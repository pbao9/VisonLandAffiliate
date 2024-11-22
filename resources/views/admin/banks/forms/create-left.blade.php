<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Tài khoản') }}</h2>
        </div>
        <div class="row card-body">
        <div class="col-md-12 col-sm-12">
        <x-input type="hidden" name="id_user" :value="$user->id" />
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên ngân gàng') }}:</label>
                    <x-input type="text" name="bank_name" :placeholder="__('Tên ngân hàng')"/>
                </div>
                <div class="mb-3">
                    <label class="control-label">{{ __('Chi  nhánh ngân gàng') }}:</label>
                    <x-input type="text" name="bank_branch" :placeholder="__('Chi nhánh ngân hàng')"/>
                </div>
                <div class="mb-3">
                <label class="control-label">{{ __('Tên tài khoản') }}:</label>
                <x-input type="text" name="bank_account" :placeholder="__('Tên tài khoản')"/>
                </div>
                <div class="mb-3">
                <label class="control-label">{{ __('Số tài khoản') }}:</label>
                <x-input type="number" name="bank_number" :placeholder="__('Số tài khoản')"/>
                </div>

            </div>
        </div>
    </div>
   
</div>
