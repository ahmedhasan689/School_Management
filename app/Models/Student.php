<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'date_birth',
        'academic_year',
        'gender_id',
        'nationality_id',
        'blood_type_id',
        'grade_id',
        'classroom_id',
        'section_id',
        'parent_id',
    ];

    /**
     * Realtions
     */

    // With Gender
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    // with Grade
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    // With Classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    // With Section
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    // With Nationality
    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    // With Blood_Type
    public function blood_type()
    {
        return $this->belongsTo(BloodType::class, 'blood_type_id');
    }

    // With Parent
    public function parent()
    {
        return $this->belongsTo(My_Parent::class, 'parent_id');
    }

    // Morph To Relation With Image Model
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
