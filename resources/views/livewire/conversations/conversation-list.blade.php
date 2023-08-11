<div class="space-y-4">
    <div class="relative flex items-center justify-between">
        <div class="flex justify-end">
            <a class="bg-indigo-400 rounded-lg px-4 py-2 shadow-md hover:bg-pink-300"
                href="{{ route('conversations.create') }}">New Chat</a>
        </div>
    </div>
    <div class="flex flex-col gap-4 shadow-lg border border-grey-600 p-3 rounded-md  ">
        <div class="flex flex-col gap-2">
            <p>Online</p>
            @forelse($conversations as $conversation)
                @foreach ($conversation->users as $user)
                    @if (Cache::has('user-is-online-' . $user->id) && $user->id !== auth()->user()->id)
                        <a href="{{ route('conversations.show', $conversation) }}"
                            class="block bg-white rounded-lg p-4 border border-black">
                            <div class="font-semibold">
                                {{ $user->present()->name }}
                            </div>
                            <div class="text-gray-600">
                                @if (!auth()->user()->hasRead($conversation))
                                    <i class="fas fa-circle text-blue-500 text-xs"></i>
                                @endif
                                <span>{{ $conversation->messages->last()->body }}</span>
                            </div>
                        </a>
                    @endif
                @endforeach
            @empty
                <div class="p-6">No Conversations</div>
            @endforelse
        </div>

        <div class="flex flex-col gap-2">
            <p>Offline</p>
            @forelse($conversations as $conversation)
                @foreach ($conversation->users as $user)
                    @if (!Cache::has('user-is-online-' . $user->id))
                        <a href="{{ route('conversations.show', $conversation) }}"
                            class="block bg-white rounded-lg p-4 border border-black">
                            <div class="font-semibold">
                                {{ $user->present()->name }}
                            </div>
                            <div class="text-gray-600">
                                @if (!auth()->user()->hasRead($conversation))
                                    <i class="fas fa-circle text-blue-500 text-xs"></i>
                                @endif
                                <span>{{ $conversation->messages->last()->body }}</span>
                            </div>
                        </a>
                    @endif
                @endforeach
            @empty
                <div class="p-6">No Conversations</div>
            @endforelse
        </div>
    </div>


    <!-------- Create Conversation Modal -------------->

</div>

<script>
    function tagSelect() {
        return {
            open: false,
            textInput: '',
            tags: [],

            removeTag(index) {
                this.tags.splice(index, 1)
                this.fireTagsUpdateEvent()
            },
            search(q) {
                fetch(`/api/search/users?q=${q.target.value}`)
                    .then(response => response.json())
                    .then((tags) => {
                        this.tags = tags
                    });

                this.toggleSearch()
            },
            clearSearch() {
                this.textInput = ''
                this.toggleSearch()
            },
            toggleSearch() {
                this.open = this.textInput != ''
            }
        }
    }
</script>
