@extends('adminlte.layout.adminlte')

@push('styles')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
@endpush

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: auto">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактировани проекта</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin_home_index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin_post_index')}}">Все проекты</a></li>
                            <li class="breadcrumb-item active">Редактировани проекта</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <widget-container
                    :type_admin_page='@json('edit')'
                    :widgets='@json($body)'
                    :file_dir='@json($post->getDirPath())'
                ></widget-container>

                <project-content
                    :action='@json(route('admin_post_edit', $post->id))'
                    :type_admin_page='@json('edit')'
                    :post='@json($post)'
                    :all_additional_posts='@json($posts)'
                    :additional_posts='@json($additionalPosts)'
                    :categories='@json($categories)'
                    :file_dir='@json($post->getDirPath())'
                ></project-content>
            </div>

        </section>
    </div>
@endsection

@push('scripts')
    <!-- jQuery -->
    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>

    @vite('resources/js/adminlte/project.js')
@endpush
