<div class="nav-item dropdown d-none d-md-flex me-3">
    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications"
        aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
            <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
        </svg>
        @if (!empty($noti) && !$noti->isEmpty())
            <span class="badge bg-red badge-blink">
                @if ($noti->count() >= 10)
                    {{ $noti->count() . '+' }}
                @else
                    {{ $noti->count() }}
                @endif
            </span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card" style="width: 530px">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3 class="card-title">{{ __('Thông báo') }}</h3>
                @if (!empty($noti) && !$noti->isEmpty())
                    <x-link :href="route('admin.notification.readAll')" :title="__('Đánh dấu đã xem tất cả')" class="nav-link small"></x-link>
                @endif
            </div>
            <div class="card-body" style="height: 450px; overflow: auto;">
                <div class="list-group list-group-flush list-group-hoverable">
                    @if (empty($noti) || $noti->isEmpty())
                        <p class="p-4 text-center mb-0">Không có thông báo nào</p>
                    @else
                        @foreach ($noti as $item)
                            <x-link :href="route('admin.notification.detail', $item->id)" class="nav-link">
                                <div class="list-group-item" style="max-width: 530px; width: 100%">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span
                                                class="status-dot status-dot-animated bg-red d-block"></span>
                                        </div>
                                        <div class="col text-truncate">
                                            <span
                                                class="text-body d-block text-truncate mb-2">{{ $item->title }}</span>
                                            <div class="d-block text-secondary text-truncate mt-n1"
                                                style="max-height: 250px">
                                                {!! $item->content !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </x-link>
                        @endforeach
                    @endif

                </div>
            </div>


            <div class="card-footer">
                <x-link :href="route('admin.notification.showAll')" :title="__('Xem toàn bộ')"></x-link>
            </div>
        </div>
    </div>
</div>
