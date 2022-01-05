<?php

namespace App\Policies;

use App\Models\User;
use App\Models\items;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\items  $items
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, items $items)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
        return $user->role == 2 || $user->role == 1 ;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\items  $items
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, items $items)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\items  $items
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        //
        return $user->role == 1 ;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\items  $items
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, items $items)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\items  $items
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, items $items)
    {
        //
    }
}
