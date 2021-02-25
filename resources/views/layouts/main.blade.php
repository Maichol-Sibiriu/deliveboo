<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="https://js.braintreegateway.com/web/dropin/1.26.0/js/dropin.min.js"></script>
        <title>Deliveboo</title>
    </head>
    <body>
        <div id="app">
            @include('partials.header')

            <main>
                @yield('content')
            </main>

            @include('partials.footer')
        </div>
 
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
