@extends('layout')

@section('content')
    <form method="post" action="{{ route('admin.fleet.update', ['fleet' => $vehicle->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="api-token" value="{{ auth()->user()->api_token }}">

        <div class="divide-y divide-gray-900/10 dark:divide-white/10">
            <div class="grid grid-cols-1 gap-x-8 gap-y-8 py-10 md:grid-cols-3">
                <div class="px-4 sm:px-0">
                    <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Upravit vozidlo</h2>
                    <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Vyplněná data pomohou při udržování flotily a evidování jízd.</p>
                </div>

                <div class="bg-white shadow-xs outline outline-gray-900/5 sm:rounded-xl md:col-span-2 dark:bg-[#212121] dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                    <div class="px-4 py-6 sm:p-8">
                        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="manufacturer" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Výrobce *</label>
                                <div class="mt-2">
                                    <input id="manufacturer"
                                           type="text"
                                           name="manufacturer"
                                           autocomplete="off"
                                           value="{{ old('manufacturer', $vehicle->manufacturer) }}"
                                           required
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="model" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Model *</label>
                                <div class="mt-2">
                                    <input id="model"
                                           type="text"
                                           name="model"
                                           autocomplete="off"
                                           value="{{ old('model', $vehicle->model) }}"
                                           required
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="productionYear" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Rok výroby *</label>
                                <div class="mt-2">
                                    <input id="productionYear"
                                           type="number"
                                           name="productionYear"
                                           autocomplete="off"
                                           pattern="[0-9]*"
                                           value="{{ old('productionYear', $vehicle->productionYear) }}"
                                           required
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                {{-- an intentional gap --}}
                            </div>

                            <div class="sm:col-span-3">
                                <label for="spz" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Registrační značka *</label>
                                <div class="mt-2">
                                    <input id="spz"
                                           type="text"
                                           name="spz"
                                           autocomplete="off"
                                           value="{{ old('spz', $vehicle->spz) }}"
                                           required
                                           oninput="updateLicensePlatePreview(this.value)"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label class="block text-sm/6 font-medium text-gray-900 dark:text-white">Náhled</label>
                                <div class="mt-2 flex items-center">
                                    <div id="license-plate-preview">
                                        <x-license-plate :spz="old('spz', $vehicle->spz)" />
                                    </div>
                                </div>
                            </div>

                            <div class="sm:col-span-6">
                                <label for="vin" class="block text-sm/6 font-medium text-gray-900 dark:text-white">VIN vozidla *</label>
                                <div class="mt-2 flex gap-4">
                                    <input id="vin"
                                           type="text"
                                           name="vin"
                                           autocomplete="off"
                                           value="{{ old('vin', $vehicle->vin) }}"
                                           required
                                    />
                                    <button type="button" class="soft text-nowrap" onclick="navigator.clipboard.readText().then(text => document.getElementById('vin').value = text)">
                                        <i class="fa-regular fa-paste fa-lg"></i> Vložit ze schránky
                                    </button>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="color" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Barva *</label>
                                <div class="mt-2">
                                    <input id="color"
                                           type="color"
                                           name="color"
                                           autocomplete="off"
                                           class="h-12"
                                           value="{{ old('color', $vehicle->color) }}"
                                           required
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="type" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Typ *</label>
                                <div class="mt-2 grid grid-cols-3 gap-3">
                                    @foreach(\App\Enum\VehicleType::cases() as $type)
                                        <label class="group relative flex items-center justify-center rounded-md border border-gray-300 bg-white p-3 has-checked:border-primary-600 has-checked:bg-primary-600 has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-primary-600 has-disabled:border-gray-400 has-disabled:bg-gray-200 has-disabled:opacity-25 dark:border-white/10 dark:bg-white/5 dark:has-checked:border-primary-500 dark:has-checked:bg-primary-500 dark:has-focus-visible:outline-primary-500 dark:has-disabled:border-white/10 dark:has-disabled:bg-gray-800">
                                            <input type="radio" name="type" value="{{ $type->value }}" class="absolute inset-0 appearance-none focus:outline-none" @checked(old('type', $vehicle->type) == $type->value) />
                                            <span class="text-sm font-medium text-gray-900 uppercase group-has-checked:text-white dark:text-white">{{ $type->getName() }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            {{--<div class="col-span-full">
                                <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Cover photo</label>
                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 dark:border-white/25">
                                    <div class="text-center">
                                        <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="mx-auto size-12 text-gray-300 dark:text-gray-500">
                                            <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                                        </svg>
                                        <div class="mt-4 flex text-sm/6 text-gray-600 dark:text-gray-400">
                                            <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-primary-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-primary-600 hover:text-primary-500 dark:bg-transparent dark:text-primary-400 dark:focus-within:outline-primary-500 dark:hover:text-primary-300">
                                                <span>Upload a file</span>
                                                <input id="file-upload" type="file" name="file-upload" class="sr-only" />
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs/5 text-gray-600 dark:text-gray-400">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-8 py-10 md:grid-cols-3">
                <div class="px-4 sm:px-0">
                    <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Hlídané termíny</h2>
                    <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Vyplněné datumy jsou automaticky hlídané a v případě blížícího se termínu se pošle e-mail.</p>
                </div>

                <div class="bg-white shadow-xs outline outline-gray-900/5 sm:rounded-xl md:col-span-2 dark:bg-[#212121] dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                    <div class="px-4 py-6 sm:p-8">
                        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="stk" class="block text-sm/6 font-medium text-gray-900 dark:text-white">STK</label>
                                <div class="mt-2">
                                    <input id="stk"
                                           type="date"
                                           name="stk"
                                           value="{{ old('stk', $vehicle->stk?->format('Y-m-d')) }}"
                                           autocomplete="off"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="insurance" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Povinné ručení</label>
                                <div class="mt-2">
                                    <input id="insurance"
                                           type="date"
                                           name="insurance"
                                           value="{{ old('insurance', $vehicle->insurance?->format('Y-m-d')) }}"
                                           autocomplete="off"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="tachograph" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Tachograf</label>
                                <div class="mt-2">
                                    <input id="tachograph"
                                           type="date"
                                           name="tachograph"
                                           value="{{ old('tachograph', $vehicle->tachograph?->format('Y-m-d')) }}"
                                           autocomplete="off"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="oilChange" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Výměna oleje</label>
                                <div class="mt-2">
                                    <input id="oilChange"
                                           type="date"
                                           name="oilChange"
                                           value="{{ old('oilChange', $vehicle->oilChange?->format('Y-m-d')) }}"
                                           autocomplete="off"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3 mt-10">
                                <label for="spneu" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Letní pneu</label>
                                <div class="mt-2">
                                    <input id="spneu"
                                           type="date"
                                           name="spneu"
                                           value="{{ old('spneu', $vehicle->spneu?->format('Y-m-d')) }}"
                                           autocomplete="off"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3 mt-10">
                                <label for="wpneu" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Zimní pneu</label>
                                <div class="mt-2">
                                    <input id="wpneu"
                                           type="date"
                                           name="wpneu"
                                           value="{{ old('wpneu', $vehicle->wpneu?->format('Y-m-d')) }}"
                                           autocomplete="off"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-8 py-10 md:grid-cols-3">
                <div class="px-4 sm:px-0">
                    <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">
                        <img src="{{ asset('img/oni.png') }}" alt="ONI system ID" class="h-6 inline-block">
                    </h2>
                    <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Pokud je vozidlo evidováno v ONI systému, zadejte ID vozidla, aby bylo vidět v mapě.</p>
                </div>

                <div class="bg-white shadow-xs outline outline-gray-900/5 sm:rounded-xl md:col-span-2 dark:bg-[#212121] dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                    <div class="px-4 py-6 sm:p-8">
                        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="oni_id" class="block text-sm/6 font-medium text-gray-900 dark:text-white">ONI system ID</label>
                                <div class="mt-2">
                                    <input id="oni_id"
                                           type="text"
                                           name="oni_id"
                                           value="{{ old('oni_id', $vehicle->oni_id) }}"
                                           autocomplete="off"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-8 py-10 md:grid-cols-3">
                <div class="px-4 sm:px-0">
                    <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Přílohy</h2>
                    <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Dokumenty k vozidlu</p>
                </div>

                {{--<div class="bg-white shadow-xs outline outline-gray-900/5 sm:rounded-xl md:col-span-2 dark:bg-[#212121] dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                    <div class="px-4 py-6 sm:p-8">
                        <div class="max-w-2xl space-y-10 md:col-span-2">
                            <fieldset>
                                <legend class="text-sm/6 font-semibold text-gray-900 dark:text-white">By email</legend>
                                <div class="mt-6 space-y-6">
                                    <div class="flex gap-3">
                                        <div class="flex h-6 shrink-0 items-center">
                                            <div class="group grid size-4 grid-cols-1">
                                                <input id="comments" type="checkbox" name="comments" checked aria-describedby="comments-description" class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-primary-600 checked:bg-primary-600 indeterminate:border-primary-600 indeterminate:bg-primary-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 dark:border-white/10 dark:bg-white/5 dark:checked:border-primary-500 dark:checked:bg-primary-500 dark:indeterminate:border-primary-500 dark:indeterminate:bg-primary-500 dark:focus-visible:outline-primary-500 dark:disabled:border-white/5 dark:disabled:bg-white/10 dark:disabled:checked:bg-white/10 forced-colors:appearance-auto" />
                                                <svg viewBox="0 0 14 14" fill="none" class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25 dark:group-has-disabled:stroke-white/25">
                                                    <path d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 group-has-checked:opacity-100" />
                                                    <path d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 group-has-indeterminate:opacity-100" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="text-sm/6">
                                            <label for="comments" class="font-medium text-gray-900 dark:text-white">Comments</label>
                                            <p id="comments-description" class="text-gray-500 dark:text-gray-400">Get notified when someones posts a comment on a posting.</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <div class="flex h-6 shrink-0 items-center">
                                            <div class="group grid size-4 grid-cols-1">
                                                <input id="candidates" type="checkbox" name="candidates" aria-describedby="candidates-description" class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-primary-600 checked:bg-primary-600 indeterminate:border-primary-600 indeterminate:bg-primary-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 dark:border-white/10 dark:bg-white/5 dark:checked:border-primary-500 dark:checked:bg-primary-500 dark:indeterminate:border-primary-500 dark:indeterminate:bg-primary-500 dark:focus-visible:outline-primary-500 dark:disabled:border-white/5 dark:disabled:bg-white/10 dark:disabled:checked:bg-white/10 forced-colors:appearance-auto" />
                                                <svg viewBox="0 0 14 14" fill="none" class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25 dark:group-has-disabled:stroke-white/25">
                                                    <path d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 group-has-checked:opacity-100" />
                                                    <path d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 group-has-indeterminate:opacity-100" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="text-sm/6">
                                            <label for="candidates" class="font-medium text-gray-900 dark:text-white">Candidates</label>
                                            <p id="candidates-description" class="text-gray-500 dark:text-gray-400">Get notified when a candidate applies for a job.</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <div class="flex h-6 shrink-0 items-center">
                                            <div class="group grid size-4 grid-cols-1">
                                                <input id="offers" type="checkbox" name="offers" aria-describedby="offers-description" class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-primary-600 checked:bg-primary-600 indeterminate:border-primary-600 indeterminate:bg-primary-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 dark:border-white/10 dark:bg-white/5 dark:checked:border-primary-500 dark:checked:bg-primary-500 dark:indeterminate:border-primary-500 dark:indeterminate:bg-primary-500 dark:focus-visible:outline-primary-500 dark:disabled:border-white/5 dark:disabled:bg-white/10 dark:disabled:checked:bg-white/10 forced-colors:appearance-auto" />
                                                <svg viewBox="0 0 14 14" fill="none" class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25 dark:group-has-disabled:stroke-white/25">
                                                    <path d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 group-has-checked:opacity-100" />
                                                    <path d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 group-has-indeterminate:opacity-100" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="text-sm/6">
                                            <label for="offers" class="font-medium text-gray-900 dark:text-white">Offers</label>
                                            <p id="offers-description" class="text-gray-500 dark:text-gray-400">Get notified when a candidate accepts or rejects an offer.</p>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend class="text-sm/6 font-semibold text-gray-900 dark:text-white">Push notifications</legend>
                                <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">These are delivered via SMS to your mobile phone.</p>
                                <div class="mt-6 space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <input id="push-everything" type="radio" name="push-notifications" checked class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-primary-600 checked:bg-primary-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 dark:border-white/10 dark:bg-white/5 dark:checked:border-primary-500 dark:checked:bg-primary-500 dark:focus-visible:outline-primary-500 dark:disabled:border-white/5 dark:disabled:bg-white/10 dark:disabled:before:bg-white/20 forced-colors:appearance-auto forced-colors:before:hidden" />
                                        <label for="push-everything" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Everything</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="push-email" type="radio" name="push-notifications" class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-primary-600 checked:bg-primary-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 dark:border-white/10 dark:bg-white/5 dark:checked:border-primary-500 dark:checked:bg-primary-500 dark:focus-visible:outline-primary-500 dark:disabled:border-white/5 dark:disabled:bg-white/10 dark:disabled:before:bg-white/20 forced-colors:appearance-auto forced-colors:before:hidden" />
                                        <label for="push-email" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Same as email</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="push-nothing" type="radio" name="push-notifications" class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-primary-600 checked:bg-primary-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 dark:border-white/10 dark:bg-white/5 dark:checked:border-primary-500 dark:checked:bg-primary-500 dark:focus-visible:outline-primary-500 dark:disabled:border-white/5 dark:disabled:bg-white/10 dark:disabled:before:bg-white/20 forced-colors:appearance-auto forced-colors:before:hidden" />
                                        <label for="push-nothing" class="block text-sm/6 font-medium text-gray-900 dark:text-white">No push notifications</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8 dark:border-white/10">
                        <button type="button" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Cancel</button>
                        <button type="submit" class="rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-primary-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 dark:bg-primary-500 dark:shadow-none dark:hover:bg-primary-400 dark:focus-visible:outline-primary-500">Save</button>
                    </div>
                </div>--}}
                <x-placeholder :text="'Připravuje se'" :height="'h-[200px] sm:rounded-xl md:col-span-2'" />
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="reset" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Vymazat</button>
                <button type="submit" class="primary large">Aktualizovat vozidlo</button>
            </div>
        </div>
    </form>

    <script>
        function updateLicensePlatePreview(spz) {
            const preview = document.getElementById('license-plate-preview');
            const spzClean = spz.toUpperCase().trim();

            // Parse Czech license plate format
            let leftPart = '';
            let rightPart = '';

            const match = spzClean.match(/^(\S{1,3})\s*(\S{3,4})$/);
            if (match) {
                leftPart = match[1];
                rightPart = match[2];
            } else {
                const parts = spzClean.split(' ');
                leftPart = parts[0] || '';
                rightPart = parts[1] || '';
            }

            // Update the preview with the new license plate HTML
            preview.innerHTML = `
                <div class="inline-flex items-center justify-center w-44 h-8 bg-white border-2 border-black rounded-sm shadow-lg font-mono font-black tracking-wider relative overflow-hidden">
                    <!-- EU Flag Section -->
                    <div class="w-6 h-full bg-blue-600 flex flex-col items-center justify-around text-yellow-400">
                        <!-- Golden Circle -->
                        <div class="flex items-center justify-center">
                            <div class="w-3 h-3 border border-yellow-400 rounded-full"></div>
                        </div>
                        <!-- CZ Text -->
                        <div class="text-[8px] font-bold text-white leading-none">
                            CZ
                        </div>
                    </div>

                    <!-- License Plate Text -->
                    <div class="flex-1 flex items-center justify-center text-2xl text-black font-bold tracking-wide">
                        <span>${leftPart}</span>
                        <div class="mx-1.5 flex flex-col space-y-0.5">
                            <div class="w-2 h-2 border border-gray-300 rounded-full opacity-60"></div>
                            <div class="w-2 h-2 border border-gray-300 rounded-full opacity-60"></div>
                        </div>
                        <span>${rightPart}</span>
                    </div>
                </div>
            `;
        }
    </script>
@endsection
