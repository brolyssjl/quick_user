<?php

namespace QuickUser\Http\Controllers\Auth;

use QuickUser\User;
use QuickUser\Http\Controllers\Controller;
use QuickUser\Notifications\UserRegistered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],[
          'name.required' => 'El nombre no puede estar vacío',
          'name.max' => 'El nombre no puede tener más de 255 caracteres',
          'email.required' => 'El email no puede estar vacío',
          'email.email' => 'El email ingresado no es válido',
          'email.max' => 'El email no puede ser mayor a 255 caracteres.',
          'email.unique' => 'El email ingresado ya existe',
          'password.required' => 'La contraseña no puede ser vacía',
          'password.min' => 'Las contraseña debe ser de mínimo 6 caracteres.',
          'password.confirmed' => 'Las contraseña no coincide'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \QuickUser\User
     */
    protected function create(array $data)
    {
      $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'phone_number' => $data['phone_number'],
        'password' => bcrypt($data['password']),
        'role_id' => 3,
        'email_verification_token' => str_random(60)
      ]);

      $user->notify(new UserRegistered($user, $data['password']));

      return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $this->create($request->all());

        return redirect('/')->with('message', 'Hemos enviado un correo a tu dirección de Email para que verifiques tu cuenta.');
    }
}
