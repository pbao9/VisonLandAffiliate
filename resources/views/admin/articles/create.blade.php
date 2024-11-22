@extends('admin.layouts.master')
@push('libs-css')
@endpush
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.articles.store')" type="post" :validate="true">
                <div class="row justify-content-center">
                    @include('admin.articles.forms.create-left')
                    @include('admin.articles.forms.create-right')
                </div>
            </x-form>
        </div>
    </div>
@endsection

@push('libs-js')
    <script src="{{ asset('public/libs/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('public/libs/ckeditor/adapters/jquery.js') }}"></script>
    @include('ckfinder::setup')
    @include('admin.articles.scripts.create-script')
    @include('admin.articles.scripts.scripts')
@endpush

@push('custom-js')
    @include('admin.articles.scripts.datatable')
@endpush
