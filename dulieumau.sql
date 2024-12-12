-- Dữ liệu mẫu cho bảng users
INSERT INTO users (username, password, fullName, address, phone, dob, gender, identifyCard) VALUES
('admin', 'admin', 'admin', 'Ha Noi', '0901234567', '1990-01-01', 1, '123498765'),
('user1', 'password1', 'Nguyen Van A', 'Ha Noi', '0900123456', '1990-01-01', 1, '123456789'),
('user2', 'password2', 'Nguyen Van B', 'Ho Chi Minh', '0900654321', '1992-02-02', 0, '987654321'),
('user3', 'password3', 'Tran Thi A', 'Ho Chi Minh', '0900654322', '1993-03-03', 0, '876543210'),
('user4', 'password4', 'Tran Thi B', 'Da Nang', '0900654323', '1994-04-04', 0, '765432109'),
('user5', 'password5', 'Nguyen Van C', 'Can Tho', '0900654324', '1990-05-05', 1, '654321098'),
('user6', 'password6', 'Tran Van D', 'Hai Phong', '0900654325', '1991-06-06', 1, '543210987'),
('user7', 'password7', 'Le Thi E', 'Nha Trang', '0900654326', '1992-07-07', 0, '432109876'),
('user8', 'password8', 'Pham Van F', 'Hue', '0900654327', '1993-08-08', 1, '321098765');

-- Dữ liệu mẫu cho bảng employee
INSERT INTO employee (role, username) VALUES
('admin', 'admin'),
('Tài xế', 'user2'),
('Hướng dẫn viên', 'user5'),
('Tài xế', 'user6'),
('Hướng dẫn viên', 'user7'),
('Tài xế', 'user8');

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
('Tour Nha Trang', '2024-02-20 08:00:00', '2024-02-25 18:00:00', 6000000, 'Tham quan Nha Trang', 2, 2, 2),
('Tour Sapa', '2024-01-12 08:00:00', '2024-01-17 18:00:00', 7000000, 'Tham quan Sapa', 3, 1, 1),
('Tour Hue', '2024-02-22 08:00:00', '2024-02-27 18:00:00', 4000000, 'Tham quan Huế', 4, 2, 2);

-- Dữ liệu mẫu cho bảng sightseeingspot
INSERT INTO sightseeingspot (spotName, startTime, endTime, description, tourPackageCode, vehicleCode, image) VALUES
('Sun World Fansipan Legend Sapa - Sáng', '09:00:00', '12:00:00', 'Sun World Fansipan Legend Sapa', 1, 1, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733936631/image_2024-12-12_000342140_zc9dhz.png'),
('Sun World Fansipan Legend Sapa - Chiều', '13:00:00', '15:00:00', 'Sun World Fansipan Legend Sapa', 1, 1, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733936631/image_2024-12-12_000342140_zc9dhz.png'),
('Thánh Địa Mỹ Sơn Đà Nẵng - Sáng', '09:00:00', '12:00:00', 'Địa điểm tôn giáo đầu tiên của người dân tộc Chăm', 1, 1, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733937378/image_2024-12-12_001610538_hbusf2.png'),
('Thánh Địa Mỹ Sơn Đà Nẵng - Chiều', '13:00:00', '15:00:00', 'Địa điểm tôn giáo đầu tiên của người dân tộc Chăm', 1, 1, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733937378/image_2024-12-12_001610538_hbusf2.png'),
('Hòn Trống Mái - Hạ Long - Sáng', '07:00:00', '09:00:00', 'Kỳ quan thiên nhiên đặc biệt của Vịnh Hạ Long', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733936816/image_2024-12-12_000649268_xhd86m.png'),
('Hòn Trống Mái - Hạ Long - Chiều', '15:00:00', '17:00:00', 'Kỳ quan thiên nhiên đặc biệt của Vịnh Hạ Long', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733937235/image_2024-12-12_001348294_pa05fm.png'),
('Tam Cốc - Bích Động Ninh Bình - Sáng', '07:00:00', '09:00:00', 'Khung cảnh thiên nhiên yên bình nhờ non xanh, nước biếc và những làng mạc trù phú trong khu danh thắng Tam Cốc - Bích Động', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733936988/image_2024-12-12_000939995_fw8eua.png'),
('Tam Cốc - Bích Động Ninh Bình - Chiều', '15:00:00', '17:00:00', 'Khung cảnh thiên nhiên yên bình nhờ non xanh, nước biếc và những làng mạc trù phú trong khu danh thắng Tam Cốc - Bích Động', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733936988/image_2024-12-12_000939995_fw8eua.png'),
('Chùa Bái Đính Ninh Bình - Sáng', '09:00:00', '12:00:00', 'Ngôi chùa có diện tích rộng lớn bậc nhất Đông Nam Á này sẽ không làm cho bạn thất vọng bởi độ tráng lệ', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733937161/image_2024-12-12_001234709_wmlrpr.png'),
('Chùa Bái Đính Ninh Bình - Chiều', '09:00:00', '12:00:00', 'Ngôi chùa có diện tích rộng lớn bậc nhất Đông Nam Á này sẽ không làm cho bạn thất vọng bởi độ tráng lệ', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733937161/image_2024-12-12_001234709_wmlrpr.png'),
('VinWonders Nha Trang - Sáng', '09:00:00', '12:00:00', 'Khu vui chơi, giải trí và là địa điểm sống ảo không thể tuyệt vời hơn cho cả gia đình', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733937454/image_2024-12-12_001727034_eknakm.png'),
('VinWonders Nha Trang - Chiều', '09:00:00', '12:00:00', 'Khu vui chơi, giải trí và là địa điểm sống ảo không thể tuyệt vời hơn cho cả gia đình', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733937454/image_2024-12-12_001727034_eknakm.png'),
('Hòn Tằm Nha Trang - Sáng', '09:00:00', '12:00:00', 'Dải cát trắng hơn 1000m kết hợp với biển mênh mông màu xanh ngọc bích cùng màu xanh của những dãy núi hùng vĩ', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733937603/image_2024-12-12_001956506_pjctgh.png'),
('Hòn Tằm Nha Trang - Chiều', '09:00:00', '12:00:00', 'Dải cát trắng hơn 1000m kết hợp với biển mênh mông màu xanh ngọc bích cùng màu xanh của những dãy núi hùng vĩ', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733937603/image_2024-12-12_001956506_pjctgh.png'),
('Vinpearl Safari Phú Quốc - Sáng', '09:00:00', '12:00:00', 'Trải nghiệm khác biệt hoàn toàn so với các sở thú truyền thống khi bạn có thể “mục sở thị” các loài động vật hoang dã bằng cách quan sát chúng từ xe bus', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733937706/image_2024-12-12_002139550_o0zmge.png'),
('Vinpearl Safari Phú Quốc - Chiều', '09:00:00', '12:00:00', 'Trải nghiệm khác biệt hoàn toàn so với các sở thú truyền thống khi bạn có thể “mục sở thị” các loài động vật hoang dã bằng cách quan sát chúng từ xe bus', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733937603/image_2024-12-12_001956506_pjctgh.png'),
('Công Viên San Hô Nautilus Namaste Phú Quốc - Sáng', '09:00:00', '12:00:00', 'Nơi lưu giữ và bảo tồn các loài san hô với đủ màu sắc và kích thước khác nhau', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733937985/image_2024-12-12_002618042_abcfb9.png'),
('Công Viên San Hô Nautilus Namaste Phú Quốc - Chiều', '09:00:00', '12:00:00', 'Nơi lưu giữ và bảo tồn các loài san hô với đủ màu sắc và kích thước khác nhau', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733937985/image_2024-12-12_002618042_abcfb9.png'),
('Chợ Nổi Cái Răng Cần Thơ - Sáng', '09:00:00', '12:00:00', 'Nơi giao thương mua bán sôi động của người dân địa phương, với các mặt hàng chủ yếu là trái cây, rau củ, hoa lan và các sản phẩm thủ công mỹ nghệ.', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733938210/image_2024-12-12_003003450_kad2dm.png'),
('Vườn Cò Bằng Lăng - Chiều - Chiều', '15:00:00', '17:00:00', 'Các loài cò xuất hiện với hơn 20 loài khác nhau, như: cò rán, cò xanh, cò sen, cò quắm, cò bông,... và một số loài khác như: bồ nông, vạc, bìm bịp, diệc, điên điển tạo nên khung cảnh đẹp và bình yên đến lạ', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733938352/image_2024-12-12_003225717_x6va3t.png'),
('Rừng Tràm Trà Sư An Giang - Sáng', '09:00:00', '12:00:00', 'Nơi đây được mệnh danh là "vương quốc tràm" với diện tích hơn 800ha, là nơi sinh sống của hệ sinh thái đa dạng và phong phú', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733938078/image_2024-12-12_002751166_naymad.png'),
('Miếu Bà Chúa Xứ Núi Sam Ở An Giang - Chiều', '15:00:00', '17:00:00', 'Miếu Bà Chúa Xứ là một trong những địa điểm tâm linh nổi tiếng nhất An Giang', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733938492/image_2024-12-12_003445369_tijzhs.png'),
('Sân Chim Vàm Hồ Bến Tre - Chiều', '15:00:00', '17:00:00', 'Đến đây, bạn sẽ có cơ hội chiêm ngưỡng 84 loài chim khác nhau', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733938844/image_2024-12-12_004037548_vprquz.png'),
('Mũi An Giang - Chiều', '15:00:00', '17:00:00', 'Mũi Cà Mau là nơi đặt cột mốc tọa độ GPS 0001 (cây số 0). Cột mốc này mang hình một con tàu no gió, vươn mình ra biển.', 2, 2, 'https://res.cloudinary.com/dz96u1u2a/image/upload/v1733938701/image_2024-12-12_003813515_qmvjzy.png');

INSERT INTO sightseeingspot_tour (tourCode, spotCode) VALUES
(1, 1),
(2, 2);

INSERT INTO tourbookingform (bookingDate, numberOfChildren, numberOfAdults, customerCode, tourCode) VALUES
('2023-12-01 10:00:00', 2, 2, 1, 1),
('2023-12-15 15:00:00', 1, 3, 2, 2);

INSERT INTO detailbookingform (fullName, gender, dob, identifyCard, nationality, formCode) VALUES
('Nguyen Van A', 1, '1990-01-01 00:00:00', '123456789', 'Vietnam', 1),
('Tran Thi B', 0, '1992-02-02 00:00:00', '987654321', 'Vietnam', 2);

INSERT INTO voucher (voucherCode, beginAt, endAt, sale) VALUES
('VOUCHER1', '2023-12-01 00:00:00', '2024-01-01 23:59:59', 10),
('VOUCHER2', '2024-01-01 00:00:00', '2024-02-01 23:59:59', 20);

INSERT INTO bill (numberOfPeople, address, total, status, formCode, voucherCode, createAt) VALUES
(4, 'Ha Noi', 13500000, 'Đã Hủy', 1, 'VOUCHER1', '2024-01-01 00:00:00'),
(3, 'Da Nang', 9600000, 'Hoàn Thành', 2, 'VOUCHER2', '2024-02-01 00:00:00');

INSERT INTO evaluate (content, star, customerCode, tourCode, billCode) VALUES
('Tuyệt vời!', 5, 1, 1, 1),
('Không hài lòng lắm', 2, 2, 2, 2);

INSERT INTO notify (customerCode, message, title, created_at) VALUES
(1, 'Your tour is confirmed.', 'Tour Confirmation', '2024-01-01 10:00:00');
