<?php
include '../../models/booking.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formCode = isset($_POST['formCode']) ? (int)$_POST['formCode'] : 0;
    $customerCode = isset($_POST['customerCode']) ? (int)$_POST['customerCode'] : 0;

    $db = new modelBooking();

    // Duyệt đơn đặt tour
    if ($db->approveBooking($formCode)) {
        // Gửi thông báo cho người dùng
        $message = "Đơn đặt tour của bạn đã được duyệt!";
        $db->addNotification($customerCode, $message);

        echo '<script>alert("Duyệt đơn thành công và thông báo đã được gửi!"); window.location.href = "/Tour_management/modules/booking/index.php";</script>';
    } else {
        echo '<script>alert("Có lỗi trong quá trình duyệt đơn."); window.location.href = "/Tour_management/modules/booking/index.php";</script>';
    }
} else {
    header("Location: index.php");
    exit;
}
?>
