-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 05:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noblehome`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `name`, `email`, `phone`, `date_time`, `created_at`, `status`) VALUES
(11, 'Art Lorenz Jimenez', 'noblehomeconst.ph@gmail.com', '09382041746', '2025-05-02 17:30', '2025-04-24 05:06:16', 'approved'),
(12, 'Lebron James', 'noblehomeconst.ph@gmail.com', '09685916544', '2025-05-07 15:00', '2025-04-24 05:23:38', 'approved'),
(13, 'Lolo Bronny ', 'jinggoyestrada@gmail.com', '099132421651', '2025-06-21 12:52', '2025-04-25 22:09:21', 'approved'),
(15, 'test12333', 'noblehomeconst.ph@gmail.com', '09685916544', '2025-04-30 12:00', '2025-04-26 02:14:45', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `name`, `email`, `phone`, `message`, `created_at`, `product_name`, `is_read`) VALUES
(17, 'lucky day', 'artpogi@gmail.com', '09913242651', '123123213213asdasdasd', '2025-04-22 23:53:09', 'SPC flooring', 1),
(18, 'Lebron James', 'noblehomeconst.ph@gmail.com\n', '09123546789', 'hello i would like to order', '2025-04-23 00:55:12', 'Ceiling Panel', 1),
(20, 'Kyrie Irving', 'lorenzjimenez22@gmail.com', '9913242651', 'testing lang', '2025-04-25 04:11:48', 'contact', 1),
(21, 'Steph Curry', 'james.harden@hotmail.com', '99132421651', 'basketball', '2025-04-25 04:13:32', 'contact', 1),
(22, 'James Hardin tagalog', 'kidkulafoo@gmail.com', '09913242651', 'Magandang araw po!\r\n\r\nAko po si James Hardin at interesado akong malaman ang higit pang detalye tungkol sa isa sa inyong mga produkto. Maaari po ba akong humingi ng karagdagang impormasyon ukol sa availability, presyo, at shipping options?\r\n\r\nMaraming sal', '2025-04-25 22:07:53', 'WPC Indoor Fluted Wall Panel ', 1),
(23, 'Art Lorenz Brrrr', 'bpldomestics@gmail.com', '09685916544', '123', '2025-04-26 02:14:14', 'PVC Ceiling Panel', 1),
(24, 'test123', 'test123@gmail.com', '9913242651', 'test123', '2025-04-26 02:15:14', 'contact', 1),
(25, 'noblehome', 'bpldomestics@gmail.com', '09685916544', 'hello!', '2025-04-26 03:59:54', 'Laminated Board', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_replies`
--

CREATE TABLE `inquiry_replies` (
  `id` int(11) NOT NULL,
  `inquiry_id` int(11) DEFAULT NULL,
  `reply_message` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiry_replies`
--

INSERT INTO `inquiry_replies` (`id`, `inquiry_id`, `reply_message`, `created_at`) VALUES
(1, 18, 'hello', '2025-04-24 02:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `unit_of_measure` varchar(255) NOT NULL,
  `weight` varchar(55) NOT NULL,
  `material_type` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `category`, `brand_name`, `description`, `unit_of_measure`, `weight`, `material_type`, `image`, `image2`, `image3`) VALUES
(18, 'Laminated Board', 'Board', 'Noblehome', 'Durable and waterproof board, ideal for marine applications. Resistant to saltwater and extreme weather conditions, perfect for use in boat construction, docks, and other outdoor structures.', 'Piece', '15 kg', 'Marine-grade plywood or composite', '680ad979a3d87.jpg', '680ad979a4565.png', '2.png'),
(19, 'PVC Ceiling Panels', 'Ceiling Materials', 'Noblehome', 'Durable and lightweight ceiling panel, 250mm wide and 7mm thick, ideal for residential and commercial interiors. Waterproof, termite-proof, and easy to install.', 'Piece', '1.2 kg', 'Polyvinyl Chloride (PVC)', '680ae15f6421b.jpg', '680ae15f64991.jpg', '680ae15f64f71.jpg'),
(22, 'WPC Indoor Fluted Wall Panel ', 'Wall Cladding / Decorative Panels', 'Noblehome', 'Elegant and durable WPC fluted panel designed for interior walls. Size: 219mm wide x 26mm thick. Offers a natural wood-like appearance with modern acoustic benefits. Ideal for living rooms, offices, and commercial interiors. Water-resistant, termite-resistant, and eco-friendly.\r\n', 'Piece', '3.8 kg', 'Wood-Plastic Composite (WPC)', '680ae4454f60a.jpg', 'asasd.jpg', ''),
(23, 'WPC Outdoor Wall Cladding', 'Exterior Wall Cladding', 'Noblehome', 'Weather-resistant WPC wall cladding designed for exterior walls and facades. Size: 219mm wide x 26mm thick. Combines the appearance of natural wood with the durability of plastic. UV-protected, termite-proof, low maintenance, and environmentally friendly—perfect for villas, resorts, and commercial exteriors.', 'Piece', '4.2 kg', 'Wood-Plastic Composite (WPC)', '680ae58476298.jpg', '680ae5847686f.jpg', '680ae58476e6d.jpg'),
(24, 'WPC Timber', 'Decking / Structural Timber', 'Noblehome', 'Heavy-duty WPC timber plank ideal for both indoor and outdoor applications such as decking structures, pergolas, fences, and architectural details. Size: 100mm x 50mm. Resistant to rot, insects, and moisture. Maintains a natural wood look with less maintenance. Eco-friendly and easy to work with using conventional tools.', 'Piece', '5.5 kg', 'Wood-Plastic Composite (WPC)', '680ae7dc27735.jpg', '680ae7dc2846e.jpg', ''),
(25, 'WPC Decorative Tube', 'Decorative Tube / Structural Profiles', 'Noblehome', 'Hollow-core WPC tube used for indoor and outdoor architectural accents, fencing, screens, and partitions. Size: 50mm x 100mm. Lightweight, durable, water- and UV-resistant. Gives a modern wooden aesthetic with easy maintenance. Ideal for exterior facades or indoor accent designs.\r\n', 'Piece', '3.2 kg', 'Wood-Plastic Composite (WPC)', '680ae8b2f33bc.jpg', '680ae8b2f41cd.jpg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry_replies`
--
ALTER TABLE `inquiry_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inquiry_id` (`inquiry_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `inquiry_replies`
--
ALTER TABLE `inquiry_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inquiry_replies`
--
ALTER TABLE `inquiry_replies`
  ADD CONSTRAINT `inquiry_replies_ibfk_1` FOREIGN KEY (`inquiry_id`) REFERENCES `inquiry` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
