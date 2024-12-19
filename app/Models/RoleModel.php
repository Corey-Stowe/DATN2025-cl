<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'role_type', 

    ];

    public function users()
    {
        return $this->hasMany(User::class, 'roles_id');
    }
}
