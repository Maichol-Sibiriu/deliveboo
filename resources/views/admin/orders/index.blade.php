<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Lista Ordini</h1>

    <ul>
        @foreach ($orders as $order)

           <li>
               <a href="{{ route('admin.orders.show', $order->id) }}">{{ $order->price_tot }} {{ $order->phone }} {{ $order->address }}</a>
            </li>
            
        @endforeach
    </ul>
</body>
</html>