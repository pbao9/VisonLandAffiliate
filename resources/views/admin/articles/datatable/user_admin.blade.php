@php
    $article = App\Models\Articles::find($id);
@endphp

@if ($article && !empty($article->user_id))
    <x-link :href="route('admin.user.edit', $article->articleUser->id)" :title="$article->articleUser->fullname ?? ''"></x-link>
@elseif ($article && !empty($article->admin_id))
    <x-link :href="route('admin.admin.edit', $article->articleAdmin->id)" :title="$article->articleAdmin->fullname ?? ''"></x-link>
@endif
