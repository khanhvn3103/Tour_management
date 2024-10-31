<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Quản Lý Du Lịch</title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/Tour_management/asset/css/manager_home.css">
    <script src="/Tour_management/asset/js/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="/Tour_management/asset/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="sidebar">
        <a href="/Tour_management/index.php" style="max-width: 100%;">
            <img id="logo" src="/Tour_management/asset/images/travellowkey_logo.png" alt="Logo">
        </a>
        <a href="/Tour_management/modules/manager_home/manager_home.php">Thống Kê</a>
        <a href="/Tour_management/modules/manager_home/add_employee.php">Thêm Tài Khoản</a>
        <a href="/Tour_management/modules/manager_home/assign.php">Phân Công Lịch</a>
        <a href="#">Tạo Hoá Đơn</a>
        <a href="/Tour_management/modules/tour_manager/index.php">Quản Lý Tour</a>
        <a href="/Tour_management/modules/tour_category_management/index.php">Quản Lý Gói Tour</a>
        <a href="#">Danh Sách Điểm Tham Quan</a>
    </div>
    <div class="content">
        <div class="col">
            <div class="text-end">
                <form action="/Tour_management/index.php" method="POST">
                    <button type="submit" name="logout" class="btn btn-secondary">Đăng xuất</button>
                </form>
            </div>
        </div>
        <h2 class="text-primary fw-bold mb-4">Tổng Quan Thống Kê</h2>
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="startDate" class="form-label">Ngày Bắt Đầu</label>
                <input type="date" id="startDate" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="endDate" class="form-label">Ngày Kết Thúc</label>
                <input type="date" id="endDate" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-container">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Hoá Đơn Đã Tạo</h5>
                        <p class="card-text">Số lượng: <strong>15</strong></p>
                        <button class="btn btn-primary detail-button" data-bs-toggle="modal" data-bs-target="#detailModal" data-type="created">Xem Chi Tiết</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-container">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Hoá Đơn Bị Huỷ</h5>
                        <p class="card-text">Số lượng: <strong>5</strong></p>
                        <button class="btn btn-primary detail-button" data-bs-toggle="modal" data-bs-target="#detailModal" data-type="canceled">Xem Chi Tiết</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-container">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Hoá Đơn Hoàn Thành</h5>
                        <p class="card-text">Số lượng: <strong>10</strong></p>
                        <button class="btn btn-primary detail-button" data-bs-toggle="modal" data-bs-target="#detailModal" data-type="completed">Xem Chi Tiết</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-container">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Tiền Nhận</h5>
                        <p class="card-text">Tổng tiền: <strong>150,000,000 VND</strong></p>
                        <button class="btn btn-primary detail-button" data-bs-toggle="modal" data-bs-target="#detailModal" data-type="revenue">Xem Chi Tiết</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Chi Tiết Hoá Đơn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Mã Hoá Đơn</th>
                                <th scope="col">Số Người</th>
                                <th scope="col">Địa Chỉ</th>
                                <th scope="col">Tổng Tiền</th>
                                <th scope="col">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody id="billDetails">
                            <!-- Nội dung bảng sẽ được cập nhật động -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.detail-button').click(function() {
                const type = $(this).data('type');
                let tableContent = '';

                if (type === 'created') {
                    tableContent += `
                        <tr>
                            <td>1</td>
                            <td>4</td>
                            <td>TP. Hồ Chí Minh</td>
                            <td>15,000,000 VND</td>
                            <td>Đã Tạo</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>3</td>
                            <td>Hà Nội</td>
                            <td>9,000,000 VND</td>
                            <td>Đã Tạo</td>
                        </tr>`;
                } else if (type === 'canceled') {
                    tableContent += `
                        <tr>
                            <td>2</td>
                            <td>2</td>
                            <td>Đà Nẵng</td>
                            <td>7,000,000 VND</td>
                            <td>Bị Huỷ</td>
                        </tr>`;
                } else if (type === 'completed') {
                    tableContent += `
                        <tr>
                            <td>3</td>
                            <td>3</td>
                            <td>Hội An</td>
                            <td>10,000,000 VND</td>
                            <td>Hoàn Thành</td>
                        </tr>`;
                } else if (type === 'revenue') {
                    tableContent += `
                        <tr>
                            <td>5</td>
                            <td>5</td>
                            <td>Vũng Tàu</td>
                            <td>25,000,000 VND</td>
                            <td>Hoàn Thành</td>
                        </tr>`;
                }

                $('#billDetails').html(tableContent);
            });
        });
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
        session_start();
        session_unset();
        session_destroy();

        header("Location: /Tour_management/index.php");
        exit();
    }
    ?>
</body>
</html>