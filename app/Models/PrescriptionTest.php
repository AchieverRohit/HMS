<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionTest extends Model
{
    use HasFactory;

    protected $fillable = ['PrescriptionId', 'TestId'];

    // Relationships
    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'PrescriptionId');
    }

    public function test()
    {
        return $this->belongsTo(Test::class, 'TestId');
    }
}
