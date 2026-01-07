<div>
    <div class="flex justify-end mb-8">
        {{--<div class="inline-flex rounded-lg shadow-2xs">
            @foreach(\App\Enum\VehicleType::cases() as $type)
                <label class="px-4 py-2 text-sm font-medium cursor-pointer border @if($selectedType === $type->value) text-white bg-primary-800 @else text-gray-800 bg-transparent @endif @if($loop->last) rounded-e-lg @elseif($loop->first) rounded-s-lg border-b border-t @endif border-gray-900 hover:bg-gray-900 hover:text-white focus:z-10 dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700">
                    <input type="radio"
                           wire:model.live="selectedType"
                           value="{{ $type->value }}"
                           class="sr-only">
                    <i class="{{ \App\Enum\VehicleType::getIcon($type->value) }} fa-lg"></i>
                </label>
            @endforeach
        </div>--}}

        <aside class="flex space-x-4">
            <a href="{{ route('admin.oni.index') }}" class="flex items-center button secondary">
                <img src="{{ asset('img/oni.png') }}" alt="ONI" class="h-4 lg:mr-2">
                <span class="hidden lg:block">Získat data z ONI systému</span>
            </a>

            <a href="{{ route('admin.fleet.create') }}" class="flex items-center button primary">
                <i class="fa-solid fa-plus fa-lg icon mr-0! lg:mr-2"></i>
                <span class="hidden lg:block">Přidat vozidlo</span>
            </a>
        </aside>
    </div>

    @foreach($vehicles->groupBy('type') as $type => $vehicles)
        @php
            // Count errors (past due dates) for this vehicle type
            $errorCount = 0;
            foreach($vehicles as $vehicle) {
                if ($vehicle->stk && $vehicle->stk->diffInDays(now()) > -14) {
                    $errorCount++;
                }
                if ($vehicle->type === \App\Enum\VehicleType::CAR->value && $vehicle->oilChange && $vehicle->oilChange->diffInDays(now()) > -14) {
                    $errorCount++;
                }
                if ($vehicle->type === \App\Enum\VehicleType::TRUCK->value && $vehicle->tachograph && $vehicle->tachograph->diffInDays(now()) > -14) {
                    $errorCount++;
                }
                if ($vehicle->insurance && $vehicle->insurance->diffInDays(now()) > -14) {
                    $errorCount++;
                }
            }
        @endphp
        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between dark:border-white/10 my-8">
            <div class="flex items-center gap-x-3">
                <h3 class="text-base font-semibold text-gray-900 dark:text-white">
                    {{ \App\Enum\VehicleType::from($type)->getName() }}
                </h3>
                @if($errorCount > 0)
                    <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10 dark:bg-red-400/10 dark:text-red-400 dark:ring-red-400/20">
                        <i class="fa-solid fa-triangle-exclamation mr-1"></i>
                        {{ $errorCount }} {{ $errorCount === 1 ? 'chyba' : ($errorCount < 5 ? 'chyby' : 'chyb') }}
                    </span>
                @endif
            </div>
            <div class="mt-3 flex sm:mt-0 sm:ml-4">
                <div class="-mr-px grid grow grid-cols-1 focus-within:relative">
                    <input type="text" name="query" placeholder="Hledat..." />
                </div>
            </div>
        </div>

        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5 mt-4">
            @forelse($vehicles as $vehicle)
                <li class="overflow-hidden rounded-xl outline outline-gray-200 dark:-outline-offset-1 dark:outline-white/10">
                    <a href="{{ route('admin.fleet.show', ['fleet' => $vehicle->id]) }}" class="block h-full hover:bg-gray-50 dark:hover:bg-[#2a2a2a] transition-colors">
                        <div class="flex items-center justify-between gap-x-4 border-b border-gray-900/5 px-4 py-3 dark:border-white/10" style="background-color: {!! $vehicle->color !!}">
                            <i class="{{ \App\Enum\VehicleType::getIcon($vehicle->type) }} mr-2 text-shadow-lg fa-xl yiq-test-{{ $vehicle->id }}"></i>
                            <div class="text-xl font-medium yiq-text-{{ $vehicle->id }}">
                                {{ $vehicle->manufacturer }} {{ $vehicle->model }}
                            </div>
                            <script>
                                (function() {
                                    const iconElement = document.querySelector('.yiq-test-{{ $vehicle->id }}');
                                    const textElement = document.querySelector('.yiq-text-{{ $vehicle->id }}');
                                    function isTooLightYIQ(hexcolor){
                                        // Remove # if present
                                        hexcolor = hexcolor.replace('#', '');
                                        const r = parseInt(hexcolor.substr(0, 2), 16);
                                        const g = parseInt(hexcolor.substr(2, 2), 16);
                                        const b = parseInt(hexcolor.substr(4, 2), 16);
                                        const yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;
                                        return yiq >= 128;
                                    }

                                    // usage:
                                    const color = isTooLightYIQ('{!! $vehicle->color !!}') ? '#000000' : '#ffffff';
                                    iconElement.style.color = color;
                                    textElement.style.color = color;
                                })();
                            </script>
                        </div>
                        <dl class="-my-3 divide-y divide-gray-100 p-4 text-sm/6 dark:divide-white/10">
                            <div class="flex items-center justify-between gap-x-4 py-3">
                                <dt class="text-gray-500 dark:text-gray-300">SPZ</dt>
                                <dd class="text-gray-700 dark:text-gray-200">
                                    @if($vehicle->spz)
                                        <x-license-plate :spz="$vehicle->spz" size="sm" />
                                    @else
                                        <span class="text-sm text-gray-400 dark:text-gray-500 italic">Nevyplněno</span>
                                    @endif
                                </dd>
                            </div>
                            <div class="flex items-center justify-between gap-x-4 py-3 @if($vehicle->stk && $vehicle->stk->diffInDays(now()) > -14) bg-red-100 dark:bg-red-600/60 -mx-4 px-4 @endif">
                                <dt class="text-gray-500 dark:text-gray-300">STK</dt>
                                <dd class="text-gray-700 dark:text-gray-200">
                                    @if($vehicle->stk)
                                        <x-badge :red="$vehicle->stk->diffInDays(now()) > -14" :orange="$vehicle->stk->diffInDays(now()) > -60" :text="$vehicle->stk->format('j.n.Y')" />
                                    @else
                                        <span class="text-sm text-gray-400 dark:text-gray-500 italic">Nevyplněno</span>
                                    @endif
                                </dd>
                            </div>
                            @if($vehicle->type === \App\Enum\VehicleType::CAR->value)
                                <div class="flex items-center justify-between gap-x-4 py-3 @if($vehicle->oilChange && $vehicle->oilChange->diffInDays(now()) > -14) bg-red-100 dark:bg-red-600/60 -mx-4 px-4 @endif">
                                    <dt class="text-gray-500 dark:text-gray-300">Výměna oleje</dt>
                                    <dd class="text-gray-700 dark:text-gray-200">
                                        @if($vehicle->oilChange)
                                            <x-badge :red="$vehicle->oilChange->diffInDays(now()) > -14" :orange="$vehicle->oilChange->diffInDays(now()) > -60" :text="$vehicle->oilChange->format('j.n.Y')" />
                                        @else
                                            <span class="text-sm text-gray-400 dark:text-gray-500 italic">Nevyplněno</span>
                                        @endif
                                    </dd>
                                </div>
                            @endif
                            @if($vehicle->type === \App\Enum\VehicleType::TRUCK->value)
                                <div class="flex items-center justify-between gap-x-4 py-3 @if($vehicle->tachograph && $vehicle->tachograph->diffInDays(now()) > -14) bg-red-100 dark:bg-red-600/60 -mx-4 px-4 @endif">
                                    <dt class="text-gray-500 dark:text-gray-300">Tachograf</dt>
                                    <dd class="text-gray-700 dark:text-gray-200">
                                        @if($vehicle->tachograph)
                                            <x-badge :red="$vehicle->tachograph->diffInDays(now()) > -14" :orange="$vehicle->tachograph->diffInDays(now()) > -60" :text="$vehicle->tachograph->format('j.n.Y')" />
                                        @else
                                            <span class="text-sm text-gray-400 dark:text-gray-500 italic">Nevyplněno</span>
                                        @endif
                                    </dd>
                                </div>
                            @endif
                            <div class="flex items-center justify-between gap-x-4 py-3 @if($vehicle->insurance && $vehicle->insurance->diffInDays(now()) > -14) bg-red-100 dark:bg-red-600/60 -mx-4 px-4 @endif">
                                <dt class="text-gray-500 dark:text-gray-300">Povinné ručení</dt>
                                <dd class="text-gray-700 dark:text-gray-200">
                                    @if($vehicle->insurance)
                                        <x-badge :red="$vehicle->insurance->diffInDays(now()) > -14" :orange="$vehicle->insurance->diffInDays(now()) > -60" :text="$vehicle->insurance->format('j.n.Y')" />
                                    @else
                                        <span class="text-sm text-gray-400 dark:text-gray-500 italic">Nevyplněno</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </a>
                </li>
            @empty
                <x-placeholder :text="'Žádná vozidla'" :height="'h-[75px]'" />
            @endforelse
        </ul>
    @endforeach
</div>
