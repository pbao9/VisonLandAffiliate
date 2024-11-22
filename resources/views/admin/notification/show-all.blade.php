@extends('admin.layouts.master')

@push('libs-css')
@endpush

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-muted">{{ __('Dashboard') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('listNotification') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Danh sách thông báo') }}</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table class="table table-vcenter card-table table-striped mb-3 pb-3">
                            <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Ngày gửi</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($noti as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td class="text-secondary">
                                            {!! $item->content !!}
                                        </td>
                                        <td class="text-secondary"><a href="#"
                                                class="text-reset">{{ $item->created_at }}</a>
                                        </td>
                                        <td>
                                            <x-form :action="route('admin.notification.detail', $item->id)">
                                                <button class="btn btn-icon btn-cyan"><i class="ti ti-eye"></i></button>
                                            </x-form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $noti->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
