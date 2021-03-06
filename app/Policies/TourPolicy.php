<?php

namespace App\Policies;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TourPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Tour $tour
     * @return mixed
     */
    public function view(User $user, Tour $tour)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Tour $tour
     * @return mixed
     */
    public function update(User $user, Tour $tour): bool
    {
        return (int)$user->id === (int)$tour->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Tour $tour
     * @return mixed
     */
    public function delete(User $user, Tour $tour)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Tour $tour
     * @return mixed
     */
    public function restore(User $user, Tour $tour)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Tour $tour
     * @return mixed
     */
    public function forceDelete(User $user, Tour $tour)
    {
        //
    }
}
