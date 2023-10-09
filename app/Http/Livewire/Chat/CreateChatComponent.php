<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CreateChatComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $message = 'Hello';
    public $CheckedValues = [];
    public function render()
    {
        $chat_users = User::where('id','!=',auth()->user()->id)->paginate(5);
        return view('livewire.chat.create-chat-component',['chat_users' => $chat_users]);
    }

    public function checkConversation($reciverid){

        $checkedConversation = Conversation::where('sender_id',auth()->user()->id)
                                            ->where('receiver_id',$reciverid)
                                            ->orwhere('sender_id',$reciverid)
                                            ->where('receiver_id',auth()->user()->id)
                                            ->get();
        if(count($checkedConversation) === 0){

            $createdConversation = Conversation::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $reciverid,
                'last_time_message' => now()
            ]);

            // dd($createdConversation);
            $createdMessage = Message::create([
                'conversation_id' => $createdConversation->id,
                'sender_id' => auth()->user()->id,
                'receiver_id' => $reciverid,
                'body' => $this->message,
            ]);
            $createdConversation->last_time_message = $createdMessage->created_at;
            $createdConversation->save();

            session()->flash('success', 'Chat has been created Successfully!');
        }
    }

    public function checkCheckbox()
    {
        $this->emit('chat.create-chat-component', $this->CheckedValues);
    }

    public function SendGrpMsg(){

        $userIds = $this->CheckedValues;
        foreach($userIds as $key => $reciverid){

            $checkedConversation = Conversation::where('sender_id',auth()->user()->id)
                                                ->where('receiver_id',$reciverid)
                                                ->orwhere('sender_id',$reciverid)
                                                ->where('receiver_id',auth()->user()->id)
                                                ->get();
            if(count($checkedConversation) === 0){

            $createdConversation = Conversation::create([
                                'sender_id' => auth()->user()->id,
                                'receiver_id' => $reciverid,
                                'last_time_message' => now()
                                ]);

            // dd($createdConversation);
            $createdMessage = Message::create([
                                'conversation_id' => $createdConversation->id,
                                'sender_id' => auth()->user()->id,
                                'receiver_id' => $reciverid,
                                'body' => $this->message,
                                ]);
            $createdConversation->last_time_message = $createdMessage->created_at;
            $createdConversation->save();

            }

        }
        $this->CheckedValues = [];
        session()->flash('success', 'Chat has been created Successfully!');
    }
}
