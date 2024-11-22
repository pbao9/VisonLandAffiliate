<span @class([
    'badge',
    \App\Enums\Article\ArticleArticleStatus::fromValue($active_status)->badge(),
])>{{ \App\Enums\Article\ArticleArticleStatus::getDescription($active_status) }}</span>
