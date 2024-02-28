<ul class="list-unstyled chat-history">
    @foreach($chat->messages->sortBy('id') as $message)
        @include('chat.blocks.message-render')
    @endforeach

</ul>
