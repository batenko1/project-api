@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}"/>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="app-chat card overflow-hidden">
                <div class="row g-0">
                    <!-- Sidebar Left -->
                    <!-- /Sidebar Left-->

                    <!-- Chat & Contacts -->
                    <div
                        class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end"
                        id="app-chat-contacts">

                        <hr class="container-m-nx m-0"/>

                        <div class="sidebar-header">
                            <div class="d-flex align-items-center me-3 me-lg-0">

                                <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                                    <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                                    <input type="text" class="form-control chat-search-input" placeholder="Поиск" aria-label="Search..." aria-describedby="basic-addon-search31">
                                </div>
                            </div>
                            <i class="ti ti-x cursor-pointer d-lg-none d-block position-absolute mt-2 me-1 top-0 end-0" data-overlay="" data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
                        </div>

                        <hr>

                        <div class="sidebar-body">
                            <div class="chat-contact-list-item-title">
                                <h5 class="text-primary mb-0 px-4 pt-3 pb-2">Чаты</h5>
                            </div>
                            <!-- Chats -->
                            <ul class="list-unstyled chat-contact-list" id="chat-list">
                                @if(!$chats->count())
                                    <li class="chat-contact-list-item chat-list-item-0">
                                        <h6 class="text-muted mb-0">На данный момент чатов нету</h6>
                                    </li>
                                @else

                                    @foreach($chats as $chat)
                                        @include('chat.blocks.chat-render')
                                    @endforeach

                                @endif

                            </ul>
                            <!-- Contacts -->
                        </div>
                    </div>
                    <!-- /Chat contacts -->

                    <!-- Chat History -->
                    <div class="col app-chat-history bg-body">
                        <div class="chat-history-wrapper">
                            <div class="chat-history-header border-bottom">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex overflow-hidden align-items-center">
                                        <i
                                            class="ti ti-menu-2 ti-sm cursor-pointer d-lg-none d-block me-2"
                                            data-bs-toggle="sidebar"
                                            data-overlay
                                            data-target="#app-chat-contacts"></i>
                                        <div class="flex-shrink-0 avatar">
{{--                                            <img--}}
{{--                                                src="../../assets/img/avatars/2.png"--}}
{{--                                                alt="Avatar"--}}
{{--                                                class="rounded-circle"--}}
{{--                                                data-bs-toggle="sidebar"--}}
{{--                                                data-overlay--}}
{{--                                                data-target="#app-chat-sidebar-right"/>--}}
                                        </div>
                                        <div class="chat-contact-info flex-grow-1 ms-2">
{{--                                            <h6 class="m-0">Felecia Rower</h6>--}}
{{--                                            <small class="user-status text-muted">NextJS developer</small>--}}
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">

{{--                                        <div class="dropdown d-flex align-self-center">--}}
{{--                                            <button--}}
{{--                                                class="btn p-0"--}}
{{--                                                type="button"--}}
{{--                                                id="chat-header-actions"--}}
{{--                                                data-bs-toggle="dropdown"--}}
{{--                                                aria-haspopup="true"--}}
{{--                                                aria-expanded="false">--}}
{{--                                                <i class="ti ti-dots-vertical"></i>--}}
{{--                                            </button>--}}
{{--                                            <div class="dropdown-menu dropdown-menu-end"--}}
{{--                                                 aria-labelledby="chat-header-actions">--}}
{{--                                                <a class="dropdown-item" href="javascript:void(0);">View Contact</a>--}}
{{--                                                <a class="dropdown-item" href="javascript:void(0);">Mute--}}
{{--                                                    Notifications</a>--}}
{{--                                                <a class="dropdown-item" href="javascript:void(0);">Block Contact</a>--}}
{{--                                                <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>--}}
{{--                                                <a class="dropdown-item" href="javascript:void(0);">Report</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="chat-history-body bg-body">

                            </div>
                            <!-- Chat message form -->
                            <div class="chat-history-footer shadow-sm">
                                <form class="form-send-message d-flex justify-content-between align-items-center">
                                    @csrf
                                    <input type="hidden" name="chat_id">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input
                                        class="form-control message-input border-0 me-3 shadow-none"
                                        name="message"
                                        placeholder="Напиши свое сообщение"/>
                                    <div class="message-actions d-flex align-items-center">

                                        <button class="btn btn-primary d-flex send-msg-btn btn-send-message">
                                            <i class="ti ti-send me-md-1 me-0"></i>
                                            <span class="align-middle d-md-inline-block d-none">Отправить</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Chat History -->

                    <!-- Sidebar Right -->
                    <div class="col app-chat-sidebar-right app-sidebar overflow-hidden" id="app-chat-sidebar-right">
                        <div
                            class="sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap px-4 pt-5">
                            <div class="avatar avatar-xl avatar-online">
                                <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle"/>
                            </div>
                            <h6 class="mt-2 mb-0">Felecia Rower</h6>
                            <span>NextJS Developer</span>
                            <i
                                class="ti ti-x ti-sm cursor-pointer close-sidebar d-block"
                                data-bs-toggle="sidebar"
                                data-overlay
                                data-target="#app-chat-sidebar-right"></i>
                        </div>
                        <div class="sidebar-body px-4 pb-4">
                            <div class="my-4">
                                <small class="text-muted text-uppercase">About</small>
                                <p class="mb-0 mt-3">
                                    A Next. js developer is a software developer who uses the Next. js framework
                                    alongside ReactJS
                                    to build web applications.
                                </p>
                            </div>
                            <div class="my-4">
                                <small class="text-muted text-uppercase">Personal Information</small>
                                <ul class="list-unstyled d-grid gap-2 mt-3">
                                    <li class="d-flex align-items-center">
                                        <i class="ti ti-mail ti-sm"></i>
                                        <span class="align-middle ms-2">josephGreen@email.com</span>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class="ti ti-phone-call ti-sm"></i>
                                        <span class="align-middle ms-2">+1(123) 456 - 7890</span>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class="ti ti-clock ti-sm"></i>
                                        <span class="align-middle ms-2">Mon - Fri 10AM - 8PM</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-4 d-none">
                                <small class="text-muted text-uppercase">Options</small>
                                <ul class="list-unstyled d-grid gap-2 mt-3">
                                    <li class="cursor-pointer d-flex align-items-center">
                                        <i class="ti ti-badge ti-sm"></i>
                                        <span class="align-middle ms-2">Add Tag</span>
                                    </li>
                                    <li class="cursor-pointer d-flex align-items-center">
                                        <i class="ti ti-star ti-sm"></i>
                                        <span class="align-middle ms-2">Important Contact</span>
                                    </li>
                                    <li class="cursor-pointer d-flex align-items-center">
                                        <i class="ti ti-photo ti-sm"></i>
                                        <span class="align-middle ms-2">Shared Media</span>
                                    </li>
                                    <li class="cursor-pointer d-flex align-items-center">
                                        <i class="ti ti-trash ti-sm"></i>
                                        <span class="align-middle ms-2">Delete Contact</span>
                                    </li>
                                    <li class="cursor-pointer d-flex align-items-center">
                                        <i class="ti ti-ban ti-sm"></i>
                                        <span class="align-middle ms-2">Block Contact</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Sidebar Right -->

                    <div class="app-overlay"></div>
                </div>
            </div>
        </div>
        <!-- / Content -->


        <div class="content-backdrop fade"></div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            window.Echo.private('chat-message.{{ auth()->user()->id }}')
                .listen('SendMessage', e => {
                    if (e) {

                        if(e.messageHtml) {
                            $('input[name="message"]').val('')
                            $('.chat-history').append(e.messageHtml)

                            setTimeout(() => {
                                $('.chat-history-body.bg-body').scrollTop(99999999999999);
                            }, 50)
                        }

                        if (e.html) {
                            if($('.chat-contact-list-item[data-id="'+ e.message.chat_id +'"]')) {
                                $('.chat-contact-list-item[data-id="'+ e.message.chat_id +'"]').replaceWith(e.html)
                            }
                            else {
                                $('.chat-contact-list').prepend(e.html)
                            }


                        }

                    }

                })

            $('body').on('click', '.chat-contact-list-item', function() {
                let el = $(this)

                $('.chat-contact-list-item').removeClass('active')
                el.addClass('active')
                let id = el.data('id')

                el.find('.badge-center').remove()

                $.ajax({
                    type: 'post',
                    url: '/api/get-chat',
                    data: {chat_id:id},
                    success:function(result) {
                        $('input[name="chat_id"]').val(id)
                        $('.chat-history-body').html(result)

                        setTimeout(() => {
                            $('.chat-history-body.bg-body').scrollTop(99999999999999);
                        }, 50)
                    }
                })
            })

            $('.btn-send-message').click(function(e) {
                e.preventDefault()
                let el = $(this)
                let form = new FormData(el.closest('form')[0])

                let message = $('input[name="message"]')

                let messageVal = message.val()

                if(!messageVal.length) return

                $.ajax({
                    type: 'post',
                    url: '/api/send-message',
                    data: form,
                    processData: false,
                    contentType: false,
                    success: function (result) {
                        message.val('')
                        $('.chat-history').append(result)

                        setTimeout(() => {
                            $('.chat-history-body.bg-body').scrollTop(99999999999999);
                        }, 50)
                    }
                })



            })

            $('.chat-search-input').keyup(function() {
                let el = $(this)
                let val = el.val()

                if(val.length) {

                    

                }

            })

        })
    </script>
@endsection
