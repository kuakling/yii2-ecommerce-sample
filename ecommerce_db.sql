-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- โฮสต์: 127.0.0.1
-- เวลาในการสร้าง: 05 มิ.ย. 2017  04:21น.
-- เวอร์ชั่นของเซิร์ฟเวอร์: 5.5.54-0ubuntu0.14.04.1
-- รุ่นของ PHP: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- ฐานข้อมูล: `ecommerce_db`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('employee-lv1', '4', 1496628563),
('root', '1', 1496628064);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1496627920, 1496627920),
('/cart/*', 2, NULL, NULL, NULL, 1496628356, 1496628356),
('employee-lv1', 1, 'พนักงานระดับ 1', NULL, NULL, 1496628431, 1496628431),
('manage-backend', 2, 'งานดูแลหลังร้านทั้งหมด', NULL, NULL, 1496627991, 1496628010),
('manage-cart', 2, 'งานจัดการตะกร้าสินค้า', NULL, NULL, 1496628334, 1496628334),
('root', 1, 'ผู้ดูแลสูงสุด', NULL, NULL, 1496628045, 1496628045);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('manage-backend', '/*'),
('manage-cart', '/cart/*'),
('root', 'manage-backend'),
('employee-lv1', 'manage-cart');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- dump ตาราง `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `address`, `created_at`, `updated_at`, `status`, `comment`) VALUES
(1, 3, 'ปัตตานี', 1496628988, 1496628988, 0, NULL),
(2, 2, 'ยะลา', 1496629310, 1496629310, 0, NULL);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `cart_items`
--

CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- dump ตาราง `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `amount`, `price`) VALUES
(1, 1, 5, 1, '9200.00'),
(2, 1, 2, 1, '24900.00'),
(3, 2, 1, 1, '23900.00');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1495344853),
('m130524_201442_user_table', 1495344857),
('m140506_102106_rbac_init', 1495344902),
('m160425_081413_create_user_profile_table', 1495344857);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) NOT NULL COMMENT 'Title',
  `category_id` int(11) NOT NULL COMMENT 'Category',
  `detail` text COMMENT 'Detail',
  `price` float NOT NULL DEFAULT '0' COMMENT 'Price',
  `balance` float NOT NULL DEFAULT '0' COMMENT 'Balance',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT 'Status',
  `created_at` varchar(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` varchar(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- dump ตาราง `product`
--

INSERT INTO `product` (`id`, `title`, `category_id`, `detail`, `price`, `balance`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Lenovo MIIX 510-80XE004NTA (Silver)', 1, '<p><img alt="" src="https://img.advice.co.th/images_nas/pic_product4/A0097902/A0097902OK_BIG_2.jpg" style="height:200px; width:200px" /></p>\r\n\r\n<p>CPU : Intel Core Core i3-7100U</p>\r\n\r\n<p>RAM :<em>4GB DDR4</em></p>\r\n\r\n<p>HDD : 128GB SSD Display 12.2&quot; inch</p>\r\n\r\n<p>Graphics :Integrated</p>\r\n\r\n<p>OS : Windows 10 Home</p>\r\n\r\n<p>&nbsp;</p>\r\n', 23900, 11, 1, '1495361397', 1, '1496395988', 1),
(2, 'DELL Vostro V3668 (W2681403TH)', 2, '<p>CPU : Intel i7-7700 3.6GHz</p>\r\n\r\n<p>RAM : 8GB DDR4 2400MHz</p>\r\n\r\n<p>HDD : 1TB&nbsp;</p>\r\n\r\n<p>Graphics : Integrated</p>\r\n\r\n<p>ODD:&nbsp;DVD-RW</p>\r\n\r\n<p>OS : Ubuntu</p>\r\n', 24900, 0, 1, '1495362540', 1, '1496398802', 1),
(3, 'PHILIPS 216V6LHSB2/00 (HDMI) LED 20.7''''', 10, '<p>Brand: PHILIPS</p>\r\n\r\n<p>Model: 216V6LHSB2</p>\r\n\r\n<p>Pixel Pitch: 0.2385x 0.2385 mm</p>\r\n\r\n<p>Response Time: 5ms</p>\r\n\r\n<p>Max. Resolution: 1920 x 1080 @ 60Hz</p>\r\n\r\n<p>Contrast Ratio: 10,000,000:1</p>\r\n\r\n<p>Brightness: 200 cd/m&sup2;</p>\r\n\r\n<p>Display: 20.7&quot; W (52.6cm)</p>\r\n\r\n<p>Viewing Angle: 90&deg; (H) / 65&deg; (V) @ C/R &gt; 10</p>\r\n\r\n<p>Color System: 16.7M</p>\r\n\r\n<p>HDMI: 1 Port</p>\r\n\r\n<p>VGA Port: 1 Port</p>\r\n\r\n<p>Aspect Ratio: 16:9</p>\r\n', 3090, 34, 1, '1495362724', 1, '1495362724', 1),
(4, 'Iphone 10', 3, '<p>Iphone 10&nbsp;Iphone 10Iphone 10Iphone 10Iphone 10Iphone 10Iphone 10Iphone 10Iphone 10Iphone 10Iphone 10Iphone 10Iphone <strong>10Iphone</strong> 10Iphone <a id="sss" name="sss">10Iphone</a> 10Ipho<s>ne 10</s></p>\r\n', 1000, 3, 1, '1495521915', 1, '1495521915', 1),
(5, '512 GB. SSD Samsung 850 PRO (MZ-7KE512BW)', 7, '<p>ข้อมูลจำเพาะของ 512 GB. SSD Samsung 850 PRO (MZ-7KE512BW)</p>\r\n\r\n<p><br />\r\nBrand</p>\r\n\r\n<p>samsung</p>\r\n\r\n<p>Model</p>\r\n\r\n<p>Samsung 850 PRO</p>\r\n\r\n<p>Capacity</p>\r\n\r\n<p>512GB</p>\r\n\r\n<p>Interface</p>\r\n\r\n<p>SATA 6Gb/s (compatible with SATA 3Gb/s and SATA 1.5Gb/s)</p>\r\n\r\n<p>Transfer Rate (MB/sec)</p>\r\n\r\n<p>Read : Up to 550 MB/s&nbsp;<br />\r\nWrite : Up to 520 MB/s</p>\r\n\r\n<p>Form Factor</p>\r\n\r\n<p>2.5 inch form factor</p>\r\n', 9200, 20, 1, '1495680254', 1, '1495680254', 1),
(6, '1.TB. SSD Samsung m.2 2280 960PRO', 7, '<p>Samsung</p>\r\n\r\n<p>Model &nbsp; &nbsp;960 PRO (MZ-V6P1T0)</p>\r\n\r\n<p>Capacity &nbsp; &nbsp;1TB</p>\r\n\r\n<p>Interface &nbsp; &nbsp;PCIe 3.0 x4, NVMe 1.2</p>\r\n\r\n<p>Transfer Rate (MB/sec) &nbsp; &nbsp;Sequential Read Speed : Max 3,500 MB/sec&nbsp;<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Sequential Write Speed : Max 2,100 MB/sec</p>\r\n\r\n<p>Form Factor &nbsp; &nbsp;M.2</p>\r\n', 21900, 54, 1, '1496399313', 1, '1496399313', 1),
(7, '2GB GDDR5 GTX1050 MSI OC', 1, '<p>Memory : 2GB GDDR5 / 128-bit Port : DVI / HDMI / Display</p>\r\n', 4190, 22, 1, '1496399463', 1, '1496399463', 1);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) NOT NULL COMMENT 'Title',
  `created_at` varchar(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` varchar(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- dump ตาราง `product_category`
--

INSERT INTO `product_category` (`id`, `title`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Notebook', '1495360280', 1, '1495360280', 1),
(2, 'PC', '1495360354', 1, '1495360354', 1),
(3, 'CPU', '1495360365', 1, '1495360365', 1),
(4, 'Mainboard', '1495360377', 1, '1495360377', 1),
(5, 'Graphic Card', '1495360415', 1, '1495360415', 1),
(6, 'RAM', '1495360423', 1, '1495360423', 1),
(7, 'Harddisk', '1495360449', 1, '1495360449', 1),
(8, 'Case', '1495360471', 1, '1495360471', 1),
(9, 'Power supply', '1495360484', 1, '1495360484', 1),
(10, 'Monitor', '1495360493', 1, '1495360493', 1);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- dump ตาราง `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '4zDgeprzL2aeGTjVtMQjnP3yH1Bvd8GL', '$2y$13$4M/KWkZxCAfVL4yMQNa/1.BUkyE2YSiFPjThmvEOxGJveJ/8sF3Bi', NULL, 'admin@yii2-ecomerce-sample-kuakling.c9users.io', 10, 1495345695, 1495345695),
(2, 'customer1', 'zSe9C-f4eZinFFBniLWfPJpxoDtxZiad', '$2y$13$2JoXMEJ3xBhF2gcq.IlIuOWsQLKl25FdjgzLcNca.cS9gaR2uGSGy', NULL, 'customer1@yii2-ecommerce.com', 10, 1496627815, 1496627815),
(3, 'customer2', 'EQnV0wmDPDBOjAz2e_ycsyLosUd9MDCj', '$2y$13$q30B6ReHLKPDvVqtHDa6quk/juedoU0MQJ4jDa.LkMlle2ZW1VyaC', NULL, 'customer2@yii2-ecommerce.com', 10, 1496628489, 1496628489),
(4, 'employee1', 'Mq07sjMJvAfMrBPtvGNSElLQ3zT9dfVW', '$2y$13$KZCDyfwOCdhyzyUiPvC/v.e8MBK01VUDjgjkwcAH20XnPCpjnqrR.', NULL, 'employee1@yii2-ecommerce.com', 10, 1496628536, 1496628536);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `avatar_offset` varchar(255) NOT NULL,
  `avatar_cropped` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `cover_offset` varchar(255) NOT NULL,
  `cover_cropped` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- dump ตาราง `user_profile`
--

INSERT INTO `user_profile` (`user_id`, `firstname`, `lastname`, `avatar_offset`, `avatar_cropped`, `avatar`, `cover_offset`, `cover_cropped`, `cover`, `bio`) VALUES
(1, 'แอดมิน', 'สูงสุด', '27.11-1-93.11-100', '59265d84a3013_59212ac619db1.jpg', '59212ac619db1.jpg', '0-14.52-100-41.19', '59265d781a8ac_59265d7816291.jpg', '59265d7816291.jpg', ''),
(2, 'แจ็ค', 'สแปร์โร่ว', '', '', '', '', '', '', ''),
(3, '', '', '', '', '', '', '', '', ''),
(4, 'โทนี่', 'สตาร์ค', '', '', '', '', '', '', 'พนักงานตะกร้าสินค้า');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
