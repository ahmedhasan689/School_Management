<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Grade;
use App\Models\Classroom;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::all();
        $grades = Grade::all();
        return view('pages.classroom.index', compact('classrooms', 'grades'));
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
        // Validate
        $request->validate(
        [
            'List_Classes.*.name_ar' => 'required',
            'List_Classes.*.name_en' => 'required',
        ],
        [
            'List_Classes.*.name_ar.required' => __('validation.required'),
            'List_Classes.*.name_en.required' => __('validation.required'),
        ]);

        $Lists = $request->List_Classes;

        foreach ($Lists as $List) {
            Classroom::create([
                'class_name' => ['en' => $List['name_en'], 'ar' => $List['name_ar']],
                'grade_id' => $List['grade_id'],
            ]);
        }

        toastr()->success(__('classes-page.success'));
        return redirect()->route('classroom.index');

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
        $classroom = Classroom::findOrFail($id);

        // Validate
        $request->validate(
        [
            'List_Classes.*.name_ar' => ['required'],
            'List_Classes.*.name_en' => ['required'],
        ],
        [
            'List_Classes.*.name_ar.required' => __('validation.required'),
            'List_Classes.*.name_en.required' => __('validation.required'),
        ]);

        $classroom->update([
            'class_name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'grade_id' => $request->grade_id,
        ]);

        toastr()->success( __('classes-page.update') );

        return redirect()->route('classroom.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classroom = Classroom::findOrFail($id);

        $classroom->delete();

        toastr()->success( __('classes-page.delete') );

        return redirect()->route('classroom.index');
    }

    public function deleteAll(Request $request){
        $delete_all = explode(',', $request->delete_all_id);

        Classroom::whereIn('id', $delete_all)->delete();

        toastr()->success( __('classes-page.delete') );

        return redirect()->route('classroom.index');
    }

    public function search(Request $request)
    {
        $grades = Grade::all();

        $search = Classroom::select('*')->where('grade_id', '=', $request->grade_id)->get();

        return view('pages.classroom.index', compact('grades'))->withDetails($search);

    }
}
