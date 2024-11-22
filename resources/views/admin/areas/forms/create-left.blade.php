<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('informationArea') }}</h2>
        </div>
        <div class="row card-body">
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('articleArea') }} <span style="color:red;">*</span>:</label>
                    <x-input name="name" :value="old('name')" :required="true" placeholder="{{ __('articleArea') }}"
                        onpaste="return false;" />
                </div>
            </div>
        </div>
    </div>
</div>
