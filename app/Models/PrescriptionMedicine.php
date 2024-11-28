<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'PrescriptionId',
        'MedicineId',
        'Dosage',
        'Quantity',
        'Duration',
        'Remarks'
    ];

    // Relationships
    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'PrescriptionId');
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'MedicineId');
    }
}
