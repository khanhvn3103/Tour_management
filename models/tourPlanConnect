<?php
include_once("clsKetNoi.php");

class modelTourPlan
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

    // Phương thức lấy tất cả các tour
    function selectAllTourPlans()
    {
        if ($this->conn) {
            $query = "SELECT * FROM tourplan";
            $result = $this->conn->query($query);
            $tourplan = [];

            while ($row = $result->fetch_assoc()) {
                $tourplan[] = $row;
            }
            return $tourplan;
        } else {
            return false;
        }
    }
    
    // Lấy thông tin tour thông qua tourCode
    function getTourPlan($tourCode){
        if($this->conn){
            $query = "SELECT * FROM tourplan WHERE tourCode =?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('i', $tourCode);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row;
        }else{
            return false;
        }        
    }
}
