<?php
class clsKetNoi
{
    private $conn;

    function ketNoiDB() {
        $this->conn = new mysqli("localhost", "root", "", "ptud");

        // Kiểm tra kết nối
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }

    function closeKetNoi()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
