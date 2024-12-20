<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacturaRequest extends FormRequest
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
            'idCliente' => 'required|exists:clientes,idCliente',
            'fecha' => 'required|date',
            'esDolar' => 'required|boolean',
            'totalSubtotal' => 'required|numeric|min:0',
            'ivaAplicado' => 'required|numeric|min:0',
            'fechaVence' => 'required|date|after_or_equal:fecha',
            'tipoFactura' => 'required|string|max:50',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'idCliente.required' => 'El cliente es obligatorio.',
            'idCliente.exists' => 'El cliente seleccionado no existe.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'esDolar.required' => 'Debe seleccionar una moneda.',
            'totalSubtotal.required' => 'El subtotal es obligatorio.',
            'totalSubtotal.numeric' => 'El subtotal debe ser un número.',
            'ivaAplicado.required' => 'El IVA es obligatorio.',
            'fechaVence.required' => 'La fecha de vencimiento es obligatoria.',
            'fechaVence.date' => 'La fecha de vencimiento debe ser válida.',
            'fechaVence.after_or_equal' => 'La fecha de vencimiento debe ser igual o posterior a la fecha.',
            'tipoFactura.required' => 'El tipo de factura es obligatorio.',
        ];
    }
}
