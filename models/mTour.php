<?php
include_once(__DIR__ . "/clsKetNoi.php");

class modelTour
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

    function getTour($tourCode)
    {
        if ($this->conn) {
            $query = "SELECT * FROM tour WHERE tourCode = ?";
            $stmt = $this->conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("i", $tourCode);
                $stmt->execute();
                $result = $stmt->get_result();
                $tour = $result->fetch_assoc();
                $stmt->close();
                return $tour;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Thêm phương thức lấy tất cả các tour
    function getAllTours()
    {
        if ($this->conn) {
            $query = "SELECT * FROM tour";
            $result = $this->conn->query($query);
            $tours = [];

            while ($row = $result->fetch_assoc()) {
                $tours[] = $row;
            }

            return $tours;
        } else {
            return false;
        }
    }
}
