@extends('layouts.main')

@section('content')
    <h1>io sono tutti i ristoranti</h1>

    <div>
        <input type="text" name="name" placeholder="cerca per nome" v-model="name">
        <ul>
            @foreach ($categories as $category)
            
                <li>
                    <label for="{{ $category->name }}">{{ $category->name }}</label>
                    <input type="checkbox" id="{{ $category->name }}" value="{{ $category->name }}" v-model="categories">
                </li>
                
            @endforeach
        </ul>
    </div>

@endsection
<script src="{{ asset('js/filter_restaurant.js') }}" defer></script>