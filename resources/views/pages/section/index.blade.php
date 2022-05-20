@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('section-page.Section-page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">
                {{ __('section-page.Section-page') }}
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item">
                    <a href="{{ route('section.index') }}" class="default-color">
                        {{ __('section-page.Home') }}
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('section-page.Section-page') }}
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<!-- main body -->
<div class="row">

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <a class="button x-small my-3" href="#" data-toggle="modal" data-target="#Add">
                    {{ __('section-page.add-section') }}
                </a>

                <div class="accordion gray plus-icon round h-100">
                    {{-- One --}}
                    @foreach ($grades as $grade)
                        <div class="acd-group">
                            <a href="#" class="acd-heading">
                                {{ $grade->name }}
                            </a>
                            <div class="acd-des">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered p-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('section-page.section_name') }}</th>
                                                <th>{{ __('section-page.class-name') }}</th>
                                                <th>{{ __('section-page.status') }}</th>
                                                <th>{{ __('section-page.Processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($grade->sections as $section)
                                                <tr>
                                                    <td>
                                                        {{ $section->id }}
                                                    </td>
                                                    <td>
                                                        {{ $section->section_name }}
                                                    </td>
                                                    <td>
                                                        {{ $section->classrooms->class_name }}
                                                    </td>
                                                    <td>
                                                        @if ($section->status == 'Active')
                                                            <label class="badge badge-success">
                                                                {{ __('section-page.active') }}
                                                            </label>
                                                        @else
                                                            <label class="badge badge-danger">
                                                                {{ __('section-page.draft') }}
                                                            </label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#edit-{{ $section->id }}">
                                                            {{ __('section-page.edit') }}
                                                        </a>
                                                        <a href="#" class="btn btn-outline-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete-{{ $section->id }}">
                                                            {{ __('section-page.delete') }}
                                                        </a>
                                                    </td>
                                                </tr>

                                            <!-- Start Edit_Modal_Section -->
                                            <div class="modal fade" id="edit-{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                style="font-family: 'Cairo', sans-serif;"
                                                                id="exampleModalLabel">
                                                                {{ __('section-page.edit_Section') }}
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <form
                                                                action="{{ route('section.update', ['id' => $section->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="row">
                                                                    {{-- Section Name => Arabic --}}
                                                                    <div class="col">
                                                                        <input type="text" name="name_ar"
                                                                            class="form-control"
                                                                            value="{{ $section->getTranslation('section_name', 'ar') }}">
                                                                    </div>

                                                                    {{-- Section Name => English --}}
                                                                    <div class="col">
                                                                        <input type="text" name="name_en"
                                                                            class="form-control"
                                                                            value="{{ $section->getTranslation('section_name', 'en') }}">
                                                                        {{-- <input id="id" type="hidden" name="id" class="form-control" value="{{ $section->id }}"> --}}
                                                                    </div>

                                                                </div>
                                                                <br>


                                                                <div class="col">
                                                                    <label for="inputName" class="control-label">
                                                                        {{ __('section-page.Grade_name') }}
                                                                    </label>
                                                                    <select name="Grade_id" class="custom-select"
                                                                        onclick="console.log($(this).val())">
                                                                        <!--placeholder-->
                                                                        <option value="{{ $grade->id }}">
                                                                            {{ $grade->name }}
                                                                        </option>

                                                                        @foreach ($list_grades as $list_Grade)

                                                                            <option value="{{ $list_Grade->id }}">
                                                                                {{ $list_Grade->name }}
                                                                            </option>

                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <br>

                                                                <div class="col">
                                                                    <label for="inputName" class="control-label">
                                                                        {{ __('section-page.Class_name') }}
                                                                    </label>
                                                                    <select name="Class_id" class="custom-select">
                                                                        <option
                                                                            value="{{ $section->classrooms->id }}">
                                                                            {{ $section->classrooms->class_name }}
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                                <br>
                                                                <div class="col">
                                                                    <label for="inputName" class="control-label">
                                                                        {{ __('section-page.Teacher_Name') }}
                                                                    </label>

                                                                    <select name="teacher_id[]" class="form-control" id="exampleFormControlSelect2" multiple>
                                                                        @foreach($section->teachers as $teacher)
                                                                            <option value="{{ $teacher['id'] }}" selected>
                                                                                {{ $teacher['name'] }}
                                                                            </option>
                                                                        @endforeach

                                                                        @foreach($teachers as $teacher)
                                                                            <option value="{{ $teacher->id }}">
                                                                                {{ $teacher->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                <div class="col">
                                                                    <div class="form-check">
                                                                        <lable>
                                                                            {{ __("section-page.status") }}
                                                                        </lable>

                                                                        <br>

                                                                        <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="Active" @if($section->status == 'Active') checked @endif>
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Active
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="Draft" @if($section->status == 'Draft') checked @endif>
                                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                                            Draft
                                                                        </label>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                    {{ __('grades-page.Close') }}
                                                                </button>
                                                                <button type="submit" class="btn btn-danger">
                                                                    {{ __('grades-page.Submit') }}
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Edit_Modal_Grade -->

                                            <!-- Start Delete_Modal_Grade -->
                                            <div class="modal fade" id="delete-{{ $section->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">
                                                                {{ __('section-page.Delete_Section') }}
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form action="{{ route('section.delete', ['id' => $section->id]) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <h6>
                                                                    {{ __('grades-page.Delete') }}
                                                                </h6>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ __('grades-page.Close') }}</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">{{ __('grades-page.Sure') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Delete_Modal_Grade -->
                                            @endforeach


                                            {{-- @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Add Modal --}}
        <div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                            {{ __('section-page.add-section') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        {{-- Start Form --}}
                        <form action="{{ route('section.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                {{-- Section Name [Arabic] --}}
                                <div class="col">
                                    <input type="text" name="name_ar" class="form-control"
                                        placeholder="{{ __('section-page.section-name-ar') }}">
                                </div>

                                {{-- Section Name [English] --}}
                                <div class="col">
                                    <input type="text" name="name_en" class="form-control"
                                        placeholder="{{ __('section-page.section-name-en') }}">
                                </div>

                            </div>

                            <br>

                            {{-- Grade Name --}}
                            <div class="col">
                                <label for="inputName" class="control-label">
                                    {{ __('section-page.grade-name') }}
                                </label>
                                <select name="Grade_id" class="custom-select" onchange="console.log($(this).val())">
                                    <!--placeholder-->
                                    <option value="" selected disabled>
                                        {{ __('section-page.grade-name') }}
                                    </option>
                                    @foreach ($list_grades as $list_grade)
                                        <option value="{{ $list_grade->id }}">
                                            {{ $list_grade->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <br>

                            {{-- Class Name --}}
                            <div class="col">
                                <label for="inputName" class="control-label">
                                    {{ __('section-page.class-name') }}
                                </label>
                                <select name="Class_id" class="custom-select"></select>
                            </div>

                            <br>

                            {{-- Teacher Name --}}
                            <div class="col">
                                <label for="inputName" class="control-label">
                                    {{ __('section-page.Teacher_Name') }}
                                </label>
                                <select name="teacher_id[]" class="form-control" id="exampleFormControlSelect2" multiple>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Footer --}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    {{ __('grades-page.Close') }}
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    {{ __('grades-page.Submit') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            {{-- End Add Modal --}}

        </div>
    </div>
</div>
    <!--=================================
 wrapper -->

    <!--=================================

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
    <script>
        $(document).ready(function() {
            $('select[name="Grade_id"]').on('change', function() {
                var grade_id = $(this).val();

                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('sections/class') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="Class_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="Class_id"]').append('<option value="' +
                                    key + '">' + value + '</option');
                            });
                        }
                    })
                } else {
                    console.log('There Is Nothing!')
                }
            })
        })
    </script>
@endsection
