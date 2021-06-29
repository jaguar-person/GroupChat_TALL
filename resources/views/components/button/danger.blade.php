@props([
    'loader' => false,
    'size' => 'normal',
    'loadingTarget' => null,
])

<x-button :size="$size" :loader="$loader" :loadingTarget="$loadingTarget" {{ $attributes->merge(['class' => 'text-white bg-red-600 hover:bg-red-500 active:bg-red-700 border-red-600']) }}>{{ $slot }}</x-button>
