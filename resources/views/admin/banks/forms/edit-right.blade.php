<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
                <x-input type="hidden" name="id" :value="$bank->id" />
                <x-link :href="route('admin.user.edit', $bank->id_user)" class="btn btn-warning">
                <i class="ti ti-arrow-back-up pe-2"></i>
                {{ __('return') }}
            </x-link>
        </div>
    </div>

    

</div>
