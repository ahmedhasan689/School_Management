@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('student-page.title') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">
                    {{ __('student-page.title') }}
                </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item">
                        <a href="#" class="default-color">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{ __('student-page.title') }}
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <!-- breadcrumb -->
@section('PageTitle')
    {{ __('student-page.title') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
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

                    <form action="{{ route('student.update', $student->id) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                            {{ __('student-page.personal_information') }}
                        </h6>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        {{ __('student-page.name_ar') }} :
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name_ar" class="form-control" value="{{ $student->getTranslation('name', 'ar') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        {{ __('student-page.name_en') }} :
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control" name="name_en" type="text" value="{{ $student->getTranslation('name', 'en') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        {{ __('student-page.email') }} :
                                    </label>
                                    <input type="email" name="email" class="form-control" value="{{ $student->email }}">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        {{ __('student-page.password') }} :
                                    </label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">
                                        {{ __('student-page.gender') }} :
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="custom-select mr-sm-2" name="gender_id">
                                        <option selected disabled>
                                            {{ __('student-page.Choose') }}...
                                        </option>
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id }}" @if( $student->gender_id == $gender->id) selected @endif>
                                                {{ $gender->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">
                                        {{ __('student-page.Nationality') }} :
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="custom-select mr-sm-2" name="nationality_id">
                                        <option selected disabled>
                                            {{ __('student-page.Choose') }}...
                                        </option>
                                        @foreach ($nationals as $national)
                                            <option value="{{ $national->id }}" @if( $student->nationality_id == $national->id ) selected @endif>
                                                {{ $national->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_id">{{ __('student-page.blood_type') }} : </label>
                                    <select class="custom-select mr-sm-2" name="blood_id">
                                        <option selected disabled>
                                            {{ __('student-page.Choose') }}...
                                        </option>
                                        @foreach ($blood_types as $blood_type)
                                            <option value="{{ $blood_type->id }}" @if( $student->blood_type_id == $blood_type->id ) selected @endif>
                                                {{ $blood_type->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>
                                        {{ __('student-page.Date_of_Birth') }} :
                                    </label>
                                    <input class="form-control" type="text" id="datepicker-action" name="date_birth" data-date-format="yyyy-mm-dd" value="{{ $student->date_birth }}">
                                </div>
                            </div>

                        </div>

                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                            {{ __('student-page.Student_information') }}
                        </h6>
                        <br>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Grade_id">
                                        {{ __('student-page.Grade') }} :
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="custom-select mr-sm-2" name="Grade_id">
                                        <option selected disabled>
                                            {{ __('student-page.Choose') }}...
                                        </option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}" @if( $student->grade_id == $grade->id ) selected @endif>
                                                {{ $grade->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Classroom_id">
                                        {{ __('student-page.classrooms') }} :
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="custom-select mr-sm-2" name="Classroom_id">
                                        <option value="{{ $student->classroom_id }}">
                                            {{ $student->classroom->class_name}}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">
                                        {{ __('student-page.section') }} :
                                    </label>
                                    <select class="custom-select mr-sm-2" name="section_id">
                                        <option value="{{ $student->section_id }}">
                                            {{ $student->section->section_name}}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">
                                        {{ __('student-page.parent') }} :
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="custom-select mr-sm-2" name="parent_id">
                                        <option selected disabled>
                                            {{ __('student-page.Choose') }}...
                                        </option>
                                        @foreach ($parents as $parent)
                                            <option value="{{ $parent->id }}" @if( $student->parent_id == $parent->id ) selected @endif>
                                                {{ $parent->father_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">
                                        {{ __('student-page.academic_year') }} :
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="custom-select mr-sm-2" name="academic_year">
                                        <option selected disabled>
                                            {{ __('student-page.Choose') }}...
                                        </option>
                                        @php
                                            $gradeurrent_year = date('Y');
                                        @endphp
                                        @for ($year = $gradeurrent_year; $year <= $gradeurrent_year + 1; $year++)
                                            <option value="{{ $year }}" @if( $student->academic_year == $year ) selected @endif>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div><br>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">
                                    {{ __('student-page.Attachments') }} :
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="file" accept="image/*" name="images[]" multiple>
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">
                            {{ __('student-page.submit') }}
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function() {
            $('select[name="Grade_id"]').on('change', function() {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('students/getClassrooms') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="Classroom_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="Classroom_id"]').append(
                                    '<option selected disabled >{{ __('student-page.Choose') }}...</option>'
                                );
                                $('select[name="Classroom_id"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('select[name="Classroom_id"]').on('change', function() {
                var Classroom_id = $(this).val();
                if (Classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('students/getSections') }}/" + Classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="section_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="section_id"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection
