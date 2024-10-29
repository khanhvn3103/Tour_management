<?php
class clsKetNoi{
    function ketNoiDB(){
        $conn = mysqli_connect("localhost", "root", "", "ptud");
        return $conn; 
    }

    function closeKetNoi($conn){
        $conn -> close();
    }
}
?>
