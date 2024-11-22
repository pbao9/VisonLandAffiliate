<div class="modal modal-blur fade" id="modalPayment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <x-form :action="route('admin.commissionDetail.update')" type="put" :validate="true" class="modal-content">
            <div class="modal-body">
                <div class="modal-title">{{ __('Tiền đã thanh toán') }}</div>
                <div class="mb-3">{{ __('Cập nhật tiền thanh toán') }}</div>
                <p class="amount_remaining"></p>
                <x-input type="text" class="priceFormat" placeholder="{{ __('Cập nhật số tiền đã chuyển') }}" />
                <input type="hidden" name="paid_amount" class="hiddenCurrency">
                <input type="hidden" name="id" value="{{ $id ?? '' }}" />
                <input type="hidden" name="type" value="{{ $type ?? '' }}" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto nav-link"
                    data-bs-dismiss="modal">{{ __('Hủy') }}</button>
                <button type="submit" class="btn btn-success">{{ __('Cập nhật') }}</button>
            </div>
        </x-form>
    </div>
</div>
