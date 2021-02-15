<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modifica</title>
</head>
<body>
    <h1>Modifica {{$editRestaurant->name }}</h1>
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
    <form action="{{ route('admin.restaurants.update', $editRestaurant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PATCH")

        <div>
            <label for="name">Nome Ristorante</label>
            <input type="text" name="name" id="name" value="{{ old('name', $editRestaurant->name) }}">
        </div>
        <div>
            <label for="address">Indirizzo</label>
            <input type="text" name="address" id="address" value="{{ old('address', $editRestaurant->address) }}">
        </div>
        <div>
            <label for="vat_num">Partita IVA</label>
            <input type="text" name="vat_num" id="vat_num" value="{{ old('vat_num', $editRestaurant->vat_num) }}">
        </div>
        <div>
            <label for="phone">Numero di Telefono</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $editRestaurant->phone) }}">
        </div>
        <div>
            <label for="image_logo">Logo Ristorante</label>
            @isset($editRestaurant->image_logo)
                <img width="100" src="{{ asset('storage/' . $editRestaurant->image_logo) }}" alt="{{ $editRestaurant->name }}">                
                <h6>Change Old Image:</h6>
            @endisset
            <input type="file" name="image_logo" id="image_logo" accept="image/*">
        </div>
        <div>
            <h3>Lista Tag:</h3>
            @foreach ($categories as $category)
                <div>
                    <input type="checkbox" name="categories[]" id="{{$category->id}}" value="{{$category->id}}"
                    @if ($editRestaurant->categories->contains($category->id)) checked @endif
                    >
                    
                    <label for="tag-{{$category->id}}">
                        {{ $category->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <input type="submit" value="Edita Ristorante">
    </form>
</body>
</html>