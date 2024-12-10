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
// Lấy danh sách khách hàng
$customers = $customerModel->getAllCustomers();
// Lấy danh sách tour
$tours = $tourModel->getAllTours();

// Xử lý việc tạo hóa đơn
function createInvoice($formCode, $customerCode, $tourCode, $address, $voucherCode = null)
{
    global $billModel, $tourBookingFormModel, $detailBookingFormModel, $voucherModel, $customerModel, $tourModel;

    // Lấy thông tin từ tourbookingform
    $booking = $tourBookingFormModel->getTourBookingForm($formCode);
    if (!$booking) {
        echo "Không tìm thấy booking với formCode: $formCode.";
        return false;
    }

    // Lấy thông tin chi tiết từ detailbookingform
    $details = $detailBookingFormModel->getDetailBookingForm($formCode);
    if (!$details) {
        echo "Không tìm thấy chi tiết booking với formCode: $formCode.";
        return false;
    }

    // Tính tổng số người
    $numberOfPeople = count($details);

    // Lấy thông tin voucher nếu có
    $voucher = $voucherCode ? $voucherModel->getVoucher($voucherCode) : null;

    // Lấy thông tin khách hàng
    $customer = $customerModel->getCustomer($customerCode);

    // Lấy thông tin tour
    $tour = $tourModel->getTour($tourCode);
    if (!$tour) {
        echo "Không tìm thấy thông tin tour với tourCode: $tourCode";
        return false;
    }

    // Tính toán tổng tiền
    $total = ($tour['price'] * $booking['numberOfAdults']) + ($tour['price'] * 0.7 * $booking['numberOfChildren']);
    if ($voucher) {
        $total = $total * ((100 - $voucher['sale']) / 100);
    }

    // Các thông tin khác
    $status = 'Đang xử lý'; // Trạng thái hóa đơn

    // Tạo hóa đơn
    $result = $billModel->createBill($numberOfPeople, $address, $total, $status, $formCode, $voucherCode, $tourCode, $customerCode);
    if ($result) {
        echo "Hóa đơn đã được tạo thành công.";
        exit;
    } else {
        echo "Có lỗi xảy ra khi tạo hóa đơn. Vui lòng thử lại.";
        exit;
    }
}

// Xử lý việc cập nhật trạng thái hóa đơn
function updateInvoiceStatus($billCode, $status)
{
    global $billModel;

    // Cập nhật trạng thái hóa đơn
    $result = $billModel->updateBillStatus($billCode, $status);
    if ($result) {
        echo "Trạng thái hóa đơn đã được cập nhật thành công.";
        exit;
    } else {
        echo "Có lỗi xảy ra khi cập nhật trạng thái hóa đơn. Vui lòng thử lại.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'updateStatus') {
        $billCode = $_POST['billCode'];
        $status = $_POST['status'];
        updateInvoiceStatus($billCode, $status);
    } else {
        $formCode = $_POST['formCode'];
        $customerCode = $_POST['customerCode'];
        $tourCode = $_POST['tourCode'];
        $address = $_POST['address'];
        $voucherCode = !empty($_POST['voucherCode']) ? $_POST['voucherCode'] : null;
        createInvoice($formCode, $customerCode, $tourCode, $address, $voucherCode);
    }
}

// Lấy danh sách hóa đơn từ cơ sở dữ liệu
$bills = $billModel->getAllBills();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tài Khoản Nhân Viên</title>
    <link rel="stylesheet" href="/Tour_management/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Tour_management/asset/css/manager_home.css">
    <script src="/Tour_management/asset/js/bootstrap.bundle.min.js"></script>
    <script src="/Tour_management/asset/js/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
</head>

<body>
    <div class="sidebar">
        <a href="/Tour_management/index.php" style="max-width: 100%;">
            <img id="logo" src="/Tour_management/asset/images/travellowkey_logo.png" alt="Logo">
        </a>
        <a href="/Tour_management/modules/manager_home/manager_home.php">Thống Kê</a>
        <a href="/Tour_management/modules/manager_home/manager_employee.php">Danh Sách Tài Khoản</a>
        <a href="/Tour_management/modules/manager_home/manager_voucher.php">Thêm Voucher</a>
        <a href="/Tour_management/modules/manager_home/manager_assign.php">Phân Công Lịch</a>
        <a href="/Tour_management/modules/manager_home/manager_bill.php">Tạo Hoá Đơn</a>
        <a href="/Tour_management/modules/tour_manage/index.php">Quản Lý Tour</a>
        <a href="/Tour_management/modules/tour_category_management/index.php">Quản Lý Gói Tour</a>
        <a href="./sightseeing_list.php">Danh Sách Điểm Tham Quan</a>
    </div>

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
                                echo '<td>' . $bill['tourCode'] . '</td>';
                                echo '<td>' . $bill['customerCode'] . '</td>';
                                echo '<td>' . $bill['address'] . '</td>';
                                echo '<td>' . $bill['total'] . '</td>';
                                echo '<td>' . $bill['createAt'] . '</td>';
                                echo '<td>';
                                echo '<select class="form-select update-status-select" data-bill="' . $bill['billCode'] . '">';
                                echo '<option value="Đang xử lý" ' . ($bill['status'] == 'Đang xử lý' ? 'selected' : '') . '>Đang xử lý</option>';
                                echo '<option value="Đã xác nhận" ' . ($bill['status'] == 'Đã xác nhận' ? 'selected' : '') . '>Đã xác nhận</option>';
                                echo '<option value="Hoàn thành" ' . ($bill['status'] == 'Hoàn thành' ? 'selected' : '') . '>Hoàn thành</option>';
                                echo '<option value="Đã hủy" ' . ($bill['status'] == 'Đã hủy' ? 'selected' : '') . '>Đã hủy</option>';
                                echo '</select>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="7">Không có hóa đơn nào.</td></tr>';
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
                            <label for="customerCode">Username Khách Hàng</label>
                            <select class="form-control" name="customerCode" id="customerCode" required>
                                <?php
                                foreach ($customers as $customer) {
                                    echo '<option value="' . $customer['customerCode'] . '">' . $customer['username'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tourCode">Mã Tour</label>
                            <select class="form-control" name="tourCode" id="tourCode" required>
                                <?php
                                foreach ($tours as $tour) {
                                    echo '<option value="' . $tour['tourCode'] . '">' . $tour['tourCode'] . '</option>';
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