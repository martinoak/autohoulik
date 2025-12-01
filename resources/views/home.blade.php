@extends('layout')

@section('content')

    <x-nav />

    <!-- hero section -->
    <section class="bg-stone-100 overflow-x-hidden">
        <div class="">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-16">
                <div class="grid grid-cols-1 gap-14 items-center xl:grid-cols-12 xl:gap32">
                    <div class="w-full xl:col-span-6 2xl:-mx-5 xl:-mx-0 pt-20 xl:pt-0">
                        <h1 class="py-8 text-center text-gray-900 font-bold fontManrope text-4xl sm:text-6xl xl:text-left sm:leading-[88px]">
                            Převážíme velký věci
                        </h1>
                        <p class="text-gray-400 text-lg text-center mb-5 xl:text-left">
                            Jsme malá nákladní autodoprava na úpatí bájné hory Blaník. Potřebujete převézt materiál? Tak to jste tu správně.
                        </p>
                        <div class="pt-10">
                            <button class="mx-auto xl:mx-0 px-6 py-3 bg-yellow-400 rounded-full flex items-center gap-2 text-lg font-semibold leading-8 justify-center transition-all duration-500 hover:bg-yellow-500">
                                Vozový park
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M11.0015 8.25012V3.85095C11.0015 2.64823 11.0015 2.04688 10.6799 1.94639C10.3582 1.8459 10.0159 2.34031 9.33122 3.32913L3.74642 11.395C3.30918 12.0264 3.09055 12.3422 3.21924 12.5878C3.34793 12.8335 3.73198 12.8335 4.50006 12.8335H11.0015V18.1486C11.0015 19.3516 11.0015 19.9531 11.3232 20.0535C11.6449 20.154 11.9872 19.6595 12.6719 18.6704L18.2547 10.6052C18.6918 9.97372 18.9104 9.65799 18.7817 9.41239C18.653 9.16679 18.269 9.16678 17.501 9.16678H11.9182C11.4861 9.16678 11.27 9.16678 11.1358 9.03254C11.0015 8.8983 11.0015 8.68224 11.0015 8.25012Z" stroke="black" stroke-width="2" stroke-linejoin="round"></path>
                                </svg></button>
                        </div>
                        <div class="pt-10 xl:pt-20 flex flex-col gap-4 items-center xl:items-start text-center xl:text-start">
                            <h4 class="text-xl font-semibold leading-8 text-gray-500">Over 3000+ Satisfied <br>
                                customers</h4>
                            <div class="flex items-center gap-4 text-sm font-medium"><img src="{{ asset('img/hero-sec-img1.png') }}" alt="img">People have joined</div>
                        </div>
                    </div>
                    <div class="w-full xl:col-span-6  block">
                        <div class="w-full sm:w-auto xl:w-[58.8125rem] xl:ml-11">
                            <img src="{{ asset('img/hero-img.png') }}" alt="Header tailwind section" class="w-full object-cover min-[1290px]:h-screen">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- services section -->
    <section class="pt-14 lg:pt-[120px]">
        <div class="mx-auto max-w-[1232px] px-4">
            <div class="flex flex-col justify-center xl:flex-row gap-16 lg:justify-between lg:gap-8 ">
                <div
                    class="w-full rounded-2xl xl:w-[40%] max-w-xl mx-auto md:max-w-2xl xl:max-w-full text-center xl:text-left">
                    <h3 class="text-4xl font-normal text-black fontManrope mb-5">Naše služby</h3>
                    <h2 class="text-4xl leading-[44px] sm:text-5xl font-semibold text-black sm:leading-[3.9rem] max-w-max lg:max-w-3xl lg:mx-auto fontManrope">
                        To nejlepší,<br />co můžeme<br />nabídnout
                    </h2>
                </div>
                <div
                    class="grid grid-cols-1 gap-8 lg:grid-cols-2 md:grid-cols-2 lg:gap-10 xl:w-[60%] max-w-md md:max-w-2xl lg:max-w-full mx-auto">
                    <div class="relative w-full transition-all duration-500 text-center md:text-left">
                        <div
                            class="mx-auto md:mx-0 relative bg-yellow-400 rounded-xl w-20 h-20 flex items-center justify-center mb-5 transition-all duration-500 cursor-pointer hover:bg-yellow-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                                fill="none">
                                <path
                                    d="M17.8604 32.5C17.8604 33.8807 16.7089 35 15.2884 35C13.8678 35 12.7163 33.8807 12.7163 32.5M28.1488 32.5C28.1488 33.8807 26.9972 35 25.5767 35C24.1562 35 23.0046 33.8807 23.0046 32.5M5.85736 10L8.26941 22.8924C8.75627 25.4946 8.99971 26.7958 9.92584 27.5646C10.852 28.3333 12.176 28.3333 14.8241 28.3333H26.0417C28.69 28.3333 30.0141 28.3333 30.9402 27.5645C31.8664 26.7957 32.1098 25.4944 32.5965 22.892L33.5317 17.892C34.2155 14.2359 34.5574 12.4078 33.5575 11.2039C32.5575 10 30.6973 10 26.9769 10H5.85736ZM5.85736 10L5 5"
                                    stroke="black" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                        <h4 class="text-2xl font-semibold leading-9 fontManrope text-black mb-2.5">
                            Free Shipping</h4>
                        <p class="text-base font-normal leading-[30px] text-gray-400">
                            If you're shopping online, check the store's shipping policy or promotional
                        </p>

                    </div>
                    <div class="relative w-full transition-all duration-500 text-center md:text-left">
                        <div
                            class="mx-auto md:mx-0 relative bg-yellow-400 rounded-xl w-20 h-20 flex items-center justify-center mb-5 transition-all duration-500 cursor-pointer hover:bg-yellow-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                                fill="none">
                                <path
                                    d="M16 27.6667C16 27.6667 16 27.6667 16 27.6667ZM16 27.6667C16.9205 27.6667 17.6667 28.4129 17.6667 29.3333M16 27.6667C15.0795 27.6667 14.3333 28.4129 14.3333 29.3333M17.6667 29.3333C17.6667 29.3333 17.6667 29.3333 17.6667 29.3333ZM17.6667 29.3333C17.6667 30.2538 16.9205 31 16 31M17.6667 29.3333H19.3333C23.0152 29.3333 26 26.3486 26 22.6667M14.3333 29.3333C14.3333 29.3333 14.3333 29.3333 14.3333 29.3333ZM14.3333 29.3333C14.3333 30.2538 15.0795 31 16 31M16 31C16 31 16 31 16 31ZM26 12.6667V11C26 5.47715 21.5228 1 16 1C10.4772 1 6 5.47715 6 11V12.6667M5.16667 22.6667C2.86548 22.6667 1 20.8012 1 18.5V16.8333C1 14.5321 2.86548 12.6667 5.16667 12.6667C7.46785 12.6667 9.33333 14.5321 9.33333 16.8333V18.5C9.33333 20.8012 7.46785 22.6667 5.16667 22.6667ZM26.8333 12.6667C29.1345 12.6667 31 14.5321 31 16.8333V18.5C31 20.8012 29.1345 22.6667 26.8333 22.6667C24.5321 22.6667 22.6667 20.8012 22.6667 18.5V16.8333C22.6667 14.5321 24.5321 12.6667 26.8333 12.6667Z"
                                    stroke="black" stroke-width="2" />
                            </svg>
                        </div>
                        <h4 class="text-2xl font-semibold leading-9 fontManrope text-black mb-2.5">
                            24/7 Support</h4>
                        <p class="text-base font-normal leading-[30px] text-gray-400">
                            It looks like you're referring to 24/7 support, which typically means
                        </p>

                    </div>
                    <div class="relative w-full transition-all duration-500 text-center md:text-left">
                        <div
                            class="mx-auto md:mx-0 relative bg-yellow-400 rounded-xl w-20 h-20 flex items-center justify-center mb-5 transition-all duration-500 cursor-pointer hover:bg-yellow-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                                fill="none">
                                <path
                                    d="M35 10.9144L30.7513 15.1631M35 10.9144L30.7513 6.66577M35 10.9144L11.6667 10.9144C8.52397 10.9144 6.95262 10.9144 5.97631 11.8907C5 12.867 5 14.4384 5 17.5811V18.3328M5 29.0846L9.24866 24.8359M5 29.0846L9.24866 33.3332M5 29.0846L28.3333 29.0846C31.476 29.0846 33.0474 29.0846 34.0237 28.1083C35 27.132 35 25.5606 35 22.4179V21.6662"
                                    stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h4 class="text-2xl font-semibold leading-9 fontManrope text-black mb-2.5 ">
                            30- Days free Return</h4>
                        <p class="text-base font-normal leading-[30px] text-gray-400">
                            A 30-day free return policy means that you can return an item you've
                        </p>

                    </div>
                    <div class="relative w-full transition-all duration-500 text-center md:text-left">
                        <div
                            class="mx-auto md:mx-0 relative bg-yellow-400 rounded-xl w-20 h-20 flex items-center justify-center mb-5 transition-all duration-500 cursor-pointer hover:bg-yellow-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                                fill="none">
                                <path
                                    d="M10.9986 16.0014L12.7842 17.7871C13.5609 18.5638 13.9492 18.9521 14.4318 18.9521C14.9144 18.9521 15.3027 18.5638 16.0794 17.7871L21.0999 12.7666M9.59619 4.33233L8.04423 4.31384C5.97386 4.28918 4.28918 5.97386 4.31384 8.04423L4.33233 9.59619C4.34433 10.6044 3.94292 11.5735 3.22153 12.2779L2.11106 13.3622C0.629648 14.8087 0.629648 17.1913 2.11106 18.6378L3.22153 19.7221C3.94292 20.4265 4.34433 21.3956 4.33233 22.4038L4.31384 23.9558C4.28918 26.0261 5.97386 27.7108 8.04423 27.6862L9.59619 27.6677C10.6044 27.6557 11.5735 28.0571 12.2779 28.7785L13.3622 29.8889C14.8087 31.3704 17.1913 31.3704 18.6378 29.8889L19.7221 28.7785C20.4265 28.0571 21.3956 27.6557 22.4038 27.6677L23.9558 27.6862C26.0261 27.7108 27.7108 26.0261 27.6862 23.9558L27.6677 22.4038C27.6557 21.3956 28.0571 20.4265 28.7785 19.7221L29.8889 18.6378C31.3704 17.1913 31.3704 14.8087 29.8889 13.3622L28.7785 12.2779C28.0571 11.5735 27.6557 10.6044 27.6677 9.59619L27.6862 8.04423C27.7108 5.97386 26.0261 4.28918 23.9558 4.31384L22.4038 4.33233C21.3956 4.34433 20.4265 3.94292 19.7221 3.22153L18.6378 2.11106C17.1913 0.629648 14.8087 0.629648 13.3622 2.11106L12.2779 3.22153C11.5735 3.94292 10.6044 4.34433 9.59619 4.33233Z"
                                    stroke="black" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                        <h4 class="text-2xl font-semibold leading-9 fontManrope text-black mb-2.5">
                            Pojištění
                        </h4>
                        <p class="text-base font-normal leading-[30px] text-gray-400">
                            Všechny naše vozidla jsou pojištěná, včetně nákladu.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--<section class="pt-14 lg:pt-[120px]">
        <div class="mx-auto max-w-[1232px] px-4">
            <div class="flex items-center flex-col gap-4 text-center">
                <h2
                    class="text-4xl leading-[44px] sm:text-5xl font-semibold text-black sm:leading-[3.9rem] fontManrope">
                    Limitless Opportunities</h2>
                <p class="text-lg font-medium text-gray-400">An Power Ride is a bicycle that uses an electric motor to
                    assist with pedaling. </p>
            </div>
            <div class="pt-14 grid grid-cols-1 max-w-2xl lg:max-w-full mx-auto lg:mx-0 lg:grid-cols-3 gap-8">
                <div class="flex flex-col gap-7 pb-7 border-b-2 border-yellow-400">
                    <div class="rounded-3xl overflow-hidden">
                        <img src="{{ asset('img/section4-img1.png') }}" alt="img"
                            class="w-full object-cover transition-all duration-700 hover:scale-105">
                    </div>
                    <div class="flex  flex-col gap-3">
                        <div class="flex items-center justify-between">
                            <h4 class="text-[30px] font-semibold text-black fontManrope">Road Bike New Style</h4>
                            <a href=""
                                class="rounded-full w-[30px] h-[30px] flex items-center justify-center bg-zinc-200 "><svg
                                    xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14"
                                    fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.784065 1.06871C1.06611 0.786666 1.5234 0.786666 1.80544 1.06871L7.22233 6.4856C7.35777 6.62104 7.43386 6.80474 7.43386 6.99629C7.43386 7.18783 7.35777 7.37153 7.22233 7.50698L1.80225 12.9271C1.5202 13.2091 1.06292 13.2091 0.78087 12.9271C0.498825 12.645 0.498825 12.1877 0.78087 11.9057L5.69026 6.99629L0.784065 2.09009C0.50202 1.80804 0.50202 1.35076 0.784065 1.06871Z"
                                        fill="black" />
                                </svg></a>
                        </div>
                        <p class="text-sm font-medium leading-5 text-gray-500">Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry. Lorem Ipsum has been the </p>
                    </div>
                </div>

                <div class="flex flex-col gap-7 pb-7 border-b-2 border-red-500">
                    <div class="rounded-3xl overflow-hidden">
                        <img src="{{ asset('img/section4-img2.png') }}" alt="img"
                            class="w-full object-cover transition-all duration-700 hover:scale-105">
                    </div>
                    <div class="flex  flex-col gap-3">
                        <div class="flex items-center justify-between">
                            <h4 class="text-[30px] font-semibold text-black fontManrope">Helmet Requirements</h4>
                            <a href=""
                                class="rounded-full w-[30px] h-[30px] flex items-center justify-center bg-zinc-200 "><svg
                                    xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14"
                                    fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.784065 1.06871C1.06611 0.786666 1.5234 0.786666 1.80544 1.06871L7.22233 6.4856C7.35777 6.62104 7.43386 6.80474 7.43386 6.99629C7.43386 7.18783 7.35777 7.37153 7.22233 7.50698L1.80225 12.9271C1.5202 13.2091 1.06292 13.2091 0.78087 12.9271C0.498825 12.645 0.498825 12.1877 0.78087 11.9057L5.69026 6.99629L0.784065 2.09009C0.50202 1.80804 0.50202 1.35076 0.784065 1.06871Z"
                                        fill="black" />
                                </svg></a>
                        </div>
                        <p class="text-sm font-medium leading-5 text-gray-500">Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry. Lorem Ipsum has been the </p>
                    </div>
                </div>

                <div class="flex flex-col gap-7 pb-7 border-b-2 border-yellow-400">
                    <div class="rounded-3xl overflow-hidden">
                        <img src="{{ asset('img/section4-img3.png') }}" alt="img"
                            class="w-full object-cover transition-all duration-700 hover:scale-105">
                    </div>
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center justify-between">
                            <h4 class="text-[30px] font-semibold text-black fontManrope">Maximum Speed</h4>
                            <a href=""
                                class="rounded-full w-[30px] h-[30px] flex items-center justify-center bg-zinc-200 "><svg
                                    xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14"
                                    fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.784065 1.06871C1.06611 0.786666 1.5234 0.786666 1.80544 1.06871L7.22233 6.4856C7.35777 6.62104 7.43386 6.80474 7.43386 6.99629C7.43386 7.18783 7.35777 7.37153 7.22233 7.50698L1.80225 12.9271C1.5202 13.2091 1.06292 13.2091 0.78087 12.9271C0.498825 12.645 0.498825 12.1877 0.78087 11.9057L5.69026 6.99629L0.784065 2.09009C0.50202 1.80804 0.50202 1.35076 0.784065 1.06871Z"
                                        fill="black" />
                                </svg></a>
                        </div>
                        <p class="text-sm font-medium leading-5 text-gray-500">Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry. Lorem Ipsum has been the </p>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}

    <!-- Stats Section -->
    <section class="pt-14 lg:pt-[120px]">
        <div class="bg-stone-50 py-12">
            <div class="mx-auto max-w-[1069px] px-4">
                <div class="flex flex-col lg:flex-row gap-8 lg:justify-between text-center lg:text-start">
                    <div class="flex flex-col gap-2.5 border-b border-gray-300  pb-4 lg:pb-0 lg:border-b-0">
                        <h4 class="text-6xl font-bold fontManrope text-yellow-500">95%</h4>
                        <p class="text-lg font-medium leading-8 text-black">Power Ride Selling Rate</p>
                    </div>
                    <div
                        class="flex flex-col gap-2.5 lg:border-l lg:border-r border-e-gray-300 lg:px-28 border-gray-300 pb-4 lg:pb-0 border-b lg:border-b-0">
                        <h4 class="text-6xl font-bold fontManrope text-yellow-500">50,000+</h4>
                        <p class="text-lg font-medium leading-8 text-black">Satisfied Customer</p>
                    </div>
                    <div class="flex flex-col gap-2.5 border-b lg:border-b-0 border-gray-300 pb-4 lg:pb-0">
                        <h4 class="text-6xl font-bold fontManrope text-yellow-500 ">25+</h4>
                        <p class="text-lg font-medium leading-8 text-black">Power Ride New Variety</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--<section class="pt-14 lg:pt-[120px]">
        <div class="mx-auto max-w-[1232px] px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-14">
                <div class="rounded-3xl overflow-hidden">
                    <img src="{{ asset('img/section5-img-1.png') }}" alt="img" class="w-full h-full">
                </div>
                <div class="flex flex-col gap-5 my-auto items-center lg:items-start text-center lg:text-start">
                    <div
                        class="w-20 h-20 rounded-full bg-yellow-400 transition-all duration-500 hover:bg-amber-500 flex items-center justify-center fontManrope text-4xl font-semibold text-black">
                        01
                    </div>
                    <h3 class="text-4xl font-normal fontManrope text-black ">Don’t Miss Out !</h3>
                    <h4 class="fontManrope text-4xl sm:text-5xl font-semibold text-black">Winter Sale Is Coming</h4>
                    <p class="text-lg font-medium leading-8 text-gray-400">Lorem Ipsum is simply dummy text
                        of the
                        printing and typesetting industry. Lorem Ipsum has been
                        the </p>
                    <div class="flex items-start w-full gap-5 count-down-main justify-center lg:justify-start">
                        <div class="timer flex flex-col gap-0.5">
                            <div class="">
                                <h3
                                    class="countdown-element days text-center text-3xl sm:text-6xl font-bold text-yellow-400">
                                </h3>
                            </div>
                            <p class="text-center text-sm sm:text-lg font-medium text-black w-full">DAYS</p>
                        </div>
                        <h3 class="w-3 text-center text-3xl sm:text-6xl font-bold text-black">:</h3>
                        <div class="timer flex flex-col gap-0.5">
                            <div class="">
                                <h3
                                    class="countdown-element hours text-center text-3xl sm:text-6xl font-bold text-yellow-400">
                                </h3>
                            </div>
                            <p class="text-center text-sm sm:text-lg font-medium text-black w-full">HOURS</p>
                        </div>
                        <h3 class="w-3 text-center text-3xl sm:text-6xl font-bold text-black">:</h3>
                        <div class="timer flex flex-col gap-0.5">
                            <div class="">
                                <h3
                                    class="countdown-element minutes text-center text-3xl sm:text-6xl font-bold text-yellow-400">
                                </h3>
                            </div>
                            <p class="text-center text-sm sm:text-lg font-medium text-black w-full">MINUT</p>
                        </div>
                        <h3 class="w-3 text-center text-3xl sm:text-6xl font-bold text-black">:</h3>
                        <div class="timer flex flex-col gap-0.5">
                            <div class="">
                                <h3
                                    class="countdown-element seconds text-center text-3xl sm:text-6xl font-bold text-yellow-400">
                                </h3>
                            </div>
                            <p class="text-center text-sm sm:text-lg font-medium text-black w-full">SECOND</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}

    <!-- CTA Section -->
    <section class="mt-14 lg:mt-[120px] bg-no-repeat bg-cover bg-center"
        style="background-image: url('img/CTA-bg.png');">
        <div class="py-40">
            <div class="max-w-5xl mx-auto w-full flex flex-col gap-8 items-center">
                <h2
                    class="text-4xl leading-[44px] sm:text-6xl font-bold text-white text-center fontManrope sm:leading-[88px]">
                    Good selection of
                    cycling accessories
                    and great service .</h2>
                <div class="flex items-center flex-col sm:flex-row gap-8">
                    <button
                        class="mx-auto lg:mx-0 px-6 py-3 bg-yellow-400 rounded-full flex items-center gap-2 text-lg font-semibold leading-8 justify-center transition-all duration-500 hover:bg-yellow-500">Browse
                        Our Bike<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                            fill="none">
                            <path
                                d="M11.0015 8.25012V3.85095C11.0015 2.64823 11.0015 2.04688 10.6799 1.94639C10.3582 1.8459 10.0159 2.34031 9.33122 3.32913L3.74642 11.395C3.30918 12.0264 3.09055 12.3422 3.21924 12.5878C3.34793 12.8335 3.73198 12.8335 4.50006 12.8335H11.0015V18.1486C11.0015 19.3516 11.0015 19.9531 11.3232 20.0535C11.6449 20.154 11.9872 19.6595 12.6719 18.6704L18.2547 10.6052C18.6918 9.97372 18.9104 9.65799 18.7817 9.41239C18.653 9.16679 18.269 9.16678 17.501 9.16678H11.9182C11.4861 9.16678 11.27 9.16678 11.1358 9.03254C11.0015 8.8983 11.0015 8.68224 11.0015 8.25012Z"
                                stroke="black" stroke-width="2" stroke-linejoin="round" />
                        </svg></button>

                    <button
                        class="mx-auto lg:mx-0 px-6 py-3  rounded-full text-white text-lg font-semibold leading-8 justify-center transition-all duration-500 hover:bg-yellow-400 hover:text-black">Explore
                        All Services</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Store Section -->
    {{--<section class="pt-14 lg:pt-[120px]">
        <div class="mx-auto max-w-[1232px] px-4">
            <div class="flex items-center flex-col gap-4 text-center">
                <h2 class="text-4xl sm:text-5xl font-semibold text-black sm:leading-[3.9rem] fontManrope">
                    Popular In Store</h2>
                <p class="text-lg font-medium text-gray-400">An Power Ride is a bicycle that uses an electric motor to
                    assist with pedaling.</p>
            </div>

            <div class="pt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-16">
                <div class="flex flex-col items-center justify-center gap-5 text-center">
                    <img src="{{ asset('img/bike1.png') }}" alt="img">
                    <div class="flex flex-col gap-1.5">
                        <h5 class="text-lg font-semibold leading-8 text-black">Durable Linen Bench</h5>
                        <div class="flex items-center justify-center gap-2.5 text-center">
                            <a href="" class="text-lg font-normal leading-8 text-gray-400 line-through">
                                $160.00
                            </a>
                            <span class="cursor-pointer text-lg font-semibold leading-8 text-yellow-500">$100.00</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center gap-5 text-center">
                    <img src="{{ asset('img/bike2.png') }}" alt="img">
                    <div class="flex flex-col gap-1.5">
                        <h5 class="text-lg font-semibold leading-8 text-black">Calfee Bamboo Bicycle Frames</h5>
                        <div class="flex items-center justify-center gap-2.5 text-center">
                            <a href="" class="text-lg font-normal leading-8 text-gray-400 line-through">
                                $160.00
                            </a>
                            <span class="cursor-pointer text-lg font-semibold leading-8 text-yellow-500">$100.00</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center gap-5 text-center">
                    <img src="{{ asset('img/bike3.png') }}" alt="img">
                    <div class="flex flex-col gap-1.5">
                        <h5 class="text-lg font-semibold leading-8 text-black">Intelligent Wool Coat</h5>
                        <div class="flex items-center justify-center gap-2.5 text-center">
                            <a href="" class="text-lg font-normal leading-8 text-gray-400 line-through">
                                $160.00
                            </a>
                            <span class="cursor-pointer text-lg font-semibold leading-8 text-yellow-500">$100.00</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center gap-5 text-center">
                    <img src="{{ asset('img/bike1.png') }}" alt="img">
                    <div class="flex flex-col gap-1.5">
                        <h5 class="text-lg font-semibold leading-8 text-black">Durable Linen Bench</h5>
                        <div class="flex items-center justify-center gap-2.5 text-center">
                            <a href="" class="text-lg font-normal leading-8 text-gray-400 line-through">
                                $160.00
                            </a>
                            <span class="cursor-pointer text-lg font-semibold leading-8 text-yellow-500">$100.00</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center gap-5 text-center">
                    <img src="{{ asset('img/bike2.png') }}" alt="img">
                    <div class="flex flex-col gap-1.5">
                        <h5 class="text-lg font-semibold leading-8 text-black">Calfee Bamboo Bicycle Frames</h5>
                        <div class="flex items-center justify-center gap-2.5 text-center">
                            <a href="" class="text-lg font-normal leading-8 text-gray-400 line-through">
                                $160.00
                            </a>
                            <span class="cursor-pointer text-lg font-semibold leading-8 text-yellow-500">$100.00</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center gap-5 text-center">
                    <img src="{{ asset('img/bike3.png') }}" alt="img">
                    <div class="flex flex-col gap-1.5">
                        <h5 class="text-lg font-semibold leading-8 text-black">Intelligent Wool Coat</h5>
                        <div class="flex items-center justify-center gap-2.5 text-center">
                            <a href="" class="text-lg font-normal leading-8 text-gray-400 line-through">
                                $160.00
                            </a>
                            <span class="cursor-pointer text-lg font-semibold leading-8 text-yellow-500">$100.00</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center gap-5 text-center">
                    <img src="{{ asset('img/bike1.png') }}" alt="img">
                    <div class="flex flex-col gap-1.5">
                        <h5 class="text-lg font-semibold leading-8 text-black">Durable Linen Bench</h5>
                        <div class="flex items-center justify-center gap-2.5 text-center">
                            <a href="" class="text-lg font-normal leading-8 text-gray-400 line-through">
                                $160.00
                            </a>
                            <span class="cursor-pointer text-lg font-semibold leading-8 text-yellow-500">$100.00</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center gap-5 text-center">
                    <img src="{{ asset('img/bike2.png') }}" alt="img">
                    <div class="flex flex-col gap-1.5">
                        <h5 class="text-lg font-semibold leading-8 text-black">Calfee Bamboo Bicycle Frames</h5>
                        <div class="flex items-center justify-center gap-2.5 text-center">
                            <a href="" class="text-lg font-normal leading-8 text-gray-400 line-through">
                                $160.00
                            </a>
                            <span class="cursor-pointer text-lg font-semibold leading-8 text-yellow-500">$100.00</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center gap-5 text-center">
                    <img src="{{ asset('img/bike3.png') }}" alt="img">
                    <div class="flex flex-col gap-1.5">
                        <h5 class="text-lg font-semibold leading-8 text-black">Intelligent Wool Coat</h5>
                        <div class="flex items-center justify-center gap-2.5 text-center">
                            <a href="" class="text-lg font-normal leading-8 text-gray-400 line-through">
                                $160.00
                            </a>
                            <span class="cursor-pointer text-lg font-semibold leading-8 text-yellow-500">$100.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}

    <!-- Testimonials  -->
    {{--<section class="pt-14 lg:pt-[120px]">
        <div class="mx-auto max-w-[1232px] px-4">
            <div
                class="flex justify-center gap-y-8 flex-wrap md:flex-wrap xl:flex-nowrap xl:flex-row xl:justify-between xl:gap-x-10 max-w-sm sm:max-w-3xl xl:max-w-full mx-auto">
                <div class="w-full xl:w-1/3 text-center xl:text-start">
                    <h2 class="text-4xl sm:text-5xl font-semibold text-black sm:leading-[3.9rem] mb-5 fontManrope">What
                        Our
                        Clients Says
                    </h2>
                    <p class="text-lg font-medium leading-8 text-gray-400">Lorem Ipsum is simply dummy text of the
                        printing and typesetting industry.</p>
                    <!-- Slider controls -->
                    <div class="flex items-center justify-center xl:justify-start gap-10 pt-16">
                        <button id="slider-button-left"
                            class="swiper-button-prev group flex z-0 justify-center items-center border border-solid  w-12 h-12 transition-all duration-500 rounded-full bg-yellow-400 hover:bg-black"
                            data-carousel-prev>
                            <svg class="h-6 w-6 text-black group-hover:text-white transition-all duration-500"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.9999 12L4.99992 12M9.99992 6L4.70703 11.2929C4.3737 11.6262 4.20703 11.7929 4.20703 12C4.20703 12.2071 4.3737 12.3738 4.70703 12.7071L9.99992 18"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                        <button id="slider-button-right"
                            class="swiper-button-next group flex z-0 justify-center items-center border border-solid  w-12 h-12 transition-all duration-500 rounded-full bg-yellow-400 hover:bg-black"
                            data-carousel-next>
                            <svg class="h-6 w-6 text-black group-hover:text-white transition-all duration-500"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3 12L19 12M14 18L19.2929 12.7071C19.6262 12.3738 19.7929 12.2071 19.7929 12C19.7929 11.7929 19.6262 11.6262 19.2929 11.2929L14 6"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="w-full xl:w-2/3 xl:pt-0">
                    <!--Slider wrapper-->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div
                                class="swiper-slide group rounded-2xl max-sm:max-w-sm max-sm:mx-auto transition-all duration-500 h-full">
                                <img src="{{ asset('img/testimonials-img1.png') }}" alt="img" class="w-full h-full">
                            </div>
                            <div
                                class="swiper-slide group bg-stone-100 rounded-2xl max-sm:max-w-sm max-sm:mx-auto p-5 transition-all duration-500">
                                <div class="flex items-center mb-5  gap-2 text-amber-500 transition-all duration-500  ">
                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.73013 1.5625C9.10513 0.8125 10.1676 0.84375 10.5114 1.5625L12.5739 5.71875L17.1364 6.375C17.9489 6.5 18.2614 7.5 17.6676 8.09375L14.3864 11.3125L15.1676 15.8438C15.2926 16.6562 14.4176 17.2812 13.6989 16.9062L9.63638 14.75L5.54263 16.9062C4.82388 17.2812 3.94888 16.6562 4.07388 15.8438L4.85513 11.3125L1.57388 8.09375C0.980125 7.5 1.29263 6.5 2.10513 6.375L6.69888 5.71875L8.73013 1.5625Z"
                                            fill="#FFBC3B" />
                                    </svg>

                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.73013 1.5625C9.10513 0.8125 10.1676 0.84375 10.5114 1.5625L12.5739 5.71875L17.1364 6.375C17.9489 6.5 18.2614 7.5 17.6676 8.09375L14.3864 11.3125L15.1676 15.8438C15.2926 16.6562 14.4176 17.2812 13.6989 16.9062L9.63638 14.75L5.54263 16.9062C4.82388 17.2812 3.94888 16.6562 4.07388 15.8438L4.85513 11.3125L1.57388 8.09375C0.980125 7.5 1.29263 6.5 2.10513 6.375L6.69888 5.71875L8.73013 1.5625Z"
                                            fill="#FFBC3B" />
                                    </svg>

                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.73013 1.5625C9.10513 0.8125 10.1676 0.84375 10.5114 1.5625L12.5739 5.71875L17.1364 6.375C17.9489 6.5 18.2614 7.5 17.6676 8.09375L14.3864 11.3125L15.1676 15.8438C15.2926 16.6562 14.4176 17.2812 13.6989 16.9062L9.63638 14.75L5.54263 16.9062C4.82388 17.2812 3.94888 16.6562 4.07388 15.8438L4.85513 11.3125L1.57388 8.09375C0.980125 7.5 1.29263 6.5 2.10513 6.375L6.69888 5.71875L8.73013 1.5625Z"
                                            fill="#FFBC3B" />
                                    </svg>

                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.73013 1.5625C9.10513 0.8125 10.1676 0.84375 10.5114 1.5625L12.5739 5.71875L17.1364 6.375C17.9489 6.5 18.2614 7.5 17.6676 8.09375L14.3864 11.3125L15.1676 15.8438C15.2926 16.6562 14.4176 17.2812 13.6989 16.9062L9.63638 14.75L5.54263 16.9062C4.82388 17.2812 3.94888 16.6562 4.07388 15.8438L4.85513 11.3125L1.57388 8.09375C0.980125 7.5 1.29263 6.5 2.10513 6.375L6.69888 5.71875L8.73013 1.5625Z"
                                            fill="#FFBC3B" />
                                    </svg>

                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.73013 1.5625C9.10513 0.8125 10.1676 0.84375 10.5114 1.5625L12.5739 5.71875L17.1364 6.375C17.9489 6.5 18.2614 7.5 17.6676 8.09375L14.3864 11.3125L15.1676 15.8438C15.2926 16.6562 14.4176 17.2812 13.6989 16.9062L9.63638 14.75L5.54263 16.9062C4.82388 17.2812 3.94888 16.6562 4.07388 15.8438L4.85513 11.3125L1.57388 8.09375C0.980125 7.5 1.29263 6.5 2.10513 6.375L6.69888 5.71875L8.73013 1.5625Z"
                                            fill="#FFBC3B" />
                                    </svg>

                                </div>
                                <p class="text-base text-gray-400 leading-6 transition-all duration-500">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived not only five centuries,
                                </p>
                                <div class="flex items-center gap-5 mt-9">
                                    <img class="rounded-full object-cover" src="{{ asset('img/testimonials-img2.png') }}"
                                        alt="avatar">
                                    <div class="grid">
                                        <h5 class="text-black text-lg font-medium transition-all duration-500 ">Noah
                                            Smith
                                        </h5>
                                        <span class="text-sm font-medium text-red-600">CTO, Google</span>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="swiper-slide group rounded-2xl max-sm:max-w-sm max-sm:mx-auto transition-all duration-500 h-full">
                                <img src="{{ asset('img/testimonials-img1.png') }}" alt="img" class="w-full h-full">
                            </div>
                            <div
                                class="swiper-slide group bg-stone-100 rounded-2xl max-sm:max-w-sm max-sm:mx-auto p-5 transition-all duration-500">
                                <div class="flex items-center mb-5  gap-2 text-amber-500 transition-all duration-500  ">
                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.73013 1.5625C9.10513 0.8125 10.1676 0.84375 10.5114 1.5625L12.5739 5.71875L17.1364 6.375C17.9489 6.5 18.2614 7.5 17.6676 8.09375L14.3864 11.3125L15.1676 15.8438C15.2926 16.6562 14.4176 17.2812 13.6989 16.9062L9.63638 14.75L5.54263 16.9062C4.82388 17.2812 3.94888 16.6562 4.07388 15.8438L4.85513 11.3125L1.57388 8.09375C0.980125 7.5 1.29263 6.5 2.10513 6.375L6.69888 5.71875L8.73013 1.5625Z"
                                            fill="#FFBC3B" />
                                    </svg>

                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.73013 1.5625C9.10513 0.8125 10.1676 0.84375 10.5114 1.5625L12.5739 5.71875L17.1364 6.375C17.9489 6.5 18.2614 7.5 17.6676 8.09375L14.3864 11.3125L15.1676 15.8438C15.2926 16.6562 14.4176 17.2812 13.6989 16.9062L9.63638 14.75L5.54263 16.9062C4.82388 17.2812 3.94888 16.6562 4.07388 15.8438L4.85513 11.3125L1.57388 8.09375C0.980125 7.5 1.29263 6.5 2.10513 6.375L6.69888 5.71875L8.73013 1.5625Z"
                                            fill="#FFBC3B" />
                                    </svg>

                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.73013 1.5625C9.10513 0.8125 10.1676 0.84375 10.5114 1.5625L12.5739 5.71875L17.1364 6.375C17.9489 6.5 18.2614 7.5 17.6676 8.09375L14.3864 11.3125L15.1676 15.8438C15.2926 16.6562 14.4176 17.2812 13.6989 16.9062L9.63638 14.75L5.54263 16.9062C4.82388 17.2812 3.94888 16.6562 4.07388 15.8438L4.85513 11.3125L1.57388 8.09375C0.980125 7.5 1.29263 6.5 2.10513 6.375L6.69888 5.71875L8.73013 1.5625Z"
                                            fill="#FFBC3B" />
                                    </svg>

                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.73013 1.5625C9.10513 0.8125 10.1676 0.84375 10.5114 1.5625L12.5739 5.71875L17.1364 6.375C17.9489 6.5 18.2614 7.5 17.6676 8.09375L14.3864 11.3125L15.1676 15.8438C15.2926 16.6562 14.4176 17.2812 13.6989 16.9062L9.63638 14.75L5.54263 16.9062C4.82388 17.2812 3.94888 16.6562 4.07388 15.8438L4.85513 11.3125L1.57388 8.09375C0.980125 7.5 1.29263 6.5 2.10513 6.375L6.69888 5.71875L8.73013 1.5625Z"
                                            fill="#FFBC3B" />
                                    </svg>

                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.73013 1.5625C9.10513 0.8125 10.1676 0.84375 10.5114 1.5625L12.5739 5.71875L17.1364 6.375C17.9489 6.5 18.2614 7.5 17.6676 8.09375L14.3864 11.3125L15.1676 15.8438C15.2926 16.6562 14.4176 17.2812 13.6989 16.9062L9.63638 14.75L5.54263 16.9062C4.82388 17.2812 3.94888 16.6562 4.07388 15.8438L4.85513 11.3125L1.57388 8.09375C0.980125 7.5 1.29263 6.5 2.10513 6.375L6.69888 5.71875L8.73013 1.5625Z"
                                            fill="#FFBC3B" />
                                    </svg>

                                </div>
                                <p class="text-base text-gray-400 leading-6 transition-all duration-500">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived not only five centuries,
                                </p>
                                <div class="flex items-center gap-5 mt-9">
                                    <img class="rounded-full object-cover" src="{{ asset('img/testimonials-img2.png') }}"
                                        alt="avatar">
                                    <div class="grid">
                                        <h5 class="text-black text-lg font-medium transition-all duration-500 ">Noah
                                            Smith
                                        </h5>
                                        <span class="text-sm font-medium text-red-600">CTO, Google</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}

    <!-- blog Section -->
    {{--<section class="py-14 lg:py-[120px]">
        <div class="mx-auto max-w-[1232px] px-4">
            <div class="flex items-center flex-col lg:flex-row justify-between gap-4 text-center lg:text-start">
                <h2 class="text-4xl sm:text-5xl font-semibold text-black sm:leading-[3.9rem] fontManrope">
                    Our Latest Blog & News</h2>

                <button
                    class="px-7 py-3 rounded-full bg-yellow-400 text-lg font-semibold leading-8 text-black text-center flex items-center justify-center transition-all duration-500 hover:bg-yellow-500">View
                    All Blog</button>
            </div>

            <div class="pt-14 grid grid-cols-1 lg:grid-cols-3 gap-11 w-full max-lg:max-w-lg mx-auto">
                <div class="pb-6 border-b-2 border-yellow-400 flex flex-col gap-2">
                    <div class="rounded-lg overflow-hidden">
                        <img src="{{ asset('img/bolg1.png') }}" alt="bolg1"
                            class="w-full transition-all duration-500 hover:scale-105 cursor-pointer">
                    </div>
                    <a href="" class="text-base font-normal leading-8 pt-2 text-gray-400 cursor-pointer">Design January
                        24/2024</a>
                    <h5 class="text-2xl font-semibold leading-9 fontManrope text-black">Technological Advancements:
                        Battery Innovations</h5>
                </div>

                <div class="pb-6 border-b-2 border-red-500 flex flex-col gap-2">
                    <div class="rounded-lg overflow-hidden">
                        <img src="{{ asset('img/blog2.png') }}" alt="blog2"
                            class="w-full transition-all duration-500 hover:scale-105 cursor-pointer">
                    </div>
                    <a href="" class="text-base font-normal leading-8 pt-2 text-gray-400 cursor-pointer">Design January
                        24/2024</a>
                    <h5 class="text-2xl font-semibold leading-9 fontManrope text-black">Bicycle vs. Traditional
                        Bikes:
                        Upcoming Power Bicycle Models</h5>
                </div>

                <div class="pb-6 border-b-2 border-lime-500 flex flex-col gap-2">
                    <div class="rounded-lg overflow-hidden">
                        <img src="{{ asset('img/blog3.png') }}" alt="bolg3"
                            class="w-full transition-all duration-500 hover:scale-105 cursor-pointer">
                    </div>
                    <a href="" class="text-base font-normal leading-8 pt-2 text-gray-400 cursor-pointer">Design January
                        24/2024</a>
                    <h5 class="text-2xl font-semibold leading-9 fontManrope text-black">Health and Fitness with Power
                        Ride:
                        Fitness Benefits</h5>
                </div>
            </div>
        </div>
    </section>--}}

    <!-- footer -->
    <footer class="bg-black pt-16 pb-7">
        <div class="mx-auto max-w-[1232px] px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 sm:w-3/4 lg:w-full mx-auto lg:mx-0">
                <div class="flex gap-10 sm:gap-20 flex-col sm:flex-row">
                    <div
                        class="flex flex-col gap-14 lg:w-2/3 text-center justify-center items-center sm:items-start sm:justify-start">
                        <div class="flex flex-col gap-5 items-center sm:items-start">
                            <svg width="187" height="38" viewBox="0 0 187 38" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1_18709)">
                                    <path
                                        d="M31.769 27.0754L24.7697 5.51961H27.4232V6.90585C27.4232 7.52231 27.923 8.0221 28.5395 8.0221C29.1559 8.0221 29.6557 7.52231 29.6557 6.90585V4.40492C29.6557 4.4044 29.6558 4.40388 29.6558 4.40336C29.6558 3.78689 29.156 3.28711 28.5395 3.28711H23.2336C22.6172 3.28711 22.1174 3.78689 22.1174 4.40336C22.1174 4.50233 22.1315 4.59781 22.1557 4.68919C22.1573 4.69626 22.1593 4.70378 22.1614 4.71122C22.1645 4.72209 22.1672 4.73303 22.1707 4.74374C22.1711 4.74523 22.1714 4.7465 22.1719 4.74806L23.2289 8.00349C19.6358 10.7553 15.614 12.364 12.8064 13.24C11.2081 13.7386 9.82039 14.0603 8.82075 14.2589L10.0923 9.51497H11.8928C12.5093 9.51497 13.0091 9.01519 13.0091 8.39872C13.0091 7.78225 12.5093 7.28247 11.8928 7.28247H6.09844C5.48197 7.28247 4.98218 7.78225 4.98218 8.39872C4.98218 9.01519 5.48197 9.51497 6.09844 9.51497H7.78092L6.42862 14.5603C4.33863 14.7005 2.31479 15.3469 0.529089 16.4517C0.00482318 16.776 -0.157256 17.464 0.167126 17.9882C0.491509 18.5124 1.17949 18.6745 1.70368 18.3501C3.37999 17.3129 5.31074 16.7644 7.28762 16.7635C7.28962 16.7635 7.29163 16.7637 7.29364 16.7637C7.29535 16.7637 7.29714 16.7635 7.29885 16.7635C12.7953 16.7664 17.3316 20.9523 17.8913 26.3038L7.29297 26.3038C6.67651 26.3038 6.17672 26.8035 6.17672 27.42C6.17672 28.0365 6.67651 28.5363 7.29297 28.5363L19.0658 28.5363C19.5729 28.5363 20.0003 28.198 20.1363 27.7349C20.1371 27.7324 20.138 27.7309 20.1387 27.7283L24.5962 12.214L29.6457 27.7649C29.7989 28.2367 30.2365 28.5366 30.7072 28.5366C30.8214 28.5366 30.9376 28.519 31.0521 28.4818C31.6384 28.2914 31.9594 27.6617 31.769 27.0754ZM19.2715 22.6619C18.0276 19.5413 15.598 17.0174 12.5423 15.6494C12.8264 15.5678 13.1182 15.481 13.4179 15.3879C17.3057 14.1805 20.3297 12.6288 22.5674 11.1907L19.2715 22.6619Z"
                                        fill="white" />
                                    <path
                                        d="M31.8909 20.2241L33.8918 26.3859C34.462 28.1421 33.4971 30.0348 31.7409 30.6051C31.4062 30.7139 31.058 30.7691 30.7065 30.7691C29.2511 30.7691 27.9712 29.8388 27.5217 28.4542L25.5223 22.2966C24.2196 23.6146 23.414 25.425 23.414 27.4201C23.414 31.4413 26.6855 34.7128 30.7066 34.7128C34.7278 34.7128 37.9993 31.4413 37.9993 27.4201C37.9993 23.8022 35.3508 20.7916 31.8909 20.2241Z"
                                        fill="#FACC15" />
                                    <path
                                        d="M7.29273 30.7689C5.44623 30.7689 3.94398 29.2666 3.94398 27.4201C3.94398 25.5736 5.44623 24.0714 7.29273 24.0714L13.7697 24.0715C12.5544 21.7305 10.1074 20.1274 7.29266 20.1274C3.27148 20.1274 -3.05176e-05 23.399 -3.05176e-05 27.4201C-3.05176e-05 31.4413 3.27148 34.7128 7.29266 34.7128C10.1073 34.7128 12.5544 33.1098 13.7696 30.7689H7.29273Z"
                                        fill="#FACC15" />
                                </g>
                                <path
                                    d="M175.868 27.2029V11.2188H186.264V13.646H178.764V17.9855H185.726V20.4128H178.764V24.7756H186.327V27.2029H175.868Z"
                                    fill="white" />
                                <path
                                    d="M164.92 27.2029H159.503V11.2188H165.029C166.616 11.2188 167.979 11.5387 169.119 12.1787C170.263 12.8135 171.143 13.7267 171.757 14.9182C172.37 16.1097 172.677 17.5354 172.677 19.1952C172.677 20.8602 172.368 22.2911 171.749 23.4878C171.135 24.6846 170.248 25.6029 169.087 26.2429C167.932 26.8829 166.543 27.2029 164.92 27.2029ZM162.399 24.6976H164.779C165.893 24.6976 166.821 24.4946 167.565 24.0888C168.309 23.6777 168.869 23.0664 169.243 22.2547C169.618 21.4378 169.805 20.418 169.805 19.1952C169.805 17.9725 169.618 16.9578 169.243 16.1514C168.869 15.3397 168.315 14.7335 167.581 14.3328C166.853 13.927 165.947 13.7241 164.865 13.7241H162.399V24.6976Z"
                                    fill="white" />
                                <path d="M155.928 11.2188V27.2029H153.032V11.2188H155.928Z" fill="white" />
                                <path
                                    d="M138.298 27.2029V11.2188H144.292C145.52 11.2188 146.551 11.4321 147.383 11.8587C148.221 12.2854 148.853 12.8838 149.28 13.6538C149.712 14.4187 149.928 15.311 149.928 16.3309C149.928 17.3559 149.709 18.2456 149.272 19.0001C148.84 19.7493 148.203 20.3295 147.36 20.7406C146.517 21.1464 145.481 21.3493 144.253 21.3493H139.984V18.9455H143.863C144.581 18.9455 145.169 18.8466 145.627 18.6489C146.085 18.446 146.423 18.152 146.642 17.7669C146.865 17.3767 146.977 16.898 146.977 16.3309C146.977 15.7637 146.865 15.2798 146.642 14.8792C146.418 14.4733 146.077 14.1663 145.619 13.9582C145.161 13.7449 144.571 13.6382 143.848 13.6382H141.194V27.2029H138.298ZM146.556 19.9601L150.513 27.2029H147.282L143.395 19.9601H146.556Z"
                                    fill="white" />
                                <path
                                    d="M117.673 27.2029V11.2188H123.667C124.895 11.2188 125.926 11.4321 126.758 11.8587C127.596 12.2854 128.228 12.8838 128.655 13.6538C129.086 14.4187 129.302 15.311 129.302 16.3309C129.302 17.3559 129.084 18.2456 128.647 19.0001C128.215 19.7493 127.578 20.3295 126.735 20.7406C125.892 21.1464 124.856 21.3493 123.628 21.3493H119.359V18.9455H123.238C123.956 18.9455 124.544 18.8466 125.002 18.6489C125.46 18.446 125.798 18.152 126.017 17.7669C126.24 17.3767 126.352 16.898 126.352 16.3309C126.352 15.7637 126.24 15.2798 126.017 14.8792C125.793 14.4733 125.452 14.1663 124.994 13.9582C124.536 13.7449 123.946 13.6382 123.222 13.6382H120.569V27.2029H117.673ZM125.931 19.9601L129.888 27.2029H126.657L122.77 19.9601H125.931Z"
                                    fill="white" />
                                <path
                                    d="M103.884 27.2029V11.2188H114.28V13.646H106.779V17.9855H113.741V20.4128H106.779V24.7756H114.342V27.2029H103.884Z"
                                    fill="white" />
                                <path
                                    d="M84.6795 27.2029L80.1684 11.2188H83.2825L86.1624 22.9649H86.3107L89.3858 11.2188H92.2189L95.3018 22.9727H95.4423L98.3223 11.2188H101.436L96.9252 27.2029H94.0687L90.8687 15.9875H90.7438L87.5361 27.2029H84.6795Z"
                                    fill="white" />
                                <path
                                    d="M78.5464 19.2106C78.5464 20.9329 78.2238 22.408 77.5786 23.6359C76.9387 24.8586 76.0645 25.7952 74.9562 26.4456C73.8532 27.096 72.6018 27.4212 71.2022 27.4212C69.8025 27.4212 68.5485 27.096 67.4403 26.4456C66.3372 25.79 65.4631 24.8508 64.8179 23.6281C64.1779 22.4001 63.8579 20.9276 63.8579 19.2106C63.8579 17.4884 64.1779 16.0159 64.8179 14.7931C65.4631 13.5652 66.3372 12.626 67.4403 11.9756C68.5485 11.3252 69.8025 11 71.2022 11C72.6018 11 73.8532 11.3252 74.9562 11.9756C76.0645 12.626 76.9387 13.5652 77.5786 14.7931C78.2238 16.0159 78.5464 17.4884 78.5464 19.2106ZM75.6353 19.2106C75.6353 17.9983 75.4453 16.9758 75.0655 16.1433C74.6909 15.3056 74.1706 14.6734 73.5046 14.2468C72.8386 13.8149 72.0711 13.599 71.2022 13.599C70.3332 13.599 69.5658 13.8149 68.8998 14.2468C68.2337 14.6734 67.7108 15.3056 67.331 16.1433C66.9564 16.9758 66.7691 17.9983 66.7691 19.2106C66.7691 20.4229 66.9564 21.448 67.331 22.2857C67.7108 23.1182 68.2337 23.7504 68.8998 24.1822C69.5658 24.6089 70.3332 24.8222 71.2022 24.8222C72.0711 24.8222 72.8386 24.6089 73.5046 24.1822C74.1706 23.7504 74.6909 23.1182 75.0655 22.2857C75.4453 21.448 75.6353 20.4229 75.6353 19.2106Z"
                                    fill="white" />
                                <path
                                    d="M49.68 27.2029V11.2188H55.674C56.902 11.2188 57.9322 11.4477 58.7647 11.9056C59.6024 12.3634 60.2346 12.993 60.6613 13.7943C61.0931 14.5904 61.3091 15.4958 61.3091 16.5104C61.3091 17.5354 61.0931 18.446 60.6613 19.242C60.2294 20.0381 59.592 20.6651 58.7491 21.123C57.9062 21.5757 56.8682 21.802 55.635 21.802H51.6624V19.4215H55.2448C55.9628 19.4215 56.5508 19.2967 57.0087 19.0469C57.4665 18.7972 57.8047 18.4538 58.0233 18.0167C58.247 17.5796 58.3589 17.0775 58.3589 16.5104C58.3589 15.9432 58.247 15.4437 58.0233 15.0119C57.8047 14.58 57.4639 14.2444 57.0009 14.005C56.543 13.7605 55.9524 13.6382 55.2292 13.6382H52.5756V27.2029H49.68Z"
                                    fill="white" />
                                <defs>
                                    <clipPath id="clip0_1_18709">
                                        <rect width="38" height="38" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>

                            <p class="text-lg font-medium leading-8 text-gray-400 text-center sm:text-start">An power
                                ride is a bicycle that uses an electric motor to assist with pedaling. </p>
                        </div>
                        <div class="flex items-center gap-4">
                            <a href=""
                                class="group p-2 rounded-full border-2 border-white transition-all duration-500 hover:border-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14"
                                    fill="none">
                                    <path
                                        d="M8.32144 5.93666L13.4919 0.0556641H12.2667L7.77716 5.16205L4.19141 0.0556641H0.0556641L5.47803 7.77743L0.0556641 13.9446H1.28097L6.022 8.55204L9.80881 13.9446H13.9446L8.32114 5.93666H8.32144ZM6.64322 7.84546L6.09382 7.07654L1.72246 0.958215H3.60445L7.13219 5.8959L7.68159 6.66481L12.2672 13.083H10.3852L6.64322 7.84575V7.84546Z"
                                        fill="#FACC15" />
                                </svg>
                            </a>

                            <a href=""
                                class="group p-2 rounded-full border-2 border-white transition-all duration-500 hover:border-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                    fill="none">
                                    <path
                                        d="M7.7117 9.93907C7.7117 8.66068 8.76298 7.62407 10.0601 7.62407C11.3573 7.62407 12.4092 8.66068 12.4092 9.93907C12.4092 11.2175 11.3573 12.2541 10.0601 12.2541C8.76298 12.2541 7.7117 11.2175 7.7117 9.93907ZM6.44187 9.93907C6.44187 11.9085 8.06177 13.505 10.0601 13.505C12.0585 13.505 13.6784 11.9085 13.6784 9.93907C13.6784 7.96963 12.0585 6.37318 10.0601 6.37318C8.06177 6.37318 6.44187 7.96963 6.44187 9.93907ZM12.9761 6.2318C12.976 6.39661 13.0256 6.55775 13.1184 6.69483C13.2113 6.8319 13.3433 6.93877 13.4978 7.0019C13.6523 7.06503 13.8223 7.0816 13.9863 7.04951C14.1503 7.01743 14.301 6.93812 14.4193 6.82162C14.5377 6.70512 14.6182 6.55667 14.6509 6.39503C14.6836 6.23339 14.667 6.06583 14.603 5.91353C14.5391 5.76124 14.4307 5.63105 14.2917 5.53942C14.1527 5.4478 13.9893 5.39886 13.822 5.3988H13.8217C13.5975 5.3989 13.3825 5.48668 13.224 5.64287C13.0654 5.79906 12.9763 6.01087 12.9761 6.2318ZM7.21337 15.5917C6.52637 15.5609 6.15296 15.4481 5.90481 15.3528C5.57583 15.2266 5.3411 15.0762 5.0943 14.8334C4.8475 14.5905 4.69474 14.3594 4.56722 14.0351C4.47049 13.7907 4.35605 13.4226 4.32482 12.7455C4.29066 12.0135 4.28384 11.7936 4.28384 9.93913C4.28384 8.08463 4.29123 7.86535 4.32482 7.13274C4.35611 6.45568 4.47139 6.0883 4.56722 5.84313C4.6953 5.51891 4.84784 5.28757 5.0943 5.04435C5.34076 4.80113 5.57526 4.65057 5.90481 4.52491C6.15285 4.42957 6.52637 4.3168 7.21337 4.28602C7.95613 4.25235 8.17925 4.24563 10.0601 4.24563C11.9411 4.24563 12.1644 4.25291 12.9078 4.28602C13.5948 4.31685 13.9676 4.43046 14.2163 4.52491C14.5453 4.65057 14.7801 4.80146 15.0268 5.04435C15.2736 5.28724 15.4258 5.51891 15.5539 5.84313C15.6507 6.08757 15.7651 6.45568 15.7963 7.13274C15.8305 7.86535 15.8373 8.08463 15.8373 9.93913C15.8373 11.7936 15.8305 12.0129 15.7963 12.7455C15.765 13.4226 15.65 13.7906 15.5539 14.0351C15.4258 14.3594 15.2733 14.5907 15.0268 14.8334C14.7804 15.076 14.5453 15.2266 14.2163 15.3528C13.9683 15.4481 13.5948 15.5609 12.9078 15.5917C12.165 15.6254 11.9419 15.6321 10.0601 15.6321C8.1784 15.6321 7.9559 15.6254 7.21337 15.5917ZM7.15503 3.03668C6.40489 3.07035 5.8923 3.18757 5.44465 3.35924C4.98105 3.53652 4.58859 3.77435 4.19641 4.16024C3.80423 4.54613 3.56352 4.93352 3.38364 5.39041C3.20945 5.83185 3.09051 6.33674 3.05635 7.07602C3.02162 7.81646 3.01367 8.05318 3.01367 9.93907C3.01367 11.825 3.02162 12.0617 3.05635 12.8021C3.09051 13.5415 3.20945 14.0463 3.38364 14.4877C3.56352 14.9444 3.80429 15.3322 4.19641 15.7179C4.58853 16.1036 4.98105 16.3411 5.44465 16.5189C5.89314 16.6906 6.40489 16.8078 7.15503 16.8415C7.90675 16.8751 8.14655 16.8835 10.0601 16.8835C11.9737 16.8835 12.2139 16.8757 12.9653 16.8415C13.7155 16.8078 14.2277 16.6906 14.6756 16.5189C15.139 16.3411 15.5317 16.1038 15.9239 15.7179C16.3161 15.332 16.5563 14.9444 16.7367 14.4877C16.9108 14.0463 17.0304 13.5414 17.064 12.8021C17.0981 12.0611 17.1061 11.825 17.1061 9.93907C17.1061 8.05318 17.0981 7.81646 17.064 7.07602C17.0298 6.33668 16.9108 5.83157 16.7367 5.39041C16.5563 4.9338 16.3154 4.54674 15.9239 4.16024C15.5323 3.77374 15.139 3.53652 14.6762 3.35924C14.2277 3.18757 13.7154 3.0698 12.9658 3.03668C12.2145 3.00302 11.9743 2.99463 10.0607 2.99463C8.14712 2.99463 7.90675 3.00246 7.15503 3.03668Z"
                                        fill="#FACC15" />
                                </svg>
                            </a>

                            <a href=""
                                class="group p-2 rounded-full border-2 border-white transition-all duration-500 hover:border-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 13 12"
                                    fill="none">
                                    <path
                                        d="M2.87842 11.5554V3.87103H0.317917V11.5554H2.87869H2.87842ZM1.59871 2.82205C2.49142 2.82205 3.0472 2.23198 3.0472 1.49456C3.03049 0.740346 2.49142 0.166748 1.61568 0.166748C0.739343 0.166748 0.166992 0.740346 0.166992 1.4945C0.166992 2.23192 0.722566 2.82198 1.58193 2.82198H1.5985L1.59871 2.82205ZM4.2957 11.5554H6.85601V7.26455C6.85601 7.03519 6.87272 6.80523 6.94036 6.64141C7.12537 6.18236 7.54667 5.70718 8.25417 5.70718C9.18044 5.70718 9.5512 6.41179 9.5512 7.44491V11.5554H12.1114V7.14941C12.1114 4.78921 10.8484 3.69088 9.16386 3.69088C7.78274 3.69088 7.17617 4.4609 6.83916 4.98536H6.85621V3.8713H4.29583C4.32925 4.59218 4.29563 11.5556 4.29563 11.5556L4.2957 11.5554Z"
                                        fill="#FACC15" />
                                </svg>
                            </a>

                            <a href=""
                                class="group p-2 rounded-full border-2 border-white transition-all duration-500 hover:border-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                    fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M15.9326 5.1387C16.5664 5.30987 17.0646 5.8093 17.233 6.44237C17.5394 7.59129 17.5394 9.98995 17.5394 9.98995C17.5394 9.98995 17.5394 12.3886 17.233 13.5375C17.0623 14.173 16.5641 14.6724 15.9326 14.8412C14.7866 15.1484 10.1886 15.1484 10.1886 15.1484C10.1886 15.1484 5.59296 15.1484 4.44462 14.8412C3.81082 14.67 3.31266 14.1706 3.14427 13.5375C2.83789 12.3886 2.83789 9.98995 2.83789 9.98995C2.83789 9.98995 2.83789 7.59129 3.14427 6.44237C3.315 5.80695 3.81316 5.30752 4.44462 5.1387C5.59296 4.83154 10.1886 4.83154 10.1886 4.83154C10.1886 4.83154 14.7866 4.83154 15.9326 5.1387ZM12.539 9.98995L8.71982 12.201V7.77887L12.539 9.98995Z"
                                        fill="#FACC15" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="lg:w-2/6 text-center sm:text-start">
                        <h4 class="text-xl font-semibold leading-8 text-white mb-5">Odkazy</h4>
                        <ul class="flex flex-col gap-3 sm:items-start items-center text-lg font-normal  transition-all duration-500">
                            <li class="">
                                <a href="/"
                                   class="text-gray-400 transition-all duration-500 hover:text-gray-300">Home</a>
                            </li>
                            <li class="">
                                <a href="aboutus.html"
                                   class="text-gray-400 transition-all duration-500 hover:text-gray-300">About Us</a>
                            </li>
                            <li class="">
                                <a href=""
                                   class="text-gray-400 transition-all duration-500 hover:text-gray-300">Services</a>
                            </li>
                            <li class="">
                                <a href="blog.html"
                                   class="text-gray-400 transition-all duration-500 hover:text-gray-300">Blog</a>
                            </li>
                            <li>
                                <a href=""
                                   class="text-gray-400 transition-all duration-500 hover:text-gray-300">Testimonials</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex flex-col gap-5">
                    <h5 class="col-span-full text-xl font-semibold leading-8 text-white text-center sm:text-start">
                        Napište nám!</h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <input type="text"
                            class="py-2 px-3.5 bg-white shadow-[0 1px 2px 0 rgba(16, 24, 40, 0.05)] rounded-lg outline-none placeholder:text-black transition-all duration-500 focus:bg-gray-200"
                            placeholder="Jméno *">
                        <input type="text"
                            class="py-2 px-3.5 bg-white shadow-[0 1px 2px 0 rgba(16, 24, 40, 0.05)] rounded-lg outline-none placeholder:text-black transition-all duration-500 focus:bg-gray-200"
                            placeholder="Telefon*">

                        <textarea type="text" rows="3"
                            class="col-span-full py-2 px-3.5 bg-white shadow-[0 1px 2px 0 rgba(16, 24, 40, 0.05)] rounded-lg outline-none placeholder:text-black resize-none transition-all duration-500 focus:bg-gray-200"
                            placeholder="Zpráva"></textarea>
                        <div>
                        </div>
                    </div>
                    <button class="mx-auto sm:mx-0 flex items-center gap-1.5 px-4 py-2 text-sm font-medium leading-6 text-black bg-yellow-400 shadow-sm rounded-lg transition-all duration-500 hover:bg-yellow-500 w-max">
                        Odeslat <i class="fa-regular fa-truck"></i>
                    </button>
                </div>
            </div>
            <div
                class="mt-12 pt-7 border-t border-white/40 flex items-center flex-col sm:flex-row gap-4 sm:gap-0 sm:justify-between">
                <p class="text-sm font-normal leading-5 text-white text-center sm:text-start">Copyright &copy;{{ date('Y') }} Auto Houlík.
                    Všechna práva vyhrazena.</p>
                <div class="flex items-center gap-4 sm:gap-8 flex-col sm:flex-row">
                    <a href="" class="text-sm font-light leading-5 text-white">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 2,
            spaceBetween: 28,
            centeredSlides: false,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    centeredSlides: false,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 28,
                    centeredSlides: false,
                },
                1024: {
                    slidesPerView: 2,
                    spaceBetween: 44,
                },
            },
        });


    </script>
    <script src="{{ asset('script/script.js') }}"></script>
@endsection
