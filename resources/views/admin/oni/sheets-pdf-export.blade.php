<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Výkazy hodin vozidel</title>
    <style>
        @page {
            margin: 15mm;
            size: A4;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }

        .header .date {
            font-size: 14px;
            font-weight: bold;
            color: #666;
        }

        .vehicle-section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .vehicle-header {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            border: 1px solid #dee2e6;
        }

        .vehicle-header h2 {
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            color: #333;
        }

        .vehicle-info {
            font-size: 10px;
            color: #666;
            margin-top: 3px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 9px;
        }

        .table th {
            background-color: #343a40;
            color: white;
            padding: 8px 6px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #dee2e6;
        }

        .table td {
            padding: 6px;
            border: 1px solid #dee2e6;
            vertical-align: top;
        }

        .table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table .summary-row {
            background-color: #e9ecef !important;
            font-weight: bold;
        }

        .table .summary-row td {
            border-top: 2px solid #333;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .no-data {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 20px;
        }

        .error-message {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 10px;
            border-radius: 3px;
            margin-bottom: 10px;
            font-size: 9px;
        }

        .footer {
            position: fixed;
            bottom: 10mm;
            left: 15mm;
            right: 15mm;
            text-align: center;
            font-size: 8px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 5px;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>Výkazy hodin vozidel</h1>
        <div class="date">{{ $reportMonth }}</div>
    </div>

    @if(empty($vehicleReports))
        <div class="no-data">
            Žádná vozidla s přiřazeným ONI ID nebyla nalezena.
        </div>
    @else
        @foreach($vehicleReports as $index => $report)
            @if($index > 0)
                <div class="page-break"></div>
            @endif

            <div class="vehicle-section">
                <div class="vehicle-header">
                    <h2>{{ $report['vehicle']->manufacturer }} {{ $report['vehicle']->model }}</h2>
                    <div class="vehicle-info">
                        SPZ: {{ $report['vehicle']->spz }}
                    </div>
                </div>

                @if(isset($report['error']))
                    <div class="error-message">
                        <strong>Chyba při načítání dat:</strong> {{ $report['error'] }}
                    </div>
                @else
                    @if(empty($report['rides']))
                        <div class="no-data">
                            Žádné jízdy v období {{ $startDate->format('d.m.Y') }} - {{ $endDate->format('d.m.Y') }}
                        </div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Den</th>
                                    <th>Začátek první jízdy</th>
                                    <th>Konec poslední jízdy</th>
                                    <th class="text-right">Ujeté km</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($report['rides'] as $ride)
                                    <tr>
                                        <td>
                                            <strong>{{ ucfirst($ride['day_name']) }}</strong><br>
                                        </td>
                                        <td>{{ $ride['start_time'] }}</td>
                                        <td>{{ $ride['end_time'] }}</td>
                                        <td class="text-right">{{ number_format($ride['total_distance'], 1) }} km</td>
                                    </tr>
                                @endforeach

                                <tr class="summary-row">
                                    <td>
                                        <strong>Počet dní řízení: {{ count($report['rides']) }}</strong>
                                    </td>
                                    <td colspan="2">
                                        @php
                                            $totalSeconds = collect($report['rides'])->sum('total_seconds');
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
                                        @endphp
                                        <strong>Celkem hodin řízení: {{ $formattedTime }}</strong>
                                    </td>
                                    <td class="text-right">
                                        <strong>{{ number_format($report['summary']['total_distance'], 1) }} km</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                @endif
            </div>
        @endforeach
    @endif

    <!-- Footer -->
    <div class="footer">
        Vygenerováno: {{ $generatedAt->format('d.m.Y H:i:s') }} | Systém evidence vozidel
    </div>
</body>
</html>
