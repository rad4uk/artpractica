@extends('layouts.main', [
    'metaTitle' => $category->meta_title ?? '',
    'metaDescription' => $category->meta_description ?? '',
    'canonical' => route('portfolio'),
])

@push('styles')
    @vite(['resources/sass/frontend/portfolio.scss'])
@endpush

@section('content')
    <tabs-component
        :categories='@json($categories)'
        :category='@json($category)'
    ></tabs-component>
    <project-component
        :posts='@json($posts)'
        :category='@json($category)'
    >
    </project-component>

    <feedback-component></feedback-component>
@endsection

@push('scripts')
    @vite(['resources/js/frontend/portfolio.js'])
@endpush
