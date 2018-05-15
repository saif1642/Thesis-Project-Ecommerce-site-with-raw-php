-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2017 at 02:04 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `ad_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subcat_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `subloc_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `condition` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `post_time` datetime NOT NULL,
  `phone_num` varchar(14) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `negotiable` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`ad_id`, `user_id`, `cat_id`, `subcat_id`, `location_id`, `subloc_id`, `role`, `caption`, `description`, `condition`, `price`, `post_time`, `phone_num`, `image_url`, `negotiable`) VALUES
(7, 1, 13, 20, 2, 14, 'member', 'Pet cat for sale', 'Very friendly cat Very friendly catVery friendly catVery friendly catVery friendly catVery friendly catVery friendly catVery friendly catVery friendly catVery friendly catVery friendly catVery friendly catVery friendly catVery friendly cat', 'New', 15000, '2017-11-08 09:48:35', '01911311309', 'ads/5a027e93dcee01.78683753.png', 'yes'),
(8, 1, 8, 14, 5, 26, 'member', 'House for sale!', 'BIg house with low cost  BIg house with low cost BIg house with low cost BIg house with low cost BIg house with low cost BIg house with low cost BIg house with low cost BIg house with low cost BIg house with low cost BIg house with low cost ', 'Used', 15000000, '2017-11-08 09:50:17', '21411241412', 'ads/5a027ef9050e73.54985710.png', 'no'),
(9, 1, 7, 7, 1, 8, 'member', 'Brand new Toyota car ', ' Picture dekhe bivranto hoben na Picture dekhe bivranto hoben naPicture dekhe bivranto hoben naPicture dekhe bivranto hoben naPicture dekhe bivranto hoben naPicture dekhe bivranto hoben naPicture dekhe bivranto hoben naPicture dekhe bivranto hoben naPictu', 'New', 7500000, '2017-11-08 09:52:48', '214214', 'ads/5a027f90627aa1.85766342.jpeg', 'no'),
(10, 1, 6, 2, 5, 29, 'member', 'Desktop Pc for sale', 'Motherboard: Original Intel\r\nâœ…Processor: Dual Core 2.50gh\r\nâœ…Ram 2GB \r\nâœ…Hard Disk 250GB \r\nâœ…Monitor Samsung LED -19\" \r\nâœ…Keyboard USB\r\nâœ…Mouse USB\r\nâœ…Poewr Supply\r\nâœ…Power Cable\r\n\r\nâœ…à¦¯à§‹à¦—à¦¾à¦¯à§‹à¦—\r\nà¦•à¦®à§à¦ªà¦¿à¦‰à¦Ÿà¦¾à¦° à¦¹à§‹à¦®\r', 'New', 20000, '2017-11-08 09:55:04', '78782141212', 'ads/5a028018db4816.99946087.png', 'no'),
(11, 9, 6, 1, 1, 5, 'dealer', 'Book for sale', 'fadasfadasdas', 'Used', 20, '2017-11-27 12:31:19', '01911311303', 'ads/5a1bb1378c4094.05428162.jpg', 'no'),
(12, 9, 6, 1, 2, 11, 'dealer', 'something', 'adhbakhdakdha', 'New', 200, '2017-11-27 05:29:11', '019913', 'ads/5a1bf70766f6e9.28106696.jpeg', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `name`, `description`, `icon`) VALUES
(6, 'Electronics', 'Find great deals for used electronics in Bangladesh including mobile phones, computers, laptops, TVs, cameras and much more.', 'images/59f3b45f3d6a12.36497595.png'),
(7, 'Vehicles', 'Buy and sell used cars, motorbikes and other vehicles in Bangladesh. Choose from top brands including Toyota, Nissan, Honda and Suzuki.', 'images/59f3b48f76f909.23257287.png'),
(8, 'Properties', 'View listings for property in Bangladesh. Find the cheapest rates for apartments, commercial and residential properties, as well as for land and plots.', 'images/59f3b4c2396ce7.46013366.png'),
(9, 'Services', 'Browse through a range of service offerings to businesses and consumers alike.', 'images/59f3b4e7010dd4.44406673.png'),
(10, 'Utensils', 'Buy and sell new and used home appliances including furniture, kitchen items, gardening products and other items for your garden.', 'images/59f3b548cec426.35770303.png'),
(12, 'Hobby,Sports', 'Buy and sell used musical instruments, sports gear and accessories, art and collectibles and items for kids here', 'images/59f3b7278714e0.99188339.png'),
(13, 'Pets', 'Search from the widest variety of pets in Bangladesh . Select from dogs, puppies, cats, kittens, birds and other domesticated animals.', 'images/59f3b78a26cd60.19783221.png'),
(14, 'Others', 'Classified ads for miscellaneous products and items all over Bangladesh. Buy and sell almost anything.', 'images/59f3b7b9e85748.60406780.png'),
(15, 'Dressings, Health and beauty', 'Buy and sell clothing, garments, shoes and other personal items including handbags, perfumes, children\'s toys and hand made items in Bangladesh.', 'images/59f3b850c229f8.78596349.png');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `name`) VALUES
(4, 'Barisal'),
(2, 'Chittagong'),
(1, 'Dhaka'),
(6, 'Khulna'),
(5, 'Rajshahi'),
(3, 'Sylhet');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `orderer` varchar(255) NOT NULL,
  `phone` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `ad_id`, `orderer`, `phone`) VALUES
(1, 11, 'ahnaf', '01911231231'),
(2, 12, 'ahnaf', '0199');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `r_id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`r_id`, `ad_id`, `email`, `description`) VALUES
(1, 8, 'aust@gmail.com', 'fraud'),
(4, 10, 'aust@gmail.com', 'bad'),
(5, 10, 'aust@gmail.com', 'asfas'),
(6, 9, 'aust@gmail.com', 'bad'),
(7, 11, 'ahnaf@gmail.com', 'bad book'),
(8, 11, 'aust@gmail.com', 'bal');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcat_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcat_id`, `cat_id`, `subname`) VALUES
(1, 6, 'mobile/accessories'),
(2, 6, 'computer/tablet'),
(3, 6, 'computer accessories'),
(4, 6, 'tv'),
(5, 6, 'camera'),
(6, 6, 'others'),
(7, 7, 'car'),
(8, 7, 'motor bike'),
(9, 7, 'cycle'),
(10, 7, 'Bus'),
(11, 7, 'tractor'),
(12, 7, 'parts'),
(13, 8, 'flat'),
(14, 8, 'house'),
(15, 8, 'commercial space'),
(16, 15, 't-shirts'),
(17, 15, 'cosmetics'),
(20, 13, 'Cat'),
(21, 13, 'Dog'),
(22, 13, 'Pigeon');

-- --------------------------------------------------------

--
-- Table structure for table `sublocations`
--

CREATE TABLE `sublocations` (
  `subloc_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sublocations`
--

INSERT INTO `sublocations` (`subloc_id`, `location_id`, `name`) VALUES
(1, 1, 'Khilgaon'),
(3, 1, 'Meradia'),
(4, 1, 'Dhanmondi'),
(5, 1, 'Tejgaon'),
(6, 1, 'Mirpur'),
(7, 1, 'Shantinagar'),
(8, 1, 'Gulistan'),
(9, 2, 'Agrabad'),
(10, 2, 'Chawkbazar'),
(11, 2, 'Halishahar'),
(12, 2, 'Nasirabad'),
(13, 2, 'Chandgaon'),
(14, 2, 'Anderkilla'),
(15, 2, 'Anwara'),
(16, 2, 'Baizid'),
(17, 2, 'Bandar'),
(18, 2, 'Bakolia'),
(19, 2, 'Boalkhali'),
(20, 2, 'Banskhali'),
(21, 2, 'CDA Avenue'),
(22, 5, 'Shaheb Bazar'),
(23, 5, 'Lakshmipur'),
(24, 5, 'Motihar'),
(25, 5, 'Uposahar'),
(26, 5, 'Kazla'),
(27, 5, 'Baolia'),
(28, 5, 'Bosepara'),
(29, 5, 'Kazihata'),
(30, 5, 'Nawdapara'),
(31, 5, 'Rajpara'),
(32, 5, 'Shiroil'),
(33, 5, 'Rani Nagar');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `join_date` datetime NOT NULL,
  `ban_status` tinyint(4) NOT NULL,
  `ban_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `phone`, `location`, `join_date`, `ban_status`, `ban_time`) VALUES
(1, 'ahnaf ahmad shoumik', 'aust@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'member', '01911311309', 'Dhaka', '2017-10-29 04:10:57', 0, NULL),
(2, 'ahnaf22', 'orebaba@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'dealer', '1321', 'Dhaka', '2017-10-29 04:10:49', 0, NULL),
(3, 'ooooo', 'aust@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'member', '123', 'Dhaka', '2017-10-29 04:10:51', 0, NULL),
(4, 'ahnaf ahmad shoumik', 'aaust@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'member', '01911311309', 'Dhaka', '2017-10-29 04:10:12', 0, NULL),
(5, 'ahnaf', 'austce@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'member', '1141', 'Dhaka', '2017-10-29 04:57:23', 0, NULL),
(6, 'shiraj ud doula', 'mirjaforkhubkharap@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'dealer', '01931139441', 'Dhaka', '2017-10-29 08:46:37', 0, NULL),
(7, 'ahnaf ahmad', 'aeust@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'dealer', '01911311309', 'Dhaka', '2017-10-29 07:22:44', 0, NULL),
(8, 'Tarek Ahmed Dewanbagi', 'tarekhuzur@gmail.com', '10ed13c7afc59016276f8364e2451aa0', 'dealer', '019231412414', 'Dhaka', '2017-10-30 02:23:20', 0, NULL),
(9, 'ahnaf', 'ahnaf@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'dealer', '01911311303', 'Dhaka', '2017-11-27 12:29:13', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`ad_id`),
  ADD KEY `user_id` (`user_id`,`cat_id`,`subcat_id`,`location_id`,`subloc_id`),
  ADD KEY `FK_catid` (`cat_id`),
  ADD KEY `FK_subcatid` (`subcat_id`),
  ADD KEY `FK_locationid` (`location_id`),
  ADD KEY `FK_sublocid` (`subloc_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `ad_id` (`ad_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `ad_id` (`ad_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`subcat_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `sublocations`
--
ALTER TABLE `sublocations`
  ADD PRIMARY KEY (`subloc_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `subcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `sublocations`
--
ALTER TABLE `sublocations`
  MODIFY `subloc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD CONSTRAINT `FK_catid` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_locationid` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_subcatid` FOREIGN KEY (`subcat_id`) REFERENCES `subcategories` (`subcat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_sublocid` FOREIGN KEY (`subloc_id`) REFERENCES `sublocations` (`subloc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_AD` FOREIGN KEY (`ad_id`) REFERENCES `advertisements` (`ad_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `FK_REP_AD` FOREIGN KEY (`ad_id`) REFERENCES `advertisements` (`ad_id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sublocations`
--
ALTER TABLE `sublocations`
  ADD CONSTRAINT `FK_location_id` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
