import Swal from "sweetalert2";
import $ from 'jquery';

window.SweetAlertpreguntarSI_NO = function (titulo, mensaje = null, confirmButtonText = "Sí", cancelButtonText = "No") {
    // const texto = mensaje || '¿Estás seguro de realizar esta acción?';

    // Obtener colores del tema actual
    const bgColor = getComputedStyle(document.body).getPropertyValue("--bg-body").trim();
    const textColor = getComputedStyle(document.body).getPropertyValue("--text-color").trim();
    const confirmColor = getComputedStyle(document.body).getPropertyValue("--button-bg").trim();
    const cancelColor = "#d33";  // Puedes personalizar esto si quieres

    return Swal.fire({
        title: titulo,
        text: mensaje,
        icon: "question",
        showCancelButton: true,
        color: textColor,
        background: bgColor,
        backdrop: "rgba(0, 0, 0, 0.9)", // Fondo oscuro (0.8 = 80% de opacidad)
        confirmButtonColor: confirmColor,
        cancelButtonColor: cancelColor,
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText,
        reverseButtons: true //Para Cambiar el orden de los botones
    }).then((result) => {
        return result.isConfirmed; // Devuelve true si confirma, false si cancela
    });
};

// Función para abrir el modal de carga
window.SweetAlertProgressOpen1 = function (data = {}) {
    // Configuración por defecto
    const defaults = {
        title: 'Procesando...',
        text: 'Por favor espere',
        allowOutsideClick: false // Aquí definimos la variable
    };

    // Combinar con configuración recibida
    const config = Array.isArray(data) ? { ...defaults, ...data[0] } : { ...defaults, ...data };

    return Swal.fire({
        title: config.title,
        text: config.text,
        allowOutsideClick: config.allowOutsideClick,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

// Función para cerrar el modal de carga
window.SweetAlertProgressClose1 = function () {
    return Swal.close();
}

window.circuleProgressindicatorOpen = function () {
    document.getElementById("idcirlculeprogresindicator").style.display = "flex";
}

window.circuleProgressindicatorClose = function () {
    document.getElementById("idcirlculeprogresindicator").style.display = "none";
}

window.validarcorreoglobal = function (input) {
    let vlidr = false;
    // const correoField = document.getElementById('correo');
    const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!correoRegex.test(input.value.trim())) {
        // correoField.classList.add('input-error'); // Resaltar en rojo
        Swal.fire({
            icon: 'error',
            title: 'Correo inválido',
            text: 'Por favor, ingresa un correo electrónico válido.',
        });
    } else {
        vlidr = true;
        // correoField.classList.remove('input-error');
    }
    return vlidr;
}

window.SweetAlert2 = function (data) {
    const alertData = data[0];

    return Swal.fire({
        icon: alertData.icon || 'info', //'error', 'question'
        title: alertData.title,
        text: alertData.text,
        footer: alertData.footer || '',
        showCancelButton: alertData.showCancelButton || false,
        confirmButtonText: alertData.confirmButtonText || 'Aceptar',
        cancelButtonText: alertData.cancelButtonText || 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        timer: alertData.timer || 0
    });
}

window.mostrarProgresolineal = function (activar) {
    if (activar) {
        document.getElementById("loaderLine").style.display = "block";
    } else {
        document.getElementById("loaderLine").style.display = "none";
    }
}

window.mostrarErrorBoostrap = function (activar, mensaje = "Error Prueba") {
    if (activar) {
        const errorDiv = document.getElementById("errorMensaje");
        errorDiv.textContent = mensaje;
        errorDiv.classList.remove("d-none");
    } else {
        const errorDiv = document.getElementById("errorMensaje");
        errorDiv.classList.add("d-none");
        errorDiv.textContent = "";
    }
}

window.desactivarFormulario = function (form, desactivar) {
    const elementos = form.querySelectorAll("input, button, select, textarea");
    elementos.forEach(el => el.disabled = desactivar);
}
