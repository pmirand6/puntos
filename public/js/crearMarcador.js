function crearMarcador() {
    Swal.fire({
        title: '¿Desea Generar el Marcador?',
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
            let url = `/api/marcadores/create`
            let data = $("#formCreateMarcador").serializeArray();
            data.push({name: "latitud_marcador", value: $('#latitud_marcador').val()});
            data.push({name: "longitud_marcador", value: $('#longitud_marcador').val()});
            //Removemos los mensajes de error antes de hacer el submit
            $('.help').remove();
            $('.input').removeClass('is-danger');
            $.ajax({
                url: url,
                type: "POST",
                dataType: "json",
                data: data,
                success: function (data) {
                    Swal.fire({
                        title: 'Ha generado un marcador nuevo!',
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
    document.getElementById('formCreateMarcador').addEventListener("submit", function (e) {
        e.preventDefault();
        crearMarcador();
    });
});