<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'patient_id',
        'dentist_id',
        'appointment_date',
        'purpose_of_appointment',
        'status',
        'notes'
    ];

    protected $casts = [
        'appointment_date' => 'datetime'
    ];

    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function dentist()
    {
        return $this->belongsTo(Dentist::class, 'dentist_id');
    }
}
