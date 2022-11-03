-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2022 at 07:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `cart` (
  `SNO` int(11) NOT NULL,
  `CART_ID` int(11) NOT NULL,
  `USER ID` int(11) NOT NULL,
  `DISH_ID` int(11) NOT NULL,
  `REST_ID` int(11) NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `ORDERED` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `dishes` (
  `DISH_ID` bigint(20) NOT NULL,
  `DISH_NAME` varchar(20) NOT NULL,
  `CUISINE` varchar(20) NOT NULL,
  `TIME` int(11) NOT NULL,
  `VEG/NON-VEG` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dishes` (`DISH_ID`, `DISH_NAME`, `CUISINE`, `TIME`, `VEG/NON-VEG`) VALUES
(1, 'IDLI', 'SOUTH INDIAN', 1001, 'V'),
(2, 'DOSA', 'SOUTH INDIAN', 1001, 'V'),
(3, 'POORI', 'SOUTH INDIAN', 1000, 'V'),
(4, 'PONGAL', 'SOUTH INDIAN', 1001, 'V');

CREATE TABLE `restaurant` (
  `SNO` int(11) NOT NULL,
  `REST_NAME` varchar(30) NOT NULL,
  `REST_ID` int(11) NOT NULL,
  `REST_CITY` varchar(30) NOT NULL,
  `REST_ADD` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `restaurant` (`SNO`, `REST_NAME`, `REST_ID`, `REST_CITY`, `REST_ADD`) VALUES
(1, 'M A M', 1, 'CHENNAI', 'NO:1,DUBAI KURUKKU SANDHU,DUBAI MAIN ROAD,COFFEE.NAGAR,CHENN');

CREATE TABLE `restaurant dishes list` (
  `SNO` int(11) NOT NULL,
  `REST_ID` int(11) NOT NULL,
  `DISH_NAME` varchar(20) NOT NULL,
  `DISH_ID` int(11) NOT NULL,
  `DISH_PRICE` int(11) NOT NULL,
  `DISH_DESCRIPTION` varchar(150) NOT NULL,
  `RATING` int(11) NOT NULL,
  `TOP_RATED_DISH` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `restaurant dishes list` (`SNO`, `REST_ID`, `DISH_NAME`, `DISH_ID`, `DISH_PRICE`, `DISH_DESCRIPTION`, `RATING`, `TOP_RATED_DISH`) VALUES
(1, 1, 'DOSA', 2, 35, 'DOSA IS A SOUTH INDIAN DISH MADE UP RICE AND LENTIL.IT IS USUALLY SERVED WITH SAMBHAR AND CHUTNEY.', 5, 'T');

CREATE TABLE `user` (
  `S NO` bigint(11) NOT NULL,
  `USER ID` bigint(7) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(8) NOT NULL,
  `EMAIL` varchar(40) NOT NULL,
  `PHONE NUMBER` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `address` (
  `S NO` bigint(11) NOT NULL,
  `USER ID` bigint(7) NOT NULL,
  `ADDRESS 1` varchar(30) NOT NULL,
  `ADDRESS 2` varchar(30) NOT NULL,
  `CITY` varchar(15) NOT NULL,
  `REGION` varchar(15) NOT NULL,
  `POSTAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `order` (
  `SNO` int(11) NOT NULL,
  `ORDER_ID` int(11) NOT NULL,
  `CART_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `address` (`S NO`, `USER ID`, `ADDRESS 1`, `ADDRESS 2`, `CITY`, `REGION`, `POSTAL`) VALUES
(15, 0, '98/22, Hospital Colony', 'MetturDam', 'Salem', 'INDIA', 636401);

ALTER TABLE `address`
  ADD PRIMARY KEY (`S NO`);

ALTER TABLE `address`
  MODIFY `S NO` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

ALTER TABLE `cart`
  ADD PRIMARY KEY (`SNO`);

ALTER TABLE `dishes`
  ADD UNIQUE KEY `DISH_ID` (`DISH_ID`),
  ADD UNIQUE KEY `DISH_NAME` (`DISH_NAME`);

ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`SNO`),
  ADD UNIQUE KEY `REST_ID` (`REST_ID`),
  ADD UNIQUE KEY `REST_ADD` (`REST_ADD`);

ALTER TABLE `restaurant dishes list`
  ADD PRIMARY KEY (`SNO`);

ALTER TABLE `user`
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD UNIQUE KEY `PHONE NUMBER` (`PHONE NUMBER`);

ALTER TABLE `cart`
  MODIFY `SNO` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `dishes`
  MODIFY `DISH_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `restaurant`
  MODIFY `SNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `restaurant dishes list`
  MODIFY `SNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `order`
  MODIFY `ORDER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `order`
  ADD PRIMARY KEY (`ORDER_ID`);

COMMIT;