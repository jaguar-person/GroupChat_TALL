@props([
    'loader' => false,
    'loadingTarget' => null,
    'icon' => null,
    'size' => 'normal',
])

<x-button :size="$size" :icon="$icon" :loader="$loader" :loadingTarget="$loadingTarget" {{ $attributes->merge(['class' => 'text-white bg-yellow-600 hover:bg-yellow-500 active:bg-yellow-700 border-yellow-600']) }}>{{ $slot }}</x-button>
