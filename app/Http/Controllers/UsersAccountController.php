<?php

namespace QuickUser\Http\Controllers;

use Illuminate\Http\Request;
use QuickUser\User;

class UsersAccountController extends Controller
{
  /**
  * Verifies user account by email_verification_token param.
  * If does not find a user redirects to root path with error message.
  * If finds a user updates email_verification_token and active fields from User model in verify_email function
  *
  * @param String $token
  * @return Response redirect
  */
  public function verify($token){
    $user = User::where('email_verification_token', $token)->first();

    if (is_null($user)) {
      return redirect('/')->with('message', 'El link de confirmación ha expirado.');
    }

    $user->verify_email();

    return redirect('/login')->with('verification_message', 'Tu cuenta ha sido verificada!');
  }
}
