<?php
include_once(__DIR__ . "/clsKetNoi.php");

class modelCustomer
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

    function getCustomer($customerCode)
    {
        if ($this->conn) {
            $query = "SELECT * FROM customer WHERE customerCode = ?";
            $stmt = $this->conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("i", $customerCode);
                $stmt->execute();
                $result = $stmt->get_result();
                $customer = $result->fetch_assoc();
                $stmt->close();
                return $customer;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Thêm phương thức lấy tất cả khách hàng
    function getAllCustomers()
    {
        if ($this->conn) {
            $query = "SELECT * FROM customer";
            $result = $this->conn->query($query);
            $customers = [];

            while ($row = $result->fetch_assoc()) {
                $customers[] = $row;
            }

            return $customers;
        } else {
            return false;
        }
    }
}
