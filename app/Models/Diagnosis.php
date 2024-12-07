<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'diagnosis';
    protected $fillable = [
        'DiagnosisName',
        'Date',
        'Duration',
    ];

    // Relationships
    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class, 'PrescriptionDiagnosis', 'DiagnosisId', 'PrescriptionId');
    }
}
