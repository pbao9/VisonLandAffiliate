<div class="col-12 col-md-9">
    <div class="card mb-3">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin khách hàng đăng ký bài đăng') }}</h2>
            {{--           @dd($customerRegistrations) --}}
        </div>
        <div class="row card-body">
            <!-- customer_id -->
            <div class="col-12">
                <div class="mb-3">
                    <input type="hidden" value="{{ $customerRegistrations->article_id }}" name="article_id">
                    <input type="hidden" value="{{ $customerRegistrations->user_id ?? '' }}" name="user_id">

                    <p class="form-label">Bài đăng:
                        <x-link :href="route('admin.articles.edit', $customerRegistrations->article_id)" :title="$customerRegistrations->articles->title"></x-link>
                    </p>

                    @if ($customerRegistrations->user_id)
                        <p class="form-label">Họ tên thành viên:
                            <x-link :href="route('admin.user.edit', $customerRegistrations->users->id)" :title="$customerRegistrations->users->fullname"></x-link>
                        </p>
                        <p class="form-label">Số điện thoại thành viên: {{ $customerRegistrations->users->phone }}</p>
                        <hr>
                        <p class="form-label">Họ tên đăng ký: {{ $customerRegistrations->fullname }}</p>
                        <p class="form-label">Số điện thoại đăng ký: {{ $customerRegistrations->phone }}</p>
                        <p class="form-label">Nhu cầu: {{ $customerRegistrations->needs }}</p>
                        <hr>
                        <h1>Thông tin người giới thiệu dự án</h1>
                        <p class="form-label">Người giới thiệu dự án:
                            {{ $customerRegistrations->referal->fullname ?? 'Không có' }}
                        </p>
                        <p class="form-label">Số điện thoại người giới thiệu dự án:
                            {{ $customerRegistrations->referal->phone ?? 'Không có' }}</p>
                        <hr>
                        <h1>Thông tin người giới thiệu của thành viên</h1>
                        <p class="form-label">Họ tên người giới thiệu:
                            {{ $customerRegistrations->users->parent->fullname ?? 'Không có' }}
                        </p>
                        <p class="form-label">Số điện thoại người giới thiệu:
                            {{ $customerRegistrations->users->parent->phone ?? 'Không có' }}</p>
                    @else
                        <p class="form-label">Người giới thiệu:
                            {{ $customerRegistrations->referal->fullname ?? 'Không có' }} -
                            {{ $customerRegistrations->referal->phone ?? 'Không có' }}</p>
                        <p class="form-label">Họ tên: {{ $customerRegistrations->fullname }}</p>
                        <p class="form-label">Số điện thoại liên lạc: {{ $customerRegistrations->phone }}</p>
                        <p class="form-label">Nhu cầu: {{ $customerRegistrations->needs }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if ($customerRegistrations->status->value == App\Enums\CustomerRegistration\CustomerRegistrationStatus::Approved)
        <div class="card">
            <div class="card-header card-title">
                <h2 class="mb-0"> {{ __('Thông tin nhận hoa hồng') }}</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            @if ($direct)
                                <div class="card-header card-title">
                                    <h2 class="mb-0"> {{ __('Người nhận hoa hồng trực tiếp') }}</h2>
                                    @if ($direct->remaining_amount != 0)
                                        <x-button.modal-payment type="direct" id="{{ $direct->id ?? '' }}"
                                            amount="{{ $direct->remaining_amount ?? 0 }}" />
                                    @endif
                                </div>
                                <div class="card-body">
                                    <x-link :href="route(
                                        'admin.user.edit',
                                        $customerRegistrations->referal->id ??
                                            $customerRegistrations->users->parent->id,
                                    )" :title="$customerRegistrations->referal->fullname ??
                                        $customerRegistrations->users->parent->fullname"></x-link>
                                    <p>Tiền đã thanh toán: {{ number_format($direct->paid_amount ?? 0) . 'đ' }}</p>
                                    <p>Tiền chưa thanh toán: {{ number_format($direct->remaining_amount ?? 0) . 'đ' }}
                                    </p>
                                </div>
                            @else
                                <div class="card-body">
                                    <p>Thông tin người nhận hoa hồng trực tiếp không có.</p>
                                </div>
                            @endif
                            <div class="card-footer">
                                {{ number_format($cmDirect) . 'đ' }}
                                cho
                                {{ $customerRegistrations->articles->commission->direct_commission . '% hoa hồng nhận được' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">

                            @if ($indirect)
                                <div class="card-header">
                                    <div class="card-title">
                                        {{ __('Người nhận hoa hồng gián tiếp') }}
                                        @if ($indirect->remaining_amount != 0)
                                            <x-button.modal-payment type="indirect" id="{{ $indirect->id ?? '' }}"
                                                amount="{{ $indirect->remaining_amount ?? 0 }}" />
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if ($customerRegistrations->referal)
                                        <x-link :href="route('admin.user.edit', $customerRegistrations->users->parent->id)" :title="$customerRegistrations->users->parent->fullname"></x-link>
                                        <p>Tiền đã thanh toán: {{ number_format($indirect->paid_amount ?? 0) . 'đ' }}
                                        </p>
                                        <p>Tiền chưa thanh toán:
                                            {{ number_format($indirect->remaining_amount ?? 0) . 'đ' }}</p>
                                    @else
                                        <x-link :href="route(
                                            'admin.user.edit',
                                            $customerRegistrations->users->parent->parent->id,
                                        )" :title="$customerRegistrations->users->parent->parent->fullname"></x-link>
                                        <p>Tiền đã thanh toán: {{ number_format($indirect->paid_amount ?? 0) . 'đ' }}
                                        </p>
                                        <p>Tiền chưa thanh toán:
                                            {{ number_format($indirect->remaining_amount ?? 0) . 'đ' }}</p>
                                    @endif
                                </div>
                            @else
                                <div class="card-body">
                                    <p>Thông tin người nhận hoa hồng gián tiếp không có.</p>
                                </div>
                            @endif
                            <div class="card-footer">
                                {{ number_format($cmIndirect) . 'đ' }}
                                cho
                                {{ $customerRegistrations->articles->commission->indirect_commission . '% hoa hồng nhận được' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
