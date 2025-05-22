//console.log('✅ appusuarios.js cargado correctamente');

import $ from 'jquery';
import Swal from "sweetalert2";


document.addEventListener('livewire:init', () => {
    Livewire.on('usuarioGuardado', () => {
        Swal.fire({
            icon: 'success',
            title: 'Usuario creado',
            text: 'El usuario ha sido registrado correctamente.',
            timer: 2000,
            showConfirmButton: false
        });
        $('#modalUsuario').modal('hide');
    });

    Livewire.on('usuarioEditado', () => {
        Swal.fire({
            icon: 'info',
            title: 'Usuario actualizado',
            text: 'El usuario ha sido modificado.',
            timer: 2000,
            showConfirmButton: false
        });
        $('#modalUsuario').modal('hide');
    });

    Livewire.on('usuarioEliminado', () => {
        Swal.fire({
            icon: 'warning',
            title: 'Usuario eliminado',
            text: 'El usuario fue eliminado correctamente.',
            timer: 2000,
            showConfirmButton: false
        });
    });

    Livewire.on('usuarioNoEliminado', data => {
        Swal.fire({
            icon: 'error',
            title: 'Acción bloqueada',
            text: data.message || 'No puedes eliminar al último usuario con ese rol.',
            timer: 2500,
            showConfirmButton: false
        });
    });

    Livewire.on('usuarioNoEditado', data => {
        Swal.fire({
            icon: 'error',
            title: 'Cambio no permitido',
            text: data.message || 'No puedes cambiar el rol del último usuario con ese rol.',
            timer: 2500,
            showConfirmButton: false
        });
        $('#modalUsuario').modal('hide');
    });

});
