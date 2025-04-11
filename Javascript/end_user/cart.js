// addtoCart.js
 export function attachAddToCartEvents() {
    const buttons = document.querySelectorAll(".add-to-cart-btn");
    buttons.forEach(btn => {
        btn.addEventListener("click", handleAddToCart);
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
    .then((response) => response.json())
    .then((data) => {
        alert(data.message); // Hoặc toast

        // Nếu sản phẩm CHƯA có trong giỏ thì mới tăng cart-count
        if (!data.alreadyExists) {
            const cartCountElems = document.querySelectorAll(".cart-count");
            cartCountElems.forEach(elem => {
                const currentCount = parseInt(elem.textContent) || 0;
                elem.textContent = currentCount + 1;
            });
        }
    })
    .catch((error) => {
        console.error("Lỗi:", error);
    });
}
export function updateCartCount() {
    fetch("../gui/cart/cart_count.php")
        .then(res => res.json())
        .then(data => {
            const count = data.count || 0;
            const countElems = document.querySelectorAll(".cart-count");
            countElems.forEach(elem => {
                elem.textContent = count;
            });
        });
}



// Khi trang load lần đầu
document.addEventListener("DOMContentLoaded", function () {
    attachAddToCartEvents();
    updateCartCount();
    setupPaymentOptionQR();
});
