<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'appointmentstatus';

    protected $fillable = ['StatusName'];

    // Relationships
    // public function appointments()
    // {
    //     return $this->hasMany(Appointment::class, 'StatusId');
    // }
}
