<!doctype html>
<html lang="en" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
  <link href="{{ asset('css/home.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="./img/favicon.png" type="image/png">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>IsraelBidur</title>

  <script type="text/javascript" async="async" src="//widgets.outbrain.com/outbrain.js"></script>
</head>
<body>
    <div id="home"></div>
    @include('parts/footer')

    <div id="preloader">
      <div>
        <img src="img/logo-yellow.png">
      </div>
      <div>
        <div class="blue ball"></div>
        <div class="red ball"></div>
        <div class="yellow ball"></div>
        <div class="green ball"></div>
      </div>
    </div>
    
    <script src="/js/home.js" charset="utf-8"></script>
</body>
</html>
