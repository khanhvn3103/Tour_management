-- Reset database
DROP DATABASE IF EXISTS ptud;
CREATE DATABASE ptud;
USE ptud;

-- Tạo bảng và dữ liệu mẫu

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullName` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `identifyCard` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE (`phone`),
  UNIQUE (`identifyCard`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `employee` (
  `employeeCode` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`employeeCode`),
  KEY `username` (`username`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `customer` (
  `customerCode` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`customerCode`),
  KEY `username` (`username`),
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tourpackage` (
  `tourPackageCode` int(11) NOT NULL AUTO_INCREMENT,
  `packageName` varchar(100) DEFAULT NULL,
  `startingPoint` varchar(100) DEFAULT NULL,
  `endPoint` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`tourPackageCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `vehicle` (
  `vehicleCode` int(11) NOT NULL AUTO_INCREMENT,
  `vehicleName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`vehicleCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tour` (
  `tourCode` int(11) NOT NULL AUTO_INCREMENT,
  `tourName` varchar(100) DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `price` float DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `employeeCode` int(11) DEFAULT NULL,
  `vehicleCode` int(11) DEFAULT NULL,
  `tourPackageCode` int(11) DEFAULT NULL,
  PRIMARY KEY (`tourCode`),
  KEY `vehicleCode` (`vehicleCode`),
  KEY `employeeCode` (`employeeCode`),
  KEY `tourPackageCode` (`tourPackageCode`),
  CONSTRAINT `tour_ibfk_1` FOREIGN KEY (`vehicleCode`) REFERENCES `vehicle` (`vehicleCode`),
  CONSTRAINT `tour_ibfk_2` FOREIGN KEY (`employeeCode`) REFERENCES `employee` (`employeeCode`),
  CONSTRAINT `tour_ibfk_3` FOREIGN KEY (`tourPackageCode`) REFERENCES `tourpackage` (`tourPackageCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `sightseeingspot` (
  `spotCode` int(11) NOT NULL AUTO_INCREMENT,
  `spotName` varchar(100) DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `tourPackageCode` int(11) DEFAULT NULL,
  `vehicleCode` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`spotCode`),
  KEY `tourPackageCode` (`tourPackageCode`),
  KEY `vehicleCode` (`vehicleCode`),
  CONSTRAINT `sightseeingspot_ibfk_1` FOREIGN KEY (`tourPackageCode`) REFERENCES `tourpackage` (`tourPackageCode`),
  CONSTRAINT `sightseeingspot_ibfk_2` FOREIGN KEY (`vehicleCode`) REFERENCES `vehicle` (`vehicleCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `sightseeingspot_tour` (
  `tourCode` int(11) NOT NULL,
  `spotCode` int(11) NOT NULL,
  PRIMARY KEY (`tourCode`,`spotCode`),
  KEY `spotCode` (`spotCode`),
  CONSTRAINT `sightseeingspot_tour_ibfk_1` FOREIGN KEY (`tourCode`) REFERENCES `tour` (`tourCode`),
  CONSTRAINT `sightseeingspot_tour_ibfk_2` FOREIGN KEY (`spotCode`) REFERENCES `sightseeingspot` (`spotCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tourbookingform` (
  `formCode` int(11) NOT NULL AUTO_INCREMENT,
  `bookingDate` datetime DEFAULT NULL,
  `numberOfChildren` int(11) DEFAULT NULL,
  `numberOfAdults` int(11) DEFAULT NULL,
  `customerCode` int(11) DEFAULT NULL,
  `tourCode` int(11) DEFAULT NULL,
  PRIMARY KEY (`formCode`),
  KEY `customerCode` (`customerCode`),
  KEY `tourCode` (`tourCode`),
  CONSTRAINT `tourbookingform_ibfk_1` FOREIGN KEY (`customerCode`) REFERENCES `customer` (`customerCode`),
  CONSTRAINT `tourbookingform_ibfk_2` FOREIGN KEY (`tourCode`) REFERENCES `tour` (`tourCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `detailbookingform` (
  `detailId` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(100) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `identifyCard` varchar(20) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `formCode` int(11) DEFAULT NULL,
  PRIMARY KEY (`detailId`),
  KEY `formCode` (`formCode`),
  CONSTRAINT `detailbookingform_ibfk_1` FOREIGN KEY (`formCode`) REFERENCES `tourbookingform` (`formCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `voucher` (
  `voucherCode` varchar(20) NOT NULL,
  `beginAt` datetime DEFAULT NULL,
  `endAt` datetime DEFAULT NULL,
  `sale` float DEFAULT NULL,
  PRIMARY KEY (`voucherCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
