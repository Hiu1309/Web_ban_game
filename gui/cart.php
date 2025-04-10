<?php
session_start();
include('../database/connectDB.php'); // Kết nối CSDL

$customerID = $_SESSION['CustomerID'] ?? null;

if ($customerID) {
    $sql = "SELECT * FROM cart WHERE CustomerID = '$customerID' AND Status = 'Pending'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Có giỏ hàng
        $cart = $result->fetch_assoc();
        $cartID = $cart['CartID'];

        // Lấy sản phẩm trong giỏ hàng
        $sqlItems = "SELECT * FROM cart_item WHERE CartID = $cartID";
        $itemsResult = $conn->query($sqlItems);

        $cartItems = [];
        while ($row = $itemsResult->fetch_assoc()) {
            $cartItems[] = $row;
        }
    } else {
        $cartItems = [];
    }
} else {
    $cartItems = [];
}
?>
<?php include('header_footer/header.php') ?>
    
            
                              <section id="cart-content" class="cart grid-col col-l-12 col-m-12 col-s-12 margin-y-12">
                                   <div class="cart-title padding-bottom-8">
                                        <span class="uppercase font-size-20">giỏ hàng</span>
                                        <span class="cart-count font-size-16 padding-left-8">(0 sản phẩm)</span>
                                   </div>

                                   <div class="cart-ui-content">
                                        <section id="blank-cart" class="margin-y-12 cart-ui">
                                             <img
                                                  src="../Assets/Images/BackGrounds/kettle-desaturated._CB445243794_.svg" />
                                             <span class="font-size-16 padding-left-16 margin-y-12">Không có sản phẩm
                                                  nào trong giỏ hàng. Quay lại
                                                  cửa hàng
                                                  để tiếp tục mua sắm.</span>
                                             <section
                                                  class="flex justify-center align-center font-bold capitalize margin-y-12">
                                                  <a href=" " target="_blank" class="category-btn button">trang chủ</a>
                                             </section>
                                        </section>

                                        <section id="cart" class="active">
                                             <div class="grid-cols col-l-8 col-m-12 col-s-12 no-gutter">
                                                  <div class="header-cart-content cart-ui">
                                                       <input type="checkbox" name="selection-item" id="selection-item"
                                                            class="grid-col col-l-1 col-m-1 col-s-1" />
                                                       <div class="grid-col col-l-6 col-m-11 col-s-11">
                                                            chọn sản phẩm
                                                            <span class="item-count">(1 sản phẩm)</span>
                                                       </div>

                                                       <div class="grid-col col-l-2 s-m-hidden text-center">
                                                            số lượng
                                                       </div>
                                                       <div class="grid-col col-l-2 s-m-hidden text-center">
                                                            thành tiền
                                                       </div>
                                                       <div class="grid-col col-l-1 s-m-hidden text-center">
                                                            xóa
                                                       </div>
                                                  </div>

                                                  <div class="list-carts cart-ui margin-top-16">
                                                  <?php
$totalPrice = 0; 
?>
                                                  <?php if (count($cartItems) > 0): ?>
    <?php foreach ($cartItems as $item): ?>
        <?php
            $productID = $item['ProductID'];
            $productQuery = "SELECT * FROM product WHERE ProductID = '$productID'";
            $productResult = $conn->query($productQuery);
            $product = $productResult->fetch_assoc();
            $totalPrice += $product['Price'] * $item['Quantity'];
        ?>
        <div class="block-product" data-id="<?= $item['CartItemID'] ?>">
            <input type="checkbox" name="select-block-product" />
            <div class="product-cart">
                <img src="<?= $product['Image'] ?>" alt="<?= $product['ProductName'] ?>" />
            </div>
            <div class="info-product-cart">
                <p class="font-bold"><?= $product['ProductName'] ?></p>
                <div class="block-product-price">
                    <span class="new-price"><?= number_format($product['Price'], 0, ',', '.') ?>đ</span>
                </div>
            </div>
            <div class="number-product-cart">
            <input type="number" name="quantity-cart" class="update-qty" value="<?= $item['Quantity'] ?>" min="1" max="100" />
            </div>
            <div class="price-per-item"><?= number_format($product['Price'] * $item['Quantity'], 0, ',', '.') ?>đ</div>
            <div class="remove-product">
    <button class="delete-btn">X</button>
</div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <section id="blank-cart">
        <img src="../Assets/Images/BackGrounds/kettle-desaturated._CB445243794_.svg" />
        <span>Không có sản phẩm nào trong giỏ hàng.</span>
    </section>
<?php endif; ?>
                                                       
                                                  </div>
                                             </div>

                                             <div class="grid-col col-l-4 col-m-12 col-s-12">
                                                  <div class="promotion-block-content cart-ui">
                                                       <div class="shop-voucher margin-bottom-12">
                                                            <p class="font-bold margin-bottom-8 capitalize">
                                                                 Shop voucher
                                                            </p>
                                                            <form action="" method="post"
                                                                 class="flex justify-space-between">
                                                                 <input type="text" name="voucher-code"
                                                                      id="voucher-code"
                                                                      placeholder="nhập mã khuyến mãi" />
                                                                 <button type="submit" class="font-size-14 button">
                                                                      sử dụng
                                                                 </button>
                                                            </form>
                                                       </div>
                                                       <div class="payment-methods margin-bottom-12">
                                                            <h4 class="capitalize margin-bottom-8">
                                                                 phương thức thanh toán
                                                            </h4>
                                                            <ul>
                                                                 <li class="flex align-center">
                                                                      <input type="radio" name="payment-option"
                                                                           id="payment-option-1" class="margin-right-8"
                                                                           checked />
                                                                      <img
                                                                           src="../Assets/Images/Icons/Payment_method/ico_cashondelivery.svg" />
                                                                      <p class="padding-left-8 font-size-14">
                                                                           thanh toán khi nhận hàng (COD)
                                                                      </p>
                                                                 </li>
                                                                 <li class="flex align-center">
                                                                      <input type="radio" name="payment-option"
                                                                           id="payment-option-2"
                                                                           class="margin-right-8" />
                                                                      <img
                                                                           src="../Assets/Images/Icons/Payment_method/ico_momopay.svg" />
                                                                      <p class="padding-left-8 font-size-14">Ví Momo</p>
                                                                      <div class="qr-code-container" id="qr-code-momo" style="display: none; text-align: center; margin-top: 10px;">
                                                                           <img src="../Assets/Images/QC/mm.jpg" alt="QR Code Momo" style="width: 12em; height: auto;" />
                                                                       </div>
                                                                 </li>
                                                                 <li class="flex align-center">
                                                                      <input type="radio" name="payment-option"
                                                                           id="payment-option-3"
                                                                           class="margin-right-8" />
                                                                      <img
                                                                           src="../Assets/Images/Icons/Payment_method/ico_vnpayatm.svg" />
                                                                      <p class="padding-left-8 font-size-14">
                                                                           ATM / Internet Banking
                                                                      </p>
                                                                      <div class="qr-code-container" id="qr-code-atm" style="display: none; text-align: center; margin-top: 10px;">
                                                                           <img src="../Assets/Images/QC/bank.jpg" alt="QR Code ATM" style="width: 12em; height: auto;" />
                                                                       </div>
                                                                 </li>
                                                            </ul>
                                                       </div>

                                                       <div class="order-address margin-bottom-12">
                                                            <h4 class="capitalize margin-bottom-8">địa chỉ nhận hàng
                                                            </h4>
                                                            <div class="margin-bottom-8">
                                                                 <input type="checkbox" name="selection-address"
                                                                 id="selection-address" class="capitalize margin-bottom-8" />
                                                                 <label class="font-size-14"> địa chỉ mặc định</label>
                                                            </div>
                                                            <ul>
                                                                 <li class="flex flex-direction-y justify-center">
                                                                      <input type="text" name="user-address"
                                                                           id="user-address"
                                                                           class="margin-right-8 padding-8" value=""
                                                                           placeholder="địa chỉ nhận hàng" />
                                                                 </li>
                                                            </ul>
                                                       </div>


                                                       <div class="order-summary">
                                                       <h4 class="capitalize margin-bottom-8">chi tiết thanh toán</h4>
    <div>
        <p class="font-size-14">thành tiền</p>
        <span class="price prices font-size-14"><?= number_format($totalPrice, 0, ',', '.') ?>đ</span>
    </div>
    <div>
        <p class="font-size-14">tổng tiền phí vận chuyển</p>
        <span class="price shipping-fee font-size-14">0đ</span>
    </div>
    <div>
        <p class="font-size-14">giảm giá phí vận chuyển</p>
        <span class="price shipping-discount font-size-14">0đ</span>
    </div>
    <div>
        <p class="font-size-14">voucher giảm giá</p>
        <span class="price voucher-discount font-size-14">0đ</span>
    </div>
    <div>
    <p class="font-bold">Tổng Số Tiền</p>
    <span class="price total-price font-bold" data-basetotal="<?= $totalPrice ?>">
        <?= number_format($totalPrice, 0, ',', '.') ?>đ
    </span>
</div>

    <button type="submit" class="checkout-btn button margin-top-12">
        <p class="uppercase font-size-16 font-bold">Đặt hàng</p>
    </button>
                                                       </div>
                                                  </div>

                                                  <div class="user-cart-note cart-ui margin-top-16">
                                                       <form action="" method="post">
                                                            <label for="user-note" class="capitalize font-bold">Ghi
                                                                 Chú</label>
                                                            <textarea name="user-note" id="user-note"></textarea>
                                                       </form>
                                                  </div>
                                             </div>
                                        </section>
                                   </div>
                              </section>
                    
     <?php include('header_footer/footer.php') ?>
