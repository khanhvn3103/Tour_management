<?php
include_once("clsKetNoi.php");

class modelEmployee
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

    public function selectAllEmployees()
    {
        if ($this->conn) {
            $query = "SELECT * FROM employee";
            $result = $this->conn->query($query);
            $employees = [];

            while ($row = $result->fetch_assoc()) {
                $employees[] = $row;
            }
            return $employees;
        } else {
            return false;
        }
    }
}
?>
