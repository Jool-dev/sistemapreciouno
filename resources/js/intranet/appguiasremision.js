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
    $("#idformguiasremision").submit(function(e) {
        e.preventDefault();

        // Cerrar el modal
        const modalElement = document.getElementById('idmodalProductos'); // Asegúrate que tu modal tenga este ID
        const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modalInstance.hide();

        const datos = {
            tim: $("#idtxttim").val(),
            fechaemision: fechaLocal,
            horaemision: horaLocal,
            motivotraslado: $("#idtxtmotivotraslado").val(),
            origen: $("#idtxtselectorigen").val(),
            destino: $("#idtxtselectdestino").val(),
            estado: $("#idselectestado").val(),
            cantidadenviada: $("#idselectcantidadenviada").val(),
            _token: $('input[name="_token"]').val() // Token CSRF
        };

        console.log(JSON.stringify(datos));

        // Enviar datos al servidor (AJAX)
        $.ajax({
            url: "/registrarguiasremision", // Ruta en Laravel
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
                $("#idformguiasremision")[0].reset();
            },
            error: function(error) {
                // alert("Error: " + xhr.responseJSON.message);
            }
        });
    });
});
