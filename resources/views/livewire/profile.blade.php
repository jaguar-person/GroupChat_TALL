<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <div class="grid grid-cols-3 gap-4 pt-4 border-b">
                    <div class="pb-10 pl-20 flex justify-center items-center" :error="$errors->first('newAvatar')">
                        @if($user->avatar)
                            <img src=" {{ asset('avatars/'. $user->avatar) }}" class="rounded-full ring ring-pink-400 ring-offset-4 ring-offset-pink-100 w-52 h-52 object-fit">
                        @else
                            <img src="https://www.gravatar.com/avatar/" alt="Profile Photo" width="200px" class="rounded-full">
                        @endif
                    </div>

                    <div class="p-10 col-span-2" >
                        <div class="flex items-center space-x-6">
                            <div class="flex items-center">
                                <h1>@ {{ $user->username }}</h1>
                            </div>
                            @auth
                                @if($user->id === auth()->id())
                                    <x-button.primary class="text-xs" wire:click="edit({{ $user->profile->id }})">Edit Profile</x-button.primary>
                                @else
                                    <a href="{{ route('conversations.create') }}" class="text-sm text-gray-100 font-semibold rounded-lg shadow-lg px-4 py-2 bg-indigo-400 hover:bg-pink-300">Message</a>
                                @endif
                            @endauth
                        </div>

                        <div class="pt-4 text-gray-700 space-y-2">
                            <div class="text-lg text-gray-700"><strong>{{ $user->name }}</strong></div>
                            <p >{{ $user->profile->description ?? '' }}</p>
                        </div>
                    </div>
                </div>
                <div class="py-4 font-semibold text-gray-800">
                    Connected with:
                </div>
                <div>
                    @forelse($conversations as $conversation)
                        <a href="{{ route('conversations.show', $conversation) }}">
                            <div class="font-semibold text-gray-700">
                                @foreach($conversation->users as $user)
                                   <a href="{{ route('profile', ['user' => $user->username]) }}" class="hover:text-pink-300 flex items-center pb-1">
                                       <div class="pr-2">
                                           @if($user->id !== auth()->id())
                                               @if($user->avatar)
                                                   <img src=" {{ asset('avatars/'. $user->avatar) }}" class="rounded-full w-8 h-8 object-fit">
                                               @else
                                                   <img src="https://www.gravatar.com/avatar/" alt="Profile Photo" class="rounded-full w-8 h-8 object-fit">
                                               @endif
                                           @endif
                                       </div>
                                       {{ $user->id === auth()->id() ? '' : $user->name }}
                                   </a>
                                @endforeach
                            </div>
                        </a>
                    @empty
                        <div class="p-6">No Conversations yet. <a href="{{ route('conversations.create') }}" class="text-blue-500">Start at conversation?</a></div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-------- Edit Profile Modal -------------->

    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">

            <x-slot name="title">Update Profile</x-slot>

            <x-slot name="content">
                <div class="space-y-8">
                    <x-input.group for="name" label="Name" :error="$errors->first('user.name')">
                        <x-input.text wire:model="user.name" id="name" placeholder="Name" />
                    </x-input.group>

                    <x-input.group for="description" label="Bio" :error="$errors->first('editing.description')">
                        <x-input.textarea wire:model="editing.description" id="bio" placeholder="Bio" />
                    </x-input.group>

                    <x-input.group label="Display Picture" for="avatar" :error="$errors->first('newAvatar')">
                        <x-input.file-upload type="file" wire:model="newAvatar" id="avatar" />
                    </x-input.group>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
