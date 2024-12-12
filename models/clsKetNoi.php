<?php
class clsKetNoi
{
    private $conn;

<<<<<<< HEAD
    function ketNoiDB() {
=======
    function ketNoiDB()
    {
>>>>>>> 7ed8cb8294fd34bb0c2864f6de717da1af4b4283
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
