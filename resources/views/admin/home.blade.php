@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <button><a href="{{ route('orders.index') }}">ORDINI</a></button>
                <button><a href="{{ route('dishes.index') }}">PIATTI</a></button>
            </div>
        </div>
    </div>
</div>
@endsection
