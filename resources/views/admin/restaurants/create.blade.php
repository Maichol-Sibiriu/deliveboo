@extends('layouts.app')
@section('content')
<h1>Crea nuovo ristorante</h1>
    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{$error}}
            </li>
        @endforeach
    </ul>
    <hr>
    @endif
    <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("POST")

        <div>
            <label for="name">Nome Ristorante</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
        </div>
        <div>
            <label for="address">Indirizzo</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}">
        </div>
        <div>
            <label for="vat_num">Partita IVA</label>
            <input type="text" name="vat_num" id="vat_num" value="{{ old('vat_num') }}">
        </div>
        <div>
            <label for="phone">Numero di Telefono</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}">
        </div>
        <div>
            <label for="img_logo">Logo Ristorante</label>
            <input type="file" name="image_logo" id="img_logo" accept="image/*">
        </div>
        <div>
            @foreach ($categories as $category)
            <input type="checkbox" name="categories[]" id="{{ $category->name }}" value = "{{ $category->id }}"><label for="{{ $category->name }}">{{ $category->name }}</label><br>            
            @endforeach
        </div>

        <input type="submit" value="Crea Ristorante">
    </form>
@endsection