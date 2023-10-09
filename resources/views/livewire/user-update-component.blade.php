<div>
    @if ($chkupdate === true)
        <div class="row">
            <div class="col-12">
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
                                <h1>Register Component</h1>
                                <form wire:submit.prevent="update({{ $u_id }})">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" type="text" wire:model="name">
                                    </div>
                                    @error('name')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email" wire:model="email">
                                    </div>
                                    @error('email')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <livewire:user.user-component />
    @endif
</div>
