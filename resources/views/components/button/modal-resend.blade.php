<button type="button"
    {{ $attributes->class(['btn', 'btn-cyan', 'open-modal-resend-payment'])->merge([
        'data-bs-toggle' => 'modal',
        'data-bs-target' => '#modalResendPayment',
    ]) }}>
    {{ $title ?? '' }}
    {{ $slot }}
</button>
