@extends('admin.layouts.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Trang chủ trình quản lý') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h2>{{ __('Dashboard') }}</h2>
                        </div>
                        <div class="card-body">


                            <div class="col-12">
                                <div class="row row-cards">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-users"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="customerRegistrations">Quản lý đăng ký khách hàng</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountCustomerRegistrations }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-bell"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="notification">Thông báo</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountNotification }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-address-book"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="contact_admin">Admin Liên hệ</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountContact_admin }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-article"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="articles">Bài đăng</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountArticles }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-brand-cashapp"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="commission">Hoa hồng</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountCommission }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-article"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="commissionDetail">Hoa hồng chi tiết</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountCommission_detail }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
