<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\neraca;
use App\User;

class NeracaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\neraca  $neraca
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, neraca $neraca)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\neraca  $neraca
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, neraca $neraca)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\neraca  $neraca
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, neraca $neraca)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\neraca  $neraca
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, neraca $neraca)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\neraca  $neraca
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, neraca $neraca)
    {
        //
    }
}
