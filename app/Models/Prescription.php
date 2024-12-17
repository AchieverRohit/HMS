<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'prescriptions';

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

    public function complaints()
    {
        return $this->belongsToMany(Complaint::class, 'PrescriptionComplaints', 'PrescriptionId', 'ComplaintsId');
    }

    public function diagnoses()
    {
        return $this->belongsToMany(Diagnosis::class, 'PrescriptionDiagnosis', 'PrescriptionId', 'DiagnosisId');
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'PrescriptionTest', 'PrescriptionId', 'TestId');
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'PrescriptionMedicine', 'PrescriptionId', 'MedicineId')
            ->withPivot(['Dosage', 'Quantity', 'Duration', 'Remarks']);
    }
}
