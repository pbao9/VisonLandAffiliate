<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('addCustomer') }}</h2>
        </div>
        <div class="row card-body">
            <!-- user_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('broker') }}:</label>
                    <x-select name="user_id" :required="true" disabled>
                        <x-select-option :value="$user->id" :title="__($user->fullname)" />
                    </x-select>
                    <x-input name="user_id" :value="$user->id" type="hidden" />
                </div>
            </div><!-- customer_name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('nameCustomer') }} <span style="color:red;">*</span>:</label>
                    <x-input name="customer_name" :value="old('customer_name')" :required="true"
                        placeholder="{{ __('nameCustomer') }}" />
                </div>
            </div><!-- phone -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('phone') }} :</label>
                    <x-input type="number" name="phone" :value="old('phone')" placeholder="{{ __('phone') }}" />
                </div>
            </div><!-- refferal_code -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('referralCode') }} :</label>
                    <x-input name="refferal_code" :value="$user->refferal_code" readonly placeholder="{{ __('referralCode') }}" />
                </div>
            </div><!-- needs -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('needs') }} :</label>
                    <x-textarea name="needs">{{ old('needs') }}</x-textarea>
                </div>
            </div><!-- status -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('status') }}:</label>
                    <x-select name="status" :required="true">
                        <x-select-option value="" :title="__('status')" />
                        @foreach ($status as $key => $value)
                            <x-select-option :value="$key" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>
            </div>

        </div>
    </div>
</div>
