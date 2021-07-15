-- --------------------------------------------------------
-- Sunucu:                       127.0.0.1
-- Sunucu sürümü:                10.4.14-MariaDB - mariadb.org binary distribution
-- Sunucu İşletim Sistemi:       Win64
-- HeidiSQL Sürüm:               11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- etic_canykav için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `etic_canykav` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `etic_canykav`;

-- tablo yapısı dökülüyor etic_canykav.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` tinytext DEFAULT NULL,
  `thumbnail` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- etic_canykav.categories: ~6 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `description`, `thumbnail`) VALUES
	(1, 'Dizüstü Bilgisayarlar', NULL, NULL),
	(2, 'Masaüstü Bilgisayarlar', NULL, NULL),
	(3, 'Oyun Bilgisayarları', NULL, NULL),
	(4, 'Tabletler', NULL, NULL),
	(6, 'Telefon', 'Cebimizde taşıyabildiğimiz mobil cihazlar', NULL),
	(7, 'Akıllı Saatler', '', NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- tablo yapısı dökülüyor etic_canykav.options
CREATE TABLE IF NOT EXISTS `options` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- etic_canykav.options: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
/*!40000 ALTER TABLE `options` ENABLE KEYS */;

-- tablo yapısı dökülüyor etic_canykav.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `shipping_adress` varchar(50) DEFAULT NULL,
  `order_adress` varchar(50) DEFAULT NULL,
  `order_email` varchar(50) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_orders_customers` (`customer_id`),
  CONSTRAINT `FK_orders_customers` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- etic_canykav.orders: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- tablo yapısı dökülüyor etic_canykav.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `sku` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_order_details_orders` (`order_id`),
  KEY `FK_order_details_products` (`product_id`),
  CONSTRAINT `FK_order_details_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `FK_order_details_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- etic_canykav.order_details: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;

-- tablo yapısı dökülüyor etic_canykav.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `special_id` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `price` decimal(19,2) DEFAULT 0.00,
  `weight` decimal(10,2) DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `thumbnail` int(11) DEFAULT NULL,
  `image` varchar(225) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `recommend` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `special_id` (`special_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

-- etic_canykav.products: ~14 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `special_id`, `name`, `price`, `weight`, `description`, `thumbnail`, `image`, `stock`, `create_date`, `recommend`) VALUES
	(2, 'w09kl5nmw', 'Lenovo IdeaPad Flex 5', 350.00, 0.00, 'Hayat tarzınıza uygun ozelliklerden yararlanın', 0, 'upload/10769294065714.jpg', 2, NULL, 1),
	(3, 'qYıe019', 'Acer Predator Helios 300', 125.00, 0.00, '0', 0, '0', 0, NULL, 0),
	(37, '4UawL', 'DELL Inspiron 3881', 5162.00, 0.00, 'İşletim Sistemi	Linux', NULL, 'upload/450X-ZEQUTQUAOO1192020111715_dell-inspiron-3881_01.jpg', 0, NULL, 0),
	(43, 'q1SzL', 'Samsung Galaxy Tab S6 Lite', 2549.00, 0.00, '', NULL, 'upload/292700472_.jpg', 5, NULL, 1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- tablo yapısı dökülüyor etic_canykav.product_categories
CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_product_categories_categories` (`category_id`),
  KEY `FK_product_categories_products` (`product_id`),
  CONSTRAINT `FK_product_categories_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `FK_product_categories_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

-- etic_canykav.product_categories: ~17 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` (`id`, `product_id`, `category_id`) VALUES
	(1, 2, 1),
	(20, 37, 2),
	(26, 43, 4);
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;

-- tablo yapısı dökülüyor etic_canykav.product_options
CREATE TABLE IF NOT EXISTS `product_options` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `option_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_product_options_options` (`option_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `FK_product_options_options` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`),
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- etic_canykav.product_options: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `product_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_options` ENABLE KEYS */;

-- tablo yapısı dökülüyor etic_canykav.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `billing_adress` varchar(50) DEFAULT NULL,
  `default_shipping_adress` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- etic_canykav.users: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `password`, `name`, `billing_adress`, `default_shipping_adress`, `country`, `phone`, `is_admin`) VALUES
	(1, 'test@test.co', '123456', 'test', NULL, NULL, NULL, NULL, NULL),
	(2, 'can@test.cooc', '12345678', 'Name X', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
