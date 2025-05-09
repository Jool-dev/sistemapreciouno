import $ from 'jquery';
import Swal from "sweetalert2";

const fechaActual = new Date();

// Formatear fecha como YYYY-MM-DD
const fechaLocal = fechaActual.getFullYear() + "-" +
    ("0" + (fechaActual.getMonth() + 1)).slice(-2) + "-" +
    ("0" + fechaActual.getDate()).slice(-2);

// Formatear hora como HH:MM:SS
const horaLocal = ("0" + fechaActual.getHours()).slice(-2) + ":" +
    ("0" + fechaActual.getMinutes()).slice(-2) + ":" +
    ("0" + fechaActual.getSeconds()).slice(-2);

// Verificar si jQuery está disponible
if (typeof $ === 'undefined') {
    throw new Error('jQuery no está cargado. Verifica tus imports.');
}


$(document).ready(function() {
    $("#idformaddguiasremision").submit(function(e) {
        e.preventDefault();

        // Cerrar el modal
        const modalElement = document.getElementById('idmodalguiasremision'); // Asegúrate que tu modal tenga este ID
        const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modalInstance.hide();

        const datos = {
            idguia: $("#idguia").val(),
            codigoguia: $("#idtxtcodigoguia").val(),
            fechaemision: fechaLocal,
            horaemision: horaLocal,
            razonsocialguia: $("#idtxtrazonsocialguia").val(),
            numerotrasladotim: $("#idtxtnumerotrasladotim").val(),
            motivotraslado: $("#idselcetmotivotraslado").val(),
            pesobrutototal: $("#idtxtpesobrutototal").val(),
            volumenproducto: $("#idtxtvolumenproducto").val(),
            numerobultopallet: $("#idselectnumerobultopallet").val(),
            observaciones: $("#idtxtobservaciones").val(),
            idconductor: $("#idselectidconductor").val(),
            idtipoempresa: $("#idselectidtipoempresa").val(),
            _token: $('input[name="_token"]').val() // Token CSRF
        };

        console.log(JSON.stringify(datos));

        // Enviar datos al servidor (AJAX)
        $.ajax({
            url: "/registrarguiaremision", // Ruta en Laravel
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(datos),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (!response.result) {
                    console.log('Estructura de respuesta inválida');
                    // throw new Error();
                }

                Livewire.dispatch("listarGuiasRemisionDesdeJS");

                // Mensaje de éxito (opcional)
                Swal.fire({
                    icon: 'success',
                    title: 'Guia registrada correctamente',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Limpiar el formulario (opcional)
                $("#idformaddguiasremision")[0].reset();
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseJSON);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON.message || 'Ocurrió un error al guardar'
                });
            }
        });
    });
});
