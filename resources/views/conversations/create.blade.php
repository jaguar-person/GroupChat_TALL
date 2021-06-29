<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex items-center">
            <div class="w-10/12 overflow-hidden space-x-8 flex ">
                <div class="w-5/12">
                    <livewire:conversations.conversation-list :conversations="$conversations" />
                </div>

                <div class="bg-white sm:rounded-lg shadow-xl w-7/12">
                    <div class="p-4">
                        <livewire:conversations.conversation-create />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
