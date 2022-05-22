<?php

namespace App\Repository\Student;

use Illuminate\Http\Request;

interface StudentInterface {

    // Create Student
    public function createStudent();

    // Get Classrooms
    public function getClassrooms($id);

    // Get Sections
    public function getSections($id);

    // Store New Student
    public function storeStudent(Request $request);

    // Edit Student
    public function editStudent($id);

    // Update Student
    public function updateStudent(Request $request, $id);

    // Delete Student
    public function deleteStudent($id);

}
