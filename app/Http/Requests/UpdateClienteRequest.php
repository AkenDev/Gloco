<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
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
        $clienteId = $this->route('cliente')->idCliente; // Fetch the current cliente's ID

        return [
            'codigoCliente' => "required|unique:clientes,codigoCliente,{$clienteId},idCliente|max:50",
            'depaCliente' => 'required|max:100',
            'nombreCliente' => 'required|max:255',
            'contactoCliente' => 'required|max:255',
            'telCliente' => 'required|max:20',
            'rucCliente' => "required|unique:clientes,rucCliente,{$clienteId},idCliente|max:50",
            'dirCliente' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'codigoCliente.required' => 'Atención: Este campo se dejó vacío. Se recuperó el código anterior',
            'codigoCliente.unique' => 'El código ya está asignado a otro cliente.',
            // Add other custom messages if needed
        ];
    }
}
