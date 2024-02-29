@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/jstree/jstree.css') }}" />
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4><span class="fw-light text-muted">Категории</h4>

            @can('create entity')
            <a href="{{ route('admin.entities.create') }}"
               class="btn btn-primary waves-effect waves-light mb-4">Создать</a>
            @endcan

            <!-- JSTree -->
            <div class="row">
                <!-- Basic -->
                <div class="col-md-6 col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div id="jstree-basic">
                                <ul>
                                    @foreach($entities as $entity)
                                        <li data-jstree='{"icon" : "ti ti-folder"}'>
                                            {{ $entity->title }}
                                            @if($entity->child)
                                                <ul>
                                                    @foreach($entity->child as $child)
                                                        <li data-jstree='{"icon" : "ti ti-folder"}'>{{ $child->title }} </li>

                                                        @if($child->child)
                                                            <ul>
                                                                @foreach($child->child as $item)
                                                                    <li data-jstree='{"icon" : "ti ti-folder"}'>{{ $item->title }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @endforeach


                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
{{--                                    <li data-jstree='{"icon" : "ti ti-folder"}'>--}}
{{--                                        css--}}
{{--                                        <ul>--}}
{{--                                            <li data-jstree='{"icon" : "ti ti-folder"}'>app.css</li>--}}
{{--                                            <li data-jstree='{"icon" : "ti ti-folder"}'>style.css</li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li class="jstree-open" data-jstree='{"icon" : "ti ti-folder"}'>--}}
{{--                                        img--}}
{{--                                        <ul data-jstree='{"icon" : "ti ti-folder"}'>--}}
{{--                                            <li data-jstree='{"icon" : "ti ti-folder"}'>bg.jpg</li>--}}
{{--                                            <li data-jstree='{"icon" : "ti ti-folder"}'>logo.png</li>--}}
{{--                                            <li data-jstree='{"icon" : "ti ti-folder"}'>avatar.png</li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li class="jstree-open" data-jstree='{"icon" : "ti ti-folder"}'>--}}
{{--                                        js--}}
{{--                                        <ul>--}}
{{--                                            <li data-jstree='{"icon" : "ti ti-folder"}'>jquery.js</li>--}}
{{--                                            <li data-jstree='{"icon" : "ti ti-folder"}'>app.js</li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li data-jstree='{"icon" : "ti ti-file-text"}'>index.html</li>--}}
{{--                                    <li data-jstree='{"icon" : "ti ti-file-text"}'>page-one.html</li>--}}
{{--                                    <li data-jstree='{"icon" : "ti ti-file-text"}'>page-two.html</li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- /JSTree -->
        </div>

        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
    </div>
@endsection


@section('js')
    <script src="{{ asset('assets/vendor/libs/jstree/jstree.js') }}"></script>

    <script src="{{ asset('assets/js/extended-ui-treeview.js') }}"></script>
@endsection
