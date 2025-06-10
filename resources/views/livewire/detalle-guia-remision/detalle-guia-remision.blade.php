<div class="container-fluid py-4">
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white py-3">
            <h4 class="mb-0"><i class="fas fa-file-invoice me-2"></i>Detalle de Guía de Remisión</h4>
        </div>

        <div class="card-body">
            <!-- Datos principales de la guía -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <h5 class="fw-bold">Información Básica</h5>
                    <p><strong>Código:</strong></p>
                    <p><strong>Fecha:</strong></p>
                    <p><strong>Hora:</strong></p>
                </div>

                <div class="col-md-4">
                    <h5 class="fw-bold">Empresa</h5>
                    <p><strong>Razón Social:</strong></p>
                    <p><strong>TIM:</strong></p>
                    <p><strong>Tipo Empresa:</strong></p>
                </div>

                <div class="col-md-4">
                    <h5 class="fw-bold">Transporte</h5>
                    <p><strong>Conductor:</strong></p>
                    <p><strong>Motivo:</strong></p>
                    <p><strong>Estado:</strong> <span class="badge bg-info"></span></p>
                </div>
            </div>

            <!-- Lista de productos -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white py-2">
                    <h5 class="mb-0"><i class="fas fa-boxes me-2"></i>Productos en la Guía</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>CÓDIGO</th>
                                    <th>NOMBRE PRODUCTO</th>
                                    <th>CANTIDAD</th>
                                    <th>PESO UNITARIO (kg)</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--                            agregar productos --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Formulario para agregar productos -->
            <div class="card">
                <div class="card-header bg-warning text-dark py-2">
                    <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Agregar Productos</h5>
                </div>
                <div class="card-body">
                    <form id="formAgregarProducto" class="row g-3 align-items-end">
                        @csrf
                        <input type="hidden" name="idguia" value="#">

                        <div class="col-md-3">
                            <label for="codigoProducto" class="form-label">Código</label>
                            <input type="text" class="form-control" id="codigoProducto" name="codigo" required>
                        </div>

                        <div class="col-md-4">
                            <label for="nombreProducto" class="form-label">Nombre Producto</label>
                            <input type="text" class="form-control" id="nombreProducto" name="nombre" required>
                        </div>

                        <div class="col-md-2">
                            <label for="cantidadProducto" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="cantidadProducto" name="cantidad"
                                min="1" required>
                        </div>

                        <div class="col-md-2">
                            <label for="pesoProducto" class="form-label">Peso (kg)</label>
                            <input type="number" step="0.01" class="form-control" id="pesoProducto"
                                name="peso_unitario" required>
                        </div>

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-plus me-1"></i> Agregar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Resumen y acciones -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card border-info">
                        <div class="card-header bg-info text-white py-2">
                            <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Resumen</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Total Productos:</strong></p>
                            <p><strong>Peso Total:</strong></p>
                            <p><strong>Volumen Total:</strong></p>
                            <p><strong>Bultos/Pallets:</strong></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-secondary">
                        <div class="card-header bg-secondary text-white py-2">
                            <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Acciones</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-success me-md-2" type="button">
                                    <i class="fas fa-check-circle me-1"></i> Confirmar
                                </button>
                                <button class="btn btn-danger" type="button">
                                    <i class="fas fa-times-circle me-1"></i> Rechazar
                                </button>
                                <a href="#" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-left me-1"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
