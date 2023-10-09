<div>
    @if (session()->has('success'))
        <div class="alert alert-success" style="color:green">
            {{ session('success') }}
        </div>
    @endif

    <ul class="list-group w-75 mx-auto mt-3 container-fluid" style="height: 1000px">

        <li class="list-group-item list-group-item-action d-flex justify-content-end align-items-center ">
            <button type="button" class="btn btn-primary send-grp-msg hidden" wire:click="SendGrpMsg">
                <i class="fa fa-paper-plane text-info" aria-hidden="true"></i>
            </button>
        </li>
        @foreach ($chat_users as $user)
            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span>

                    <input type="checkbox" value="{{ $user->id }}" wire:click="checkCheckbox"
                        wire:model="CheckedValues" class="check_checkbox" data-id="{{ $user->id }}" id="checked_checkbox_{{ $user->id }}">
                    {{ $user->name }}
                </span>
                <button type="button" class="btn btn-info btn-sm hide-btn" id="checked_{{ $user->id }}"
                    wire:click="checkConversation({{ $user->id }})"><i class="fa fa-paper-plane text-info"
                        aria-hidden="true"></i></button>
            </li>
        @endforeach
        <div class="d-flex justify-content-end mt-2">
            <p> {{ $chat_users->links() }}</p>
        </div>
    </ul>

    <script>

        document.addEventListener('livewire:load', function() {
            Livewire.on('chat.create-chat-component', function(checkedIds) {

                var checkedIds = checkedIds;
                $(checkedIds).each(function(index, value) {
                    var chk = $('#checked_checkbox_' + value).prop("checked");
                    console.log(chk);
                    if (chk) {
                        $('#checked_' + value).remove()
                    } else {
                        $('#checked_' + value).show()
                    }
                })
                $('.send-grp-msg').hide();
                if(checkedIds.length > 0){
                    $('.send-grp-msg').show();
                }
                console.log(checkedIds)
            });
        });
    </script>
</div>
