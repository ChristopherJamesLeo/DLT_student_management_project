<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Leave;

class LeavePol
{

    // Admin can view all leave data 

    public function viewany(User $user){
        // check if the user has the admin row 
        return $user->hasRole(["Admin","Teacher"]);  
    }


 /**
     * Determine whether the user can view the model.
     */
    public function view(User $user , Leave $leave): bool
    {
        // allow if the user has the required permission or is the owner of the leave. 
        return $user -> hasPermission("view_resource")  || $user -> isOwner($leave); //Owner ဖြစ်သလား Owner နှင့် permission ပေးထားသူဘဲ ကြည့်ခွင့်ရှိမယ်
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user -> hasRole(["Student"]);  // only Student can create Leaev
    }

    public function edit(User $user , Leave $leave): bool {
        // return $user -> hasPermission("edit_resource") || $user -> isOwner($leave);
        // or
        // return $user -> hasPermission("edit_resource") || $leave -> user_id == $user -> id ;
        // or
        // return $leave -> user_id == $user -> id ; // edit only for owner


        // admin နှင့် owner သာ Edit လုပ်နိုင်မည် 
        if($user -> hasRole(["Admin"])){
            return true;
        }
        return $leave -> user_id == $user -> id;
    }

    public function show(User $user , Leave $leave): bool {
        return $user -> hasPermission("view_resource") || $user -> isOwner($leave);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Leave $leave): bool
    {
        // return $user -> hasPermission("edit_resource")  || $user -> isOwner($leave);

          // admin နှင့် owner သာ Update လုပ်နိုင်မည် 
        if($user -> hasRole(["Admin"])){
            return true;
        }
        return $leave -> user_id == $user -> id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Leave $leave): bool
    {

        // return $user -> hasPermission("delete_resource") || $user -> isOwner($leave);

        // admin နှင့် owner သာ Update လုပ်နိုင်မည် 
        if($user -> hasRole(["Admin"])){
            return true;
        }
        return $leave -> user_id == $user -> id;
    }


    
}
