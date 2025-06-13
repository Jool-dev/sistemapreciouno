@extends('intranet/layout')
@section('title', 'Dashboard')
@section('subtitle', 'Panel de control y estadísticas generales')

@section('content')
    <div class="enable-scroll">
        <!-- Tarjetas de estadísticas principales -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1 fw-bold">{{ $totalGuiasEmitidas ?? 0 }}</h3>
                            <p class="mb-0 opacity-75">Guías Emitidas</p>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-truck fa-2x opacity-75"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 75%"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stats-card success">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1 fw-bold">{{ $totalRevisiones ?? 0 }}</h3>
                            <p class="mb-0 opacity-75">Revisiones Completadas</p>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-check-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 60%"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stats-card warning">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1 fw-bold">{{ $guiasSinDanio ?? 0 }}</h3>
                            <p class="mb-0 opacity-75">Guías Sin Daño</p>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-shield-alt fa-2x opacity-75"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 85%"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stats-card danger">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1 fw-bold">{{ $guiasConDanio ?? 0 }}</h3>
                            <p class="mb-0 opacity-75">Guías Con Daño</p>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-exclamation-triangle fa-2x opacity-75"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 25%"></div>
                    </div>
                </div>
            </div>
        </div>

        @livewire('dashboard.dashboard')
    </div>
@endsection

@section('scripts')
<script>
    // Animación de contadores
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.stats-card h3');
        
        counters.forEach(counter => {
            const target = parseInt(counter.textContent);
            let current = 0;
            const increment = target / 50;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target;
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current);
                }
            }, 30);
        });
    });
</script>
@endsection