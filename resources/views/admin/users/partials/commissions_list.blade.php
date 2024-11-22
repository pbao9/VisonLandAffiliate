

@foreach ($commission as $item)
    <div class="card mb-3">
        <div class="card-header">
            <div class="card-title">
                <p>Dự án tham gia: {{ $item->customerRegistrations->articles->title }}</p>
            </div>
        </div>
        <div class="card-body">
            <p>Tổng tiền dự án: {{ number_format($item->total_amount) }}</p>
            <p>Tiền đã thanh toán: {{ number_format($item->paid_amount) }} </p>
            <p>Tiền chưa thanh toán: {{ number_format($item->remaining_amount) }}</p>
            <p>Người đăng ký dự án: {{ $item->customerRegistrations->users->fullname }}</p>
        </div>
    </div>
@endforeach



<!-- Hiển thị phân trang -->
{{ $commission->links() }}
