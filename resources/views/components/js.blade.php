<script src="{{ asset('assets/template/src/js/codebase.app.min.js') }}"></script>
<script src="{{ asset('assets/template/src/js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('assets/custom/js/custom.js') }}"></script>

<!-- Page JS Plugins -->
<script src="{{ asset('assets/template/src/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/template/src/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/template/src/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/template/src/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/template/src/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/template/src/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/template/src/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/template/src/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/template/src/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/template/src/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/template/src/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>

<script src="{{ asset('assets/template/src/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/template/src/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/template/src/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<!-- Page JS Code -->
<script src="{{ asset('assets/template/src/js/pages/be_tables_datatables.min.js') }}"></script>

<script>
  Codebase.helpersOnLoad([
    'js-flatpickr',
    'jq-select2',
  ])
</script>

@include('sweetalert::alert')
@stack('javascript')
@include('components.alert-error')