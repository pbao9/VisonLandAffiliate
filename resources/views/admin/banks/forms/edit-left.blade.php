<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Sửa tài khoản thụ hưởng') }}   </h2>
         
        </div>
        <div class="row card-body">
            <!-- bank_name -->
            <div class="col-md-12 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên ngân hàng') }}:</label>
                    <x-input name="bank_name" :value="$bank->bank_name" :required="true" placeholder="{{ __('Tên ngân hàng') }}" />
                </div>
            </div>
            <!-- bank_branch -->
            <div class="col-md-12 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Chi nhánh ngân hàng') }}:</label>
                    <x-input name="bank_branch" :value="$bank->bank_branch" :required="true" placeholder="{{ __('Chi nhánh ngân hàng') }}" />
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tài khoản ngân hàng') }}:</label>
                    <x-input name="bank_account" :value="$bank->bank_account" :required="true" placeholder="{{ __('Tài khoản ngân hàng') }}" />
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số tài khoản ngân hàng') }}:</label>
                    <x-input name="bank_number" :value="$bank->bank_number" :required="true" placeholder="{{ __('Số tài khoản ngân hàng') }}" />
                </div>
            </div>
         

        </div>
    </div>
    
</div>
