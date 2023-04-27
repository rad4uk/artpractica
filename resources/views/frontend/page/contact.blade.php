@extends('layouts.main')

@push('styles')
    @vite(['resources/sass/frontend/contact.scss'])
@endpush

@section('content')
    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="contact__column">
                    <div class="contact__content">
                        <p class="contact__content-title">адрес</p>
                        <p class="contact__content-text">
                            <span>394036, Россия, Воронеж</span>
                            <span>Орджоникидзе, 14/16</span>
                            <a href="tel:+79202134222">Тел.: + 7 (920) 213-42-22</a>
                        </p>
                    </div>
                    <div class="contact__form">
                        <p class="contact__form-title">мы на связи</p>
                        <form-component></form-component>
                    </div>
                </div>
                <div class="contact__column">
                    <div class="contact__maps">
                        <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A3459b1b7b46903187516b6b3be21f2904ac947485c2b2199baf3e3e8f33f37a9&amp;source=constructor" width="1160" height="385" frameborder="0"></iframe>                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/frontend/contact.js'])
@endpush
