<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
    /**
     * Tentukan apakah user boleh mengupdate post.
     */
    public function update(User $user, object $post): bool
    {
        return $user->id === (int) $post->user_id;
    }
}
