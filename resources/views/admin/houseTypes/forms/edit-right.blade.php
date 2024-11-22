<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header justify-content-between align-items-center">
            {{ __('push') }}
            <x-link :href="route('admin.houses-type.create')" class="btn btn-success">
                <i class="ti ti-plus"></i>
                {{ __('add') }}
            </x-link>
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('update')" />
            <x-button.modal-delete data-route="{{ route('admin.houses-type.delete', $houseType->id) }}"
                :title="__('delete')" />
            <x-link :href="route('admin.articles.create')" class="btn btn-warning">
                <i class="ti ti-arrow-back-up pe-2"></i>
                {{ __('return') }}
            </x-link>
        </div>
    </div>
</div>
