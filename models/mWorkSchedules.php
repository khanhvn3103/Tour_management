<?php
include_once("clsKetNoi.php");

class modelWorkSchedules
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

    function assignEmployeeToTour($employeeCode, $tourCode)
    {
        if ($this->conn) {
            $query = "INSERT INTO work_schedule (employeeCode, tourCode, assignedAt) VALUES (?, ?, NOW())";
            $stmt = $this->conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("ii", $employeeCode, $tourCode);

                if ($stmt->execute()) {
                    $stmt->close();
                    return true;
                } else {
                    error_log("Lỗi khi thực thi câu truy vấn: " . $stmt->error);
                    $stmt->close();
                    return false;
                }
            } else {
                error_log("Lỗi khi chuẩn bị câu truy vấn: " . $this->conn->error);
                return false;
            }
        } else {
            error_log("Kết nối cơ sở dữ liệu không có sẵn.");
            return false;
        }
    }
}
?>
