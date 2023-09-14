-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 03:52 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bazaphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id_answer` int(50) NOT NULL,
  `id_survey` int(50) NOT NULL,
  `answer` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id_answer`, `id_survey`, `answer`) VALUES
(1, 1, 'Very good - 5'),
(2, 1, 'Good - 4'),
(3, 1, 'Medicore - 3'),
(4, 1, 'Bad - 2'),
(5, 1, 'Very bad - 1'),
(6, 2, 'Great expirience. Website is very intuitive.'),
(7, 2, 'It was hard for me to find my way but I managed to complete the order.  '),
(8, 2, 'I couldn\t make my order.'),
(9, 2, 'None of the above');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id_brand` int(50) NOT NULL,
  `brand_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id_brand`, `brand_name`) VALUES
(6, 'Egger Licht'),
(4, 'Fabbian'),
(2, 'Grupa'),
(8, 'Lalalallaaa22'),
(1, 'Marset'),
(3, 'Martinelli Luce'),
(5, 'Top Light');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(50) NOT NULL,
  `id_finishshop` int(50) NOT NULL,
  `id_product` int(50) NOT NULL,
  `quantity` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `id_finishshop`, `id_product`, `quantity`) VALUES
(1, 6, 2, 1),
(2, 6, 3, 1),
(3, 7, 2, 2),
(4, 8, 2, 1),
(5, 8, 3, 1),
(6, 8, 4, 2),
(7, 9, 2, 1),
(8, 9, 3, 1),
(9, 10, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(50) NOT NULL,
  `name_category` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name_category`) VALUES
(14, 'Bulbs'),
(1, 'Camera'),
(12, 'Diwali Lights'),
(11, 'LED Lights'),
(10, 'Lights'),
(13, 'Tube Lights');

-- --------------------------------------------------------

--
-- Table structure for table `finishshopping`
--

CREATE TABLE `finishshopping` (
  `id_finishshop` int(50) NOT NULL,
  `id_user` int(50) NOT NULL,
  `shopping_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `finishshopping`
--

INSERT INTO `finishshopping` (`id_finishshop`, `id_user`, `shopping_date`) VALUES
(1, 1, '2023-03-14 20:05:31'),
(2, 1, '2023-03-14 20:05:59'),
(3, 1, '2023-03-14 20:15:43'),
(4, 1, '2023-03-14 20:16:04'),
(5, 1, '2023-03-14 20:17:18'),
(6, 1, '2023-03-14 20:17:43'),
(7, 1, '2023-03-14 20:18:38'),
(8, 1, '2023-03-14 23:09:43'),
(9, 0, '2023-03-15 12:10:32'),
(10, 0, '2023-03-15 12:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(50) NOT NULL,
  `name_menu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_m` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display` tinyint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `name_menu`, `path_m`, `display`) VALUES
(1, 'Home', 'index.php', 1),
(2, 'Products', 'product.php', 1),
(3, 'Admin panel', 'admin.php', 3),
(4, 'Contact', 'contact.php', 1),
(5, 'Log in/Register', 'account.php', 0),
(6, 'Author', 'author.php', 2),
(7, 'Log out', 'logout.php', 2),
(11, 'probaaa', 'proba', 5),
(12, 'proba2', 'proba2', 5),
(13, 'proba3', 'proba3', 5);

-- --------------------------------------------------------

--
-- Table structure for table `messagecontact`
--

CREATE TABLE `messagecontact` (
  `id_message` int(50) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `datOfMessage` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messagecontact`
--

INSERT INTO `messagecontact` (`id_message`, `name`, `email`, `phone`, `subject`, `datOfMessage`) VALUES
(1, 'Aleksa', 'Aleksa', 'Aleksa', 'Aleksa', '2023-03-04 16:29:16'),
(2, 'Aleksa', 'aleksa@gmail.com', '1234567890', 'ja sam tu sam 2', '2023-03-04 16:30:56'),
(4, 'Aleksa', 'aleksaaa@gmail.com', '2234567890', 'ja sam tu sam 2', '2023-03-04 16:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `id_picture` int(50) NOT NULL,
  `path` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`id_picture`, `path`, `alt`) VALUES
(1, 'images/p8.jpg', 'Slika Barokne sijalice'),
(2, 'images/p7.jpg', 'Slika Barokne sijalice'),
(3, 'images/p12.jpg', 'Slika Barokne sijalice'),
(4, 'images/p4.jpg', 'Slika zidne lampe'),
(5, 'images/p5.jpg', 'Slika fenjera'),
(6, 'images/p3.jpg', 'Slika metalne zidne lampe'),
(7, 'images/p6.jpg', 'Slika led rekfrekotra'),
(8, 'images/p11.jpg', 'Slika zidne lampe sa dve sijalice'),
(9, 'images/ofr3.jpg', 'Slika zidnog fenjera'),
(10, 'images/p10.jpg', 'Slika metalne lampe'),
(11, 'images/p9.jpg', 'Slika nocne lampe'),
(12, 'images/p2.jpg', 'Slika led lampe');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id_price` int(50) NOT NULL,
  `price` decimal(50,0) NOT NULL,
  `date_from` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id_price`, `price`, `date_from`) VALUES
(1, '40', '2023-03-02 21:20:42.000000'),
(2, '39', '2023-03-02 21:20:42.000000'),
(3, '28', '2023-03-05 17:08:49.000000'),
(4, '25', '2023-03-05 17:08:49.000000'),
(5, '55', '2023-03-07 17:01:34.000000'),
(6, '37', '2023-03-07 17:01:34.000000'),
(7, '57', '2023-03-07 17:02:06.000000'),
(8, '27', '2023-03-06 17:02:06.000000'),
(9, '112', '2023-03-16 14:18:37.000000');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(50) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `id_category` int(50) NOT NULL,
  `id_brand` int(50) NOT NULL,
  `id_picture` int(50) NOT NULL,
  `date` datetime(6) NOT NULL,
  `id_price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `name`, `description`, `id_category`, `id_brand`, `id_picture`, `date`, `id_price`) VALUES
(2, 'Lighting Wood Carved Mop Glass Double Wall Lamp', 'The most striking feature of the Artemide Tolomeo Parete Diffusore is doubtlessly the classic lampshade which is available in two different versions: satin or parchment. The first version has an aluminium grey colour while it is switched off; however, it looks almost white as soon as the light is switched on.', 12, 1, 1, '2023-03-02 21:21:57.000000', 2),
(3, 'Lighting Wood Carved Mop Glass Single Wall Lamp', 'Lighting Wood Carved Mop Glass wall lamp impresses with its graceful forms and the timeless design that was penned by the renowned architects and designers Roberto and Ludovica Palomba.', 12, 3, 2, '2023-03-05 17:10:06.000000', 3),
(4, 'Lighting Brass Carved Mop Porcelain Single Wall La', 'Lighting Brass Carved Mop Porcelain wall lamp impresses with its graceful forms and the timeless design that was penned by the renowned architects and designers Nicole Blane.', 12, 4, 3, '2023-03-05 17:10:06.000000', 4),
(5, 'ÅRSTID', 'One of our most cherished lamp series and it’s no wonder why – it has a timeless design that fits right in. Combine several lamps from the series to create a soft, comfortable light and a unified look.', 10, 1, 6, '2023-03-10 17:31:45.000000', 6),
(6, 'BrightLyts Sherry Wall Lamp', 'This Wall fixture comes fitted with an imported B-22 bulb holder & BULB is Not INCLUDED with this lamp for the convenience of you.', 10, 6, 4, '2023-03-10 17:31:45.000000', 3),
(7, 'WALL LAMP WENTWORTH DOUBLE', 'Invite boutique hotel elegance into your furniture arrangement with the Wentworth Double Wall Lamp.', 10, 4, 8, '2023-03-10 17:41:51.000000', 5),
(8, 'Reflector BL-300UP Black', 'Our Victoria reflector, suitable for fixing to lamp posts, wall brackets and plinths for enhancing entrances, frontages and courtyard areas.', 11, 2, 7, '2023-03-10 17:57:24.000000', 7),
(9, 'Victoria Lantern', 'Ideal for all original lamp post refurbishment projects. The lantern is ideally scaled.', 11, 2, 5, '2023-03-10 17:57:24.000000', 2),
(10, 'Antique Nickel Finish', 'Throw away those old boring fabric shades and use this for your lamp.', 12, 3, 10, '2023-03-10 18:05:56.000000', 8),
(11, 'Night Lamp', 'Decor Bedside Lamp with USB Port - Touch Control Table Lamp for Bedroom Wood 3 Way Dimmable Nightstand Lamp', 10, 4, 11, '2023-03-12 23:29:35.000000', 4),
(12, 'LED Camping Lamp', 'Great LED Lamp for camping and nights in the wild.', 11, 5, 12, '2023-03-12 23:32:14.000000', 6);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(50) NOT NULL,
  `role_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Regular');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id_survey` int(50) NOT NULL,
  `question` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id_survey`, `question`, `active`) VALUES
(1, 'How do you like our website?(Give us a grade 1-5)', 1),
(2, 'What is you expirience with online shopping at our website?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `surveyvotes`
--

CREATE TABLE `surveyvotes` (
  `id_vote` int(50) NOT NULL,
  `id_user` int(50) NOT NULL,
  `id_answer` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `surveyvotes`
--

INSERT INTO `surveyvotes` (`id_vote`, `id_user`, `id_answer`) VALUES
(1, 1, 2),
(2, 1, 6),
(3, 2, 1),
(4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(50) NOT NULL,
  `firstName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `passwordCrypt` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dateOfRegistration` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_role` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `firstName`, `lastName`, `email`, `passwordCrypt`, `dateOfRegistration`, `id_role`) VALUES
(1, 'Aleksa', 'Levnajic', 'levnajic1997@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2023-03-03 16:04:56', 2),
(2, 'Aleksa', 'Levnajic', 'aleksa@gmail.com', '6eea9b7ef19179a06954edd0f6c05ceb', '2023-03-03 17:20:13', 2),
(3, 'Pera', 'Peric', 'peraperic@gmail.com', 'ee33b3bc92b59d4bae6011d118dfd78c', '2023-03-03 18:01:34', 2),
(4, 'Admin', 'Adminovic', 'admin@gmail.com', 'a66abb5684c45962d887564f08346e8d', '2023-03-04 16:45:04', 1),
(7, 'Proba', 'Proba', 'proba@gmail.com', 'debb63071d7f343d409902fcf9708666', '2023-03-16 12:06:13', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id_answer`),
  ADD KEY `id_survey` (`id_survey`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`),
  ADD UNIQUE KEY `name` (`brand_name`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`),
  ADD UNIQUE KEY `name` (`name_category`);

--
-- Indexes for table `finishshopping`
--
ALTER TABLE `finishshopping`
  ADD PRIMARY KEY (`id_finishshop`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD UNIQUE KEY `name` (`name_menu`,`path_m`);

--
-- Indexes for table `messagecontact`
--
ALTER TABLE `messagecontact`
  ADD PRIMARY KEY (`id_message`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id_picture`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id_price`),
  ADD UNIQUE KEY `price` (`price`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_picture` (`id_picture`),
  ADD KEY `id_price` (`id_price`),
  ADD KEY `id_brand` (`id_brand`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`),
  ADD UNIQUE KEY `name` (`role_name`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id_survey`),
  ADD UNIQUE KEY `question` (`question`);

--
-- Indexes for table `surveyvotes`
--
ALTER TABLE `surveyvotes`
  ADD PRIMARY KEY (`id_vote`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_answer` (`id_answer`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id_answer` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id_brand` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `finishshopping`
--
ALTER TABLE `finishshopping`
  MODIFY `id_finishshop` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `messagecontact`
--
ALTER TABLE `messagecontact`
  MODIFY `id_message` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `id_picture` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id_price` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id_survey` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surveyvotes`
--
ALTER TABLE `surveyvotes`
  MODIFY `id_vote` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`id_survey`) REFERENCES `survey` (`id_survey`) ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`id_picture`) REFERENCES `picture` (`id_picture`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`id_price`) REFERENCES `price` (`id_price`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id_brand`) ON UPDATE CASCADE;

--
-- Constraints for table `surveyvotes`
--
ALTER TABLE `surveyvotes`
  ADD CONSTRAINT `surveyvotes_ibfk_1` FOREIGN KEY (`id_answer`) REFERENCES `answer` (`id_answer`),
  ADD CONSTRAINT `surveyvotes_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
