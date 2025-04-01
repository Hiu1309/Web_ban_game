<?php include("../header_footer/header.php"); ?>

                        <div id="account-content" class="grid-col col-l-12 col-m-12 col-s-12 no-gutter">
                           <section id="login-registration-form" class="js-account-form">
                                <div class="user-box">
                                     <div id="register" class="text-center">
                                          <div class="font-size-20 uppercase font-bold">đăng ký</div>
                                          <div id="register-layout">
                                               <form action="" method="post">
                                                    <div class="js-fname-register">
                                                         <input type="text" name="customer-last-name" id="customer-last-name" placeholder="Họ" required>
                                                         <div class="error-message"></div>
                                                    </div>
                                                    <div class="js-lname-register">
                                                         <input type="text" name="customer-first-name" id="customer-first-name" placeholder="Tên" required>
                                                         <div class="error-message"></div>
                                                    </div>
                                                    <div class="js-email-register">
                                                         <input type="email" name="customer-email-register"
                                                              id="customer-email-register" placeholder="Email" autocomplete="on" required>
                                                         <div class="error-message"></div>
                                                    </div>
                                                    <div class="js-password-register">
                                                         <input type="password"
                                                              name="customer-password-register" id="customer-password-register" autocomplete="off"
                                                              placeholder="Tạo mật khẩu" minlength="8" required>
                                                         <div class="error-message"></div>
                                                    </div>
                                                    <div class="js-confirm-pass-register">
                                                         <input type="password"
                                                              name="customer-confirm-password-register" id="customer-confirm-password-register"
                                                              autocomplete="off" placeholder="Xác nhận mật khẩu" minlength="8" required>
                                                         <div class="error-message"></div>
                                                    </div>
                                                    <button type="submit" id="register-btn" class="button">
                                                         <p class="capitalize font-bold">đăng ký</p>
                                                    </button>
                                               </form>

                                               <div class="font-size-14 margin-y-12 js-login">
                                                    <span>Đã có tài khoản ?</span>
                                                    <a href="login.php">đăng nhập</a>
                                               </div>
                                          </div>
                                     </div>
                                </div>
                           </section>
                      </div>

                      <?php include("../header_footer/footer.php"); ?>
