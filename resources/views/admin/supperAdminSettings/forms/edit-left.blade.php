<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('informationSupperAdminSetting') }}</h2>
           
        </div>
        <div class="row card-body">
            <!-- bank_account_number -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('numberAccount') }} :</label>
                    <x-input name="bank_account_number" :value="$supperAdmin_settings->bank_account_number" 
                         placeholder="{{ __('numberAccount') }}" />
                </div>
            </div><!-- transfer_syntax -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('tranferSyntax') }} <span style="color:red;">*</span>:</label>
                    <x-textarea name="transfer_syntax" 
                        :required="true">{{ $supperAdmin_settings->transfer_syntax }}</x-textarea>
                </div>
            </div><!-- zalo_number -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Zalo') }} <span style="color:red;">*</span>:</label>
                    <x-input type="number" name="zalo_number" :value="$supperAdmin_settings->zalo_number" 
                        :required="true" placeholder="{{ __('Zalo') }}" />
                </div>
            </div><!-- hotline -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Hotline') }} <span style="color:red;">*</span>:</label>
                    <x-input type="number" name="hotline" :value="$supperAdmin_settings->hotline" 
                        :required="true" placeholder="{{ __('Hotline') }}" />
                </div>
            </div><!-- max_user_level -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('maxUser') }} <span style="color:red;">*</span>:</label>
                    <x-input type="number" name="max_user_level" :value="$supperAdmin_settings->max_user_level" 
                        :required="true" placeholder="{{ __('maxUser') }}" />
                </div>
            </div><!-- commission_per_level -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('commission') }} <span style="color:red;">*</span>:</label>
                    <x-input type="number" name="commission_per_level" :value="$supperAdmin_settings->commission_per_level" 
                        :required="true" placeholder="{{ __('commission') }}" />
                </div>
            </div>
          
        </div>
    </div>
</div>