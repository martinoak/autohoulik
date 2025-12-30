<!-- Sidebar component, swap this element with another sidebar if you like -->
<div class="relative flex grow flex-col gap-y-5 overflow-y-auto bg-primary-600 px-6 dark:bg-primary-800 dark:after:pointer-events-none dark:after:absolute dark:after:inset-y-0 dark:after:right-0 dark:after:w-px dark:after:bg-white/10">
    <div class="flex h-16 shrink-0 items-center">
        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=white" alt="Your Company" class="h-8 w-auto dark:hidden" />
        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=white" alt="Your Company" class="h-8 w-auto not-dark:hidden" />
    </div>
    <nav class="flex flex-1 flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" @class(['group sidebar-item', 'active' => Route::is('admin.dashboard')])>
                            <i class="fa-regular fa-rectangle-list fa-lg group-hover:text-white"></i>
                            Přehled
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.calendar') }}" @class(['group sidebar-item', 'active' => Route::is('admin.calendar')])>
                            <i class="fa-regular fa-calendar-days fa-lg group-hover:text-white"></i>
                            Kalendář
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.fleet.index') }}" @class(['group sidebar-item', 'active' => Route::is('admin.fleet.index')])>
                            <i class="fa-regular fa-truck fa-lg group-hover:text-white"></i>
                            Vozový park
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.cost-calculator') }}" @class(['group sidebar-item', 'active' => Route::is('admin.cost-calculator')])>
                            <i class="fa-solid fa-calculator fa-lg group-hover:text-white"></i>
                            Kalkulačka nákladů
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.oni.index') }}" @class(['group sidebar-item', 'active' => Route::is('admin.oni.index')])>
                            <i class="fa-solid fa-binoculars fa-lg group-hover:text-white"></i>
                            ONI systém
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.fleet.sheets') }}"
                           class="group flex items-center gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-primary-200 hover:bg-primary-700 hover:text-white dark:text-primary-100 dark:hover:bg-primary-950/25">
                            <i class="fa-regular fa-money-bill-1 fa-lg text-primary-200 group-hover:text-white dark:text-primary-100"></i>
                            Výkazy hodin
                            <span class="ml-auto badge-white dark:badge-gray">
                                {{ ucfirst(\Carbon\Carbon::now()->subMonth()->locale('cs')->isoFormat('MMMM YYYY')) }}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <div class="text-xs/6 font-semibold text-primary-200 dark:text-primary-100">Řidiči</div>
                <ul role="list" class="-mx-2 mt-2 space-y-1">
                    <li>
                        <!-- Current: "bg-primary-700 dark:bg-primary-950/25 text-white", Default: "text-primary-200 dark:text-primary-100 hover:text-white hover:bg-primary-700 dark:hover:bg-primary-950/25" -->
                        <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-primary-200 hover:bg-primary-700 hover:text-white dark:text-primary-100 dark:hover:bg-primary-950/25">
                            <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-primary-400 bg-primary-500 text-[0.625rem] font-medium text-white dark:border-primary-500/50 dark:bg-primary-700">H</span>
                            <span class="truncate">Heroicons</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-primary-200 hover:bg-primary-700 hover:text-white dark:text-primary-100 dark:hover:bg-primary-950/25">
                            <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-primary-400 bg-primary-500 text-[0.625rem] font-medium text-white dark:border-primary-500/50 dark:bg-primary-700">T</span>
                            <span class="truncate">Tailwind Labs</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-primary-200 hover:bg-primary-700 hover:text-white dark:text-primary-100 dark:hover:bg-primary-950/25">
                            <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-primary-400 bg-primary-500 text-[0.625rem] font-medium text-white dark:border-primary-500/50 dark:bg-primary-700">W</span>
                            <span class="truncate">Workcation</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="-mx-6 mt-auto">
                <a href="#" class="flex items-center gap-x-4 px-6 py-3 text-sm/6 font-semibold text-white hover:bg-primary-700 dark:hover:bg-primary-950/25">
                    <i class="fa-regular fa-id-badge fa-lg"></i>
                    <span aria-hidden="true">{{ Auth::user()->name }}</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
