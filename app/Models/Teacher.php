<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name'];

    protected $guarded = [];

    /**
     * Relation
     */

    // With Gender
    public function genders()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    // With Specialization
    public function Specializations()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }

    // With Sections
    public function sections()
    {
        return $this->belongsToMany(Section::class, 'section_teachers');
    }
}
