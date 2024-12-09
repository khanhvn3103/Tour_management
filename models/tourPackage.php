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

    public function selectTourPackagesWithTours($startingPoint = '', $destination = '', $duration = '', $numberOfPeople = '')
    {
        if ($this->conn) {
            // Khởi tạo truy vấn cơ bản
            $query = "
            SELECT tp.tourPackageCode, tp.packageName, tp.startingPoint, tp.image,
                   MIN(t.startDate) AS minStartDate, MAX(t.endDate) AS maxEndDate,
                   SUM(t.price) AS totalPrice
            FROM tourpackage tp
            LEFT JOIN tour t ON tp.tourPackageCode = t.tourPackageCode
            WHERE 1=1
        ";

            // Thêm điều kiện lọc cho điểm đi
            if ($startingPoint) {
                $query .= " AND tp.startingPoint LIKE '%" . $this->conn->real_escape_string($startingPoint) . "%'";
            }

            // Thêm điều kiện lọc cho điểm đến
            if ($destination) {
                $query .= " AND t.destination LIKE '%" . $this->conn->real_escape_string($destination) . "%'";
            }

            // Thêm điều kiện lọc cho thời gian
            if ($duration) {
                switch ($duration) {
                    case '1':
                        $query .= " AND DATEDIFF(MAX(t.endDate), MIN(t.startDate)) BETWEEN 1 AND 3";
                        break;
                    case '2':
                        $query .= " AND DATEDIFF(MAX(t.endDate), MIN(t.startDate)) BETWEEN 4 AND 7";
                        break;
                    case '3':
                        $query .= " AND DATEDIFF(MAX(t.endDate), MIN(t.startDate)) BETWEEN 8 AND 14";
                        break;
                    case '4':
                        $query .= " AND DATEDIFF(MAX(t.endDate), MIN(t.startDate)) > 14";
                        break;
                }
            }

            // Thêm điều kiện lọc cho số lượng người
//            if ($numberOfPeople) {
//                $query .= " AND t.numberOfPeople >= " . (int)$numberOfPeople;
//            }

            // Cập nhật GROUP BY
            $query .= " GROUP BY tp.tourPackageCode, tp.packageName, tp.startingPoint, tp.image";

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
