<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperationsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'description' => 'required|max:255',
          'mount' => 'required|numeric|min:0',
          'type' => 'required',
        ];
    }
    public function messages()
    {
      return [
          'description.required' => 'Usted debe ingresar una descripción',
          'description.max' => 'El maximo es de 255 caracteres',
          'mount.required' => 'Usted debe ingresar un monto',
          'mount.numeric' => 'El monto un numero',
          'mount.min' => 'El monto minimo es 0',
          'type.required' => 'Usted debe ingresar un tipo de operación'
      ];
    }
}
