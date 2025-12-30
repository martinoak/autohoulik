@extends('layout')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center mt-4">
            <div class="sm:flex-auto">
                <h1 class="heading-title">Výkazy hodin</h1>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                    Přehled jízd vozidel za {{ $reportMonth ?? 'N/A' }}
                </p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{ route('admin.fleet.sheets.export') }}" class="button primary">
                    <i class="fa-solid fa-download mr-2"></i>
                    Stáhnout PDF
                </a>
            </div>
        </div>

        @if(isset($error))
            <div class="mt-8 bg-red-50 border border-red-200 rounded-md p-4 dark:bg-red-900/20 dark:border-red-800">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-exclamation-triangle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                            Chyba při načítání dat
                        </h3>
                        <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                            {{ $error }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(empty($vehicleReports)) {{-- TODO forelse --}}
            <div class="mt-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Žádná vozidla</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Nebyla nalezena žádná vozidla s přiřazeným ONI ID.
                </p>
            </div>
        @else
            @foreach($vehicleReports as $report)
                <div class="mt-8">
                    <div class="sm:flex sm:items-center mb-4">
                        <div class="sm:flex-auto">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $report['vehicle']->manufacturer }} {{ $report['vehicle']->model }}
                                <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">
                                    ({{ $report['vehicle']->spz }})
                                </span>
                            </h2>
                        </div>
                    </div>

                    @if(isset($report['error']))
                        <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 dark:bg-yellow-900/20 dark:border-yellow-800">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fa-solid fa-exclamation-triangle text-yellow-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                                        Chyba při načítání dat vozidla
                                    </h3>
                                    <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                                        {{ $report['error'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mt-4 flow-root">
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <table class="relative min-w-full divide-y divide-gray-300 dark:divide-white/15">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 dark:text-white">Den</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">Začátek první jízdy</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">Konec poslední jízdy</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">Celkový čas</th>
                                            <th scope="col" class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900 dark:text-white">Ujeté km</th>
                                        </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-white/10">
                                            @forelse($report['rides'] as $ride)
                                                <tr>
                                                    <td class="py-4 pr-3 pl-4 text-sm whitespace-nowrap text-gray-900 dark:text-white">
                                                        <div class="font-medium">{{ \Illuminate\Support\Str::ucfirst($ride['day_name']) }}</div>
                                                    </td>
                                                    <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                        {{ $ride['start_time'] }}
                                                    </td>
                                                    <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                        {{ $ride['end_time'] }}
                                                    </td>
                                                    <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                        {{ $ride['formatted_time'] }}
                                                    </td>
                                                    <td class="px-3 py-4 text-sm text-right whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                        {{ number_format($ride['total_distance'], 1) }} km
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                                        Žádné jízdy v tomto období
                                                    </td>
                                                </tr>
                                            @endforelse

                                            @if(!empty($report['rides']))
                                                <tr class="bg-gray-50 dark:bg-primary-800/20">
                                                    <td colspan="2" class="py-4 pr-3 pl-4 text-sm font-semibold text-gray-900 dark:text-white">
                                                        Počet dní řízení: {{ count($report['rides']) }}
                                                    </td>
                                                    <td colspan="2" class="py-4 pr-3 pl-4 text-sm font-semibold text-gray-900 sm:pl-0 dark:text-white">
                                                        Celkem hodin řízení:
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
                                                        {{ $formattedTime }}
                                                    </td>
                                                    <td class="px-3 py-4 text-sm text-right font-semibold text-gray-900 dark:text-white">
                                                        {{ number_format($report['summary']['total_distance'], 1) }} km
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
@endsection
