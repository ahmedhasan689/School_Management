<?php
namespace App\Repository\Promotion;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Section;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PromotionRepository implements PromotionInterface
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function allPromotions()
    {
        $grades = Grade::all();

        return view('pages.promotion.index', compact('grades'));
    }

    public function storePromotion($request)
    {
        $students = Student::where('grade_id', $request->Grade_id)
            ->where('classroom_id', $request->Classroom_id)
            ->where('section_id', $request->section_id)
            ->get();

        DB::beginTransaction();

        try {
            if ($students->count() > 0) {

                foreach ($students as $student) {
                    $ids = explode(',' , $student->id);
                    Student::whereIn('id', $ids)->update([
                        'grade_id' => $request->Grade_id_new,
                        'classroom_id' => $request->Classroom_id_new,
                        'section_id' => $request->section_id_new,
                    ]);

                    // Insert Into Promotions
                    Promotion::updateOrCreate([
                        'student_id'     => $student->id,
                        'from_grade'     => $request->Grade_id,
                        'from_classroom' => $request->Classroom_id,
                        'from_section'   => $request->section_id,
                        'to_grade'       => $request->Grade_id_new,
                        'to_classroom'   => $request->Classroom_id_new,
                        'to_section'     => $request->section_id_new,
                        'created_at'     => Carbon::now(),
                        'updated_at'     => Carbon::now(),
                    ]);
                }

                DB::commit();

                toastr()->success( __('student-page.Upgrade') );

                return redirect()->route('student.index');

            }else{
                abort(404, 'No Student Found');
            }
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('student.index')->withErrors('success', $e->getMessage());
        }










    }

}
