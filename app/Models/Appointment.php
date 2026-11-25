<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';
    protected $primaryKey = 'appointment_id';
    public $timestamps = true;

    protected $fillable = [
        'patient_id', 'hospital_id', 'service_type',
        'appointment_date', 'appointment_time', 'status', 'vaccine_id',
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

    public function testResult()
    {
        return $this->hasOne(TestResult::class, 'appointment_id');
    }

    public function vaccinationStatus()
    {
        return $this->hasOne(VaccinationStatus::class, 'appointment_id');
    }
}