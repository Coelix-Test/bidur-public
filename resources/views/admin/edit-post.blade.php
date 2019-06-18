<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        @include('parts/head')
    </head>
    <body>
        <textarea name="name" rows="8" cols="80">Write content here!</textarea>
        <!-- Scripts -->
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>
    </body>
</html>
