@extends('layouts.main')

@push('styles')
    @vite(['resources/sass/frontend/portfolio.scss'])
@endpush

@section('content')
    <tabs-component
        :categories='@json($categories)'
        :category='@json($category)'
    ></tabs-component>

    <div class="project">
        <div class="container">
            <div class="project__row">
                @foreach($posts as $post)
                    <project-item-component :item='@json($post)'></project-item-component>
                @endforeach
            </div>
        </div>
    </div>

    <feedback-component></feedback-component>
@endsection

@push('scripts')
    @vite(['resources/js/frontend/portfolio.js'])
@endpush
