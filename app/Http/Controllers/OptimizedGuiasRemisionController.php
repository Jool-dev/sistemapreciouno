<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuiaRemisionRequest;
use App\Http\Resources\GuiaRemisionResource;
use App\Services\GuiaRemisionService;
use App\Models\Guiasderemision;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OptimizedGuiasRemisionController extends Controller
{
    public function __construct(
        private GuiaRemisionService $guiaService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $guias = Guiasderemision::with(['conductor', 'tipoempresa'])
            ->when($request->search, function ($query, $search) {
                $query->where('codigoguia', 'like', "%{$search}%")
                      ->orWhere('razonsocialguia', 'like', "%{$search}%");
            })
            ->when($request->estado, function ($query, $estado) {
                $query->where('estado', $estado);
            })
            ->orderBy('fechaemision', 'desc')
            ->paginate($request->per_page ?? 15);

        return response()->json([
            'success' => true,
            'data' => GuiaRemisionResource::collection($guias),
            'meta' => [
                'current_page' => $guias->currentPage(),
                'total' => $guias->total(),
                'per_page' => $guias->perPage(),
            ]
        ]);
    }

    public function store(StoreGuiaRemisionRequest $request): JsonResponse
    {
        try {
            $guia = $this->guiaService->createGuiaWithProducts(
                $request->validated(),
                $request->productos
            );

            return response()->json([
                'success' => true,
                'message' => 'Guía de remisión creada exitosamente',
                'data' => new GuiaRemisionResource($guia)
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la guía de remisión',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}