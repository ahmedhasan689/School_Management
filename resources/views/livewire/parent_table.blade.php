<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showAddForm" type="button">
    {{ __('parent-page.Add_Parent') }}
</button>
<br><br>

<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
        <thead>
            <tr class="table-success">
                <th>#</th>
                <th>{{ __('parent-page.Email') }}</th>
                <th>{{ __('parent-page.father_name') }}</th>
                <th>{{ __('parent-page.father_national_id') }}</th>
                <th>{{ __('parent-page.father_passport_id') }}</th>
                <th>{{ __('parent-page.father_phone') }}</th>
                <th>{{ __('parent-page.father_job') }}</th>
                <th>{{ __('parent-page.Processes') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($my_parents as $my_parent)
            <tr>

                <td>{{ $my_parent->id }}</td>
                <td>{{ $my_parent->email }}</td>
                <td>{{ $my_parent->father_name }}</td>
                <td>{{ $my_parent->father_national_id }}</td>
                <td>{{ $my_parent->father_passport_id }}</td>
                <td>{{ $my_parent->father_phone }}</td>
                <td>{{ $my_parent->father_job }}</td>
                <td>
                    <button wire:click="edit({{ $my_parent->id }})" title="{{ __('grades-page.Edit') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})" title="{{ __('Grades_trans.Delete') }}">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
</div>
