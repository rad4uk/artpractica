@extends('layouts.main')

@push('styles')
    @vite(['resources/sass/frontend/homepage.scss'])
@endpush

@section('content')
    <section class="content">
        <preview-component
            :preview_image='@json(asset('images/mainImg.webp'))'
        ></preview-component>
        <div class="about">
            <div class="container">
                <div class="about__title">
                    <h1>
                        CОЗДАЁМ И ВОПЛОЩАЕМ
                    </h1>
                </div>
                <div class="about__row">
                    <div class="about__column"></div>
                    <div class="about__column">
                        <div class="about__column-text">
                            <div class="about__column-item">
                                <p class="column-item-tile">
                                    Разрабатываем дизайн-проекты интерьеров жилых домов, квартир и коммерческих объектов с учетом всех  необходимых технических расчетов.                                </p>
                            </div>
                            <div class="about__column-item">
                                <p class="column-item-tile">
                                    Мы стремимся создавать и воплощать в жизнь эстетический, современный и функциональный дизайн. Команда ArtPractica всегда открыта для новых задач в проектировании и реализации вашей мечты.                                </p>
                            </div>
                        </div>
                        <div class="about__column-info">
                            <div class="about__column-item">
                                <p class="about__column-count">10 +</p>
                                <p class="about__column-subtitle">лет работы студии</p>
                            </div>
                            <div class="about__column-item">
                                <p class="about__column-count">15 +</p>
                                <p class="about__column-subtitle">городов</p>
                            </div>
                            <div class="about__column-item">
                                <p class="about__column-count">490 +</p>
                                <p class="about__column-subtitle">реализованных проектов</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(count($additionalCategoriesData) === 4):
        <div class="interiors">
            <div class="container">
                <div class="interiors__title">
                    <h1>УНИКАЛЬНЫЕ ИНТЕРЬЕРЫ ДЛЯ ЖИЗНИ</h1>
                </div>
                <div class="interiors__row">
                    <div class="interiors__column column-1">
                        <div class="interiors__item">
                            <div class="interiors__item-content">
                                <div class="interiors__item-title">
                                    <p>{{$additionalCategoriesData[0]['title']}}</p>
                                </div>
                                <a href="{{$additionalCategoriesData[0]['slug']}}" class="interiors__item-image">

                                    <img lazy v-lazy="{ src: '{{$additionalCategoriesData[0]['image']}}' }" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="interiors__column column-2">
                        <div class="interiors__column-1">
                            <div class="interiors__item">
                                <div class="interiors__item-content">
                                    <div class="interiors__item-title">
                                        <p>{{$additionalCategoriesData[1]['title']}}</p>
                                    </div>
                                    <a href="{{$additionalCategoriesData[1]['slug']}}" class="interiors__item-image">
                                        <img lazy v-lazy="{ src: '{{$additionalCategoriesData[1]['image']}}' }" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="interiors__column-2">
                            <div class="interiors__item">
                                <div class="interiors__item-content">
                                    <div class="interiors__item-title">
                                        <p>{{$additionalCategoriesData[2]['title']}}</p>
                                    </div>
                                    <a href="{{$additionalCategoriesData[2]['slug']}}" class="interiors__item-image">
                                        <img lazy v-lazy="{ src: '{{$additionalCategoriesData[2]['image']}}' }" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="interiors__item">
                                <div class="interiors__item-content">
                                    <div class="interiors__item-title">
                                        <p>{{$additionalCategoriesData[3]['title']}}</p>
                                    </div>
                                    <a href="{{$additionalCategoriesData[3]['slug']}}" class="interiors__item-image">
                                        <img lazy v-lazy="{ src: '{{$additionalCategoriesData[3]['image']}}' }" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(count($additionalServiceData) > 0)
        <div class="services">
            <div class="container">
                <div class="services__title">
                    <h1>ОКАЗЫВАЕМ ПОЛНЫЙ СПЕКТР УСЛУГ</h1>
                </div>
                <div class="services__row">
                    @foreach($additionalServiceData as $service)
                    <div class="services__item">
                        <div class="services__subtitle">
                            <p>{{$service['title']}}</p>
                        </div>
                        <div class="services__image">
                            <img lazy v-lazy="{ src: '{{$service['image']}}' }" alt="">
                        </div>
                        <div class="services__content">
                            {!! $service['description'] !!}
{{--                            <ul class="services__list">--}}
{{--                                <li class="services__list-item">--}}
{{--                                    15-ти летний опыт работы профессионалов--}}
{{--                                </li>--}}
{{--                                <li class="services__list-item">--}}
{{--                                    Системный подход к созданию проектов--}}
{{--                                </li>--}}
{{--                                <li class="services__list-item">--}}
{{--                                    Воплощение в жизнь заказов любой сложности--}}
{{--                                </li>--}}
{{--                            </ul>--}}
                            <div class="services__more">
                                <a href="{{$service['slug']}}">подробнне</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
{{--                    <div class="services__item">--}}
{{--                        <div class="services__subtitle">--}}
{{--                            <p>КОМПЛЕКТАЦИЯ ИНТЕРЬЕРА</p>--}}
{{--                        </div>--}}
{{--                        <div class="services__image">--}}
{{--                            <img lazy v-lazy="{ src: '{{ asset('images/img_8.png') }}' }" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="services__content">--}}
{{--                            <ul class="services__list">--}}
{{--                                <li class="services__list-item">--}}
{{--                                    Существенная экономия времени заказчика--}}
{{--                                </li>--}}
{{--                                <li class="services__list-item">--}}
{{--                                    Гарантия качества отделочных материалов и мебели--}}
{{--                                </li>--}}
{{--                                <li class="services__list-item">--}}
{{--                                    Возможность тщательного неторопливого выбора--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <div class="services__more">--}}
{{--                                <a href="#">подробнне</a>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="services__item">--}}
{{--                        <div class="services__subtitle">--}}
{{--                            <p>АТЕЛЬЕ АВТОРСКОЙ МЕБЕЛИ</p>--}}
{{--                        </div>--}}
{{--                        <div class="services__image">--}}
{{--                            <img lazy v-lazy="{ src: '{{ asset('images/img_9.png') }}' }" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="services__content">--}}
{{--                            <ul class="services__list">--}}
{{--                                <li class="services__list-item">--}}
{{--                                    Высокотехнологичное производство полного цикла--}}
{{--                                </li>--}}
{{--                                <li class="services__list-item">--}}
{{--                                    Группа профессиональных конструкторов--}}
{{--                                </li>--}}
{{--                                <li class="services__list-item">--}}
{{--                                    Внимание к деталям--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <div class="services__more">--}}
{{--                                <a href="#">подробнне</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
        @endif
        <div class="profit">
            <div class="container">
                <div class="profit__title">
                    <h1>
                        Работая с нами вы получаете
                    </h1>
                </div>
                <div class="profit__row">
                    <div class="profit__column"></div>
                    <div class="profit__column">
                        <div class="profit__item">
                            <div class="profit__subtitle">
                                <p>полный цикл</p>
                            </div>
                            <div class="profit__text">
                                <p>Реализация проекта любой сложности. Полная комплектация объекта качественными материалами и мебелью премиум-качества. </p>
                            </div>
                        </div>
                        <div class="profit__item">
                            <div class="profit__subtitle">
                                <p>Продуманный проект</p>
                            </div>
                            <div class="profit__text">
                                <p>Многолетний опыт позволяет создавать дизайн-проекты, соблюдая баланс пожеланий заказчика и технических требований.</p>
                            </div>
                        </div>
                        <div class="profit__item">
                            <div class="profit__subtitle">
                                <p>ТОЧНАЯ СМЕТА</p>
                            </div>
                            <div class="profit__text">
                                <p>«Прозрачная» оценка стоимости материалов и работ на всех этапах.</p>
                            </div>
                        </div>
                        <div class="profit__item">
                            <div class="profit__subtitle">
                                <p>экономия бюджета</p>
                            </div>
                            <div class="profit__text">
                                <p>Точные технические расчеты исключают ошибки в процессе реализации проекта, экономя время и деньги заказчика.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <discuss-component :image_path='@json(asset('images/img_10.png'))'></discuss-component>

        <professional-component></professional-component>

{{--        <div class="professional">--}}
{{--            <div class="container">--}}
{{--                <div class="professional__title">--}}
{{--                    <h1>ВЫБИРАЙТЕ ПРОФЕССИОНАЛОВ</h1>--}}
{{--                </div>--}}
{{--                <div class="professional__row">--}}
{{--                    <div class="professional__column">--}}
{{--                        <div class="professional__text">--}}
{{--                            <p>Проектирование и реализация крупных коммерческих объектов</p>--}}
{{--                        </div>--}}
{{--                        <div class="professional__image">--}}
{{--                            <img src="{{asset('images/img_11.png')}}" alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="professional__column">--}}
{{--                        <div class="professional__text">--}}
{{--                            <p>Собственное мебельное производство</p>--}}
{{--                        </div>--}}
{{--                        <div class="professional__image">--}}
{{--                            <img src="{{asset('images/img_12.png')}}" alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="professional__column">--}}
{{--                        <div class="professional__text">--}}
{{--                            <p>Профессиональная команда дизайнеров</p>--}}
{{--                        </div>--}}
{{--                        <div class="professional__image">--}}
{{--                            <img src="{{asset('images/img_13.png')}}" alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <feedback-component></feedback-component>
    </section>
@endsection

@push('scripts')
    @vite(['resources/js/frontend/home.js'])
@endpush
