@extends('layout')

@section('head')
    <style>
        .gm-style-iw-c {
            padding-top: 12px !important;
        }

        .gm-style-iw-chr {
            position: absolute;
            right: 0;
        }
    </style>
@endsection

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center mt-4">
            <div class="sm:flex-auto">
                <h1 class="heading-title">Mapa vozidel</h1>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{ url()->current() }}" class="button soft">Obnovit mapu</a>
            </div>
        </div>

        <div class="my-8 flow-root">
            <div class="bg-white dark:bg-zinc-800 shadow-sm ring-1 ring-gray-900/5 dark:ring-white/10 rounded-lg">
                @if(config('maps.google_api_key'))
                    <div id="map" style="height: 600px; width: 100%; border-radius: 0.5rem;">
                        <div id="map-loading" class="flex items-center justify-center h-full">
                            <div class="text-center">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-red-600 mx-auto"></div>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Načítání mapy...</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="p-8 text-center">
                        <div class="mx-auto h-12 w-12 text-gray-400">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 01.553-.894L9 2l6 3 5.447-2.724A1 1 0 0121 3.382v10.764a1 1 0 01-.553.894L15 18l-6-3z"></path>
                            </svg>
                        </div>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Google Maps není dostupné</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Pro zobrazení mapy je potřeba nastavit GOOGLE_MAPS_API_KEY v .env souboru.
                        </p>
                    </div>
                @endif
            </div>
        </div>


        <div class="sm:flex sm:items-center my-8">
            <div class="sm:flex-auto">
                <h1 class="heading-title">Seznam vozů z ONI systému</h1>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Přehled vozidel evidovaných v portálu ONI system a jejich specifikace</p>
            </div>
        </div>

        @if(isset($error))
            <div class="rounded-md bg-red-50 p-4 dark:bg-red-900/20">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Chyba při načítání vozidel</h3>
                        <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                            <p>{{ $error }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(count($vehicles) === 0 && !isset($error))
            <div class="mt-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Žádná vozidla</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Nebyla nalezena žádná aktivní vozidla v ONI systémech.
                </p>
            </div>
        @endif

        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="relative min-w-full divide-y divide-gray-300 dark:divide-white/15">
                        <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-0 dark:text-white">Název</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white hidden lg:table-cell">ID vozidla</th>
                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900 dark:text-white hidden md:table-cell">Aktivní</th>
                            <th scope="col" class="py-3.5 pr-4 text-right pl-3 sm:pr-0 text-gray-900 dark:text-white">
                                Akce
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-white/10">
                            @foreach($vehicles as $vehicle)
                                @continue($vehicle['AKTIVNÍ'] === 'F' || $vehicle['IDOBJ'] === '93584')
                                <tr>
                                    <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-0 dark:text-white">{{ $vehicle['NAZEV'] }}</td>
                                    <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400 hidden lg:table-cell">{{ $vehicle['IDOBJ'] }}</td>
                                    <td class="px-3 py-4 text-sm text-center whitespace-nowrap text-gray-500 dark:text-gray-400 hidden md:table-cell">
                                        @if($vehicle['AKTIVNÍ'] === 'T')
                                            <span class="badge-green">ANO</span>
                                        @else
                                            <span class="badge-red">NE</span>
                                        @endif
                                    </td>
                                    <td class="py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-0">
                                        <a href="{{ route('admin.oni.show', ['oni' => $vehicle['IDOBJ']]) }}" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                            Detail vozidla
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
@if(config('maps.google_api_key'))
<script>
let map;
let infoWindow;

function initMap() {
    console.log('initMap called');

    try {
        const loadingElement = document.getElementById('map-loading');
        if (loadingElement) {
            loadingElement.style.display = 'none';
        }

        // Default center (Czech Republic)
        const defaultCenter = { lat: 49.75, lng: 15.5 };

        console.log('Creating map...');
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 8,
            center: defaultCenter,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        });
        console.log('Map created successfully');

        infoWindow = new google.maps.InfoWindow();

        // Vehicle positions data from PHP
        const positionsData = @json($filteredPositions ?? []);
        console.log('Positions data:', positionsData);

        // Convert object to array if needed (PHP array_filter can return objects)
        const positions = Array.isArray(positionsData) ? positionsData : Object.values(positionsData);
        console.log('Positions array:', positions);

        if (positions.length === 0) {
            console.log('No positions available');
            // Show message when no positions available
            const noDataDiv = document.createElement('div');
            noDataDiv.innerHTML = `
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                            background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                            text-align: center; z-index: 1000;">
                    <h3 style="margin: 0 0 10px 0; color: #374151;">Žádné pozice vozidel</h3>
                    <p style="margin: 0; color: #6B7280;">Nebyla nalezena žádná data o poloze vozidel.</p>
                </div>
            `;
            document.getElementById('map').appendChild(noDataDiv);
            return;
        }

        console.log('Creating markers for', positions.length, 'positions');
        // Create markers for each vehicle position
        const bounds = new google.maps.LatLngBounds();

        positions.forEach(position => {
            if (position.GPSLA && position.GPSLO && position.GPSLA !== 0 && position.GPSLO !== 0) {
                const latLng = new google.maps.LatLng(position.GPSLA, position.GPSLO);

                const marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    title: `Vozidlo ID: ${position.IDOBJ}`,
                    icon: {
                        url: `/img/oni/${position.IDOBJ}.png`,
                        scaledSize: new google.maps.Size(69, 27),
                        anchor: new google.maps.Point(0, 0)
                    }
                });

                // Add click listener to show vehicle info
                marker.addListener('click', () => {
                    showVehicleInfo(position, marker);
                });

                bounds.extend(latLng);
            }
        });

        // Fit map to show all markers
        if (!bounds.isEmpty()) {
            map.fitBounds(bounds);

            // Ensure minimum zoom level
            google.maps.event.addListenerOnce(map, 'bounds_changed', function() {
                if (map.getZoom() > 15) {
                    map.setZoom(15);
                }
            });
        }

        console.log('Map initialization complete');
    } catch (error) {
        console.error('Error in initMap:', error);
        const loadingElement = document.getElementById('map-loading');
        if (loadingElement) {
            loadingElement.innerHTML = `
                <div class="text-center">
                    <p class="text-sm text-red-600">Chyba při načítání mapy: ${error.message}</p>
                </div>
            `;
        }
    }
}

async function showVehicleInfo(position, marker) {
    try {
        const response = await fetch(`/admin/vehicles/api/by-oni-id/${position.IDOBJ}`);

        let content = '';

        if (response.ok) {
            const vehicle = await response.json();
            content += `
            <div style="min-width: 250px;">
                <h2 class="font-bold text-xl">${vehicle.manufacturer} ${vehicle.model}</h2>
                <p style="margin: 5px 0;"><strong>Čas:</strong> ${position.TIME}</p>
                <p style="margin: 5px 0;"><strong>SPZ:</strong> ${vehicle.spz || 'N/A'}</p>
                <div style="margin: 15px 0;">
                    <a href="/admin/oni/${position.IDOBJ}"
                       style="background: #DC2626; color: white; padding: 8px 16px; text-decoration: none;
                              border-radius: 4px; font-size: 14px;">
                        Detail vozidla
                    </a>
                </div>
            `;
        } else {
            content += `
                <p style="margin: 5px 0; color: red">Vozidlo není v databázi</p>
            `;
        }

        content += '</div>';

        infoWindow.setContent(content);
        infoWindow.open(map, marker);

    } catch (error) {
        console.error('Error fetching vehicle details:', error);

        const content = `
            <div style="min-width: 250px;">
                <p style="margin: 5px 0;"><strong>Čas:</strong> ${position.TIME}</p>
                <div style="margin-top: 15px;">
                    <a href="/admin/oni/${position.IDOBJ}"
                       style="background: #DC2626; color: white; padding: 8px 16px; text-decoration: none;
                              border-radius: 4px; font-size: 14px;">
                        Detail vozidla
                    </a>
                </div>
            </div>
        `;

        infoWindow.setContent(content);
        infoWindow.open(map, marker);
    }
}

// Add error handling
window.gm_authFailure = function() {
    console.error('Google Maps authentication failed');
    const loadingElement = document.getElementById('map-loading');
    if (loadingElement) {
        loadingElement.innerHTML = `
            <div class="text-center">
                <p class="text-sm text-red-600">Chyba autentizace Google Maps API</p>
            </div>
        `;
    }
};
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('maps.google_api_key') }}&callback=initMap"></script>
@endif
@endsection
