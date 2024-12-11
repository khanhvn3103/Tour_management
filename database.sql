/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : ptud

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 11/12/2024 21:13:22
*/

DROP DATABASE IF EXISTS ptud;
CREATE DATABASE ptud;
USE ptud;


SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bill
-- ----------------------------
DROP TABLE IF EXISTS `bill`;
CREATE TABLE `bill`  (
                         `billCode` int NOT NULL AUTO_INCREMENT,
                         `numberOfPeople` int NULL DEFAULT NULL,
                         `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                         `total` float NULL DEFAULT NULL,
                         `status` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                         `formCode` int NULL DEFAULT NULL,
                         `voucherCode` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                         `tourCode` int NULL DEFAULT NULL,
                         `customerCode` int NULL DEFAULT NULL,
                         PRIMARY KEY (`billCode`) USING BTREE,
                         INDEX `formCode`(`formCode` ASC) USING BTREE,
                         INDEX `voucherCode`(`voucherCode` ASC) USING BTREE,
                         INDEX `tourCode`(`tourCode` ASC) USING BTREE,
                         INDEX `customerCode`(`customerCode` ASC) USING BTREE,
                         CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`formCode`) REFERENCES `tourbookingform` (`formCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
                         CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`voucherCode`) REFERENCES `voucher` (`voucherCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
                         CONSTRAINT `bill_ibfk_3` FOREIGN KEY (`tourCode`) REFERENCES `tour` (`tourCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
                         CONSTRAINT `bill_ibfk_4` FOREIGN KEY (`customerCode`) REFERENCES `customer` (`customerCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bill
-- ----------------------------
INSERT INTO `bill` VALUES (1, 4, 'Ha Noi', 15000000, 'Đã Tạo', 1, 'VOUCHER1', 1, 1);
INSERT INTO `bill` VALUES (2, 3, 'Da Nang', 12000000, 'Bị Huỷ', 2, 'VOUCHER2', 2, 2);

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer`  (
                             `customerCode` int NOT NULL AUTO_INCREMENT,
                             `username` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                             PRIMARY KEY (`customerCode`) USING BTREE,
                             INDEX `username`(`username` ASC) USING BTREE,
                             CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES (1, 'user1');
INSERT INTO `customer` VALUES (2, 'user2');

-- ----------------------------
-- Table structure for detailbookingform
-- ----------------------------
DROP TABLE IF EXISTS `detailbookingform`;
CREATE TABLE `detailbookingform`  (
                                      `detailId` int NOT NULL AUTO_INCREMENT,
                                      `fullName` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                                      `gender` int NULL DEFAULT NULL,
                                      `dob` datetime NULL DEFAULT NULL,
                                      `identifyCard` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                                      `nationality` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                                      `formCode` int NULL DEFAULT NULL,
                                      PRIMARY KEY (`detailId`) USING BTREE,
                                      INDEX `formCode`(`formCode` ASC) USING BTREE,
                                      CONSTRAINT `detailbookingform_ibfk_1` FOREIGN KEY (`formCode`) REFERENCES `tourbookingform` (`formCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detailbookingform
-- ----------------------------
INSERT INTO `detailbookingform` VALUES (1, 'Nguyen Van A', 1, '1990-01-01 00:00:00', '123456789', 'Vietnam', 1);
INSERT INTO `detailbookingform` VALUES (2, 'Tran Thi B', 0, '1992-02-02 00:00:00', '987654321', 'Vietnam', 2);

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee`  (
                             `employeeCode` int NOT NULL AUTO_INCREMENT,
                             `role` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                             `username` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                             PRIMARY KEY (`employeeCode`) USING BTREE,
                             INDEX `username`(`username` ASC) USING BTREE,
                             CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES (1, 'Hướng dẫn viên', 'user1');
INSERT INTO `employee` VALUES (2, 'Tài xế', 'user2');

-- ----------------------------
-- Table structure for evaluate
-- ----------------------------
DROP TABLE IF EXISTS `evaluate`;
CREATE TABLE `evaluate`  (
                             `evaluateCode` int NOT NULL AUTO_INCREMENT,
                             `content` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                             `star` int NULL DEFAULT NULL,
                             `customerCode` int NULL DEFAULT NULL,
                             `tourCode` int NULL DEFAULT NULL,
                             `billCode` int NULL DEFAULT NULL,
                             PRIMARY KEY (`evaluateCode`) USING BTREE,
                             INDEX `billCode`(`billCode` ASC) USING BTREE,
                             INDEX `customerCode`(`customerCode` ASC) USING BTREE,
                             INDEX `tourCode`(`tourCode` ASC) USING BTREE,
                             CONSTRAINT `evaluate_ibfk_1` FOREIGN KEY (`billCode`) REFERENCES `bill` (`billCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
                             CONSTRAINT `evaluate_ibfk_2` FOREIGN KEY (`customerCode`) REFERENCES `customer` (`customerCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
                             CONSTRAINT `evaluate_ibfk_3` FOREIGN KEY (`tourCode`) REFERENCES `tour` (`tourCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of evaluate
-- ----------------------------
INSERT INTO `evaluate` VALUES (1, 'Tuyệt vời!', 5, 1, 1, 1);
INSERT INTO `evaluate` VALUES (2, 'Không hài lòng lắm', 2, 2, 2, 2);

-- ----------------------------
-- Table structure for notify
-- ----------------------------
DROP TABLE IF EXISTS `notify`;
CREATE TABLE `notify`  (
                           `id` int NOT NULL AUTO_INCREMENT,
                           `customerCode` int NULL DEFAULT NULL,
                           `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
                           `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
                           `created_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                           PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notify
-- ----------------------------
INSERT INTO `notify` VALUES (1, 1, 'Đơn đặt tour của bạn đã được duyệt!', NULL, '2024-12-11 19:36:17');
INSERT INTO `notify` VALUES (2, 1, 'Đơn đặt tour của bạn đã được duyệt!', NULL, '2024-12-11 19:41:45');
INSERT INTO `notify` VALUES (3, 1, 'Đơn đặt tour của bạn đã bị từ chối!', NULL, '2024-12-11 19:41:49');
INSERT INTO `notify` VALUES (4, 1, 'Đơn đặt tour của bạn đã bị từ chối!', NULL, '2024-12-11 19:41:54');

-- ----------------------------
-- Table structure for sightseeingspot
-- ----------------------------
DROP TABLE IF EXISTS `sightseeingspot`;
CREATE TABLE `sightseeingspot`  (
                                    `spotCode` int NOT NULL AUTO_INCREMENT,
                                    `spotName` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                                    `startTime` datetime NULL DEFAULT NULL,
                                    `endTime` datetime NULL DEFAULT NULL,
                                    `description` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                                    `tourPackageCode` int NULL DEFAULT NULL,
                                    `vehicleCode` int NULL DEFAULT NULL,
                                    `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                                    PRIMARY KEY (`spotCode`) USING BTREE,
                                    INDEX `tourPackageCode`(`tourPackageCode` ASC) USING BTREE,
                                    INDEX `vehicleCode`(`vehicleCode` ASC) USING BTREE,
                                    CONSTRAINT `sightseeingspot_ibfk_1` FOREIGN KEY (`tourPackageCode`) REFERENCES `tourpackage` (`tourPackageCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                    CONSTRAINT `sightseeingspot_ibfk_2` FOREIGN KEY (`vehicleCode`) REFERENCES `vehicle` (`vehicleCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sightseeingspot
-- ----------------------------
INSERT INTO `sightseeingspot` VALUES (1, 'Bãi biển Mỹ Khê', '2023-01-11 09:00:00', '2023-01-11 12:00:00', 'Tham quan bãi biển Mỹ Khê', 1, 1, NULL);
INSERT INTO `sightseeingspot` VALUES (2, 'Tháp bà Ponagar', '2023-02-21 10:00:00', '2023-02-21 13:00:00', 'Tham quan Tháp bà Ponagar', 2, 2, NULL);
INSERT INTO `sightseeingspot` VALUES (4, 'dsf', '2024-12-28 00:45:00', '2025-01-05 00:45:00', 'sadf', 4, 1, 'assets/images/uploads/pexels-quang-nguyen-vinh-222549-2131614.jpg');

-- ----------------------------
-- Table structure for sightseeingspot_tour
-- ----------------------------
DROP TABLE IF EXISTS `sightseeingspot_tour`;
CREATE TABLE `sightseeingspot_tour`  (
                                         `tourCode` int NOT NULL,
                                         `spotCode` int NOT NULL,
                                         PRIMARY KEY (`tourCode`, `spotCode`) USING BTREE,
                                         INDEX `spotCode`(`spotCode` ASC) USING BTREE,
                                         CONSTRAINT `sightseeingspot_tour_ibfk_1` FOREIGN KEY (`tourCode`) REFERENCES `tour` (`tourCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                         CONSTRAINT `sightseeingspot_tour_ibfk_2` FOREIGN KEY (`spotCode`) REFERENCES `sightseeingspot` (`spotCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sightseeingspot_tour
-- ----------------------------
INSERT INTO `sightseeingspot_tour` VALUES (1, 1);
INSERT INTO `sightseeingspot_tour` VALUES (2, 2);

-- ----------------------------
-- Table structure for tour
-- ----------------------------
DROP TABLE IF EXISTS `tour`;
CREATE TABLE `tour`  (
                         `tourCode` int NOT NULL AUTO_INCREMENT,
                         `tourName` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                         `startDate` datetime NULL DEFAULT NULL,
                         `price` float NULL DEFAULT NULL,
                         `description` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                         `employeeCode` int NULL DEFAULT NULL,
                         `vehicleCode` int NULL DEFAULT NULL,
                         `tourPackageCode` int NULL DEFAULT NULL,
                         `endDate` datetime NULL DEFAULT NULL,
                         PRIMARY KEY (`tourCode`) USING BTREE,
                         INDEX `vehicleCode`(`vehicleCode` ASC) USING BTREE,
                         INDEX `employeeCode`(`employeeCode` ASC) USING BTREE,
                         INDEX `tourPackageCode`(`tourPackageCode` ASC) USING BTREE,
                         CONSTRAINT `tour_ibfk_1` FOREIGN KEY (`vehicleCode`) REFERENCES `vehicle` (`vehicleCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
                         CONSTRAINT `tour_ibfk_2` FOREIGN KEY (`employeeCode`) REFERENCES `employee` (`employeeCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
                         CONSTRAINT `tour_ibfk_3` FOREIGN KEY (`tourPackageCode`) REFERENCES `tourpackage` (`tourPackageCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tour
-- ----------------------------
INSERT INTO `tour` VALUES (1, 'Tour Đà Nẵng', '2023-01-10 08:00:00', 5000000, 'Tham quan Đà Nẵng', 1, 1, 1, NULL);
INSERT INTO `tour` VALUES (2, 'Tour Nha Trang', '2023-02-20 08:00:00', 6000000, 'Tham quan Nha Trang', 2, 2, 2, NULL);
INSERT INTO `tour` VALUES (4, 'Tour Mẫu', '2024-12-11 22:52:00', 100.5, 'Mô tả cho tour mẫu.', 1, 1, 1, '2024-12-18 22:52:00');
INSERT INTO `tour` VALUES (5, 'aaaaa', '2024-12-12 23:20:00', 234, 'ssssss', 1, 1, 1, '2024-12-28 23:20:00');

-- ----------------------------
-- Table structure for tourbookingform
-- ----------------------------
DROP TABLE IF EXISTS `tourbookingform`;
CREATE TABLE `tourbookingform`  (
                                    `formCode` int NOT NULL AUTO_INCREMENT,
                                    `bookingDate` datetime NULL DEFAULT NULL,
                                    `numberOfChildren` int NULL DEFAULT NULL,
                                    `numberOfAdults` int NULL DEFAULT NULL,
                                    `customerCode` int NULL DEFAULT NULL,
                                    `tourPackageCode` int NULL DEFAULT NULL,
                                    `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                                    PRIMARY KEY (`formCode`) USING BTREE,
                                    INDEX `customerCode`(`customerCode` ASC) USING BTREE,
                                    CONSTRAINT `tourbookingform_ibfk_1` FOREIGN KEY (`customerCode`) REFERENCES `customer` (`customerCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tourbookingform
-- ----------------------------
INSERT INTO `tourbookingform` VALUES (1, '2022-12-01 10:00:00', 2, 2, 1, NULL, NULL);
INSERT INTO `tourbookingform` VALUES (2, '2022-12-15 15:00:00', 1, 3, 2, NULL, NULL);
INSERT INTO `tourbookingform` VALUES (3, '2024-12-12 00:00:00', 3, 1, 1, 1, 'approved');
INSERT INTO `tourbookingform` VALUES (4, '2024-12-13 00:00:00', 3, 1, 1, 6, 'rejected');
INSERT INTO `tourbookingform` VALUES (5, '2024-12-13 00:00:00', 0, 1, 1, 6, NULL);
INSERT INTO `tourbookingform` VALUES (6, '2024-12-14 00:00:00', 0, 1, 1, 6, NULL);
INSERT INTO `tourbookingform` VALUES (7, '2024-12-27 00:00:00', 0, 1, 1, 6, NULL);

-- ----------------------------
-- Table structure for tourpackage
-- ----------------------------
DROP TABLE IF EXISTS `tourpackage`;
CREATE TABLE `tourpackage`  (
                                `tourPackageCode` int NOT NULL AUTO_INCREMENT,
                                `packageName` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                                `startingPoint` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                                `endPoint` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                                `description` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                                `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                                PRIMARY KEY (`tourPackageCode`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tourpackage
-- ----------------------------
INSERT INTO `tourpackage` VALUES (1, 'Gói 1', 'Ha Noi', 'Da Nang', 'Tham quan Đà Nẵng', NULL);
INSERT INTO `tourpackage` VALUES (2, 'Gói 2', 'Ho Chi Minh', 'Nha Trang', 'Tham quan Nha Trang', NULL);
INSERT INTO `tourpackage` VALUES (3, 'ádfas', 'ádf', 'adsf', 'ádfas', NULL);
INSERT INTO `tourpackage` VALUES (4, 'dsafsaf', 'fsdfa', 'ádf', 'ádfas', NULL);
INSERT INTO `tourpackage` VALUES (6, 'ágfg', 'fgsd', 'sdfg', 'sdfg', 'assets/images/uploads/tải xuống.jpg');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
                          `username` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
                          `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
                          `fullName` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                          `address` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                          `phone` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                          `dob` date NULL DEFAULT NULL,
                          `gender` int NULL DEFAULT NULL,
                          `identifyCard` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                          PRIMARY KEY (`username`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('user1', 'password1', 'Nguyen Van A', 'Ha Noi', '0900123456', '1990-01-01', 1, '123456789');
INSERT INTO `users` VALUES ('user2', 'password2', 'Tran Thi B', 'Ho Chi Minh', '0900654321', '1992-02-02', 0, '987654321');

-- ----------------------------
-- Table structure for vehicle
-- ----------------------------
DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE `vehicle`  (
                            `vehicleCode` int NOT NULL AUTO_INCREMENT,
                            `vehicleName` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                            PRIMARY KEY (`vehicleCode`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vehicle
-- ----------------------------
INSERT INTO `vehicle` VALUES (1, 'Xe 16 chỗ');
INSERT INTO `vehicle` VALUES (2, 'Xe 45 chỗ');

-- ----------------------------
-- Table structure for voucher
-- ----------------------------
DROP TABLE IF EXISTS `voucher`;
CREATE TABLE `voucher`  (
                            `voucherCode` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
                            `beginAt` datetime NULL DEFAULT NULL,
                            `endAt` datetime NULL DEFAULT NULL,
                            `sale` float NULL DEFAULT NULL,
                            PRIMARY KEY (`voucherCode`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of voucher
-- ----------------------------
INSERT INTO `voucher` VALUES ('VOUCHER1', '2022-12-01 00:00:00', '2023-01-01 23:59:59', 10);
INSERT INTO `voucher` VALUES ('VOUCHER2', '2023-01-01 00:00:00', '2023-02-01 23:59:59', 20);

SET FOREIGN_KEY_CHECKS = 1;
