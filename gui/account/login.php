

<?php
     session_start();
     include("../../database/connectDB.php");

     $error_message = "";

     // Xử lý khi submit form đăng nhập
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $email = isset($_POST["customer-email-login"]) ? trim($_POST["customer-email-login"]) : "";
     $password = isset($_POST["customer-password-login"]) ? trim($_POST["customer-password-login"]) : "";
          

     $conn = connectDB::getConnection();

     // Kiểm tra email có tồn tại không
     $sql = "SELECT a.Username, a.Password, a.RoleID, c.Fullname
               FROM account a
               JOIN customer c ON a.Username = c.Username
               WHERE c.Email = ?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $result = $stmt->get_result();

     if ($result->num_rows == 1) {
          $account = $result->fetch_assoc();
          if (password_verify($password, $account["Password"])) {
               // Lưu thông tin người dùng vào session
               $_SESSION["username"] = $account["Username"];
               $_SESSION["fullname"] = $account["Fullname"];
               $_SESSION["role"] = $account["RoleID"];

               // Chuyển hướng theo Role
               switch ($account["RoleID"]) {
                    case "R4": // Người mua hàng
                         header("Location: /index.php");
                         exit;
                    case "R3":
                         header("Location: /staff/sales.php");
                         exit;
                    case "R2":
                         header("Location: /staff/inventory.php");
                         exit;
                    case "R1":
                         header("Location: /admin/dashboard.php");
                         exit;
                    default:
                         $error_message = "Vai trò không hợp lệ!";
               }
          } else {
               $error_message = "Mật khẩu không đúng!";
          }
     } else {
          $error_message = "Email không tồn tại!";
     }

     connectDB::closeConnection($conn);
     }
?>
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
                    <?php if (!empty($error_message)): ?>
                        <div style="color:red; margin-bottom:10px;"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include("../header_footer/footer.php"); ?>
