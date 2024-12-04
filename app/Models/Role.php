<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['RoleName', 'Description'];

    // Relationships
    public function users()
    {
        return $this->hasMany(User::class, 'RoleId');
    }
}
