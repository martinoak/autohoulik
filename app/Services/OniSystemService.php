<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OniSystemService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false,
            'timeout' => 30,
            'connect_timeout' => 10,
        ]);
    }

    public static function getBaseUri(): string
    {
        return 'https://www.onisystem.net/inetgweb/ws/driveexp.jsp';
    }

    public static function getFormParams(array $range, string $system): array
    {
        return array_merge($range, [
            'IDOWN' => env("ONI_SYSTEM_{$system}_IDOWN"),
            'WORK' => env("ONI_SYSTEM_{$system}_WORK"),
            'USER' => env("ONI_SYSTEM_{$system}_USER"),
            'PASSW' => env("ONI_SYSTEM_{$system}_PASSW"),
        ]);
    }

    /**
     * Get all configured ONI systems
     */
    public static function getConfiguredSystems(): array
    {
        $systems = [];

        if (env('ONI_SYSTEM_JAF_IDOWN')) {
            $systems['JAF'] = [
                'name' => 'JAF',
                'idown' => env('ONI_SYSTEM_JAF_IDOWN'),
                'work' => env('ONI_SYSTEM_JAF_WORK'),
                'user' => env('ONI_SYSTEM_JAF_USER'),
                'passw' => env('ONI_SYSTEM_JAF_PASSW'),
            ];
        }

        if (env('ONI_SYSTEM_HOULIK_IDOWN')) {
            $systems['HOULIK'] = [
                'name' => 'HOULIK',
                'idown' => env('ONI_SYSTEM_HOULIK_IDOWN'),
                'work' => env('ONI_SYSTEM_HOULIK_WORK'),
                'user' => env('ONI_SYSTEM_HOULIK_USER'),
                'passw' => env('ONI_SYSTEM_HOULIK_PASSW'),
            ];
        }

        return $systems;
    }

    /**
     * Get parsed vehicle list from all configured systems
     *
     * @throws GuzzleException
     */
    public function getParsedVehicleList(): array
    {
        $allVehicles = [];
        $systems = self::getConfiguredSystems();

        foreach ($systems as $systemName => $systemConfig) {
            try {
                $rawData = $this->getVehicleList($systemName);
                $vehicles = $this->parseVehicleData($rawData, $systemName);

                // Add system info to each vehicle
                foreach ($vehicles as &$vehicle) {
                    $vehicle['oni_system'] = $systemName;
                    $vehicle['oni_system_name'] = $systemConfig['name'];
                }

                $allVehicles = array_merge($allVehicles, $vehicles);

            } catch (\Exception $e) {
                \Log::warning("Failed to fetch vehicles from {$systemName} system: ".$e->getMessage());
                // Continue with other systems even if one fails
            }
        }

        return $allVehicles;
    }

    /**
     * Get parsed vehicle list from specific system
     *
     * @throws GuzzleException
     */
    public function getParsedVehicleListForSystem(string $system): array
    {
        $rawData = $this->getVehicleList($system);

        return $this->parseVehicleData($rawData, $system);
    }

    public function getRideHistory(string $id, string $timeFrom = '2025-09-01T00:00:00', string $timeTo = '2025-09-10T23:59:59', string $system = 'JAF'): string
    {
        $params = self::getFormParams([
            'ACT' => 'drives2',
            'IDOBJ' => $id,
            'TIMEFROM' => $timeFrom,
            'TIMETO' => $timeTo,
        ], $system);

        $response = $this->client->get(self::getBaseUri(), [
            'query' => $params,
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * Get last known positions for all vehicles from a specific system
     *
     * @throws GuzzleException
     */
    public function getLastPositions(string $system = 'JAF'): string
    {
        $params = self::getFormParams([
            'ACT' => 'lastposall',
        ], $system);

        $response = $this->client->get(self::getBaseUri(), [
            'query' => $params,
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * Get parsed last positions from all configured systems
     *
     * @throws GuzzleException
     */
    public function getParsedLastPositions(): array
    {
        $allPositions = [];
        $systems = self::getConfiguredSystems();

        foreach ($systems as $systemName => $systemConfig) {
            try {
                $rawData = $this->getLastPositions($systemName);
                $positions = $this->parseLastPositionsData($rawData, $systemName);

                // Add system info to each position
                foreach ($positions as &$position) {
                    $position['oni_system'] = $systemName;
                    $position['oni_system_name'] = $systemConfig['name'];
                }

                $allPositions = array_merge($allPositions, $positions);

            } catch (\Exception $e) {
                \Log::warning("Failed to fetch last positions from {$systemName} system: ".$e->getMessage());
                // Continue with other systems even if one fails
            }
        }

        return $allPositions;
    }

    /**
     * Get list of vehicles from ONI system
     *
     * @throws GuzzleException
     */
    private function getVehicleList(string $system = 'JAF'): string
    {
        $response = $this->client->get(self::getBaseUri(), [
            'query' => self::getFormParams(['ACT' => 'listobj'], $system),
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * Parse the raw ONI system data into structured array
     */
    private function parseVehicleData(string $rawData, string $system = 'JAF'): array
    {
        $lines = explode("\n", trim($rawData));
        $vehicles = [];

        foreach ($lines as $line) {
            if (empty(trim($line))) {
                continue;
            }

            $fields = explode("\t", $line);

            // Based on the example data structure
            $vehicles[] = [
                'IDOBJ' => $fields[0] ?? '',
                'NAZEV' => $fields[1] ?? '',
                'AKTIVNÍ' => $fields[2] ?? '',
                'SPZ' => $fields[3] ?? '',
                'VYR' => $fields[8] ?? '',
                'IDSRC' => $fields[25] ?? '',
                'DRUH' => $fields[28] ?? '',
                'COLOR' => $fields[32] ?? '',
                'EMAIL_NOCOMM' => $fields[33] ?? '',
            ];
        }

        return $vehicles;
    }

    /**
     * Parse the raw last positions data into structured array
     * Format: IDOBJ	TIME	GPSLO	GPSLA	VE	IGNITION
     */
    private function parseLastPositionsData(string $rawData, string $system = 'JAF'): array
    {
        $lines = explode("\n", trim($rawData));
        $positions = [];

        foreach ($lines as $line) {
            if (empty(trim($line))) {
                continue;
            }

            $fields = explode("\t", $line);

            // Based on the example data structure: IDOBJ, TIME, GPSLO, GPSLA, VE, IGNITION
            if (count($fields) >= 4) {
                $positions[] = [
                    'IDOBJ' => $fields[0] ?? '',
                    'TIME' => $fields[1] ?? '',
                    'GPSLO' => floatval($fields[2] ?? 0), // Longitude
                    'GPSLA' => floatval($fields[3] ?? 0), // Latitude
                    'VE' => $fields[4] ?? '',
                    'IGNITION' => $fields[5] ?? '',
                ];
            }
        }

        return $positions;
    }

    /**
     * Parse the raw ONI ride history data into structured array
     */
    private function parseRideHistoryData(string $rawData): array
    {
        $lines = explode("\n", trim($rawData));
        $rides = [];

        foreach ($lines as $line) {
            if (empty(trim($line))) {
                continue;
            }

            $fields = explode("\t", $line);

            // Based on the example ride history data structure
            $rides[] = [
                'IDDRIVE' => $fields[0] ?? '',
                'STARTTIME' => $fields[1] ?? '',
                'STARTGPSLO' => $fields[2] ?? '',
                'STARTGPSLA' => $fields[3] ?? '',
                'STOPTIME' => $fields[5] ?? '',
                'STOPGPSLO' => $fields[6] ?? '',
                'STOPGPSLA' => $fields[7] ?? '',
                'DRIVETYPE' => $fields[10] ?? '',
                'DRIVEDIST' => $fields[11] ?? '',
                'STARTOBEC' => $fields[12] ?? '',
                'STOPOBEC' => $fields[13] ?? '',
                'STARTSTAT' => $fields[16] ?? '',
                'STARTSTATN' => $fields[17] ?? '',
                'STARTCISPOP' => $fields[20] ?? '',
                'STARTCISOR' => $fields[21] ?? '',
                'STOPSTAT' => $fields[22] ?? '',
                'STOPSTATN' => $fields[23] ?? '',
                'STOPCISPOP' => $fields[26] ?? '',
                'STOPCISOR' => $fields[27] ?? '',
                'VEMAX' => $fields[28] ?? '',
                'VEAVG' => $fields[29] ?? '',
                'TIMEDIFF' => $fields[30] ?? '',
                'MOTOHOD' => $fields[39] ?? '',
            ];
        }

        return $rides;
    }

    public function getParsedRideHistory(string $id, string $timeFrom = '2025-09-01T00:00:00', string $timeTo = '2025-09-10T23:59:59', string $system = 'JAF'): array
    {
        $rawData = $this->getRideHistory($id, $timeFrom, $timeTo, $system);

        return $this->parseRideHistoryData($rawData);
    }
}
