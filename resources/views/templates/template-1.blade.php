@php
  $header = data_get($page_data, 'header');
  $hero = data_get($page_data, 'hero_section');
  $about_us = data_get($page_data, 'about_us_section');
  $menu = data_get($page_data, 'menu_section');
  $gallery = data_get($page_data, 'gallery_section');
//  dd([
//	  "header" => $header,
//	  "hero" => $hero,
//	  "gallery" => $gallery
//  ]);
@endphp
<section id='template-1'>
  @if(data_get($hero, 'is_bg_image_visible'))
  <div
    style='
      background-image: url("{{ asset('/storage/' . data_get($hero, 'background_image')) }}");
      background-size: cover;
      background-position: 50%;
      background-repeat: no-repeat;
    '
  @else
    <div
  @endif
    class="hero flex flex-col justify-between items-center self-stretch p-[2.5rem_0.875rem_1.25rem_0.875rem] tablet:p-[2.5rem_2.5rem_1.25rem_2.5rem] big-tablet:p-[2.5rem_4.375rem_1.25rem_4.375rem] min-h-screen max-w-[100vw]">
    <header class="flex w-full justify-between items-center pb-[2.5rem] self-stretch">
      <div class="tablet:flex items-center justify-start laptop:gap-[5rem]">
        <div class="hidden tablet:flex flex-col justify-center items-start">
          @if($image = data_get($header, 'header_logo'))
            <a href=''>
              <img
                src='{{ asset('/storage/' . $image) }}'
                style='width: 200px; height: auto'
                alt='App Logo'>
            </a>
          @else
            <h1>{{ config('app.name') }}</h1>
          @endif
        </div>
        <div class="hidden laptop:flex gap-[0.875rem] items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
            <path
              d="M4.87911 15.4255C3.65457 13.2903 3.06331 11.5467 2.7068 9.7794C2.17952 7.16554 3.38618 4.61221 5.38512 2.98299C6.22996 2.29441 7.19843 2.52967 7.69801 3.42593L8.82587 5.44934C9.71984 7.05315 10.1668 7.85505 10.0782 8.70522C9.98951 9.5554 9.38669 10.2478 8.18106 11.6327L4.87911 15.4255ZM4.87911 15.4255C7.35766 19.7473 11.2473 23.6391 15.5741 26.1205M15.5741 26.1205C17.7093 27.345 19.4528 27.9363 21.2202 28.2928C23.8341 28.8201 26.3874 27.6134 28.0166 25.6145C28.7052 24.7696 28.4699 23.8012 27.5737 23.3016L25.5503 22.1737C23.9464 21.2798 23.1445 20.8328 22.2944 20.9214C21.4442 21.0101 20.7518 21.6129 19.3669 22.8185L15.5741 26.1205Z"
              stroke="white" stroke-width="1.5" stroke-linejoin="round" />
            <path
              d="M18.083 8.82439C19.9214 9.60506 21.3946 11.0782 22.1753 12.9166M18.9278 2.58325C23.4967 3.90173 27.0977 7.50259 28.4163 12.0714"
              stroke="white" stroke-width="1.5" stroke-linecap="round" />
          </svg>
          <div class="flex w-full flex-col items-start justify-center gap-[0.25rem]">
            <span class="uppercase text-[0.5rem] font-light tracking-[0.0625rem]">CALL US</span>
            {{-- Contact Number --}}
            <span class="text-[1] font-semibold">
              {{ data_get($header, 'contact_number') }}
            </span>
            <span class="text-[0.625rem] tracking-[0.0625rem] font-thin">
              {{ data_get($header, 'operating_hours') }}
            </span>
          </div>
        </div>
        <div class="hidden desktop:flex gap-[0.875rem] items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="28" viewBox="0 0 23 28" fill="none">
            <path
              d="M1.29199 11.4708C1.29199 18.5464 7.48185 24.3976 10.2216 26.6409C10.6138 26.962 10.8122 27.1244 11.1047 27.2068C11.3325 27.2709 11.6677 27.2709 11.8955 27.2068C12.1886 27.1243 12.3856 26.9634 12.7792 26.6412C15.519 24.3978 21.7085 18.547 21.7085 11.4715C21.7085 8.79381 20.6331 6.22549 18.7186 4.33209C16.8042 2.4387 14.2079 1.375 11.5004 1.375C8.79303 1.375 6.19638 2.43886 4.28194 4.33225C2.36751 6.22565 1.29199 8.79316 1.29199 11.4708Z"
              stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path
              d="M8.58366 10.125C8.58366 11.7358 9.8895 13.0417 11.5003 13.0417C13.1112 13.0417 14.417 11.7358 14.417 10.125C14.417 8.51417 13.1112 7.20833 11.5003 7.20833C9.8895 7.20833 8.58366 8.51417 8.58366 10.125Z"
              stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <div class="flex w-full flex-col items-start justify-center gap-[0.25rem]">
            <span class="uppercase text-[0.5rem] font-light tracking-[0.0625rem]">VISIT US</span>
            <span class="text-[1] font-semibold">
              {{ data_get($header, 'contact_number') }}
            </span>
            <span class="text-[0.625rem] tracking-[0.0625rem] font-thin">
              {{ data_get($header, 'operating_hours') }}
            </span>
          </div>
        </div>
      </div>
      <div class="flex flex-[1_0_0] items-center tablet:justify-end z-10 tablet:gap-[3.75rem]">
        <div class="hidden items-center big-tablet:flex gap-[1.25rem] flex-end">
          @foreach(data_get($header, ['nav_links']) as $link)
            @php
              $label = data_get($link, 'label');
              if ($label === null) {
                  continue;
              }
            @endphp
            <a href="{{ data_get($link, 'url') }}"
               class="group scroll-link hidden big-tablet:flex w-[7.1875rem] h-[3.6875rem] relative items-center justify-center text-center hover:text-white/80 transition-colors text-[1rem] font-semibold tracking-[0.03125rem]">
              {{ $label }}
              <svg xmlns="http://www.w3.org/2000/svg"
                   class="group-hover:rotate-[5deg] transition-transform absolute inset-0 top-4 left-2" width="105"
                   height="41" viewBox="0 0 105 41" fill="none">
                <path opacity="0.4"
                      d="M104.022 13.5773C104.341 15.851 103.378 18.2964 101.141 20.8089C98.9074 23.3184 95.4703 25.8129 91.0505 28.1381C82.217 32.7854 69.6085 36.6785 55.3231 38.6862C41.0376 40.6939 27.8445 40.427 18.0722 38.3945C13.1827 37.3776 9.19118 35.9272 6.35206 34.1307C3.50944 32.332 1.90968 30.2468 1.59013 27.9731C1.27058 25.6994 2.23362 23.2541 4.47033 20.7415C6.70427 18.232 10.1414 15.7376 14.5611 13.4123C23.3947 8.76503 36.0031 4.87194 50.2886 2.86425C64.5741 0.856558 77.7672 1.12347 87.5395 3.15588C92.429 4.17278 96.4205 5.62319 99.2596 7.41971C102.102 9.21845 103.702 11.3036 104.022 13.5773Z"
                      stroke="white" stroke-width="1.5" />
              </svg>
            </a>
          @endforeach
        </div>
        @if(data_get($header, 'is_search_visible'))
          <div class="flex w-full tablet:w-auto items-center justify-between tablet:gap-[1.25rem] tablet:justify-end">
            <button class="flex z-10 items-center justify-center tablet:gap-[1.5rem]">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                <path
                  d="M16.6725 17.1412L21 21.5M19 11.5C19 15.9183 15.4183 19.5 11 19.5C6.58172 19.5 3 15.9183 3 11.5C3 7.08172 6.58172 3.5 11 3.5C15.4183 3.5 19 7.08172 19 11.5Z"
                  stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </button>
            <button id="drawer-button"
                    class="flex -mb-3 tablet:mb-0 big-tablet:hidden z-10 items-center justify-center tablet:gap-[1.5rem]">
              <svg xmlns="http://www.w3.org/2000/svg" widsth="18" height="15" viewBox="0 0 18 15" fill="none">
                <path d="M17 1.5H1M17 7.5H7M17 13.5H12" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
              </svg>
            </button>
          </div>
        @endif
      </div>
    </header>
    {{-- START Hero Section --}}
    @if(data_get($hero, 'is_visible'))
      <div class="flex flex-col items-center self-stretch gap-[1.875rem]">
        <div class="flex flex-col self-stretch items-center gap-[0.625rem]">
        <span class="font-mea text-[#E1BC84] text-[1.25rem] tablet:text-[2.5rem] desktop:text-[3.5rem] text-center">
          @if($greeting = data_get($hero, 'greeting', '&nbsp;'))
            @if($greeting !== '&nbsp;')
              {{ $greeting }}
            @else
              {!! $greeting !!}
            @endif
          @endif
        </span>
          <h1 class="font-antic text-[3.75rem] tablet:text-[5rem] desktop:text-[6.25rem] self-stretch text-center">
            @if($header = data_get($hero, 'header', '&nbsp;'))
              @if($header !== '&nbsp;')
                {{ $header }}
              @else
                {!! $header !!}
              @endif
            @endif
          </h1>
          <p class="tracking-[0.0625rem] leading-[170%] text-[0.875rem] desktop:text-[1rem] text-center flex flex-col">
            {!! data_get($hero, 'subtext', '&nbsp;') !!}
          </p>
        </div>
        @if(data_get($hero, 'is_contact_us_visible') && (data_get($hero, 'contact_us_title') || data_get($hero, 'contact_us_link')))
          <a href="{{ data_get($hero, 'contact_us_link', '#')}}"
             class="group scroll-link relative text-[1rem] hover:text-white/80 transition-colors font-semibold flex items-center justify-center text-center w-[10.66488rem] h-[5.08131rem]">
            {{ data_get($hero, 'contact_us_title') }}
            <svg class="group-hover:rotate-[5deg] top-3 transition-transform absolute inset-0"
                 xmlns="http://www.w3.org/2000/svg" width="165" height="61" viewBox="0 0 165 61" fill="none">
              <path
                d="M163.8 24.5135C164.07 28.3656 162.159 32.2543 158.323 36.0027C154.489 39.7493 148.78 43.3042 141.596 46.4671C127.231 52.7912 107.071 57.5033 84.5252 59.0849C61.9789 60.6666 41.3586 58.8154 26.2517 54.5588C18.6961 52.4299 12.547 49.7069 8.22719 46.5324C3.9052 43.3562 1.47003 39.7724 1.1998 35.9204C0.929572 32.0684 2.84052 28.1797 6.67673 24.4312C10.511 20.6846 16.2197 17.1298 23.4041 13.9668C37.7687 7.64277 57.9286 2.93066 80.4748 1.34898C103.021 -0.232704 123.641 1.61857 138.748 5.87511C146.304 8.004 152.453 10.727 156.773 13.9015C161.095 17.0777 163.53 20.6615 163.8 24.5135Z"
                stroke="white" />
            </svg>
            <svg class="group-hover:rotate-[5deg] top-3 transition-transform absolute inset-0"
                 xmlns="http://www.w3.org/2000/svg" width="165" height="60" viewBox="0 0 165 60" fill="none">
              <path opacity="0.4"
                    d="M163.967 32.5299C163.858 36.3899 161.574 40.0719 157.388 43.4253C153.204 46.777 147.174 49.7537 139.713 52.1953C124.797 57.0772 104.271 59.7855 81.6787 59.1441C59.0862 58.5026 38.7476 54.634 24.1321 48.9136C16.8223 46.0526 10.9704 42.7385 6.98351 39.1549C2.99454 35.5694 0.923322 31.7636 1.03292 27.9037C1.14252 24.0437 3.42634 20.3616 7.61233 17.0082C11.7962 13.6566 17.8266 10.6799 25.287 8.23824C40.2035 3.35634 60.7289 0.648038 83.3214 1.28952C105.914 1.93099 126.253 5.79955 140.868 11.52C148.178 14.381 154.03 17.6951 158.017 21.2787C162.006 24.8642 164.077 28.67 163.967 32.5299Z"
                    stroke="white" />
            </svg>
          </a>
        @endif
      </div>
      <svg class="flex" xmlns="http://www.w3.org/2000/svg" width="61" height="61" viewBox="0 0 61 61" fill="none">
        <rect x="1" y="0.933838" width="59" height="59" rx="29.5" stroke="white" stroke-opacity="0.16" />
        <path
          d="M31 23.4338V37.4338M31 37.4338C30.3333 35.2672 28.1 30.9338 24.5 30.9338M31 37.4338C31.6667 35.2672 33.9 30.9338 37.5 30.9338"
          stroke="white" />
      </svg>
      <div class="flex flex-col pt-[0.625rem] items-center gap-[1.875rem] self-stretch">
        <div class="flex justify-center items-center gap-[1.25rem] self-stretch">
          <svg class="tablet:hidden" xmlns="http://www.w3.org/2000/svg" width="104" height="2" viewBox="0 0 104 2"
               fill="none">
            <path opacity="0.6" d="M104 1H-1.35601e-06" stroke="url(#paint0_linear_1_843)" />
            <defs>
              <linearGradient id="paint0_linear_1_843" x1="104" y1="1.5" x2="0" y2="1.5" gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
          <svg class="hidden tablet:block big-tablet:hidden" xmlns="http://www.w3.org/2000/svg" width="254" height="2"
               viewBox="0 0 254 2" fill="none">
            <path opacity="0.6" d="M253.5 1H0" stroke="url(#paint0_linear_1_674)" />
            <defs>
              <linearGradient id="paint0_linear_1_674" x1="253.5" y1="1.5" x2="0" y2="1.5"
                              gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
          <svg class="hidden big-tablet:block laptop:hidden" xmlns="http://www.w3.org/2000/svg" width="352" height="2"
               viewBox="0 0 352 2" fill="none">
            <path opacity="0.6" d="M351.5 1H8.16584e-06" stroke="url(#paint0_linear_1_482)" />
            <defs>
              <linearGradient id="paint0_linear_1_482" x1="351.5" y1="1.5" x2="0" y2="1.5"
                              gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
          <svg class="hidden laptop:block desktop:hidden" xmlns="http://www.w3.org/2000/svg" width="535" height="2"
               viewBox="0 0 535 2" fill="none">
            <path opacity="0.6" d="M534.5 1H2.37226e-05" stroke="url(#paint0_linear_1_285)" />
            <defs>
              <linearGradient id="paint0_linear_1_285" x1="534.5" y1="1.5" x2="0" y2="1.5"
                              gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
          <svg class="hidden desktop:block" xmlns="http://www.w3.org/2000/svg" width="812" height="2"
               viewBox="0 0 812 2" fill="none">
            <path opacity="0.6" d="M811.5 1H2.86102e-05" stroke="url(#paint0_linear_1_78)" />
            <defs>
              <linearGradient id="paint0_linear_1_78" x1="811.5" y1="1.5" x2="0" y2="1.5"
                              gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
          <span class="font-mea text-[1.875rem] text-[#E1BC84] min-w-32">
            We Opened
          </span>
          <svg class="tablet:hidden" xmlns="http://www.w3.org/2000/svg" width="104" height="2" viewBox="0 0 104 2"
               fill="none">
            <path opacity="0.6" d="M0 1H104" stroke="url(#paint0_linear_1_845)" />
            <defs>
              <linearGradient id="paint0_linear_1_845" x1="0" y1="1.5" x2="104" y2="1.5" gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
          <svg class="hidden tablet:block big-tablet:hidden" xmlns="http://www.w3.org/2000/svg" width="254" height="2"
               viewBox="0 0 254 2" fill="none">
            <path opacity="0.6" d="M0.5 1H254" stroke="url(#paint0_linear_1_676)" />
            <defs>
              <linearGradient id="paint0_linear_1_676" x1="0.5" y1="1.5" x2="254" y2="1.5"
                              gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
          <svg class="hidden big-tablet:block laptop:hidden" xmlns="http://www.w3.org/2000/svg" width="352" height="2"
               viewBox="0 0 352 2" fill="none">
            <path opacity="0.6" d="M0.5 1H352" stroke="url(#paint0_linear_1_484)" />
            <defs>
              <linearGradient id="paint0_linear_1_484" x1="0.5" y1="1.5" x2="352" y2="1.5"
                              gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
          <svg class="hidden laptop:block desktop:hidden" xmlns="http://www.w3.org/2000/svg" width="535" height="2"
               viewBox="0 0 535 2" fill="none">
            <path opacity="0.6" d="M0.5 1H535" stroke="url(#paint0_linear_1_287)" />
            <defs>
              <linearGradient id="paint0_linear_1_287" x1="0.5" y1="1.5" x2="535" y2="1.5"
                              gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
          <svg class="hidden desktop:block" xmlns="http://www.w3.org/2000/svg" width="812" height="2"
               viewBox="0 0 812 2" fill="none">
            <path opacity="0.6" d="M811.5 1H2.86102e-05" stroke="url(#paint0_linear_1_78)" />
            <defs>
              <linearGradient id="paint0_linear_1_78" x1="811.5" y1="1.5" x2="0" y2="1.5"
                              gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
        </div>
        <div class="flex h-[4.875rem] laptop:mx-auto justify-center gap-[1.25rem] items-center big-tablet:justify-between laptop:w-[73.75rem] self-stretch">
          @if(data_get($hero, 'weekdays_mobile_day') || data_get($hero, 'weekdays_mobile_operating_hours'))
            <div class="flex flex-col items-center gap-[0.625rem] big-tablet:hidden">
            <span class="font-antic uppercase text-[#AAA] text-[0.875rem] tracking-[0.0625rem]">
              {{ data_get($hero, 'weekdays_mobile_day') }}
            </span>
              <span class="text-[1rem] font-semibold tracking-[0.03125rem]">
              {{ data_get($hero, 'weekdays_mobile_operating_hours') }}
            </span>
              <svg xmlns="http://www.w3.org/2000/svg" width="46" height="7" viewBox="0 0 46 7" fill="none">
                <path
                  d="M0.113249 3.5L3 6.38675L5.88675 3.5L3 0.613249L0.113249 3.5ZM45.8868 3.5L43 0.613252L40.1133 3.5L43 6.38675L45.8868 3.5ZM3.45455 4C3.73069 4 3.95455 3.77614 3.95455 3.5C3.95455 3.22386 3.73069 3 3.45455 3L3.45455 4ZM12.5455 3C12.2693 3 12.0455 3.22386 12.0455 3.5C12.0455 3.77614 12.2693 4 12.5455 4L12.5455 3ZM13.4545 4C13.7307 4 13.9545 3.77614 13.9545 3.5C13.9545 3.22386 13.7307 3 13.4545 3L13.4545 4ZM22.5455 3C22.2693 3 22.0455 3.22386 22.0455 3.5C22.0455 3.77614 22.2693 4 22.5455 4L22.5455 3ZM23.4545 4C23.7307 4 23.9545 3.77614 23.9545 3.5C23.9545 3.22386 23.7307 3 23.4545 3L23.4545 4ZM32.5455 3C32.2693 3 32.0455 3.22386 32.0455 3.5C32.0455 3.77614 32.2693 4 32.5455 4L32.5455 3ZM33.4545 4C33.7307 4 33.9545 3.77615 33.9545 3.5C33.9545 3.22386 33.7307 3 33.4545 3L33.4545 4ZM42.5455 3C42.2693 3 42.0455 3.22386 42.0455 3.5C42.0455 3.77615 42.2693 4 42.5455 4L42.5455 3ZM3 4L3.45455 4L3.45455 3L3 3L3 4ZM12.5455 4L13.4545 4L13.4545 3L12.5455 3L12.5455 4ZM22.5455 4L23.4545 4L23.4545 3L22.5455 3L22.5455 4ZM32.5455 4L33.4545 4L33.4545 3L32.5455 3L32.5455 4ZM42.5455 4L43 4L43 3L42.5455 3L42.5455 4Z"
                  fill="#E1BC84" fill-opacity="0.46" />
              </svg>
            </div>
          @endif
          @foreach(data_get($hero, 'we_opened_schedule') as $schedule)
            <div class="flex-col items-center gap-[0.625rem] hidden big-tablet:flex">
              <span class="font-antic uppercase text-[#AAA] text-[0.875rem] tracking-[0.0625rem]">
                {{ data_get($schedule, 'day') }}
              </span>
              <span class="text-[1rem] font-semibold tracking-[0.03125rem]">
                {{ data_get($schedule, 'operating_hours') }}
              </span>
              <svg xmlns="http://www.w3.org/2000/svg" width="46" height="7" viewBox="0 0 46 7" fill="none">
                <path
                  d="M0.113249 3.5L3 6.38675L5.88675 3.5L3 0.613249L0.113249 3.5ZM45.8868 3.5L43 0.613252L40.1133 3.5L43 6.38675L45.8868 3.5ZM3.45455 4C3.73069 4 3.95455 3.77614 3.95455 3.5C3.95455 3.22386 3.73069 3 3.45455 3L3.45455 4ZM12.5455 3C12.2693 3 12.0455 3.22386 12.0455 3.5C12.0455 3.77614 12.2693 4 12.5455 4L12.5455 3ZM13.4545 4C13.7307 4 13.9545 3.77614 13.9545 3.5C13.9545 3.22386 13.7307 3 13.4545 3L13.4545 4ZM22.5455 3C22.2693 3 22.0455 3.22386 22.0455 3.5C22.0455 3.77614 22.2693 4 22.5455 4L22.5455 3ZM23.4545 4C23.7307 4 23.9545 3.77614 23.9545 3.5C23.9545 3.22386 23.7307 3 23.4545 3L23.4545 4ZM32.5455 3C32.2693 3 32.0455 3.22386 32.0455 3.5C32.0455 3.77614 32.2693 4 32.5455 4L32.5455 3ZM33.4545 4C33.7307 4 33.9545 3.77615 33.9545 3.5C33.9545 3.22386 33.7307 3 33.4545 3L33.4545 4ZM42.5455 3C42.2693 3 42.0455 3.22386 42.0455 3.5C42.0455 3.77615 42.2693 4 42.5455 4L42.5455 3ZM3 4L3.45455 4L3.45455 3L3 3L3 4ZM12.5455 4L13.4545 4L13.4545 3L12.5455 3L12.5455 4ZM22.5455 4L23.4545 4L23.4545 3L22.5455 3L22.5455 4ZM32.5455 4L33.4545 4L33.4545 3L32.5455 3L32.5455 4ZM42.5455 4L43 4L43 3L42.5455 3L42.5455 4Z"
                  fill="#E1BC84" fill-opacity="0.46" />
              </svg>
            </div>
          @endforeach
          @if(data_get($hero, 'weekends_mobile_day') || data_get($hero, 'weekends_mobile_operating_hours'))
            <div class="flex flex-col items-center gap-[0.625rem] big-tablet:hidden">
              <span class="font-antic uppercase text-[#AAA] text-[0.875rem] tracking-[0.0625rem]">
                {{ data_get($hero, 'weekends_mobile_day') }}
              </span>
                  <span class="text-[1rem] font-semibold tracking-[0.03125rem]">
                {{ data_get($hero, 'weekends_mobile_operating_hours') }}
              </span>
              <svg xmlns="http://www.w3.org/2000/svg" width="46" height="7" viewBox="0 0 46 7" fill="none">
                <path
                  d="M0.113249 3.5L3 6.38675L5.88675 3.5L3 0.613249L0.113249 3.5ZM45.8868 3.5L43 0.613252L40.1133 3.5L43 6.38675L45.8868 3.5ZM3.45455 4C3.73069 4 3.95455 3.77614 3.95455 3.5C3.95455 3.22386 3.73069 3 3.45455 3L3.45455 4ZM12.5455 3C12.2693 3 12.0455 3.22386 12.0455 3.5C12.0455 3.77614 12.2693 4 12.5455 4L12.5455 3ZM13.4545 4C13.7307 4 13.9545 3.77614 13.9545 3.5C13.9545 3.22386 13.7307 3 13.4545 3L13.4545 4ZM22.5455 3C22.2693 3 22.0455 3.22386 22.0455 3.5C22.0455 3.77614 22.2693 4 22.5455 4L22.5455 3ZM23.4545 4C23.7307 4 23.9545 3.77614 23.9545 3.5C23.9545 3.22386 23.7307 3 23.4545 3L23.4545 4ZM32.5455 3C32.2693 3 32.0455 3.22386 32.0455 3.5C32.0455 3.77614 32.2693 4 32.5455 4L32.5455 3ZM33.4545 4C33.7307 4 33.9545 3.77615 33.9545 3.5C33.9545 3.22386 33.7307 3 33.4545 3L33.4545 4ZM42.5455 3C42.2693 3 42.0455 3.22386 42.0455 3.5C42.0455 3.77615 42.2693 4 42.5455 4L42.5455 3ZM3 4L3.45455 4L3.45455 3L3 3L3 4ZM12.5455 4L13.4545 4L13.4545 3L12.5455 3L12.5455 4ZM22.5455 4L23.4545 4L23.4545 3L22.5455 3L22.5455 4ZM32.5455 4L33.4545 4L33.4545 3L32.5455 3L32.5455 4ZM42.5455 4L43 4L43 3L42.5455 3L42.5455 4Z"
                  fill="#E1BC84" fill-opacity="0.46" />
              </svg>
            </div>
          @endif
        </div>
      </div>
    @endif
    {{-- END Hero Section --}}
  </div>
  <div id="drawer"
       class="flex flex-col big-tablet:hidden items-center justify-between p-[2.5rem_0.875rem_1.25rem_0.875rem] tablet:p-[2.5rem_2.5rem_1.25rem_2.5rem] big-tablet:p-[2.5rem_4.375rem_1.25rem_4.375rem] fixed bg-[#121212] inset-0 h-[100dvh] w-screen z-40 transition-transform -translate-y-[150dvh] duration-300 ease-in-out">
    <div class="flex w-full items-center justify-end pt-[1.5rem]">
      <button id="close-drawer" class="flex justify-center items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
          <path d="M5 5.5L18.5 19" stroke="white" stroke-width="2" stroke-linecap="round" />
          <path d="M18.5 5.5L5 19" stroke="white" stroke-width="2" stroke-linecap="round" />
        </svg>
      </button>
    </div>
    <div class="flex w-full flex-col items-center justify-center gap-[1.25rem]">
      <button id="button-about"
              class="group w-[7.1875rem] h-[3.6875rem] relative flex items-center justify-center text-center hover:text-white/80 transition-colors text-[1rem] font-semibold tracking-[0.03125rem]">
        About Us
        <svg xmlns="http://www.w3.org/2000/svg"
             class="group-hover:rotate-[5deg] transition-transform absolute inset-0 top-4 left-2" width="105"
             height="41" viewBox="0 0 105 41" fill="none">
          <path opacity="0.4"
                d="M104.022 13.5773C104.341 15.851 103.378 18.2964 101.141 20.8089C98.9074 23.3184 95.4703 25.8129 91.0505 28.1381C82.217 32.7854 69.6085 36.6785 55.3231 38.6862C41.0376 40.6939 27.8445 40.427 18.0722 38.3945C13.1827 37.3776 9.19118 35.9272 6.35206 34.1307C3.50944 32.332 1.90968 30.2468 1.59013 27.9731C1.27058 25.6994 2.23362 23.2541 4.47033 20.7415C6.70427 18.232 10.1414 15.7376 14.5611 13.4123C23.3947 8.76503 36.0031 4.87194 50.2886 2.86425C64.5741 0.856558 77.7672 1.12347 87.5395 3.15588C92.429 4.17278 96.4205 5.62319 99.2596 7.41971C102.102 9.21845 103.702 11.3036 104.022 13.5773Z"
                stroke="white" stroke-width="1.5" />
        </svg>
      </button>
      <button id="button-menu"
              class="group w-[7.1875rem] h-[3.6875rem] relative flex items-center justify-center text-center hover:text-white/80 transition-colors text-[1rem] font-semibold tracking-[0.03125rem]">
        Our Menu
        <svg xmlns="http://www.w3.org/2000/svg"
             class="group-hover:rotate-[5deg] transition-transform absolute inset-0 top-4 left-2" width="105"
             height="41" viewBox="0 0 105 41" fill="none">
          <path opacity="0.4"
                d="M104.022 13.5773C104.341 15.851 103.378 18.2964 101.141 20.8089C98.9074 23.3184 95.4703 25.8129 91.0505 28.1381C82.217 32.7854 69.6085 36.6785 55.3231 38.6862C41.0376 40.6939 27.8445 40.427 18.0722 38.3945C13.1827 37.3776 9.19118 35.9272 6.35206 34.1307C3.50944 32.332 1.90968 30.2468 1.59013 27.9731C1.27058 25.6994 2.23362 23.2541 4.47033 20.7415C6.70427 18.232 10.1414 15.7376 14.5611 13.4123C23.3947 8.76503 36.0031 4.87194 50.2886 2.86425C64.5741 0.856558 77.7672 1.12347 87.5395 3.15588C92.429 4.17278 96.4205 5.62319 99.2596 7.41971C102.102 9.21845 103.702 11.3036 104.022 13.5773Z"
                stroke="white" stroke-width="1.5" />
        </svg>
      </button>
      <button id="button-contacts"
              class="group w-[7.1875rem] h-[3.6875rem] relative flex items-center justify-center text-center hover:text-white/80 transition-colors text-[1rem] font-semibold tracking-[0.03125rem]">
        Contacts
        <svg xmlns="http://www.w3.org/2000/svg"
             class="group-hover:rotate-[5deg] transition-transform absolute inset-0 top-4 left-2" width="105"
             height="41" viewBox="0 0 105 41" fill="none">
          <path opacity="0.4"
                d="M104.022 13.5773C104.341 15.851 103.378 18.2964 101.141 20.8089C98.9074 23.3184 95.4703 25.8129 91.0505 28.1381C82.217 32.7854 69.6085 36.6785 55.3231 38.6862C41.0376 40.6939 27.8445 40.427 18.0722 38.3945C13.1827 37.3776 9.19118 35.9272 6.35206 34.1307C3.50944 32.332 1.90968 30.2468 1.59013 27.9731C1.27058 25.6994 2.23362 23.2541 4.47033 20.7415C6.70427 18.232 10.1414 15.7376 14.5611 13.4123C23.3947 8.76503 36.0031 4.87194 50.2886 2.86425C64.5741 0.856558 77.7672 1.12347 87.5395 3.15588C92.429 4.17278 96.4205 5.62319 99.2596 7.41971C102.102 9.21845 103.702 11.3036 104.022 13.5773Z"
                stroke="white" stroke-width="1.5" />
        </svg>
      </button>
    </div>
    <div class="flex flex-col justify-center items-center gap-[1.25rem] p-[0rem_0.875rem] tablet:p-[0rem_2.5rem]">
      <div class="flex flex-col justify-center items-center gap-[0.875rem]">
        <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
          <path
            d="M4.87911 15.4255C3.65457 13.2903 3.06331 11.5467 2.7068 9.7794C2.17952 7.16554 3.38618 4.61221 5.38512 2.98299C6.22996 2.29441 7.19843 2.52967 7.69801 3.42593L8.82587 5.44934C9.71984 7.05315 10.1668 7.85505 10.0782 8.70522C9.98951 9.5554 9.38669 10.2478 8.18106 11.6327L4.87911 15.4255ZM4.87911 15.4255C7.35766 19.7473 11.2473 23.6391 15.5741 26.1205M15.5741 26.1205C17.7093 27.345 19.4528 27.9363 21.2202 28.2928C23.8341 28.8201 26.3874 27.6134 28.0166 25.6145C28.7052 24.7696 28.4699 23.8012 27.5737 23.3016L25.5503 22.1737C23.9464 21.2798 23.1445 20.8328 22.2944 20.9214C21.4442 21.0101 20.7518 21.6129 19.3669 22.8185L15.5741 26.1205Z"
            stroke="#E1BC84" stroke-width="1.5" stroke-linejoin="round" />
          <path
            d="M18.083 8.82439C19.9214 9.60506 21.3946 11.0782 22.1753 12.9166M18.9278 2.58325C23.4967 3.90173 27.0977 7.50259 28.4163 12.0714"
            stroke="#E1BC84" stroke-width="1.5" stroke-linecap="round" />
        </svg>
        <div class="flex flex-col justify-center items-center gap-[0.25rem]">
          <span class="text-[0.5rem] font-light uppercase tracking-[0.0625rem] text-[#AAA]">CALL US</span>
          <span class="text-[1rem] font-semibold">+1 232 222 4445 777</span>
          <span class="font-light text-[#AAA] text-[0.625rem] tracking-[0.0625rem]">Mon. - Fri. : <span
              class="font-bold">09:00 - 23:00</span></span>
        </div>
      </div>
      <svg class="tablet:hidden" xmlns="http://www.w3.org/2000/svg" width="365" height="2" viewBox="0 0 365 2"
           fill="none">
        <path opacity="0.1" d="M365 1L-3.8147e-06 0.999984" stroke="white" />
      </svg>
      <svg class="hidden tablet:block" xmlns="http://www.w3.org/2000/svg" width="664" height="2" viewBox="0 0 664 2"
           fill="none">
        <path opacity="0.1" d="M664 1L7.62939e-06 0.999971" stroke="white" />
      </svg>
      <div class="flex flex-col justify-center items-center gap-[0.875rem]">
        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
          <path
            d="M7.29199 14.4708C7.29199 21.5464 13.4819 27.3976 16.2216 29.6409C16.6138 29.962 16.8122 30.1244 17.1047 30.2068C17.3325 30.2709 17.6677 30.2709 17.8955 30.2068C18.1886 30.1243 18.3856 29.9634 18.7792 29.6412C21.519 27.3978 27.7085 21.547 27.7085 14.4715C27.7085 11.7938 26.6331 9.22549 24.7186 7.33209C22.8042 5.4387 20.2079 4.375 17.5004 4.375C14.793 4.375 12.1964 5.43886 10.2819 7.33225C8.36751 9.22565 7.29199 11.7932 7.29199 14.4708Z"
            stroke="#E1BC84" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path
            d="M14.5837 13.125C14.5837 14.7358 15.8895 16.0417 17.5003 16.0417C19.1112 16.0417 20.417 14.7358 20.417 13.125C20.417 11.5142 19.1112 10.2083 17.5003 10.2083C15.8895 10.2083 14.5837 11.5142 14.5837 13.125Z"
            stroke="#E1BC84" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <div class="flex flex-col justify-center items-center gap-[0.25rem]">
          <span class="text-[0.5rem] font-light uppercase tracking-[0.0625rem] text-[#AAA]">VISIT US</span>
          <span class="text-[1rem] font-semibold">10408 Madison Street, Fort Lilly 19797-5951</span>
          <span class="font-light text-[#AAA] text-[0.625rem] tracking-[0.0625rem]">Mon. - Fri. : <span
              class="font-bold">09:00 - 23:00</span> Weekend : <span class="font-bold">11:00 - 23:30</span></span>
        </div>
      </div>
      <svg class="tablet:hidden" xmlns="http://www.w3.org/2000/svg" width="365" height="2" viewBox="0 0 365 2"
           fill="none">
        <path opacity="0.1" d="M365 1L-3.8147e-06 0.999984" stroke="white" />
      </svg>
      <svg class="hidden tablet:block" xmlns="http://www.w3.org/2000/svg" width="664" height="2" viewBox="0 0 664 2"
           fill="none">
        <path opacity="0.1" d="M664 1L7.62939e-06 0.999971" stroke="white" />
      </svg>
      <div class="flex gap-[1rem]">
        <a href="#"
           class="border border-1 hover:bg-white/20 transition-colors rounded-full p-[11px] gap-[10px] border-white/20">
          <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
            <path
              d="M16.5 9.04277C16.5 5.15316 13.366 2 9.5 2C5.634 2 2.5 5.15316 2.5 9.04277C2.5 12.558 5.05979 15.4716 8.40625 16V11.0786H6.62891V9.04277H8.40625V7.49116C8.40625 5.72607 9.45135 4.75108 11.0502 4.75108C11.8162 4.75108 12.6172 4.88864 12.6172 4.88864V6.62183H11.7345C10.865 6.62183 10.5937 7.16475 10.5937 7.72173V9.04277H12.5351L12.2248 11.0786H10.5937V16C13.9402 15.4716 16.5 12.5581 16.5 9.04277Z"
              fill="white" />
          </svg>
        </a>
        <a href="#"
           class="border border-1 hover:bg-white/20 transition-colors rounded-full p-[11px] gap-[10px] border-white/20">
          <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
            <path
              d="M13.3821 3.18213H15.4521L10.9296 8.26518L16.25 15.1821H12.0842L8.82133 10.9871L5.08792 15.1821H3.01658L7.85388 9.74523L2.75 3.18213H7.02159L9.97093 7.01659L13.3821 3.18213ZM12.6555 13.9637H13.8026L6.39831 4.33659H5.1674L12.6555 13.9637Z"
              fill="white" />
          </svg>
        </a>
        <a href="#"
           class="border border-1 hover:bg-white/20 transition-colors rounded-full p-[11px] gap-[10px] border-white/20">
          <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
            <path
              d="M10.6102 2.6665C11.3695 2.66853 11.7549 2.67258 12.0877 2.68203L12.2186 2.68675C12.3698 2.69215 12.519 2.6989 12.6992 2.707C13.4173 2.74075 13.9074 2.85414 14.3373 3.02086C14.7828 3.1923 15.1581 3.42449 15.5334 3.7991C15.8766 4.13651 16.1422 4.54466 16.3116 4.99513C16.4783 5.42509 16.5917 5.91511 16.6255 6.63395C16.6336 6.81349 16.6403 6.96266 16.6457 7.11453L16.6498 7.24547C16.6599 7.57755 16.6639 7.96296 16.6653 8.72229L16.666 9.22582V10.11C16.6676 10.6023 16.6624 11.0947 16.6504 11.5868L16.6464 11.7178C16.641 11.8697 16.6342 12.0188 16.6261 12.1984C16.5924 12.9172 16.4776 13.4066 16.3116 13.8372C16.1426 14.2879 15.877 14.6962 15.5334 15.0332C15.1959 15.3763 14.7877 15.6419 14.3373 15.8115C13.9074 15.9782 13.4173 16.0916 12.6992 16.1253C12.539 16.1329 12.3788 16.1396 12.2186 16.1456L12.0877 16.1496C11.7549 16.1591 11.3695 16.1638 10.6102 16.1651L10.1066 16.1658H9.22311C8.73057 16.1675 8.23802 16.1623 7.74562 16.1503L7.61467 16.1462C7.45444 16.1402 7.29425 16.1332 7.1341 16.1253C6.41593 16.0916 5.92591 15.9782 5.49528 15.8115C5.04485 15.6423 4.63687 15.3767 4.29992 15.0332C3.95639 14.6959 3.69057 14.2878 3.52101 13.8372C3.35429 13.4072 3.2409 12.9172 3.20715 12.1984C3.19963 12.0382 3.19288 11.878 3.1869 11.7178L3.18352 11.5868C3.17109 11.0947 3.16546 10.6024 3.16665 10.11V8.72229C3.16477 8.22997 3.16972 7.73765 3.1815 7.24547L3.18622 7.11453C3.19162 6.96266 3.19837 6.81349 3.20647 6.63395C3.24022 5.91511 3.35361 5.42576 3.52033 4.99513C3.68982 4.54419 3.95617 4.13592 4.30059 3.7991C4.63746 3.45586 5.04518 3.19027 5.49528 3.02086C5.92591 2.85414 6.41526 2.74075 7.1341 2.707C7.31364 2.6989 7.46348 2.69215 7.61467 2.68675L7.74562 2.6827C8.23779 2.67071 8.73012 2.66554 9.22244 2.66718L10.6102 2.6665ZM9.9163 6.04133C9.02124 6.04133 8.16284 6.39689 7.52994 7.0298C6.89704 7.6627 6.54148 8.5211 6.54148 9.41616C6.54148 10.3112 6.89704 11.1696 7.52994 11.8025C8.16284 12.4354 9.02124 12.791 9.9163 12.791C10.8114 12.791 11.6698 12.4354 12.3027 11.8025C12.9356 11.1696 13.2911 10.3112 13.2911 9.41616C13.2911 8.5211 12.9356 7.6627 12.3027 7.0298C11.6698 6.39689 10.8114 6.04133 9.9163 6.04133ZM9.9163 7.39126C10.1822 7.39122 10.4455 7.44355 10.6912 7.54527C10.9369 7.64699 11.1602 7.7961 11.3482 7.9841C11.5363 8.1721 11.6855 8.3953 11.7873 8.64095C11.8891 8.88661 11.9415 9.14991 11.9415 9.41582C11.9416 9.68173 11.8893 9.94505 11.7875 10.1907C11.6858 10.4364 11.5367 10.6597 11.3487 10.8477C11.1607 11.0358 10.9375 11.185 10.6918 11.2868C10.4462 11.3886 10.1829 11.441 9.91698 11.4411C9.37994 11.4411 8.8649 11.2277 8.48516 10.848C8.10542 10.4682 7.89208 9.95319 7.89208 9.41616C7.89208 8.87912 8.10542 8.36408 8.48516 7.98434C8.8649 7.6046 9.37994 7.39126 9.91698 7.39126M13.4605 5.02888C13.2368 5.02888 13.0222 5.11777 12.864 5.276C12.7057 5.43422 12.6168 5.64882 12.6168 5.87259C12.6168 6.09635 12.7057 6.31095 12.864 6.46918C13.0222 6.62741 13.2368 6.7163 13.4605 6.7163C13.6843 6.7163 13.8989 6.62741 14.0571 6.46918C14.2154 6.31095 14.3043 6.09635 14.3043 5.87259C14.3043 5.64882 14.2154 5.43422 14.0571 5.276C13.8989 5.11777 13.6843 5.02888 13.4605 5.02888Z"
              fill="white" />
          </svg>
        </a>
        <a href="#"
           class="border border-1 hover:bg-white/20 transition-colors rounded-full p-[11px] gap-[10px] border-white/20">
          <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M3.875 2.43213C3.25368 2.43213 2.75 2.93581 2.75 3.55713V14.8071C2.75 15.4284 3.25368 15.9321 3.875 15.9321H15.125C15.7463 15.9321 16.25 15.4284 16.25 14.8071V3.55713C16.25 2.93581 15.7463 2.43213 15.125 2.43213H3.875ZM6.89057 5.43417C6.89479 6.15136 6.35796 6.59327 5.72092 6.59011C5.1208 6.58694 4.59768 6.10917 4.60084 5.43523C4.60401 4.80136 5.10498 4.29194 5.75573 4.30671C6.41596 4.32148 6.89479 4.80558 6.89057 5.43417ZM9.70978 7.50345H7.81978H7.81872V13.9233H9.81627V13.7736C9.81627 13.4886 9.81605 13.2036 9.81582 12.9186C9.81522 12.1582 9.81455 11.397 9.81845 10.6369C9.8195 10.4523 9.8279 10.2604 9.87537 10.0842C10.0536 9.4261 10.6453 9.00108 11.3056 9.10555C11.7295 9.17193 12.01 9.4177 12.1281 9.81745C12.201 10.0674 12.2337 10.3363 12.2368 10.5969C12.2454 11.3826 12.2442 12.1683 12.243 12.954C12.2425 13.2314 12.2421 13.5089 12.2421 13.7862V13.9223H14.246V13.7683C14.246 13.4293 14.2458 13.0904 14.2456 12.7515C14.2452 11.9043 14.2448 11.0572 14.247 10.2098C14.2481 9.8269 14.207 9.44935 14.1131 9.07915C13.9729 8.52858 13.6828 8.07295 13.2114 7.74393C12.877 7.50977 12.51 7.35895 12.0997 7.34208C12.053 7.34014 12.0059 7.33759 11.9586 7.33504C11.7488 7.3237 11.5356 7.31218 11.335 7.35262C10.7613 7.46758 10.2572 7.7302 9.87642 8.19318C9.83217 8.24628 9.7889 8.3002 9.72432 8.38068L9.70978 8.3989V7.50345ZM4.76123 13.9254H6.74932V7.50763H4.76123V13.9254Z"
                  fill="white" />
          </svg>
        </a>
      </div>
    </div>
  </div>
{{-- START: About Us --}}
  @if(data_get($about_us, 'is_section_visible'))
  <div id="about"
       class="relative flex flex-col tablet:flex-row gap-[3.75rem] items-center justify-center tablet:justify-end laptop:justify-center laptop:gap-[5rem] desktop:gap-[7.5rem] self-stretch p-[3.75rem_0.875rem_2.5rem_0.875rem] tablet:p-[6.25rem_2.5rem_3.75rem_2.5rem] big-tablet:p-[6.25rem_4.375rem] desktop:p-[6.25rem_23.125rem_6.25rem_7.5rem]">
    @if(data_get($about_us, 'is_left_section_visible'))
      <img
        class="absolute top-0 right-0 w-[24.5625rem] h-[16.375rem] tablet:w-[25.9375rem] tablet:h-[17.25rem] big-tablet:w-[29.1875rem] big-tablet:h-[19.4375rem] laptop:w-[36.6875rem] laptop:h-[24.4375rem] desktop:w-[45.25rem] desktop:h-[30.125rem]"
        src="{{ asset('/assets/templates/1/graphic.png') }}" alt="graphic" />
      <div
        class="justify-center items-center hidden tablet:flex self-stretch w-[14.3125rem] big-tablet:w-[39.6875rem] big-tablet:h-[42.875rem] big-tablet:-translate-x-[6rem] laptop:translate-x-0 desktop:w-[53.125rem] desktop:h-[42.875rem] big-tablet:justify-start big-tablet:items-start">
        <div
          class="relative border-2 border-[#E1BC84] border-opacity-[0.12] shrink-0 w-[12.75rem] big-tablet:w-[17.625rem] big-tablet:h-[29.75rem] h-[21.5rem]">
          <div
            class="absolute top-5 left-5 inset-0 flex w-[13.0625rem] big-tablet:w-[18.1875rem] big-tablet:h-[29.75rem] h-[21.375rem] max-w-[38.125rem] items-center justify-center shrink-0">
            <div
              class="asset-1 w-[13.0625rem] h-[21.375rem] big-tablet:w-[18.1875rem] big-tablet:h-[29.75rem] shrink-0"></div>
          </div>
        </div>
        <div
          class="relative hidden big-tablet:flex translate-x-20 translate-y-48 border-2 border-[#E1BC84] border-opacity-[0.12] shrink-0 w-[12.75rem] big-tablet:w-[16.8125rem] big-tablet:h-[29.75rem] desktop:w-[30.25rem] h-[21.5rem]">
          <div
            class="absolute -top-5 -left-8 inset-0 flex w-[13.0625rem] big-tablet:w-[17.75rem] big-tablet:h-[29.75rem] desktop:w-[31.125rem] h-[21.375rem] max-w-[38.125rem] items-center justify-center shrink-0">
            <div
              class="asset-2 w-[13.0625rem] h-[21.375rem] shrink-0 big-tablet:w-[17.75rem] big-tablet:h-[29.75rem] desktop:w-[31.125rem]"></div>
          </div>
        </div>
      </div>
    @endif
    @if(data_get($about_us, 'is_right_section_visible'))
      <div
        class="flex max-w-[43.75rem] flex-col justify-center items-center tablet:items-start tablet:flex-[1_0_0] gap-[2.5rem] self-stretch">
        <div class="flex flex-col gap-[1.875rem] self-stretch items-start">
          <div class="flex flex-col self-stretch items-center tablet:items-start">
            <h1 class="font-mea text-[1.875rem] desktop:text-[2.5rem] text-[#E1BC84]">
              {{ data_get($about_us, 'section_title') }}
            </h1>
            <h2 class="font-antic text-[2.5rem] desktop:text-[2.875rem] tracking-[0.03125rem]">
              {{ data_get($about_us, 'header') }}
            </h2>
          </div>
        </div>
        <div class="flex flex-col items-start justify-center gap-[1.25rem] self-stretch">
          <div class="text-[#AAA] text-[0.875rem] font-light leading-[170%] tracking-[0.0625rem]">
            {!! data_get($about_us, 'subtext') !!}
          </div>
          <div class="relative tablet:hidden self-stretch h-[22.625rem]">
            <div class="border-2 -z-10 border-[#E1BC84] opacity-[0.12] shrink-0 w-[21.5625rem] h-[21.375rem]"></div>
            <div
              class="absolute top-5 left-5 inset-0 flex w-[21.5625rem] h-[21.375rem] max-w-[38.125rem] items-center justify-center shrink-0">
              <div class="asset-1 w-[21.5625rem] h-[21.375rem] shrink-0"></div>
            </div>
          </div>
        </div>
        <div class="flex flex-col tablet:flex-row gap-[1.25rem] items-center justify-center">
          @if(data_get($about_us, 'is_contact_us_visible'))
            <a href="{{ data_get($about_us, 'contact_us_link') }}"
               class="group relative text-[1rem] hover:text-white/80 transition-colors font-semibold flex items-center justify-center text-center w-[10.66488rem] h-[5.08131rem]">
              {{ data_get($about_us, 'contact_us_title') }}
              <svg class="group-hover:rotate-[5deg] top-3 transition-transform absolute inset-0"
                   xmlns="http://www.w3.org/2000/svg" width="165" height="61" viewBox="0 0 165 61" fill="none">
                <path
                  d="M163.8 24.5135C164.07 28.3656 162.159 32.2543 158.323 36.0027C154.489 39.7493 148.78 43.3042 141.596 46.4671C127.231 52.7912 107.071 57.5033 84.5252 59.0849C61.9789 60.6666 41.3586 58.8154 26.2517 54.5588C18.6961 52.4299 12.547 49.7069 8.22719 46.5324C3.9052 43.3562 1.47003 39.7724 1.1998 35.9204C0.929572 32.0684 2.84052 28.1797 6.67673 24.4312C10.511 20.6846 16.2197 17.1298 23.4041 13.9668C37.7687 7.64277 57.9286 2.93066 80.4748 1.34898C103.021 -0.232704 123.641 1.61857 138.748 5.87511C146.304 8.004 152.453 10.727 156.773 13.9015C161.095 17.0777 163.53 20.6615 163.8 24.5135Z"
                  stroke="white" />
              </svg>
              <svg class="group-hover:rotate-[5deg] top-3 transition-transform absolute inset-0"
                   xmlns="http://www.w3.org/2000/svg" width="165" height="60" viewBox="0 0 165 60" fill="none">
                <path opacity="0.4"
                      d="M163.967 32.5299C163.858 36.3899 161.574 40.0719 157.388 43.4253C153.204 46.777 147.174 49.7537 139.713 52.1953C124.797 57.0772 104.271 59.7855 81.6787 59.1441C59.0862 58.5026 38.7476 54.634 24.1321 48.9136C16.8223 46.0526 10.9704 42.7385 6.98351 39.1549C2.99454 35.5694 0.923322 31.7636 1.03292 27.9037C1.14252 24.0437 3.42634 20.3616 7.61233 17.0082C11.7962 13.6566 17.8266 10.6799 25.287 8.23824C40.2035 3.35634 60.7289 0.648038 83.3214 1.28952C105.914 1.93099 126.253 5.79955 140.868 11.52C148.178 14.381 154.03 17.6951 158.017 21.2787C162.006 24.8642 164.077 28.67 163.967 32.5299Z"
                      stroke="white" />
              </svg>
            </a>
          @endif
          @if(data_get($about_us, 'is_learn_more_visible'))
            <a href="{{ data_get($about_us, 'learn_more_link') }}"
               class="group flex p-[1rem_2.5rem] hover:text-white/80 transition-colors justify-center items-center gap-[0.875rem]">
              <span class="text-[1rem] font-semibold min-w-[96px]">
                {{ data_get($about_us, 'learn_more_title') }}
              </span>
              <svg class="transition-transform group-hover:translate-x-[2px] group-hover:-translate-y-[2px]"
                   xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                <path
                  d="M0.55029 11.251L10.4498 1.35148M10.4498 1.35148C9.38912 3.35495 7.9042 7.99828 10.4498 10.5439M10.4498 1.35148C8.44632 2.41214 3.80298 3.89706 1.2574 1.35148"
                  stroke="white" />
              </svg>
            </a>
          @endif
        </div>
      </div>
    @endif
  </div>
  @endif
{{-- END: About Us --}}
{{-- START: Menu Section --}}
  @if(data_get($menu, 'is_section_visible'))
    <div id="menu"
         class="relative flex flex-col big-tablet:flex-row big-tablet:justify-normal gap-[3.75rem] laptop:gap-[5rem] desktop:gap-[7.5rem] self-stretch p-[3.75rem_0.875rem] tablet:p-[6.25rem_2.5rem] big-tablet:p-[6.25rem_4.375rem] laptop:p-[6.25rem_4.375rem_12.5rem_4.375rem] desktop:p-[6.25rem_23.125rem_12.5rem_23.125rem] items-center justify-center">
      <div class="absolute inset-0 h-full w-full -z-10">
        <img class="object-cover h-full w-full" src="{{ asset('assets/templates/1/backdrop.png') }}"
             alt="backdrop image" />
      </div>
      @if(data_get($menu, 'is_left_section_visible'))
        <div class="flex flex-col justify-center items-center big-tablet:items-start gap-[3.75rem] self-stretch">
          <div
            class="flex flex-col gap-[1rem] self-stretch items-center text-center big-tablet:items-start big-tablet:text-left">
            <h1 class="font-mea text-[#E1BC84] text-[1.875rem] tablet:text-[2.5rem]">
              {{ data_get($menu, 'section_title') }}
            </h1>
            <h2 class="font-antic text-[2.5rem] tablet:text-[2.875rem] tracking-[0.03125rem]">
              {{ data_get($menu, 'header') }}
            </h2>
            <div
              style='width: 430px'
              class="text-[#AAA] text-[0.875rem] font-thin tracking-[0.0625rem] leading-[170%] tablet:flex tablet:flex-col">
              {!! data_get($menu, 'subtext') !!}
            </div>
          </div>
          @if(data_get($menu, 'is_menu_pdf_visible'))
            <a
              href="{{ data_get($menu, 'menu_pdf') }}"
              target='_blank'
              class="group relative text-[1rem] hover:text-white/80 transition-colors font-semibold flex items-center justify-center text-center w-[10.66488rem] h-[5.08131rem]">
              {{ data_get($menu, 'menu_pdf_title') }}
              <svg class="group-hover:rotate-[5deg] top-3 transition-transform absolute inset-0"
                   xmlns="http://www.w3.org/2000/svg" width="165" height="61" viewBox="0 0 165 61" fill="none">
                <path
                  d="M163.8 24.5135C164.07 28.3656 162.159 32.2543 158.323 36.0027C154.489 39.7493 148.78 43.3042 141.596 46.4671C127.231 52.7912 107.071 57.5033 84.5252 59.0849C61.9789 60.6666 41.3586 58.8154 26.2517 54.5588C18.6961 52.4299 12.547 49.7069 8.22719 46.5324C3.9052 43.3562 1.47003 39.7724 1.1998 35.9204C0.929572 32.0684 2.84052 28.1797 6.67673 24.4312C10.511 20.6846 16.2197 17.1298 23.4041 13.9668C37.7687 7.64277 57.9286 2.93066 80.4748 1.34898C103.021 -0.232704 123.641 1.61857 138.748 5.87511C146.304 8.004 152.453 10.727 156.773 13.9015C161.095 17.0777 163.53 20.6615 163.8 24.5135Z"
                  stroke="white" />
              </svg>
              <svg class="group-hover:rotate-[5deg] top-3 transition-transform absolute inset-0"
                   xmlns="http://www.w3.org/2000/svg" width="165" height="60" viewBox="0 0 165 60" fill="none">
                <path opacity="0.4"
                      d="M163.967 32.5299C163.858 36.3899 161.574 40.0719 157.388 43.4253C153.204 46.777 147.174 49.7537 139.713 52.1953C124.797 57.0772 104.271 59.7855 81.6787 59.1441C59.0862 58.5026 38.7476 54.634 24.1321 48.9136C16.8223 46.0526 10.9704 42.7385 6.98351 39.1549C2.99454 35.5694 0.923322 31.7636 1.03292 27.9037C1.14252 24.0437 3.42634 20.3616 7.61233 17.0082C11.7962 13.6566 17.8266 10.6799 25.287 8.23824C40.2035 3.35634 60.7289 0.648038 83.3214 1.28952C105.914 1.93099 126.253 5.79955 140.868 11.52C148.178 14.381 154.03 17.6951 158.017 21.2787C162.006 24.8642 164.077 28.67 163.967 32.5299Z"
                      stroke="white" />
              </svg>
            </a>
          @endif
        </div>
      @endif
      @if(data_get($menu, 'is_right_section_visible'))
        @if($menu_picture = data_get($menu, 'menu_picture'))
          <div
            class="relative h-[49rem] big-tablet:flex-[1_0_0] self-stretch"
            style='
              background-image: url("{{ asset('/storage/' . $menu_picture) }}");
              background-color: lightgray;
              background-size: cover;
              background-position: 50%;
              background-repeat: no-repeat;
            '>
        @else
          <div class="relative h-[49rem] big-tablet:flex-[1_0_0] self-stretch">
        @endif
          <div class="absolute inset-0 w-full h-full flex items-center justify-center">
            <span class="font-mea text-[7.5rem]">Menu</span>
          </div>
        </div>
      @endif
    </div>
  @endif
{{-- END: Menu Section --}}

{{-- START: Gallery --}}
@if(data_get($gallery, 'is_section_visible'))
  <div
    class="flex flex-col bg-[#161616] gap-[2.5rem] p-[6.25rem_0.875rem] tablet:p-[6.25rem_0rem] tablet:gap-[5rem] justify-center items-center self-stretch">
    @if(data_get($gallery, 'is_top_section_visible'))
      <div class="flex flex-col items-center justify-center gap-[1rem] self-stretch text-center">
        <h1 class="font-mea text-[1.875rem] desktop:text-[2.5rem] text-[#E1BC84]">
          {{ data_get($gallery, 'section_title') }}
        </h1>
        <h2 class="font-antic text-[2.5rem] desktop:text-[2.875rem]">
          {{ data_get($gallery, 'header') }}
        </h2>
        <p class="text-[#AAA] w-[460px] text-[0.875rem] font-thin tracking-[0.0625rem] leading-[170%] tablet:flex tablet:flex-col">
          {!! data_get($gallery, 'subtext') !!}
        </p>
      </div>
    @endif
    @if(data_get($gallery, 'is_top_section_visible'))
      <div
        class="relative w-full h-[11.00156rem] tablet:h-[21.88525rem] big-tablet:h-[34.375rem] swiper-container overflow-hidden">
        <div class="swiper-wrapper">
          @foreach(data_get($gallery, 'gallery') as $image)
            <div class="swiper-slide max-w-[18.75rem] tablet:max-w-[37.5rem] big-tablet:max-w-[58.75rem] h-full">
              <img class="object-cover w-full h-full"
                   src="{{ asset('/storage/' . $image) }}"
                   alt="gallery image" />
            </div>
          @endforeach
        </div>
      </div>
      <div
        class="flex w-full justify-center tablet:gap-[2.5rem] items-center px-[0.875rem] tablet:px-[4.375rem] big-tablet:px-[10rem] laptop:px-[20rem] desktop:px-[34rem]">
        <div class="flex-[3_0_0] relative flex w-[28.75rem]">
          <div class="swiper-pagination bg-black h-[0.25rem]"></div>
        </div>
        <div class="hidden tablet:flex gap-[1.25rem] items-center flex-[1_0_0] relative w-full">
          <button id="prev-button" class="hidden tablet:block">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="61" viewBox="0 0 60 61" fill="none">
              <rect x="-0.5" y="-0.5" width="59" height="59" rx="29.5"
                    transform="matrix(4.37114e-08 -1 -1 -4.37114e-08 59 59.6664)" stroke="white" stroke-opacity="0.16" />
              <path
                d="M37 30.1664L23 30.1664M23 30.1664C25.1667 30.833 29.5 33.0664 29.5 36.6664M23 30.1664C25.1667 29.4997 29.5 27.2664 29.5 23.6664"
                stroke="white" />
            </svg>
          </button>
          <button id="next-button" class="hidden tablet:block">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="61" viewBox="0 0 60 61" fill="none">
              <rect x="0.5" y="60.1664" width="59" height="59" rx="29.5" transform="rotate(-90 0.5 60.1664)"
                    stroke="white" stroke-opacity="0.16" />
              <path
                d="M23 30.1664L37 30.1664M37 30.1664C34.8333 30.833 30.5 33.0664 30.5 36.6664M37 30.1664C34.8333 29.4997 30.5 27.2664 30.5 23.6664"
                stroke="white" />
            </svg>
          </button>
        </div>
      </div>
    @endif
  </div>
@endif
{{-- END: Gallery --}}
  <div id="contacts"
       class="relative flex p-[5rem_0.875rem] tablet:p-[5rem_2.5rem] big-tablet:p-[5rem_4.375rem] desktop:p-[5rem_7.5rem] flex-col items-center justify-center gap-[2.5rem] self-stretch">
    <img
      class="absolute bottom-0 left-0 rotate-180 w-[24.5625rem] h-[16.375rem] tablet:w-[25.9375rem] tablet:h-[17.25rem] big-tablet:w-[29.1875rem] big-tablet:h-[19.4375rem] laptop:w-[36.6875rem] laptop:h-[24.4375rem] desktop:w-[45.25rem] desktop:h-[30.125rem]"
      src="{{ asset('/assets/templates/1/graphic.png') }}" alt="graphic" />
    <div class="flex flex-col items-center justify-center gap-[0.375rem] self-stretch text-center">
      <h1 class="font-mea text-[1.875rem] desktop:text-[2.5rem] text-[#E1BC84]">Contacts</h1>
      <h2 class="font-antic text-[2.5rem] desktop:text-[2.875rem] tracking-[0.03125rem]">Contact Us</h2>
    </div>
    <div class="flex flex-col self-stretch gap-[1.25rem] z-10">
      <div class="flex flex-col tablet:flex-row gap-[1.25rem] self-stretch items-start">
        <div class="flex flex-[1_0_0] flex-col gap-2 self-stretch border-b border-black/20">
          <label for="name" class="text-[#AAA] font-thin leading-[120%] tracking-[0.0625rem] text-[0.75rem]">Enter Your
            Full Name</label>
          <div
            class="flex self-stretch flex-[1_0_0] w-full justify-between items-center p-[0.625rem_0.875rem] bg-[#161616] ">
            <input type="text" id="name"
                   class="w-full text-[1.25rem] font-thin italic leading-[150%] tracking-[0.0625rem] bg-transparent border-none outline-none"
                   placeholder="John Jackson" />
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
              <g opacity="0.2">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M9.12856 3.96343L4.28906 8.80293C4.22056 8.87193 4.17306 8.95893 4.15356 9.05393L3.41006 12.5964C3.37556 12.7609 3.42606 12.9319 3.54456 13.0509C3.66256 13.1704 3.83306 13.2224 3.99756 13.1894L7.56906 12.4754C7.66606 12.4559 7.75506 12.4084 7.82456 12.3384L12.6641 7.49893L9.12856 3.96343ZM9.83556 3.25643L13.3711 6.79193L14.2676 5.89593C15.2441 4.91943 15.2441 3.33643 14.2676 2.35993C13.7986 1.89143 13.1631 1.62793 12.5001 1.62793C11.8366 1.62793 11.2011 1.89143 10.7321 2.35993L9.83556 3.25643Z"
                      fill="#E1BC84" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M1.75 15.6279H13.75C14.164 15.6279 14.5 15.2919 14.5 14.8779C14.5 14.4639 14.164 14.1279 13.75 14.1279H1.75C1.336 14.1279 1 14.4639 1 14.8779C1 15.2919 1.336 15.6279 1.75 15.6279Z"
                      fill="#E1BC84" />
              </g>
            </svg>
          </div>
          <div class="h-0.5 w-full bg-[#414141]"></div>
        </div>
        <div class="flex flex-[1_0_0] flex-col gap-2 self-stretch">
          <label for="mail" class="text-[#AAA] font-thin leading-[120%] tracking-[0.0625rem] text-[0.75rem]">Enter Your
            Mail</label>
          <div
            class="flex self-stretch flex-[1_0_0] w-full justify-between items-center p-[0.625rem_0.875rem] bg-[#161616] ">
            <input type="text" id="mail"
                   class="w-full text-[1.25rem] font-thin italic leading-[150%] tracking-[0.0625rem] bg-transparent border-none outline-none"
                   placeholder="(___) ___ __ __ __" />
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
              <g opacity="0.2">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M9.12856 3.96343L4.28906 8.80293C4.22056 8.87193 4.17306 8.95893 4.15356 9.05393L3.41006 12.5964C3.37556 12.7609 3.42606 12.9319 3.54456 13.0509C3.66256 13.1704 3.83306 13.2224 3.99756 13.1894L7.56906 12.4754C7.66606 12.4559 7.75506 12.4084 7.82456 12.3384L12.6641 7.49893L9.12856 3.96343ZM9.83556 3.25643L13.3711 6.79193L14.2676 5.89593C15.2441 4.91943 15.2441 3.33643 14.2676 2.35993C13.7986 1.89143 13.1631 1.62793 12.5001 1.62793C11.8366 1.62793 11.2011 1.89143 10.7321 2.35993L9.83556 3.25643Z"
                      fill="#E1BC84" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M1.75 15.6279H13.75C14.164 15.6279 14.5 15.2919 14.5 14.8779C14.5 14.4639 14.164 14.1279 13.75 14.1279H1.75C1.336 14.1279 1 14.4639 1 14.8779C1 15.2919 1.336 15.6279 1.75 15.6279Z"
                      fill="#E1BC84" />
              </g>
            </svg>
          </div>
          <div class="h-0.5 w-full bg-[#414141]"></div>
        </div>
      </div>
      <div class="flex flex-col gap-2 self-stretch">
        <label for="mail" class="text-[#AAA] font-thin leading-[120%] tracking-[0.0625rem] text-[0.75rem]">Enter Your
          Mail</label>
        <div
          class="flex self-stretch flex-[1_0_0] w-full justify-between items-end p-[0.625rem_0.875rem] bg-[#161616] ">
          <textarea type="text" id="mail"
                    class="w-full h-[10.25rem] text-[1.25rem] font-thin italic leading-[150%] tracking-[0.0625rem] bg-transparent border-none outline-none"
                    placeholder="Message"></textarea>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
            <g opacity="0.2">
              <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M9.12856 3.96343L4.28906 8.80293C4.22056 8.87193 4.17306 8.95893 4.15356 9.05393L3.41006 12.5964C3.37556 12.7609 3.42606 12.9319 3.54456 13.0509C3.66256 13.1704 3.83306 13.2224 3.99756 13.1894L7.56906 12.4754C7.66606 12.4559 7.75506 12.4084 7.82456 12.3384L12.6641 7.49893L9.12856 3.96343ZM9.83556 3.25643L13.3711 6.79193L14.2676 5.89593C15.2441 4.91943 15.2441 3.33643 14.2676 2.35993C13.7986 1.89143 13.1631 1.62793 12.5001 1.62793C11.8366 1.62793 11.2011 1.89143 10.7321 2.35993L9.83556 3.25643Z"
                    fill="#E1BC84" />
              <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M1.75 15.6279H13.75C14.164 15.6279 14.5 15.2919 14.5 14.8779C14.5 14.4639 14.164 14.1279 13.75 14.1279H1.75C1.336 14.1279 1 14.4639 1 14.8779C1 15.2919 1.336 15.6279 1.75 15.6279Z"
                    fill="#E1BC84" />
            </g>
          </svg>
        </div>
        <div class="h-0.5 w-full bg-[#414141]"></div>
      </div>
    </div>
    <button
      class="group relative text-[1.4145rem] hover:text-white/80 transition-colors font-semibold flex items-center justify-center text-center w-[15.08513rem] h-[7.18738rem]">
      Sent
      <svg class="group-hover:rotate-[5deg] top-3 transition-transform absolute inset-0"
           xmlns="http://www.w3.org/2000/svg" width="233" height="86" viewBox="0 0 233 86" fill="none">
        <path
          d="M231.497 35.0599C231.879 40.5084 229.176 46.0089 223.75 51.311C218.327 56.6104 210.252 61.6387 200.09 66.1126C179.771 75.0578 151.256 81.723 119.365 83.9602C87.4735 86.1974 58.3066 83.5789 36.9384 77.5581C26.2512 74.5468 17.5533 70.6952 11.4431 66.2049C5.3298 61.7123 1.88532 56.6431 1.50309 51.1946C1.12085 45.746 3.82384 40.2455 9.25005 34.9434C14.6735 29.644 22.7483 24.6157 32.9105 20.1418C53.2288 11.1966 81.7444 4.53147 113.635 2.29423C145.526 0.056984 174.693 2.67556 196.062 8.69632C206.749 11.7076 215.447 15.5592 221.557 20.0495C227.67 24.5421 231.115 29.6113 231.497 35.0599Z"
          stroke="white" stroke-width="1.41447" />
      </svg>
      <svg class="group-hover:rotate-[5deg] top-3 transition-transform absolute inset-0"
           xmlns="http://www.w3.org/2000/svg" width="233" height="84" viewBox="0 0 233 84" fill="none">
        <path opacity="0.4"
              d="M231.733 45.3991C231.578 50.8589 228.348 56.0671 222.427 60.8104C216.509 65.5512 207.979 69.7617 197.426 73.2153C176.327 80.1207 147.295 83.9515 115.338 83.0441C83.3819 82.1368 54.6134 76.6648 33.9402 68.5734C23.6006 64.5266 15.3234 59.8389 9.68401 54.7699C4.04172 49.6983 1.11204 44.3152 1.26706 38.8554C1.42208 33.3956 4.65249 28.1874 10.5735 23.4441C16.4914 18.7033 25.0213 14.4929 35.5738 11.0392C56.6728 4.13389 85.7054 0.30307 117.662 1.21042C149.618 2.11777 178.387 7.58975 199.06 15.6811C209.4 19.728 217.677 24.4156 223.316 29.4846C228.959 34.5562 231.888 39.9393 231.733 45.3991Z"
              stroke="white" stroke-width="1.41447" />
      </svg>
    </button>
  </div>
  <footer class="flex flex-col items-center self-stretch justify-center">
    <div
      class="relative flex w-full min-h-[31.25rem] flex-[1_0_0] flex-col items-center justify-center gap-[0.625rem] self-stretch">
      <div class="absolute inset-0 w-full h-full">
        <img class="w-full h-full object-cover" src="{{ asset('/assets/templates/1/map.png') }}" alt="map" />
      </div>
      <div
        class="relative flex flex-col items-start p-[1.25rem] w-[20.1875rem] gap-[0.625rem] bg-[rgba(255,255,255,0.08)]">
        <svg class="absolute left-[145px] tablet:-left-12 -top-12" xmlns="http://www.w3.org/2000/svg" width="32"
             height="33" viewBox="0 0 32 33" fill="none">
          <circle opacity="0.5" cx="16" cy="16.9546" r="15.5" stroke="#E1BC84" />
          <circle cx="16" cy="16.9546" r="8" fill="#E1BC84" />
        </svg>
        <span class="text-[1.25rem] font-semibold">10408 Madison Street, Fort Lilly 19797-5951</span>
        <div class="flex flex-col items-start gap-[0.25rem]">
          <span class="text-[0.875rem] font-thin tracking-[0.0625rem]">Mon. - Fri. : <span class="font-bold">09:00 - 23:00</span></span>
          <span class="text-[0.875rem] font-thin tracking-[0.0625rem]">Weekend : <span
              class="font-bold">09:00 - 23:00</span></span>
        </div>
      </div>
    </div>
    <div class="flex flex-col tablet:flex-row items-start self-stretch">
      <div
        class="flex tablet:w-[23.25rem] big-tablet:w-[31.25rem] laptop:w-[42.6875rem] desktop:max-w-[59.96875rem] p-[2.5rem_0.875rem] tablet:p-[2.5rem] big-tablet:p-[4.375rem_2.5rem] desktop:p-[4.375rem_7.5rem] tablet:flex-[1_0_0] bg-[#161616] flex-col justify-center items-center gap-[2.5rem] self-stretch">
        <div class="flex pt-[0.75rem] flex-col justify-center items-center self-stretch h-[6.25rem]">
          <span class="font-antic text-[2.875rem]">RESTAURANT</span>
          <div class="flex justify-center items-center gap-[1.4375rem] self-stretch">
            <span class="text-[1.5rem] tracking-[0.0625rem]">logo</span>
          </div>
        </div>
        <p class="text-center text-[#AAA] text-[0.875rem] font-thin tracking-[0.0625rem] leading-[170%]">Lorem ipsum
          dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat. Sed dui vestibulum posuere
          massa vulputate.</p>
        <div class="flex justify-center items-center self-stretch">
          <a href="#about"
             class="group min-w-48 flex p-[1rem_2.5rem] justify-center items-center gap-[0.875rem] text-[1rem] hover:text-white/80 transition-colors font-semibold">
            About Us
            <svg class="transition-transform group-hover:translate-x-[2px] group-hover:-translate-y-[2px]"
                 xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
              <path
                d="M0.55029 11.251L10.4498 1.35148M10.4498 1.35148C9.38912 3.35495 7.9042 7.99828 10.4498 10.5439M10.4498 1.35148C8.44632 2.41214 3.80298 3.89706 1.2574 1.35148"
                stroke="white" />
            </svg>
          </a>
          <svg xmlns="http://www.w3.org/2000/svg" width="2" height="42" viewBox="0 0 2 42" fill="none">
            <path opacity="0.1" d="M1 0.165039V41.165" stroke="white" />
          </svg>
          <a href="#menu"
             class="group flex p-[1rem_2.5rem] justify-center items-center gap-[0.875rem] text-[1rem] hover:text-white/80 transition-colors font-semibold">
            Menu
            <svg class="transition-transform group-hover:translate-x-[2px] group-hover:-translate-y-[2px]"
                 xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
              <path
                d="M0.55029 11.251L10.4498 1.35148M10.4498 1.35148C9.38912 3.35495 7.9042 7.99828 10.4498 10.5439M10.4498 1.35148C8.44632 2.41214 3.80298 3.89706 1.2574 1.35148"
                stroke="white" />
            </svg>
          </a>
        </div>
      </div>
      <div
        class="flex tablet:w-[23.25rem] big-tablet:w-[31.25rem] laptop:w-[42.6875rem] desktop:max-w-[59.96875rem] flex-col justify-center self-stretch bg-[#121212] items-center gap-[2.5rem] tablet:gap-[3.75rem] p-[2.5rem_0.875rem] tablet:flex-[1_0_0]">
        <div class="flex flex-col justify-center items-center gap-[0.875rem]">
          <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
            <path
              d="M4.87911 15.4255C3.65457 13.2903 3.06331 11.5467 2.7068 9.7794C2.17952 7.16554 3.38618 4.61221 5.38512 2.98299C6.22996 2.29441 7.19843 2.52967 7.69801 3.42593L8.82587 5.44934C9.71984 7.05315 10.1668 7.85505 10.0782 8.70522C9.98951 9.5554 9.38669 10.2478 8.18106 11.6327L4.87911 15.4255ZM4.87911 15.4255C7.35766 19.7473 11.2473 23.6391 15.5741 26.1205M15.5741 26.1205C17.7093 27.345 19.4528 27.9363 21.2202 28.2928C23.8341 28.8201 26.3874 27.6134 28.0166 25.6145C28.7052 24.7696 28.4699 23.8012 27.5737 23.3016L25.5503 22.1737C23.9464 21.2798 23.1445 20.8328 22.2944 20.9214C21.4442 21.0101 20.7518 21.6129 19.3669 22.8185L15.5741 26.1205Z"
              stroke="#E1BC84" stroke-width="1.5" stroke-linejoin="round" />
            <path
              d="M18.083 8.82439C19.9214 9.60506 21.3946 11.0782 22.1753 12.9166M18.9278 2.58325C23.4967 3.90173 27.0977 7.50259 28.4163 12.0714"
              stroke="#E1BC84" stroke-width="1.5" stroke-linecap="round" />
          </svg>
          <div class="flex flex-col justify-center items-center gap-[0.25rem]">
            <span class="text-[0.5rem] font-light uppercase tracking-[0.0625rem] text-[#AAA]">CALL US</span>
            <span class="text-[1rem] font-semibold">+1 232 222 4445 777</span>
            <span class="font-light text-[#AAA] text-[0.625rem] tracking-[0.0625rem]">Mon. - Fri. : <span
                class="font-bold">09:00 - 23:00</span></span>
          </div>
        </div>
        <svg class="tablet:hidden" xmlns="http://www.w3.org/2000/svg" width="365" height="2" viewBox="0 0 365 2"
             fill="none">
          <path opacity="0.1" d="M365 1L-3.8147e-06 0.999984" stroke="white" />
        </svg>
        <div class="flex gap-[1rem]">
          <a href="#"
             class="border border-1 hover:bg-white/20 transition-colors rounded-full p-[11px] gap-[10px] border-white/20">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
              <path
                d="M16.5 9.04277C16.5 5.15316 13.366 2 9.5 2C5.634 2 2.5 5.15316 2.5 9.04277C2.5 12.558 5.05979 15.4716 8.40625 16V11.0786H6.62891V9.04277H8.40625V7.49116C8.40625 5.72607 9.45135 4.75108 11.0502 4.75108C11.8162 4.75108 12.6172 4.88864 12.6172 4.88864V6.62183H11.7345C10.865 6.62183 10.5937 7.16475 10.5937 7.72173V9.04277H12.5351L12.2248 11.0786H10.5937V16C13.9402 15.4716 16.5 12.5581 16.5 9.04277Z"
                fill="white" />
            </svg>
          </a>
          <a href="#"
             class="border border-1 hover:bg-white/20 transition-colors rounded-full p-[11px] gap-[10px] border-white/20">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
              <path
                d="M13.3821 3.18213H15.4521L10.9296 8.26518L16.25 15.1821H12.0842L8.82133 10.9871L5.08792 15.1821H3.01658L7.85388 9.74523L2.75 3.18213H7.02159L9.97093 7.01659L13.3821 3.18213ZM12.6555 13.9637H13.8026L6.39831 4.33659H5.1674L12.6555 13.9637Z"
                fill="white" />
            </svg>
          </a>
          <a href="#"
             class="border border-1 hover:bg-white/20 transition-colors rounded-full p-[11px] gap-[10px] border-white/20">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
              <path
                d="M10.6102 2.6665C11.3695 2.66853 11.7549 2.67258 12.0877 2.68203L12.2186 2.68675C12.3698 2.69215 12.519 2.6989 12.6992 2.707C13.4173 2.74075 13.9074 2.85414 14.3373 3.02086C14.7828 3.1923 15.1581 3.42449 15.5334 3.7991C15.8766 4.13651 16.1422 4.54466 16.3116 4.99513C16.4783 5.42509 16.5917 5.91511 16.6255 6.63395C16.6336 6.81349 16.6403 6.96266 16.6457 7.11453L16.6498 7.24547C16.6599 7.57755 16.6639 7.96296 16.6653 8.72229L16.666 9.22582V10.11C16.6676 10.6023 16.6624 11.0947 16.6504 11.5868L16.6464 11.7178C16.641 11.8697 16.6342 12.0188 16.6261 12.1984C16.5924 12.9172 16.4776 13.4066 16.3116 13.8372C16.1426 14.2879 15.877 14.6962 15.5334 15.0332C15.1959 15.3763 14.7877 15.6419 14.3373 15.8115C13.9074 15.9782 13.4173 16.0916 12.6992 16.1253C12.539 16.1329 12.3788 16.1396 12.2186 16.1456L12.0877 16.1496C11.7549 16.1591 11.3695 16.1638 10.6102 16.1651L10.1066 16.1658H9.22311C8.73057 16.1675 8.23802 16.1623 7.74562 16.1503L7.61467 16.1462C7.45444 16.1402 7.29425 16.1332 7.1341 16.1253C6.41593 16.0916 5.92591 15.9782 5.49528 15.8115C5.04485 15.6423 4.63687 15.3767 4.29992 15.0332C3.95639 14.6959 3.69057 14.2878 3.52101 13.8372C3.35429 13.4072 3.2409 12.9172 3.20715 12.1984C3.19963 12.0382 3.19288 11.878 3.1869 11.7178L3.18352 11.5868C3.17109 11.0947 3.16546 10.6024 3.16665 10.11V8.72229C3.16477 8.22997 3.16972 7.73765 3.1815 7.24547L3.18622 7.11453C3.19162 6.96266 3.19837 6.81349 3.20647 6.63395C3.24022 5.91511 3.35361 5.42576 3.52033 4.99513C3.68982 4.54419 3.95617 4.13592 4.30059 3.7991C4.63746 3.45586 5.04518 3.19027 5.49528 3.02086C5.92591 2.85414 6.41526 2.74075 7.1341 2.707C7.31364 2.6989 7.46348 2.69215 7.61467 2.68675L7.74562 2.6827C8.23779 2.67071 8.73012 2.66554 9.22244 2.66718L10.6102 2.6665ZM9.9163 6.04133C9.02124 6.04133 8.16284 6.39689 7.52994 7.0298C6.89704 7.6627 6.54148 8.5211 6.54148 9.41616C6.54148 10.3112 6.89704 11.1696 7.52994 11.8025C8.16284 12.4354 9.02124 12.791 9.9163 12.791C10.8114 12.791 11.6698 12.4354 12.3027 11.8025C12.9356 11.1696 13.2911 10.3112 13.2911 9.41616C13.2911 8.5211 12.9356 7.6627 12.3027 7.0298C11.6698 6.39689 10.8114 6.04133 9.9163 6.04133ZM9.9163 7.39126C10.1822 7.39122 10.4455 7.44355 10.6912 7.54527C10.9369 7.64699 11.1602 7.7961 11.3482 7.9841C11.5363 8.1721 11.6855 8.3953 11.7873 8.64095C11.8891 8.88661 11.9415 9.14991 11.9415 9.41582C11.9416 9.68173 11.8893 9.94505 11.7875 10.1907C11.6858 10.4364 11.5367 10.6597 11.3487 10.8477C11.1607 11.0358 10.9375 11.185 10.6918 11.2868C10.4462 11.3886 10.1829 11.441 9.91698 11.4411C9.37994 11.4411 8.8649 11.2277 8.48516 10.848C8.10542 10.4682 7.89208 9.95319 7.89208 9.41616C7.89208 8.87912 8.10542 8.36408 8.48516 7.98434C8.8649 7.6046 9.37994 7.39126 9.91698 7.39126M13.4605 5.02888C13.2368 5.02888 13.0222 5.11777 12.864 5.276C12.7057 5.43422 12.6168 5.64882 12.6168 5.87259C12.6168 6.09635 12.7057 6.31095 12.864 6.46918C13.0222 6.62741 13.2368 6.7163 13.4605 6.7163C13.6843 6.7163 13.8989 6.62741 14.0571 6.46918C14.2154 6.31095 14.3043 6.09635 14.3043 5.87259C14.3043 5.64882 14.2154 5.43422 14.0571 5.276C13.8989 5.11777 13.6843 5.02888 13.4605 5.02888Z"
                fill="white" />
            </svg>
          </a>
          <a href="#"
             class="border border-1 hover:bg-white/20 transition-colors rounded-full p-[11px] gap-[10px] border-white/20">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
              <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M3.875 2.43213C3.25368 2.43213 2.75 2.93581 2.75 3.55713V14.8071C2.75 15.4284 3.25368 15.9321 3.875 15.9321H15.125C15.7463 15.9321 16.25 15.4284 16.25 14.8071V3.55713C16.25 2.93581 15.7463 2.43213 15.125 2.43213H3.875ZM6.89057 5.43417C6.89479 6.15136 6.35796 6.59327 5.72092 6.59011C5.1208 6.58694 4.59768 6.10917 4.60084 5.43523C4.60401 4.80136 5.10498 4.29194 5.75573 4.30671C6.41596 4.32148 6.89479 4.80558 6.89057 5.43417ZM9.70978 7.50345H7.81978H7.81872V13.9233H9.81627V13.7736C9.81627 13.4886 9.81605 13.2036 9.81582 12.9186C9.81522 12.1582 9.81455 11.397 9.81845 10.6369C9.8195 10.4523 9.8279 10.2604 9.87537 10.0842C10.0536 9.4261 10.6453 9.00108 11.3056 9.10555C11.7295 9.17193 12.01 9.4177 12.1281 9.81745C12.201 10.0674 12.2337 10.3363 12.2368 10.5969C12.2454 11.3826 12.2442 12.1683 12.243 12.954C12.2425 13.2314 12.2421 13.5089 12.2421 13.7862V13.9223H14.246V13.7683C14.246 13.4293 14.2458 13.0904 14.2456 12.7515C14.2452 11.9043 14.2448 11.0572 14.247 10.2098C14.2481 9.8269 14.207 9.44935 14.1131 9.07915C13.9729 8.52858 13.6828 8.07295 13.2114 7.74393C12.877 7.50977 12.51 7.35895 12.0997 7.34208C12.053 7.34014 12.0059 7.33759 11.9586 7.33504C11.7488 7.3237 11.5356 7.31218 11.335 7.35262C10.7613 7.46758 10.2572 7.7302 9.87642 8.19318C9.83217 8.24628 9.7889 8.3002 9.72432 8.38068L9.70978 8.3989V7.50345ZM4.76123 13.9254H6.74932V7.50763H4.76123V13.9254Z"
                    fill="white" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </footer>
</section>
