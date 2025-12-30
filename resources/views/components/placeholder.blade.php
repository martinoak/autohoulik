<div class="placeholder {{ $height ?? 'h-[300px]' }} {{ $class ?? '' }}">
    <svg class="absolute inset-0 h-full w-full stroke-gray-900/10 dark:stroke-gray-200/10" fill="none">
        <defs>
            <pattern id="pattern-1526ac66-f54a-4681-8fb8-0859d412f251" x="0" y="0" width="10" height="10" patternUnits="userSpaceOnUse">
                <path d="M-3 13 15-5M-5 5l18-18M-1 21 17 3"></path>
            </pattern>
        </defs>
        <rect stroke="none" fill="url(#pattern-1526ac66-f54a-4681-8fb8-0859d412f251)" width="100%" height="100%"></rect>
    </svg>
    <div class="absolute flex flex-col justify-center items-center text-gray-700 dark:text-white text-2xl font-bold">
        <p class="opacity-75">{!! $text ?? '' !!}</p>
    </div>
</div>
