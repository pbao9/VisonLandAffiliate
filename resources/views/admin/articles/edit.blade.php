@extends('admin.layouts.master')
@push('libs-css')
@endpush
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.articles.update')" type="put" :validate="true">
                <x-input type="hidden" name="id" :value="$articles->id" />
                <div class="row justify-content-center">
                    @include('admin.articles.forms.edit-left')
                    @include('admin.articles.forms.edit-right')
                </div>
            </x-form>
        </div>
    </div>
    @include('admin.layouts.modal.modal-resend-payment')
@endsection

@push('libs-js')
    <script src="{{ asset('public/libs/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('public/libs/ckeditor/adapters/jquery.js') }}"></script>
    @include('ckfinder::setup')
    @include('admin.articles.scripts.edit-script')
    @include('admin.articles.scripts.scripts')
@endpush

@push('custom-js')
    @include('admin.articles.scripts.datatable')
@endpush
