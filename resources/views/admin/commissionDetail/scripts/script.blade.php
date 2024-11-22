<script>
document.addEventListener("DOMContentLoaded", function() {
    var totalAmountInput = document.getElementById("total_amount");
    var amountPaidInput = document.getElementById("amount_paid");
    var amountPercentInput = document.getElementById("amount_percent");

    // Lắng nghe sự kiện khi giá trị của total_amount hoặc amount_paid thay đổi
    totalAmountInput.addEventListener("input", calculateAmountPercent);
    amountPaidInput.addEventListener("input", calculateAmountPercent);

    // Hàm tính toán amount_percent
    function calculateAmountPercent() {
        var totalAmount = parseFloat(totalAmountInput.value);
        var amountPaid = parseFloat(amountPaidInput.value);

        if (isNaN(totalAmount) || isNaN(amountPaid) || totalAmount <= 0) {
            amountPercentInput.value = "";
            return;
        }

        var amountPercent = (amountPaid / totalAmount) * 100;
        amountPercentInput.value = amountPercent.toFixed(2);
    }

    // Gọi hàm tính toán amount_percent lần đầu tiên để cập nhật giá trị ban đầu
    calculateAmountPercent();
});

</script>
