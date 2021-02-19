<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

  <div id="cart">
    <input value="{{ $restaurant->id}}"  type="hidden" id="restaurantId">
    <h1>{{ $restaurant->name }}</h1>
    <h1>{{ $restaurant->address }}</h1>
    <h1>{{ $restaurant->phone }}</h1>
    <h1>{{ $restaurant->vat_num }}</h1>
    <h1>{{ $restaurant->image_logo }}</h1>

    {{-- Lista piatti --}}
    <ul>
      <li v-if="dish.available" v-for="(dish, index) in dishes">
        <a v-on:click="activeModal(index)" href="#">@{{dish.name}}</a>
      </li>
    </ul>
    
    {{-- Modale --}}
    <div class="modal" v-show="displayModal">
      <p>Aggiungi @{{ order[dishIndex].name }}</p>
      <label for="quantity">Quantità</label>
      <input id="quantity" type="number" min="0" v-model="numDish">
      <button v-on:click="addDish()">Aggiungi piatto</button>
    </div>

    {{-- Carrello ordine --}}
    <div class="cart" v-if="total > 0">
      <ul>
        <li v-for="(product, index) in order" v-if="product.quantity > 0">
          <p>@{{ product.name }} - @{{ product.quantity }}</p>
          <a v-on:click="setQuantity(false, index)">- </a>
          <a v-on:click="setQuantity(true, index)"> +</a>
          <a v-on:click="deleteDish(index)">Elimina piatto</a>
        </li>
      </ul>
      <div class="total">
        <h2>Totale: @{{ total }} €</h2>
        <a v-on:click="deleteCart">Pulisci carrello</a>
      </div>

      <button>Checkout</button>
    </div>

  </div>

  <script defer src="{{asset('js/cart.js')}}" charset="utf-8"></script>



</body>
</html>
