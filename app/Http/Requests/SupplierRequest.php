<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'name'=>'required',
            'description'=>'required|max:255',
            'adress'=>'required',
            'phone'=> 'required',
            'email'=>'required',
            'image' => 'nullable'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'description.required'=>'La descripcion es obligatoria',
            'adress.required'=>'El la direccion es obligatoria',
            'phone.required'=>'El telefono es obligatorio',
            'email.required'=>'El email es obligatorio',

        ];

    }
}
