@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

    <div class="card">
        <div class="card-content">
            <p class="title">
                Mapa de Marcadores
            </p>
            <p class="buttons">
                <button class="button is-success" onclick="window.location = '{{url('/nuevo')}}'">
                    <span>Agregar Marcador</span>
                </button>
            </p>
            <div style="width: 100%; height: 50%;" id="mapa"></div>
        </div>
    </div>

@endsection

@section('custom-scripts')
    <script src="{{asset('js/inicio.js')}}?v={{ rand() }}"></script>
@endsection