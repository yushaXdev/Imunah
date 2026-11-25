<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationStatus extends Model
{
    use HasFactory;

    protected $table = 'vaccination_status';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'patient_id', 'hospital_id', 'appointment_id', 'vaccine_id', 'dose', 'date', 'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class, 'vaccine_id');
    }
}