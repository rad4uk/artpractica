@extends('layouts.main')

@push('styles')
    @vite(['resources/sass/frontend/project.scss'])
@endpush

@section('content')
    <tabs-component
        :categories='@json($categories)'
        :category='@json($post->category)'
    ></tabs-component>

    <preview-component
        :post='@json($post)'
        :apartment_images='@json($apartmentImages)'
        :preview_image='@json(asset($post->getFullImagePath($post->preview_image)))'
    >
    </preview-component>

    <div class="project-wrapper">
        @foreach($body as $widget)
            @include('frontend.project.widgets.' . $widget->name, ['widget' => $widget])
        @endforeach
    </div>
    @if(count($additionalPostsData) > 0)
        <post-slider-component
            :posts='@json($additionalPostsData)'
        >
        </post-slider-component>
    @endif

    <feedback-component></feedback-component>
@endsection

@push('scripts')
    @vite(['resources/js/frontend/project.js'])
@endpush
