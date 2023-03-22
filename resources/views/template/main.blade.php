<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? ucwords($title)." - " : "" }}SoyBean</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/desktop.css">
</head>
<body>
    <div class="main-container">
        @yield('container')
    </div>
    
</body>
</html>