<?php
include_once("clsKetNoi.php");

class modelUser
{
    private $conn;

    function __construct()
    {
        $p = new clsKetNoi();
        $this->conn = $p->ketNoiDB(); // Sử dụng đối tượng kết nối duy nhất
    }

    function __destruct()
    {
        if ($this->conn) {
            $this->conn->close(); // Đóng kết nối khi kết thúc
        }
    }

    // Phương thức lấy tất cả người dùng
    function selectAllUsers()
    {
        if ($this->conn) {
            $query = "SELECT * FROM users";
            $result = $this->conn->query($query);
            if ($result) {
                $users = [];
                while ($row = $result->fetch_assoc()) {
                    $users[] = $row;
                }
                return $users;
            } else {
                return false;
            }
        }
        return false;
    }

    // Phương thức lấy một người dùng theo username
    function selectOneUser($username)
    {
        if ($this->conn) {
            $query = "SELECT users.username, users.password, users.fullName, users.address, users.phone, users.dob, users.gender, users.identifyCard, employee.role
                      FROM users
                      JOIN employee ON users.username = employee.username
                      WHERE users.username = ?";
            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                $stmt->close();
                return $user;
            } else {
                return false;
            }
        }
        return false;
    }

    // Phương thức thêm người dùng mới
    public function insertUser($username, $password, $fullName, $address, $phone, $dob, $gender, $identifyCard)
    {
        if ($this->conn) {
            $query = "INSERT INTO users (username, password, fullName, address, phone, dob, gender, identifyCard) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("sssssssi", $username, $password, $fullName, $address, $phone, $dob, $gender, $identifyCard);
                $result = $stmt->execute();
                $stmt->close();
                return $result;
            } else {
                return false;
            }
        }
        return false;
    }

    // Phương thức xóa người dùng
    public function deleteUser($username)
    {
        if ($this->conn) {
            // Xóa bản ghi trong bảng employee trước
            $queryEmployee = "DELETE FROM employee WHERE username = ?";
            $stmtEmployee = $this->conn->prepare($queryEmployee);
            if ($stmtEmployee) {
                $stmtEmployee->bind_param("s", $username);
                $stmtEmployee->execute();
                $stmtEmployee->close();
            } else {
                return false;
            }

            // Sau đó xóa bản ghi trong bảng users
            $queryUser = "DELETE FROM users WHERE username = ?";
            $stmtUser = $this->conn->prepare($queryUser);
            if ($stmtUser) {
                $stmtUser->bind_param("s", $username);
                $result = $stmtUser->execute();
                $stmtUser->close();
                return $result;
            } else {
                return false;
            }
        }
        return false;
    }

    // Phương thức cập nhật người dùng
    public function updateUser($username, $password, $fullName, $address, $phone, $dob, $gender, $identifyCard, $role)
    {
        if ($this->conn) {
            // Update bảng users
            $queryUser = "UPDATE users SET password = ?, fullName = ?, address = ?, phone = ?, dob = ?, gender = ?, identifyCard = ? WHERE username = ?";
            $stmtUser = $this->conn->prepare($queryUser);

            if ($stmtUser) {
                $stmtUser->bind_param("ssssssis", $password, $fullName, $address, $phone, $dob, $gender, $identifyCard, $username);
                $stmtUser->execute();
                $stmtUser->close();
            } else {
                return false;
            }

            // Update bảng employee
            $queryEmployee = "UPDATE employee SET role = ? WHERE username = ?";
            $stmtEmployee = $this->conn->prepare($queryEmployee);

            if ($stmtEmployee) {
                $stmtEmployee->bind_param("ss", $role, $username);
                $result = $stmtEmployee->execute();
                $stmtEmployee->close();
                return $result;
            } else {
                return false;
            }
        }
        return false;
    }

    // Lấy danh sách tất cả các nhân viên
    public function getListEmployees()
    {
        if ($this->conn) {
            $query = "SELECT employee.employeeCode, users.username, users.fullName, employee.role, users.address, users.phone, users.dob, users.gender, users.identifyCard 
                      FROM employee 
                      JOIN users ON employee.username = users.username";
            $result = $this->conn->query($query);
            if ($result) {
                $employees = [];
                while ($row = $result->fetch_assoc()) {
                    $employees[] = $row;
                }
                return $employees;
            } else {
                return false;
            }
        }
        return false;
    }

    // Phương thức thêm nhân viên
    public function insertEmployee($username, $password, $fullName, $address, $phone, $dob, $gender, $identifyCard, $role)
    {
        if ($this->conn) {
            // Insert vào bảng users trước
            $queryUser = "INSERT INTO users (username, password, fullName, address, phone, dob, gender, identifyCard) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtUser = $this->conn->prepare($queryUser);

            if ($stmtUser) {
                $stmtUser->bind_param("sssssssi", $username, $password, $fullName, $address, $phone, $dob, $gender, $identifyCard);
                $stmtUser->execute();
                $stmtUser->close();
            } else {
                return false;
            }

            // Insert vào bảng employee
            $queryEmployee = "INSERT INTO employee (username, role) VALUES (?, ?)";
            $stmtEmployee = $this->conn->prepare($queryEmployee);

            if ($stmtEmployee) {
                $stmtEmployee->bind_param("ss", $username, $role);
                $result = $stmtEmployee->execute();
                $stmtEmployee->close();
                return $result;
            } else {
                return false;
            }
        }
        return false;
    }

    // Phương thức cập nhật nhân viên
    public function updateEmployee($username, $password, $fullName, $address, $phone, $dob, $gender, $identifyCard, $role)
    {
        if ($this->conn) {
            // Update bảng users trước
            $queryUser = "UPDATE users SET password = ?, fullName = ?, address = ?, phone = ?, dob = ?, gender = ?, identifyCard = ? WHERE username = ?";
            $stmtUser = $this->conn->prepare($queryUser);

            if ($stmtUser) {
                $stmtUser->bind_param("ssssssis", $password, $fullName, $address, $phone, $dob, $gender, $identifyCard, $username);
                $stmtUser->execute();
                $stmtUser->close();
            } else {
                return false;
            }

            // Update bảng employee
            $queryEmployee = "UPDATE employee SET role = ? WHERE username = ?";
            $stmtEmployee = $this->conn->prepare($queryEmployee);

            if ($stmtEmployee) {
                $stmtEmployee->bind_param("ss", $role, $username);
                $result = $stmtEmployee->execute();
                $stmtEmployee->close();
                return $result;
            } else {
                return false;
            }
        }
        return false;
    }
}
