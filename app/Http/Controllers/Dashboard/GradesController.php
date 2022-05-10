<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeStoreRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();
        return view('pages.grades.index', compact('grades'));
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
    public function store(GradeStoreRequest $request)
    {

        if ( Grade::where('name->ar', $request->Name)->orWhere('Name->en', $request->Name_en)->exists() ){
            return redirect()->back()->withErrors( __('grades-page.exists') );
        };

        $validated = $request->validated();

        // $grade = new Grade();
        // $grade->name = [
        //     'en' => $request->Name_en,
        //     'ar' => $request->Name,
        // ];

        // $grade->notes = $request->Notes;

        // $grade->save();

        $grade = Grade::create([
            'name' => [
                'en' => $request->Name_en,
                'ar' => $request->Name,
            ],
            'notes' => $request->Notes,
        ]);

        toastr()->success( __('grades-page.Data has been saved successfully!') );

        return redirect()->route('grade.index');
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
    public function update(GradeStoreRequest $request, $id)
    {
        // return $request;
        $validated = $request->validated();

        $grade = Grade::findOrFail($id);

        $grade->update([
            'name' => [
                'en' => $request->Name_en,
                'ar' => $request->Name,
            ],
            'notes' => $request->Notes,
        ]);

        toastr()->success( __('grades-page.Data has been Updated successfully!') );

        return redirect()->route('grade.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);

        $classrooms = Classroom::where('grade_id', $grade->id)->pluck('grade_id');

        // If Count == 0 (No Classroom Inside This Grade)
        if ($classrooms->count() == 0) {
            $grade->delete();

            toastr()->success( __('grades-page.Data has been Deleted successfully!') );

            return redirect()->route('grade.index');
        } else {
            toastr()->error( __('grades-page.error_delete') );

            return redirect()->route('grade.index');
        }
    }
}
