-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2025 at 05:40 AM
-- Server version: 5.7.37
-- PHP Version: 8.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstoredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_infos`
--

CREATE TABLE `book_infos` (
  `id` int(255) NOT NULL,
  `ISBN` int(13) NOT NULL,
  `TITLE` varchar(255) NOT NULL,
  `AUTHOR` varchar(255) NOT NULL,
  `EDITION` varchar(5) NOT NULL,
  `PUBLICATION_YEAR` year(4) NOT NULL,
  `PRICE` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_infos`
--

INSERT INTO `book_infos` (`id`, `ISBN`, `TITLE`, `AUTHOR`, `EDITION`, `PUBLICATION_YEAR`, `PRICE`) VALUES
(0, 65468456, 'Netherrealm', 'Maxim Stone', '1st', 1997, '50'),
(1, 9283459, 'New Data', 'Vamps', '68th', 2000, '78'),
(2, 22344546, 'In Water', 'Bumps', '1st', 2021, '98'),
(3, 45045056, 'The Division', 'Tom Clancy', '3rd', 2015, '73'),
(4, 752788, 'Overwatch ', 'Bli Zzard', '1st', 2016, '64'),
(5, 524165, 'Last of Us', 'Joel Naught', '1st', 2012, '81'),
(6, 6884658, 'God Of War', 'Santa Monica', '1st', 2018, '78'),
(7, 6519654, 'Invincible', 'Robert Kirkland', '1st', 2021, '93'),
(8, 687463321, 'The Boys', 'Amazo Noriginals', '1st', 2018, '54'),
(9, 35469, 'Death Of Superman', 'Newr Era', '2nd', 2015, '62'),
(10, 419498, 'The Phantom Menace', 'Gon Jin', '1st', 1999, '47'),
(11, 1898664, 'Attack Of The Clones', 'Wan Kenobi', '2nd', 2001, '69'),
(12, 697489, 'Revenge of The Sith', 'Sheev Palpatine', '3rd', 2004, '53'),
(13, 94654, 'A New Hope', 'Luke Skywalker', '4th', 1977, '27'),
(14, 546826, 'Empire Strikes Back', 'Darth Vader', '5th', 1980, '35'),
(15, 684846, 'Return Of The Jedi', 'Anakin Skywalker', '6th', 1982, '33'),
(16, 684789, 'The Clone Wars', 'George Lucas', '1st', 2008, '67'),
(17, 664828, 'The Bad Batch', 'Dave Filoni ', '3rd', 2021, '87'),
(18, 65432, 'Falcon and The Winter Soldier', 'Sam Wislon', '4th ', 2020, '82'),
(19, 2787542, 'Wanda Vision', 'Jarvis Stark', '4th', 2019, '77'),
(20, 8967468, 'Far From Home', 'Peter Parker', '2nd', 2018, '71'),
(21, 7375254, 'The Winter Solider', 'Bucky Barnes', '2nd', 2014, '54'),
(22, 56498, 'Civil War', 'Baron Zemo', '3rd', 2016, '48'),
(23, 846496, 'Endgame', 'Stephen Strange', '4th', 2019, '83'),
(25, 45245274, '**Separatists**', 'George Lucas', '3rd', 1988, '0'),
(26, 723448, 'Fallen Order', 'Cal Kestis', '1st', 2017, '73'),
(27, 321456, 'Rebellion', 'Caleb Dume', '3rd', 2014, '58'),
(28, 789654, 'Ragnarok', 'Kevin Fiege', '3rd', 2016, '56'),
(29, 321987, 'Love and Thunder', 'James Gunn', '4rd', 2010, '52'),
(30, 456927, 'Mortal Kombat', 'Lui Kang', '11th', 2019, '76');

-- --------------------------------------------------------

--
-- Table structure for table `purchased_books`
--

CREATE TABLE `purchased_books` (
  `UUID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PurchasePrice` decimal(10,2) NOT NULL,
  `CheckoutDate` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchased_books`
--

INSERT INTO `purchased_books` (`UUID`, `BookID`, `Quantity`, `PurchasePrice`, `CheckoutDate`) VALUES
(5, 8, 1, '54.00', '2011'),
(5, 7, 1, '93.00', '2011'),
(8, 10, 1, '47.00', '2011'),
(8, 14, 1, '35.00', '2011'),
(8, 30, 1, '76.00', '2011');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_carts`
--

CREATE TABLE `shopping_carts` (
  `UUID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UUID` int(11) NOT NULL,
  `FName` varchar(15) NOT NULL,
  `LName` varchar(15) NOT NULL,
  `DOB` varchar(10) NOT NULL,
  `Phone` varchar(8) NOT NULL,
  `Address` varchar(60) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Pass` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UUID`, `FName`, `LName`, `DOB`, `Phone`, `Address`, `Email`, `Username`, `Pass`) VALUES
(5, 'Jane', 'List', '22-09-2004', '617-9891', '111 Parrot Ave.', 'jlista@yahoo.com', 'Jlista1', 'parrot@!#'),
(8, 'rihanna', 'banner', '17-09-2005', '633-4544', 'burrell boom', 'rihannaree88@gmail.com', 'rih_00', 'password0!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_infos`
--
ALTER TABLE `book_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchased_books`
--
ALTER TABLE `purchased_books`
  ADD KEY `UUID` (`UUID`),
  ADD KEY `BookID` (`BookID`);

--
-- Indexes for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD KEY `UUID` (`UUID`),
  ADD KEY `BookID` (`BookID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UUID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchased_books`
--
ALTER TABLE `purchased_books`
  ADD CONSTRAINT `purchased_books_ibfk_1` FOREIGN KEY (`UUID`) REFERENCES `users` (`UUID`),
  ADD CONSTRAINT `purchased_books_ibfk_2` FOREIGN KEY (`BookID`) REFERENCES `book_infos` (`id`);

--
-- Constraints for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD CONSTRAINT `shopping_carts_ibfk_1` FOREIGN KEY (`UUID`) REFERENCES `users` (`UUID`),
  ADD CONSTRAINT `shopping_carts_ibfk_2` FOREIGN KEY (`BookID`) REFERENCES `book_infos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
