<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\User;
use Livewire\Component;

class ChatListComponent extends Component
{

    public $auth_id = '';
    public $conversations = '';
    public $receiverInstance = '';
    public $name = '';
    public $selectedConversation;

    protected $listeners = ['chatUserSelected', 'refresh' => '$refresh', 'resetComponent'];
    public function mount()
    {
        $this->auth_id = auth()->user()->id;
        $this->conversations = Conversation::where('sender_id', $this->auth_id)
                                            ->orwhere('receiver_id', $this->auth_id)
                                            ->orderBy('last_time_message', 'DESC')
                                            ->get();
    }
    public function render()
    {
        return view('livewire.chat.chat-list-component');
    }
    public function resetComponent()
    {
        $this->selectedConversation = null;
        $this->receiverInstance = null;

        # code...
    }

    public function getChatUserInstance(Conversation $conversation, $request)
    {

        // dd($request);
        $this->auth_id = auth()->user()->id;
        if ($conversation->id == $this->auth_id) {
            $this->receiverInstance = User::firstwhere('id', $conversation->receiver_id);
        } else {
            $this->receiverInstance = User::firstwhere('id', $conversation->sender_id);
        }

        // dd($this->receiverInstance);
        if (isset($request)) {

            return $this->receiverInstance->$request;
            # code...
        }
    }
    public function chatUserSelected(Conversation $conversation, $receiverId)
    {

        //   dd($conversation,$receiverId);
        $this->selectedConversation = $conversation;
        $receiverInstance = User::find($receiverId);
        $this->emitTo('chat.chat-box-component', 'loadConversation', $this->selectedConversation, $receiverInstance);
        $this->emitTo('chat.send-message-component', 'updateSendMessage', $this->selectedConversation, $receiverInstance);

        # code...
    }
}
