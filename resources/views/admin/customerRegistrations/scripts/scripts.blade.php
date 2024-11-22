<x-input type="hidden" id="customerRoute" name="route_search_select_customer"  :value="route('admin.search.select.customer')"/>
<x-input type="hidden" id="articleRoute" name="route_search_select_article" :value="route('admin.search.select.article')"/>
<script>
    $(document).ready(function () {
        select2LoadData($('#customerRoute').val(), '.select2-bs5-ajax[name="customer_id"]');
        select2LoadData($('#articleRoute').val(), '.select2-bs5-ajax[name="article_id"]');
    });
</script>
@if(session('hideFields'))
    <script>
        $(document).ready(function() {
       
            $('#status-field, #register-date-field').hide();
        });
    </script>
@endif
