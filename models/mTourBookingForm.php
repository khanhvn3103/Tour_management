<?php
include_once("clsKetNoi.php");

class modelTourBookingForm
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

    // Lấy thông tin booking theo formCode
    public function getTourBookingForm($formCode)
    {
        if ($this->conn) {
            $query = "SELECT * FROM tourbookingform WHERE formCode = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $formCode);
            $stmt->execute();
            $result = $stmt->get_result();
            $booking = $result->fetch_assoc();
            $stmt->close();
            return $booking;
        } else {
            return false;
        }
    }
}
