<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'ComplaintName',
        'Frequency',
        'Severity',
        'Duration',
        'Date',
        'Note'
    ];

    // Relationships
    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class, 'PrescriptionComplaints', 'ComplaintsId', 'PrescriptionId')
            ->withPivot(['Dosage', 'Quantity', 'Duration', 'Remarks']);
    }
}
