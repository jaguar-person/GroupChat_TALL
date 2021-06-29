@props([
    'loader' => false,
    'loadingTarget' => null,
    'icon' => null,
    'size' => 'normal',
    'width' => '',
    'sizes' => [
        'normal' => 'py-2 px-4 text-sm leading-5',
        'small' => 'py-1 px-2 text-xs leading-none',
        ],
])

<span class="inline-flex rounded-md shadow-sm {{ $width }}">
    <button @if($loader) wire:loading.attr="disabled" @endif
        {{ $attributes->merge([
            'type' => 'button',
            'class' => 'flex ' . $sizes[$size] . ' justify-center items-center border rounded-md font-medium focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out disabled:opacity-75 disabled:cursor-not-allowed' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
        ]) }}
    >
        {{ $slot }}

        @if($icon)
            <i class="ml-2 fas {{ $icon }}"></i>
        @endif

        @if($loader)
            <x-button.loading :loadingTarget="$loadingTarget"></x-button.loading>
        @endif
    </button>
</span>
