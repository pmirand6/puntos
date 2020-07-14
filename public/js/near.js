let mapElement;
mapElement = document.getElementById('mapa');
let url = `/api/marcadores/near/${$("#idMarcador").val()}/scope/`;

function initMapa() {
    $.get(url,
        function (data, textStatus, jqXHR) {
        console.log(data.length)
            if(data.length === 0){
                Swal.fire('Advertencia', 'No se encontraron puntos cercanos', 'warning');
            }
            mapDisplay(data);
            appendTablaMarcadores(data);


        },
        "json"
    );
}

function definirScope(scope) {
    return url = `/api/marcadores/near/${$("#idMarcador").val()}/scope/${scope}`;
}

function reiniciarMapa(scope) {
    limpiarTablaMarcadores();
    definirScope(scope);
    initMapa();
    $('.help').html( `Mostrando los ${scope} marcadores cercanos`);
}

function appendTablaMarcadores(datos) {
    $('#tableNear').show();
    $('#formScope').show();
    $.each(datos, (key, value) => {
        let tituloMarcador = `<a title="Ver Detalle" onclick="modificarMarcador(${value.id})">${value.titulo_marcador}</a>`
        $("#tableNear tbody").append(`<tr><th>${tituloMarcador}</th><th>${value.distance}</th></tr>`);
    })
}

function limpiarTablaMarcadores() {
    $("#tableNear tbody").html('');
}

function mapDisplay(marcadores) {

    // Opciones de visualización, se centrará el mapa en base al marcador de la búsqueda
    const options = {
        center: {lat: Number($('#latitud_marcador').val()), lng: Number($('#longitud_marcador').val())},
        zoom: 10
    }
    // Creación de la instancia del mapa
    const map = new google.maps.Map(mapElement, options);
    const marcadoresArray = [];

    // Se arma el array de los marcadores
    for (let index = 0; index < marcadores.length; index++) {
        marcadoresArray.push({
            coords: {lat: Number(marcadores[index].latitud_marcador), lng: Number(marcadores[index].longitud_marcador)},
            content: `<div>
                            <h5>${marcadores[index].titulo_marcador}</h5>
                            <h5>${marcadores[index].descripcion_marcador}</h5>
                            <a onclick=modificarMarcador(${marcadores[index].id})>Modificar Marcador</a>
                            <a onclick=marcadoresCercanos(${marcadores[index].id})>Ver Marcadores Cercanos</a>
                            `
        })
    }

    // Loop entre el array de marcadores para agregarlos al Mapa
    for (let i = 0; i < marcadores.length; i++) {
        addMarcador(marcadoresArray[i], map);
    }


}

function addMarcador(props, map) {
    //Se instancia el marcador
    let marcador = new google.maps.Marker({
        position: props.coords,
        map: map
    });

    // Se agrega el contenido al Info Window
    if (props.content) {
        let infowindow = new google.maps.InfoWindow({
            content: props.content
        });
        marcador.addListener('click', function () {
            infowindow.open(map, marcador);
        });
    }
}

function modificarMarcador(marcadorId) {

    window.location = `/modificar/${marcadorId}`;
}

function marcadoresCercanos(marcadorId) {
    window.location = `/near/${marcadorId}`;
}

window.addEventListener("load", function () {
    document.getElementById('formScope').addEventListener("submit", function (e) {
        e.preventDefault();
        reiniciarMapa(document.getElementById('scope').value);
    });
});
