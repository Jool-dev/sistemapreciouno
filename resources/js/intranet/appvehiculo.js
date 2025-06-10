import $ from 'jquery';
import Swal from "sweetalert2";

document.addEventListener('livewire:init', () => {
    // Configurar listener para cuando se actualice la lista
    Livewire.on('listaActualizada', () => {
        console.log('Lista de vehículos actualizada en el frontend');
        // Aquí puedes forzar la actualización de los data-attributes si es necesario
    });
});

// Verificar si jQuery está disponible
if (typeof $ === 'undefined') {
    throw new Error('jQuery no está cargado. Verifica tus imports.');
}

$(document).ready(function () {
    $("#idformvechiculo").submit(function (e) {
        e.preventDefault();

        // Desactivar inputs y botón
        // $("#idformvechiculo :input").prop("disabled", true);

        const $form = $(this);
        $form.find(":input").prop("disabled", true);

        const datos = {
            idvehiculo: $("#idvehiculo").val(),
            placa: $("#idtxtplaca").val(),
            placasecundaria: $("#idtxtplacasecundaria").val(),
            _token: $('input[name="_token"]').val()
        };

        // Enviar datos al servidor (AJAX)
        $.ajax({
            url: "/mantenimientovehiculo", // Ruta en Laravel
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(datos),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (!response.success) {
                    console.log('Estructura de respuesta inválida');
                    // throw new Error();
                }

                // Actualizar Livewire
                Livewire.dispatch("listarvehiculoDesdeJS");

                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                // Resetear y cerrar modal
                $form[0].reset();
                $form.find(":input").prop("disabled", false);
                bootstrap.Modal.getInstance($('#idmodalvehiculo')[0]).hide();

                // Livewire.dispatch("listarvehiculoDesdeJS");
                //
                // // Mensaje de éxito (opcional)
                // Swal.fire({
                //     icon: 'success',
                //     title: response.message,
                //     showConfirmButton: false,
                //     timer: 1500
                // });
                //
                // // Limpiar el formulario yDesactivar inputs y botón
                // $("#idformvechiculo :input").prop("disabled", false);
                // $("#idformvechiculo")[0].reset();

                // Cerrar el modal
                // const modalElement = document.getElementById('idmodalvehiculo'); // Asegúrate que tu modal tenga este ID
                // const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
                // modalInstance.hide();
            },
            error: function (xhr) {
                console.error('Error:', xhr.responseJSON);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON.message || 'Ocurrió un error al guardar'
                });
            }
        });
    });

    $('#btnnuevovehiculo').on('click', function () {
        // Limpiar inputs
        $('#idvehiculo').val(''); // limpiar para nuevo
        $('#idformvechiculo')[0].reset();

        // Cambiar el título del modal
        $('#idlabeltitlemodalvehiculo').text('Nuevo Vehículo');
        $("#idformvechiculo :input").prop("disabled", false);

        // Mostrar el modal
        const modalElement = document.getElementById('idmodalvehiculo');
        const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modalInstance.show();
    });

    // Delegación de eventos mejorada
    $(document).on('click', '.btn-editarvehiculo', function (e) {
        e.preventDefault();

        // Obtener datos del TR actual (no del botón)
        const $tr = $(this).closest('tr');
        const id = $tr.find('td:eq(0)').text().trim();
        const placa = $tr.find('td:eq(1)').text().trim();
        const placasecundaria = $tr.find('td:eq(2)').text().trim();

        // Llenar el formulario
        $('#idvehiculo').val(id);
        $('#idtxtplaca').val(placa);
        $('#idtxtplacasecundaria').val(placasecundaria);
        $('#idlabeltitlemodalvehiculo').text('Editar Vehículo');

        // Mostrar modal
        const modal = new bootstrap.Modal(document.getElementById('idmodalvehiculo'));
        modal.show();
    });

    $(document).on('click', '.btn-eliminarvehiculo', async function (e) {
        e.preventDefault();

        // const id = $(this).data('id'); // Obtener ID directamente del data-attribute
        const $tr = $(this).closest('tr');
        const id = $tr.find('td:eq(0)').text().trim();
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Verificación adicional
        if (!csrfToken) {
            console.log('Token CSRF no encontrado');
            return;
        }

        const pregunta = await window.SweetAlertpreguntarSI_NO("¿Estás seguro de eliminar?");

        if (!pregunta) return;

        try {
            const response = await $.ajax({
                url: "/estadovehiculo",
                type: "POST",
                data: {
                    idvehiculo: id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                dataType: 'json'
            });

            if (response.success) {
                Livewire.dispatch("listarvehiculoDesdeJS");
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
