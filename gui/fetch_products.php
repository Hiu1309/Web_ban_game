<?php
include '../database/connectDB.php';

$conn = connectDB::getConnection();

// Số sản phẩm trên mỗi trang
$productsPerPage = 20;

// Xác định trang hiện tại từ request (mặc định là trang 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $productsPerPage;

// Nhận từ khóa tìm kiếm, thể loại và khoảng giá từ request
$keyword = isset($_GET['query']) ? trim($_GET['query']) : "";
$type = isset($_GET['type']) ? trim($_GET['type']) : "";
$minPrice = isset($_GET['minPrice']) ? (int)$_GET['minPrice'] : 0;
$maxPrice = isset($_GET['maxPrice']) ? (int)$_GET['maxPrice'] : PHP_INT_MAX;

// Chuẩn bị câu SQL
$sql = "SELECT p.ProductID, p.ProductName, p.ProductImg, p.Price, p.Quantity 
        FROM product p 
        LEFT JOIN type_product t ON p.ProductID = t.ProductID 
        WHERE 1";

$params = [];
$types = "";

// Nếu có từ khóa, tìm kiếm theo ProductName
if (!empty($keyword)) {
    $sql .= " AND p.ProductName LIKE ?";
    $params[] = "%" . $keyword . "%";
    $types .= "s";
}

// Nếu có bộ lọc thể loại
if (!empty($type)) {
    $sql .= " AND t.TypeID = ?";
    $params[] = $type;
    $types .= "s";
}

// Nếu có bộ lọc giá tiền
$sql .= " AND p.Price BETWEEN ? AND ?";
$params[] = $minPrice;
$params[] = $maxPrice;
$types .= "ii";

// Đếm tổng số sản phẩm để tính số trang
$countSql = "SELECT COUNT(*) as total FROM ($sql) as subquery";
$stmt = mysqli_prepare($conn, $countSql);
if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$countResult = mysqli_stmt_get_result($stmt);
$totalProducts = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalProducts / $productsPerPage);

// Thêm điều kiện phân trang
$sql .= " LIMIT ? OFFSET ?";
$params[] = $productsPerPage;
$params[] = $offset;
$types .= "ii";

// Chuẩn bị và thực thi truy vấn lấy sản phẩm
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, $types, ...$params);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

connectDB::closeConnection($conn);

// Trả về dữ liệu dưới dạng JSON
echo json_encode(["products" => $products, "totalPages" => $totalPages]);
?>
