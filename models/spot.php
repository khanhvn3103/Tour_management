<?php
include_once("clsKetNoi.php");

class modelSpot
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

    public function selectAllSpots()
    {
        if ($this->conn) {
            $query = "SELECT * FROM sightseeingspot";
            $result = $this->conn->query($query);
            $spots = [];

            while ($row = $result->fetch_assoc()) {
                $spots[] = $row;
            }
            return $spots;
        } else {
            return false;
        }
    }

    public function getSpotByCode($spotCode)
    {
        if ($this->conn) {
            $query = "SELECT * FROM sightseeingspot WHERE spotCode = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $spotCode);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return false;
    }

    public function insertSpot($spotName, $startTime, $endTime, $description, $tourPackageCode, $vehicleCode, $image)
    {
        if ($this->conn) {
            $query = "INSERT INTO sightseeingspot (spotName, startTime, endTime, description, tourPackageCode, vehicleCode, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ssssiis", $spotName, $startTime, $endTime, $description, $tourPackageCode, $vehicleCode, $image);
                return $stmt->execute();
            }
        }
        return false;
    }


    public function updateSpot($spotCode, $spotName, $startTime, $endTime, $description, $tourPackageCode, $vehicleCode, $image)
    {
        if ($this->conn) {
            $query = "UPDATE sightseeingspot SET spotName = ?, startTime = ?, endTime = ?, description = ?, tourPackageCode = ?, vehicleCode = ?, image = ? WHERE spotCode = ?";
            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ssssisi", $spotName, $startTime, $endTime, $description, $tourPackageCode, $vehicleCode, $image, $spotCode);
                return $stmt->execute();
            }
        }
        return false;
    }

    public function deleteSpot($spotCode)
    {
        if ($this->conn) {
            $query = "DELETE FROM sightseeingspot WHERE spotCode = ?";
            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("i", $spotCode);
                return $stmt->execute();
            }
        }
        return false;
    }

    public function deleteMultipleSpots($spotCodes)
    {
        if ($this->conn) {
            $query = "DELETE FROM sightseeingspot WHERE spotCode IN ($spotCodes)";
            return $this->conn->query($query);
        }
        return false;
    }
}
?>
