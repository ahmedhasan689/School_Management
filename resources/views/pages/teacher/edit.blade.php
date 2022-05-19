@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('teacher-page.Add_Teacher') }}
@stop
@endsection
@section('page-header')
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

@section('PageTitle')
    {{ __('teacher-page.Edit_Teacher') }}
@stop

@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">



                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('teacher.update', ['id' => $teacher->id]) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-row">
                                {{-- Email --}}
                                <div class="col">
                                    <label for="title">
                                        {{ __('teacher-page.Email') }}
                                    </label>
                                    <input type="email" name="email" class="form-control"  value="{{ $teacher->email }}">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Password --}}
                                <div class="col">
                                    <label for="title">
                                        {{ __('teacher-page.Password') }}
                                    </label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            {{-- Name --}}
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">
                                        {{ __('teacher-page.Name_ar') }}
                                    </label>
                                    <input type="text" name="name_ar" class="form-control" value="{{ $teacher->getTranslation('name', 'ar') }}" >
                                    @error('name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{ __('teacher-page.Name_en') }}</label>
                                    <input type="text" name="name_en" class="form-control" value="{{ $teacher->getTranslation('name', 'en') }}">
                                    @error('name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <br>

                            <div class="form-row">

                                {{-- Specialization --}}
                                <div class="form-group col">
                                    <label for="inputCity">
                                        {{ __('teacher-page.specialization') }}
                                    </label>
                                    <select class="custom-select my-1 mr-sm-2" name="specialization_id">
                                        <option selected disabled>
                                            {{ __('teacher-page.Choose') }}...
                                        </option>
                                        @foreach ($specializations as $specialization)
                                            <option value="{{ $specialization->id }}" @if($teacher->specialization_id == $specialization->id) selected @endif>
                                                {{ $specialization->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('specialization_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Gender --}}
                                <div class="form-group col">
                                    <label for="inputState">{{ __('teacher-page.Gender') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="gender_id">
                                        <option selected disabled>
                                            {{ __('teacher-page.Choose') }}...
                                        </option>
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id }}" @if($teacher->gender_id == $gender->id) selected @endif>
                                                {{ $gender->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('gender_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <br>

                            {{-- Joining Date --}}
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">
                                        {{ __('teacher-page.Joining_Date') }}
                                    </label>
                                    <div class='input-group date'>
                                        <input class="form-control" type="text" id="datepicker-action" name="joining_date" data-date-format="yyyy-mm-dd" value="{{ $teacher->joining_date }}">
                                    </div>
                                    @error('joining_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <br>

                            {{-- Address --}}
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">
                                    {{ __('teacher-page.Address') }}
                                </label>
                                <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="4">
                                    {{ $teacher->address }}
                                </textarea>
                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">
                                {{ __('teacher-page.Next') }}
                            </button>
                        </form>
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
