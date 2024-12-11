<?php
// Kết nối tới các models cần thiết
include_once("../../models/mBill.php");
include_once("../../models/mTourBookingForm.php");
include_once("../../models/mDetailBookingForm.php");
include_once("../../models/mVoucher.php");
include_once("../../models/mCustomer.php");
include_once("../../models/mTour.php");

// Khởi tạo các models
$billModel = new modelBill();
$tourBookingFormModel = new modelTourBookingForm();
$detailBookingFormModel = new modelDetailBookingForm();
$voucherModel = new modelVoucher();
$customerModel = new modelCustomer();
$tourModel = new modelTour();

// Lấy danh sách các mã đặt tour chưa được tạo hóa đơn
$availableTourBookingForms = $billModel->getAvailableTourBookingForms();

// Xử lý yêu cầu POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'updateStatus') {
        $billCode = $_POST['billCode'];
        $status = $_POST['status'];
        echo $billModel->updateInvoiceStatus($billCode, $status);
    } else {
        $formCode = $_POST['formCode'];
        $address = $_POST['address'];
        $voucherCode = !empty($_POST['voucherCode']) ? $_POST['voucherCode'] : null;
        echo $billModel->createInvoice($formCode, $address, $voucherCode);
    }
    exit;
}

// Lấy danh sách hóa đơn từ cơ sở dữ liệu
$bills = $billModel->getAllBills();

// Lấy thông tin bổ sung cho mỗi hóa đơn từ bảng tourbookingform
foreach ($bills as &$bill) {
    $booking = $tourBookingFormModel->getTourBookingForm($bill['formCode']);
    $bill['tourCode'] = $booking['tourCode'];
    $bill['customerCode'] = $booking['customerCode'];
}
unset($bill); // Xóa tham chiếu cuối cùng đến phần tử mảng
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Hóa Đơn</title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Tour_management/asset/css/manager_home.css">
    <script src="/Tour_management/asset/js/bootstrap.bundle.min.js"></script>
    <script src="/Tour_management/asset/js/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
</head>

<body>
<?php
include '../../view/leftmenu.php'
?>

    <div class="content">
        <div class="col">
            <div class="text-end">
                <form action="/Tour_management/index.php" method="POST">
                    <button type="submit" name="logout" class="btn btn-secondary">Đăng xuất</button>
                </form>
            </div>
        </div>

        <h2 class="text-primary fw-bold mb-4">Tạo Hóa Đơn</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createInvoiceModal">Tạo Hóa Đơn</button>
        <div class="row mb-4">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Mã Hóa Đơn</th>
                            <th scope="col">Mã Đặt Tour</th>
                            <th scope="col">Mã Tour</th>
                            <th scope="col">Mã Khách Hàng</th>
                            <th scope="col">Địa Chỉ Đón</th>
                            <th scope="col">Tổng Tiền</th>
                            <th scope="col">Ngày Tạo</th>
                            <th scope="col">Trạng Thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($bills) {
                            foreach ($bills as $bill) {
                                echo '<tr>';
                                echo '<td>' . $bill['billCode'] . '</td>';
                                echo '<td>' . $bill['formCode'] . '</td>';
                                echo '<td>' . $bill['tourCode'] . '</td>';
                                echo '<td>' . $bill['customerCode'] . '</td>';
                                echo '<td>' . $bill['address'] . '</td>';
                                echo '<td>' . $bill['total'] . '</td>';
                                echo '<td>' . $bill['createAt'] . '</td>';
                                echo '<td>';
                                echo '<select class="form-select update-status-select" data-bill="' . $bill['billCode'] . '">';
                                echo '<option value="Đang Xử Lý" ' . ($bill['status'] == 'Đang Xử Lý' ? 'selected' : '') . '>Đang xử lý</option>';
                                echo '<option value="Đã Xác Nhận" ' . ($bill['status'] == 'Đã Xác Nhận' ? 'selected' : '') . '>Đã xác nhận</option>';
                                echo '<option value="Hoàn Thành" ' . ($bill['status'] == 'Hoàn Thành' ? 'selected' : '') . '>Hoàn thành</option>';
                                echo '<option value="Đã Hủy" ' . ($bill['status'] == 'Đã Hủy' ? 'selected' : '') . '>Đã hủy</option>';
                                echo '</select>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="8">Không có hóa đơn nào.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tạo Hóa Đơn -->
    <div class="modal fade" id="createInvoiceModal" tabindex="-1" aria-labelledby="createInvoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createInvoiceModalLabel">Tạo Hóa Đơn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createInvoiceForm">
                        <div class="form-group mb-3">
                            <label for="formCode">Mã Đặt Tour</label>
                            <select class="form-control" name="formCode" id="formCode" required>
                                <?php
                                foreach ($availableTourBookingForms as $formCode) {
                                    echo '<option value="' . $formCode . '">' . $formCode . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Địa Chỉ Đón</label>
                            <input type="text" class="form-control" name="address" id="address" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="voucherCode">Mã Voucher (nếu có)</label>
                            <input type="text" class="form-control" name="voucherCode" id="voucherCode">
                        </div>
                        <button type="submit" class="btn btn-primary">Tạo Hóa Đơn</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Xử lý sự kiện khi gửi form tạo hóa đơn
            $('#createInvoiceForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: '/Tour_management/modules/manager_home/manager_bill.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function() {
                        alert("Có lỗi xảy ra. Vui lòng thử lại.");
                    }
                });
            });

            // Xử lý sự kiện khi thay đổi trạng thái hóa đơn
            $('.update-status-select').change(function() {
                const billCode = $(this).data('bill');
                const newStatus = $(this).val();

                $.ajax({
                    url: '/Tour_management/modules/manager_home/manager_bill.php',
                    method: 'POST',
                    data: {
                        action: 'updateStatus',
                        billCode: billCode,
                        status: newStatus
                    },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function() {
                        alert("Có lỗi xảy ra. Vui lòng thử lại.");
                    }
                });
            });
        });
    </script>
</body>

</html>