<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{ $order->price_tot }}</h1>
    <h1>{{ $order->address }}</h1>
    <h1>{{ $order->phone }}</h1>

    <h2>Scontrino</h2>
    @foreach ($dishes as $dish)
        <h3>{{$dish->name}}</h3>
        <h3>{{$dish->price}}</h3>
        <hr>
    @endforeach
</body>
</html>