<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserUpdateComponent extends Component
{

    public $u_id,$name,$email;
    public $chkupdate = true;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
    ];
    protected $messages = [
        'email.required' => 'The Email Address cannot be empty.',
        'email.email' => 'The Email Address format is not valid.',
    ];


    public function render()
    {
        return view('livewire.user-update-component');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function update($id)
    {
        $validatedData = $this->validate();
        $user = User::find($this->u_id);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();
        $this->chkupdate = false;
        session()->flash('success', 'User Updated Successfully!');

    }


}
