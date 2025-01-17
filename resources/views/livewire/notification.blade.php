<div class="card mt-3">
    <div class="card-header bg-cyan">
        <div class="card-title text-center text-white text-uppercase">
            <span> {{ 'Thông báo' }}</span>
        </div>
    </div>
    <div class="card-body">
        <div wire:poll.keep-alive.5s="pollNotifications">
            @foreach ($data as $item)
                <div class="alert alert-success">
                    <div class="d-flex justify-content-between">
                        <x-link :href="route('admin.notification.detail', $item->id)" :title="$item->title" class="nav-link" />
                        {{ $item->status }}
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-end"> {{ $data->links() }}</div>
        </div>
    </div>
</div>
