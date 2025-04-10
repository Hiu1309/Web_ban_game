<?php
session_start();
include '../../database/connectDB.php'; // đường dẫn đến file kết nối CSDL của bạn

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['CustomerID']) && isset($_POST['CartItemID'])) {
        $customerID = $_SESSION['CustomerID'];
        $cartItemID = $_POST['CartItemID'];

        $stmt = $conn->prepare("DELETE FROM cart_item WHERE CustomerID = ? AND CartItemID = ?");
        $stmt->bind_param("ii", $customerID, $cartItemID);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Xóa sản phẩm khỏi giỏ hàng thành công']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Không thể xóa sản phẩm']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ hoặc chưa đăng nhập']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Phương thức không hợp lệ']);
}
?>
