import $ from 'jquery';
import Swal from "sweetalert2";

// Verificar si jQuery está disponible
if (typeof $ === 'undefined') {
    throw new Error('jQuery no está cargado. Verifica tus imports.');
}

$(document).ready(function () {
    // Asumiendo que el formulario de usuarios tiene el ID 'idformusuario'
    $("#idformusuario").submit(function (e) {
        e.preventDefault();

        // Cerrar el modal
        const modalElement = document.getElementById('idmodalUsuarios'); // Asegúrate de que tu modal tenga este ID
        const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modalInstance.hide();

        // Obtener los datos del formulario
        const datos = {
            userId: $("#idusuario").val(), // ID del usuario (si estamos editando)
            name: $("#idtxtnombre").val(),
            email: $("#idtxtemail").val(),
            password: $("#idtxtpassword").val(), // Contraseña
            idrol: $("#idselectrol").val(),
            _token: $('input[name="_token"]').val() // Token CSRF
        };

        console.log(JSON.stringify(datos));

        // Enviar los datos al servidor (AJAX)
        $.ajax({
            url: "/registrarusuario", // Asegúrate de que esta ruta esté correctamente definida en Laravel
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(datos),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (!response.success) {
                    console.log('Estructura de respuesta inválida');
                    // Puedes lanzar un error o notificar al usuario
                    return;
                }

                // Emitir evento Livewire para refrescar la lista de usuarios
                Livewire.dispatch("listarusuariosDesdeJS");

                // Mostrar un mensaje de éxito usando SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Usuario registrado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Limpiar el formulario (opcional)
                $("#idformusuario")[0].reset();
            },
            error: function (error) {
                // Mostrar un mensaje de error si la solicitud falla
                Swal.fire({
                    icon: 'error',
                    title: 'Error al registrar usuario',
                    text: 'Hubo un problema al registrar el usuario. Intenta nuevamente.',
                    showConfirmButton: true
                });
            }
        });
    });
});
