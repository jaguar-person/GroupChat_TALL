@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div {{ $attributes->merge(['class' => "text-lg px-6 py-4 bg-gray-100"]) }}>
        {{ $title }}
    </div>

    <div class="px-6 py-4">
        {{ $content }}
    </div>

    <div class="px-6 py-4 bg-gray-100 text-right space-x-1">
        {{ $footer }}
    </div>
</x-modal>
