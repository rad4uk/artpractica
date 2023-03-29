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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: auto">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Изменить категорию</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin_home_index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin_page_index')}}">Все категории</a></li>
                            <li class="breadcrumb-item active">категория</li>
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
                        <form action="{{route('admin_category_edit', $category->id)}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Название</label>
                                    <input type="text" id="inputName" name="title" class="form-control" value="{{$category->title}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">Описание</label>
                                    <textarea id="inputDescription" name="description" class="form-control" rows="4">{{$category->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="inputUrl">Ссылка</label>
                                    <input type="text" id="inputUrl" name="slug" class="form-control" value="{{$category->slug}}">                                </div>
{{--                                <category-select :categories='@json($categories)'></category-select>--}}
                                <div class="form-group">
                                    <label for="inputStatus">Родительская категория</label>
                                    <select id="inputStatus" name='parent' class="form-control custom-select">
                                        <option value="-1">Нет</option>
                                        @foreach($categories as $cat)
                                            <option value="{{$cat->id}}" {{($cat->id === $category->parent_id) ? 'selected' : ''}}>{{$cat->title}}</option>
                                            @if(count($cat->childrenRecursive) > 0)
                                                    @include('adminlte.category.parts.option', ['childrens' => $cat->childrenRecursive, 'count' => 3])
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="status" class="form-check-input" {{($category->status == 1) ? 'checked' : ''}}>Опубликовать
                                    </label>
                                </div>
                                <div style="display: flex; flex-direction: column">
                                    <div>Полная ссылка</div>
                                    <div><a href="{{$slug}}">{{$slug}}</a></div>
                                </div>
                            </div>
                            <div class="row m-lg-3">
                                <div class="col-12">
                                    {{--                    <a href="#" class="btn btn-secondary">Cancel</a>--}}
                                    <input type="submit" value="сохранить" class="btn btn-success float-left">
                                </div>
                            </div>
                        </form>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <!-- /.card -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Изображения</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Размер</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td>Functional-requirements.docx</td>
                                    <td>49.8005 kb</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                <tr>
                                    <td>UAT.pdf</td>
                                    <td>28.4883 kb</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <category-image :category='@json($category)'></category-image>
{{--            <div class="row category">--}}
{{--                <div class="col-12 category__images" style="display: flex; flex-direction: row; flex-wrap: wrap">--}}
{{--                    @foreach($category->categoryImages as $image)--}}
{{--                    <div class="col-sm-3 category__images-item">--}}
{{--                        <img src="{{$image->image->path}}" alt="{{$image->image->alt}}">--}}
{{--                        <button class='btn btn-info btn-sm'>--}}
{{--                            <i class="fas fa-pencil-alt"></i>--}}
{{--                            Изменить--}}
{{--                        </button>--}}
{{--                        <button class="btn btn-danger btn-sm">--}}
{{--                            <i class="fas fa-trash"></i>--}}
{{--                            Удалить--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
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
