@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{__('student-page.list_students')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">
                    {{ __('student-page.list_students') }}
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
                        {{ __('student-page.list_students') }}
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <!-- breadcrumb -->
@section('PageTitle')
    {{__('student-page.list_students')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{ route('student.create') }}" class="btn btn-success btn-sm" role="button" aria-pressed="true">
                                    {{ __('student-page.add_student') }}
                                </a>
                                <br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('student-page.name') }}</th>
                                            <th>{{ __('student-page.email') }}</th>
                                            <th>{{ __('student-page.gender') }}</th>
                                            <th>{{ __('student-page.Grade') }}</th>
                                            <th>{{ __('student-page.classrooms') }}</th>
                                            <th>{{ __('student-page.section') }}</th>
                                            <th>{{ __('student-page.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $student->id }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->gender->name }}</td>
                                                <td>{{ $student->grade->name }}</td>
                                                <td>{{ $student->classroom->class_name }}</td>
                                                <td>{{ $student->section->section_name }}</td>
                                                <td>
                                                    <a href="{{ route('student.edit', ['id' => $student->id])}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_Student-{{ $student->id }}" title="{{ __('Grades___.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <a href="#" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                        @include('pages.student.delete')

                                        @endforeach
                                    </table>
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
