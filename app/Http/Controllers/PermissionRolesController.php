<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\Permission;

class PermissionRolesController extends Controller
{
    public function index(){
        $permissionroles = PermissionRole::paginate(10);
        $roles = Role::all();
        $permissions = Permission::all();
        return view("permissionroles.index",compact("permissionroles","roles","permissions"));
    }

    public function store(Request $request){

        $this->validate($request,[
            "role_id" => "required|exists:roles,id",
            "permission_id" => "required|array",
            "permission_id.*" => "exists:permissions,id", // array ဖြစ်နေပါက .* ကိုသုံးပြိ ထပ်စစ်ပေးရမည် 
        ]);


        $role = Role::findOrFail($request["role_id"]);

        $role -> permissions() -> sync($request["permission_id"]); // sync ကိုသုံးပြီး permission ကို နဂိုရှိနေပြီးသားဆို ထပ်မထည့်ဘူး မရှိရင် ထပ်ထည့်မည် 



        return redirect()->back();
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            "role_id" => "required",
            "permission_id" => "required",
        ]);

        $permissionrole = PermissionRole::find($id);
        $permissionrole->role_id = $request->role_id;
        $permissionrole->permission_id = $request->permission_id;
        $permissionrole->save();
        
        return redirect()->back();
    }

    public function destroy($id){
        $permissionrole = PermissionRole::find($id);
        $permissionrole->delete();
        return redirect()->back();
    }

    
}
