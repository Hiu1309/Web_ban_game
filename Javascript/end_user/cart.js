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
export function setupCartSummaryUpdate() {
    const checkboxes = document.querySelectorAll(".cart-item-checkbox");

    // Gọi khi checkbox thay đổi
    checkboxes.forEach(cb => {
        cb.addEventListener("change", updateOrderSummary);
    });

    // Gọi khi số lượng thay đổi
    const quantities = document.querySelectorAll(".quantity-cart");
    quantities.forEach(input => {
        input.addEventListener("input", updateOrderSummary);
    });

    // Gọi lần đầu để setup
    updateOrderSummary();
}

function updateOrderSummary() {
    let total = 0;
    let shippingFee = 30000; // bạn có thể thay đổi theo nhu cầu
    let shippingDiscount = 10000;
    let voucherDiscount = 0;

    document.querySelectorAll(".cart-item-checkbox").forEach(checkbox => {
        if (checkbox.checked) {
            const block = checkbox.closest(".block-product");
            const price = parseInt(block.getAttribute("data-price")) || 0;
            const quantityInput = block.querySelector(".quantity-cart");
            const quantity = parseInt(quantityInput?.value) || 1;
            total += price * quantity;
        }
    });

    document.querySelector(".prices").textContent = formatPrice(total) + "đ";
    document.querySelector(".shipping-fee").textContent = formatPrice(total > 0 ? shippingFee : 0) + "đ";
    document.querySelector(".shipping-discount").textContent = formatPrice(total > 0 ? shippingDiscount : 0) + "đ";
    document.querySelector(".voucher-discount").textContent = formatPrice(voucherDiscount) + "đ";

    const totalPrice = total + (total > 0 ? shippingFee - shippingDiscount : 0) - voucherDiscount;
    document.querySelector(".total-price").textContent = formatPrice(totalPrice) + "đ";
}

function formatPrice(price) {
    return price.toLocaleString("vi-VN");
}
function setupQuantityChangeHandler() {
    const quantityInputs = document.querySelectorAll(".quantity-cart");

    quantityInputs.forEach(input => {
        input.addEventListener("input", function () {
            const quantity = parseInt(this.value) || 1;

            // Tìm phần tử cha chứa toàn bộ sản phẩm
            const productBlock = this.closest(".block-product");
            if (!productBlock) return;

            // Tìm phần hiển thị giá từng sản phẩm
            const pricePerItemElem = productBlock.querySelector(".price-per-item");
            const basePrice = parseInt(pricePerItemElem.dataset.price); // lấy từ data-price

            const newTotal = quantity * basePrice;

            // Cập nhật giá hiển thị
            pricePerItemElem.textContent = formatCurrency(newTotal);

            // Gọi lại hàm tính tổng thanh toán
            updateOrderSummary();
        });
    });
}
function formatCurrency(value) {
    return value.toLocaleString("vi-VN") + "₫";
}
function setupSelectAllCheckbox() {
    const selectAllCheckbox = document.getElementById('selection-item');
    const itemCheckboxes = document.querySelectorAll('.cart-item-checkbox');

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function () {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
                checkbox.dispatchEvent(new Event('change')); 
            });

            // 👉 Gọi lại updateOrderSummary sau khi tất cả checkbox cập nhật
            updateOrderSummary();
        });
    }
}





// Khi trang load lần đầu
document.addEventListener("DOMContentLoaded", function () {
    attachAddToCartEvents();
    updateCartCount();
    setupPaymentOptionQR();
    setupCartSummaryUpdate();
    setupQuantityChangeHandler();
    setupSelectAllCheckbox();

});
