<?php

namespace QuickUser\Http\Controllers;

use Socialite;
use Illuminate\Http\Request;
use QuickUser\User;
use QuickUser\SocialProfile;
use QuickUser\Notifications\UserFacebookRegistered;

class SocialAuthController extends Controller
{
  public function facebook(){
    return Socialite::driver('facebook')->redirect();
  }

  public function callback(){
    $user = Socialite::driver('facebook')->user();

    $existing = User::whereHas('social_profiles', function($query) use ($user){
      $query->where('social_id', $user->id);
    })->first();

    if($existing !== null){
      auth()->login($existing);

      return redirect('/home');
    }

    session()->flash('facebook_user', $user);

    return view('users.facebook', ['user' => $user]);
  }

  public function register(Request $request){
    $data = session('facebook_user');

    $existing_user = User::where('email', $data->email)->first();

    if($existing_user !== null){
      auth()->login($existing_user);

      $this->generate_social_profile($existing_user, $data);

      return redirect('/home');
    }

    $user = User::create([
      'name' => $data->name,
      'email' => $data->email,
      'phone_number' => $request->input('phone_number'),
      'role_id' => 3,
      'password' => bcrypt(str_random(10)),
      'email_verification_token' => str_random(60)
    ]);

    $this->generate_social_profile($user, $data);

    $user->notify(new UserFacebookRegistered($user));

    return redirect('/')->with('message', 'Hemos enviado un correo a tu dirección de Email para que verifiques tu cuenta.');
  }

  private function generate_social_profile(User $user, $social_data){
    $profile = SocialProfile::create([
      'social_id' => $social_data->id,
      'user_id' => $user->id
    ]);
  }
}
