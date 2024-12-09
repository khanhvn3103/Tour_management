<?php
include_once("clsKetNoi.php");

class modelTourPackage
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

    // Phương thức lấy tất cả gói tour
    public function selectAllTourPackages()
    {
        if ($this->conn) {
            $query = "SELECT * FROM tourpackage";
            $result = $this->conn->query($query);
            $tourPackages = [];

            while ($row = $result->fetch_assoc()) {
                $tourPackages[] = $row;
            }
            return $tourPackages;
        } else {
            return false;
        }
    }

    public function insertTourPackage($tenGoi, $diemXuatPhat, $diemDen, $moTa, $image)
    {
        if ($this->conn) {
            // Sửa câu lệnh SQL để khớp với số lượng tham số
            $query = "INSERT INTO tourpackage (packageName, startingPoint, endPoint, description, image) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);

            if ($stmt) {
                // Sửa kiểu dữ liệu trong bind_param
                $stmt->bind_param("sssss", $tenGoi, $diemXuatPhat, $diemDen, $moTa, $image);
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

    public function getTourPackageByCode($tourPackageCode)
    {
        if ($this->conn) {
            $query = "SELECT * FROM tourpackage WHERE tourPackageCode = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $tourPackageCode);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return false;
    }

    public function updateTourPackage($tourPackageCode, $packageName, $startingPoint, $endPoint, $description, $image)
    {
        if ($this->conn) {
            $query = "UPDATE tourpackage SET packageName = ?, startingPoint = ?, endPoint = ?, description = ?, image = ? WHERE tourPackageCode = ?";
            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ssssss", $packageName, $startingPoint, $endPoint, $description, $image, $tourPackageCode);
                $result = $stmt->execute();
                $stmt->close();
                return $result;
            }
        }
        return false;
    }

    // Phương thức xóa gói tour
    public function deleteTourPackage($tourPackageCode)
    {
        if ($this->conn) {
            $query = "DELETE FROM tourpackage WHERE tourPackageCode = ?";
            $stmt = $this->conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("s", $tourPackageCode);
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

    // Phương thức xóa nhiều gói tour
    public function deleteMultipleTourPackages($tourPackageCodes)
    {
        if ($this->conn) {
            $query = "DELETE FROM tourpackage WHERE tourPackageCode IN ($tourPackageCodes)";
            return $this->conn->query($query);
        } else {
            return false;
        }
    }

    // Hàm helper để bảo vệ khỏi SQL Injection
    private function quote($value)
    {
        return "'" . $this->conn->real_escape_string($value) . "'";
    }

    public function selectTourPackagesWithTours()
    {
        if ($this->conn) {
            $query = "
            SELECT tp.tourPackageCode, tp.packageName, tp.startingPoint, tp.image,
                   MIN(t.startDate) AS minStartDate, MAX(t.endDate) AS maxEndDate,
                   SUM(t.price) AS totalPrice
            FROM tourpackage tp
            LEFT JOIN tour t ON tp.tourPackageCode = t.tourPackageCode
            GROUP BY tp.tourPackageCode
        ";
            $result = $this->conn->query($query);
            $tourPackages = [];

            while ($row = $result->fetch_assoc()) {
                $tourPackages[] = $row;
            }
            return $tourPackages;
        } else {
            return false;
        }
    }
}
?>
