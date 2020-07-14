let mapElement;
mapElement = document.getElementById('mapa');

function initMapa() {
    let url = `/api/marcadores/all`;
    $.get(url,
        function (data, textStatus, jqXHR) {
            mapDisplay(data);
        },
        "json"
    );
}

function mapDisplay(marcadores) {
    // Opciones de visualización, se centrará el mapa en base al primer elemento
    // En caso de no haber registros se centrará el mapa en la ciudad de Buenos Aires
    let lat = (marcadores.length === 0) ? -34.6131500 : marcadores[0].latitud_marcador;
    let lon = (marcadores.length === 0) ? -58.3772300 : marcadores[0].longitud_marcador;
    const options = {
        center: {lat: Number(lat), lng: Number(lon)},
        zoom: 10
    }
    // Creación de la instancia del mapa
    const map = new google.maps.Map(mapElement, options);
    const marcadoresArray = [];

    if(marcadores.length === undefined) return;

    // Se arma el array de los marcadores

    for (let index = 0; index < marcadores.length; index++) {
        const contentString = `<div id="content">
            <div id="siteNotice">
                <h4 class="title is-size-6">${marcadores[index].titulo_marcador}</h4>
                <h5 class="subtitle is-size-7">${marcadores[index].descripcion_marcador}</h5>
            </div>
            <div id="bodyContent">
                <p class="subtitle is-size-7 has-text-weight-bold">Ubicación: ${marcadores[index].latitud_marcador}, ${marcadores[index].longitud_marcador}</p>
                <button class="button is-danger is-small" onclick=modificarMarcador(${marcadores[index].id})>Modificar Marcador</button>
                <button class="button is-info is-small" onclick=marcadoresCercanos(${marcadores[index].id})>Marcadores Cercanos</button>
            </div>
            </div>`;
        marcadoresArray.push({
            coords: {lat: Number(marcadores[index].latitud_marcador), lng: Number(marcadores[index].longitud_marcador)},

            content: contentString
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