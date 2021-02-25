@extends('layouts.main')
@section('content')
<p>Il tuo ordine è andato a buon fine</p>
<a class="btn btn-success" href="{{ route('welcome') }}">Torna alla homepage</a>
@endsection