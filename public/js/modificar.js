let mapElement;
mapElement = document.getElementById('mapa');


function initMapa(marcadores) {

    // Opciones de visualización, se centrará el mapa en base al primer elemento
    let latMarcador = document.getElementById('latitud_marcador').value;
    let lonMarcador = document.getElementById('longitud_marcador').value;
    let tituloMarcador = document.getElementById('titulo_marcador').value;
    let descMarcador = document.getElementById('descripcion_marcador').value;
    const options = {
        center: {lat: Number(latMarcador), lng: Number(lonMarcador)},
        zoom: 13
    }
    // Creación de la instancia del mapa
    const map = new google.maps.Map(mapElement, options);
    //Creación del Objeto del Marcador
    const marcadoresObj = {
        coords: {lat: Number(latMarcador), lng: Number(lonMarcador)},
        content: `<h4 class="title is-size-6">${tituloMarcador}</h4>
                  <h5 class="subtitle is-size-7">${descMarcador}</h5>`
    };
    addMarcador(marcadoresObj, map);
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

function updateMarcador() {
    Swal.fire({
        title: '¿Desea Modificar el Marcador?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
        confirmButtonText: 'Si',
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
            let idMarcador = $('#idMarcador').val();
            let url = `/api/marcadores/update/${idMarcador}`
            let data = $("#formUpdate").serializeArray();
            data.push({name: "id", value: idMarcador});
            //Removemos los mensajes de error antes de hacer el submit
            $('.help').remove();
            $('.input').removeClass('is-danger');
            $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                data: data,
                success: function (data) {
                    Swal.fire({
                        title: 'Actualización Correcta!',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.value) {
                            window.location = '/';
                        }
                    })
                },
                error: function (data) {
                    Swal.fire('Error', 'Se han encontrado errores en el formulario, por favor verificar', 'error')
                    let errors = data.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $('#' + key).addClass('is-danger').parent().append(`<p class='help is-danger'>${value}</p>`);
                    });
                }
            });
        }
    })
}

function deleteMarcador() {
    Swal.fire({
        title: '¿Desea Eliminar el Marcador?',
        text: "Esta Operación no puede deshacerse",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
        confirmButtonText: 'Si',
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
            let idMarcador = $('#idMarcador').val();
            let url = `/api/marcadores/delete/${idMarcador}`
            //Removemos los mensajes de error antes de hacer el submit
            $('.help').remove();
            $('.input').removeClass('is-danger');
            $.ajax({
                url: url,
                type: "delete",
                success: function (data) {
                    Swal.fire({
                        title: 'Se ha eliminado el Marcador',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.value) {
                            window.location = '/';
                        }
                    })
                },
                error: function (data) {
                    Swal.fire('Error', 'Se han encontrado errores en el formulario, por favor verificar', 'error')
                    let errors = data.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $('#' + key).addClass('is-danger').parent().append(`<p class='help is-danger'>${value}</p>`);
                    });
                }
            });
        }
    })
}

window.addEventListener("load", function () {
    document.getElementById('formUpdate').addEventListener("submit", function (e) {
        e.preventDefault();
        updateMarcador();
    });
    document.getElementById('deleteMarcador').addEventListener('click', function (e) {
        e.preventDefault();
        deleteMarcador();
    })
});

