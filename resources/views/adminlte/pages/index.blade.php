@extends('adminlte.layout.adminlte')

@push('styles')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Страницы</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin_home_index')}}">Главная</a></li>
                            <li class="breadcrumb-item active">Страницы</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

{{--        <section>--}}
{{--            <div class="container-fluid">--}}
{{--                <div class="row mb-3">--}}
{{--                    <div class="col-12" style="display: flex;justify-content: right">--}}
{{--                        <a href="{{route('admin_page_new')}}" class="btn btn-success">Добавить страницу</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Страницы</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th style="width: 20%">
                                Заголовок
                            </th>
                            <th style="width: 30%">
                                Описание
                            </th>
                            <th style="width: 8%" class="text-center">
                                Ссылка
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>
                                    {{$page->title}}
                                </td>
                                <td>
                                    {{$page->description}}
                                </td>
                                <td>
                                    <a href="{{$page->slug}}">{{$page->slug}}</a>
                                </td>
                                <td class="project-actions text-right">
                                    @if($page->id === 1)
                                        <a class="btn btn-info btn-sm" href={{route('admin_home_page_edit')}}>
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Изменить
                                        </a>
                                    @endif
                                    @if($page->id === 2)
                                        <a class="btn btn-info btn-sm"
                                           href={{route('admin_about_page_edit')}}>
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Изменить
                                        </a>
                                    @endif
                                    @if($page->id === 3)
                                        <a class="btn btn-info btn-sm"
                                           href={{route('admin_contact_page_edit')}}>
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Изменить
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection

@push('scripts')
    <!-- jQuery -->
    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>

    @vite('resources/js/adminlte/page.js')

@endpush

