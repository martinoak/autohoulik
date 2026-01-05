@extends('layout')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-sm text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
            <i class="fa-solid fa-arrow-left mr-2"></i>Zpět na seznam uživatelů
        </a>
    </div>

    <form method="post" action="{{ route('admin.users.store') }}">
        @csrf

        <div class="divide-y divide-gray-900/10 dark:divide-white/10">
            <div class="grid grid-cols-1 gap-x-8 gap-y-8 py-10 md:grid-cols-3">
                <div class="px-4 sm:px-0">
                    <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Nový uživatel</h2>
                    <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Vytvořte nového uživatele v systému.</p>
                </div>

                <div class="bg-white shadow-xs outline outline-gray-900/5 sm:rounded-xl md:col-span-2 dark:bg-[#212121] dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                    <div class="px-4 py-6 sm:p-8">
                        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-6">
                                <label for="name" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Jméno *</label>
                                <div class="mt-2">
                                    <input id="name"
                                           type="text"
                                           name="name"
                                           autocomplete="name"
                                           value="{{ old('name') }}"
                                           required
                                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-primary-500"
                                    />
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-6">
                                <label for="username" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Uživatelské jméno *</label>
                                <div class="mt-2">
                                    <input id="username"
                                           type="text"
                                           name="username"
                                           autocomplete="username"
                                           value="{{ old('username') }}"
                                           required
                                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-primary-500"
                                    />
                                </div>
                                @error('username')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-6">
                                <label for="email" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Email</label>
                                <div class="mt-2">
                                    <input id="email"
                                           type="email"
                                           name="email"
                                           autocomplete="email"
                                           value="{{ old('email') }}"
                                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-primary-500"
                                    />
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-6">
                                <label for="role" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Role *</label>
                                <div class="mt-2">
                                    <select id="role"
                                            name="role"
                                            required
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:focus:outline-primary-500"
                                    >
                                        <option value="">Vyberte roli</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->value }}" {{ old('role') == $role->value ? 'selected' : '' }}>
                                                {{ $role->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('role')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-6">
                                <label for="password" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Heslo *</label>
                                <div class="mt-2">
                                    <input id="password"
                                           type="password"
                                           name="password"
                                           autocomplete="new-password"
                                           required
                                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-primary-500"
                                    />
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-6">
                                <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Potvrzení hesla *</label>
                                <div class="mt-2">
                                    <input id="password_confirmation"
                                           type="password"
                                           name="password_confirmation"
                                           autocomplete="new-password"
                                           required
                                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-primary-500"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="{{ route('admin.users.index') }}" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Zrušit</a>
                <button type="submit" class="primary large">Vytvořit uživatele</button>
            </div>
        </div>
    </form>
@endsection

