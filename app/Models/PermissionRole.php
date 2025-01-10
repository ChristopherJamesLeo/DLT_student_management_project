<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use HasFactory;

    protected $table = "permission_roles";
    protected $primaryKey = "id";
    protected $fillable = [
        "role_id",
        "permission_id",
    ];

}
