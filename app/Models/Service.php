<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'service';
    protected $fillable = ['ServiceName', 'Amount'];

    // Relationships
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'ServiceId');
    }
}
