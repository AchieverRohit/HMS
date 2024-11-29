<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'patient';
    protected $fillable = [
        'FirstName',
        'LastName',
        'PatientNo',
        'Email',
        'Age',
        'Gender',
        'Dob',
        'BloodGroup',
        'Address',
        'Pin',
        'City',
        'HospitalId',
        'MobileNo',
    ];

    // Relationships
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'HospitalId');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'PatientId');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'PatientId');
    }
}
