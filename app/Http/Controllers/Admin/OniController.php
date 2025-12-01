<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Services\MapService;
use App\Services\OniSystemService;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class OniController extends Controller
{
    private OniSystemService $oni;

    private MapService $mapService;

    public function __construct(OniSystemService $oni, MapService $mapService)
    {
        $this->oni = $oni;
        $this->mapService = $mapService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|RedirectResponse
    {
        try {
            $vehicles = $this->oni->getParsedVehicleList();
            $lastPositions = $this->oni->getParsedLastPositions();

            // Filter positions to only include vehicles that exist in our database
            $dbVehicles = \App\Models\Vehicle::whereNotNull('oni_id')->pluck('oni_id')->toArray();
            $filteredPositions = array_filter($lastPositions, function($position) use ($dbVehicles) {
                return in_array($position['IDOBJ'], $dbVehicles);
            });

            return view('admin.oni.index', compact('vehicles', 'filteredPositions'));
        } catch (GuzzleException|\Exception $e) {
            return view('admin.oni.index', [
                'vehicles' => [],
                'filteredPositions' => [],
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @throws GuzzleException
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $from = request('start_date', date('c', strtotime('-1 month'))).'T00:00:00';
            $to = request('end_date', date('c')).'T23:59:59';

            $vehicle = Vehicle::where('oni_id', $id)->first();
            if (!$vehicle) {
                return back()->with('error', 'Vozidlo nemá přiřazené ONI ID!');
            }

            $system = $this->determineOniSystem($id);
            $rides = $this->oni->getParsedRideHistory($id, $from, $to, $system);

            $grouped = collect($rides)->groupBy(function ($ride) {
                $startTime = $ride['STARTTIME'];
                if (preg_match('/^(\d{2}\.\d{2}\.\d{2})/', $startTime, $matches)) {
                    return $matches[1]; // Returns date like "04.09.25"
                }

                return 'Unknown Date';
            });

            // Sort the grouped collection by actual date values (most recent first)
            $ridesByDate = $grouped->sortByDesc(function ($rides, $dateString) {
                // Convert date string to sortable format
                // "04.09.25" -> "2025-09-04" for proper sorting
                if (preg_match('/^(\d{2})\.(\d{2})\.(\d{2})$/', $dateString, $matches)) {
                    $day = $matches[1];
                    $month = $matches[2];
                    $year = '20'.$matches[3]; // Convert 25 to 2025

                    return $year.'-'.$month.'-'.$day;
                }

                return $dateString;
            });

            return view('admin.oni.show', compact('vehicle', 'ridesByDate', 'id'));
        } catch (GuzzleException|\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Export ride history for a specific date as PDF
     */
    public function export(string $id): Response
    {
        try {
            $date = request('date');

            $vehicle = Vehicle::where('oni_id', $id)->first();

            // Determine which ONI system this vehicle belongs to
            $system = $this->determineOniSystem($id);
            $rides = $this->oni->getParsedRideHistory($id, $date.'T00:00:00', $date.'T23:59:59', $system);

            // Generate map image using MapService
            $mapImage = $this->mapService->generateMapImageForPdf($rides, 600, 400);

            $pdf = Pdf::loadView('admin.oni.pdf-export', [
                'vehicle' => $vehicle,
                'rides' => $rides,
                'date' => $date ?: 'Všechny záznamy',
                'mapImage' => $mapImage,
            ]);

            $filename = 'stazka_'.$vehicle->spz.'.pdf';

            return $pdf->download($filename);
        } catch (GuzzleException|\Exception $e) {
            return response('Error generating export: '.$e->getMessage(), 500);
        }
    }

    /**
     * Show interactive map preview for ride history
     */
    public function showMap(string $id): View|Response
    {
        try {
            $date = request('date');
            $vehicle = Vehicle::where('oni_id', $id)->first();

            // Determine which ONI system this vehicle belongs to
            $system = $this->determineOniSystem($id);
            $rides = $this->oni->getParsedRideHistory($id, $date.'T00:00:00', $date.'T23:59:59', $system);

            return view('admin.oni.map-preview', [
                'vehicle' => $vehicle,
                'rides' => $rides,
                'date' => $date,
                'id' => $id,
            ]);
        } catch (GuzzleException|\Exception $e) {
            return response('Error loading map: '.$e->getMessage(), 500);
        }
    }

    /**
     * Determine which ONI system a vehicle belongs to by checking all systems
     */
    private function determineOniSystem(string $vehicleId): string
    {
        $systems = OniSystemService::getConfiguredSystems();

        foreach ($systems as $systemName => $systemConfig) {
            try {
                $vehicles = $this->oni->getParsedVehicleListForSystem($systemName);

                // Check if this vehicle ID exists in this system
                foreach ($vehicles as $vehicle) {
                    if ($vehicle['IDOBJ'] === $vehicleId) {
                        Log::info("Vehicle {$vehicleId} found in {$systemName} system");

                        return $systemName;
                    }
                }
            } catch (\Exception $e) {
                Log::warning("Failed to check {$systemName} system for vehicle {$vehicleId}: ".$e->getMessage());

                continue;
            }
        }

        Log::warning("Vehicle {$vehicleId} not found in any ONI system.");

        return 'JAF';
    }

    /**
     * Process rides for time report - group by day and calculate segments
     */
    private function processRidesForTimeReport(array $rides): array
    {
        if (empty($rides)) {
            return [];
        }

        // Group rides by date
        $ridesByDate = collect($rides)->groupBy(function ($ride) {
            $startTime = $ride['STARTTIME'];
            if (preg_match('/^(\d{2}\.\d{2}\.\d{2})/', $startTime, $matches)) {
                return $matches[1]; // Returns date like "04.09.25"
            }
            return 'Unknown Date';
        });

        $processedRides = [];

        foreach ($ridesByDate as $date => $dayRides) {
            // Sort rides by start time for the day
            $sortedRides = collect($dayRides)->sortBy('STARTTIME');

            if ($sortedRides->isNotEmpty()) {
                $firstRide = $sortedRides->first();
                $lastRide = $sortedRides->last();

                // Calculate total distance for the day
                $totalDistance = $sortedRides->sum(function ($ride) {
                    return floatval($ride['DRIVEDIST'] ?? 0);
                });

                // Calculate total driving time in seconds
                $totalSeconds = $sortedRides->sum(function ($ride) {
                    return intval($ride['TIMEDIFF'] ?? 0);
                });

                // Convert date to Carbon for day name
                $dayName = '';
                if (preg_match('/^(\d{2})\.(\d{2})\.(\d{2})$/', $date, $matches)) {
                    $day = $matches[1];
                    $month = $matches[2];
                    $year = '20' . $matches[3];
                    try {
                        $carbonDate = \Carbon\Carbon::createFromFormat('Y-m-d', $year . '-' . $month . '-' . $day);
                        $dayName = $carbonDate->locale('cs')->dayName;
                    } catch (\Exception $e) {
                        $dayName = '';
                    }
                }

                // Format hours in human-readable Czech format
                $hours = intval($totalSeconds / 3600);
                $minutes = intval(($totalSeconds % 3600) / 60);
                $formattedTime = '';

                if ($hours > 0) {
                    $formattedTime .= $hours . ' ' . ($hours === 1 ? 'hodina' : ($hours < 5 ? 'hodiny' : 'hodin'));
                }
                if ($minutes > 0) {
                    if ($formattedTime) $formattedTime .= ' ';
                    $formattedTime .= $minutes . ' ' . ($minutes === 1 ? 'minuta' : ($minutes < 5 ? 'minuty' : 'minut'));
                }
                if (!$formattedTime) {
                    $formattedTime = '0 minut';
                }

                $processedRides[] = [
                    'date' => $date,
                    'day_name' => $dayName,
                    'start_time' => $firstRide['STARTTIME'],
                    'end_time' => $lastRide['STOPTIME'],
                    'total_distance' => $totalDistance,
                    'total_seconds' => $totalSeconds,
                    'total_hours' => round($totalSeconds / 3600, 2),
                    'formatted_time' => $formattedTime,
                    'ride_count' => $sortedRides->count(),
                ];
            }
        }

        // Sort by date (chronologically - first to last)
        return collect($processedRides)->sortBy(function ($ride) {
            // Convert date string to sortable format for proper chronological sorting
            // "04.09.25" -> "2025-09-04"
            if (preg_match('/^(\d{2})\.(\d{2})\.(\d{2})$/', $ride['date'], $matches)) {
                $day = $matches[1];
                $month = $matches[2];
                $year = '20' . $matches[3]; // Convert 25 to 2025
                return $year . '-' . $month . '-' . $day;
            }
            return $ride['date'];
        })->values()->toArray();
    }

    /**
     * Calculate summary statistics for all rides
     */
    private function calculateRideSummary(array $processedRides): array
    {
        if (empty($processedRides)) {
            return [
                'total_hours' => 0,
                'total_distance' => 0,
                'total_rides' => 0,
            ];
        }

        $totalHours = collect($processedRides)->sum('total_hours');
        $totalDistance = collect($processedRides)->sum('total_distance');
        $totalRides = collect($processedRides)->sum('ride_count');

        return [
            'total_hours' => round($totalHours, 2),
            'total_distance' => round($totalDistance, 1),
            'total_rides' => $totalRides,
        ];
    }

    public function sheets(): View
    {
        try {
            // Get all vehicles with oni_id from database
            $vehicles = Vehicle::whereNotNull('oni_id')->get();

            // Calculate date range for past month
            $currentDate = now();
            $startDate = $currentDate->copy()->subMonth()->startOfMonth();
            $endDate = $currentDate->copy()->subMonth()->endOfMonth();

            $vehicleReports = [];

            foreach ($vehicles as $vehicle) {
                try {
                    // Determine which ONI system this vehicle belongs to
                    $system = $this->determineOniSystem($vehicle->oni_id);

                    // Get ride history for the past month
                    $rides = $this->oni->getParsedRideHistory(
                        $vehicle->oni_id,
                        $startDate->format('Y-m-d') . 'T00:00:00',
                        $endDate->format('Y-m-d') . 'T23:59:59',
                        $system
                    );

                    // Process rides to get summary data
                    $processedRides = $this->processRidesForTimeReport($rides);

                    $vehicleReports[] = [
                        'vehicle' => $vehicle,
                        'rides' => $processedRides,
                        'summary' => $this->calculateRideSummary($processedRides),
                    ];

                } catch (\Exception $e) {
                    \Log::warning("Failed to fetch rides for vehicle {$vehicle->oni_id}: " . $e->getMessage());

                    // Add vehicle with empty data if fetch fails
                    $vehicleReports[] = [
                        'vehicle' => $vehicle,
                        'rides' => [],
                        'summary' => [
                            'total_hours' => 0,
                            'total_distance' => 0,
                            'total_rides' => 0,
                        ],
                        'error' => $e->getMessage(),
                    ];
                }
            }

            return view('admin.oni.sheets', [
                'vehicleReports' => $vehicleReports,
                'reportMonth' => $startDate->locale('cs')->isoFormat('MMMM YYYY'),
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);

        } catch (\Exception $e) {
            return view('admin.oni.sheets', [
                'vehicleReports' => [],
                'reportMonth' => 'N/A',
                'startDate' => now()->subMonth()->startOfMonth(),
                'endDate' => now()->subMonth()->endOfMonth(),
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Export time reports for all vehicles as PDF
     */
    public function exportSheets(): Response
    {
        try {
            // Get all vehicles with oni_id from database
            $vehicles = Vehicle::whereNotNull('oni_id')->get();

            // Calculate date range for past month
            $currentDate = now();
            $startDate = $currentDate->copy()->subMonth()->startOfMonth();
            $endDate = $currentDate->copy()->subMonth()->endOfMonth();

            $vehicleReports = [];

            foreach ($vehicles as $vehicle) {
                try {
                    // Determine which ONI system this vehicle belongs to
                    $system = $this->determineOniSystem($vehicle->oni_id);

                    // Get ride history for the past month
                    $rides = $this->oni->getParsedRideHistory(
                        $vehicle->oni_id,
                        $startDate->format('Y-m-d') . 'T00:00:00',
                        $endDate->format('Y-m-d') . 'T23:59:59',
                        $system
                    );

                    // Process rides to get summary data
                    $processedRides = $this->processRidesForTimeReport($rides);

                    $vehicleReports[] = [
                        'vehicle' => $vehicle,
                        'rides' => $processedRides,
                        'summary' => $this->calculateRideSummary($processedRides),
                    ];

                } catch (\Exception $e) {
                    \Log::warning("Failed to fetch rides for vehicle {$vehicle->oni_id}: " . $e->getMessage());

                    // Add vehicle with empty data if fetch fails
                    $vehicleReports[] = [
                        'vehicle' => $vehicle,
                        'rides' => [],
                        'summary' => [
                            'total_hours' => 0,
                            'total_distance' => 0,
                            'total_rides' => 0,
                        ],
                        'error' => $e->getMessage(),
                    ];
                }
            }

            $pdf = Pdf::loadView('admin.oni.sheets-pdf-export', [
                'vehicleReports' => $vehicleReports,
                'reportMonth' => $startDate->locale('cs')->isoFormat('MMMM YYYY'),
                'startDate' => $startDate,
                'endDate' => $endDate,
                'generatedAt' => now(),
            ]);

            $filename = 'vykazy-hodin-' . $startDate->format('Y-m') . '.pdf';

            return $pdf->download($filename);

        } catch (\Exception $e) {
            return back()->with('error', 'Chyba při generování PDF: ' . $e->getMessage());
        }
    }
}
