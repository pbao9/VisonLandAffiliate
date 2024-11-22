<div class="d-flex flex-column">
    @if ($articles->payment)
        <a class="mb-3" href="{{ asset($articles->payment->document ?? config('custom.images.default')) }}"
            data-fancybox data-caption="Ảnh thanh toán của {{ $articles->articleUser->fullname }}">
            <img src="{{ asset($articles->payment->document ?? config('custom.images.default')) }}" />
        </a>
        <div class="d-flex">
            @if ($articles->active_status === App\Enums\Article\ArticleArticleStatus::Pending)
                <x-button.modal-resend
                    data-route="{{ route('admin.articles.deletePayment', $articles->payment->article_id ?? $articles->id) }}"
                    :title="__('Yêu cầu thanh toán lại!')" />
            @endif
        </div>
    @endif
</div>



<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />


<script>
    Fancybox.bind("[data-fancybox]", {});
</script>
