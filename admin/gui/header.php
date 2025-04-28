<?php
session_start(); // Khởi tạo session

// Kiểm tra nếu người dùng đã đăng nhập và có quyền 'R1'
if (isset($_SESSION['role']) && $_SESSION['role'] === 'R1') {
    echo '<div class="header">
            <span>Xin chào, admin</span>
            <a href="../../index.php" class="logout-btn">Thoát</a>
          </div>
          
          <div class="container">
            <div class="sidebar">
              <a href="admin.php?page=permission">Quyền</a>
            </div>';
} else {
    // Nếu chưa đăng nhập hoặc không phải quyền R1, chuyển hướng về trang mặc định
    header('Location: ../../gui/account/logout.php');
    exit();
}
?>

<style>
    .header {
        display: flex;
        justify-content: space-between; /* Căn đều hai bên */
        align-items: center; /* Căn giữa theo chiều dọc */
        padding: 10px 20px;
        background-color: #4568dc; /* Màu nền */
        color: white; /* Màu chữ */
        font-size: 18px;
        font-weight: bold;
    }

    .logout-btn {
        background-color: #ff6b6b;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none; /* Xóa gạch chân */
        transition: background-color 0.3s ease;
    }

    .logout-btn:hover {
        background-color: #ff4444;
    }

    .text-warning {
        color: #ffc107; /* Màu vàng cho tên admin */
    }
</style>