<div>
    @if($chkupdate === false && $chkadd == false)
        <div class="row">
            <div class="col-12" >
                <div class="row d-flex justify-content-center align-items-center" style="height: 100vh">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h2>Users List</h2>
                            </div>
                            <div class="card-body">
                                @if (session()->has('success'))
                                    <div class="alert alert-success" style="color:green">
                                        {{ session('success') }}
                                    </div>
                                @endif
                               <div class="mb-2 d-flex justify-content-end"> <button class="btn  btn-primary "  wire:click="add">+Add New User</button></div>
                                <table class="table table-striped">
                                    <div class="mb-2 d-flex justify-content-between">
                                        <input class="form-control  w-50" wire:model="search" type="search" placeholder="Search user by name...">
                                        <select class="form-control"  wire:model="perPage" style="width: 150px">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                        </select>
                                    </div>
                                    <thead>
                                        <tr>
                                            <th scope="col" wire:click="sortBy('id')">
                                                ID
                                                @if($sortField === 'id')
                                                    @if($sortDirection === 'asc')
                                                        <i class="fas fa-sort-up"></i>
                                                    @else
                                                        <i class="fas fa-sort-down"></i>
                                                    @endif
                                                @endif
                                            </th>
                                            <th scope="col" wire:click="sortBy('name')">
                                                Name
                                                @if($sortField === 'name')
                                                    @if($sortDirection === 'asc')
                                                        <i class="fas fa-sort-up"></i>
                                                    @else
                                                        <i class="fas fa-sort-down"></i>
                                                    @endif
                                                @endif
                                            </th>
                                            <th scope="col" wire:click="sortBy('email')">
                                                Email
                                                @if($sortField === 'email')
                                                    @if($sortDirection === 'asc')
                                                        <i class="fas fa-sort-up"></i>
                                                    @else
                                                        <i class="fas fa-sort-down"></i>
                                                    @endif
                                                @endif
                                            </th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($users) > 0)
                                            @foreach ($users as $user)
                                                <tr>
                                                    <th scope="row">{{ $user->id }}</th>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info"  wire:click="edit({{ $user->id }})">Edit</button>
                                                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $user->id }})">Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                                <tr class="p-2 bg-light text-center text-secondary">
                                                    <th colspan="4">Not Found</th>
                                                </tr>
                                        @endif

                                    </tbody>
                                </table>
                            <div class="d-flex justify-content-end"> <p > {{ $users->links() }}</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($chkadd == true)
        <livewire:user.add-user-component  />
    @elseif($chkupdate == true)
        <livewire:user-update-component :u_id="$u_id" :name="$name" :email="$email"/>
    @endif
</div>
