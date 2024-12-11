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
    function getAvailableEmployees($inputTourCode)
    {
        if ($this->conn) {
            $query = "
                SELECT e.employeeCode, e.role, u.fullName, u.phone
                FROM employee e
                JOIN users u ON e.username = u.username
                WHERE e.employeeCode NOT IN (
                    SELECT ws.employeeCode
                    FROM work_schedule ws
                    JOIN tour t ON ws.tourCode = t.tourCode
                    WHERE (
                        t.startDate < (SELECT endDate FROM tour WHERE tourCode = ?) AND
                        t.endDate > (SELECT startDate FROM tour WHERE tourCode = ?)
                    )
                )
                OR e.employeeCode NOT IN (
                    SELECT employeeCode FROM work_schedule
                )
            ";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $inputTourCode, $inputTourCode);
            $stmt->execute();
            $result = $stmt->get_result();
            $employees = [];
            while ($row = $result->fetch_assoc()) {
                $employees[] = $row;
            }
            $stmt->close();
            return $employees;
        } else {
            return false;
        }
    }
}
?>
