@extends('intranet.layout')

@section('title', 'Usuarios')

@section('content')
    <div class="container-fluid py-2">
        <!-- Título -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Usuarios</h3>
        </div>

        <!-- Componente Livewire -->
        @livewire('usuarios.usuarios')
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            window.livewire.on('closeModal', () => {
                // Aquí puedes agregar lógica para cerrar modales si usas alguno
            });
        });
    </script>
@endpush