<?php

namespace App\Repository\Student;

use App\Models\Grade;
use App\Models\Gender;
use App\Models\Image;
use App\Models\Section;
use App\Models\BloodType;
use App\Models\Classroom;
use App\Models\My_Parent;
use App\Models\Nationality;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentRepository implements StudentInterface {

    public function createStudent()
    {
        $data = [];

        $data['grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['blood_types'] = BloodType::all();

        return view('pages.student.create', $data);
    }

    public function getClassrooms($id)
    {
        $list_Classroom = Classroom::where('Grade_id', $id)->pluck('class_name', 'id');
        return $list_Classroom;
    }

    public function getSections($id)
    {
        $list_Section= Section::where('classroom_id', $id)->pluck('section_name', 'id');
        return $list_Section;
    }

    public function storeStudent($request)
    {
        $request->validate([
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
            'email' => 'required|email',
            'gender_id' => 'required',
            'nationality_id' => 'required',
            'blood_id' => 'required',
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'section_id' => 'required',
            'parent_id' => 'required',
            'password' => 'required',
            'date_birth' => 'required',
            'academic_year' => 'required'
        ]);

        DB::beginTransaction();

        try {
            Student::create([
                'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender_id' => $request->gender_id,
                'nationality_id' => $request->nationality_id,
                'blood_type_id' => $request->blood_id,
                'grade_id' => $request->Grade_id,
                'classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'parent_id' => $request->parent_id,
                'date_birth' => $request->date_birth,
                'academic_year' => $request->academic_year,
            ]);

            $student = Student::latest()->first();

            if($request->hasFile('images')) {
                foreach($request->file('images') as $image) {
                    $file_name = $image->getClientOriginalName();
                    $image->storeAs('/images/students/'. $student->name, $file_name, 'images');

                    $image = new Image();
                    $image->file_name = $file_name;
                    $image->imageable_id = $student->id;
                    $image->imageable_type = 'App\Models\Student';
                    $image->created_at = Carbon::now();
                    $image->updated_at = Carbon::now();
                    $image->save();
                }
            }

            DB::commit();

            toastr()->success( __('student-page.Created') );
            return redirect()->route('student.index');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }



    }

    public function editStudent($id)
    {
        $data = [];

        $data['student'] = Student::findOrFail($id);
        $data['grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['blood_types'] = BloodType::all();

        return view('pages.student.edit', $data);
    }

    public function updateStudent($request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
            'email' => 'required|email',
            'gender_id' => 'required',
            'nationality_id' => 'required',
            'blood_id' => 'required',
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'section_id' => 'required',
            'parent_id' => 'required',
            'password' => 'nullable|min:8',
            'date_birth' => 'required',
            'academic_year' => 'required'
        ]);

        if(!empty($request->password)) {
            $password = Hash::make($request->password);
        }else{
            $password = $student->password;
        }

        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $file_name = $image->getClientOriginalName();
                $image->storeAs('images/students/'. $student->name, $file_name, 'images');

                $image = new Image();
                $image->file_name = $file_name;
                $image->imageable_id = $student->id;
                $image->imageable_type = 'App\Models\Student';
                $image->created_at = Carbon::now();
                $image->updated_at = Carbon::now();
                $image->save();
            }
        }

        $student->update([
            'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'email' => $request->email,
            'password' => $password,
            'gender_id' => $request->gender_id,
            'nationality_id' => $request->nationality_id,
            'blood_type_id' => $request->blood_id,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'parent_id' => $request->parent_id,
            'date_birth' => $request->date_birth,
            'academic_year' => $request->academic_year,
        ]);

        toastr()->success( __('student-page.Updated') );

        return redirect()->route('student.index');

    }

    public function deleteStudent($id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        toastr()->success( __('student-page.Deleted') );

        return redirect()->route('student.index');
    }

}
