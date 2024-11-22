<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('informationContactAdmin') }}</h2>
        </div>
        <div class="row card-body">
        <!-- admin_id -->
            <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Mã người quản lý') }}:</label>
                <x-select name="admin_id" :required="true">
    				<x-select-option value="" title="" />

				</x-select>
            </div>
        </div><!-- fullname -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Họ tên') }} <span style="color:red;">*</span>:</label>
                    <x-input name="fullname" :value="old('fullname')" 
                        :required="true" placeholder="{{ __('Họ tên') }}" />
                </div>
            </div><!-- phone -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số điện thoại') }} <span style="color:red;">*</span>:</label>
                    <x-input type="number" name="phone" :value="old('phone')" 
                        :required="true" placeholder="{{ __('Số điện thoại') }}" />
                </div>
            </div><!-- referral_code -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã giới thiệu') }} <span style="color:red;">*</span>:</label>
                    <x-input name="referral_code" :value="old('referral_code')" 
                        :required="true" placeholder="{{ __('Mã giới thiệu') }}" />
                </div>
            </div><!-- status -->
            <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Trạng thái') }}:</label>
                <x-select name="status" >
    				<x-select-option value="Đã thực hiện" title="Đã thực hiện" />
<x-select-option value="Chưa xử lý" title="Chưa xử lý" />
<x-select-option value="Cần trao đổi thêm" title="Cần trao đổi thêm" />

				</x-select>
            </div>
        </div>

        </div>
    </div>
</div>