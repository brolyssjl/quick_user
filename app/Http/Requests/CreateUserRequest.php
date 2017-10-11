<?php

namespace QuickUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      return true; //Pendiente verificar que el role sea admin
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'name' => 'required',
        'phone_number' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required_unless:check_random_pass,1|same:confirm_password'
      ];
    }

    public function messages()
    {
      return [
        'name.required' => 'El nombre no puede estar vacío',
        'phone_number.required' => 'El teléfono no puede estar vacío',
        'email.required' => 'El email no puede estar vacío',
        'email.email' => 'El email ingresado no es válido',
        'email.unique' => 'El email ingresado ya existe',
        'password.required_unless' => 'La contraseña no puede ser vacía si no seleccionó contraseña aleatoria',
        'password.same' => 'Las contraseñas no coinciden'
      ];
    }
}
