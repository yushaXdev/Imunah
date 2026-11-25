<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $table = 'vaccines';
    protected $primaryKey = 'vaccine_id';
    public $timestamps = false;

    protected $fillable = [
        'vaccine_name', 'status',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'vaccine_id');
    }
}