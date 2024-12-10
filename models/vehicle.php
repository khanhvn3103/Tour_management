<?php
include_once("clsKetNoi.php");

class modelVehicle
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

    public function selectAllVehicles()
    {
        if ($this->conn) {
            $query = "SELECT * FROM vehicle";
            $result = $this->conn->query($query);
            $vehicles = [];

            while ($row = $result->fetch_assoc()) {
                $vehicles[] = $row;
            }
            return $vehicles;
        } else {
            return false;
        }
    }
}
?>
