<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Religion;
use App\Models\BloodType;
use App\Models\My_Parent;
use App\Models\Nationality;
use Livewire\WithFileUploads;
use App\Models\ParentAttachment;
use Illuminate\Support\Facades\File;

class MyParent extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $successMessage = '',


    // Father Inputs
    $Email, $Password, $father_name,
    $father_name_en, $father_job, $father_job_en,
    $father_national_id, $father_passport_id,
    $father_phone, $father_nationality_id, $father_blood_type,
    $father_religion, $father_address,

    // Mother Inputs
    $mother_name, $mother_name_en, $mother_job,
    $mother_job_en, $mother_national_id, $mother_passport_id,
    $mother_phone, $mother_nationality_id, $mother_blood_type,
    $mother_religion, $mother_address,

    // Attachment
    $attachments,

    // Form Mode
    $show_table = true,

    // Edit Mode
    $edit_mode = false;

    public function render()
    {
        return view('livewire.my-parent', [
            'nationalities' => Nationality::all(),
            'bloodTypes' => BloodType::all(),
            'religions' => Religion::all(),
            'my_parents' => My_Parent::all(),
        ]);
    }

    // Real-Time Validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'Email' => 'required|email',
            'father_national_id' => 'required|min:10|max:10|regex:/[0-9]{9}/',
            'father_passport_id' => 'min:10|max:10',
            'father_phone' => 'min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'mother_national_id' => 'required|min:10|max:10|regex:/[0-9]{9}/',
            'mother_passport_id' => 'min:10|max:10',
            'mother_phone' => 'min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'Email' => 'required|unique:my_parents,email,' . $this->id,
            'Password' => 'required',
            'father_name' => 'required',
            'father_name_en' => 'required',
            'father_job' => 'required',
            'father_job_en' => 'required',
            'father_national_id' => 'required|unique:my_parents,father_national_id,' . $this->id,
            'father_passport_id' => 'required|unique:my_parents,father_passport_id,' . $this->id,
            'father_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'father_nationality_id' => 'required',
            'father_blood_type' => 'required',
            'father_religion' => 'required',
            'father_address' => 'required',
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'Email' => 'required|unique:my_parents,email,' . $this->id,
            'Password' => 'required',
            'mother_name' => 'required',
            'mother_name_en' => 'required',
            'mother_job' => 'required',
            'mother_job_en' => 'required',
            'mother_national_id' => 'required|unique:my_parents,mother_national_id,' . $this->id,
            'mother_passport_id' => 'required|unique:my_parents,mother_passport_id,' . $this->id,
            'mother_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_nationality_id' => 'required',
            'mother_blood_type' => 'required',
            'mother_religion' => 'required',
            'mother_address' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function submitForm()
    {
        $my_parent = new My_Parent();

        $my_parent->email = $this->Email;
        $my_parent->password = $this->Password;
        $my_parent->father_name = ['en' => $this->father_name_en, 'ar' => $this->father_name];
        $my_parent->father_job = ['en' => $this->father_job_en, 'ar' => $this->father_job];
        $my_parent->father_national_id = $this->father_national_id;
        $my_parent->father_passport_id = $this->father_passport_id;
        $my_parent->father_phone = $this->father_phone;
        $my_parent->nationality_father_id = $this->father_nationality_id;
        $my_parent->blood_type_father_id = $this->father_blood_type;
        $my_parent->religion_father_id = $this->father_religion;
        $my_parent->father_address = $this->father_address;

        $my_parent->mother_name = ['en' => $this->mother_name_en, 'ar' => $this->mother_name];
        $my_parent->mother_job = ['en' => $this->mother_job_en, 'ar' => $this->mother_job];
        $my_parent->mother_national_id = $this->mother_national_id;
        $my_parent->mother_passport_id = $this->mother_passport_id;
        $my_parent->mother_phone = $this->mother_phone;
        $my_parent->nationality_mother_id = $this->mother_nationality_id;
        $my_parent->blood_type_mother_id = $this->mother_blood_type;
        $my_parent->religion_mother_id = $this->mother_religion;
        $my_parent->mother_address = $this->mother_address;

        $my_parent->save();

        // Attachments
        if(!empty($this->attachments)) {
            foreach($this->attachments as $attachment) {
                // storeAs (Directory[ Folder ], File_name, Disk);
                $attachment->storeAs($this->father_national_id, $attachment->getClientOriginalName(), $disk='parent_attachment');

                ParentAttachment::create([
                    'file_name' => $attachment->getClientOriginalName(),
                    'parent_id' => My_Parent::latest()->first()->id,
                ]);
            }
        }

        $this->successMessage = __('parent-page.Success');
        $this->clearForm();
        $this->currentStep = 1;
        $this->show_table = true;
    }

    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->father_name = '';
        $this->father_name_en = '';
        $this->father_job_en = '';
        $this->father_job = '';
        $this->father_national_id = '';
        $this->father_passport_id = '';
        $this->father_phone = '';
        $this->father_nationality_id = '';
        $this->father_blood_type = '';
        $this->father_religion = '';
        $this->father_address = '';

        $this->mother_name_en = '';
        $this->mother_name = '';
        $this->mother_job_en = '';
        $this->mother_job = '';
        $this->mother_job_en = '';
        $this->mother_national_id = '';
        $this->mother_passport_id = '';
        $this->mother_phone = '';
        $this->mother_nationality_id = '';
        $this->mother_blood_type = '';
        $this->mother_religion = '';
        $this->mother_address = '';
    }

    public function showAddForm()
    {
        $this->show_table = false;
    }

    public function edit($id)
    {
        $this->show_table = false;
        $this->edit_mode = true;

        $my_parent = My_Parent::where('id', $id)->first();

        $this->parent_id = $id;
        $this->Email = $my_parent->email;
        $this->Password = $my_parent->password;
        $this->father_name = $my_parent->getTranslation('father_name', 'ar');
        $this->father_name_en = $my_parent->getTranslation('father_name', 'en');
        $this->father_job_en = $my_parent->getTranslation('father_job', 'en');
        $this->father_job = $my_parent->getTranslation('father_job', 'ar');
        $this->father_national_id = $my_parent->father_national_id;
        $this->father_passport_id = $my_parent->father_passport_id;
        $this->father_phone = $my_parent->father_phone;
        $this->father_nationality_id = $my_parent->nationality_father_id;
        $this->father_blood_type = $my_parent->blood_type_father_id;
        $this->father_religion = $my_parent->religion_father_id;
        $this->father_address = $my_parent->father_address;

        $this->Email = $my_parent->email;
        $this->Password = $my_parent->password;
        $this->mother_name = $my_parent->getTranslation('mother_name', 'ar');
        $this->mother_name_en = $my_parent->getTranslation('mother_name', 'en');
        $this->mother_job_en = $my_parent->getTranslation('mother_job', 'en');
        $this->mother_job = $my_parent->getTranslation('mother_job', 'ar');
        $this->mother_national_id = $my_parent->mother_national_id;
        $this->mother_passport_id = $my_parent->mother_passport_id;
        $this->mother_phone = $my_parent->mother_phone;
        $this->mother_nationality_id = $my_parent->nationality_mother_id;
        $this->mother_blood_type = $my_parent->blood_type_mother_id;
        $this->mother_religion = $my_parent->religion_mother_id;
        $this->mother_address = $my_parent->mother_address;
    }

    public function firstEditSubmit()
    {
        $this->edit_mode = true;
        $this->currentStep = 2;
    }

    public function secondEditSubmit()
    {
        $this->edit_mode = true;
        $this->currentStep = 3;
    }

    public function submitEditForm()
    {
        if($this->parent_id) {
            $my_parent = My_Parent::find($this->parent_id);

            if(!empty($this->attachments)) {
                foreach($this->attachments as $attachment) {
                    // storeAs (Directory[ Folder ], File_name, Disk);
                    $attachment->storeAs($this->father_national_id, $attachment->getClientOriginalName(), $disk='parent_attachment');

                    ParentAttachment::insert([
                        'file_name' => $attachment->getClientOriginalName(),
                        'parent_id' => My_Parent::latest()->first()->id,
                    ]);
                }
            }

            $my_parent->update([
                'email' => $this->Email,
                'password' => $this->Password,
                'father_name' => ['en' => $this->father_name_en, 'ar' => $this->father_name],
                'father_job' => ['en' => $this->father_job_en, 'ar' => $this->father_job],
                'father_national_id' => $this->father_national_id,
                'father_passport_id' => $this->father_passport_id,
                'father_phone' => $this->father_phone,
                'nationality_father_id' => $this->father_nationality_id,
                'blood_type_father_id' => $this->father_blood_type,
                'religion_father_id' => $this->father_religion,
                'father_address' => $this->father_address,

                'mother_name' => ['en' => $this->mother_name_en, 'ar' => $this->mother_name],
                'mother_job' => ['en' => $this->mother_job_en, 'ar' => $this->mother_job],
                'mother_national_id' => $this->mother_national_id,
                'mother_passport_id' => $this->mother_passport_id,
                'mother_phone' => $this->mother_phone,
                'nationality_mother_id' => $this->mother_nationality_id,
                'blood_type_mother_id' => $this->mother_blood_type,
                'religion_mother_id' => $this->mother_religion,
                'mother_address' => $this->mother_address,
            ]);
        }

        $this->show_table = true;
        $this->currentStep = 1;
        $this->edit_mode = false;
        $this->successMessage = __('parent-page.Edit');

    }

    public function delete($id)
    {
        $my_parent = My_Parent::find($id);
        $attachments = ParentAttachment::where('parent_id', $id)->get();

        if($attachments) {
            foreach($attachments as $attachment) {

                // unlink(public_path('attachment/' . $my_parent->father_national_id . '/' . $attachment->file_name));

                $attachment->delete();

                if( File::exists( public_path('attachment/' . $my_parent->father_national_id) ) ) {
                    File::deleteDirectory(public_path('attachment/' . $my_parent->father_national_id));
                }

            }
        }

        $my_parent->delete();
        $this->successMessage = __('parent-page.delete');
    }
}
