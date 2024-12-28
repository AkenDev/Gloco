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

    public function rules(): array
    {
        //dd($this->request);
        $this->prepareForValidation();        
        return [
            'idCliente' => 'required|exists:clientes,idCliente',
            'fecha' => 'required|date',
            'esDolar' => 'required|boolean',
            'tipoFactura' => 'required|string|in:contado,credito',
            'fechaVence' => 'nullable|required_if:tipoFactura,credito|date|after_or_equal:fecha',
            'detalle_facturas' => 'required|array|min:1',
            'detalle_facturas.*.codInventario' => 'required|exists:inventarios,codInventario',
            'detalle_facturas.*.cantidad' => 'required|integer|min:1',
            'detalle_facturas.*.precioUnitario' => 'required|numeric|min:0',
            'detalle_facturas.*.aplicaIva' => 'nullable|boolean',
        ];
    }

    /**
     * Customize error messages.
     */
    public function messages(): array
    {
        return [
            // Factura validation messages
            'idCliente.required' => 'Debe seleccionar un cliente.',
            'idCliente.exists' => 'El cliente seleccionado no existe.',
            'fecha.required' => 'La fecha de la factura es obligatoria.',
            'fecha.date' => 'La fecha de la factura debe ser una fecha válida.',
            'esDolar.required' => 'Debe especificar si la factura es en córdobas o dólares.',
            'esDolar.boolean' => 'El formato de moneda seleccionado no es válido.',
            'tipoFactura.required' => 'El tipo de factura es obligatorio.',
            'tipoFactura.in' => 'El tipo de factura seleccionado no es válido.',
            'fechaVence.required_if' => 'La fecha de vencimiento es obligatoria para facturas de crédito.',
            'fechaVence.date' => 'La fecha de vencimiento debe ser una fecha válida.',
            'fechaVence.after_or_equal' => 'La fecha de vencimiento debe ser igual o posterior a la fecha de la factura.',
    
            // Detalle_Facturas validation messages
            'detalle_facturas.required' => 'Debe incluir al menos un producto en la factura.',
            'detalle_facturas.array' => 'Los detalles de la factura deben estar en un formato válido.',
            'detalle_facturas.min' => 'Debe agregar al menos un producto a la factura.',
            'detalle_facturas.*.codInventario.required' => 'El código del producto es obligatorio.',
            'detalle_facturas.*.codInventario.exists' => 'El producto seleccionado no existe en el inventario.',
            'detalle_facturas.*.cantidad.required' => 'La cantidad es obligatoria.',
            'detalle_facturas.*.cantidad.integer' => 'La cantidad debe ser un número entero.',
            'detalle_facturas.*.cantidad.min' => 'La cantidad debe ser al menos 1.',
            'detalle_facturas.*.precioUnitario.required' => 'El precio unitario es obligatorio.',
            'detalle_facturas.*.precioUnitario.numeric' => 'El precio unitario debe ser un número válido.',
            'detalle_facturas.*.precioUnitario.min' => 'El precio unitario no puede ser negativo.',
            'detalle_facturas.*.aplicaIva.boolean' => 'El valor de IVA debe ser verdadero o falso.',
        ];
    }

    protected function prepareForValidation()
    {
        $detalleFacturas = $this->input('detalle_facturas', []);

        foreach ($detalleFacturas as $index => $detalle) {
            // Ensure aplicaIva is a boolean
            $detalleFacturas[$index]['aplicaIva'] = isset($detalle['aplicaIva']) && $detalle['aplicaIva'] == '1';
        }

        $this->merge([
            'detalle_facturas' => $detalleFacturas,
        ]);
    }
    
}
