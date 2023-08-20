@extends('layouts.main', [
    'metaTitle' => $post->meta_title ?? '',
    'metaDescription' => $post->meta_description ?? '',
    'canonical' => route('projects', $post->slug),
])

@push('styles')
    @vite(['resources/sass/frontend/project.scss'])
@endpush

@section('content')
    <tabs-component
        :categories='@json($categories)'
        :category='@json($post->category)'
    ></tabs-component>

    <body-component
        :post='@json($post)'
        :apartment_images='@json($apartmentImages)'
        :preview_image='@json(asset($post->getFullImagePath($post->preview_image)))'
        :data='@json($body)'
        :slider_images_data='@json($sliderImagesData)'
    >
    </body-component>

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
