{{--<header class="header">--}}
{{--    <div class="container">--}}
{{--        <div class="header__row">--}}
{{--            <div class="header__logo">--}}
{{--                <a href="/">--}}
{{--                    <picture>--}}
{{--                        <source srcset="{{asset('images/logo-88-24.png')}}" media="(mmax-width: 768px)">--}}
{{--                        <img src="{{asset('images/logo-172-47.png')}}" alt="">--}}
{{--                    </picture>--}}
{{--                </a>--}}
{{--            </div>--}}

{{--            <nav class="header__nav">--}}
{{--                <ul class="header__nav-list">--}}
{{--                    <li><a href="{{route('portfolio')}}" class="{{(Route::currentRouteName() === 'portfolio') ? 'active' : ''}}">портфолио</a></li>--}}
{{--                    <li><a href="{{route('services')}}" class="{{(Route::currentRouteName() === 'services') ? 'active' : ''}}">услуги</a></li>--}}
{{--                    <li><a href="{{route('about')}}" class="{{(Route::currentRouteName() === 'about') ? 'active' : ''}}">о нас</a></li>--}}
{{--                    <li><a href="{{route('contact')}}" class="{{(Route::currentRouteName() === 'contact') ? 'active' : ''}}">контакты</a></li>--}}
{{--                </ul>--}}
{{--                <div class="header__nav-mobile-nav">--}}
{{--                    <div class="header__nav-mobile-line"></div>--}}
{{--                    <div class="header__nav-mobile-line"></div>--}}
{{--                    <div class="header__nav-mobile-line"></div>--}}
{{--                </div>--}}
{{--            </nav>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</header>--}}

<header-component
    :portfolio='@json(['slug' => route('portfolio'), 'class' => Route::currentRouteName() === 'portfolio'])'
    :services='@json(['slug' => route('services'), 'class' => Route::currentRouteName() === 'services'])'
    :about='@json(['slug' => route('about'), 'class' => Route::currentRouteName() === 'about'])'
    :contact='@json(['slug' => route('contact'), 'class' => Route::currentRouteName() === 'contact'])'
    :images='@json([asset('/images/logo-88-24.png'), asset('/images/logo-172-47.png')])'
></header-component>

{{--@push('scripts')--}}
{{--    <script>--}}
{{--        const wrapper = document.querySelector('.wrapper');--}}
{{--        const menu = document.querySelector('.header');--}}
{{--        let isMenuActive = false;--}}

{{--        wrapper.addEventListener('scroll', function() {--}}
{{--            console.log('adsasd')--}}
{{--            const scrollPosition = wrapper.scrollTop;--}}

{{--            if (scrollPosition > 0 && !isMenuActive) {--}}
{{--                // Если прокрутка больше 0 и меню не активно, то активируем его--}}
{{--                isMenuActive = true;--}}
{{--                menu.classList.add('active');--}}
{{--            } else if (scrollPosition === 0 && isMenuActive) {--}}
{{--                // Если прокрутка равна 0 и меню активно, то деактивируем его--}}
{{--                isMenuActive = false;--}}
{{--                menu.classList.remove('active');--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
