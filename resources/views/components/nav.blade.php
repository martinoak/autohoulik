<nav class="fixed z-10 top-4 lg:top-6 w-full fontInter px-3 lg:px-0 transition-all duration-500 ease-in-out"
     data-aos="fade-down">
    <div id="navbar-container"
         class="max-w-7xl flex flex-wrap items-center justify-between w-full gap-5 py-3 pl-8 pr-4 mx-auto rounded-full navbar">
        <a href="#" class="flex items-center">
            <i class="fa-regular fa-truck fa-flip-horizontal fa-2xl text-[#eab308]"></i>
            <h1 class="text-xl font-bold text-black ml-2">Auto Houlík</h1>
        </a>

        <button data-collapse-toggle="mobile-menu-2" type="button"
                class="inline-flex items-center p-2 ml-1 text-base rounded-lg lg:hidden text-black"
                aria-controls="mobile-menu-2" aria-expanded="true">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                      clip-rule="evenodd" class="logo-path"></path>
            </svg>
            <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd" class="logo-path"></path>
            </svg>
        </button>

        <div class="hidden items-center justify-center w-full lg:flex lg:w-auto lg:order-1 transition-all duration-500 ease-in-out"
             id="mobile-menu-2">
            {{--<ul
                class="flex flex-col mt-2  lg:flex-row lg:mt-0 gap-3 lg:gap-4 text-base font-bold text-black leading-[26px]">
                <li>
                    <a href="#" class="block py-2 pl-3 pr-4 transition-all duration-500 text-yellow-500"
                       aria-current="page">Home</a>
                </li>
                <li>
                    <a href="aboutus.html"
                       class="block py-2 pl-3 pr-4 transition-all duration-500 hover:text-yellow-500 font-medium">About
                        us</a>
                </li>
                <li>
                    <a href="reviews.html"
                       class="block py-2 pl-3 pr-4 transition-all duration-500 hover:text-yellow-500 font-medium">Reviews</a>
                </li>
                <li>
                    <a href="blog.html"
                       class="block py-2 pl-3 pr-4 transition-all duration-500 hover:text-yellow-500 font-medium">Blog</a>
                </li>
                <li>
                    <a href="contact.html"
                       class="block py-2 pl-3 pr-4 transition-all duration-500 hover:text-yellow-500 font-medium">Contact
                        us</a>
                </li>
            </ul>--}}
            <div class="lg:hidden pt-3">
                <a href="tel:+420602352402"
                   class="font-medium text-sm leading-[22px] px-4 py-2 flex items-center justify-center gap-1.5 navbtn text-white rounded-full transition-all duration-500 bg-black hover:bg-gray-900"
                >
                    <i class="fa-solid fa-phone"></i> 602 352 402
                </a>
            </div>
        </div>
        <div class="hidden lg:block lg:order-3" id="mobile-menu-2">
            <a href="tel:+420602352402"
               class="font-medium text-sm leading-[22px] px-4 py-2 flex items-center justify-center gap-1.5 navbtn text-white transition-all duration-500 bg-black rounded-full hover:bg-gray-900"
            >
                <i class="fa-solid fa-phone"></i> 602 352 402
            </a>
        </div>
    </div>
</nav>
