@php
    $languageThreeLetterCode = App\Helper\Helper::getLanguageThreeLetterCode(App::getLocale());
@endphp
<section id="hero">
    <div class="hero relative tablet:pb-[6rem] big-tablet:pb-[10rem] laptop:pb-[12rem] gap-[2.5rem] max-w-[100vw]">
        <header
            class="flex mx-auto max-w-[94rem] p-[2.5rem_0.875rem_1.25rem_0.875rem] tablet:p-[1.875rem_2.5rem_1.25rem_2.5rem] justify-between items-center w-full">
            <div class="big-tablet:flex items-center justify-start big-tablet:gap-[2.5rem]">
                <div class="flex flex-1 gap-[0.54888rem] tablet:gap-[0.875rem] items-center w-full h-full">
                    <span class="font-bold font-alt text-[1.48988rem] tablet:text-[2.375rem]">
                        <x-pages.logo />
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="tablet:hidden" width="2" height="33"
                        viewBox="0 0 2 33" fill="none">
                        <path d="M0.782227 0.5L0.782225 32.5" stroke="black" stroke-width="0.627308" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="hidden tablet:flex" width="2" height="51"
                        viewBox="0 0 2 51" fill="none">
                        <path d="M1 0L0.999998 51" stroke="black" />
                    </svg>
                    <div class="flex flex-col">
                        <span
                            class="tracking-[0.03294rem] text-[0.54888rem] tablet:text-[0.875rem] tablet:tracking-[0.0525rem] uppercase">
                            {{ __('pages/home.websites') }}
                        </span>
                        <span
                            class="tracking-[0.03294rem] text-[0.54888rem] tablet:text-[0.875rem] tablet:tracking-[0.0525rem] uppercase">
                            {{ __('pages/home.for_restaurants') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex items-center tablet:gap-[2.5rem]">
                <button data-language='{{ App::currentLocale() }}'
                    class="hidden language-selected z-10 tablet:flex font-alt text-[1.25rem] tracking-[0.0625rem] cursor-pointer hover:opacity-80 transition-opacity"
                    title="{{ __('pages/home.language') }}">
                    {{ $languageThreeLetterCode }}
                </button>
                <a href="#contact"
                    class="hidden z-10 laptop:flex justify-center items-center gap-[1.5rem] rounded-full bg-black hover:bg-black/80 transition-colors text-white p-[1.125rem_2.875rem]">
                    {{ __('pages/home.contact_us') }}
                </a>
                <button id="drawer-button" class="flex z-10 items-center justify-center tablet:gap-[1.5rem]">
                    <div class="hidden tablet:flex font-thin tracking-[0.0625rem] text-[0.875rem]">
                        {{ __('pages/home.menu') }}
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="47" height="16" viewBox="0 0 47 16"
                        fill="none">
                        <rect width="47" height="2" rx="1" fill="black" />
                        <rect x="11" y="14" width="36" height="2" rx="1" fill="black" />
                    </svg>
                </button>
            </div>
        </header>
        <div class="flex flex-col mx-auto max-w-[94rem] flex-1 items-center self-stretch justify-between">
            <div class="tablet:flex tablet:flex-col tablet:self-stretch tablet:justify-between">
                <div
                    class="flex self-stretch items-center flex-col p-[6.25rem_0.875rem] tablet:p-[8rem_2.5rem_4.6875rem_2.5rem] desktop:py-[15rem] big-tablet:p-[6rem_3.75rem_4.6875rem_3.75rem] items-center tablet:items-start gap-[1.25rem] tablet:gap-[3.0625rem] justify-center tablet:bg-none bg-[linear-gradient(180deg,rgba(255,255,255,0.00)_3.14%,rgba(255,255,255,0.70)_44.5%,rgba(255,255,255,0.00)_100%)]">
                    <h2 class="text-[1.125rem] uppercase">
                        {{ __('pages/home.welcome_to_app_name', ['app_name' => config('app.name')]) }}
                    </h2>
                    <div
                        class="relative text-[2.75rem] tablet:text-[3.75rem] font-bold tracking-[-0.0625rem] text-center tablet:text-left capitalize leading-[100%] tablet:flex tablet:flex-col">
                        <div class='flex items-end w-[29rem]'>
                            <p>
                                {{ __('pages/home.hero_title') }}
                                <span style='color: #FC1919'>.</span>
                            </p>
                            </span>
                            </span>
                        </div>
                    </div>
                    <h3
                        class="capitalize text-base text-center w-[22rem] tablet:text-left tablet:flex tablet:flex-col tablet:text-[1.25rem]">
                        {{ __('pages/home.hero_benefits') }}
                    </h3>
                    <a href="#contact"
                        class="hidden z-10 tablet:flex laptop:hidden justify-center items-center gap-[1.5rem] rounded-full bg-black hover:bg-black/80 transition-colors text-white p-[1.125rem_2.875rem]">
                        {{ __('pages/home.contact_us') }}
                    </a>
                </div>
            </div>
            <div
                class="hidden max-w-[94rem] mx-auto absolute bottom-4 inset-x-0 tablet:flex justify-between items-end h-full self-stretch p-[0rem_2.5rem_4rem_2.5rem] big-tablet:p-[0rem_3.75rem_4rem_3.75rem] ">
                <svg xmlns="http://www.w3.org/2000/svg" width="39" height="31" viewBox="0 0 39 31"
                    fill="none">
                    <path d="M2 11L19.5 28.5L37 11" stroke="#FC1919" stroke-width="2.5" stroke-linecap="round" />
                    <path d="M9.5 1.5L19 10.5L28.5 1.5" stroke="#FC1919" stroke-opacity="0.5" stroke-width="1.5"
                        stroke-linecap="round" />
                </svg>
            </div>
            <div
                class="self-stretch justify-between flex flex-col pb-[5rem] flex-1 items-center tablet:hidden max-w-[92.5rem]">
                <a href="#contact"
                    class="flex justify-center items-center gap-[1.5rem] rounded-full bg-black hover:bg-black/80 transition-colors text-white p-[1.125rem_2.875rem]">
                    {{ __('pages/home.contact_us') }}
                </a>
            </div>
        </div>
    </div>
    <div id="drawer"
        class="flex flex-col justify-between items-start pb-[3.75rem] fixed bg-white inset-0 h-[100dvh] w-screen z-40 transition-transform -translate-y-[150dvh] duration-300 ease-in-out">
        <div class="flex w-full justify-between items-center p-[2.5rem_0.875rem_0rem_0.875rem]">
            <span class="font-light text-[0.875rem] tracking-[0.0625rem] text-body">{{ __('pages/home.menu') }}</span>
            <div class="flex items-center desktop:gap-[3.75rem]">
                <button class="hidden desktop:flex font-alt text-[1.25rem] tracking-[0.0625rem]">
                    ENG
                </button>
                <a href="#contact"
                    class="hidden desktop:flex p-[1.125rem_2.875rem] font-medium tracking-[0.0625rem] items-center justify-center gap-[1.5rem] rounded-[22.1875rem] bg-black hover:bg-black/80 text-white">
                    {{ __('pages/home.contact_us') }}
                </a>
                <button id="close-drawer" class="flex gap-[1.5rem] items-center">
                    <span class="font-light text-[0.875rem] tracking-[0.0625rem] text-body">Close</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="47" class="translate-y-[7px]" height="16"
                        viewBox="0 0 47 16" fill="none">
                        <rect width="47" height="2" rx="1" fill="black" />
                    </svg>
                </button>
            </div>
        </div>
        <div
            class="flex flex-col items-start text-[1.625rem] desktop:text-[3.75rem] tablet:text-[2.5rem] gap-[1.25rem] p-[0rem_0.875rem] self-stretch tablet:p-[0rem_5.625rem] tablet:gap-[0.625rem] big-tablet:p-[0rem_12.5rem] desktop:p-[0rem_15rem]">
            <a href="#hero" class="font-alt font-bold uppercase hover:text-black/80">{{ __('pages/home.home') }}</a>
            <a href="#benefits"
                class="font-alt font-bold uppercase hover:text-black/80">{{ __('pages/home.benefits_of_a_website') }}</a>
            <a href="#prices"
                class="font-alt font-bold uppercase hover:text-black/80">{{ __('pages/home.prices') }}</a>
            <a href="#contact"
                class="font-alt font-bold uppercase hover:text-black/80">{{ __('pages/home.contact') }}</a>
            <a href="#questions"
                class="font-alt font-bold uppercase hover:text-black/80">{{ __('pages/home.questions_and_answers') }}</a>
            <a href="#about"
                class="font-alt font-bold uppercase hover:text-black/80">{{ __('pages/home.about_us') }}</a>
        </div>
        <div
            class="flex flex-col items-start gap-[1.875rem] self-stretch p-[0rem_0.875rem] tablet:p-0 tablet:pl-[1.875rem] big-tablet:pl-[3.75rem] laptop:pl-[2.5rem]">
            <span class="text-[0.75rem] tracking-[0.0625rem] text-body">{{ __('pages/home.language') }}</span>
            <div
                class="flex justify-between items-start self-stretch tablet:pl-[8.75rem] laptop:pl-[10rem] tablet:justify-start">
                <button id="en" data-lang="en"
                    class="rounded-[4rem] {{ $languageThreeLetterCode === 'en' ? 'bg-[#FC1919] text-white' : '' }} flex items-center justify-center flex-col gap-[0.625rem] p-[0.625rem_1.3125rem] w-[5.125rem] h-[4rem] font-alt tracking-[0.0625rem]"
                    wire:click="changeLocale('en')">
                    ENG
                </button>
                <button id="de" data-lang="de"
                    class="rounded-[4rem] {{ $languageThreeLetterCode === 'de' ? 'bg-[#FC1919] text-white' : '' }} flex items-center justify-center flex-col gap-[0.625rem] p-[0.625rem_1.3125rem] w-[5.125rem] h-[4rem] font-alt tracking-[0.0625rem]"
                    wire:click="changeLocale('de')">
                    DEU
                </button>
                <button id="tr" data-lang="tr"
                    class="rounded-[4rem] {{ $languageThreeLetterCode === 'tr' ? 'bg-[#FC1919] text-white' : '' }} flex items-center justify-center flex-col gap-[0.625rem] p-[0.625rem_1.3125rem] w-[5.125rem] h-[4rem] font-alt tracking-[0.0625rem]"
                    wire:click="changeLocale('tr')">
                    TÜR
                </button>
                <button id="ar" data-lang="ar"
                    class="rounded-[4rem] {{ $languageThreeLetterCode === 'ar' ? 'bg-[#FC1919] text-white' : '' }} flex items-center justify-center flex-col gap-[0.625rem] p-[0.625rem_1.3125rem] w-[5.125rem] h-[4rem] font-alt tracking-[0.0625rem]"
                    wire:click="changeLocale('ar')">
                    عربي
                </button>
            </div>
        </div>
    </div>
    <div id="benefits"
        class="flex relative overflow-hidden mx-auto max-w-[92.5rem flex-col justify-center items-center gap-[3.75rem] tablet:gap-[5.625rem] self-stretch p-[0rem_0.875rem] tablet:p-[0rem_2.5rem] desktop:p-[0rem_16.75rem] my-[5.625rem] tablet:my-[7.5rem] big-tablet:my-[10rem] desktop:my-[11.25rem] tablet:max-w-[120rem]">
        <button class="absolute desktop:block top-[1px] desktop:left-[156px] hidden">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"
                fill="none">
                <rect class="group-hover:fill-black/80" x="0.5" y="0.5" width="47" height="47" rx="23.5"
                    fill="black" />
                <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" stroke="white" />
                <path d="M18 26L24 20L30 26" stroke="white" stroke-width="1.5" stroke-linecap="round" />
            </svg>
        </button>
        <div class="flex flex-col gap-[1.875rem] self-stretch ">
            <div
                class="flex flex-col tablet:flex-row items-center tablet:justify-start gap-[0.625rem] self-stretch justify-center">
                <h3 class="font-alt text-[1.25rem] leading-[120%] tablet:order-last">{{ __('pages/home.benefits') }}
                </h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10"
                    fill="#FC1919">
                    <circle cx="5.5" cy="5" r="5" fill="#FC1919" />
                </svg>
            </div>
            <h2
                class="font-bold text-[1.875rem] tablet:text-[2.125rem] laptop:text-[2.5rem] text-center tablet:text-left">
                {{ __('pages/home.your_website') }}
            </h2>
        </div>
        <div class="flex flex-wrap self-stretch items-start content-start gap-[1.25rem]">
            <div
                class="flex rounded-[1.25rem] border-[3px] border-[#F6F6F6] h-[21.5rem] min-w-[20.75rem] min-h-[21.5rem] p-[1.875rem] flex-col justify-between items-start flex-1">
                <div class="flex flex-col gap-[1.25rem] items-start self-stretch">
                    <h2 class="font-medium leading-[160%] text-[1.125rem] uppercase">
                        {{ __('pages/home.present_your_restaurant') }}</h2>
                    <p class="text-[0.875rem] leading-[160%] text-body">
                        {{ __('pages/home.present_your_restaurant_description') }}
                    </p>
                </div>
                <svg class="w-[3.75rem] h-[3.75rem] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="60"
                    height="60" viewBox="0 0 60 60" fill="none">
                    <path
                        d="M45 20C45 23.9782 43.4196 27.7936 40.6066 30.6066C37.7936 33.4196 33.9782 35 30 35C26.0218 35 22.2064 33.4196 19.3934 30.6066C16.5804 27.7936 15 23.9782 15 20C15 16.0218 16.5804 12.2064 19.3934 9.3934C22.2064 6.58035 26.0218 5 30 5C33.9782 5 37.7936 6.58035 40.6066 9.3934C43.4196 12.2064 45 16.0218 45 20Z"
                        fill="#FC1919" />
                    <path
                        d="M12.5828 26.9575C10.2212 28.3015 8.26906 30.2617 6.93481 32.6288C5.60057 34.9959 4.93437 37.681 5.00737 40.3972C5.08037 43.1135 5.88982 45.7589 7.34928 48.0509C8.80874 50.3429 10.8634 52.1955 13.2937 53.4107C15.7241 54.6258 18.4389 55.158 21.1482 54.9504C23.8575 54.7427 26.4595 53.8031 28.6763 52.2317C30.8931 50.6604 32.6415 48.5164 33.7346 46.0287C34.8277 43.541 35.2246 40.8032 34.8828 38.1075C30.4453 39.3037 25.723 38.8291 21.6122 36.7737C17.5015 34.7183 14.2884 31.2253 12.5828 26.9575ZM38.4678 36.735C38.6528 37.795 38.7503 38.885 38.7503 40C38.7503 45.225 36.6128 49.955 33.1628 53.355C36.6587 55.1959 40.7398 55.5833 44.5196 54.4328C48.2994 53.2824 51.4727 50.6871 53.3502 47.2107C55.2276 43.7343 55.6577 39.6575 54.547 35.8658C53.4362 32.0742 50.8744 28.8739 47.4178 26.96C45.7186 31.1959 42.5378 34.6699 38.4678 36.735Z"
                        fill="#FE9090" />
                </svg>
            </div>
            <div
                class="flex rounded-[1.25rem] border-[3px] border-[#F6F6F6] h-[21.5rem] min-w-[20.75rem] min-h-[21.5rem] p-[1.875rem] flex-col justify-between items-start flex-1">
                <div class="flex flex-col gap-[1.25rem] items-start self-stretch">
                    <h2 class="font-medium leading-[160%] text-[1.125rem] uppercase">
                        {{ __('pages/home.accessibility') }}
                    </h2>
                    <p class="text-[0.875rem] leading-[160%] text-body">
                        {{ __('pages/home.accessibility_description') }}
                    </p>
                </div>
                <svg class="w-[3.75rem] h-[3.75rem] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="60"
                    height="60" viewBox="0 0 60 60" fill="none">
                    <path
                        d="M34.9232 53.2907C34.4523 53.4178 33.9718 53.531 33.4949 53.629C32.2473 53.8832 31.4422 55.1008 31.697 56.3485C31.7113 56.4197 31.7291 56.4875 31.7495 56.5556C32.0899 57.6833 33.2402 58.3869 34.4171 58.1468C34.9863 58.0303 35.5599 57.8947 36.1222 57.7434C37.3521 57.4126 38.0804 56.1472 37.7495 54.9173C37.4183 53.6858 36.1531 52.9596 34.9232 53.2907Z"
                        fill="#FE9090" />
                    <path
                        d="M18.8508 52.0069C18.4055 51.8087 17.9613 51.5942 17.5303 51.3688C16.4009 50.78 15.0086 51.2176 14.4196 52.3469C14.1289 52.9023 14.0881 53.522 14.256 54.0782C14.4295 54.6518 14.8241 55.1582 15.3965 55.457C15.911 55.725 16.4397 55.9812 16.9702 56.2177C18.1326 56.7367 19.4963 56.2156 20.0157 55.0533C20.5351 53.89 20.0134 52.5272 18.8508 52.0069Z"
                        fill="#FE9090" />
                    <path
                        d="M26.7797 54.0341C26.2947 53.9951 25.8027 53.9401 25.3199 53.8722C24.0589 53.6925 22.8922 54.57 22.713 55.8308C22.6644 56.1735 22.6942 56.5086 22.7878 56.8192C23.0391 57.6519 23.7541 58.3067 24.6724 58.4377C25.2469 58.5188 25.8317 58.584 26.4096 58.63C27.6793 58.7328 28.7911 57.7866 28.8932 56.5177C28.9953 55.248 28.0496 54.1363 26.7797 54.0341Z"
                        fill="#FE9090" />
                    <path
                        d="M42.3496 49.8517C41.949 50.1273 41.5335 50.3948 41.1152 50.6473C40.1936 51.2026 39.8002 52.3009 40.0968 53.2858C40.1515 53.4662 40.2295 53.6431 40.3311 53.8125C40.9879 54.9031 42.4052 55.2534 43.496 54.5968C43.9933 54.2969 44.4873 53.9778 44.9636 53.6503C46.0122 52.9284 46.278 51.4927 45.5559 50.4441C44.8342 49.3945 43.3981 49.1298 42.3496 49.8517Z"
                        fill="#FE9090" />
                    <path
                        d="M51.4135 43.6163C50.3807 42.8716 48.9397 43.1052 48.1948 44.1374C47.9104 44.5322 47.6093 44.9239 47.301 45.2998C46.7953 45.9174 46.664 46.718 46.8778 47.4287C47.0059 47.8518 47.2563 48.2438 47.6236 48.5449C48.6087 49.3516 50.0613 49.2068 50.868 48.2216C51.2361 47.773 51.5954 47.3059 51.9344 46.8351C52.6793 45.8023 52.4462 44.3616 51.4135 43.6163Z"
                        fill="#FE9090" />
                    <path
                        d="M54.6406 35.218C53.4185 34.861 52.1383 35.5631 51.7818 36.7854C51.6447 37.2536 51.4921 37.7237 51.3287 38.1824C51.1552 38.6652 51.1526 39.1686 51.2907 39.6245C51.4946 40.301 52.0051 40.8744 52.7201 41.1306C53.919 41.5605 55.2385 40.9378 55.6691 39.7394C55.8647 39.1929 56.0463 38.6333 56.2081 38.0763C56.5645 36.8546 55.8627 35.5739 54.6406 35.218Z"
                        fill="#FE9090" />
                    <path
                        d="M58.967 20.1956L55.9369 21.1371C53.6372 14.09 48.7953 8.29901 42.2418 4.78193C41.5821 4.42765 40.913 4.1021 40.2356 3.80294C40.2307 3.8006 40.2268 3.79865 40.2222 3.79566C40.1939 3.7837 40.1641 3.77252 40.1365 3.7603C34.1616 1.14589 27.5496 0.65029 21.2114 2.3667C21.1616 2.37645 21.1118 2.38582 21.0627 2.39973C20.851 2.45745 20.6374 2.51999 20.4266 2.58291C20.0807 2.68744 19.7326 2.80003 19.3912 2.91717C19.3508 2.93108 19.3127 2.94838 19.2734 2.96398C13.6156 4.9239 8.79749 8.53745 5.36025 13.3656C5.34802 13.3822 5.33424 13.3965 5.32267 13.413C4.98672 13.8848 4.6613 14.3741 4.35395 14.8676C4.33471 14.8992 4.31872 14.9321 4.30039 14.9647C3.99382 15.4619 3.69922 15.9705 3.42021 16.4892C0.571395 21.7984 -0.515372 27.7304 0.226084 33.59C0.227774 33.6034 0.229335 33.6159 0.230505 33.6292C0.231675 33.6385 0.233755 33.6483 0.235965 33.658C0.437483 35.2234 0.768493 36.7837 1.23328 38.3248C2.45383 42.3714 4.49047 46.0101 7.28624 49.1402C8.13431 50.0896 9.592 50.1715 10.5419 49.3234C11.4912 48.4751 11.574 47.017 10.7253 46.0679C9.32963 44.5061 8.16161 42.7906 7.22669 40.9423C7.21668 40.9196 7.20784 40.8963 7.19692 40.8745C6.97707 40.4384 6.76814 39.9914 6.57468 39.5441C6.57364 39.5406 6.57247 39.5385 6.57091 39.5356C6.21884 38.7121 5.91189 37.8644 5.64874 36.9935C2.62688 26.974 6.48069 16.4896 14.4781 10.6276C14.5964 10.5416 14.7146 10.4547 14.8341 10.3713C16.8872 8.92319 19.203 7.77493 21.7374 7.01072C24.288 6.24183 26.8673 5.91888 29.3934 5.99455C29.4342 5.99637 29.4739 5.99754 29.5143 5.99871C29.6685 6.00339 29.8222 6.01158 29.9756 6.02016C30.0376 6.02341 30.0994 6.02679 30.1613 6.03069C38.0383 6.52344 45.3019 10.8983 49.3796 17.7714C49.3818 17.7753 49.3834 17.7797 49.3861 17.7836C49.4466 17.8857 49.5056 17.9876 49.5649 18.0908C49.5719 18.1024 49.5796 18.1127 49.5863 18.1245C50.3665 19.4926 51.0229 20.9567 51.5335 22.506L48.5034 23.4481C47.6619 23.7096 47.5791 24.315 48.3177 24.7937L54.9117 29.0649C55.651 29.544 56.5327 29.2696 56.8698 28.4569L59.8823 21.1997C60.2191 20.3863 59.808 19.9343 58.967 20.1956Z"
                        fill="#FC1919" />
                    <path
                        d="M20.1894 30.0627C17.9672 31.7089 16.4515 33.1369 15.6436 34.3466C14.8365 35.5561 14.3524 36.8474 14.1934 38.2204H28.0962V34.4432H20.8601C21.285 34.0254 21.6546 33.6885 21.9695 33.431C22.2845 33.1722 22.9078 32.7216 23.841 32.0766C25.4108 30.9693 26.4938 29.9528 27.0893 29.0271C27.6844 28.1022 27.9823 27.1313 27.9823 26.1149C27.9823 25.1594 27.7226 24.2964 27.2031 23.5261C26.6832 22.7566 25.9698 22.1855 25.0636 21.8138C24.1576 21.4427 22.8888 21.2563 21.2578 21.2563C19.6958 21.2563 18.4731 21.452 17.589 21.8432C16.706 22.2338 16.0209 22.7948 15.5359 23.5261C15.0503 24.2588 14.7169 25.277 14.5345 26.581L19.1764 26.9563C19.3053 26.0165 19.5578 25.36 19.9329 24.9886C20.3087 24.6169 20.7915 24.4308 21.3839 24.4308C21.9525 24.4308 22.4248 24.6113 22.8 24.9717C23.1752 25.3313 23.3632 25.7659 23.3632 26.2744C23.3632 26.7449 23.1737 27.2414 22.7942 27.7651C22.4149 28.2883 21.5464 29.0546 20.1894 30.0627Z"
                        fill="#FC1919" />
                    <path
                        d="M42.0783 38.2204V35.1028H44.1713V31.507H42.0783V21.2563H38.0393L29.5977 31.2916V35.1028H38.0393V38.2204H42.0783ZM33.5793 31.507L38.0393 26.2589V31.507H33.5793Z"
                        fill="#FC1919" />
                </svg>
            </div>
            <div
                class="flex rounded-[1.25rem] border-[3px] border-[#F6F6F6] h-[21.5rem] min-w-[20.75rem] min-h-[21.5rem] p-[1.875rem] flex-col justify-between items-start flex-1">
                <div class="flex flex-col gap-[1.25rem] items-start self-stretch">
                    <h2 class="font-medium leading-[160%] text-[1.125rem] uppercase">
                        {{ __('pages/home.direct_communication') }}
                    </h2>
                    <p class="text-[0.875rem] leading-[160%] text-body">
                        {{ __('pages/home.direct_communication_description') }}
                    </p>
                </div>
                <svg class="w-[3.75rem] h-[3.75rem] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="60"
                    height="60" viewBox="0 0 60 60" fill="none">
                    <path
                        d="M52.5 20C53.8261 20 55.0979 20.5268 56.0355 21.4645C56.9732 22.4021 57.5 23.6739 57.5 25V35C57.5 36.3261 56.9732 37.5978 56.0355 38.5355C55.0979 39.4732 53.8261 40 52.5 40H49.845C49.2355 44.8332 46.8832 49.2779 43.2294 52.5C40.2038 55.168 36.4582 56.8458 32.4936 57.344C31.1237 57.5161 30 56.3807 30 55C30 53.6193 31.127 52.5213 32.4885 52.2922C35.5437 51.7782 38.3871 50.3261 40.6066 48.1066C43.4197 45.2936 45 41.4782 45 37.5V22.5C45 18.5217 43.4197 14.7064 40.6066 11.8934C37.7936 9.08035 33.9782 7.5 30 7.5C26.0218 7.5 22.2064 9.08035 19.3934 11.8934C16.5804 14.7064 15 18.5217 15 22.5V40H7.5C6.17392 40 4.90215 39.4732 3.96447 38.5355C3.02678 37.5978 2.5 36.3261 2.5 35V25C2.5 23.6739 3.02678 22.4021 3.96447 21.4645C4.90215 20.5268 6.17392 20 7.5 20H10.155C10.7651 15.1672 13.1177 10.7232 16.7714 7.50168C20.4252 4.28019 25.1289 2.50269 30 2.50269C34.8711 2.50269 39.5748 4.28019 43.2286 7.50168C46.8823 10.7232 49.2349 15.1672 49.845 20H52.5ZM21.5938 40.6524C20.3422 40.0719 19.9923 38.5148 20.7236 37.3448C21.4559 36.173 22.9952 35.8397 24.2721 36.3676C26.0808 37.1152 28.0266 37.5032 30 37.5C31.9734 37.5032 33.9192 37.1152 35.7279 36.3675C37.0049 35.8397 38.5441 36.173 39.2764 37.3447C40.0076 38.5147 39.6578 40.0719 38.4062 40.6524C35.7814 41.8696 32.9132 42.5045 30 42.5C27.0867 42.5046 24.2185 41.8698 21.5938 40.6524Z"
                        fill="#FC1919" />
                    <path
                        d="M21.5937 40.6524C20.3421 40.0719 19.9922 38.5147 20.7235 37.3447C21.4558 36.1729 22.9951 35.8396 24.272 36.3675C26.0807 37.1152 28.0265 37.5031 29.9999 37.4999C31.9733 37.5031 33.9191 37.1151 35.7278 36.3675C37.0048 35.8396 38.544 36.1729 39.2763 37.3447C40.0075 38.5146 39.6577 40.0718 38.4061 40.6523C35.7813 41.8696 32.9131 42.5044 29.9999 42.4999C27.0866 42.5045 24.2184 41.8697 21.5937 40.6524Z"
                        fill="#FE9090" />
                </svg>
            </div>
            <div
                class="flex rounded-[1.25rem] border-[3px] border-[#F6F6F6] h-[21.5rem] min-w-[20.75rem] min-h-[21.5rem] p-[1.875rem] flex-col justify-between items-start flex-1">
                <div class="flex flex-col gap-[1.25rem] items-start self-stretch">
                    <h2 class="font-medium leading-[160%] text-[1.125rem] uppercase">
                        {{ __('pages/home.increased_visibility') }}
                    </h2>
                    <p class="text-[0.875rem] leading-[160%] text-body">
                        {{ __('pages/home.increased_visibility_description') }}
                    </p>
                </div>
                <svg class="w-[3.75rem] h-[3.75rem] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="60"
                    height="60" viewBox="0 0 60 60" fill="none">
                    <path
                        d="M21.7969 12C18.5681 12 15.9891 14.3478 15.4395 17.4016C12.3387 18.1777 9.64805 20.1815 8.4668 23.3625H8.41758L4.92797 33.0913C4.15733 34.6455 3.75441 36.3543 3.75 38.087C3.75 44.3707 8.91141 49.5 15.2344 49.5C20.9306 49.5 25.677 45.3391 26.5645 39.9212C27.4554 40.7935 28.6645 41.3478 30 41.3478C31.3355 41.3478 32.543 40.7935 33.4355 39.9212C34.3214 45.3391 39.0694 49.5 44.7656 49.5C51.0886 49.5 56.25 44.3707 56.25 38.087C56.25 36.4989 55.9219 34.9793 55.3263 33.6033L51.5857 23.2092L51.5332 23.1603V23.1065C50.3355 20.2207 47.681 18.1957 44.5605 17.4C44.0109 14.3511 41.4319 12 38.2031 12C35.1565 12 32.6873 14.0951 31.9474 16.8913H28.0509C27.3127 14.0951 24.8435 12 21.7969 12ZM15.2344 29.9348C19.7838 29.9348 23.4375 33.5658 23.4375 38.087C23.4375 42.6082 19.7838 46.2391 15.2344 46.2391C10.6849 46.2391 7.03125 42.6082 7.03125 38.087C7.03125 36.9326 7.31836 35.8696 7.74984 34.875C7.77609 34.8147 7.77117 34.7348 7.79906 34.6728C8.45154 33.2583 9.49915 32.0597 10.8173 31.2198C12.1354 30.3798 13.6685 29.9338 15.2344 29.9348ZM44.7656 29.9348C49.3151 29.9348 52.9688 33.5658 52.9688 38.087C52.9688 42.6082 49.3151 46.2391 44.7656 46.2391C40.2162 46.2391 36.5625 42.6082 36.5625 38.087C36.5625 33.5658 40.2162 29.9348 44.7656 29.9348ZM30 34.8261C30.9253 34.8261 31.6406 35.537 31.6406 36.4565C31.6406 37.3761 30.9253 38.087 30 38.087C29.0747 38.087 28.3594 37.3761 28.3594 36.4565C28.3594 35.537 29.0747 34.8261 30 34.8261Z"
                        fill="#FC1919" />
                    <circle cx="15.375" cy="37.875" r="4.875" fill="#FE9090" />
                    <circle cx="44.625" cy="37.875" r="4.875" fill="#FE9090" />
                </svg>
            </div>
            <div
                class="flex rounded-[1.25rem] border-[3px] border-[#F6F6F6] h-[21.5rem] min-w-[20.75rem] min-h-[21.5rem] p-[1.875rem] flex-col justify-between items-start flex-1">
                <div class="flex flex-col gap-[1.25rem] items-start self-stretch">
                    <h2 class="font-medium leading-[160%] text-[1.125rem] uppercase">
                        {{ __('pages/home.presentation_of_the_menu') }}
                    </h2>
                    <p class="text-[0.875rem] leading-[160%] text-body">
                        {{ __('pages/home.presentation_of_the_menu_description') }}
                    </p>
                </div>
                <svg class="w-[3.75rem] h-[3.75rem] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="60"
                    height="60" viewBox="0 0 60 60" fill="none">
                    <path
                        d="M7.5 5H12.5V55H7.5V30V5ZM47.5 5H15V55H47.5C50.2575 55 52.5 52.7575 52.5 50V10C52.5 7.2425 50.2575 5 47.5 5ZM45 30H22.5V25H45V30ZM45 20H22.5V15H45V20Z"
                        fill="#FC1919" />
                    <path d="M7.5 5H12.5V55H7.5V30V5Z" fill="#FE9090" />
                </svg>
            </div>
            <div
                class="flex rounded-[1.25rem] border-[3px] border-[#F6F6F6] h-[21.5rem] min-w-[20.75rem] min-h-[21.5rem] p-[1.875rem] flex-col justify-between items-start flex-1">
                <div class="flex flex-col gap-[1.25rem] items-start self-stretch">
                    <h2 class="font-medium leading-[160%] text-[1.125rem] uppercase">
                        {{ __('pages/home.online_reservation_and_orders') }}
                    </h2>
                    <p class="text-[0.875rem] leading-[160%] text-body">
                        {{ __('pages/home.online_reservation_and_orders_description') }}
                    </p>
                </div>
                <svg class="w-[3.75rem] h-[3.75rem] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="60"
                    height="60" viewBox="0 0 60 60" fill="none">
                    <path
                        d="M1 39.1462V44.2099C1 46.5532 2.90641 48.4597 5.24975 48.4597H20.4864L19.837 52.9419H16.5617V56.3875H19.3377H40.662H43.4381V52.9419H40.1628L39.5134 48.4597H54.75C57.0934 48.4597 58.9998 46.5532 58.9998 44.2099V39.1462H1ZM32.373 45.5259H27.6269V42.0802H32.373V45.5259Z"
                        fill="#FC1919" />
                    <path
                        d="M54.7503 4H5.24975C2.90641 4 1 5.90117 1 8.23794V36H59V8.23794C59 5.90117 57.0936 4 54.7503 4ZM28.2772 31.4185H28.2771H11.2018V10.8724H28.2772V31.4185ZM48.7982 31.4185H31.7228V10.8724H48.7982V31.4185Z"
                        fill="#FE9090" />
                    <path d="M24.8798 13.7871H14.6001V17.2328H24.8798V13.7871Z" fill="#FC1919" />
                    <path d="M24.8798 19.0819H14.6001V22.5276H24.8798V19.0819Z" fill="#FC1919" />
                    <path d="M24.8798 24.3779H14.6001V27.8236H24.8798V24.3779Z" fill="#FC1919" />
                    <path d="M45.4003 13.7871H35.1206V17.2328H45.4003V13.7871Z" fill="#FC1919" />
                    <path d="M45.4003 19.0819H35.1206V22.5276H45.4003V19.0819Z" fill="#FC1919" />
                    <path d="M45.4003 24.3779H35.1206V27.8236H45.4003V24.3779Z" fill="#FC1919" />
                </svg>
            </div>
            <div
                class="flex rounded-[1.25rem] border-[3px] border-[#F6F6F6] h-[21.5rem] min-w-[20.75rem] min-h-[21.5rem] p-[1.875rem] flex-col justify-between items-start flex-1">
                <div class="flex flex-col gap-[1.25rem] items-start self-stretch">
                    <h2 class="font-medium leading-[160%] text-[1.125rem] uppercase">
                        {{ __('pages/home.customers_reviews_and_testimonials') }}
                    </h2>
                    <p class="text-[0.875rem] leading-[160%] text-body">
                        {{ __('pages/home.customers_reviews_and_testimonials_description') }}
                    </p>
                </div>
                <svg class="w-[3.75rem] h-[3.75rem] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="60"
                    height="60" viewBox="0 0 60 60" fill="none">
                    <path
                        d="M43.1345 10.6575L35.2753 9.51558L31.7606 2.39397C31.0439 0.94167 28.9674 0.94249 28.251 2.39397L24.7363 9.51558L16.8771 10.6575C15.2745 10.8903 14.6336 12.8655 15.7927 13.9953L21.4797 19.5387L20.137 27.3662C19.8632 28.962 21.5436 30.1826 22.9764 29.4291L30.0058 25.7336L37.0351 29.4291C38.4563 30.1764 40.1503 28.9746 39.8745 27.3662L38.532 19.5387L44.219 13.9953C45.3788 12.8648 44.7362 10.8903 43.1345 10.6575Z"
                        fill="#FC1919" />
                    <path
                        d="M14.1135 29.7319H1.95691C0.876211 29.7319 0 30.608 0 31.6887V56.738C0 57.8187 0.876211 58.6949 1.95691 58.6949H14.1135C15.1942 58.6949 16.0704 57.8188 16.0704 56.738V31.6887C16.0704 30.608 15.1942 29.7319 14.1135 29.7319Z"
                        fill="#FE9090" />
                    <path
                        d="M58.7237 38.2386C56.6054 35.5686 52.718 35.1805 50.1156 37.3644L40.8446 45.1436C37.9384 45.1436 35.6307 45.1436 32.9723 45.1436L37.1837 41.6098C40.3877 38.9214 38.6339 33.5293 34.2682 33.5293H19.9844V56.8162C21.0269 57.6591 22.3328 58.1233 23.6753 58.1233H42.0149C43.3927 58.1233 44.7327 57.6357 45.7885 56.75L57.8085 46.6647C60.3243 44.5535 60.7352 40.7736 58.7237 38.2386Z"
                        fill="#FC1919" />
                </svg>
            </div>
            <div
                class="flex bg-[#FC1010] rounded-[1.25rem] border-[3px] border-[#F6F6F6] h-[21.5rem] min-w-[20.75rem] min-h-[21.5rem] p-[1.875rem] flex-col justify-between items-start flex-1">
                <div class="flex flex-col gap-[1.25rem] items-start self-stretch">
                    <h2 class="font-medium leading-[160%] text-[1.125rem] uppercase text-white">
                        {{ __('pages/home.are_you_unsure') }}
                    </h2>
                    <p class="text-[0.875rem] leading-[160%] text-white">
                        {{ __('pages/home.are_you_unsure_description') }}
                    </p>
                </div>
                <button
                    class="rounded-[22.1875rem] p-[1.125rem_2.875rem] flex items-center justify-center gap-[1.5rem] bg-white hover:bg-white/80 text-[#FC1919] font-medium text-[1.25rem] tracking-[0.0625rem] leading-[120%]">
                    {{ __('pages/home.contact') }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-[1.5px] w-[0.8rem] h-[0.8rem]"
                        width="11" height="10" viewBox="0 0 11 10" fill="#FC1919">
                        <path
                            d="M0.46967 8.71967C0.176777 9.01256 0.176777 9.48744 0.46967 9.78033C0.762563 10.0732 1.23744 10.0732 1.53033 9.78033L0.46967 8.71967ZM10.25 0.75C10.25 0.335786 9.91421 0 9.5 0H2.75C2.33579 0 2 0.335786 2 0.75C2 1.16421 2.33579 1.5 2.75 1.5H8.75V7.5C8.75 7.91421 9.08579 8.25 9.5 8.25C9.91421 8.25 10.25 7.91421 10.25 7.5V0.75ZM1.53033 9.78033L10.0303 1.28033L8.96967 0.21967L0.46967 8.71967L1.53033 9.78033Z"
                            fill="#FC1919" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div id="prices"
        class="relative overflow-hidden self-stretch items-center flex w-full flex-col p-[6.25rem_0.875rem] tablet:p-[6.25rem_2.5rem] big-tablet:p-[6.25rem_3.75rem] desktop:p-[6.25rem_6rem] gap-[3.75rem] bg-black">
        <svg xmlns="http://www.w3.org/2000/svg"
            class="absolute -z-0 inset-0 tablet:right-0 tablet:inset-auto tablet:inset-y-0" width="393"
            height="694" viewBox="0 0 393 694" fill="none">
            <g opacity="0.1">
                <path
                    d="M-526.206 808.556C-507.47 767.966 -496.209 739.09 -471.624 703.94C-439.957 658.664 -401.096 626.156 -358.422 603.448C-277.098 560.175 -190.333 547.476 -105.563 523.018C31.8583 483.367 155.679 403.253 259.941 274.976C325.367 194.481 379.089 97.9038 431.205 2"
                    stroke="white" stroke-width="3" stroke-linecap="round" />
                <path
                    d="M-526.206 923.778C-507.47 883.188 -496.209 854.312 -471.624 819.162C-439.957 773.886 -401.096 741.378 -358.422 718.67C-277.098 675.397 -190.333 662.699 -105.563 638.24C31.8583 598.589 155.679 518.475 259.941 390.199C325.367 309.703 379.089 213.126 431.205 117.222"
                    stroke="white" stroke-width="3" stroke-linecap="round" />
                <path
                    d="M-526.206 1015.56C-507.47 974.966 -496.209 946.09 -471.624 910.94C-439.957 865.664 -401.096 833.156 -358.422 810.448C-277.098 767.175 -190.333 754.476 -105.563 730.018C31.8583 690.367 155.679 610.253 259.941 481.976C325.367 401.481 379.089 304.904 431.205 209"
                    stroke="white" stroke-width="3" stroke-linecap="round" />
                <path
                    d="M-526.206 1110.12C-507.47 1069.54 -496.209 1040.66 -471.624 1005.51C-439.957 960.233 -401.096 927.725 -358.422 905.017C-277.098 861.744 -190.333 849.046 -105.563 824.587C31.8583 784.936 155.679 704.822 259.941 576.546C325.367 496.05 379.089 399.473 431.205 303.569"
                    stroke="white" stroke-width="3" stroke-linecap="round" />
            </g>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" class="hidden absolute -z-0 tablet:block isnet-y-0 left-0"
            width="240" height="769" viewBox="0 0 240 769" fill="none">
            <g opacity="0.06">
                <path
                    d="M240 769L1.86895 769L1.86895 745.101L32.159 745.101C20.7734 737.565 12.1804 727.984 6.38022 716.357C0.580018 704.515 -2.32008 690.951 -2.32008 675.664C-2.32008 662.53 0.0429597 650.257 4.76905 638.846C9.49516 627.435 16.0472 617.638 24.4253 609.456C32.5886 601.059 42.363 594.492 53.7486 589.756C64.9194 585.019 77.0569 582.65 90.1611 582.65C103.265 582.65 115.403 585.126 126.574 590.078C137.744 594.815 147.519 601.382 155.897 609.779C164.06 618.176 170.505 628.08 175.231 639.492C179.957 650.903 182.32 663.176 182.32 676.31C182.32 691.166 179.42 704.407 173.62 716.034C167.82 727.661 159.227 737.35 147.841 745.101L240 745.101L240 769ZM160.408 676.633C160.408 666.728 158.69 657.578 155.252 649.181C151.6 640.568 146.66 633.14 140.43 626.896C134.2 620.652 126.896 615.808 118.518 612.363C109.925 608.703 100.687 606.873 90.8056 606.873C80.4941 606.873 71.0419 608.703 62.449 612.363C53.6412 615.808 46.1224 620.652 39.8926 626.896C33.4479 633.14 28.507 640.568 25.0698 649.181C21.4178 657.793 19.5918 667.267 19.5918 677.601C19.5918 687.29 21.4178 696.333 25.0698 704.73C28.7218 713.127 33.7701 720.448 40.2148 726.692C46.4447 732.936 53.8561 737.888 62.449 741.548C71.0419 744.993 80.2793 746.716 90.1611 746.716C100.043 746.716 109.28 744.993 117.873 741.548C126.466 737.888 133.985 732.936 140.43 726.692C146.66 720.233 151.6 712.804 155.252 704.407C158.69 695.795 160.408 686.537 160.408 676.633Z"
                    fill="white" />
                <path
                    d="M178.131 548.855L1.86894 548.855L1.86894 524.956L27.0032 524.956C22.2771 522.588 18.1955 519.896 14.7583 516.882C11.1063 513.652 8.0988 510.1 5.73575 506.224C3.37271 502.133 1.54671 497.504 0.25777 492.337C-1.03116 487.169 -1.89045 481.356 -2.32009 474.897L21.203 474.897C22.9216 491.691 28.2921 504.286 37.3147 512.683C46.1224 520.865 58.797 524.956 75.3383 524.956L178.131 524.956L178.131 548.855Z"
                    fill="white" />
                <path
                    d="M178.131 451.714L1.86893 451.714L1.86893 427.815L178.131 427.815L178.131 451.714ZM-19.3985 451.714L-60 451.714L-60 427.815L-19.3985 427.815L-19.3985 451.714Z"
                    fill="white" />
                <path
                    d="M126.251 238.172L126.251 211.044C145.371 221.378 159.549 233.543 168.786 247.538C177.809 261.533 182.32 278.22 182.32 297.598C182.32 311.162 179.957 323.865 175.231 335.707C170.505 347.334 163.953 357.454 155.575 366.066C147.197 374.678 137.422 381.46 126.251 386.412C114.866 391.365 102.621 393.841 89.5166 393.841C76.6273 393.841 64.5972 391.365 53.4264 386.413C42.2556 381.46 32.5886 374.786 24.4253 366.389C16.0472 357.776 9.49514 347.765 4.76904 336.353C0.0429455 324.727 -2.3201 312.346 -2.3201 299.213C-2.3201 279.189 2.83564 261.318 13.1471 245.601C23.4586 229.883 37.5295 218.472 55.3598 211.367L55.3598 238.172C43.7594 245.062 34.9516 253.782 28.9366 264.333C22.7067 274.667 19.5918 286.402 19.5918 299.535C19.5918 309.44 21.4178 318.698 25.0698 327.31C28.7218 335.707 33.7701 343.028 40.2148 349.272C46.4447 355.516 53.8561 360.468 62.449 364.128C71.0419 367.788 80.2792 369.618 90.1611 369.618C100.043 369.618 109.28 367.788 117.873 364.128C126.251 360.468 133.663 355.408 140.107 348.949C146.337 342.49 151.278 334.954 154.93 326.341C158.582 317.729 160.408 308.471 160.408 298.567C160.408 285.863 157.83 274.99 152.675 265.947C147.519 256.689 138.711 247.431 126.251 238.172Z"
                    fill="white" />
                <path
                    d="M120.129 30.3585L120.129 5.49029C129.366 8.7199 137.852 13.2414 145.585 19.0548C153.104 24.8681 159.656 31.5427 165.242 39.0785C170.612 46.399 174.801 54.5807 177.809 63.6236C180.816 72.4513 182.32 81.7095 182.32 91.3984C182.32 104.532 179.957 116.805 175.231 128.216C170.29 139.412 163.63 149.209 155.252 157.606C146.874 166.003 137.1 172.677 125.929 177.63C114.543 182.366 102.299 184.735 89.1944 184.735C76.305 184.735 64.3824 182.366 53.4264 177.63C42.2556 172.893 32.5886 166.434 24.4253 158.252C16.0472 150.07 9.49514 140.381 4.76903 129.185C0.0429365 117.989 -2.32011 106.039 -2.32011 93.3363C-2.32011 80.6331 0.150352 68.6834 5.09128 57.4873C9.81737 46.076 16.262 36.1718 24.4253 27.7748C32.5886 19.1624 42.1482 12.3802 53.1042 7.4281C64.0601 2.47595 75.6605 -6.69651e-05 87.9055 -6.75003e-05C89.624 -6.75754e-05 91.3426 0.107598 93.0612 0.32293C94.565 0.538201 96.1761 0.861199 97.8947 1.2918L97.8947 160.836C106.702 160.405 114.866 158.252 122.385 154.376C129.903 150.501 136.563 145.549 142.363 139.52C147.948 133.276 152.352 126.063 155.575 117.881C158.797 109.7 160.408 101.087 160.408 92.0444C160.408 78.48 156.756 66.0997 149.452 54.9037C141.933 43.4923 132.159 35.3105 120.129 30.3585ZM76.305 160.19L76.305 24.8681C58.6895 28.9589 44.8335 37.1407 34.7368 49.4133C24.6401 61.4705 19.5918 76.1116 19.5918 93.3363C19.5918 101.733 20.9882 109.7 23.7809 117.235C26.3587 124.556 30.2255 131.123 35.3813 136.936C40.3222 142.75 46.3372 147.702 53.4264 151.793C60.3007 155.668 67.9269 158.467 76.305 160.19Z"
                    fill="white" />
            </g>
        </svg>
        <div
            class="flex mx-auto max-w-[92.5rem] p-[0rem_0.875rem] tablet:p-[0rem_3.75rem] flex-col items-center gap-[3.75rem] self-stretch">
            <div class="flex flex-col items-center self-stretch gap-[3.75rem]">
                <div class="flex flex-col items-center gap-[1.875rem] self-stretch">
                    <h3 class="relative text-[1.875rem] font-alt font-bold text-white leading-[120%]">
                        {{ __('pages/home.price') }}
                        <svg class="absolute -bottom-4 -left-14 w-[3.26675rem] h-[3.26675rem]"
                            xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 65 65"
                            fill="none">
                            <g clip-path="url(#clip0_1_2005)">
                                <path
                                    d="M17.0707 53.0158L46.216 45.2175C46.5053 45.137 46.7669 44.9782 46.9719 44.7587C47.1769 44.5392 47.3174 44.2674 47.378 43.9732L50.0841 30.7815C50.1362 30.5314 50.129 30.2726 50.0629 30.0258C49.9969 29.7791 49.8739 29.5512 49.7038 29.3606L40.7369 19.2809C40.5342 19.0782 40.2817 18.9324 40.0047 18.8582C39.7278 18.7839 39.4362 18.7839 39.1592 18.8582L10.014 26.6565C9.60164 26.7694 9.25002 27.0394 9.03456 27.4086C8.9828 27.5409 8.94593 27.6784 8.92465 27.8188C8.85309 28.0974 8.85638 28.39 8.93416 28.6669L15.0814 51.8571C15.1929 52.2738 15.4646 52.6294 15.8372 52.8465C16.2099 53.0636 16.6533 53.1244 17.0707 53.0158Z"
                                    fill="#F1F1F1" fill-opacity="0.38" />
                                <path
                                    d="M42.3422 38.7853L52.035 27.8547C52.205 27.6642 52.3279 27.4365 52.394 27.1899C52.4601 26.9433 52.4674 26.6847 52.4155 26.4347L49.4866 12.1221C49.4252 11.8268 49.2833 11.5542 49.0765 11.3346C48.8697 11.1151 48.6061 10.957 48.315 10.8781L16.7608 2.42318C16.3424 2.31106 15.8965 2.36976 15.5214 2.58636C15.1462 2.80295 14.8725 3.15971 14.7604 3.57814L7.99643 28.8215C7.88431 29.2399 7.94301 29.6857 8.15961 30.0609C8.3762 30.4361 8.73296 30.7098 9.1514 30.8219L40.7055 39.2768C40.9971 39.354 41.3044 39.349 41.5933 39.2622C41.8822 39.1754 42.1414 39.0104 42.3422 38.7853Z"
                                    fill="#FC1919" />
                                <path
                                    d="M36.6215 22.9637C35.921 25.5778 37.4723 28.2647 40.0864 28.9651C42.7004 29.6655 45.3873 28.1142 46.0877 25.5002C46.7881 22.8862 45.2369 20.1993 42.6228 19.4989C40.0088 18.7984 37.3219 20.3497 36.6215 22.9637Z"
                                    fill="black" />
                                <path
                                    d="M28.3101 22.4277L30.4238 14.5392C30.5359 14.1207 30.8097 13.764 31.1848 13.5474C31.56 13.3308 32.0058 13.2721 32.4242 13.3842C32.8427 13.4963 33.1994 13.7701 33.416 14.1452C33.6326 14.5204 33.6913 14.9662 33.5792 15.3847L31.4655 23.2732C31.3534 23.6916 31.0796 24.0484 30.7045 24.265C30.3293 24.4816 29.8835 24.5403 29.465 24.4282C29.0466 24.316 28.6898 24.0423 28.4732 23.6671C28.2566 23.292 28.1979 22.8461 28.3101 22.4277Z"
                                    fill="#F1F1F1" fill-opacity="0.2" />
                                <path
                                    d="M21.5199 25.6812L24.9018 13.0595C25.0139 12.6411 25.2877 12.2844 25.6628 12.0678C26.038 11.8512 26.4838 11.7925 26.9023 11.9046C27.3207 12.0167 27.6775 12.2905 27.8941 12.6656C28.1107 13.0408 28.1694 13.4866 28.0572 13.905L24.6753 26.5267C24.5632 26.9451 24.2894 27.3019 23.9142 27.5185C23.5391 27.7351 23.0933 27.7938 22.6748 27.6817C22.2564 27.5695 21.8996 27.2958 21.683 26.9206C21.4664 26.5455 21.4077 26.0996 21.5199 25.6812Z"
                                    fill="black" />
                                <path
                                    d="M15.9979 24.2016L19.3798 11.5799C19.492 11.1615 19.7657 10.8047 20.1409 10.5881C20.516 10.3715 20.9619 10.3129 21.3803 10.425C21.7987 10.5371 22.1555 10.8108 22.3721 11.186C22.5887 11.5612 22.6474 12.007 22.5353 12.4254L19.1533 25.0471C19.0412 25.4655 18.7674 25.8223 18.3923 26.0389C18.0171 26.2555 17.5713 26.3142 17.1528 26.202C16.7344 26.0899 16.3777 25.8162 16.1611 25.441C15.9445 25.0659 15.8858 24.62 15.9979 24.2016Z"
                                    fill="black" />
                                <path
                                    d="M44.4817 25.0698C44.5938 24.6514 44.8512 24.2902 45.1973 24.0659C45.5434 23.8415 45.9499 23.7722 46.3272 23.8733L57.7095 26.9232C58.0869 27.0243 58.4042 27.2875 58.5918 27.6549C58.7793 28.0223 58.8217 28.4637 58.7096 28.8822C58.5975 29.3006 58.34 29.6617 57.9939 29.8861C57.6478 30.1105 57.2414 30.1797 56.864 30.0786L45.4817 27.0287C45.1044 26.9276 44.787 26.6644 44.5995 26.2971C44.4119 25.9297 44.3696 25.4882 44.4817 25.0698Z"
                                    fill="black" />
                            </g>
                            <defs>
                                <clipPath id="clip0_1_2005">
                                    <rect width="52.2676" height="52.2676" fill="white"
                                        transform="translate(64.5146 13.5278) rotate(105)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </h3>
                    <h1
                        class="text-white hidden tablet:block text-center laptop:text-[2.5rem] text-[2.125rem] font-bold leading-[120%]">
                        {{ __('pages/home.price_header') }}
                        <span class="text-[#FC1919]">
                            39,99€
                        </span>
                        /Monat Festpreis!
                    </h1>
                </div>
                <p class="font-light leading-[160%] text-[0.875rem] tablet:text-[1rem] text-center text-white">
                    {{ __('pages/home.price_description') }}
                </p>
            </div>
            <div
                class="overflow-hidden tablet:-mb-96 z-10 h-[11.75rem] self-stretch example-image tablet:h-[37.625rem] tablet:order-last">
            </div>
            <button
                class="flex gap-[0.625rem] font-medium leading-[120%] text-[1.25rem] items-center justify-center rounded-[6.25rem] bg-white hover:bg-white/80 p-[1.125rem_2.875rem] text-black">
                {{ __('pages/home.do_you_have_a_question') }}
            </button>
        </div>
    </div>
    <div id="contact"
        class="flex mx-auto my-[5.625rem] tablet:my-[7.5rem] big-tablet:my-[10rem] desktop:my-[11.25rem] max-w-[92.5rem] gap-[3.75rem] items-start flex-col self-stretch p-[0rem_0.875rem] tablet:p-[0rem_2.5rem] big-tablet:p-[0rem_3.75rem]">
        <div class="flex flex-col gap-[1.875rem] self-stretch">
            <div
                class="flex flex-col items-center tablet:flex-row tablet:justify-start gap-[0.625rem] self-stretch justify-center">
                <h3 class="font-alt text-[1.25rem] leading-[120%] tablet:order-last">{{ __('pages/home.contact') }}
                </h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10"
                    fill="#FC1919">
                    <circle cx="5.5" cy="5" r="5" fill="#FC1919" />
                </svg>
            </div>
            <h2
                class="font-bold text-[1.875rem] laptop:w-[29rem] tablet:text-[2.125rem] laptop:text-[2.5rem] text-center tablet:text-left big-tablet:flex big-tablet:flex-col leading-[120%]">
                {{ __('pages/home.contact_us_description') }}
            </h2>
        </div>
        <div class="flex gap-[3.75rem] flex-col big-tablet:flex-row big-tablet:justify-between self-stretch">
            <div class="flex big-tablet:order-last big-tablet:flex-1 flex-col items-center gap-[3.75rem] self-stretch">
                <div class="flex flex-col items-start gap-[2.5rem] self-stretch">
                    <div class="flex flex-col self-stretch items-start">
                        <label for="name"
                            class="text-[0.875rem] font-light tracking-[0.0625rem] leading-[120%] flex p-[0rem_1.25rem] items-start gap-[0.625rem] self-stretch">
                            {{ __('pages/home.enter_your_name') }} ...
                        </label>
                        <div
                            class="flex justify-between p-[1rem_1.25rem] items-center self-stretch border-b border-black">
                            <input type="text" id="name"
                                class="w-full italic border-none text-[1.125rem] bg-transparent font-light text-body leading-[150%] tracking-[0.0625rem] outline-none"
                                placeholder="John Jackson">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17"
                                viewBox="0 0 16 17" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9.12856 3.8355L4.28906 8.675C4.22056 8.744 4.17306 8.831 4.15356 8.926L3.41006 12.4685C3.37556 12.633 3.42606 12.804 3.54456 12.923C3.66256 13.0425 3.83306 13.0945 3.99756 13.0615L7.56906 12.3475C7.66606 12.328 7.75506 12.2805 7.82456 12.2105L12.6641 7.371L9.12856 3.8355ZM9.83556 3.1285L13.3711 6.664L14.2676 5.768C15.2441 4.7915 15.2441 3.2085 14.2676 2.232C13.7986 1.7635 13.1631 1.5 12.5001 1.5C11.8366 1.5 11.2011 1.7635 10.7321 2.232L9.83556 3.1285Z"
                                    fill="#FC1919" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M1.75 15.5H13.75C14.164 15.5 14.5 15.164 14.5 14.75C14.5 14.336 14.164 14 13.75 14H1.75C1.336 14 1 14.336 1 14.75C1 15.164 1.336 15.5 1.75 15.5Z"
                                    fill="#FC1919" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex flex-col self-stretch items-start">
                        <label for="email"
                            class="text-[0.875rem] font-light tracking-[0.0625rem] leading-[120%] flex p-[0rem_1.25rem] items-start gap-[0.625rem] self-stretch">
                            {{ __('pages/home.enter_your_email') }} ...
                        </label>
                        <div
                            class="flex justify-between p-[1rem_1.25rem] items-center self-stretch border-b border-black">
                            <input type="email" id="email"
                                class="w-full italic border-none text-[1.125rem] bg-transparent font-light text-body leading-[150%] tracking-[0.0625rem] outline-none"
                                placeholder="contact.simpleeats@gmail.com">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17"
                                viewBox="0 0 16 17" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9.12856 3.8355L4.28906 8.675C4.22056 8.744 4.17306 8.831 4.15356 8.926L3.41006 12.4685C3.37556 12.633 3.42606 12.804 3.54456 12.923C3.66256 13.0425 3.83306 13.0945 3.99756 13.0615L7.56906 12.3475C7.66606 12.328 7.75506 12.2805 7.82456 12.2105L12.6641 7.371L9.12856 3.8355ZM9.83556 3.1285L13.3711 6.664L14.2676 5.768C15.2441 4.7915 15.2441 3.2085 14.2676 2.232C13.7986 1.7635 13.1631 1.5 12.5001 1.5C11.8366 1.5 11.2011 1.7635 10.7321 2.232L9.83556 3.1285Z"
                                    fill="#FC1919" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M1.75 15.5H13.75C14.164 15.5 14.5 15.164 14.5 14.75C14.5 14.336 14.164 14 13.75 14H1.75C1.336 14 1 14.336 1 14.75C1 15.164 1.336 15.5 1.75 15.5Z"
                                    fill="#FC1919" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex flex-col self-stretch items-start">
                        <label for="phone"
                            class="text-[0.875rem] font-light tracking-[0.0625rem] leading-[120%] flex p-[0rem_1.25rem] items-start gap-[0.625rem] self-stretch">
                            {{ __('pages/home.enter_your_email') }} ...
                        </label>
                        <div
                            class="flex justify-between p-[1rem_1.25rem] items-center self-stretch border-b border-black">
                            <input type="text" id="phone"
                                class="w-full italic border-none text-[1.125rem] bg-transparent font-light text-body leading-[150%] tracking-[0.0625rem] outline-none"
                                placeholder="(___) ___ __ __ __">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17"
                                viewBox="0 0 16 17" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9.12856 3.8355L4.28906 8.675C4.22056 8.744 4.17306 8.831 4.15356 8.926L3.41006 12.4685C3.37556 12.633 3.42606 12.804 3.54456 12.923C3.66256 13.0425 3.83306 13.0945 3.99756 13.0615L7.56906 12.3475C7.66606 12.328 7.75506 12.2805 7.82456 12.2105L12.6641 7.371L9.12856 3.8355ZM9.83556 3.1285L13.3711 6.664L14.2676 5.768C15.2441 4.7915 15.2441 3.2085 14.2676 2.232C13.7986 1.7635 13.1631 1.5 12.5001 1.5C11.8366 1.5 11.2011 1.7635 10.7321 2.232L9.83556 3.1285Z"
                                    fill="#FC1919" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M1.75 15.5H13.75C14.164 15.5 14.5 15.164 14.5 14.75C14.5 14.336 14.164 14 13.75 14H1.75C1.336 14 1 14.336 1 14.75C1 15.164 1.336 15.5 1.75 15.5Z"
                                    fill="#FC1919" />
                            </svg>
                        </div>
                    </div>
                </div>
                <button
                    class="group flex tablet:flex-1 tablet:w-full font-medium leading-[120%] text-[1.25rem] items-center justify-center text-white rounded-[6.25rem] gap-[1.25rem] p-[1.125rem_2.875rem] bg-[#FC1919] hover:bg-[#FC1919]/80">
                    {{ __('pages/home.sent') }}
                    <svg class="group-hover:translate-x-1 transition stroke-[1.5px]"
                        xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                        fill="#fff">
                        <path
                            d="M1.5 5.25C1.08579 5.25 0.75 5.58579 0.75 6C0.75 6.41421 1.08579 6.75 1.5 6.75L1.5 5.25ZM11.0303 6.53033C11.3232 6.23744 11.3232 5.76256 11.0303 5.46967L6.25736 0.696699C5.96447 0.403805 5.48959 0.403805 5.1967 0.696699C4.90381 0.989592 4.90381 1.46447 5.1967 1.75736L9.43934 6L5.1967 10.2426C4.90381 10.5355 4.90381 11.0104 5.1967 11.3033C5.48959 11.5962 5.96447 11.5962 6.25736 11.3033L11.0303 6.53033ZM1.5 6.75L10.5 6.75L10.5 5.25L1.5 5.25L1.5 6.75Z"
                            fill="white" />
                    </svg>
                </button>
            </div>
            <div
                class="flex flex-col border-[3px] big-tablet:flex-1 big-tablet:-ml-6 big-tablet:items-start big-tablet:justify-between big-tablet:border-none border-[#F8F8F8] rounded-[1.25rem] p-[1.875rem_1.25rem] justify-center items-center gap-[1.25rem] self-stretch">
                <div class="flex flex-col justify-center items-start gap-[1.25rem]">
                    <div class="flex gap-[1rem] items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M24.7139 28.5137L21.0427 25.4703L8.23442 38.5819H40.8678L28.2954 25.4481L24.7139 28.5137ZM30.1277 24.0565L42.3082 36.7208C42.3779 36.475 42.4277 36.2204 42.4277 35.9514V14.0615L30.1277 24.0565ZM7 14.0105V35.9514C7 36.2204 7.04982 36.475 7.11957 36.7208L19.341 24.0975L7 14.0105ZM41.3206 12H8.10712L24.7139 25.3064L41.3206 12Z"
                                fill="black" />
                        </svg>
                        <div class="flex flex-col justify-center items-start gap-[0.125rem]">
                            <span
                                class="font-bold text-[1.125rem] tracking-[0.0625rem]">contact.simpleeats@gmail.com</span>
                            <span
                                class="text-body text-[0.75rem] tracking-[0.0625rem]">{{ __('pages/home.we_respond_within') }}
                                <span class="font-bold">24 hrs</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="questions"
        class="mx-auto w-full flex p-[6.25rem_0rem] flex-col justify-center items-center gap-[0.625rem] self-stretch bg-[#F8F8F8]">
        <div
            class="mx-auto flex gap-[3.75rem] self-stretch p-[0rem_0.875rem] tablet:p-[0rem_2.5rem] big-tablet:p-[0rem_3.75rem] tablet:gap-[5.625rem] flex-col max-w-[92.5rem] justify-center items-center">
            <div class="flex flex-col gap-[1.875rem] self-stretch">
                <div
                    class="flex flex-col items-center tablet:flex-row tablet:justify-start gap-[0.625rem] self-stretch justify-center">
                    <h3 class="font-alt text-[1.25rem] leading-[120%] tablet:order-last">Q.&A.</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10"
                        fill="#FC1919">
                        <circle cx="5.5" cy="5" r="5" fill="#FC1919" />
                    </svg>
                </div>
                <h2
                    class="font-bold text-[1.875rem] tablet:text-[2.125rem] laptop:text-[2.5rem] text-center tablet:text-left leading-[120%]">
                    {{ __('pages/home.questions_and_answers') }}
                </h2>
            </div>
            <div class="flex flex-wrap text-center gap-[3.75rem] self-stretch content-start items-start">
                <div
                    class="flex min-w-[20.75rem] text-center flex-col gap-[1.875rem] flex-1 items-center tablet:items-start tablet:text-left">
                    <h3 class="text-[#FC1919] text-[1.25rem] font-bold leading-[120%]">01</h3>
                    <div class="flex flex-col gap-[1.5rem] self-stretch items-start">
                        <h2 class="font-medium text-[1.25rem] leading-[120%] uppercase">
                            {{ __('pages/home.why_in_good_hands') }}
                        </h2>
                        <p class="text-body font-light leading-[160%]">
                            {{ __('pages/home.why_in_good_hands_description') }}
                        </p>
                    </div>
                </div>
                <div
                    class="flex min-w-[20.75rem] text-center flex-col gap-[1.875rem] flex-1 items-center tablet:items-start tablet:text-left">
                    <h3 class="text-[#FC1919] text-[1.25rem] font-bold leading-[120%]">02</h3>
                    <div class="flex flex-col gap-[1.5rem] self-stretch items-start">
                        <h2 class="font-medium text-[1.25rem] leading-[120%] uppercase">
                            {{ __('pages/home.what_if_i_dont_like_it_or_go_bankrupt') }}
                        </h2>
                        <p class="text-body font-light leading-[160%]">
                            {{ __('pages/home.what_if_i_dont_like_it_or_go_bankrupt_description') }}
                        </p>
                    </div>
                </div>
                <div
                    class="flex min-w-[20.75rem] text-center flex-col gap-[1.875rem] flex-1 items-center tablet:items-start tablet:text-left">
                    <h3 class="text-[#FC1919] text-[1.25rem] font-bold leading-[120%]">03</h3>
                    <div class="flex flex-col gap-[1.5rem] self-stretch items-start">
                        <h2 class="font-medium text-[1.25rem] text-center leading-[120%] uppercase">
                            {{ __('pages/home.how_does_my_company_benefit') }}
                        </h2>
                        <p class="text-body font-light text-center leading-[160%]">
                            {{ __('pages/home.how_does_my_company_benefit_description') }}
                        </p>
                    </div>
                </div>
            </div>
            <button
                class="flex font-medium leading-[120%] text-[1.25rem] items-center justify-center text-white rounded-[6.25rem] gap-[1.25rem] p-[1.125rem_2.875rem] bg-[#FC1919] hover:bg-[#FC1919]/80">
                {{ __('pages/home.ask_us_what') }}
            </button>
        </div>
    </div>
    <div id="about"
        class="mx-auto flex big-tablet:flex-row big-tablet:gap-[5.625rem] big-tablet:items-center big-tablet:content-center flex-col my-[5.625rem] tablet:my-[7.5rem] big-tablet:my-[10rem] desktop:my-[11.25rem] max-w-[92.5rem] p-[0rem_0.875rem] tablet:p-[0rem_3.75rem] items-start gap-[0.625rem] self-stretch">
        <div
            class="mx-auto flex flex-col big-tablet:items-start items-center flex-1 gap-[3.75rem] p-[2.5rem_0rem] min-w-[20.75rem] max-w-[47.5rem]">
            <div class="flex flex-col gap-[1.875rem] self-stretch">
                <div
                    class="flex flex-col items-center tablet:flex-row tablet:justify-start gap-[0.625rem] self-stretch justify-center">
                    <h3 class="big-tablet:hidden font-alt text-[1.25rem] leading-[120%] tablet:order-last">about us
                    </h3>
                    <h3 class="hidden big-tablet:block font-alt text-[1.25rem] leading-[120%] tablet:order-last">
                        {{ __('pages/home.about_us') }}
                    </h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10"
                        fill="#FC1919">
                        <circle cx="5.5" cy="5" r="5" fill="#FC1919" />
                    </svg>
                </div>
                <h2
                    class="font-bold text-[1.875rem] tablet:text-[2.125rem] laptop:text-[2.5rem] text-center tablet:text-left leading-[120%]">
                    {{ __('pages/home.about_us_header') }}
                </h2>
            </div>
            <div class="big-tablet:hidden image-laptop self-stretch h-[15.625rem] tablet:h-[26.0625rem]"></div>
            <div class="flex flex-col gap-[1.875rem] self-stretch">
                <p class="text-[1.25rem] font-medium uppercase text-center tablet:text-left">
                    {{ __('pages/home.about_us_header_description') }}
                </p>
                <p class="text-[#808080] text-center text-[0.875rem] capitalize tablet:text-left">
                    {{ __('pages/home.about_us_header_subtext') }}
                </p>
            </div>
            <div class="flex flex-col tablet:flex-row gap-[1rem] items-center">
                <a href="#contact"
                    class="flex text-white rounded-[22.1875rem] gap-[1.5rem] justify-center items-center p-[1.125rem_2.875rem] bg-[#FC1919] hover:bg-[#FC1919]/80">
                    {{ __('pages/home.contact') }}
                    <svg class="stroke-[1.5px]" xmlns="http://www.w3.org/2000/svg" width="11" height="10"
                        viewBox="0 0 11 10" fill="#fff">
                        <path
                            d="M0.71967 8.71967C0.426777 9.01256 0.426777 9.48744 0.71967 9.78033C1.01256 10.0732 1.48744 10.0732 1.78033 9.78033L0.71967 8.71967ZM10.5 0.75C10.5 0.335786 10.1642 0 9.75 0H3C2.58579 0 2.25 0.335786 2.25 0.75C2.25 1.16421 2.58579 1.5 3 1.5H9V7.5C9 7.91421 9.33579 8.25 9.75 8.25C10.1642 8.25 10.5 7.91421 10.5 7.5V0.75ZM1.78033 9.78033L10.2803 1.28033L9.21967 0.21967L0.71967 8.71967L1.78033 9.78033Z"
                            fill="white" />
                    </svg>
                </a>
                <a href="/agb"
                    class="text-[#FC1919] underline hover:text-[#FC1919]/80 text-[0.875rem] tablet:text-[1rem]">
                    AGB (Allgemeine Geschäftsbedingungen)
                </a>
            </div>
        </div>
        <div class="image-laptop self-stretch big-tablet:block flex-1 h-[36.1875rem] min-w-[20.75rem]"></div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle smooth scrolling for all anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    // Close drawer if it's open
                    const drawer = document.getElementById('drawer');
                    if (drawer && drawer.classList.contains('open')) {
                        drawer.classList.remove('open');
                    }
                }
            });
        });
    });
</script>
