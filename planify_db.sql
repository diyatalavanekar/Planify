-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2026 at 05:52 PM
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
-- Database: `planify_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'Rasika Prakshale', 'Rasika123'),
(4, 'Diya Talavanekar', '12345678'),
(5, 'Shital Dongare', 'Shital06'),
(6, 'kranti', 'kranti123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `package_name` varchar(50) DEFAULT NULL,
  `package_price` decimal(10,2) DEFAULT NULL,
  `guests` int(11) DEFAULT NULL,
  `veg_qty` int(11) DEFAULT NULL,
  `nonveg_qty` int(11) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `advance_amount` decimal(10,2) DEFAULT NULL,
  `remaining_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `event_id`, `package_name`, `package_price`, `guests`, `veg_qty`, `nonveg_qty`, `event_date`, `total_amount`, `advance_amount`, `remaining_amount`, `status`, `booking_date`) VALUES
(5, 1, 3, 'Basic Package', 30000.00, 200, 50, 150, '2026-03-28', 168500.00, 33700.00, 134800.00, 'Confirmed', '2026-03-04 16:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `booking_food_items`
--

CREATE TABLE `booking_food_items` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `food_item_id` int(11) NOT NULL,
  `type` enum('Veg','NonVeg') NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_food_items`
--

INSERT INTO `booking_food_items` (`id`, `booking_id`, `food_item_id`, `type`, `price`) VALUES
(31, 5, 2, 'Veg', 25.00),
(32, 5, 3, 'Veg', 20.00),
(33, 5, 7, 'Veg', 60.00),
(34, 5, 9, 'Veg', 120.00),
(35, 5, 13, 'Veg', 100.00),
(36, 5, 15, 'Veg', 30.00),
(37, 5, 4, 'NonVeg', 150.00),
(38, 5, 19, 'NonVeg', 300.00),
(39, 5, 20, 'NonVeg', 250.00),
(40, 5, 23, 'NonVeg', 60.00),
(41, 5, 26, 'NonVeg', 25.00),
(42, 5, 27, 'NonVeg', 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `email`, `phone`, `address`) VALUES
(1, 'rasika@gmail.com', '7756053060', 'Maharashtra, India');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `description`, `image`) VALUES
(1, 'Wedding Event', 'Book the hall for wedding event', '1772030300_wedding.jpg'),
(2, 'Birthday Event', 'Book the hall for birthday parties', '1772031104_birthday.jpg'),
(3, 'Engagement Event', 'Book the hall for engagement event.', '1772031282_engagement.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int(11) NOT NULL,
  `type` enum('Veg','NonVeg') NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `type`, `item_name`, `price`) VALUES
(2, 'Veg', 'Roti', 25.00),
(3, 'Veg', 'Chapati', 20.00),
(4, 'NonVeg', 'Chicken Tikka', 150.00),
(5, 'Veg', 'Hara Bhara Kabab', 70.00),
(6, 'Veg', 'Veg Spring Roll', 50.00),
(7, 'Veg', 'Veg Manchurian', 60.00),
(8, 'Veg', 'Paneer Butter Masala', 110.00),
(9, 'Veg', 'Kadai Paneer', 120.00),
(10, 'Veg', 'Dal Makhani', 100.00),
(11, 'Veg', 'Malai Kofta', 120.00),
(12, 'Veg', 'Mix Veg Dewani Handi', 200.00),
(13, 'Veg', 'Veg Biryani ', 100.00),
(14, 'Veg', 'Pulao', 60.00),
(15, 'Veg', 'Tandoori Roti', 30.00),
(16, 'NonVeg', 'Murgh Malai Tikka', 160.00),
(17, 'NonVeg', 'Mutton Seekh Kebab', 180.00),
(18, 'NonVeg', 'Fish Finger', 200.00),
(19, 'NonVeg', 'Prawn Tempura', 300.00),
(20, 'NonVeg', 'Butter Chicken', 250.00),
(21, 'NonVeg', 'Chicken Tikka Masala', 70.00),
(22, 'NonVeg', 'Mutton Rogan Josh', 50.00),
(23, 'NonVeg', ' Bhuna Gosht', 60.00),
(24, 'NonVeg', 'Goan Fish Curry', 70.00),
(25, 'NonVeg', 'Mutton Dum Biryani', 180.00),
(26, 'NonVeg', 'Roti', 25.00),
(27, 'NonVeg', 'Chapati', 20.00),
(28, 'NonVeg', 'Tandoori Roti', 30.00);

-- --------------------------------------------------------

--
-- Table structure for table `food_prices`
--

CREATE TABLE `food_prices` (
  `id` int(11) NOT NULL,
  `veg_price` decimal(10,2) NOT NULL,
  `nonveg_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_prices`
--

INSERT INTO `food_prices` (`id`, `veg_price`, `nonveg_price`) VALUES
(1, 300.00, 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `package_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `package_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `event_id`, `package_name`, `description`, `package_price`) VALUES
(1, 1, 'Basic Package', 'Includes professional wedding decor, standard sound system, and core management for an intimate and beautiful celebration.', 200000.00),
(2, 1, 'Premium Package', 'A grander celebration with enhanced floral arrangements, premium catering options, professional photography, and full-day event coordination.', 500000.00),
(3, 1, 'Luxury Package', 'The ultimate royal wedding experience. Features bespoke theme decor, cinematic videography, and a dedicated personal event concierge.', 700000.00),
(4, 2, 'Basic Package', 'Perfect for intimate gatherings. Includes colorful theme decor, sound system, and fun party games to keep the energy high.', 40000.00),
(5, 2, 'Premium Package', 'Take the party up a notch with customized backdrops, professional MC/host, specialized cake-cutting ceremony, and expanded food menu.', 50000.00),
(6, 2, 'Luxury Package', 'An unforgettable birthday bash! Includes premium 3D decor, live entertainment (magicians/performers), professional photography, and personalized party favors for all guests.\"', 70000.00),
(7, 3, 'Basic Package', 'A charming and simple setup for your special \'Yes\' moment. Includes elegant stage backdrop, seating arrangements, and ambient lighting.', 30000.00),
(8, 3, 'Premium Package', 'Elevate your engagement with floral aesthetics, high-quality audio-visual setup, and a dedicated coordinator to manage the ring ceremony flow.', 50000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `created_at`) VALUES
(1, 'diyat', 'diyatalavanekar@gmail.com', '7684934958', '123456789', '2026-02-14 15:00:46'),
(3, 'shrutit', 'shrutithombare@gmail.com', '2345656789', '1234567', '2026-03-03 09:23:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_date` (`event_date`);

--
-- Indexes for table `booking_food_items`
--
ALTER TABLE `booking_food_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `food_item_id` (`food_item_id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_prices`
--
ALTER TABLE `food_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `booking_food_items`
--
ALTER TABLE `booking_food_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `food_prices`
--
ALTER TABLE `food_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_food_items`
--
ALTER TABLE `booking_food_items`
  ADD CONSTRAINT `booking_food_items_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_food_items_ibfk_2` FOREIGN KEY (`food_item_id`) REFERENCES `food_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
