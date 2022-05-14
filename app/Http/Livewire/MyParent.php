<?php

namespace App\Http\Livewire;

use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\Religion;
use Livewire\Component;

class MyParent extends Component
{
    public $currentStep = 1,

    // Father Inputs
    $Email, $Password, $father_name,
    $father_name_en, $father_job, $father_job_en,
    $father_national_id, $father_passport_id,
    $father_phone, $father_nationality, $father_blood_type,
    $father_religion, $father_address,

    // Mother Inputs
    $mother_name, $mother_name_en, $mother_job,
    $mother_job_en, $mother_national_id, $mother_passport_id,
    $mother_phone, $mother_nationality, $mother_blood_type,
    $mother_religion, $mother_address;

    public function render()
    {
        return view('livewire.parents.my-parent', [
            'nationalities' => Nationality::all(),
            'bloodTypes' => BloodType::all(),
            'religions' => Religion::all(),
        ]);
    }

    public function firstStepSubmit()
    {
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->currentStep = 3;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }


}
