<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thêm Khách Hàng') }}</h2>
        </div>
        <div class="row card-body">
            <!-- customer_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label>{{ __('Chọn khách hàng') }}</label>
                    <x-select class="select2-bs5-ajax" name="customer_id" :required="true">
                    </x-select>
                </div>
            </div><!-- article_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label>{{ __('Chọn bài đăng') }}</label>
                    <x-select class="select2-bs5-ajax" name="article_id" :required="true">
                    </x-select>
                </div>
            </div><!-- status -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Trạng thái') }}:</label>
                    <x-select name="status" :required="true">
                        <x-select-option value="" :title="__('Chọn Trạng thái')" />
                        @foreach ($status as $key => $value)
                            <x-select-option :value="$key" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>
            </div>

        </div>
    </div>
</div>
