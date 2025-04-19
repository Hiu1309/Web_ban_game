// cart.js
 export function attachAddToCartEvents() {
    const buttons = document.querySelectorAll(".add-to-cart-btn");
    buttons.forEach(btn => {
        btn.addEventListener("click", handleAddToCart);
    });
}
export function attachBuyNowEvents() {
    const buttons = document.querySelectorAll(".buy-now-btn");
    buttons.forEach(btn => {
        btn.addEventListener("click", handleBuyNow);
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

    const quantityInput = document.querySelector(".quantity-cart");
    const quantity = parseInt(quantityInput?.value) || 1;

    fetch("../gui/cart/add_to_cart.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "productID=" + encodeURIComponent(productID) + "&quantity=" + quantity,
    })
    .then((response) => response.json())
    .then((data) => {
        if (!data.alreadyExists) {
            const cartCountElems = document.querySelectorAll(".cart-count");
            cartCountElems.forEach(elem => {
                const currentCount = parseInt(elem.textContent) || 0;
                elem.textContent = currentCount + quantity;
            });
        }

        // 👉 Thông báo đã thêm vào giỏ hàng
        const alertElem = document.getElementById("cart-added-alert");
        alertElem.classList.remove("hidden");

        setTimeout(() => {
            alertElem.classList.add("hidden");
        }, 2000); // ẩn sau 2 giây
    })
    .catch((error) => {
        console.error("Lỗi:", error);
    });
}

function handleBuyNow(event) {
    const productID = this.getAttribute("data-id");
    const quantityInput = document.querySelector(".quantity-cart");
    const quantity = parseInt(quantityInput?.value) || 1;

    fetch("../gui/cart/add_to_cart.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "productID=" + encodeURIComponent(productID) + "&quantity=" + quantity,
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.status === "success") {
            window.location.href = "/gui/cart.php";
        } else {
            showAlert2("Có lỗi xảy ra khi thêm vào giỏ hàng.");
        }
    })
    .catch((error) => {
        console.error("Lỗi:", error);
    });
}

export function updateCartCount() {
    fetch("/gui/cart/cart_count.php")
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



function setupDefaultAddressCheckbox() {
    const checkbox = document.getElementById("selection-address");
    const addressInput = document.getElementById("user-address");
    const warningDiv = document.getElementById("address-warning");

    if (!checkbox || !addressInput || !warningDiv) return;

    const defaultAddress = checkbox.dataset.defaultAddress || "";

    checkbox.addEventListener("change", function () {
        if (this.checked) {
            if (defaultAddress.trim() === "") {
                warningDiv.classList.remove("hidden");

                // Ẩn sau 3 giây
                setTimeout(() => {
                    warningDiv.classList.add("hidden");
                }, 3000);

                this.checked = false;
                return;
            }
            addressInput.value = defaultAddress;
        } else {
            addressInput.value = "";
            warningDiv.classList.add("hidden");
        }
    });
}
function setupCheckoutHandler() {
    const checkoutBtn = document.getElementById("checkout-btn");
    if (!checkoutBtn) return;

    checkoutBtn.addEventListener("click", function (e) {
        e.preventDefault(); // Ngăn form submit nếu có

        const selectedItems = [];
        const checkboxes = document.querySelectorAll(".cart-item-checkbox:checked");

        checkboxes.forEach(cb => {
            const block = cb.closest(".block-product");
            const productID = block.dataset.id;
            const quantity = block.querySelector(".quantity-cart").value;

            selectedItems.push({
                productID,
                quantity
            });
        });

        const paymentMethod =
            document.querySelector('input[name="payment-method"]:checked')?.value ||
            document.querySelector('input[name="payment-option"]:checked')?.id || ''; // fallback
        const address = document.getElementById("user-address")?.value || '';
        const note = document.getElementById("order-note")?.value || '';

        if (selectedItems.length === 0) {
            showAlert2("Vui lòng chọn ít nhất một sản phẩm để đặt hàng.");
            return;
        }

        if (!address.trim()) {
            showAlert2("Vui lòng nhập địa chỉ giao hàng.");
            return;
        }

        fetch("/gui/cart/checkout.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                items: selectedItems,
                paymentMethod,
                address,
                note
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Xóa các sản phẩm trong giao diện
                selectedItems.forEach(item => {
                    const productBlock = document.querySelector(`.block-product[data-id="${item.productID}"]`);
                    if (productBlock) productBlock.remove();
                });

                // Xóa giỏ hàng trong localStorage nếu dùng cho khách
                localStorage.removeItem("cart");

                
                window.location.href = "/index.php";
                showAlert("Đặt hàng thành công!");
            } else {
                showAlert2("Đã có lỗi xảy ra khi đặt hàng hoặc do bạn chưa đăng nhập");
            }
        })
        .catch(err => {
            console.error("Lỗi khi đặt hàng:", err);
            showAlert2("Lỗi kết nối đến máy chủ.");
        });
    });
}


export function showAlert(message, isSuccess = false) {
    const alertElem = document.getElementById("cart-added-alert");
    if (!alertElem) return;

    alertElem.textContent = message;
    alertElem.classList.remove("hidden");
    alertElem.classList.toggle("success", isSuccess);

    setTimeout(() => {
        alertElem.classList.add("hidden");
        alertElem.classList.remove("success");
    }, 2000);
}
export function showAlert2(message, isSuccess = false) {
    const alert2Elem = document.getElementById("address-warning");
    if (!alert2Elem) return;

    alert2Elem.textContent = message;
    alert2Elem.classList.remove("hidden");
    alert2Elem.classList.toggle("success", isSuccess);

    setTimeout(() => {
        alert2Elem.classList.add("hidden");
        alert2Elem.classList.remove("success");
    }, 2000);
}



document.addEventListener("DOMContentLoaded", function () {
    attachAddToCartEvents();
    attachBuyNowEvents();
    updateCartCount();
    setupPaymentOptionQR();
    setupCartSummaryUpdate();
    setupQuantityChangeHandler();
    setupSelectAllCheckbox();
    setupDefaultAddressCheckbox();
    setupCheckoutHandler();
});
