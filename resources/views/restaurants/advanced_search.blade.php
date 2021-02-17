@extends('layouts.main')

@section('content')
    <h1>io sono tutti i ristoranti</h1>

    <div>
        <input type="text" name="name" placeholder="cerca per nome" v-model="name" v-on:keyup="filterRestaurant">
        <ul>
            @foreach ($categories as $category)

                <li>
                    <label for="{{ $category->name }}">{{ $category->name }}</label>
                    <input type="checkbox" id="{{ $category->name }}" value="{{ $category->name }}" v-model="categories"
                    v-on:change="filterRestaurant">
                </li>

            @endforeach
        </ul>

        <ul>
          <li v-for="restaurant in allRestaurants">
            <a :href="routing(restaurant.slug)">
              <img :src="restaurant.image_logo" :alt="restaurant.name">
              <h3>@{{restaurant.name}}</h3>
            </a>
          </li>
        </ul>


    </div>

@endsection
<script src="{{ asset('js/filter_restaurant.js') }}" defer></script>
