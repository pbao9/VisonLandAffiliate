<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="account-info-tab" data-bs-toggle="tab" href="#account-info"
                        role="tab" aria-controls="account-info"
                        aria-selected="true">{{ __('Thông tin Thành viên') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="bank-info-tab" data-bs-toggle="tab" href="#bank-info" role="tab"
                        aria-controls="bank-info" aria-selected="false">{{ __('Thông tin Ngân hàng') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="subordinate-list-tab" data-bs-toggle="tab" href="#subordinate-list"
                        role="tab" aria-controls="subordinate-list"
                        aria-selected="false">{{ __('Danh sách cấp dưới') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="commission-list-tab" data-bs-toggle="tab" href="#commission-list"
                        role="tab" aria-controls="commission-list" aria-selected="false">{{ __('Hoa hồng') }}</a>
                </li>
            </ul>
        </div>
        <div class="tab-content card-body" id="myTabContent">
            <!-- Thông tin Thành viên -->
            <div class="tab-pane fade show active" id="account-info" role="tabpanel" aria-labelledby="account-info-tab">
                <div class="row">
                    <!-- Fullname -->
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="control-label">{{ __('Họ và tên') }}:</label>
                            <x-input name="fullname" :value="$user->fullname" :required="true"
                                placeholder="{{ __('Họ và tên') }}" />
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="control-label">{{ __('Email') }}:</label>
                            <x-input-email name="email" :value="$user->email" :required="true" />
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="mb-3">
                            <label class="control-label">{{ __('Ngày sinh') }}:</label>
                            <x-input type="date" name="birthday" :value="$user->birthday" :placeholder="__('Ngày cấp')" />
                        </div>
                    </div>
                    <!-- Phone -->
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="control-label">{{ __('Số điện thoại') }}:</label>
                            <x-input-phone name="phone" :value="$user->phone" :required="true" />
                        </div>
                    </div>
                    <!-- Address -->
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="control-label">{{ __('Địa chỉ') }}:</label>
                            <x-input name="address" :value="$user->address" :placeholder="__('Địa chỉ')" />
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="control-label">{{ __('Mật khẩu') }}:</label>
                            <x-input-password name="password" />
                        </div>
                    </div>
                    <!-- Password Confirmation -->
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="control-label">{{ __('Xác nhận mật khẩu') }}:</label>
                            <x-input-password name="password_confirmation" data-parsley-equalto="input[name='password']"
                                data-parsley-equalto-message="{{ __('Mật khẩu không khớp.') }}" />
                        </div>
                    </div>
                </div>
                <!-- Thông tin Định Danh -->
                <div class="card mt-3">
                    <div class="card-header justify-content-center">
                        <h2 class="mb-0">{{ __('Thông tin Định Danh') }}</h2>
                    </div>
                    <div class="row card-body">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Ảnh chụp CCCD 2 mặt') }}:</label>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 text-center">
                                        <label style="text-align:left">{{ __('Mặt trước CCCD') }}:</label>
                                        <x-input-image-ckfinder name="cccd_front_image" showImage="cccd_front_image"
                                            :value="$user->cccd_front_image" />
                                    </div>
                                    <!-- CCCD Back -->
                                    <div class="col-md-6 col-sm-12 text-center">
                                        <label style="text-align:left">{{ __('Mặt sau CCCD') }}:</label>
                                        <x-input-image-ckfinder name="cccd_back_image" showImage="cccd_back_image"
                                            :value="$user->cccd_back_image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- CCCD Number -->
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('numberCCCD') }}:</label>
                                <x-input type="number" name="cccd_number" :value="$user->cccd_number" :placeholder="__('numberCCCD')" />
                            </div>
                        </div>
                        <!-- Issued Date -->
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Ngày cấp') }}:</label>
                                <x-input type="date" name="issued_day" :value="$user->issued_day" :placeholder="__('Ngày cấp')" />
                            </div>
                        </div>
                        <!-- Issued By -->
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Nơi cấp') }}:</label>
                                <x-input name="issued_by" :placeholder="__('Nơi cấp')" :value="$user->issued_by" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông tin Ngân hàng -->
            <div class="tab-pane fade" id="bank-info" role="tabpanel" aria-labelledby="bank-info-tab">
                <div class="container mt-5">
                    <h3 class="mb-4">Tài khoản thụ hưởng</h3>
                    <ul class="list-group mb-3">
                        @foreach ($bank as $banks)
                            <li class="list-group-item d-flex justify-content-between align-items-center mb-3"
                                style="border-top:1px solid #e6e7e9">
                                <span>{{ $banks['bank_name'] }}</span>
                                <span>{{ $banks['bank_number'] }}</span>
                                <x-link :href="route('admin.user.EditPayment', $banks['id'])" class="text-decoration-none">&#8250;</x-link>
                            </li>
                        @endforeach
                    </ul>
                    <div class="text-left mt-4">
                        <x-link :href="route('admin.user.AddPayInformation', $user->id)" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Thêm tài khoản
                        </x-link>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="subordinate-list" role="tabpanel" aria-labelledby="subordinate-list-tab">
                <div class="accordion" id="subordinateAccordion">
                    @foreach ($parent as $key => $subordinate)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $key }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $key }}" aria-expanded="true"
                                    aria-controls="collapse{{ $key }}">
                                    {{ $subordinate['fullname'] }}
                                </button>
                            </h2>
                            <div id="collapse{{ $key }}" class="accordion-collapse collapse"
                                aria-labelledby="heading{{ $key }}" data-bs-parent="#subordinateAccordion">
                                <div class="accordion-body">
                                    <!-- Avatar -->
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ asset($subordinate['avatar']) }}" alt="Avatar"
                                            class="rounded-circle" width="50" height="50">

                                        <h5 class="ms-3">{{ $subordinate['fullname'] }}</h5>
                                    </div>

                                    <!-- Other Info -->
                                    <p><strong>{{ __('Số điện thoại') }}:</strong> {{ $subordinate['phone'] }}</p>
                                    <p><strong>{{ __('Email') }}:</strong> {{ $subordinate['email'] }}</p>
                                    <p><strong>{{ __('Ngày sinh nhật') }}:</strong> {{ $subordinate['Birthday'] }}</p>
                                    <p><strong>{{ __('Địa chỉ') }}:</strong> {{ $subordinate['address'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="tab-pane fade" id="commission-list" role="tabpanel" aria-labelledby="commission-list-tab">
                <div class="row mb-3">
                    <div class="col-md-6 col-12">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M17 17h-11v-14h-2"></path>
                                                <path d="M6 5l14 1l-1 7h-13"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ __('Hoa hồng trực tiếp') }}
                                        </div>
                                        <div class="text-secondary">
                                            {{ number_format($totalDirect) . 'đ' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M17 17h-11v-14h-2"></path>
                                                <path d="M6 5l14 1l-1 7h-13"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ __('Hoa hồng gián tiếp') }}
                                        </div>
                                        <div class="text-secondary">
                                            {{ number_format($totalIndirect) . ' đ' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="commissions-container">
                    @include('admin.users.partials.commissions_list', [
                        'commission' => $commission,
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
