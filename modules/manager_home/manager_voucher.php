<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("../../models/mVoucher.php");
$voucherModel = new modelVoucher();

// Xử lý yêu cầu thêm, xóa voucher
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        $beginAt = date('Y-m-d', strtotime($_POST['beginAt']));
        $endAt = date('Y-m-d', strtotime($_POST['endAt']));

        if ($beginAt >= $endAt) {
            echo "Ngày nhập bị sai.";
            exit;
        }
        $sale = $_POST['sale'];
        if ($sale <= 0) {
            echo "Giảm giá bị sai.";
            exit;
        }
        function generateRandomString($length)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            return $randomString;
        }

        $voucherCode = generateRandomString(10);
        if ($voucherModel->insertVoucher($voucherCode, $beginAt, $endAt, $sale)) {
            echo "Thêm voucher thành công.";
        } else {
            echo "Có lỗi xảy ra. Vui lòng thử lại.";
        }
        exit;
    } elseif ($action == 'delete') {
        $voucherCode = $_POST['voucherCode'];

        if ($voucherModel->deleteVoucher($voucherCode)) {
            echo "Xóa voucher thành công.";
        } else {
            echo "Có lỗi xảy ra. Vui lòng thử lại.";
        }
        exit;
    }
}

// Lấy danh sách voucher
$vouchers = $voucherModel->selectAllVouchers();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Voucher</title>
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

        <h2 class="text-primary fw-bold mb-4">Danh Sách Voucher</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addVoucherModal">Thêm Voucher</button>
        <div class="row mb-4">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Mã Voucher</th>
                            <th scope="col">Ngày Bắt Đầu</th>
                            <th scope="col">Ngày Kết Thúc</th>
                            <th scope="col">Giá Trị Giảm Giá (%)</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($vouchers) {
                            foreach ($vouchers as $voucher) {
                                echo '<tr>';
                                echo '<td>' . $voucher['voucherCode'] . '</td>';
                                echo '<td>' . date('Y-m-d', strtotime($voucher['beginAt'])) . '</td>';
                                echo '<td>' . date('Y-m-d', strtotime($voucher['endAt'])) . '</td>';
                                echo '<td>' . $voucher['sale'] . '</td>';
                                echo '<td>
                                        <button class="btn btn-danger btn-sm delete-button" data-voucher="' . $voucher['voucherCode'] . '">Xóa</button>
                                      </td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">Không có voucher nào.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Thêm Voucher -->
    <div class="modal fade" id="addVoucherModal" tabindex="-1" aria-labelledby="addVoucherModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVoucherModalLabel">Thêm Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addVoucherForm">
                        <!-- <div class="form-group mb-3">
                            <label for="voucherCode">Mã Voucher</label>
                            <input type="text" class="form-control" name="voucherCode" id="voucherCode" required>
                        </div> -->
                        <div class="form-group mb-3">
                            <label for="beginAt">Ngày Bắt Đầu</label>
                            <input type="date" class="form-control" name="beginAt" id="beginAt" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="endAt">Ngày Kết Thúc</label>
                            <input type="date" class="form-control" name="endAt" id="endAt" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="sale">Giá Trị Giảm Giá (%)</label>
                            <input type="number" step="0.01" class="form-control" name="sale" id="sale" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm Voucher</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Xử lý sự kiện khi gửi form thêm voucher
            $('#addVoucherForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: location.href,
                    method: 'POST',
                    data: $(this).serialize() + '&action=add',
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function() {
                        alert("Có lỗi xảy ra. Vui lòng thử lại.");
                    }
                });
            });

            // Xử lý sự kiện xóa voucher
            $('.delete-button').click(function() {
                if (confirm('Bạn có chắc chắn muốn xóa voucher này?')) {
                    const voucherCode = $(this).data('voucher');

                    $.ajax({
                        url: location.href,
                        method: 'POST',
                        data: {
                            action: 'delete',
                            voucherCode: voucherCode
                        },
                        success: function(response) {
                            alert(response);
                            location.reload();
                        },
                        error: function() {
                            alert("Có lỗi xảy ra. Vui lòng thử lại.");
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>