import Swal from "sweetalert2";
import $ from 'jquery';

// Verificar si jQuery está disponible
if (typeof $ === 'undefined') {
    throw new Error('jQuery no está cargado. Verifica tus imports.');
}

$(document).ready(function() {
    $("#formulariologin").submit(function(e) {
        e.preventDefault();

        // Opción 1: Serializar todos los campos
        const datos = $(this).serialize();

        // Opción 2: Crear un objeto manualmente (útil si necesitas agregar más datos)
        const datosManual = {
            nombre: $("#username").val(),
            email: $("#password").val(),
            _token: $('input[name="_token"]').val() // Token CSRF
        };

        // Redirigir a una ruta relativa
        window.location.href = "/dashboard";

        // Enviar datos al servidor (AJAX)
        // $.ajax({
        //     url: "/guardar-datos", // Ruta en Laravel
        //     method: "POST",
        //     data: datos, // o datosManual
        //     success: function(respuesta) {
        //         alert("Datos guardados: " + respuesta.mensaje);
        //     },
        //     error: function(xhr) {
        //         alert("Error: " + xhr.responseJSON.message);
        //     }
        // });
    });
    // Mostrar shimmer y ocultar contenido al inicio
    // $('#idshimmerpersonero').show();
    // $('#idcontenidopersonero').hide();

    // Llamar a la función
    // $('#btn-agregar').click(agregarVoto);
    // $('#btn-eliminar').click(eliminarVoto);
    // $('#btn-confirmar').click(confirmVotacion);
});
