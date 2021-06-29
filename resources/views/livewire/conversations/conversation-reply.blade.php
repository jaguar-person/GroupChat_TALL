<form x-data="conversationReplyState()" action="#" wire:submit.prevent="reply">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <x-input.textarea wire:model="body" x-on:keydown.enter="submit" placeholder="Type your reply"></x-input.textarea>
    <div class="flex justify-end mt-2">
        <x-button.primary type="submit" x-ref="submit" >Send</x-button.primary>
    </div>
</form>

<script>
    function conversationReplyState() {
        return {
            submit() {
                this.$refs.submit.click()
            }
        }
    }
</script>
