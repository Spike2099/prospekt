<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}" />
    
    <title>@yield('title') / {{ config('app.name') }} </title>
    <link rel="shortcut icon" href='/img/favicon.png' type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/defina.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}" />
</head>
<body>
    <div id="admin" :class="[isOpen ? 'panel' : 'panel-close']" class="d-print-block" v-cloak>
        @include('layout.main.aside')
        <div class="bg-light content d-print-table w-100">
            @include('layout.main.header')
            <section 
                style="overflow-y: scroll;height: 83vh" 
                class="d-print-table w-100 @if($_SERVER['REQUEST_URI'] === '/dashboard' && empty(session('search'))) shlak @endif"
            >
                <div class="container-fluid d-print-table">
                    <div class="row d-print-table">
                        <div class="col-md-12 d-print-table pad">
                            <main class="px-3 pb-5 d-print-block">
                                <div class="d-print-none">
                                    @yield('breadcrumbs')
                                </div>
                                <div class="d-print-none">
                                    <h2>@yield('title')</h2>
                                </div>
                                {{-- @include('layout.main.company') --}}
                                @yield('content')
                            </main>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="border-top py-2 d-print-none">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <p class="text-muted text-center m-0">
                                <small style="font-size: 12px">Copyright &copy; {{ date('Y') }} 
                                    &middot; Все права защищены. 
                                    &middot; <span class="text-dark">{{ config('app.name') }}</span>
                                    | {{ config('app.email') }}
                                    &middot; <a href="/doc/privatepolice" class="text-muted">Политика конфиденциальности</a>
                                </small>
                            </p>                            
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
{{--    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>--}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/defina.admin.min.js') }}"></script>
    @if ($_SERVER['REQUEST_URI'] === '/dashboard/document/agreement/edit' || $_SERVER['REQUEST_URI'] === '/dashboard/document/agreement')
    <script src="{{ asset('js/cleave.js') }}"></script>
    <script src="{{ asset('js/cleave-phone.ru.js') }}"></script>
    @endif
    <script>
        const editor = document.querySelector('#editor');
        if(editor) {
            ClassicEditor
                .create(editor, {
                    placeholder: 'Опишите товар здесь...'
                })
                .catch(error=>{
                    console.error(error);
                });             
        }
        // if(promo) {
        //     ClassicEditor
        //         .create(promo, {
        //             placeholder: 'Описание...'
        //         })
        //         .catch(error=>{
        //             console.error(error);
        //         });             
        // }

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(
            tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl)
        );
        const offcanvasElementList = document.querySelectorAll('.offcanvas')
        const offcanvasList = [...offcanvasElementList].map(
            offcanvasEl => new bootstrap.Offcanvas(offcanvasEl)
        );
    </script>
</body>
</html>