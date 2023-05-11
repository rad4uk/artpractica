@extends('layouts.main')

@push('styles')
    @vite(['resources/sass/frontend/about.scss'])
@endpush

@section('content')
    <div class="aboutsection">
        <div class="container">
            <div class="aboutsection__row">
                <div class="aboutsection__title">
                    <h1>ВОПЛОЩАЕМ ВАШИ МЕЧТЫ В РЕАТЬНОСТЬ</h1>
                </div>
                <div class="aboutsection__content">
                    <div class="aboutsection__column">
                        <p class="aboutsection__column-title">
                            Людмила Балашова
                        </p>

                        <p class="aboutsection__column-subtitle">
                            создатель и руководитель студии
                        </p>
                    </div>
                    <div class="aboutsection__column">

                        <div class="aboutsection__column-text">
                            <p>
                                "Студия дизайна ArtPractica - дело всей моей жизни! Это моё хобби и мой бизнес одновременно. Моя главная мотивация видеть счастливые глаза заказчиков, довольных результатом нашей работы! Именно это помогает двигаться вперед, расширять свои возможности и осваивать новые направления"
                            </p>
                            <p>
                                "ArtPractica сегодня - это надежная и успешная команда профессионалов. Мы идем в ногу со временем и всегда открыты для новых задач в проектировании и реализации вашей мечты"
                            </p>
                        </div>
                    </div>
                    <div class="aboutsection__column">
                        <div class="aboutsection__column-img">
                            <picture>
                                <source srcset="{{asset('images/about/img_2.png')}}" media="(max-width: 520px)"/>
                                <img src="{{asset('images/about/img.png')}}" alt="Людмила Балашова">
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
                    <h3>КОМАНДА ПРОФЕССИОНАЛОВ</h3>
                </div>
                <div class="command__text">
                    <p>
                        Работая с частными и коммерческими клиентами на территории России и других стран - наши специалисты сформировали дружную команду . Благодаря навыкам и мастерству мы способны успешно преобразует пространство вокруг нас, создавая динамичные и вдохновленные интерьеры для жизни.
                    </p>
                </div>
                <div class="command__image">
                    <img src="{{asset('images/about/img_1.png')}}" alt="КОМАНДА ПРОФЕССИОНАЛОВ">
                </div>
            </div>
        </div>
    </div>

    <div class="mission">
        <div class="container">
            <div class="mission__row">
                <div class="mission__title">
                    <h3>
                        НАША МИССИЯ
                    </h3>
                </div>
                <div class="mission__text">
                    <p>
                        Через дизайн мы хотим привнести в мир больше красоты, логики, совершенства.
                        Мы верим, что дизайн должен решать конкретные задачи, а не просто создавать визуально приятную картинку. Дизайн должен быть актуальным, эстетичным и уместным. А еще мы хотим привнести через дизайн самоиронию. Ведь ее так не хватает в современном мире!
                    </p>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.partials.feedback')
@endsection

@push('scripts')
    @vite(['resources/js/frontend/about.js'])
@endpush
