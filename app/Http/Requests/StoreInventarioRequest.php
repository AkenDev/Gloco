<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'codInventario' => 'required|unique:inventarios|max:50',
            'codProveedor' => 'required|max:50',
            'descrInventario' => 'required|max:255',
            'unidadInventario' => 'required|max:50',
            'precioDolarInventario' => 'required|numeric|min:0|max:9999999.99',
            'precioCordInventario' => 'required|numeric|min:0|max:9999999.99',
            'lotes.*.idLote' => 'required|exists:lote_inventarios,idLote',
            'lotes.*.stockPorLote' => 'required|integer|min:0|max:99999',
            'lotes' => 'array', // Ensure lotes is an array
        ];
    }

        public function messages(): array
    {
        return [
            'lotes.array' => 'Valor no valido para lotes. Por favor contacte a soporte',
            'lotes.*.idLote.required' => 'Debe seleccionar un lote',
            'lotes.*.idLote.exists' => 'El lote seleccionado no es válido.',

            'codInventario.required' => 'El código del inventario es obligatorio.',
            'codInventario.unique' => 'Este código de inventario ya está registrado.',
            'codInventario.max' => 'El código del inventario no puede exceder los 50 caracteres.',

            'codProveedor.required' => 'El código del proveedor es obligatorio.',
            'codProveedor.max' => 'El código del proveedor no puede exceder los 50 caracteres.',

            'descrInventario.required' => 'La descripción del inventario es obligatoria.',
            'descrInventario.max' => 'La descripción del inventario no puede exceder los 255 caracteres.',

            'unidadInventario.required' => 'La unidad del inventario es obligatoria.',
            'unidadInventario.max' => 'La unidad del inventario no puede exceder los 50 caracteres.',
            
            'precioDolarInventario.max' => 'El precio en dólares no puede exceder 9,999,999.99.',
            'precioDolarInventario.required' => 'El precio en dólares es obligatorio.',
            'precioDolarInventario.numeric' => 'El precio en dólares debe ser un valor numérico.',
            'precioDolarInventario.min' => 'El precio en dólares debe ser mayor o igual a 0.',

            'precioCordInventario.max' => 'El precio en córdobas no puede exceder 9,999,999.99.',
            'precioCordInventario.required' => 'El precio en córdobas es obligatorio.',
            'precioCordInventario.numeric' => 'El precio en córdobas debe ser un valor numérico.',
            'precioCordInventario.min' => 'El precio en córdobas debe ser mayor o igual a 0.',

            'lotes.*.stockPorLote.required' => 'El stock de este lote es obligatorio.',
            'lotes.*.stockPorLote.integer' => 'El stock de este lote debe ser un número entero.',
            'lotes.*.stockPorLote.min' => 'El stock de este lote no puede ser negativo.',
            'lotes.*.stockPorLote.max' => 'El stock de este lote no puede exceder 99,999.',
        ];
    }                                                                                                                                                                      
}
