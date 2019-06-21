<!doctype html>
<html lang="en" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Admin panel</title>
</head>
<body>
    <header id="header_main">
        @include('parts/header/top-line')
    </header>
    <div id="admin"></div>
    @include('parts/footer')
    <script src="/js/admin.js" charset="utf-8"></script>
</body>
</html>
