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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Sửa Thành viên') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.user.update')" type="put" :validate="true">
                <x-input type="hidden" name="id" :value="$user->id" />
                <div class="row justify-content-center">
                    @include('admin.users.forms.edit-left', ['user' => $user])
                    @include('admin.users.forms.edit-right', ['user' => $user])
                </div>
            </x-form>
        </div>
    </div>
@endsection

@push('libs-js')
    @include('ckfinder::setup')
    @include('admin.users.scripts.edit')
@endpush


@push('custom-js')
    <script>
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();

            var url = $(this).attr("href");
            fetchCommissions(url);
        });

        function fetchCommissions(url) {
            $.ajax({
                type: "GET",
                url: url,
                dataType: "html",
                success: function(response) {
                    $('#commissions-container').html(response);
                }
            });
        }
    </script>
@endpush
