<?php

namespace QuickUser\Http\Controllers\Auth;

use QuickUser\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    * Handle an authentication attempt.
    *
    * @return Response
    */
    public function login(Request $request)
    {
      dd(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'active' => 1]));
      if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'active' => 1])) {
          // Authentication passed...
          return redirect()->intended($this->redirectTo);
      } else {
        return redirect('/login')->with('auth_error', 'Usuario inactivo');
      }
    }
}
