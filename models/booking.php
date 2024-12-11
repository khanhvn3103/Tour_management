<?php
include_once("clsKetNoi.php");
class modelBooking
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

    // Phương thức lấy tất cả gói tour
    public function selectAllBookingPackages()
    {
        if ($this->conn) {
            $query = "SELECT * FROM tourpackage";
            $result = $this->conn->query($query);
            $tourPackages = [];

            while ($row = $result->fetch_assoc()) {
                $tourPackages[] = $row;
            }
            return $tourPackages;
        } else {
            return false;
        }
    }

    // Phương thức lấy danh sách người đặt tour
    public function selectAllBookings()
    {
        if ($this->conn) {
            $query = "
                SELECT tb.formCode, tb.bookingDate, tb.numberOfAdults, tb.numberOfChildren, u.fullName, tp.packageName, c.customerCode, tb.status
                FROM tourbookingform tb
                JOIN customer c ON tb.customerCode = c.customerCode 
                JOIN users u ON c.username = u.username
                JOIN tourpackage tp ON tb.tourPackageCode = tp.tourPackageCode
            ";
            $result = $this->conn->query($query);
            $bookings = [];

            while ($row = $result->fetch_assoc()) {
                $bookings[] = $row;
            }
            return $bookings;
        } else {
            return false;
        }
    }

    // Phương thức duyệt đơn đặt tour
    public function approveBooking($formCode)
    {
        if ($this->conn) {
            $query = "UPDATE tourbookingform SET status = 'approved' WHERE formCode = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $formCode);
            return $stmt->execute();
        }
        return false;
    }

    // Phương thức từ chối đơn đặt tour
    public function rejectBooking($formCode)
    {
        if ($this->conn) {
            $query = "UPDATE tourbookingform SET status = 'rejected' WHERE formCode = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $formCode);
            return $stmt->execute();
        }
        return false;
    }

    // Phương thức thêm thông báo vào bảng notify
    public function addNotification($customerCode, $message)
    {
        if ($this->conn) {
            $query = "INSERT INTO notify (customerCode, message, created_at) VALUES (?, ?, NOW())";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("is", $customerCode, $message);
            return $stmt->execute();
        }
        return false;
    }

    public function getNotifications($customerCode)
    {
        if ($this->conn) {
            $query = "SELECT message, created_at FROM notify WHERE customerCode = ? ORDER BY created_at DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $customerCode);
            $stmt->execute();
            $result = $stmt->get_result();
            $notifications = [];

            while ($row = $result->fetch_assoc()) {
                $notifications[] = $row;
            }
            return $notifications;
        }
        return [];
    }
}
