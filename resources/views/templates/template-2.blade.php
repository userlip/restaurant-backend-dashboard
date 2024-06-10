@php
$header = data_get($page_data, 'header');
$hero = data_get($page_data, 'hero_section');
$about = data_get($page_data, 'about_us_section');

//dd($header, $hero);
@endphp
<section class='mx-auto w-full max-w-[120rem]'>
  @if(data_get($hero, 'is_bg_image_visible') && data_get($hero, 'background_image'))
    <div
      style="background: url('{{ asset('/storage/' . data_get($hero, 'background_image')) }}') 50% / cover no-repeat;"
  @else
    <div
  @endif
    class="relative flex flex-col items-center self-stretch gap-[8.75rem] tablet:gap-[10rem] p-[3.75rem_0.875rem] tablet:p-[3.75rem_2.5rem] laptop:p-[3.75rem_4.375rem] min-h-[67.5rem] max-w-[100vw]">
    @if(data_get($header, 'is_header_visible'))
      <header class="flex w-full justify-between items-center self-stretch">
        <div class="flex flex-col items-center">
          @if($logo = data_get($header, 'header_logo'))
            <img src='{{ asset('/storage/' . $logo) }}'
                 class='w-[300px] h-auto'
                 alt='{{ data_get($header, 'restaurant_name') ?? config('app.name') }}'/>
          @else
            <span class="text-[2.5rem] text-white font-bold">
            {{ data_get($header, 'restaurant_name') }}
          </span>
          @endif
        </div>
        <div class="flex items-center self-stretch tablet:gap-[1.25rem] big-tablet:gap-[2.5rem] laptop:gap-[5rem] desktop:gap-[7.5rem]">
          <div class="hidden big-tablet:flex items-center gap-[1.25rem] laptop:gap-[2.5rem] self-stretch">
            @foreach(data_get($header, 'nav_links') as $link)
              <a href="{{ data_get($link, 'url') }}" class="p-[1rem_0rem] items-center justify-center gap-[0.625rem] text-white text-[1rem] laptop:text-[1.25rem] uppercase tracking-[0.03125rem] font-light hover:text-white/80 transition-colors">
                {{ data_get($link, 'label') }}
              </a>
            @endforeach
          </div>
          <div class="hidden big-tablet:flex items-center gap-[0.875rem]">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="41" viewBox="0 0 40 41" fill="none">
              <path d="M25.927 24.7462L25.1678 25.5453C25.1678 25.5453 23.3635 27.445 18.4385 22.2598C13.5135 17.0747 15.3178 15.1751 15.3178 15.1751L15.7959 14.6719C16.9735 13.4321 17.0845 11.4416 16.0571 9.9885L13.9554 7.01602C12.6838 5.2175 10.2266 4.97992 8.76908 6.5144L6.15308 9.26857C5.43038 10.0294 4.94608 11.0158 5.00481 12.1099C5.15506 14.9091 6.35118 20.9317 13.0256 27.9587C20.1035 35.4103 26.7447 35.7065 29.4605 35.4385C30.3195 35.3537 31.0665 34.8905 31.6685 34.2567L34.0362 31.764C35.6343 30.0815 35.1837 27.197 33.1388 26.02L29.9547 24.1872C28.612 23.4143 26.9763 23.6413 25.927 24.7462Z" fill="white"/>
              <path d="M22.0992 3.63297C22.2095 2.95149 22.8537 2.48921 23.5352 2.59952C23.5774 2.60761 23.7132 2.63297 23.7842 2.64881C23.9265 2.68049 24.1249 2.72924 24.3722 2.80129C24.8669 2.94536 25.5579 3.18271 26.3872 3.56292C28.0477 4.32419 30.2574 5.65586 32.5504 7.94886C34.8434 10.2419 36.175 12.4515 36.9362 14.112C37.3165 14.9414 37.5539 15.6324 37.6979 16.127C37.7699 16.3744 37.8187 16.5727 37.8504 16.7149C37.8662 16.7861 37.8779 16.8432 37.8859 16.8853L37.8955 16.9373C38.0057 17.6188 37.5477 18.2898 36.8662 18.4001C36.1867 18.5101 35.5465 18.0499 35.4335 17.3718C35.43 17.3534 35.4204 17.3046 35.4102 17.2584C35.3895 17.1661 35.354 17.0197 35.2977 16.8261C35.1849 16.4389 34.989 15.8634 34.6637 15.1539C34.014 13.7367 32.8457 11.7797 30.7825 9.71662C28.7195 7.65352 26.7625 6.48521 25.3454 5.83549C24.6359 5.51022 24.0604 5.31434 23.673 5.20154C23.4795 5.14516 23.2362 5.08931 23.1439 5.06876C22.4655 4.95571 21.9892 4.31251 22.0992 3.63297Z" fill="white"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M22.4762 9.38227C22.6659 8.71847 23.3577 8.33411 24.0215 8.52376L23.6782 9.72567C24.0215 8.52376 24.0215 8.52376 24.0215 8.52376L24.024 8.52446L24.0265 8.52519L24.032 8.52681L24.045 8.53067L24.078 8.54094C24.103 8.54897 24.1345 8.55944 24.1719 8.57272C24.2467 8.59929 24.3457 8.63706 24.467 8.68906C24.7099 8.79312 25.0415 8.95382 25.4492 9.19501C26.2649 9.67781 27.3785 10.4798 28.6869 11.7881C29.9952 13.0964 30.797 14.21 31.2799 15.0258C31.521 15.4333 31.6817 15.7651 31.7859 16.0079C31.8379 16.1292 31.8757 16.2281 31.9022 16.303C31.9155 16.3404 31.9259 16.3718 31.934 16.3969L31.9442 16.4299L31.948 16.4428L31.9497 16.4484L31.9504 16.4509C31.9504 16.4509 31.9512 16.4533 30.7492 16.7967L31.9512 16.4533C32.1409 17.1171 31.7564 17.8089 31.0927 17.9986C30.4345 18.1866 29.7487 17.8104 29.5522 17.157L29.546 17.139C29.5372 17.114 29.5189 17.0647 29.488 16.9927C29.4264 16.8488 29.3145 16.6134 29.1285 16.2991C28.7569 15.6712 28.0857 14.7224 26.919 13.5558C25.7525 12.3892 24.8037 11.7181 24.1759 11.3465C23.8615 11.1604 23.6262 11.0486 23.4822 10.9869C23.4102 10.9561 23.3609 10.9377 23.3359 10.9288L23.3179 10.9226C22.6645 10.7262 22.2882 10.0404 22.4762 9.38227Z" fill="white"/>
            </svg>
            <div class="flex text-white flex-col items-start gap-[0.125rem]">
              <span class="text-[1.25rem] font-bold">
                {{ data_get($header, 'call_us_contact_number') }}
              </span>
              <span class="font-inter font-light text-[0.625rem]">
                {!! data_get($header, 'call_us_operating_hours') !!}
              </span>
            </div>
          </div>
          @if(data_get($header, 'cta_label') && data_get($header, 'cta_link'))
            <a href='{{ data_get($header, 'cta_link') }}' class="hidden tablet:flex bg-white hover:bg-white/80 transition-colors text-template_2_primary text-[1rem] tracking-[0.03125rem] uppercase font-bold rounded-[3.8125rem] p-[1rem_2.5rem] justify-center items-center gap-[0.625rem]">
              {{ data_get($header, 'cta_label') }}
            </a>
          @endif
          <button id="drawer-button" class="flex big-tablet:hidden z-10 items-center justify-center">
            <svg class="fill-[fill: rgba(255,255,255,0.20)]" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
              <rect width="40" height="40" rx="20" fill="white" fill-opacity="0.2"/>
              <path d="M11.0613 25H29.0613M11.0613 15H29.0613" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </button>
        </div>
      </header>
    @endif
    @if(data_get($hero, 'is_visible'))
      <div class="flex text-white big-tablet:justify-between big-tablet:items-center p-[0rem_1.25rem] laptop:p-[0rem_5rem] desktop:p-[0rem_8.125rem] flex-col big-tablet:flex-row items-end self-stretch justify-center gap-[5rem]">
        <div class="flex flex-col self-stretch items-center tablet:items-start tablet:gap-[3.3125rem] justify-end tablet:justify-normal">
          <div class="flex text-center tablet:text-left flex-col justify-center items-center tablet:items-start gap-[1.25rem] self-stretch">
            <span class="font-inter text-[1rem] tracking-[0.125rem]">
              {{ data_get($hero, 'section_title') }}
            </span>
            <span class="text-[3.75rem] tablet:text-[5rem] desktop:text-[6.25rem] tracking-[-0.0625rem] uppercase">
              {{ data_get($hero, 'header') }}
            </span>
            <span class="font-inter text-[1rem] leading-[170%] font-medium tracking-[0.0625rem] tablet:flex tablet:flex-col">
              {!! data_get($hero, 'subtext') !!}
            </span>
          </div>
          @if(data_get($hero, 'is_our_menu_visible'))
            <a href="{{ data_get($hero, 'our_menu_link') }}" class="hidden w-fit tablet:flex text-[1.25rem] text-white font-bold tracking-[0.03125rem] uppercase p-[1.25rem_2.5rem] justify-center items-center gap-[0.625rem] self-stretch rounded-[19.6875rem] bg-template_2_primary hover:bg-template_2_primary/80 transition-colors">
              {{ data_get($hero, 'our_menu_title') }}
            </a>
          @endif
        </div>
        <div class="hidden tablet:flex big-tablet:flex-col big-tablet:items-end big-tablet:justify-normal justify-end items-start gap-[1rem]">
          @if($facebook = data_get($hero, 'facebook'))
          <a href="{{ $facebook }}" class="flex items-center justify-center h-[3.375rem] w-[3.375rem] bg-[rgba(255,255,255,0.20)] hover:bg-[rgba(255,255,255,0.10)] transition-colors p-[0.6875rem] gap-[0.625rem]">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
              <path d="M16.5 9.04277C16.5 5.15316 13.366 2 9.5 2C5.634 2 2.5 5.15316 2.5 9.04277C2.5 12.558 5.05979 15.4716 8.40625 16V11.0786H6.62891V9.04277H8.40625V7.49116C8.40625 5.72607 9.45135 4.75108 11.0502 4.75108C11.8162 4.75108 12.6172 4.88864 12.6172 4.88864V6.62183H11.7345C10.865 6.62183 10.5938 7.16475 10.5938 7.72173V9.04277H12.5351L12.2248 11.0786H10.5938V16C13.9402 15.4716 16.5 12.5581 16.5 9.04277Z" fill="white"/>
            </svg>
          </a>
          @endif
          @if($twitter = data_get($hero, 'x'))
          <a href="{{ $twitter }}" class="flex items-center justify-center h-[3.375rem] w-[3.375rem] bg-[rgba(255,255,255,0.20)] hover:bg-[rgba(255,255,255,0.10)] transition-colors p-[0.6875rem] gap-[0.625rem]">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
              <path d="M13.3821 3.18213H15.4521L10.9296 8.26518L16.25 15.1821H12.0842L8.82133 10.9871L5.08792 15.1821H3.01658L7.85388 9.74523L2.75 3.18213H7.02159L9.97093 7.01659L13.3821 3.18213ZM12.6555 13.9637H13.8026L6.39831 4.33659H5.1674L12.6555 13.9637Z" fill="white"/>
            </svg>
          </a>
          @endif
          @if($instagram = data_get($hero, 'instagram'))
          <a href="{{ $instagram }}" class="flex items-center justify-center h-[3.375rem] w-[3.375rem] bg-[rgba(255,255,255,0.20)] hover:bg-[rgba(255,255,255,0.10)] transition-colors p-[0.6875rem] gap-[0.625rem]">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
              <path d="M10.6102 2.6665C11.3695 2.66853 11.7549 2.67258 12.0877 2.68203L12.2186 2.68675C12.3698 2.69215 12.519 2.6989 12.6992 2.707C13.4173 2.74075 13.9074 2.85414 14.3373 3.02086C14.7828 3.1923 15.1581 3.42449 15.5334 3.7991C15.8766 4.13651 16.1422 4.54466 16.3116 4.99513C16.4783 5.42509 16.5917 5.91511 16.6255 6.63395C16.6336 6.81349 16.6403 6.96266 16.6457 7.11453L16.6498 7.24547C16.6599 7.57755 16.6639 7.96296 16.6653 8.72229L16.666 9.22582V10.11C16.6676 10.6023 16.6624 11.0947 16.6504 11.5868L16.6464 11.7178C16.641 11.8697 16.6342 12.0188 16.6261 12.1984C16.5924 12.9172 16.4776 13.4066 16.3116 13.8372C16.1426 14.2879 15.877 14.6962 15.5334 15.0332C15.1959 15.3763 14.7877 15.6419 14.3373 15.8115C13.9074 15.9782 13.4173 16.0916 12.6992 16.1253C12.539 16.1329 12.3788 16.1396 12.2186 16.1456L12.0877 16.1496C11.7549 16.1591 11.3695 16.1638 10.6102 16.1651L10.1066 16.1658H9.22311C8.73057 16.1675 8.23802 16.1623 7.74562 16.1503L7.61467 16.1462C7.45444 16.1402 7.29425 16.1332 7.1341 16.1253C6.41593 16.0916 5.92591 15.9782 5.49528 15.8115C5.04485 15.6423 4.63687 15.3767 4.29992 15.0332C3.95639 14.6959 3.69057 14.2878 3.52101 13.8372C3.35429 13.4072 3.2409 12.9172 3.20715 12.1984C3.19963 12.0382 3.19288 11.878 3.1869 11.7178L3.18352 11.5868C3.17109 11.0947 3.16546 10.6024 3.16665 10.11V8.72229C3.16477 8.22997 3.16972 7.73765 3.1815 7.24547L3.18622 7.11453C3.19162 6.96266 3.19837 6.81349 3.20647 6.63395C3.24022 5.91511 3.35361 5.42576 3.52033 4.99513C3.68982 4.54419 3.95617 4.13592 4.30059 3.7991C4.63746 3.45586 5.04518 3.19027 5.49528 3.02086C5.92591 2.85414 6.41526 2.74075 7.1341 2.707C7.31364 2.6989 7.46348 2.69215 7.61467 2.68675L7.74562 2.6827C8.23779 2.67071 8.73012 2.66554 9.22244 2.66718L10.6102 2.6665ZM9.9163 6.04133C9.02124 6.04133 8.16284 6.39689 7.52994 7.0298C6.89704 7.6627 6.54148 8.5211 6.54148 9.41616C6.54148 10.3112 6.89704 11.1696 7.52994 11.8025C8.16284 12.4354 9.02124 12.791 9.9163 12.791C10.8114 12.791 11.6698 12.4354 12.3027 11.8025C12.9356 11.1696 13.2911 10.3112 13.2911 9.41616C13.2911 8.5211 12.9356 7.6627 12.3027 7.0298C11.6698 6.39689 10.8114 6.04133 9.9163 6.04133ZM9.9163 7.39126C10.1822 7.39122 10.4455 7.44355 10.6912 7.54527C10.9369 7.64699 11.1602 7.7961 11.3482 7.9841C11.5363 8.1721 11.6855 8.3953 11.7873 8.64095C11.8891 8.88661 11.9415 9.14991 11.9415 9.41582C11.9416 9.68173 11.8893 9.94505 11.7875 10.1907C11.6858 10.4364 11.5367 10.6597 11.3487 10.8477C11.1607 11.0358 10.9375 11.185 10.6918 11.2868C10.4462 11.3886 10.1829 11.441 9.91698 11.4411C9.37994 11.4411 8.8649 11.2277 8.48516 10.848C8.10542 10.4682 7.89208 9.95319 7.89208 9.41616C7.89208 8.87912 8.10542 8.36408 8.48516 7.98434C8.8649 7.6046 9.37994 7.39126 9.91698 7.39126M13.4605 5.02888C13.2368 5.02888 13.0222 5.11777 12.864 5.276C12.7057 5.43422 12.6168 5.64882 12.6168 5.87259C12.6168 6.09635 12.7057 6.31095 12.864 6.46918C13.0222 6.62741 13.2368 6.7163 13.4605 6.7163C13.6843 6.7163 13.8989 6.62741 14.0571 6.46918C14.2154 6.31095 14.3043 6.09635 14.3043 5.87259C14.3043 5.64882 14.2154 5.43422 14.0571 5.276C13.8989 5.11777 13.6843 5.02888 13.4605 5.02888Z" fill="white"/>
            </svg>
          </a>
          @endif
          @if($linkedin = data_get($hero, '$linkedin'))
          <a href="{{ $linkedin }}" class="flex items-center justify-center h-[3.375rem] w-[3.375rem] bg-[rgba(255,255,255,0.20)] hover:bg-[rgba(255,255,255,0.10)] transition-colors p-[0.6875rem] gap-[0.625rem]">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M3.875 2.43213C3.25368 2.43213 2.75 2.93581 2.75 3.55713V14.8071C2.75 15.4284 3.25368 15.9321 3.875 15.9321H15.125C15.7463 15.9321 16.25 15.4284 16.25 14.8071V3.55713C16.25 2.93581 15.7463 2.43213 15.125 2.43213H3.875ZM6.89057 5.43417C6.89479 6.15136 6.35796 6.59327 5.72092 6.59011C5.1208 6.58694 4.59768 6.10917 4.60084 5.43523C4.60401 4.80136 5.10498 4.29194 5.75573 4.30671C6.41596 4.32148 6.89479 4.80558 6.89057 5.43417ZM9.70977 7.50345H7.81978H7.81872V13.9233H9.81627V13.7736C9.81627 13.4886 9.81605 13.2036 9.81582 12.9186C9.81522 12.1582 9.81455 11.397 9.81845 10.6369C9.8195 10.4523 9.8279 10.2604 9.87537 10.0842C10.0536 9.4261 10.6453 9.00108 11.3055 9.10555C11.7295 9.17193 12.01 9.4177 12.1281 9.81745C12.201 10.0674 12.2337 10.3363 12.2368 10.5969C12.2454 11.3826 12.2442 12.1683 12.243 12.954C12.2425 13.2314 12.2421 13.5089 12.2421 13.7862V13.9223H14.246V13.7683C14.246 13.4293 14.2458 13.0904 14.2456 12.7515C14.2452 11.9043 14.2448 11.0572 14.247 10.2098C14.2481 9.8269 14.207 9.44935 14.1131 9.07915C13.9729 8.52858 13.6828 8.07295 13.2114 7.74393C12.877 7.50977 12.51 7.35895 12.0997 7.34208C12.053 7.34014 12.0059 7.33759 11.9586 7.33504C11.7488 7.3237 11.5356 7.31218 11.335 7.35262C10.7613 7.46758 10.2572 7.7302 9.87642 8.19318C9.83217 8.24628 9.7889 8.3002 9.72433 8.38068L9.70977 8.3989V7.50345ZM4.76123 13.9254H6.74932V7.50763H4.76123V13.9254Z" fill="white"/>
            </svg>
          </a>
          @endif
        </div>
      </div>
    @endif
    @if(data_get($hero, 'is_our_menu_visible'))
      <a href="{{ data_get($hero, 'our_menu_link') }}" class="tablet:hidden flex text-[1.25rem] text-white font-bold tracking-[0.03125rem] uppercase p-[1.25rem_2.5rem] justify-center items-center gap-[0.625rem] self-stretch rounded-[19.6875rem] bg-template_2_primary hover:bg-template_2_primary/80 transition-colors">
        {{ data_get($hero, 'our_menu_title') }}
      </a>
    @endif
    <div class="tablet:hidden absolute w-[13.41769rem] h-[13.75313rem] left-[-3.60525rem] bottom-[1.79688rem]">
      <div class="absolute top-0 -left-1 w-[7.52881rem] h-[7.04431rem] shrink-0">
        <img src="/assets/templates/2/asset-02.png" alt="asset" class="w-full h-full object-cover">
      </div>
      <div class="absolute top-[20px] left-2 w-[11.88956rem] h-[12.74681rem] shrink-0">
        <img src="/assets/templates/2/asset-01.png" alt="asset" class="w-full h-full object-cover">
      </div>
    </div>
  </div>
  <div id="drawer" class="flex bg-white tablet:my-auto flex-col big-tablet:hidden items-center justify-between p-[3.75rem_0.875rem] shrink-0 self-stretch fixed inset-0 h-[100dvh] w-screen z-40 transition-transform -translate-y-[150dvh] duration-300 ease-in-out">
    <div class="absolute top-[3.75rem] right-[0.875rem] tablet:right-[2.5rem] flex w-full items-center justify-end">
      <button id="close-drawer" class="flex justify-center items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
          <rect width="40" height="40" rx="20" fill="#546C76" fill-opacity="0.2"/>
          <path d="M14.9998 15.5L24.9998 25.5M24.9998 15.5L14.9998 25.5" stroke="#546C76" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </button>
    </div>
    <div class="flex pt-[2.5rem] w-full flex-col items-center justify-center gap-[1.25rem]">
      @foreach(data_get($header, 'nav_links') as $link)
        <a
          href='{{ data_get($link, 'url') }}'
          id="button-{{ \Illuminate\Support\Str::slug(data_get($link, 'label')) }}" class="flex font-light items-center justify-center p-[1rem_0rem] gap-[0.625rem] text-center text-template_2_alt hover:text-template_2_alt/80 transition-colors text-[1.25rem] uppercase tracking-[0.03125rem]">
          {{ data_get($link, 'label') }}
        </a>
      @endforeach
    </div>
    <div class="flex flex-col justify-center self-stretch items-center gap-[1.25rem]">
      <svg class="tablet:hidden" xmlns="http://www.w3.org/2000/svg" width="365" height="1" viewBox="0 0 365 1" fill="none">
        <path opacity="0.2" d="M365 0.5L-4.76837e-06 0.499984" stroke="#708086"/>
      </svg>
      <svg class="hidden tablet:block" xmlns="http://www.w3.org/2000/svg" width="716" height="2" viewBox="0 0 716 2" fill="none">
        <path opacity="0.2" d="M716 1L-5.72205e-06 0.999969" stroke="#708086"/>
      </svg>
      <div class="flex flex-col justify-center items-center self-stretch gap-[0.875rem]">
        <svg xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41" fill="none">
          <path d="M26.427 24.7462L25.6678 25.5453C25.6678 25.5453 23.8635 27.445 18.9385 22.2598C14.0135 17.0747 15.8178 15.1751 15.8178 15.1751L16.2959 14.6719C17.4735 13.4321 17.5845 11.4416 16.5571 9.9885L14.4554 7.01602C13.1838 5.2175 10.7266 4.97992 9.26908 6.5144L6.65308 9.26857C5.93038 10.0294 5.44608 11.0158 5.50481 12.1099C5.65506 14.9091 6.85118 20.9317 13.5256 27.9587C20.6035 35.4103 27.2447 35.7065 29.9605 35.4385C30.8195 35.3537 31.5665 34.8905 32.1685 34.2567L34.5362 31.764C36.1343 30.0815 35.6837 27.197 33.6388 26.02L30.4547 24.1872C29.112 23.4143 27.4763 23.6413 26.427 24.7462Z" fill="#D82217"/>
          <path d="M22.5991 3.63297C22.7094 2.95149 23.3536 2.48921 24.0351 2.59952C24.0772 2.60761 24.2131 2.63297 24.2841 2.64881C24.4264 2.68049 24.6247 2.72924 24.8721 2.80129C25.3667 2.94536 26.0577 3.18271 26.8871 3.56292C28.5476 4.32419 30.7572 5.65586 33.0502 7.94886C35.3432 10.2419 36.6749 12.4515 37.4361 14.112C37.8164 14.9414 38.0537 15.6324 38.1977 16.127C38.2697 16.3744 38.3186 16.5727 38.3502 16.7149C38.3661 16.7861 38.3777 16.8432 38.3857 16.8853L38.3954 16.9373C38.5056 17.6188 38.0476 18.2898 37.3661 18.4001C36.6866 18.5101 36.0464 18.0499 35.9334 17.3718C35.9299 17.3534 35.9202 17.3046 35.9101 17.2584C35.8894 17.1661 35.8539 17.0197 35.7976 16.8261C35.6847 16.4389 35.4889 15.8634 35.1636 15.1539C34.5139 13.7367 33.3456 11.7797 31.2824 9.71662C29.2194 7.65352 27.2624 6.48521 25.8452 5.83549C25.1357 5.51022 24.5602 5.31434 24.1729 5.20154C23.9794 5.14516 23.7361 5.08931 23.6437 5.06876C22.9654 4.95571 22.4891 4.31251 22.5991 3.63297Z" fill="#D82217"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M22.9761 9.38227C23.1658 8.71847 23.8576 8.33411 24.5215 8.52376L24.1781 9.72567C24.5215 8.52376 24.5215 8.52376 24.5215 8.52376L24.524 8.52446L24.5265 8.52519L24.532 8.52681L24.545 8.53067L24.578 8.54094C24.603 8.54897 24.6345 8.55944 24.6718 8.57272C24.7466 8.59929 24.8456 8.63706 24.967 8.68906C25.2098 8.79312 25.5415 8.95382 25.9491 9.19501C26.7648 9.67781 27.8785 10.4798 29.1868 11.7881C30.4951 13.0964 31.297 14.21 31.7798 15.0258C32.021 15.4333 32.1816 15.7651 32.2858 16.0079C32.3378 16.1292 32.3756 16.2281 32.4021 16.303C32.4155 16.3404 32.4258 16.3718 32.434 16.3969L32.4441 16.4299L32.448 16.4428L32.4496 16.4484L32.4503 16.4509C32.4503 16.4509 32.4511 16.4533 31.2491 16.7967L32.4511 16.4533C32.6408 17.1171 32.2563 17.8089 31.5926 17.9986C30.9345 18.1866 30.2486 17.8104 30.0521 17.157L30.046 17.139C30.0371 17.114 30.0188 17.0647 29.988 16.9927C29.9263 16.8488 29.8145 16.6134 29.6285 16.2991C29.2568 15.6712 28.5856 14.7224 27.419 13.5558C26.2525 12.3892 25.3036 11.7181 24.6758 11.3465C24.3615 11.1604 24.1261 11.0486 23.9821 10.9869C23.9101 10.9561 23.8608 10.9377 23.8358 10.9288L23.8178 10.9226C23.1645 10.7262 22.7881 10.0404 22.9761 9.38227Z" fill="#D82217"/>
        </svg>
        <div class="flex flex-col justify-center items-center gap-[0.625rem]">
          <span class="text-[1.25rem] text-template_2_alt font-bold">
            {{ data_get($header, 'call_us_contact_number') }}
          </span>
          <span class="font-light font-inter text-template_2_primary text-[0.875rem] tracking-[0.0625rem]">
          {!! data_get($header, 'call_us_operating_hours') !!}
        </div>
      </div>
      <svg class="tablet:hidden" xmlns="http://www.w3.org/2000/svg" width="365" height="1" viewBox="0 0 365 1" fill="none">
        <path opacity="0.2" d="M365 0.5L-4.76837e-06 0.499984" stroke="#708086"/>
      </svg>
      <svg class="hidden tablet:block" xmlns="http://www.w3.org/2000/svg" width="716" height="2" viewBox="0 0 716 2" fill="none">
        <path opacity="0.2" d="M716 1L-5.72205e-06 0.999969" stroke="#708086"/>
      </svg>
      <div class="flex flex-col justify-center items-center gap-[0.875rem]">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="35" viewBox="0 0 25 35" fill="none">
          <path d="M12.5 34.5C12.5 34.5 0.5 18.979 0.5 12.4C0.5 10.8373 0.810389 9.28984 1.41345 7.84607C2.0165 6.40229 2.90042 5.09045 4.01472 3.98543C5.12902 2.88041 6.45189 2.00386 7.9078 1.40583C9.36371 0.807803 10.9241 0.5 12.5 0.5C14.0759 0.5 15.6363 0.807803 17.0922 1.40583C18.5481 2.00386 19.871 2.88041 20.9853 3.98543C22.0996 5.09045 22.9835 6.40229 23.5866 7.84607C24.1896 9.28984 24.5 10.8373 24.5 12.4C24.5 18.979 12.5 34.5 12.5 34.5ZM12.5 15.8C13.4093 15.8 14.2814 15.4418 14.9244 14.8042C15.5673 14.1665 15.9286 13.3017 15.9286 12.4C15.9286 11.4983 15.5673 10.6335 14.9244 9.99584C14.2814 9.35821 13.4093 9 12.5 9C11.5907 9 10.7186 9.35821 10.0756 9.99584C9.43265 10.6335 9.07143 11.4983 9.07143 12.4C9.07143 13.3017 9.43265 14.1665 10.0756 14.8042C10.7186 15.4418 11.5907 15.8 12.5 15.8Z" fill="#D82217"/>
        </svg>
        <div class="flex flex-col justify-center items-center gap-[0.625rem]">
          <span class="text-[1.25rem] text-template_2_alt text-center font-bold">
            {{ data_get($header, 'call_us_address') }}
          </span>
        </div>
      </div>
      <div class="flex justify-center items-center gap-[0.625rem] self-stretch">
        <div class="flex flex-col items-center gap-[0.625rem] flex-[1_0_0]">
          <span class="font-open text-[0.875rem] tracking-[0.0625rem] leading-[170%] text-center text-template_2_body">
            {{ data_get($header, 'weekday_operating_days') }}
          </span>
          <span class="text-template_2_primary font-bold text-[1.25rem] tracking-[0.03125rem]">
            {!! data_get($header, 'weekday_operating_hours') !!}
          </span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="1" height="49" viewBox="0 0 1 49" fill="none">
          <path opacity="0.2" d="M0.5 0.5L0.500002 48.5" stroke="#708086"/>
        </svg>
        <div class="flex flex-col items-center gap-[0.625rem] flex-[1_0_0]">
          <span class="font-open text-[0.875rem] tracking-[0.0625rem] leading-[170%] text-center text-template_2_body">
            {{ data_get($header, 'weekend_operating_days') }}
          </span>
          <span class="text-template_2_primary font-bold text-[1.25rem] tracking-[0.03125rem]">
            {!! data_get($header, 'weekend_operating_hours') !!}
          </span>
        </div>
      </div>
      <svg class="tablet:hidden" xmlns="http://www.w3.org/2000/svg" width="365" height="1" viewBox="0 0 365 1" fill="none">
        <path opacity="0.2" d="M365 0.5L-4.76837e-06 0.499984" stroke="#708086"/>
      </svg>
      <svg class="hidden tablet:block" xmlns="http://www.w3.org/2000/svg" width="716" height="2" viewBox="0 0 716 2" fill="none">
        <path opacity="0.2" d="M716 1L-5.72205e-06 0.999969" stroke="#708086"/>
      </svg>
      <div class="flex gap-[1rem]">
        @if($facebook = data_get($hero, 'facebook'))
          <a href="{{ $facebook }}" class="flex items-center justify-center h-[3.375rem] w-[3.375rem] bg-[rgba(255,255,255,0.20)] hover:bg-[rgba(255,255,255,0.10)] transition-colors p-[0.6875rem] gap-[0.625rem]">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
              <path d="M16.5 9.04277C16.5 5.15316 13.366 2 9.5 2C5.634 2 2.5 5.15316 2.5 9.04277C2.5 12.558 5.05979 15.4716 8.40625 16V11.0786H6.62891V9.04277H8.40625V7.49116C8.40625 5.72607 9.45135 4.75108 11.0502 4.75108C11.8162 4.75108 12.6172 4.88864 12.6172 4.88864V6.62183H11.7345C10.865 6.62183 10.5938 7.16475 10.5938 7.72173V9.04277H12.5351L12.2248 11.0786H10.5938V16C13.9402 15.4716 16.5 12.5581 16.5 9.04277Z" fill="white"/>
            </svg>
          </a>
        @endif
        @if($twitter = data_get($hero, 'x'))
          <a href="{{ $twitter }}" class="flex items-center justify-center h-[3.375rem] w-[3.375rem] bg-[rgba(255,255,255,0.20)] hover:bg-[rgba(255,255,255,0.10)] transition-colors p-[0.6875rem] gap-[0.625rem]">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
              <path d="M13.3821 3.18213H15.4521L10.9296 8.26518L16.25 15.1821H12.0842L8.82133 10.9871L5.08792 15.1821H3.01658L7.85388 9.74523L2.75 3.18213H7.02159L9.97093 7.01659L13.3821 3.18213ZM12.6555 13.9637H13.8026L6.39831 4.33659H5.1674L12.6555 13.9637Z" fill="white"/>
            </svg>
          </a>
        @endif
        @if($instagram = data_get($hero, 'instagram'))
          <a href="{{ $instagram }}" class="flex items-center justify-center h-[3.375rem] w-[3.375rem] bg-[rgba(255,255,255,0.20)] hover:bg-[rgba(255,255,255,0.10)] transition-colors p-[0.6875rem] gap-[0.625rem]">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
              <path d="M10.6102 2.6665C11.3695 2.66853 11.7549 2.67258 12.0877 2.68203L12.2186 2.68675C12.3698 2.69215 12.519 2.6989 12.6992 2.707C13.4173 2.74075 13.9074 2.85414 14.3373 3.02086C14.7828 3.1923 15.1581 3.42449 15.5334 3.7991C15.8766 4.13651 16.1422 4.54466 16.3116 4.99513C16.4783 5.42509 16.5917 5.91511 16.6255 6.63395C16.6336 6.81349 16.6403 6.96266 16.6457 7.11453L16.6498 7.24547C16.6599 7.57755 16.6639 7.96296 16.6653 8.72229L16.666 9.22582V10.11C16.6676 10.6023 16.6624 11.0947 16.6504 11.5868L16.6464 11.7178C16.641 11.8697 16.6342 12.0188 16.6261 12.1984C16.5924 12.9172 16.4776 13.4066 16.3116 13.8372C16.1426 14.2879 15.877 14.6962 15.5334 15.0332C15.1959 15.3763 14.7877 15.6419 14.3373 15.8115C13.9074 15.9782 13.4173 16.0916 12.6992 16.1253C12.539 16.1329 12.3788 16.1396 12.2186 16.1456L12.0877 16.1496C11.7549 16.1591 11.3695 16.1638 10.6102 16.1651L10.1066 16.1658H9.22311C8.73057 16.1675 8.23802 16.1623 7.74562 16.1503L7.61467 16.1462C7.45444 16.1402 7.29425 16.1332 7.1341 16.1253C6.41593 16.0916 5.92591 15.9782 5.49528 15.8115C5.04485 15.6423 4.63687 15.3767 4.29992 15.0332C3.95639 14.6959 3.69057 14.2878 3.52101 13.8372C3.35429 13.4072 3.2409 12.9172 3.20715 12.1984C3.19963 12.0382 3.19288 11.878 3.1869 11.7178L3.18352 11.5868C3.17109 11.0947 3.16546 10.6024 3.16665 10.11V8.72229C3.16477 8.22997 3.16972 7.73765 3.1815 7.24547L3.18622 7.11453C3.19162 6.96266 3.19837 6.81349 3.20647 6.63395C3.24022 5.91511 3.35361 5.42576 3.52033 4.99513C3.68982 4.54419 3.95617 4.13592 4.30059 3.7991C4.63746 3.45586 5.04518 3.19027 5.49528 3.02086C5.92591 2.85414 6.41526 2.74075 7.1341 2.707C7.31364 2.6989 7.46348 2.69215 7.61467 2.68675L7.74562 2.6827C8.23779 2.67071 8.73012 2.66554 9.22244 2.66718L10.6102 2.6665ZM9.9163 6.04133C9.02124 6.04133 8.16284 6.39689 7.52994 7.0298C6.89704 7.6627 6.54148 8.5211 6.54148 9.41616C6.54148 10.3112 6.89704 11.1696 7.52994 11.8025C8.16284 12.4354 9.02124 12.791 9.9163 12.791C10.8114 12.791 11.6698 12.4354 12.3027 11.8025C12.9356 11.1696 13.2911 10.3112 13.2911 9.41616C13.2911 8.5211 12.9356 7.6627 12.3027 7.0298C11.6698 6.39689 10.8114 6.04133 9.9163 6.04133ZM9.9163 7.39126C10.1822 7.39122 10.4455 7.44355 10.6912 7.54527C10.9369 7.64699 11.1602 7.7961 11.3482 7.9841C11.5363 8.1721 11.6855 8.3953 11.7873 8.64095C11.8891 8.88661 11.9415 9.14991 11.9415 9.41582C11.9416 9.68173 11.8893 9.94505 11.7875 10.1907C11.6858 10.4364 11.5367 10.6597 11.3487 10.8477C11.1607 11.0358 10.9375 11.185 10.6918 11.2868C10.4462 11.3886 10.1829 11.441 9.91698 11.4411C9.37994 11.4411 8.8649 11.2277 8.48516 10.848C8.10542 10.4682 7.89208 9.95319 7.89208 9.41616C7.89208 8.87912 8.10542 8.36408 8.48516 7.98434C8.8649 7.6046 9.37994 7.39126 9.91698 7.39126M13.4605 5.02888C13.2368 5.02888 13.0222 5.11777 12.864 5.276C12.7057 5.43422 12.6168 5.64882 12.6168 5.87259C12.6168 6.09635 12.7057 6.31095 12.864 6.46918C13.0222 6.62741 13.2368 6.7163 13.4605 6.7163C13.6843 6.7163 13.8989 6.62741 14.0571 6.46918C14.2154 6.31095 14.3043 6.09635 14.3043 5.87259C14.3043 5.64882 14.2154 5.43422 14.0571 5.276C13.8989 5.11777 13.6843 5.02888 13.4605 5.02888Z" fill="white"/>
            </svg>
          </a>
        @endif
        @if($linkedin = data_get($hero, '$linkedin'))
          <a href="{{ $linkedin }}" class="flex items-center justify-center h-[3.375rem] w-[3.375rem] bg-[rgba(255,255,255,0.20)] hover:bg-[rgba(255,255,255,0.10)] transition-colors p-[0.6875rem] gap-[0.625rem]">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M3.875 2.43213C3.25368 2.43213 2.75 2.93581 2.75 3.55713V14.8071C2.75 15.4284 3.25368 15.9321 3.875 15.9321H15.125C15.7463 15.9321 16.25 15.4284 16.25 14.8071V3.55713C16.25 2.93581 15.7463 2.43213 15.125 2.43213H3.875ZM6.89057 5.43417C6.89479 6.15136 6.35796 6.59327 5.72092 6.59011C5.1208 6.58694 4.59768 6.10917 4.60084 5.43523C4.60401 4.80136 5.10498 4.29194 5.75573 4.30671C6.41596 4.32148 6.89479 4.80558 6.89057 5.43417ZM9.70977 7.50345H7.81978H7.81872V13.9233H9.81627V13.7736C9.81627 13.4886 9.81605 13.2036 9.81582 12.9186C9.81522 12.1582 9.81455 11.397 9.81845 10.6369C9.8195 10.4523 9.8279 10.2604 9.87537 10.0842C10.0536 9.4261 10.6453 9.00108 11.3055 9.10555C11.7295 9.17193 12.01 9.4177 12.1281 9.81745C12.201 10.0674 12.2337 10.3363 12.2368 10.5969C12.2454 11.3826 12.2442 12.1683 12.243 12.954C12.2425 13.2314 12.2421 13.5089 12.2421 13.7862V13.9223H14.246V13.7683C14.246 13.4293 14.2458 13.0904 14.2456 12.7515C14.2452 11.9043 14.2448 11.0572 14.247 10.2098C14.2481 9.8269 14.207 9.44935 14.1131 9.07915C13.9729 8.52858 13.6828 8.07295 13.2114 7.74393C12.877 7.50977 12.51 7.35895 12.0997 7.34208C12.053 7.34014 12.0059 7.33759 11.9586 7.33504C11.7488 7.3237 11.5356 7.31218 11.335 7.35262C10.7613 7.46758 10.2572 7.7302 9.87642 8.19318C9.83217 8.24628 9.7889 8.3002 9.72433 8.38068L9.70977 8.3989V7.50345ZM4.76123 13.9254H6.74932V7.50763H4.76123V13.9254Z" fill="white"/>
            </svg>
          </a>
        @endif
      </div>
    </div>
  </div>
  @if(data_get($about, 'is_section_visible'))
    <div id="about" class="flex tablet:justify-between self-stretch items-center tablet:pl-[2.5rem] big-tablet:pl-[3.75rem] laptop:pl-[9.375rem] desktop:pl-[23.125rem]">
      @if(data_get($about, 'is_left_section_visible'))
        <div class="flex flex-col overflow-hidden items-center justify-center gap-[1.875rem] self-stretch p-[0rem_0.875rem_3.75rem_0.875rem]">
          <div class="flex flex-col items-center justify-center tablet:justify-normal tablet:items-start text-center tablet:text-left gap-[1.875rem] self-stretch">
            <h1 class="font-inter text-template_2_body uppercase tracking-[0.125rem] text-[0.875rem]">
              {{ data_get($about, 'section_title') }}
            </h1>
            <h2 class="self-stretch text-template_2_secondary mx-auto tablet:mx-0 text-[2.5rem] desktop:text-[3.75rem] tracking-[0.03125rem] leading-tight w-[360px] desktop:w-[500px] uppercase">
              {{ data_get($about, 'header') }}
              <span class="text-template_2_primary">
                {{ data_get($about, 'header_red_text') }}
              </span>
            </h2>
          </div>
          <div class="tablet:hidden relative w-[27.8125rem] h-[22.625rem]">
            <img src="{{ asset('/storage/' . data_get($about, 'background_image')) }}" alt="dish" class="object-cover w-full h-full"/>
          </div>
          <div class="flex flex-col big-tablet:flex-row pb-[1.25rem] gap-[1.25rem] self-stretch">
            <span class="font-open text-template_2_body text-[0.875rem] tracking-[0.0625rem] leading-[170%]">
              {{ data_get($about, 'subtext_left') }}
            </span>
            <span class="font-open text-template_2_body text-[0.875rem] tracking-[0.0625rem] leading-[170%]">
              {{ data_get($about, 'subtext_right') }}
            </span>
          </div>
          @if(data_get($about, 'is_our_menu_visible'))
            <a href="{{ data_get($about, 'our_menu_link') }}" class="tablet:w-fit flex text-[1.25rem] text-white font-bold tracking-[0.03125rem] uppercase p-[1.25rem_2.5rem] justify-center items-center gap-[0.625rem] self-stretch rounded-[19.6875rem] bg-template_2_primary hover:bg-template_2_primary/80 transition-colors">
              {{ data_get($about, 'our_menu_title') }}
            </a>
          @endif
        </div>
      @endif
      @if(data_get($about, 'is_right_section_visible'))
      <div class="relative hidden tablet:block min-w-[20.875rem] big-tablet:min-w-[24.375rem] laptop:min-w-[38.375rem] desktop:min-w-[63.1875rem] h-[35.5625rem] big-tablet:h-[40.625rem] laptop:h-[51.75rem]">
        <img src="{{ asset('/storage/' . data_get($about, 'background_image')) }}" alt="dish" class="absolute -z-10 scale-[2] big-tablet:scale-[2.2] laptop:scale-[1.5] desktop:scale-100 object-contain left-12 desktop:left-0 -top-8 h-[35.5625rem] big-tablet:h-[40.625rem] w-[43rem] big-tablet:w-[50rem] laptop:h-[51.75rem] laptop:w-[63rem] desktop:w-[63.1875rem]"/>
      </div>
      @endif
    </div>
  @endif
  <div class="about text-white flex min-h-[56.375rem] tablet:min-h-[50rem] flex-col p-[16rem_0.875rem] tablet:p-[16rem_3.75rem] laptop:p-[16rem_9.375rem] desktop:p-[16rem_23.125rem] justify-center tablet:justify-end tablet:items-end items-center gap-[0.625rem] self-stretch">
    <div class="flex gap-[3.75rem] tablet:flex-initial flex-[1_0_0] max-w-[43.75rem] tablet:w-[30.75rem] flex-col items-start">
      <div class="flex flex-col items-start gap-[1.875rem] self-stretch">
        <div class="flex flex-col text-center tablet:text-left items-center tablet:items-start justify-center gap-[1.875rem] self-stretch">
          <span class="font-inter uppercase tracking-[0.3125rem] text-[0.875rem]">About Us</span>
          <span class="text-[2.5rem] desktop:text-[3.75rem] tracking-[0.03125rem] uppercase">Our Story</span>
        </div>
        <div class="flex flex-col tablet:flex-row gap-[1.25rem] self-stretch">
          <span class="font-open text-[0.875rem] leading-[170%] tracking-[0.0625rem]">Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat. Sed dui vestibulum posuere massa vulputate. Enim volutpat amet enim venenatis pharetra. Eget accumsan massa amet faucibus.</span>
          <span class="font-open text-[0.875rem] leading-[170%] tracking-[0.0625rem]">Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat. Sed dui vestibulum posuere massa vulputate. Enim volutpat amet enim venenatis pharetra. Eget accumsan massa amet faucibus.</span>
        </div>
      </div>
      <div class="flex flex-col tablet:flex-row gap-[1.25rem] items-center tablet:justify-start justify-center self-stretch">
        <button class="tablet:w-fit flex text-[1.25rem] text-white font-bold tracking-[0.03125rem] uppercase p-[1.25rem_2.5rem] justify-center items-center gap-[0.625rem] self-stretch rounded-[19.6875rem] bg-template_2_primary hover:bg-template_2_primary/80 transition-colors">
          BOOK A TABLE
        </button>
        <button class="font-inter flex text-[1.25rem] font-bold tracking-[0.03125rem] p-[1rem_1.25rem] justify-center items-center gap-[0.875rem] self-stretch rounded-[19.6875rem] text-white hover:text-white/80 transition-colors">
          Learn More
        </button>
      </div>
    </div>
  </div>
  <div id="menu" class="relative flex items-center justify-center p-[3.75rem_0.875rem] tablet:p-[3.75rem_2.5rem] laptop:p-[6.25rem_9.375rem] desktop:p-[6.25rem_23.125rem] self-stretch">
    <div class="absolute w-[25.9375rem] tablet:w-[47.6875rem] h-[17.25rem] tablet:h-[31.75rem] right-0 bottom-0">
      <img src="/assets/templates/2/graphic.png" alt="graphic" class="object-cover w-full h-full"/>
    </div>
    <div class="flex flex-col justify-center items-center flex-[1_0_0] gap-[5rem]">
      <div class="flex flex-col items-center self-stretch text-center gap-[1.875rem]">
        <h1 class="font-inter text-template_2_body tracking-[0.3125rem] uppercase">Explore</h1>
        <h2 class="text-template_2_secondary text-[2.5rem] desktop:text-[3.75rem] tracking-[0.03125rem]">Our Menu</h2>
      </div>
      <div class="relative h-[31.25rem] self-stretch">
        <img src="/assets/templates/2/asset-04.jpg" alt="dish" class="object-cover w-full h-full"/>
      </div>
      <button href="#menu" class="z-10 w-fit mx-auto flex text-[1.25rem] text-white font-bold tracking-[0.03125rem] uppercase p-[1.25rem_2.5rem] justify-center items-center gap-[0.625rem] self-stretch rounded-[19.6875rem] bg-template_2_primary hover:bg-template_2_primary/80 transition-colors">
        Download Menu (PDF)
      </button>
    </div>
  </div>
  <div class="flex flex-col items-center self-stretch pb-[3.75rem] overflow-hidden">
    <div class="contact"></div>
    <div class="flex mt-[-39.5rem] z-10 flex-col justify-center items-center self-stretch gap-[4.25rem] p-[6.25rem_0.875rem_0rem_0.875rem] tablet:p-[6.25rem_2.5rem_0rem_2.5rem] big-tablet:p-[6.25rem_3.75rem_0rem_3.75rem] laptop:p-[6.25rem_9.375rem_0rem_9.375rem] desktop:p-[6.25rem_23.125rem_0rem_23.125rem]">
      <div class="flex flex-col justify-center items-center gap-[0.625rem] self-stretch">
        <div class="text-white text-center flex flex-col items-center self-stretch gap-[1.0625rem]">
          <div class="flex flex-col items-center gap-[1.875rem]">
            <h1 class="font-inter text-[0.875rem] tracking-[0.3125rem] uppercase">Contacts</h1>
            <h2 class="text-[2.5rem] desktop:text-[3.75rem] tracking-[0.03125rem] uppercase">Contact Us</h2>
          </div>
          <p class="font-open font-medium text-[1rem] leading-[170%] tracking-[0.0625rem] tablet:flex tablet:flex-col">Lorem ipsum dolor sit amet consectetur. Gravida <span>accumsan accumsan et lectus ipsum nulla erat.</span></p>
        </div>
      </div>
      <div class="flex flex-col bg-white p-[1.25rem] tablet:p-[3.75rem] gap-[2.5rem] tablet:gap-[3.75rem] self-stretch">
        <div class="flex flex-col items-start gap-[1.25rem] self-stretch">
          <div class="flex tablet:flex-row flex-col items-start gap-[0.625rem] self-stretch">
            <div class="flex flex-1 flex-col gap-[0.625rem] self-stretch">
              <label for="name" class="text-template_2_alt font-inter leading-[120%] tracking-[0.0625rem] text-[0.75rem]">Full Name</label>
              <div class="flex self-stretch flex-[1_0_0] w-full justify-between items-center p-[0.625rem_0.875rem] bg-[#F2F3F7] ">
                <input type="text" id="name" class="w-full font-inter text-[1.125rem] font-thin italic leading-[150%] tracking-[0.0625rem] bg-transparent border-none outline-none" placeholder="John Jackson" />
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                  <g opacity="0.2">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.12856 3.3355L4.28906 8.175C4.22056 8.244 4.17306 8.331 4.15356 8.426L3.41006 11.9685C3.37556 12.133 3.42606 12.304 3.54456 12.423C3.66256 12.5425 3.83306 12.5945 3.99756 12.5615L7.56906 11.8475C7.66606 11.828 7.75506 11.7805 7.82456 11.7105L12.6641 6.871L9.12856 3.3355ZM9.83556 2.6285L13.3711 6.164L14.2676 5.268C15.2441 4.2915 15.2441 2.7085 14.2676 1.732C13.7986 1.2635 13.1631 1 12.5001 1C11.8366 1 11.2011 1.2635 10.7321 1.732L9.83556 2.6285Z" fill="black"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.75 15H13.75C14.164 15 14.5 14.664 14.5 14.25C14.5 13.836 14.164 13.5 13.75 13.5H1.75C1.336 13.5 1 13.836 1 14.25C1 14.664 1.336 15 1.75 15Z" fill="black"/>
                  </g>
                </svg>
              </div>
            </div>
            <div class="flex flex-1 flex-col gap-[0.625rem] self-stretch">
              <label for="email" class="text-template_2_alt font-inter leading-[120%] tracking-[0.0625rem] text-[0.75rem]">Enter Your Email</label>
              <div class="flex self-stretch flex-[1_0_0] w-full justify-between items-center p-[0.625rem_0.875rem] bg-[#F2F3F7] ">
                <input type="text" id="email" class="w-full font-inter text-[1.125rem] font-thin italic leading-[150%] tracking-[0.0625rem] bg-transparent border-none outline-none" placeholder="your@mail.com" />
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                  <g opacity="0.2">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.12856 3.3355L4.28906 8.175C4.22056 8.244 4.17306 8.331 4.15356 8.426L3.41006 11.9685C3.37556 12.133 3.42606 12.304 3.54456 12.423C3.66256 12.5425 3.83306 12.5945 3.99756 12.5615L7.56906 11.8475C7.66606 11.828 7.75506 11.7805 7.82456 11.7105L12.6641 6.871L9.12856 3.3355ZM9.83556 2.6285L13.3711 6.164L14.2676 5.268C15.2441 4.2915 15.2441 2.7085 14.2676 1.732C13.7986 1.2635 13.1631 1 12.5001 1C11.8366 1 11.2011 1.2635 10.7321 1.732L9.83556 2.6285Z" fill="black"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.75 15H13.75C14.164 15 14.5 14.664 14.5 14.25C14.5 13.836 14.164 13.5 13.75 13.5H1.75C1.336 13.5 1 13.836 1 14.25C1 14.664 1.336 15 1.75 15Z" fill="black"/>
                  </g>
                </svg>
              </div>
            </div>
          </div>
          <div class="flex flex-col gap-[0.625rem] items-start self-stretch">
            <label for="message" class="text-template_2_alt font-inter leading-[120%] tracking-[0.0625rem] text-[0.75rem]">Message</label>
            <div class="flex self-stretch flex-[1_0_0] w-full justify-between items-end p-[0.625rem_0.875rem] bg-[#F2F3F7] ">
              <textarea type="text" id="message" class="w-full h-[11.25rem] text-[1.125rem] font-inter font-thin italic leading-[150%] tracking-[0.0625rem] bg-transparent border-none outline-none" placeholder="Your Message"></textarea>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <g opacity="0.2">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M9.12856 3.3355L4.28906 8.175C4.22056 8.244 4.17306 8.331 4.15356 8.426L3.41006 11.9685C3.37556 12.133 3.42606 12.304 3.54456 12.423C3.66256 12.5425 3.83306 12.5945 3.99756 12.5615L7.56906 11.8475C7.66606 11.828 7.75506 11.7805 7.82456 11.7105L12.6641 6.871L9.12856 3.3355ZM9.83556 2.6285L13.3711 6.164L14.2676 5.268C15.2441 4.2915 15.2441 2.7085 14.2676 1.732C13.7986 1.2635 13.1631 1 12.5001 1C11.8366 1 11.2011 1.2635 10.7321 1.732L9.83556 2.6285Z" fill="black"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M1.75 15H13.75C14.164 15 14.5 14.664 14.5 14.25C14.5 13.836 14.164 13.5 13.75 13.5H1.75C1.336 13.5 1 13.836 1 14.25C1 14.664 1.336 15 1.75 15Z" fill="black"/>
                </g>
              </svg>
            </div>
          </div>
        </div>
        <button class="tablet:w-fit tablet:mx-auto flex text-[1.25rem] text-white font-bold tracking-[0.03125rem] uppercase p-[1.25rem_2.5rem] justify-center items-center gap-[0.625rem] self-stretch rounded-[19.6875rem] bg-template_2_primary hover:bg-template_2_primary/80 transition-colors">
          SENT
        </button>
        <p class="text-template_2_body text-center mx-auto font-open text-[0.875rem] tracking-[0.0625rem] leading-[170%] tablet:flex tablet:flex-col">Lorem ipsum dolor sit amet consectetur. Gravida accumsan <span>accumsan et lectus ipsum nulla erat.</span></p>
      </div>
    </div>
  </div>
  <div id="location" class="relative min-h-[31.25rem] flex flex-col items-start gap-[0.625rem] self-stretch">
    <div class="absolute inset-0 w-full h-full">
      <img src="/assets/templates/2/location.png" alt="location" class="object-cover w-full h-full"/>
    </div>
    <div class="flex flex-col absolute inset-x-0 bottom-[4.5rem] justify-end tablet:items-start items-center gap-[2.125rem] tablet:gap-[6rem] p-[1.6875rem_4.75rem_0rem_4.75rem]">
      <svg class="self-center" xmlns="http://www.w3.org/2000/svg" width="34" height="49" viewBox="0 0 34 49" fill="none">
        <path d="M16.8 48.0449C16.8 48.0449 0 26.1329 0 16.8449C-3.28751e-08 14.6387 0.434545 12.4541 1.27882 10.4158C2.1231 8.37757 3.36058 6.52555 4.92061 4.96553C6.48063 3.4055 8.33265 2.16803 10.3709 1.32375C12.4092 0.479467 14.5938 0.0449219 16.8 0.0449219C19.0062 0.0449219 21.1908 0.479467 23.2291 1.32375C25.2674 2.16803 27.1194 3.4055 28.6794 4.96553C30.2394 6.52555 31.4769 8.37757 32.3212 10.4158C33.1655 12.4541 33.6 14.6387 33.6 16.8449C33.6 26.1329 16.8 48.0449 16.8 48.0449ZM16.8 21.6449C18.073 21.6449 19.2939 21.1392 20.1941 20.239C21.0943 19.3389 21.6 18.118 21.6 16.8449C21.6 15.5719 21.0943 14.351 20.1941 13.4508C19.2939 12.5506 18.073 12.0449 16.8 12.0449C15.527 12.0449 14.3061 12.5506 13.4059 13.4508C12.5057 14.351 12 15.5719 12 16.8449C12 18.118 12.5057 19.3389 13.4059 20.239C14.3061 21.1392 15.527 21.6449 16.8 21.6449Z" fill="#D82217"/>
      </svg>
      <div class="flex flex-col tablet:flex-row items-center tablet:justify-start gap-[0.875rem]">
        <svg class="hidden tablet:block" xmlns="http://www.w3.org/2000/svg" width="24" height="35" viewBox="0 0 24 35" fill="none">
          <path d="M12 34.1865C12 34.1865 0 18.6655 0 12.0865C-2.34822e-08 10.5238 0.310389 8.97637 0.913446 7.53259C1.5165 6.08882 2.40042 4.77697 3.51472 3.67195C4.62902 2.56694 5.95189 1.69039 7.4078 1.09236C8.86371 0.494326 10.4241 0.186523 12 0.186523C13.5759 0.186523 15.1363 0.494326 16.5922 1.09236C18.0481 1.69039 19.371 2.56694 20.4853 3.67195C21.5996 4.77697 22.4835 6.08882 23.0866 7.53259C23.6896 8.97637 24 10.5238 24 12.0865C24 18.6655 12 34.1865 12 34.1865ZM12 15.4865C12.9093 15.4865 13.7814 15.1283 14.4244 14.4907C15.0673 13.8531 15.4286 12.9883 15.4286 12.0865C15.4286 11.1848 15.0673 10.32 14.4244 9.68236C13.7814 9.04474 12.9093 8.68652 12 8.68652C11.0907 8.68652 10.2186 9.04474 9.57563 9.68236C8.93265 10.32 8.57143 11.1848 8.57143 12.0865C8.57143 12.9883 8.93265 13.8531 9.57563 14.4907C10.2186 15.1283 11.0907 15.4865 12 15.4865Z" fill="#D82217"/>
        </svg>
        <div class="flex text-white flex-col items-center tablet:items-start justify-center gap-[0.675rem] tablet:gap-[0.25rem] flex-[1_0_0]">
          <p class="text-center font-bold text-[1.625rem] flex flex-col tablet:block tablet:text-left">10408 Madison Street, <span>Fort Lilly 19797-5951</span></p>
          <div class="flex flex-col text-center tablet:text-left tablet:flex-row gap-[0.25rem] items-center justify-center tablet:justify-start">
            <span class="font-thin font-inter text-[0.875rem] tracking-[0.0625rem]">Mon. - Fri. : <span class="font-bold">09:00 - 23:00</span></span>
            <span class="font-thin font-inter text-[0.875rem] tracking-[0.0625rem]">Weekend : <span class="font-bold">09:00 - 23:00</span></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="flex p-[3.75rem_0.875rem] tablet:p-[3.75rem_2.5rem] laptop:p-[3.75rem_5rem] desktop:p-[3.75rem_12.5rem] flex-col items-center gap-[1.875rem] self-stretch">
    <div class="flex flex-col big-tablet:flex-row items-center justify-center big-tablet:justify-between gap-[2.5rem] big-tablet:gap-0 self-stretch">
      <div class="flex flex-col big-tablet:flex-row items-center justify-center gap-[0.875rem]">
        <svg xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40" fill="none">
          <path d="M26.427 24.2462L25.6678 25.0453C25.6678 25.0453 23.8635 26.945 18.9385 21.7598C14.0135 16.5747 15.8178 14.6751 15.8178 14.6751L16.2959 14.1719C17.4735 12.9321 17.5845 10.9416 16.5571 9.4885L14.4554 6.51602C13.1838 4.7175 10.7266 4.47992 9.26908 6.0144L6.65308 8.76857C5.93038 9.52943 5.44608 10.5158 5.50481 11.6099C5.65506 14.4091 6.85118 20.4317 13.5256 27.4587C20.6035 34.9103 27.2447 35.2065 29.9605 34.9385C30.8195 34.8537 31.5665 34.3905 32.1685 33.7567L34.5362 31.264C36.1343 29.5815 35.6837 26.697 33.6388 25.52L30.4547 23.6872C29.112 22.9143 27.4763 23.1413 26.427 24.2462Z" fill="#D82217"/>
          <path d="M22.5991 3.13297C22.7094 2.45149 23.3536 1.98921 24.0351 2.09952C24.0772 2.10761 24.2131 2.13297 24.2841 2.14881C24.4264 2.18049 24.6247 2.22924 24.8721 2.30129C25.3667 2.44536 26.0577 2.68271 26.8871 3.06292C28.5476 3.82419 30.7572 5.15586 33.0502 7.44886C35.3432 9.74186 36.6749 11.9515 37.4361 13.612C37.8164 14.4414 38.0537 15.1324 38.1977 15.627C38.2697 15.8744 38.3186 16.0727 38.3502 16.2149C38.3661 16.2861 38.3777 16.3432 38.3857 16.3853L38.3954 16.4373C38.5056 17.1188 38.0476 17.7898 37.3661 17.9001C36.6866 18.0101 36.0464 17.5499 35.9334 16.8718C35.9299 16.8534 35.9202 16.8046 35.9101 16.7584C35.8894 16.6661 35.8539 16.5197 35.7976 16.3261C35.6847 15.9389 35.4889 15.3634 35.1636 14.6539C34.5139 13.2367 33.3456 11.2797 31.2824 9.21662C29.2194 7.15352 27.2624 5.98521 25.8452 5.33549C25.1357 5.01022 24.5602 4.81434 24.1729 4.70154C23.9794 4.64516 23.7361 4.58931 23.6437 4.56876C22.9654 4.45571 22.4891 3.81251 22.5991 3.13297Z" fill="#D82217"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M22.9761 8.88227C23.1658 8.21847 23.8576 7.83411 24.5215 8.02376L24.1781 9.22567C24.5215 8.02376 24.5215 8.02376 24.5215 8.02376L24.524 8.02446L24.5265 8.02519L24.532 8.02681L24.545 8.03067L24.578 8.04094C24.603 8.04897 24.6345 8.05944 24.6718 8.07272C24.7466 8.09929 24.8456 8.13706 24.967 8.18906C25.2098 8.29312 25.5415 8.45382 25.9491 8.69501C26.7648 9.17781 27.8785 9.97977 29.1868 11.2881C30.4951 12.5964 31.297 13.71 31.7798 14.5258C32.021 14.9333 32.1816 15.2651 32.2858 15.5079C32.3378 15.6292 32.3756 15.7281 32.4021 15.803C32.4155 15.8404 32.4258 15.8718 32.434 15.8969L32.4441 15.9299L32.448 15.9428L32.4496 15.9484L32.4503 15.9509C32.4503 15.9509 32.4511 15.9533 31.2491 16.2967L32.4511 15.9533C32.6408 16.6171 32.2563 17.3089 31.5926 17.4986C30.9345 17.6866 30.2486 17.3104 30.0521 16.657L30.046 16.639C30.0371 16.614 30.0188 16.5647 29.988 16.4927C29.9263 16.3488 29.8145 16.1134 29.6285 15.7991C29.2568 15.1712 28.5856 14.2224 27.419 13.0558C26.2525 11.8892 25.3036 11.2181 24.6758 10.8465C24.3615 10.6604 24.1261 10.5486 23.9821 10.4869C23.9101 10.4561 23.8608 10.4377 23.8358 10.4288L23.8178 10.4226C23.1645 10.2262 22.7881 9.54042 22.9761 8.88227Z" fill="#D82217"/>
        </svg>
        <div class="flex flex-col text-center items-center gap-[0.125rem]">
          <span class="font-bold text-template_2_alt text-[1.675rem]">+1 232 222 4445 777</span>
          <span class="font-inter font-thin text-template_2_alt text-[0.875rem]">Mon. - Fri. : <span class="font-bold">09:00 - 23:00</span></span>
        </div>
      </div>
      <span class="text-[3.125rem] font-bold upppercase text-center text-template_2_alt">LOGOTYPE</span>
      <div class="flex gap-[1rem]">
        <a href="#" class="border flex items-center justify-center h-[3.375rem] w-[3.375rem] border-1 hover:bg-[rgba(84,108,118,0.30)] transition-colors p-[0.6875rem] gap-[0.625rem] border-[rgba(84,108,118,0.30)]">
          <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
            <path d="M16.5 9.04277C16.5 5.15316 13.366 2 9.5 2C5.634 2 2.5 5.15316 2.5 9.04277C2.5 12.558 5.05979 15.4716 8.40625 16V11.0786H6.62891V9.04277H8.40625V7.49116C8.40625 5.72607 9.45135 4.75108 11.0502 4.75108C11.8162 4.75108 12.6172 4.88864 12.6172 4.88864V6.62183H11.7345C10.865 6.62183 10.5938 7.16475 10.5938 7.72173V9.04277H12.5351L12.2248 11.0786H10.5938V16C13.9402 15.4716 16.5 12.5581 16.5 9.04277Z" fill="#546C76"/>
          </svg>
        </a>
        <a href="#" class="border flex items-center justify-center h-[3.375rem] w-[3.375rem] border-1 hover:bg-[rgba(84,108,118,0.30)] transition-colors p-[0.6875rem] gap-[0.625rem] border-[rgba(84,108,118,0.30)]">
          <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
            <path d="M13.3821 3.18213H15.4521L10.9296 8.26518L16.25 15.1821H12.0842L8.82133 10.9871L5.08792 15.1821H3.01658L7.85388 9.74523L2.75 3.18213H7.02159L9.97093 7.01659L13.3821 3.18213ZM12.6555 13.9637H13.8026L6.39831 4.33659H5.1674L12.6555 13.9637Z" fill="#546C76"/>
          </svg>
        </a>
        <a href="#" class="border flex items-center justify-center h-[3.375rem] w-[3.375rem] border-1 hover:bg-[rgba(84,108,118,0.30)] transition-colors p-[0.6875rem] gap-[0.625rem] border-[rgba(84,108,118,0.30)]">
          <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
            <path d="M10.6102 2.6665C11.3695 2.66853 11.7549 2.67258 12.0877 2.68203L12.2186 2.68675C12.3698 2.69215 12.519 2.6989 12.6992 2.707C13.4173 2.74075 13.9074 2.85414 14.3373 3.02086C14.7828 3.1923 15.1581 3.42449 15.5334 3.7991C15.8766 4.13651 16.1422 4.54466 16.3116 4.99513C16.4783 5.42509 16.5917 5.91511 16.6255 6.63395C16.6336 6.81349 16.6403 6.96266 16.6457 7.11453L16.6498 7.24547C16.6599 7.57755 16.6639 7.96296 16.6653 8.72229L16.666 9.22582V10.11C16.6676 10.6023 16.6624 11.0947 16.6504 11.5868L16.6464 11.7178C16.641 11.8697 16.6342 12.0188 16.6261 12.1984C16.5924 12.9172 16.4776 13.4066 16.3116 13.8372C16.1426 14.2879 15.877 14.6962 15.5334 15.0332C15.1959 15.3763 14.7877 15.6419 14.3373 15.8115C13.9074 15.9782 13.4173 16.0916 12.6992 16.1253C12.539 16.1329 12.3788 16.1396 12.2186 16.1456L12.0877 16.1496C11.7549 16.1591 11.3695 16.1638 10.6102 16.1651L10.1066 16.1658H9.22311C8.73057 16.1675 8.23802 16.1623 7.74562 16.1503L7.61467 16.1462C7.45444 16.1402 7.29425 16.1332 7.1341 16.1253C6.41593 16.0916 5.92591 15.9782 5.49528 15.8115C5.04485 15.6423 4.63687 15.3767 4.29992 15.0332C3.95639 14.6959 3.69057 14.2878 3.52101 13.8372C3.35429 13.4072 3.2409 12.9172 3.20715 12.1984C3.19963 12.0382 3.19288 11.878 3.1869 11.7178L3.18352 11.5868C3.17109 11.0947 3.16546 10.6024 3.16665 10.11V8.72229C3.16477 8.22997 3.16972 7.73765 3.1815 7.24547L3.18622 7.11453C3.19162 6.96266 3.19837 6.81349 3.20647 6.63395C3.24022 5.91511 3.35361 5.42576 3.52033 4.99513C3.68982 4.54419 3.95617 4.13592 4.30059 3.7991C4.63746 3.45586 5.04518 3.19027 5.49528 3.02086C5.92591 2.85414 6.41526 2.74075 7.1341 2.707C7.31364 2.6989 7.46348 2.69215 7.61467 2.68675L7.74562 2.6827C8.23779 2.67071 8.73012 2.66554 9.22244 2.66718L10.6102 2.6665ZM9.9163 6.04133C9.02124 6.04133 8.16284 6.39689 7.52994 7.0298C6.89704 7.6627 6.54148 8.5211 6.54148 9.41616C6.54148 10.3112 6.89704 11.1696 7.52994 11.8025C8.16284 12.4354 9.02124 12.791 9.9163 12.791C10.8114 12.791 11.6698 12.4354 12.3027 11.8025C12.9356 11.1696 13.2911 10.3112 13.2911 9.41616C13.2911 8.5211 12.9356 7.6627 12.3027 7.0298C11.6698 6.39689 10.8114 6.04133 9.9163 6.04133ZM9.9163 7.39126C10.1822 7.39122 10.4455 7.44355 10.6912 7.54527C10.9369 7.64699 11.1602 7.7961 11.3482 7.9841C11.5363 8.1721 11.6855 8.3953 11.7873 8.64095C11.8891 8.88661 11.9415 9.14991 11.9415 9.41582C11.9416 9.68173 11.8893 9.94505 11.7875 10.1907C11.6858 10.4364 11.5367 10.6597 11.3487 10.8477C11.1607 11.0358 10.9375 11.185 10.6918 11.2868C10.4462 11.3886 10.1829 11.441 9.91698 11.4411C9.37994 11.4411 8.8649 11.2277 8.48516 10.848C8.10542 10.4682 7.89208 9.95319 7.89208 9.41616C7.89208 8.87912 8.10542 8.36408 8.48516 7.98434C8.8649 7.6046 9.37994 7.39126 9.91698 7.39126M13.4605 5.02888C13.2368 5.02888 13.0222 5.11777 12.864 5.276C12.7057 5.43422 12.6168 5.64882 12.6168 5.87259C12.6168 6.09635 12.7057 6.31095 12.864 6.46918C13.0222 6.62741 13.2368 6.7163 13.4605 6.7163C13.6843 6.7163 13.8989 6.62741 14.0571 6.46918C14.2154 6.31095 14.3043 6.09635 14.3043 5.87259C14.3043 5.64882 14.2154 5.43422 14.0571 5.276C13.8989 5.11777 13.6843 5.02888 13.4605 5.02888Z" fill="#546C76"/>
          </svg>
        </a>
        <a href="#" class="border flex items-center justify-center h-[3.375rem] w-[3.375rem] border-1 hover:bg-[rgba(84,108,118,0.30)] transition-colors p-[0.6875rem] gap-[0.625rem] border-[rgba(84,108,118,0.30)]">
          <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.875 2.43213C3.25368 2.43213 2.75 2.93581 2.75 3.55713V14.8071C2.75 15.4284 3.25368 15.9321 3.875 15.9321H15.125C15.7463 15.9321 16.25 15.4284 16.25 14.8071V3.55713C16.25 2.93581 15.7463 2.43213 15.125 2.43213H3.875ZM6.89057 5.43417C6.89479 6.15136 6.35796 6.59327 5.72092 6.59011C5.1208 6.58694 4.59768 6.10917 4.60084 5.43523C4.60401 4.80136 5.10498 4.29194 5.75573 4.30671C6.41596 4.32148 6.89479 4.80558 6.89057 5.43417ZM9.70977 7.50345H7.81978H7.81872V13.9233H9.81627V13.7736C9.81627 13.4886 9.81605 13.2036 9.81582 12.9186C9.81522 12.1582 9.81455 11.397 9.81845 10.6369C9.8195 10.4523 9.8279 10.2604 9.87537 10.0842C10.0536 9.4261 10.6453 9.00108 11.3055 9.10555C11.7295 9.17193 12.01 9.4177 12.1281 9.81745C12.201 10.0674 12.2337 10.3363 12.2368 10.5969C12.2454 11.3826 12.2442 12.1683 12.243 12.954C12.2425 13.2314 12.2421 13.5089 12.2421 13.7862V13.9223H14.246V13.7683C14.246 13.4293 14.2458 13.0904 14.2456 12.7515C14.2452 11.9043 14.2448 11.0572 14.247 10.2098C14.2481 9.8269 14.207 9.44935 14.1131 9.07915C13.9729 8.52858 13.6828 8.07295 13.2114 7.74393C12.877 7.50977 12.51 7.35895 12.0997 7.34208C12.053 7.34014 12.0059 7.33759 11.9586 7.33504C11.7488 7.3237 11.5356 7.31218 11.335 7.35262C10.7613 7.46758 10.2572 7.7302 9.87642 8.19318C9.83217 8.24628 9.7889 8.3002 9.72433 8.38068L9.70977 8.3989V7.50345ZM4.76123 13.9254H6.74932V7.50763H4.76123V13.9254Z" fill="#546C76"/>
          </svg>
        </a>
      </div>
    </div>
    <div class="flex w-full items-center justify-center gap-[2.5rem] self-stretch">
      <a href="#about" class="text-[1.25rem] tracking-[0.03125rem] uppercase p-[1rem_0rem] justify-center items-center self-stretch gap-[0.625rem] text-template_2_primary hover:text-template_2_primary/80 transition-colors">About Us</a>
      <a href="#menu" class="text-[1.25rem] tracking-[0.03125rem] uppercase p-[1rem_0rem] justify-center items-center self-stretch gap-[0.625rem] text-template_2_primary hover:text-template_2_primary/80 transition-colors">Our Menu</a>
      <a href="#location" class="text-[1.25rem] tracking-[0.03125rem] uppercase p-[1rem_0rem] justify-center items-center self-stretch gap-[0.625rem] text-template_2_primary hover:text-template_2_primary/80 transition-colors">Location</a>
    </div>
    <p class="text-template_2_body font-open text-center font-[0.875rem] leading-[170%] tracking-[0.0625rem] tablet:flex tablet:flex-col">Lorem ipsum dolor sit amet consectetur. Gravida accumsan <span>accumsan et lectus ipsum nulla erat.</span></p>
  </footer>
</section>
