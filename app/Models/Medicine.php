<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'MedicineName',
        'Dose',
        'Frequency',
        'WhenToTake',
        'Duration',
        'Instruction'
    ];

    // Relationships
    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class, 'PrescriptionMedicine', 'MedicineId', 'PrescriptionId')
            ->withPivot(['Dosage', 'Quantity', 'Duration', 'Remarks']);
    }
}
