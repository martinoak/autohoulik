@extends('layout')

@section('content')
    <div class="mb-6">
        <a href="{{ route('service-book.index', ['vehicle' => $vehicle->id]) }}" class="text-sm text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
            <i class="fa-solid fa-arrow-left mr-2"></i>Zpět na detail vozidla
        </a>
    </div>

    <form method="post" action="{{ route('service-book.store', ['vehicle' => $vehicle->id]) }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="api-token" value="{{ auth()->user()->api_token }}">
        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

        <div class="divide-y divide-gray-900/10 dark:divide-white/10">
            <div class="grid grid-cols-1 gap-x-8 gap-y-8 py-10 md:grid-cols-3">
                <div class="px-4 sm:px-0">
                    <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Nový servisní záznam</h2>
                    <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Vyplňte informace o provedeném servisu nebo opravě.</p>
                </div>

                <div class="bg-white shadow-xs outline outline-gray-900/5 sm:rounded-xl md:col-span-2 dark:bg-[#212121] dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                    <div class="px-4 py-6 sm:p-8">
                        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-6">
                                <label for="title" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Název opravy *</label>
                                <div class="mt-2">
                                    <input id="title"
                                           type="text"
                                           name="title"
                                           autocomplete="off"
                                           value="{{ old('title') }}"
                                           required
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-6">
                                <label for="note" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Poznámka</label>
                                <div class="mt-2">
                                    <textarea id="note"
                                           name="note"
                                           autocomplete="off"
                                           rows="3"
                                    >{{ old('note') }}</textarea>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="price" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Cena opravy</label>
                                <div class="mt-2">
                                    <input id="price"
                                           type="number"
                                           name="price"
                                           autocomplete="off"
                                           value="{{ old('price') }}"
                                           inputmode="numeric"
                                           pattern="[0-9]*"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="service_date" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Datum provedení práce *</label>
                                <div class="mt-2">
                                    <input id="service_date"
                                           type="date"
                                           name="service_date"
                                           value="{{ old('service_date', \Illuminate\Support\Carbon::parse(time())->toDateString()) }}"
                                           autocomplete="off"
                                           required
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="km" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Stav km</label>
                                <div class="mt-2">
                                    <input id="km"
                                           type="number"
                                           name="km"
                                           autocomplete="off"
                                           value="{{ old('km') }}"
                                           inputmode="numeric"
                                           pattern="[0-9]*"
                                           min="0"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="next_km" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Další servis km</label>
                                <div class="mt-2">
                                    <input id="next_km"
                                           type="number"
                                           name="next_km"
                                           autocomplete="off"
                                           value="{{ old('next_km') }}"
                                           inputmode="numeric"
                                           pattern="[0-9]*"
                                           min="0"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-6">
                                <livewire:service-log-attachment />
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8 dark:border-white/10">
                        <a href="{{ route('service-book.index', ['vehicle' => $vehicle->id]) }}" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Zrušit</a>
                        <button type="submit" class="primary">Uložit záznam</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
