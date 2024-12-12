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
-- Table structure for vehicle
-- ----------------------------
DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE `vehicle`  (
                            `vehicleCode` int NOT NULL AUTO_INCREMENT,
                            `vehicleName` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
                            PRIMARY KEY (`vehicleCode`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;


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

DROP TABLE IF EXISTS `bill`;
CREATE TABLE `bill` (
                        `billCode` int(11) NOT NULL AUTO_INCREMENT,
                        `numberOfPeople` int(11) DEFAULT NULL,
                        `address` varchar(255) DEFAULT NULL,
                        `total` float DEFAULT NULL,
                        `status` varchar(50) DEFAULT NULL,
                        `formCode` int(11) DEFAULT NULL,
                        `voucherCode` varchar(20) DEFAULT NULL,
                        `createAt` datetime DEFAULT CURRENT_TIMESTAMP,
                        PRIMARY KEY (`billCode`),
                        KEY `formCode` (`formCode`),
                        KEY `voucherCode` (`voucherCode`),
                        CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`formCode`) REFERENCES `tourbookingform` (`formCode`),
                        CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`voucherCode`) REFERENCES `voucher` (`voucherCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `evaluate`;
CREATE TABLE `evaluate` (
                            `evaluateCode` int(11) NOT NULL AUTO_INCREMENT,
                            `content` varchar(500) DEFAULT NULL,
                            `star` int(11) DEFAULT NULL,
                            `customerCode` int(11) DEFAULT NULL,
                            `tourCode` int(11) DEFAULT NULL,
                            `billCode` int(11) DEFAULT NULL,
                            PRIMARY KEY (`evaluateCode`),
                            KEY `billCode` (`billCode`),
                            KEY `customerCode` (`customerCode`),
                            KEY `tourCode` (`tourCode`),
                            CONSTRAINT `evaluate_ibfk_1` FOREIGN KEY (`billCode`) REFERENCES `bill` (`billCode`),
                            CONSTRAINT `evaluate_ibfk_2` FOREIGN KEY (`customerCode`) REFERENCES `customer` (`customerCode`),
                            CONSTRAINT `evaluate_ibfk_3` FOREIGN KEY (`tourCode`) REFERENCES `tour` (`tourCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `work_schedule`;
CREATE TABLE `work_schedule` (
                                 `scheduleCode` int(11) NOT NULL AUTO_INCREMENT,
                                 `employeeCode` int(11) NOT NULL,
                                 `tourCode` int(11) NOT NULL,
                                 `assignedAt` datetime DEFAULT CURRENT_TIMESTAMP,
                                 PRIMARY KEY (`scheduleCode`),
                                 KEY `employeeCode` (`employeeCode`),
                                 KEY `tourCode` (`tourCode`),
                                 CONSTRAINT `work_schedule_ibfk_1` FOREIGN KEY (`employeeCode`) REFERENCES `employee` (`employeeCode`),
                                 CONSTRAINT `work_schedule_ibfk_2` FOREIGN KEY (`tourCode`) REFERENCES `tour` (`tourCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `tour_images`;
CREATE TABLE `tour_images`  (
                                `id` int NOT NULL AUTO_INCREMENT,
                                `tourCode` int NULL DEFAULT NULL,
                                `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
                                PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;