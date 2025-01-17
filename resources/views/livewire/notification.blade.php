<div class="my-5" wire:poll.keep-alive.5s="pollNotifications">
    <div class="alert alert-info">
        Admin: {{ $admin->name }}
    </div>
    @foreach ($data as $item)
        <div class="alert alert-success">
            {{ $item->title }}
        </div>
    @endforeach
    <div class="mt-4"> {{ $data->links() }}</div>


</div>
