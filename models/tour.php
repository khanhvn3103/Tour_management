<?php
include_once("clsKetNoi.php");

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

    public function selectAllTours()
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

    public function getTourByCode($tourCode)
    {
        if ($this->conn) {
            $query = "SELECT * FROM tour WHERE tourCode = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $tourCode);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return false;
    }

    public function insertTour($tourName, $startDate, $endDate, $price, $description, $employeeCode, $vehicleCode, $tourPackageCode)
    {
        if ($this->conn) {
            $query = "INSERT INTO tour (tourName, startDate, endDate, price, description, employeeCode, vehicleCode, tourPackageCode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                // Chỉnh sửa kiểu dữ liệu cho bind_param
                $stmt->bind_param("ssssssss", $tourName, $startDate, $endDate, $price, $description, $employeeCode, $vehicleCode, $tourPackageCode);
                return $stmt->execute();
            }
        }
        return false;
    }


    public function updateTour($tourCode, $tourName, $startDate, $endDate, $price, $description, $employeeCode, $vehicleCode, $tourPackageCode)
    {
        if ($this->conn) {
            $query = "UPDATE tour SET tourName = ?, startDate = ?, endDate = ?, price = ?, description = ?, employeeCode = ?, vehicleCode = ?, tourPackageCode = ? WHERE tourCode = ?";
            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("sssssissi", $tourName, $startDate, $endDate, $price, $description, $employeeCode, $vehicleCode, $tourPackageCode, $tourCode);
                return $stmt->execute();
            }
        }
        return false;
    }

    public function deleteTour($tourCode)
    {
        if ($this->conn) {
            $query = "DELETE FROM tour WHERE tourCode = ?";
            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("i", $tourCode);
                return $stmt->execute();
            }
        }
        return false;
    }

    public function deleteMultipleTours($tourCodes)
    {
        if ($this->conn) {
            $query = "DELETE FROM tour WHERE tourCode IN ($tourCodes)";
            return $this->conn->query($query);
        }
        return false;
    }
}

