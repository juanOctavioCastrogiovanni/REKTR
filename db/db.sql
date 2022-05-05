-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-03-2022 a las 13:30:30
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Base de datos diseñada por Juan Octavio Castrogiovanni.
-- Database designed by Juan Octavio Castrogiovanni

--
-- Base de datos: `database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla `categories`
-- `categories` table structure
--


CREATE DATABASE `tecnology`;
USE `tecnology`;


CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- datos para la tabla `categories`
-- data for table `categories`

INSERT INTO `categories` (`categoryId`, `name`) VALUES
(1, 'Cameras'),
(2, 'Cards'),
(3, 'Card reader');


-- --------------------------------------------------------

--
-- Estructura de tabla `brands`
-- `brands` table structure

CREATE TABLE `brands` (
  `brandId` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- datos para la tabla `brands`
-- data for table `brands`

INSERT INTO `brands` (`brandId`, `name`) VALUES
(1, 'Nikon'),
(2, 'Sony'),
(3, 'SandDisk'),
(4, 'Jahovans'),
(5, 'Smartq');

-- --------------------------------------------------------

--
-- Estructura de tabla `products`
-- `products` table structure

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` double NOT NULL,
  `brand` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `stock` int(6) NOT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image1` tinytext DEFAULT NULL,
  `image2` tinytext DEFAULT NULL,
  `image3` tinytext DEFAULT NULL,
  `new` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- datos para la tabla `products`
-- data for table `products`

INSERT INTO `products` (`productId`, `name`, `price`, `brand`, `category`, `stock`, `short_description`, `description`, `image1`, `image2`, `image3`, `new`) VALUES
(1, 'A7', 1199.99, 2, 1, 50, "Sony A7 has a 24.0MP Full frame (35.8 x 23.9 mm ) sized CMOS sensor and
 features Bionz X processor. You can shoot at maximum resolution of 6000 x 4000 pixels with aspect 
 ratios of 3:2 and 16:9. A7 has a native ISO range of 50 - 25600 and it can save files in RAW format
  which gives you a wider room for post processing." , "The Sony Alpha 7 is a full-frame E-mount
   mirrorless camera. The A7 is very similar to its more expensive sibling (the A7R), except that 
   it uses a 24 megapixel CMOS sensor with on-chip phase detection. The A7 twins are the smallest 
   and lightest full-frame cameras on the market. While the cameras can use any E-mount lens, there
    will be a crop factor involved (unless you don't mind vignetting). Sony is producing a new line
     of FE-series lenses that take advantage of the larger sensor. The A7's use the new Sony Bionz 
     X processor, which produces images with better detail, less noise, and reduced diffraction. 
     Other features include a 3-inch, tilting LCD, XGA OLED electronic viewfinder, Multi-interface
      (hot) shoe, Wi-Fi with NFC, and 1080/60p video recording." ,'a7-front.jpeg', 'a7-up.webp', NULL, 1),

(2, 'D90', 599.99, 1, 1, 50,"The Nikon D90 is a 12.3 megapixel digital single-lens reflex camera (DSLR) 
model announced by Nikon on August 27, 2008. It is a prosumer model that replaces the Nikon D80, fitting
 between the company's entry-level and professional DSLR models. It has a Nikon DX format crop sensor.",
 "Some of the improvements the D90 offers over the D80 include 12.3 megapixel resolution, extended light
  sensitivity capabilities, live view and automatic correction of lateral chromatic aberration. The D90 
  is the first DSLR to offer video recording, with the ability to record HD 720p videos, with mono sound,
   at 24 frames per second.Unlike less expensive models such as the D40, D60, D3000 and D5000, the D90 
   has a built in autofocus motor, which means that all Nikon F-mount autofocus-lenses (the only 
   exceptions being the AF-80mm f/2.8 Nikkor and the AF-200mm f/3.5 Nikkor, designed for the rare Nikon 
   F3AF) can be used in autofocus mode.The Nikon D90 is the first Nikon camera to include a third 
   firmware module, labeled which provides an updateable lens distance integration database that 
   improves autoexposure functions. Some of its accessories, such as the MB-D80 battery grip and ML-L3
   wireless remote, are also compatible with its predecessor the D80. It supports Global Positioning 
   System integration for automatic location tagging of photographs, using a GPS receiver sold
    separately.", 'D90_front.webp', 'D90_back.webp', 'D90_left.webp', 0),

(3, 'D610', 1299.99, 1, 1, 50,"The Nikon D610 is a minor upgrade to the company's full-frame (FX-format)
 D600. New features include slightly faster burst shooting, new 'quiet continuous' mode, and improved
  auto white balance.","The rest of the features are unchanged. They include a full-frame 24 megapixel 
  CMOS sensor, 39-point AF system, 3.2-inch LCD, large optical viewfinder, dual memory card slots, 
  and high-end video recording features.", 'D610-front.webp', 'D610-left.webp', 'D610-side.webp', 1),

(4, 'D7000', 699.99, 1, 1, 50,"Amazing photography isn’t only about what you shoot and how 
you shoot it, it’s also about what you shoot it with.","The high resolution, multi-featured 
Nikon D7000 gives you 16.2 megapixels of vividly detailed images, a more sensitive DX-format
 CMOS sensor that delivers high ISO with low noise, plus various automatic and customizable 
 settings to take your pictures and videos from great to gorgeous. Shoot up to 6 fps or record
  every second of the action with full HD 1080p D-Movies with Nikon’s advanced autofocus 
  system to impress and inspire. Whether you want to make large prints or crop tightly in an 
  image, the D7000 delivers the resolution you need. At its heart is a DX-format CMOS image
   sensor with 16.2 effective megapixels, optimally engineered to gather more quality light 
   through sharp NIKKOR lenses. Coupled with 14-bit A/D conversion (12-bit selectable), 
   the D7000 produces stunning images that are richer in tone and detail than previously 
   possible in DX format. The D7000 is equipped to help you creat", 'D7000_front.webp', 
   'D7000_left.webp', 'D7000_side.webp', 0),

(5, 'Model S', 19.99, 4, 3, 300 , NULL, NULL, 'jahovans.jpg', NULL, NULL, 0),
(6, 'Model T', 14.99, 5, 3, 249, NULL , NULL, 'smartq.jpg', NULL, NULL, 0),
(7, '32gb', 9.99, 3, 2, 125,"microSD is a type of removable flash memory card 
used for storing information. SD is an abbreviation of Secure Digital, and microSD
 cards are sometimes referred to as µSD or uSD. The cards are used in mobile phones 
 and other mobile devices.","It is the smallest memory card that can be bought; at 
 15 mm × 11 mm × 1 mm (about the size of a fingernail), it is about a quarter of the
  size of a normal-sized SD card.[2] There are adapters that make the small microSD
   able to fit in devices that have slots for standard SD, miniSD, Memory Stick Duo
    card, and even USB. But, not all of the different cards can work together. Many 
    microSD cards are sold with a standard SD adapter, so that people can use them in 
    devices that take standard SD but not microSD cards. TransFlash and microSD cards
     are the same (they can be used in place of each other), but microSD has support
      for SDIO mode. This lets microSD slots support non-memory jobs like Bluetooth, 
      GPS, and Near Field Communication by attaching a device in place of a memory card.",
       'sandisk-32gb.jpg', NULL, NULL, 0),

(8, '64gb', 19.99, 3, 2, 200,"microSD is a type of removable 
flash memory card used for storing information. SD is an abbreviation of Secure Digital, 
and microSD cards are sometimes referred to as µSD or uSD.[1] The cards are used in mobile
 phones and other mobile devices.","It is the smallest memory card that can be bought; at 
 15 mm × 11 mm × 1 mm (about the size of a fingernail), it is about a quarter of the size 
 of a normal-sized SD card.[2] There are adapters that make the small microSD able to fit 
 in devices that have slots for standard SD, miniSD, Memory Stick Duo card, and even USB. 
 But, not all of the different cards can work together. Many microSD cards are sold with 
 a standard SD adapter, so that people can use them in devices that take standard SD but
  not microSD cards. TransFlash and microSD cards are the same (they can be used in place
   of each other), but microSD has support for SDIO mode. This lets microSD slots support
    non-memory jobs like Bluetooth, GPS, and Near Field Communication by attaching a device
     in place of a memory card.", 'sandisk-64gb.jpg', NULL, NULL, 1),

(9, '128gb', 99.99, 3, 2, 164,"The SD card debuted in 1999 and is the successor to the 
now-obsolete MultiMediaCard (MMC). ","The SD card debuted in 1999 and is the successor 
to the now-obsolete MultiMediaCard (MMC). It was one of a number of competing memory card
 formats in use by consumer electronics, such as Sony's defunct Memory Stick and the 
 CompactFlash card, which, while still in use, is much less common than it was in decades past. 
 ", 'sandisk-128gb.webp', NULL, NULL, 1);
 
 
 
 

-- --------------------------------------------------------

--
-- Estructura de tabla `users`
-- `users` table structure

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` text NOT NULL,
  `activation` text NOT NULL,
  `state` tinyint(1) DEFAULT 0,
  `admin` tinyint(1) DEFAULT 0,
  `clave` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- datos para la tabla `users`
-- data for table `users`

INSERT INTO `users` (`userId`, `firstname`, `lastname`, `email`, `pass`, `activation`, `state`,`admin`,`clave`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '$2y$10$zYH5CY5M17DYsC0zPCABu.acQphxUEZFBkss/RjUhOu4j8EFlIRV.', '0d3ccb5cb418d3d648bfbc768fabd1b1', 1, 1, null);

INSERT INTO `users` (`userId`, `firstname`, `lastname`, `email`, `pass`, `activation`, `state`,`admin`,`clave`) VALUES
(2, 'Palermo', 'Tv', 'palermotv.up@gmail.com', '$2y$10$wQ1RmUcBNIaN2Z3eemOTneSLpn2qkpGknXyZzjp2rceh5ygjyBpDG', '76572eff69a3f54cc18d52c4bfb4e216', 1, 0, '111111111');


 -- ---------------------------------------------------------------------
 
 
   -- carts
  CREATE TABLE `carts` (
  `cartId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `date` DATE,
  `sale` tinyint(1) DEFAULT 0,
  `products` int(11),
  `total` FLOAT(6,2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `user` (`userId`);
  
ALTER TABLE `carts`
MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


-- --------------------------------------------------------------------------------------

--
CREATE TABLE `productsCarts` (
  `productCartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `qty` int(11),
  `subtotal` FLOAT(6,2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
ALTER TABLE `productsCarts`
  ADD PRIMARY KEY (`productCartId`),
  ADD KEY `product` (`productId`),
  ADD KEY `cart` (`cartId`);
  
ALTER TABLE `productsCarts`
MODIFY `productCartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

  
 -- -------------------------------------------------------------------------------------------------------------------------------- 
  

ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);


--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`BrandId`);

--

ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `brand` (`brand`),
  ADD KEY `category` (`Category`);

--

ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`);

--

ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `brands`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;


ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
  
  
-- relationship foreign key
  
ALTER TABLE `productsCarts`
  ADD CONSTRAINT `productsCarts_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productsCarts_ibfk_2` FOREIGN KEY (`cartId`) REFERENCES `carts` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE;
  


ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand`) REFERENCES `brands` (`BrandId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
