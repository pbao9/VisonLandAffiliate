<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('push') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('add')" />
        </div>
    </div>
        <!-- status -->
        <div class="card mb-3">
            <div class="card-header">
                <label class="control-label">{{ __('status') }}:</label>
            </div>
            <div class="card-body">
                <x-select name="status" :required="true">
                    @foreach($status as $key => $value)
                        <x-select-option :value="$key" :title="$value"/>
                    @endforeach
                </x-select>
            </div>
        </div>
</div>
