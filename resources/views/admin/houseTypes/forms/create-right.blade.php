<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('push') }}
        </div>
        <div class="card-body p-2">
            <x-button.submit :title="__('add')" />
            <x-link :href="route('admin.articles.create')" class="btn btn-warning">
                <i class="ti ti-arrow-back-up pe-2"></i>
                {{ __('return') }}
            </x-link>
        </div>
    </div>
</div>
