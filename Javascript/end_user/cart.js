// addtoCart.js
 export function attachAddToCartEvents() {
    const buttons = document.querySelectorAll(".add-to-cart-btn");

    buttons.forEach(function (button) {
        button.removeEventListener("click", handleAddToCart); // Xoá sự kiện cũ để tránh trùng
        button.addEventListener("click", handleAddToCart);
    });
}

export function setupPaymentOptionQR() {
    const momo = document.getElementById('payment-option-2');
    const cod = document.getElementById('payment-option-1');
    const atm = document.getElementById('payment-option-3');

    if (momo) {
        momo.addEventListener('change', () => {
            document.getElementById('qr-code-momo').style.display = momo.checked ? 'block' : 'none';
            document.getElementById('qr-code-atm').style.display = 'none';
        });
    }

    if (atm) {
        atm.addEventListener('change', () => {
            document.getElementById('qr-code-atm').style.display = atm.checked ? 'block' : 'none';
            document.getElementById('qr-code-momo').style.display = 'none';
        });
    }

    if (cod) {
        cod.addEventListener('change', () => {
            document.getElementById('qr-code-momo').style.display = 'none';
            document.getElementById('qr-code-atm').style.display = 'none';
        });
    }
}

function handleAddToCart(event) {
    const productID = this.getAttribute("data-id");

    fetch("../gui/cart/add_to_cart.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "productID=" + encodeURIComponent(productID),
    })
    .then((response) => response.text())
    .then((data) => {
        alert(data); // Hoặc dùng toast
    })
    .catch((error) => {
        console.error("Lỗi:", error);
    });
}

// Khi trang load lần đầu
document.addEventListener("DOMContentLoaded", function () {
    attachAddToCartEvents();
    setupPaymentOptionQR();
});
