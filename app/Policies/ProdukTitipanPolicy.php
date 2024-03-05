<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProdukTitipan;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProdukTitipanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the produkTitipan can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list produktitipans');
    }

    /**
     * Determine whether the produkTitipan can view the model.
     */
    public function view(User $user, ProdukTitipan $model): bool
    {
        return $user->hasPermissionTo('view produktitipans');
    }

    /**
     * Determine whether the produkTitipan can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create produktitipans');
    }

    /**
     * Determine whether the produkTitipan can update the model.
     */
    public function update(User $user, ProdukTitipan $model): bool
    {
        return $user->hasPermissionTo('update produktitipans');
    }

    /**
     * Determine whether the produkTitipan can delete the model.
     */
    public function delete(User $user, ProdukTitipan $model): bool
    {
        return $user->hasPermissionTo('delete produktitipans');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete produktitipans');
    }

    /**
     * Determine whether the produkTitipan can restore the model.
     */
    public function restore(User $user, ProdukTitipan $model): bool
    {
        return false;
    }

    /**
     * Determine whether the produkTitipan can permanently delete the model.
     */
    public function forceDelete(User $user, ProdukTitipan $model): bool
    {
        return false;
    }
}
