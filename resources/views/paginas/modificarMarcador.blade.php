@extends('layouts.app')

@section('title', 'Modificar Marcador')

@section('content')
    <div class="columns">
        <div class="column">
            <div class="card">
                <div class="card-content">
                    <p class="title">
                        Modificar Marcador
                    </p>
                    <form action="/api/update/{{$marcador->id}}" method="post" id="formUpdate">
                        {{ csrf_field() }}
                        <div class="field">
                            <label class="label">ID Marcador</label>
                            <div class="control">
                                <input class="input" id="idMarcador" name="idMarcador" type="text"
                                       value="{{$marcador->id}}" disabled>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Titulo</label>
                            <div class="control">
                                <input class="input" id="titulo_marcador" name="titulo_marcador" type="text"
                                       value="{{$marcador->titulo_marcador}}">
                            </div>

                        </div>
                        <div class="field">
                            <label class="label">Descripción</label>
                            <div class="control">
                                <input class="input" id="descripcion_marcador" name="descripcion_marcador" type="text"
                                       value="{{$marcador->descripcion_marcador}}">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Latitud</label>
                            <div class="control">
                                <input class="input" id="latitud_marcador" name="latitud_marcador" type="text"
                                       value="{{$marcador->latitud_marcador}}">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Longitud</label>
                            <div class="control">
                                <input class="input" id="longitud_marcador" name="longitud_marcador" type="text"
                                       value="{{$marcador->longitud_marcador}}">
                            </div>
                        </div>
                        <div class="buttons is-centered">
                            <button id="saveFormUpdate" name="saveFormUpdate" type="submit" class="button is-success">Actualizar</button>
                            <button id="deleteMarcador" name="deleteMarcador" class="button is-danger">Eliminar</button>
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
    <script src="{{asset('js/modificar.js')}}?v={{rand()}}"></script>
@endsection