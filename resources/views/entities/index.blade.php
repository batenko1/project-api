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
                            @if($entities->count())
                                <div id="jstree-basic">
                                <ul>


                                    @foreach($entities as $entity)
                                        <li data-jstree='{"icon" : "ti ti-folder"}' data-id="{{ $entity->id }}">
                                            {{ $entity->title }}
                                            @if($entity->child)
                                                <ul>
                                                    @foreach($entity->child as $child)
                                                        <li data-id="{{ $child->id }}"
                                                            data-jstree='{"icon" : "ti ti-folder"}'>{{ $child->title }}

                                                            @if($child->child)
                                                                <ul>
                                                                    @foreach($child->child as $item)
                                                                        <li
                                                                            data-id="{{ $item->id }}"
                                                                            data-jstree='{"icon" : "ti ti-folder"}'>{{ $item->title }}

                                                                            @if($item->child)
                                                                                <ul>
                                                                                    @foreach($item->child as $child)
                                                                                        <li
                                                                                            data-id="{{ $child->id }}"
                                                                                            data-jstree='{"icon" : "ti ti-folder"}'>{{ $child->title }}</li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>


                                                    @endforeach


                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @else
                                <span>В данный момент нет категорий</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <!-- /JSTree -->
        </div>


        <!-- / Footer -->

        <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="backDropModalTitle">Действительно удалить?</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            Нет
                        </button>
                        <form action="" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">Да</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="content-backdrop fade"></div>


    </div>
    <style>
        .jstree-default .jstree-anchor {
            height: 40px;
        }
    </style>
@endsection


@section('js')
    <script src="{{ asset('assets/vendor/libs/jstree/jstree.js') }}"></script>

    <script src="{{ asset('assets/js/extended-ui-treeview.js') }}"></script>

    <script>


            $('#jstree-basic').on('ready.jstree', function() {
                $('#jstree-basic').find('.jstree-anchor').each(function() {

                    // Для каждого элемента в дереве, добавляем кнопку
                    console.log('here')
                    var node = $(this).closest('.jstree-node');
                    node.append('<button class="btn btn-primary btn-sm btn-edit-entity" style="margin-left: 10px;">Редактировать</button>' +
                        '<button class="btn btn-danger btn-sm btn-delete-entity" style="margin-left: 15px">Удалить</button>');
                });
            })
                .on('open_node.jstree', function (e, data) {

                    var node = data.node
                    var children = node.children


                    $.each(children, function (el, item) {

                        $('#jstree-basic').find('#' + item).each(function() {
                            var node = $(this).closest('.jstree-node');
                            node.append('<button class="btn btn-primary btn-sm btn-edit-entity" style="margin-left: 10px;">Редактировать</button>' +
                                '<button class="btn btn-danger btn-sm btn-delete-entity" style="margin-left: 15px">Удалить</button>');
                        })
                    })



                });

        $('body').on('click', '.btn-edit-entity', function() {
            let el = $(this)
            let id = el.closest('li').data('id')

            window.location.href = '/admin/entities/' + id + '/edit'
        })

        $('body').on('click', '.btn-delete-entity', function() {
            let el = $(this)
            let id = el.closest('li').data('id')

            $('#backDropModal').find('form').attr('action', '/admin/entities/' + id)

            var modal = new bootstrap.Modal(document.getElementById('backDropModal'));

            // Открыть модальное окно
            modal.show();

            // window.location.href = '/admin/entities/' + id + '/edit'
        })

    </script>
@endsection
