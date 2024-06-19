<?php

namespace App\Policies;

use App\Models\Gear;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GearPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the gear.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gear  $gear
     * @return mixed
     */
    public function update(User $user, Gear $gear)
    {
        return $user->id === $gear->user_id;
    }

    /**
     * Determine whether the user can delete the gear.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gear  $gear
     * @return mixed
     */
    public function delete(User $user, Gear $gear)
    {
        return $user->id === $gear->user_id;
    }
}
