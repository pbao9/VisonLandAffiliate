<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('commissionInformation') }}</h2>

        </div>
        <div class="row card-body">
            <!-- direct_commission -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('directCommission') }} :</label>
                    <x-input type="number" name="direct_commission" :value="$commission->direct_commission"
                        placeholder="{{ __('directCommission') }}" />
                </div>
            </div>
            <!-- direct_commission_default -->

            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Gián tiếp') }} :</label>
                    <x-input type="number" name="indirect_commission" :value="$commission->indirect_commission"
                        placeholder="{{ __('Gián tiếp Bậc 0') }}" />
                </div>
            </div>
        </div>
    </div>
</div>
