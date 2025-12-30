<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SheetsController extends Controller
{
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
