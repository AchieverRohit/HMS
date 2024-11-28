<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Address',
        'IsActive',
        'CreatedAt',
        'UpdatedAt',
    ];

    // Relationships
    public function users()
    {
        return $this->hasMany(User::class, 'HospitalId');
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'HospitalId');
    }
}
