@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}"/>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Страницы /</span> Редактировать</h4>

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">

                        <div class="card-body">
                            <form method="post" action="{{ route('admin.pages.update', $page->id) }}"
                                  enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Заголовок</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                               class="form-control @if($errors->first('title')) is-invalid @endif"
                                               id="basic-default-name"
                                               value="{{ old('title') ?? $page->title }}"
                                               name="title"/>
                                        @if($errors->first('title'))
                                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Описание</label>
                                    <div class="col-sm-10">
                                        <div id="full-editor">
                                            {!! $page->text!!}
                                        </div>
                                        <textarea style="opacity: 0; width: 0;height: 0"
                                                  name="text">{{ old('text') ?? $page->text }}</textarea>
                                        @if($errors->first('text'))
                                            <div class="invalid-feedback">{{ $errors->first('text') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" name="submit" class="btn btn-primary">Обновить</button>
                                        <button type="submit" value="1" name="submit_and_reload"
                                                class="btn btn-primary">Обновить и вернуться назад
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <form
                                style="float:right;"
                                action="{{ route('admin.pages.destroy', $page->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">
                                    <i class="ti ti-trash me-1"></i> Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>


    <script>
        (function () {
            const fullToolbar = [
                [
                    {
                        font: []
                    },
                    {
                        size: []
                    }
                ],
                ['bold', 'italic', 'underline', 'strike'],
                [
                    {
                        color: []
                    },
                    {
                        background: []
                    }
                ],
                [
                    {
                        script: 'super'
                    },
                    {
                        script: 'sub'
                    }
                ],
                [
                    {
                        header: '1'
                    },
                    {
                        header: '2'
                    },
                    'blockquote',
                    'code-block'
                ],
                [
                    {
                        list: 'ordered'
                    },
                    {
                        list: 'bullet'
                    },
                    {
                        indent: '-1'
                    },
                    {
                        indent: '+1'
                    }
                ],
                [{direction: 'rtl'}],
                ['link', 'image', 'video', 'formula'],
                ['clean']
            ];
            const fullEditor = new Quill('#full-editor', {
                bounds: '#full-editor',
                placeholder: 'Type Something...',
                modules: {
                    formula: true,
                    toolbar: fullToolbar
                },
                theme: 'snow'
            })

            const hiddenTextarea = $('textarea');

            // Слушаем событие изменения содержимого редактора
            fullEditor.on('text-change', function () {
                // Получаем HTML содержимое редактора
                const editorContent = fullEditor.root.innerHTML;
                // Записываем его в скрытое поле textarea
                hiddenTextarea.val(editorContent);
            });
        })();
    </script>
@endsection
