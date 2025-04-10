<?php
session_start();

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (!isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = 1;
    } else {
        $_SESSION['cart'][$productId]++;
    }

    echo array_sum($_SESSION['cart']); // Tổng số sản phẩm để cập nhật
} else {
    echo '0';
}
