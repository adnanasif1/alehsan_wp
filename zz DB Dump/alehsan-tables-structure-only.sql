-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2018 at 10:12 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `al-ehsan`
--

-- --------------------------------------------------------

--
-- Table structure for table `jk_zememailsystem_accountreceiveables`
--

CREATE TABLE `jk_zememailsystem_accountreceiveables` (
  `id` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `totalsale` bigint(20) NOT NULL DEFAULT '0',
  `totalcashin` bigint(20) NOT NULL DEFAULT '0',
  `balance` int(11) NOT NULL DEFAULT '0',
  `lastsale` date NOT NULL,
  `lastcashin` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jk_zememailsystem_accountreceiveables`
--

INSERT INTO `jk_zememailsystem_accountreceiveables` (`id`, `customerid`, `totalsale`, `totalcashin`, `balance`, `lastsale`, `lastcashin`) VALUES
(1, 1, 2172212, 399, 2171813, '2018-10-18', '2018-10-26'),
(2, 2, 105, 0, 105, '2017-04-14', '2017-04-02'),
(3, 3, 572, 0, 572, '2017-04-12', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `jk_zememailsystem_cashreceived`
--

CREATE TABLE `jk_zememailsystem_cashreceived` (
  `id` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `cashin` mediumint(9) NOT NULL,
  `cashindate` date NOT NULL,
  `description` varchar(70) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jk_zememailsystem_cashreceived`
--

INSERT INTO `jk_zememailsystem_cashreceived` (`id`, `customerid`, `cashin`, `cashindate`, `description`, `status`, `created`) VALUES
(2, 1, 5, '2017-04-04', '', 1, '2017-04-08 16:53:04'),
(3, 1, 50, '2017-04-13', '', 1, '2017-04-08 18:58:37'),
(4, 1, 344, '2018-10-26', 'fds', 1, '2018-10-18 16:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `jk_zememailsystem_customers`
--

CREATE TABLE `jk_zememailsystem_customers` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `shopname` varchar(70) NOT NULL,
  `emailaddress` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(70) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jk_zememailsystem_customers`
--

INSERT INTO `jk_zememailsystem_customers` (`id`, `name`, `shopname`, `emailaddress`, `mobile`, `phone`, `address`, `status`, `created`) VALUES
(1, 'Adnan', '', '', '', '', '', 1, '2017-03-30 09:22:48'),
(2, 'ehsan', '', '', 'mobile', 'phone', '', 1, '2017-03-30 09:22:58'),
(3, 'sufyan', '', '', '', '', '', 1, '2017-03-30 09:23:05'),
(4, 'aaa', '', '', '', '', '', 1, '2017-03-30 16:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `jk_zememailsystem_employees`
--

CREATE TABLE `jk_zememailsystem_employees` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `advance` mediumint(9) NOT NULL,
  `reference` varchar(70) NOT NULL,
  `referencephone` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `joiningdate` date NOT NULL,
  `leavedate` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jk_zememailsystem_employees`
--

INSERT INTO `jk_zememailsystem_employees` (`id`, `name`, `phone`, `advance`, `reference`, `referencephone`, `address`, `joiningdate`, `leavedate`, `status`, `created`) VALUES
(1, 'sufi', '', 0, '', '031526548', '', '2017-03-08', '0000-00-00', 1, '2017-03-31 10:16:31'),
(2, 'fdfd', '', 0, '', '', '', '2017-04-11', '0000-00-00', 1, '2017-04-02 09:06:07'),
(3, 'fdfds', '', 0, '', '', '', '2017-04-20', '0000-00-00', 1, '2017-04-02 09:06:14'),
(4, 'hgfgfgf', '', 0, '', '', '', '2017-04-20', '0000-00-00', 1, '2017-04-02 09:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `jk_zememailsystem_expenseitemnames`
--

CREATE TABLE `jk_zememailsystem_expenseitemnames` (
  `id` int(11) NOT NULL,
  `itemname` varchar(70) NOT NULL,
  `ordering` int(11) NOT NULL,
  `isdefault` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jk_zememailsystem_expenseitemnames`
--

INSERT INTO `jk_zememailsystem_expenseitemnames` (`id`, `itemname`, `ordering`, `isdefault`, `status`, `created`) VALUES
(1, 'Acid', 2, 0, 1, '2017-04-02 06:34:58'),
(7, 'Greec', 7, 0, 1, '2017-04-02 06:40:37'),
(3, 'Firewood', 4, 0, 1, '2017-04-02 06:35:15'),
(4, 'Ribits', 3, 0, 1, '2017-04-02 06:35:22'),
(5, 'Saucepan Handles', 6, 0, 1, '2017-04-02 06:36:18'),
(6, 'Caustic Soda', 5, 0, 1, '2017-04-02 06:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `jk_zememailsystem_expenses`
--

CREATE TABLE `jk_zememailsystem_expenses` (
  `id` int(11) NOT NULL,
  `expenseitemnameid` int(11) NOT NULL,
  `expensetypeid` int(11) NOT NULL,
  `note` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `expensedate` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jk_zememailsystem_expenses`
--

INSERT INTO `jk_zememailsystem_expenses` (`id`, `expenseitemnameid`, `expensetypeid`, `note`, `price`, `expensedate`, `status`, `created`) VALUES
(1, 1, 1, 'gfdg', 300, '2017-02-09', 1, '2017-02-09 16:11:11'),
(2, 4, 5, '', 54, '2017-04-18', 1, '2017-04-02 09:04:25'),
(3, 1, 2, 'fd', 434, '2017-04-25', 1, '2017-04-02 09:04:37'),
(4, 1, 2, '', 43435, '2017-04-12', 1, '2017-04-02 09:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `jk_zememailsystem_expensetypes`
--

CREATE TABLE `jk_zememailsystem_expensetypes` (
  `id` int(11) NOT NULL,
  `itemname` varchar(50) NOT NULL,
  `ordering` int(11) NOT NULL,
  `isdefault` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jk_zememailsystem_expensetypes`
--

INSERT INTO `jk_zememailsystem_expensetypes` (`id`, `itemname`, `ordering`, `isdefault`, `status`, `created`) VALUES
(1, 'Electricity Bill', 2, 0, 1, '2017-04-02 06:07:47'),
(2, 'Rent', 1, 0, 1, '2017-04-02 06:08:08'),
(3, 'Repair', 4, 0, 1, '2017-04-02 06:08:40'),
(4, 'Machinary', 5, 0, 1, '2017-04-02 06:08:52'),
(5, 'Gathyali', 3, 0, 1, '2017-04-02 06:09:18'),
(6, 'Markiting', 6, 0, 1, '2017-04-02 06:32:01'),
(7, 'Utilities Bills', 7, 0, 1, '2017-04-02 06:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `jk_zememailsystem_phonebook`
--

CREATE TABLE `jk_zememailsystem_phonebook` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jk_zememailsystem_phonebook`
--

INSERT INTO `jk_zememailsystem_phonebook` (`id`, `name`, `mobile`, `address`, `status`, `created`) VALUES
(1, 'ali', '0346-6033151', 'pakis zin daba mian sansi rad stree no qq', 1, '2017-04-07 19:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `jk_zememailsystem_purchaseitemnames`
--

CREATE TABLE `jk_zememailsystem_purchaseitemnames` (
  `id` int(11) NOT NULL,
  `itemname` varchar(70) NOT NULL,
  `ordering` int(11) NOT NULL,
  `isdefault` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jk_zememailsystem_purchaseitemnames`
--

INSERT INTO `jk_zememailsystem_purchaseitemnames` (`id`, `itemname`, `ordering`, `isdefault`, `status`, `created`) VALUES
(4, 'shopper', 3, 0, 1, '2017-02-09 15:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `jk_zememailsystem_purchases`
--

CREATE TABLE `jk_zememailsystem_purchases` (
  `id` int(11) NOT NULL,
  `purchaseitemnameid` int(11) NOT NULL,
  `note` varchar(150) NOT NULL,
  `quantity` float NOT NULL,
  `rate` smallint(6) NOT NULL,
  `unit` tinyint(1) NOT NULL,
  `total` mediumint(9) NOT NULL,
  `purchasedate` date NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jk_zememailsystem_purchases`
--

INSERT INTO `jk_zememailsystem_purchases` (`id`, `purchaseitemnameid`, `note`, `quantity`, `rate`, `unit`, `total`, `purchasedate`, `status`, `created`) VALUES
(3, 4, '', 166, 7200, 2, 32022, '2015-12-15', 1, '2017-01-11 18:13:05'),
(4, 4, '', 149, 52, 1, 7748, '2015-11-11', 1, '2017-01-11 18:14:14'),
(5, 4, '', 1223.3, 7900, 2, 258924, '2015-12-19', 1, '2017-01-11 18:16:21'),
(6, 4, '', 1210.7, 7900, 2, 256257, '2015-12-19', 1, '2017-01-11 18:17:16'),
(7, 0, '', 390.5, 7200, 2, 75330, '2015-12-19', 1, '2017-01-11 18:17:44'),
(8, 4, '', 389.4, 58, 1, 22585, '2015-12-19', 1, '2017-01-11 18:18:31'),
(9, 0, '', 237.9, 7200, 2, 45892, '2015-12-23', 1, '2017-01-11 18:20:06'),
(10, 0, '', 1000, 33, 1, 33000, '2015-12-29', 1, '2017-01-11 18:20:51'),
(11, 0, '', 1482.4, 7900, 2, 313765, '2015-12-29', 1, '2017-01-11 18:22:00'),
(12, 0, '', 50, 40, 1, 2000, '2017-01-03', 1, '2017-01-11 18:23:13'),
(13, 0, '', 858.8, 7600, 2, 174871, '2017-01-04', 1, '2017-01-11 18:23:36'),
(14, 0, '', 1011.7, 7900, 2, 214136, '2017-01-12', 1, '2017-01-11 18:24:41'),
(15, 0, '', 2100, 9, 1, 18900, '2017-01-16', 1, '2017-01-11 18:25:26'),
(16, 0, '', 801.1, 7800, 2, 167415, '2017-03-06', 1, '2017-01-11 18:29:12'),
(17, 0, '', 583, 26, 1, 15158, '2017-03-16', 1, '2017-01-11 18:31:23'),
(18, 0, '', 1071, 7200, 2, 206602, '2017-03-27', 1, '2017-01-11 18:31:49'),
(19, 0, '', 561.5, 23, 1, 12915, '2017-04-26', 1, '2017-01-11 18:34:12'),
(20, 0, '', 384.6, 7800, 2, 80374, '2017-04-27', 1, '2017-01-11 18:35:30'),
(21, 0, '', 60, 40, 1, 2400, '2017-05-10', 1, '2017-01-11 18:37:05'),
(22, 0, '', 598.6, 7150, 2, 114671, '2017-05-19', 1, '2017-01-11 18:37:51'),
(23, 0, 'dani adnan', 5, 5, 1, 25, '2017-02-07', 1, '2017-02-07 16:31:26'),
(29, 4, '', 329.1, 43, 2, 379, '2017-04-19', 1, '2017-04-02 16:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `jk_zememailsystem_salaries`
--

CREATE TABLE `jk_zememailsystem_salaries` (
  `id` int(11) NOT NULL,
  `employeeid` int(11) NOT NULL,
  `details` varchar(100) NOT NULL,
  `salary` mediumint(9) NOT NULL,
  `amount` tinytext,
  `salarydate` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jk_zememailsystem_salaries`
--

INSERT INTO `jk_zememailsystem_salaries` (`id`, `employeeid`, `details`, `salary`, `amount`, `salarydate`, `status`, `created`) VALUES
(1, 1, 'desc', 8, '[\"4\",\"4\"]', '2017-01-03', 1, '2017-04-01 08:35:18'),
(4, 1, 'bohat zayada advance', 1300, '[\"1300\"]', '2017-03-15', 1, '2017-04-01 16:56:44'),
(5, 1, '', 4, '[\"4\"]', '2017-02-15', 1, '2017-04-01 17:59:47'),
(6, 1, '', 5, '[\"5\"]', '2017-03-15', 1, '2017-04-01 18:00:00'),
(7, 1, '', 5, '[\"5\"]', '2017-05-17', 1, '2017-04-01 18:00:13'),
(8, 1, 'desc', 753, '[\"4\",\"4\",\"4\",\"454\",\"54\",\"233\"]', '2017-05-10', 1, '2017-04-01 08:35:18'),
(12, 1, 'bohat zayada advance', 1300, '[\"1300\"]', '2017-03-15', 1, '2017-04-01 16:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `jk_zememailsystem_saleitemnames`
--

CREATE TABLE `jk_zememailsystem_saleitemnames` (
  `id` int(11) NOT NULL,
  `itemname` varchar(70) NOT NULL,
  `ordering` int(11) NOT NULL,
  `isdefault` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jk_zememailsystem_saleitemnames`
--

INSERT INTO `jk_zememailsystem_saleitemnames` (`id`, `itemname`, `ordering`, `isdefault`, `status`, `created`) VALUES
(1, 'Saada Set', 1, 0, 1, '2017-02-07 18:06:27'),
(2, 'Palshe Saada', 2, 0, 1, '2017-02-07 18:06:54'),
(3, 'Saucepan', 3, 0, 1, '2017-02-07 18:07:24'),
(4, 'Dhakan', 4, 0, 1, '2017-02-07 18:07:39'),
(5, 'Taala', 5, 0, 1, '2017-02-07 18:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `jk_zememailsystem_sales`
--

CREATE TABLE `jk_zememailsystem_sales` (
  `id` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `saleitemnameid` int(11) NOT NULL,
  `description` varchar(65) NOT NULL,
  `quantity` float NOT NULL DEFAULT '0',
  `rate` smallint(6) NOT NULL DEFAULT '0',
  `carriage` mediumint(9) NOT NULL DEFAULT '0',
  `total` mediumint(9) NOT NULL DEFAULT '0',
  `saledate` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jk_zememailsystem_sales`
--

INSERT INTO `jk_zememailsystem_sales` (`id`, `customerid`, `saleitemnameid`, `description`, `quantity`, `rate`, `carriage`, `total`, `saledate`, `status`, `created`) VALUES
(1, 1, 2, '', 100, 20, 0, 2000, '2017-04-08', 1, '2017-04-08 14:23:31'),
(2, 1, 2, '', 5, 7900, 100, 39600, '2017-04-07', 1, '2017-04-08 14:23:49'),
(3, 2, 2, '', 1, 5, 100, 105, '2017-04-14', 1, '2017-04-08 14:24:06'),
(4, 3, 3, '', 1, 7, 150, 157, '2017-04-08', 1, '2017-04-08 14:24:27'),
(5, 3, 2, '', 45, 7, 100, 415, '2017-04-12', 1, '2017-04-08 14:25:05'),
(6, 1, 4, 'Hdjxjkchksx', 34, 67, 0, 2278, '2017-04-12', 1, '2017-04-08 18:02:02'),
(7, 1, 2, '', 1000, 356, 300, 356300, '2018-10-10', 1, '2018-10-18 16:32:54'),
(8, 1, 1, '', 4000, 443, 34, 1772034, '2018-10-18', 1, '2018-10-18 16:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `jk_zememailsystem_settings`
--

CREATE TABLE `jk_zememailsystem_settings` (
  `settingname` varchar(60) NOT NULL,
  `settingvalue` varchar(260) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jk_zememailsystem_settings`
--

INSERT INTO `jk_zememailsystem_settings` (`settingname`, `settingvalue`) VALUES
('zem_solutions_url', 'www.zemsolutions.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jk_zememailsystem_accountreceiveables`
--
ALTER TABLE `jk_zememailsystem_accountreceiveables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`customerid`);

--
-- Indexes for table `jk_zememailsystem_cashreceived`
--
ALTER TABLE `jk_zememailsystem_cashreceived`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jk_zememailsystem_customers`
--
ALTER TABLE `jk_zememailsystem_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jk_zememailsystem_employees`
--
ALTER TABLE `jk_zememailsystem_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jk_zememailsystem_expenseitemnames`
--
ALTER TABLE `jk_zememailsystem_expenseitemnames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jk_zememailsystem_expenses`
--
ALTER TABLE `jk_zememailsystem_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jk_zememailsystem_expensetypes`
--
ALTER TABLE `jk_zememailsystem_expensetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jk_zememailsystem_phonebook`
--
ALTER TABLE `jk_zememailsystem_phonebook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jk_zememailsystem_purchaseitemnames`
--
ALTER TABLE `jk_zememailsystem_purchaseitemnames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jk_zememailsystem_purchases`
--
ALTER TABLE `jk_zememailsystem_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jk_zememailsystem_salaries`
--
ALTER TABLE `jk_zememailsystem_salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jk_zememailsystem_saleitemnames`
--
ALTER TABLE `jk_zememailsystem_saleitemnames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jk_zememailsystem_sales`
--
ALTER TABLE `jk_zememailsystem_sales`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jk_zememailsystem_accountreceiveables`
--
ALTER TABLE `jk_zememailsystem_accountreceiveables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jk_zememailsystem_cashreceived`
--
ALTER TABLE `jk_zememailsystem_cashreceived`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jk_zememailsystem_customers`
--
ALTER TABLE `jk_zememailsystem_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jk_zememailsystem_employees`
--
ALTER TABLE `jk_zememailsystem_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jk_zememailsystem_expenseitemnames`
--
ALTER TABLE `jk_zememailsystem_expenseitemnames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `jk_zememailsystem_expenses`
--
ALTER TABLE `jk_zememailsystem_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jk_zememailsystem_expensetypes`
--
ALTER TABLE `jk_zememailsystem_expensetypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `jk_zememailsystem_phonebook`
--
ALTER TABLE `jk_zememailsystem_phonebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jk_zememailsystem_purchaseitemnames`
--
ALTER TABLE `jk_zememailsystem_purchaseitemnames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jk_zememailsystem_purchases`
--
ALTER TABLE `jk_zememailsystem_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `jk_zememailsystem_salaries`
--
ALTER TABLE `jk_zememailsystem_salaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `jk_zememailsystem_saleitemnames`
--
ALTER TABLE `jk_zememailsystem_saleitemnames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `jk_zememailsystem_sales`
--
ALTER TABLE `jk_zememailsystem_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
