<div>
    <div class="chatlist_header">
        <div class="title">
            Chat
        </div>

        <div class="img_container">
            <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ auth()->user()->name }}"
                alt="">
        </div>
    </div>
    <div class="chatlist_body ">
        @if (count($conversations) > 0)
            @foreach ($conversations as $conv)
                <div class="chatlist_item" wire:key="{{ $conv->id }}"
                    wire:click="$emit('chatUserSelected',{{ $conv }},{{ $this->getChatUserInstance($conv, $name = 'id') }})">
                    <div class="chatlist_img_container">

                        <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ $this->getChatUserInstance($conv, $name = 'name') }}"
                            alt="">
                    </div>
                    <div class="chatlist_info">
                        <div class="top_row">
                            <div class="list_username">
                                {{ $this->getChatUserInstance($conv, $name = 'name') }}
                            </div>
                            <div class="date">
                                {{ $conv->messages->last()->created_at->shortAbsoluteDiffForHumans() }}
                            </div>
                        </div>
                        <div class="bottom_row">
                            <div class="message_body text-truncate">
                                {{ $conv->messages->last()->body }}
                            </div>
                            @php
                                if (count($conv->messages->where('read', 0)->where('receiver_id', Auth()->user()->id))) {
                                    echo ' <div class="unread_count badge rounded-pill text-light bg-danger">  ' . count($conv->messages->where('read', 0)->where('receiver_id', Auth()->user()->id)) . '</div> ';
                                }

                            @endphp
                        </div>
                    </div>

                </div>
            @endforeach
        @else
            <p class="p-2 bg-light text-center">No Conversation</p>
        @endif
    </div>
</div>
