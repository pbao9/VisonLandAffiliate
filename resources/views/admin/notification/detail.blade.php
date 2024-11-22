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
                            <li class="breadcrumb-item" aria-current="page">{{ __('Thông báo') }}</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Chi tiết thông báo') }}</li>
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
                    <div class="card-title"> {{ $noti->title }}</div>
                </div>
                <div class="card-body">
                    {!! $noti->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
