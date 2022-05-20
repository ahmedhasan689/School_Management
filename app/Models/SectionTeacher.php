<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
      'section_id',
      'teacher_id',
    ];

    protected $table = 'section_teachers';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'teacher_id' => 'json',
        'section_id' => 'json',
    ];
}
