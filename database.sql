DROP DATABASE IF EXISTS ptud;
CREATE DATABASE ptud;
USE ptud;

CREATE TABLE `users`  (
    `username` varchar(50) NOT NULL,
    `password` varchar(50) NOT NULL,
    `fullName` varchar(100) NULL DEFAULT NULL,
    `address` varchar(200) NULL DEFAULT NULL,
    `phone` varchar(15) NULL DEFAULT NULL,
    `dob` date NULL DEFAULT NULL,
    `gender` int NULL DEFAULT NULL,
    `identifyCard` varchar(20) NULL DEFAULT NULL,
    PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `employee`  (
    `employeeCode` int NOT NULL AUTO_INCREMENT,
    `role` varchar(50) NULL DEFAULT NULL,
    `username` varchar(50) NULL DEFAULT NULL,
    PRIMARY KEY (`employeeCode`),
    INDEX `username`(`username`),
    CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `customer`  (
    `customerCode` int NOT NULL AUTO_INCREMENT,
    `username` varchar(50) NULL DEFAULT NULL,
    PRIMARY KEY (`customerCode`),
    INDEX `username`(`username`),
    CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tourpackage`  (
    `tourPackageCode` int NOT NULL AUTO_INCREMENT,
    `packageName` varchar(100) NULL DEFAULT NULL,
    `startingPoint` varchar(100) NULL DEFAULT NULL,
    `endPoint` varchar(100) NULL DEFAULT NULL,
    `description` varchar(500) NULL DEFAULT NULL,
    `image` varchar(255) NULL DEFAULT NULL,
    PRIMARY KEY (`tourPackageCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `vehicle`  (
    `vehicleCode` int NOT NULL AUTO_INCREMENT,
    `vehicleName` varchar(100) NULL DEFAULT NULL,
    PRIMARY KEY (`vehicleCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tour`  (
    `tourCode` int NOT NULL AUTO_INCREMENT,
    `tourName` varchar(100) NULL DEFAULT NULL,
    `startDate` datetime NULL DEFAULT NULL,
    `price` float NULL DEFAULT NULL,
    `description` varchar(500) NULL DEFAULT NULL,
    `employeeCode` int NULL DEFAULT NULL,
    `vehicleCode` int NULL DEFAULT NULL,
    `tourPackageCode` int NULL DEFAULT NULL,
    `endDate` datetime NULL DEFAULT NULL,
    PRIMARY KEY (`tourCode`),
    INDEX `vehicleCode`(`vehicleCode`),
    INDEX `employeeCode`(`employeeCode`),
    INDEX `tourPackageCode`(`tourPackageCode`),
    CONSTRAINT `tour_ibfk_1` FOREIGN KEY (`vehicleCode`) REFERENCES `vehicle` (`vehicleCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT `tour_ibfk_2` FOREIGN KEY (`employeeCode`) REFERENCES `employee` (`employeeCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT `tour_ibfk_3` FOREIGN KEY (`tourPackageCode`) REFERENCES `tourpackage` (`tourPackageCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `sightseeingspot`  (
    `spotCode` int NOT NULL AUTO_INCREMENT,
    `spotName` varchar(100) NULL DEFAULT NULL,
    `startTime` datetime NULL DEFAULT NULL,
    `endTime` datetime NULL DEFAULT NULL,
    `description` varchar(500) NULL DEFAULT NULL,
    `tourPackageCode` int NULL DEFAULT NULL,
    `vehicleCode` int NULL DEFAULT NULL,
    `image` varchar(255) NULL DEFAULT NULL,
    PRIMARY KEY (`spotCode`),
    INDEX `tourPackageCode`(`tourPackageCode`),
    INDEX `vehicleCode`(`vehicleCode`),
    CONSTRAINT `sightseeingspot_ibfk_1` FOREIGN KEY (`tourPackageCode`) REFERENCES `tourpackage` (`tourPackageCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT `sightseeingspot_ibfk_2` FOREIGN KEY (`vehicleCode`) REFERENCES `vehicle` (`vehicleCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `sightseeingspot_tour`  (
    `tourCode` int NOT NULL,
    `spotCode` int NOT NULL,
    PRIMARY KEY (`tourCode`, `spotCode`),
    INDEX `spotCode`(`spotCode`),
    CONSTRAINT `sightseeingspot_tour_ibfk_1` FOREIGN KEY (`tourCode`) REFERENCES `tour` (`tourCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT `sightseeingspot_tour_ibfk_2` FOREIGN KEY (`spotCode`) REFERENCES `sightseeingspot` (`spotCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tourbookingform`  (
    `formCode` int NOT NULL AUTO_INCREMENT,
    `bookingDate` datetime NULL DEFAULT NULL,
    `numberOfChildren` int NULL DEFAULT NULL,
    `numberOfAdults` int NULL DEFAULT NULL,
    `customerCode` int NULL DEFAULT NULL,
    `tourPackageCode` int NULL DEFAULT NULL,
    `tourCode` int NOT NULL,
    `status` varchar(255) NULL DEFAULT NULL,
    PRIMARY KEY (`formCode`),
    INDEX `customerCode`(`customerCode`),
    CONSTRAINT `tourbookingform_ibfk_1` FOREIGN KEY (`tourCode`) REFERENCES `tour` (`tourCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT `tourbookingform_ibfk_2` FOREIGN KEY (`customerCode`) REFERENCES `customer` (`customerCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `detailbookingform`  (
    `detailId` int NOT NULL AUTO_INCREMENT,
    `fullName` varchar(100) NULL DEFAULT NULL,
    `gender` int NULL DEFAULT NULL,
    `dob` datetime NULL DEFAULT NULL,
    `identifyCard` varchar(20) NULL DEFAULT NULL,
    `nationality` varchar(50) NULL DEFAULT NULL,
    `formCode` int NULL DEFAULT NULL,
    PRIMARY KEY (`detailId`),
    INDEX `formCode`(`formCode`),
    CONSTRAINT `detailbookingform_ibfk_1` FOREIGN KEY (`formCode`) REFERENCES `tourbookingform` (`formCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `voucher`  (
    `voucherCode` varchar(20) NOT NULL,
    `beginAt` datetime NULL DEFAULT NULL,
    `endAt` datetime NULL DEFAULT NULL,
    `sale` float NULL DEFAULT NULL,
    PRIMARY KEY (`voucherCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `bill`  (
    `billCode` int NOT NULL AUTO_INCREMENT,
    `numberOfPeople` int NULL DEFAULT NULL,
    `address` varchar(255) NULL DEFAULT NULL,
    `total` float NULL DEFAULT NULL,
    `status` varchar(50) NULL DEFAULT NULL,
    `formCode` int NULL DEFAULT NULL,
    `voucherCode` varchar(20) NULL DEFAULT NULL,
    `tourCode` int NULL DEFAULT NULL,
    `customerCode` int NULL DEFAULT NULL,
    `createAt` datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`billCode`),
    INDEX `formCode`(`formCode` ASC),
    INDEX `voucherCode`(`voucherCode` ASC),
    INDEX `tourCode`(`tourCode` ASC),
    INDEX `customerCode`(`customerCode` ASC),
    CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`formCode`) REFERENCES `tourbookingform` (`formCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`voucherCode`) REFERENCES `voucher` (`voucherCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT `bill_ibfk_3` FOREIGN KEY (`tourCode`) REFERENCES `tour` (`tourCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT `bill_ibfk_4` FOREIGN KEY (`customerCode`) REFERENCES `customer` (`customerCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `evaluate`  (
    `evaluateCode` int NOT NULL AUTO_INCREMENT,
    `content` varchar(500) NULL DEFAULT NULL,
    `star` int NULL DEFAULT NULL,
    `customerCode` int NULL DEFAULT NULL,
    `tourCode` int NULL DEFAULT NULL,
    `billCode` int NULL DEFAULT NULL,
    PRIMARY KEY (`evaluateCode`),
    INDEX `billCode`(`billCode` ASC),
    INDEX `customerCode`(`customerCode` ASC),
    INDEX `tourCode`(`tourCode` ASC),
    CONSTRAINT `evaluate_ibfk_1` FOREIGN KEY (`billCode`) REFERENCES `bill` (`billCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT `evaluate_ibfk_2` FOREIGN KEY (`customerCode`) REFERENCES `customer` (`customerCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT `evaluate_ibfk_3` FOREIGN KEY (`tourCode`) REFERENCES `tour` (`tourCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `work_schedule` (
    `scheduleCode` int(11) NOT NULL AUTO_INCREMENT,
    `employeeCode` int(11) NOT NULL,
    `tourCode` int(11) NOT NULL,
    `assignedAt` datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`scheduleCode`),
    KEY `employeeCode` (`employeeCode`),
    KEY `tourCode` (`tourCode`),
    CONSTRAINT `work_schedule_ibfk_1` FOREIGN KEY (`employeeCode`) REFERENCES `employee` (`employeeCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT `work_schedule_ibfk_2` FOREIGN KEY (`tourCode`) REFERENCES `tour` (`tourCode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `notify` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `customerCode` INT NULL DEFAULT NULL,
    `message` TEXT NULL,
    `title` TEXT NULL,
    `created_at` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `tour_images`;
CREATE TABLE `tour_images`  (
                                `id` int NOT NULL AUTO_INCREMENT,
                                `tourCode` int NULL DEFAULT NULL,
                                `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
                                PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;