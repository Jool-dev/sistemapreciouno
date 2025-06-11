<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'codigoproducto' => 'required|string|max:20|unique:productos,codigoproducto',
            'nombre' => 'required|string|max:100',
            'tipoinventario' => 'required|string|in:Tottus Oriente,Tottus',
            'fecharegistro' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'codigoproducto.required' => 'El código del producto es obligatorio.',
            'codigoproducto.unique' => 'Este código de producto ya existe.',
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'tipoinventario.required' => 'El tipo de inventario es obligatorio.',
            'tipoinventario.in' => 'El tipo de inventario debe ser Tottus Oriente o Tottus.',
        ];
    }
}