<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $primaryKey = 'patient_id';
    public $timestamps = true;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'city', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class, 'patient_id');
    }

    public function vaccinationStatuses()
    {
        return $this->hasMany(VaccinationStatus::class, 'patient_id');
    }
}