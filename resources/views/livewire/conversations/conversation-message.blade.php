<div class="flex items-center">
    <img src="{{ $message->user->present()->avatar }}" alt="{{ $message->user->name }}" class="rounded-full mr-2" style="width: 35px;">

    <div>
        <div class="bg-gray-100 p-2 rounded">
            {{ $message->body }}
        </div>
        <div class="text-muted" style="font-size: 0.8rem;">
            {{ $message->user->present()->name }}
        </div>
    </div>
</div>
