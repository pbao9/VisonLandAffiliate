<script src="{{ asset('public/libs/tabler/dist/js/tabler.min.js') }}" defer></script>
<script src="{{ asset('public/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('public/libs/Parsley.js-2.9.2/parsley.min.js') }}"></script>
<!-- datatables -->
<script src="{{ asset('/public/libs/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('/public/libs/datatables/plugins/bs5/js/dataTables.bootstrap5.min.js') }}"></script>

<script src="{{ asset('/public/libs/datatables/plugins/buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/public/libs/datatables/plugins/buttons/js/buttons.bootstrap5.min.js') }}"></script>

<script src="{{ asset('/public/libs/datatables/plugins/responsive/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ asset('/public/libs/datatables/plugins/responsive/js/responsive.bootstrap5.min.js') }}"></script>

<script src="{{ asset('/public/libs/select2/dist/js/select2.full.min.js') }}"></script>
@stack('libs-js')
<script src="{{ asset('/public/libs/firebase/firebase.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/setup.js') }}"></script>
{{-- <script src="{{ asset('public/admin/assets/js/province.js') }}"></script> --}}

@stack('custom-js')
