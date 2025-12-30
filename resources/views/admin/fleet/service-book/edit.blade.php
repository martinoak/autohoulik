@extends('layout')

@section('content')
    <form method="post" action="{{ route('service-book.update', ['fleet' => $vehicle->id, 'id' => $service->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="api-token" value="{{ auth()->user()->api_token }}">
        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

        <div class="space-y-12 sm:space-y-16">
            <div>
                <h1 class="heading-title">Nový servisní záznam</h1>

                <x-errors :errors="$errors" />

                <div class="form-wrapper">
                    <div class="form-row">
                        <label for="title">Název opravy *</label>
                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                            <input id="title"
                                   type="text"
                                   name="title"
                                   autocomplete="off"
                                   value="{{ old('title', $service->title) }}"
                                   class="max-w-2xl"
                                   required
                            />
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="note">Poznámka</label>
                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                            <textarea id="note"
                                   type="text"
                                   name="note"
                                   autocomplete="off"
                                   class="max-w-2xl"
                            >
                                {{ old('note', $service->note) }}
                            </textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="price">Cena opravy</label>
                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                            <input id="price"
                                   type="number"
                                   name="price"
                                   autocomplete="off"
                                   value="{{ old('price', $service->price) }}"
                                   class="max-w-2xl"
                                   inputmode="numeric"
                                   pattern="[0-9]*"
                            />
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="service_date">Datum provedení práce *</label>
                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                            <input id="service_date"
                                   type="date"
                                   name="service_date"
                                   value="{{ old('service_date', $service->service_date->format('Y-m-d')) }}"
                                   autocomplete="off"
                                   class="max-w-2xl"
                                   required
                            />
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="km">Stav km</label>
                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                            <input id="km"
                                   type="number"
                                   name="km"
                                   autocomplete="off"
                                   value="{{ old('km', $service->km) }}"
                                   class="max-w-2xl"
                                   inputmode="numeric"
                                   pattern="[0-9]*"
                                   min="0"
                            />
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="next_km">Další servis km</label>
                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                            <input id="next_km"
                                   type="number"
                                   name="next_km"
                                   autocomplete="off"
                                   value="{{ old('next_km', $service->next_km) }}"
                                   class="max-w-2xl"
                                   inputmode="numeric"
                                   pattern="[0-9]*"
                                   min="0"
                            />
                        </div>
                    </div>

                    <livewire:service-log-attachment />
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Zrušit</button>
                    <button type="submit" class="primary w-1/6 h-12">Aktualizovat záznam</button>
                </div>
            </div>
        </div>
    </form>
@endsection
