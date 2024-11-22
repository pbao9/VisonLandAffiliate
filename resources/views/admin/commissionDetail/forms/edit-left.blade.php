<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('editInformation') }}</h2>
           
        </div>
        <div class="row card-body">
            <!-- total_amount -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('total') }} <span style="color:red;">*</span>:</label>
                    <x-input id="total_amount" type="number" name="total_amount" :value="$commission_detail->total_amount" 
                        :required="true" placeholder="{{ __('total') }}" readonly/>
                </div>
            </div>
            <!-- amount_paid -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('amountPaid') }} <span style="color:red;">*</span>:</label>
                    <x-input id="amount_paid" type="number" name="amount_paid" :value="$commission_detail->amount_paid" 
                        :required="true" placeholder="{{ __('amountPaid') }}" />
                </div>
            </div><!-- amount_percent -->
           <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('percent') }} <span style="color:red;">*</span>:</label>
                    <x-input id="amount_percent" type="text" name="amount_percent" value="{{ $commission_detail->amount_percent }}" 
                        :required="true" placeholder="{{ __('percent') }}" readonly />
                </div>
            </div>
            <!-- status -->
            <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('status') }}:</label>
                <x-select name="status" :required="true">
                    <x-select-option value="" :title="__('selectStatus')"/>
                    @foreach ($status as $key => $value)
                        <x-select-option :value="$key" :title="__($value)" :selected="$commission_detail->status == $key"/>
                    @endforeach
                </x-select>
            </div>
        </div>
        </div>
    </div>
</div>