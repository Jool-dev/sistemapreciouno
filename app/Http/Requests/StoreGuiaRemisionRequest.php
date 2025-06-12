<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuiaRemisionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'codigoguia' => 'required|string|max:20|unique:guiaremision,codigoguia',
            'fechaemision' => 'required|date',
            'horaemision' => 'required|date_format:H:i:s',
            'razonsocialguia' => 'required|string|max:100',
            'numerotrasladotim' => 'required|string|max:20',
            'motivotraslado' => 'required|string|max:100',
            'pesobrutototal' => 'required|numeric|min:0',
            'volumenproducto' => 'required|numeric|min:0',
            'numerobultopallet' => 'required|integer|min:1',
            'observaciones' => 'nullable|string|max:255',
            'idconductor' => 'required|exists:conductores,idconductor',
            'idtipoempresa' => 'required|exists:tipoempresa,idtipoempresa',
            'productos' => 'required|array|min:1',
            'productos.*.idproducto' => 'required|exists:productos,idproducto',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.estado' => 'required|in:Bueno,Regular,Dañado',
        ];
    }

    public function messages(): array
    {
        return [
            'codigoguia.required' => 'El código de guía es obligatorio.',
            'codigoguia.unique' => 'Este código de guía ya existe.',
            'productos.required' => 'Debe agregar al menos un producto.',
            'productos.min' => 'Debe agregar al menos un producto.',
            'productos.*.idproducto.exists' => 'El producto seleccionado no existe.',
            'productos.*.cantidad.min' => 'La cantidad debe ser mayor a 0.',
        ];
    }
}