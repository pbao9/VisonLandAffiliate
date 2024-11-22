<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete data-route="{{ route('admin.user.delete', $user->id) }}" :title="__('Xóa')" />
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <div class="card-title">
                {{ __('Mã giới thiệu') }}
            </div>
        </div>
        <div class="card-body p-2">
            <div class="alert alert-info" role="alert">
                {{ $user->code }}
            </div>
        </div>
    </div>


    @if ($user->parent)
        <div class="card mb-3">
            <div class="card-header">
                <div class="card-title">
                    {{ __('Người giới thiệu') }}
                </div>
            </div>
            <div class="card-body p-2">
                <div class="alert alert-success" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="icon alert-icon">
                                <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                                <path
                                    d="M19.9975 18C20 17.8358 20 17.669 20 17.5C20 15.0147 16.4183 13 12 13C7.58172 13 4 15.0147 4 17.5C4 19.9853 4 22 12 22C14.231 22 15.8398 21.8433 17 21.5634"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div>
                            <x-link :href="route('admin.user.edit', $user->parent->id)" :title="$user->parent->fullname . ' - ' . $user->parent->phone" class="nav-link"></x-link>
                            {{-- {{ ($user->parent->fullname ?? '') . ' - ' . ($user->parent->phone ?? '') }} --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endif

    <!-- gender -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Giới tính') }}
        </div>
        <div class="card-body p-2">
            <x-select name="gender" :required="true">
                <x-select-option value="" :title="__('Chọn Giới tính')" />
                @foreach ($gender as $key => $value)
                    <x-select-option :option="$user->gender->value" :value="$key" :title="__($value)" />
                @endforeach
            </x-select>
        </div>

    </div>
    <!-- Status -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Tình trạng') }}
        </div>
        <div class="card-body p-2">
            <x-select name="active" :required="true">

                @foreach ($Active as $key => $value)
                    <x-select-option :option="$user->active" :value="$key" :selected="$user->active == $key" :title="__($value)" />
                @endforeach
            </x-select>
        </div>
    </div>

    <!-- vip -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Vai trò') }}
        </div>
        <div class="card-body p-2">
            <x-select name="roles" :required="true">
                <x-select-option value="" :title="__('Chọn vai trò')" />
                @foreach ($roles as $key => $value)
                    <x-select-option :option="$user->roles->value" :value="$key" :title="__($value)" />
                @endforeach
            </x-select>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            {{ __('Định danh') }}
        </div>
        <div class="card-body p-2">
            <x-select name="identifier" :required="true">
                @foreach ($identifier as $key => $value)
                    <x-select-option :option="$user->identifier" :value="$key" :selected="$user->identifier == $key" :title="__($value)" />
                @endforeach
            </x-select>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh đại diện') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="avatar" showImage="avatar" :value="$user->avatar" />
        </div>
    </div>
</div>
