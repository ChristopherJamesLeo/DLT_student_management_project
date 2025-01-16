<?php

namespace App\Policies;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Auth\Access\Response;

// php artisan make:policy AnnouncementPol --model=Announcement

class AnnouncementPol
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user -> hasPermission("view_resource");
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        // return $uesr -> hasPermission("view_resource") || $user -> id === $announcement -> user_id; 
        return $user -> hasPermission("view_resource");  // Model ထဲမှာ isOwner အား ဖန်တီးပေးရမယ်
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool  // create function သက်ဆိုင်ရာ controller ထဲတွင့် $this -> authorize ("methodname",modelname::class) အား authorize ထဲတွင် string type ဖြင့်ထည့်ပေးရမယ် second parameter ကို model အား ထည့်ပေးရမယ်
    {
        // return $uesr -> hasPermission("create_resource") || $user -> id === $announcement -> user_id; 
        return $user -> hasPermission("create_resource");  // Model ထဲမှာ isOwner အား ဖန်တီးပေးရမယ်
    }

    /**
     * Determine whether the user can update the model.
     */
    public function edit(User $user, Announcement $announcement): bool
    {
        // return $uesr -> hasPermission("edit_resource") || $user -> id === $announcement -> user_id; 
        return $user -> hasPermission("edit_resource") || $user -> isOwner($announcement);  // Model ထဲမှာ isOwner အား ဖန်တီးပေးရမယ်
    }

    public function update(User $user, Announcement $announcement): bool
    {
        // return $uesr -> hasPermission("edit_resource") || $user -> id === $announcement -> user_id; 
        return $user -> hasPermission("update_resource") || $user -> isOwner($announcement);  // Model ထဲမှာ isOwner အား ဖန်တီးပေးရမယ်
    }



    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Announcement $announcement): bool
    {
        // return $uesr -> hasPermission("delete_resource") || $user -> id === $announcement -> user_id; 
        return $user -> hasPermission("delete_resource") || $user -> isOwner($announcement);  // Model ထဲမှာ isOwner အား ဖန်တီးပေးရမယ်
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Announcement $announcement): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Announcement $announcement): bool
    // {
    //     //
    // }
}
