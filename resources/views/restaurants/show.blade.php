@extends('layouts.main')

@section('content')

<main class="rest-show-main">
  {{-- Errore pagamento --}}
  @if ($error) 
  <p class="alert alert-danger">L'ordine non è andato a buon fine, controllare il metodo di pagamento!</p>
  @endif
  
  <div id="cart">
    {{-- info ristorante --}}
    <section class="rest-info-section mt-5 mb-5">
      <div class="rest-logo-wrapper">
        <img src="{{ asset('storage/'.$restaurant->image_logo) }}" alt="">
      </div>
      <div class="info">
        <input value="{{ $restaurant->id}}" type="hidden" id="restaurantId">
        <h1 class="restaurant-name">{{ $restaurant->name }}</h1>
        <small>{{ $restaurant->address }}</small>
        <p>+39 {{ $restaurant->phone }}</p>
        {{-- <p>P.IVA: {{ $restaurant->vat_num }}</p> --}}
      </div>
    </section>
  
    {{-- Lista piatti --}}
    <section id="menu" class="dishes-section mb-5">
      <h2 class="menu-title mb-4">MENU</h2>
      <div class="dish-typology mb-4" v-for="typology in typologies">
        <h2 class="mb-4">@{{ typology }}</h2>
        <a href="#modal-box" class="dish"
          v-if="dish.available && dish.typology == typology"
          v-for="(dish, index) in dishes"
          v-on:click="activeModal(index)">@{{dish.name}}
        </a>
      </div>
    </section>
  
    {{-- Modale --}}
    <div id="modal-box" class="modal-box mb-5" v-show="displayModal">
      <h2>@{{ order[dishIndex].name }}</h2>
      <div class="quantity-wrapper">
        <label for="quantity">Quantità</label>
        <input id="quantity" type="number" min="0" v-model="numDish">
      </div>
      <a href="#menu" class="btn-cart" v-on:click="addDish()">Aggiungi piatto</a>
    </div>
  
    {{-- Carrello ordine --}}
    <div class="cart mb-5" v-if="total > 0">
      <ul>
        <li class="mb-3" v-for="(product, index) in order" v-if="product.quantity > 0">
          <p>@{{ product.name }}</p>
          <a class="btn-cart-quantity" v-on:click="setQuantity(false, index)">- </a>
          <span class="pz-quantity">@{{ product.quantity }}pz.</span>
          <a class="btn-cart-quantity" v-on:click="setQuantity(true, index)"> +</a>
          <a class="btn-cart-remove" v-on:click="deleteDish(index)">Rimuovi</a>
        </li>
      </ul>
      <div class="total">
        <a class="btn-cart-clear" v-on:click="deleteCart">Pulisci carrello</a>
        <span class="total-text">Totale: @{{ total }} €</span>
      </div>
  
      {{-- <button v-on:click="checkout()">Checkout</button> --}}
    </div>
  </div>
  
  
  {{-- pagamento braintree --}}
  <div class="braintree-dropin-wrapper">
    <h2 class="payment-title mb-5">Concludi il tuo ordine</h2>
    <form id="payment-form" class="form-group" action="{{ route('pay') }}" method="POST">
      @csrf
      @method('POST')
      <input type="hidden" name="amount" id="amount">
      <input type="hidden" id="nonce" name="payment_method_nonce"/>
      <input type="hidden" name="slug" value="{{ $restaurant->slug }}" />
      <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}" />
      <label for="phone">Numero di Telefono</label>
      <input type="text" name="phone" value="{{ old('phone') }}" id="phone" />
      <label for="address">Indirizzo di Consegna</label>
      <input type="text" name="address" value="{{ old('address') }}" id="address" />
      <div id="dropin-container"></div>
      
      <input type="submit" class="btn-cart" value="Ordina"/>
    </form>
    
    {{-- script braintree --}}
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
  
</main>


<script defer src="{{asset('js/cart.js')}}" charset="utf-8"></script>

@endsection
