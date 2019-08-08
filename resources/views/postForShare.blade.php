<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta
    name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
  >
  <meta name="og:url" content="{{ \URL::to('/#/post/' . $id) }}">
  <meta name="og:image" content="@php
    foreach ($post['post']['sections'] as $section) {
      if($section['type'] == 'image') {
        echo $section['value'];
        break;
      }
    }
  @endphp">
  <meta name="og:type" content="article">
  <meta name="og:description" content="">
  <meta name="og:site_name" content="Israel Bidur">
  <meta name="og:title" content="{{ $post['post']['mainTitle'] }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $post['post']['mainTitle'] }}</title>
</head>
<body>
<article>
  <h1>{{ $post['post']['mainTitle'] }}</h1>
  @foreach($post['post']['sections'] as $section)
    @if($section['type'] == 'content')
      <p>{{ $section['value'] }}</p>
    @elseif($section['type'] == 'image')
      <img src="{{ $section['value'] }}" alt="{{ $section['description'] }}">
    @elseif($section['type'] == 'video')
      <iframe src="https://www.youtube.com/embed/{{ $section['value'] }}"></iframe>
    @endif
  @endforeach
</article>

</body>
</html>
