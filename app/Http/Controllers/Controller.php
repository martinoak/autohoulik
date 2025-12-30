<?php

namespace App\Http\Controllers;

use App\Services\OniSystemService;
use Illuminate\Support\Facades\Log;

abstract class Controller
{
    public function __construct(
        protected OniSystemService $oni
    ) {
    }

    /**
     * Determine which ONI system a vehicle belongs to by checking all systems
     */
    protected function determineOniSystem(string $vehicleId): string
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
    protected function processRidesForTimeReport(array $rides): array
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
    protected function calculateRideSummary(array $processedRides): array
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
}
