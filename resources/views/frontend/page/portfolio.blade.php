@extends('layouts.main')

@push('styles')
    @vite(['resources/sass/frontend/portfolio.scss'])
@endpush

@section('content')
    <div class="tabs">
        <div class="container">
            <div class="tabs__row">
                <ul class="tabs__list">
                    <li class="tabs__item">
                        @if($category->id === 1)
                            Все объекты
                        @else
                            <a href="{{route('portfolio')}}">
                                Все объекты
                            </a>
                        @endif
                    </li>
                    @foreach($categories as $cat)
                        @if($cat['id'] === 1)
                            @continue
                        @else
                            @if($category->id === $cat['id'])
                                <li class="tabs__item active">
                                    {{$cat['title']}}
                                </li>
                            @else
                                <li class="tabs__item">
                                    <a href="{{$cat['slug']}}">
                                        {{$cat['title']}}
                                    </a>
                                </li>
                            @endif
                        @endif

                    @endforeach
                </ul>
            </div>
        </div>
    </div>
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
