<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CategoryTranslations;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryTranslationsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the categoryTranslations can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the categoryTranslations can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CategoryTranslations  $model
     * @return mixed
     */
    public function view(User $user, CategoryTranslations $model)
    {
        return true;
    }

    /**
     * Determine whether the categoryTranslations can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the categoryTranslations can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CategoryTranslations  $model
     * @return mixed
     */
    public function update(User $user, CategoryTranslations $model)
    {
        return true;
    }

    /**
     * Determine whether the categoryTranslations can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CategoryTranslations  $model
     * @return mixed
     */
    public function delete(User $user, CategoryTranslations $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CategoryTranslations  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the categoryTranslations can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CategoryTranslations  $model
     * @return mixed
     */
    public function restore(User $user, CategoryTranslations $model)
    {
        return false;
    }

    /**
     * Determine whether the categoryTranslations can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CategoryTranslations  $model
     * @return mixed
     */
    public function forceDelete(User $user, CategoryTranslations $model)
    {
        return false;
    }
}
