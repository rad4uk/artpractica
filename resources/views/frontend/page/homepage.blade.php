@extends('layouts.main', [
    'metaTitle' => $homePage->meta_title ?? '',
    'metaDescription' => $homePage->meta_description ?? '',
    'canonical' => route('home'),
])

@push('styles')
    @vite(['resources/sass/frontend/homepage.scss'])
@endpush

@section('content')
    <section class="content">
        <preview-component></preview-component>

        <div class="about">
            <div class="container">
                <div class="about__title">
                    <h1>
                        {{$firstSectionData->title ?? ''}}
                    </h1>
                </div>
                <div class="about__row">
                    <div class="about__column"></div>
                    <div class="about__column">
                        <div class="about__column-text">
                            <div class="about__column-item">
                                <p class="column-item-tile">
                                    {{$firstSectionData->firstText ?? ''}}
                                </p>
                            </div>
                            <div class="about__column-item">
                                <p class="column-item-tile">
                                    {{$firstSectionData->secondText ?? ''}}
                                </p>
                            </div>
                        </div>
                        <div class="about__column-info">
                            <div class="about__column-item">
                                <p class="about__column-count">{{$firstSectionData->yearQuantity ?? ''}} +</p>
                                <p class="about__column-subtitle">лет работы студии</p>
                            </div>
                            <div class="about__column-item">
                                <p class="about__column-count">{{$firstSectionData->cityQuantity ?? ''}} +</p>
                                <p class="about__column-subtitle">городов</p>
                            </div>
                            <div class="about__column-item">
                                <p class="about__column-count">{{$firstSectionData->projectQuantity ?? ''}} +</p>
                                <p class="about__column-subtitle">реализованных проектов</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(count($additionalCategoriesData) === 4)
        <div class="interiors">
            <div class="container">
                <div class="interiors__title">
                    <h1>УНИКАЛЬНЫЕ ИНТЕРЬЕРЫ ДЛЯ ЖИЗНИ</h1>
                </div>
                <div class="interiors__row">
                    <div class="interiors__item">
                        <div class="interiors__item-content">
                            <div class="interiors__item-title">
                                <p>{{$additionalCategoriesData[0]['title']}}</p>
                            </div>
                            <a href="{{$additionalCategoriesData[0]['slug']}}" class="interiors__item-image">
                                <img lazy v-lazy="{ src: '{{$additionalCategoriesData[0]['image']['default']}}' }" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="interiors__item">
                        <div class="interiors__item-content">
                            <div class="interiors__item-title">
                                <p>{{$additionalCategoriesData[1]['title']}}</p>
                            </div>
                            <a href="{{$additionalCategoriesData[1]['slug']}}" class="interiors__item-image">
                                <picture>
                                    @if(isset($additionalCategoriesData[1]['image']['small']))
                                        <source srcset="{{$additionalCategoriesData[1]['image']['small']}}" media="(max-width: 330px)"/>
                                        <source srcset="{{$additionalCategoriesData[1]['image']['medium']}}" media="(max-width: 520px)"/>
                                        <source srcset="{{$additionalCategoriesData[1]['image']['large']}}" media="(max-width: 768px)"/>
                                    @endif
                                    <source srcset="{{$additionalCategoriesData[1]['image']['default']}}" media="(min-width: 1280px)"/>
                                    <img lazy v-lazy="{ src: '{{$additionalCategoriesData[1]['image']['default']}}' }" alt="">
                                </picture>
                            </a>
                        </div>
                    </div>
                    <div class="interiors__item">
                        <div class="interiors__item-content">
                            <div class="interiors__item-title">
                                <p>{{$additionalCategoriesData[2]['title']}}</p>
                            </div>
                            <a href="{{$additionalCategoriesData[2]['slug']}}" class="interiors__item-image">
                                <picture>
                                    @if(isset($additionalCategoriesData[2]['image']['small']))
                                        <source srcset="{{$additionalCategoriesData[2]['image']['small']}}" media="(max-width: 330px)"/>
                                        <source srcset="{{$additionalCategoriesData[2]['image']['medium']}}" media="(max-width: 520px)"/>
                                        <source srcset="{{$additionalCategoriesData[2]['image']['large']}}" media="(max-width: 768px)"/>
                                    @endif
                                    <source srcset="{{$additionalCategoriesData[2]['image']['default']}}" media="(min-width: 1280px)"/>
                                    <img lazy v-lazy="{ src: '{{$additionalCategoriesData[2]['image']['default']}}' }" alt="">
                                </picture>
                            </a>
                        </div>
                    </div>
                    <div class="interiors__item">
                        <div class="interiors__item-content">
                            <div class="interiors__item-title">
                                <p>{{$additionalCategoriesData[3]['title']}}</p>
                            </div>
                            <a href="{{$additionalCategoriesData[3]['slug']}}" class="interiors__item-image">
                                <picture>
                                    @if(isset($additionalCategoriesData[3]['image']['small']))
                                        <source srcset="{{$additionalCategoriesData[3]['image']['small']}}" media="(max-width: 330px)"/>
                                        <source srcset="{{$additionalCategoriesData[3]['image']['medium']}}" media="(max-width: 520px)"/>
                                        <source srcset="{{$additionalCategoriesData[3]['image']['large']}}" media="(max-width: 768px)"/>
                                    @endif
                                    <source srcset="{{$additionalCategoriesData[3]['image']['default']}}" media="(min-width: 1280px)"/>
                                    <img lazy v-lazy="{ src: '{{$additionalCategoriesData[3]['image']['default']}}' }" alt="">
                                </picture>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(count($additionalServiceData) > 0)

            <services-component
                :services='@json($additionalServiceData)'
            >

            </services-component>
        @endif
        <div class="profit">
            <div class="container">
                <div class="profit__title">
                    <h1>
                        {{$secondSectionData->title ?? ''}}
                    </h1>
                </div>
                <div class="profit__row">
                    <div class="profit__column"></div>
                    <div class="profit__column">
                        @if(isset($secondSectionData->items))
                            @foreach($secondSectionData->items as $item)
                            <div class="profit__item">
                                <div class="profit__subtitle">
                                    <p>{{$item->input}}</p>
                                </div>
                                <div class="profit__text">
                                    <p>
                                        {{$item->textarea}}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <discuss-component :image_path='@json(asset('images/img_10.webp'))'></discuss-component>

        <professional-component
            :sliders_data='@json($slidersData)'
        ></professional-component>

        <feedback-component></feedback-component>
    </section>
@endsection

@push('scripts')
    @vite(['resources/js/frontend/home.js'])
@endpush
