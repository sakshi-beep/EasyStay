-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.42 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table hostelbooking.admin_cred
CREATE TABLE IF NOT EXISTS `admin_cred` (
  `sr_no` int NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.admin_cred: ~1 rows (approximately)
INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
	(1, 'sakshi', '12345');

-- Dumping structure for table hostelbooking.booking_details
CREATE TABLE IF NOT EXISTS `booking_details` (
  `sr_no` int NOT NULL AUTO_INCREMENT,
  `booking_id` int NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `total_pay` int NOT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  PRIMARY KEY (`sr_no`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.booking_details: ~1 rows (approximately)
INSERT INTO `booking_details` (`sr_no`, `booking_id`, `room_name`, `price`, `total_pay`, `room_no`, `user_name`, `phonenum`, `address`) VALUES
	(21, 21, 'Luxury Room', 600, 1800, '2', 'Sakshi Thapa', '9840648593', 'Madikhatar');

-- Dumping structure for table hostelbooking.booking_order
CREATE TABLE IF NOT EXISTS `booking_order` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `room_id` int NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int NOT NULL DEFAULT '0',
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `trans_id` varchar(200) DEFAULT NULL,
  `trans_amt` int NOT NULL,
  `trans_status` varchar(100) NOT NULL DEFAULT 'pending',
  `trans_resp_msg` varchar(200) DEFAULT NULL,
  `datentime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`booking_id`),
  KEY `user_id` (`user_id`),
  KEY `room_id` (`room_id`),
  CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.booking_order: ~2 rows (approximately)
INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `booking_status`, `order_id`, `trans_id`, `trans_amt`, `trans_status`, `trans_resp_msg`, `datentime`) VALUES
	(16, 2, 5, '2022-08-26', '2022-08-28', 1, 'booked', 'ORD_28784829', '20220825111212800110168627505415606', 1200, 'TXN_SUCCESS', 'Txn Success', '2022-08-25 01:52:04'),
	(21, 9, 5, '2025-05-30', '2025-06-02', 1, 'booked', 'ORD_94824836', 'nPK6JMzg8H4Gy5JGu4NMwj', 1800, 'Completed', 'Completed', '2025-05-29 21:12:45');

-- Dumping structure for table hostelbooking.carousel
CREATE TABLE IF NOT EXISTS `carousel` (
  `sr_no` int NOT NULL AUTO_INCREMENT,
  `image` varchar(150) NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.carousel: ~4 rows (approximately)
INSERT INTO `carousel` (`sr_no`, `image`) VALUES
	(5, 'IMG_93127.png'),
	(6, 'IMG_99736.png'),
	(8, 'IMG_40905.png'),
	(9, 'IMG_55677.png');

-- Dumping structure for table hostelbooking.contact_details
CREATE TABLE IF NOT EXISTS `contact_details` (
  `sr_no` int NOT NULL AUTO_INCREMENT,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` bigint NOT NULL,
  `pn2` bigint NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.contact_details: ~1 rows (approximately)
INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
	(1, 'VJTI, Matunga, Mumbai, Maharashtra', 'https://goo.gl/maps/p9s1LYMHvWiww7pZ8', 918529636985, 91111222333558, 'amey.neal@gmail.com', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3771.9433432697824!2d72.85393251443796!3d19.02221808711878!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7cf26f4972d21:0x2c50185364aca4c1!2sVeermata Jijabai Technological Institute!5e0!3m2!1sen!2sin!4v1670867131904!5m2!1sen!2sin');

-- Dumping structure for table hostelbooking.facilities
CREATE TABLE IF NOT EXISTS `facilities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.facilities: ~6 rows (approximately)
INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
	(13, 'IMG_43553.svg', 'Wifi', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus incidunt odio quos dolore commodi repudiandae tenetur.'),
	(14, 'IMG_49949.svg', 'Air conditioner', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus incidunt odio quos dolore commodi repudiandae tenetur.'),
	(15, 'IMG_41622.svg', 'Television', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus incidunt odio quos dolore commodi repudiandae tenetur.'),
	(17, 'IMG_47816.svg', 'Spa', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus incidunt odio quos dolore commodi repudiandae tenetur.'),
	(18, 'IMG_96423.svg', 'Room Heater', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus incidunt odio quos dolore commodi repudiandae tenetur.'),
	(19, 'IMG_27079.svg', 'Geyser', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus incidunt odio quos dolore commodi repudiandae tenetur.');

-- Dumping structure for table hostelbooking.features
CREATE TABLE IF NOT EXISTS `features` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.features: ~4 rows (approximately)
INSERT INTO `features` (`id`, `name`) VALUES
	(13, 'bedroom'),
	(14, 'balcony'),
	(15, 'kitchen'),
	(17, 'sofa');

-- Dumping structure for table hostelbooking.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `location` varchar(100) NOT NULL DEFAULT '',
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `people` int NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `removed` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.rooms: ~6 rows (approximately)
INSERT INTO `rooms` (`id`, `name`, `location`, `price`, `quantity`, `people`, `description`, `status`, `removed`) VALUES
	(1, 'simple room', '159', 58, 56, 12, 'asdf asd', 1, 1),
	(2, 'simple room 2', '785', 159, 85, 452, 'adfasdfa sd', 1, 1),
	(3, 'Simple Room', '250', 300, 10, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero culpa error officiis totam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dic', 1, 0),
	(4, 'Deluxe Room', '300', 500, 10, 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero culpa error officiis totam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dic', 1, 0),
	(5, 'Luxury Room', '600', 600, 2, 8, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero culpa error officiis totam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dic', 1, 0),
	(6, 'Supreme deluxe room', '500', 900, 12, 9, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero culpa error officiis totam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dic', 1, 0);

-- Dumping structure for table hostelbooking.room_facilities
CREATE TABLE IF NOT EXISTS `room_facilities` (
  `sr_no` int NOT NULL AUTO_INCREMENT,
  `room_id` int NOT NULL,
  `facilities_id` int NOT NULL,
  PRIMARY KEY (`sr_no`),
  KEY `facilities id` (`facilities_id`),
  KEY `room id` (`room_id`),
  CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`),
  CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.room_facilities: ~14 rows (approximately)
INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
	(29, 4, 14),
	(30, 4, 18),
	(31, 4, 19),
	(35, 6, 13),
	(36, 6, 14),
	(37, 6, 18),
	(38, 6, 19),
	(39, 5, 13),
	(40, 5, 14),
	(41, 5, 18),
	(42, 3, 14),
	(43, 3, 15),
	(44, 3, 18),
	(45, 3, 19);

-- Dumping structure for table hostelbooking.room_features
CREATE TABLE IF NOT EXISTS `room_features` (
  `sr_no` int NOT NULL AUTO_INCREMENT,
  `room_id` int NOT NULL,
  `features_id` int NOT NULL,
  PRIMARY KEY (`sr_no`),
  KEY `features id` (`features_id`),
  KEY `rm id` (`room_id`),
  CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`),
  CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.room_features: ~12 rows (approximately)
INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
	(16, 4, 13),
	(17, 4, 14),
	(18, 4, 15),
	(22, 6, 13),
	(23, 6, 14),
	(24, 6, 15),
	(25, 5, 13),
	(26, 5, 14),
	(27, 5, 15),
	(28, 3, 13),
	(29, 3, 14),
	(30, 3, 17);

-- Dumping structure for table hostelbooking.room_images
CREATE TABLE IF NOT EXISTS `room_images` (
  `sr_no` int NOT NULL AUTO_INCREMENT,
  `room_id` int NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`sr_no`),
  KEY `room_id` (`room_id`),
  CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.room_images: ~10 rows (approximately)
INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
	(15, 3, 'IMG_39782.png', 0),
	(16, 3, 'IMG_65019.png', 1),
	(17, 4, 'IMG_44867.png', 0),
	(18, 4, 'IMG_78809.png', 1),
	(19, 4, 'IMG_11892.png', 0),
	(21, 5, 'IMG_17474.png', 0),
	(22, 5, 'IMG_42663.png', 1),
	(23, 5, 'IMG_70583.png', 0),
	(24, 6, 'IMG_67761.png', 0),
	(25, 6, 'IMG_69824.png', 1);

-- Dumping structure for table hostelbooking.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `sr_no` int NOT NULL AUTO_INCREMENT,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(250) NOT NULL,
  `shutdown` tinyint(1) NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.settings: ~1 rows (approximately)
INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
	(1, '', '', 0);

-- Dumping structure for table hostelbooking.team_details
CREATE TABLE IF NOT EXISTS `team_details` (
  `sr_no` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.team_details: ~2 rows (approximately)
INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
	(16, 'Amey', 'IMG_38410.jpg'),
	(17, 'Neal', 'IMG_69823.jpg');

-- Dumping structure for table hostelbooking.user_cred
CREATE TABLE IF NOT EXISTS `user_cred` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_verified` int NOT NULL DEFAULT '0',
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `datentime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.user_cred: ~7 rows (approximately)
INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
	(2, 'neal', 'neal@gmail.com', 'ad', '123', 123324, '2022-06-12', '$2y$10$B/CaqVvi4GIKZJFbQnCvnOccqVzuOWLftXWodOA.bS.Y/KduJC0Qq', 1, NULL, NULL, 1, '2022-06-12 16:05:59'),
	(5, 'amey', 'helubeti@finews.biz', 'asd', '1234', 123, '2022-12-13', '$2y$10$NtKNL5Ogn.m3NViVu/DKIevNhms7thrZP.qTnPpqooncOSygLw9hS', 1, '24ffd287a4c2eda5f2b424be2824f997', NULL, 1, '2022-12-13 02:37:19'),
	(6, 'amey', 'xelih35531@lubde.com', 'asd', '1123', 123, '2022-12-13', '$2y$10$aoCaCM6Ji3VuZlO0YFl.Y.O4vv2cqJr0HiT2oVH5sy3AWQJqyyQJ6', 1, 'ef6dc7ba39cf4bf844244d3ef927a3e7', NULL, 1, '2022-12-13 02:40:42'),
	(7, 'harry', 'harryd123@gmail.com', 'asd', '12345', 123, '2022-12-13', '$2y$10$kiw8LOLFK9e/I4u5i3vO0.GkMpBKAbeZguOqtp1HD0mBoPyAwXFhq', 0, '5c9f04397ff3e693f7cbfccea1044483', NULL, 1, '2022-12-13 02:42:37'),
	(8, 'a', 'cejika9124@paxven.com', 'a', '12', 1, '2022-12-13', '$2y$10$0kAvtcnPie9S0W2DGjxaBuI8rvrC5Zq7BVUyNmST14J25tm2Vzdyu', 0, '250dd45640f7d810313b27e758a267af', NULL, 1, '2022-12-13 02:55:39'),
	(9, 'Sakshi Thapa', 'www@gmail.com', 'Madikhatar', '9840648593', 44600, '1999-09-14', '$2y$10$jgCEYFj8EaGFEUzfxDJpQuq0.Id4bBZBq2HAOIY5sM/B1naQq/c1.', 0, '4633315df231086260078ed659c7c752', NULL, 1, '2025-05-09 10:38:39'),
	(10, 'Ram', 'pakulithapa9@gmail.com', 'Pokhara', '9840648594', 2345, '2025-05-01', '$2y$10$hokgHdZ97b8M56gKmR1EAOpP6EuTKWMy7zs8nk9k3aiYAgMmC2rZG', 0, '0b4dd1885d7a44753879d5f452646456', NULL, 1, '2025-05-28 13:36:55');

-- Dumping structure for table hostelbooking.user_queries
CREATE TABLE IF NOT EXISTS `user_queries` (
  `sr_no` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.user_queries: ~2 rows (approximately)
INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `datentime`, `seen`) VALUES
	(11, 'Amey', 'amey@gmail.com', 'This is one subject', 'orem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates im', '2022-03-11 00:00:00', 1),
	(13, 'neal', 'n@gmail.com', '4a2qez', 'watT', '2022-12-13 10:10:48', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
