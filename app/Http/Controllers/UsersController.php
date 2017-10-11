<?php

namespace QuickUser\Http\Controllers;

use Illuminate\Http\Request;
use QuickUser\Http\Requests\CreateUserRequest;
use QuickUser\Http\Requests\UpdateUserRequest;
use QuickUser\User;
use QuickUser\Role;

class UsersController extends Controller
{
  public function index()
  {
    $users = User::orderBy('created_at', 'desc')->paginate(10);
    return view('users.index', [ 'users' => $users ]);
  }

  public function profile(User $user)
  {
    return view('users.edit', [ 'user' => $user, 'roles' => $this->get_all_roles() ]);
  }

  public function create()
  {
    return view('users.new', [ 'roles' => $this->get_all_roles() ]);
  }

  public function save(CreateUserRequest $request)
  {
    $user = User::create([
      'name' => $request->input('name'),
      'phone_number' => $request->input('phone_number'),
      'email' => $request->input('email'),
      'password' => $this->get_password($request),
      'role_id' => $request->input('role_id', 3)
    ]);

    return redirect()->route('users_path')->withSuccess('Usuario creado satisfactoriamente!!');
  }

  public function edit(User $user)
  {
    return view('users.edit', [ 'user' => $user, 'roles' => $this->get_all_roles() ]);
  }

  public function update(User $user, UpdateUserRequest $request)
  {
    $user->update([
      'name' => $request->input('name'),
      'phone_number' => $request->input('phone_number'),
      'email' => $request->input('email'),
      'role_id' => $request->input('role_id')
    ]);
    $this->update_password($user, $request);

    return redirect()->route('edit_user_path', $user->id);
  }

  public function delete(User $user)
  {
    $user->delete();
    return redirect()->route('users_path')->withSuccess('Usuario eliminado correctamente!!');
  }

  public function active_user(User $user)
  {
    $user->actived = 1;
    $user->save();
    return redirect()->route('edit_user_path', $user->id);
  }

  public function disable_user(User $user)
  {
    $user->actived = 0;
    $user->save();
    return redirect()->route('edit_user_path', $user->id);
  }

  private function get_password(CreateUserRequest $request){
    $password = bcrypt($request->input('password'));
    if($request->has('check_random_pass')){
      $password = bcrypt(str_random(10));
    }

    return $password;
  }

  private function update_password(User $user, UpdateUserRequest $request){
    if($request->input('password') != null){
      $user->update([
        'password' => bcrypt($request->input('password'))
      ]);
    }
  }

  private function get_all_roles(){
    return Role::all();
  }

}
