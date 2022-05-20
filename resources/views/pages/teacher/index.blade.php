@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('teacher-page.Title') }}
@stop
@endsection
@section('page-header')
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">
                    {{ __('teacher-page.Title') }}
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
                        {{ __('teacher-page.Title') }}
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('PageTitle')
    {{ __('teacher-page.Title') }}
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
                            <a href="{{ route('teacher.create') }}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">
                                {{ __('teacher-page.Add_Teacher') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('teacher-page.Teacher-Name') }}</th>
                                            <th>{{ __('teacher-page.Gender') }}</th>
                                            <th>{{ __('teacher-page.Joining_Date') }}</th>
                                            <th>{{ __('teacher-page.specialization') }}</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($teachers as $teacher)
                                            <tr>
                                                <td>{{ $teacher->id }}</td>
                                                <td>{{ $teacher->name }}</td>
                                                <td>{{ $teacher->genders->name }}</td>
                                                <td>{{ $teacher->joining_date }}</td>
                                                <td>{{ $teacher->specializations->name }}</td>
                                                <td>
                                                    <a href="{{ route('teacher.edit', $teacher->id) }}"
                                                        class="btn btn-info btn-sm" role="button" aria-pressed="true">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#delete_Teacher-{{ $teacher->id }}"
                                                        title="{{ __('Grades___.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            {{-- Delete Modal --}}
                                            <div class="modal fade" id="delete_Teacher-{{ $teacher->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{ route('teacher.delete', ['id' => $teacher->id]) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">
                                                                    {{ __('teacher-page.Delete_Teacher') }}
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p> {{ __('grades-page.warning_Grade') }}</p>
                                                                <input type="hidden" name="id"
                                                                    value="{{ $teacher->id }}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                    {{ __('grades-page.Close') }}
                                                                </button>

                                                                <button type="submit" class="btn btn-danger">
                                                                    {{ __('grades-page.Submit') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
