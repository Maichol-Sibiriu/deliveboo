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


    <ul>
      <li v-if="dish.available" v-for="dish in dishes">
        <a v-on:click="addDish(dish.name)" href="#">@{{dish.name}}</a>
      </li>
    </ul>

    <div class="cart">

    </div>

  </div>

  <script defer src="{{asset('js/cart.js')}}" charset="utf-8"></script>



</body>
</html>
