-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 21, 2022 at 03:36 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fishytablemarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `CartID` int NOT NULL AUTO_INCREMENT,
  `CartPaid` bit(1) NOT NULL,
  `CustID` int NOT NULL,
  PRIMARY KEY (`CartID`),
  KEY `CustID` (`CustID`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `CartPaid`, `CustID`) VALUES
(1, b'1', 1),
(2, b'1', 2),
(3, b'0', 3),
(4, b'0', 1),
(7, b'1', 2),
(8, b'1', 3),
(9, b'1', 1),
(10, b'1', 2),
(11, b'1', 2),
(12, b'1', 2),
(13, b'1', 3),
(14, b'1', 3),
(15, b'1', 2),
(16, b'1', 2),
(17, b'1', 1),
(18, b'1', 1),
(19, b'1', 2),
(20, b'1', 2),
(21, b'1', 3),
(22, b'1', 2),
(23, b'1', 3),
(24, b'1', 1),
(25, b'1', 2),
(26, b'1', 3),
(27, b'1', 3),
(28, b'1', 2),
(29, b'1', 2),
(30, b'0', 2),
(31, b'0', 2),
(32, b'0', 2),
(33, b'0', 2),
(34, b'0', 2),
(35, b'0', 2),
(36, b'0', 2),
(37, b'0', 2),
(38, b'0', 2),
(39, b'0', 2),
(40, b'0', 2),
(41, b'0', 2),
(42, b'0', 2),
(43, b'0', 2),
(44, b'0', 2),
(45, b'0', 2),
(46, b'0', 2),
(47, b'0', 2),
(48, b'0', 2),
(49, b'1', 8),
(50, b'0', 9),
(51, b'1', 8),
(52, b'0', 8);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `CategoryID` char(6) NOT NULL,
  `CategoryName` varchar(30) NOT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
('FISHCA', 'Fishery'),
('ORGACA', 'Organic');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `CustID` int NOT NULL AUTO_INCREMENT,
  `CustName` varchar(30) NOT NULL,
  `CustEmail` varchar(255) NOT NULL,
  `CustPassword` varchar(128) NOT NULL,
  `CustAddress` varchar(255) NOT NULL,
  PRIMARY KEY (`CustID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustID`, `CustName`, `CustEmail`, `CustPassword`, `CustAddress`) VALUES
(1, 'Kudo Tan', 'kudotan@gmail.com', 'kudotan123', 'Taman Fifi, Jalan Mango 12, Bukit Jalil'),
(2, 'Bright Chiah', 'brightchiah@gmail.com', 'brightchiah123', 'Taman Cena, Jalan Apple 42, Bukit Jalil '),
(3, 'Ryan Chong', 'ryanchong@gmail.com', 'ryanchong123', 'Taman Wifo, Jalan Watermelon 13, Bukit Jalil'),
(8, 'John Belgium Johnyy', 'johnlegenda@gmail.com', 'john1234', 'Jalan Terbalik Kangkung, 55200 Cheras, Kuala Lumpur'),
(9, 'Bubu bobo', 'bobo@mail.com', 'bobo123123', '29, jalan lan al');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `OrderID` int NOT NULL AUTO_INCREMENT,
  `RecipientName` varchar(60) NOT NULL,
  `RecipientAddress` varchar(255) NOT NULL,
  `RecipientTelephone` varchar(12) NOT NULL,
  `OrderDate` date NOT NULL,
  `CartID` int NOT NULL,
  `totalprice` decimal(10,2) NOT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `CartID` (`CartID`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `RecipientName`, `RecipientAddress`, `RecipientTelephone`, `OrderDate`, `CartID`, `totalprice`) VALUES
(1, 'Kudo Tan', 'Taman Mifi, Jalan Kiki 24, Bukit Jalil', '0122344234', '2021-12-12', 1, '10.00'),
(7, 'John Try', '20, Jalan try, Taman never give up, 23222, Selangor', '0122323232', '2021-12-31', 2, '332.50'),
(9, 'Aaron Bong', '2/10 Jalan two per ten, Taman dua bahagi 10, 81203, Johor', '0199999992', '2022-01-02', 8, '170.00'),
(28, 'John Legenda', 'Jalan Takdejalan, 55200 Cheras, Kuala Lumpur', '01294323433', '2022-01-20', 49, '243.00'),
(29, 'John Legenda', 'Jalan Terbalik Kangkung, 55200 Cheras, Kuala Lumpur', '01234234234', '2022-01-20', 51, '53.00'),
(30, 'Bright Chiah', 'Taman Cena, Jalan Apple 42, Bukit Jalil ', '0127314938', '2022-01-20', 7, '508.50'),
(31, 'Kudo Tan', 'Taman Fifi, Jalan Mango 12, Bukit Jalil', '0125742928', '2022-01-20', 9, '56.50'),
(32, 'Bright Chiah', 'Taman Cena, Jalan Apple 42, Bukit Jalil ', '0127230865', '2022-01-20', 10, '48.00'),
(33, 'Bright Chiah', 'Taman Cena, Jalan Apple 42, Bukit Jalil ', '0124932579', '2022-01-20', 11, '140.00'),
(34, 'Bright Chiah', 'Taman Cena, Jalan Apple 42, Bukit Jalil ', '0126954043', '2022-01-20', 12, '105.00'),
(35, 'Ryan Chong', 'Taman Wifo, Jalan Watermelon 13, Bukit Jalil', '0121588881', '2022-01-20', 13, '12.00'),
(36, 'Ryan Chong', 'Taman Wifo, Jalan Watermelon 13, Bukit Jalil', '0126484197', '2022-01-20', 14, '56.50'),
(37, 'Bright Chiah', 'Taman Cena, Jalan Apple 42, Bukit Jalil ', '0125733988', '2022-01-20', 15, '100.00'),
(38, 'Bright Chiah', 'Taman Cena, Jalan Apple 42, Bukit Jalil ', '0121761061', '2022-01-20', 16, '105.00'),
(39, 'Kudo Tan', 'Taman Fifi, Jalan Mango 12, Bukit Jalil', '0124086521', '2022-01-20', 17, '24.00'),
(40, 'Kudo Tan', 'Taman Fifi, Jalan Mango 12, Bukit Jalil', '0124306748', '2022-01-20', 18, '35.00'),
(41, 'Bright Chiah', 'Taman Cena, Jalan Apple 42, Bukit Jalil ', '0129895504', '2022-01-20', 19, '56.50'),
(42, 'Bright Chiah', 'Taman Cena, Jalan Apple 42, Bukit Jalil ', '0121033748', '2022-01-20', 20, '19.00'),
(43, 'Ryan Chong', 'Taman Wifo, Jalan Watermelon 13, Bukit Jalil', '0121723209', '2022-01-20', 21, '10.00'),
(44, 'Bright Chiah', 'Taman Cena, Jalan Apple 42, Bukit Jalil ', '0124224942', '2022-01-20', 22, '56.50'),
(45, 'Ryan Chong', 'Taman Wifo, Jalan Watermelon 13, Bukit Jalil', '0128284169', '2022-01-20', 23, '15.00'),
(46, 'Kudo Tan', 'Taman Fifi, Jalan Mango 12, Bukit Jalil', '0127589307', '2022-01-20', 24, '113.00'),
(47, 'Bright Chiah', 'Taman Cena, Jalan Apple 42, Bukit Jalil ', '0124517853', '2022-01-20', 25, '15.00'),
(48, 'Ryan Chong', 'Taman Wifo, Jalan Watermelon 13, Bukit Jalil', '0121857549', '2022-01-20', 26, '96.00'),
(49, 'Ryan Chong', 'Taman Wifo, Jalan Watermelon 13, Bukit Jalil', '0124904764', '2022-01-20', 27, '18.00'),
(50, 'Bright Chiah', 'Taman Cena, Jalan Apple 42, Bukit Jalil ', '0128966377', '2022-01-20', 28, '21.00'),
(51, 'Bright Chiah', 'Taman Cena, Jalan Apple 42, Bukit Jalil ', '0124884727', '2022-01-20', 29, '169.50');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ProductID` int NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ShippingMethod` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `ProductSpecification` varchar(1200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ProductPicture` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Weight` int NOT NULL,
  `DateAdded` date NOT NULL,
  `SellerID` int NOT NULL,
  `SubCategoryID` char(6) NOT NULL,
  `ProductRating` int DEFAULT NULL,
  PRIMARY KEY (`ProductID`),
  KEY `SellerID` (`SellerID`,`SubCategoryID`),
  KEY `SubCategoryID` (`SubCategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `ShippingMethod`, `Price`, `ProductSpecification`, `ProductPicture`, `Weight`, `DateAdded`, `SellerID`, `SubCategoryID`, `ProductRating`) VALUES
(1, 'Uncle Big Fish Super Big Size Salmon Sure fresh', 'Seller-self delivery', '56.50', 'A fish reared dearly by Uncle Big Fish. The salmons are big and fat because of the dearing love by Uncle. The fish average around 1kg.  UncleBigFish\'s fish is fresh! It is comes from India, packed well. We promise that the fish is still fresh when it reach your home!', 'image/unclebigFish.jpg', 1000, '2021-11-28', 1, 'FIS', 5),
(2, 'Tiger Prawn Fresh Deluxe- 500g', 'Third-party delivery', '35.00', 'Freshly farmed tiger prawn reared by the finest quality caretaker. *Item may average around 500 g. Buy now!! 100 SURE  fresh.', 'image/wangleisellshrimp.jpg', 500, '2021-12-05', 2, 'PRN', 5),
(3, 'Fresh Local silverbeet – 500g organically grown', 'Third-party delivery', '12.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/smartSellVege.jpg', 500, '2021-12-11', 3, 'FRU', 4),
(4, 'Ikan bilis', 'Third-party delivery', '2.00', 'Im selling nothing, hi there', 'image/ikan_bilis.jpg', 100, '2022-01-03', 4, 'FIS', 0),
(5, 'Baked Beans', 'Third-party delivery', '7.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/bakedbeans.png', 500, '2021-12-11', 3, 'BEA', 0),
(6, 'Almond Nuts', 'Third-party delivery', '10.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/almond.png', 500, '2021-12-11', 3, 'BEA', 0),
(7, 'Dried Beans', 'Third-party delivery', '9.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/driedbeans.png', 500, '2021-12-11', 3, 'BEA', 0),
(8, 'Lobster', 'Third-party delivery', '37.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/lobster.png', 500, '2021-12-11', 3, 'LOB', 0),
(9, 'King Crab', 'Third-party delivery', '230.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/kingcrab.png', 500, '2021-12-11', 3, 'LOB', 0),
(10, 'Blue Crab', 'Third-party delivery', '29.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/bluecrab.png', 500, '2021-12-11', 3, 'LOB', 0),
(11, 'Salmon', 'Third-party delivery', '21.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/salmon.png', 500, '2021-12-11', 3, 'FIS', 0),
(12, 'Seabass', 'Third-party delivery', '16.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/seabass.png', 500, '2021-12-11', 3, 'FIS', 0),
(13, 'Grey Prawn', 'Third-party delivery', '15.00', 'This is another prawn, kudo loves it!', 'image/greyprawn.png', 500, '2021-12-11', 2, 'PRN', 0),
(14, 'White Shrimp', 'Third-party delivery', '19.00', 'This is prawn, it is clever!', 'image/whiteshrimp.png', 500, '2021-12-11', 2, 'PRN', 0),
(15, 'Watermelon', 'Third-party delivery', '9.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/watermelon.png', 500, '2021-12-11', 3, 'FRU', 0),
(16, 'Mango', 'Third-party delivery', '12.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/mango.png', 500, '2021-12-11', 3, 'FRU', 0),
(17, 'Chicken', 'Third-party delivery', '17.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/chicken.png', 500, '2021-12-11', 3, 'MEA', 0),
(18, 'Mutton', 'Third-party delivery', '19.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/mutton.png', 500, '2021-12-11', 3, 'MEA', 0),
(19, 'Beef', 'Third-party delivery', '21.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/beef.png', 500, '2021-12-11', 3, 'MEA', 0),
(20, 'Black Tuffle', 'Third-party delivery', '17.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/blacktuffle.png', 500, '2021-12-11', 3, 'MUS', 0),
(21, 'Enokitake', 'Third-party delivery', '6.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/enokitake.png', 500, '2021-12-11', 3, 'MUS', 0),
(22, 'Champignon', 'Third-party delivery', '9.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/champignon.png', 500, '2021-12-11', 3, 'MUS', 0),
(23, 'Octopus', 'Third-party delivery', '23.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/octopus.png', 500, '2021-12-11', 3, 'OCT', 0),
(24, 'Squid', 'Third-party delivery', '19.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/squid.png', 500, '2021-12-11', 3, 'OCT', 0),
(25, 'Calamari Squid', 'Third-party delivery', '39.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/calamari.png', 500, '2021-12-11', 3, 'OCT', 0),
(26, 'Muscle', 'Third-party delivery', '17.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/muscle.png', 500, '2021-12-11', 3, 'SHL', 4),
(27, 'Oyster', 'Third-party delivery', '20.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/oyster.png', 500, '2021-12-11', 3, 'SHL', 4),
(28, 'Clam', 'Third-party delivery', '19.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/clam.png', 500, '2021-12-11', 3, 'SHL', 4),
(29, 'Carrot', 'Third-party delivery', '4.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/carrot.png', 500, '2021-12-11', 3, 'VEG', 4),
(30, 'Tomato', 'Third-party delivery', '6.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/tomato.png', 500, '2021-12-11', 3, 'VEG', 4),
(31, 'Broccoli', 'Third-party delivery', '8.00', 'Homegrown silverbeet fresh from the farm. 1 Unit 500g average. No pesticide no artificial medicine. Organically delicious silverbeet', 'image/broccoli.png', 500, '2021-12-11', 3, 'VEG', 4);

-- --------------------------------------------------------

--
-- Table structure for table `productcartlist`
--

DROP TABLE IF EXISTS `productcartlist`;
CREATE TABLE IF NOT EXISTS `productcartlist` (
  `ProductCartListID` int NOT NULL AUTO_INCREMENT,
  `Quantity` int NOT NULL,
  `UnitPrice` decimal(10,2) NOT NULL,
  `CartID` int NOT NULL,
  `ProductID` int NOT NULL,
  PRIMARY KEY (`ProductCartListID`),
  KEY `CartID` (`CartID`,`ProductID`),
  KEY `ProductID` (`ProductID`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productcartlist`
--

INSERT INTO `productcartlist` (`ProductCartListID`, `Quantity`, `UnitPrice`, `CartID`, `ProductID`) VALUES
(4, 2, '12.00', 1, 3),
(6, 3, '55.50', 2, 1),
(9, 4, '12.00', 2, 3),
(10, 5, '55.50', 4, 1),
(17, 2, '35.00', 4, 2),
(25, 3, '35.00', 2, 2),
(28, 9, '56.50', 7, 1),
(29, 7, '12.00', 7, 3),
(30, 6, '35.00', 7, 2),
(92, 2, '56.50', 8, 1),
(93, 1, '35.00', 8, 2),
(94, 1, '12.00', 8, 3),
(95, 1, '56.50', 9, 1),
(96, 1, '35.00', 9, 2),
(97, 4, '12.00', 10, 3),
(98, 4, '35.00', 11, 2),
(99, 3, '35.00', 12, 2),
(100, 1, '12.00', 13, 3),
(106, 1, '56.50', 14, 1),
(107, 1, '12.00', 14, 3),
(123, 1, '100.00', 15, 4),
(127, 3, '35.00', 16, 2),
(128, 1, '12.00', 16, 3),
(135, 2, '12.00', 17, 16),
(136, 2, '15.00', 18, 13),
(137, 1, '35.00', 18, 2),
(138, 1, '56.50', 19, 1),
(139, 1, '19.00', 19, 14),
(140, 1, '19.00', 20, 14),
(141, 1, '10.00', 21, 6),
(142, 1, '19.00', 22, 14),
(143, 1, '56.50', 22, 1),
(144, 1, '15.00', 23, 13),
(145, 2, '56.50', 24, 1),
(146, 1, '15.00', 25, 13),
(147, 6, '16.00', 26, 12),
(154, 1, '6.00', 27, 21),
(155, 2, '9.00', 27, 15),
(157, 3, '15.00', 28, 13),
(160, 1, '16.00', 28, 12),
(161, 1, '21.00', 28, 11),
(162, 1, '39.00', 28, 25),
(163, 1, '19.00', 28, 28),
(164, 1, '20.00', 28, 27),
(165, 6, '17.00', 28, 17),
(166, 3, '56.50', 29, 1),
(167, 2, '19.00', 30, 14),
(171, 3, '10.00', 49, 6),
(172, 7, '29.00', 49, 10),
(173, 1, '19.00', 51, 18),
(174, 2, '12.00', 51, 16),
(175, 1, '15.00', 52, 13);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `RatingID` int NOT NULL AUTO_INCREMENT,
  `Rating` int NOT NULL,
  `FeedbackHeader` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Feedback` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `DateWritten` date NOT NULL,
  `CustID` int NOT NULL,
  `ProductID` int NOT NULL,
  `CartID` int NOT NULL,
  PRIMARY KEY (`RatingID`),
  KEY `CustID` (`CustID`,`ProductID`,`CartID`),
  KEY `ProductID` (`ProductID`),
  KEY `CartID` (`CartID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`RatingID`, `Rating`, `FeedbackHeader`, `Feedback`, `DateWritten`, `CustID`, `ProductID`, `CartID`) VALUES
(1, 4, 'Awesome products!', 'Delicious Watermelehhhh', '2021-12-12', 1, 3, 1),
(2, 5, 'So fresh!', 'Fresh and delicious', '2021-12-15', 2, 2, 2),
(3, 5, 'Most worth value!', 'Will buy it again!', '2021-12-18', 3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `SellerID` int NOT NULL AUTO_INCREMENT,
  `SellerName` varchar(30) NOT NULL,
  `SellerEmail` varchar(255) NOT NULL,
  `SellerPassword` varchar(128) NOT NULL,
  `SellerTelephone` varchar(12) NOT NULL,
  `SellerPhoto` varchar(255) NOT NULL,
  `ShopName` varchar(30) NOT NULL,
  `SellerAddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SellerDescription` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `JoinDate` date NOT NULL,
  `SellerRating` int DEFAULT NULL,
  PRIMARY KEY (`SellerID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`SellerID`, `SellerName`, `SellerEmail`, `SellerPassword`, `SellerTelephone`, `SellerPhoto`, `ShopName`, `SellerAddress`, `SellerDescription`, `JoinDate`, `SellerRating`) VALUES
(1, 'Wong Da Yuu', 'unclebigfish@gmail.com', 'unclebigfish123', '0124230333', 'image/wongdayuu_1.jpg', 'Uncle Big Fish', 'Jalan Skudai 2, 68100 Cheras, Wilayah Persekutuan', 'Halo uncle and nephews. This is your uncle. Uncle Big Fish. Sell good good fish', '2021-11-24', 5),
(2, 'Lee Wang Lei', 'madamprawn@gmail.com', 'madamprawn123', '0123437233', 'image/leewanglei_1.jpg', 'Madam Prawn', 'Jalan Bintang Impian, 71000 Port Dickson, Negeri Sembilan', 'This is Madam Prawn\'s prawn shop. I am a professional prawn rearer from Port Dickson.', '2021-11-28', 5),
(3, 'Muhammad Aizzul Bin Firdaus', 'aizull2048@gmail.com', 'someStrongPassword123', '0128760366', 'image/firdaus.jpg', 'The Golden Local Farm', 'Jalan Ultraman 3, 52000 Cheras, Kuala Lumpur', 'Yo guys! This is your man Aizzul. Welcome to the golden local farm where fresh vegetables, fruits and delicious animal products can be found!', '2021-12-10', 4),
(4, 'Mr Boom', 'brightchiah@gmail.com', 'brightchiah123', '0129992233', 'image/mrboom.jpg', 'BIKILI boom', 'Jalan Boom, 123, Bunga hari 123', 'Sell many organic food!', '2022-01-03', 0),
(5, 'Im Nani', 'idk@gmail.com', '1231231231', '01233232323', 'image/missnani.jpg', 'AUNTY NANI KORE', '123, Jalan nani korek, 123222, Bunga hari', 'What kind of fish, aunty Nani oso ada sell. Dont shy, be kind, just buy!', '2022-01-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE IF NOT EXISTS `subcategory` (
  `SubCategoryID` char(6) NOT NULL,
  `SubCategoryName` varchar(30) NOT NULL,
  `CategoryID` char(6) NOT NULL,
  PRIMARY KEY (`SubCategoryID`),
  KEY `CategoryID` (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`SubCategoryID`, `SubCategoryName`, `CategoryID`) VALUES
('BEA', 'Bean & Nut', 'ORGACA'),
('FIS', 'Fish', 'FISHCA'),
('FRU', 'Fruit', 'ORGACA'),
('LOB', 'Lobster & Crab', 'FISHCA'),
('MEA', 'Meat', 'ORGACA'),
('MUS', 'Mushroom', 'ORGACA'),
('OCT', 'Squid & Octopus', 'FISHCA'),
('PRN', 'Prawn', 'FISHCA'),
('SHL', 'Shell Fish', 'FISHCA'),
('VEG', 'Vegetable', 'ORGACA');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`CustID`) REFERENCES `customer` (`CustID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CartID`) REFERENCES `cart` (`CartID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `seller` (`SellerID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`SubCategoryID`) REFERENCES `subcategory` (`SubCategoryID`);

--
-- Constraints for table `productcartlist`
--
ALTER TABLE `productcartlist`
  ADD CONSTRAINT `productcartlist_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
  ADD CONSTRAINT `productcartlist_ibfk_2` FOREIGN KEY (`CartID`) REFERENCES `cart` (`CartID`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
  ADD CONSTRAINT `rating_ibfk_3` FOREIGN KEY (`CartID`) REFERENCES `cart` (`CartID`),
  ADD CONSTRAINT `rating_ibfk_4` FOREIGN KEY (`CustID`) REFERENCES `customer` (`CustID`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
