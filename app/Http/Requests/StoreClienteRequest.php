<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
            'codigoCliente' => 'nullable|unique:clientes,codigoCliente|max:50',
            'depaCliente' => 'required|max:100',
            'nombreCliente' => 'required|max:255',
            'contactoCliente' => 'required|max:255',
            'telCliente' => 'required|max:20',
            'rucCliente' => 'required|unique:clientes,rucCliente|max:50',
            'dirCliente' => 'required|max:255',
        ];
    }
}
