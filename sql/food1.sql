-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-06-09 17:14:59
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `food1`
--

-- --------------------------------------------------------

--
-- 資料表結構 `drinks`
--

CREATE TABLE `drinks` (
  `drinks_id` int(11) NOT NULL,
  `ice` varchar(50) DEFAULT NULL,
  `sweet` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Salary` decimal(10,2) DEFAULT NULL,
  `Lname` varchar(50) DEFAULT NULL,
  `Script` text DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `items`
--

CREATE TABLE `items` (
  `it_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `items`
--

INSERT INTO `items` (`it_id`, `name`, `price`, `deleted`, `type`) VALUES
(2, 'noodle1', 12, NULL, 'N'),
(3, 'rice1', 10, NULL, ''),
(4, 'drink1', 15, NULL, 'D'),
(5, 'Margarita', 15, NULL, 'D'),
(6, 'Mojito', 15, NULL, 'D'),
(7, 'Martini', 30, NULL, 'D'),
(8, 'Cosmopolitan', 60, NULL, 'D'),
(9, 'Daiquiri', 100, NULL, 'D'),
(10, 'Old Fashioned', 30, NULL, 'D'),
(11, 'Manhattan', 60, NULL, 'D'),
(12, 'Pina Colada', 10, NULL, 'D');

-- --------------------------------------------------------

--
-- 資料表結構 `noodles`
--

CREATE TABLE `noodles` (
  `noodle_id` int(11) NOT NULL,
  `nood_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `address`, `description`, `date`, `payment_type`, `total`, `status`, `deleted`) VALUES
(1, 2, 'addd1', 'test', NULL, 'Cash On Delivery', 67.00, 'Cancelled by Customer', 1),
(2, 2, '12345', 'test', NULL, 'Cash On Delivery', 35.00, 'delivery', 0),
(3, 2, 'sasss', 'test', NULL, 'Cash On Delivery', 40.00, NULL, 0),
(4, 2, 'fffff', 'test', '2024-01-01 00:00:00', 'Cash On Delivery', 32.00, NULL, 0),
(5, 7, '34523', 'test', '2024-01-01 00:00:00', 'Cash On Delivery', 12.00, NULL, 0),
(6, 7, '34523', 'test', '2024-01-01 00:00:00', 'Cash On Delivery', 10.00, 'delivery', 0),
(7, 16, '626615', 'test', '2024-01-01 00:00:00', 'Cash On Delivery', 12.00, NULL, 0),
(8, 16, 'none', 'test', '2024-01-01 00:00:00', 'Cash On Delivery', 12.00, NULL, 0),
(9, 16, 'none', 'test', '2024-01-01 00:00:00', 'Cash On Delivery', 12.00, NULL, 0),
(10, 16, 'none', 'test', '2024-01-01 00:00:00', 'Cash On Delivery', 12.00, NULL, 0),
(11, 16, 'none', 'test', '2024-01-01 00:00:00', 'Cash On Delivery', 12.00, 'Cancelled by Customer', 1),
(12, 16, 'none', 'test', '2024-01-01 00:00:00', 'Cash On Delivery', 12.00, 'Cancelled by Customer', 1),
(13, 16, 'none', 'test', '2024-01-01 00:00:00', 'Cash On Delivery', 12.00, 'pickup', 0),
(14, 16, '123456', 'test', '2024-01-01 00:00:00', 'Cash On Delivery', 12.00, '<br />\r\n<b>Warning</b>:  Undefined array key ', 0),
(15, 16, 'none', 'test', '2024-01-01 00:00:00', 'Cash On Delivery', 12.00, 'pickup', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `ice` varchar(50) DEFAULT NULL,
  `sweet` varchar(50) DEFAULT NULL,
  `nood_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `item_id`, `quantity`, `price`, `ice`, `sweet`, `nood_type`) VALUES
(1, 1, 2, 1, 12.00, NULL, NULL, NULL),
(2, 1, 3, 1, 10.00, NULL, NULL, NULL),
(3, 1, 4, 3, 45.00, NULL, NULL, NULL),
(4, 2, 3, 2, 20.00, NULL, NULL, NULL),
(5, 2, 4, 1, 15.00, NULL, NULL, NULL),
(6, 3, 3, 1, 10.00, NULL, NULL, NULL),
(7, 3, 4, 2, 30.00, NULL, NULL, NULL),
(8, 4, 2, 1, 12.00, NULL, NULL, NULL),
(9, 4, 3, 2, 20.00, NULL, NULL, NULL),
(10, 5, 2, 1, 12.00, NULL, NULL, NULL),
(11, 6, 3, 1, 10.00, NULL, NULL, NULL),
(12, 7, 2, 1, 12.00, NULL, NULL, NULL),
(13, 8, 2, 1, 12.00, NULL, NULL, NULL),
(14, 9, 2, 1, 12.00, NULL, NULL, NULL),
(15, 10, 2, 1, 12.00, NULL, NULL, NULL),
(16, 11, 2, 1, 12.00, NULL, NULL, NULL),
(17, 12, 2, 1, 12.00, NULL, NULL, NULL),
(18, 13, 2, 1, 12.00, NULL, NULL, NULL),
(19, 14, 2, 1, 12.00, NULL, NULL, NULL),
(20, 15, 2, 1, 12.00, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `poster_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `tickets`
--

INSERT INTO `tickets` (`id`, `poster_id`, `subject`, `description`, `status`, `type`, `date`, `deleted`) VALUES
(1, 2, '411144', '41444cdcccccccccccccccccccc', NULL, 'Support', NULL, NULL),
(2, 7, 'ssdasd', 'asdasdasdasdweq2313434', NULL, 'Payment', NULL, NULL),
(3, 7, 'dfsdfdsfsdfweeesssssssssssss', 'dfsdfdsfsdfweeesssssssssssss', NULL, 'Payment', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `ticket_details`
--

CREATE TABLE `ticket_details` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `ticket_details`
--

INSERT INTO `ticket_details` (`id`, `ticket_id`, `user_id`, `description`, `date`) VALUES
(1, 1, 2, '41444cdcccccccccccccccccccc', NULL),
(2, 2, 7, 'asdasdasdasdweq2313434', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(50) DEFAULT 'Customer',
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `username`, `password`, `email`, `address`, `contact`, `verified`, `deleted`) VALUES
(1, NULL, '12345', 'user1', '12345', NULL, NULL, '1111111111', NULL, NULL),
(2, 'Customer', 'user1', 'user1', '123456', '198275@gmail.com', NULL, '5515551', NULL, NULL),
(3, 'Customer', 'dvwer', NULL, 'erwwerf', 'vbdfvbre', NULL, '41242745', NULL, NULL),
(4, 'Customer', 'fedgwerfgr', NULL, 'rferf', '234234', '', '155185', NULL, NULL),
(5, 'Customer', 'werfwerf', NULL, 'wefwef', 'wefwef', '', '5237453', NULL, NULL),
(6, 'Customer', 'qeqwe', NULL, '785247', 'tghr', '527', '204587', NULL, NULL),
(7, 'Customer', 'qweqwe', 'qweqwe', '12345', '123123', '34523', '45245', NULL, NULL),
(8, 'Administrator', 'Jane Smith', 'ad', '123', 'janesmith@example.com', '456 Elm St', '98654210', 1, 0),
(9, 'Customer', 'user1', 'user1', '12345', '516556', NULL, '0', NULL, NULL),
(10, 'Customer', 'user1', 'user1', '12345', '516556', NULL, '0', NULL, NULL),
(12, 'Customer', 'user2', 'user2', '12345', '4418585', NULL, '0', NULL, NULL),
(13, 'Customer', 'user2', 'user2', '12345', '4418585', NULL, '0', NULL, NULL),
(14, 'Customer', 'sddvv', 'user4', '12345', 'dfsdf', NULL, '0', NULL, NULL),
(15, 'Customer', 'sddvv', 'user4', '12345', 'dfsdf', NULL, '0', NULL, NULL),
(16, 'Customer', 'user5', 'user5', '123', 'dfsadfdf', NULL, '0', 1, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `wallet_details`
--

CREATE TABLE `wallet_details` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `cvv` varchar(4) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `wallet_details`
--

INSERT INTO `wallet_details` (`id`, `customer_id`, `number`, `cvv`, `balance`) VALUES
(1, 10, '1757704555499261', '821', NULL),
(2, 12, '287181419015431', '280', NULL),
(3, 14, '7840924847433717', '458', NULL),
(4, 16, '4488944433918952', '224', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `workschedules`
--

CREATE TABLE `workschedules` (
  `employee_id` int(11) NOT NULL,
  `day` varchar(50) NOT NULL,
  `Shift` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`drinks_id`);

--
-- 資料表索引 `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- 資料表索引 `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`it_id`);

--
-- 資料表索引 `noodles`
--
ALTER TABLE `noodles`
  ADD PRIMARY KEY (`noodle_id`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- 資料表索引 `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `user_id` (`user_id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `wallet_details`
--
ALTER TABLE `wallet_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer` (`customer_id`);

--
-- 資料表索引 `workschedules`
--
ALTER TABLE `workschedules`
  ADD PRIMARY KEY (`employee_id`,`day`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `drinks`
--
ALTER TABLE `drinks`
  MODIFY `drinks_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `items`
--
ALTER TABLE `items`
  MODIFY `it_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ticket_details`
--
ALTER TABLE `ticket_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `wallet_details`
--
ALTER TABLE `wallet_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `noodles`
--
ALTER TABLE `noodles`
  ADD CONSTRAINT `noodles_ibfk_1` FOREIGN KEY (`noodle_id`) REFERENCES `items` (`it_id`);

--
-- 資料表的限制式 `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`it_id`);

--
-- 資料表的限制式 `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD CONSTRAINT `ticket_details_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `ticket_details_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- 資料表的限制式 `wallet_details`
--
ALTER TABLE `wallet_details`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- 資料表的限制式 `workschedules`
--
ALTER TABLE `workschedules`
  ADD CONSTRAINT `workschedules_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`EmployeeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
