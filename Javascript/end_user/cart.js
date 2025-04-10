document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".add-to-cart-btn");

    buttons.forEach(function (button) {
        button.addEventListener("click", function () {
            const productID = this.getAttribute("data-id");

            fetch("../gui/add_to_cart.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: "productID=" + encodeURIComponent(productID),
            })
            .then((response) => response.text())
            .then((data) => {
                alert(data); // Hoặc show toast
            })
            .catch((error) => {
                console.error("Lỗi:", error);
            });
        });
    });
});
