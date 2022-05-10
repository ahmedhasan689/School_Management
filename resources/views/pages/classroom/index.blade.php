@extends('layouts.master')

@section('css')
    @toastr_css
@section('title')
    {{ __('Classes-page.title') }}
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">
                {{ __('Classes-page.Classes_List') }}
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
                    {{ __('classes-page.title') }}
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
                    {{ __('classes-page.Add_Class') }}
                </button>

                <button type="button" class="button x-small my-2" id="btn_delete_all">
                    {{ __('classes-page.Delete_All') }}
                </button>

                {{-- Start Search --}}
                <form class="my-2" action="{{ route('classroom.search') }}" method="POST">
                    @csrf
                    <select name="grade_id" onchange="this.form.submit()">
                        <option value="" selected disabled>
                            {{ __('classes-page.Search_By_Grade') }}
                        </option>

                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
                {{-- Start Search --}}


                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="select_all" onclick="Check('box1', this)">
                                </th>
                                <th>#</th>
                                <th>{{ __('classes-page.classroom_name') }}</th>
                                <th>{{ __('grades-page.Name') }}</th>
                                <th>{{ __('grades-page.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (isset($details))
                                <?php $List_classes = $details; ?>
                            @else
                                <?php $List_classes = $classrooms; ?>
                            @endif

                            @foreach ($List_classes as $classroom)
                                <tr>
                                    <td>
                                        <input type="checkbox" value="{{ $classroom->id }}" class="box1">
                                    </td>
                                    <td>{{ $classroom->id }}</td>
                                    <td>{{ $classroom->class_name }}</td>
                                    <td>{{ $classroom->grade->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit-{{ $classroom->id }}"
                                            title="{{ __('grades-page.Edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete-{{ $classroom->id }}"
                                            title="{{ __('grades-page.Delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Start Edit_Modal_Grade -->
                                <div class="modal fade" id="edit-{{ $classroom->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ __('classes-page.Edit_Class') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- edit_form -->
                                                <form
                                                    action="{{ route('classroom.update', ['id' => $classroom->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name"
                                                                class="mr-sm-2">{{ __('classes-page.classroom_name_ar') }}
                                                                :</label>
                                                            <input id="Name" type="text" name="name_ar"
                                                                class="form-control"
                                                                value="{{ $classroom->getTranslation('class_name', 'ar') }}"
                                                                required>
                                                            <input id="id" type="hidden" name="id"
                                                                class="form-control" value="{{ $classroom->id }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="Name_en" class="mr-sm-2">
                                                                {{ __('classes-page.classroom_name_en') }}:
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $classroom->getTranslation('class_name', 'en') }}"
                                                                name="name_en" required>
                                                        </div>
                                                    </div><br>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">
                                                            {{ __('classes-page.grade_name') }}:
                                                        </label>
                                                        <select class="form-control form-control-lg"
                                                            id="exampleFormControlSelect1" name="grade_id">
                                                            <option value="{{ $classroom->grade->id }}">
                                                                {{ $classroom->grade->name }}
                                                            </option>
                                                            @foreach ($grades as $grade)
                                                                <option value="{{ $grade->id }}">
                                                                    {{ $grade->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <br><br>

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
                                <div class="modal fade" id="delete-{{ $classroom->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ __('classes-page.Delete_Class') }}
                                                </h5>

                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('classroom.delete', ['id' => $classroom->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <h6 class="mb-3">
                                                        {{ __('classes-page.Warning_Class') }}
                                                    </h6>

                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $classroom->id }}">

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ __('classes-page.Add_Class') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="row mb-30" action="{{ route('classroom.store') }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Classes">
                                    <div data-repeater-item>
                                        <div class="row">

                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">
                                                    {{ __('classes-page.classroom_name_ar') }}:
                                                </label>
                                                <input class="form-control" type="text" name="name_ar" />
                                            </div>


                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">
                                                    {{ __('classes-page.classroom_name_en') }}:
                                                </label>
                                                <input class="form-control" type="text" name="name_en" />
                                            </div>


                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">
                                                    {{ __('classes-page.grade_name') }}:
                                                </label>

                                                <div class="box">
                                                    <select class="fancyselect" name="grade_id">
                                                        @foreach ($grades as $grade)
                                                            <option value="{{ $grade->id }}">
                                                                {{ $grade->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">
                                                    {{ __('classes-page.processes') }}:
                                                </label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete
                                                    type="button" value="{{ __('classes-page.delete_row') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button my-2" data-repeater-create type="button"
                                            value="{{ __('classes-page.Add_Class') }}" />
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        {{ __('grades-page.Close') }}
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        {{ __('grades-page.Submit') }}
                                    </button>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>


            </div>

        </div>

    </div>
    <!-- End add_modal_Grade -->

    <!-- Delete Group Of Classrooms -->
    <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ __('classes-page.Delete_Class') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('classroom.delete_all') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        {{ __('classes-page.Warning_Class') }}
                        <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('grades-page.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('grades-page.Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@toastr_js
@toastr_render

<script>
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            })

            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        })
    })
</script>

@endsection
