<?php
include_once "../../database/connectDB.php";
$conn = connectDB::getConnection();
header("Content-Type: application/json");
session_start();
$data = json_decode(file_get_contents("php://input"), true);

// Debug log (tùy chọn)
file_put_contents("debug_log.txt", print_r($data, true));

// Kiểm tra dữ liệu đầu vào
if (!$data || !isset($data['items'])) {
    echo json_encode(["success" => false, "message" => "Dữ liệu không hợp lệ"]);
    exit;
}

// Kiểm tra đăng nhập
$customerID = $_SESSION['CustomerID'] ?? null;
if (!$customerID) {
    echo json_encode(["success" => false, "message" => "Chưa đăng nhập"]);
    exit;
}

// Lấy dữ liệu từ client
$items = $data['items'];
$paymentMethod = $data['paymentMethod'] ?? 'COD';
$address = $data['address'] ?? '';
$note = $data['note'] ?? '';
$salesdate = date('Y-m-d H:i:s');

// Kiểm tra dữ liệu sản phẩm
if (empty($items)) {
    echo json_encode(["success" => false, "message" => "Danh sách sản phẩm rỗng"]);
    exit;
}

foreach ($items as $item) {
    if (empty($item['productID']) || !is_numeric($item['quantity']) || $item['quantity'] <= 0) {
        echo json_encode(["success" => false, "message" => "Thông tin sản phẩm không hợp lệ"]);
        exit;
    }
}

// Tính tổng tiền
$totalPrice = 0;
$productPrices = [];

foreach ($items as $item) {
    $productID = $item['productID'];
    $quantity = $item['quantity'];

    if (!isset($productPrices[$productID])) {
        $stmt = $conn->prepare("SELECT Price FROM product WHERE ProductID = ?");
        $stmt->bind_param("s", $productID);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $productPrices[$productID] = $result['Price'];
    }

    $totalPrice += $productPrices[$productID] * $quantity;
}

// Tạo SalesID
$salesID = "SI" . uniqid();

// Bắt đầu transaction
$conn->begin_transaction();

try {
    // Thêm vào bảng sales_invoice
    $stmt = $conn->prepare("INSERT INTO sales_invoice (SalesID, CustomerID, PaymentMethod, ShippingAddress, TotalPrice, Note, SalesDate) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $salesID, $customerID, $paymentMethod, $address, $totalPrice, $note, $salesdate);
    if (!$stmt->execute()) {
        throw new Exception("Lỗi khi chèn hóa đơn");
    }

    // Thêm vào bảng detail_sales_invoice (MySQL tự sinh DetailSalesID)
    foreach ($items as $item) {
        $productID = $item['productID'];
        $quantity = $item['quantity'];
        $price = $productPrices[$productID];
        $totalItem = $price * $quantity;
        $orderStatus = "Đang xử lý";

        $stmt = $conn->prepare("INSERT INTO detail_sales_invoice (SalesID, ProductID, Order_status, Quantity, Price, TotalPrice) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssidd", $salesID, $productID, $orderStatus, $quantity, $price, $totalItem);
        if (!$stmt->execute()) {
            throw new Exception("Lỗi khi chèn chi tiết hóa đơn");
        }
    }

    $conn->commit();
    echo json_encode(["success" => true]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
?>
