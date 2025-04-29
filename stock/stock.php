<?php
session_start();
$activeSection = 'home'; // mặc định là Trang chủ

if (!isset($_SESSION["role"]) || !in_array($_SESSION["role"], ["R0", "R2"])) {
    header("Location: /gui/account/logout.php");
    exit;
}

// Nếu có POST (submit form), thì lấy theo form ẩn
if (isset($_POST['active_section'])) {
    $activeSection = $_POST['active_section'];
}

// Nếu không có POST mà người dùng nhấn qua URL ?section=abc (khi click menu), thì cũng lấy từ đó
if (isset($_GET['section'])) {
    $activeSection = $_GET['section'];
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý kho hàng</title>
    <link rel="stylesheet" href="/Assets/CSS/stockstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .form-spmoi-container {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            padding: 40px 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-spmoi-container h2 {
            margin-bottom: 30px;
            font-size: 20px;
        }

        .form-spmoi-grid {
            display: flex;
            gap: 30px;
        }

        .form-spmoi-left,
        .form-spmoi-right {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-spmoi-input,
        .form-spmoi-select,
        .form-spmoi-textarea {
            padding: 12px;
            border: none;
            background-color: #eee;
            border-radius: 3px;
            font-size: 14px;
        }

        .form-spmoi-textarea {
            height: 150px;
            resize: none;
        }

        .form-spmoi-image-box {
            background: #eee;
            height: 215px;
            padding: 10px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .form-spmoi-image-box span {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #555;
            font-size: 14px;
        }

        .form-spmoi-image-box img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .form-spmoi-add-image {
            margin-top: 10px;
            background: #f4f4f4;
            border: none;
            padding: 8px 16px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            cursor: pointer;
        }

        .form-spmoi-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .form-spmoi-btn-back,
        .form-spmoi-btn-submit {
            width: 48%;
            padding: 14px 0;
            font-size: 14px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }

        .form-spmoi-btn-back {
            background: #fff;
            border: 1px solid #1f2a80;
            color: #1f2a80;
        }

        .form-spmoi-btn-submit {
            background: #1f2a80;
            color: white;
        }

        .supplier-form-overlay {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }

        .supplier-form-overlay.show {
            display: flex;
        }

        .form-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .supplier-form-section {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .supplier-form-section .form-box {
            background-color: white;
            padding: 32px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
        }

        .supplier-form-section h2 {
            margin-bottom: 24px;
            font-size: 20px;
        }

        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }

        .form-icon {
            width: 40px;
            text-align: center;
            font-size: 18px;
        }

        .form-row input {
            flex: 1;
            padding: 10px;
            background-color: #eee;
            border: none;
            border-radius: 2px;
            font-size: 14px;
        }

        .double-input input,
        .double-input button {
            width: 50%;
            margin-left: 8px;
        }

        .double-input input:first-of-type,
        .double-input button:first-of-type {
            margin-left: 0;
            margin-right: 8px;
        }

        .btn-outline {
            padding: 10px;
            border: 1px solid #1e2d78;
            background: white;
            color: #1e2d78;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            padding: 10px;
            border: none;
            background: #1e2d78;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .mainBlock {
            display: flex;
            height: 100vh;
        }

        .sideMenu {
            width: 220px;
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
        }

        .sideMenu h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sideList {
            list-style: none;
            padding: 0;
        }

        .sideList li {
            padding: 10px 20px;
            cursor: pointer;
        }

        .sideList li:hover {
            background-color: #34495e;
        }

        .container {
            flex: 1;
            padding: 20px;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }
    </style>
</head>

<body>

    <div class="mainBlock">
        <div class="sideMenu">
            <h2>QUẢN LÍ KHO</h2>
            <ul class="sideList">
                <li><a href="?section=home">Trang chủ</a></li>
                <li><a href="?section=products">Quản lý sản phẩm</a></li>
                <li><a href="?section=suppliers">Nhà cung cấp</a></li>
                <li><a href="?section=import">Lập phiếu nhập</a></li>
                <li><a href="?section=history">Lịch sử nhập</a></li>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <li class="logout"><a href="/gui/account/logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>

            </ul>
        </div>


        <div class="container">
            <!-- Trang chủ -->
            <div id="home" class="section <?= $activeSection == 'home' ? 'active' : '' ?>">
                <h2>Chào mừng Quản lí kho!</h2>
                <p>Chọn chức năng từ menu bên trái để quản lý kho hàng.</p>
            </div>

            <div id="products" class="section <?= $activeSection == 'products' ? 'active' : '' ?>">
                <?php include 'pages/products.php'; ?>
            </div>

            <div id="suppliers" class="section <?= $activeSection == 'suppliers' ? 'active' : '' ?>">
                <?php include 'pages/suppliers.php'; ?>
            </div>

            <div id="import" class="section <?= $activeSection == 'import' ? 'active' : '' ?>">
                <?php include 'pages/import_form.php'; ?>
            </div>

            <div id="history" class="section <?= $activeSection == 'history' ? 'active' : '' ?>">
                <?php include 'pages/history.php'; ?>
            </div>

        </div>

        <script>
            function showSection(id) {
                const sections = document.querySelectorAll('.section');
                sections.forEach(section => section.classList.remove('active'));
                document.getElementById(id).classList.add('active');
            }
        </script>

</body>

</html>