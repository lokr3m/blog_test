<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @unless(app()->environment('testing'))
        @vite('resources/css/app.css')
    @endunless
</head>

<body>
    @include('partials.nav')
    <div class="container mx-auto mt-2">
        @yield('content')
    </div>
</body>
</html>
