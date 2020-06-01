$(document).ready(function() {
    //Guardar-Editar un registro
    $('#guardar-registro').on('submit', function(e) {
        e.preventDefault();

        let datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                console.log(data);
                let resultado = data;
                if (resultado.respuesta === 'exito') {
                    Swal.fire(
                        'Listo',
                        'Se guardo correctamente',
                        'success'
                    )

                } else {
                    Swal.fire(
                        '¡Error!',
                        'Hubo un Error',
                        'error'
                    )
                }
            }
        });
    });

    //Se ejecuta cuando hay un archivo
    $('#guardar-registro-archivo').on('submit', function(e) {
        e.preventDefault();

        let datos = new FormData(this);

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function(data) {
                console.log(data);
                let resultado = data;
                if (resultado.respuesta === 'exito') {
                    Swal.fire(
                        'Listo',
                        'Se guardo correctamente',
                        'success'
                    )

                } else {
                    Swal.fire(
                        '¡Error!',
                        'Hubo un Error',
                        'error'
                    )
                }
            }
        });
    });

    //Eliminar un registro
    $('.borrar_registro').on('click', function(e) {
        e.preventDefault();

        let id = $(this).attr('data-id');
        let tipo = $(this).attr('data-tipo');

        Swal.fire({
            title: '¿Estás Seguro?',
            text: "Un usuario eliminado no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {

            if (result.value) {
                $.ajax({
                    type: 'post',
                    data: {
                        'id': id,
                        'registro': 'eliminar'
                    },
                    url: 'modelo-' + tipo + '.php',
                    success: function(data) {
                        console.log(data);
                        let resultado = JSON.parse(data);
                        if (resultado.respuesta === 'exito') {
                            Swal.fire(
                                '¡Eliminado!',
                                'El registro a sido eliminado',
                                'success'
                            )
                            jQuery('[data-id="' + resultado.id_eliminado + '"]').parents('tr').remove();

                        } else {
                            Swal.fire(
                                '¡Error!',
                                'No se pudo eliminar',
                                'error'
                            )
                        }
                    }
                })
            }
        });
    });

});