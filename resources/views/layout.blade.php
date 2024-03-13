<!doctype html>

<html
    lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="assets/"
    data-template="vertical-menu-template">
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    @if(\App\Models\Setting::query()->where('key', 'title_site')->first())
        <title>{{ \App\Models\Setting::query()->where('key', 'title_site')->first()->value }}</title>
    @endif

    <meta name="description" content="" />

    <!-- Favicon -->
    @if(\App\Models\Setting::query()->where('key', 'title_site')->first())
{{--        <title>{{ \App\Models\Setting::query()->where('key', 'title_site')->first()->value }}</title>--}}
        <link rel="icon" type="image/x-icon"
              href="{{ asset('storage'. \Str::replace('public', '', \App\Models\Setting::query()->where('key', 'logo')->first()->value)) }}" />
    @endif


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />

    @yield('css')

    <!-- Page CSS -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<!-- Layout wrapper -->

@if(Route::currentRouteName() == 'login')
    @yield('content')
@else
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        @if(Route::currentRouteName() != 'login')
            @include('blocks.sidebar')
        @endif
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

           @include('blocks.header')

            <!-- / Navbar -->

            <!-- Content wrapper -->
            @yield('content')
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
</div>
@endif
<!-- / Layout wrapper -->

<audio id="audio" class="d-none">
    <source src="{{ asset('audio.mp3') }}" type="audio/mpeg">
</audio>
<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<!-- Helpers -->
<script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
{{--    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>--}}
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{ asset('assets/js/config.js') }}"></script>


<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
{{--<script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>--}}
<script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
{{--<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>--}}

<script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>

<!-- Main JS -->

<!-- Page JS -->
<script src="{{ asset('assets/js/ui-toasts.js') }}"></script>

<script src="{{ asset('build/assets/app-8UGkboQB.js') }}"></script>

@yield('js')

@if(session('message'))
    <script>
        toastr.success('{{ session('message') }}');
    </script>
@endif


<script>

    @if(auth()->user())
        window.Echo.private('chat-message.{{ auth()->user()->id }}')
            .listen('SendMessage', e => {
                if(e) {
                    console.log('test event')
                    var audio = document.getElementById('audio');
                    audio.play();
                }

            })

        window.Echo.channel('chat-order')
            .listen('OrderEvent', e => {
                if(e) {
                    var audio = document.getElementById('audio');
                    audio.play();
                }

            })
    @endif


</script>
</body>
</html>
