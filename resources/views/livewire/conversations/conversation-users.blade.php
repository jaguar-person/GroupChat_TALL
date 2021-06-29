<div x-data="{...userSearchState(), ...userAddState()}">
    <div class="flex justify-between">
        <div>
            @foreach($users as $user)
                {{ $user->present()->name }}{{ !$loop->last ? ',' : null }}
            @endforeach
        </div>
        <button x-on:click="show = !show"><i class="fas fa-plus text-blue-500"></i></button>
    </div>
    <div x-show="show">
        <x-conversations.user-search>
            <x-slot name="suggestions">
                <template x-for="user in suggestions" :key="user.id">
                    <a href="#" class="block" x-on:click="addUser(user)" x-text="user.name"></a>
                </template>
            </x-slot>
        </x-conversations.user-search>
    </div>
</div>
<script>
    function userAddState () {
        return {
            show: false,

            addUser(user) {
                @this.call('addUser', user)
                this.$refs.search.value = ''
                this.suggestions = []
                this.show = false
            }
        }
    }
</script>


