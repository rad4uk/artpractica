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
    <div class="content-wrapper" style="min-height: auto; height: auto">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Category Edit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin_home_index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin_category_index')}}">Все категории</a></li>
                            <li class="breadcrumb-item active">Добавить категорию</li>
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
                        <form action="{{route('admin_category_create')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Название</label>
                                    <input type="text" id="inputName" name="title" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">Описание</label>
                                    <textarea id="inputDescription" name="description" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="inputUrl">Ссылка</label>
                                    <input type="text" id="inputUrl" name="slug" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Родительская категория</label>
                                    <select id="inputStatus" name='parent_id' class="form-control custom-select">
                                        <option value="-1">Нет</option>
                                        @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                                            @if(count($cat->childrenRecursive) > 0)
                                                @include('adminlte.category.parts.option', ['childrens' => $cat->childrenRecursive, 'count' => 3])
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="status" class="form-check-input">Опубликовать
                                    </label>
                                </div>

                                <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
                                     aria-labelledby="custom-tabs-three-home-tab">

                                    <div class="card card-blue card-outline collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title">Отображение на главной</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body" style="display: none;">
                                            <div class="form-group collection-wrapper">
                                                <div class="secondSectionDescription" id="secondSectionDescription">
                                                    <div class="row collection-row">
                                                        <div class="form-group" style="width: 100%">
                                                            <label for="inputDescription">Изображение</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="page_image" class="custom-file-input" id="validatedCustomFile">
                                                                <label class="custom-file-label" for="validatedCustomFile">Выберите файл</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="width: 100%">
                                                            <label for="inputStatus">Выберите страницу</label>
                                                            <select id="inputStatus" name='page_id' class="form-control custom-select">
                                                                <option value="-1">Нет</option>
                                                                @foreach($pages as $page)
                                                                    <option value="{{$page->id}}">{{$page->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group" style="width: 100%">
                                                            <label for="inputName">Порядок сортировки</label>
                                                            <input type="number" id="inputName" name="page_sort" class="form-control" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>




                            <div class="row m-lg-3">
                                <div class="col-12">
                                    <input type="submit" value="сохранить" class="btn btn-success float-left">
                                </div>
                            </div>
                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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

