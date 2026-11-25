<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $table = 'hospitals';
    protected $primaryKey = 'hospital_id';
    public $timestamps = true;

    protected $fillable = [
        'name', 'address', 'city', 'phone', 'email', 'password', 'status',
    ];

    protected $hidden = [
        'password',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'hospital_id');
    }
}