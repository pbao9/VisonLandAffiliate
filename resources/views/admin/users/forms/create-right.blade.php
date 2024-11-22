<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2">
            <x-button.submit :title="__('Thêm')" />
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            {{ __('Mã giới thiệu') }}
        </div>
        <div class="card-body p-2">
            <x-input name="referal_code" :value="old('referal_code')" placeholder="{{ __('Mã giới thiệu') }}" />
        </div>
    </div>


    <div class="card mb-3">
        <div class="card-header">
            {{ __('Giới tính') }}
        </div>
        <div class="card-body">
            <x-select name="gender" :required="true">
                <x-select-option value="" :title="__('Chọn Giới tính')" />
                @foreach ($gender as $key => $value)
                    <x-select-option :value="$key" :title="__($value)" />
                @endforeach
            </x-select>
        </div>

    </div>

    <div class="card mb-3">
        <div class="card-header">
            {{ __('Vai trò') }}
        </div>
        <div class="card-body">
            <x-select name="roles" :required="true">
                <x-select-option value="" :title="__('Chọn vai trò')" />
                @foreach ($roles as $key => $value)
                    <x-select-option :value="$key" :title="__($value)" />
                @endforeach
            </x-select>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh đại diện') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="avatar" showImage="image" />
        </div>
    </div>

</div>
