<?php

namespace App\Http\Livewire\User;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $u_id,$name,$email;
    public $chkupdate = false;
    public $chkadd = false;

    public $search = '';

    public $perPage = 5;

    protected $queryString = ['search'];

    public $sortField = 'id'; // Default sorting field
    public $sortDirection = 'asc'; // Default sorting direction

    public function render()
    {
        $users = User::where('name', 'like', '%'.$this->search.'%')
                        ->orderBy($this->sortField, $this->sortDirection)
                        ->paginate($this->perPage);

        // Check if the current page is empty
        if ($users->isEmpty() && $users->currentPage() > 1) {
            // Redirect to the first page
            return redirect()->to(route('user.index'));
        }
        return view('livewire.user.user-component',['users'=> $users]);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    public function add(){


        $this->chkadd = true;
     }
    public function edit($id){

        $this->u_id = $id;
        $user = User::find($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->chkupdate = true;
     }

    public function delete($id){

        User::find($id)->delete();
        $this->render();
     }
}
