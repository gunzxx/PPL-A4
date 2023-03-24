<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? ucwords($title)." - " : "" }}SoyChain</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/desktop.css">
</head>
<body>
    <div class="main-container">
        @yield('container')
    </div>
    
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script> --}}
    <script src="/js/jquery.min.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>