var orderSelect = document.getElementById('orderSelect');
if (orderSelect) {
    orderSelect.addEventListener('change', function() {
        document.getElementById('orderForm').submit();
    });
}
