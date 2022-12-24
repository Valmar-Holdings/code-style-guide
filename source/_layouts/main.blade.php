<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="canonical" href="{{ $page->getUrl() }}">
        <meta name="description" content="{{ $page->description }}">
        <title>{{ $page->title }}</title>
        <link rel="home" href="{{ $page->baseUrl }}">
        <link rel="stylesheet" href="{{ url(mix('css/main.css', 'assets/build')) }}">
        <script defer src="{{ url(mix('js/main.js', 'assets/build')) }}"></script>
    </head>
    <body class="font-sans antialiased text-gray-900">
        @yield('body')
    </body>
</html>
