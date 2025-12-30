@extends('layout')

@section('content')
    <div>
        <div class="px-4 sm:px-0 flex justify-between">
            <h3 class="heading-title">Detail vozidla</h3>
            <div class="space-y-4 flex gap-6">
                <a href="{{ route('admin.fleet.edit', ['fleet' => $vehicle->id]) }}" class="button soft">
                    <i class="fa-solid fa-file-pen mr-2"></i> Upravit vozidlo
                </a>

                <form action="{{ route('admin.fleet.destroy', ['fleet' => $vehicle->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="danger" onclick="return confirm('Opravdu smazat vozidlo? Tato akce je nevratná.')">
                        <i class="fa-solid fa-trash mr-2"></i>
                        Smazat vozidlo
                    </button>
                </form>
            </div>
        </div>
        <div class="mt-6 border-t border-gray-100 dark:border-white/10">
            <dl class="divide-y divide-gray-100 dark:divide-white/10">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="font-medium text-gray-900 dark:text-gray-100">Výrobce</dt>
                    <dd class="mt-1 text-gray-700 sm:col-span-2 sm:mt-0 dark:text-gray-200">
                        <img src="{{ \App\Enum\VehicleManufacturer::getLogo($vehicle->manufacturer) }}" alt="{{ $vehicle->manufacturer }}" class="h-12 dark:hidden">
                        <img src="{{ \App\Enum\VehicleManufacturer::getLogo($vehicle->manufacturer, 'dark') }}" alt="{{ $vehicle->manufacturer }}" class="h-12 hidden dark:block">
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="font-medium text-gray-900 dark:text-gray-100">Model</dt>
                    <dd class="mt-1 text-gray-700 sm:col-span-2 sm:mt-0 dark:text-gray-200">
                        {{ $vehicle->model }}
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="font-medium text-gray-900 dark:text-gray-100">Rok výroby</dt>
                    <dd class="mt-1 text-gray-700 sm:col-span-2 sm:mt-0 dark:text-gray-200">
                        {{ $vehicle->productionYear }}
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="font-medium text-gray-900 dark:text-gray-100">VIN</dt>
                    <dd class="mt-1 text-gray-700 sm:col-span-2 sm:mt-0 dark:text-gray-200 flex items-center font-bold">
                        {{ $vehicle->vin }}
                        <button type="button" class="ml-4 py-2! soft" onclick="navigator.clipboard.writeText('{{ $vehicle->vin }}')">
                            <i class="fa-regular fa-paste fa-lg"></i>
                        </button>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="font-medium text-gray-900 dark:text-gray-100">SPZ</dt>
                    <dd class="mt-1 text-gray-700 sm:col-span-2 sm:mt-0 dark:text-gray-200">
                        <x-license-plate :spz="$vehicle->spz" size="md" />
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="font-medium text-gray-900 dark:text-gray-100">Letní pneu</dt>
                    <dd class="mt-1 text-gray-700 sm:col-span-2 sm:mt-0 dark:text-gray-200">
                        @if($vehicle->spneu)
                            {{ $vehicle->spneu }}
                        @else
                            <x-placeholder :text="'Nevyplněno'" :height="'h-[75px]'" />
                        @endif
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="font-medium text-gray-900 dark:text-gray-100">Zimní pneu</dt>
                    <dd class="mt-1 text-gray-700 sm:col-span-2 sm:mt-0 dark:text-gray-200">
                        @if($vehicle->wpneu)
                            {{ $vehicle->wpneu }}
                        @else
                            <x-placeholder :text="'Nevyplněno'" :height="'h-[75px]'" />
                        @endif
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="font-medium text-gray-900 dark:text-gray-100">
                        <img src="{{ asset('images/oni.png') }}" alt="ONI system ID" class="h-6 inline-block">
                    </dt>
                    <dd class="mt-1 text-gray-700 sm:col-span-2 sm:mt-0 dark:text-gray-200">
                        @if($vehicle->oni_id)
                            <div class="flex items-center gap-24">
                                <strong>{{ $vehicle->oni_id }}</strong>
                                <a href="{{ route('admin.oni.show', ['oni' => $vehicle->oni_id]) }}"
                                   class="button soft font-bold"
                                >
                                    Získat data z ONI
                                </a>
                            </div>
                        @else
                            <x-placeholder :text="'Nevyplněno'" :height="'h-[75px]'" />
                        @endif
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm/6 font-medium text-gray-900 dark:text-gray-100">Přílohy</dt>
                    <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0 dark:text-white">
                        @if($vehicle->vtp)
                            <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200 dark:divide-white/5 dark:border-white/10">
                                <li class="flex items-center justify-between py-4 pr-5 pl-4 text-sm/6">
                                    <div class="flex w-0 flex-1 items-center">
                                        <i class="fa-solid fa-paperclip fa-lg text-gray-500 dark:text-gray-300"></i>
                                        <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                            <span class="truncate font-medium text-gray-900 dark:text-white">VTP</span>
                                        </div>
                                    </div>
                                    <div class="ml-4 shrink-0">
                                        <a href="{{ $vehicle->vtp }}"
                                           class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300"
                                           target="_blank"
                                        >
                                            Zobrazit
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        @else
                            <x-placeholder :text="'Žádné přílohy'" :height="'h-[75px]'" />
                        @endif
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm/6 font-medium text-gray-900 dark:text-gray-100">Servisní kniha</dt>
                    <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0 dark:text-white">
                        <a href="{{ route('service-book.create', ['vehicle' => $vehicle->id]) }}" class="button primary mb-4">
                            <i class="fa-solid fa-plus mr-2"></i> Přidat záznam
                        </a>
                        <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200 dark:divide-white/5 dark:border-white/10 mt-4">
                            @forelse($vehicle->serviceLog()->orderBy('service_date', 'desc')->get() as $log)
                                <li class="py-4 pr-5 pl-4">
                                    <!-- Top row: Title (left) and Price/KM (right) -->
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center flex-1">
                                            <i class="fa-solid fa-wrench fa-lg text-gray-500 dark:text-gray-300"></i>
                                            <h3 class="ml-3 font-medium text-xl text-gray-900 dark:text-white">{{ $log->title }}</h3>
                                        </div>
                                        <div class="flex gap-6 text-sm">
                                            @if($log->price)
                                            <div class="text-right">
                                                <div class="text-gray-500 dark:text-gray-300">Cena</div>
                                                <div class="font-bold text-gray-700 dark:text-gray-200">{{ number_format($log->price, 0, ',', ' ') }} Kč</div>
                                            </div>
                                            @endif
                                            @if($log->km)
                                            <div class="text-right">
                                                <div class="text-gray-500 dark:text-gray-300">Stav km</div>
                                                <div class="font-bold text-gray-700 dark:text-gray-200">{{ number_format($log->km, 0, ',', ' ') }} km</div>
                                            </div>
                                            @endif
                                            @if($log->next_km)
                                            <div class="text-right">
                                                <div class="text-gray-500 dark:text-gray-300">Další servis km</div>
                                                <div class="font-bold text-gray-700 dark:text-gray-200">{{ number_format($log->next_km, 0, ',', ' ') }} km</div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Note section -->
                                    @if($log->note)
                                    <div class="m-4">
                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ $log->note }}
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Middle row: Attachments under title -->
                                    @if($log->attachments()->count() > 0)
                                    <div class="ml-4 mb-3 flex flex-col gap-y-2">
                                        @foreach($log->attachments()->get() as $att)
                                            <a href="{{ route('attachment', ['id' => $att->id]) }}" class="inline-block text-sm text-gray-900 dark:text-white">
                                                <i class="fa-solid fa-paperclip mr-2"></i> {{ $att->title }}
                                            </a>
                                        @endforeach
                                    </div>
                                    @endif

                                    <!-- Bottom row: Action buttons (right) -->
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('service-book.edit', ['fleet' => $vehicle->id, 'id' => $log->id]) }}"
                                           class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 border border-blue-300 rounded-md hover:bg-blue-50 dark:border-blue-600 dark:hover:bg-blue-900/20">
                                            <i class="fa-solid fa-edit mr-1"></i> Upravit
                                        </a>
                                        <form method="POST" action="{{ route('service-book.destroy', ['fleet' => $vehicle->id, 'id' => $log->id]) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Opravdu chcete smazat tento servisní záznam?')"
                                                    class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 border border-red-300 rounded-md hover:bg-red-50 dark:border-red-600 dark:hover:bg-red-900/20">
                                                <i class="fa-solid fa-trash mr-1"></i> Smazat
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <x-placeholder :text="'Žádné záznamy'" :height="'h-[75px]'" />
                            @endforelse
                        </ul>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="font-medium text-gray-900 dark:text-gray-100">Statistika</dt>
                    <dd class="mt-1 text-gray-700 sm:col-span-2 sm:mt-0 dark:text-gray-200">
                        <x-placeholder :text="'Připravuje se...'" :height="'h-[75px]'" />
                    </dd>
                </div>
            </dl>
        </div>
    </div>
@endsection
