@extends('layouts.main')

@section('content')

@if ($error) 

<p class="alert alert-danger">L'ordine non è andato a buon fine, controllare il metodo di pagamento!</p>
    
@endif

<div id="cart">
  <input value="{{ $restaurant->id}}" type="hidden" id="restaurantId">
  <h1>{{ $restaurant->name }}<small>{{ $restaurant->address }}</small></h1>
  <h4>{{ $restaurant->phone }}</h4>
  <h5>{{ $restaurant->vat_num }}</h5>
  {{-- <h1>{{ $restaurant->image_logo }}</h1> DA INSERIRE!!!!!!!!!!!!!! --}}

  {{-- Lista piatti --}}
  <ul class="flex">
    <li v-if="dish.available" v-for="(dish, index) in dishes">
      <a class="btn btn-primary" v-on:click="activeModal(index)">@{{dish.name}}</a>
    </li>
  </ul>

  {{-- Modale --}}
  <div class="modal-box" v-show="displayModal">
    <p>Aggiungi @{{ order[dishIndex].name }}</p>
    <label for="quantity">Quantità</label>
    <input id="quantity" type="number" min="0" v-model="numDish">
    <a  class="btn btn-primary" v-on:click="addDish()">Aggiungi piatto</a>
  </div>

  {{-- Carrello ordine --}}
  <div class="cart" v-if="total > 0">
    <ul>
      <li v-for="(product, index) in order" v-if="product.quantity > 0">
        <p>@{{ product.name }} - @{{ product.quantity }}pz.</p>
        <a class="btn btn-primary" v-on:click="setQuantity(false, index)">- </a>
        <a class="btn btn-primary" v-on:click="setQuantity(true, index)"> +</a>
        <a class="btn btn-primary" v-on:click="deleteDish(index)">Elimina piatto</a>
      </li>
    </ul>
    <div class="total">
      <h2>Totale: @{{ total }} €</h2>
      <a class="btn btn-primary" v-on:click="deleteCart">Pulisci carrello</a>
    </div>

    {{-- <button v-on:click="checkout()">Checkout</button> --}}
  </div>
</div>


{{-- pagamento braintree --}}
<div class="braintree-dropin">
  <form id="payment-form" class="form-group" action="{{ route('pay') }}" method="POST">
    @csrf
    @method('POST')
    <input type="hidden" name="amount" id="amount">
    <input type="hidden" id="nonce" name="payment_method_nonce"/>
    <input type="hidden" name="slug" value="{{ $restaurant->slug }}" />
    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}" />
    <label for="phone">Numero di Telefono</label>
    <input type="text" name="phone" value="{{ old('phone') }}" id="phone" />
    <label for="phone">Indirizzo di Consegna</label>
    <input type="text" name="address" value="{{ old('address') }}" id="address" />
    <div id="dropin-container"></div>
    
    <input type="submit" />
  </form>

  <script type="text/javascript">
    const form = document.getElementById('payment-form');
    const clientToken = '@php echo($clientToken) @endphp';

    braintree.dropin.create({
      authorization: clientToken,
      container: document.getElementById('dropin-container'),
    }, (error, dropinInstance) => {

      if (error) console.error(error);

      form.addEventListener('submit', event => {
          event.preventDefault();

          dropinInstance.requestPaymentMethod((error, payload) => {
          if (error) {
              console.error(error);
          }
          document.getElementById('nonce').value = payload.nonce;

          form.submit();
          });
      });
    });
  </script>
</div>


<script defer src="{{asset('js/cart.js')}}" charset="utf-8"></script>

@endsection
