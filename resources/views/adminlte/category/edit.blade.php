@extends('adminlte.layout.adminlte')

@push('styles')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">

{{--    <link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
@endpush

@section('content')
    <div class="content-wrapper" style="min-height: auto">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Изменить категорию</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin_home_index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin_category_index')}}">Все категории</a></li>
                            <li class="breadcrumb-item active">категория</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <category-content
            :action='@json(route('admin_category_update', $category->id))'
            :category='@json($category)'
            :posts='@json($posts)'
            :categories='@json($categories)'
            :pages='@json($pages)'
            :is_type_page='@json('edit')'
        ></category-content>

    </div>
@endsection

@push('scripts')
    <!-- jQuery -->
    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
    @vite('resources/js/adminlte/category.js')

@endpush
