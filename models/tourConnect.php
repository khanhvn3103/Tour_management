<?php
include_once("clsKetNoi.php");

class modelTour
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
    function selectAllTours()
    {
        if ($this->conn) {
            $query = "SELECT * FROM tour";
            $result = $this->conn->query($query);
            $tours = [];

            while ($row = $result->fetch_assoc()) {
                $tours[] = $row;
            }
            return $tours;
        } else {
            return false;
        }
    }
    
    // Lấy thông tin tour thông qua tourCode
    function getTour($tourCode){
        if($this->conn){
            $query = "SELECT * FROM tour WHERE tourCode =?";
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
    
    // show_gallery
    function show_gallery($tourCode){
        if($this->conn){
            $query = "SELECT * FROM tour_gallery WHERE tourCode =?";
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
