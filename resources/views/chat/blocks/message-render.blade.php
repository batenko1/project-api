<li class="chat-message @if($message->account_id) chat-message-right @endif">
    <div class="d-flex overflow-hidden">
        <div class="user-avatar flex-shrink-0 me-3">
            <div class="avatar avatar-sm">
                <img src="{{ asset('assets/img/avatars/2.png') }}" alt="Avatar"
                     class="rounded-circle"/>
            </div>
        </div>
        <div class="chat-message-wrapper flex-grow-1">
            <div class="chat-message-text">
                <p class="mb-0">{{ $message->message }}</p>
            </div>
            <div class="text-muted mt-1">
                <small>{{ $message->created_at->format('d.m.Y H:i') }}</small>
            </div>
        </div>
    </div>
</li>
