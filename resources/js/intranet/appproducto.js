import $ from 'jquery';
import Swal from "sweetalert2";

const fecha = new Date();
const fechaLocal = fecha.getFullYear() + "-" +
    ("0" + (fecha.getMonth() + 1)).slice(-2) + "-" +
    ("0" + fecha.getDate()).slice(-2) + " " +
    ("0" + fecha.getHours()).slice(-2) + ":" +
    ("0" + fecha.getMinutes()).slice(-2) + ":" +
    ("0" + fecha.getSeconds()).slice(-2);

// Verificar si jQuery está disponible
if (typeof $ === 'undefined') {
    throw new Error('jQuery no está cargado. Verifica tus imports.');
}

$(document).ready(function () {
    $("#idformproducto").submit(function (e) {
        e.preventDefault();

        // Cerrar el modal
        const modalElement = document.getElementById('idmodalProductos'); // Asegúrate que tu modal tenga este ID
        const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modalInstance.hide();

        const datos = {
            idproducto: $("#idproducto").val(),
            codigoproducto: $("#idtxtcodigoproducto").val(),
            nombre: $("#idtxtnombre").val(),
            tipoinventario: $("#idselectinventario").val(),
            fecharegistro: fechaLocal,
            _token: $('input[name="_token"]').val() // Token CSRF
        };

        console.log(JSON.stringify(datos));

        // Enviar datos al servidor (AJAX)
        $.ajax({
            url: "/registrarproducto", // Ruta en Laravel
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(datos),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (!response.result) {
                    console.log('Estructura de respuesta inválida');
                    // throw new Error();
                }

                Livewire.dispatch("listarproductoDesdeJS");

                // Mensaje de éxito (opcional)
                Swal.fire({
                    icon: 'success',
                    title: 'Producto registrado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Limpiar el formulario (opcional)
                $("#idformproducto")[0].reset();
            },
            error: function (error) {
                // alert("Error: " + xhr.responseJSON.message);
            }
        });
    });

    // Botón Eliminar Producto
    $(document).on('click', '.btn-eliminarproducto', async function (e) {
        e.preventDefault();

        const id = $(this).data('id'); // ✅ Obtenemos el ID desde el botón
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (!csrfToken || !id) {
            console.log('ID o token CSRF faltante');
            return;
        }

        const pregunta = await window.SweetAlertpreguntarSI_NO("¿Estás seguro de eliminar este producto?");

        if (!pregunta) return;

        try {
            const response = await $.ajax({
                url: "/eliminarproducto",
                type: "POST",
                data: {
                    idproducto: id,
                    _token: csrfToken
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                dataType: 'json'
            });

            if (response.success) {
                Livewire.dispatch("listarproductoDesdeJS");
                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    timer: 1500,
                    showConfirmButton: false
                });
            } else {
                throw new Error(response.message || 'Error en la operación');
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.responseJSON?.message || 'No se pudo completar la eliminación'
            });
        }
    });
});
