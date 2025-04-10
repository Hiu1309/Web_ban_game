<?php include("../header_footer/header.php"); ?>

                    <div id="account-content" class="grid-col col-l-12 col-m-12 col-s-12 no-gutter ">
                         <section id="login-registration-form" class="js-account-form">
                              <div class="user-box">
                                   <div id="login" class="text-center">
                                          <div class="font-size-20 uppercase font-bold">đăng nhập</div>
                                          <div id="login-layout">
                                               <form action="" method="post">
                                                    <div class="js-email-login">
                                                         <input type="email" name="customer-email-login"
                                                              id="customer-email-login" placeholder="Email" autocomplete="on" required>
                                                         <div class="error-message"></div>
                                                    </div>
                                                    <div class="js-pass-login">
                                                         <input type="password" name="customer-password-login" id="customer-password-login" 
                                                              placeholder="Mật khẩu" autocomplete="current-password" required>
                                                         <div class="error-message"></div>
                                                    </div>
                                                    <button type="submit" id="login-btn" class="button">
                                                         <p class="capitalize font-bold">đăng nhập</p>
                                                    </button>
                                               </form>

                                               <div class="font-size-14 margin-y-12 js-register">
                                                    <span>Không có tài khoản ?</span>
                                                    <a href="register.php">đăng ký</a>
                                               </div>
                                          </div>
                                     </div>
                              </div>
                         </section>
                    </div>

<?php include("../header_footer/footer.php"); ?>