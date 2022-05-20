<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Classroom;
use App\Models\SectionTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $grades = Grade::with(['sections'])->get();

        $list_grades = Grade::all();

        $teachers = Teacher::all();

        return view('pages.section.index', compact('grades', 'list_grades', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => ['required'],
            'name_en' => ['required'],
        ]);
//
//       Section::create([
//           'section_name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
//           'status' => 'Active',
//           'grade_id' => $request->Grade_id,
//           'classroom_id' => $request->Class_id,
//        ]);

        $section = new Section();

        $section->section_name = ['ar' => $request->name_ar, 'en' => $request->name_en];
        $section->grade_id = $request->Grade_id;
        $section->classroom_id = $request->Class_id;
        $section->Status = 'Active';
        $section->save();
        $section->teachers()->attach($request->teacher_id);


        toastr()->success( __('section-page.section_created') );

        return redirect()->route('section.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $section = Section::findOrFail($id);

        $request->validate([
            'name_ar' => ['required'],
            'name_en' => ['required'],
        ]);

        $section->update([
            'section_name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Class_id,
            'status' => $request->status,
        ]);

        toastr()->success( __('section-page.section_updated') );

        return redirect()->route('section.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();

        toastr()->error( __('section-page.section_deleted') );

        return redirect()->route('section.index');
    }

    public function getClass($id)
    {
        $list_class = Classroom::where("grade_id", $id)->pluck('class_name', 'id');

        return $list_class;
    }
}
