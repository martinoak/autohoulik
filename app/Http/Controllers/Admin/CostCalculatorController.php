<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CostCalculatorController extends Controller
{
    private const DATA_FILE = 'calc-data.json';

    public function index(): View
    {
        return view('admin.cost-calculator');
    }

    /**
     * Save calculator data to JSON file
     */
    public function save(Request $request): JsonResponse
    {
        $data = $request->validate([
            'fuelConsumption' => 'nullable|numeric|min:0',
            'fuelPrice' => 'nullable|numeric|min:0',
            'driverWage' => 'nullable|numeric|min:0',
            'insurance' => 'nullable|numeric|min:0',
            'toll' => 'nullable|numeric|min:0',
            'otherCosts' => 'nullable|numeric|min:0',
            'margin' => 'nullable|numeric|min:0',
        ]);

        try {
            // Add timestamp
            $data['updated_at'] = now()->toIso8601String();

            // Save to storage/app/private/calc-data.json
            Storage::disk('local')->put(self::DATA_FILE, json_encode($data, JSON_PRETTY_PRINT));

            return response()->json([
                'success' => true,
                'message' => 'Data saved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Load calculator data from JSON file
     */
    public function load(): JsonResponse
    {
        try {
            if (Storage::disk('local')->exists(self::DATA_FILE)) {
                $content = Storage::disk('local')->get(self::DATA_FILE);
                $data = json_decode($content, true);

                return response()->json($data ?? []);
            }

            return response()->json([]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to load data: ' . $e->getMessage()
            ], 500);
        }
    }
}
