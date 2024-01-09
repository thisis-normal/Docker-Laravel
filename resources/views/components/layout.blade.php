<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('app.css')}}" type="text/css" rel="stylesheet">
    <title>My Layout</title>
</head>
<body>
{{$title}}
{{ $content }}
{{--{{ $slot }}--}}
<p>My Layout</p>
</body>
</html>
