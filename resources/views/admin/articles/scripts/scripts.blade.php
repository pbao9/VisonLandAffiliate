<x-input type="hidden" id="brokerRoute" name="route_search_select_broker" :value="route('admin.search.select.broker')" />

<x-input type="hidden" id="houseTypeRoute" name="route_search_select_house_type" :value="route('admin.search.select.houseType')" />
<x-input type="hidden" id="areaRoute" name="route_search_select_area" :value="route('admin.search.select.area')" />
<x-input type="hidden" id="provinceRoute" name="route_search_select_province" :value="route('admin.search.select.province')" />
<x-input type="hidden" id="districtRoute" name="route_search_select_district" :value="route('admin.search.select.district')" />

<script>
    $(document).ready(function() {
        select2LoadData($('#brokerRoute').val(), '.select2-bs5-ajax[name="broker_id"]');
        select2LoadData($('#houseTypeRoute').val(), '.select2-bs5-ajax[name="houseType_id[]"]');
        select2LoadData($('#areaRoute').val(), '.select2-bs5-ajax[name="area_id"]');
        select2LoadData($('#provinceRoute').val(), '.select2-bs5-ajax[name="province_id"]');
        select2LoadData($('#districtRoute').val(), '.select2-bs5-ajax[name="district_id"]');
        select2LoadData($('#wardRoute').val(), '.select2-bs5-ajax[name="ward_id"]');
    });
</script>

<script>
    $(document).on('change', 'select[name="province_id"]', function(e) {
        let provinceId = $(this).val();
        let url = "{{ route('admin.search.select.district') }}";
        select2LoadData(url + '?province_id=' + provinceId, '#district_id');
    });

    $(document).on('change', 'select[name="district_id"]', function(e) {
        let districtId = $(this).val();
        let urlWard = "{{ route('admin.search.select.ward') }}";
        select2LoadData(urlWard + '?district_id=' + districtId, '#ward_id');
    });
</script>
