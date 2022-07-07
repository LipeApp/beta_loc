<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductTranslations;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductTranslationsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the productTranslations can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the productTranslations can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductTranslations  $model
     * @return mixed
     */
    public function view(User $user, ProductTranslations $model)
    {
        return true;
    }

    /**
     * Determine whether the productTranslations can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the productTranslations can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductTranslations  $model
     * @return mixed
     */
    public function update(User $user, ProductTranslations $model)
    {
        return true;
    }

    /**
     * Determine whether the productTranslations can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductTranslations  $model
     * @return mixed
     */
    public function delete(User $user, ProductTranslations $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductTranslations  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the productTranslations can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductTranslations  $model
     * @return mixed
     */
    public function restore(User $user, ProductTranslations $model)
    {
        return false;
    }

    /**
     * Determine whether the productTranslations can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductTranslations  $model
     * @return mixed
     */
    public function forceDelete(User $user, ProductTranslations $model)
    {
        return false;
    }
}
