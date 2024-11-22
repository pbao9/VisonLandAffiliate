<script>
    document.addEventListener("DOMContentLoaded", function() {
        var provinceSelect = document.getElementById('provinceSelect');
        var districtSelect = document.getElementById('districtSelect');
        var wardSelect = document.getElementById('wardSelect');

        function fetchDistricts(provinceCode) {
            var appUrl = '{{ env('APP_URL') }}';
            fetch(appUrl+'admin/articles/get-districts/' + provinceCode)
                .then(response => response.json())
                .then(data => {
                    districtSelect.innerHTML = '';
                    var defaultDistrictOption = document.createElement('option');
                    defaultDistrictOption.text = '{{ __('selectDistrict') }}';
                    districtSelect.appendChild(defaultDistrictOption);
                    data.forEach(district => {
                        var option = document.createElement('option');
                        option.value = district.code;
                        option.text = district.name;
                        districtSelect.appendChild(option);
                    });

                    // Add code to ensure "Select Ward" option is displayed
                    wardSelect.innerHTML = '';
                    var defaultWardOption = document.createElement('option');
                    defaultWardOption.text = '{{ __('selectWard') }}';
                    wardSelect.appendChild(defaultWardOption);
                })
                .catch(error => {
                    console.error('Error fetching districts:', error);
                });
        }

        function addDefaultWardOption() {
            var defaultWardOption = document.createElement('option');
            defaultWardOption.text = '{{ __('selectWard') }}';
            wardSelect.innerHTML = '';
            wardSelect.appendChild(defaultWardOption);
        }

        fetchDistricts(1);

        provinceSelect.addEventListener('change', function() {
            var provinceCode = provinceSelect.value;
            fetchDistricts(provinceCode);
            addDefaultWardOption();
        });

        districtSelect.addEventListener('change', function() {
            var districtCode = districtSelect.value;
            fetch('/appbds/admin/articles/get-wards/' + districtCode)
                .then(response => response.json())
                .then(data => {
                    wardSelect.innerHTML = '';
                    addDefaultWardOption();
                    data.forEach(ward => {
                        var option = document.createElement('option');
                        option.value = ward.code;
                        option.text = ward.name;
                        wardSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching wards:', error);
                });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#DayArticle').on('blur', function() {
            var value = $(this).val();


            if (value < 7) {
                Swal.fire({
                    icon: 'warning',
                    title: 'số ngày không hợp lệ',
                    text: 'Phải nhập số ngày trên hoặc bằng 7',
                    confirmButtonText: 'OK'
                }).then(() => {
                    $(this).val('');
                });
            }
        });
    })
</script>
<script>
    $(document).ready(function() {
        var vipPrice = {{ $Vip }};
        var normalPrice = {{ $Normal }};


        $('#article-status').change(function() {
            var DayArticle = $('#DayArticle').val();

            var selectedStatus = $(this).val();
            var price = 0;
            if (DayArticle && selectedStatus) {

                if (selectedStatus == 2) {
                    price = normalPrice * DayArticle;
                } else if (selectedStatus == 1) {
                    price = vipPrice * DayArticle;
                } else {
                    price = '';
                }
            } else {
                price = '';
            }

            $('#article-price').val(price);
        });
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
