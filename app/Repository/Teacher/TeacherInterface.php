<?php

namespace App\Repository\Teacher;

use Illuminate\Http\Request;

interface TeacherInterface {

    // Get All Teachers
    public function getAllTeachers();

    // Get Specialization
    public function getSpecialization();

    // Get Gender
    public function getGender();

    // Store Teacher (Create New Teacher)
    public function storeTeacher(Request $request);

    // Get One Teacher
    public function getTeacher($id);

    // Update Teacher
    public function updateTeacher(Request $request, $id);

    // Delete Teacher
    public function deleteTeacher(Request $request);

}
