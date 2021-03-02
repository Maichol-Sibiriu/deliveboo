@extends('layouts.app')

@section('content')

  <main>
      <section class="advanced-search d-flex">
        <!-- Sidebar -->
        <div class="sidebar-client">
          <div class="sidebar-heading mb-5">Trova il ristorante giusto per te</div>
          <div class="list-group list-group-flush">
            <input type="text" name="name" placeholder="cerca per nome" v-model="name" v-on:keyup="filterRestaurant" class="mb-5">
            <div class="category-box text-center">
              <h3>Categorie</h3>
              <div class="grey-box">
                <ul class="text-left">
                    @foreach ($categories as $category)
                        <li>
                          <input type="checkbox" id="{{ $category->name }}" value="{{ $category->name }}" v-model="categories"
                          v-on:change="filterRestaurant">
                          <label for="{{ $category->name }}">{{ $category->name }}</label>
                        </li>
                    @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- /#sidebar-wrapper -->
    
        <!-- Page Content -->
        <div class="page-content d-flex">
          <ul>
            <li v-for="restaurant in allRestaurants" class="text-center">
              <a :href="routing(restaurant.slug)">
                <img :src="restaurant.image_logo" :alt="restaurant.name">
                <h3>@{{restaurant.name}}</h3>

              </a>
            </li>
          </ul>
        </div>
      </section>
  </main>

@endsection
<script src="{{ asset('js/filter_restaurant.js') }}" defer></script>
