@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('main-nav.Grades_List') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">
                {{ __('main-nav.Grades_List') }}
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
                    {{ __('main-nav.Grades_List') }}
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
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

                <button type="button" class="button x-small my-2" data-toggle="modal" data-target="#exampleModal">
                    {{ __('grades-page.Add_Grade') }}
                </button>


                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('grades-page.Name') }}</th>
                                <th>{{ __('grades-page.Notes') }}</th>
                                <th>{{ __('grades-page.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grades as $grade)
                                <tr>
                                    <td>{{ $grade->id }}</td>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->notes }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit-{{ $grade->id }}"
                                            title="{{ __('grades-page.Edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete-{{ $grade->id }}"
                                            title="{{ __('grades-page.Delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Start Edit_Modal_Grade -->
                                <div class="modal fade" id="edit-{{ $grade->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="EditLabel">
                                                    {{ __('grades-page.Edit_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('grade.update', ['id' => $grade->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name" class="mr-sm-2">
                                                                {{ __('grades-page.Stage_name_ar') }}:
                                                            </label>
                                                            <input id="Name" type="text" name="Name"
                                                                class="form-control"
                                                                value="{{ $grade->getTranslation('name', 'ar') }}">
                                                        </div>

                                                        <div class="col">
                                                            <label for="Name_en" class="mr-sm-2">
                                                                {{ __('grades-page.Stage_name_en') }}:
                                                            </label>
                                                            <input type="text" class="form-control" name="Name_en"
                                                                value="{{ $grade->getTranslation('name', 'en') }}">
                                                        </div>

                                                    </div>

                                                    <div class="form-group my-2">
                                                        <label for="exampleFormControlTextarea1">
                                                            {{ __('grades-page.Notes') }}:
                                                        </label>
                                                        <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="5">
                                                            {{ $grade->notes }}
                                                        </textarea>
                                                    </div>

                                                    <br>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                            {{ __('grades-page.Close') }}
                                                        </button>

                                                        <button type="submit" class="btn btn-success">
                                                            {{ __('grades-page.Submit') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- End Edit_Modal_Grade -->

                                <!-- Start Delete_Modal_Grade -->
                                <div class="modal fade" id="delete-{{ $grade->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                   id="exampleModalLabel">
                                                   {{ __('grades-page.Delete_Grade') }}
                                               </h5>
                                               <button type="button" class="close" data-dismiss="modal"
                                                       aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                               </button>
                                           </div>

                                           <div class="modal-body">
                                               <form action="{{ route('grade.delete', ['id' => $grade->id]) }}" method="post">
                                                   @csrf
                                                   @method('DELETE')

                                                   <h6>
                                                       {{ __('grades-page.Delete') }}
                                                   </h6>
                                                   <div class="modal-footer">
                                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('grades-page.Close') }}</button>
                                                       <button type="submit" class="btn btn-danger">{{ __('grades-page.Sure') }}</button>
                                                   </div>
                                               </form>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                                <!-- End Delete_Modal_Grade -->
                            @endforeach


                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ __('grades-page.Add_Grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('grade.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col">
                                <label for="Name" class="mr-sm-2">
                                    {{ __('grades-page.Stage_name_ar') }}:
                                </label>
                                <input id="Name" type="text" name="Name" class="form-control">
                            </div>

                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">
                                    {{ __('grades-page.Stage_name_en') }}:
                                </label>
                                <input type="text" class="form-control" name="Name_en">
                            </div>

                        </div>

                        <div class="form-group my-2">
                            <label for="exampleFormControlTextarea1">
                                {{ __('grades-page.Notes') }}:
                            </label>
                            <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="5"></textarea>
                        </div>

                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('grades-page.Close') }}</button>
                            <button type="submit" class="btn btn-success">{{ __('grades-page.Submit') }}</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
    <!-- End add_modal_Grade -->
</div>
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
