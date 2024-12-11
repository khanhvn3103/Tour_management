<?php
session_start();
include_once("../../models/clsKetNoi.php");
$_SESSION['customerCode'] = 1;
// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['customerCode'])) {
    header("Location: /Tour_management/login.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit;
}

// Kết nối đến cơ sở dữ liệu
$p = new clsKetNoi();
$conn = $p->ketNoiDB();

// Lấy thông tin từ form
$tourCode = isset($_POST['tour_code']) ? $_POST['tour_code'] : '';
$numberOfAdults = isset($_POST['adults']) ? (int)$_POST['adults'] : 0;
$numberOfChildren = isset($_POST['children']) ? (int)$_POST['children'] : 0;
$bookingDate = isset($_POST['date']) ? $_POST['date'] : '';

// Lấy customerCode từ session
$customerCode = $_SESSION['customerCode'];

// Kiểm tra dữ liệu hợp lệ
$errors = [];
if (empty($tourCode) || $numberOfAdults < 0 || $numberOfChildren < 0 || empty($bookingDate)) {
    $errors[] = "Vui lòng điền đầy đủ thông tin.";
}

if (empty($errors)) {
    // Thêm thông tin đặt tour vào bảng tourbookingform
    $queryInsert = "INSERT INTO tourbookingform (customerCode, tourPackageCode, bookingDate, numberOfAdults, numberOfChildren) VALUES (?, ?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($queryInsert);

    if ($stmtInsert) {
        $stmtInsert->bind_param("ssssi", $customerCode, $tourCode, $bookingDate, $numberOfAdults, $numberOfChildren);
        if ($stmtInsert->execute()) {
            echo '<script>
alert("Đặt tour thành công!"); window.location.href = "/Tour_management";</script>';
        } else {
            $errors[] = "Có lỗi trong quá trình đặt tour.";
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
