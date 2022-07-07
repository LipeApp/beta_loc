<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StoreTranslations;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoreTranslationsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the storeTranslations can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the storeTranslations can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StoreTranslations  $model
     * @return mixed
     */
    public function view(User $user, StoreTranslations $model)
    {
        return true;
    }

    /**
     * Determine whether the storeTranslations can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the storeTranslations can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StoreTranslations  $model
     * @return mixed
     */
    public function update(User $user, StoreTranslations $model)
    {
        return true;
    }

    /**
     * Determine whether the storeTranslations can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StoreTranslations  $model
     * @return mixed
     */
    public function delete(User $user, StoreTranslations $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StoreTranslations  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the storeTranslations can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StoreTranslations  $model
     * @return mixed
     */
    public function restore(User $user, StoreTranslations $model)
    {
        return false;
    }

    /**
     * Determine whether the storeTranslations can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StoreTranslations  $model
     * @return mixed
     */
    public function forceDelete(User $user, StoreTranslations $model)
    {
        return false;
    }
}
