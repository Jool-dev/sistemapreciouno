import $ from 'jquery';
import Swal from "sweetalert2";

// Verificar si jQuery está disponible
if (typeof $ === 'undefined') {
    throw new Error('jQuery no está cargado. Verifica tus imports.');
}

$(document).ready(function() {
    $("#idformConductores").submit(function(e) {
        e.preventDefault();

        // Cerrar el modal
        const modalElement = document.getElementById('idmodalConductoress'); // Asegúrate que tu modal tenga este ID
        const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modalInstance.hide();

        const datos = {
            idconductor: $("#idconductor").val(),
            nombre: $("#idtxtnombre").val(),
            dni: $("#idtxtdni").val(),
            idtransportista: $("#idselecttransporte").val(),
            idvehiculo: $("#idselectvehiculo").val(),
            _token: $('input[name="_token"]').val() // Token CSRF
        };

        console.log(JSON.stringify(datos));

        // Enviar datos al servidor (AJAX)
        $.ajax({
            url: "/mantenimientoconductor", // Ruta en Laravel
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

                Livewire.dispatch("listarconductoresDesdeJS");

                // Mensaje de éxito (opcional)
                Swal.fire({
                    icon: 'success',
                    title: 'Conductor registrado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Limpiar el formulario (opcional)
                $("#idformConductores")[0].reset();
            },
            error: function(error) {
                // alert("Error: " + xhr.responseJSON.message);
            }
        });
    });
});
