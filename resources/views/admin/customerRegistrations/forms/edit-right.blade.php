<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete
                data-route="{{ route('admin.customerRegistration.delete', $customerRegistrations->id) }}"
                :title="__('Xóa')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <label class="control-label">{{ __('Tiền bán được') }} <span style="color:red;">*</span>:</label>
        </div>
        <div class="card-body p-2">
            <x-input class="priceFormat" id="priceFormat" :value="number_format($customerRegistrations->amount_sold)" :placeholder="__('Tiền bán được')" />
            <input type="hidden" name="amount_sold" class="hiddenCurrency"
                value="{{ $customerRegistrations->amount_sold }}">
        </div>
    </div>
    <div class="card mb-3" id="status-field">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select name="status" :required="true">
                <x-select-option value="" :title="__('Trạng thái')" />
                @foreach ($status as $key => $value)
                    <x-select-option :option="$customerRegistrations->status->value" :value="$key" :title="__($value)" />
                @endforeach
            </x-select>
        </div>
    </div>
</div>
