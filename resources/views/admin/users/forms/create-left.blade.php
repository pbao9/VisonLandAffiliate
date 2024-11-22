<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin thành viên') }}</h2>
        </div>
        <div class="row card-body">
            <!-- Fullname -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Họ và tên') }}:</label>
                    <x-input name="fullname" :value="old('fullname')" :required="true"
                        placeholder="{{ __('Họ và tên') }}" />
                </div>
            </div>
            <!-- email -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Email') }}:</label>
                    <x-input-email name="email" :value="old('email')" :required="true" />
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày sinh') }}:</label>
                    <x-input type="date" name="birthday" :placeholder=" __('Ngày cấp') " />
                </div>
            </div>
            <!-- phone -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số điện thoại') }}:</label>
                    <x-input-phone name="phone" :value="old('phone')" :required="true" />
                </div>
            </div>
            <!-- address -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Địa chỉ') }}:</label>
                    <x-input name="address" :value="old('address')" :placeholder="__('Địa chỉ')" />
                </div>
            </div>
            <!-- new password -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mật khẩu') }}:</label>
                    <x-input-password name="password" :required="true" />
                </div>
            </div>
            <!-- new password confirmation-->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Xác nhận mật khẩu') }}:</label>
                    <x-input-password name="password_confirmation" :required="true"
                        data-parsley-equalto="input[name='password']"
                        data-parsley-equalto-message="{{ __('Mật khẩu không khớp.') }}" />
                </div>
            </div>

        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Định Danh') }}</h2>
        </div>
        <div class="row card-body">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ảnh chụp CCCD 2 mặt') }}:</label>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 text-center" style="display: flex;flex-direction: column;">
                            <label style="text-align:left">{{ __('Mặt trước CCCD') }}:</label>
                            <div style="text-align: left;">
                                <x-input-image-ckfinder
                                    name="cccd_front_image"
                                    showImage="cccd_front_image" />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 text-center">
                            <label>{{ __('Mặt sau CCCD') }}:</label>
                            <div style="display: flex;justify-content: center;">

                                <x-input-image-ckfinder
                                    name="cccd_back_image"
                                    showImage="cccd_back_image" />

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('numberCCCD') }}:</label>
                    <x-input type="number" name="cccd_number" :placeholder="__('numberCCCD')" />
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày cấp') }}:</label>
                    <x-input type="date" name="issued_day" :placeholder=" __('Ngày cấp') " />
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Nơi cấp') }}:</label>
                    <x-input name="issued_by" :placeholder=" __('Nơi cấp') " />
                </div>
            </div>
        </div>
    </div>
</div>