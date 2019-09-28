-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2019 at 09:00 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(10) UNSIGNED NOT NULL,
  `account_number` bigint(20) NOT NULL,
  `account_type` varchar(50) NOT NULL,
  `personal_code` varchar(20) NOT NULL,
  `current_balance` float NOT NULL,
  `currency` varchar(20) NOT NULL DEFAULT 'euro',
  `user_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_number`, `account_type`, `personal_code`, `current_balance`, `currency`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2107351569659488, 'GENERAL', '245875126', 3.8, 'euro', 3, 1, '2019-09-28 18:59:27', '2019-09-28 18:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `ac_ledger`
--

CREATE TABLE `ac_ledger` (
  `ledger_id` bigint(20) UNSIGNED NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `trid` int(11) DEFAULT NULL,
  `trcode` tinyint(4) DEFAULT NULL,
  `cr_amount` float DEFAULT 0,
  `dr_amount` float DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ac_ledger`
--

INSERT INTO `ac_ledger` (`ledger_id`, `account_id`, `trid`, `trcode`, `cr_amount`, `dr_amount`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 2107351569659488, 1, 1, 0, 49.125, 1, 3, '2019-09-28 10:39:07', '2019-09-28 16:39:07'),
(2, 2107351569659488, 1, 3, 0.875, 0, 1, 3, '2019-09-28 10:39:07', '2019-09-28 16:39:07'),
(3, 2107351569659488, 2, 1, 0, 39.3, 1, 3, '2019-09-28 10:40:56', '2019-09-28 16:40:56'),
(4, 2107351569659488, 2, 3, 0.7, 0, 1, 3, '2019-09-28 10:40:56', '2019-09-28 16:40:56'),
(5, 2107351569659488, 3, 2, 22, 0, 1, 3, '2019-09-28 11:12:18', '2019-09-28 17:12:18'),
(6, 2107351569659488, 4, 2, 22, 0, 1, 3, '2019-09-28 11:12:41', '2019-09-28 17:12:41'),
(7, 2107351569659488, 5, 2, 15, 0, 1, 3, '2019-09-28 12:45:34', '2019-09-28 18:45:34'),
(8, 2107351569659488, 6, 2, 0, 24.375, 1, 3, '2019-09-28 12:59:27', '2019-09-28 18:59:27'),
(9, 2107351569659488, 6, 3, 0.625, 0, 1, 3, '2019-09-28 12:59:27', '2019-09-28 18:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `ac_vaucher`
--

CREATE TABLE `ac_vaucher` (
  `vaucher_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` varchar(100) DEFAULT NULL COMMENT 'Unique invoice id',
  `vaucher_date` datetime NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ac_voucher_item`
--

CREATE TABLE `ac_voucher_item` (
  `vci_id` bigint(20) UNSIGNED NOT NULL,
  `vaucher_id` bigint(20) UNSIGNED NOT NULL,
  `room_no` int(10) UNSIGNED NOT NULL COMMENT 'Number of room',
  `room_type` int(10) UNSIGNED NOT NULL,
  `particular_id` smallint(6) NOT NULL,
  `amount` float NOT NULL,
  `discount` float DEFAULT 0,
  `vat` float DEFAULT 0,
  `comission` float DEFAULT 0,
  `service_charge` float DEFAULT 0,
  `total_amount` float NOT NULL DEFAULT 0,
  `currency` varchar(10) NOT NULL DEFAULT 'BDT',
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `trid` int(11) NOT NULL,
  `account_id` bigint(20) NOT NULL,
  `amount` float NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'euro',
  `trcode` tinyint(4) NOT NULL,
  `tr_time` datetime NOT NULL,
  `card_number` int(11) DEFAULT NULL,
  `card_type` varchar(20) DEFAULT NULL,
  `bank_acc_number` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`trid`, `account_id`, `amount`, `currency`, `trcode`, `tr_time`, `card_number`, `card_type`, `bank_acc_number`, `user_id`, `remarks`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 2107351569659488, 50, 'euro', 1, '2019-09-28 16:39:07', 12334, 'master', NULL, 3, NULL, 3, '2019-09-28 10:39:07', '2019-09-28 16:39:07'),
(2, 2107351569659488, 40, 'euro', 1, '2019-09-28 16:40:56', 2121212, 'master', NULL, 3, NULL, 3, '2019-09-28 10:40:56', '2019-09-28 16:40:56'),
(3, 2107351569659488, 22, 'euro', 2, '2019-09-28 17:12:18', NULL, NULL, 2323, 3, 'test', 3, '2019-09-28 11:12:18', '2019-09-28 17:12:18'),
(4, 2107351569659488, 22, 'euro', 2, '2019-09-28 17:12:41', NULL, NULL, 2323, 3, 'test', 3, '2019-09-28 11:12:41', '2019-09-28 17:12:41'),
(5, 2107351569659488, 15, 'euro', 2, '2019-09-28 18:45:34', NULL, NULL, 2323, 3, 'Test', 3, '2019-09-28 12:45:34', '2019-09-28 18:45:34'),
(6, 2107351569659488, 25, 'euro', 2, '2019-09-28 18:59:27', NULL, NULL, 3434, 3, NULL, 3, '2019-09-28 12:59:27', '2019-09-28 18:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_code`
--

CREATE TABLE `transaction_code` (
  `trcode` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction_code`
--

INSERT INTO `transaction_code` (`trcode`, `name`, `is_active`) VALUES
(1, 'Deposit', 1),
(2, 'Withdraw', 1),
(3, 'Service Change', 1),
(4, 'Vat', 1),
(5, 'Fund Transfer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `remember_token`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Abdul', 'Awal', 'awal.ashu@gmail.com', '$2y$10$r/H3FvaZiWnGtUNwxCTbTuugcHtJCoqYXyZe2FLJJkq8D93kkm8xG', 'TXJwfUjoZMwpFXKMrczLBsJkzYktRucw7vA6Xw6ZZMROx64PnM6pNM2UuT2x', 1, NULL, '2019-09-27 12:10:44'),
(3, 'Ashraf', 'Ahmed', 'ashraf@gmail.com', '$2y$10$.VYoyupk9KB8qDSE1fuKfe7XHm.P8f/xdIEuq1r.7UfsCV1nEvVV2', '7enl7cDya6xMvgJgn9R9unJpm074WEBhc48ltkzQOcX828NIdkrICqOp2lp9', 1, '2019-09-28 02:31:28', '2019-09-28 02:31:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `ac_ledger`
--
ALTER TABLE `ac_ledger`
  ADD PRIMARY KEY (`ledger_id`);

--
-- Indexes for table `ac_vaucher`
--
ALTER TABLE `ac_vaucher`
  ADD PRIMARY KEY (`vaucher_id`);

--
-- Indexes for table `ac_voucher_item`
--
ALTER TABLE `ac_voucher_item`
  ADD PRIMARY KEY (`vci_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`trid`);

--
-- Indexes for table `transaction_code`
--
ALTER TABLE `transaction_code`
  ADD PRIMARY KEY (`trcode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ac_ledger`
--
ALTER TABLE `ac_ledger`
  MODIFY `ledger_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ac_vaucher`
--
ALTER TABLE `ac_vaucher`
  MODIFY `vaucher_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ac_voucher_item`
--
ALTER TABLE `ac_voucher_item`
  MODIFY `vci_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `trid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction_code`
--
ALTER TABLE `transaction_code`
  MODIFY `trcode` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
