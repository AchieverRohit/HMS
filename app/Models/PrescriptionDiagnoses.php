<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionDiagnoses extends Model
{
    use HasFactory;

    protected $fillable = ['PrescriptionId', 'DiagnosisId'];

    // Relationships
    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'PrescriptionId');
    }

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class, 'DiagnosisId');
    }
}
