
    @if ($currentStep != 3)
        <div style="display: none" class="row setup-content" id="step-3">
    @endif
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3 style="font-family: 'Cairo', sans-serif;">هل انت متاكد من حفظ البيانات ؟</h3><br>
                    <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                            wire:click="back(2)">{{ trans('Parent_trans.Back') }}</button>
                    <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                            type="button">{{ trans('Parent_trans.Finish') }}</button>
                </div>
            </div>
        </div>

