<?php

namespace QuickUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//Pendiente verificar que usuario admin puede actualizar
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
          'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($this->get_user_id()),
          ],
          'password' => 'required_with:confirm_password|same:confirm_password'
        ];
    }

    /**
    * Get the error messages from validation rules
    *
    * @return array
    */
    public function messages()
    {
      return [
        'name.required' => 'El nombre no puede estar vacío',
        'phone_number.required' => 'El teléfono no puede estar vacío',
        'email.required' => 'El email no puede estar vacío',
        'email.email' => 'El email ingresado no es válido',
        'email.unique' => 'El email ingresado ya existe',
        'password.required_with' => 'La contraseña no puede estar vacía',
        'password.same' => 'Las contraseñas no coinciden'
      ];
    }

    /**
    * Gets user id verifying if user id logeed in is equals
    * to user id from request under validation
    *
    * @return user_id
    */
    private function get_user_id()
    {
      if($this->user->id == $this->route()->user->id) return $this->user->id;
      else return $this->route()->user->id;
    }
}
