<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if (request()->isMethod("POST")) {
            return [
                'name' => 'required',
                'description' => 'required|max:255',
                'stock' => 'required|integer',
                'unit_price' => 'required|integer',
                'category' => 'required',
                'id_supplier' => 'required',
                'due_date' => 'required|date',
                'image' => 'nullable'
            ];
        } elseif (request()->isMethod('put')) {
            return [
                'name' => 'required',
                'description' => 'required|max:255',
                'stock' => 'required|integer',
                'unit_price' => 'required|integer',
                'category' => 'required',
                'id_supplier' => 'required',
                'due_date' => 'required|date',
                'image' => 'nullable'
            ];
        }else{
            return [
                'name'=>'required',
                'description'=>'required|max:255',
                'stock'=>'required|integer',
                'unit_price'=> 'required|integer',
                'category'=>'required',
                'id_supplier'=>'required',
                'due_date'=>'required|date',
                'image' => 'nullable'
            ];

        }



    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'description.required' => 'La descripcion es obligatoria',
            'stock.required' => 'La cantidad en stock es obligatoria',
            'stock.integer' => 'Stock debe ser un numero entero',
            'unit_price.required' => 'El precio unitario es obligatorio',
            'unit_price.integer' => 'El precio unitario debe ser un numero entero',
            'category.required' => 'La categoria es obligatoria',
            'id_supplier.required' => 'El proveedor es obligatorio',
            'due_date.required' => 'La fecha de vencimiento es obligatoria',

        ];

    }

    public function attributes(){
        return [
            'name'=>'required',
            'description'=>'required|max:255',
            'stock'=>'required|integer',
            'unit_price'=> 'required|integer',
            'category'=>'required',
            'id_supplier'=>'required',
            'due_date'=>'required|date',
            'image' => 'nullable'
        ];
    }
}
