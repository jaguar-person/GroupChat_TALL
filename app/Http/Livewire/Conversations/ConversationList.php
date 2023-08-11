<?php

namespace App\Http\Livewire\Conversations;

use App\Models\Conversation;
use Illuminate\Support\Collection;
use Livewire\Component;

class ConversationList extends Component
{
    public $conversations;

    public function mount(Collection $conversations)
    {
        $this->conversations = $conversations->load('users');
    }

    public function getListeners()
    {
        return [
            'echo-private:users.' . auth()->id() . ',Conversations\\ConversationCreated' => 'prependConversationFromBroadcast',
            'echo-private:users.' . auth()->id() . ',Conversations\\ConversationUpdated' => 'updateConversationFromBroadcast',
        ];
    }

    public function prependConversation($id)
    {
        $this->conversations->prepend(Conversation::find($id));
    }

    public function prependConversationFromBroadcast($payload)
    {
        $this->prependConversation($payload['conversation']['id']);
    }

    public function updateConversationFromBroadcast($payload)
    {
        $id = $payload['conversation']['id'];

        $this->conversations->find($id)->fresh();
    }

    public function render()
    {

        return view('livewire.conversations.conversation-list', [
            'conversations' => Conversation::all(),
        ]);
    }
}