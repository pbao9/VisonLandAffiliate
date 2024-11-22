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
                    <x-select class="select2-bs5-ajax" name="user_id" :required="true">
                    </x-select>
                </div>
            </div><!-- article_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label>{{ __('Chọn bài đăng') }}</label>
                    <x-select class="select2-bs5-ajax" name="article_id" :required="true">
                    </x-select>
                </div>
            </div>
        </div>
    </div>
</div>
