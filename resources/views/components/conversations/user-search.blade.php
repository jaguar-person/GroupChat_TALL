<div>
    <x-input.group borderless for="user" label="Name" :error="$errors->first('user')">
        <x-input.text id="user" autocomplete="off" placeholder="Search users"
                      x-on:input.debounce="search" x-ref="search"/>
    </x-input.group>

    {{ $suggestions }}
</div>

<script>
    function userSearchState() {
        return {
            suggestions: [],
            search(q) {
                fetch(`/api/search/users?q=${q.target.value}`)
                    .then(response => response.json())
                    .then((suggestions) => {
                        this.suggestions = suggestions
                    });
            },
        }
    }
</script>
