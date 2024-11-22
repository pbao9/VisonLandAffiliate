<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('commissionInformation') }}</h2>
        </div>
        <div class="row card-body">
            <!-- direct_commission -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('directCommission') }} :</label>
                    <x-input type="number" name="direct_commission" :value="old('direct_commission')"
                        placeholder="{{ __('directCommission') }}" />
                </div>
            </div>
            <!-- direct_commission_default -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Gián tiếp') }} :</label>
                    <x-input type="number" name="indirect_commission" :value="old('indirect_commission')"
                        placeholder="{{ __('Gián tiếp') }}" />
                </div>
            </div>
        </div>
    </div>
</div>
