<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Repository\Student\StudentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * @var App\Repository\Student\StudentInterface
     */
    protected $student;

    public function __construct(StudentInterface $student)
    {
        $this->student = $student;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('pages.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->student->createStudent();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->student->storeStudent($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->student->showStudent($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->student->editStudent($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->student->updateStudent($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->student->deleteStudent($id);
    }

    /**
     * @param $id
     * @return mixed
     * Get Classrooms [ Ajax Request ]
     */
    public function getClassrooms($id)
    {
        return $this->student->getClassrooms($id);
    }

    /**
     * @param $id
     * @return mixed
     * Get Sections [ Ajax Request ]
     */
    public function getSections($id)
    {
        return $this->student->getSections($id);
    }

    /**
     * @param Request $request
     * @return mixed
     * Uplaod Image In Show Function
     */
    public function uploadImage(Request $request)
    {
        return $this->student->images($request);
    }

    /**
     * Download Image
     */
    public function download($studentName, $fileName)
    {
        return $this->student->downloadImage($studentName, $fileName);
    }

    public function deleteImage(Request $request)
    {
        return $this->student->deleteImage($request);
    }
}
