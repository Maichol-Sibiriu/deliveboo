@extends('layouts.app')
@section('content')
<main>
    <h1 class="text-center stats-title mb-4">Le tue statistiche</h1>
    <div class="stats-wrapper d-flex">
        <div class="canvas-wrapper mb-5">
            <canvas id="mediaAnno" ></canvas>
        </div>
    
        <div class="canvas-wrapper mb-5">
            <canvas id="mediaMese" ></canvas>
        </div>
    
        <div class="canvas-wrapper mb-5">
            <canvas id="ordiniMensili" ></canvas>
        </div>
    
        <div class="canvas-wrapper mb-5">
            <canvas id="ordiniAnnuali" ></canvas>
        </div>
    </div>
</main>

<input type="hidden" value="@php echo($id) @endphp" id="restaurant_id">

<script src="{{ asset('js/stats.js') }}"></script>
@endsection