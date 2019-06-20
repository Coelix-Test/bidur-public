<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        @include('parts/head')
    </head>
    <body>
        @include('parts/header')

        @include('parts/big-news')

        <div class="container">
            <div class="row">
                <div class="col-3">
                    @include('parts/recent-sidebar')
                </div>
                <div class="col-6">
                    @include('parts/main-news-list')
                </div>
                <div class="col-3">
                    @include('parts/hot-sidebar')
                </div>
            </div>
        </div>

        @include('parts/footer')
        <!-- Scripts -->
        <script src="/js/app.js" type="text/javascript"></script>
    </body>
</html>
