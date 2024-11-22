<script>
    document.addEventListener("DOMContentLoaded", function() {
        var provinceSelect = document.getElementById('provinceSelect');
        var districtSelect = document.getElementById('districtSelect');
        var wardSelect = document.getElementById('wardSelect');

        function fetchDistricts(provinceCode) {
            var appUrl = '{{ env('APP_URL') }}';
            fetch(appUrl + 'admin/articles/get-districts/' + provinceCode)
                .then(response => response.json())
                .then(data => {
                    districtSelect.innerHTML = '';
                    var defaultDistrictOption = document.createElement('option');
                    defaultDistrictOption.text = '{{ __('selectDistrict') }}';
                    defaultDistrictOption.value = '';
                    districtSelect.appendChild(defaultDistrictOption);
                    data.forEach(district => {
                        var option = document.createElement('option');
                        option.value = district.code;
                        option.text = district.name;
                        districtSelect.appendChild(option);
                    });
                    if (districtSelect.dataset.selected) {
                        districtSelect.value = districtSelect.dataset.selected;
                        districtSelect.removeAttribute('data-selected');
                    }
                })
                .catch(error => {
                    console.error('Error fetching districts:', error);
                });
        }

        function fetchWards(districtCode) {
            fetch('/appbds/admin/articles/get-wards/' + districtCode)
                .then(response => response.json())
                .then(data => {
                    wardSelect.innerHTML = '';
                    var defaultWardOption = document.createElement('option');
                    defaultWardOption.text = '{{ __('selectWard') }}';
                    defaultWardOption.value = '';
                    wardSelect.appendChild(defaultWardOption);
                    data.forEach(ward => {
                        var option = document.createElement('option');
                        option.value = ward.code;
                        option.text = ward.name;
                        wardSelect.appendChild(option);
                    });
                    if (wardSelect.dataset.selected) {
                        wardSelect.value = wardSelect.dataset.selected;
                        wardSelect.removeAttribute('data-selected');
                    }
                })
                .catch(error => {
                    console.error('Error fetching wards:', error);
                });
        }

        function addDefaultWardOption() {
            var defaultWardOption = document.createElement('option');
            defaultWardOption.text = '{{ __('selectWard') }}';
            defaultWardOption.value = '';
            wardSelect.innerHTML = '';
            wardSelect.appendChild(defaultWardOption);
        }

        var provinceId = {{ $articles->province_id ?? 'null' }};
        var districtId = {{ $articles->district_id ?? 'null' }};
        var wardId = {{ $articles->ward_id ?? 'null' }};

        if (provinceId) {
            provinceSelect.value = provinceId;
            if (districtId) {
                districtSelect.dataset.selected = districtId;
            }
            if (wardId) {
                wardSelect.dataset.selected = wardId;
            }
            fetchDistricts(provinceId);
        }

        provinceSelect.addEventListener('change', function() {
            var provinceCode = provinceSelect.value;
            if (!provinceCode) {
                return;
            }
            districtSelect.innerHTML = '';
            wardSelect.innerHTML = '';
            var defaultDistrictOption = document.createElement('option');
            defaultDistrictOption.text = '{{ __('selectDistrict') }}';
            defaultDistrictOption.value = '';
            districtSelect.appendChild(defaultDistrictOption);
            var defaultWardOption = document.createElement('option');
            defaultWardOption.text = '{{ __('selectWard') }}';
            defaultWardOption.value = '';
            wardSelect.appendChild(defaultWardOption);
            fetchDistricts(provinceCode);
        });

        districtSelect.addEventListener('change', function() {
            var districtCode = districtSelect.value;
            if (!districtCode) {
                addDefaultWardOption();
                return;
            }
            fetchWards(districtCode);
        });

        if (districtId) {
            fetchWards(districtId);
        }
    });
</script>
