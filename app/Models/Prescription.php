<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'PatientId',
        'DoctorId',
        'AppointmentId',
        'NextToVisitDate',
        'Notes'
    ];

    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'PatientId');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'DoctorId');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'AppointmentId');
    }

    public function tests()
    {
        return $this->hasMany(PrescriptionTest::class, 'PrescriptionId');
    }

    public function diagnoses()
    {
        return $this->hasMany(PrescriptionDiagnoses::class, 'PrescriptionId');
    }

    public function complaints()
    {
        return $this->hasMany(PrescriptionComplaints::class, 'PrescriptionId');
    }

    public function medicines()
    {
        return $this->hasMany(PrescriptionMedicine::class, 'PrescriptionId');
    }
}
