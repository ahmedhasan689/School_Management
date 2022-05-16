<div>
    @if(!empty($successMessage))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">X</button>
            {{ $successMessage }}
        </div>
    @endif

    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">
                    1
                </a>
                <p>{{ __('parent-page.Step-1') }}</p>
            </div>

            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">
                    2
                </a>
                <p>{{ __('parent-page.Step-2') }}</p>
            </div>

            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}" disabled="disabled">
                    3
                </a>
                <p>{{ __('parent-page.Step-3') }}</p>
            </div>

        </div>
    </div>

    @include('livewire.parents.father_info')

    @include('livewire.parents.mother_info')

    {{-- Step - 3 --}}
    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }} mx-2" id="step-3">
        @if ($currentStep != 3)
            <div style="display: none" class="row setup-content" id="step-3">
        @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
{{--                        <h3 style="font-family: 'Cairo', sans-serif;" class="my-2">--}}
{{--                            {{ __('parent-page.Sure') }}--}}
{{--                        </h3>--}}
{{--                        <br>--}}
                        <label style="color: red">
                            {{ __('parent-page.Attachment') }}
                        </label>

                        <div class="form-group">
                            <input type="file" wire:model="attachments" accept="image/*" multiple>
                        </div>

                        <br>
                        <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right mx-1" type="button" wire:click="back(2)">
                            {{ __('parent-page.Back') }}
                        </button>
                        <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm" type="button">
                            {{ __('parent-page.Finish') }}
                        </button>
                    </div>
                </div>
            </div>


</div>
