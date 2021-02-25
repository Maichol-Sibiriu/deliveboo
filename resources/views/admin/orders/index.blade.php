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
        @forelse ($orders as $order)
            <li>
                <a href="{{ route('admin.orders.show', $order->id) }}">{{ $order->price_tot }} {{ $order->phone }} {{ $order->address }}</a>
            </li>
            @if ($loop->last)
                <a href="{{ route('admin.stats.show', $orders[0]->restaurant_id) }}">Controlla statistica</a>
            @endif
        @empty
            <p>Non ci sono ordini</p>
        @endforelse
    </ul>
    
</body>
</html>