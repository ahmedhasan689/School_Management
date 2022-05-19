<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Teacher;
use App\Models\Specialization;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherInterface {

    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function getSpecialization()
    {
        return Specialization::all();
    }

    public function getGender()
    {
        return Gender::all();
    }

    public function storeTeacher($request)
    {
        $request->validate([
            'email' => 'required|unique:teachers,email',
            'password' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'specialization_id' => 'required',
            'gender_id' => 'required',
            'joining_date' => 'required|date|date_format:Y-m-d',
            'address' => 'required',
        ]);

        Teacher::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'joining_date' => $request->joining_date,
            'specialization_id' => $request->specialization_id,
            'gender_id' => $request->gender_id,
            'address' => $request->address,
        ]);

        toastr()->success(__('teacher-page.Create'));

        return redirect()->route('teacher.index');
    }

    public function getTeacher($id)
    {
        return Teacher::find($id);
    }

    public function updateTeacher($request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'email' => 'nullable',
            'password' => 'nullable',
            'name_ar' => 'required',
            'name_en' => 'required',
            'specialization_id' => 'required',
            'gender_id' => 'required',
            'joining_date' => 'required|date|date_format:Y-m-d',
            'address' => 'required',
        ]);

        if (!empty($request->password)) {
            $password = Hash::make($request->password);
        }else{
            $password = $teacher->password;
        }

        $teacher->update([
            'email' => $request->email,
            'password' => $password,
            'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'joining_date' => $request->joining_date,
            'specialization_id' => $request->specialization_id,
            'gender_id' => $request->gender_id,
            'address' => $request->address,
        ]);

        toastr()->success(__('teacher-page.Update'));

        return redirect()->route('teacher.index');
    }

    public function deleteTeacher($request)
    {
        $teacher = Teacher::findOrFail($request->id);

        $teacher->delete();

        toastr()->success(__('teacher-page.Delete'));

        return redirect()->route('teacher.index');
    }
}
