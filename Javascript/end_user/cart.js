document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll('input[name="select-block-product"]');
    const shippingFeeEl = document.querySelector('.shipping-fee');
    const totalPriceEl = document.querySelector('.total-price');

    const shippingFee = 20000; // phí vận chuyển

    const baseTotal = parseInt(
        document.querySelector('.total-price').dataset.basetotal || "0"
    );

    function updateShippingFee() {
        let anyChecked = false;
        checkboxes.forEach(cb => {
            if (cb.checked) {
                anyChecked = true;
            }
        });

        if (anyChecked) {
            shippingFeeEl.textContent = shippingFee.toLocaleString('vi-VN') + 'đ';
            totalPriceEl.textContent = (baseTotal + shippingFee).toLocaleString('vi-VN') + 'đ';
        } else {
            shippingFeeEl.textContent = '0đ';
            totalPriceEl.textContent = baseTotal.toLocaleString('vi-VN') + 'đ';
        }
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updateShippingFee));
    // Xử lý cập nhật số lượng
document.querySelectorAll('.update-qty').forEach(input => {
    input.addEventListener('change', function () {
        const block = input.closest('.block-product');
        const cartItemID = block.dataset.id;
        const newQty = input.value;

        fetch('../gui/update_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=update&cartItemID=${cartItemID}&quantity=${newQty}`
        })
        .then(res => res.text())
        .then(data => {
            if (data === 'updated') {
                location.reload(); // có thể thay bằng update DOM nếu muốn mượt
            }
        });
    });
});
 // Xử lý xoá sản phẩm
 document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const block = btn.closest('.block-product');
        const cartItemID = block.dataset.id;

        fetch('../gui/update_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=delete&cartItemID=${cartItemID}`
        })
        .then(res => res.text())
        .then(data => {
            if (data === 'deleted') {
                block.remove();
                // Có thể thêm hàm cập nhật tổng tiền, phí ship ở đây
            }
        });
    });
});

document.querySelectorAll('.add-to-cart-btn').forEach(button => {
    button.addEventListener('click', function () {
      const productId = this.dataset.id;
  
      fetch('../gui/add_to_cart.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'product_id=' + encodeURIComponent(productId)
      })
      .then(response => response.text())
      .then(data => {
        // Giả sử server trả về tổng số sản phẩm trong giỏ
        if (!isNaN(data)) {
          document.querySelector('.cart-count').textContent = data;
          alert('Đã thêm sản phẩm vào giỏ!');
        }
      })
      .catch(error => console.error('Lỗi:', error));
    });
  });
});


