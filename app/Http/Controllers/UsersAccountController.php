<?php

namespace QuickUser\Http\Controllers;

use Illuminate\Http\Request;
use QuickUser\User;

class UsersAccountController extends Controller
{
  public function verify($token){
    $user = User::where('email_verification_token', $token)->first();

    if (is_null($user)) {
      return redirect('/')->with('message', 'El link de confirmación ha expirado.');
    }

    $user->verify_email();

    return redirect('/login')->with('verification_message', 'Tu cuenta ha sido verificada!');
  }
}
