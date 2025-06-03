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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hostelbooking.rooms: ~57 rows (approximately)
INSERT INTO `rooms` (`id`, `name`, `location`, `price`, `quantity`, `people`, `description`, `status`, `removed`) VALUES
	(1, 'simple room', '159', 58, 56, 12, 'asdf asd', 1, 1),
	(2, 'simple room 2', '785', 159, 85, 452, 'adfasdfa sd', 1, 1),
	(3, 'Simple Room', '250', 300, 10, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero culpa error officiis totam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dic', 1, 0),
	(4, 'Deluxe Room', '300', 500, 10, 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero culpa error officiis totam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dic', 1, 0),
	(5, 'Luxury Room', '600', 600, 2, 8, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero culpa error officiis totam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dic', 1, 0),
	(6, 'Supreme deluxe room', '500', 900, 12, 9, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dicta quia nisi voluptates impedit perspiciatis, nobis libero culpa error officiis totam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptate vero sed tempore illo atque beatae asperiores, adipisci dic', 1, 0),
	(7, 'Sunrise Dormitory', 'Kathmandu', 700, 5, 4, 'Affordable shared dormitory in the city center.', 1, 0),
	(8, 'Everest View Room', 'Pokhara', 1200, 2, 2, 'Cozy private room with mountain views.', 1, 0),
	(9, 'Peaceful Stay', 'Lalitpur', 800, 3, 3, 'Quiet neighborhood with easy transport access.', 1, 0),
	(10, 'Budget Backpacker', 'Kathmandu', 500, 10, 6, 'Basic dorm for backpackers on a budget.', 1, 0),
	(11, 'Riverside Lodge', 'Chitwan', 900, 4, 2, 'Close to Chitwan National Park.', 1, 0),
	(12, 'Eco Homestay', 'Bhaktapur', 1000, 3, 2, 'Eco-friendly homestay with local meals.', 1, 0),
	(13, 'Valley Guest House', 'Kathmandu', 950, 6, 2, 'Popular among international travelers.', 1, 0),
	(14, 'Mountain Base Hostel', 'Pokhara', 750, 5, 4, 'Perfect for hikers and trekkers.', 1, 0),
	(15, 'Thamel Stay', 'Kathmandu', 1100, 4, 2, 'Located in the tourist hub of Thamel.', 1, 0),
	(16, 'Namaste Room', 'Lalitpur', 850, 2, 2, 'Clean and comfortable rooms.', 1, 0),
	(17, 'New Horizon Hostel', 'Dharan', 800, 3, 3, 'Spacious rooms with AC.', 1, 0),
	(18, 'Tranquil Lodge', 'Ilam', 600, 4, 2, 'Great place to relax and unwind.', 1, 0),
	(19, 'Green Valley Inn', 'Pokhara', 1300, 2, 2, 'Green surroundings and great views.', 1, 0),
	(20, 'Heritage Hostel', 'Bhaktapur', 950, 3, 3, 'Historic area with cultural sites.', 1, 0),
	(21, 'Skyline Stay', 'Kathmandu', 1200, 4, 2, 'Rooftop dining and lounge.', 1, 0),
	(22, 'Peace Hostel', 'Lalitpur', 780, 5, 3, 'Affordable and peaceful.', 1, 0),
	(23, 'Urban Traveler', 'Kathmandu', 900, 6, 2, 'For urban explorers.', 1, 0),
	(24, 'Nature Lodge', 'Pokhara', 1000, 3, 2, 'Near lakeside with peaceful view.', 1, 0),
	(25, 'Metro Hostel', 'Butwal', 850, 4, 4, 'Close to bus park and market.', 1, 0),
	(26, 'Sunshine Inn', 'Itahari', 750, 3, 2, 'Friendly staff and clean rooms.', 1, 0),
	(27, 'Pine Tree House', 'Dhulikhel', 950, 2, 2, 'Nature retreat near Dhulikhel hills.', 1, 0),
	(28, 'Traveler\'s Nest', 'Biratnagar', 700, 5, 4, 'Popular with students and solo travelers.', 1, 0),
	(29, 'Jungle Stay', 'Chitwan', 1050, 3, 2, 'Jungle safari tours available.', 1, 0),
	(30, 'Himalayan Basecamp', 'Manang', 1100, 2, 2, 'For trekkers going to Annapurna.', 1, 0),
	(31, 'Cozy Corner', 'Bhaktapur', 800, 4, 3, 'Nice shared kitchen and lounge.', 1, 0),
	(32, 'Cityscape Hostel', 'Kathmandu', 950, 3, 2, 'Modern rooms with WiFi.', 1, 0),
	(33, 'Namobuddha Retreat', 'Kavre', 1300, 2, 2, 'Spiritual and peaceful stay.', 1, 0),
	(34, 'Nepal Nights', 'Lalitpur', 880, 5, 2, 'Well-lit and safe for women travelers.', 1, 0),
	(35, 'Happy Home', 'Birgunj', 800, 4, 3, 'Local hospitality and home-cooked meals.', 1, 0),
	(36, 'Backpacker Bunk', 'Kathmandu', 500, 6, 6, 'Ideal for quick overnight stays.', 1, 0),
	(37, 'Sunset Rooms', 'Pokhara', 1250, 3, 2, 'Lakeview balconies.', 1, 0),
	(38, 'Central Lodge', 'Nepalgunj', 900, 4, 3, 'Downtown location.', 1, 0),
	(39, 'Simple Stay', 'Janakpur', 650, 3, 4, 'Clean and basic facilities.', 1, 0),
	(40, 'Trekkers Point', 'Gorkha', 850, 2, 3, 'Near trekking routes.', 1, 0),
	(41, 'Everest Hub', 'Solukhumbu', 1400, 2, 2, 'Perfect stop before basecamp.', 1, 0),
	(42, 'Forest View Hostel', 'Makwanpur', 920, 3, 3, 'Quiet and green surroundings.', 1, 0),
	(43, 'Hilltop Lodge', 'Palpa', 850, 2, 2, 'Great views and fresh air.', 1, 0),
	(44, 'River Breeze', 'Bardia', 970, 3, 2, 'Safari and river walk options.', 1, 0),
	(45, 'CoLiving Hub', 'Kathmandu', 1000, 6, 2, 'Work-from-hostel setup.', 1, 0),
	(46, 'Eastern Breeze', 'Damak', 800, 4, 3, 'Good for families and groups.', 1, 0),
	(47, 'Mero Hostel', 'Kathmandu', 950, 5, 2, 'Popular among locals.', 1, 0),
	(48, 'Student Stay', 'Hetauda', 700, 3, 4, 'For college students.', 1, 0),
	(49, 'Pokhara Paradise', 'Pokhara', 1350, 2, 2, 'Luxury feel near Fewa Lake.', 1, 0),
	(50, 'Cultural Inn', 'Bhaktapur', 980, 3, 2, 'Live like a local.', 1, 0),
	(51, 'Nomad Nest', 'Kathmandu', 1100, 4, 3, 'Digital nomad friendly.', 1, 0),
	(52, 'Serene Stay', 'Dhulikhel', 950, 2, 2, 'Yoga, meditation and retreat.', 1, 0),
	(53, 'Trailblazer Hostel', 'Lamjung', 880, 3, 4, 'Group treks start here.', 1, 0),
	(54, 'Village Homestay', 'Nuwakot', 770, 3, 2, 'Traditional village setup.', 1, 0),
	(55, 'Urban Nights', 'Kathmandu', 1050, 4, 2, 'Rooftop café and lounge.', 1, 0),
	(56, 'Evergreen Rooms', 'Pokhara', 900, 3, 2, 'Greenery and peaceful.', 1, 0),
	(57, 'Basecamp Lodge', 'Rasuwa', 1200, 2, 2, 'For Langtang route trekkers.', 1, 0);

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

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
