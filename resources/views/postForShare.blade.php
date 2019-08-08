<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<article>
    <h1>{{$post['post']['mainTitle']}}</h1>
    @foreach($post['post']['sections'] as $section)
        @if($section['type'] == 'content')
            <p>{{$section['value']}}</p>
        @elseif($section['type'] == 'image')
            <img src="{{$section['value']}}" alt="{{$section['description']}}">
        @elseif($section['type'] == 'video')
            <iframe src="https://www.youtube.com/embed/{{$section['value']}}"></iframe>
        @endif
    @endforeach
</article>

</body>
</html>
