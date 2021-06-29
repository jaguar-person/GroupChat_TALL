@props([
    'loader' => false,
    'size' => 'normal',
])

<x-button :size="$size" :loader="$loader" class="border-gray-300 text-gray-700 active:bg-gray-50 active:text-gray-800 hover:text-gray-500" {{ $attributes }}>{{ $slot }}</x-button>
