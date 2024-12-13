<?php
session_start();
include_once("../../models/clsKetNoi.php");
$_SESSION['customerCode'] = 1;

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['customerCode'])) {
    header("Location: /Tour_management/login.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit;
}

$p = new clsKetNoi();
$conn = $p->ketNoiDB();

$tourCode = isset($_POST['tour_code']) ? (int)$_POST['tour_code'] : 0; // Cast to integer
$numberOfAdults = isset($_POST['adults']) ? (int)$_POST['adults'] : 0;
$numberOfChildren = isset($_POST['children']) ? (int)$_POST['children'] : 0;
$bookingDate = isset($_POST['date']) ? $_POST['date'] : '';
$customerCode = $_SESSION['customerCode'];
$status = 1;

$errors = [];
if (empty($tourCode) || $numberOfAdults < 0 || $numberOfChildren < 0 || empty($bookingDate)) {
    $errors[] = "Vui lòng điền đầy đủ thông tin.";
}

if (empty($errors)) {
    // Thêm thông tin đặt tour vào bảng tourbookingform
    $queryInsert = "INSERT INTO tourbookingform (customerCode, tourCode, bookingDate, numberOfAdults, numberOfChildren, status) VALUES (?, ?, ?, ?, ?, ?)";

    $stmtInsert = $conn->prepare($queryInsert);

    if ($stmtInsert) {
        // Bind parameters
        $stmtInsert->bind_param("iisiii", $customerCode, $tourCode, $bookingDate, $numberOfAdults, $numberOfChildren, $status); // Adjusted types

        // Thực thi câu lệnh
        if ($stmtInsert->execute()) {
            echo '<script>
            alert("Đặt tour thành công!"); window.location.href = "/Tour_management";</script>';
        } else {
            $errors[] = "Có lỗi trong quá trình đặt tour: " . $stmtInsert->error;
        }
        $stmtInsert->close();
    } else {
        $errors[] = "Có lỗi trong quá trình chuẩn bị câu lệnh.";
    }
}

// Đóng kết nối
$p->closeKetNoi($conn);

// Hiển thị lỗi nếu có
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
}
?>
