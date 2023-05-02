@extends('layouts.main')

@push('styles')
    @vite(['resources/sass/frontend/project.scss'])
@endpush

@section('content')
    {{--    <div class="houselayout">--}}
    {{--        <div class="container">--}}
    {{--            <div class="houselayout__title">--}}
    {{--                <h1>--}}
    {{--                    PROJECT 715--}}
    {{--                </h1>--}}
    {{--                <div class="houselayout__title-footage">--}}
    {{--                    <p>--}}
    {{--                        102 м2--}}
    {{--                    </p>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="houselayout__row">--}}
    {{--                <div class="houselayout__column">--}}
    {{--                    <p class="houselayout__subtitle">--}}
    {{--                        ПЛАНИРОВКА--}}
    {{--                    </p>--}}
    {{--                    <img src="{{asset('images/project/img_10.png')}}" alt="" class="houselayout__planirovka">--}}
    {{--                </div>--}}
    {{--                <div class="houselayout__column">--}}
    {{--                    <img src="{{asset('images/project/img_15.png')}}" alt="" class="houselayout__image">--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <div class="sectionimage">--}}
    {{--        <div class="container">--}}
    {{--            <div class="sectionimage__row">--}}
    {{--                <div class="sectionimage__block">--}}
    {{--                    <div class="sectionimage__image">--}}
    {{--                        <img src="{{asset('images/project/img.png')}}" alt="">--}}
    {{--                    </div>--}}
    {{--                    <div class="sectionimage__text">--}}
    {{--                        <p>--}}
    {{--                            Заказчики хотели получить что-то там, мы к ним конечно же прислушались и сделали всё как всегда просто потрясающе. Интерьер получился легкий благодаря цветовой гамме и одновременно интересный, за счет применения разных текстур и игры форм--}}
    {{--                        </p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="sectionimage__block">--}}
    {{--                    <div class="sectionimage__item sectionimage__screen">--}}
    {{--                        <img src="{{asset('images/project/img_1.png')}}" alt="">--}}
    {{--                    </div>--}}
    {{--                    <div class="sectionimage__item">--}}
    {{--                        <img src="{{asset('images/project/img_2.png')}}" alt="">--}}
    {{--                    </div>--}}
    {{--                    <div class="sectionimage__item">--}}
    {{--                        <img src="{{asset('images/project/img_3.png')}}" alt="">--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <div class="sticky">--}}
    {{--        <div class="container">--}}
    {{--            <div class="sticky__row">--}}
    {{--                <div class="sticky__column">--}}
    {{--                    <div class="sticky__block">--}}
    {{--                        <img src="{{asset('images/project/img_4.png')}}" alt="" class="sticky__img">--}}
    {{--                    </div>--}}
    {{--                    <div class="sticky__block sticky__block-center">--}}
    {{--                        <div class="sticky__item">--}}
    {{--                            <img src="{{asset('images/project/img_5.png')}}" alt="" class="sticky__img">--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__item">--}}
    {{--                            <img src="{{asset('images/project/img_6.png')}}" alt="" class="sticky__img">--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="sticky__block">--}}
    {{--                        <img src="{{asset('images/project/img_7.png')}}" alt="" class="sticky__img">--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="sticky__column">--}}
    {{--                    <div class="sticky-exec">--}}
    {{--                        <div class="sticky__title">--}}
    {{--                            <h2>ГОСТИННАЯ</h2>--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__text">--}}
    {{--                            <p>В проработанной и точной до миллиметра планировке всего дома есть место для несовершенства. В интерьере эту роль на себя взяли грубые текстуры натуральных материалов: настенных и напольных покрытий, аутентичный декор и текстура штор.</p>--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__buttontext">--}}
    {{--                            <p>ДИВАН: KAKAYATO KRUTAYA ЛЮСТРА: KAKAYATO KRUTAYA--}}
    {{--                                ОСВЕЩЕНИЕ: ERTULI EL COSCO--}}
    {{--                                ПЛИТКА: FERRERO INERUO</p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}

    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <div class="sticky">--}}
    {{--        <div class="container">--}}
    {{--            <div class="sticky__row sticky-reverse">--}}
    {{--                <div class="sticky__column">--}}
    {{--                    <div class="sticky__block">--}}
    {{--                        <img src="{{asset('images/project/img_11.png')}}" alt="" class="sticky__img">--}}
    {{--                    </div>--}}
    {{--                    <div class="sticky__block sticky__block-center">--}}
    {{--                        <div class="sticky__item">--}}
    {{--                            <img src="{{asset('images/project/img_12.png')}}" alt="" class="sticky__img">--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__item">--}}
    {{--                            <img src="{{asset('images/project/img_13.png')}}" alt="" class="sticky__img">--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="sticky__block sticky__block-center">--}}
    {{--                        <div class="sticky__item">--}}
    {{--                            <img src="{{asset('images/project/img_14.png')}}" alt="" class="sticky__img">--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__item">--}}
    {{--                            <img src="{{asset('images/project/img_16.png')}}" alt="" class="sticky__img">--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="sticky__column">--}}
    {{--                    <div class="sticky-exec">--}}
    {{--                        <div class="sticky__title">--}}
    {{--                            <h2>Спальня</h2>--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__text">--}}
    {{--                            <p>В проработанной и точной до миллиметра планировке всего дома есть место для несовершенства. В интерьере эту роль на себя взяли грубые текстуры натуральных материалов: настенных и напольных покрытий, аутентичный декор и текстура штор.</p>--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__buttontext">--}}
    {{--                            <p>ДИВАН: KAKAYATO KRUTAYA ЛЮСТРА: KAKAYATO KRUTAYA--}}
    {{--                                ОСВЕЩЕНИЕ: ERTULI EL COSCO--}}
    {{--                                ПЛИТКА: FERRERO INERUO</p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}

    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <div class="sticky">--}}
    {{--        <div class="container">--}}
    {{--            <div class="sticky__row">--}}
    {{--                <div class="sticky__column">--}}
    {{--                    <div class="sticky__block">--}}
    {{--                        <img src="{{asset('images/project/img_17.png')}}" alt="" class="sticky__img">--}}
    {{--                    </div>--}}
    {{--                    <div class="sticky__block sticky__block-center">--}}
    {{--                        <div class="sticky__item">--}}
    {{--                            <img src="{{asset('images/project/img_18.png')}}" alt="" class="sticky__img">--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__item">--}}
    {{--                            <img src="{{asset('images/project/img_19.png')}}" alt="" class="sticky__img">--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="sticky__block sticky__block-center">--}}
    {{--                        <div class="sticky__item">--}}
    {{--                            <img src="{{asset('images/project/img_20.png')}}" alt="" class="sticky__img">--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__item">--}}
    {{--                            <img src="{{asset('images/project/img_21.png')}}" alt="" class="sticky__img">--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="sticky__block">--}}
    {{--                        <img src="{{asset('images/project/img_22.png')}}" alt="" class="sticky__img">--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="sticky__column">--}}
    {{--                    <div class="sticky-exec">--}}
    {{--                        <div class="sticky__title">--}}
    {{--                            <h2>детская</h2>--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__text">--}}
    {{--                            <p>--}}
    {{--                                В спроектированном нами доме, мы учли важность естественного света во всех комнатах, и поэтому имеет несколько световых композиций на первом этаже.--}}

    {{--                                В спроектированном нами доме, мы учли важность естественного света во всех комнатах, и поэтому имеет несколько световых композиций на первом этаже.--}}
    {{--                            </p>--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__buttontext">--}}
    {{--                            <p>--}}
    {{--                                ДИВАН: KAKAYATO KRUTAYA ЛЮСТРА: KAKAYATO--}}
    {{--                                ОСВЕЩЕНИЕ: ERTULI EL COSCO--}}
    {{--                                ПЛИТКА: FERRERO INERUO--}}
    {{--                                ДИВАН: KAKAYATO KRUTAYA ЛЮСТРА: KAKAYATO KRUTAYA--}}
    {{--                            </p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}

    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <div class="sticky">--}}
    {{--        <div class="container">--}}
    {{--            <div class="sticky__row sticky-reverse">--}}
    {{--                <div class="sticky__column">--}}
    {{--                    <div class="sticky__block">--}}
    {{--                        <img src="{{asset('images/project/img_23.png')}}" alt="" class="sticky__img">--}}
    {{--                    </div>--}}
    {{--                    <div class="sticky__block sticky__block-center">--}}
    {{--                        <div class="sticky__item">--}}
    {{--                            <img src="{{asset('images/project/img_24.png')}}" alt="" class="sticky__img">--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__item">--}}
    {{--                            <img src="{{asset('images/project/img_25.png')}}" alt="" class="sticky__img">--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="sticky__block sticky__block-center">--}}
    {{--                        <div class="sticky__item">--}}
    {{--                            <img src="{{asset('images/project/img_26.png')}}" alt="" class="sticky__img">--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__item">--}}
    {{--                            <img src="{{asset('images/project/img_27.png')}}" alt="" class="sticky__img">--}}
    {{--                        </div>                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="sticky__column">--}}
    {{--                    <div class="sticky-exec">--}}
    {{--                        <div class="sticky__title">--}}
    {{--                            <h2>ванная</h2>--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__text">--}}
    {{--                            <p>--}}
    {{--                                В спроектированном нами доме, мы учли важность естественного света во всех комнатах, и поэтому имеет несколько световых композиций на первом этаже.--}}
    {{--                            </p>--}}
    {{--                        </div>--}}
    {{--                        <div class="sticky__buttontext">--}}
    {{--                            <p>ДИВАН: KAKAYATO KRUTAYA ЛЮСТРА: KAKAYATO--}}
    {{--                                ОСВЕЩЕНИЕ: ERTULI EL COSCO--}}
    {{--                                ПЛИТКА: FERRERO INERUO--}}
    {{--                                ДИВАН: KAKAYATO KRUTAYA ЛЮСТРА: KAKAYATO KRUTAYA</p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}

    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <div class="project">--}}

    {{--        <div class="container">--}}
    {{--            <div class="project__title">--}}
    {{--                <h3>--}}
    {{--                    ДРУГИЕ ПРОЕКТЫ--}}
    {{--                </h3>--}}
    {{--            </div>--}}
    {{--            <div class="project__row">--}}
    {{--                <div class="project__item">--}}
    {{--                    <div class="project__text">--}}
    {{--                        <p class="project__title">PROJECT 866</p>--}}
    {{--                        <p class="project__subtitle">78M2</p>--}}
    {{--                    </div>--}}
    {{--                    <div class="project__image">--}}
    {{--                        <img src="{{asset('images/project/img_8.png')}}" alt="">--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="project__item">--}}
    {{--                    <div class="project__text">--}}
    {{--                        <p class="project__title">PROJECT 928</p>--}}
    {{--                        <p class="project__subtitle">78M2</p>--}}
    {{--                    </div>--}}
    {{--                    <div class="project__image">--}}
    {{--                        <img src="{{asset('images/project/img_9.png')}}" alt="">--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--            </div>--}}

    {{--        </div>--}}
    {{--    </div>--}}
    <div class="tabs">
        <div class="container">
            <div class="row">
                <ul class="tabs__list">
                    <li class="tabs__list-item">
                        <a href="{{route('portfolio')}}">
                            Все объекты
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        @if($cat['id'] === 1)
                            @continue
                        @endif
                        <li class="tabs__list-item">
                            <a href="{{$cat['slug']}}">
                                {{$cat['title']}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

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
