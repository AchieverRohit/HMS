<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'appointment';
    protected $fillable = [
        'AppointmentTokenNo',
        'DoctorId',
        'PatientId',
        'ServiceId',
        'StatusId',
        'ReffernceBy',
        'DateTime',
        'Duration',
        'HospitalId'
    ];

    // Relationships
    public function doctor()
    {
        return $this->belongsTo(User::class, 'DoctorId', 'Id');
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'HospitalId');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'PatientId', 'Id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'ServiceId', 'Id');
    }

    public function status()
    {
        return $this->belongsTo(AppointmentStatus::class, 'StatusId', 'Id');
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class, 'AppointmentId');
    }
}
