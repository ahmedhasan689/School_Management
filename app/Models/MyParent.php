<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyParent extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'password',
        'father_name',
        'father_national_id',
        'father_passport_id',
        'father_phone',
        'father_job',
        'father_address',
        'nationality_father_id',
        'blood_types_father_id',
        'religions_father_id',
        'mother_name',
        'mother_national_id',
        'mother_passport_id',
        'mother_phone',
        'mother_job',
        'mother_address',
        'nationality_mother_id',
        'blood_type_mother_id',
        'religion_mother_id',
    ];
}
