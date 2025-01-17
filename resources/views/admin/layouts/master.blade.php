<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('admin.layouts.head')
    @livewireStyles
</head>

<body>
    <div class="page">
        <x-admin-sidebar-left />
        @include('admin.layouts.sidebar-top')
        <div class="page-wrapper">
            @section('breadcrumbs')
                @include('admin.layouts.partials.breadcrumbs')
            @show
            @yield('content')
            @include('admin.layouts.footer')
            @include('admin.layouts.modal.modal-logout')
            @include('admin.layouts.modal.modal-delete')
        </div>
    </div>
    @livewireScripts
    @include('admin.layouts.scripts')
    @include('admin.notification.scripts.firebase-script')

    <x-alert />
</body>

</html>
