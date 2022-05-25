@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('student-page.student_details') }}
@stop
@endsection
@section('page-header')
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
@section('PageTitle')
    {{ __('student-page.student_details') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="card-body">
                    <div class="tab nav-border">
                        @if (Session()->has('success'))
                            <div class="alert alert-danger">
                                <span>
                                    {{ Session()->get('success') }}
                                </span>
                            </div>
                        @endif
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02" role="tab" aria-controls="home-02" aria-selected="true">
                                    {{ __('student-page.student_details') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02" role="tab" aria-controls="profile-02" aria-selected="false">
                                    {{ __('student-page.Attachments') }}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="home-02" role="tabpanel" aria-labelledby="home-02-tab">
                                <table class="table table-striped table-hover" style="text-align:center">
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                {{ __('student-page.name') }}
                                            </th>
                                            <td>
                                                {{ $student->name }}
                                            </td>
                                            <th scope="row">
                                                {{ __('student-page.email') }}
                                            </th>
                                            <td>
                                                {{ $student->email }}
                                            </td>
                                            <th scope="row">
                                                {{ __('student-page.gender') }}
                                            </th>
                                            <td>
                                                {{ $student->gender->name }}
                                            </td>
                                            <th scope="row">
                                                {{ __('student-page.Nationality') }}
                                            </th>
                                            <td>
                                                {{ $student->Nationality->name }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row">
                                                {{ __('student-page.Grade') }}
                                            </th>
                                            <td>
                                                {{ $student->grade->name }}
                                            </td>
                                            <th scope="row">
                                                {{ __('student-page.classrooms') }}
                                            </th>
                                            <td>
                                                {{ $student->classroom->class_name }}
                                            </td>
                                            <th scope="row">
                                                {{ __('student-page.section') }}
                                            </th>
                                            <td>
                                                {{ $student->section->section_name }}
                                            </td>
                                            <th scope="row">
                                                {{ __('student-page.Date_of_Birth') }}
                                            </th>
                                            <td>
                                                {{ $student->date_birth }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row">
                                                {{ __('student-page.parent') }}
                                            </th>
                                            <td>
                                                {{ $student->parent->father_name }}
                                            </td>
                                            <th scope="row">
                                                {{ __('student-page.academic_year') }}
                                            </th>
                                            <td>
                                                {{ $student->academic_year }}
                                            </td>
                                            <th scope="row"></th>
                                            <td></td>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <form method="post" action="{{ route('student.image') }}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="academic_year">
                                                        {{ __('student-page.Attachments') }} :
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="file" accept="image/*" name="images[]" multiple required>

                                                    <input type="hidden" name="student_name" value="{{ $student->name }}">
                                                    <input type="hidden" name="student_id" value="{{ $student->id }}">

                                                </div>
                                            </div>
                                            <br><br>
                                            <button type="submit" class="button button-border x-small">
                                                {{ __('student-page.submit') }}
                                            </button>
                                        </form>
                                    </div>

                                    <br>

                                    <table class="table center-aligned-table mb-0 table table-hover"
                                        style="text-align:center">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{ __('student-page.filename') }}</th>
                                                <th scope="col">{{ __('student-page.created_at') }}</th>
                                                <th scope="col">{{ __('student-page.processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($student->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $attachment->file_name }}</td>
                                                    <td>{{ $attachment->created_at->diffForHumans() }}</td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm" href="{{ url('students/download-image') }}/{{ $attachment->imageable->name }}/{{ $attachment->file_name }}" role="button">
                                                            <i class="fas fa-download"></i>&nbsp;
                                                            {{ __('student-page.Download') }}
                                                        </a>

                                                        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete_img-{{ $attachment->id }}" title="{{ __('Grades___.Delete') }}">
                                                            {{ __('student-page.delete') }}
                                                        </button>

                                                    </td>
                                                </tr>
                                                @include('pages.student.delete-image')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

        <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
