<?php

namespace App\Policies;

use App\Models\User;
use App\Models\GearReply;
use Illuminate\Auth\Access\HandlesAuthorization;

class GearReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function delete(User $user, GearReply $reply)
    {
        return $user->id === $reply->user_id;
    }
}
