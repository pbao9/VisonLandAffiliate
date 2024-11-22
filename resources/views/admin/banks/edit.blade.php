@extends('admin.layouts.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-muted">{{ __('Dashboard') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Sửa Tài khoản thụ hưởng') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.user.UpdatePayment')" type="put" :validate="true">
                <x-input type="hidden" name="Id" :value="$bank->id" />
                <div class="row justify-content-center">
                    @include('admin.banks.forms.edit-left', ['bank' => $bank])
                    @include('admin.banks.forms.edit-right', ['bank' => $bank])
                </div>
            </x-form>
        </div>
    </div>
@endsection

@push('libs-js')
   
    @include('ckfinder::setup')
    @include('admin.users.scripts.edit')

@endpush