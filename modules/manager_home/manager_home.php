<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['type'])) {
    include_once("../../models/mBill.php");

    $type = $_POST['type'];
    $billModel = new modelBill();
    $status = '';

    if ($type == 'created') {
        // Lấy tất cả các hóa đơn chưa bị huỷ và hoàn thành
        $status = 'Tất Cả';  // Thay thế 'Đã Tạo' bằng 'Tất Cả' nếu bạn muốn tất cả các hóa đơn
    } elseif ($type == 'canceled') {
        $status = 'Đã Huỷ';
    } elseif ($type == 'completed') {
        $status = 'Hoàn Thành';
    } elseif ($type == 'revenue') {
        // Trạng thái này có thể để trống nếu bạn đang tính tổng doanh thu
        $status = 'Doanh Thu';
    }


    $bills = $billModel->getBillsByStatus($status);
    $output = '';

    foreach ($bills as $row) {
        $output .= '<tr>
            <td>' . $row['billCode'] . '</td>
            <td>' . $row['numberOfPeople'] . '</td>
            <td>' . $row['address'] . '</td>
            <td>' . number_format($row['total']) . ' VND</td>
            <td>' . $row['status'] . '</td>
        </tr>';
    }

    echo $output;
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Quản Lý Du Lịch</title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css">
    <script src="/Tour_management/asset/js/jquery-3.7.1.js"></script>
    <script src="/Tour_management/asset/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/Tour_management/asset/css/manager_home.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
</head>

<body>
<?php
include '../../view/leftmenu.php'
?>

    <?php
    include_once("../../models/mBill.php");
    $billModel = new modelBill();
    $createdBills = $billModel->getBillsByStatus('Tất Cả');
    $canceledBills = $billModel->getBillsByStatus('Đã Huỷ');
    $completedBills = $billModel->getBillsByStatus('Hoàn Thành');
    $totalCreated = count($createdBills);
    $totalCanceled = count($canceledBills);
    $totalCompleted = count($completedBills);
    $totalRevenue = array_sum(array_column($completedBills, 'total'));
    ?>

    <div class="content">
        <div class="col">
            <div class="text-end">
                <form action="/Tour_management/index.php" method="POST">
                    <button type="submit" name="logout" class="btn btn-secondary">Đăng xuất</button>
                </form>
            </div>
        </div>
        <h2 class="text-primary fw-bold mb-4">Tổng Quan Thống Kê</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-container">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Hoá Đơn Đã Tạo</h5>
                        <p class="card-text">Số lượng: <strong><?php echo $totalCreated; ?></strong></p>
                        <button class="btn btn-primary detail-button" data-bs-toggle="modal" data-bs-target="#detailModal" data-type="created">Xem Chi Tiết</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-container">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Hoá Đơn Bị Huỷ</h5>
                        <p class="card-text">Số lượng: <strong><?php echo $totalCanceled; ?></strong></p>
                        <button class="btn btn-primary detail-button" data-bs-toggle="modal" data-bs-target="#detailModal" data-type="canceled">Xem Chi Tiết</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-container">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Hoá Đơn Hoàn Thành</h5>
                        <p class="card-text">Số lượng: <strong><?php echo $totalCompleted; ?></strong></p>
                        <button class="btn btn-primary detail-button" data-bs-toggle="modal" data-bs-target="#detailModal" data-type="completed">Xem Chi Tiết</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-container">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Tiền Nhận</h5>
                        <p class="card-text">Tổng tiền: <strong><?php echo number_format($totalRevenue); ?> VND</strong></p>
                        <!-- <button class="btn btn-primary detail-button" data-bs-toggle="modal" data-bs-target="#detailModal" data-type="revenue">Xem Chi Tiết</button> -->
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
                // Gửi yêu cầu AJAX để lấy dữ liệu hóa đơn từ server
                $.ajax({
                    url: location.href,
                    method: 'POST',
                    data: {
                        type: type
                    },
                    success: function(response) {
                        $('#billDetails').html(response);
                    }
                });
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['type'])) {
        include_once("../../models/mBill.php");

        $type = $_POST['type'];
        $billModel = new modelBill();
        $status = '';

        if ($type == 'created') {
            $status = 'Đã Tạo';
        } elseif ($type == 'canceled') {
            $status = 'Bị Huỷ';
        } elseif ($type == 'completed') {
            $status = 'Hoàn Thành';
        } elseif ($type == 'revenue') {
            $status = 'Hoàn Thành';
        }

        $bills = $billModel->getBillsByStatus($status);
        $output = '';

        foreach ($bills as $row) {
            $output .= '<tr>
                <td>' . $row['billCode'] . '</td>
                <td>' . $row['numberOfPeople'] . '</td>
                <td>' . $row['address'] . '</td>
                <td>' . number_format($row['total']) . ' VND</td>
                <td>' . $row['status'] . '</td>
            </tr>';
        }

        echo $output;
        exit;
    }
    ?>
</body>

</html>