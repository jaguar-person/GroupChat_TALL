<?php

namespace App\Http\Livewire\Conversations;

use App\Events\Conversations\ConversationCreated;
use App\Models\Conversation;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;

class ConversationCreate extends Component
{
    public $body = '';
    public $users = [];
    public $conversations;

    public function mount(Collection $conversations)
    {
        $this->conversations = $conversations;
    }

    public function addUser($user)
    {
        $this->users[] = $user;
    }

    public function create()
    {
        $this->validate([
            'users' => 'required',
            'body' => 'required',
        ]);

        $conversation = Conversation::create([
            'uuid' => Str::uuid(),
        ]);

        $conversation->messages()->create([
           'user_id' => auth()->id(),
           'body' => $this->body,
        ]);

        $conversation->users()->sync($this->collectUserIds());

        broadcast(new ConversationCreated($conversation))->toOthers();

        return redirect()->route('conversations.show', $conversation);

    }

    public function collectUserIds()
    {
        return collect($this->users)->merge([auth()->user()])->pluck('id')->unique();
    }

    public function render()
    {
        return view('livewire.conversations.conversation-create');
    }
}
