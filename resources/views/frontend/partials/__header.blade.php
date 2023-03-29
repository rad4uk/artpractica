<header class="header">
    <div class="container">
        <div class="header__row">
            <div class="header__logo">
                <a href="/">
                    <picture>
                        <source srcset="{{asset('images/logo-88-24.png')}}" media="(mmax-width: 768px)">
                        <img src="{{asset('images/logo-172-47.png')}}" alt="">
                    </picture>
                </a>
            </div>
            <nav class="header__nav">
                <ul class="header__nav-list">
                    <li><a href="{{route('portfolio')}}">портфолио</a></li>
                    <li><a href="{{route('services')}}">услуги</a></li>
                    <li><a href="{{route('about')}}">о нас</a></li>
                    <li><a href="{{route('contact')}}">контакты</a></li>
                </ul>
                <div class="header__nav-mobile-nav">
                    <div class="header__nav-mobile-line"></div>
                    <div class="header__nav-mobile-line"></div>
                    <div class="header__nav-mobile-line"></div>
                </div>
            </nav>
        </div>

    </div>
</header>
