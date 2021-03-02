@extends('layouts.app')

@section('content')
<main class="order-show container">

  <h2 class="mb-5"> Dettaglio Ordine ID. {{ $order->id}} </h2>

  <div class="address mb-3">
    <p> Indirizzo di consegna:
      <i class="fas fa-map-marker-alt"></i>
      <span> {{ $order->address }} </span>
    </p>
  </div>

  <div class="phone mb-5">
    <p> Numero di telefono del destinatario:
      <i class="fas fa-phone"></i>
      <span> {{ $order->phone}} </span>
    </p>
  </div>

  <h2 class="mb-5">Scontrino</h2>

  @foreach ($dishes as $dish)

  <div class="dish-name mb-3 text-center">
    <p>Piatto ordinato:
      <i class="fas fa-utensils"></i>
      <span>{{$dish->name}}</span>
    </p>
  </div>

  <div class="dish-price mb-3 text-center">
    <p>Quantità del piatto ordinato:
      <i class="fas fa-times"></i>
      <!-- <span>{{$dish->price}} </span> -->
    </p>
  </div>

  <div class="dish-price mb-4 text-center">
    <p>Prezzo del piatto ordinato:
      <i class="fas fa-money-check-alt"></i>
      <span>{{$dish->price}} €</span>
    </p>
  </div>
  <hr>
  @endforeach

  <div class="tot text-center mt-5">
    <h2 class="mb-4">Prezzo totale: </h2>
    <i class="fas fa-cash-register">  {{ $order->amount }} €</i>
  </div>

  <a href="{{route('admin.orders.index')}}"class="btn mt-4">Indietro</a>

</main>
  @endsection
