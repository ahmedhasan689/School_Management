@if ($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-2">
@endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>

                <div class="form-row my-2">
                    {{-- Email --}}
                    <div class="col">
                        <label for="title">
                            {{ __('parent-page.Email') }}
                        </label>
                        <input type="email" wire:model="Email" class="form-control">
                        @error('Email')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="col">
                        <label for="title">
                            {{ __('parent-page.Password') }}
                        </label>
                        <input type="password" wire:model="Password" class="form-control">
                        @error('Password')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-row my-2">
                    {{-- mother_name (ar) --}}
                    <div class="col">
                        <label for="title">
                            {{ __('parent-page.mother_name') }}
                        </label>
                        <input type="text" wire:model="mother_name" class="form-control">
                        @error('mother_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- mother_name (en) --}}
                    <div class="col">
                        <label for="title">
                            {{ __('parent-page.mother_name_en') }}
                        </label>
                        <input type="text" wire:model="mother_name_en" class="form-control">
                        @error('mother_name_en')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-row my-2">
                    {{-- mother Job (ar) --}}
                    <div class="col-md-3">
                        <label for="title">
                            {{ __('parent-page.mother_job') }}
                        </label>
                        <input type="text" wire:model="mother_job" class="form-control">
                        @error('mother_job')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- mother Job (en) --}}
                    <div class="col-md-3">
                        <label for="title">
                            {{ __('parent-page.mother_job_en') }}
                        </label>
                        <input type="text" wire:model="mother_job_en" class="form-control">
                        @error('mother_job_en')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- mother national_id --}}
                    <div class="col">
                        <label for="title">
                            {{ __('parent-page.mother_national_id') }}
                        </label>
                        <input type="text" wire:model="mother_national_id" class="form-control">
                        @error('mother_national_id')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- mother Passport --}}
                    <div class="col">
                        <label for="title">
                            {{ __('parent-page.mother_passport_id') }}
                        </label>
                        <input type="text" wire:model="mother_passport_id" class="form-control">
                        @error('mother_passport_id')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- mother_Phone --}}
                    <div class="col">
                        <label for="title">
                            {{ __('parent-page.mother_phone') }}
                        </label>
                        <input type="text" wire:model="mother_phone" class="form-control">
                        @error('mother_phone')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>


                <div class="form-row my-2">
                    <div class="form-group col-md-6">
                        <label for="inputCity">
                            {{ __('parent-page.mother_nationality') }}
                        </label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="mother_nationality_id">
                            <option selected>
                                {{ __('parent-page.Choose') }}...
                            </option>
                            @foreach ($nationalities as $national)
                                <option value="{{ $national->id }}">
                                    {{ $national->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('mother_nationality_id')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Blood Type Of mother --}}
                    <div class="form-group col">
                        <label for="inputState">
                            {{ __('parent-page.mother_blood_type') }}
                        </label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="mother_blood_type">
                            <option selected>{{ __('parent-page.Choose') }}...</option>
                            @foreach ($bloodTypes as $bloodType)
                                <option value="{{ $bloodType->id }}">
                                    {{ $bloodType->type }}
                                </option>
                            @endforeach
                        </select>
                        @error('mother_blood_type')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Religion Of mother --}}
                    <div class="form-group col">
                        <label for="inputZip">
                            {{ __('parent-page.mother_religion') }}
                        </label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="mother_religion">
                            <option selected>
                                {{ __('parent-page.Choose') }}...
                            </option>
                            @foreach ($religions as $religion)
                                <option value="{{ $religion->id }}">
                                    {{ $religion->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('mother_religion')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- mother Address --}}
                <div class="form-group my-2">
                    <label for="exampleFormControlTextarea1">
                        {{ __('parent-page.mother_address') }}
                    </label>
                    <textarea class="form-control" wire:model="mother_address" id="exampleFormControlTextarea1" rows="4"></textarea>
                    @error('mother_address')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Back --}}
                <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right mx-1" type="button" wire:click="back(1)">
                    {{ __('parent-page.Back')}}
                </button>

                {{-- Submit --}}
                @if($edit_mode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="secondEditSubmit" type="button">
                        {{ __('parent-page.Next') }}
                    </button>
                @else
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="secondStepSubmit" type="button">
                        {{ __('parent-page.Next') }}
                    </button>
                @endif
            </div>
        </div>
    </div>


