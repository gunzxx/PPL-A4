<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? ucwords($title)." - " : "" }}SoyChain</title>
    <link rel="stylesheet" href="/css/style.css">
    @if(isset($css) && gettype($css)=='array')
        @foreach ($css as $cssitem)
            <link rel="stylesheet" href="css/{{ $cssitem }}.css">
        @endforeach
    @endif
    <script src="js/jquery.min.js"></script>
</head>
<body>
    @yield('content')
    
    @yield('script')
    <script src="/js/jquery.min.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>