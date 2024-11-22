<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('push') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between flex-column gap-2">
            <x-link :href="route('admin.areas.create')" class="btn btn-success"><i class="ti ti-plus px-2"></i>{{ __('addArea') }}</x-link>
            <x-button.submit :title="__('update')" />
            <x-button.modal-delete data-route="{{ route('admin.areas.delete', $areas->id) }}" :title="__('delete')" />
        </div>
    </div>
</div>
