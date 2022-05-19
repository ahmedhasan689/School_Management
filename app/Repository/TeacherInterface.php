<?php

namespace App\Repository;

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



}
