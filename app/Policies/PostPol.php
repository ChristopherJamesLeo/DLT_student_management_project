<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPol
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user -> hasPermission("view_resource");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user -> hasPermission("create_resource");
    }

    public function edit(User $user , Post $post): bool {
        return $user -> hasPermission("edit_resource") || $user -> isOwner($post);
    }

    public function show(User $user , Post $post): bool {
        return $user -> hasPermission("view_resource") || $user -> isOwner($post);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        return $user -> hasPermission("edit_resource")  || $user -> isOwner($post);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user -> hasPermission("delete_resource") || $user -> isOwner($post);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        //
    }
}
