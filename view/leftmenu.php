<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: /Tour_management/index.php");
    exit();
}
?>

<div class="sidebar">
    <a href="/Tour_management/index.php" style="max-width: 100%;">
        <img id="logo" src="/Tour_management/asset/images/travellowkey_logo.png" alt="Logo">
    </a>
    <a href="/Tour_management/modules/manager_home/manager_home.php">Thống Kê</a>
    <a href="/Tour_management/modules/booking/index.php">Danh Sách Đặt Tour</a>
    <a href="/Tour_management/modules/manager_home/manager_employee.php">Danh Sách Tài Khoản</a>
    <a href="/Tour_management/modules/manager_home/manager_voucher.php">Thêm Voucher</a>
    <a href="/Tour_management/modules/manager_home/manager_assign.php">Phân Công Lịch</a>
    <a href="/Tour_management/modules/manager_home/manager_bill.php">Tạo Hoá Đơn</a>
    <a href="/Tour_management/modules/tour_manage/index.php">Quản Lý Tour</a>
    <a href="/Tour_management/modules/tour_package/index.php">Quản Lý Gói Tour</a>
    <a href="/Tour_management/modules/sightseeing_spot/index.php">Danh Sách Điểm Tham Quan</a>
</div>