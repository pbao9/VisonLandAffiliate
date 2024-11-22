<span @class([
    'badge',
    \App\Enums\Collaboration\Status::fromValue($status)->badge(),
])>{{ \App\Enums\Collaboration\Status::getDescription($status) }}</span>
