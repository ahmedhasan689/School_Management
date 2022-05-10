<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory, HasTranslations;


    public $translatable = ['class_name'];

    public $fillable = [
        'class_name',
        'grade_id',
    ];

    // Relaitons
    public function grade() {
        return $this->belongsTo(Grade::class);
    }
}
