var orderSelect = document.getElementById("orderSelect");
if (orderSelect) {
    orderSelect.addEventListener("change", function () {
        document.getElementById("filterForm").submit();
    });
}

document.addEventListener("DOMContentLoaded", function () {
    let priceRange = document.getElementById("priceRange");
    let priceLabel = document.getElementById("priceLabel");

    function updatePriceLabel(value) {
        priceLabel.textContent =
            value === "1500" ? "Cualquier precio" : "Hasta $" + value;
    }
    if (priceRange) {
        priceRange.addEventListener("input", function () {
            updatePriceLabel(this.value);
        });
        updatePriceLabel(priceRange.value);
    }
});
