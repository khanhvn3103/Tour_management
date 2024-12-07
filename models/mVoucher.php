<?php
include_once("clsKetNoi.php");

class modelVoucher
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

    // Phương thức lấy tất cả các voucher
    function selectAllVouchers()
    {
        if ($this->conn) {
            $query = "SELECT * FROM voucher";
            $result = $this->conn->query($query);
            $vouchers = [];

            while ($row = $result->fetch_assoc()) {
                $vouchers[] = $row;
            }
            return $vouchers;
        } else {
            return false;
        }
    }

    // Phương thức thêm voucher mới
    function insertVoucher($voucherCode, $beginAt, $endAt, $sale)
    {
        if ($this->conn) {
            $query = "INSERT INTO voucher (voucherCode, beginAt, endAt, sale) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("sssd", $voucherCode, $beginAt, $endAt, $sale);
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

    // Phương thức xóa voucher
    function deleteVoucher($voucherCode)
    {
        if ($this->conn) {
            $query = "DELETE FROM voucher WHERE voucherCode = ?";
            $stmt = $this->conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("s", $voucherCode);
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
}
