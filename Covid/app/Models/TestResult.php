<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $table = 'test_results';
    protected $primaryKey = 'result_id';
    public $timestamps = false;

    protected $fillable = [
        'patient_id', 'hospital_id', 'appointment_id', 'result', 'remarks', 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}