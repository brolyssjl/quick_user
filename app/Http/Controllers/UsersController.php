<?php

namespace QuickUser\Http\Controllers;

use Illuminate\Http\Request;
use QuickUser\Http\Requests\CreateUserRequest;
use QuickUser\Http\Requests\UpdateUserRequest;
use QuickUser\Notifications\AdminUserCreated;
use QuickUser\User;
use QuickUser\Role;

class UsersController extends Controller
{
  public function index()
  {
    $this->authorize('access_users_list', User::class);
    $users = User::orderBy('created_at', 'desc')->paginate(10);
    return view('users.index', [ 'users' => $users ]);
  }

  public function profile(User $user)
  {
    $this->authorize('update', [User::class, $user]);
    return view('users.edit', [ 'user' => $user, 'roles' => $this->get_all_roles() ]);
  }

  public function create()
  {
    $this->authorize('create', User::class);
    return view('users.new', [ 'roles' => $this->get_all_roles() ]);
  }

  public function save(CreateUserRequest $request)
  {
    $this->authorize('create', User::class);

    $pass = $this->get_password($request);
    $user = User::create([
      'name' => $request->input('name'),
      'phone_number' => $request->input('phone_number'),
      'email' => $request->input('email'),
      'password' => bcrypt($pass),
      'role_id' => $request->input('role_id', 3)
    ]);

    $user->notify(new AdminUserCreated($user, $pass));

    return redirect()->route('active_user', $user->id);
  }

  public function edit(User $user)
  {
    $this->authorize('update', [User::class, $user]);
    return view('users.edit', [ 'user' => $user, 'roles' => $this->get_all_roles() ]);
  }

  public function update(User $user, UpdateUserRequest $request)
  {
    $this->authorize('update', [User::class, $user]);
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
    $this->authorize('delete', User::class);
    $user->delete();
    return redirect()->route('users_path')->withSuccess('Usuario eliminado correctamente!!');
  }

  public function active_user(User $user)
  {
    $this->authorize('active_user', User::class);
    $user->active = 1;
    $user->save();

    return redirect()->route('edit_user_path', $user->id);
  }

  public function disable_user(User $user)
  {
    $this->authorize('disable_user', User::class);
    $user->active = 0;
    $user->save();

    if($user->verify_if_current_user_account_is_disabled())
    {
      auth()->logout();
      return redirect('/');
    }

    return redirect()->route('edit_user_path', $user->id);
  }

  private function get_password(CreateUserRequest $request){
    $password = $request->input('password');
    if($request->has('check_random_pass')){
      $password = str_random(10);
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
