@extends('layouts.app')

@section('content')
<main class="order-index container">

  <h2 class="mb-5">Lista Ordini</h2>

  <div class="" id="ora">

  </div>

  <!-- tabella lista ordini -->
  <table class="table">
    <thead>
      <tr>
        <th class="id">N.ID</th>
        <th class="day">Data ordine</th>
        <th class="time">Orario ordine</th>
        <th class="amount text-center">Prezzo Totale Ordine</th>
        <th></th>
      </tr>
    </thead>

    <!-- Ciclo + compilazione tabella -->
    @forelse ($orders as $order)
    <tbody>
      <tr>
        <td class="id-main"> {{  $order->id }} </td>
        <td class="day-main">  {{  $order->created_at->isoFormat('dddd DD/MM/YYYY') }}  </td>
        <td class="time-main">  {{  $order->created_at->isoFormat('HH:mm')}}  </td>
        <td class="amount-main text-center">  {{  $order->amount}} € </td>
        <td class="text-center" width="100">
          <a href="{{ route('admin.orders.show', $order->id) }}" class="btn">Dettaglio</a>
        </td>
      </tr>
    </tbody>

    <!-- mostra bottone statistiche all ultimo ciclo -->
    @if ($loop->last)
    <a href="{{ route('admin.stats.show', $orders[0]->restaurant_id) }}"class="btn mb-5">Visualizza Statistiche</a>
    @endif

    <!-- avviso in caso di tabella vuota -->
    @empty
    <div class="alert alert-danger">
      <p>Non hai ricevuto ordini.</p>
    </div>
    @endforelse

  </table>

  <div class="pagination">
    {{ $orders->links()}}
  </div>

  <!-- bottone indietro -->
    <a href="{{route('admin.home')}}"class="btn mt-4">Indietro</a>



</main>


@endsection
