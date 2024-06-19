<?php

namespace App\Policies;

use App\Models\User;
use App\Models\GearComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class GearCommentPolicy
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
    
    
    public function delete(User $user, GearComment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
