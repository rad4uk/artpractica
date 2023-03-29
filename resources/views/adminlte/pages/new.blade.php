@extends('adminlte.layout.adminlte')

@section('styles')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
@endsection;

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: auto">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Edit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin_home_index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin_page_index')}}">Все страницы</a></li>
                            <li class="breadcrumb-item active">Добавить страницу</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Основное</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <form action="{{route('admin_page_new')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Заголовок</label>
                                    <input type="text" id="inputName" name="title" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">Описание</label>
                                    <textarea id="inputDescription" name="description" class="form-control" rows="4" placeholder="начните вводить текст"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="inputUrl">Ссылка (должна быть уникальной)</label>
                                    <input type="text" id="inputUrl" name="pageUrl" class="form-control" value="{{env('APP_URL')}}">                                </div>
                                {{--                                <div class="form-group">--}}
                                {{--                                    <label for="inputStatus">Status</label>--}}
                                {{--                                    <select id="inputStatus" class="form-control custom-select">--}}
                                {{--                                        <option disabled>Select one</option>--}}
                                {{--                                        <option>On Hold</option>--}}
                                {{--                                        <option>Canceled</option>--}}
                                {{--                                        <option selected>Success</option>--}}
                                {{--                                    </select>--}}
                                {{--                                </div>--}}

                            </div>
                            <div class="row m-lg-3">
                                <div class="col-12">
                                    {{--                    <a href="#" class="btn btn-secondary">Cancel</a>--}}
                                    <input type="submit" value="Добавить" class="btn btn-success float-left">
                                </div>
                            </div>
                        </form>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection;

@section('scripts')
    <!-- jQuery -->
    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('adminlte/dist/js/demo.js')}}"></script>

    @vite('resources/js/adminlte/page.js')
@endsection

