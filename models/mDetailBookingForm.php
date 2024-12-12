<?php
include_once("clsKetNoi.php");

class modelDetailBookingForm
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

    // Lấy thông tin chi tiết booking theo formCode
    public function getDetailBookingForm($formCode)
    {
        if ($this->conn) {
            $query = "SELECT * FROM detailbookingform WHERE formCode = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $formCode);
            $stmt->execute();
            $result = $stmt->get_result();
            $details = [];
            while ($row = $result->fetch_assoc()) {
                $details[] = $row;
            }
            $stmt->close();
            return $details;
        } else {
            return false;
        }
    }
}
