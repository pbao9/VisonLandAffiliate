<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('informationNotification') }}</h2>
        </div>
        <div class="row card-body">
        <!-- user_id -->
            <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('userCode') }}:</label>
                <x-select name="user_id[]" class="select2-bs5-ajax" :data-url="route('admin.search.select.user')" multiple></x-select>

            </div>
        </div><!-- title -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('title') }} :</label>
                    <x-input name="title" :value="old('title')"
                         placeholder="{{ __('title') }}" />
                </div>
            </div><!-- content -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('content') }}:</label>
                    <textarea name="content" class="ckeditor visually-hidden">{{ old('content') }}</textarea>
                </div>
            </div>
        </div>
        </div>
</div>
