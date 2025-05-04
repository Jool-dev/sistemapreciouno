import $ from 'jquery';
import Swal from "sweetalert2";

// Verificar si jQuery está disponible
if (typeof $ === 'undefined') {
    throw new Error('jQuery no está cargado. Verifica tus imports.');
}

$(document).ready(function() {
    $("#idformvechiculo").submit(function(e) {
        e.preventDefault();

        // Cerrar el modal
        const modalElement = document.getElementById('idmodalvehiculo'); // Asegúrate que tu modal tenga este ID
        const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modalInstance.hide();

        const datos = {
            placa: $("#idtxtplaca").val(),
            marca: $("#idtxtmarca").val(),
            tipo: $("#idselecttipo").val(),
            _token: $('input[name="_token"]').val() // Token CSRF
        };

        // Enviar datos al servidor (AJAX)
        $.ajax({
            url: "/registrarvehiculo", // Ruta en Laravel
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(datos),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (!response.result || !response.result.data) {
                    console.log('Estructura de respuesta inválida');
                    // throw new Error();
                }

                Livewire.dispatch("listarvehiculoDesdeJS");

                // Mensaje de éxito (opcional)
                Swal.fire({
                    icon: 'success',
                    title: 'Vehículo registrado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Limpiar el formulario (opcional)
                $("#idformvechiculo")[0].reset();
            },
            error: function(error) {
                // alert("Error: " + xhr.responseJSON.message);
            }
        });
    });
});
