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

// Variables globales (accesibles desde todas las funciones)
let productos = [];
let contadorId = 0;

// Verificar si jQuery está disponible
if (typeof $ === 'undefined') {
    throw new Error('jQuery no está cargado. Verifica tus imports.');
}


$(document).ready(function() {
    // 1. Prevenir el comportamiento por defecto del Enter en todo el formulario
    $('#idformaddguiasremision').on('keypress', function(e) {
        if(e.which === 13 && !$(e.target).is('textarea, [type="submit"]')) {
            e.preventDefault();
        }
    });

    // 2. Manejador específico para el campo de código de producto
    // Evento para manejar Enter (código 13 es la tecla Enter)
    $('#idtxtcodigoproducto').keypress(function(e) {
        if(e.which === 13) { // 13 es el código de la tecla Enter
            e.preventDefault();
            const codigo = $(this).val().trim();

            // Resetear estilo si había error previo
            $(this).removeClass('border-danger');

            if(codigo) {
                buscarproductocodigo(codigo);
            }
        }
    });

    // 3. Manejador para navegación entre campos
    $('.form-control:not(#idtxtcodigoproducto), .form-select').keypress(function(e) {
        if(e.which === 13) {
            e.preventDefault();
            const $current = $(this);

            // Si es el último campo antes del botón agregar
            if($current.is('#idselectestadoproducto')) {
                $('#idbtnagregarproducto').click();
                $('#idtxtcodigoproducto').focus();
            }
            // Para otros campos
            else {
                const inputs = $current.closest('.row').find('.form-control, .form-select');
                const currentIndex = inputs.index(this);
                if(currentIndex < inputs.length - 1) {
                    inputs.eq(currentIndex + 1).focus();
                }
            }
        }
    });

    $('#btnnuevaguia').on('click', function () {
        // Limpiar inputs
        $('#idguia').val(''); // limpiar para nuevo
        $('#idformaddguiasremision')[0].reset();

        // Cambiar el título del modal
        $('#idmodalguiasremision').text('Nueva Guia de Remision');
        $("#idformaddguiasremision :input").prop("disabled", false);

        // Mostrar el modal
        const modalElement = document.getElementById('idmodalguiasremision');
        const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modalInstance.show();
    });

    // Delegación de eventos mejorada
    $(document).on('click', '.btn-editarguia', function(e) {
        e.preventDefault();

        // Obtener datos del TR actual (no del botón)
        const $tr = $(this).closest('tr');
        const id = $tr.find('td:eq(0)').text().trim();
        const placa = $tr.find('td:eq(1)').text().trim();
        const placasecundaria = $tr.find('td:eq(2)').text().trim();

        // Llenar el formulario
        $('#idguia').val(id);
        $('#idtxtcodigoguia').val(placa);
        $('#idtxtnumerotrasladotim').val(placasecundaria);
        $('#idmodalguiasremision').text('Editar Vehículo');

        // Mostrar modal
        const modal = new bootstrap.Modal(document.getElementById('idmodalguiasremision'));
        modal.show();
    });

    //Eliminar
    $(document).on('click', '.btn-eliminarguia', async function(e) {
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
                url: "/estadoguia",
                type: "POST",
                data: {
                    idguia: id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                dataType: 'json'
            });

            if (response.success) {
                Livewire.dispatch("listarGuiasRemisionDesdeJS");
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

    // Evento para botón agregar
    $('#idbtnagregarproducto').click(agregarProductoAlCarrito);

    // Evento delegado para eliminar
    $('#tablaProductos').on('click', '.btn-eliminar', function() {
        eliminarProducto($(this).closest('tr').data('id'));
    });

    // Evento para resetear el estilo al escribir
    $('#idtxtcodigoproducto').on('input', function() {
        $(this).removeClass('border-danger');
    });

    $("#idformaddguiasremision").submit( async function(e) {
        e.preventDefault();

        //verifico que haya productos en la tabla
        // Validar antes de continuar
        if (!validarFormulario()) {
            return;
        }

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
            productos: productos, // <- Aquí incluimos el array de productos
            _token: $('input[name="_token"]').val() // Token CSRF
        };

        console.log(JSON.stringify(datos));
        const pregunta = await window.SweetAlertpreguntarSI_NO("¿Estás seguro de Registrar?");

        if(pregunta){
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

                    // Livewire.dispatch("listarGuiasRemisionDesdeJS");

                    // Mensaje de éxito (opcional)
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Guia registrada correctamente',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });

                    // Limpiar el formulario (opcional)
                    // $("#idformaddguiasremision")[0].reset();
                    window.location.replace('/guiasremision');
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
        }
    });
});

function buscarproductocodigo(codigo) {
    const $codigoInput = $('#idtxtcodigoproducto');
    const $btnAgregar = $('#idbtnagregarproducto');

    //desactivo los campos
    $codigoInput.prop('disabled', true);
    $('#idtxtcantidadproducto').prop('disabled', true);
    $('#idselectestadoproducto').prop('disabled', true);

    // Mostrar carga en el botón
    $btnAgregar.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

    $.ajax({
        url: '/buscarproductocodigo',
        method: 'POST',
        data: { codigoproducto: codigo, _token: $('meta[name="csrf-token"]').attr('content') },
        success: function(response) {
            $btnAgregar.prop('disabled', false).html('<i class="fas fa-plus"></i>');
            $codigoInput.prop('disabled', false);
            $('#idtxtcantidadproducto').prop('disabled', false);
            $('#idselectestadoproducto').prop('disabled', false);

            if(response.data !== null) {
                $('#idtxtnombreproducto').val(response.data[0]["nombre"]);
                $('#idproductocarritogiaremision').val(response.data[0]["idproducto"]);

                $('#idtxtcantidadproducto').focus();
            } else {
                $codigoInput.addClass('border-danger').focus();
                $('#idtxtnombreproducto').val('');
                $('#idtxtcantidadproducto').val('');
                $('#idproductocarritogiaremision').val('');
                $('#idselectestadoproducto').val('Bueno');
            }
        },
        error: function(xhr) {
            $btnAgregar.prop('disabled', false).html('<i class="fas fa-plus"></i>');
            $codigoInput.addClass('border-danger');
        }
    });
}

function agregarProductoAlCarrito() {
    const producto = {
        id: contadorId++,
        idproducto: $('#idproductocarritogiaremision').val().trim(),
        codigo: $('#idtxtcodigoproducto').val().trim(),
        nombre: $('#idtxtnombreproducto').val().trim(),
        cantidad: $('#idtxtcantidadproducto').val(),
        estado: $('#idselectestadoproducto').val()
    };

    // Validación de campos obligatorios
    if(!producto.codigo || !producto.nombre || !producto.cantidad) {
        return;
    }

    // Validar que no exista el mismo producto con el mismo estado
    const productoExistente = productos.find(p =>
        p.idproducto === producto.idproducto &&
        p.estado === producto.estado
    );

    if(productoExistente) {
        return;
    }

    // Si pasa todas las validaciones, agregar el producto
    productos.push(producto);
    actualizarTablaProductos();

    // Limpiar campos
    $('#idtxtcodigoproducto').val('').focus();
    $('#idtxtnombreproducto').val('');
    $('#idtxtcantidadproducto').val('');
    $('#idproductocarritogiaremision').val('');
    $('#idselectestadoproducto').val('Bueno');
}

function actualizarTablaProductos() {
    const tbody = $('#tablaProductos tbody').empty();

    productos.forEach(producto => {
        tbody.append(`
            <tr data-id="${producto.id}">
                <td>${producto.codigo}</td>
                <td>${producto.nombre}</td>
                <td>${producto.cantidad}</td>
                <td>${producto.estado}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-danger btn-eliminar">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `);
    });
}

function eliminarProducto(id) {
    productos = productos.filter(p => p.id !== id);
    actualizarTablaProductos();
}

function validarFormulario() {
    let valido = true;
    let camposIncompletos = false;
    const camposRequeridos = [
        '#idtxtcodigoguia',
        '#idtxtnumerotrasladotim',
        '#idtxtrazonsocialguia',
        '#idselcetmotivotraslado',
        '#idtxtpesobrutototal',
        '#idtxtvolumenproducto',
        '#idselectnumerobultopallet',
        '#idselectidtipoempresa',
        '#idselectidconductor'
    ];

    // Resetear estilos de error
    $(camposRequeridos.join(',')).removeClass('is-invalid');

    // Validar cada campo
    camposRequeridos.forEach(selector => {
        const $campo = $(selector);
        if (!$campo.val().trim()) {
            $campo.addClass('is-invalid');
            if (valido) {
                $campo.focus(); // Enfocar el primer campo inválido
            }
            valido = false;
            camposIncompletos = true;
        }
    });

    // Mostrar mensaje de campos incompletos si aplica
    if (camposIncompletos) {
        Swal.fire({
            icon: 'error',
            text: 'Complete todos los campos requeridos',
            confirmButtonText: 'Entendido'
        });
        return false;
    }

    // Validar productos (solo si los campos están completos)
    if (productos.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Productos requeridos',
            text: 'Agregue al menos un producto',
            confirmButtonText: 'Entendido'
        });
        // $('#idtxtcodigoproducto').focus();
        return false;
    }

    return true;
}
