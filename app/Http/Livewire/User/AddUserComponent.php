<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class AddUserComponent extends Component
{
    public $name,$email;
    public $chkadd = true;

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
        return view('livewire.user.add-user-component');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function store()
    {
        $validatedData = $this->validate();
        User::create($validatedData);
        $this->chkadd = false;
        $this->resetFilter();
        session()->flash('success', 'User Added Successfully!');

    }

    public function resetFilter()
    {
        $this->reset(['name','email']);
    }

}
