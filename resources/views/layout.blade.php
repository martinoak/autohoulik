<!DOCTYPE html>
<html lang="en" class="h-full @if(! Route::is('homepage')) bg-white dark:bg-[#141414] @endif">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Auto Houlík Kondrac</title>

    <link rel="icon" href="{{ asset('img/logo.png') }}">

    <!-- Theme detection script - inline to avoid FOUC -->
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        document.documentElement.classList.toggle(
            'dark',
            localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        );
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    @if(str_contains(url()->current(), '/admin'))
        <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    @endif

    @yield('head')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full fontInter">
    @if(str_contains(url()->current(), '/admin'))
        <x-sidebar />

        <main class="py-10 lg:pl-72">
            <div class="px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    @else
        @yield('content')
    @endif

    @yield('scripts')
</body>

</html>
