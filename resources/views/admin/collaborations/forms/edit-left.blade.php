<div class="col-12 col-md-9">
    <div class="card mb-3">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin khách hàng đăng ký bài đăng') }}</h2>
            {{--           @dd($collaborations) --}}
        </div>
        <div class="row card-body">
            <!-- customer_id -->
            <div class="col-12">
                <div class="mb-3">
                    <input type="hidden" value="{{ $collaborations->article_id }}" name="article_id">
                    <input type="hidden" value="{{ $collaborations->user_id ?? '' }}" name="user_id">

                    <p class="form-label">Bài đăng:
                        <x-link :href="route('admin.articles.edit', $collaborations->article_id)" :title="$collaborations->articles->title"></x-link>
                    </p>

                    <p class="form-label">Họ tên thành viên:
                        <x-link :href="route('admin.user.edit', $collaborations->users->id)" :title="$collaborations->users->fullname"></x-link>
                    </p>
                    <p class="form-label">Số điện thoại thành viên: {{ $collaborations->users->phone }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
