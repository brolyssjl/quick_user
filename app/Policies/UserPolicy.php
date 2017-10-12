<?php

namespace QuickUser\Policies;

use QuickUser\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param  \QuickUser\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      return $user->is_admin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \QuickUser\User  $user
     * @param  \QuickUser\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
      return $user->is_admin() || $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \QuickUser\User  $user
     * @param  \QuickUser\User  $model
     * @return mixed
     */
    public function delete(User $user)
    {
      return $user->is_admin();
    }

    /**
     * Determine whether the user can active users
     *
     * @param  \QuickUser\User  $user
     * @return mixed
     */
    public function active_user(User $user)
    {
      return $user->is_admin();
    }

    /**
     * Determine whether the user can disable users
     *
     * @param  \QuickUser\User  $user
     * @return mixed
     */
    public function disable_user(User $user)
    {
      return $user->is_admin();
    }

    /**
     * Determine whether the user can view users list
     *
     * @param  \QuickUser\User  $user
     * @return mixed
     */
    public function access_users_list(User $user)
    {
      return $user->is_admin() || $user->is_agent();
    }
}
