<script>
    function searchColumsDataTable(datatable) {
        datatable.api().columns([0, 1, 2, 3, 4, 5, 6, 7, 8]).every(function() {
            var column = this;
            var input = document.createElement("input");
            if (column.selector.cols == 8) {
                input = document.createElement("select");
                var myOptions = ["Đã duyệt", "Chưa duyệt"];
                generateSelectOptions(input, myOptions);
            } else if (column.selector.cols == 2) {
                input = document.createElement("select");
                var myOptions = ["Bán", "Thuê"];
                generateSelectOptions(input, myOptions);
            } else if (column.selector.cols == 7) {
                input = document.createElement("select");
                var myOptions = ["Vip", "Thường"];
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
        columns = window.LaravelDataTables["articlesTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>


<script>
    $(document).ready(function() {
        select2LoadData($('#brokerRoute').val(), '.select2-bs5-ajax[name="articles[customer_id][]"]');
    });

    $(document).ready(function() {
        select2LoadData($('#houseTypeRoute').val(), '.select2-bs5-ajax[name="articles[houseType_id][]"]');
    });
</script>
