<?php

namespace App\Http\Livewire;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $user;
    public $selectedPost;
    public $editing;
    public $newAvatar;
    public $showEditModal = false;

    protected $rules = [
        'user.name' => 'required|min:3',
        'editing.description' => 'required|max:250',
        'newAvatar' => 'nullable|image',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function edit(\App\Models\Profile $bio)
    {
        $this->resetErrorBag();
        $this->editing = $bio;
        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

//        if ($this->newAvatar) {

            $filename = $this->newAvatar->store('/', 'avatars');

            $this->user->avatar = $filename;

            $this->user->save();
//        }

        $this->editing->save();


        $this->showEditModal = false;
    }

    public function render()
    {
        $this->user = User::findOrFail($this->user->id);
        return view('livewire.profile', [
            'users' => User::all(),
            'conversations' => Conversation::all(),
        ]);
    }
}
