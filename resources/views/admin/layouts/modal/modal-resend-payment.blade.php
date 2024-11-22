<div class="modal modal-blur fade" id="modalResendPayment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">{{ __('Bạn có chắc?') }}</div>
                <div>{{ __('Gửi thông báo đến người dùng yêu cầu thanh toán lại!') }}</div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto"
                    data-bs-dismiss="modal">{{ __('Hủy') }}</button>
                <x-form id="modalFormResend" action="#" type="delete">
                    <button type="submit" class="btn btn-danger">{{ __('Đồng ý') }}</button>
                </x-form>
            </div>
        </div>
    </div>
</div>
<button type="button" class="d-none" data-bs-toggle="modal"
    data-bs-target="#modalResendPayment">{{ __('OpenModel') }}</button>
