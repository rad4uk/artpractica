@extends('layouts.main', [
    'metaTitle' => $page->meta_title ?? '',
    'metaDescription' => $page->meta_description ?? '',
    'canonical' => route('about'),
])

@push('styles')
    @vite(['resources/sass/frontend/about.scss'])
@endpush

@section('content')
    <div class="aboutsection">
        <div class="container">
            <div class="aboutsection__row">
                <div class="aboutsection__title">
                    <h1>{{$page->title}}</h1>
                </div>
                <div class="aboutsection__content">
                    <div class="aboutsection__column">
                        <p class="aboutsection__column-title">
                            {{$firstSectionData->authorName}}
                        </p>

                        <p class="aboutsection__column-subtitle">
                            {{ $firstSectionData->authorDescription }}
                        </p>
                    </div>
                    <div class="aboutsection__column">

                        <div class="aboutsection__column-text">
                            {!!$firstSectionData->description !!}
                        </div>
                    </div>
                    <div class="aboutsection__column">
                        <div class="aboutsection__column-img">
                            <picture>
                                <img src="{{$page->getFullImagePath($firstSectionData->image)}}" alt="{{$firstSectionData->authorName}}">
                            </picture>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="command">
        <div class="container">
            <div class="command__row">
                <div class="command__title">
                    <h3>{{$secondSectionData->title}}</h3>
                </div>
                <div class="command__text">
                    <p>
                        {{$secondSectionData->description}}
                    </p>
                </div>
                <div class="command__image">
                    <img src="{{$page->getFullImagePath($secondSectionData->image)}}" alt="{{$secondSectionData->title}}">
                </div>
            </div>
        </div>
    </div>

    <div class="mission">
        <div class="container">
            <div class="mission__row">
                <div class="mission__title">
                    <h3>
                        {{$thirdSectionData->title}}
                    </h3>
                </div>
                <div class="mission__text">
                    <p>
                        {{$thirdSectionData->description}}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <feedback-component></feedback-component>
@endsection

@push('scripts')
    @vite(['resources/js/frontend/about.js'])
@endpush
