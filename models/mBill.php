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
            $query = "SELECT * FROM bill WHERE status = ?";
            $stmt = $this->conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("s", $status);
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
}
