<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('informationArticles') }}</h2>
        </div>
        <div class="row card-body">
            <!-- title -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('title') }} <span style="color:red;">*</span>:</label>
                    <x-input name="title" :value="old('title')" :required="true" placeholder="{{ __('title') }}" />
                </div>
            </div>
            <div class="col-md-3 col-12">
                <!-- type -->
                <div class="mb-3">
                    <label class="control-label">{{ __('type') }}:</label>
                    <x-select class="select2-bs5" name="type" :required="true">
                        @foreach ($type as $key => $item)
                            <x-select-option :value="$key" :title="$item" />
                        @endforeach
                    </x-select>
                </div>
            </div>

            <div class="col-md-3 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('area') }}<em>(m2)</em> <span
                            style="color:red;">*</span>:</label>
                    <x-input name="area" :value="old('area')" :required="true" placeholder="{{ __('area') }}"
                        class="form-control" />
                </div>
            </div>
            <!-- price -->
            <div class="col-md-3 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('price') }} <span style="color:red;">*</span>:</label>
                    <x-input type="text" name="price_level" :value="old('price')" :required="true"
                        placeholder="{{ __('price') }}" />
                </div>
            </div>

            <!-- price_consent -->
            <div class="col-md-3 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('priceConsent') }}:</label>
                    <x-select class="select2-bs5" name="price_consent" :required="true">
                        @foreach ($price_consent as $key => $item)
                            <x-select-option :value="$key" :title="$item" />
                        @endforeach
                    </x-select>
                </div>
            </div>



            <!-- quantity -->
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label class="control-label">{{ __('quantity') }} <span style="color:red;">*</span>:</label>
                    <x-input type="number" name="quantity" :value="old('quantity')" :required="true"
                        placeholder="{{ __('quantity') }}" />
                </div>
            </div>
            <!-- height_floor -->
            <div class="col-md-3 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('heightFloor') }} :</label>
                    <x-input type="number" name="height_floor" :value="old('height_floor')"
                        placeholder="{{ __('heightFloor') }}" />
                </div>
            </div>
            <!-- project_size -->
            <div class="col-md-3 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('projectSize') }} <span style="color:red;">*</span>:</label>
                    <x-input type="number" name="project_size" :value="old('project_size')" :required="true"
                        placeholder="{{ __('projectSize') }}" />
                </div>
            </div>
            <!-- building_density -->
            <div class="col-md-3 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('buildingDensity') }} :</label>
                    <x-input name="building_density" :value="old('building_density')" placeholder="{{ __('buildingDensity') }}" />
                </div>
            </div>
            <!-- investor -->
            <div class="col-md-3 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('investor') }} :</label>
                    <x-input name="investor" :value="old('investor')" placeholder="{{ __('investor') }}" />
                </div>
            </div><!-- constructor -->
            <div class="col-md-3 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('contructor') }} :</label>
                    <x-input name="constructor" :value="old('constructor')" placeholder="{{ __('contructor') }}" />
                </div>
            </div>
            <!-- hand_over -->
            <div class="col-md-3 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('handOver') }} :</label>
                    <x-input name="hand_over" :value="old('hand_over')" placeholder="{{ __('handOver') }}" />
                </div>
            </div>

            <!-- operative_management -->
            <div class="col-md-3 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('operativeManagent') }} :</label>
                    <x-input name="operative_management" :value="old('operative_management')"
                        placeholder="{{ __('operativeManagent') }}" />
                </div>
            </div>
            <!-- deployment_time -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('deploymentTime') }} :</label>
                    <x-input type="date" name="deployment_time" placeholder="{{ __('deploymentTime') }}" />
                </div>
            </div>
            <!-- name_contact -->
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">{{ __('nameContact') }} :</label>
                    <x-input name="name_contact" :value="old('name_contact')" placeholder="{{ __('nameContact') }}" />
                </div>
            </div><!-- phone_contact -->
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">{{ __('phoneContact') }} <span style="color:red;">*</span>:</label>
                    <x-input type="number" name="phone_contact" :value="old('phone_contact')" :required="true"
                        placeholder="{{ __('phoneContact') }}" />
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="mb-3">
                            <label for="">{{ __('Tỉnh/Thành phố') }}</label>
                            <x-select name="province_id" id="province_id" class="select2-bs5-ajax"
                                data-url="{{ route('admin.search.select.province') }}" :required="true">
                            </x-select>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="mb-3">
                            <label for="">{{ __('Quận/Huyện') }}</label>
                            <x-select name="district_id" id="district_id" class="select2-bs5-ajax" data-url=""
                                :required="true">
                            </x-select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-3">
                            <label for="">{{ __('Phường/Xã') }}</label>
                            <x-select name="ward_id" id="ward_id" class="select2-bs5-ajax" data-url=""
                                :required="true">
                            </x-select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('address') }} <span style="color:red;">*</span>:</label>
                    <x-input type="text" name="address" :value="old('address')" :required="true"
                        placeholder="{{ __('address') }}" />
                </div>
            </div>

            <!-- description -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('description') }} :</label>
                    <x-textarea name="description"
                        class="ckeditor visually-hidden">{{ old('description') }}</x-textarea>
                </div>
            </div>
            <!-- utilities -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('utilities') }} :</label>
                    <x-textarea name="utilities" class="ckeditor visually-hidden">{{ old('utilities') }}</x-textarea>
                </div>
            </div>
        </div>
    </div>
</div>
