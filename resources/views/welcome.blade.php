<!doctype html>
<html lang="en" dir="rtl">
<head>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131925839-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-131925839-1');
  </script>

  {{-- ADSENSE BOTTOM AD --}}
  {{-- <script>
    (adsbygoogle = window.adsbygoogle || []).push({
      google_ad_client: "ca-pub-6511052822397382",
      enable_page_level_ads: true,
      overlays: { bottom: true }
    });
  </script> --}}

  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/home.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="./img/favicon.png" type="image/png">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>IsraelBidur</title>

  <!-- <script type="text/javascript" async="async" src="//widgets.outbrain.com/outbrain.js"></script> -->
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

    <div id="ads">
      <div id="ads-rest" class="a-row-center">3</div>
      <div id="ads-wrapper">
        <!-- Between pages -->
        {{-- <div style="width: 100%; height: 100%; background: #000;">

        </div> --}}
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins
          class="adsbygoogle"
          style="display:block; width: 100%; height: 100%;"
          data-ad-client="ca-pub-6511052822397382"
          data-ad-slot="9249316864"
          data-ad-format="auto"
          data-full-width-responsive="true"
        ></ins>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
      </div>
    </div>

    <script src="/js/home.js" charset="utf-8"></script>
</body>
</html>
