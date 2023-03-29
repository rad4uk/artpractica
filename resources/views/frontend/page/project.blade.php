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
                    <li class="tabs__list-item active">Все объекты</li>
                    <li class="tabs__list-item">Квартиры</li>
                    <li class="tabs__list-item">Коттеджи</li>
                    <li class="tabs__list-item">Коммерческие объекты</li>
                    <li class="tabs__list-item">Ландшафты и террасы</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="project-preview">
        <div class="container">
            <div class="row">
                <h1 class="project-preview__title">PROJECT 715</h1>
                <div class="project-preview__container">
                    <img src="{{asset('images/project/img_28.png')}}" alt="" class="project-preview__container-img">
                </div>
            </div>
            <div class="row">
                <div class="project-preview__arrow">
                    <div class="project-preview__arrow-text">Было / Стало</div>
                    <div class="project-preview__arrow-prev">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.701096 7.29289C0.310572 7.68342 0.310572 8.31658 0.701096 8.70711L7.06506 15.0711C7.45558 15.4616 8.08875 15.4616 8.47927 15.0711C8.86979 14.6805 8.86979 14.0474 8.47927 13.6569L2.82242 8L8.47927 2.34315C8.86979 1.95262 8.86979 1.31946 8.47927 0.928933C8.08875 0.538409 7.45558 0.538409 7.06506 0.928933L0.701096 7.29289ZM2.4082 7H1.4082V9H2.4082V7Z" fill="white"/>
                        </svg>
                    </div>
                    <div class="project-preview__arrow-next">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.70711 7.29289C9.09763 7.68342 9.09763 8.31658 8.70711 8.70711L2.34315 15.0711C1.95262 15.4616 1.31946 15.4616 0.928933 15.0711C0.538409 14.6805 0.538409 14.0474 0.928933 13.6569L6.58579 8L0.928933 2.34315C0.538409 1.95262 0.538409 1.31946 0.928933 0.928933C1.31946 0.538409 1.95262 0.538409 2.34315 0.928933L8.70711 7.29289ZM7 7H8V9H7V7Z" fill="white"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="project-preview__container project-scheme">
                    <img src="{{asset('images/project/img_29.png')}}" alt="" class="project-preview__container-img">
                </div>
                <p class="project-preview__text">
                    Работая с частными и коммерческими клиентами на территории России и других стран - наши специалисты сформировали дружную команду. Благодаря навыкам и мастерству мы способны успешно преобразует пространство вокруг нас, создавая динамичные и вдохновленные интерьеры для жизни. Работая с частными и коммерческими клиентами на территории России и других стран - наши специалисты сформировали дружную команду . Благодаря навыкам и мастерству мы способны успешно преобразует пространство вокруг нас, создавая динамичные и вдохновленные интерьеры для жизни.
                </p>
            </div>
        </div>
    </div>
    <div class="project-wrapper">
        <div class="project-widget1">
            <div class="container">
                <h3 class="project-widget1-title">ГОСТИННАЯ</h3>
                <div class="row">
                    <div class="project-widget1__container">
                        <img src="{{asset('images/project/img_30.png')}}" alt="" class="project-widget1__container-img">
                    </div>
                </div>
            </div>
        </div>

        <div class="project-widget2">
            <div class="container">
                <div class="row">
                    <div class="project-widget2__container">
                        <div class="project-widget2-item">
                            <img src="{{asset('images/project/img_31.png')}}" alt="" class="project-widget2__container-img">
                        </div>
                        <div class="project-widget2-item">
                            <img src="{{asset('images/project/img_32.png')}}" alt="" class="project-widget2__container-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="project-widget1">
            <div class="container">
                <div class="row">
                    <div class="project-widget1__container">
                        <img src="{{asset('images/project/img_33.png')}}" alt="" class="project-widget1__container-img">
                    </div>
                    <p class="project-widget1-text">Работая с частными и коммерческими клиентами на территории России и других стран - наши специалисты сформировали дружную команду. Благодаря навыкам и мастерству мы способны успешно преобразует пространство вокруг нас, создавая динамичные и вдохновленные интерьеры для жизни. Работая с частными и коммерческими клиентами на территории России и других стран - наши специалисты сформировали дружную команду . Благодаря навыкам и мастерству мы способны успешно преобразует пространство вокруг нас, создавая динамичные и вдохновленные интерьеры для жизни.</p>
                </div>
            </div>
        </div>

        <div class="project-widget3">
            <div class="container">
                <div class="row">
                    <div class="project-widget3-container">
                        <div class="project-widget3__column">
                            <img src="{{asset('images/project/img_34.png')}}" alt="" class="project-widget3__column-image">
                        </div>
                        <div class="project-widget3__column">
                            <img src="{{asset('images/project/img_35.png')}}" alt="" class="project-widget3__column-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="project-widget1">
            <div class="container">
                <div class="row">
                    <div class="project-widget1__container">
                        <img src="{{asset('images/project/img_36.png')}}" alt="" class="project-widget1__container-img">
                    </div>
                </div>
            </div>
        </div>

        <div class="project-widget4">
            <div class="container">
                <div class="row">
                    <h3 class="project-widget4-title">СПАЛЬНЯ</h3>
                </div>
            </div>
        </div>

        <div class="project-widget1">
            <div class="container">
                <div class="row">
                    <div class="project-widget1__container">
                        <img src="{{asset('images/project/img_37.png')}}" alt="" class="project-widget1__container-img">
                    </div>
                    <p class="project-widget1-text">
                        Работая с частными и коммерческими клиентами на территории России и других стран - наши специалисты сформировали дружную команду. Благодаря навыкам и мастерству мы способны успешно преобразует пространство вокруг нас, создавая динамичные и вдохновленные интерьеры для жизни. Работая с частными и коммерческими клиентами на территории России и других стран - наши специалисты сформировали дружную команду . Благодаря навыкам и мастерству мы способны успешно преобразует пространство вокруг нас, создавая динамичные и вдохновленные интерьеры для жизни.
                    </p>
                </div>
            </div>
        </div>

        <div class="project-widget1">
            <div class="container">
                <div class="row">
                    <div class="project-widget1__container">
                        <img src="{{asset('images/project/img_38.png')}}" alt="" class="project-widget1__container-img">
                    </div>
                </div>
            </div>
        </div>

        <div class="project-widget3">
            <div class="container">
                <div class="row">
                    <div class="project-widget3-container">
                        <div class="project-widget3__column">
                            <img src="{{asset('images/project/img_39.png')}}" alt="" class="project-widget3__column-image">
                        </div>
                        <div class="project-widget3__column">
                            <img src="{{asset('images/project/img_40.png')}}" alt="" class="project-widget3__column-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="project-widget4">
            <div class="container">
                <div class="row">
                    <h3 class="project-widget4-title">ДЕТСКАЯ</h3>
                </div>
            </div>
        </div>

        <div class="project-widget3">
            <div class="container">
                <div class="row">
                    <div class="project-widget3-container">
                        <div class="project-widget3__column">
                            <img src="{{asset('images/project/img_41.png')}}" alt="" class="project-widget3__column-image">
                        </div>
                        <div class="project-widget3__column">
                            <img src="{{asset('images/project/img_42.png')}}" alt="" class="project-widget3__column-image">
                        </div>
                    </div>
                    <p class="project-widget3-text">
                        Работая с частными и коммерческими клиентами на территории России и других стран - наши специалисты сформировали дружную команду. Благодаря навыкам и мастерству мы способны успешно преобразует пространство вокруг нас, создавая динамичные и вдохновленные интерьеры для жизни. Работая с частными и коммерческими клиентами на территории России и других стран - наши специалисты сформировали дружную команду . Благодаря навыкам и мастерству мы способны успешно преобразует пространство вокруг нас, создавая динамичные и вдохновленные интерьеры для жизни.
                    </p>
                </div>
            </div>
        </div>

        <div class="project-widget3">
            <div class="container">
                <div class="row">
                    <div class="project-widget3-container">
                        <div class="project-widget3__column">
                            <img src="{{asset('images/project/img_43.png')}}" alt="" class="project-widget3__column-image">
                        </div>
                        <div class="project-widget3__column">
                            <img src="{{asset('images/project/img_44.png')}}" alt="" class="project-widget3__column-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="project-widget4">
            <div class="container">
                <div class="row">
                    <h3 class="project-widget4-title">ВАННАЯ</h3>
                </div>
            </div>
        </div>

        <div class="project-widget3">
            <div class="container">
                <div class="row">
                    <div class="project-widget3-container">
                        <div class="project-widget3__column">
                            <img src="{{asset('images/project/img_45.png')}}" alt="" class="project-widget3__column-image">
                        </div>
                        <div class="project-widget3__column">
                            <img src="{{asset('images/project/img_46.png')}}" alt="" class="project-widget3__column-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="project">
        <div class="container">
            <h4 class="project-title">
                ДРУГИЕ ПРОЕКТЫ
            </h4>

            <div class="project__row">
                <project-item-component :item='@json(['id' => 10, 'title' => 'PROJECT 866', 'preview_image' => asset('images/project/img_47.png')])'></project-item-component>
                <project-item-component :item='@json(['id' => 11, 'title' => 'PROJECT 928', 'preview_image' => asset('images/project/img_48.png')])'></project-item-component>

            </div>
        </div>
    </div>

    @include('frontend.partials.feedback')
@endsection

@push('scripts')
    @vite(['resources/js/frontend/project.js'])
@endpush
