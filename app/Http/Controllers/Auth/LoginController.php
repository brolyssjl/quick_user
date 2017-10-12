<?php

namespace QuickUser\Http\Controllers\Auth;

use QuickUser\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get a validator for an incoming login request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
      return Validator::make($request->all(), [
          'email' => 'required|email',
          'password' => 'required',
      ],[
        'email.required' => 'El campo de email es obligatorio',
        'email.email' => 'El email parace mal escrito',
        'password.required' => 'La contraseña es obligatoria, no puede ir vacía'
      ])->validate();
    }

    /**
    * Handle an authentication attempt.
    *
    * @return Response
    */
    public function login(Request $request)
    {
      if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'active' => 1])) {
          // Authentication passed...
          return redirect()->intended($this->redirectTo);
      } else {
        return redirect('/login')->with('auth_error', 'El usuario está inactivo o no existe!');
      }
    }
}
