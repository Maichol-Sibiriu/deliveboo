@extends('layouts.app')

@section('content')
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
@endsection