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

    function createBill($numberOfPeople, $address, $total, $status, $formCode, $voucherCode, $tourCode, $customerCode)
    {
        if ($this->conn) {
            $query = "INSERT INTO bill (numberOfPeople, address, total, status, formCode, voucherCode, tourCode, customerCode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("isssisii", $numberOfPeople, $address, $total, $status, $formCode, $voucherCode, $tourCode, $customerCode);
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
}
