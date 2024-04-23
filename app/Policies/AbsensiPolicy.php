<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Absensi;
use Illuminate\Auth\Access\HandlesAuthorization;

class AbsensiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the absensi can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list absensis');
    }

    /**
     * Determine whether the absensi can view the model.
     */
    public function view(User $user, Absensi $model): bool
    {
        return $user->hasPermissionTo('view absensis');
    }

    /**
     * Determine whether the absensi can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create absensis');
    }

    /**
     * Determine whether the absensi can update the model.
     */
    public function update(User $user, Absensi $model): bool
    {
        return $user->hasPermissionTo('update absensis');
    }

    /**
     * Determine whether the absensi can delete the model.
     */
    public function delete(User $user, Absensi $model): bool
    {
        return $user->hasPermissionTo('delete absensis');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete absensis');
    }

    /**
     * Determine whether the absensi can restore the model.
     */
    public function restore(User $user, Absensi $model): bool
    {
        return false;
    }

    /**
     * Determine whether the absensi can permanently delete the model.
     */
    public function forceDelete(User $user, Absensi $model): bool
    {
        return false;
    }
}
