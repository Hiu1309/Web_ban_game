<?php
session_start();
include('../database/connectDB.php');

$customerID = $_SESSION['CustomerID'] ?? null;

if (!$customerID) {
    http_response_code(403);
    echo "Not logged in";
    exit;
}

$action = $_POST['action'] ?? '';
$cartItemID = $_POST['cartItemID'] ?? 0;

if ($action === 'update') {
    $quantity = intval($_POST['quantity']);
    $stmt = $conn->prepare("UPDATE cart_item SET Quantity = ? WHERE CartItemID = ? AND CartID IN (SELECT CartID FROM cart WHERE CustomerID = ? AND Status = 'Pending')");
    $stmt->bind_param('iii', $quantity, $cartItemID, $customerID);
    $stmt->execute();
    echo "updated";
} elseif ($action === 'delete') {
    $stmt = $conn->prepare("DELETE FROM cart_item WHERE CartItemID = ? AND CartID IN (SELECT CartID FROM cart WHERE CustomerID = ? AND Status = 'Pending')");
    $stmt->bind_param('ii', $cartItemID, $customerID);
    $stmt->execute();
    echo "deleted";
} else {
    echo "invalid";
}
