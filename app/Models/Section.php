<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['section_name'];

    protected $fillable = [
        'section_name',
        'status',
        'classroom_id',
        'grade_id',
    ];

    /**
     * Realtion
     */

    // With Classrooms
    public function classrooms() {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    // With Grades
    public function grade() {
        return $this->belongsTo(Grade::class);
    }

    // With Teacher
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'section_teachers');
    }

}
