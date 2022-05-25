<!-- Deleted inFormation Student -->
<div class="modal fade" id="delete_img-{{ $attachment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{__('student-page.Delete_attachment')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('student.deleteImage') }}" method="post">
                    @csrf


                    <input type="hidden" name="id" value="{{ $attachment->id }}">

                    <input type="hidden" name="student_name" value="{{ $attachment->imageable->name }}">
                    <input type="hidden" name="student_id" value="{{ $attachment->imageable->id }}">

                    <h5 style="font-family: 'Cairo', sans-serif;">{{__('student-page.Delete_attachment_tilte')}}</h5>
                    <input type="text" name="file_name" readonly value="{{ $attachment->file_name }}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('student-page.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('student-page.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
