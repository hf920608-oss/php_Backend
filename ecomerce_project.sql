-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2026 at 07:13 AM
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
-- Database: `ecomerce_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `userName`, `password`) VALUES
(1, 'Huzaifa', 'huzaifa1234');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `status`) VALUES
(1, 'Clothes', 1),
(2, 'Watches', 1),
(9, 'Phones', 1),
(10, 'laptops', 1),
(11, 'Hand Bags', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `addedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `name`, `email`, `mobile`, `comment`, `addedOn`) VALUES
(1, 'Huzaifa Farooq', 'hf920608@gmail.com', '03100303965', 'my name is huzafa', '0000-00-00 00:00:00'),
(2, 'Huzaifa Farooq', 'hf920608@gmail.com', '03100303965', 'my name is huzafa', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(100) NOT NULL,
  `pinCode` int(11) NOT NULL,
  `pymentType` varchar(50) NOT NULL,
  `totalAmount` float NOT NULL,
  `paymentStatus` varchar(50) NOT NULL,
  `orderStatus` int(11) NOT NULL,
  `addedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `city`, `pinCode`, `pymentType`, `totalAmount`, `paymentStatus`, `orderStatus`, `addedOn`) VALUES
(1, 1, 'lyari express way taiser town karachi', 'karachi', 16250, 'cod', 64000, 'pending', 3, '2026-02-15 17:38:23'),
(2, 1, 'lyari express way taiser town karachi', 'karachi', 16250, 'cod', 6850000, 'pending', 5, '2026-02-16 12:04:48'),
(3, 1, 'lyari express way taiser town karachi', 'karachi', 16250, 'payp', 12000, 'pending', 1, '2026-02-17 05:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `addedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `price`, `addedOn`) VALUES
(1, 1, 0, 2, 12000, '2026-02-15 17:38:23'),
(2, 1, 3, 4, 10000, '2026-02-15 17:38:23'),
(3, 2, 1, 2, 12000, '2026-02-16 12:04:48'),
(4, 2, 2, 2, 3413000, '2026-02-16 12:04:48'),
(5, 3, 1, 1, 12000, '2026-02-17 05:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'pending'),
(2, 'processing'),
(3, 'shipped'),
(4, 'cancled'),
(5, 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories` int(11) DEFAULT NULL,
  `productName` varchar(255) NOT NULL,
  `productMrp` float NOT NULL,
  `productPrice` float NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `productImage` text NOT NULL,
  `productShortDescription` text NOT NULL,
  `productDescription` text NOT NULL,
  `productMetaTitle` text NOT NULL,
  `productMetaDescription` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `productKeyword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories`, `productName`, `productMrp`, `productPrice`, `productQuantity`, `productImage`, `productShortDescription`, `productDescription`, `productMetaTitle`, `productMetaDescription`, `status`, `productKeyword`) VALUES
(1, 1, 'Arctix Women\'s Essential Insulated Ski Bibs, Water Resistant Snow Pants for Skiing & Snowboarding', 15000, 12000, 2, '51s9r9R309L._AC_UL480_FMwebp_QL65_.webp', 'About this item ARCTIX ESSENTIALS: Stay warm and dry with the Arctix Women\'s Essential Insulated Ski Bibs. These durable, water resistant snow bibs for women offer all-weather protection, lightweight insulation, and a customizable fit to keep you comfortable in the cold.', 'About this item ARCTIX ESSENTIALS: Stay warm and dry with the Arctix Women\'s Essential Insulated Ski Bibs. These durable, water resistant snow bibs for women offer all-weather protection, lightweight insulation, and a customizable fit to keep you comfortable in the cold. ALL-WEATHER WARMTH: THERMALOCK technology keeps you warm from -20°F to 35°F. Water-resistant and wind-resistant, these women\'s ski bibs provide reliable protection against snow, rain, and cold, keeping you comfortable on any snowboarding or skiing adventure. LIGHTWEIGHT & TOUGH: Made with durable polyester and THERMATECH insulation, these ski pants for women keep you warm without bulk. The lightweight design allows easy movement, while the water resistant shell protects against snow, wind, and rain for all-day comfort. EXTRA FUNCTIONALITY: Designed for convenience, these snow pants for women feature fleece-lined handwarmer pockets, an O-ring for keys or gloves, and boot gaiters with grippers to keep warmth in and moisture out. Perfect for any snow gear setup. CUSTOM FIT & EASY CARE: Adjustable shoulder straps and waist ensure a perfect fit for all-day comfort. Machine washable for hassle-free cleaning, these women’s snow bibs are built for skiing, snowboarding, and any snow clothes for women.', 'Arctix Women\'s', 'Arctix Women\'s Essential Insulated Ski Bibs, Water Resistant Snow Pants for Skiing & Snowboarding', 1, 'Women Clothes'),
(2, 2, 'Seamaster - Master Chronometer - 44mm', 3423000, 3413000, 5, 'omega-seamaster-diver-300m-21030445101001-1-product-zoom.webp', 'This Omega Seamaster - CO‑AXIAL MASTER CHRONOMETER CHRONOGRAPH watch has a 44mm stainless steel case. This model also features an automatic movement, stainless steel bracelet, sapphire crystal and a Black dial with hands and indexes are filled with white Super-LumiNova. It has a water resistance of 300m', 'This Omega Seamaster - CO‑AXIAL MASTER CHRONOMETER CHRONOGRAPH watch has a 44mm stainless steel case. This model also features an automatic movement, stainless steel bracelet, sapphire crystal and a Black dial with hands and indexes are filled with white Super-LumiNova. It has a water resistance of 300m', 'CO‑AXIAL MASTER CHRONOMETER CHRONOGRAPH watch', 'CO‑AXIAL MASTER CHRONOMETER CHRONOGRAPH watch', 1, 'watch'),
(3, 9, 'LIVELY Jitterbug Flip2 - Flip Cell Phone for Seniors - Not Compatible with Other Wireless Carriers - Must Be Activated Phone Plan - No SIM Needed - Red Flip Phone', 120000, 10000, 6, '711hxcwZUpL._AC_SX679_.jpg', 'Only Compatible with Lively Phone Service: The Jitterbug Flip2 is only compatible with Lively phone service; plans include flexible talk & text options and 24/7 access to Lively’s caring team Easy-to-Use Flip Phone: The Jitterbug Flip2 flip phone features a pre-installed SIM card, large screen, big buttons, powerful speaker, simple list-based menu and one-touch speed dial Help When You Need It: Once your new phone is activated with Lively, the Lively team is here to help if you want to learn more about your phone, need a ride, have a health concern, or an emergency Online Activation: Activate phone online for easy setup, and for additional questions, call our customer service agents for questions about your service and phone Why Lively: Lively offers Jitterbug cell phones and Lively medical alert devices that can help seniors feel connected, safe and healthy', 'Only Compatible with Lively Phone Service: The Jitterbug Flip2 is only compatible with Lively phone service; plans include flexible talk & text options and 24/7 access to Lively’s caring team Easy-to-Use Flip Phone: The Jitterbug Flip2 flip phone features a pre-installed SIM card, large screen, big buttons, powerful speaker, simple list-based menu and one-touch speed dial Help When You Need It: Once your new phone is activated with Lively, the Lively team is here to help if you want to learn more about your phone, need a ride, have a health concern, or an emergency Online Activation: Activate phone online for easy setup, and for additional questions, call our customer service agents for questions about your service and phone Why Lively: Lively offers Jitterbug cell phones and Lively medical alert devices that can help seniors feel connected, safe and healthy', 'Only Compatible with Lively Phone Service:', 'Only Compatible with Lively Phone Service:', 1, 'Phone'),
(4, 11, 'Everyday Chic Shoulder Bag - Soft Faux Leather Crescent ladies Handbag for Work & Weekends', 700, 529, 4, 'bag.jpg', 'Style: Modern Crescent (Demi-Lune) Shoulder Bag that perfectly captures the current Baguette trend.  Material: Crafted from Soft Vegan Leather for a premium look and durable everyday use.  Aesthetic: Everyday Chic Minimalist Design that easily transitions from office professionalism to casual weekend style.  Comfort: Designed to fit comfortably and securely under the arm with a perfectly tailored drop length.  Functionality: Features a secure Top Zip Closure to protect your essentials.  Important Disclaimers  Color Variation Disclaimer  Please note that while we strive to ensure our product photography is as accurate as possible, the actual color of the bag may vary slightly from what you see on your screen. This can be due to:  Monitor Settings: Different computer monitors and mobile devices have varying capabilities to display color.  Lighting: The color of the product (e.g., Navy Blue, Baby Pink) may appear different in direct sunlight versus indoor lighting.  Material Texture: The natural texture of the Faux leather can reflect light differently, affecting the perceived shade.  Size & Measurement Disclaimer  Our measurements are taken to provide the most accurate description possible, but please allow for a small tolerance.  Please allow a ±1 cm or 0.5 inch difference in measurements due to manual measurement and the flexible nature of the material.', 'Style: Modern Crescent (Demi-Lune) Shoulder Bag that perfectly captures the current Baguette trend.  Material: Crafted from Soft Vegan Leather for a premium look and durable everyday use.  Aesthetic: Everyday Chic Minimalist Design that easily transitions from office professionalism to casual weekend style.  Comfort: Designed to fit comfortably and securely under the arm with a perfectly tailored drop length.  Functionality: Features a secure Top Zip Closure to protect your essentials.  Important Disclaimers  Color Variation Disclaimer  Please note that while we strive to ensure our product photography is as accurate as possible, the actual color of the bag may vary slightly from what you see on your screen. This can be due to:  Monitor Settings: Different computer monitors and mobile devices have varying capabilities to display color.  Lighting: The color of the product (e.g., Navy Blue, Baby Pink) may appear different in direct sunlight versus indoor lighting.  Material Texture: The natural texture of the Faux leather can reflect light differently, affecting the perceived shade.  Size & Measurement Disclaimer  Our measurements are taken to provide the most accurate description possible, but please allow for a small tolerance.  Please allow a ±1 cm or 0.5 inch difference in measurements due to manual measurement and the flexible nature of the material.', 'Modern Crescent (Demi-Lune) Shoulder Bag', 'Modern Crescent (Demi-Lune) Shoulder Bag', 1, 'Bag'),
(5, 1, '1', 4, 2, 3, 'collection-page1.jpg', '5', '6', '7', '8', 0, '9'),
(6, 1, '6', 3, 7, 8, 'collection1.jpg', '7', '8', '9', '4', 0, '5'),
(7, 2, '9', 6, 8, 7, 'accessories.jpg', '8', '5', '2', '1', 0, '4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `addedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `addedOn`) VALUES
(1, 'Huzaifa Farooq', 'hf920608@gmail.com', 'huzaifa', '0310303987', '0000-00-00 00:00:00'),
(2, 'Hamza', 'Hamza@gmail.com', 'hamza', '03103254564', '0000-00-00 00:00:00'),
(3, 'Haider', 'haider@gmail.com', 'haider', '03146454664', '0000-00-00 00:00:00'),
(4, 'Tayyaba', 'Tayyaba@gmail.com', 'tayyaba', '0313564563156', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
