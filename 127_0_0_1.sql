-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2017 at 12:51 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bigshop`
--
CREATE DATABASE IF NOT EXISTS `bigshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bigshop`;

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `AboutText` text NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `AboutText`, `image`) VALUES
(1, 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.\r\n\r\nA small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', 'b1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `c_name` varchar(50) NOT NULL,
  `Address` text NOT NULL,
  `Address2` text NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Email2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `c_name`, `Address`, `Address2`, `Email`, `Email2`) VALUES
(1, 'BigShop', 'Shfaram', 'Eim Mahel', 'mahmod24@windowslive.com', 'majdi.abolil48@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `imagesproduct`
--

CREATE TABLE `imagesproduct` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imagesproduct`
--

INSERT INTO `imagesproduct` (`id`, `p_id`, `image`) VALUES
(11, 93, 'm33.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `infoproduct`
--

CREATE TABLE `infoproduct` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `size` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `count_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `infoproduct`
--

INSERT INTO `infoproduct` (`id`, `p_id`, `color`, `quantity`, `price`, `size`, `type`, `count_order`) VALUES
(60, 93, '#000000', 3, 100, 'XS', 'man', 2),
(61, 93, '#008080', 19, 150, 'XS', 'man', 6),
(62, 94, '#008080', 10, 120, 'L', 'man', 10),
(63, 94, '#0080c0', 30, 150, 'M', 'man', 12),
(64, 95, '#808080', 20, 80, 'M', 'man', 0),
(65, 95, '#ff8080', 20, 80, 'XS', 'man', 0),
(66, 96, '#800000', 30, 40, 'L', 'man', 0),
(67, 97, '#c0c0c0', 30, 120, 'S', 'man', 0),
(68, 97, '#000000', 30, 120, 'XS', 'man', 0),
(69, 98, '#ffffff', 30, 50, 'S', 'man', 0),
(70, 98, '#000000', 30, 50, 'L', 'man', 0),
(71, 99, '#ffff00', 2, 350, 'M', 'woman', 12),
(72, 100, '#000000', 30, 200, 'M', 'woman', 0),
(73, 101, '#ff0080', 15, 400, 'S', 'woman', 0),
(74, 102, '#000080', 20, 800, 'M', 'woman', 0),
(75, 104, '#ffffff', 9, 60, 'XS', 'kid', 0),
(76, 105, '#c0c0c0', 39, 30, 'XS', 'kid', 0),
(77, 106, '#8000ff', 20, 40, 'XS', 'kid', 0),
(78, 107, '#000000', 10, 22, 'XS', 'man', 0),
(79, 93, '#ff80ff', 0, 12, 'XS', 'man', 5),
(80, 93, '#ff8080', 45, 14, 'XS', 'man', 4),
(81, 93, '#00ff00', 14, 11, 'XS', 'man', 3),
(82, 93, '#ffffff', 1, 15, 'XXL', 'man', 9);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `nameProduct` varchar(50) NOT NULL,
  `typeProduct` varchar(50) NOT NULL,
  `des` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `image`, `nameProduct`, `typeProduct`, `des`) VALUES
(93, 'm3.jpg', 'Trousers', 'man', 'For men'),
(94, 'm4.jpg', 'Trousers', 'man', 'For Men'),
(95, 's1.jpg', 'Short', 'man', 'For Men'),
(96, 's2.jpg', 'Short', 'man', 'For Man'),
(97, 't1.jpg', 'Tshirt', 'man', 'For Man'),
(98, 't2.jpg', 'Tshirt', 'man', 'For Man'),
(99, 's-l1600 (2).jpg', 'Dress', 'woman', 'For Woman'),
(100, 's-l16 (2).jpg', 'Trousers', 'woman', 'For Woman'),
(101, 's-l500 (1).jpg', 'Watches', 'woman', 'For Woman'),
(102, 's-l1600.jpg', 'Dress', 'woman', 'For Woman'),
(103, 'dr.jpg', 'Dress', 'woman', 'For Woman'),
(104, 's-l1600 (1).jpg', 'Dress', 'kid', 'For Kids'),
(105, 's-l1600 (9).jpg', 'Tshirt', 'kid', 'For Kid'),
(106, 's-l500.jpg', 'Watches', 'kid', 'For Kid'),
(107, '24.jpg', 'Short', 'man', 'asa');

-- --------------------------------------------------------

--
-- Table structure for table `productorder`
--

CREATE TABLE `productorder` (
  `id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Date` text NOT NULL,
  `Time` text NOT NULL,
  `Total` int(11) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productorder`
--

INSERT INTO `productorder` (`id`, `o_id`, `p_id`, `quantity`, `Date`, `Time`, `Total`, `status`) VALUES
(100, 107, 75, 1, '2017-09-03', '12:56:12am', 60, 'Processing'),
(101, 108, 60, 1, '2017-09-04', '12:56:12am', 100, 'Processing'),
(102, 109, 60, 1, '2017-09-04', '12:56:12am', 100, 'Processing'),
(103, 110, 61, 1, '2017-09-04', '12:56:12am', 150, 'Processing'),
(104, 111, 60, 1, '2017-09-04', '12:56:12am', 100, 'Processing'),
(105, 112, 60, 1, '2017-09-04', '12:56:12am', 100, 'Processing'),
(106, 113, 60, 1, '2017-09-04', '12:56:12am', 100, 'Processing'),
(107, 114, 71, 1, '2017-09-04', '12:56:12am', 350, 'Processing'),
(108, 115, 80, 2, '2017-09-04', '12:56:12am', 28, 'Processing'),
(109, 116, 60, 10, '2017-09-04', '12:56:12am', 1000, 'Processing'),
(110, 116, 71, 5, '2017-09-04', '12:56:12am', 1750, 'Processing'),
(111, 117, 81, 1, '2017-09-04', '12:56:12am', 11, 'Processing'),
(112, 117, 75, 10, '2017-09-04', '12:56:12am', 600, 'Processing'),
(113, 118, 62, 10, '2017-09-04', '12:56:12am', 1200, 'Processing'),
(114, 118, 73, 5, '2017-09-04', '12:56:12am', 2000, 'Processing'),
(115, 118, 76, 11, '2017-09-04', '12:56:12am', 330, 'Processing'),
(116, 119, 79, 12, '2017-09-04', '12:56:12am', 144, 'Shipped'),
(117, 120, 60, 2, '2017-09-04', '12:56:12am', 200, 'Processing'),
(118, 120, 62, 10, '2017-09-04', '12:56:12am', 1200, 'Processing'),
(119, 122, 71, 12, '2017-09-04', '12:56:12am', 4200, 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `productshopingcart`
--

CREATE TABLE `productshopingcart` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Color` varchar(50) NOT NULL,
  `Size` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productshopingcart`
--

INSERT INTO `productshopingcart` (`id`, `u_id`, `p_id`, `quantity`, `Color`, `Size`, `type`, `price`) VALUES
(1, 9, 60, 1, '#000000', 'XS', 'man', 100);

-- --------------------------------------------------------

--
-- Table structure for table `productwishlist`
--

CREATE TABLE `productwishlist` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productwishlist`
--

INSERT INTO `productwishlist` (`id`, `u_id`, `p_id`) VALUES
(34, 9, 99),
(37, 9, 93);

-- --------------------------------------------------------

--
-- Table structure for table `uorder`
--

CREATE TABLE `uorder` (
  `idOrder` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uorder`
--

INSERT INTO `uorder` (`idOrder`, `u_id`) VALUES
(107, 9),
(108, 9),
(109, 9),
(110, 9),
(111, 9),
(112, 9),
(113, 9),
(114, 9),
(115, 9),
(116, 9),
(117, 9),
(118, 9),
(119, 9),
(120, 9),
(121, 9),
(122, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Pelephone` int(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `imgProfile` text NOT NULL,
  `BU` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `FirstName`, `LastName`, `Address`, `Pelephone`, `Email`, `Password`, `imgProfile`, `BU`) VALUES
(9, 'mahmod', 'sawaid', 'shafraam', 546122506, 'mahmod24@windowslive.com', '123456', 'fashion.jpg', 0),
(10, 'mm', 'mm', 'nn', 50, 'mm@gmail.com', '123456', 'image', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagesproduct`
--
ALTER TABLE `imagesproduct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `infoproduct`
--
ALTER TABLE `infoproduct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productorder`
--
ALTER TABLE `productorder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `o_id` (`o_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `productshopingcart`
--
ALTER TABLE `productshopingcart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `productwishlist`
--
ALTER TABLE `productwishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `uorder`
--
ALTER TABLE `uorder`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`,`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `imagesproduct`
--
ALTER TABLE `imagesproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `infoproduct`
--
ALTER TABLE `infoproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `productorder`
--
ALTER TABLE `productorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
--
-- AUTO_INCREMENT for table `productshopingcart`
--
ALTER TABLE `productshopingcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `productwishlist`
--
ALTER TABLE `productwishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `uorder`
--
ALTER TABLE `uorder`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `imagesproduct`
--
ALTER TABLE `imagesproduct`
  ADD CONSTRAINT `imagesproduct_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `infoproduct`
--
ALTER TABLE `infoproduct`
  ADD CONSTRAINT `infoproduct_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productorder`
--
ALTER TABLE `productorder`
  ADD CONSTRAINT `productorder_ibfk_1` FOREIGN KEY (`o_id`) REFERENCES `uorder` (`idOrder`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productorder_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `infoproduct` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productshopingcart`
--
ALTER TABLE `productshopingcart`
  ADD CONSTRAINT `productshopingcart_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productshopingcart_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `infoproduct` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productwishlist`
--
ALTER TABLE `productwishlist`
  ADD CONSTRAINT `productwishlist_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productwishlist_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uorder`
--
ALTER TABLE `uorder`
  ADD CONSTRAINT `uorder_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
