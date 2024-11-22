<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('informationSupperAdminSetting') }}</h2>
        </div>
        <div class="row card-body">
        <!-- bank_account_number -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('numberAccount') }} :</label>
                    <x-input name="bank_account_number" :value="old('numberAccount')" 
                         placeholder="{{ __('Số tài khoản') }}" />
                </div>
            </div><!-- transfer_syntax -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('tranferSyntax') }} <span style="color:red;">*</span>:</label>
                    <x-textarea name="transfer_syntax" 
                        :required="true">{{ old('tranferSyntax') }}</x-textarea>
                </div>
            </div><!-- zalo_number -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Zalo') }} <span style="color:red;">*</span>:</label>
                    <x-input type="number" name="zalo_number" :value="old('zalo_number')" 
                        :required="true" placeholder="{{ __('Zalo') }}" />
                </div>
            </div><!-- hotline -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Hotline') }} <span style="color:red;">*</span>:</label>
                    <x-input type="number" name="hotline" :value="old('hotline')" 
                        :required="true" placeholder="{{ __('Hotline') }}" />
                </div>
            </div><!-- max_user_level -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('maxUser') }} <span style="color:red;">*</span>:</label>
                    <x-input type="number" name="max_user_level" :value="old('max_user_level')" 
                        :required="true" placeholder="{{ __('maxUser') }}" />
                </div>
            </div><!-- commission_per_level -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('commission') }} <span style="color:red;">*</span>:</label>
                    <x-input type="number" name="commission_per_level" :value="old('commission_per_level')" 
                        :required="true" placeholder="{{ __('commission') }}" />
                </div>
            </div>

        </div>
    </div>
</div>