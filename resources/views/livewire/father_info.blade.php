@if ($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
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
                    {{-- Father_name (ar) --}}
                    <div class="col">
                        <label for="title">
                            {{ __('parent-page.father_name') }}
                        </label>
                        <input type="text" wire:model="father_name" class="form-control">
                        @error('father_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Father_name (en) --}}
                    <div class="col">
                        <label for="title">
                            {{ __('parent-page.father_name_en') }}
                        </label>
                        <input type="text" wire:model="father_name_en" class="form-control">
                        @error('father_name_en')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-row my-2">
                    {{-- father Job (ar) --}}
                    <div class="col-md-3">
                        <label for="title">
                            {{ __('parent-page.father_job') }}
                        </label>
                        <input type="text" wire:model="father_job" class="form-control">
                        @error('father_job')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- father Job (en) --}}
                    <div class="col-md-3">
                        <label for="title">
                            {{ __('parent-page.father_job_en') }}
                        </label>
                        <input type="text" wire:model="father_job_en" class="form-control">
                        @error('father_job_en')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- father national_id --}}
                    <div class="col">
                        <label for="title">
                            {{ __('parent-page.father_national_id') }}
                        </label>
                        <input type="text" wire:model="father_national_id" class="form-control">
                        @error('father_national_id')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Father Passport --}}
                    <div class="col">
                        <label for="title">
                            {{ __('parent-page.father_passport_id') }}
                        </label>
                        <input type="text" wire:model="father_passport_id" class="form-control">
                        @error('father_passport_id')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Father_Phone --}}
                    <div class="col">
                        <label for="title">
                            {{ __('parent-page.father_phone') }}
                        </label>
                        <input type="text" wire:model="father_phone" class="form-control">
                        @error('father_phone')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>


                <div class="form-row my-2">
                    <div class="form-group col-md-6">
                        <label for="inputCity">
                            {{ __('parent-page.father_nationality') }}
                        </label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="father_nationality_id">
                            <option selected>
                                {{ __('parent-page.Choose') }}...
                            </option>
                            @foreach ($nationalities as $national)
                                <option value="{{ $national->id }}">
                                    {{ $national->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('father_nationality_id')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Blood Type Of Father --}}
                    <div class="form-group col">
                        <label for="inputState">
                            {{ __('parent-page.father_blood_type') }}
                        </label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="father_blood_type">
                            <option selected>{{ __('parent-page.Choose') }}...</option>
                            @foreach ($bloodTypes as $bloodType)
                                <option value="{{ $bloodType->id }}">
                                    {{ $bloodType->type }}
                                </option>
                            @endforeach
                        </select>
                        @error('father_blood_type')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Religion Of Father --}}
                    <div class="form-group col">
                        <label for="inputZip">
                            {{ __('parent-page.father_religion') }}
                        </label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="father_religion">
                            <option selected>
                                {{ __('parent-page.Choose') }}...
                            </option>
                            @foreach ($religions as $religion)
                                <option value="{{ $religion->id }}">
                                    {{ $religion->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('father_religion')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Father Address --}}
                <div class="form-group my-2">
                    <label for="exampleFormControlTextarea1">
                        {{ __('parent-page.father_address') }}
                    </label>
                    <textarea class="form-control" wire:model="father_address" id="exampleFormControlTextarea1" rows="4"></textarea>
                    @error('father_address')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Submit --}}
                @if($edit_mode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstEditSubmit" type="button">
                        {{ __('parent-page.Next') }}
                    </button>
                @else
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit" type="button">
                        {{ __('parent-page.Next') }}
                    </button>
                @endif
            </div>
        </div>
    </div>
