-- Dữ liệu mẫu cho bảng users
INSERT INTO users (username, password, fullName, address, phone, dob, gender, identifyCard) VALUES
('user1', 'password1', 'Nguyen Van A', 'Ha Noi', '0900123456', '1990-01-01', 1, '123456789'),
('user2', 'password2', 'Nguyen Van B', 'Ho Chi Minh', '0900654321', '1992-02-02', 0, '987654321'),
('user3', 'password3', 'Tran Thi A', 'Ho Chi Minh', '0900654322', '1993-03-03', 0, '876543210'),
('user4', 'password4', 'Tran Thi B', 'Da Nang', '0900654323', '1994-04-04', 0, '765432109');

-- Dữ liệu mẫu cho bảng employee
INSERT INTO employee (role, username) VALUES
('Hướng dẫn viên', 'user1'),
('Tài xế', 'user2');

-- Dữ liệu mẫu cho bảng customer
INSERT INTO customer (username) VALUES
('user3'),
('user4');

-- Dữ liệu mẫu cho bảng tourpackage
INSERT INTO tourpackage (packageName, startingPoint, endPoint, description) VALUES
('Gói 1', 'Ha Noi', 'Da Nang', 'Tham quan Đà Nẵng'),
('Gói 2', 'Ho Chi Minh', 'Nha Trang', 'Tham quan Nha Trang');

-- Dữ liệu mẫu cho bảng vehicle
INSERT INTO vehicle (vehicleName) VALUES
('Xe 16 chỗ'),
('Xe 45 chỗ');

-- Dữ liệu mẫu cho bảng tour
INSERT INTO tour (tourName, startDate, endDate, price, description, employeeCode, vehicleCode, tourPackageCode) VALUES
('Tour Đà Nẵng', '2024-01-10 08:00:00', '2024-01-15 18:00:00', 5000000, 'Tham quan Đà Nẵng', 1, 1, 1),
('Tour Nha Trang', '2024-02-20 08:00:00', '2024-02-25 18:00:00', 6000000, 'Tham quan Nha Trang', 2, 2, 2);

-- Dữ liệu mẫu cho bảng sightseeingspot
INSERT INTO sightseeingspot (spotName, startTime, endTime, description, tourPackageCode, vehicleCode) VALUES
('Bãi biển Mỹ Khê', '2024-01-11 09:00:00', '2024-01-11 12:00:00', 'Tham quan bãi biển Mỹ Khê', 1, 1),
('Tháp bà Ponagar', '2024-02-21 10:00:00', '2024-02-21 13:00:00', 'Tham quan Tháp bà Ponagar', 2, 2);

-- Dữ liệu mẫu cho bảng sightseeingspot_tour
INSERT INTO sightseeingspot_tour (tourCode, spotCode) VALUES
(1, 1),
(2, 2);

-- Dữ liệu mẫu cho bảng tourbookingform
INSERT INTO tourbookingform (bookingDate, numberOfChildren, numberOfAdults, customerCode, tourCode) VALUES
('2023-12-01 10:00:00', 2, 2, 1, 1),
('2023-12-15 15:00:00', 1, 3, 2, 2);

-- Dữ liệu mẫu cho bảng detailbookingform
INSERT INTO detailbookingform (fullName, gender, dob, identifyCard, nationality, formCode) VALUES
('Nguyen Van A', 1, '1990-01-01 00:00:00', '123456789', 'Vietnam', 1),
('Tran Thi B', 0, '1992-02-02 00:00:00', '987654321', 'Vietnam', 2);

-- Dữ liệu mẫu cho bảng voucher
INSERT INTO voucher (voucherCode, beginAt, endAt, sale) VALUES
('VOUCHER1', '2023-12-01 00:00:00', '2024-01-01 23:59:59', 10),
('VOUCHER2', '2024-01-01 00:00:00', '2024-02-01 23:59:59', 20);

-- Dữ liệu mẫu cho bảng bill
INSERT INTO bill (numberOfPeople, address, total, status, formCode, voucherCode, createAt) VALUES
(4, 'Ha Noi', 13500000, 'Đã Hủy', 1, 'VOUCHER1', '2024-01-01 00:00:00'),
(3, 'Da Nang', 9600000, 'Hoàn Thành', 2, 'VOUCHER2', '2024-02-01 00:00:00');

-- Dữ liệu mẫu cho bảng evaluate
INSERT INTO evaluate (content, star, customerCode, tourCode, billCode) VALUES
('Tuyệt vời!', 5, 1, 1, 1),
('Không hài lòng lắm', 2, 2, 2, 2);
