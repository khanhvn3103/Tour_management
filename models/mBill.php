<?php
include_once(__DIR__ . "/clsKetNoi.php");

class modelBill
{
    private $conn;

    function __construct()
    {
        $p = new clsKetNoi();
        $this->conn = $p->ketNoiDB();
    }

    function __destruct()
    {
        $p = new clsKetNoi();
        $p->closeKetNoi($this->conn);
    }

    function createBill($numberOfPeople, $address, $total, $status, $formCode, $voucherCode)
    {
        if ($this->conn) {
            $query = "INSERT INTO bill (numberOfPeople, address, total, status, formCode, voucherCode, createAt) VALUES (?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $this->conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("isssis", $numberOfPeople, $address, $total, $status, $formCode, $voucherCode);
                $result = $stmt->execute();
                $stmt->close();
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getBill($billCode)
    {
        if ($this->conn) {
            $query = "SELECT * FROM bill WHERE billCode = ?";
            $stmt = $this->conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("i", $billCode);
                $stmt->execute();
                $result = $stmt->get_result();
                $bill = $result->fetch_assoc();
                $stmt->close();
                return $bill;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getBillsByStatus($status)
    {
        if ($this->conn) {
            // Nếu status là "Tất Cả", lấy tất cả các hóa đơn chưa bị huỷ hoặc hoàn thành
            if ($status == 'Tất Cả') {
                $query = "SELECT * FROM bill ";
            } else {
                // Nếu status là một trạng thái cụ thể, lấy hóa đơn theo trạng thái
                $query = "SELECT * FROM bill WHERE status = ?";
            }

            $stmt = $this->conn->prepare($query);

            if ($stmt) {
                // Nếu trạng thái không phải là "Tất Cả", sử dụng bind_param
                if ($status != 'Tất Cả') {
                    $stmt->bind_param("s", $status);
                }

                $stmt->execute();
                $result = $stmt->get_result();
                $bills = [];

                while ($row = $result->fetch_assoc()) {
                    $bills[] = $row;
                }

                $stmt->close();
                return $bills;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getAllBills()
    {
        if ($this->conn) {
            $query = "SELECT * FROM bill";
            $result = $this->conn->query($query);
            $bills = [];

            while ($row = $result->fetch_assoc()) {
                $bills[] = $row;
            }

            return $bills;
        } else {
            return false;
        }
    }

    // Thêm phương thức cập nhật trạng thái hóa đơn
    function updateBillStatus($billCode, $status)
    {
        if ($this->conn) {
            $query = "UPDATE bill SET status = ? WHERE billCode = ?";
            $stmt = $this->conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("si", $status, $billCode);
                $result = $stmt->execute();
                $stmt->close();
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Thêm phương thức lấy các mã đặt tour chưa được tạo hóa đơn
    function getAvailableTourBookingForms()
    {
        if ($this->conn) {
            $query = "SELECT formCode FROM tourbookingform WHERE formCode NOT IN (SELECT formCode FROM bill)";
            $result = $this->conn->query($query);
            $forms = [];

            while ($row = $result->fetch_assoc()) {
                $forms[] = $row['formCode'];
            }

            return $forms;
        } else {
            return false;
        }
    }

    // Phương thức tạo hóa đơn
    function createInvoice($formCode, $address, $voucherCode = null)
    {
        global $tourBookingFormModel, $detailBookingFormModel, $voucherModel, $tourModel;

        // Lấy thông tin từ tourbookingform
        $booking = $tourBookingFormModel->getTourBookingForm($formCode);
        if (!$booking) {
            return "Không tìm thấy booking với formCode: $formCode.";
        }

        // Lấy thông tin chi tiết từ detailbookingform
        $details = $detailBookingFormModel->getDetailBookingForm($formCode);
        if (!$details) {
            return "Không tìm thấy chi tiết booking với formCode: $formCode.";
        }

        // Tính tổng số người
        $numberOfPeople = count($details);

        // Lấy thông tin voucher nếu có
        $voucher = $voucherCode ? $voucherModel->getVoucher($voucherCode) : null;

        // Lấy thông tin khách hàng và tour từ booking
        $customerCode = $booking['customerCode'];
        $tourCode = $booking['tourCode'];

        // Tính toán tổng tiền
        $tour = $tourModel->getTour($tourCode);
        $total = ($tour['price'] * $booking['numberOfAdults']) + ($tour['price'] * 0.7 * $booking['numberOfChildren']);
        if ($voucher) {
            $total = $total * ((100 - $voucher['sale']) / 100);
        }

        // Các thông tin khác
        $status = 'Đang xử lý'; // Trạng thái hóa đơn

        // Tạo hóa đơn
        $result = $this->createBill($numberOfPeople, $address, $total, $status, $formCode, $voucherCode);
        if($result) {
            return "Hóa đơn đã được tạo thành công." ;
        } else {
            return "Có lỗi xảy ra khi tạo hóa đơn. Vui lòng thử lại.";
        }
    }

    // Phương thức cập nhật trạng thái hóa đơn
    function updateInvoiceStatus($billCode, $status)
    {
        // Cập nhật trạng thái hóa đơn
        $result = $this->updateBillStatus($billCode, $status);
        if($result) {
            return "Trạng thái hóa đơn đã được cập nhật thành công." ;
        } else {
            return "Có lỗi xảy ra khi cập nhật trạng thái hóa đơn. Vui lòng thử lại.";
        }
    }
}
