<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <title>{{$metaTitle ?? 'Студия дизайна Artpractica'}}</title>
    <meta name="description" content="{{$metaDescription ?? ''}}">
    <link rel="canonical" href="{{$canonical ?? ''}}">
    @vite(['resources/js/app.js', 'resources/sass/frontend/app.scss'])
    @stack('styles')
</head>
<body>
    <div class="wrapper" id="app">
        @include('frontend.partials.__header')

        @yield('content')

        @include('frontend.partials.__footer')

    </div>
    @stack('scripts')
</body>
</html>
