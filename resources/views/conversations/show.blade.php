<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex items-center">
            <div class="w-10/12 overflow-hidden space-x-8 flex justify-end">
                <div class="bg-white sm:rounded-lg shadow-xl  w-1/2">
                    <div class="flex">
                        <a class=" mt-3 ml-3 bg-indigo-400 rounded-lg px-4 py-2 shadow-md hover:bg-pink-300"
                            href="{{ route('dashboard') }}">Back</a>
                    </div>
                    <div class="p-4 border-b border-gray-100">
                        <livewire:conversations.conversation-users :conversation="$conversation" :users="$conversation->users" />
                    </div>
                    <div class="p-4" style="max-height: 300px; height: 300px; overflow: scroll;">
                        <livewire:conversations.conversation-messages :conversation="$conversation" :messages="$conversation->messages" />
                    </div>
                    <div class="p-4 border-t border-gray-100">
                        <livewire:conversations.conversation-reply :conversation="$conversation" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
