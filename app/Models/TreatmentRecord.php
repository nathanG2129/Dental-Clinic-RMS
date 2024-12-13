<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TreatmentRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'record_id';

    protected $fillable = [
        'patient_id',
        'dentist_id',
        'treatment_type',
        'treatment_details',
        'treatment_date',
        'cost',
        'payment_status',
        'notes'
    ];

    protected $casts = [
        'treatment_date' => 'date',
        'cost' => 'decimal:2'
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
