<?php
include_once("ketnoi.php");

class modelCompany{
    function selectAllUsers() {
        $p = new clsKetNoi();
        $conn = $p->ketNoiDB(); 
        
        if ($conn) {
            $string = "SELECT * FROM Users";
            $result = mysqli_query($conn, $string);
            
            $users = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
    
            $p->closeKetNoi($conn); 
            return $users;
        } else {
            return false;
        }
    }    

    function selectOneUser($username) {
        $p = new clsKetNoi();
        $conn = $p->ketNoiDB(); 
        
        if ($conn) {
            $string = "SELECT * FROM Users WHERE username = ?";
            $stmt = $conn->prepare($string);
    
            if ($stmt) {
                $stmt->bind_param("s", $username);
    
                $stmt->execute();
    
                $result = $stmt->get_result();
    
                $user = $result->fetch_assoc();
    
                $stmt->close();
                $p->closeKetNoi($conn);
    
                return $user;
            } else {
                $p->closeKetNoi($conn);
                return false;
            }
        } else {
            return false;
        }
    }
    
    
    public function insertUser($username, $password, $fullName, $address, $phone, $dob, $gender, $identifyCard) {
        $p = new clsKetNoi();
        $conn = $p->ketNoiDB(); 
        
        if ($conn) {
            $string = "INSERT INTO Users (username, password, fullName, address, phone, dob, gender, identifyCard) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($string);
    
            if ($stmt) {
                $stmt->bind_param("sssssssi", $username, $password, $fullName, $address, $phone, $dob, $gender, $identifyCard);
                
                $result = $stmt->execute();
                
                $stmt->close();
                $p->closeKetNoi($conn);
                
                return $result; 
            } else {
                $p->closeKetNoi($conn);
                return false; 
            }
        } else {
            return false;
        }
    }
    
    public function deleteUser($username) {
        $p = new clsKetNoi();
        $conn = $p->ketNoiDB(); 
        
        if ($conn) {
            $string = "DELETE FROM Users WHERE username = ?";
            $stmt = $conn->prepare($string);
    
            if ($stmt) {
                $stmt->bind_param("s", $username);
    
                $result = $stmt->execute();
                
                $stmt->close();
                $p->closeKetNoi($conn);
                
                return $result;
            } else {
                $p->closeKetNoi($conn);
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function updateUser($username, $password, $fullName, $address, $phone, $dob, $gender, $identifyCard) {
        $p = new clsKetNoi();
        $conn = $p->ketNoiDB(); 
        
        if ($conn) {
            $string = "UPDATE Users SET password = ?, fullName = ?, address = ?, phone = ?, dob = ?, gender = ?, identifyCard = ? WHERE username = ?";
            
            $stmt = $conn->prepare($string);
    
            if ($stmt) {
                $stmt->bind_param("ssssssis", $password, $fullName, $address, $phone, $dob, $gender, $identifyCard, $username);
                
                $result = $stmt->execute();
                
                $stmt->close();
                $p->closeKetNoi($conn);
                
                return $result;
            } else {
                $p->closeKetNoi($conn);
                return false;
            }
        } else {
            return false;
        }
    }
    
}
?>