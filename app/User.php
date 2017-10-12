<?php

namespace QuickUser;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'role_id', 'email_verification_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verification_token',
    ];

    public function role()
    {
      return $this->belongsTo(Role::class);
    }

    public function social_profiles()
    {
      return $this->hasMany(SocialProfile::class);
    }

    public function is_admin()
    {
      return $this->role_id === 1;
    }

    public function is_agent()
    {
      return $this->role_id == 2;
    }

    public function verify_email()
    {
      $this->email_verification_token = null;
      $this->active = 1;
      $this->save();

      return $this;
    }

    public function verify_if_current_user_account_is_disabled(){
      return $this->id === auth()->user()->id;
    }
}
