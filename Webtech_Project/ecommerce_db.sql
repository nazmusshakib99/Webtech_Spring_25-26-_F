-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 09:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `parent_id`) VALUES
(1, 'Smartphone', 'smartphone.jpg', NULL),
(2, 'Electronics', 'electronics.jpg', NULL),
(3, 'Fashion', 'fashion.jpg', NULL),
(4, 'Books', 'book.jpg', NULL),
(5, 'Sports', 'sport.jpg', NULL),
(6, 'Beauty', 'beauty.jpg', NULL),
(7, 'Baby Care', 'babycare.jpg', NULL),
(8, 'Kitchen Appliances', 'kitchen.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shipping_address` text NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Processing','Shipped','Delivered','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `shipping_address`, `payment_method`, `total_amount`, `status`, `created_at`) VALUES
(1, 2, 'Dhaka', 'Cash', 950.00, 'Delivered', '2026-05-17 20:34:01'),
(2, 2, 'dhaka', 'Cash', 950.00, 'Delivered', '2026-05-17 20:37:18'),
(3, 3, 'Shakib', 'Cash', 1900.00, 'Delivered', '2026-05-17 21:53:56'),
(4, 2, 'Dhaka', 'Cash', 850.00, 'Delivered', '2026-05-17 21:55:24'),
(5, 2, 'Dhaka,Bangladesh', 'Cash', 950.00, 'Processing', '2026-05-17 22:01:31'),
(6, 2, 'Dhaka', 'Cash', 850.00, 'Delivered', '2026-05-17 22:08:49'),
(7, 2, 'Dhaka', 'Cash', 999.99, 'Delivered', '2026-05-17 23:32:30'),
(8, 2, 'Dhaka', 'Cash', 950.00, 'Delivered', '2026-05-17 23:36:17'),
(9, 2, 'Dhaka', 'Cash', 999.99, 'Delivered', '2026-05-18 04:39:48'),
(10, 2, 'Dhaka', 'Cash', 999.99, 'Delivered', '2026-05-18 04:42:00'),
(11, 2, 'Ctg', 'Cash', 999.99, 'Delivered', '2026-05-18 04:42:43'),
(12, 2, 'Dhaka', 'Cash', 999.99, 'Delivered', '2026-05-18 04:46:03'),
(13, 2, 'Dhaka', 'Cash', 999.99, 'Processing', '2026-05-18 04:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`) VALUES
(1, 1, 29, 1, 950.00),
(2, 2, 29, 1, 950.00),
(3, 3, 29, 2, 950.00),
(4, 4, 28, 1, 850.00),
(5, 5, 29, 1, 950.00),
(6, 6, 28, 1, 850.00),
(7, 7, 27, 1, 999.99),
(8, 8, 30, 1, 950.00),
(9, 9, 27, 1, 999.99),
(10, 10, 27, 1, 999.99),
(11, 11, 27, 1, 999.99),
(12, 12, 27, 1, 999.99),
(13, 13, 27, 1, 999.99);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock_qty` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `stock_qty`, `image`, `is_available`) VALUES
(10, 1, 'Samsung Galaxy S24', 'This Smartphone was released on 24 January 2024. It features a Qualcomm SM8650-AC Snapdragon 8 Gen 3 (4 nm). It is paired with 8GB of RAM and 128GB of phone storage. The device runs on Android 14, One UI 6.1.', 999.99, 5, 'uploads/galaxys24', 1),
(27, 1, 'Laptop 103', 'Gaming Laptop ', 999.99, 5, 'laptop.jpg', 1),
(28, 1, 'Dell Laptop 1', 'Core i5 Laptop', 850.00, 3, 'dell.jpg', 1),
(29, 1, 'HP Laptop', 'Gaming Laptop', 950.00, 3, 'hp.jpg', 1),
(30, 1, 'Iphone 15', 'Pro Max', 950.00, 9, 'Home View nn.jpg', 1),
(32, 1, 'Galaxy S26 Ultra 5G', 'Dimensions: 163.6 × 78.1 × 7.9 mm | Weight: 214 g | Build: Gorilla Armor 2 front, Victus 2 back, Aluminum frame | SIM: · Nano-SIM + Nano-SIM + eSIM + eSIM (max 2 at a time) - INT, Nano-SIM + eSIM + eSIM (max 2 at a time) - USA, Nano-SIM + Nano-SIM - CN', 850.00, 10, '1779083905_S26.jpg.webp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(1, 27, 2, 4, 'Good Product With Best Quality', '2026-05-18 05:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `shipping_addresses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`shipping_addresses`)),
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password_hash`, `phone`, `role`, `shipping_addresses`, `remember_token`, `created_at`) VALUES
(1, 'Nazmus Shakib', 'shakib13', 'nazmusshakib252@gmail.com', '$2y$10$xONKddKeRKDH/9BLnkwBP.9SgsUDdBeC.qqvmlTBH4VdRGlYT/JHO', '01632974313', 'customer', NULL, NULL, '2026-05-15 18:23:04'),
(2, 'Farid Uddinn', 'farid37', 'farid012uddin@gmail.com', '$2y$10$TECVOOzUcGHtM1d73t1GUunAneAhZkDdoryd7VEnTiXxFTIGRxRD6', '01623069937', 'customer', '[\"Dhaka\",\"\"]', '6be83fe1dd221202158ca38cf6d50537c79f404770cc302717cd7bdaf944348e', '2026-05-16 07:23:06'),
(3, 'Rohan Islam', 'rohan', 'rohan@gmail.com', '$2y$10$e.RfE7UlnviqeSnwvrzawOx6gAi68pfv8RUO2.3PwEtDX4DWUDZ8O', '01852639852', 'admin', NULL, '6c68d66ff49b1e1d2d8634d9f9b962496be6fe43f72964a2e85994e8ab80e780', '2026-05-16 08:28:40'),
(4, 'Hasnat Safar', 'safat27', 'safat@gmail.com', '$2y$10$jTDWu/d7haQJU/JLvpl4sO2EcCurz3Xy5LeTMhdkdxgMFGGOoRA7O', '01639430927', 'customer', NULL, NULL, '2026-05-17 22:22:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_review` (`user_id`,`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
