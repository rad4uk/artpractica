<footer class="footer">
    <div class="container">
        <div class="footer__row">
            <div class="footer__column">
                <ul class="footer__list">
                    <li class="footer__list-item">
                        @if(Route::currentRouteName() === 'home')
                            Главная
                        @else
                            <a href="{{route('home')}}" class="footer__list-item-link">Главная</a>
                        @endif
                    </li>
                    <li class="footer__list-item">
                        @if(Route::currentRouteName() === 'portfolio')
                            Портфолио
                        @else
                            <a href="{{route('portfolio')}}" class="footer__list-item-link">Портфолио</a>
                        @endif
                    </li>
                    <li class="footer__list-item">
                        @if(Route::currentRouteName() === 'services')
                            Услуги
                        @else
                            <a href="{{route('services')}}" class="footer__list-item-link">Услуги</a>
                        @endif
                    </li>
                    <li class="footer__list-item">
                        @if(Route::currentRouteName() === 'about')
                            О нас
                        @else
                            <a href="{{route('about')}}" class="footer__list-item-link">О нас</a>
                        @endif
                    </li>
                </ul>
            </div>

            <div class="footer__column">
                <ul class="footer__list">

                    <li class="footer__list-item">
                        <a href="{{route('categories', 'kvartiry')}}" class="footer__list-item-link">Квартиры</a>
                    </li>
                    <li class="footer__list-item">
                        <a href="{{route('categories', 'kottedzhi')}}" class="footer__list-item-link">Коттеджи</a>
                    </li>
                    <li class="footer__list-item">
                        <a href="{{route('categories', 'kommercheskie-obekty')}}" class="footer__list-item-link">Коммерческие объекты</a>
                    </li>
                    <li class="footer__list-item">
                        <a href="{{route('categories', 'landshafty-i-terrasy')}}" class="footer__list-item-link">Ландшафты и террасы</a>
                    </li>
                </ul>
            </div>
            <div class="footer__column">
                <ul class="footer__list">
                    <li class="footer__list-item">
                        <a href="{{route('contact')}}" class="footer__list-item-link">Контакты</a>
                    </li>
                    <li class="footer__list-item">
                        <a href="tel:89202134222" class="footer__list-item-link">8 920 213 4222</a>
                    </li>
                    <li class="footer__list-item">
                        <a href="https://apfurniture.ru" class="footer__list-item-link underline" target="_blank">Ателье авторской мебели</a>
                    </li>
                    <li class="footer__list-item">
                        <a href="https://vk.com/art_practica_36" target="_blank" class="footer__icon-vk"></a>
                        <a href="mailto: artpractica@mail.ru" class="footer__icon-mail"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer__bottom">
            <a href="#" class="footer__bottom-policy" target="_blank">Политика конфиденциальности</a>
            <a href="https://t.me/kseniya_but" class="footer__bottom-developer" target="_blank">Сайт разработан</a>
        </div>
    </div>
</footer>
