<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="https://js.braintreegateway.com/web/dropin/1.26.0/js/dropin.min.js"></script>
        <title>Deliveboo</title>
        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Oswald:wght@400;700&family=Roboto:wght@700;900&display=swap" rel="stylesheet">
        {{-- Styles --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div id="app">
            @include('partials.header')

            @yield('content')

            @include('partials.footer')
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
