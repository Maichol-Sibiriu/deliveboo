@extends('layouts.app')

@section('content')
<h1>{{ $order->price_tot }}</h1>
<h1>{{ $order->address }}</h1>
<h1>{{ $order->phone }}</h1>

<h2>Scontrino</h2>
@foreach ($dishes as $dish)
    <h3>{{$dish->name}}</h3>
    <h3>{{$dish->price}}</h3>
    <hr>
@endforeach
@endsection