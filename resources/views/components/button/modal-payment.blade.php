<button type="button" class="btn {{ $type === 'direct' ? 'btn-primary' : 'btn-secondary' }} open-modal-payment"
    data-bs-toggle="modal" data-bs-target="#modalPayment" data-id="{{ $id }}" data-amount="{{ $amount }}"
    data-type="{{ $type }}">
    <i class="ti ti-send px-2"></i>
    {{ $type === 'direct' ? __('Người nhận hoa hồng trực tiếp') : __('Người nhận hoa hồng gián tiếp') }}
</button>
