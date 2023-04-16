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
                            <a href="#">Тел.: + 7 (920) 213-42-22</a>
                        </p>
                    </div>
                    <div class="contact__form">
                        <p class="contact__form-title">мы на связи</p>
                        <form action="" id="form">
                            <div class="feedback__form-item">
                                <input type="text" name="name" placeholder="имя" id="feedback__form-id">
                            </div>

                            <div class="feedback__form-item">
                                <input type="text" placeholder="телефон" id="feedback__form-phone">
                            </div>
                            <button type="submit" class="buttonShadow">ОБРАТНЫЙ ЗВОНОК</button>
                        </form>
                    </div>
                </div>
                <div class="contact__column">
                    <div class="contact__maps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9899.441200643383!2d39.2084885!3d51.6623941!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x27c401840ff086aa!2sArt%20Practica!5e0!3m2!1sru!2sru!4v1646231450129!5m2!1sru!2sru" width="600" height="450" style="border: 0px; pointer-events: none;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/frontend/contact.js'])
@endpush
