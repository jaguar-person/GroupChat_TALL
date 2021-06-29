<form action="" wire:submit.prevent="create">
    <div>
        Send to:
        @foreach($users as $index => $user)
            {{ $user['name'] }}{{ $index + 1 !== count($users) ? ',' : null }}
        @endforeach
    </div>
    <div x-data="{...conversationCreateState(),...userSearchState()}">
        <div class="border-b border-gray-100">
          <x-conversations.user-search>
              <x-slot name="suggestions">
                  <template x-for="user in suggestions" :key="user.id">
                      <a href="#" class="block" x-on:click="addUser(user)" x-text="user.name"></a>
                  </template>
              </x-slot>
          </x-conversations.user-search>
        </div>

        <div class="my-6">
            <x-input.textarea id="body" wire:model="body" placeholder="Type message"></x-input.textarea>
        </div>

        <div class="flex justify-end">
            <x-button.primary type="submit" >Create Chat</x-button.primary>
        </div>
    </div>
</form>

<script>
    function conversationCreateState() {
        return {
            addUser (user) {
                @this.call('addUser', user)
                this.$refs.search.value = ''
                this.suggestions = []
            }
        }
    }
</script>
