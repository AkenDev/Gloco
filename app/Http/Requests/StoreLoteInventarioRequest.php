<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoteInventarioRequest extends FormRequest
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
            'codLote' => 'required|unique:lote_inventarios|max:50',
            'fechaVencimiento' => 'required|date|after:today',
        ];
    }

    public function messages(): array
    {
        return [
            'codLote.required' => 'El código del lote es obligatorio.',
            'codLote.unique' => 'Este código ya está registrado.',
            'codLote.max' => 'El código del lote no puede exceder los 50 caracteres.',
            'fechaVencimiento.required' => 'La fecha de vencimiento es obligatoria.',
            'fechaVencimiento.date' => 'La fecha de vencimiento debe ser una fecha válida.',
            'fechaVencimiento.after' => 'La fecha de vencimiento debe ser posterior a hoy.',
        ];
    }
}
