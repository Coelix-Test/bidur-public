<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        @include('parts/head')
    </head>
    <body>
        @include('parts/header')

        @include('parts/big-news')

        @include('parts/footer')
        <!-- Scripts -->
        <script src="/js/app.js" type="text/javascript"></script>
    </body>
</html>
