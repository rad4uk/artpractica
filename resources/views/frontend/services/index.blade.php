@extends('layouts.main', [
    'metaTitle' => $page->meta_title,
    'metaDescription' => $page->meta_description,
    'canonical' => route('service', $page->slug),
])

@push('styles')
    @vite(['resources/sass/frontend/design.scss'])
@endpush

@section('content')
    <services-component
        :service='@json($service)'
        :services='@json($services)'
    ></services-component>


    <feedback-component></feedback-component>
@endsection

@push('scripts')
    @vite(['resources/js/frontend/design.js'])
@endpush
