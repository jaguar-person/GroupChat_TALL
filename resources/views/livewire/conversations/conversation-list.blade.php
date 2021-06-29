<div class="space-y-4">
    <div class="relative flex items-center justify-between">
        <div class="flex justify-end">
            <a class="bg-indigo-400 rounded-lg px-4 py-2 shadow-md hover:bg-pink-300" href="{{ route('conversations.create') }}">New Chat</a>
        </div>
    </div>
    @forelse($conversations as $conversation)
        <a href="{{ route('conversations.show', $conversation) }}" class="block bg-white rounded-lg p-4 ">
            <div class="font-semibold">
                @foreach($conversation->users as $user)
                    {{ $user->present()->name }}{{ !$loop->last ? ',' : null }}
                @endforeach
            </div>
            <div class="text-gray-600">
                @if(!auth()->user()->hasRead($conversation))
                    <i class="fas fa-circle text-blue-500 text-xs"></i>
                @endif
                <span>{{ $conversation->messages->last()->body }}</span>
            </div>
        </a>
    @empty
        <div class="p-6">No Conversations</div>
    @endforelse

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

