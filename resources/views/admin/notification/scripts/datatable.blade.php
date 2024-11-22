<script>
    function searchColumsDataTable(datatable) {
        datatable.api().columns([0, 1, 2, 3, 4]).every(function() {
            var column = this;
            var input = document.createElement("input");
            if (column.selector.cols == 6) {
                input = document.createElement("input");
            } else if (column.selector.cols == 3) {
                input = document.createElement("select");
                var myOptions = ["Đã xem", "Chưa xem"];
                generateSelectOptions(input, myOptions);
            }

            input.setAttribute('placeholder', 'Nhập từ khóa');
            input.setAttribute('class', 'form-control');

            $(input).appendTo($(column.footer()).empty())
                .on('change', function() {
                    column.search($(this).val(), false, false, true).draw();
                });
        });
    }
    $(document).ready(function() {
        // define columns for the datatables
        columns = window.LaravelDataTables["notificationTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>
<x-input type="hidden" id="userRoute" name="route_search_select_user" :value="route('admin.search.select.user')" />

<script>
    $(document).ready(function() {
        select2LoadData($('#userRoute').val(), '.select2-bs5-ajax[name="user_id[]"]');
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var select = document.querySelector('select[name="status"]');
        var hiddenInput = document.getElementById('status-hidden');

        select.addEventListener('change', function() {
            hiddenInput.value = select.value;
        });
    });
</script>
