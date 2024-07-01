<li class="chat-contact-list-item" data-id="{{ $chat->id }}">
    <a class="d-flex align-items-center">
        <div class="flex-shrink-0 avatar avatar-online">
            <img src="{{ asset('assets/img/avatars/13.png') }}" alt="Avatar" class="rounded-circle"/>
        </div>
        <div class="chat-contact-info flex-grow-1 ms-2">
            @if($chat->account)
                <h6 class="chat-contact-name text-truncate m-0">{{ $chat->account?->fio }}</h6>
            @else
                <h6 class="chat-contact-name text-truncate m-0">{{ $chat->uuid }}</h6>
            @endif

            <p class="chat-contact-status text-muted text-truncate mb-0">
                {{ \Str::limit($chat->messages->last()->message, 40, '...') }}
            </p>
        </div>
        <small class="text-muted mb-auto"
        >{{ \Carbon\Carbon::parse($chat->messages->last()->created_at)->diffForHumans(null, null, true) }}</small>
        @if($chat->messages->where('is_read', 0)->count())
            <span class="badge badge-center rounded-pill bg-primary" style="margin-top: 20px;display: block;"
            >{{ $chat->messages->where('is_read', 0)->count() }}</span>
        @endif
    </a>
</li>
