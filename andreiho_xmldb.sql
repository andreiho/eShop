-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: db22.meebox.net
-- Generation Time: Nov 20, 2014 at 04:22 PM
-- Server version: 5.5.38-0+wheezy1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `andreiho_xmldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_username` varchar(24) NOT NULL,
  `admin_name` varchar(32) NOT NULL,
  `admin_password` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_username`, `admin_name`, `admin_password`) VALUES
('admin', 'Andrei Horodinca', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_partner_id` int(11) NOT NULL,
  `order_customer_id` int(11) NOT NULL,
  `order_product_id` int(11) NOT NULL,
  `order_product_quantity` int(24) NOT NULL,
  `order_total` int(24) NOT NULL,
  `order_delivery_address` varchar(1024) NOT NULL,
  `order_email` varchar(1024) NOT NULL,
  `order_phone_number` varchar(24) NOT NULL,
  `order_timestamp` int(11) NOT NULL,
  `order_processed` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_partner_id`, `order_customer_id`, `order_product_id`, `order_product_quantity`, `order_total`, `order_delivery_address`, `order_email`, `order_phone_number`, `order_timestamp`, `order_processed`) VALUES
(1, 28, 0, 1, 1, 999, 'Lygten 37, 2200 Copenhagen N', 'andrei.horodinca@gmail.com', '45 42 53 63', 1416442690, 0),
(2, 28, 1, 9, 3, 2997, 'Norre Alle 19, 2200 Copenhagen N', 'andrei.horodinca@gmail.com', '50 50 50 30', 1416442747, 0),
(3, 29, 1, 3, 1, 56885, 'Falkoner Alle 28, Frederiksberg', 'andrei.horodinca@gmail.com', '50 20 50 10', 1416442785, 0),
(4, 29, 0, 1, 1, 19949, 'Osterbrogade 53, 2100 Copenhagen O', 'user@email.com', '20 10 50 20', 1416442816, 0),
(5, 28, 0, 11, 9, 8091, 'Norrebrogade 20, 2200 Copenhagen N', 'johndoe@gmail.com', '34 59 20 24', 1416442852, 0),
(6, 28, 0, 16, 1, 1299, 'n&oslash;rre alle 19 m, 1 - 4 . 2200 kbh N', 'avi.melissa.lla@gmail.com', '+4553831325', 1416443991, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `ext_product_id` int(11) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `product_description` varchar(1024) NOT NULL,
  `product_image_url` varchar(1024) NOT NULL,
  `product_quantity` int(24) NOT NULL,
  `product_price` int(24) NOT NULL,
  `product_removed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `vendor_id`, `ext_product_id`, `product_name`, `product_description`, `product_image_url`, `product_quantity`, `product_price`, `product_removed`) VALUES
(1, 28, 0, 'Caviar Sleeve Knit', 'Cable knitted black base body, with contrasting pearl patterned sleeve detailing.', 'http://shop.fruitionlv.com/uploaded_images/KTZPatternedCrewneck.jpg', 100, 999, 0),
(2, 28, 0, 'Denim Knitted Jacket', ' Dual paneled knitted jacket, with classic iconic denim front.', 'http://shop.fruitionlv.com/uploaded_images/DenimKnittedJacket1.jpg', 80, 1299, 0),
(3, 28, 0, 'Norwegian Dark Knit ', 'Timeworn norwegian dark diamond quatrefoil knit, with contrasting design. ', 'http://shop.fruitionlv.com/uploaded_images/NorwegianDarkKnitFront.jpg', 24, 1799, 0),
(4, 28, 0, 'Lumberjack Lodge Coat', 'Timeworn coat, with two chest welt pockets.', 'http://shop.fruitionlv.com/uploaded_images/PlaidLumbercoat.jpg', 125, 2499, 0),
(5, 28, 0, ' Fair Isle Sweater', 'Timeworn fair isle double knitted sweater, with heather gray body.', 'http://shop.fruitionlv.com/uploaded_images/FairIsleDoubleKnit1.jpg', 78, 899, 0),
(6, 28, 0, 'Norwegian Diamond Sweater', 'Timeworn norwegian diamond quatrefoil shawl sweater, with contrasting arm and lower body detailing.', 'http://shop.fruitionlv.com/uploaded_images/NorwegianKnittedShawl.jpg', 80, 1199, 0),
(7, 28, 0, 'Aztec Summit Coat', 'Archival woolrich aztec summit coat, with red/green striped colorway.', 'http://shop.fruitionlv.com/uploaded_images/WoolrichAztecCoat.jpg', 190, 1299, 0),
(8, 28, 0, 'Rustic Shawl Sweater', 'Cozy shawl collar, with single leather basket-woven button at the placket.', 'http://shop.fruitionlv.com/uploaded_images/Shawl-copy.jpg', 10, 799, 0),
(9, 28, 0, 'Navajo Knit Vest', 'Archival Ralph Lauren polo navajo knit vest, with five-button front.', 'http://shop.fruitionlv.com/uploaded_images/rlknitvest1.jpg', 25, 999, 0),
(10, 28, 0, 'Crystal Native Knit ', 'Crystal serrated lightning native knit.', 'http://shop.fruitionlv.com/uploaded_images/sunburstps.jpg', 55, 1399, 0),
(11, 28, 0, 'Polo Ski Knit', 'Timeworn norwegian ski knit, with contrasting design. ', 'http://shop.fruitionlv.com/uploaded_images/ralphlaurenskips.jpg', 66, 899, 0),
(12, 28, 0, 'Cookie Knit Sweater', 'Ralph Lauren cookie knit sweater.', 'http://shop.fruitionlv.com/uploaded_images/rlcookieknitps.jpg', 90, 699, 0),
(13, 28, 0, 'Lightning Native Knit ', 'Crystal serrated lightning native knit.', 'http://shop.fruitionlv.com/uploaded_images/sunburstps.jpg', 210, 1299, 0),
(14, 28, 0, 'On Fire Cardigan', 'Phenomenon on fire cardigan, with ribbed V-neckline and placket.', 'http://shop.fruitionlv.com/uploaded_images/phenomenoncardigan.jpg', 28, 799, 0),
(15, 28, 0, 'NauticalKnit', 'Nautical drawstring knit crewneck, with woven patched logo.', 'http://shop.fruitionlv.com/uploaded_images/Drawstring-Crewneck.jpg', 87, 899, 0),
(16, 28, 0, 'Norwegian Check Sweater', 'Timeworn norwegian smoke woven check sweater, with contrasting vector motif.', 'http://shop.fruitionlv.com/uploaded_images/NorwegianCheckKnit.jpg', 45, 1299, 0),
(17, 29, 1, 'XML Electric Killer', 'The super fast racer killer electric bike', 'http://www.motorizedbicyclesportal.com/adventurer-electric-bike.gif', 0, 20999, 0),
(18, 29, 2, 'XML Shopper Electric Bike', 'Go and shop without peddaling', 'http://2.bp.blogspot.com/-hgMQf3YGgKg/UWmrSQtrbDI/AAAAAAAADtg/52EKvTNraIg/s1600/a2b-velociti-e-bike-v24-white01-stock.jpg', 0, 14999, 0),
(19, 29, 3, 'XML Electric Ninja', 'the fastest bike in the world powered by electricity', 'http://www.bicycle-power.com/images/MOTOrepublic-Beta-Electric-Bike-.jpg', 0, 59879, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `user_email` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `user_password` varchar(512) CHARACTER SET utf8 NOT NULL,
  `user_code` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_timestamp` int(11) NOT NULL,
  `user_confirmed` int(11) NOT NULL DEFAULT '0',
  `user_string` varchar(35) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_code`, `user_timestamp`, `user_confirmed`, `user_string`) VALUES
(1, 'Demo User', 'andrei.horodinca@gmail.com', '$2y$12$240365984546d32cf19d8uu95v3jQy0Yh.pFdWCMY/mi1XXiyOKky', '1546d32cf19d2e', 1416442575, 1, '0'),
(2, 'Melissa', 'avi.melissa.lla@gmail.com', '$2y$12$5390315125546d38ab5dbup77oeiUg7zFkXsRZk4gBnq9Dt.n/Mcq', '1546d38ab5dacb', 1416444075, 1, '0'),
(3, 'mel', 'me.avilla@hotmail.com', '$2y$12$863834224546d390ae1cauMxtOPfApDAc3LxrjJkRaOX.Iq34P.ZW', '1546d390ae1c5d', 1416444170, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(32) NOT NULL,
  `vendor_email` varchar(1024) NOT NULL,
  `vendor_url` varchar(1024) NOT NULL,
  `vendor_commission` int(11) NOT NULL,
  `vendor_code` varchar(100) NOT NULL,
  `vendor_key` varchar(20) NOT NULL,
  `vendor_confirmed` int(11) NOT NULL DEFAULT '0',
  `vendor_removed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `vendor_email`, `vendor_url`, `vendor_commission`, `vendor_code`, `vendor_key`, `vendor_confirmed`, `vendor_removed`) VALUES
(28, 'eShop', 'andrei.horodinca@gmail.com', 'http://eshop.dev/api/products.json', 0, '', '518012', 1, 0),
(29, 'Demo Partner', 'ah@churchdesk.com', 'http://iqvsiq.com/webshop2014/products.xml', 5, '1546d31a8e468c', '346820', 1, 0),
(30, 'My Shop', 'andrei.horodinca@aiesec.net', '', 24, '1546ded594f8bb', '', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
