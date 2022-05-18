<?php

namespace App\Repository;

use App\Models\Teacher;

class TeacherRepository implements TeacherInterface {

    public function getAllTeachers()
    {
        return Teacher::all();
    }

}
