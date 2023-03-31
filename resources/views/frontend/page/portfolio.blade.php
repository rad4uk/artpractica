@extends('layouts.main')

@push('styles')
    @vite(['resources/sass/frontend/portfolio.scss'])
@endpush

@section('content')
    <div class="tabs">
        <div class="container">
            <div class="tabs__row">
                <ul class="tabs__list">
                    <li class="tabs__item active">Все объекты</li>
                    <li class="tabs__item">Квартиры</li>
                    <li class="tabs__item">Коттеджи</li>
                    <li class="tabs__item">Коммерческие объекты</li>
                    <li class="tabs__item">Ландшафты и террасы</li>
                </ul>
            </div>
        </div>
    </div>
{{--    <project-component :posts='@json($posts)'></project-component>--}}

    <div class="project">
        <div class="container">
            <div class="project__row">
{{--                @foreach($posts as $post)--}}
                <project-item-component :item='@json(['slug' => route('project1'), 'title' => 'PROJECT 715', 'preview_image' => asset('images/project/img_28.png')])'></project-item-component>
                <project-item-component :item='@json(['slug' => route('project2'), 'title' => 'PROJECT 716', 'preview_image' => asset('images/project/img_49.png')])'></project-item-component>
                <project-item-component :item='@json(['slug' => route('project3'), 'title' => 'PROJECT 562', 'preview_image' => asset('images/project/img_62.png')])'></project-item-component>
                <project-item-component :item='@json(['slug' => route('project4'), 'title' => 'PROJECT 788', 'preview_image' => asset('images/project/img_70.png')])'></project-item-component>

                <project-item-component :item='@json(['slug' => '#', 'title' => 'PROJECT 866', 'preview_image' => asset('images/portfolio/5.png')])'></project-item-component>
{{--                <project-item-component :item='@json(['id' => 6, 'title' => 'PROJECT 866', 'preview_image' => asset('images/portfolio/6.png')])'></project-item-component>--}}
{{--                <project-item-component :item='@json(['id' => 7, 'title' => 'PROJECT 866', 'preview_image' => asset('images/portfolio/7.png')])'></project-item-component>--}}
{{--                <project-item-component :item='@json(['id' => 8, 'title' => 'PROJECT 866', 'preview_image' => asset('images/portfolio/8.png')])'></project-item-component>--}}
{{--                <project-item-component :item='@json(['id' => 9, 'title' => 'PROJECT 866', 'preview_image' => asset('images/portfolio/9.png')])'></project-item-component>--}}
{{--                <project-item-component :item='@json(['id' => 10, 'title' => 'PROJECT 866', 'preview_image' => asset('images/portfolio/10.png')])'></project-item-component>--}}
{{--                <project-item-component :item='@json(['id' => 11, 'title' => 'PROJECT 866', 'preview_image' => asset('images/portfolio/11.png')])'></project-item-component>--}}

{{--                @endforeach--}}
            </div>

        </div>
    </div>

    <feedback-component></feedback-component>
@endsection

@push('scripts')
    @vite(['resources/js/frontend/portfolio.js'])
@endpush
