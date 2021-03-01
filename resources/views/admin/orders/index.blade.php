@extends('layouts.app')

@section('content')
<main class="order-index container">

  <h1>Lista Ordini</h1>


  <table class="table">
    <thead>
      <tr>
        <th>Giorno</th>
        <th>Orario</th>
        <th>Prezzo Totale Ordine</th>
        <th></th>
      </tr>
    </thead>

    @forelse ($orders as $order)
    <tbody>
      <tr>
        <td> {{  $order->created_at }} </td>
        <td>  {{  $order->created_at }}  </td>
        <td class="text-center">  {{  $order->amount}} € </td>
        <td class="text-center" width="100">
          <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-success">Show</a>
        </td>
      </tr>

    </tbody>
    @if ($loop->last)
    <a href="{{ route('admin.stats.show', $orders[0]->restaurant_id) }}"class="btn btn-success">Controlla Statistiche</a>
    @endif

    @empty
    <p>Non ci sono ordini</p>
    @endforelse

  </table>

</main>
@endsection
