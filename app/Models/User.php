<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = [
        'FirstName',
        'LastName',
        'Email',
        'Password',
        'Mobile',
        'IsActive',
        'IsDeleted',
        'RoleId',
        'HospitalId',
    ];

    // Relationships
    public function role()
    {
        return $this->belongsTo(Role::class, 'RoleId');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'HospitalId');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'DoctorId');
    }
}
