@extends('layouts.app')

@section('title', 'Marcadores Cercanos')

@section('content')
    <div class="columns">
        <div class="column">
            <div class="card">
                <div class="card-content">
                    <p class="title">
                        Nuevo Marcador
                    </p>
                    <form action="/api/marcadores/create/" method="post" id="formCreateMarcador">
                        {{ csrf_field() }}
                        <div class="field">
                            <label class="label">Buscar</label>
                            <div class="control">
                                <input class="input map-input" id="address-input" name="address_address" type="text">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Titulo</label>
                            <div class="control">
                                <input class="input" id="titulo_marcador" name="titulo_marcador" type="text">
                            </div>

                        </div>
                        <div class="field">
                            <label class="label">Descripción</label>
                            <div class="control">
                                <input class="input" id="descripcion_marcador" name="descripcion_marcador" type="text">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Latitud</label>
                            <div class="control">
                                <input class="input" id="latitud_marcador" name="latitud_marcador" type="text" disabled>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Longitud</label>
                            <div class="control">
                                <input class="input" id="longitud_marcador" name="longitud_marcador" type="text" disabled>
                            </div>
                        </div>
                        <div class="buttons is-centered">
                            <button id="saveFormCreate" name="saveFormCreate" type="submit" class="button is-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card">
                <div class="card-content">
                    <div style="width: 100%; height: 70%;" id="mapa"></div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('custom-scripts')
    <script src="{{asset('js/busquedaMarcador.js')}}?v={{rand()}}"></script>
    <script src="{{asset('js/crearMarcador.js')}}?v={{rand()}}"></script>
@endsection
