@props([
    'loader' => false,
    'loadingTarget' => null,
    'size' => 'normal',
])

<x-button :size="$size" :loader="$loader" :loadingTarget="$loadingTarget" {{ $attributes->merge(['class' => 'text-white bg-gray-800 hover:bg-gray-500 active:bg-gray-800 border-gray-600']) }}>{{ $slot }}</x-button>
