<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionComplaints extends Model
{
    use HasFactory;

    protected $fillable = [
        'PrescriptionId',
        'ComplaintsId',
    ];

    // Relationships
    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'PrescriptionId');
    }

    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'ComplaintsId');
    }
}
