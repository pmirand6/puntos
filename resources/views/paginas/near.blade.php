@extends('layouts.app')

@section('title', 'Marcadores Cercanos')

@section('content')
    <div class="columns is-fluid">
        <div class="column">
            <div class="card">
                <div class="card-content">
                    <p class="title">
                        Marcadores Cercanos
                    </p>
                    <p class="subtitle">{{$marcador->titulo_marcador}}</p>

                    <form action="" method="post" id="formScope"  style="display: none">
                        <div class="field has-addons">
                            <div class="control">
                                <input class="input" type="number" id="scope" name="scope" placeholder="Cantidad Resultados">
                            </div>
                            <div class="control">
                                <button class="button is-info" type="submit">
                                    Filtrar
                                </button>
                            </div>
                        </div>
                        <p class="help is-info">* Se muestran los primeros 5 resultados, pero puede extender los
                            resultados</p>
                        <span class="help is-danger">* La distancia entre los puntos es expresada en forma lineal</span>
                    </form>

                    <input type="hidden" id="idMarcador" value="{{$marcador->id}}">
                    <input type="hidden" id="latitud_marcador" value="{{$marcador->latitud_marcador}}">
                    <input type="hidden" id="longitud_marcador" value="{{$marcador->longitud_marcador}}">
                    <table class="table" id="tableNear"  style="display: none">
                        <thead>
                        <tr>
                            <th>Nombre</abbr></th>
                            <th>Distancia</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card">
                <div class="card-content">
                    <div style="width: 100%; height: 100%;" id="mapa"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom-scripts')
    <script src="{{asset('js/near.js')}}?v={{rand()}}"></script>
@endsection

