@props([
    "variant" => "white"
])
@php
$variant = match($variant) {
    "white" => '/hor_white_BG@4x.png',
    "black" => '/hor_black_BG@4x.png',
    "black_no_slogan" => '/hor_black_BG no slogan@4x.png',
}
@endphp
<img
  class='app-logo'
  src='{{ asset('/assets/logo') . $variant }}'
  alt='{{ config('app.name') }}'>
