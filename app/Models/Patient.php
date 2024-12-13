<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'patient_id';

    protected $fillable = [
        'patient_name',
        'date_of_birth',
        'gender',
        'contact_information',
        'address'
    ];

    protected $casts = [
        'date_of_birth' => 'date'
    ];

    // Relationships
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function treatmentRecords()
    {
        return $this->hasMany(TreatmentRecord::class, 'patient_id');
    }
}
