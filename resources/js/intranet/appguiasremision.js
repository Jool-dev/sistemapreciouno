
import $ from 'jquery';
import Swal from "sweetalert2";

const fechaActual = new Date();
const fechaLocal = fechaActual.getFullYear() + "-" +
    ("0" + (fechaActual.getMonth() + 1)).slice(-2) + "-" +
    ("0" + fechaActual.getDate()).slice(-2);
const horaLocal = ("0" + fechaActual.getHours()).slice(-2) + ":" +
    ("0" + fechaActual.getMinutes()).slice(-2) + ":" +
    ("0" + fechaActual.getSeconds()).slice(-2);

let productos = [];
let contadorId = 0;

if (typeof $ === 'undefined') {
    throw new Error('jQuery no está cargado. Verifica tus imports.');
}

$(document).ready(function () {
    $('#idformaddguiasremision').on('keypress', function (e) {
        if (e.which === 13 && !$(e.target).is('textarea, [type="submit"]')) {
            e.preventDefault();
        }
    });

    // Auto completar campos al seleccionar producto por nombre
    $('#idselectnombreproducto').on('change', function () {
        const selected = $(this).find('option:selected');
        const codigo = selected.data('codigo') || '';
        const idproducto = selected.val();
        const nombre = selected.text();

        $('#idtxtcodigoproducto').val(codigo);
        $('#idproductocarritogiaremision').val(idproducto);
        $('#idtxtnombreproducto').val(nombre); // <-- ESTA LÍNEA ES CLAVE
    });

    $('#idbtnagregarproducto').click(agregarProductoAlCarrito);

    $('#tablaProductos').on('click', '.btn-eliminar', function () {
        eliminarProducto($(this).closest('tr').data('id'));
    });

    $("#idformaddguiasremision").submit(async function (e) {
        e.preventDefault();

        if (!validarFormulario()) return;

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
            productos: productos,
            _token: $('input[name="_token"]').val()
        };

        const confirm = await Swal.fire({
            title: "¿Estás seguro de registrar esta guía?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Sí, guardar",
            cancelButtonText: "Cancelar"
        });

        if (!confirm.isConfirmed) return;

        $.ajax({
            url: "/registrarguiaremision",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(datos),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                window.location.replace('/guiasremision');
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON.message || 'Ocurrió un error al guardar'
                });
            }
        });
    });
});

function agregarProductoAlCarrito() {
    const idproducto = $('#idproductocarritogiaremision').val().trim();
    const codigo = $('#idtxtcodigoproducto').val().trim();
    const nombre = $('#idselectnombreproducto option:selected').text().trim();
    const cantidad = parseInt($('#idtxtcantidadproducto').val());
    const estado = $('#idselectestadoproducto').val();

    if (!idproducto || !codigo || !nombre) {
        Swal.fire({
            icon: 'warning',
            title: 'Campos incompletos',
            text: 'Debe seleccionar un producto válido con nombre y código .',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    if (isNaN(cantidad) || cantidad <= 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Cantidad inválida',
            text: 'La cantidad debe ser un número mayor a 0',
            confirmButtonText: 'Corregir'
        });
        $('#idtxtcantidadproducto').focus();
        return;
    }

    const productoExistente = productos.find(p =>
        p.idproducto === idproducto && p.estado === estado
    );

    if (productoExistente) {
        Swal.fire({
            icon: 'info',
            title: 'Producto duplicado',
            text: 'Este producto con el mismo estado ya fue agregado.',
        });
        return;
    }

    productos.push({
        id: contadorId++,
        idproducto,
        codigo,
        nombre,
        cantidad,
        estado
    });

    actualizarTablaProductos();

    $('#idselectnombreproducto').val('');
    $('#idtxtcodigoproducto').val('').focus();
    // $('#idtxtnombreproducto').val('');
    $('#idtxtcantidadproducto').val('');
    $('#idproductocarritogiaremision').val('');
    $('#idselectestadoproducto').val('Bueno');
}
//Eliminar producto de la tabla
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

    $(camposRequeridos.join(',')).removeClass('is-invalid');

    camposRequeridos.forEach(selector => {
        const $campo = $(selector);
        if (!$campo.val().trim()) {
            $campo.addClass('is-invalid');
            if (valido) $campo.focus();
            valido = false;
            camposIncompletos = true;
        }
    });

    if (camposIncompletos) {
        Swal.fire({
            icon: 'error',
            title: 'Campo requerido',
            text: 'Complete todos los campos requeridos',
            confirmButtonText: 'Entendido'
        });
        return false;
    }

    // const Nguia = $('#idtxtcodigoguia').val().trim();
    // const NTraslado = $('#idtxtnumerotrasladotim').val().trim();
    // const RazonSocial = $('#idtxtrazonsocialguia').val().trim();
    // const MotivoTraslado = $('#idselcetmotivotraslado').val();
    // const PesoBruto = $('#idtxtpesobrutototal').val().trim();
    // const VolumenProducto = $('#idtxtvolumenproducto').val().trim();
    // const NumeroBulto = $('#idselectnumerobultopallet').val();

    // if (!Nguia|| !NTraslado || !RazonSocial ) {
    //     Swal.fire({
    //         icon: 'warning',
    //         title: 'Campos de datos principales incompletos',
    //         text: 'Debe completar los campos con N° Guia,N° TIM y Razon social .',
    //         confirmButtonText: 'Entendido'
    //     });
    //     return;
    // }

    if (productos.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Productos requeridos',
            text: 'Agregue al menos un producto',
            confirmButtonText: 'Entendido'
        });
        return false;
    }

    return true;


}


