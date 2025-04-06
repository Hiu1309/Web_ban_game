<?php include('gui/header_footer/header.php') ?>


                    <!-- homepage -->
                    <div id="index-content" class="grid-col col-l-12 col-m-12 col-s-12">
                           <!-- banner -->
                                <section class="banner-container flex justify-center align-center">
                                     <div class="homepage grid-col col-l-12 col-m-12 col-s-12 no-gutter">
                                          <a data-panel="{&quot;focusable&quot;:false}" href="" class="promo_link" style="display: block;">
                                          <video loop muted autoplay playsinline preload="none'" id="home_video_desktop" alt="Feature red Promotion" class="fullscreen-bg__video">
                                   
                                               <source src="/Assets/Videos/BackGrounds/webm_page_bg_english.webm" type="video/mp4">

                                          </video>
                                          </a>
                                     </div>
                                
                           </section>

                           <!-- service -->
                           <section class="grid-col col-l-12 no-gutter margin-y-16 full-width">
                                <div class="services-container flex justify-center align-center">
                                     <div class="service-content grid-col col-l-3 col-m-3 col-s-6">
                                          <img src="/Assets/Images/Icons/Service/icon-sv1.jpg"
                                               alt="Thanh toán" />
                                          <div class="flex-direction-y padding-left-8">
                                               <h5 class="font-bold uppercase font-size-13">Thanh toán</h5>
                                               <p class="font-size-13 font-light capitalize">Giao dịch nhanh</p>
                                          </div>
                                     </div>

                                     <div class="service-content grid-col col-l-3 col-m-3 col-s-6">
                                          <img src="/Assets/Images/Icons/Service/icon-sv2.jpg"
                                               alt="Quà tặng" />
                                          <div class="flex-direction-y padding-left-8">
                                               <h5 class="font-bold uppercase font-size-13">Quà tặng</h5>
                                               <p class="font-size-13 font-light capitalize">Miễn phí</p>
                                          </div>
                                     </div>

                                     <div class="service-content grid-col col-l-3 col-m-3 col-s-6">
                                          <img src="/Assets/Images/Icons/Service/icon-sv3.jpg"
                                               alt="Bảo mật" />
                                          <div class="flex-direction-y padding-left-8">
                                               <h5 class="font-bold uppercase font-size-13">Bảo mật</h5>
                                               <p class="font-size-13 font-light capitalize">Thanh toán trực
                                                    tuyến</p>
                                          </div>
                                     </div>

                                     <div class="service-content grid-col col-l-3 col-m-3 col-s-6">
                                          <img src="/Assets/Images/Icons/Service/icon-sv4.jpg" alt="Hỗ trợ" />
                                          <div class="flex-direction-y padding-left-8">
                                               <h5 class="font-bold uppercase font-size-13">Hỗ trợ</h5>
                                               <p class="font-size-13 font-light capitalize">24/7</p>
                                          </div>
                                     </div>
                                </div>
                           </section>

                           <!-- best selling -->
                           <section id="best-selling-container" class="container flex grid-col col-l-12 col-m-12 col-s-12 no-gutter">
                              <div class="category-tab">
                                   <div class="heading">
                                        <div id="best-selling-label" class="heading-label"></div>
                                        <div class="uppercase font-bold font-size-20 padding-left-8" style="color: white;">Featured & Recommended</div>
                                   </div>

                                   <div class="product-container">
                                        <?php
                                             // Kết nối cơ sở dữ liệu
                                             require_once "database/connectDB.php"; 
                                             $conn = connectDB::getConnection();

                                             // Truy vấn lấy danh sách 5 sản phẩm bán chạy nhất
                                             $sql = "SELECT ProductID, ProductName, ProductImg, Price, Quantity FROM product ORDER BY Quantity DESC LIMIT 5";
                                             $result = mysqli_query($conn, $sql);

                                             // Kiểm tra và hiển thị sản phẩm   
                                             if (mysqli_num_rows($result) > 0) {
                                                  while ($product = mysqli_fetch_assoc($result)) {
                                                       $price = ($product['Price'] > 0) ? number_format($product['Price'], 0, ',', '.') . ' đ' : 'Miễn phí';


                                                       $availabilityClass = ($product['Quantity'] > 0) ? '' : 'active'; // Kiểm tra số lượng

                                                       echo '<div class="product-item grid-col col-l-2-4 col-m-3 col-s-6">';
                                                       echo '  <div class="block-product product-resize">';
                                                       echo '    <span class="product-image js-item">';
                                                       echo '      <img src="' . $product['ProductImg'] . '" alt="' . $product['ProductName'] . '">';
                                                       echo '    </span>';
                                                       echo '    <div class="sale-off font-bold capitalize ' . $availabilityClass . '">hết hàng</div>';
                                                       echo '    <div class="info-inner flex justify-center align-center line-height-1-6">';
                                                       echo '      <h4 class="font-light capitalize" title="' . $product['ProductName'] . '">' . $product['ProductName'] . '</h4>';
                                                       echo '      <div class="margin-y-4">';
                                                       echo '        <span class="price font-bold">' . $price . '</span>';
                                                       echo '      </div>';
                                                       echo '    </div>';
                                                       echo '  </div>';
                                                       echo '  <div class="action ' . ($product['Quantity'] > 0 ? '' : 'disable') . '">';
                                                       echo '    <div class="buy-btn">';
                                                       echo '      <div title="Mua ngay" class="button">';
                                                       echo '        <i class="fa-solid fa-bag-shopping fa-lg" style="color: var(--primary-white);"></i>';
                                                       echo '      </div>';
                                                       echo '    </div>';
                                                       echo '    <div class="add-to-cart">';
                                                       echo '      <div title="Thêm vào giỏ hàng" class="button">';
                                                       echo '        <i class="fa-solid fa-basket-shopping fa-lg" style="color: var(--primary-white);"></i>';
                                                       echo '      </div>';
                                                       echo '    </div>';
                                                       echo '  </div>';
                                                       echo '</div>';
                                                  }
                                             } else {
                                                  echo '<p>Không có sản phẩm nào thuộc danh mục này.</p>';
                                             }                                             
                                        ?>
                                   </div>

                                   <div class="flex justify-center align-center font-bold capitalize margin-bottom-16">
                                        <a href="gui/shop.php?featured=true" class="category-btn button">Xem thêm</a>
                                   </div>
                              </div>
                              </section>


                           <!-- action -->
                           <section id="action-game-container" class="container flex grid-col col-l-12 col-m-12 col-s-12 no-gutter">
                              <div class="category-tab">
                                   <div class="heading">
                                        <div id="action-game-label" class="heading-label"></div>
                                        <div class="uppercase font-bold font-size-20 padding-left-8" style="color: white;">ACTION</div>
                                   </div>

                                   <div class="product-container">
                                        <?php
                                        // Truy vấn lấy 5 sản phẩm thuộc thể loại "Hành động" (AC001)
                                        $sql = "SELECT p.ProductID, p.ProductName, p.ProductImg, p.Price, p.Quantity 
                                                  FROM product p
                                                  JOIN type_product tp ON p.ProductID = tp.ProductID
                                                  WHERE tp.TypeID = 'AC001'
                                                  LIMIT 5";

                                        $result = mysqli_query($conn, $sql);

                                        // Kiểm tra và hiển thị sản phẩm   
                                        if (mysqli_num_rows($result) > 0) {
                                             while ($product = mysqli_fetch_assoc($result)) {
                                                  $price = ($product['Price'] > 0) ? number_format($product['Price'], 0, ',', '.') . ' đ' : 'Miễn phí';

                                                  $availabilityClass = ($product['Quantity'] > 0) ? '' : 'active'; // Kiểm tra số lượng

                                                  echo '<div class="product-item grid-col col-l-2-4 col-m-3 col-s-6">';
                                                  echo '  <div class="block-product product-resize">';
                                                  echo '    <span class="product-image js-item">';
                                                  echo '      <img src="' . $product['ProductImg'] . '" alt="' . $product['ProductName'] . '">';
                                                  echo '    </span>';
                                                  echo '    <div class="sale-off font-bold capitalize ' . $availabilityClass . '">Hết hàng</div>';
                                                  echo '    <div class="info-inner flex justify-center align-center line-height-1-6">';
                                                  echo '      <h4 class="font-light capitalize" title="' . $product['ProductName'] . '">' . $product['ProductName'] . '</h4>';
                                                  echo '      <div class="margin-y-4">';
                                                  echo '        <span class="price font-bold">' . $price . '</span>'; // Sửa lại hiển thị tiền Việt
                                                  echo '      </div>';
                                                  echo '    </div>';
                                                  echo '  </div>';
                                                  echo '  <div class="action ' . ($product['Quantity'] > 0 ? '' : 'disable') . '">';
                                                  echo '    <div class="buy-btn">';
                                                  echo '      <div title="Mua ngay" class="button">';
                                                  echo '        <i class="fa-solid fa-bag-shopping fa-lg" style="color: var(--primary-white);"></i>';
                                                  echo '      </div>';
                                                  echo '    </div>';
                                                  echo '    <div class="add-to-cart">';
                                                  echo '      <div title="Thêm vào giỏ hàng" class="button">';
                                                  echo '        <i class="fa-solid fa-basket-shopping fa-lg" style="color: var(--primary-white);"></i>';
                                                  echo '      </div>';
                                                  echo '    </div>';
                                                  echo '  </div>';
                                                  echo '</div>';
                                             }
                                        } else {
                                             echo '<p>Không có sản phẩm nào thuộc thể loại này.</p>';
                                        }
                                        ?>
                                   </div>

                                   <div class="flex justify-center align-center font-bold capitalize margin-bottom-16">
                                        <a href="gui/shop.php?type=AC001" class="category-btn button">Xem thêm</a>
                                   </div>
                              </div>
                              </section>
                        

                           <!-- Role-playing  -->
                           <section id="role-playing-container" class="container flex grid-col col-l-12 col-m-12 col-s-12 no-gutter">
                              <div class="category-tab">
                                   <div class="heading">
                                        <div id="role-playing-label" class="heading-label"></div>
                                        <div class="uppercase font-bold font-size-20 padding-left-8" style="color: white;">ROLE-PLAYING</div>
                                   </div>

                                   <div class="product-container">
                                        <?php

                                        // Truy vấn lấy 5 sản phẩm thuộc thể loại "Nhập vai" (RP001)
                                        $sql = "SELECT p.ProductID, p.ProductName, p.ProductImg, p.Price, p.Quantity 
                                                  FROM product p
                                                  JOIN type_product tp ON p.ProductID = tp.ProductID
                                                  WHERE tp.TypeID = 'RPG001'
                                                  LIMIT 5";

                                        $result = mysqli_query($conn, $sql);

                                        // Kiểm tra và hiển thị sản phẩm   
                                        if (mysqli_num_rows($result) > 0) {
                                             while ($product = mysqli_fetch_assoc($result)) {
                                                  $price = ($product['Price'] > 0) ? number_format($product['Price'], 0, ',', '.') . ' đ' : 'Miễn phí';
                                                  $availabilityClass = ($product['Quantity'] > 0) ? '' : 'active'; // Kiểm tra số lượng

                                                  echo '<div class="product-item grid-col col-l-2-4 col-m-3 col-s-6">';
                                                  echo '  <div class="block-product product-resize">';
                                                  echo '    <span class="product-image js-item">';
                                                  echo '      <img src="' . $product['ProductImg'] . '" alt="' . $product['ProductName'] . '">';
                                                  echo '    </span>';
                                                  echo '    <div class="sale-off font-bold capitalize ' . $availabilityClass . '">Hết hàng</div>';
                                                  echo '    <div class="info-inner flex justify-center align-center line-height-1-6">';
                                                  echo '      <h4 class="font-light capitalize" title="' . $product['ProductName'] . '">' . $product['ProductName'] . '</h4>';
                                                  echo '      <div class="margin-y-4">';
                                                  echo '        <span class="price font-bold">' . $price . '</span>'; // Sửa lại hiển thị tiền Việt
                                                  echo '      </div>';
                                                  echo '    </div>';
                                                  echo '  </div>';
                                                  echo '  <div class="action ' . ($product['Quantity'] > 0 ? '' : 'disable') . '">';
                                                  echo '    <div class="buy-btn">';
                                                  echo '      <div title="Mua ngay" class="button">';
                                                  echo '        <i class="fa-solid fa-bag-shopping fa-lg" style="color: var(--primary-white);"></i>';
                                                  echo '      </div>';
                                                  echo '    </div>';
                                                  echo '    <div class="add-to-cart">';
                                                  echo '      <div title="Thêm vào giỏ hàng" class="button">';
                                                  echo '        <i class="fa-solid fa-basket-shopping fa-lg" style="color: var(--primary-white);"></i>';
                                                  echo '      </div>';
                                                  echo '    </div>';
                                                  echo '  </div>';
                                                  echo '</div>';
                                             }
                                        } else {
                                             echo '<p>Không có sản phẩm nào thuộc thể loại này.</p>';
                                        }                                   
                                        ?>
                                   </div>

                                   <div class="flex justify-center align-center font-bold capitalize margin-bottom-16">
                                        <a href="gui/shop.php?type=RPG001" class="category-btn button">Xem thêm</a>
                                   </div>
                              </div>
                              </section>


                           <!-- free to play -->
                           <section id="free-to-play-container" class="container flex grid-col col-l-12 col-m-12 col-s-12 no-gutter">
                              <div class="category-tab">
                                   <div class="heading">
                                        <div id="free-to-play-label" class="heading-label"></div>
                                        <div class="uppercase font-bold font-size-20 padding-left-8" style="color: white;">FREE TO PLAY</div>
                                   </div>

                                   <div class="product-container">
                                        <?php                                             
                                             // Truy vấn lấy 5 sản phẩm Free-to-Play (F2P001)
                                             $sql = "SELECT p.ProductID, p.ProductName, p.ProductImg, p.Price, p.Quantity 
                                                  FROM product p
                                                  JOIN type_product tp ON p.ProductID = tp.ProductID
                                                  WHERE tp.TypeID = 'F2P001'
                                                  LIMIT 5";

                                             $result = mysqli_query($conn, $sql);

                                             // Kiểm tra và hiển thị sản phẩm   
                                             if (mysqli_num_rows($result) > 0) {
                                                  while ($product = mysqli_fetch_assoc($result)) {
                                                  $availabilityClass = ($product['Quantity'] > 0) ? '' : 'active'; // Kiểm tra số lượng

                                                  echo '<div class="product-item grid-col col-l-2-4 col-m-3 col-s-6">';
                                                  echo '  <div class="block-product product-resize">';
                                                  echo '    <span class="product-image js-item">';
                                                  echo '      <img src="' . $product['ProductImg'] . '" alt="' . $product['ProductName'] . '">';
                                                  echo '    </span>';
                                                  echo '    <div class="sale-off font-bold capitalize ' . $availabilityClass . '">hết hàng</div>';
                                                  echo '    <div class="info-inner flex justify-center align-center line-height-1-6">';
                                                  echo '      <h4 class="font-light capitalize" title="' . $product['ProductName'] . '">' . $product['ProductName'] . '</h4>';
                                                  echo '      <div class="margin-y-4">';
                                                  echo '        <span class="price font-bold">Miễn phí</span>';
                                                  echo '      </div>';
                                                  echo '    </div>';
                                                  echo '  </div>';
                                                  echo '  <div class="action ' . ($product['Quantity'] > 0 ? '' : 'disable') . '">';
                                                  echo '    <div class="buy-btn">';
                                                  echo '      <div title="chơi ngay" class="button">';
                                                  echo '        <i class="fa-solid fa-play-circle fa-lg" style="color: var(--primary-white);"></i>';
                                                  echo '      </div>';
                                                  echo '    </div>';
                                                  echo '    <div class="add-to-cart">';
                                                  echo '      <div title="thêm vào thư viện" class="button">';
                                                  echo '        <i class="fa-solid fa-plus-square fa-lg" style="color: var(--primary-white);"></i>';
                                                  echo '      </div>';
                                                  echo '    </div>';
                                                  echo '  </div>';
                                                  echo '</div>';
                                                  }
                                             } else {
                                                  echo '<p>Không có sản phẩm nào thuộc thể loại này.</p>';
                                             }                                             
                                        ?>
                                   </div>

                                   <div class="flex justify-center align-center font-bold capitalize margin-bottom-16">
                                        <a href="gui/shop.php?type=F2P001" class="category-btn button">Xem thêm</a>
                                   </div>
                              </div>
                              </section>

                           <!-- open word -->                            
                           <section id="open-world-container" class="container flex grid-col col-l-12 col-m-12 col-s-12 no-gutter">
                              <div class="category-tab">
                                   <div class="heading">
                                        <div id="open-world-label" class="heading-label"></div>
                                        <div class="uppercase font-bold font-size-20 padding-left-8" style="color: white;">OPEN WORLD</div>
                                   </div>

                                   <div class="product-container">
                                        <?php                                             
                                             // Truy vấn lấy 5 sản phẩm thuộc thể loại Open World (OW001)
                                             $sql = "SELECT p.ProductID, p.ProductName, p.ProductImg, p.Price, p.Quantity 
                                                  FROM product p
                                                  JOIN type_product tp ON p.ProductID = tp.ProductID
                                                  WHERE tp.TypeID = 'OW001'
                                                  LIMIT 5";

                                             $result = mysqli_query($conn, $sql);

                                             // Kiểm tra và hiển thị sản phẩm   
                                             if (mysqli_num_rows($result) > 0) {
                                                  while ($product = mysqli_fetch_assoc($result)) {
                                                  $price = number_format($product['Price'], 0, ',', '.') . "₫"; // Định dạng giá tiền
                                                  $availabilityClass = ($product['Quantity'] > 0) ? '' : 'active'; // Kiểm tra số lượng

                                                  echo '<div class="product-item grid-col col-l-2-4 col-m-3 col-s-6">';
                                                  echo '  <div class="block-product product-resize">';
                                                  echo '    <span class="product-image js-item">';
                                                  echo '      <img src="' . $product['ProductImg'] . '" alt="' . $product['ProductName'] . '">';
                                                  echo '    </span>';
                                                  echo '    <div class="sale-off font-bold capitalize ' . $availabilityClass . '">hết hàng</div>';
                                                  echo '    <div class="info-inner flex justify-center align-center line-height-1-6">';
                                                  echo '      <h4 class="font-light capitalize" title="' . $product['ProductName'] . '">' . $product['ProductName'] . '</h4>';
                                                  echo '      <div class="margin-y-4">';
                                                  echo '        <span class="price font-bold">' . $price . '</span>';
                                                  echo '      </div>';
                                                  echo '    </div>';
                                                  echo '  </div>';
                                                  echo '  <div class="action ' . ($product['Quantity'] > 0 ? '' : 'disable') . '">';
                                                  echo '    <div class="buy-btn">';
                                                  echo '      <div title="Mua ngay" class="button">';
                                                  echo '        <i class="fa-solid fa-bag-shopping fa-lg" style="color: var(--primary-white);"></i>';
                                                  echo '      </div>';
                                                  echo '    </div>';
                                                  echo '    <div class="add-to-cart">';
                                                  echo '      <div title="Thêm vào giỏ hàng" class="button">';
                                                  echo '        <i class="fa-solid fa-basket-shopping fa-lg" style="color: var(--primary-white);"></i>';
                                                  echo '      </div>';
                                                  echo '    </div>';
                                                  echo '  </div>';
                                                  echo '</div>';
                                                  }
                                             } else {
                                                  echo '<p>Không có sản phẩm nào thuộc thể loại này.</p>';
                                             }

                                             // Đóng kết nối
                                             connectDB::closeConnection($conn);
                                        ?>
                                   </div>

                                   <div class="flex justify-center align-center font-bold capitalize margin-bottom-16">
                                        <a href="gui/shop.php?type=OW001" class="category-btn button">Xem thêm</a>
                                   </div>
                              </div>
                              </section>

                      </div>

                      <!-- account -->
                      <div id="account-content" class="grid-col col-l-12 col-m-12 col-s-12 no-gutter disable">
                           <div id="user-detail" class="grid-col col-l-12 col-m-12 col-s-12 disable">
                                <div class="account-container">
                                     <div class="flex align-center margin-bottom-16">
                                          <div class="font-size-20 uppercase font-bold">tài khoản của bạn</div>
                                          <div class="margin-left-12 js-signout exit-color">Thoát</div>
                                     </div>
                                     <p class="user-orders margin-bottom-16 font-size-14 font-light"></p>

                                     <div class="account-history-bill grid-col col-l-3 no-gutter">
                                          <article class="history-order-link button">
                                               <div class="history-order-btn font-bold capitalize text-center">xem lịch sử mua hàng</div>
                                          </article>
                                     </div>

                                     <div class="account-info padding-top-16">
                                          <div class="font-bold uppercase margin-bottom-16 font-size-20">thông tin khách hàng</div>
                                          <div class="user-card padding-16 grid-col col-l-6 col-m-12 col-s-12">
                                               <div class="info user-last-name">
                                                    <div class="font-bold grid-col col-l-2 col-m-4 col-s-4 no-gutter">Họ</div>
                                                    <input type="text" name="user-last-name" id="user-last-name" 
                                                         class="grid-col col-l-10 col-m-8 col-s-8" value="Kenneth Valdez" disabled>
                                               </div>
                                               <div class="info user-first-name">
                                                    <div class="font-bold grid-col col-l-2 col-m-4 col-s-4 no-gutter">Tên</div>
                                                    <input type="text" name="user-first-name" id="user-first-name" 
                                                         class="grid-col col-l-10 col-m-8 col-s-8" value="Kenneth Valdez" disabled>
                                               </div>
                                               <div class="info user-email">
                                                    <div
                                                         class="font-bold grid-col col-l-2 col-m-4 col-s-4 no-gutter">Email</div>
                                                    <input type="text" name="user-email" id="user-email"
                                                         class="grid-col col-l-10 col-m-8 col-s-8" value="fip@jukmuh.al" disabled>
                                               </div>
                                               <div class="info user-password">
                                                    <div
                                                         class="font-bold grid-col col-l-2 col-m-4 col-s-4 no-gutter">Mật Khẩu</div>
                                                    <input type="password" name="user-password" id="user-password"
                                                         class="grid-col col-l-10 col-m-8 col-s-8" placeholder="nhập mật khẩu" disabled>
                                               </div>
                                               <div class="info user-phone">
                                                    <div
                                                         class="font-bold grid-col col-l-2 col-m-4 col-s-4 no-gutter">Điện Thoại</div>
                                                    <input type="text" name="user-phone" id="user-phone" class="grid-col col-l-10 col-m-8 col-s-8" 
                                                         placeholder="chưa có số điện thoại" value="(239) 816-9029" disabled>
                                               </div>
                                               <div class="info user-address">
                                                    <div class="font-bold grid-col col-l-2 col-m-4 col-s-4 no-gutter"> Địa Chỉ</div>
                                                    <input type="text" name="user-address" id="user-address" class="grid-col col-l-10 col-m-8 col-s-8" 
                                                         placeholder="chưa có địa chỉ" value="Bay Area, San Francisco, CA" disabled>
                                               </div>
                                               <div class="full-width flex margin-top-12">
                                                    <button class="js-edit-btn button capitalize">sửa thông tin</button>
                                                    <button class="js-submit-btn button margin-left-16 capitalize">xác nhận</button>
                                               </div>
                                          </div>
                                          
                                     </div>
                                </div>
                           </div>
                      </div>

                      <!-- detail product -->
                      <div id="detail-content" class="grid-col col-l-12 col-m-12 col-s-12 disable">
                           <section
                                class="detail-product-container grid-col col-l-12 col-m-12 col-s-12 margin-bottom-16">
                                <div class="detail-block">
                                     <div class="block-product grid-col col-l-5 col-m-12 col-s-12">
                                          <div class="product-image">
                                               <div class="flex justify-center">
                                                    <img src="" alt="">
                                               </div>
                                               <div class="sale-off font-bold">Hết hàng</div>
                                          </div>
                                          <div class="sale-label"></div>
                                     </div>

                                     <div class="grid-col col-l-7 col-m-12 col-s-12">
                                          <div>
                                               <div class="product-title">
                                                    <h1 class="font-size-26 capitalize font-light"></h1>
                                                    <div
                                                         class="product-id margin-y-12 font-size-14 opacity-0-8">
                                                    </div>
                                               </div>
                                               <div class="block-product-price margin-bottom-12">
                                                    <span
                                                         class="price new-price font-bold padding-right-8 font-size-26"></span>
                                                    <del class="price old-price font-size-26"></del>
                                               </div>
                                               <div
                                                    class="product-info grid-col col-l-12 col-m-12 col-s-12 no-gutter flex margin-bottom-12">
                                                    <div class="grid-col col-l-6 col-m-6 col-s-12 no-gutter">
                                                         <strong>Developer</strong>
                                                         <div class="b-author"></div>
                                                    </div>
                                                    <div class="grid-col col-l-6 col-m-6 col-s-12 no-gutter">
                                                         <strong>Release date</strong>
                                                         <div class="b-release opacity-0-8"></div>
                                                    </div>
                                                   
                                                    <div class="grid-col col-l-6 col-m-6 col-s-12 no-gutter">
                                                         <strong>Storage</strong>
                                                         <div class="b-size opacity-0-8"></div>
                                                    </div>
                                               </div>

                                               <div class="short-desc">
                                                    <strong class="font-size-14">Description:</strong>
                                                    <div class="font-size-14 opacity-0-8"></div>
                                               </div>

                                               <div class="product-selector margin-top-16">
                                                    <label>
                                                       
                                                         <div
                                                              class="margin-bottom-12 grid-col col-l-4 col-m-3 col-s-5 no-gutter">
                                                              <select name="product-selector"
                                                                   id="product-selector-options">
                                                                   <option value="special">bản đặc biệt</option>
                                                                   <option value="normal" selected>bản thường
                                                                   </option>
                                                              </select>
                                                         </div>
                                                    </label>
                                                    <div
                                                         class="quantity-box margin-bottom-12 grid-col col-l-2-4 col-m-3 col-s-5 no-gutter">
                                                         <input type="button" value="-" class="reduce">
                                                         <input type="text" name="quantity" id="quantity"
                                                              placeholder="1" value="1" class="quantity-cart">
                                                         <input type="button" value="+" class="increase">
                                                    </div>
                                                    <div
                                                         class="grid-col col-l-8 col-m-6 col-s-12 no-gutter flex justify-space-between margin-bottom-12">
                                                         <div class="buy-btn button margin-bottom-8">mua ngay
                                                         </div>
                                                         <div class="add-to-cart button margin-bottom-8">thêm
                                                              vào giỏ hàng</div>
                                                    </div>
                                               </div>
                                               <div class="product-tags margin-top-16">
                                                    <div class="flex font-size-14">
                                                         <strong class="margin-right-8">tag:</strong>
                                                         <p></p>
                                                    </div>
                                                    <div class="flex font-size-14">
                                                         <strong class="margin-right-8">danh mục:</strong>
                                                         <p></p>
                                                    </div>
                                               </div>
                                          </div>
                                     </div>
                                </div>
                           </section>

                           <!-- show games same developer -->
                           <section id="same-author-container"
                                class="container grid-col col-l-12 col-m-12 col-s-12">
                                <div class="category-tab">
                                     <div class="list-title margin-bottom-12 padding-top-12 padding-bottom-12">
                                          <strong class="font-size-20">MORE FROM THIS DEVELOPER</strong>
                                     </div>

                                     <!-- container for products -->
                                     <div class="product-container flex full-height align-center justify-start">
                                     </div>
                                </div>
                           </section>

                           <!-- show books same tags -->
                           <section id="product-like-container"
                                class="container grid-col col-l-12 col-m-12 col-s-12">
                                <div class="category-tab">
                                     <div class="list-title margin-bottom-12 padding-top-12 padding-bottom-12">
                                          <strong class="font-size-20">MORE LIKE THIS</strong>
                                     </div>

                                     <!-- container for products -->
                                     <div class="product-container flex full-height align-center justify-start">
                                     </div>
                                </div>
                           </section>
                      </div>

                      <!-- order tracking, history order -->
                      <div id="order-content" class="grid-col col-l-12 col-m-12 col-s-12 disable">
                           <!-- status -->
                           <div class="order-status-container margin-y-24 grid-col col-l-12 col-m-12 col-s-12">
                                <section id="blank-order" class="margin-y-16">
                                     <img
                                          src="https://m.media-amazon.com/images/G/31/cart/empty/kettle-desaturated._CB424694257_.svg">
                                     <span class="font-size-16 padding-bottom-16 margin-y-12">Không có đơn đặt hàng nào.</span>
                                     <section
                                          class="flex justify-center align-center font-bold capitalize margin-y-12">
                                          <a href="./index.html" target="_self" class="return-homepage category-btn button">trang chủ</a>
                                     </section>
                                </section>

                                <section id="customer-order" class="">
                                     <div
                                          class="order-status-header grid-col col-l-12 col-m-12 col-s-12 padding-bottom-8 margin-bottom-8">
                                          <div class="uppercase font-bold text-center font-size-20">đơn hàng của
                                               bạn</div>
                                     </div>

                                     <!--block order info and tracking bar -->
                                     <div class="order-info flex flex-direction-y margin-y-24">
                                          <div class="flex ">
                                               <div class="block-order-info grid-col col-l-3 col-m-6 col-s-6">
                                                    <h4 class="capitalize">mã đơn hàng</h4>
                                                    <span
                                                         class="order-code font-size-20 opacity-0-8">123451</span>
                                               </div>

                                               <div class="block-order-info grid-col col-l-3 col-m-6 col-s-6">
                                                    <h4 class="capitalize">thời gian đặt hàng</h4>
                                                    <span
                                                         class="order-time font-size-20 opacity-0-8">21/09/2024</span>
                                               </div>

                                               <div class="block-order-info grid-col col-l-3 col-m-6 col-s-6">
                                                    <h4 class="capitalize">mã vận đơn</h4>
                                                    <span
                                                         class="tracking-code font-size-20 opacity-0-8">432434xgf14142</span>
                                               </div>

                                               <div class="block-order-info grid-col col-l-3 col-m-6 col-s-6">
                                                    <h4 class="capitalize">vận chuyển bởi</h4>
                                                    <span class="shipped-with font-size-20 opacity-0-8">TLANG
                                                         SHIP</span>
                                               </div>

                                               <div class="block-order-info grid-col col-l-3 col-m-6 col-s-6">
                                                    <h4 class="capitalize">ngày nhận hàng dự kiến</h4>
                                                    <span
                                                         class="expected-delivery-date font-size-20 opacity-0-8">22/9/2024</span>
                                               </div>

                                               <div class="block-order-info grid-col col-l-3 col-m-6 col-s-6">
                                                    <h4 class="capitalize">tên người nhận</h4>
                                                    <span class="Consignee font-size-20 opacity-0-8">K
                                                         Tài</span>
                                               </div>

                                               <div class="block-order-info grid-col col-l-3 col-m-6 col-s-6">
                                                    <h4 class="capitalize">số điện thoại người nhận</h4>
                                                    <span class="Consignee-phone font-size-20 opacity-0-8">(+84)843
                                                         *** ***</span>
                                               </div>

                                               <div class="block-order-info grid-col col-l-3 col-m-6 col-s-6">
                                                    <h4 class="capitalize">địa chỉ nhận hàng</h4>
                                                    <span class="shipping-to font-size-20 opacity-0-8">
                                                         <span class="Consignee-address">449/76 K4 HL BD BT TP.HCM</span>
                                                    </span>
                                               </div>
                                          </div>

                                          <!-- tracking bar -->
                                          <div class="tracking-bar padding-top-8">
                                               <div class="shipped-dot grid-col col-l-4 col-m-4 col-s-4">
                                                    <div class="dot-status">
                                                         <div class="dot-active">
                                                              <div class="border-arrow-top"></div>
                                                              <i class="fa-solid fa-circle fa-lg"
                                                                   style="color: var(--main-color);"></i>
                                                              <p class="font-size-14">
                                                                   <span class="flex">đơn hàng đã được giao cho
                                                                        đơn vị vận chuyển</span>
                                                              </p>
                                                         </div>
                                                         <div class="dot-disable">
                                                              <div class="border-arrow-top opacity-0-6"></div>
                                                              <i class="fa-regular fa-circle fa-lg"
                                                                   style="color: var(--main-color);"></i>
                                                              <p class="font-size-14 text-end">
                                                                   <span class="text-center flex opacity-0-6">chờ
                                                                        lấy hàng</span>
                                                              </p>

                                                         </div>
                                                    </div>
                                               </div>

                                               <div
                                                    class="in-transit-dot grid-col col-l-4 com-m-4 col-s-4 no-gutter text-center">
                                                    <div class="dot-status">
                                                         <div class="dot-active">
                                                              <div class="border-arrow-top"></div>
                                                              <i class="fa-solid fa-circle fa-lg"
                                                                   style="color: var(--main-color);"></i>
                                                              <p class="font-size-14">
                                                                   <span class="flex justify-center">đơn hàng  đang được vận chuyển đến bạn</span>
                                                              </p>
                                                         </div>
                                                         <div class="dot-disable">
                                                              <div class="border-arrow-top opacity-0-6"></div>
                                                              <i class="fa-regular fa-circle fa-lg"
                                                                   style="color: var(--main-color);"></i>
                                                              <p class="font-size-14">
                                                                   <span class="justify-center flex opacity-0-6">chờ giao hàng</span>
                                                              </p>
                                                         </div>
                                                    </div>
                                               </div>

                                               <div
                                                    class="delivered-dot grid-col col-l-4 col-m-4 col-s-4 text-end">
                                                    <div class="dot-status">
                                                         <div class="dot-active">
                                                              <div class="border-arrow-top"></div>
                                                              <i class="fa-solid fa-circle fa-lg"
                                                                   style="color: var(--main-color);"></i>
                                                              <p class="font-size-14 text-end">
                                                                   <span class="text-end flex">giao hàng thành công</span>
                                                              </p>
                                                         </div>
                                                         <div class="dot-disable">
                                                              <div class="border-arrow-top opacity-0-6"></div>
                                                              <i class="fa-regular fa-circle fa-lg"
                                                                   style="color: var(--main-color);"></i>
                                                              <p class="font-size-14 text-end">
                                                                   <span class="flex justify-end opacity-0-6">chờ
                                                                        nhận hàng</span>
                                                              </p>
                                                         </div>
                                                    </div>
                                               </div>
                                          </div>

                                         
                                     </div>

                                     <article
                                          class="history-order-link button flex justify-center align-center">
                                          <div class="history-order-btn font-bold capitalize">xem lịch sử mua
                                               hàng</div>
                                     </article>
                                </section>
                           </div>

                           <!-- history -->
                           <div
                                class="history-tracking-container margin-y-24 grid-col col-l-12 col-m-12 col-s-12">
                                <section id="history-order-container" class="">
                                     <div class="order-status-header padding-bottom-8 margin-bottom-16">
                                          <p class="uppercase font-bold text-center font-size-20">lịch sử mua hàng</p>
                                     </div>

                                     <div class="history-order-table grid-col col-l-12 col-m-12 col-s-12 no-gutter flex justify-space-between"></div>
                                </section>
                           </div>

                          
                      </div>
                      </div>
        </section>
        <?php include('gui/header_footer/new_blog.php') ?>
                      
        <?php include('gui/header_footer/footer.php') ?>