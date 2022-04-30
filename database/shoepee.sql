-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2022 at 04:46 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoepee`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `ID` int(11) NOT NULL,
  `BRAND_NAME` varchar(100) NOT NULL,
  `DATE_ADDED` date NOT NULL,
  `STATUS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`ID`, `BRAND_NAME`, `DATE_ADDED`, `STATUS`) VALUES
(7, 'Adidas', '2022-04-03', 'Unavailable'),
(8, 'Nike', '2022-04-03', 'Available'),
(9, 'Puma', '2022-04-03', 'Available'),
(31, 'Fila', '2022-04-03', 'Available'),
(47, 'Reebok', '2022-04-14', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `SIZE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_details`
--

CREATE TABLE `delivery_details` (
  `ID` int(11) NOT NULL,
  `ORDER_ID` int(11) NOT NULL,
  `COURIER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_details`
--

INSERT INTO `delivery_details` (`ID`, `ORDER_ID`, `COURIER_ID`) VALUES
(1, 14, 10),
(2, 15, 5),
(3, 16, 10),
(4, 17, 5),
(5, 20, 10);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `ID` int(11) NOT NULL,
  `QUESTION` varchar(500) NOT NULL,
  `ANSWER` varchar(500) NOT NULL,
  `DATE_ADDED` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`ID`, `QUESTION`, `ANSWER`, `DATE_ADDED`) VALUES
(2, 'How can I use the SHOEPEE?', 'First you must create an account, to be able to use completely the SHOPEE and its services.', '2022-04-12'),
(3, 'Does SHOEPEE only sell shoes?', 'From the name itself, Shoepee is an e-commerce website that only sale shoes.', '2022-04-12'),
(4, 'Can I cancel my order?', 'Yes you can, just go to your orders details page then select cancellation. \r\n\r\nNote: For each order, buyers can only make one cancellation request. If your request is denied or withdrawn, you will not be allowed to submit another cancellation request for the same order.\r\n', '2022-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `ID` int(11) NOT NULL,
  `ORDER_ID` int(11) NOT NULL,
  `TOTAL_QUANTITY` int(11) NOT NULL,
  `TOTAL_AMOUNT` decimal(10,0) NOT NULL,
  `DATE_CREATED` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`ID`, `ORDER_ID`, `TOTAL_QUANTITY`, `TOTAL_AMOUNT`, `DATE_CREATED`) VALUES
(8, 14, 1, '4000', '2022-04-17'),
(9, 15, 2, '2700', '2022-04-18'),
(10, 16, 4, '4498', '2022-04-19'),
(11, 17, 3, '8797', '2022-04-20'),
(12, 18, 3, '9000', '2022-04-20'),
(13, 19, 2, '2500', '2022-04-27'),
(14, 20, 3, '3750', '2022-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `AMOUNT` decimal(10,0) NOT NULL,
  `ORDER_STATUS` varchar(50) NOT NULL,
  `ORDER_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `USER_ID`, `AMOUNT`, `ORDER_STATUS`, `ORDER_DATE`) VALUES
(14, 11, '4000', 'Delivered', '2022-04-17'),
(15, 15, '2700', 'Delivered', '2022-04-18'),
(16, 15, '4498', 'Delivered', '2022-04-19'),
(17, 11, '8797', 'To Receive', '2022-04-20'),
(18, 11, '9000', 'Pending', '2022-04-20'),
(19, 11, '2500', 'Pending', '2022-04-27'),
(20, 16, '3750', 'Delivered', '2022-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `ID` int(11) NOT NULL,
  `ORDER_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `SIZE` varchar(50) NOT NULL,
  `QUANTITY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`ID`, `ORDER_ID`, `PRODUCT_ID`, `SIZE`, `QUANTITY`) VALUES
(7, 14, 12, '7', 1),
(8, 15, 11, '6', 2),
(9, 16, 4, '6', 2),
(10, 16, 13, '6', 2),
(11, 17, 14, '7', 1),
(12, 17, 3, '7', 1),
(13, 17, 4, '7', 1),
(14, 18, 10, '7', 3),
(15, 19, 13, '7', 2),
(16, 20, 13, '7', 3);

-- --------------------------------------------------------

--
-- Table structure for table `price_change`
--

CREATE TABLE `price_change` (
  `ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `AMOUNT` decimal(10,0) NOT NULL,
  `START_EFF_DATE` date NOT NULL,
  `END_EFF_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `price_change`
--

INSERT INTO `price_change` (`ID`, `PRODUCT_ID`, `AMOUNT`, `START_EFF_DATE`, `END_EFF_DATE`) VALUES
(1, 4, '999', '2022-04-14', '2022-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `PRODUCT_NAME` varchar(150) NOT NULL,
  `PRICE` decimal(10,0) NOT NULL,
  `BRAND_ID` int(11) NOT NULL,
  `DATE_ADDED` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `PRODUCT_NAME`, `PRICE`, `BRAND_ID`, `DATE_ADDED`) VALUES
(3, 'zoom freak 3 basketball shoes', '2499', 8, '2022-04-10'),
(4, 'above run men\'s running shoes', '999', 31, '2022-04-11'),
(10, 'scuderia ferrari ionspeed motorsport shoes', '3000', 9, '2022-04-15'),
(11, 'reebok nano X1 grey GW8891 52 standard', '1350', 47, '2022-04-15'),
(12, 'Adizero Boston 10 Shoes Green H67514 06 standard', '4000', 7, '2022-04-15'),
(13, 'custom nike react element 55', '1250', 8, '2022-04-15'),
(14, 'D Rose Shoes Godspeed Black GX2928 6', '5299', 7, '2022-04-20'),
(15, 'Lite Wind Women\'s Lite Running Shoes', '1399', 31, '2022-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `ID` int(11) NOT NULL,
  `TYPE` varchar(50) NOT NULL,
  `DATE_GENERATED` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`ID`, `TYPE`, `DATE_GENERATED`) VALUES
(1, 'Sales Report', '2022-04-19'),
(3, 'Sales Report', '2022-04-20'),
(4, 'Sales Report', '2022-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `ROLE_NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ID`, `ROLE_NAME`) VALUES
(1, 'admin'),
(2, 'customer'),
(3, 'courier');

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

CREATE TABLE `seo` (
  `ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `SEARCH_KEY` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seo`
--

INSERT INTO `seo` (`ID`, `PRODUCT_ID`, `SEARCH_KEY`) VALUES
(1, 3, 'black shoes'),
(3, 13, 'black shoes'),
(4, 14, 'black shoes'),
(7, 10, 'red shoes'),
(8, 4, 'white shoes'),
(9, 11, 'grey shoes'),
(10, 12, 'green shoes'),
(11, 15, 'pink shoes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `FIRSTNAME` varchar(100) NOT NULL,
  `LASTNAME` varchar(100) NOT NULL,
  `ADDRESS` varchar(150) NOT NULL,
  `AGE` int(11) NOT NULL,
  `PHONE_NUMBER` varchar(30) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `ROLE_ID` int(30) NOT NULL,
  `JOIN_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FIRSTNAME`, `LASTNAME`, `ADDRESS`, `AGE`, `PHONE_NUMBER`, `EMAIL`, `PASSWORD`, `ROLE_ID`, `JOIN_DATE`) VALUES
(5, 'Angelica', 'Ariola', 'Balogo, Oas, Albay', 21, '09322450100', 'angelicaariola@gmail.com', '87e67c1b8a7bf17e3df45ebfcfa9006a', 3, '2022-04-14'),
(10, 'Raymond', 'Reblando', 'Camagong, Oas, Albay', 21, '09451479009', 'raymondreblando32@gmail.com', '87e67c1b8a7bf17e3df45ebfcfa9006a', 3, '2022-04-15'),
(11, 'Reggie', 'Reblando', 'Camagong, Oas, Albay', 22, '09101115678', 'reggiereblando@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, '2022-04-15'),
(14, 'Raymond', 'Reblando', 'Camagong, Oas, Albay', 21, '09451479009', 'shoepeeadmin@gmail.com', '331499db7e824adfcbd9b84a22db442b', 1, '2022-04-17'),
(15, 'Angel Rose', 'Capuz', 'Balogo, Oas, Albay', 21, '09322450100', 'angelrosecapuz@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, '2022-04-18'),
(16, 'Shaina Mae', 'Alcantara', 'Tobog, Oas Albay', 21, '09111175643', 'shainamae@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, '2022-04-27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `delivery_details`
--
ALTER TABLE `delivery_details`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `price_change`
--
ALTER TABLE `price_change`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `delivery_details`
--
ALTER TABLE `delivery_details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `price_change`
--
ALTER TABLE `price_change`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seo`
--
ALTER TABLE `seo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
