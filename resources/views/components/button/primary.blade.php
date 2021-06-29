@props([
    'loader' => false,
    'loadingTarget' => null,
    'icon' => null,
    'size' => 'normal',
])

<x-button :size="$size" :icon="$icon" :loader="$loader" :loadingTarget="$loadingTarget" {{ $attributes->merge(['class' => 'text-gray-100 font-semibold bg-indigo-400 hover:bg-pink-400 active:bg-indigo-700 ']) }}>{{ $slot }}</x-button>
