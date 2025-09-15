-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 15, 2025 at 11:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kibo`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `entity_type` varchar(100) NOT NULL,
  `entity_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `readStatus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `entity_type`, `entity_id`, `description`, `ip_address`, `user_agent`, `created_at`, `readStatus`) VALUES
(1, 32, 'car_dealer_created', 'CarDealer', 12, 'Created new car dealer: Solomon Newton', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-12 17:44:55', 0),
(2, 32, 'lender_created', 'Lender', 18, 'Created new lender: mikochecni inst', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-13 06:25:50', 0),
(3, 32, 'car_dealer_created', 'CarDealer', 13, 'Created new car dealer: mwakin car dealer', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-13 06:41:15', 0),
(4, 32, 'lender_created', 'Lender', 19, 'Created new lender: MABUTO GROUP', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-14 07:58:34', 0),
(5, 32, 'lender_created', 'Lender', 20, 'Created new lender: TANZANITE LEED', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-14 08:13:56', 0),
(6, 32, 'lender_approved', 'Lender', 20, 'Approved lender: TANZANITE LEED', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-14 08:21:34', 0),
(7, 32, 'car_dealer_created', 'CarDealer', 14, 'Created new car dealer: MABUTO GROUP', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-14 08:41:33', 0),
(8, 32, 'car_dealer_approved', 'CarDealer', 14, 'Approved car dealer: MABUTO GROUP', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-14 08:46:14', 0),
(9, 32, 'lender_created', 'Lender', 21, 'Created new lender: DEMO TEST', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-15 08:26:01', 0),
(10, 32, 'lender_approved', 'Lender', 21, 'Approved lender: DEMO TEST', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-15 08:26:25', 0),
(11, 32, 'lender_approved', 'Lender', 21, 'Approved lender: DEMO TEST', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-15 08:26:29', 0),
(12, 32, 'car_dealer_created', 'CarDealer', 16, 'Created new car dealer: mwakin car dealer', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-15 08:33:20', 0),
(13, 32, 'car_dealer_approved', 'CarDealer', 16, 'Approved car dealer: mwakin car dealer', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-15 08:33:39', 0),
(14, 32, 'car_dealer_created', 'CarDealer', 17, 'Created new car dealer: Keith Luna', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-05-05 18:09:49', 0),
(15, 32, 'car_dealer_approved', 'CarDealer', 17, 'Approved car dealer: Keith Luna', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-05-05 18:16:20', 0),
(16, 32, 'lender_created', 'Lender', 22, 'Created new lender: MIWILI INSIT', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-05-06 14:48:40', 0),
(17, 32, 'lender_approved', 'Lender', 22, 'Approved lender: MIWILI INSIT', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-05-06 15:05:47', 0),
(18, 32, 'car_dealer_created', 'CarDealer', 18, 'Created new car dealer: Lillian Morse', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-22 09:10:28', 0),
(19, 99, 'car_dealer_created', 'CarDealer', 20, 'Created new car dealer: Mlimani Car Dealer', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 20:38:12', 0),
(20, 99, 'car_dealer_updated', 'CarDealer', 20, 'Updated car dealer: Mlimani Car Dealer', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 21:49:54', 0),
(21, 99, 'car_dealer_updated', 'CarDealer', 20, 'Updated car dealer: Mlimani Car Dealer', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 22:01:12', 0),
(22, 99, 'car_dealer_approved', 'CarDealer', 20, 'Approved car dealer: Mlimani Car Dealer', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-08 22:04:35', 0),
(23, 99, 'lender_created', 'Lender', 23, 'Created new lender: NBC Bank', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 04:37:39', 0),
(24, 99, 'lender_approved', 'Lender', 23, 'Approved lender: NBC Bank', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 04:41:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_type` enum('LOAN','IMPORT_DUTY') DEFAULT 'LOAN',
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `national_id` varchar(50) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `application_status` varchar(50) DEFAULT NULL,
  `make_and_model` varchar(255) DEFAULT NULL,
  `year_of_manufacture` varchar(255) DEFAULT NULL,
  `vin` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `mileage` varchar(255) DEFAULT NULL,
  `purchase_price` varchar(11) DEFAULT NULL,
  `down_payment` varchar(11) DEFAULT NULL,
  `loan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `loan_amount` varchar(220) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `loanProductId` varchar(50) DEFAULT NULL,
  `is_employee` tinyint(1) NOT NULL DEFAULT 0,
  `employee_id` varchar(50) DEFAULT NULL,
  `monthly_income` varchar(60) DEFAULT NULL,
  `employer_name` varchar(60) DEFAULT NULL,
  `lender_id` varchar(20) DEFAULT NULL,
  `hrEmail` varchar(30) DEFAULT NULL,
  `employer_verification_sent` tinyint(1) DEFAULT 0,
  `employer_verification_sent_at` timestamp NULL DEFAULT NULL,
  `employer_verified` tinyint(1) DEFAULT 0,
  `employer_verified_at` timestamp NULL DEFAULT NULL,
  `employer_verification_status` varchar(255) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `tenure` varchar(255) DEFAULT NULL,
  `car_dealer_id` varchar(200) DEFAULT NULL,
  `stage_name` varchar(200) DEFAULT NULL,
  `vehicle_id` varchar(100) DEFAULT NULL,
  `import_duty_application_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `application_type`, `first_name`, `middle_name`, `last_name`, `phone_number`, `national_id`, `region`, `district`, `street`, `amount`, `email`, `application_status`, `make_and_model`, `year_of_manufacture`, `vin`, `color`, `mileage`, `purchase_price`, `down_payment`, `loan_id`, `loan_amount`, `created_at`, `updated_at`, `loanProductId`, `is_employee`, `employee_id`, `monthly_income`, `employer_name`, `lender_id`, `hrEmail`, `employer_verification_sent`, `employer_verification_sent_at`, `employer_verified`, `employer_verified_at`, `employer_verification_status`, `client_id`, `tenure`, `car_dealer_id`, `stage_name`, `vehicle_id`, `import_duty_application_id`) VALUES
(1, 'LOAN', 'LIGHT', 'ALONE', 'SASO', '0753244888', '3222323444', 'DAR ES SALAAM', 'ILALA', 'WODA', NULL, 'appsbongo@gmail.com', 'ACCEPTED', 'TOYOTA', '1999', '363365645', 'BLACK', '500000', '70000000', '30000000', 165, NULL, '2024-01-18 08:11:06', '2025-02-22 11:53:12', NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'LOAN', 'PASCAZIA', 'KOKUSHIBA', 'SHUBILA', '0754244888', '23434234', 'DAR ES SALAAM', 'ILALA', 'MWENGE', NULL, 'appsbongo@gmail.com', 'REJECTED', 'NISSAN', '2009', '5435456456', 'SILVER', '60000', '45000000', '10000000', 167, '35000000', '2024-01-18 08:26:42', '2025-02-22 11:53:25', NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'LOAN', 'Flavia', 'Graham Gillespie', 'Larsen', '+1 (405) 103-3706', '733', 'Quibusdam tempor ex ', 'Dolore harum minim i', 'Et eos in maxime sed', NULL, 'pyla@mailinator.com', 'NEW CLIENT', 'Voluptatum amet inv', 'Aliquid modi volupta', 'Sit et amet occaeca', 'Dolor veniam volupt', 'Voluptate ratione ut', '600000', '300000000', 169, '600000000', '2025-02-22 10:13:42', '2025-02-22 10:13:42', NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'LOAN', 'Flavia', 'Graham Gillespie', 'Larsen', '+1 (405) 103-3706', '733', 'Quibusdam tempor ex ', 'Dolore harum minim i', 'Et eos in maxime sed', NULL, 'pyla@mailinator.com', 'NEW CLIENT', 'Voluptatum amet inv', 'Aliquid modi volupta', 'Sit et amet occaeca', 'Dolor veniam volupt', 'Voluptate ratione ut', '600000', '300000000', 170, '600000000', '2025-02-22 10:15:35', '2025-02-22 10:15:35', NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'LOAN', 'Percy', 'Travis Carlson', 'Egno', '0716815881', '34345345', 'Dar es salaam', 'Nulla quos ipsa rer', 'Et non odio est qui ', NULL, 'aleck.ngoshani@wealthora.co.tz', 'ACCEPTED', 'sdff', 'erwe', 'rwt', 'rte', '444', '453', '454', 171, '50000', '2025-03-16 17:43:55', '2025-03-16 19:55:32', '15', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'LOAN', 'Pevv', 'Richards', 'gfhd', '0716815881', '23423', 'HBWJHQERHJGB', 'Suscipit deleniti eu', 'Dicta id vero bland', NULL, 'fastcredit.tz@gmail.com', 'NEW CLIENT', '5435', '5345', '5646', '3656', '365', '65365', '5636', 172, '60000', '2025-03-16 20:10:28', '2025-03-16 20:10:28', '15', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'LOAN', 'Pevvre', '23erwr', 'gfhd', '0716815881', '3424', '34dfs', 'Suscipit deleniti eu', 'Natus odit et assume', NULL, 'fastcredit.tz@gmail.com34', 'NEW CLIENT', '34', '324', '34', '324', '342', '34245', '2343', 173, '80000', '2025-03-16 20:14:56', '2025-03-16 20:14:56', '15', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'LOAN', 'mwajuma', 'Travis Carlson', 'Egno', '0716815881', '556566', 'HBWJHQERHJGB', 'Suscipit deleniti eu', 'Neque veniam aute q', NULL, 'aleck.ngoshani@wealthora.co.tz', 'NEW CLIENT', '4563', '4354', '34345', '4545', '34554', '45435', '43554', 174, '10000', '2025-03-16 20:49:39', '2025-03-16 20:49:39', '15', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'LOAN', 'Percy', 'Travis Carlson', 'Egno', '0716815881', '576457675675678', 'Dar es salaam', 'Nulla quos ipsa rer', 'Dar Es Salaam', 5000.00, 'aleck.ngoshani@wealthora.co.tz', 'NEW CLIENT', 'toyota', '2023', '30004', 'black', '12', '6000', '5000', 179, '5000', '2025-04-12 18:49:49', '2025-04-12 18:49:49', '15', 1, 'gfdhg', '500000', NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'LOAN', 'juma ', 'ally', 'mimin', '0716815881', '89687', 'Dar es Salaam', 'retgreg', 'Dar Es Salaam', 900000.00, 'aleck.ngoshani@wealthora.co.tz', 'NEW CLIENT', 'toyota', '2023', '30004', 'black', '12', '70000', '80000', 180, '900000', '2025-04-12 19:44:58', '2025-04-12 19:44:58', '15', 1, '87988', '20000', NULL, '1', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'LOAN', 'Percy', 'Richards', 'Egno', '0716815881', '77', 'Dar es salaam', 'Suscipit deleniti eu', 'Dar Es Salaam', 700000.00, 'aleck.ngoshani@wealthora.co.tz', 'NEW CLIENT', 'toyota', '2023', '30004', 'black', '12', '600000', '6000', 181, '700000', '2025-04-12 20:16:35', '2025-04-12 20:16:35', '15', 1, '567487', '50000', NULL, '1', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'LOAN', 'Percy', 'Richards', 'Egno', '0716815881', '888', 'Dar es salaam', 'Nulla quos ipsa rer', 'Dar Es Salaam', 3000.00, 'aleck.ngoshani@wealthora.co.tz', 'NEW CLIENT', 'toyota', '2023', '30004', 'black', '12', '80000', '7000', 182, '3000', '2025-04-12 20:22:00', '2025-04-12 20:22:00', '15', 0, NULL, '70000000', 'u8987', '1', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'LOAN', 'Percy', 'Richards', 'Egno', '0716815881', '888', 'Dar es salaam', 'Nulla quos ipsa rer', 'Dar Es Salaam', 3000.00, 'aleck.ngoshani@wealthora.co.tz', 'NEW CLIENT', 'toyota', '2023', '30004', 'black', '12', '80000', '7000', 183, '3000', '2025-04-12 20:22:28', '2025-04-12 20:22:28', '15', 0, NULL, '70000000', 'u8987', '1', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'LOAN', 'Percy', 'Richards', 'Egno', '0716815881', '888', 'Dar es salaam', 'Nulla quos ipsa rer', 'Dar Es Salaam', 3000.00, 'aleck.ngoshani@wealthora.co.tz', 'NEW CLIENT', 'toyota', '2023', '30004', 'black', '12', '80000', '7000', 184, '3000', '2025-04-12 20:22:55', '2025-04-12 20:22:55', '15', 0, NULL, '70000000', 'u8987', '1', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'LOAN', 'Percy', 'Richards', 'Egno', '0716815881', '888', 'Dar es salaam', 'Nulla quos ipsa rer', 'Dar Es Salaam', 3000.00, 'aleck.ngoshani@wealthora.co.tz', 'NEW CLIENT', 'toyota', '2023', '30004', 'black', '12', '80000', '7000', 185, '3000', '2025-04-12 20:23:35', '2025-04-12 20:23:35', '15', 0, NULL, '70000000', 'u8987', '1', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'LOAN', 'Percy', 'rt', 'Egno', '0716815881', 'rteh', 'tye', 'tyry', 'Dar Es Salaam', 600000.00, 'aleck.ngoshani@wealthora.co.tz', 'NEW CLIENT', 'BMW x1', '2023', '6567566732', 'black', '12', '40000', '500', 186, '600000', '2025-04-13 05:52:59', '2025-04-13 05:52:59', '19', 1, '45354', '49000', NULL, '1', 'percyegno@gmail.com', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'LOAN', 'Percy', 'rt', 'Egno', '0716815881', 'rteh', 'tye', 'tyry', 'Dar Es Salaam', 600000.00, 'aleck.ngoshani@wealthora.co.tz', 'NEW CLIENT', 'BMW x1', '2023', '6567566732', 'black', '12', '40000', '500', 187, '600000', '2025-04-13 05:53:41', '2025-04-13 18:06:23', '19', 1, '45354', '49000', NULL, '1', 'percyegno@gmail.com', 1, '2025-04-13 18:04:47', 1, '2025-04-13 18:06:23', 'confirmed', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'LOAN', 'Percy', 'Travis Carlson', 'Egno', '0716815881', 'rteh', 'DAR ES SALAAM', 'rweer', 'Dar Es Salaam', 2043245.00, 'aleck.ngoshani@wealthora.co.tz', 'NEW CLIENT', 'BMW x2', '2023', '6567566732', 'black', '12', '79999', '34545', 188, '2043245', '2025-04-13 06:04:03', '2025-04-13 06:04:03', '19', 0, NULL, '5000', NULL, '1', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'LOAN', 'Percy', 'Travis Carlson', 'Egno', '0716815881', 'rteh', 'DAR ES SALAAM', 'rweer', 'Dar Es Salaam', 2043245.00, 'aleck.ngoshani@wealthora.co.tz', 'ACCEPTED', 'BMW x2', '2023', '6567566732', 'black', '12', '79999', '34545', 189, '2043245', '2025-04-13 06:07:09', '2025-04-13 06:17:11', '19', 0, NULL, '5000', NULL, '1', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'LOAN', 'Pevv', 'Travis Carlson', 'gfhd', '0716815881', '45556546', 'HBWJHQERHJGB', 'Suscipit deleniti eu', 'Dar Es Salaam', 10000000.00, 'fastcredit.tz@gmail.com', 'ACCEPTED', 'BMW x2', '2023', '30004', 'black', '12', '60000000', '5000000', 190, '10000000', '2025-04-13 18:18:09', '2025-04-13 18:41:21', '19', 1, '45354', '150000', NULL, '1', 'percyegno@gmail.com', 1, '2025-04-13 18:41:21', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'LOAN', 'Pevv', 'Travis Carlson', 'gfhd', '0716815881', '34564654', 'HBWJHQERHJGB', 'Suscipit deleniti eu', 'Dar Es Salaam', 300000.00, 'fastcredit.tz@gmail.com', 'NEW CLIENT', 'BMW x3', '2023', '300046', 'black', '12', '300000', '5000', 191, '300000', '2025-04-15 05:39:15', '2025-04-15 05:43:12', '20', 1, '45354', '150000', NULL, '21', 'percyegno@gmail.com', 1, '2025-04-15 05:42:00', 1, '2025-04-15 05:43:12', 'confirmed', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'LOAN', 'Percy', 'Travis Carlson', 'Egno', '0716815881', 'rteh7887798', 'HBWJHQERHJGB', 'Suscipit deleniti eu', 'Dar Es Salaam', 60000000.00, 'aleck.ngoshani@wealthora.co.tz', 'ACCEPTED', 'BMW x4', '2023', '30004', 'black', '12', '400000000', '3000000', 192, '60000000', '2025-04-15 10:41:12', '2025-04-15 10:47:08', '20', 1, '45354', '1300000', NULL, '19', 'percyegno@gmail.com', 1, '2025-04-15 10:42:50', 1, '2025-04-15 10:43:51', 'confirmed', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'LOAN', 'Pevv', 'Diaz', 'gfhd', '0716815881', '4567890987', 'HBWJHQERHJGB', 'Nulla quos ipsa rer', 'Dar Es Salaam', 42000.00, 'fastcredit.tz@gmail.com', 'NEW CLIENT', 'BMW x4', '2023', '30004', 'black', '12', '70000', '28000', 193, '42000', '2025-04-17 06:06:11', '2025-04-17 06:06:11', '20', 0, NULL, '50000', NULL, '21', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, '22', NULL, NULL, NULL),
(24, 'LOAN', 'Pevv', 'Richards', 'gfhd', '0716815881', '456789', 'HBWJHQERHJGB', 'tyry', 'Dar Es Salaam', 570000.00, 'percyegno@gmail.com', 'NEW CLIENT', 'BMW x3', '2023', '6567566732', 'black', '12', '600000', '30000', 194, '570000', '2025-04-17 06:19:22', '2025-04-17 06:19:22', '20', 0, NULL, '600', NULL, '21', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, '22', NULL, NULL, NULL),
(25, 'LOAN', 'Percy', 'Travis Carlson', 'Egno', '0716815881', '897789799779', 'Dar es salaam', 'Deleniti sed nisi te', 'Dar Es Salaam', 42000000.00, 'aleck.ngoshani@wealthora.co.tz', 'NEW CLIENT', 'toyota', '2023', '30004', 'black', '12000', '70000000', '28000000', 195, '42000000', '2025-04-30 10:06:40', '2025-04-30 10:06:40', '9', 1, '45354', '150000', NULL, '21', 'fastcredit.tz@gmail.com', 0, NULL, 0, NULL, NULL, NULL, NULL, '22', NULL, NULL, NULL),
(26, 'LOAN', 'Cody', 'Eugenia Guthrie', 'Howard', '+1 (867) 733-8391', 'Omnis est voluptate', 'Sed fugiat anim tem', 'Aute sint nobis omn', 'Id officia nobis qui', NULL, 'zyvuqofu@mailinator.com', 'pending', 'toyota', '2015', '457789', 'Yellow', '12000', '75800000', '900000', 9, '74900000', '2025-05-03 02:44:24', '2025-05-03 02:44:24', '9', 1, NULL, '8220000', 'Odette Blair', '21', 'murumuta@mailinator.com', 0, NULL, 0, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'LOAN', 'Cody', 'Eugenia Guthrie', 'Howard', '+1 (867) 733-8391', 'Omnis est voluptate', 'Sed fugiat anim tem', 'Aute sint nobis omn', 'Id officia nobis qui', NULL, 'zyvuqofu@mailinator.com', 'pending', 'toyota', '2015', '457789', 'Yellow', '12000', '75800000', '900000', 9, '74900000', '2025-05-03 02:45:07', '2025-05-03 02:45:07', '9', 1, NULL, '8220000', 'Odette Blair', '21', 'murumuta@mailinator.com', 0, NULL, 0, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'LOAN', 'Cody', 'Eugenia Guthrie', 'Howard', '+1 (867) 733-8391', 'Omnis est voluptate', 'Sed fugiat anim tem', 'Aute sint nobis omn', 'Id officia nobis qui', NULL, 'zyvuqofu@mailinator.com', 'pending', 'toyota', '2015', '457789', 'Yellow', '12000', '75800000', '900000', 9, '74900000', '2025-05-03 02:45:27', '2025-05-03 02:45:27', '9', 1, NULL, '8220000', 'Odette Blair', '21', 'murumuta@mailinator.com', 0, NULL, 0, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'LOAN', 'Ashely', 'Rahim Parsons', 'Justice', '+1 (652) 381-1799', 'Dolores sequi placea', 'Quas eos adipisicin', 'Maiores sit sed off', 'Dolor quo voluptate ', NULL, 'jymiqoka@mailinator.com', 'pending', 'toyota', '2015', '457789', 'Yellow', '12000', '75800000', '0', 20, '75800000', '2025-05-03 02:48:51', '2025-05-03 02:48:51', '20', 1, NULL, '760', 'Kato Parks', '21', 'gehecuf@mailinator.com', 0, NULL, 0, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'LOAN', 'Karina', 'Lenore Talley', 'Woods', '+1 (321) 666-9205', 'Id accusamus dolores', 'Et qui nihil debitis', 'Magna amet quo ipsa', 'Velit beatae reprehe', NULL, 'dimewogo@mailinator.com', 'pending', 'toyota', '2000', '457789', 'black', '12000', '8000000', '3200000', NULL, '8000000', '2025-05-03 09:30:20', '2025-05-03 09:30:20', NULL, 0, NULL, '379', 'Gannon Clarke', '17', 'gezyf@mailinator.com', 0, NULL, 0, NULL, 'pending', 32, NULL, NULL, NULL, NULL, NULL),
(31, 'LOAN', NULL, NULL, NULL, '+1 (203) 727-6356', NULL, NULL, NULL, NULL, NULL, 'neliqomu@mailinator.com', 'pending', 'toyota', '2000', '457789', 'black', '12000', '8000000', '3200000', NULL, '8000000', '2025-05-03 11:08:46', '2025-05-03 11:08:46', NULL, 0, NULL, NULL, NULL, '1', NULL, 0, NULL, 0, NULL, 'pending', 66, NULL, NULL, NULL, NULL, NULL),
(32, 'LOAN', 'Harper', 'Blair Potts', 'Delgado', '+1 (195) 542-1983', 'Dolor odio voluptatu', 'Labore velit aut dol', 'Et alias ullam nisi ', 'Quae est sunt at o', NULL, 'jypuwyb@mailinator.com', 'NEW CLIENT', 'toyota', '2025', '656756673288', 'black', '12000', '999967000', '0', 19, '999967000', '2025-05-06 04:42:02', '2025-05-11 12:37:31', '19', 1, NULL, '987', 'Odessa Torres', '1', 'todegi@mailinator.com', 0, NULL, 0, NULL, 'pending', 71, NULL, '22', 'statement_verification', NULL, NULL),
(33, 'LOAN', 'Cora', 'Noble Finley', 'Reynolds', '+1 (527) 676-5493', 'Dolor deserunt in la', 'Aut ut labore conseq', 'Aspernatur perspicia', 'Quaerat aspernatur a', NULL, 'jemufeqyb@mailinator.com', 'REJECTED', 'toyota', '2025', '656756673288', 'black', '12000', '999967000', '399986800', NULL, '599980200', '2025-05-06 18:19:22', '2025-06-12 07:48:07', NULL, 1, NULL, '13', 'Kelsey Andrews', '22', 'vaxi@mailinator.com', 0, NULL, 0, NULL, 'pending', 73, '6', '22', NULL, NULL, NULL),
(34, 'LOAN', 'Tate', 'Britanney Bullock', 'Chambers', '+1 (813) 989-6995', 'Sint labore temporib', 'Veniam perferendis ', 'Autem dignissimos ha', 'Quos amet nulla lab', NULL, 'nivux@mailinator.com', 'ACCEPTED', 'toyota', '2005', '3000476545', 'gray', '12000', '8977009', '2693102.7', NULL, '6283906.3', '2025-05-07 04:58:13', '2025-06-12 06:49:11', NULL, 1, NULL, '439', 'Vanna Blackwell', '22', 'qoca@mailinator.com', 0, NULL, 0, NULL, 'pending', 75, '14', '17', NULL, NULL, NULL),
(35, 'LOAN', 'Baker', 'Virginia Casey', 'Horn', '0767582817', 'Magni at in et enim ', 'Nulla dicta voluptat', 'Quaerat enim est vol', 'Quod aperiam enim en', NULL, 'admin@gmail.com', 'ACCEPTED', 'Chevrolet', '2005', '3000476545', 'gray', '12000', '8977009', '0', NULL, '8977009', '2025-05-09 10:56:35', '2025-06-12 07:47:41', NULL, 0, NULL, NULL, NULL, '22', NULL, 0, NULL, 0, NULL, NULL, 32, '17', '17', 'statement_verification', NULL, NULL),
(36, 'LOAN', 'Lesley', 'Galena Rasmussen', 'Banks', '0767582817', '2021', 'Dolorem reprehenderi', 'Deserunt id soluta o', 'Saepe sit aliquid a', NULL, 'admin@gmail.com', 'REJECTED', 'Chevrolet Corvette', '2005', '3000476545', 'gray', '12000', '8977009', '0', NULL, '8977009', '2025-05-09 11:37:07', '2025-05-09 12:35:23', NULL, 1, NULL, '3790000', 'Gannon Clarke', '22', 'fastcredit.tz@gmail.com', 0, NULL, 0, NULL, 'pending', 32, '5', '17', NULL, NULL, NULL),
(37, 'LOAN', 'Ayanna', 'Perry Griffin', 'Nelson', '+1 (905) 867-4955', 'Pariatur Sunt dolo', 'Beatae sequi exercit', 'Ut harum nemo impedi', 'Commodo qui iste par', NULL, 'vaxidaf@mailinator.com', 'ACCEPTED', 'Chevrolet Aveo', '2025', '300045646', 'white', '12000', '60000000', '0', NULL, '60000000', '2025-05-10 02:38:27', '2025-05-11 03:12:22', NULL, 1, NULL, '5000000', 'Gannon Clarke', '17', 'percyegno@gmail.com', 0, NULL, 0, NULL, 'pending', 79, '32', '14', 'statement_verification', '13', NULL),
(38, 'LOAN', 'JUMA ', 'MWENDESHA', 'MARABA', '0767582837', '20010322-90948-58898-70', 'DAR ES SALAAM', 'ubungo', 'Dar Es Salaam', 48000000.00, 'percyegno@gmail.com', 'NEW CLIENT', 'toyota', '2023', '3000499887', 'black', '12000', '80000000', '32000000', 197, '48000000', '2025-05-10 17:57:19', '2025-05-10 17:57:19', '9', 1, '45354', '3000000', NULL, '21', 'percyegno@gmail.com', 0, NULL, 0, NULL, NULL, NULL, NULL, '17', NULL, NULL, NULL),
(39, 'LOAN', 'Joy', 'Brianna Wade', 'Gutierrez', '+255716815887', '77777788-87667-67778-88', 'Quo quia ea et excep', 'Libero velit odit es', 'Dicta quam dolore do', NULL, 'percyegno@gmail.com', 'pending', 'Chevrolet Corvette', '2005', '3000476545', 'gray', '12000', '8977009', '0', NULL, '8977009', '2025-06-11 11:40:39', '2025-06-11 11:40:39', NULL, 1, NULL, '8900000', 'Gannon Clarke', '17', 'percyegno@gmail.com', 0, NULL, 0, NULL, 'pending', 72, '19', '17', 'car_dealer', '11', NULL),
(40, 'LOAN', 'Percy', 'Richards', 'Egno', '0716815881', '45665765-78678-78978-98', 'tye', 'Dar Es Salaam', 'Dar Es Salaam', 3590803.60, 'aleck.ngoshani@wealthora.co.tz', 'NEW CLIENT', 'toyota', '2023', '30004', 'black', '12', '8977009', '5386205.4', 198, '3590803.6', '2025-06-12 08:05:49', '2025-06-12 08:05:49', '9', 0, NULL, '500000', NULL, '21', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, '22', NULL, NULL, NULL),
(41, 'LOAN', 'Flavia', 'Marshall Sellers', 'Navarro', '+255716815887', '20002093-92883-34389-43', 'Ut dolor excepteur a', 'Facilis aut recusand', 'Vel et ea blanditiis', NULL, 'percyegno@gmail.com', 'NEW CLIENT', 'Chevrolet Corvette', '2005', '3000476545', 'gray', '12000', '8977009', '0', NULL, '8977009', '2025-06-23 09:47:23', '2025-06-23 10:22:26', NULL, 0, NULL, NULL, NULL, '17', NULL, 0, NULL, 0, NULL, NULL, 72, '57', '17', 'statement_verification', '11', NULL),
(42, 'LOAN', 'Percy', 'Shoshana Avery', 'Egno', '+1 (727) 363-9883', '20002093-92883-34389-43', 'Nostrud et omnis sae', 'Nihil consequat Ips', 'Dar Es Salaam', NULL, 'ryno@mailinator.com', 'pending', 'Chevrolet Corvette', '2005', '3000476545', 'gray', '12000', '8977009', '3141953.15', NULL, '5835055.85', '2025-07-25 07:57:39', '2025-07-25 07:57:39', NULL, 0, NULL, NULL, NULL, '17', NULL, 0, NULL, 0, NULL, NULL, 90, '8', '17', 'car_dealer', '11', NULL),
(43, 'LOAN', 'Amber', 'Ignatius Pope', 'Rivas', '+1 (137) 556-4185', '20002093-92883-34389-43', 'Blanditiis consequat', 'Itaque alias enim ex', 'Ipsum eos quidem qu', NULL, 'myfyz@mailinator.com', 'REJECTED', 'Infiniti X5', '2025', '30004765454', 'gray', '12000', '600000', '210000', NULL, '390000', '2025-07-25 08:51:16', '2025-08-01 15:19:59', NULL, 0, NULL, NULL, NULL, '17', NULL, 0, NULL, 0, NULL, NULL, 91, '51', '22', 'statement_verification', '14', NULL),
(44, 'LOAN', 'Lacey', 'Macon May', 'Baxter', '+1 (523) 482-6001', '20000333-47343-57845-78', 'Commodo itaque fugia', 'Illum voluptas temp', 'Quia voluptatem mole', NULL, 'winon@mailinator.com', 'REJECTED', 'Ford Puma', '2025', '1HJDH449NN', 'gray-white', '12000', '40000000', '20000000', NULL, '20000000', '2025-08-01 07:24:16', '2025-08-01 15:14:47', NULL, 0, NULL, NULL, NULL, '22', NULL, 0, NULL, 0, NULL, NULL, 92, '21', '22', 'car_dealer', '15', NULL),
(45, 'LOAN', 'Pevv', 'jully', 'gfhd', '0767582817', '20060329-14129-00001-27', '2', 'ilila', 'Dar Es Salaam', NULL, 'admin@gmail.com', 'NEW CLIENT', 'Ford Puma', '2020', 'b5678', 'BLACK', '120000', '450000', '225000', NULL, '225000', '2025-08-06 03:32:50', '2025-08-06 03:32:50', NULL, 0, NULL, NULL, NULL, '22', NULL, 0, NULL, 0, NULL, NULL, 32, '48', NULL, 'statement_verification', NULL, NULL),
(46, 'LOAN', 'Percy', 'djbfgvbv', 'Egno', '0767582817', '20060329-14129-00001-27', '3', 'ewfsetrtg', 'Dar Es Salaam', NULL, 'admin@gmail.com', 'NEW CLIENT', 'BMW M4', '2020', 'dshajfds', 'white', '12000', '150000', '45000', NULL, '105000', '2025-09-01 15:44:36', '2025-09-01 15:44:36', NULL, 0, NULL, NULL, NULL, '17', NULL, 0, NULL, 0, NULL, NULL, 32, '42', NULL, 'statement_verification', NULL, NULL),
(47, 'LOAN', 'Percy', 'ROBERT', 'Egno', '0716815881', '20765675-43675-46754-43', 'Dar es Salaam', 'Dar Es Salaam', 'Dar Es Salaam', 7040000.00, 'aleck.ngoshani@wealthora.co.tz', 'NEW CLIENT', 'BMW x1', '2023', '30004', 'black', '12000', '8000000', '960000', 199, '7040000', '2025-09-09 01:00:56', '2025-09-09 01:00:56', '9', 0, NULL, '15000000', NULL, '21', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, '20', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `application_status_history`
--

CREATE TABLE `application_status_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `application_type` enum('LOAN','IMPORT_DUTY') NOT NULL,
  `previous_status` varchar(50) DEFAULT NULL,
  `new_status` varchar(50) NOT NULL,
  `changed_by_type` enum('SYSTEM','CLIENT','CF_COMPANY','LENDER','ADMIN') NOT NULL,
  `changed_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `url`, `loan_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'assets/attachment/6800c79a3cd6e.pdf', 194, 'payslip', '2025-04-17 06:19:22', '2025-04-17 06:19:22'),
(2, 'assets/attachment/6800c79a3d9df.pdf', 194, 'application_form', '2025-04-17 06:19:22', '2025-04-17 06:19:22'),
(3, 'assets/attachment/681220601e470.pdf', 195, 'payslip', '2025-04-30 10:06:40', '2025-04-30 10:06:40'),
(4, 'assets/attachment/681220601f08a.pdf', 195, 'bankStatement', '2025-04-30 10:06:40', '2025-04-30 10:06:40'),
(5, 'assets/attachment/681220601f73c.pdf', 195, 'application_form', '2025-04-30 10:06:40', '2025-04-30 10:06:40'),
(6, 'assets/attachment/681e09939929f.pdf', 35, 'id_document', '2025-05-09 10:56:35', '2025-05-09 10:56:35'),
(7, 'assets/attachment/681e09939a6b3.pdf', 35, 'bank_statement', '2025-05-09 10:56:35', '2025-05-09 10:56:35'),
(8, 'assets/attachment/681e09939aa24.pdf', 35, 'application_document', '2025-05-09 10:56:35', '2025-05-09 10:56:35'),
(9, 'assets/attachment/681e131305ac8.pdf', 36, 'id_document', '2025-05-09 11:37:07', '2025-05-09 11:37:07'),
(10, 'assets/attachment/681e131306273.pdf', 36, 'bank_statement', '2025-05-09 11:37:07', '2025-05-09 11:37:07'),
(11, 'assets/attachment/681e13130669c.png', 36, 'payslip', '2025-05-09 11:37:07', '2025-05-09 11:37:07'),
(12, 'assets/attachment/681e1313069bf.pdf', 36, 'application_document', '2025-05-09 11:37:07', '2025-05-09 11:37:07'),
(13, 'assets/attachment/681ee653ef5ce.png', 37, 'id_document', '2025-05-10 02:38:27', '2025-05-10 02:38:27'),
(14, 'assets/attachment/681ee653efd79.png', 37, 'bank_statement', '2025-05-10 02:38:27', '2025-05-10 02:38:27'),
(15, 'assets/attachment/681ee653f0119.png', 37, 'payslip', '2025-05-10 02:38:27', '2025-05-10 02:38:27'),
(16, 'assets/attachment/681ee653f05d8.png', 37, 'application_document', '2025-05-10 02:38:27', '2025-05-10 02:38:27'),
(17, 'assets/attachment/681fbdafa5958.pdf', 197, 'bankStatement', '2025-05-10 17:57:19', '2025-05-10 17:57:19'),
(18, 'assets/attachment/681fbdafa5f33.pdf', 197, 'application_form', '2025-05-10 17:57:19', '2025-05-10 17:57:19'),
(19, 'assets/attachment/6849956702a86.png', 39, 'id_document', '2025-06-11 11:40:39', '2025-06-11 11:40:39'),
(20, 'assets/attachment/6849956704253.png', 39, 'bank_statement', '2025-06-11 11:40:39', '2025-06-11 11:40:39'),
(21, 'assets/attachment/68499567046ca.png', 39, 'payslip', '2025-06-11 11:40:39', '2025-06-11 11:40:39'),
(22, 'assets/attachment/684ab48d50729.pdf', 198, 'bankStatement', '2025-06-12 08:05:49', '2025-06-12 08:05:49'),
(23, 'assets/attachment/684ab48d5153b.pdf', 198, 'application_form', '2025-06-12 08:05:49', '2025-06-12 08:05:49'),
(24, 'assets/attachment/68594cdb4897e.png', 41, 'id_document', '2025-06-23 09:47:23', '2025-06-23 09:47:23'),
(25, 'assets/attachment/68594cdb4a0b5.png', 41, 'bank_statement', '2025-06-23 09:47:23', '2025-06-23 09:47:23'),
(26, 'assets/attachment/6883632362776.png', 42, 'id_document', '2025-07-25 07:57:39', '2025-07-25 07:57:39'),
(27, 'assets/attachment/68836323639e3.png', 42, 'bank_statement', '2025-07-25 07:57:39', '2025-07-25 07:57:39'),
(28, 'assets/attachment/68836fb4564bc.png', 43, 'id_document', '2025-07-25 08:51:16', '2025-07-25 08:51:16'),
(29, 'assets/attachment/68836fb457502.png', 43, 'bank_statement', '2025-07-25 08:51:16', '2025-07-25 08:51:16'),
(30, 'assets/attachment/688c95d0648fa.pdf', 44, 'id_document', '2025-08-01 07:24:16', '2025-08-01 07:24:16'),
(31, 'assets/attachment/688c95d065b33.pdf', 44, 'bank_statement', '2025-08-01 07:24:16', '2025-08-01 07:24:16'),
(32, 'assets/attachment/6892f71209bed.png', 45, 'id_document', '2025-08-06 03:32:50', '2025-08-06 03:32:50'),
(33, 'assets/attachment/6892f7120ad36.jpg', 45, 'bank_statement', '2025-08-06 03:32:50', '2025-08-06 03:32:50'),
(34, 'assets/vehicles/6892f7120b139.webp', 45, 'vehicle_image_1', '2025-08-06 03:32:50', '2025-08-06 03:32:50'),
(35, 'assets/vehicles/6892f7120b57a.jpg', 45, 'vehicle_image_2', '2025-08-06 03:32:50', '2025-08-06 03:32:50'),
(36, 'assets/vehicles/6892f7120b879.jpg', 45, 'vehicle_image_3', '2025-08-06 03:32:50', '2025-08-06 03:32:50'),
(37, 'assets/attachment/68b5e99430212.jpeg', 46, 'id_document', '2025-09-01 15:44:36', '2025-09-01 15:44:36'),
(38, 'assets/attachment/68b5e9943280a.jpeg', 46, 'bank_statement', '2025-09-01 15:44:36', '2025-09-01 15:44:36'),
(39, 'assets/vehicles/68b5e99432c5c.jpeg', 46, 'vehicle_image_1', '2025-09-01 15:44:36', '2025-09-01 15:44:36'),
(40, 'assets/vehicles/68b5e99433182.jpeg', 46, 'vehicle_image_2', '2025-09-01 15:44:36', '2025-09-01 15:44:36'),
(41, 'assets/vehicles/68b5e99433520.jpeg', 46, 'vehicle_image_3', '2025-09-01 15:44:36', '2025-09-01 15:44:36'),
(42, 'assets/attachment/68bfa6788a62f.pdf', 199, 'bankStatement', '2025-09-09 01:00:56', '2025-09-09 01:00:56'),
(43, 'assets/attachment/68bfa6788b5ff.pdf', 199, 'application_form', '2025-09-09 01:00:56', '2025-09-09 01:00:56');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_number` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_number`, `bank_name`, `created_at`, `updated_at`) VALUES
(1, '15', 'BANK OF TANZANIA', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(2, '2', 'CRDB BANK PLC', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(3, '4', 'PEOPLE’S BANK OF ZANZIBAR LTD', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(4, '5', 'STANDARD CHARTERED BANK (T) LIMITED', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(5, '6', 'STANBIC BANK TANZANIA LTD.', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(6, '8', 'CITIBANK TANZANIA LTD', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(7, '9', 'BANK OF AFRICA TANZANIA LIMITED', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(8, '11', 'DIAMOND TRUST BANK TANZANIA LTD', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(9, '12', 'AKIBA COMMERCIAL BANK LTD', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(10, '13', 'EXIM BANK (TANZANIA) LTD', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(11, '14', 'KILIMANJARO CO-OPERATIVE BANK LTD', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(12, '1', 'NATIONAL BANK OF COMMERCE LTD', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(13, '16', 'NATIONAL MICROFINANCE BANK LIMITED', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(14, '17', 'KCB BANK TANZANIA LIMITED', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(15, '18', 'HABIB AFRICAN BANK LIMITED', '2022-05-31 09:16:12', '2022-05-31 09:16:12'),
(16, '19', 'INTERNATIONAL COMMERCIAL BANK (TANZANIA) LIMITED', '2022-05-31 09:16:12', '2022-05-31 09:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `billing_configurations`
--

CREATE TABLE `billing_configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entity_type` enum('lender','car_dealer') NOT NULL,
  `entity_id` bigint(20) UNSIGNED NOT NULL,
  `billing_type` enum('per_application','monthly_subscription','commission_based') NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `currency` varchar(3) DEFAULT 'TZS',
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billing_configurations`
--

INSERT INTO `billing_configurations` (`id`, `entity_type`, `entity_id`, `billing_type`, `rate`, `currency`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'lender', 1, 'per_application', 50000.00, 'TZS', 1, NULL, NULL),
(2, 'car_dealer', 1, 'per_application', 30000.00, 'TZS', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_number` varchar(50) NOT NULL,
  `entity_type` enum('lender','car_dealer') NOT NULL,
  `entity_id` bigint(20) UNSIGNED NOT NULL,
  `billing_period_start` date NOT NULL,
  `billing_period_end` date NOT NULL,
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `tax_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(3) DEFAULT 'TZS',
  `status` enum('pending','sent','paid','overdue','cancelled') DEFAULT 'pending',
  `due_date` date NOT NULL,
  `issued_date` date NOT NULL,
  `paid_date` date DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_reference` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `bill_number`, `entity_type`, `entity_id`, `billing_period_start`, `billing_period_end`, `subtotal`, `tax_amount`, `total_amount`, `currency`, `status`, `due_date`, `issued_date`, `paid_date`, `payment_method`, `payment_reference`, `notes`, `created_at`, `updated_at`) VALUES
(2, 'BILL-2025-0001', 'car_dealer', 17, '2025-06-01', '2025-06-30', 100000.00, 18000.00, 118000.00, 'TZS', 'paid', '2025-07-30', '2025-06-24', '2025-07-21', NULL, NULL, NULL, '2025-06-24 05:34:50', '2025-07-21 09:29:09'),
(3, 'BILL-2025-0002', 'car_dealer', 17, '2025-06-01', '2025-06-30', 100000.00, 18000.00, 118000.00, 'TZS', 'paid', '2025-07-30', '2025-06-24', '2025-06-24', NULL, NULL, NULL, '2025-06-24 05:35:31', '2025-06-24 05:45:07'),
(5, 'BILL-2025-0003', 'car_dealer', 14, '2025-05-01', '2025-05-31', 30000.00, 5400.00, 35400.00, 'TZS', 'paid', '2025-06-30', '2025-06-24', '2025-06-24', NULL, NULL, NULL, '2025-06-24 07:45:21', '2025-06-24 07:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `bill_items`
--

CREATE TABLE `bill_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `item_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_items`
--

INSERT INTO `bill_items` (`id`, `bill_id`, `application_id`, `description`, `quantity`, `unit_price`, `total_price`, `item_date`, `created_at`, `updated_at`) VALUES
(1, 2, 39, 'Application processing fee for Joy Gutierrez', 1, 50000.00, 50000.00, '2025-06-11', '2025-06-24 05:34:50', '2025-06-24 05:34:50'),
(2, 2, 41, 'Application processing fee for Flavia Navarro', 1, 50000.00, 50000.00, '2025-06-23', '2025-06-24 05:34:50', '2025-06-24 05:34:50'),
(3, 3, 39, 'Application processing fee for Joy Gutierrez', 1, 50000.00, 50000.00, '2025-06-11', '2025-06-24 05:35:31', '2025-06-24 05:35:31'),
(6, 5, 37, 'Vehicle Financing Facilitation for Ayanna Nelson - Vehicle: Chevrolet Aveo - Amount: 60,000,000 TZS - App ID: 37', 1, 30000.00, 30000.00, '2025-05-10', '2025-06-24 07:45:21', '2025-06-24 07:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `body_types`
--

CREATE TABLE `body_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `body_types`
--

INSERT INTO `body_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sedan', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(2, 'SUV', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(3, 'Pickup', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(4, 'Hatchback', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(5, 'Coupe', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(6, 'Convertible', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(7, 'Wagon', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(8, 'Van', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(9, 'Minivan', '2025-04-30 08:32:18', '2025-04-30 08:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `wilaya` varchar(255) DEFAULT NULL,
  `branchNumber` varchar(255) DEFAULT NULL,
  `parentBranch` varchar(255) DEFAULT NULL,
  `monthly_disbursement_amount` varchar(255) DEFAULT NULL,
  `amount_owed` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `automatic_payments` varchar(255) DEFAULT NULL,
  `branch_status` varchar(255) DEFAULT NULL,
  `selected` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `institution_id`, `name`, `region`, `wilaya`, `branchNumber`, `parentBranch`, `monthly_disbursement_amount`, `amount_owed`, `phone_number`, `email`, `automatic_payments`, `branch_status`, `selected`, `created_at`, `updated_at`) VALUES
(12, NULL, 'MAFINGA DC BRANCH', 'IRINGA', 'MAFINGA', '9010', NULL, NULL, NULL, NULL, 'ema@gmail.com', NULL, 'PENDING', 0, '2023-07-02 19:48:14', '2023-07-02 19:48:14'),
(17, NULL, 'SOWETO', 'DAR ES SALAAM ', 'ILALA', '9583', NULL, NULL, NULL, '0624451311', 'ema@gmail.com', NULL, 'ACTIVE', 0, '2023-07-03 08:37:35', '2023-07-03 08:37:35'),
(25, NULL, 'HQ', 'DAR ES SALAAM', 'KINONDONI', '9307', NULL, NULL, NULL, '0624531123', 'makongosaccos@gmail.com', NULL, 'PENDING', 0, '2023-08-02 03:50:44', '2023-08-02 03:50:44'),
(30, '8', 'text', 'mwanza ', 'mjini', '9308', NULL, NULL, NULL, '7777777777', 'mwana@gmail.com', NULL, 'ACTIVE', 0, '2023-11-20 09:30:18', '2023-11-20 09:33:10'),
(31, '8', 'demo', 'DAR ES SALAAM ', 'MADABA', '9309', NULL, NULL, NULL, '+2551234567891', 'mwana@gmail.com', NULL, 'PENDING', 0, '2023-11-24 10:33:33', '2023-11-24 10:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `make` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `city_mpg` int(11) DEFAULT NULL,
  `highway_mpg` int(11) DEFAULT NULL,
  `combined_mpg` int(11) DEFAULT NULL,
  `cylinders` int(11) DEFAULT NULL,
  `displacement` decimal(3,1) DEFAULT NULL,
  `fuel_type` varchar(50) DEFAULT NULL,
  `co2_emission` decimal(5,2) DEFAULT NULL,
  `fuel_cost_city` int(11) DEFAULT NULL,
  `drive_type` varchar(50) DEFAULT NULL,
  `transmission` varchar(50) DEFAULT NULL,
  `vehicle_class` varchar(50) DEFAULT NULL,
  `you_save_spend` int(11) DEFAULT NULL,
  `base_model` varchar(255) DEFAULT NULL,
  `engine_id` varchar(255) DEFAULT NULL,
  `engine_description` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `edited_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `car_dealers`
--

CREATE TABLE `car_dealers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `region` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(100) NOT NULL DEFAULT 'Tanzania',
  `contact_person_name` varchar(255) NOT NULL,
  `contact_person_position` varchar(100) DEFAULT NULL,
  `contact_person_phone` varchar(20) NOT NULL,
  `contact_person_email` varchar(255) NOT NULL,
  `dealer_type` enum('New Cars','Used Cars','Both','Other') NOT NULL,
  `year_established` year(4) DEFAULT NULL,
  `brands_sold` text DEFAULT NULL,
  `inventory_size` int(11) DEFAULT NULL,
  `services_offered` text DEFAULT NULL,
  `operating_hours` varchar(255) DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` enum('PENDING','APPROVED','REJECTED') NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `business_registration_number` varchar(200) DEFAULT NULL,
  `tax_identification_number` varchar(300) DEFAULT NULL,
  `servicesOffered` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_dealers`
--

INSERT INTO `car_dealers` (`id`, `name`, `phone_number`, `email`, `website`, `region`, `city`, `address`, `postal_code`, `country`, `contact_person_name`, `contact_person_position`, `contact_person_phone`, `contact_person_email`, `dealer_type`, `year_established`, `brands_sold`, `inventory_size`, `services_offered`, `operating_hours`, `additional_notes`, `logo`, `status`, `created_at`, `updated_at`, `business_registration_number`, `tax_identification_number`, `servicesOffered`) VALUES
(1, 'Solomon Newton', '+255716815881', 'aleck.ngoshani@wealthora.co.tz', '', 'HBWJHQERHJGB', 'Dar Es Salaam', 'Dar Es Salaam\n2113', '17004', 'Tanzania', 'Percy Egno', 'Percy Egno', '+255716815881', 'aleck.ngoshani@wealthora.co.tz', 'Both', '2050', '[\"Toyota\",\"BMW\",\"Audi\",\"Lexus\"]', 300, NULL, NULL, NULL, NULL, 'PENDING', '2025-04-12 13:34:41', '2025-04-12 13:34:41', NULL, NULL, NULL),
(9, 'Solomon Newton', '+255716815881', 'aleck.ngoshanfdi@wealthora.co.tz', NULL, 'HBWJHQERHJGB', 'Dar Es Salaam', 'Dar Es Salaam\n2113', '17004', 'Tanzania', 'Percy Egno', 'Percy Egno', '+255716815881', 'aleck.ngffoshani@wealthora.co.tz', 'Both', '2025', '[\"Mazda\",\"Ford\"]', 565776, NULL, NULL, NULL, NULL, 'APPROVED', '2025-04-12 14:43:03', '2025-04-12 14:45:55', '4324545', '86787', NULL),
(10, 'Solomon Newton', '+255716815881', 'aleck.ngoshgfhanfdi@wealthora.co.tz', NULL, 'HBWJHQERHJGB', 'Dar Es Salaam', 'Dar Es Salaam\n2113', '17004', 'Tanzania', 'Percy Egno', 'Percy Egno', '+255716815881', 'aleck.ngffoshfgani@wealthora.co.tz', 'Both', '2025', '[\"Mazda\",\"Ford\"]', 565776, NULL, NULL, NULL, NULL, 'PENDING', '2025-04-12 14:44:26', '2025-04-12 14:44:26', '4324545', '86787', NULL),
(12, 'Solomon Newton', '+255716815881', 'aleck.nggfoshgfhanfdi@wealthora.co.tz', NULL, 'HBWJHQERHJGB', 'Dar Es Salaam', 'Dar Es Salaam\n2113', '17004', 'Tanzania', 'Percy Egno', 'Percy Egno', '+255716815881', 'aleck.ngffgdfoshfgani@wealthora.co.tz', 'Both', '2025', '[\"Mazda\",\"Ford\"]', 565776, NULL, NULL, NULL, NULL, 'APPROVED', '2025-04-12 14:44:55', '2025-04-12 14:45:52', '4324545', '86787', NULL),
(13, 'mwakin car dealer', '+255716815881', 'aleck.ngosheretani@wealthora.co.tz', NULL, 'DAR ES SALAAM', 'Dar Es Salaam', 'KIJITONYAMA\nPLOT NO. 2113', '17004', 'Tanzania', 'Percy Egno', 'CEO', '+255716815881', 'aleck.ngfdsgfoshani@wealthora.co.tz', 'Both', '1999', '[\"Toyota\",\"Ford\",\"Chevrolet\",\"Jeep\",\"Kia\"]', 2333, NULL, NULL, NULL, NULL, 'PENDING', '2025-04-13 03:41:15', '2025-04-13 03:41:15', '4534t53', '35654fre', NULL),
(14, 'MABUTO GROUP', '+255716815881', 'percyebdfhgno@gmail.com', NULL, 'DAR ES SALAAM', 'Dar Es Salaam', 'Dar Es Salaam\n2113', '17004', 'Tanzania', 'Percy Egno', 'MD', '+25571681584353', 'percyegno@gmail.com', 'Both', '2000', '[\"Toyota\",\"Mazda\",\"Chevrolet\",\"Audi\",\"Subaru\",\"Nissan\",\"Isuzu\",\"Volkswagen\",\"Kia\",\"Jeep\",\"Land Rover\",\"Ford\",\"Suzuki\",\"Honda\",\"BMW\",\"Mercedes-Benz\"]', 2300, NULL, NULL, NULL, NULL, 'APPROVED', '2025-04-14 05:41:33', '2025-09-08 20:37:54', '432454544RTTR', '442RTY65', '[\"Sales\",\"Parts\",\"Insurance\",\"Financing\",\"Maintenance\",\"BodyWork\"]'),
(16, 'mwakin car dealer', '+255716815881', 'percyegffno@gmail.com', NULL, 'Dar es Salaam', 'Dar Es Salaam', 'Dar Es Salaam\n2113', '17004', 'Tanzania', 'Percy Egno', 'Percy Egno', '+255716815834', 'percyegno@gmail.com', 'Both', '2000', '[\"Toyota\",\"BMW\",\"Hyundai\",\"Lexus\"]', 2900, NULL, NULL, NULL, NULL, 'APPROVED', '2025-04-15 05:33:20', '2025-05-05 18:15:30', '4324545rwe', '442erw', '[\"Sales\",\"Parts\",\"Financing\",\"BodyWork\"]'),
(17, 'Keith Luna', '+1 (609) 281-6736', 'percyegno01@gmail.com', 'https://www.qylepef.cc', 'Minus voluptatem est', 'In illum deserunt d', 'Non aute magni ut qu', 'Qui ipsum expedita ', 'Kenya', 'Isaiah Shannon', 'Sit laborum sunt eu', '+1 (233) 604-8331', 'percyegno@gmail.com', 'Other', '2009', '[\"Nissan\",\"Mazda\",\"Suzuki\",\"Subaru\",\"Isuzu\",\"Mercedes-Benz\",\"Lexus\"]', 62, NULL, NULL, NULL, NULL, 'APPROVED', '2025-05-05 15:09:49', '2025-06-24 10:29:24', '793', '532', '[\"Sales\",\"Financing\",\"Insurance\"]'),
(18, 'Lillian Morse', '+1 (901) 281-6465', 'vynehecas@mailinator.com', 'https://www.wafysuzugilotu.info', 'Officia sapiente dol', 'Reprehenderit molest', 'Voluptatum libero pr', 'Ullam tenetur conseq', 'Tanzania', 'Freya Avery', 'Dolorem sit qui aut ', '+1 (749) 184-4046', 'nuwawuryz@mailinator.com', 'Both', '1970', '[\"Honda\",\"Nissan\",\"Mitsubishi\",\"Subaru\",\"Mercedes-Benz\",\"BMW\",\"Audi\",\"Chevrolet\",\"Hyundai\",\"Kia\",\"Volvo\",\"Lexus\"]', 76, NULL, NULL, NULL, 'dealer-logos/orhg07xUXNJkxWJp63JAKF94lEQOmUFWyYkT5zPC.png', 'PENDING', '2025-07-22 06:10:28', '2025-07-22 06:10:28', '125', '223', '[\"Sales\",\"Financing\",\"Maintenance\",\"Parts\",\"Insurance\",\"BodyWork\"]'),
(20, 'Mlimani Car Dealer', '+255716815881', 'percyegno@gmail.com', NULL, 'Dar es Salaam', 'Dar Es Salaam', 'Dar Es Salaam\n2113', '17004', 'Tanzania', 'Percy Egno', 'Percy Egno', '+255716815881', 'percyegno@gmail.com', 'Both', '2020', '[\"Toyota\",\"Chevrolet\",\"BMW\",\"Suzuki\",\"Honda\",\"Subaru\",\"Audi\",\"Hyundai\",\"Jeep\",\"Lexus\",\"Isuzu\"]', 120, NULL, NULL, NULL, 'dealer-logos/iI7CzaGZHtDCBnHyWsvUkyguiG5RoPoCD082ykHL.png', 'APPROVED', '2025-09-08 17:38:12', '2025-09-08 19:04:30', '432454533', '44243e', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `cf_quotations`
--

CREATE TABLE `cf_quotations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `cf_company_id` bigint(20) UNSIGNED NOT NULL,
  `tra_calculation_log_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quotation_number` varchar(50) NOT NULL,
  `tra_reference_number` varchar(100) DEFAULT NULL,
  `duty_calculation_source` enum('TRA_TANCIS','TRA_MANUAL','CF_ESTIMATE') DEFAULT 'TRA_TANCIS',
  `import_duty` decimal(12,2) NOT NULL,
  `vat_amount` decimal(12,2) NOT NULL,
  `railway_development_levy` decimal(12,2) NOT NULL,
  `excise_duty` decimal(12,2) DEFAULT 0.00,
  `service_levy` decimal(12,2) DEFAULT 0.00,
  `other_charges` decimal(12,2) DEFAULT 0.00,
  `total_duties_taxes` decimal(12,2) NOT NULL,
  `clearing_fee` decimal(12,2) NOT NULL,
  `forwarding_fee` decimal(12,2) NOT NULL,
  `documentation_fee` decimal(12,2) NOT NULL,
  `port_charges` decimal(12,2) DEFAULT 0.00,
  `transportation_fee` decimal(12,2) DEFAULT 0.00,
  `storage_charges` decimal(12,2) DEFAULT 0.00,
  `other_service_fees` decimal(12,2) DEFAULT 0.00,
  `total_service_fees` decimal(12,2) NOT NULL,
  `grand_total` decimal(12,2) NOT NULL,
  `currency` varchar(3) DEFAULT 'TZS',
  `estimated_clearance_days` int(11) NOT NULL,
  `validity_days` int(11) DEFAULT 7,
  `payment_terms` varchar(255) DEFAULT NULL,
  `special_notes` text DEFAULT NULL,
  `status` enum('DRAFT','SUBMITTED','SELECTED','EXPIRED','WITHDRAWN') DEFAULT 'DRAFT',
  `submitted_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `selected_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `calculation_breakdown_document` varchar(500) DEFAULT NULL COMMENT 'Path to TRA calculation document'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cf_quotations`
--

INSERT INTO `cf_quotations` (`id`, `application_id`, `cf_company_id`, `tra_calculation_log_id`, `quotation_number`, `tra_reference_number`, `duty_calculation_source`, `import_duty`, `vat_amount`, `railway_development_levy`, `excise_duty`, `service_levy`, `other_charges`, `total_duties_taxes`, `clearing_fee`, `forwarding_fee`, `documentation_fee`, `port_charges`, `transportation_fee`, `storage_charges`, `other_service_fees`, `total_service_fees`, `grand_total`, `currency`, `estimated_clearance_days`, `validity_days`, `payment_terms`, `special_notes`, `status`, `submitted_at`, `expires_at`, `selected_at`, `created_at`, `updated_at`, `calculation_breakdown_document`) VALUES
(1, 2, 4, NULL, 'Q420250001', 'hhjjnnh', 'TRA_TANCIS', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 800000.00, 78000.00, 780000.00, 80000.00, 1738000.00, 1738000.00, 'TZS', 7, 7, 'Payment required before clearance', 'my special notes', 'SELECTED', '2025-08-16 11:37:02', '2025-08-23 11:37:02', '2025-08-16 11:46:18', '2025-08-16 11:37:02', '2025-08-16 11:46:18', NULL),
(2, 3, 4, NULL, 'Q420250002', 'fdghvshjdjffg', 'TRA_TANCIS', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 8000000.00, 0.00, 0.00, 0.00, 8000000.00, 8000000.00, 'TZS', 7, 7, 'Payment required before clearance', 'dfsdfg dsb mbfvmdsbnfdfgg. dshgdvhgf', 'SELECTED', '2025-08-25 11:24:34', '2025-09-01 11:24:34', '2025-08-25 11:25:42', '2025-08-25 11:24:34', '2025-08-25 11:25:42', NULL),
(3, 4, 4, NULL, 'Q420250003', 'hhereret', 'TRA_TANCIS', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 200.00, 3000.00, 3000.00, 4000.00, 10200.00, 10200.00, 'TZS', 7, 7, 'Payment required before clrewterearance', 'dfgdfg', 'SELECTED', '2025-08-27 11:53:21', '2025-09-03 11:53:21', '2025-08-27 11:55:19', '2025-08-27 11:53:21', '2025-08-27 11:55:19', NULL),
(4, 5, 5, NULL, 'Q520250004', '345678976', 'TRA_TANCIS', 799990.00, 0.00, 0.00, 0.00, 0.00, 0.00, 799990.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 799990.00, 'TZS', 7, 7, 'Payment required before clearance', '', 'SUBMITTED', '2025-09-08 10:09:37', '2025-09-15 10:09:37', NULL, '2025-09-08 10:09:37', '2025-09-08 10:09:37', NULL),
(5, 6, 5, NULL, 'Q520250005', '2324343', 'TRA_TANCIS', 1900000.00, 20.00, 10.00, 0.00, 0.00, 0.00, 1900030.00, 20000.00, 60000.00, 156000.00, 0.00, 0.00, 0.00, 0.00, 236000.00, 2136030.00, 'TZS', 7, 7, 'Payment required before clearance', '', 'SELECTED', '2025-09-09 03:27:57', '2025-09-16 03:27:57', '2025-09-09 03:33:05', '2025-09-09 03:27:57', '2025-09-09 03:33:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_number` int(11) DEFAULT NULL,
  `branch_number` int(11) DEFAULT NULL,
  `charge_number` int(11) DEFAULT NULL,
  `charge_name` varchar(255) DEFAULT NULL,
  `charge_type` varchar(255) DEFAULT NULL,
  `flat_charge_amount` double(8,2) DEFAULT NULL,
  `percentage_charge_amount` int(11) DEFAULT NULL,
  `account_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id`, `institution_number`, `branch_number`, `charge_number`, `charge_name`, `charge_type`, `flat_charge_amount`, `percentage_charge_amount`, `account_status`, `created_at`, `updated_at`) VALUES
(1, 1001, 101, 101, 'Service Charge', 'percentage', NULL, 1, NULL, '2023-12-11 15:03:33', '2023-12-11 15:03:33'),
(2, 1001, 101, 101, 'Insurance', 'percentage', NULL, 2, NULL, '2023-12-11 15:04:05', '2023-12-11 15:04:05'),
(3, 1001, 101, 101, 'Form', 'percentage', NULL, 1, NULL, '2023-12-11 15:04:29', '2023-12-11 15:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `region_id`, `created_at`, `updated_at`) VALUES
(1, 'Ilala', 2, '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(2, 'Kinondoni', 2, '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(3, 'Temeke', 2, '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(4, 'Ubungo', 2, '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(5, 'Kigamboni', 2, '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(6, 'Arusha City', 1, '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(7, 'Meru', 1, '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(8, 'Ngorongoro', 1, '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(9, 'Karatu', 1, '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(10, 'Monduli', 1, '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(11, 'Dodoma City', 3, '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(12, 'Kondoa', 3, '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(13, 'Mpwapwa', 3, '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(14, 'Chamwino', 3, '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(15, 'Bahi', 3, '2025-04-10 16:18:16', '2025-04-10 16:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `clearing_forwarding_companies`
--

CREATE TABLE `clearing_forwarding_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `registration_number` varchar(100) NOT NULL,
  `tra_license_number` varchar(100) NOT NULL,
  `contact_person_name` varchar(255) NOT NULL,
  `contact_person_position` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `physical_address` text NOT NULL,
  `postal_address` varchar(255) DEFAULT NULL,
  `region` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `years_in_operation` int(11) DEFAULT NULL,
  `specializations` text DEFAULT NULL,
  `service_ports` text DEFAULT NULL,
  `average_clearance_time_days` int(11) DEFAULT NULL,
  `languages_supported` varchar(255) DEFAULT NULL,
  `operating_hours` varchar(255) DEFAULT NULL,
  `verification_documents` text DEFAULT NULL,
  `status` enum('PENDING','VERIFIED','APPROVED','SUSPENDED','REJECTED') DEFAULT 'PENDING',
  `verified_at` timestamp NULL DEFAULT NULL,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT 0.00,
  `total_applications_handled` int(11) DEFAULT 0,
  `average_response_time_hours` decimal(5,2) DEFAULT NULL,
  `success_rate_percentage` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clearing_forwarding_companies`
--

INSERT INTO `clearing_forwarding_companies` (`id`, `company_name`, `registration_number`, `tra_license_number`, `contact_person_name`, `contact_person_position`, `phone_number`, `email`, `physical_address`, `postal_address`, `region`, `city`, `website`, `years_in_operation`, `specializations`, `service_ports`, `average_clearance_time_days`, `languages_supported`, `operating_hours`, `verification_documents`, `status`, `verified_at`, `verified_by`, `rating`, `total_applications_handled`, `average_response_time_hours`, `success_rate_percentage`, `created_at`, `updated_at`) VALUES
(1, 'Dar Clearing Services Ltd', 'REG001', 'TRA001', 'John Mwangi', NULL, '+255712345001', 'info@darclearing.co.tz', 'Plot 123, Uhuru Street', NULL, 'Dar es Salaam', 'Dar es Salaam', NULL, NULL, '[\"electronics\",\"textiles\",\"food_beverages\",\"chemicals\",\"pharmaceuticals\",\"general_cargo\"]', '[\"tanga\",\"mwanza\",\"dodoma\"]', NULL, NULL, NULL, NULL, 'APPROVED', NULL, NULL, 0.00, 0, NULL, NULL, '2025-08-16 12:00:59', '2025-09-08 09:27:14'),
(2, 'Tanzania Customs Brokers', 'REG002', 'TRA002', 'Mary Kikwete', NULL, '+255712345002', 'contact@tzcustoms.co.tz', 'Plot 456, Samora Avenue', NULL, 'Dar es Salaam', 'Dar es Salaam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'APPROVED', NULL, NULL, 0.00, 0, NULL, NULL, '2025-08-16 12:00:59', '2025-08-16 12:00:59'),
(3, 'East Africa Forwarding Co.', 'REG003', 'TRA003', 'Ahmed Hassan', NULL, '+255712345003', 'info@eaforwarding.co.tz', 'Plot 789, Nyerere Road', NULL, 'Dar es Salaam', 'Dar es Salaam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'APPROVED', NULL, NULL, 0.00, 0, NULL, NULL, '2025-08-16 12:00:59', '2025-08-16 12:00:59'),
(4, 'JUma Alli', '2388456', '53654', 'Pevv gfhd', 'Admin', '0716815881', 'admin@gmail.com', 'Dar Es Salaam', '17004', 'Dar es salaam', 'Dar Es Salaam', '', 4, '[\"general_cargo\",\"vehicles\",\"machinery\",\"electronics\",\"textiles\",\"food_beverages\",\"chemicals\",\"pharmaceuticals\"]', '[\"dodoma\",\"dar_es_salaam\",\"mtwara\",\"tanga\",\"mwanza\"]', 4, 'any', 'monday to friday ', NULL, 'VERIFIED', NULL, NULL, 0.00, 0, NULL, NULL, '2025-08-16 11:25:14', '2025-08-16 14:32:14'),
(5, 'Max Rols CF agency', '73288353', 'erw45335', 'Percy Egno', 'MD', '0716815881', 'percyegno@gmail.com', 'Dar Es Salaam\n2113', '17004', 'Dar es salaam', 'Dar Es Salaam', '', 4, '[\"electronics\",\"textiles\",\"food_beverages\",\"chemicals\",\"pharmaceuticals\",\"general_cargo\"]', '[\"tanga\",\"mwanza\",\"mtwara\",\"dar_es_salaam\"]', 1, 'all language', 'Mon-friday 8000am to 1700am', NULL, 'APPROVED', NULL, NULL, 0.00, 0, NULL, NULL, '2025-09-08 09:50:02', '2025-09-08 09:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `account_number` bigint(20) DEFAULT NULL,
  `institution_id` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `registering_officer` varchar(255) DEFAULT NULL,
  `loan_officer` varchar(255) DEFAULT NULL,
  `approving_officer` varchar(255) DEFAULT NULL,
  `membership_type` varchar(255) DEFAULT NULL,
  `incorporation_number` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `mobile_phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `client_number` varchar(30) DEFAULT NULL,
  `registration_date` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `current_team_id` bigint(20) DEFAULT NULL,
  `profile_photo_path` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `client_status` varchar(255) NOT NULL DEFAULT 'PENDING',
  `next_of_kin_name` varchar(255) DEFAULT NULL,
  `next_of_kin_phone` varchar(255) DEFAULT NULL,
  `tin_number` varchar(255) DEFAULT NULL,
  `nida_number` varchar(255) DEFAULT NULL,
  `ref_number` varchar(255) DEFAULT NULL,
  `shares_ref_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nationarity` varchar(30) DEFAULT NULL,
  `member_exit_document` varchar(200) DEFAULT NULL,
  `end_membership_description` text DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `national_id` varchar(30) DEFAULT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `customer_code` varchar(255) DEFAULT NULL,
  `present_surname` varchar(255) DEFAULT NULL,
  `birth_surname` varchar(255) DEFAULT NULL,
  `number_of_spouse` int(11) DEFAULT NULL,
  `number_of_children` int(11) DEFAULT NULL,
  `classification_of_individual` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `country_of_birth` varchar(255) DEFAULT NULL,
  `fate_status` varchar(255) DEFAULT NULL,
  `social_status` varchar(255) DEFAULT NULL,
  `residency` varchar(255) DEFAULT NULL,
  `citizenship` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `employment` varchar(255) DEFAULT NULL,
  `employer_name` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `income_available` varchar(255) DEFAULT NULL,
  `monthly_expenses` varchar(255) DEFAULT NULL,
  `negative_status_of_individual` varchar(255) DEFAULT NULL,
  `tax_identification_number` varchar(255) DEFAULT NULL,
  `passport_number` varchar(255) DEFAULT NULL,
  `passport_issuer_country` varchar(255) DEFAULT NULL,
  `driving_license_number` varchar(255) DEFAULT NULL,
  `voters_id` varchar(255) DEFAULT NULL,
  `foreign_unique_id` varchar(255) DEFAULT NULL,
  `custom_id_number_1` varchar(255) DEFAULT NULL,
  `custom_id_number_2` varchar(255) DEFAULT NULL,
  `main_address` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `number_of_building` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `mobile_phone` varchar(255) DEFAULT NULL,
  `fixed_line` varchar(255) DEFAULT NULL,
  `web_page` varchar(255) DEFAULT NULL,
  `trade_name` text DEFAULT NULL,
  `legal_form` text DEFAULT NULL,
  `establishment_date` text DEFAULT NULL,
  `registration_country` text DEFAULT NULL,
  `industry_sector` text DEFAULT NULL,
  `registration_number` text DEFAULT NULL,
  `middle_names` text DEFAULT NULL,
  `is_employee` tinyint(1) NOT NULL DEFAULT 0,
  `employee_id` varchar(20) DEFAULT NULL,
  `monthly_income` varchar(30) DEFAULT NULL,
  `current_owner` varchar(30) DEFAULT NULL,
  `lender_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `account_number`, `institution_id`, `first_name`, `middle_name`, `last_name`, `branch`, `registering_officer`, `loan_officer`, `approving_officer`, `membership_type`, `incorporation_number`, `phone_number`, `mobile_phone_number`, `email`, `place_of_birth`, `marital_status`, `client_number`, `registration_date`, `address`, `notes`, `current_team_id`, `profile_photo_path`, `branch_id`, `client_status`, `next_of_kin_name`, `next_of_kin_phone`, `tin_number`, `nida_number`, `ref_number`, `shares_ref_number`, `created_at`, `updated_at`, `nationarity`, `member_exit_document`, `end_membership_description`, `full_name`, `amount`, `national_id`, `client_id`, `customer_code`, `present_surname`, `birth_surname`, `number_of_spouse`, `number_of_children`, `classification_of_individual`, `gender`, `date_of_birth`, `country_of_birth`, `fate_status`, `social_status`, `residency`, `citizenship`, `nationality`, `employment`, `employer_name`, `education`, `business_name`, `income_available`, `monthly_expenses`, `negative_status_of_individual`, `tax_identification_number`, `passport_number`, `passport_issuer_country`, `driving_license_number`, `voters_id`, `foreign_unique_id`, `custom_id_number_1`, `custom_id_number_2`, `main_address`, `street`, `number_of_building`, `postal_code`, `region`, `district`, `country`, `mobile_phone`, `fixed_line`, `web_page`, `trade_name`, `legal_form`, `establishment_date`, `registration_country`, `industry_sector`, `registration_number`, `middle_names`, `is_employee`, `employee_id`, `monthly_income`, `current_owner`, `lender_id`) VALUES
(32, NULL, NULL, 'Andrew', 'Andrew', 'Andrew', NULL, NULL, NULL, NULL, NULL, NULL, '0754244888', NULL, 'appsbongo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-17 08:17:07', '2024-01-17 08:17:07', NULL, NULL, NULL, NULL, 200000, '12345467890', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MBWENI', NULL, NULL, 'DAR ES SALAAM', 'ILALA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(33, NULL, NULL, 'MAEMBO', 'TUKUYU', 'MOYO', NULL, NULL, NULL, NULL, NULL, NULL, '0754244888', NULL, 'appsbongo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-17 14:49:12', '2024-01-17 14:49:12', NULL, NULL, NULL, NULL, NULL, '65655765687', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTUU', NULL, NULL, 'DAR ES SALAAM', 'ILALA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(34, NULL, NULL, 'MAEMBO', 'TUKUYU', 'MOYO', NULL, NULL, NULL, NULL, NULL, NULL, '0754244888', NULL, 'appsbongo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-17 14:49:54', '2024-01-17 14:49:54', NULL, NULL, NULL, NULL, NULL, '65655765687', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTUU', NULL, NULL, 'DAR ES SALAAM', 'ILALA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(35, NULL, NULL, 'MAEMBO', 'TUKUYU', 'MOYO', NULL, NULL, NULL, NULL, NULL, NULL, '0754244888', NULL, 'appsbongo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-17 14:51:23', '2024-01-17 14:51:23', NULL, NULL, NULL, NULL, NULL, '65655765687', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTUU', NULL, NULL, 'DAR ES SALAAM', 'ILALA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(36, NULL, NULL, 'MAEMBO', 'TUKUYU', 'MOYO', NULL, NULL, NULL, NULL, NULL, NULL, '0754244888', NULL, 'appsbongo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-17 14:52:21', '2024-01-17 14:52:21', NULL, NULL, NULL, NULL, NULL, '65655765687', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTUU', NULL, NULL, 'DAR ES SALAAM', 'ILALA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(37, NULL, NULL, 'LIGHT', 'ALONE', 'SASO', NULL, NULL, NULL, NULL, NULL, NULL, '0753244888', NULL, 'appsbongo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-18 08:11:06', '2024-01-18 08:11:06', NULL, NULL, NULL, NULL, NULL, '3222323444', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'WODA', NULL, NULL, 'DAR ES SALAAM', 'ILALA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(38, NULL, NULL, 'PASCAZIA', 'KOKUSHIBA', 'SHUBILA', NULL, NULL, NULL, NULL, NULL, NULL, '0754244888', NULL, 'appsbongo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-18 08:25:48', '2024-01-18 08:25:48', NULL, NULL, NULL, NULL, 35000000, '23434234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MWENGE', NULL, NULL, 'DAR ES SALAAM', 'ILALA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(39, NULL, NULL, 'PASCAZIA', 'KOKUSHIBA', 'SHUBILA', NULL, NULL, NULL, NULL, NULL, NULL, '0754244888', NULL, 'appsbongo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-18 08:26:42', '2024-01-18 08:26:42', NULL, NULL, NULL, NULL, 35000000, '23434234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MWENGE', NULL, NULL, 'DAR ES SALAAM', 'ILALA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(40, NULL, NULL, 'Edwin', NULL, 'Urasa', NULL, NULL, NULL, NULL, NULL, NULL, '+255757330260', NULL, 'edwin.urasa@creditinfo.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-29 18:58:06', '2024-01-29 18:58:06', NULL, NULL, NULL, NULL, 900000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(41, NULL, NULL, 'Edwin', NULL, 'Urasa', NULL, NULL, NULL, NULL, NULL, NULL, '+255757330260', NULL, 'edwin.urasa@creditinfo.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-29 18:59:32', '2024-01-29 18:59:32', NULL, NULL, NULL, NULL, 900000, '1223344566', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hai', NULL, NULL, 'moshi', 'moshi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(42, NULL, NULL, 'Flavia', 'Graham Gillespie', 'Larsen', NULL, NULL, NULL, NULL, NULL, NULL, '+1 (405) 103-3706', NULL, 'pyla@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-22 10:05:05', '2025-02-22 10:05:05', NULL, NULL, NULL, NULL, 600000000, '733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Et eos in maxime sed', NULL, NULL, 'Quibusdam tempor ex ', 'Dolore harum minim i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(43, NULL, NULL, 'Flavia', 'Graham Gillespie', 'Larsen', NULL, NULL, NULL, NULL, NULL, NULL, '+1 (405) 103-3706', NULL, 'pyla@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-22 10:06:18', '2025-02-22 10:06:18', NULL, NULL, NULL, NULL, 600000000, '733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Et eos in maxime sed', NULL, NULL, 'Quibusdam tempor ex ', 'Dolore harum minim i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(44, NULL, NULL, 'Flavia', 'Graham Gillespie', 'Larsen', NULL, NULL, NULL, NULL, NULL, NULL, '+1 (405) 103-3706', NULL, 'pyla@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-22 10:07:29', '2025-02-22 10:07:29', NULL, NULL, NULL, NULL, 600000000, '733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Et eos in maxime sed', NULL, NULL, 'Quibusdam tempor ex ', 'Dolore harum minim i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(45, NULL, NULL, 'Flavia', 'Graham Gillespie', 'Larsen', NULL, NULL, NULL, NULL, NULL, NULL, '+1 (405) 103-3706', NULL, 'pyla@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-22 10:09:36', '2025-02-22 10:09:36', NULL, NULL, NULL, NULL, 600000000, '733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Et eos in maxime sed', NULL, NULL, 'Quibusdam tempor ex ', 'Dolore harum minim i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(46, NULL, NULL, 'Flavia', 'Graham Gillespie', 'Larsen', NULL, NULL, NULL, NULL, NULL, NULL, '+1 (405) 103-3706', NULL, 'pyla@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-22 10:12:50', '2025-02-22 10:12:50', NULL, NULL, NULL, NULL, 600000000, '733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Et eos in maxime sed', NULL, NULL, 'Quibusdam tempor ex ', 'Dolore harum minim i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(47, NULL, NULL, 'Flavia', 'Graham Gillespie', 'Larsen', NULL, NULL, NULL, NULL, NULL, NULL, '+1 (405) 103-3706', NULL, 'pyla@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-22 10:13:42', '2025-02-22 10:13:42', NULL, NULL, NULL, NULL, 600000000, '733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Et eos in maxime sed', NULL, NULL, 'Quibusdam tempor ex ', 'Dolore harum minim i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(48, NULL, NULL, 'Flavia', 'Graham Gillespie', 'Larsen', NULL, NULL, NULL, NULL, NULL, NULL, '+1 (405) 103-3706', NULL, 'pyla@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-22 10:15:35', '2025-02-22 10:15:35', NULL, NULL, NULL, NULL, 600000000, '733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Et eos in maxime sed', NULL, NULL, 'Quibusdam tempor ex ', 'Dolore harum minim i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(49, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-16 17:42:27', '2025-03-16 17:42:27', NULL, NULL, NULL, NULL, 50000, '34345345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Et non odio est qui ', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(50, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-16 17:43:55', '2025-03-16 17:43:55', NULL, NULL, NULL, NULL, 50000, '34345345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Et non odio est qui ', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(51, NULL, NULL, 'Pevv', 'Richards', 'gfhd', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'fastcredit.tz@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-16 20:10:28', '2025-03-16 20:10:28', NULL, NULL, NULL, NULL, 60000, '23423', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dicta id vero bland', NULL, NULL, 'HBWJHQERHJGB', 'Suscipit deleniti eu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(52, NULL, NULL, 'Pevvre', '23erwr', 'gfhd', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'fastcredit.tz@gmail.com34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-16 20:14:56', '2025-03-16 20:14:56', NULL, NULL, NULL, NULL, 80000, '3424', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Natus odit et assume', NULL, NULL, '34dfs', 'Suscipit deleniti eu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(53, NULL, NULL, 'mwajuma', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-16 20:49:39', '2025-03-16 20:49:39', NULL, NULL, NULL, NULL, 10000, '556566', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Neque veniam aute q', NULL, NULL, 'HBWJHQERHJGB', 'Suscipit deleniti eu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(54, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 18:42:20', '2025-04-12 18:42:20', NULL, NULL, NULL, NULL, 5000, '576457675675678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'gfdhg', '500000', NULL, NULL),
(55, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 18:43:10', '2025-04-12 18:43:10', NULL, NULL, NULL, NULL, 5000, '576457675675678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'gfdhg', '500000', NULL, NULL),
(56, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 18:45:05', '2025-04-12 18:45:05', NULL, NULL, NULL, NULL, 5000, '576457675675678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'gfdhg', '500000', NULL, NULL),
(57, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 18:45:32', '2025-04-12 18:45:32', NULL, NULL, NULL, NULL, 5000, '576457675675678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'gfdhg', '500000', NULL, NULL),
(58, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 18:45:56', '2025-04-12 18:45:56', NULL, NULL, NULL, NULL, 5000, '576457675675678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'gfdhg', '500000', NULL, NULL),
(59, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 18:46:31', '2025-04-12 18:46:31', NULL, NULL, NULL, NULL, 5000, '576457675675678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'gfdhg', '500000', NULL, NULL),
(60, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 18:47:10', '2025-04-12 18:47:10', NULL, NULL, NULL, NULL, 5000, '576457675675678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'gfdhg', '500000', NULL, NULL),
(61, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 18:47:36', '2025-04-12 18:47:36', NULL, NULL, NULL, NULL, 5000, '576457675675678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'gfdhg', '500000', NULL, NULL),
(62, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 18:48:18', '2025-04-12 18:48:18', NULL, NULL, NULL, NULL, 5000, '576457675675678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'gfdhg', '500000', NULL, NULL),
(63, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 18:49:02', '2025-04-12 18:49:02', NULL, NULL, NULL, NULL, 5000, '576457675675678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'gfdhg', '500000', NULL, NULL),
(64, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 18:49:25', '2025-04-12 18:49:25', NULL, NULL, NULL, NULL, 5000, '576457675675678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'gfdhg', '500000', NULL, NULL),
(65, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 18:49:49', '2025-04-12 18:49:49', NULL, NULL, NULL, NULL, 5000, '576457675675678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'gfdhg', '500000', NULL, NULL),
(66, NULL, NULL, 'juma ', 'ally', 'mimin', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 19:44:58', '2025-04-12 19:44:58', NULL, NULL, NULL, NULL, 900000, '89687', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es Salaam', 'retgreg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '87988', '20000', NULL, '1'),
(67, NULL, NULL, 'Percy', 'Richards', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 20:16:35', '2025-04-12 20:16:35', NULL, NULL, NULL, NULL, 700000, '77', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Suscipit deleniti eu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '567487', '50000', NULL, '1'),
(68, NULL, NULL, 'Percy', 'Richards', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 20:22:00', '2025-04-12 20:22:00', NULL, NULL, NULL, NULL, 3000, '888', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'u8987', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '70000000', NULL, '1'),
(69, NULL, NULL, 'Percy', 'Richards', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 20:22:28', '2025-04-12 20:22:28', NULL, NULL, NULL, NULL, 3000, '888', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'u8987', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '70000000', NULL, '1'),
(70, NULL, NULL, 'Percy', 'Richards', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 20:22:55', '2025-04-12 20:22:55', NULL, NULL, NULL, NULL, 3000, '888', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'u8987', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '70000000', NULL, '1'),
(71, NULL, NULL, 'Percy', 'Richards', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12 20:23:35', '2025-04-12 20:23:35', NULL, NULL, NULL, NULL, 3000, '888', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'u8987', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '70000000', NULL, '1'),
(72, NULL, NULL, 'Percy', 'rt', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-13 05:52:59', '2025-04-13 05:52:59', NULL, NULL, NULL, NULL, 600000, 'rteh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'tye', 'tyry', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '45354', '49000', NULL, '1'),
(73, NULL, NULL, 'Percy', 'rt', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-13 05:53:41', '2025-04-13 05:53:41', NULL, NULL, NULL, NULL, 600000, 'rteh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'tye', 'tyry', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '45354', '49000', NULL, '1'),
(74, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-13 06:04:03', '2025-04-13 06:04:03', NULL, NULL, NULL, NULL, 2043245, 'rteh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'DAR ES SALAAM', 'rweer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '5000', NULL, '1'),
(75, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-13 06:07:09', '2025-04-13 06:07:09', NULL, NULL, NULL, NULL, 2043245, 'rteh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'DAR ES SALAAM', 'rweer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '5000', NULL, '1'),
(76, NULL, NULL, 'Pevv', 'Travis Carlson', 'gfhd', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'fastcredit.tz@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-13 18:18:09', '2025-04-13 18:18:09', NULL, NULL, NULL, NULL, 10000000, '45556546', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'HBWJHQERHJGB', 'Suscipit deleniti eu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '45354', '150000', NULL, '1'),
(77, NULL, NULL, 'Pevv', 'Travis Carlson', 'gfhd', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'fastcredit.tz@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-15 05:39:15', '2025-04-15 05:39:15', NULL, NULL, NULL, NULL, 300000, '34564654', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'HBWJHQERHJGB', 'Suscipit deleniti eu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '45354', '150000', NULL, '16'),
(78, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-15 10:41:12', '2025-04-15 10:41:12', NULL, NULL, NULL, NULL, 60000000, 'rteh7887798', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'HBWJHQERHJGB', 'Suscipit deleniti eu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '45354', '1300000', NULL, '16'),
(79, NULL, NULL, 'Pevv', 'Diaz', 'gfhd', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'fastcredit.tz@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-17 06:06:11', '2025-04-17 06:06:11', NULL, NULL, NULL, NULL, 42000, '4567890987', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'HBWJHQERHJGB', 'Nulla quos ipsa rer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '50000', NULL, '1'),
(80, NULL, NULL, 'Pevv', 'Richards', 'gfhd', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'percyegno@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-17 06:19:22', '2025-04-17 06:19:22', NULL, NULL, NULL, NULL, 570000, '456789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'HBWJHQERHJGB', 'tyry', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '600', NULL, '21'),
(81, NULL, NULL, 'Percy', 'Travis Carlson', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-30 10:06:40', '2025-04-30 10:06:40', NULL, NULL, NULL, NULL, 42000000, '897789799779', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es salaam', 'Deleniti sed nisi te', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '45354', '150000', NULL, '21'),
(82, NULL, NULL, 'JUMA ', 'MWENDESHA', 'MARABA', NULL, NULL, NULL, NULL, NULL, NULL, '0767582837', NULL, 'percyegno@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-10 17:55:05', '2025-05-10 17:55:05', NULL, NULL, NULL, NULL, 48000000, '20010322-90948-58898-70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'DAR ES SALAAM', 'ubungo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '45354', '3000000', NULL, '17'),
(83, NULL, NULL, 'JUMA ', 'MWENDESHA', 'MARABA', NULL, NULL, NULL, NULL, NULL, NULL, '0767582837', NULL, 'percyegno@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-10 17:57:19', '2025-05-10 17:57:19', NULL, NULL, NULL, NULL, 48000000, '20010322-90948-58898-70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'DAR ES SALAAM', 'ubungo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '45354', '3000000', NULL, '17'),
(84, NULL, NULL, 'Percy', 'Richards', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-12 08:05:49', '2025-06-12 08:05:49', NULL, NULL, NULL, NULL, 3590803.6, '45665765-78678-78978-98', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'tye', 'Dar Es Salaam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '500000', NULL, '22'),
(85, NULL, NULL, 'Percy', 'ROBERT', 'Egno', NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NEW CLIENT', NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-09 01:00:56', '2025-09-09 01:00:56', NULL, NULL, NULL, NULL, 7040000, '20765675-43675-46754-43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dar Es Salaam', NULL, NULL, 'Dar es Salaam', 'Dar Es Salaam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '15000000', NULL, '20');

-- --------------------------------------------------------

--
-- Table structure for table `contract_managements`
--

CREATE TABLE `contract_managements` (
  `id` int(11) NOT NULL,
  `contract_name` varchar(40) NOT NULL,
  `contract_description` varchar(255) NOT NULL,
  `contract_file_path` varchar(255) DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `vendorId` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contract_managements`
--

INSERT INTO `contract_managements` (`id`, `contract_name`, `contract_description`, `contract_file_path`, `startDate`, `endDate`, `vendorId`, `created_at`, `updated_at`, `status`) VALUES
(3, 'WAZAWA', 'DESCRIPTIONS', 'procurementContract/1697451854_98259aa7-f5af-4145-ae28-40abfb24f282.pdf', '2023-10-18 00:00:00', '2023-12-22 00:00:00', 1, '2023-10-16 10:24:14', '2023-10-16 10:24:14', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `dealer_reviews`
--

CREATE TABLE `dealer_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dealer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `review` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `car_dealer_id` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` varchar(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `permissions` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modules` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `institution_id`, `status`, `department_name`, `permissions`, `description`, `updated_at`, `created_at`, `modules`) VALUES
(1, '31', 'ACTIVE', 'MANAGEMENT', '[ \"9\", \"12\", \"16\",\"17\",  \"18\",  \"20\",\"21\"]', NULL, '2023-11-01 05:15:35', '2023-09-23 11:57:57', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\",\"23\",\"24\",\"25\",\"26\",\"49\",\"50\"]'),
(2, '31', 'ACTIVE', 'LENDERS', '[\"2\",\"7\",\"10\",\"11\",\"15\",\"20\",\"23\"]', NULL, '2023-11-01 05:15:35', '2023-09-23 11:57:57', '[\"1\", \"2\", \"3\", \"4\", \"5\", \"6\", \"7\", \"8\", \"10\", \"11\"]'),
(3, '31', 'ACTIVE', 'CAR DEALER', '[\"2\",\"7\",\"11\",\"14\",\"20\"]', NULL, '2023-11-01 05:15:35', '2023-09-23 11:57:57', '[\"1\", \"2\", \"3\", \"4\", \"5\", \"6\", \"7\", \"8\", \"9\", \"10\", \"11\", \"12\", \"13\"]'),
(4, NULL, 'PENDING', 'CUSTOMER', '[\"1\"]', 'For maintainance purposes', '2025-06-12 04:38:00', '2025-06-12 04:38:00', NULL),
(5, NULL, 'ACTIVE', 'CLEARANCE AND FOWARDING COMPANY', '[\"20\",\"22\"]', 'For maintainance purposes', '2025-06-12 04:38:38', '2025-06-12 04:38:38', NULL),
(6, NULL, 'ACTIVE', 'SHOP OWNER', '[\"20\",\"19\"]', 'Owns spare part shop(s)', '2025-09-07 18:40:48', '2025-09-07 18:40:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employer_verifications`
--

CREATE TABLE `employer_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(64) NOT NULL,
  `status` enum('pending','completed','expired') DEFAULT 'pending',
  `message_sent` text NOT NULL,
  `employer_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`employer_response`)),
  `responded_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employer_verifications`
--

INSERT INTO `employer_verifications` (`id`, `application_id`, `token`, `status`, `message_sent`, `employer_response`, `responded_at`, `expires_at`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 16, 'J54OaVHEkKBSJMfAl1xbUQMXb1AetRPf1bu80H0hqAaxAuaOKxXmwr7xN9ZzKtN2', 'pending', 'Dear Employer,\n\nWe are currently reviewing an application submitted by your employee. Kindly help us confirm the following:\n\n- Do you know this employee?\n- What is their position and employment status?\n- How long have they worked at your organization?\n- Would you recommend them for financial assistance?\n\nThank you for your support.\n\nRegards,\nyou actionaile', NULL, NULL, '2025-04-20 17:48:33', NULL, '2025-04-13 17:48:33', '2025-04-13 17:48:33'),
(2, 16, '2omsrSF2pMD5pjzYodIC1J22MmWcLGGwNkKqvyUwMdnCWdurQ8OGDVELQrN5dwPs', 'pending', 'Dear Employer,\n\nWe are currently reviewing an application submitted by your employee. Kindly help us confirm the following:\n\n- Do you know this employee?\n- What is their position and employment status?\n- How long have they worked at your organization?\n- Would you recommend them for financial assistance?\n\nThank you for your support.\n\nRegards,\nyou actionaile', NULL, NULL, '2025-04-20 17:48:37', NULL, '2025-04-13 17:48:37', '2025-04-13 17:48:37'),
(3, 16, 'IctrmIbiaJyuSCwviITWfuCj1xrF93rBnMdrPwBTPwN55PcFsevk207neo5mNtQF', 'pending', 'Dear Employer,\n\nWe are currently reviewing an application submitted by your employee. Kindly help us confirm the following:\n\n- Do you know this employee?\n- What is their position and employment status?\n- How long have they worked at your organization?\n- Would you recommend them for financial assistance?\n\nThank you for your support.\n\nRegards,\nyou actionaile', NULL, NULL, '2025-04-20 17:49:27', NULL, '2025-04-13 17:49:27', '2025-04-13 17:49:27'),
(4, 16, 'FprXkyPcv1H5vW3LkI4oPD1wItfjTxdc9hSxas0NjrfCJDHQnn6Mz6OwhGBZ86pD', 'pending', 'Dear Employer,\n\nWe are currently reviewing an application submitted by your employee. Kindly help us confirm the following:\n\n- Do you know this employee?\n- What is their position and employment status?\n- How long have they worked at your organization?\n- Would you recommend them for financial assistance?\n\nThank you for your support.\n\nRegards,\nyou actionaile', NULL, NULL, '2025-04-20 17:51:38', NULL, '2025-04-13 17:51:38', '2025-04-13 17:51:38'),
(5, 17, 'hwgfeDABRtx65Vp6Xe7jpBAo2r55RdLyhsF5ape0poNsexB0XvboujyUDfrbF1rB', 'completed', 'Dear Employer,\n\nWe are currently reviewing an application submitted by your employee. Kindly help us confirm the following:\n\n- Do you know this employee?\n- What is their position and employment status?\n- How long have they worked at your organization?\n- Would you recommend them for financial assistance?\n\nThank you for your support.\n\nRegards,\nLaravel', '{\"knows_employee\":\"yes\",\"position\":\"normal\",\"employment_status\":\"part-time\",\"employment_length\":\"3-5-years\",\"recommend\":\"yes\",\"comments\":\"this is not\"}', '2025-04-13 18:06:23', '2025-04-20 18:04:40', '127.0.0.1', '2025-04-13 18:04:40', '2025-04-13 18:06:23'),
(6, 20, 'TsnzaDM9Vb3UbZGbawEJLyNwu3vXwHy9id4B2VIZRabbxh0TjhwGuYYi5VgiyKfq', 'pending', 'Dear Employer,\n\nWe are currently reviewing an application submitted by your employee. Kindly help us confirm the following:\n\n- Do you know this employee?\n- What is their position and employment status?\n- How long have they worked at your organization?\n- Would you recommend them for financial assistance?\n\nThank you for your support.\n\nRegards,\nLaravel', NULL, NULL, '2025-04-20 18:41:15', NULL, '2025-04-13 18:41:15', '2025-04-13 18:41:15'),
(7, 21, 'lfy5uau6vORYUQH4kfybvWVX6FMMg0Bt0ptYwSBv1Txhgao7OVbwvTspiI3lYsf3', 'completed', 'Dear Employer,\n\nWe are currently reviewing an application submitted by your employee. Kindly help us confirm the following:\n\n- Do you know this employee?\n- What is their position and employment status?\n- How long have they worked at your organization?\n- Would you recommend them for financial assistance?\n\nThank you for your support.\n\nRegards,\nkibo', '{\"knows_employee\":\"yes\",\"position\":\"normal\",\"employment_status\":\"contract\",\"employment_length\":\"3-5-years\",\"recommend\":\"yes\",\"comments\":\"gfcghhjghjg\"}', '2025-04-15 05:43:12', '2025-04-22 05:41:56', '127.0.0.1', '2025-04-15 05:41:56', '2025-04-15 05:43:12'),
(8, 22, '0B6ORdZUi04X2h1ixq49G5lvrq1IjkE4qGG9y4JwifiL3ThwHZkUuM8Isl5LfBrx', 'completed', 'Dear Employer,\n\nWe are currently reviewing an application submitted by your employee. Kindly help us confirm the following:\n\n- Do you know this employee?\n- What is their position and employment status?\n- How long have they worked at your organization?\n- Would you recommend them for financial assistance?\n\nThank you for your support.\n\nRegards,\nkibo', '{\"knows_employee\":\"yes\",\"position\":\"normal\",\"employment_status\":\"contract\",\"employment_length\":\"3-5-years\",\"recommend\":\"yes\",\"comments\":\"gifygythtydubetrfyg\"}', '2025-04-15 10:43:51', '2025-04-22 10:42:45', '127.0.0.1', '2025-04-15 10:42:45', '2025-04-15 10:43:51'),
(9, 29, 'buRpIYxDI8pAigFfkADmtU1hMlzxJaYCdQv8Oo8UkJORhkCv7Dfv1vhe42IGhehH', 'pending', 'Dear Kato Parks,\n\nWe are currently reviewing an application submitted by your employee. Kindly help us confirm the following:\n\n- Do you know this employee?\n- What is their position and employment status?\n- How long have they worked at your organization?\n- Would you recommend them for financial assistance?\n\nThank you for your support.\n\nRegards,\nkibo', NULL, NULL, '2025-05-13 04:03:20', NULL, '2025-05-06 04:03:20', '2025-05-06 04:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `connection` text DEFAULT NULL,
  `queue` text DEFAULT NULL,
  `payload` text DEFAULT NULL,
  `exception` text DEFAULT NULL,
  `failed_at` timestamp NULL DEFAULT NULL,
  `user_id` char(10) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `username` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`, `user_id`, `ip_address`, `type`, `username`, `email`) VALUES
(1, '0333e1fa-af40-4aae-8147-24bca4727c84', 'database', 'default', '{\"uuid\":\"0333e1fa-af40-4aae-8147-24bca4727c84\",\"displayName\":\"App\\\\Jobs\\\\EndOfDay\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\EndOfDay\",\"command\":\"O:17:\\\"App\\\\Jobs\\\\EndOfDay\\\":0:{}\"}}', 'ErrorException: Attempt to read property \"loan_account_number\" on null in /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php:135\nStack trace:\n#0 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(270): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(135): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}()\n#2 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(46): App\\Jobs\\EndOfDay->loanPaymentWithNoArrears()\n#3 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\EndOfDay->handle()\n#4 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#5 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#6 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#7 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#8 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#9 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#10 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#11 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#12 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#13 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#14 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#15 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#16 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#17 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#18 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#19 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#20 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#21 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(147): Illuminate\\Queue\\Worker->daemon()\n#22 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(130): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#23 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#24 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#25 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#26 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#27 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#28 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(183): Illuminate\\Container\\Container->call()\n#29 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Command/Command.php(326): Illuminate\\Console\\Command->execute()\n#30 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(152): Symfony\\Component\\Console\\Command\\Command->run()\n#31 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(1063): Illuminate\\Console\\Command->run()\n#32 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(320): Symfony\\Component\\Console\\Application->doRunCommand()\n#33 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(174): Symfony\\Component\\Console\\Application->doRun()\n#34 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#35 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(155): Illuminate\\Console\\Application->run()\n#36 /var/www/html/microfinance/template/fastCredit/artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle()\n#37 {main}', '2023-11-27 19:25:36', NULL, NULL, NULL, NULL, NULL),
(2, 'b5950fc5-fb74-49e6-b153-a19a77864ec3', 'database', 'default', '{\"uuid\":\"b5950fc5-fb74-49e6-b153-a19a77864ec3\",\"displayName\":\"App\\\\Jobs\\\\EndOfDay\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\EndOfDay\",\"command\":\"O:17:\\\"App\\\\Jobs\\\\EndOfDay\\\":0:{}\"}}', 'ErrorException: Attempt to read property \"loan_account_number\" on null in /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php:135\nStack trace:\n#0 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(270): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(135): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}()\n#2 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(46): App\\Jobs\\EndOfDay->loanPaymentWithNoArrears()\n#3 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\EndOfDay->handle()\n#4 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#5 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#6 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#7 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#8 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#9 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#10 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#11 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#12 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#13 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#14 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#15 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#16 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#17 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#18 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#19 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#20 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#21 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(147): Illuminate\\Queue\\Worker->daemon()\n#22 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(130): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#23 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#24 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#25 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#26 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#27 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#28 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(183): Illuminate\\Container\\Container->call()\n#29 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Command/Command.php(326): Illuminate\\Console\\Command->execute()\n#30 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(152): Symfony\\Component\\Console\\Command\\Command->run()\n#31 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(1063): Illuminate\\Console\\Command->run()\n#32 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(320): Symfony\\Component\\Console\\Application->doRunCommand()\n#33 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(174): Symfony\\Component\\Console\\Application->doRun()\n#34 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#35 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(155): Illuminate\\Console\\Application->run()\n#36 /var/www/html/microfinance/template/fastCredit/artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle()\n#37 {main}', '2023-11-27 19:25:36', NULL, NULL, NULL, NULL, NULL),
(3, '307e9bfc-02e7-4199-a037-d91c3d03ac1a', 'database', 'default', '{\"uuid\":\"307e9bfc-02e7-4199-a037-d91c3d03ac1a\",\"displayName\":\"App\\\\Jobs\\\\EndOfDay\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\EndOfDay\",\"command\":\"O:17:\\\"App\\\\Jobs\\\\EndOfDay\\\":0:{}\"}}', 'ErrorException: Attempt to read property \"loan_account_number\" on null in /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php:135\nStack trace:\n#0 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(270): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(135): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}()\n#2 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(46): App\\Jobs\\EndOfDay->loanPaymentWithNoArrears()\n#3 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\EndOfDay->handle()\n#4 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#5 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#6 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#7 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#8 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#9 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#10 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#11 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#12 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#13 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#14 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#15 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#16 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#17 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#18 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#19 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#20 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#21 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(147): Illuminate\\Queue\\Worker->daemon()\n#22 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(130): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#23 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#24 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#25 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#26 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#27 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#28 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(183): Illuminate\\Container\\Container->call()\n#29 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Command/Command.php(326): Illuminate\\Console\\Command->execute()\n#30 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(152): Symfony\\Component\\Console\\Command\\Command->run()\n#31 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(1063): Illuminate\\Console\\Command->run()\n#32 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(320): Symfony\\Component\\Console\\Application->doRunCommand()\n#33 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(174): Symfony\\Component\\Console\\Application->doRun()\n#34 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#35 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(155): Illuminate\\Console\\Application->run()\n#36 /var/www/html/microfinance/template/fastCredit/artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle()\n#37 {main}', '2023-11-27 19:25:36', NULL, NULL, NULL, NULL, NULL),
(4, '5d74c720-97be-4af6-9d90-a5db798714c1', 'database', 'default', '{\"uuid\":\"5d74c720-97be-4af6-9d90-a5db798714c1\",\"displayName\":\"App\\\\Jobs\\\\EndOfDay\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\EndOfDay\",\"command\":\"O:17:\\\"App\\\\Jobs\\\\EndOfDay\\\":0:{}\"}}', 'ErrorException: Attempt to read property \"loan_account_number\" on null in /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php:135\nStack trace:\n#0 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(270): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(135): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}()\n#2 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(46): App\\Jobs\\EndOfDay->loanPaymentWithNoArrears()\n#3 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\EndOfDay->handle()\n#4 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#5 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#6 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#7 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#8 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#9 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#10 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#11 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#12 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#13 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#14 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#15 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#16 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#17 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#18 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#19 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#20 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#21 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(147): Illuminate\\Queue\\Worker->daemon()\n#22 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(130): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#23 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#24 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#25 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#26 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#27 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#28 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(183): Illuminate\\Container\\Container->call()\n#29 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Command/Command.php(326): Illuminate\\Console\\Command->execute()\n#30 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(152): Symfony\\Component\\Console\\Command\\Command->run()\n#31 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(1063): Illuminate\\Console\\Command->run()\n#32 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(320): Symfony\\Component\\Console\\Application->doRunCommand()\n#33 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(174): Symfony\\Component\\Console\\Application->doRun()\n#34 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#35 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(155): Illuminate\\Console\\Application->run()\n#36 /var/www/html/microfinance/template/fastCredit/artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle()\n#37 {main}', '2023-11-27 19:25:36', NULL, NULL, NULL, NULL, NULL),
(5, '7e8d229a-0a8b-4e26-b962-ea4749e311b4', 'database', 'default', '{\"uuid\":\"7e8d229a-0a8b-4e26-b962-ea4749e311b4\",\"displayName\":\"App\\\\Jobs\\\\EndOfDay\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\EndOfDay\",\"command\":\"O:17:\\\"App\\\\Jobs\\\\EndOfDay\\\":0:{}\"}}', 'ErrorException: Attempt to read property \"loan_account_number\" on null in /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php:135\nStack trace:\n#0 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(270): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(135): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}()\n#2 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(46): App\\Jobs\\EndOfDay->loanPaymentWithNoArrears()\n#3 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\EndOfDay->handle()\n#4 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#5 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#6 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#7 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#8 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#9 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#10 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#11 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#12 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#13 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#14 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#15 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#16 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#17 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#18 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#19 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#20 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#21 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(147): Illuminate\\Queue\\Worker->daemon()\n#22 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(130): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#23 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#24 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#25 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#26 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#27 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#28 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(183): Illuminate\\Container\\Container->call()\n#29 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Command/Command.php(326): Illuminate\\Console\\Command->execute()\n#30 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(152): Symfony\\Component\\Console\\Command\\Command->run()\n#31 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(1063): Illuminate\\Console\\Command->run()\n#32 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(320): Symfony\\Component\\Console\\Application->doRunCommand()\n#33 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(174): Symfony\\Component\\Console\\Application->doRun()\n#34 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#35 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(155): Illuminate\\Console\\Application->run()\n#36 /var/www/html/microfinance/template/fastCredit/artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle()\n#37 {main}', '2023-11-27 19:25:36', NULL, NULL, NULL, NULL, NULL),
(6, 'b0e853bb-4593-4e14-96b1-9962f8e6c183', 'database', 'default', '{\"uuid\":\"b0e853bb-4593-4e14-96b1-9962f8e6c183\",\"displayName\":\"App\\\\Jobs\\\\EndOfDay\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\EndOfDay\",\"command\":\"O:17:\\\"App\\\\Jobs\\\\EndOfDay\\\":0:{}\"}}', 'ErrorException: Attempt to read property \"loan_account_number\" on null in /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php:135\nStack trace:\n#0 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(270): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(135): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}()\n#2 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(46): App\\Jobs\\EndOfDay->loanPaymentWithNoArrears()\n#3 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\EndOfDay->handle()\n#4 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#5 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#6 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#7 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#8 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#9 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#10 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#11 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#12 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#13 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#14 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#15 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#16 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#17 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#18 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#19 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#20 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#21 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(147): Illuminate\\Queue\\Worker->daemon()\n#22 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(130): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#23 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#24 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#25 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#26 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#27 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#28 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(183): Illuminate\\Container\\Container->call()\n#29 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Command/Command.php(326): Illuminate\\Console\\Command->execute()\n#30 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(152): Symfony\\Component\\Console\\Command\\Command->run()\n#31 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(1063): Illuminate\\Console\\Command->run()\n#32 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(320): Symfony\\Component\\Console\\Application->doRunCommand()\n#33 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(174): Symfony\\Component\\Console\\Application->doRun()\n#34 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#35 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(155): Illuminate\\Console\\Application->run()\n#36 /var/www/html/microfinance/template/fastCredit/artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle()\n#37 {main}', '2023-11-27 19:25:36', NULL, NULL, NULL, NULL, NULL),
(7, 'c48eb889-fbe1-433f-b84e-554a3f97da86', 'database', 'default', '{\"uuid\":\"c48eb889-fbe1-433f-b84e-554a3f97da86\",\"displayName\":\"App\\\\Jobs\\\\EndOfDay\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\EndOfDay\",\"command\":\"O:17:\\\"App\\\\Jobs\\\\EndOfDay\\\":0:{}\"}}', 'ErrorException: Attempt to read property \"loan_account_number\" on null in /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php:135\nStack trace:\n#0 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(270): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(135): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}()\n#2 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(46): App\\Jobs\\EndOfDay->loanPaymentWithNoArrears()\n#3 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\EndOfDay->handle()\n#4 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#5 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#6 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#7 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#8 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#9 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#10 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#11 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#12 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#13 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#14 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#15 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#16 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#17 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#18 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#19 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#20 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#21 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(147): Illuminate\\Queue\\Worker->daemon()\n#22 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(130): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#23 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#24 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#25 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#26 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#27 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#28 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(183): Illuminate\\Container\\Container->call()\n#29 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Command/Command.php(326): Illuminate\\Console\\Command->execute()\n#30 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(152): Symfony\\Component\\Console\\Command\\Command->run()\n#31 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(1063): Illuminate\\Console\\Command->run()\n#32 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(320): Symfony\\Component\\Console\\Application->doRunCommand()\n#33 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(174): Symfony\\Component\\Console\\Application->doRun()\n#34 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#35 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(155): Illuminate\\Console\\Application->run()\n#36 /var/www/html/microfinance/template/fastCredit/artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle()\n#37 {main}', '2023-11-27 19:25:54', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`, `user_id`, `ip_address`, `type`, `username`, `email`) VALUES
(8, 'cf4aacce-f6a7-43da-b657-c5f67756e79b', 'database', 'default', '{\"uuid\":\"cf4aacce-f6a7-43da-b657-c5f67756e79b\",\"displayName\":\"App\\\\Jobs\\\\EndOfDay\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\EndOfDay\",\"command\":\"O:17:\\\"App\\\\Jobs\\\\EndOfDay\\\":0:{}\"}}', 'ErrorException: Attempt to read property \"loan_account_number\" on null in /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php:135\nStack trace:\n#0 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(270): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(135): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}()\n#2 /var/www/html/microfinance/template/fastCredit/app/Jobs/EndOfDay.php(46): App\\Jobs\\EndOfDay->loanPaymentWithNoArrears()\n#3 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\EndOfDay->handle()\n#4 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#5 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#6 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#7 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#8 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#9 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#10 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#11 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#12 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#13 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#14 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#15 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#16 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#17 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#18 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#19 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#20 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#21 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(147): Illuminate\\Queue\\Worker->daemon()\n#22 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(130): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#23 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#24 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#25 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#26 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#27 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#28 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(183): Illuminate\\Container\\Container->call()\n#29 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Command/Command.php(326): Illuminate\\Console\\Command->execute()\n#30 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(152): Symfony\\Component\\Console\\Command\\Command->run()\n#31 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(1063): Illuminate\\Console\\Command->run()\n#32 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(320): Symfony\\Component\\Console\\Application->doRunCommand()\n#33 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(174): Symfony\\Component\\Console\\Application->doRun()\n#34 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#35 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(155): Illuminate\\Console\\Application->run()\n#36 /var/www/html/microfinance/template/fastCredit/artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle()\n#37 {main}', '2023-11-27 19:28:09', NULL, NULL, NULL, NULL, NULL),
(9, 'a09cf548-4833-4369-a024-40eddabdacb2', 'database', 'default', '{\"uuid\":\"a09cf548-4833-4369-a024-40eddabdacb2\",\"displayName\":\"App\\\\Jobs\\\\EndOfDay\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\EndOfDay\",\"command\":\"O:17:\\\"App\\\\Jobs\\\\EndOfDay\\\":0:{}\"}}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\EndOfDay has been attempted too many times or run too long. The job may have previously timed out. in /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:746\nStack trace:\n#0 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(505): Illuminate\\Queue\\Worker->maxAttemptsExceededException()\n#1 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(414): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts()\n#2 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#3 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#4 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(147): Illuminate\\Queue\\Worker->daemon()\n#5 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(130): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#6 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#8 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#9 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#10 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Container/Container.php(661): Illuminate\\Container\\BoundMethod::call()\n#11 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(183): Illuminate\\Container\\Container->call()\n#12 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Command/Command.php(326): Illuminate\\Console\\Command->execute()\n#13 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Command.php(152): Symfony\\Component\\Console\\Command\\Command->run()\n#14 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(1063): Illuminate\\Console\\Command->run()\n#15 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(320): Symfony\\Component\\Console\\Application->doRunCommand()\n#16 /var/www/html/microfinance/template/fastCredit/vendor/symfony/console/Application.php(174): Symfony\\Component\\Console\\Application->doRun()\n#17 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#18 /var/www/html/microfinance/template/fastCredit/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(155): Illuminate\\Console\\Application->run()\n#19 /var/www/html/microfinance/template/fastCredit/artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle()\n#20 {main}', '2023-12-15 11:50:30', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Air Conditioning', 'Comfort', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(2, 'Power Steering', 'Comfort', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(3, 'Power Windows', 'Comfort', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(4, 'Power Door Locks', 'Comfort', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(5, 'Leather Seats', 'Interior', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(6, 'Sunroof', 'Comfort', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(7, 'Navigation System', 'Technology', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(8, 'Bluetooth', 'Technology', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(9, 'Backup Camera', 'Safety', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(10, 'Parking Sensors', 'Safety', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(11, 'Cruise Control', 'Comfort', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(12, 'Keyless Entry', 'Convenience', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(13, 'Push Button Start', 'Convenience', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(14, 'Alloy Wheels', 'Exterior', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(15, 'Roof Rack', 'Exterior', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(16, 'Tinted Windows', 'Exterior', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(17, 'Fog Lights', 'Exterior', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(18, 'LED Headlights', 'Exterior', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(19, 'Third Row Seating', 'Interior', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(20, 'Heated Seats', 'Comfort', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(21, 'Cooled Seats', 'Comfort', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(22, 'Blind Spot Monitoring', 'Safety', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(23, 'Lane Departure Warning', 'Safety', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(24, 'Adaptive Cruise Control', 'Safety', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(25, 'Apple CarPlay', 'Technology', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(26, 'Android Auto', 'Technology', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(27, 'Wireless Charging', 'Technology', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(28, 'Premium Sound System', 'Entertainment', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(29, 'Rear Entertainment System', 'Entertainment', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(30, 'Moonroof', 'Comfort', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(31, 'Air Conditioning', 'Comfort', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(32, 'Power Steering', 'Comfort', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(33, 'Power Windows', 'Comfort', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(34, 'Power Door Locks', 'Comfort', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(35, 'Leather Seats', 'Interior', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(36, 'Sunroof', 'Comfort', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(37, 'Navigation System', 'Technology', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(38, 'Bluetooth', 'Technology', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(39, 'Backup Camera', 'Safety', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(40, 'Parking Sensors', 'Safety', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(41, 'Cruise Control', 'Comfort', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(42, 'Keyless Entry', 'Convenience', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(43, 'Push Button Start', 'Convenience', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(44, 'Alloy Wheels', 'Exterior', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(45, 'Roof Rack', 'Exterior', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(46, 'Tinted Windows', 'Exterior', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(47, 'Fog Lights', 'Exterior', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(48, 'LED Headlights', 'Exterior', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(49, 'Third Row Seating', 'Interior', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(50, 'Heated Seats', 'Comfort', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(51, 'Cooled Seats', 'Comfort', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(52, 'Blind Spot Monitoring', 'Safety', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(53, 'Lane Departure Warning', 'Safety', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(54, 'Adaptive Cruise Control', 'Safety', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(55, 'Apple CarPlay', 'Technology', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(56, 'Android Auto', 'Technology', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(57, 'Wireless Charging', 'Technology', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(58, 'Premium Sound System', 'Entertainment', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(59, 'Rear Entertainment System', 'Entertainment', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(60, 'Moonroof', 'Comfort', '2025-04-30 08:35:30', '2025-04-30 08:35:30'),
(61, 'Air Conditioning', 'Comfort', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(62, 'Power Steering', 'Comfort', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(63, 'Power Windows', 'Comfort', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(64, 'Power Door Locks', 'Comfort', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(65, 'Leather Seats', 'Interior', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(66, 'Sunroof', 'Comfort', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(67, 'Navigation System', 'Technology', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(68, 'Bluetooth', 'Technology', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(69, 'Backup Camera', 'Safety', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(70, 'Parking Sensors', 'Safety', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(71, 'Cruise Control', 'Comfort', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(72, 'Keyless Entry', 'Convenience', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(73, 'Push Button Start', 'Convenience', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(74, 'Alloy Wheels', 'Exterior', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(75, 'Roof Rack', 'Exterior', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(76, 'Tinted Windows', 'Exterior', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(77, 'Fog Lights', 'Exterior', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(78, 'LED Headlights', 'Exterior', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(79, 'Third Row Seating', 'Interior', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(80, 'Heated Seats', 'Comfort', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(81, 'Cooled Seats', 'Comfort', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(82, 'Blind Spot Monitoring', 'Safety', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(83, 'Lane Departure Warning', 'Safety', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(84, 'Adaptive Cruise Control', 'Safety', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(85, 'Apple CarPlay', 'Technology', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(86, 'Android Auto', 'Technology', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(87, 'Wireless Charging', 'Technology', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(88, 'Premium Sound System', 'Entertainment', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(89, 'Rear Entertainment System', 'Entertainment', '2025-04-30 08:36:21', '2025-04-30 08:36:21'),
(90, 'Moonroof', 'Comfort', '2025-04-30 08:36:21', '2025-04-30 08:36:21');

-- --------------------------------------------------------

--
-- Table structure for table `feature_vehicle`
--

CREATE TABLE `feature_vehicle` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_types`
--

CREATE TABLE `fuel_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fuel_types`
--

INSERT INTO `fuel_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Petrol', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(2, 'Diesel', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(3, 'Hybrid', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(4, 'Electric', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(5, 'Plug-in Hybrid', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(6, 'Petrol', '2025-04-30 08:35:30', '2025-04-30 08:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `garages`
--

CREATE TABLE `garages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'Tanzania',
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `opening_hours` varchar(255) DEFAULT NULL,
  `services` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`services`)),
  `image` varchar(255) DEFAULT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT 0.00,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garages`
--

INSERT INTO `garages` (`id`, `name`, `description`, `address`, `city`, `state`, `zip_code`, `country`, `latitude`, `longitude`, `phone`, `email`, `website`, `opening_hours`, `services`, `image`, `rating`, `is_active`, `featured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AutoCare Express', 'Full-service automotive repair and maintenance with over 20 years of experience.', '123 Main Street', 'New York', 'NY', '10001', 'USA', 40.75890000, -73.98510000, '(555) 123-4567', 'info@autocareexpress.com', 'https://autocareexpress.com', 'Mon-Fri: 8AM-6PM, Sat: 8AM-4PM', '[\"Oil Change\",\"Brake Service\",\"Tire Service\",\"Engine Repair\",\"Inspection\"]', NULL, 4.50, 1, 1, '2025-07-05 09:43:11', '2025-07-21 09:36:47', '2025-07-21 09:36:47'),
(2, 'Quick Fix Garage', 'Fast and reliable automotive services for busy professionals.', '456 Broadway', 'New York', 'NY', '10013', 'USA', 40.72050000, -74.00500000, '(555) 234-5678', 'service@quickfixgarage.com', 'https://quickfixgarage.com', 'Mon-Sat: 7AM-7PM, Sun: 9AM-5PM', '[\"Oil Change\",\"Brake Service\",\"Battery Service\",\"Alignment\",\"Towing\"]', NULL, 4.20, 1, 0, '2025-07-05 09:43:11', '2025-09-08 07:46:39', '2025-09-08 07:46:39'),
(3, 'garage one', 'Quia sint similique ', 'Dar Es Salaam', 'Dar Es Salaam', 'Dar es salaam', '17004', 'Mexico', 78.90880000, -89.78999000, '0716815881', 'aleck.ngoshani@wealthora.co.tz', '', 'Deleniti blanditiis ', '[\"Towing\",\"Transmission Service\",\"Alignment\",\"Engine Repair\",\"Tire Service\",\"Air Conditioning\"]', NULL, 4.00, 1, 1, '2025-07-05 09:47:36', '2025-09-08 08:02:54', '2025-09-08 08:02:54'),
(4, 'Mlimani  city Garage', 'New garage located at mlimani mall at kiliwa street ', 'Dar Es Salaam', 'Dar Es Salaam', 'DAR ES SALAAM', '17004', 'USA', 12.34400000, 34.45000000, '0716815882', 'fastcredit.tz@gmail.com', '', 'Mon- Fri 8000am 1800pm', '[\"Towing\",\"Detailing\",\"Fuel System\",\"Alignment\",\"Transmission Service\",\"Fleet Services\",\"Hybrid\\/Electric Vehicle Service\",\"Electrical Repair\",\"Suspension Repair\",\"Inspection\",\"OBD diagnostics\",\"Exhaust System\",\"Cooling System\",\"Bodywork\",\"Performance Upgrades\",\"Pre-purchase Inspection\",\"Warranty Repairs\"]', 'garages/F8ECggtM1Juh3lRTRJSNqVVTDZTE6KyuQzx7GJwo.png', 4.00, 1, 1, '2025-09-08 06:54:57', '2025-09-08 06:55:50', NULL),
(5, 'Makumbusho ', 'Located in the heart of Dar es Salaam, Makumbusho Garage is your trusted local auto repair and service center. We specialize in a wide range of automotive services, including mechanical repairs, diagnostics, routine maintenance, electrical systems, brake and suspension work, and engine servicing.\n\nWith a team of experienced and certified mechanics, we pride ourselves on delivering reliable, affordable, and efficient services to keep your vehicle running at its best. Whether it’s a small car, SUV, or commercial vehicle, we handle every job with professionalism and care.\n\nAt Makumbusho Garage, customer satisfaction and transparency come first. Drive in with confidence—drive out with peace of mind.', 'Dar Es Salaam', 'Dar Es Salaam', 'Dar es salaam', '17004', 'Tanzania', -6.79235400, 39.20832800, '0716815881', 'fastcredit.tz@gmail.com', '', 'Mon- Sunday 8000am to 1900pm. ', '[\"Emissions Testing\",\"Oil Change\",\"Engine Repair\",\"Battery Service\",\"Towing\",\"Fuel System\",\"OBD diagnostics\",\"Alignment\",\"Electrical Repair\",\"Windshield Replacement\",\"Hybrid\\/Electric Vehicle Service\",\"Paintless Dent Repair\",\"Detailing\",\"Custom Modifications\",\"Pre-purchase Inspection\",\"Fleet Services\",\"Warranty Repairs\"]', 'garages/ZJYsAIJHfNyCzi5E4K0nH1DRK02bEONzm0fynFaS.png', 0.00, 1, 1, '2025-09-08 07:41:46', '2025-09-08 07:41:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` varchar(55) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `loan_id`, `url`, `created_at`, `updated_at`) VALUES
(1, '1234', 'assets/img/cars/8CG1yclSAiKZEiF779DVwq5c6MPI6vh2d16b8O2p.avif', '2025-03-12 13:07:40', '2025-03-12 13:07:40'),
(2, '1234', 'assets/img/cars/lKLqbBvGuulFhS08QovDssWDnnQnyCWaPUvYRywv.png', '2025-03-12 13:07:40', '2025-03-12 13:07:40'),
(3, '1234', 'assets/img/cars/c7IbN4hu1N3SL2cvFCakKPK4SrNGKb23OSQAYCVC.png', '2025-03-12 13:07:40', '2025-03-12 13:07:40'),
(4, '1234', 'assets/img/cars/F1xjwBH7ZBKVEmNfGdldCxQ6lOvG2AR2Xv3ZDN7f.png', '2025-03-12 13:07:40', '2025-03-12 13:07:40'),
(5, '1234', 'assets/img/cars/wkTKrGCRkU70X1w8nxByKOWqsDObJsmp11bYMoor.png', '2025-03-12 13:07:40', '2025-03-12 13:07:40'),
(6, '1234', 'assets/img/cars/i74nwfRcJ1nUO65WBqjC2nhbJH0X8hPiW8nTPo46.png', '2025-03-12 13:07:40', '2025-03-12 13:07:40'),
(7, '1234', 'assets/img/cars/Yin3Ktkk8JgPLtxu5fmdPmmFVPOsm56Hv1HGi7Cp.png', '2025-03-12 13:07:40', '2025-03-12 13:07:40'),
(8, '1234', 'assets/img/cars/wNDPj2sq3ugnP2F9ZrZCPvTQAoSKuliC7mijVIAW.png', '2025-03-12 13:07:40', '2025-03-12 13:07:40'),
(9, '1234', 'assets/img/cars/F4liQiVDHL9v6dgdIUcVRGMGivdiKyyQ5VU3UtfA.png', '2025-03-14 09:52:52', '2025-03-14 09:52:52'),
(10, '1234', 'assets/img/cars/LFlDfgzNswXnduE78RmXPhfl4DxkeafAACxWEz5u.png', '2025-03-14 09:53:01', '2025-03-14 09:53:01'),
(11, '1234', 'assets/img/cars/jG8Aym7IFJIZXzGX8I3VBtSIxnVUtIAPZ55fCTbL.png', '2025-03-14 09:53:05', '2025-03-14 09:53:05'),
(12, '1234', 'assets/img/cars/bRW6fT3pko1EiP0nGHx29TGderS3rUWSwhh4yU3c.png', '2025-03-14 09:53:11', '2025-03-14 09:53:11'),
(13, '1234', 'assets/img/cars/xJZjglwvTABiVUlcw43GJgOEGuMstBtDWGvSfgjJ.png', '2025-03-14 09:53:11', '2025-03-14 09:53:11'),
(14, '1234', 'assets/img/cars/hfu0ppltee1aS8Fk4PvbqjG8icaSL4aB9rhtId01.png', '2025-03-14 09:53:11', '2025-03-14 09:53:11'),
(15, '180', 'assets/img/cars/YsxUWBkc4euRPjwu92BalGUXBBjju4ZTAlGCLBmY.png', '2025-03-14 09:53:11', '2025-03-14 09:53:11'),
(16, '1234', 'assets/img/cars/vuPQ8THj8xz2KSQIepOijJIfUppCHEwrIBb9u4pc.png', '2025-03-14 09:53:11', '2025-03-14 09:53:11'),
(17, '1234', 'assets/img/cars/c9cpqUso4IPeTv3uUNieGgSSkn1DM2wOiJyEDhAp.png', '2025-03-16 20:10:22', '2025-03-16 20:10:22'),
(18, '1234', 'assets/img/cars/ci152r2JA0MPqj0bQAZUBYeN65I3gha3clh5wzlz.png', '2025-03-16 20:10:22', '2025-03-16 20:10:22'),
(19, '1234', 'assets/img/cars/QhzLcsyz2mOVyD1cSUf6rfd8Pd2MwsLYtnKNqlTQ.png', '2025-03-16 20:10:22', '2025-03-16 20:10:22'),
(20, '180', 'assets/img/cars/Z7mQDYINx4DtZJ54w154mMJWsaWu1GTNp3Br8hR4.png', '2025-03-16 20:10:22', '2025-03-16 20:10:22'),
(21, '173', 'assets/img/cars/l583SJRZrQ2uscAiXIsie6lad6LgAIj2zOSf2gaR.png', '2025-03-16 20:14:50', '2025-03-16 20:14:50'),
(22, '173', 'assets/img/cars/cJTzRVJRff1c679CZQvoDaomATZs7123QdpmqjBA.png', '2025-03-16 20:14:50', '2025-03-16 20:14:50'),
(23, '180', 'assets/img/cars/yskI7m5rpv3MUSP5pOm50LjwtTMnc7sTwUssrolN.png', '2025-03-16 20:14:50', '2025-03-16 20:14:50'),
(24, '173', 'assets/img/cars/Q3PZrMHKz1IWqmPMu7IyQ29mozdQvzXpZhTxZykp.png', '2025-03-16 20:14:50', '2025-03-16 20:14:50'),
(25, '189', 'assets/img/cars/67fb7ebd43892.png', '2025-04-13 06:07:09', '2025-04-13 06:07:09'),
(26, '189', 'assets/img/cars/67fb7ebd449fb.png', '2025-04-13 06:07:09', '2025-04-13 06:07:09'),
(27, '189', 'assets/img/cars/67fb7ebd44ec1.png', '2025-04-13 06:07:09', '2025-04-13 06:07:09'),
(28, '190', 'assets/img/cars/67fc2a112115d.png', '2025-04-13 18:18:09', '2025-04-13 18:18:09'),
(29, '190', 'assets/img/cars/67fc2a1121bd8.png', '2025-04-13 18:18:09', '2025-04-13 18:18:09'),
(30, '190', 'assets/img/cars/67fc2a112212c.png', '2025-04-13 18:18:09', '2025-04-13 18:18:09'),
(31, '190', 'assets/img/cars/67fc2a1122572.png', '2025-04-13 18:18:09', '2025-04-13 18:18:09'),
(32, '190', 'assets/img/cars/67fc2a1122c47.png', '2025-04-13 18:18:09', '2025-04-13 18:18:09'),
(33, '191', 'assets/img/cars/67fe1b3399ba7.png', '2025-04-15 05:39:15', '2025-04-15 05:39:15'),
(34, '191', 'assets/img/cars/67fe1b339a918.png', '2025-04-15 05:39:15', '2025-04-15 05:39:15'),
(35, '191', 'assets/img/cars/67fe1b339adac.png', '2025-04-15 05:39:15', '2025-04-15 05:39:15'),
(36, '191', 'assets/img/cars/67fe1b339b235.png', '2025-04-15 05:39:15', '2025-04-15 05:39:15'),
(37, '191', 'assets/img/cars/67fe1b339b5a5.png', '2025-04-15 05:39:15', '2025-04-15 05:39:15'),
(38, '191', 'assets/img/cars/67fe1b339baee.png', '2025-04-15 05:39:15', '2025-04-15 05:39:15'),
(39, '191', 'assets/img/cars/67fe1b339c034.png', '2025-04-15 05:39:15', '2025-04-15 05:39:15'),
(40, '192', 'assets/img/cars/67fe61f846d26.png', '2025-04-15 10:41:12', '2025-04-15 10:41:12'),
(41, '192', 'assets/img/cars/67fe61f8476ce.png', '2025-04-15 10:41:12', '2025-04-15 10:41:12'),
(42, '192', 'assets/img/cars/67fe61f847adc.png', '2025-04-15 10:41:12', '2025-04-15 10:41:12'),
(43, '192', 'assets/img/cars/67fe61f847dff.png', '2025-04-15 10:41:12', '2025-04-15 10:41:12'),
(44, '192', 'assets/img/cars/67fe61f8480ac.png', '2025-04-15 10:41:12', '2025-04-15 10:41:12'),
(45, '193', 'assets/img/cars/6800c48322d7c.png', '2025-04-17 06:06:11', '2025-04-17 06:06:11'),
(46, '193', 'assets/img/cars/6800c483235ef.png', '2025-04-17 06:06:11', '2025-04-17 06:06:11'),
(47, '194', 'assets/img/cars/6800c79a3bcb7.png', '2025-04-17 06:19:22', '2025-04-17 06:19:22'),
(48, '194', 'assets/img/cars/6800c79a3c628.png', '2025-04-17 06:19:22', '2025-04-17 06:19:22'),
(49, '195', 'assets/img/cars/681220601d647.png', '2025-04-30 10:06:40', '2025-04-30 10:06:40'),
(50, '197', 'assets/img/cars/681fbdafa455d.png', '2025-05-10 17:57:19', '2025-05-10 17:57:19'),
(51, '197', 'assets/img/cars/681fbdafa5150.png', '2025-05-10 17:57:19', '2025-05-10 17:57:19'),
(52, '197', 'assets/img/cars/681fbdafa54c3.png', '2025-05-10 17:57:19', '2025-05-10 17:57:19'),
(53, '198', 'assets/img/cars/684ab48d4fabd.png', '2025-06-12 08:05:49', '2025-06-12 08:05:49'),
(54, '199', 'assets/img/cars/68bfa6788949f.png', '2025-09-09 01:00:56', '2025-09-09 01:00:56');

-- --------------------------------------------------------

--
-- Table structure for table `import_duty_applications`
--

CREATE TABLE `import_duty_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_number` varchar(50) NOT NULL,
  `applicant_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `national_id` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `vehicle_make` varchar(100) NOT NULL,
  `vehicle_model` varchar(100) NOT NULL,
  `vehicle_year` int(11) NOT NULL,
  `vehicle_vin` varchar(50) DEFAULT NULL,
  `vehicle_color` varchar(50) NOT NULL,
  `vehicle_mileage` bigint(20) DEFAULT NULL,
  `vehicle_engine_size` varchar(50) DEFAULT NULL,
  `cif_value_usd` decimal(15,2) NOT NULL,
  `cif_value_tzs` decimal(15,2) NOT NULL,
  `currency_rate` decimal(10,4) NOT NULL,
  `bill_of_lading` varchar(255) DEFAULT NULL,
  `commercial_invoice` varchar(255) DEFAULT NULL,
  `packing_list` varchar(255) DEFAULT NULL,
  `certificate_of_origin` varchar(255) DEFAULT NULL,
  `shipping_documents` text DEFAULT NULL,
  `port_of_entry` varchar(100) DEFAULT 'Dar es Salaam',
  `expected_arrival_date` date DEFAULT NULL,
  `status` enum('DRAFT','SUBMITTED','CF_QUOTATION','CF_SELECTED','LENDER_REVIEW','APPROVED','REJECTED','PROCESSING','DUTY_PAID','COMPLETED') DEFAULT 'DRAFT',
  `application_type` enum('PURCHASED','WANT_TO_BUY') DEFAULT 'PURCHASED',
  `car_listing_url` varchar(255) DEFAULT NULL,
  `extracted_car_image` varchar(255) DEFAULT NULL,
  `extracted_car_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extracted_car_details`)),
  `selected_cf_company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `selected_lender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_duty_amount` decimal(15,2) DEFAULT NULL,
  `financing_amount` decimal(15,2) DEFAULT NULL,
  `down_payment` decimal(15,2) DEFAULT NULL,
  `loan_tenure_months` int(11) DEFAULT NULL,
  `interest_rate` decimal(5,2) DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `cf_deadline` timestamp NULL DEFAULT NULL,
  `lender_deadline` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `import_duty_applications`
--

INSERT INTO `import_duty_applications` (`id`, `application_number`, `applicant_name`, `phone_number`, `email`, `national_id`, `address`, `vehicle_make`, `vehicle_model`, `vehicle_year`, `vehicle_vin`, `vehicle_color`, `vehicle_mileage`, `vehicle_engine_size`, `cif_value_usd`, `cif_value_tzs`, `currency_rate`, `bill_of_lading`, `commercial_invoice`, `packing_list`, `certificate_of_origin`, `shipping_documents`, `port_of_entry`, `expected_arrival_date`, `status`, `application_type`, `car_listing_url`, `extracted_car_image`, `extracted_car_details`, `selected_cf_company_id`, `selected_lender_id`, `total_duty_amount`, `financing_amount`, `down_payment`, `loan_tenure_months`, `interest_rate`, `submitted_at`, `cf_deadline`, `lender_deadline`, `approved_at`, `created_at`, `updated_at`) VALUES
(1, 'ID20250001', 'ADMIN', '0767582817', 'admin@gmail.com', '20002093-92883-34389-43', 'Dar Es Salaam', 'toyota', 'prado', 2020, '132343', 'white', 2000, '2', 150000.00, 345000000.00, 2300.0000, 'import-duty/bills-of-lading/iOASpojUfRlsbCzegfmoR2shF9uNboeJ2SYKKab7.png', 'import-duty/commercial-invoices/RqvG2uHUlkCrzRBrBsZHnSRyD09f7MKzW5RPeGqJ.png', 'import-duty/packing-lists/bk2FBU6qxFWvYYTtA8TH0IkyxYjPcnY3F8g0TNwP.png', 'import-duty/certificates/Bg8silj7owuxqn9mq8MYVfJiW5c0jrv9g3W0mAWv.png', NULL, 'Dar es Salaam', '2025-08-24', 'SUBMITTED', 'PURCHASED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, '2025-08-16 09:24:31', '2025-08-18 09:24:31', NULL, NULL, '2025-08-16 09:24:31', '2025-08-16 09:24:31'),
(2, 'ID20250002', 'ADMIN', '0767582817', 'admin@gmail.com', '20002093-92883-34389-43', 'Dar Es Salaam', 'toyota', 'prado', 2020, '132343', 'white', 2000, '2', 150000.00, 345000000.00, 2300.0000, 'import-duty/bills-of-lading/xFnCp5YC0Wjw16jnLnBy8i3T2SVuonB6Hf1wpaMZ.png', 'import-duty/commercial-invoices/lt9dpX30GoLLWkE8ulqVMgHxKKd5FG3hS5ZGdfM4.png', 'import-duty/packing-lists/Z2Xf3uWeMEufu7sSagvl9V8289erl75ySlYLHerY.png', 'import-duty/certificates/O1xyVzfuRIxmekNlteOU1samnauFsysYuBMkQDaM.png', NULL, 'Dar es Salaam', '2025-08-24', 'COMPLETED', 'PURCHASED', NULL, NULL, NULL, 4, 22, 1738000.00, 1390400.02, 347599.98, 36, 18.00, '2025-08-16 09:24:50', '2025-08-18 09:24:50', NULL, '2025-08-16 17:37:22', '2025-08-16 09:24:50', '2025-08-16 18:51:26'),
(3, 'ID20250003', 'ADMIN', '0767582817', 'admin@gmail.com', '20002093-92883-34389-43', 'Dar Es Salaam\n2113', 'toyota', 'prado', 2020, '132343', 'white', 1200, '2', 600000.00, 1380000000.00, 2300.0000, 'import-duty/bills-of-lading/YBtw8DD4U5oIuC3lF8eQNxyceKVAuAxcOB5iTt8w.jpg', 'import-duty/commercial-invoices/YZm8CsJToZgKzytKfhcHENcnIXo5YjG5SPmfvIFm.png', 'import-duty/packing-lists/ACy7fSBNTwAGY7R5SQ4s1ZWt2dg0ecKL9eEfAQLS.png', 'import-duty/certificates/HAgVGqTh0SQDKElqmROVkiXiD24oBS0SCAjTdU5w.png', NULL, 'Dar es Salaam', '2025-08-31', 'APPROVED', 'PURCHASED', NULL, NULL, NULL, 4, 22, 8000000.00, 6400000.00, 1600000.00, 36, 18.00, '2025-08-25 11:17:58', '2025-08-27 11:17:58', NULL, '2025-08-25 11:32:07', '2025-08-25 11:17:58', '2025-08-25 11:32:07'),
(4, 'ID20250004', 'ADMIN', '0767582817', 'admin@gmail.com', '20002093-92883-34389-43', 'Dar Es Salaam\n2113', 'BMW', 'prado', 2010, '1323478', 'white', 400, '2', 50000.00, 115000000.00, 2300.0000, 'import-duty/bills-of-lading/4lQpOuQ0cza4cI279mHbdOw2oU6QqrDFdlAcLoue.jpg', 'import-duty/commercial-invoices/Psa4sxLjiPSK2ZdvwcZxxcbqmZJyCQV4JxJPpYQ2.jpg', 'import-duty/packing-lists/Nau3qtuzCEOjAaQk3aTw1PN29okM9OPuJcasUJ3V.jpg', 'import-duty/certificates/7P1Enncqbfu7ChVeNYI9k5qoouHTqMgnAHUyb1Mm.jpg', NULL, 'Dar es Salaam', '2025-09-04', 'APPROVED', 'PURCHASED', NULL, NULL, NULL, 4, 22, 10200.00, 8160.00, 2040.00, 36, 18.00, '2025-08-27 11:51:36', '2025-08-29 11:51:36', NULL, '2025-08-27 12:01:35', '2025-08-27 11:51:36', '2025-08-27 12:01:35'),
(5, 'ID20250005', 'ADMIN', '0767582817', 'admin@gmail.com', '20002093-92883-34389-43', 'Dar Es Salaam', 'toyota', 'prado', 2025, '13234334w', 'white', 1200, '2', 150000.00, 345000000.00, 2300.0000, 'import-duty/bills-of-lading/AdAkIx14T5uxPCJgdY33dClRXMypwY8USdM43rXP.jpg', 'import-duty/commercial-invoices/hVM7gfG3UXxjHkQlJs71xRFSEy223bXFXZpC8brB.jpg', 'import-duty/packing-lists/lfoguELio5x2bNINawrq66UAwOcwJCzJvIFPCFtS.jpg', 'import-duty/certificates/cNdl9JUt2otFevUfYYCoL9gTBW5q0ne4a6G1o5Bt.jpg', NULL, 'Mtwara', '2025-09-10', 'CF_QUOTATION', 'PURCHASED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 36, NULL, '2025-09-07 20:21:29', '2025-09-09 20:21:29', NULL, NULL, '2025-09-07 20:21:29', '2025-09-08 10:09:37'),
(6, 'ID20250006', 'Percy Egno', '+255716815889', 'percyegno@gmail.com', '20002093-92883-34389-43', 'Dar Es Salaam\n2113', 'Toyota', 'prado', 1999, NULL, 'White', 400, '2021L', 56000.00, 128800000.00, 2300.0000, NULL, NULL, NULL, NULL, NULL, 'Dar es Salaam', '2025-10-12', 'APPROVED', 'WANT_TO_BUY', 'https://www.beforward.jp/toyota/land-cruiser-prado/ca330391/id/12415211/', NULL, '{\"title\":\"Used 2021 TOYOTA LAND CRUISER PRADO TX-L PACKAGE sunroof 7-seater\\/3BA-TRJ150W for Sale CA330391 - BE FORWARD\",\"price\":\"$49,000\",\"year\":\"1999\",\"make\":\"Toyota\",\"mileage\":\"37,819\",\"color\":\"White\",\"engine_size\":\"2021L\",\"transmission\":\"automatic\",\"fuel_type\":\"Hybrid\",\"description\":\"Used 2021 TOYOTA LAND CRUISER PRADO TX-L PACKAGE sunroof 7-seater\\/3BA-TRJ150W for sale. Find an affordable Used TOYOTA LAND CRUISER PRADO with No.1 Japanese used car exporter BE FORWARD.\",\"location\":\".search.indexOf(\'_vwo_xhr\')!==-1){this.addScript({src:o})}else{this.load(o+\'&x=true\')}}};w._vwo_code=code;code.init();})();\"}', 5, 19, 2136030.00, 1708824.00, 427206.00, 36, 18.00, '2025-09-09 02:56:03', '2025-09-11 02:56:03', NULL, '2025-09-09 04:24:28', '2025-09-09 02:56:03', '2025-09-09 04:24:28');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `dealer_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(255) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `make_and_model` varchar(255) DEFAULT NULL,
  `year_of_manufacture` varchar(255) DEFAULT NULL,
  `vin` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `mileage` varchar(255) DEFAULT NULL,
  `purchase_price` varchar(11) DEFAULT NULL,
  `down_payment` varchar(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `current_owner` varchar(100) DEFAULT NULL,
  `dealer_name` varchar(50) DEFAULT NULL,
  `dealer_contact` varchar(50) DEFAULT NULL,
  `lender_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `make_and_model`, `year_of_manufacture`, `vin`, `color`, `mileage`, `purchase_price`, `down_payment`, `created_at`, `updated_at`, `current_owner`, `dealer_name`, `dealer_contact`, `lender_id`) VALUES
(1, 'TOYOTA', '2004', '64646767', 'WHITE', '80000', '30000000', '10000000', '2024-01-17 14:49:54', '2024-01-17 14:49:54', NULL, NULL, NULL, NULL),
(2, 'TOYOTA', '2004', '64646767', 'WHITE', '80000', '30000000', '10000000', '2024-01-17 14:51:23', '2024-01-17 14:51:23', NULL, NULL, NULL, NULL),
(3, 'TOYOTA', '2004', '64646767', 'WHITE', '80000', '30000000', '10000000', '2024-01-17 14:52:21', '2024-01-17 14:52:21', NULL, NULL, NULL, NULL),
(4, 'TOYOTA', '1999', '363365645', 'BLACK', '500000', '70000000', '30000000', '2024-01-18 08:11:06', '2024-01-18 08:11:06', NULL, NULL, NULL, NULL),
(5, 'NISSAN', '2009', '5435456456', 'SILVER', '60000', '45000000', '10000000', '2024-01-18 08:25:48', '2024-01-18 08:25:48', NULL, NULL, NULL, NULL),
(6, 'NISSAN', '2009', '5435456456', 'SILVER', '60000', '45000000', '10000000', '2024-01-18 08:26:42', '2024-01-18 08:26:42', NULL, NULL, NULL, NULL),
(7, 'toyota', '2021', '122223333333', 'white', '20000', '1000000', '100000', '2024-01-29 18:58:06', '2024-01-29 18:58:06', NULL, NULL, NULL, NULL),
(8, 'toyota', '2021', '122223333333', 'white', '20000', '1000000', '100000', '2024-01-29 18:59:32', '2024-01-29 18:59:32', NULL, NULL, NULL, NULL),
(9, 'Voluptatum amet inv', 'Aliquid modi volupta', 'Sit et amet occaeca', 'Dolor veniam volupt', 'Voluptate ratione ut', '600000', '300000000', '2025-02-22 10:07:29', '2025-02-22 10:07:29', NULL, NULL, NULL, NULL),
(10, 'Voluptatum amet inv', 'Aliquid modi volupta', 'Sit et amet occaeca', 'Dolor veniam volupt', 'Voluptate ratione ut', '600000', '300000000', '2025-02-22 10:09:36', '2025-02-22 10:09:36', NULL, NULL, NULL, NULL),
(11, 'Voluptatum amet inv', 'Aliquid modi volupta', 'Sit et amet occaeca', 'Dolor veniam volupt', 'Voluptate ratione ut', '600000', '300000000', '2025-02-22 10:12:50', '2025-02-22 10:12:50', NULL, NULL, NULL, NULL),
(12, 'Voluptatum amet inv', 'Aliquid modi volupta', 'Sit et amet occaeca', 'Dolor veniam volupt', 'Voluptate ratione ut', '600000', '300000000', '2025-02-22 10:13:42', '2025-02-22 10:13:42', NULL, NULL, NULL, NULL),
(13, 'Voluptatum amet inv', 'Aliquid modi volupta', 'Sit et amet occaeca', 'Dolor veniam volupt', 'Voluptate ratione ut', '600000', '300000000', '2025-02-22 10:15:35', '2025-02-22 10:15:35', NULL, NULL, NULL, NULL),
(14, 'sdff', 'erwe', 'rwt', 'rte', 'rtet', '453', '454', '2025-03-16 17:42:27', '2025-03-16 17:42:27', NULL, NULL, NULL, NULL),
(15, 'sdff', 'erwe', 'rwt', 'rte', 'rtet', '453', '454', '2025-03-16 17:43:55', '2025-03-16 17:43:55', NULL, NULL, NULL, NULL),
(16, '5435', '5345', '5646', '3656', '365', '65365', '5636', '2025-03-16 20:10:28', '2025-03-16 20:10:28', NULL, NULL, NULL, NULL),
(17, '34', '324', '34', '324', '342', '34245', '2343', '2025-03-16 20:14:56', '2025-03-16 20:14:56', NULL, NULL, NULL, NULL),
(18, '4563', '4354', '34345', '4545', '34554', '45435', '43554', '2025-03-16 20:49:39', '2025-03-16 20:49:39', NULL, NULL, NULL, NULL),
(19, 'toyota', '2023', '30004', 'black', '12', '6000', '5000', '2025-04-12 18:45:56', '2025-04-12 18:45:56', 'Private', NULL, NULL, NULL),
(20, 'toyota', '2023', '30004', 'black', '12', '6000', '5000', '2025-04-12 18:46:31', '2025-04-12 18:46:31', 'Private', NULL, NULL, NULL),
(21, 'toyota', '2023', '30004', 'black', '12', '6000', '5000', '2025-04-12 18:47:10', '2025-04-12 18:47:10', 'Private', NULL, NULL, NULL),
(22, 'toyota', '2023', '30004', 'black', '12', '6000', '5000', '2025-04-12 18:47:36', '2025-04-12 18:47:36', 'Private', NULL, NULL, NULL),
(23, 'toyota', '2023', '30004', 'black', '12', '6000', '5000', '2025-04-12 18:48:18', '2025-04-12 18:48:18', 'Private', NULL, NULL, NULL),
(24, 'toyota', '2023', '30004', 'black', '12', '6000', '5000', '2025-04-12 18:49:02', '2025-04-12 18:49:02', 'Private', NULL, NULL, NULL),
(25, 'toyota', '2023', '30004', 'black', '12', '6000', '5000', '2025-04-12 18:49:25', '2025-04-12 18:49:25', 'Private', NULL, NULL, NULL),
(26, 'toyota', '2023', '30004', 'black', '12', '6000', '5000', '2025-04-12 18:49:49', '2025-04-12 18:49:49', 'Private', NULL, NULL, NULL),
(27, 'toyota', '2023', '30004', 'black', '12', '70000', '80000', '2025-04-12 19:44:58', '2025-04-12 19:44:58', 'Private', NULL, NULL, '1'),
(28, 'toyota', '2023', '30004', 'black', '12', '600000', '6000', '2025-04-12 20:16:35', '2025-04-12 20:16:35', 'Private', NULL, NULL, '1'),
(29, 'toyota', '2023', '30004', 'black', '12', '80000', '7000', '2025-04-12 20:22:00', '2025-04-12 20:22:00', 'Private', NULL, NULL, '1'),
(30, 'toyota', '2023', '30004', 'black', '12', '80000', '7000', '2025-04-12 20:22:28', '2025-04-12 20:22:28', 'Private', NULL, NULL, '1'),
(31, 'toyota', '2023', '30004', 'black', '12', '80000', '7000', '2025-04-12 20:22:55', '2025-04-12 20:22:55', 'Private', NULL, NULL, '1'),
(32, 'toyota', '2023', '30004', 'black', '12', '80000', '7000', '2025-04-12 20:23:35', '2025-04-12 20:23:35', 'Private', NULL, NULL, '1'),
(33, 'BMW x1', '2023', '6567566732', 'black', '12', '40000', '500', '2025-04-13 05:52:59', '2025-04-13 05:52:59', 'Private', NULL, NULL, '1'),
(34, 'BMW x1', '2023', '6567566732', 'black', '12', '40000', '500', '2025-04-13 05:53:41', '2025-04-13 05:53:41', 'Private', NULL, NULL, '1'),
(35, 'BMW x2', '2023', '6567566732', 'black', '12', '79999', '34545', '2025-04-13 06:04:03', '2025-04-13 06:04:03', 'Private', NULL, NULL, '1'),
(36, 'BMW x2', '2023', '6567566732', 'black', '12', '79999', '34545', '2025-04-13 06:07:09', '2025-04-13 06:07:09', 'Private', NULL, NULL, '1'),
(37, 'BMW x2', '2023', '30004', 'black', '12', '60000000', '5000000', '2025-04-13 18:18:09', '2025-04-13 18:18:09', 'Import', NULL, NULL, '1'),
(38, 'BMW x3', '2023', '300046', 'black', '12', '300000', '5000', '2025-04-15 05:39:15', '2025-04-15 05:39:15', 'Private', NULL, NULL, '16'),
(39, 'BMW x4', '2023', '30004', 'black', '12', '400000000', '3000000', '2025-04-15 10:41:12', '2025-04-15 10:41:12', 'Private', NULL, NULL, '16'),
(40, 'BMW x4', '2023', '30004', 'black', '12', '70000', '28000', '2025-04-17 06:06:11', '2025-04-17 06:06:11', 'Private', NULL, NULL, '1'),
(41, 'BMW x3', '2023', '6567566732', 'black', '12', '600000', '30000', '2025-04-17 06:19:22', '2025-04-17 06:19:22', 'Private', NULL, NULL, '21'),
(42, 'toyota', '2023', '30004', 'black', '12000', '70000000', '28000000', '2025-04-30 10:06:40', '2025-04-30 10:06:40', 'Private', NULL, NULL, '21'),
(43, 'toyota', '2023', '3000499887', 'black', '12000', '80000000', '32000000', '2025-05-10 17:55:05', '2025-05-10 17:55:05', 'Private', NULL, NULL, '17'),
(44, 'toyota', '2023', '3000499887', 'black', '12000', '80000000', '32000000', '2025-05-10 17:57:19', '2025-05-10 17:57:19', 'Private', NULL, NULL, '17'),
(45, 'toyota', '2023', '30004', 'black', '12', '8977009', '5386205.4', '2025-06-12 08:05:49', '2025-06-12 08:05:49', 'Private', NULL, NULL, '22'),
(46, 'BMW x1', '2023', '30004', 'black', '12000', '8000000', '960000', '2025-09-09 01:00:56', '2025-09-09 01:00:56', 'Dealer', 'gtryrt', 'ghtrty', '20');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lenders`
--

CREATE TABLE `lenders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `region` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(100) NOT NULL DEFAULT 'Tanzania',
  `contact_person_name` varchar(255) NOT NULL,
  `contact_person_position` varchar(100) DEFAULT NULL,
  `contact_person_phone` varchar(20) NOT NULL,
  `contact_person_email` varchar(255) NOT NULL,
  `lender_type` enum('Bank','Microfinance','Credit Union','SACCO','Other') NOT NULL,
  `financial_license_number` varchar(100) DEFAULT NULL,
  `minimum_loan_amount` decimal(15,2) NOT NULL,
  `maximum_loan_amount` decimal(15,2) NOT NULL,
  `interest_rate_range` varchar(50) DEFAULT NULL,
  `loan_terms_range` varchar(50) DEFAULT NULL,
  `bank_account_details` text DEFAULT NULL,
  `payment_methods` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_methods`)),
  `settlement_period` int(11) DEFAULT NULL,
  `operating_hours` varchar(255) DEFAULT NULL,
  `services_offered` longtext DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` enum('PENDING','APPROVED','REJECTED') NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `business_registration_number` varchar(50) DEFAULT NULL,
  `tax_identification_number` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lenders`
--

INSERT INTO `lenders` (`id`, `name`, `phone_number`, `website`, `region`, `city`, `address`, `postal_code`, `country`, `contact_person_name`, `contact_person_position`, `contact_person_phone`, `contact_person_email`, `lender_type`, `financial_license_number`, `minimum_loan_amount`, `maximum_loan_amount`, `interest_rate_range`, `loan_terms_range`, `bank_account_details`, `payment_methods`, `settlement_period`, `operating_hours`, `services_offered`, `additional_notes`, `logo`, `status`, `created_at`, `updated_at`, `business_registration_number`, `tax_identification_number`, `email`) VALUES
(1, 'rewtr', '+255716815881', NULL, 'Dar es Salaam', 'Kinondoni', 'Dar Es Salaam', '17004', 'Tanzania', 'Pevv gfhd', 'Pevv gfhd', '+255716815881', 'fastcredit.tz@gmail.com', 'Microfinance', '7487434554', 1000.00, 500000.00, '3.4 - 50', '3 - 12', 'no bank details', '\"[\\\"Bank Transfer\\\",\\\"Mobile Money\\\",\\\"Cheque\\\",\\\"Cash\\\"]\"', 3, NULL, NULL, NULL, 'lender-logos/GXAwtuqdpE4h5ScXHn4YBKslhcMsFZaJbNPPC8vr.png', 'APPROVED', '2025-04-12 06:59:04', '2025-04-12 07:11:24', NULL, NULL, NULL),
(17, 'mikochecni inst', '+255716815881', NULL, 'Dar es Salaam', 'Kigamboni', 'Dar Es Salaam', '17004', 'Tanzania', 'juma all', 'CEO', '+255716815881', 'fastcredfdewit.tz@gmail.com', 'Microfinance', '1234567', 200.00, 1000000.00, '1-12', '1-72', '1111111111 CRDB bank', '\"[\\\"Bank Transfer\\\",\\\"Mobile Money\\\",\\\"Cheque\\\",\\\"Cash\\\"]\"', 3, NULL, NULL, NULL, 'lender-logos/BFOeWD2ghfNIaN2dCm4GXeTQv2LxvhqiYViiLtA8.png', 'APPROVED', '2025-04-13 03:25:03', '2025-04-13 03:30:38', '4324545', '442', 'aleck.ngorshani@wealthora.co.tz'),
(18, 'mikochecni inst', '+255716815881', NULL, 'Dar es Salaam', 'Kigamboni', 'Dar Es Salaam', '17004', 'Tanzania', 'juma all', 'CEO', '+255716815881', 'fastcredfdewit.tz@gmail.com', 'Microfinance', '1234567', 200.00, 1000000.00, '1-12', '1-72', '1111111111 CRDB bank', '\"[\\\"Bank Transfer\\\",\\\"Mobile Money\\\",\\\"Cheque\\\",\\\"Cash\\\"]\"', 3, NULL, NULL, NULL, 'lender-logos/xP4FTenHXAbkuYB6dPQfjqh1vGHV54PDqX52CKfN.png', 'APPROVED', '2025-04-13 03:25:50', '2025-04-13 03:30:41', '4324545', '442', 'aleck.ngorshani@wealthora.co.tz'),
(19, 'MABUTO GROUP', '+25571681589', NULL, 'Dar es Salaam', 'Kigamboni', 'Dar Es Salaam', '17004', 'Tanzania', 'Percy Egno', 'manager', '+255716815887', 'percyegno@gmail.com', 'Bank', '1234567try', 2000.00, 13000000.00, '1-24', '1-36', '94596465 NBC', '\"[\\\"Bank Transfer\\\",\\\"Mobile Money\\\",\\\"Cheque\\\",\\\"Cash\\\"]\"', 3, NULL, '[]', NULL, 'lender-logos/rOVRMPywd59KvFr2djTASsC2L37mJ19JcwqvINbC.png', 'APPROVED', '2025-04-14 04:58:28', '2025-04-14 05:01:09', '4324545E45', '442DF45', 'percyegno@gmail.com'),
(20, 'TANZANITE LEED', '+255716815881', NULL, 'Dar es Salaam', 'Kinondoni', 'Dar Es Salaam', '17004', 'Tanzania', 'Percy Egno', 'MANAGEMENT', '+255716815456', 'percyegno@gmail.com', 'Microfinance', '1234567erw', 100.00, 230000000.00, '1-16', '1-100', 'NMB WLLL', '\"[\\\"Bank Transfer\\\",\\\"Mobile Money\\\",\\\"Cheque\\\",\\\"Cash\\\"]\"', 1, NULL, '[]', NULL, NULL, 'APPROVED', '2025-04-14 05:13:56', '2025-04-14 05:21:30', '4324545ER', '442EGTT5', 'aleck.ngoshani@wealthora.co.tz'),
(21, 'DEMO TEST', '+255716815881', NULL, 'Dar es Salaam', 'Kigamboni', 'Dar Es Salaam', '17004', 'Tanzania', 'Percy Egno', 'Percy Egno', '+255716815845', 'percyegno@gmail.com', 'Microfinance', '1234567gh', 10000.00, 100000000.00, '1-5', '1-72', 'ehjkkerwer', '\"[\\\"Bank Transfer\\\",\\\"Mobile Money\\\",\\\"Cheque\\\",\\\"Cash\\\"]\"', 2, NULL, '[]', NULL, 'lender-logos/vTmjHVbyo904YVqhCoVBdDYPrru0SIIvy4qw2ZEn.png', 'APPROVED', '2025-04-15 05:26:01', '2025-04-15 05:26:21', '4324545ERWG', '442ERW', 'aleck.ERWngoshani@wealthora.co.tz'),
(22, 'MIWILI INSIT', '+255716815881', NULL, 'Dar es Salaam', 'Kigamboni', 'Dar Es Salaam', '17004', 'Tanzania', 'Percy Egno', 'Percy Egno', '+255716815887', 'percyegno@gmail.com', 'Credit Union', '1234567', 400.00, 12000000.00, '3.5-5', '1-32', 'percyegno@gmail.com', '\"[\\\"Bank Transfer\\\",\\\"Mobile Money\\\",\\\"Cheque\\\",\\\"Cash\\\"]\"', 3, NULL, '[]', NULL, NULL, 'APPROVED', '2025-05-06 11:48:40', '2025-05-06 12:05:44', '4324545', '442', 'miwili@gmail.com'),
(23, 'NBC Bank', '+255716815889', NULL, 'Dodoma', 'Chamwino', 'ikulu', '17004', 'Tanzania', 'Percy Egno', 'Percy Egno', '+255716815889', 'percyegno@gmail.com', 'Bank', '123456789HJ', 20000.00, 500000000000.00, '15-16', '12-100', 'Founded in 1967 after the nationalization of financial institutions, NBC later split into NBC Holding Corporation, National Microfinance Bank (NMB), and NBC (1997) Limited in 1997. In 2000, South Africa’s Absa Group acquired a majority stake, with the Tanzanian government retaining 30% and the IFC (World Bank Group) holding 15% \nHeadquartered in Dar es Salaam, it is one of the oldest and most established banks in Tanzania, with around 49–53 branches and over 230 ATMs nationwide', '\"[\\\"Bank Transfer\\\",\\\"Mobile Money\\\",\\\"Cheque\\\",\\\"Cash\\\"]\"', 4, NULL, '[]', NULL, 'lender-logos/uzuVKRiJY2njDLgDCWRCC1BhS28f5BEWivYZFJ0s.png', 'APPROVED', '2025-09-09 01:37:39', '2025-09-09 01:41:56', '43245453', '43333', 'percyegno@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `lender_financing_criterias`
--

CREATE TABLE `lender_financing_criterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `make_id` bigint(20) UNSIGNED DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `min_year` int(11) DEFAULT NULL,
  `max_year` int(11) DEFAULT NULL,
  `max_mileage` decimal(10,2) DEFAULT NULL,
  `max_price` decimal(12,2) DEFAULT NULL,
  `min_down_payment_percent` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `interest_rate` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lender_financing_criterias`
--

INSERT INTO `lender_financing_criterias` (`id`, `lender_id`, `make_id`, `model_id`, `min_year`, `max_year`, `max_mileage`, `max_price`, `min_down_payment_percent`, `created_at`, `updated_at`, `interest_rate`) VALUES
(1, 22, 39, 355, 2000, 2025, NULL, NULL, 40.00, '2025-05-06 12:59:12', '2025-07-25 08:31:02', '42'),
(2, 22, 31, 182, 2000, 2025, NULL, NULL, 30.00, '2025-05-06 13:49:32', '2025-07-25 08:31:15', '42'),
(3, 22, 33, 222, 2000, 2025, NULL, NULL, 50.00, '2025-05-06 13:56:12', '2025-05-06 13:56:12', NULL),
(4, 22, 44, 524, 2010, 2025, NULL, NULL, 30.00, '2025-05-06 13:56:26', '2025-05-11 03:44:19', NULL),
(6, 17, 31, 182, 1990, 2025, NULL, NULL, 35.00, '2025-05-10 02:27:01', '2025-07-25 08:31:21', '42'),
(7, 17, 39, 354, 2020, 2025, NULL, NULL, 30.00, '2025-05-10 03:53:52', '2025-05-10 03:53:52', NULL),
(8, 22, 39, 356, 2000, 2025, 100000.00, NULL, NULL, '2025-05-11 03:43:39', '2025-05-11 04:01:26', NULL),
(9, 22, 44, 527, 2010, 2025, NULL, NULL, 30.00, '2025-05-11 03:44:19', '2025-05-11 03:44:19', NULL),
(10, 22, 44, 530, 2010, 2025, NULL, NULL, 30.00, '2025-05-11 03:44:19', '2025-05-11 03:44:19', NULL),
(11, 22, 44, 533, 2010, 2025, NULL, NULL, 30.00, '2025-05-11 03:44:19', '2025-05-11 03:44:19', NULL),
(12, 22, 44, 531, 2010, 2025, NULL, NULL, 30.00, '2025-05-11 03:44:19', '2025-05-11 03:44:19', NULL),
(13, 22, 44, 534, 2010, 2025, NULL, NULL, 30.00, '2025-05-11 03:44:19', '2025-05-11 03:44:19', NULL),
(14, 22, 44, 528, 2010, 2025, NULL, NULL, 30.00, '2025-05-11 03:44:19', '2025-05-11 03:44:19', NULL),
(15, 22, 44, 567, 2010, 2025, NULL, NULL, 30.00, '2025-05-11 03:44:19', '2025-05-11 03:44:19', NULL),
(16, 22, 44, 561, 2010, 2025, NULL, NULL, 30.00, '2025-05-11 03:44:19', '2025-05-11 03:44:19', NULL),
(17, 22, 44, 558, 2010, 2025, NULL, NULL, 30.00, '2025-05-11 03:44:19', '2025-05-11 03:44:19', NULL),
(19, 17, 52, 385, 1990, 2025, NULL, NULL, 35.00, '2025-05-10 02:27:01', '2025-07-25 08:31:21', '42'),
(20, 22, 49, 655, 2020, 2025, NULL, NULL, 50.00, '2025-07-25 09:18:59', '2025-07-25 09:18:59', '0'),
(21, 23, 136, NULL, 2020, 2025, 100000.00, NULL, 40.00, '2025-09-09 01:50:55', '2025-09-09 01:50:55', '16'),
(22, 23, 122, 1472, 2005, 2025, 200000.00, 70000000.00, 30.00, '2025-09-15 06:24:25', '2025-09-15 06:24:25', '12'),
(23, 23, 94, 1013, 2004, 2025, 10000.00, 100000000.00, 50.00, '2025-09-15 06:39:02', '2025-09-15 06:39:02', '12');

-- --------------------------------------------------------

--
-- Table structure for table `lender_financing_offers`
--

CREATE TABLE `lender_financing_offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `lender_id` bigint(20) UNSIGNED NOT NULL,
  `offer_number` varchar(50) NOT NULL,
  `total_financing_amount` decimal(15,2) NOT NULL,
  `down_payment_required` decimal(15,2) NOT NULL,
  `loan_amount` decimal(15,2) NOT NULL,
  `interest_rate_annual` decimal(5,2) NOT NULL,
  `loan_tenure_months` int(11) NOT NULL,
  `monthly_installment` decimal(12,2) NOT NULL,
  `total_repayment` decimal(15,2) NOT NULL,
  `processing_fee` decimal(12,2) DEFAULT 0.00,
  `insurance_fee` decimal(12,2) DEFAULT 0.00,
  `legal_fee` decimal(12,2) DEFAULT 0.00,
  `other_fees` decimal(12,2) DEFAULT 0.00,
  `total_fees` decimal(12,2) NOT NULL,
  `minimum_income_required` decimal(12,2) DEFAULT NULL,
  `employment_type_required` varchar(100) DEFAULT NULL,
  `collateral_required` text DEFAULT NULL,
  `guarantor_required` tinyint(1) DEFAULT 0,
  `additional_requirements` text DEFAULT NULL,
  `status` enum('DRAFT','SUBMITTED','ACCEPTED','REJECTED','EXPIRED','WITHDRAWN') DEFAULT 'DRAFT',
  `priority_order` int(11) DEFAULT 1,
  `validity_hours` int(11) DEFAULT 48,
  `conditions` text DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `response_deadline` timestamp NULL DEFAULT NULL,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lender_financing_offers`
--

INSERT INTO `lender_financing_offers` (`id`, `application_id`, `lender_id`, `offer_number`, `total_financing_amount`, `down_payment_required`, `loan_amount`, `interest_rate_annual`, `loan_tenure_months`, `monthly_installment`, `total_repayment`, `processing_fee`, `insurance_fee`, `legal_fee`, `other_fees`, `total_fees`, `minimum_income_required`, `employment_type_required`, `collateral_required`, `guarantor_required`, `additional_requirements`, `status`, `priority_order`, `validity_hours`, `conditions`, `submitted_at`, `expires_at`, `response_deadline`, `accepted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 22, 'LO2220250001', 1738000.00, 347599.98, 1390400.02, 18.00, 36, 50266.29, 1809586.44, 0.00, 0.00, 0.00, 0.00, 0.00, 560000.00, 'Any', 'no colateral', 1, 'no additional', 'ACCEPTED', 1, 48, 'no additional', '2025-08-16 17:24:47', '2025-08-18 17:24:47', '2025-08-19 17:24:47', '2025-08-16 17:37:22', '2025-08-16 17:24:47', '2025-08-16 17:37:22'),
(2, 3, 22, 'LO2220250002', 8000000.00, 1600000.00, 6400000.00, 18.00, 36, 231375.33, 8329511.88, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Any', 'hjdvfjhdkbjhfg', 0, 'dsfgdgfgfd', 'ACCEPTED', 1, 48, 'ffgertgerterttreg', '2025-08-25 11:30:49', '2025-08-27 11:30:49', '2025-08-28 11:30:49', '2025-08-25 11:32:07', '2025-08-25 11:30:49', '2025-08-25 11:32:07'),
(3, 4, 22, 'LO2220250003', 10200.00, 2040.00, 8160.00, 18.00, 36, 295.00, 10620.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 'Formal Employment', '', 0, '', 'ACCEPTED', 1, 48, '', '2025-08-27 12:00:26', '2025-08-29 12:00:26', '2025-08-30 12:00:26', '2025-08-27 12:01:35', '2025-08-27 12:00:26', '2025-08-27 12:01:35'),
(4, 6, 19, 'LO1920250004', 2136030.00, 427206.00, 1708824.00, 18.00, 36, 61778.08, 2224010.88, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Formal Employment', '', 0, '', 'ACCEPTED', 1, 48, '', '2025-09-09 04:22:47', '2025-09-11 04:23:10', '2025-09-12 04:22:47', '2025-09-09 04:24:28', '2025-09-09 04:22:47', '2025-09-09 04:24:28');

-- --------------------------------------------------------

--
-- Table structure for table `lender_model`
--

CREATE TABLE `lender_model` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lender_financing_criteria_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_model_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `loan_account_number` varchar(255) DEFAULT NULL,
  `loan_sub_product` varchar(255) DEFAULT NULL,
  `client_number` varchar(255) DEFAULT NULL,
  `guarantor` varchar(255) DEFAULT NULL,
  `institution_id` varchar(11) DEFAULT NULL,
  `item_id` varchar(110) DEFAULT NULL,
  `principle` double DEFAULT NULL,
  `interest` double(8,2) DEFAULT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `business_age` int(11) DEFAULT NULL,
  `business_category` varchar(255) DEFAULT NULL,
  `business_type` varchar(255) DEFAULT NULL,
  `business_licence_number` varchar(255) DEFAULT NULL,
  `business_tin_number` varchar(255) DEFAULT NULL,
  `business_inventory` float DEFAULT NULL,
  `cash_at_hand` float DEFAULT NULL,
  `daily_sales` float DEFAULT NULL,
  `cost_of_goods_sold` float DEFAULT NULL,
  `available_funds` float DEFAULT NULL,
  `operating_expenses` float DEFAULT NULL,
  `monthly_taxes` float DEFAULT NULL,
  `other_expenses` float DEFAULT NULL,
  `collateral_value` float DEFAULT NULL,
  `collateral_location` text DEFAULT NULL,
  `collateral_description` text DEFAULT NULL,
  `collateral_type` varchar(255) DEFAULT NULL,
  `tenure` int(11) DEFAULT NULL,
  `principle_amount` double DEFAULT NULL,
  `interest_method` varchar(30) DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `LoanPhoneNo` varchar(110) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `loan_status` varchar(20) DEFAULT 'NORMAL',
  `restructure_loanId` varchar(50) DEFAULT NULL,
  `heath` varchar(255) NOT NULL DEFAULT 'GOOD',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(30) DEFAULT NULL,
  `pay_method` varchar(30) DEFAULT NULL,
  `days_in_arrears` bigint(20) DEFAULT NULL,
  `total_days_in_arrears` bigint(20) DEFAULT NULL,
  `arrears_in_amount` double DEFAULT NULL,
  `supervisor_id` bigint(20) DEFAULT NULL,
  `supervisor_name` varchar(255) DEFAULT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `loan_type` varchar(20) DEFAULT NULL,
  `future_interest` double DEFAULT NULL,
  `total_principle` double DEFAULT NULL,
  `amount_to_be_credited` varchar(150) DEFAULT NULL,
  `monthly_income` varchar(59) DEFAULT NULL,
  `other_loans` varchar(50) DEFAULT NULL,
  `other_loan_details` varchar(200) DEFAULT NULL,
  `lender_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `loan_id`, `loan_account_number`, `loan_sub_product`, `client_number`, `guarantor`, `institution_id`, `item_id`, `principle`, `interest`, `business_name`, `business_age`, `business_category`, `business_type`, `business_licence_number`, `business_tin_number`, `business_inventory`, `cash_at_hand`, `daily_sales`, `cost_of_goods_sold`, `available_funds`, `operating_expenses`, `monthly_taxes`, `other_expenses`, `collateral_value`, `collateral_location`, `collateral_description`, `collateral_type`, `tenure`, `principle_amount`, `interest_method`, `bank_account_number`, `bank`, `LoanPhoneNo`, `status`, `loan_status`, `restructure_loanId`, `heath`, `created_at`, `updated_at`, `phone_number`, `pay_method`, `days_in_arrears`, `total_days_in_arrears`, `arrears_in_amount`, `supervisor_id`, `supervisor_name`, `client_id`, `relationship`, `loan_type`, `future_interest`, `total_principle`, `amount_to_be_credited`, `monthly_income`, `other_loans`, `other_loan_details`, `lender_id`) VALUES
(162, NULL, NULL, '104_1960', NULL, NULL, NULL, '1', 200000, 16.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, '', '', '754244888', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2024-01-17 08:17:07', '2024-01-17 08:17:07', NULL, '', NULL, NULL, NULL, 1, NULL, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(163, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '754244888', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2024-01-17 14:51:23', '2024-01-17 14:51:23', NULL, '', NULL, NULL, NULL, 1, NULL, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(164, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '754244888', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2024-01-17 14:52:21', '2024-01-17 14:52:21', NULL, '', NULL, NULL, NULL, 1, NULL, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(165, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '753244888', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2024-01-18 08:11:06', '2024-01-18 08:11:06', NULL, '', NULL, NULL, NULL, 1, NULL, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(166, NULL, NULL, NULL, NULL, NULL, NULL, '5', 35000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '754244888', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2024-01-18 08:25:48', '2024-01-18 08:25:48', NULL, '', NULL, NULL, NULL, 1, NULL, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(167, NULL, NULL, NULL, NULL, NULL, NULL, '6', 35000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '754244888', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2024-01-18 08:26:42', '2024-01-18 08:26:42', NULL, '', NULL, NULL, NULL, 1, NULL, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(168, NULL, NULL, NULL, NULL, NULL, NULL, '11', 600000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '+1 (405) 103-3706', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-02-22 10:12:50', '2025-02-22 10:12:50', NULL, '', NULL, NULL, NULL, 1, NULL, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(169, NULL, NULL, NULL, NULL, NULL, NULL, '12', 600000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '+1 (405) 103-3706', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-02-22 10:13:42', '2025-02-22 10:13:42', NULL, '', NULL, NULL, NULL, 1, NULL, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, NULL, NULL, NULL, NULL, NULL, NULL, '13', 600000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '+1 (405) 103-3706', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-02-22 10:15:35', '2025-02-22 10:15:35', NULL, '', NULL, NULL, NULL, 1, NULL, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171, NULL, NULL, NULL, NULL, NULL, NULL, '15', 50000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'ACTIVE', 'NORMAL', NULL, 'GOOD', '2025-03-16 17:43:55', '2025-03-16 17:43:55', NULL, '', NULL, NULL, NULL, 1, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(172, NULL, NULL, NULL, NULL, NULL, NULL, '16', 60000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-03-16 20:10:28', '2025-03-16 20:10:28', NULL, '', NULL, NULL, NULL, 1, NULL, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(173, NULL, NULL, NULL, NULL, NULL, NULL, '17', 80000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-03-16 20:14:56', '2025-03-16 20:14:56', NULL, '', NULL, NULL, NULL, 1, NULL, 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(174, NULL, NULL, NULL, NULL, NULL, NULL, '18', 10000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-03-16 20:49:39', '2025-03-16 20:49:39', NULL, '', NULL, NULL, NULL, 1, NULL, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(175, NULL, NULL, NULL, NULL, NULL, NULL, '22', 5000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-12 18:47:36', '2025-04-12 18:47:36', NULL, '', NULL, NULL, NULL, 1, NULL, 61, NULL, NULL, NULL, NULL, NULL, '500000', '0', NULL, NULL),
(176, NULL, NULL, NULL, NULL, NULL, NULL, '23', 5000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-12 18:48:18', '2025-04-12 18:48:18', NULL, '', NULL, NULL, NULL, 1, NULL, 62, NULL, NULL, NULL, NULL, NULL, '500000', '0', NULL, NULL),
(177, NULL, NULL, NULL, NULL, NULL, NULL, '24', 5000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-12 18:49:02', '2025-04-12 18:49:02', NULL, '', NULL, NULL, NULL, 1, NULL, 63, NULL, NULL, NULL, NULL, NULL, '500000', '0', NULL, NULL),
(178, NULL, NULL, NULL, NULL, NULL, NULL, '25', 5000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-12 18:49:25', '2025-04-12 18:49:25', NULL, '', NULL, NULL, NULL, 1, NULL, 64, NULL, NULL, NULL, NULL, NULL, '500000', '0', NULL, NULL),
(179, NULL, NULL, NULL, NULL, NULL, NULL, '26', 5000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-12 18:49:49', '2025-04-12 18:49:49', NULL, '', NULL, NULL, NULL, 1, NULL, 65, NULL, NULL, NULL, NULL, NULL, '500000', '0', NULL, NULL),
(180, NULL, NULL, NULL, NULL, NULL, NULL, '27', 900000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-12 19:44:58', '2025-04-12 19:44:58', NULL, '', NULL, NULL, NULL, 1, NULL, 66, NULL, NULL, NULL, NULL, NULL, '20000', '1', 'there is 500k ', '1'),
(181, NULL, NULL, NULL, NULL, NULL, NULL, '28', 700000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-12 20:16:35', '2025-04-12 20:16:35', NULL, '', NULL, NULL, NULL, 1, NULL, 67, NULL, NULL, NULL, NULL, NULL, '50000', '1', 'vnbv bn bnb', '1'),
(182, NULL, NULL, NULL, NULL, NULL, NULL, '29', 3000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-12 20:22:00', '2025-04-12 20:22:00', NULL, '', NULL, NULL, NULL, 1, NULL, 68, NULL, NULL, NULL, NULL, NULL, '70000000', '0', NULL, '1'),
(183, NULL, NULL, NULL, NULL, NULL, NULL, '30', 3000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-12 20:22:28', '2025-04-12 20:22:28', NULL, '', NULL, NULL, NULL, 1, NULL, 69, NULL, NULL, NULL, NULL, NULL, '70000000', '0', NULL, '1'),
(184, NULL, NULL, NULL, NULL, NULL, NULL, '31', 3000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-12 20:22:55', '2025-04-12 20:22:55', NULL, '', NULL, NULL, NULL, 1, NULL, 70, NULL, NULL, NULL, NULL, NULL, '70000000', '0', NULL, '1'),
(185, NULL, NULL, NULL, NULL, NULL, NULL, '32', 3000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-12 20:23:35', '2025-04-12 20:23:35', NULL, '', NULL, NULL, NULL, 1, NULL, 71, NULL, NULL, NULL, NULL, NULL, '70000000', '0', NULL, '1'),
(186, NULL, NULL, NULL, NULL, NULL, NULL, '33', 600000, 3.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-13 05:52:59', '2025-04-13 05:52:59', NULL, '', NULL, NULL, NULL, 1, NULL, 72, NULL, NULL, NULL, NULL, NULL, '49000', '0', NULL, '1'),
(187, NULL, NULL, NULL, NULL, NULL, NULL, '34', 600000, 3.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-13 05:53:41', '2025-04-13 05:53:41', NULL, '', NULL, NULL, NULL, 1, NULL, 73, NULL, NULL, NULL, NULL, NULL, '49000', '0', NULL, '1'),
(188, NULL, NULL, NULL, NULL, NULL, NULL, '35', 2043245, 3.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-13 06:04:03', '2025-04-13 06:04:03', NULL, '', NULL, NULL, NULL, 1, NULL, 74, NULL, NULL, NULL, NULL, NULL, '5000', '0', NULL, '1'),
(189, NULL, NULL, NULL, NULL, NULL, NULL, '36', 2043245, 3.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34, NULL, NULL, '', '', '0716815881', 'ACTIVE', 'NORMAL', NULL, 'GOOD', '2025-04-13 06:07:09', '2025-04-13 06:07:09', NULL, '', NULL, NULL, NULL, 1, NULL, 75, NULL, NULL, NULL, NULL, NULL, '5000', '0', NULL, '1'),
(190, NULL, NULL, NULL, NULL, NULL, NULL, '37', 10000000, 3.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34, NULL, NULL, '', '', '0716815881', 'ACTIVE', 'NORMAL', NULL, 'GOOD', '2025-04-13 18:18:09', '2025-04-13 18:18:09', NULL, '', NULL, NULL, NULL, 1, NULL, 76, NULL, NULL, NULL, NULL, NULL, '150000', '0', NULL, '1'),
(191, NULL, NULL, NULL, NULL, NULL, NULL, '38', 300000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-15 05:39:15', '2025-04-15 05:39:15', NULL, '', NULL, NULL, NULL, 1, NULL, 77, NULL, NULL, NULL, NULL, NULL, '150000', '0', NULL, '16'),
(192, NULL, NULL, NULL, NULL, NULL, NULL, '39', 60000000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, '', '', '0716815881', 'ACTIVE', 'NORMAL', NULL, 'GOOD', '2025-04-15 10:41:12', '2025-04-15 10:41:12', NULL, '', NULL, NULL, NULL, 1, NULL, 78, NULL, NULL, NULL, NULL, NULL, '1300000', '0', NULL, '16'),
(193, NULL, NULL, NULL, NULL, NULL, NULL, '40', 42000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-17 06:06:11', '2025-04-17 06:06:11', NULL, '', NULL, NULL, NULL, 1, NULL, 79, NULL, NULL, NULL, NULL, NULL, '50000', '0', NULL, '1'),
(194, NULL, NULL, NULL, NULL, NULL, NULL, '41', 570000, 4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-17 06:19:22', '2025-04-17 06:19:22', NULL, '', NULL, NULL, NULL, 1, NULL, 80, NULL, NULL, NULL, NULL, NULL, '600', '0', NULL, '21'),
(195, NULL, NULL, NULL, NULL, NULL, NULL, '42', 42000000, 5.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-04-30 10:06:40', '2025-04-30 10:06:40', NULL, '', NULL, NULL, NULL, 1, NULL, 81, NULL, NULL, NULL, NULL, NULL, '150000', '0', NULL, '21'),
(196, NULL, NULL, NULL, NULL, NULL, NULL, '43', 48000000, 5.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, '', '', '0767582837', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-05-10 17:55:05', '2025-05-10 17:55:05', NULL, '', NULL, NULL, NULL, 1, NULL, 82, NULL, NULL, NULL, NULL, NULL, '3000000', '0', NULL, '17'),
(197, NULL, NULL, NULL, NULL, NULL, NULL, '44', 48000000, 5.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, '', '', '0767582837', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-05-10 17:57:19', '2025-05-10 17:57:19', NULL, '', NULL, NULL, NULL, 1, NULL, 83, NULL, NULL, NULL, NULL, NULL, '3000000', '0', NULL, '17'),
(198, NULL, NULL, NULL, NULL, NULL, NULL, '45', 3590803.6, 5.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-06-12 08:05:49', '2025-06-12 08:05:49', NULL, '', NULL, NULL, NULL, 1, NULL, 84, NULL, NULL, NULL, NULL, NULL, '500000', '1', 'uihoiuhu', '22'),
(199, NULL, NULL, NULL, NULL, NULL, NULL, '46', 7040000, 5.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, '', '', '0716815881', 'NEW LOAN', 'NORMAL', NULL, 'GOOD', '2025-09-09 01:00:56', '2025-09-09 01:00:56', NULL, '', NULL, NULL, NULL, 1, NULL, 85, NULL, NULL, NULL, NULL, NULL, '15000000', '0', NULL, '20');

-- --------------------------------------------------------

--
-- Table structure for table `loans_arreas`
--

CREATE TABLE `loans_arreas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `installment` double(8,2) DEFAULT NULL,
  `interest` double(8,2) DEFAULT NULL,
  `principle` double(8,2) DEFAULT NULL,
  `balance` double(8,2) DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `completion_status` varchar(255) DEFAULT NULL,
  `account_status` varchar(255) DEFAULT NULL,
  `installment_date` date DEFAULT NULL,
  `last_check_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans_originated`
--

CREATE TABLE `loans_originated` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `num_loans` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans_schedules`
--

CREATE TABLE `loans_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `installment` double DEFAULT NULL,
  `interest` double DEFAULT NULL,
  `principle` double DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `completion_status` varchar(255) DEFAULT NULL,
  `account_status` varchar(255) DEFAULT NULL,
  `installment_date` date DEFAULT NULL,
  `next_check_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `penalties` double DEFAULT NULL,
  `days_in_arrears` bigint(20) DEFAULT NULL,
  `amount_in_arrears` double DEFAULT NULL,
  `payment` double DEFAULT NULL,
  `promise_date` date DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `opening_balance` float DEFAULT 0,
  `closing_balance` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans_schedules`
--

INSERT INTO `loans_schedules` (`id`, `loan_id`, `installment`, `interest`, `principle`, `balance`, `bank_account_number`, `completion_status`, `account_status`, `installment_date`, `next_check_date`, `created_at`, `updated_at`, `penalties`, `days_in_arrears`, `amount_in_arrears`, `payment`, `promise_date`, `comment`, `opening_balance`, `closing_balance`) VALUES
(1, '1689752091', 10133.33, 133.33, 10000, 0, NULL, 'ACTIVE', 'ACTIVE', '2023-08-22', NULL, '2023-07-20 04:03:22', '2023-07-20 04:03:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(2, '1689752091', 10133.33, 133.33, 10000, 0, NULL, 'ACTIVE', 'CLOSED', '2023-08-19', NULL, '2023-07-20 06:07:47', '2023-07-20 06:07:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(3, '1689752091', 10133.33, 133.33, 10000, 0, NULL, 'ACTIVE', 'CLOSED', '2023-08-19', NULL, '2023-07-20 06:08:53', '2023-07-20 06:08:53', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(4, '1689752091', 10133.33, 133.33, 10000, 0, NULL, 'ACTIVE', 'CLOSED', '2023-08-19', NULL, '2023-07-20 06:09:23', '2023-07-20 06:09:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(5, '1689752091', 10133.33, 133.33, 10000, 0, NULL, 'ACTIVE', 'CLOSED', '2023-08-19', NULL, '2023-07-20 06:09:53', '2023-07-20 06:09:53', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(6, '1689752091', 10133.33, 133.33, 10000, 0, NULL, 'ACTIVE', 'CLOSED', '2023-08-19', NULL, '2023-07-20 06:14:44', '2023-07-20 06:14:44', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(7, '1689752091', 10133.33, 133.33, 10000, 0, NULL, 'ACTIVE', 'CLOSED', '2023-08-19', NULL, '2023-07-20 06:15:21', '2023-07-20 06:15:21', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(8, '1689850713', 362923.43, 53333.333333333, 309590.09666667, 3690409.9033333, '921673621', 'ACTIVE', 'CLOSED', '2023-08-20', NULL, '2023-07-20 10:11:29', '2023-07-20 10:11:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(9, '1689850713', 362923.43, 49205.465377778, 313717.96462222, 3376691.9387111, '921673621', 'ACTIVE', 'CLOSED', '2023-09-18', NULL, '2023-07-20 10:11:29', '2023-07-20 10:11:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(10, '1689850713', 362923.43, 45022.559182815, 317900.87081719, 3058791.0678939, '921673621', 'ACTIVE', 'CLOSED', '2023-10-18', NULL, '2023-07-20 10:11:29', '2023-07-20 10:11:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(11, '1689850713', 362923.43, 40783.880905252, 322139.54909475, 2736651.5187992, '921673621', 'ACTIVE', 'CLOSED', '2023-11-17', NULL, '2023-07-20 10:11:29', '2023-07-20 10:11:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(12, '1689850713', 362923.43, 36488.686917322, 326434.74308268, 2410216.7757165, '921673621', 'ACTIVE', 'CLOSED', '2023-12-17', NULL, '2023-07-20 10:11:29', '2023-07-20 10:11:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(13, '1689850713', 362923.43, 32136.22367622, 330787.20632378, 2079429.5693927, '921673621', 'ACTIVE', 'CLOSED', '2024-01-16', NULL, '2023-07-20 10:11:29', '2023-07-20 10:11:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(14, '1689850713', 362923.43, 27725.727591903, 335197.7024081, 1744231.8669846, '921673621', 'ACTIVE', 'CLOSED', '2024-02-15', NULL, '2023-07-20 10:11:29', '2023-07-20 10:11:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(15, '1689850713', 362923.43, 23256.424893128, 339667.00510687, 1404564.8618778, '921673621', 'ACTIVE', 'CLOSED', '2024-03-16', NULL, '2023-07-20 10:11:29', '2023-07-20 10:11:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(16, '1689850713', 362923.43, 18727.531491703, 344195.8985083, 1060368.9633695, '921673621', 'ACTIVE', 'CLOSED', '2024-04-15', NULL, '2023-07-20 10:11:29', '2023-07-20 10:11:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(17, '1689850713', 362923.43, 14138.252844926, 348785.17715507, 711583.78621438, '921673621', 'ACTIVE', 'CLOSED', '2024-05-15', NULL, '2023-07-20 10:11:29', '2023-07-20 10:11:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(18, '1689850713', 362923.43, 9487.7838161917, 353435.64618381, 358148.14003057, '921673621', 'ACTIVE', 'CLOSED', '2024-06-14', NULL, '2023-07-20 10:11:29', '2023-07-20 10:11:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(19, '1689850713', 362923.44856431, 4775.308533741, 358148.14003057, 0, '921673621', 'ACTIVE', 'CLOSED', '2024-07-14', NULL, '2023-07-20 10:11:29', '2023-07-20 10:11:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(20, '1689850713', 362923.43, 53333.333333333, 309590.09666667, 3690409.9033333, '921673621', 'ACTIVE', 'CLOSED', '2023-08-19', NULL, '2023-07-20 10:12:43', '2023-07-20 10:12:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(21, '1689850713', 362923.43, 49205.465377778, 313717.96462222, 3376691.9387111, '921673621', 'ACTIVE', 'CLOSED', '2023-09-18', NULL, '2023-07-20 10:12:43', '2023-07-20 10:12:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(22, '1689850713', 362923.43, 45022.559182815, 317900.87081719, 3058791.0678939, '921673621', 'ACTIVE', 'CLOSED', '2023-10-18', NULL, '2023-07-20 10:12:43', '2023-07-20 10:12:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(23, '1689850713', 362923.43, 40783.880905252, 322139.54909475, 2736651.5187992, '921673621', 'ACTIVE', 'CLOSED', '2023-11-17', NULL, '2023-07-20 10:12:43', '2023-07-20 10:12:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(24, '1689850713', 362923.43, 36488.686917322, 326434.74308268, 2410216.7757165, '921673621', 'ACTIVE', 'CLOSED', '2023-12-17', NULL, '2023-07-20 10:12:43', '2023-07-20 10:12:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(25, '1689850713', 362923.43, 32136.22367622, 330787.20632378, 2079429.5693927, '921673621', 'ACTIVE', 'CLOSED', '2024-01-16', NULL, '2023-07-20 10:12:43', '2023-07-20 10:12:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(26, '1689850713', 362923.43, 27725.727591903, 335197.7024081, 1744231.8669846, '921673621', 'ACTIVE', 'CLOSED', '2024-02-15', NULL, '2023-07-20 10:12:43', '2023-07-20 10:12:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(27, '1689850713', 362923.43, 23256.424893128, 339667.00510687, 1404564.8618778, '921673621', 'ACTIVE', 'CLOSED', '2024-03-16', NULL, '2023-07-20 10:12:43', '2023-07-20 10:12:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(28, '1689850713', 362923.43, 18727.531491703, 344195.8985083, 1060368.9633695, '921673621', 'ACTIVE', 'CLOSED', '2024-04-15', NULL, '2023-07-20 10:12:43', '2023-07-20 10:12:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(29, '1689850713', 362923.43, 14138.252844926, 348785.17715507, 711583.78621438, '921673621', 'ACTIVE', 'CLOSED', '2024-05-15', NULL, '2023-07-20 10:12:43', '2023-07-20 10:12:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(30, '1689850713', 362923.43, 9487.7838161917, 353435.64618381, 358148.14003057, '921673621', 'ACTIVE', 'CLOSED', '2024-06-14', NULL, '2023-07-20 10:12:43', '2023-07-20 10:12:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(31, '1689850713', 362923.44856431, 4775.308533741, 358148.14003057, 0, '921673621', 'ACTIVE', 'CLOSED', '2024-07-14', NULL, '2023-07-20 10:12:43', '2023-07-20 10:12:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(32, '1689850713', 362923.43, 53333.333333333, 309590.09666667, 3690409.9033333, '921673621', 'ACTIVE', 'CLOSED', '2023-08-19', NULL, '2023-07-20 10:13:15', '2023-07-20 10:13:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(33, '1689850713', 362923.43, 49205.465377778, 313717.96462222, 3376691.9387111, '921673621', 'ACTIVE', 'CLOSED', '2023-09-18', NULL, '2023-07-20 10:13:15', '2023-07-20 10:13:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(34, '1689850713', 362923.43, 45022.559182815, 317900.87081719, 3058791.0678939, '921673621', 'ACTIVE', 'CLOSED', '2023-10-18', NULL, '2023-07-20 10:13:15', '2023-07-20 10:13:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(35, '1689850713', 362923.43, 40783.880905252, 322139.54909475, 2736651.5187992, '921673621', 'ACTIVE', 'CLOSED', '2023-11-17', NULL, '2023-07-20 10:13:15', '2023-07-20 10:13:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(36, '1689850713', 362923.43, 36488.686917322, 326434.74308268, 2410216.7757165, '921673621', 'ACTIVE', 'CLOSED', '2023-12-17', NULL, '2023-07-20 10:13:15', '2023-07-20 10:13:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(37, '1689850713', 362923.43, 32136.22367622, 330787.20632378, 2079429.5693927, '921673621', 'ACTIVE', 'CLOSED', '2024-01-16', NULL, '2023-07-20 10:13:15', '2023-07-20 10:13:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(38, '1689850713', 362923.43, 27725.727591903, 335197.7024081, 1744231.8669846, '921673621', 'ACTIVE', 'CLOSED', '2024-02-15', NULL, '2023-07-20 10:13:15', '2023-07-20 10:13:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(39, '1689850713', 362923.43, 23256.424893128, 339667.00510687, 1404564.8618778, '921673621', 'ACTIVE', 'CLOSED', '2024-03-16', NULL, '2023-07-20 10:13:15', '2023-07-20 10:13:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(40, '1689850713', 362923.43, 18727.531491703, 344195.8985083, 1060368.9633695, '921673621', 'ACTIVE', 'CLOSED', '2024-04-15', NULL, '2023-07-20 10:13:15', '2023-07-20 10:13:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(41, '1689850713', 362923.43, 14138.252844926, 348785.17715507, 711583.78621438, '921673621', 'ACTIVE', 'CLOSED', '2024-05-15', NULL, '2023-07-20 10:13:15', '2023-07-20 10:13:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(42, '1689850713', 362923.43, 9487.7838161917, 353435.64618381, 358148.14003057, '921673621', 'ACTIVE', 'CLOSED', '2024-06-14', NULL, '2023-07-20 10:13:15', '2023-07-20 10:13:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(43, '1689850713', 362923.44856431, 4775.308533741, 358148.14003057, 0, '921673621', 'ACTIVE', 'CLOSED', '2024-07-14', NULL, '2023-07-20 10:13:15', '2023-07-20 10:13:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(44, '1689850713', 362923.43, 53333.333333333, 309590.09666667, 3690409.9033333, '921673621', 'ACTIVE', 'CLOSED', '2023-08-19', NULL, '2023-07-20 10:14:06', '2023-07-20 10:14:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(45, '1689850713', 362923.43, 49205.465377778, 313717.96462222, 3376691.9387111, '921673621', 'ACTIVE', 'CLOSED', '2023-09-18', NULL, '2023-07-20 10:14:06', '2023-07-20 10:14:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(46, '1689850713', 362923.43, 45022.559182815, 317900.87081719, 3058791.0678939, '921673621', 'ACTIVE', 'CLOSED', '2023-10-18', NULL, '2023-07-20 10:14:06', '2023-07-20 10:14:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(47, '1689850713', 362923.43, 40783.880905252, 322139.54909475, 2736651.5187992, '921673621', 'ACTIVE', 'CLOSED', '2023-11-17', NULL, '2023-07-20 10:14:06', '2023-07-20 10:14:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(48, '1689850713', 362923.43, 36488.686917322, 326434.74308268, 2410216.7757165, '921673621', 'ACTIVE', 'CLOSED', '2023-12-17', NULL, '2023-07-20 10:14:06', '2023-07-20 10:14:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(49, '1689850713', 362923.43, 32136.22367622, 330787.20632378, 2079429.5693927, '921673621', 'ACTIVE', 'CLOSED', '2024-01-16', NULL, '2023-07-20 10:14:06', '2023-07-20 10:14:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(50, '1689850713', 362923.43, 27725.727591903, 335197.7024081, 1744231.8669846, '921673621', 'ACTIVE', 'CLOSED', '2024-02-15', NULL, '2023-07-20 10:14:06', '2023-07-20 10:14:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(51, '1689850713', 362923.43, 23256.424893128, 339667.00510687, 1404564.8618778, '921673621', 'ACTIVE', 'CLOSED', '2024-03-16', NULL, '2023-07-20 10:14:06', '2023-07-20 10:14:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(52, '1689850713', 362923.43, 18727.531491703, 344195.8985083, 1060368.9633695, '921673621', 'ACTIVE', 'CLOSED', '2024-04-15', NULL, '2023-07-20 10:14:06', '2023-07-20 10:14:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(53, '1689850713', 362923.43, 14138.252844926, 348785.17715507, 711583.78621438, '921673621', 'ACTIVE', 'CLOSED', '2024-05-15', NULL, '2023-07-20 10:14:06', '2023-07-20 10:14:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(54, '1689850713', 362923.43, 9487.7838161917, 353435.64618381, 358148.14003057, '921673621', 'ACTIVE', 'CLOSED', '2024-06-14', NULL, '2023-07-20 10:14:06', '2023-07-20 10:14:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(55, '1689850713', 362923.44856431, 4775.308533741, 358148.14003057, 0, '921673621', 'ACTIVE', 'CLOSED', '2024-07-14', NULL, '2023-07-20 10:14:06', '2023-07-20 10:14:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(56, '1691497401', 1369045.86, 53333.333333333, 1315712.5266667, 2684287.4733333, '921673621', 'ACTIVE', 'CLOSED', '2023-09-07', NULL, '2023-08-08 09:37:50', '2023-08-08 09:37:50', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(57, '1691497401', 1369045.86, 35790.499644444, 1333255.3603556, 1351032.1129778, '921673621', 'ACTIVE', 'CLOSED', '2023-10-07', NULL, '2023-08-08 09:37:50', '2023-08-08 09:37:50', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(58, '1691497401', 1369045.8744841, 18013.76150637, 1351032.1129778, 0, '921673621', 'ACTIVE', 'CLOSED', '2023-11-06', NULL, '2023-08-08 09:37:50', '2023-08-08 09:37:50', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(59, '1692790481', 137651141.21, 66666666.666667, 70984474.543333, 4929015525.4567, '921673621', 'ACTIVE', 'CLOSED', '2023-09-22', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(60, '1692790481', 137651141.21, 65720207.006089, 71930934.203911, 4857084591.2528, '921673621', 'ACTIVE', 'CLOSED', '2023-10-22', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(61, '1692790481', 137651141.21, 64761127.88337, 72890013.32663, 4784194577.9261, '921673621', 'ACTIVE', 'CLOSED', '2023-11-21', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(62, '1692790481', 137651141.21, 63789261.039015, 73861880.170985, 4710332697.7551, '921673621', 'ACTIVE', 'CLOSED', '2023-12-21', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(63, '1692790481', 137651141.21, 62804435.970069, 74846705.239931, 4635485992.5152, '921673621', 'ACTIVE', 'CLOSED', '2024-01-20', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(64, '1692790481', 137651141.21, 61806479.900203, 75844661.309797, 4559641331.2054, '921673621', 'ACTIVE', 'CLOSED', '2024-02-19', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(65, '1692790481', 137651141.21, 60795217.749405, 76855923.460595, 4482785407.7448, '921673621', 'ACTIVE', 'CLOSED', '2024-03-20', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(66, '1692790481', 137651141.21, 59770472.103264, 77880669.106736, 4404904738.6381, '921673621', 'ACTIVE', 'CLOSED', '2024-04-19', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(67, '1692790481', 137651141.21, 58732063.181841, 78919078.028159, 4325985660.6099, '921673621', 'ACTIVE', 'CLOSED', '2024-05-19', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(68, '1692790481', 137651141.21, 57679808.808132, 79971332.401868, 4246014328.2081, '921673621', 'ACTIVE', 'CLOSED', '2024-06-18', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(69, '1692790481', 137651141.21, 56613524.376107, 81037616.833893, 4164976711.3742, '921673621', 'ACTIVE', 'CLOSED', '2024-07-18', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(70, '1692790481', 137651141.21, 55533022.818322, 82118118.391678, 4082858592.9825, '921673621', 'ACTIVE', 'CLOSED', '2024-08-17', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(71, '1692790481', 137651141.21, 54438114.5731, 83213026.6369, 3999645566.3456, '921673621', 'ACTIVE', 'CLOSED', '2024-09-16', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(72, '1692790481', 137651141.21, 53328607.551274, 84322533.658726, 3915323032.6869, '921673621', 'ACTIVE', 'CLOSED', '2024-10-16', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(73, '1692790481', 137651141.21, 52204307.102491, 85446834.107509, 3829876198.5793, '921673621', 'ACTIVE', 'CLOSED', '2024-11-15', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(74, '1692790481', 137651141.21, 51065015.981058, 86586125.228942, 3743290073.3504, '921673621', 'ACTIVE', 'CLOSED', '2024-12-15', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(75, '1692790481', 137651141.21, 49910534.311339, 87740606.898661, 3655549466.4517, '921673621', 'ACTIVE', 'CLOSED', '2025-01-14', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(76, '1692790481', 137651141.21, 48740659.55269, 88910481.65731, 3566638984.7944, '921673621', 'ACTIVE', 'CLOSED', '2025-02-13', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(77, '1692790481', 137651141.21, 47555186.463926, 90095954.746074, 3476543030.0484, '921673621', 'ACTIVE', 'CLOSED', '2025-03-15', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(78, '1692790481', 137651141.21, 46353907.067311, 91297234.142689, 3385245795.9057, '921673621', 'ACTIVE', 'CLOSED', '2025-04-14', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(79, '1692790481', 137651141.21, 45136610.612076, 92514530.597924, 3292731265.3077, '921673621', 'ACTIVE', 'CLOSED', '2025-05-14', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(80, '1692790481', 137651141.21, 43903083.537437, 93748057.672563, 3198983207.6352, '921673621', 'ACTIVE', 'CLOSED', '2025-06-13', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(81, '1692790481', 137651141.21, 42653109.435136, 94998031.774864, 3103985175.8603, '921673621', 'ACTIVE', 'CLOSED', '2025-07-13', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(82, '1692790481', 137651141.21, 41386469.011471, 96264672.198529, 3007720503.6618, '921673621', 'ACTIVE', 'CLOSED', '2025-08-12', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(83, '1692790481', 137651141.21, 40102940.048824, 97548201.161176, 2910172302.5006, '921673621', 'ACTIVE', 'CLOSED', '2025-09-11', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(84, '1692790481', 137651141.21, 38802297.366675, 98848843.843325, 2811323458.6573, '921673621', 'ACTIVE', 'CLOSED', '2025-10-11', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(85, '1692790481', 137651141.21, 37484312.782097, 100166828.4279, 2711156630.2294, '921673621', 'ACTIVE', 'CLOSED', '2025-11-10', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(86, '1692790481', 137651141.21, 36148755.069725, 101502386.14027, 2609654244.0891, '921673621', 'ACTIVE', 'CLOSED', '2025-12-10', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(87, '1692790481', 137651141.21, 34795389.921188, 102855751.28881, 2506798492.8003, '921673621', 'ACTIVE', 'CLOSED', '2026-01-09', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(88, '1692790481', 137651141.21, 33423979.904004, 104227161.306, 2402571331.4943, '921673621', 'ACTIVE', 'CLOSED', '2026-02-08', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(89, '1692790481', 137651141.21, 32034284.419924, 105616856.79008, 2296954474.7042, '921673621', 'ACTIVE', 'CLOSED', '2026-03-10', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(90, '1692790481', 137651141.21, 30626059.662723, 107025081.54728, 2189929393.157, '921673621', 'ACTIVE', 'CLOSED', '2026-04-09', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(91, '1692790481', 137651141.21, 29199058.575426, 108452082.63457, 2081477310.5224, '921673621', 'ACTIVE', 'CLOSED', '2026-05-09', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(92, '1692790481', 137651141.21, 27753030.806965, 109898110.40303, 1971579200.1193, '921673621', 'ACTIVE', 'CLOSED', '2026-06-08', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(93, '1692790481', 137651141.21, 26287722.668258, 111363418.54174, 1860215781.5776, '921673621', 'ACTIVE', 'CLOSED', '2026-07-08', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(94, '1692790481', 137651141.21, 24802877.087701, 112848264.1223, 1747367517.4553, '921673621', 'ACTIVE', 'CLOSED', '2026-08-07', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(95, '1692790481', 137651141.21, 23298233.566071, 114352907.64393, 1633014609.8114, '921673621', 'ACTIVE', 'CLOSED', '2026-09-06', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(96, '1692790481', 137651141.21, 21773528.130818, 115877613.07918, 1517136996.7322, '921673621', 'ACTIVE', 'CLOSED', '2026-10-06', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(97, '1692790481', 137651141.21, 20228493.289763, 117422647.92024, 1399714348.812, '921673621', 'ACTIVE', 'CLOSED', '2026-11-05', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(98, '1692790481', 137651141.21, 18662857.984159, 118988283.22584, 1280726065.5861, '921673621', 'ACTIVE', 'CLOSED', '2026-12-05', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(99, '1692790481', 137651141.21, 17076347.541148, 120574793.66885, 1160151271.9173, '921673621', 'ACTIVE', 'CLOSED', '2027-01-04', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(100, '1692790481', 137651141.21, 15468683.625564, 122182457.58444, 1037968814.3328, '921673621', 'ACTIVE', 'CLOSED', '2027-02-03', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(101, '1692790481', 137651141.21, 13839584.191104, 123811557.0189, 914157257.31393, '921673621', 'ACTIVE', 'CLOSED', '2027-03-05', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(102, '1692790481', 137651141.21, 12188763.430852, 125462377.77915, 788694879.53478, '921673621', 'ACTIVE', 'CLOSED', '2027-04-04', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(103, '1692790481', 137651141.21, 10515931.72713, 127135209.48287, 661559670.05191, '921673621', 'ACTIVE', 'CLOSED', '2027-05-04', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(104, '1692790481', 137651141.21, 8820795.6006922, 128830345.60931, 532729324.44261, '921673621', 'ACTIVE', 'CLOSED', '2027-06-03', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(105, '1692790481', 137651141.21, 7103057.6592347, 130548083.55077, 402181240.89184, '921673621', 'ACTIVE', 'CLOSED', '2027-07-03', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(106, '1692790481', 137651141.21, 5362416.5452245, 132288724.66478, 269892516.22706, '921673621', 'ACTIVE', 'CLOSED', '2027-08-02', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(107, '1692790481', 137651141.21, 3598566.8830275, 134052574.32697, 135839941.90009, '921673621', 'ACTIVE', 'CLOSED', '2027-09-01', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(108, '1692790481', 137651141.12543, 1811199.2253346, 135839941.90009, 0, '921673621', 'ACTIVE', 'CLOSED', '2027-10-01', NULL, '2023-08-23 09:26:40', '2023-08-23 09:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(109, '1692793558', 136904.59, 5333.3333333333, 131571.25666667, 268428.74333333, '921673621', 'ACTIVE', 'CLOSED', '2023-09-22', NULL, '2023-08-23 09:28:02', '2023-08-23 09:28:02', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(110, '1692793558', 136904.59, 3579.0499111111, 133325.54008889, 135103.20324444, '921673621', 'ACTIVE', 'CLOSED', '2023-10-22', NULL, '2023-08-23 09:28:02', '2023-08-23 09:28:02', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(111, '1692793558', 136904.5792877, 1801.3760432593, 135103.20324444, 0, '921673621', 'ACTIVE', 'CLOSED', '2023-11-21', NULL, '2023-08-23 09:28:02', '2023-08-23 09:28:02', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(112, '1692793558', 136904.59, 5333.3333333333, 131571.25666667, 268428.74333333, '921673621', 'ACTIVE', 'CLOSED', '2023-09-22', NULL, '2023-08-23 09:28:29', '2023-08-23 09:28:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(113, '1692793558', 136904.59, 3579.0499111111, 133325.54008889, 135103.20324444, '921673621', 'ACTIVE', 'CLOSED', '2023-10-22', NULL, '2023-08-23 09:28:29', '2023-08-23 09:28:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(114, '1692793558', 136904.5792877, 1801.3760432593, 135103.20324444, 0, '921673621', 'ACTIVE', 'CLOSED', '2023-11-21', NULL, '2023-08-23 09:28:29', '2023-08-23 09:28:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(115, '1692793558', 136904.59, 5333.3333333333, 131571.25666667, 268428.74333333, '921673621', 'ACTIVE', 'CLOSED', '2023-09-22', NULL, '2023-08-23 09:30:40', '2023-08-23 09:30:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(116, '1692793558', 136904.59, 3579.0499111111, 133325.54008889, 135103.20324444, '921673621', 'ACTIVE', 'CLOSED', '2023-10-22', NULL, '2023-08-23 09:30:40', '2023-08-23 09:30:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(117, '1692793558', 136904.5792877, 1801.3760432593, 135103.20324444, 0, '921673621', 'ACTIVE', 'CLOSED', '2023-11-21', NULL, '2023-08-23 09:30:40', '2023-08-23 09:30:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(118, '1691410650', 1745302.84, 133333.33333333, 1611969.5066667, 8388030.4933333, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-22', NULL, '2023-08-23 09:32:10', '2023-08-23 09:32:10', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(119, '1691410650', 1745302.84, 111840.40657778, 1633462.4334222, 6754568.0599111, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-22', NULL, '2023-08-23 09:32:10', '2023-08-23 09:32:10', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(120, '1691410650', 1745302.84, 90060.907465481, 1655241.9325345, 5099326.1273766, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-21', NULL, '2023-08-23 09:32:10', '2023-08-23 09:32:10', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(121, '1691410650', 1745302.84, 67991.015031688, 1677311.8249683, 3422014.3024083, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-21', NULL, '2023-08-23 09:32:10', '2023-08-23 09:32:10', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(122, '1691410650', 1745302.84, 45626.857365444, 1699675.9826346, 1722338.3197737, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-20', NULL, '2023-08-23 09:32:10', '2023-08-23 09:32:10', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(123, '1691410650', 1745302.830704, 22964.510930316, 1722338.3197737, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-19', NULL, '2023-08-23 09:32:10', '2023-08-23 09:32:10', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(124, '1694100884', 253756.22, 5000, 248756.22, 251243.78, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-07', NULL, '2023-09-07 15:35:20', '2023-09-07 15:35:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(125, '1694100884', 253756.2178, 2512.4378, 251243.78, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-06', NULL, '2023-09-07 15:35:20', '2023-09-07 15:35:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(126, '1695281446', 3745107.59, 437500, 3307607.59, 31692392.41, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-21', NULL, '2023-09-21 07:31:18', '2023-09-21 07:31:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(127, '1695281446', 3745107.59, 396154.905125, 3348952.684875, 28343439.725125, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-20', NULL, '2023-09-21 07:31:18', '2023-09-21 07:31:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(128, '1695281446', 3745107.59, 354292.99656406, 3390814.5934359, 24952625.131689, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-20', NULL, '2023-09-21 07:31:18', '2023-09-21 07:31:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(129, '1695281446', 3745107.59, 311907.81414611, 3433199.7758539, 21519425.355835, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-19', NULL, '2023-09-21 07:31:18', '2023-09-21 07:31:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(130, '1695281446', 3745107.59, 268992.81694794, 3476114.7730521, 18043310.582783, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-18', NULL, '2023-09-21 07:31:18', '2023-09-21 07:31:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(131, '1695281446', 3745107.59, 225541.38228479, 3519566.2077152, 14523744.375068, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-19', NULL, '2023-09-21 07:31:18', '2023-09-21 07:31:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(132, '1695281446', 3745107.59, 181546.80468835, 3563560.7853117, 10960183.589756, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-18', NULL, '2023-09-21 07:31:18', '2023-09-21 07:31:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(133, '1695281446', 3745107.59, 137002.29487195, 3608105.295128, 7352078.2946282, '921673621', 'ACTIVE', 'ACTIVE', '2024-05-18', NULL, '2023-09-21 07:31:18', '2023-09-21 07:31:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(134, '1695281446', 3745107.59, 91900.978682853, 3653206.6113171, 3698871.6833111, '921673621', 'ACTIVE', 'ACTIVE', '2024-06-17', NULL, '2023-09-21 07:31:18', '2023-09-21 07:31:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(135, '1695281446', 3745107.5793525, 46235.896041388, 3698871.6833111, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-07-17', NULL, '2023-09-21 07:31:18', '2023-09-21 07:31:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(136, '1695294388', 22564.58, 3125, 19439.58, 230560.42, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-21', NULL, '2023-09-21 13:26:17', '2023-09-21 13:26:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(137, '1695294388', 22564.58, 2882.00525, 19682.57475, 210877.84525, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-20', NULL, '2023-09-21 13:26:17', '2023-11-21 11:18:30', NULL, NULL, NULL, NULL, '2023-11-22', 'amesafiri akirudi atalipa', 0, 0),
(138, '1695294388', 22564.58, 2635.973065625, 19928.606934375, 190949.23831562, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-20', NULL, '2023-09-21 13:26:17', '2023-09-21 13:26:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(139, '1695294388', 22564.58, 2386.8654789453, 20177.714521055, 170771.52379457, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-19', NULL, '2023-09-21 13:26:17', '2023-09-21 13:26:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(140, '1695294388', 22564.58, 2134.6440474321, 20429.935952568, 150341.587842, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-18', NULL, '2023-09-21 13:26:17', '2023-09-21 13:26:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(141, '1695294388', 22564.58, 1879.269848025, 20685.310151975, 129656.27769003, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-19', NULL, '2023-09-21 13:26:17', '2023-09-21 13:26:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(142, '1695294388', 22564.58, 1620.7034711253, 20943.876528875, 108712.40116115, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-18', NULL, '2023-09-21 13:26:17', '2023-09-21 13:26:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(143, '1695294388', 22564.58, 1358.9050145144, 21205.674985486, 87506.726175667, '921673621', 'ACTIVE', 'ACTIVE', '2024-05-18', NULL, '2023-09-21 13:26:17', '2023-09-21 13:26:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(144, '1695294388', 22564.58, 1093.8340771958, 21470.745922804, 66035.980252863, '921673621', 'ACTIVE', 'ACTIVE', '2024-06-17', NULL, '2023-09-21 13:26:17', '2023-09-21 13:26:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(145, '1695294388', 22564.58, 825.44975316079, 21739.130246839, 44296.850006024, '921673621', 'ACTIVE', 'ACTIVE', '2024-07-17', NULL, '2023-09-21 13:26:17', '2023-09-21 13:26:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(146, '1695294388', 22564.58, 553.7106250753, 22010.869374925, 22285.980631099, '921673621', 'ACTIVE', 'ACTIVE', '2024-08-16', NULL, '2023-09-21 13:26:17', '2023-09-21 13:26:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(147, '1695294388', 22564.555388988, 278.57475788874, 22285.980631099, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-09-15', NULL, '2023-09-21 13:26:17', '2023-09-21 13:26:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(148, '1695723205', 17177.31, 1625, 15552.31, 114447.69, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-26', NULL, '2023-09-26 10:13:43', '2023-09-26 10:13:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(149, '1695723205', 17177.31, 1430.596125, 15746.713875, 98700.976125, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-25', NULL, '2023-09-26 10:13:43', '2023-09-26 10:13:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(150, '1695723205', 17177.31, 1233.7622015625, 15943.547798438, 82757.428326562, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-25', NULL, '2023-09-26 10:13:43', '2023-09-26 10:13:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(151, '1695723205', 17177.31, 1034.467854082, 16142.842145918, 66614.586180645, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-24', NULL, '2023-09-26 10:13:43', '2023-09-26 10:13:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(152, '1695723205', 17177.31, 832.68232725806, 16344.627672742, 50269.958507903, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-23', NULL, '2023-09-26 10:13:43', '2023-09-26 10:13:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(153, '1695723205', 17177.31, 628.37448134878, 16548.935518651, 33721.022989251, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-24', NULL, '2023-09-26 10:13:43', '2023-09-26 10:13:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(154, '1695723205', 17177.31, 421.51278736564, 16755.797212634, 16965.225776617, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-23', NULL, '2023-09-26 10:13:43', '2023-09-26 10:13:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(155, '1695723205', 17177.291098825, 212.06532220771, 16965.225776617, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-05-23', NULL, '2023-09-26 10:13:43', '2023-09-26 10:13:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(156, '1695725761', 30687.83, 4250, 26437.83, 313562.17, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-26', NULL, '2023-09-26 10:56:49', '2023-09-26 10:56:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(157, '1695725761', 30687.83, 4250, 26437.83, 287124.34, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-25', NULL, '2023-09-26 10:56:49', '2023-09-26 10:56:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(158, '1695725761', 30687.83, 4250, 26437.83, 260686.51, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-25', NULL, '2023-09-26 10:56:49', '2023-09-26 10:56:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(159, '1695725761', 30687.83, 4250, 26437.83, 234248.68, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-24', NULL, '2023-09-26 10:56:49', '2023-09-26 10:56:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(160, '1695725761', 30687.83, 4250, 26437.83, 207810.85, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-23', NULL, '2023-09-26 10:56:49', '2023-09-26 10:56:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(161, '1695725761', 30687.83, 4250, 26437.83, 181373.02, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-24', NULL, '2023-09-26 10:56:49', '2023-09-26 10:56:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(162, '1695725761', 30687.83, 4250, 26437.83, 154935.19, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-23', NULL, '2023-09-26 10:56:49', '2023-09-26 10:56:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(163, '1695725761', 30687.83, 4250, 26437.83, 128497.36, '921673621', 'ACTIVE', 'ACTIVE', '2024-05-23', NULL, '2023-09-26 10:56:49', '2023-09-26 10:56:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(164, '1695725761', 30687.83, 4250, 26437.83, 102059.53, '921673621', 'ACTIVE', 'ACTIVE', '2024-06-22', NULL, '2023-09-26 10:56:49', '2023-09-26 10:56:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(165, '1695725761', 30687.83, 4250, 26437.83, 75621.7, '921673621', 'ACTIVE', 'ACTIVE', '2024-07-22', NULL, '2023-09-26 10:56:49', '2023-09-26 10:56:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(166, '1695725761', 30687.83, 4250, 26437.83, 49183.87, '921673621', 'ACTIVE', 'ACTIVE', '2024-08-21', NULL, '2023-09-26 10:56:49', '2023-09-26 10:56:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(167, '1695725761', 30687.83, 4250, 26437.83, 22746.04, '921673621', 'ACTIVE', 'ACTIVE', '2024-09-20', NULL, '2023-09-26 10:56:49', '2023-09-26 10:56:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(168, '1695725761', 26996.04, 4250, 22746.04, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-10-20', NULL, '2023-09-26 10:56:49', '2023-09-26 10:56:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(169, '1695736013', 23039.39, 1387.5, 21651.89, 89348.11, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-26', NULL, '2023-09-26 13:49:54', '2023-09-26 13:49:54', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(170, '1695736013', 23039.39, 1387.5, 21651.89, 67696.22, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-25', NULL, '2023-09-26 13:49:54', '2023-09-26 13:49:54', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(171, '1695736013', 23039.39, 1387.5, 21651.89, 46044.33, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-25', NULL, '2023-09-26 13:49:54', '2023-09-26 13:49:54', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(172, '1695736013', 23039.39, 1387.5, 21651.89, 24392.44, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-24', NULL, '2023-09-26 13:49:54', '2023-09-26 13:49:54', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(173, '1695736013', 23039.39, 1387.5, 21651.89, 2740.55, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-23', NULL, '2023-09-26 13:49:54', '2023-09-26 13:49:54', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(174, '1695736013', 4128.05, 1387.5, 2740.55, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-24', NULL, '2023-09-26 13:49:54', '2023-09-26 13:49:54', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(175, '1695737111', 26105.07, 1875, 24230.07, 125769.93, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-26', NULL, '2023-09-26 14:07:34', '2023-09-26 14:07:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(176, '1695737111', 26105.07, 1572.124125, 24532.945875, 101236.984125, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-25', NULL, '2023-09-26 14:07:34', '2023-09-26 14:07:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(177, '1695737111', 26105.07, 1265.4623015625, 24839.607698437, 76397.376426562, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-25', NULL, '2023-09-26 14:07:34', '2023-09-26 14:07:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(178, '1695737111', 26105.07, 954.96720533203, 25150.102794668, 51247.273631895, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-24', NULL, '2023-09-26 14:07:34', '2023-09-26 14:07:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(179, '1695737111', 26105.07, 640.59092039868, 25464.479079601, 25782.794552293, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-23', NULL, '2023-09-26 14:07:34', '2023-09-26 14:07:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(180, '1695737111', 26105.079484197, 322.28493190367, 25782.794552293, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-24', NULL, '2023-09-26 14:07:34', '2023-09-26 14:07:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(181, '1695737906', 45562.5, 562.5, 45000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-26', NULL, '2023-09-26 14:18:38', '2023-09-26 14:18:38', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(182, '1695739042', 20759.41, 2875, 17884.41, 212115.59, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-26', NULL, '2023-09-26 14:37:35', '2023-09-26 14:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(183, '1695739042', 20759.41, 2651.444875, 18107.965125, 194007.624875, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-25', NULL, '2023-09-26 14:37:35', '2023-09-26 14:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(184, '1695739042', 20759.41, 2425.0953109375, 18334.314689062, 175673.31018594, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-25', NULL, '2023-09-26 14:37:35', '2023-09-26 14:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(185, '1695739042', 20759.41, 2195.9163773242, 18563.493622676, 157109.81656326, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-24', NULL, '2023-09-26 14:37:35', '2023-09-26 14:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(186, '1695739042', 20759.41, 1963.8727070408, 18795.537292959, 138314.2792703, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-23', NULL, '2023-09-26 14:37:35', '2023-09-26 14:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(187, '1695739042', 20759.41, 1728.9284908788, 19030.481509121, 119283.79776118, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-24', NULL, '2023-09-26 14:37:35', '2023-09-26 14:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(188, '1695739042', 20759.41, 1491.0474720148, 19268.362527985, 100015.4352332, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-23', NULL, '2023-09-26 14:37:35', '2023-09-26 14:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(189, '1695739042', 20759.41, 1250.192940415, 19509.217059585, 80506.218173611, '921673621', 'ACTIVE', 'ACTIVE', '2024-05-23', NULL, '2023-09-26 14:37:35', '2023-09-26 14:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(190, '1695739042', 20759.41, 1006.3277271701, 19753.08227283, 60753.135900781, '921673621', 'ACTIVE', 'ACTIVE', '2024-06-22', NULL, '2023-09-26 14:37:35', '2023-09-26 14:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(191, '1695739042', 20759.41, 759.41419875976, 19999.99580124, 40753.140099541, '921673621', 'ACTIVE', 'ACTIVE', '2024-07-22', NULL, '2023-09-26 14:37:35', '2023-09-26 14:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(192, '1695739042', 20759.41, 509.41425124426, 20249.995748756, 20503.144350785, '921673621', 'ACTIVE', 'ACTIVE', '2024-08-21', NULL, '2023-09-26 14:37:35', '2023-09-26 14:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(193, '1695739042', 20759.43365517, 256.28930438481, 20503.144350785, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-09-20', NULL, '2023-09-26 14:37:35', '2023-09-26 14:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(194, '1695739661', 18051.66, 2500, 15551.66, 184448.34, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-26', NULL, '2023-09-26 14:47:51', '2023-09-26 14:47:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(195, '1695739661', 18051.66, 2305.60425, 15746.05575, 168702.28425, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-25', NULL, '2023-09-26 14:47:51', '2023-09-26 14:47:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(196, '1695739661', 18051.66, 2108.778553125, 15942.881446875, 152759.40280313, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-25', NULL, '2023-09-26 14:47:51', '2023-09-26 14:47:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(197, '1695739661', 18051.66, 1909.4925350391, 16142.167464961, 136617.23533816, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-24', NULL, '2023-09-26 14:47:51', '2023-09-26 14:47:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(198, '1695739661', 18051.66, 1707.7154417271, 16343.944558273, 120273.29077989, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-23', NULL, '2023-09-26 14:47:51', '2023-09-26 14:47:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(199, '1695739661', 18051.66, 1503.4161347486, 16548.243865251, 103725.04691464, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-24', NULL, '2023-09-26 14:47:51', '2023-09-26 14:47:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(200, '1695739661', 18051.66, 1296.563086433, 16755.096913567, 86969.950001073, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-23', NULL, '2023-09-26 14:47:51', '2023-09-26 14:47:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(201, '1695739661', 18051.66, 1087.1243750134, 16964.535624987, 70005.414376086, '921673621', 'ACTIVE', 'ACTIVE', '2024-05-23', NULL, '2023-09-26 14:47:51', '2023-09-26 14:47:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(202, '1695739661', 18051.66, 875.06767970108, 17176.592320299, 52828.822055787, '921673621', 'ACTIVE', 'ACTIVE', '2024-06-22', NULL, '2023-09-26 14:47:51', '2023-09-26 14:47:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(203, '1695739661', 18051.66, 660.36027569734, 17391.299724303, 35437.522331485, '921673621', 'ACTIVE', 'ACTIVE', '2024-07-22', NULL, '2023-09-26 14:47:51', '2023-09-26 14:47:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(204, '1695739661', 18051.66, 442.96902914356, 17608.690970856, 17828.831360628, '921673621', 'ACTIVE', 'ACTIVE', '2024-08-21', NULL, '2023-09-26 14:47:51', '2023-09-26 14:47:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(205, '1695739661', 18051.691752636, 222.86039200785, 17828.831360628, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-09-20', NULL, '2023-09-26 14:47:51', '2023-09-26 14:47:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(206, '1695742386', 29360.52, 3750, 25610.52, 274389.48, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-26', NULL, '2023-09-26 15:33:25', '2023-09-26 15:33:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(207, '1695742386', 29360.52, 3750, 25610.52, 248778.96, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-25', NULL, '2023-09-26 15:33:25', '2023-09-26 15:33:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(208, '1695742386', 29360.52, 3750, 25610.52, 223168.44, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-25', NULL, '2023-09-26 15:33:25', '2023-09-26 15:33:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(209, '1695742386', 29360.52, 3750, 25610.52, 197557.92, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-24', NULL, '2023-09-26 15:33:25', '2023-09-26 15:33:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(210, '1695742386', 29360.52, 3750, 25610.52, 171947.4, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-23', NULL, '2023-09-26 15:33:25', '2023-09-26 15:33:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(211, '1695742386', 29360.52, 3750, 25610.52, 146336.88, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-24', NULL, '2023-09-26 15:33:25', '2023-09-26 15:33:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(212, '1695742386', 29360.52, 3750, 25610.52, 120726.36, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-23', NULL, '2023-09-26 15:33:25', '2023-09-26 15:33:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(213, '1695742386', 29360.52, 3750, 25610.52, 95115.84, '921673621', 'ACTIVE', 'ACTIVE', '2024-05-23', NULL, '2023-09-26 15:33:25', '2023-09-26 15:33:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(214, '1695742386', 29360.52, 3750, 25610.52, 69505.32, '921673621', 'ACTIVE', 'ACTIVE', '2024-06-22', NULL, '2023-09-26 15:33:25', '2023-09-26 15:33:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(215, '1695742386', 29360.52, 3750, 25610.52, 43894.8, '921673621', 'ACTIVE', 'ACTIVE', '2024-07-22', NULL, '2023-09-26 15:33:25', '2023-09-26 15:33:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(216, '1695742386', 29360.52, 3750, 25610.52, 18284.28, '921673621', 'ACTIVE', 'ACTIVE', '2024-08-21', NULL, '2023-09-26 15:33:25', '2023-09-26 15:33:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(217, '1695742386', 22034.28, 3750, 18284.28, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-09-20', NULL, '2023-09-26 15:33:25', '2023-09-26 15:33:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(218, '1695763797', 24364.73, 1750, 22614.73, 117385.27, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-26', NULL, '2023-09-26 21:30:41', '2023-09-26 21:30:41', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(219, '1695763797', 24364.73, 1467.315875, 22897.414125, 94487.855875, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-25', NULL, '2023-09-26 21:30:41', '2023-09-26 21:30:41', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(220, '1695763797', 24364.73, 1181.0981984375, 23183.631801563, 71304.224073438, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-25', NULL, '2023-09-26 21:30:41', '2023-09-26 21:30:41', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(221, '1695763797', 24364.73, 891.30280091797, 23473.427199082, 47830.796874355, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-24', NULL, '2023-09-26 21:30:41', '2023-09-26 21:30:41', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(222, '1695763797', 24364.73, 597.88496092944, 23766.845039071, 24063.951835285, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-23', NULL, '2023-09-26 21:30:41', '2023-09-26 21:30:41', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(223, '1695763797', 24364.751233226, 300.79939794106, 24063.951835285, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-24', NULL, '2023-09-26 21:30:41', '2023-09-26 21:30:41', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(224, '1695763797', 24364.73, 1750, 22614.73, 117385.27, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-26', NULL, '2023-09-26 21:33:43', '2023-09-26 21:33:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(225, '1695763797', 24364.73, 1467.315875, 22897.414125, 94487.855875, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-25', NULL, '2023-09-26 21:33:43', '2023-09-26 21:33:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(226, '1695763797', 24364.73, 1181.0981984375, 23183.631801563, 71304.224073438, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-25', NULL, '2023-09-26 21:33:43', '2023-09-26 21:33:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(227, '1695763797', 24364.73, 891.30280091797, 23473.427199082, 47830.796874355, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-24', NULL, '2023-09-26 21:33:43', '2023-09-26 21:33:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(228, '1695763797', 24364.73, 597.88496092944, 23766.845039071, 24063.951835285, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-23', NULL, '2023-09-26 21:33:43', '2023-09-26 21:33:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(229, '1695763797', 24364.751233226, 300.79939794106, 24063.951835285, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-24', NULL, '2023-09-26 21:33:43', '2023-09-26 21:33:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(230, '1695764868', 31974.77, 1550, 30424.77, 93575.23, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-26', NULL, '2023-09-26 21:47:59', '2023-09-26 21:47:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(231, '1695764868', 31974.77, 1550, 30424.77, 63150.46, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-25', NULL, '2023-09-26 21:47:59', '2023-09-26 21:47:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);
INSERT INTO `loans_schedules` (`id`, `loan_id`, `installment`, `interest`, `principle`, `balance`, `bank_account_number`, `completion_status`, `account_status`, `installment_date`, `next_check_date`, `created_at`, `updated_at`, `penalties`, `days_in_arrears`, `amount_in_arrears`, `payment`, `promise_date`, `comment`, `opening_balance`, `closing_balance`) VALUES
(232, '1695764868', 31974.77, 1550, 30424.77, 32725.69, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-25', NULL, '2023-09-26 21:47:59', '2023-09-26 21:47:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(233, '1695764868', 31974.77, 1550, 30424.77, 2300.92, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-24', NULL, '2023-09-26 21:47:59', '2023-09-26 21:47:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(234, '1695764868', 3850.92, 1550, 2300.92, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-23', NULL, '2023-09-26 21:47:59', '2023-09-26 21:47:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(235, '1695796061', 117160.71, 2875, 114285.71, 115714.29, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-27', NULL, '2023-09-27 06:27:52', '2023-09-27 06:27:52', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(236, '1695796061', 118589.29, 2875, 115714.29, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-26', NULL, '2023-09-27 06:27:52', '2023-09-27 06:27:52', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(237, '1695796061', 117160.71, 2875, 114285.71, 115714.29, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-27', NULL, '2023-09-27 06:28:10', '2023-09-27 06:28:10', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(238, '1695796061', 118589.29, 2875, 115714.29, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-26', NULL, '2023-09-27 06:28:10', '2023-09-27 06:28:10', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(239, '1695796061', 117160.71, 2875, 114285.71, 115714.29, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-27', NULL, '2023-09-27 06:32:22', '2023-09-27 06:32:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(240, '1695796061', 118589.29, 2875, 115714.29, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-26', NULL, '2023-09-27 06:32:22', '2023-09-27 06:32:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(241, '1695802310', 20111.89, 1675, 18436.89, 115563.11, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-27', NULL, '2023-09-27 08:12:06', '2023-09-27 08:12:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(242, '1695802310', 20111.89, 1675, 18436.89, 97126.22, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-26', NULL, '2023-09-27 08:12:06', '2023-09-27 08:12:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(243, '1695802310', 20111.89, 1675, 18436.89, 78689.33, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-26', NULL, '2023-09-27 08:12:06', '2023-09-27 08:12:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(244, '1695802310', 20111.89, 1675, 18436.89, 60252.44, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-25', NULL, '2023-09-27 08:12:06', '2023-09-27 08:12:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(245, '1695802310', 20111.89, 1675, 18436.89, 41815.55, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-24', NULL, '2023-09-27 08:12:06', '2023-09-27 08:12:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(246, '1695802310', 20111.89, 1675, 18436.89, 23378.66, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-25', NULL, '2023-09-27 08:12:06', '2023-09-27 08:12:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(247, '1695802310', 20111.89, 1675, 18436.89, 4941.77, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-24', NULL, '2023-09-27 08:12:06', '2023-09-27 08:12:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(248, '1695802310', 6616.77, 1675, 4941.77, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-05-24', NULL, '2023-09-27 08:12:06', '2023-09-27 08:12:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(249, '1695802310', 20111.89, 1675, 18436.89, 115563.11, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-27', NULL, '2023-09-27 08:27:25', '2023-09-27 08:27:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(250, '1695802310', 20111.89, 1675, 18436.89, 97126.22, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-26', NULL, '2023-09-27 08:27:25', '2023-09-27 08:27:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(251, '1695802310', 20111.89, 1675, 18436.89, 78689.33, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-26', NULL, '2023-09-27 08:27:25', '2023-09-27 08:27:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(252, '1695802310', 20111.89, 1675, 18436.89, 60252.44, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-25', NULL, '2023-09-27 08:27:25', '2023-09-27 08:27:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(253, '1695802310', 20111.89, 1675, 18436.89, 41815.55, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-24', NULL, '2023-09-27 08:27:25', '2023-09-27 08:27:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(254, '1695802310', 20111.89, 1675, 18436.89, 23378.66, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-25', NULL, '2023-09-27 08:27:25', '2023-09-27 08:27:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(255, '1695802310', 20111.89, 1675, 18436.89, 4941.77, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-24', NULL, '2023-09-27 08:27:25', '2023-09-27 08:27:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(256, '1695802310', 6616.77, 1675, 4941.77, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-05-24', NULL, '2023-09-27 08:27:25', '2023-09-27 08:27:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(257, '1695806663', 19061.27, 1587.5, 17473.77, 109526.23, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-27', NULL, '2023-09-27 09:24:37', '2023-09-27 09:24:37', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(258, '1695806663', 19061.27, 1369.077875, 17692.192125, 91834.037875, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-26', NULL, '2023-09-27 09:24:37', '2023-09-27 09:24:37', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(259, '1695806663', 19061.27, 1147.9254734375, 17913.344526563, 73920.693348437, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-26', NULL, '2023-09-27 09:24:37', '2023-09-27 09:24:37', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(260, '1695806663', 19061.27, 924.00866685547, 18137.261333145, 55783.432015293, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-25', NULL, '2023-09-27 09:24:37', '2023-09-27 09:24:37', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(261, '1695806663', 19061.27, 697.29290019116, 18363.977099809, 37419.454915484, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-24', NULL, '2023-09-27 09:24:37', '2023-09-27 09:24:37', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(262, '1695806663', 19061.27, 467.74318644355, 18593.526813556, 18825.928101928, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-25', NULL, '2023-09-27 09:24:37', '2023-09-27 09:24:37', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(263, '1695806663', 19061.252203202, 235.3241012741, 18825.928101928, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-24', NULL, '2023-09-27 09:24:37', '2023-09-27 09:24:37', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(264, '1695806663', 19061.27, 1587.5, 17473.77, 109526.23, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-27', NULL, '2023-09-27 09:27:22', '2023-09-27 09:27:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(265, '1695806663', 19061.27, 1369.077875, 17692.192125, 91834.037875, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-26', NULL, '2023-09-27 09:27:22', '2023-09-27 09:27:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(266, '1695806663', 19061.27, 1147.9254734375, 17913.344526563, 73920.693348437, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-26', NULL, '2023-09-27 09:27:22', '2023-09-27 09:27:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(267, '1695806663', 19061.27, 924.00866685547, 18137.261333145, 55783.432015293, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-25', NULL, '2023-09-27 09:27:22', '2023-09-27 09:27:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(268, '1695806663', 19061.27, 697.29290019116, 18363.977099809, 37419.454915484, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-24', NULL, '2023-09-27 09:27:22', '2023-09-27 09:27:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(269, '1695806663', 19061.27, 467.74318644355, 18593.526813556, 18825.928101928, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-25', NULL, '2023-09-27 09:27:22', '2023-09-27 09:27:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(270, '1695806663', 19061.252203202, 235.3241012741, 18825.928101928, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-24', NULL, '2023-09-27 09:27:22', '2023-09-27 09:27:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(271, '1695806663', 19061.27, 1587.5, 17473.77, 109526.23, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-27', NULL, '2023-09-27 09:30:59', '2023-09-27 09:30:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(272, '1695806663', 19061.27, 1369.077875, 17692.192125, 91834.037875, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-26', NULL, '2023-09-27 09:30:59', '2023-09-27 09:30:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(273, '1695806663', 19061.27, 1147.9254734375, 17913.344526563, 73920.693348437, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-26', NULL, '2023-09-27 09:30:59', '2023-09-27 09:30:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(274, '1695806663', 19061.27, 924.00866685547, 18137.261333145, 55783.432015293, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-25', NULL, '2023-09-27 09:30:59', '2023-09-27 09:30:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(275, '1695806663', 19061.27, 697.29290019116, 18363.977099809, 37419.454915484, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-24', NULL, '2023-09-27 09:30:59', '2023-09-27 09:30:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(276, '1695806663', 19061.27, 467.74318644355, 18593.526813556, 18825.928101928, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-25', NULL, '2023-09-27 09:30:59', '2023-09-27 09:30:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(277, '1695806663', 19061.252203202, 235.3241012741, 18825.928101928, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-24', NULL, '2023-09-27 09:30:59', '2023-09-27 09:30:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(278, '1695806663', 19061.27, 1587.5, 17473.77, 109526.23, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-27', NULL, '2023-09-27 09:33:16', '2023-09-27 09:33:16', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(279, '1695806663', 19061.27, 1369.077875, 17692.192125, 91834.037875, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-26', NULL, '2023-09-27 09:33:16', '2023-09-27 09:33:16', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(280, '1695806663', 19061.27, 1147.9254734375, 17913.344526563, 73920.693348437, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-26', NULL, '2023-09-27 09:33:16', '2023-09-27 09:33:16', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(281, '1695806663', 19061.27, 924.00866685547, 18137.261333145, 55783.432015293, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-25', NULL, '2023-09-27 09:33:16', '2023-09-27 09:33:16', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(282, '1695806663', 19061.27, 697.29290019116, 18363.977099809, 37419.454915484, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-24', NULL, '2023-09-27 09:33:16', '2023-09-27 09:33:16', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(283, '1695806663', 19061.27, 467.74318644355, 18593.526813556, 18825.928101928, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-25', NULL, '2023-09-27 09:33:16', '2023-09-27 09:33:16', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(284, '1695806663', 19061.252203202, 235.3241012741, 18825.928101928, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-24', NULL, '2023-09-27 09:33:16', '2023-09-27 09:33:16', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(285, '1695807715', 17403.38, 1250, 16153.38, 83846.62, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-27', NULL, '2023-09-27 09:42:07', '2023-09-27 09:42:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(286, '1695807715', 17403.38, 1250, 16153.38, 67693.24, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-26', NULL, '2023-09-27 09:42:07', '2023-09-27 09:42:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(287, '1695807715', 17403.38, 1250, 16153.38, 51539.86, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-26', NULL, '2023-09-27 09:42:07', '2023-09-27 09:42:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(288, '1695807715', 17403.38, 1250, 16153.38, 35386.48, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-25', NULL, '2023-09-27 09:42:07', '2023-09-27 09:42:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(289, '1695807715', 17403.38, 1250, 16153.38, 19233.1, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-24', NULL, '2023-09-27 09:42:07', '2023-09-27 09:42:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(290, '1695807715', 17403.38, 1250, 16153.38, 3079.72, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-25', NULL, '2023-09-27 09:42:07', '2023-09-27 09:42:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(291, '1695807715', 4329.72, 1250, 3079.72, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-24', NULL, '2023-09-27 09:42:07', '2023-09-27 09:42:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(292, '1695905294', 396399.41, 37500, 358899.41, 2641100.59, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-28', NULL, '2023-09-28 12:48:51', '2023-09-28 12:48:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(293, '1695905294', 396399.41, 37500, 358899.41, 2282201.18, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-27', NULL, '2023-09-28 12:48:51', '2023-09-28 12:48:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(294, '1695905294', 396399.41, 37500, 358899.41, 1923301.77, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-27', NULL, '2023-09-28 12:48:51', '2023-09-28 12:48:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(295, '1695905294', 396399.41, 37500, 358899.41, 1564402.36, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-26', NULL, '2023-09-28 12:48:51', '2023-09-28 12:48:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(296, '1695905294', 396399.41, 37500, 358899.41, 1205502.95, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-25', NULL, '2023-09-28 12:48:51', '2023-09-28 12:48:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(297, '1695905294', 396399.41, 37500, 358899.41, 846603.54, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-26', NULL, '2023-09-28 12:48:51', '2023-09-28 12:48:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(298, '1695905294', 396399.41, 37500, 358899.41, 487704.13, '921673621', 'ACTIVE', 'ACTIVE', '2024-04-25', NULL, '2023-09-28 12:48:51', '2023-09-28 12:48:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(299, '1695905294', 396399.41, 37500, 358899.41, 128804.72, '921673621', 'ACTIVE', 'ACTIVE', '2024-05-25', NULL, '2023-09-28 12:48:51', '2023-09-28 12:48:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(300, '1695905294', 166304.72, 37500, 128804.72, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-06-24', NULL, '2023-09-28 12:48:51', '2023-09-28 12:48:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(301, '1696001716', 28681.13, 1480, 27201.13, 83798.87, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-29', NULL, '2023-09-29 15:35:34', '2023-09-29 15:35:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(302, '1696001716', 28681.13, 1117.3182666667, 27563.811733333, 56235.058266667, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-28', NULL, '2023-09-29 15:35:34', '2023-09-29 15:35:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(303, '1696001716', 28681.13, 749.80077688889, 27931.329223111, 28303.729043556, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-28', NULL, '2023-09-29 15:35:34', '2023-09-29 15:35:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(304, '1696001716', 28681.11209747, 377.38305391407, 28303.729043556, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-27', NULL, '2023-09-29 15:35:34', '2023-09-29 15:35:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(305, '1696003014', 41614.13, 2666.6666666667, 38947.463333333, 161052.53666667, '921673621', 'ACTIVE', 'ACTIVE', '2023-10-29', NULL, '2023-09-29 15:57:21', '2023-09-29 15:57:21', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(306, '1696003014', 41614.13, 2666.6666666667, 38947.463333333, 122105.07333333, '921673621', 'ACTIVE', 'ACTIVE', '2023-11-28', NULL, '2023-09-29 15:57:21', '2023-09-29 15:57:21', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(307, '1696003014', 41614.13, 2666.6666666667, 38947.463333333, 83157.61, '921673621', 'ACTIVE', 'ACTIVE', '2023-12-28', NULL, '2023-09-29 15:57:21', '2023-09-29 15:57:21', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(308, '1696003014', 41614.13, 2666.6666666667, 38947.463333333, 44210.146666667, '921673621', 'ACTIVE', 'ACTIVE', '2024-01-27', NULL, '2023-09-29 15:57:21', '2023-09-29 15:57:21', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(309, '1696003014', 41614.13, 2666.6666666667, 38947.463333333, 5262.6833333333, '921673621', 'ACTIVE', 'ACTIVE', '2024-02-26', NULL, '2023-09-29 15:57:21', '2023-09-29 15:57:21', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(310, '1696003014', 7929.35, 2666.6666666667, 5262.6833333333, 0, '921673621', 'ACTIVE', 'ACTIVE', '2024-03-27', NULL, '2023-09-29 15:57:21', '2023-09-29 15:57:21', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(311, '1696334088', 72574.28, 1430, 71144.28, 71855.72, '921673621', 'ACTIVE', 'CLOSED', '2023-11-02', NULL, '2023-10-03 14:32:57', '2023-10-03 14:32:57', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(312, '1696334088', 72574.2772, 718.5572, 71855.72, 0, '921673621', 'ACTIVE', 'CLOSED', '2023-12-02', NULL, '2023-10-03 14:32:57', '2023-10-03 14:32:57', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(313, '1696419133', 30552.75, 1000, 29552.75, 270447.25, '921673621', 'ACTIVE', 'CLOSED', '2023-11-03', NULL, '2023-10-04 11:38:38', '2023-10-04 11:38:38', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(314, '1696419133', 30552.75, 901.49083333333, 29651.259166667, 240795.99083333, '921673621', 'ACTIVE', 'CLOSED', '2023-12-03', NULL, '2023-10-04 11:38:38', '2023-10-04 11:38:38', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(315, '1696419133', 30552.75, 802.65330277778, 29750.096697222, 211045.89413611, '921673621', 'ACTIVE', 'CLOSED', '2024-01-02', NULL, '2023-10-04 11:38:38', '2023-10-04 11:38:38', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(316, '1696419133', 30552.75, 703.48631378704, 29849.263686213, 181196.6304499, '921673621', 'ACTIVE', 'CLOSED', '2024-02-01', NULL, '2023-10-04 11:38:38', '2023-10-04 11:38:38', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(317, '1696419133', 30552.75, 603.98876816633, 29948.761231834, 151247.86921806, '921673621', 'ACTIVE', 'CLOSED', '2024-03-02', NULL, '2023-10-04 11:38:38', '2023-10-04 11:38:38', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(318, '1696419133', 30552.75, 504.15956406021, 30048.59043594, 121199.27878212, '921673621', 'ACTIVE', 'CLOSED', '2024-04-01', NULL, '2023-10-04 11:38:38', '2023-10-04 11:38:38', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(319, '1696419133', 30552.75, 403.99759594042, 30148.75240406, 91050.526378065, '921673621', 'ACTIVE', 'CLOSED', '2024-05-01', NULL, '2023-10-04 11:38:38', '2023-10-04 11:38:38', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(320, '1696419133', 30552.75, 303.50175459355, 30249.248245406, 60801.278132659, '921673621', 'ACTIVE', 'CLOSED', '2024-05-31', NULL, '2023-10-04 11:38:38', '2023-10-04 11:38:38', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(321, '1696419133', 30552.75, 202.67092710886, 30350.079072891, 30451.199059768, '921673621', 'ACTIVE', 'CLOSED', '2024-06-30', NULL, '2023-10-04 11:38:38', '2023-10-04 11:38:38', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(322, '1696419133', 30552.703056633, 101.50399686589, 30451.199059768, 0, '921673621', 'ACTIVE', 'CLOSED', '2024-07-30', NULL, '2023-10-04 11:38:38', '2023-10-04 11:38:38', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(323, '1696419133', 30552.75, 1000, 29552.75, 270447.25, '921673621', 'ACTIVE', 'CLOSED', '2023-11-03', NULL, '2023-10-04 11:38:45', '2023-10-04 11:38:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(324, '1696419133', 30552.75, 901.49083333333, 29651.259166667, 240795.99083333, '921673621', 'ACTIVE', 'CLOSED', '2023-12-03', NULL, '2023-10-04 11:38:45', '2023-10-04 11:38:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(325, '1696419133', 30552.75, 802.65330277778, 29750.096697222, 211045.89413611, '921673621', 'ACTIVE', 'CLOSED', '2024-01-02', NULL, '2023-10-04 11:38:45', '2023-10-04 11:38:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(326, '1696419133', 30552.75, 703.48631378704, 29849.263686213, 181196.6304499, '921673621', 'ACTIVE', 'CLOSED', '2024-02-01', NULL, '2023-10-04 11:38:45', '2023-10-04 11:38:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(327, '1696419133', 30552.75, 603.98876816633, 29948.761231834, 151247.86921806, '921673621', 'ACTIVE', 'CLOSED', '2024-03-02', NULL, '2023-10-04 11:38:45', '2023-10-04 11:38:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(328, '1696419133', 30552.75, 504.15956406021, 30048.59043594, 121199.27878212, '921673621', 'ACTIVE', 'CLOSED', '2024-04-01', NULL, '2023-10-04 11:38:45', '2023-10-04 11:38:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(329, '1696419133', 30552.75, 403.99759594042, 30148.75240406, 91050.526378065, '921673621', 'ACTIVE', 'CLOSED', '2024-05-01', NULL, '2023-10-04 11:38:45', '2023-10-04 11:38:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(330, '1696419133', 30552.75, 303.50175459355, 30249.248245406, 60801.278132659, '921673621', 'ACTIVE', 'CLOSED', '2024-05-31', NULL, '2023-10-04 11:38:45', '2023-10-04 11:38:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(331, '1696419133', 30552.75, 202.67092710886, 30350.079072891, 30451.199059768, '921673621', 'ACTIVE', 'CLOSED', '2024-06-30', NULL, '2023-10-04 11:38:45', '2023-10-04 11:38:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(332, '1696419133', 30552.703056633, 101.50399686589, 30451.199059768, 0, '921673621', 'ACTIVE', 'CLOSED', '2024-07-30', NULL, '2023-10-04 11:38:45', '2023-10-04 11:38:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(333, '1696419133', 30552.75, 1000, 29552.75, 270447.25, '921673621', 'ACTIVE', 'CLOSED', '2023-11-03', NULL, '2023-10-04 11:40:34', '2023-10-04 11:40:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(334, '1696419133', 30552.75, 901.49083333333, 29651.259166667, 240795.99083333, '921673621', 'ACTIVE', 'CLOSED', '2023-12-03', NULL, '2023-10-04 11:40:34', '2023-10-04 11:40:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(335, '1696419133', 30552.75, 802.65330277778, 29750.096697222, 211045.89413611, '921673621', 'ACTIVE', 'CLOSED', '2024-01-02', NULL, '2023-10-04 11:40:34', '2023-10-04 11:40:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(336, '1696419133', 30552.75, 703.48631378704, 29849.263686213, 181196.6304499, '921673621', 'ACTIVE', 'CLOSED', '2024-02-01', NULL, '2023-10-04 11:40:34', '2023-10-04 11:40:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(337, '1696419133', 30552.75, 603.98876816633, 29948.761231834, 151247.86921806, '921673621', 'ACTIVE', 'CLOSED', '2024-03-02', NULL, '2023-10-04 11:40:34', '2023-10-04 11:40:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(338, '1696419133', 30552.75, 504.15956406021, 30048.59043594, 121199.27878212, '921673621', 'ACTIVE', 'CLOSED', '2024-04-01', NULL, '2023-10-04 11:40:34', '2023-10-04 11:40:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(339, '1696419133', 30552.75, 403.99759594042, 30148.75240406, 91050.526378065, '921673621', 'ACTIVE', 'CLOSED', '2024-05-01', NULL, '2023-10-04 11:40:34', '2023-10-04 11:40:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(340, '1696419133', 30552.75, 303.50175459355, 30249.248245406, 60801.278132659, '921673621', 'ACTIVE', 'CLOSED', '2024-05-31', NULL, '2023-10-04 11:40:34', '2023-10-04 11:40:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(341, '1696419133', 30552.75, 202.67092710886, 30350.079072891, 30451.199059768, '921673621', 'ACTIVE', 'CLOSED', '2024-06-30', NULL, '2023-10-04 11:40:34', '2023-10-04 11:40:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(342, '1696419133', 30552.703056633, 101.50399686589, 30451.199059768, 0, '921673621', 'ACTIVE', 'CLOSED', '2024-07-30', NULL, '2023-10-04 11:40:34', '2023-10-04 11:40:34', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(343, '1696419133', 30552.75, 1000, 29552.75, 270447.25, '921673621', 'ACTIVE', 'CLOSED', '2023-11-03', NULL, '2023-10-04 11:47:53', '2023-10-04 11:47:53', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(344, '1696419133', 30552.75, 901.49083333333, 29651.259166667, 240795.99083333, '921673621', 'ACTIVE', 'CLOSED', '2023-12-03', NULL, '2023-10-04 11:47:53', '2023-10-04 11:47:53', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(345, '1696419133', 30552.75, 802.65330277778, 29750.096697222, 211045.89413611, '921673621', 'ACTIVE', 'CLOSED', '2024-01-02', NULL, '2023-10-04 11:47:53', '2023-10-04 11:47:53', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(346, '1696419133', 30552.75, 703.48631378704, 29849.263686213, 181196.6304499, '921673621', 'ACTIVE', 'CLOSED', '2024-02-01', NULL, '2023-10-04 11:47:53', '2023-10-04 11:47:53', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(347, '1696419133', 30552.75, 603.98876816633, 29948.761231834, 151247.86921806, '921673621', 'ACTIVE', 'CLOSED', '2024-03-02', NULL, '2023-10-04 11:47:53', '2023-10-04 11:47:53', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(348, '1696419133', 30552.75, 504.15956406021, 30048.59043594, 121199.27878212, '921673621', 'ACTIVE', 'CLOSED', '2024-04-01', NULL, '2023-10-04 11:47:53', '2023-10-04 11:47:53', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(349, '1696419133', 30552.75, 403.99759594042, 30148.75240406, 91050.526378065, '921673621', 'ACTIVE', 'CLOSED', '2024-05-01', NULL, '2023-10-04 11:47:53', '2023-10-04 11:47:53', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(350, '1696419133', 30552.75, 303.50175459355, 30249.248245406, 60801.278132659, '921673621', 'ACTIVE', 'CLOSED', '2024-05-31', NULL, '2023-10-04 11:47:53', '2023-10-04 11:47:53', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(351, '1696419133', 30552.75, 202.67092710886, 30350.079072891, 30451.199059768, '921673621', 'ACTIVE', 'CLOSED', '2024-06-30', NULL, '2023-10-04 11:47:53', '2023-10-04 11:47:53', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(352, '1696419133', 30552.703056633, 101.50399686589, 30451.199059768, 0, '921673621', 'ACTIVE', 'CLOSED', '2024-07-30', NULL, '2023-10-04 11:47:53', '2023-10-04 11:47:53', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(353, '1696419133', 30552.75, 1000, 29552.75, 270447.25, '921673621', 'ACTIVE', 'CLOSED', '2023-11-03', NULL, '2023-10-04 11:48:17', '2023-10-04 11:48:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(354, '1696419133', 30552.75, 901.49083333333, 29651.259166667, 240795.99083333, '921673621', 'ACTIVE', 'CLOSED', '2023-12-03', NULL, '2023-10-04 11:48:17', '2023-10-04 11:48:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(355, '1696419133', 30552.75, 802.65330277778, 29750.096697222, 211045.89413611, '921673621', 'ACTIVE', 'CLOSED', '2024-01-02', NULL, '2023-10-04 11:48:17', '2023-10-04 11:48:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(356, '1696419133', 30552.75, 703.48631378704, 29849.263686213, 181196.6304499, '921673621', 'ACTIVE', 'CLOSED', '2024-02-01', NULL, '2023-10-04 11:48:17', '2023-10-04 11:48:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(357, '1696419133', 30552.75, 603.98876816633, 29948.761231834, 151247.86921806, '921673621', 'ACTIVE', 'CLOSED', '2024-03-02', NULL, '2023-10-04 11:48:17', '2023-10-04 11:48:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(358, '1696419133', 30552.75, 504.15956406021, 30048.59043594, 121199.27878212, '921673621', 'ACTIVE', 'CLOSED', '2024-04-01', NULL, '2023-10-04 11:48:17', '2023-10-04 11:48:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(359, '1696419133', 30552.75, 403.99759594042, 30148.75240406, 91050.526378065, '921673621', 'ACTIVE', 'CLOSED', '2024-05-01', NULL, '2023-10-04 11:48:17', '2023-10-04 11:48:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(360, '1696419133', 30552.75, 303.50175459355, 30249.248245406, 60801.278132659, '921673621', 'ACTIVE', 'CLOSED', '2024-05-31', NULL, '2023-10-04 11:48:17', '2023-10-04 11:48:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(361, '1696419133', 30552.75, 202.67092710886, 30350.079072891, 30451.199059768, '921673621', 'ACTIVE', 'CLOSED', '2024-06-30', NULL, '2023-10-04 11:48:17', '2023-10-04 11:48:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(362, '1696419133', 30552.703056633, 101.50399686589, 30451.199059768, 0, '921673621', 'ACTIVE', 'CLOSED', '2024-07-30', NULL, '2023-10-04 11:48:17', '2023-10-04 11:48:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(363, '1696423712', 17372.19, 400, 16972.19, 103027.81, '081700001010', 'ACTIVE', 'CLOSED', '2023-11-03', NULL, '2023-10-04 12:59:19', '2023-11-06 12:50:20', NULL, NULL, NULL, NULL, '2023-11-08', 'ameomba siku 3, amesafiri kikazi. New promise, tarehe 8', 0, 0),
(364, '1696423712', 17372.19, 343.42603333333, 17028.763966667, 85999.046033333, '081700001010', 'ACTIVE', 'CLOSED', '2023-12-03', NULL, '2023-10-04 12:59:19', '2023-10-04 12:59:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(365, '1696423712', 17372.19, 286.66348677778, 17085.526513222, 68913.519520111, '081700001010', 'ACTIVE', 'CLOSED', '2024-01-02', NULL, '2023-10-04 12:59:19', '2023-10-04 12:59:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(366, '1696423712', 17372.19, 229.7117317337, 17142.478268266, 51771.041251845, '081700001010', 'ACTIVE', 'CLOSED', '2024-02-01', NULL, '2023-10-04 12:59:19', '2023-10-04 12:59:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(367, '1696423712', 17372.19, 172.57013750615, 17199.619862494, 34571.421389351, '081700001010', 'ACTIVE', 'CLOSED', '2024-03-02', NULL, '2023-10-04 12:59:19', '2023-10-04 12:59:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(368, '1696423712', 17372.19, 115.23807129784, 17256.951928702, 17314.469460649, '081700001010', 'ACTIVE', 'CLOSED', '2024-04-01', NULL, '2023-10-04 12:59:19', '2023-10-04 12:59:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(369, '1696423712', 17372.184358851, 57.714898202163, 17314.469460649, 0, '081700001010', 'ACTIVE', 'CLOSED', '2024-05-01', NULL, '2023-10-04 12:59:19', '2023-10-04 12:59:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(370, '1696423712', 17372.19, 400, 16972.19, 103027.81, '081700001010', 'ACTIVE', 'CLOSED', '2023-11-03', NULL, '2023-10-04 13:00:50', '2023-11-06 12:59:44', NULL, NULL, NULL, NULL, '2023-11-12', 'promises for the next week', 0, 0),
(371, '1696423712', 17372.19, 343.42603333333, 17028.763966667, 85999.046033333, '081700001010', 'ACTIVE', 'CLOSED', '2023-12-03', NULL, '2023-10-04 13:00:50', '2023-10-04 13:00:50', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(372, '1696423712', 17372.19, 286.66348677778, 17085.526513222, 68913.519520111, '081700001010', 'ACTIVE', 'CLOSED', '2024-01-02', NULL, '2023-10-04 13:00:50', '2023-10-04 13:00:50', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(373, '1696423712', 17372.19, 229.7117317337, 17142.478268266, 51771.041251845, '081700001010', 'ACTIVE', 'CLOSED', '2024-02-01', NULL, '2023-10-04 13:00:50', '2023-10-04 13:00:50', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(374, '1696423712', 17372.19, 172.57013750615, 17199.619862494, 34571.421389351, '081700001010', 'ACTIVE', 'CLOSED', '2024-03-02', NULL, '2023-10-04 13:00:50', '2023-10-04 13:00:50', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(375, '1696423712', 17372.19, 115.23807129784, 17256.951928702, 17314.469460649, '081700001010', 'ACTIVE', 'CLOSED', '2024-04-01', NULL, '2023-10-04 13:00:50', '2023-10-04 13:00:50', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(376, '1696423712', 17372.184358851, 57.714898202163, 17314.469460649, 0, '081700001010', 'ACTIVE', 'CLOSED', '2024-05-01', NULL, '2023-10-04 13:00:50', '2023-10-04 13:00:50', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(377, '1696522015', 202004.44, 3333.3333333333, 198671.10666667, 801328.89333333, '081700001025', 'ACTIVE', 'CLOSED', '2023-11-04', NULL, '2023-10-05 16:18:15', '2023-10-05 16:18:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(378, '1696522015', 202004.44, 2671.0963111111, 199333.34368889, 601995.54964444, '081700001025', 'ACTIVE', 'CLOSED', '2023-12-04', NULL, '2023-10-05 16:18:15', '2023-10-05 16:18:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(379, '1696522015', 202004.44, 2006.6518321481, 199997.78816785, 401997.76147659, '081700001025', 'ACTIVE', 'CLOSED', '2024-01-03', NULL, '2023-10-05 16:18:15', '2023-10-05 16:18:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(380, '1696522015', 202004.44, 1339.9925382553, 200664.44746174, 201333.31401485, '081700001025', 'ACTIVE', 'CLOSED', '2024-02-02', NULL, '2023-10-05 16:18:15', '2023-10-05 16:18:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(381, '1696522015', 202004.42506156, 671.11104671616, 201333.31401485, 0, '081700001025', 'ACTIVE', 'CLOSED', '2024-03-03', NULL, '2023-10-05 16:18:15', '2023-10-05 16:18:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(382, '1696843609', 15657.27, 411.33333333333, 15245.936666667, 108154.06333333, '081700001025', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 09:46:08', '2023-10-09 09:46:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(383, '1696843609', 15657.27, 360.51354444444, 15296.756455556, 92857.306877778, '081700001025', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 09:46:08', '2023-10-09 09:46:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(384, '1696843609', 15657.27, 309.52435625926, 15347.745643741, 77509.561234037, '081700001025', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 09:46:08', '2023-10-09 09:46:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(385, '1696843609', 15657.27, 258.36520411346, 15398.904795887, 62110.656438151, '081700001025', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 09:46:08', '2023-10-09 09:46:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(386, '1696843609', 15657.27, 207.0355214605, 15450.234478539, 46660.421959611, '081700001025', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 09:46:08', '2023-10-09 09:46:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(387, '1696843609', 15657.27, 155.53473986537, 15501.735260135, 31158.686699476, '081700001025', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 09:46:08', '2023-10-09 09:46:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(388, '1696843609', 15657.27, 103.86228899825, 15553.407711002, 15605.278988475, '081700001025', 'ACTIVE', 'CLOSED', '2024-05-06', NULL, '2023-10-09 09:46:08', '2023-10-09 09:46:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(389, '1696843609', 15657.296585103, 52.017596628249, 15605.278988475, 0, '081700001025', 'ACTIVE', 'CLOSED', '2024-06-05', NULL, '2023-10-09 09:46:08', '2023-10-09 09:46:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(390, '1696847741', 72842.33, 1440, 71402.33, 360597.67, '081700001025', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 10:42:33', '2023-10-09 10:42:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(391, '1696847741', 72842.33, 1201.9922333333, 71640.337766667, 288957.33223333, '081700001025', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 10:42:33', '2023-10-09 10:42:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(392, '1696847741', 72842.33, 963.19110744444, 71879.138892556, 217078.19334078, '081700001025', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 10:42:33', '2023-10-09 10:42:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(393, '1696847741', 72842.33, 723.59397780259, 72118.736022197, 144959.45731858, '081700001025', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 10:42:33', '2023-10-09 10:42:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(394, '1696847741', 72842.33, 483.19819106193, 72359.131808938, 72600.325509642, '081700001025', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 10:42:33', '2023-10-09 10:42:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(395, '1696847741', 72842.326594674, 242.00108503214, 72600.325509642, 0, '081700001025', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 10:42:33', '2023-10-09 10:42:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(396, '1696848599', 12690.77, 333.4, 12357.37, 87662.63, '081700001025', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 10:53:15', '2023-10-09 10:53:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(397, '1696848599', 12690.77, 292.20876666667, 12398.561233333, 75264.068766667, '081700001025', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 10:53:15', '2023-10-09 10:53:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(398, '1696848599', 12690.77, 250.88022922222, 12439.889770778, 62824.178995889, '081700001025', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 10:53:15', '2023-10-09 10:53:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(399, '1696848599', 12690.77, 209.4139299863, 12481.356070014, 50342.822925875, '081700001025', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 10:53:15', '2023-10-09 10:53:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(400, '1696848599', 12690.77, 167.80940975292, 12522.960590247, 37819.862335628, '081700001025', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 10:53:15', '2023-10-09 10:53:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(401, '1696848599', 12690.77, 126.06620778543, 12564.703792215, 25255.158543414, '081700001025', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 10:53:15', '2023-10-09 10:53:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(402, '1696848599', 12690.77, 84.183861811378, 12606.586138189, 12648.572405225, '081700001025', 'ACTIVE', 'CLOSED', '2024-05-06', NULL, '2023-10-09 10:53:15', '2023-10-09 10:53:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(403, '1696848599', 12690.734313242, 42.161908017416, 12648.572405225, 0, '081700001025', 'ACTIVE', 'CLOSED', '2024-06-05', NULL, '2023-10-09 10:53:15', '2023-10-09 10:53:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(404, '1696073440', 3878.18, 76.666666666667, 3801.5133333333, 19198.486666667, '081700001025', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 11:06:33', '2023-10-09 11:06:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(405, '1696073440', 3878.18, 63.994955555556, 3814.1850444444, 15384.301622222, '081700001025', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 11:06:33', '2023-10-09 11:06:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(406, '1696073440', 3878.18, 51.281005407407, 3826.8989945926, 11557.40262763, '081700001025', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 11:06:33', '2023-10-09 11:06:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(407, '1696073440', 3878.18, 38.524675425432, 3839.6553245746, 7717.7473030551, '081700001025', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 11:06:33', '2023-10-09 11:06:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(408, '1696073440', 3878.18, 25.725824343517, 3852.4541756565, 3865.2931273986, '081700001025', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 11:06:33', '2023-10-09 11:06:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(409, '1696073440', 3878.1774378232, 12.884310424662, 3865.2931273986, 0, '081700001025', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 11:06:33', '2023-10-09 11:06:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(410, '1696849827', 79622.53, 1833.3333333333, 77789.196666667, 472210.80333333, '081700001010', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 11:13:35', '2023-10-09 11:13:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(411, '1696849827', 79622.53, 1574.0360111111, 78048.493988889, 394162.30934444, '081700001010', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 11:13:35', '2023-10-09 11:13:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(412, '1696849827', 79622.53, 1313.8743644815, 78308.655635519, 315853.65370893, '081700001010', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 11:13:35', '2023-10-09 11:13:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(413, '1696849827', 79622.53, 1052.8455123631, 78569.684487637, 237283.96922129, '081700001010', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 11:13:35', '2023-10-09 11:13:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(414, '1696849827', 79622.53, 790.94656407096, 78831.583435929, 158452.38578536, '081700001010', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 11:13:35', '2023-10-09 11:13:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(415, '1696849827', 79622.53, 528.17461928453, 79094.355380715, 79358.030404645, '081700001010', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 11:13:35', '2023-10-09 11:13:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(416, '1696849827', 79622.55717266, 264.52676801548, 79358.030404645, 0, '081700001010', 'ACTIVE', 'CLOSED', '2024-05-06', NULL, '2023-10-09 11:13:35', '2023-10-09 11:13:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(417, '1696850305', 15664.38, 411.52, 15252.86, 108203.14, '081700001025', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 11:21:30', '2023-10-09 11:21:30', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(418, '1696850305', 15664.38, 360.67713333333, 15303.702866667, 92899.437133333, '081700001025', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 11:21:30', '2023-10-09 11:21:30', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(419, '1696850305', 15664.38, 309.66479044444, 15354.715209556, 77544.721923778, '081700001025', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 11:21:30', '2023-10-09 11:21:30', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(420, '1696850305', 15664.38, 258.48240641259, 15405.897593587, 62138.82433019, '081700001025', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 11:21:30', '2023-10-09 11:21:30', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(421, '1696850305', 15664.38, 207.12941443397, 15457.250585566, 46681.573744624, '081700001025', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 11:21:30', '2023-10-09 11:21:30', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(422, '1696850305', 15664.38, 155.60524581541, 15508.774754185, 31172.79899044, '081700001025', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 11:21:30', '2023-10-09 11:21:30', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(423, '1696850305', 15664.38, 103.90932996813, 15560.470670032, 15612.328320408, '081700001025', 'ACTIVE', 'CLOSED', '2024-05-06', NULL, '2023-10-09 11:21:30', '2023-10-09 11:21:30', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(424, '1696850305', 15664.369414809, 52.04109440136, 15612.328320408, 0, '081700001025', 'ACTIVE', 'CLOSED', '2024-06-05', NULL, '2023-10-09 11:21:30', '2023-10-09 11:21:30', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(425, '1696861240', 5075.29, 133.33333333333, 4941.9566666667, 35058.043333333, '081700001010', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 14:30:06', '2023-10-09 14:30:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(426, '1696861240', 5075.29, 116.86014444444, 4958.4298555556, 30099.613477778, '081700001010', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 14:30:06', '2023-10-09 14:30:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(427, '1696861240', 5075.29, 100.33204492593, 4974.9579550741, 25124.655522704, '081700001010', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 14:30:06', '2023-10-09 14:30:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(428, '1696861240', 5075.29, 83.748851742346, 4991.5411482577, 20133.114374446, '081700001010', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 14:30:06', '2023-10-09 14:30:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(429, '1696861240', 5075.29, 67.110381248154, 5008.1796187518, 15124.934755694, '081700001010', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 14:30:06', '2023-10-09 14:30:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(430, '1696861240', 5075.29, 50.416449185647, 5024.8735508144, 10100.06120488, '081700001010', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 14:30:06', '2023-10-09 14:30:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(431, '1696861240', 5075.29, 33.666870682933, 5041.6231293171, 5058.4380755628, '081700001010', 'ACTIVE', 'CLOSED', '2024-05-06', NULL, '2023-10-09 14:30:06', '2023-10-09 14:30:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(432, '1696861240', 5075.2995358147, 16.861460251876, 5058.4380755628, 0, '081700001010', 'ACTIVE', 'CLOSED', '2024-06-05', NULL, '2023-10-09 14:30:06', '2023-10-09 14:30:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(433, '1696862114', 7105.41, 186.66666666667, 6918.7433333333, 49081.256666667, '081700001010', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 15:06:00', '2023-10-09 15:06:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(434, '1696862114', 7105.41, 163.60418888889, 6941.8058111111, 42139.450855556, '081700001010', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 15:06:00', '2023-10-09 15:06:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(435, '1696862114', 7105.41, 140.46483618519, 6964.9451638148, 35174.505691741, '081700001010', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 15:06:00', '2023-10-09 15:06:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(436, '1696862114', 7105.41, 117.2483523058, 6988.1616476942, 28186.344044047, '081700001010', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 15:06:00', '2023-10-09 15:06:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(437, '1696862114', 7105.41, 93.954480146822, 7011.4555198532, 21174.888524193, '081700001010', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 15:06:00', '2023-10-09 15:06:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(438, '1696862114', 7105.41, 70.582961747311, 7034.8270382527, 14140.061485941, '081700001010', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 15:06:00', '2023-10-09 15:06:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(439, '1696862114', 7105.41, 47.133538286469, 7058.2764617135, 7081.7850242271, '081700001010', 'ACTIVE', 'CLOSED', '2024-05-06', NULL, '2023-10-09 15:06:00', '2023-10-09 15:06:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(440, '1696862114', 7105.3909743079, 23.605950080757, 7081.7850242271, 0, '081700001010', 'ACTIVE', 'CLOSED', '2024-06-05', NULL, '2023-10-09 15:06:00', '2023-10-09 15:06:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(441, '1696865436', 11128.69, 220, 10908.69, 55091.31, '081700001020', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 15:38:32', '2023-10-09 15:38:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(442, '1696865436', 11128.69, 183.6377, 10945.0523, 44146.2577, '081700001020', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 15:38:32', '2023-10-09 15:38:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(443, '1696865436', 11128.69, 147.15419233333, 10981.535807667, 33164.721892333, '081700001020', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 15:38:32', '2023-10-09 15:38:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(444, '1696865436', 11128.69, 110.54907297444, 11018.140927026, 22146.580965308, '081700001020', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 15:38:32', '2023-10-09 15:38:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(445, '1696865436', 11128.69, 73.821936551026, 11054.868063449, 11091.712901859, '081700001020', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 15:38:32', '2023-10-09 15:38:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(446, '1696865436', 11128.685278198, 36.972376339529, 11091.712901859, 0, '081700001020', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 15:38:32', '2023-10-09 15:38:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(447, '1696866487', 5083.7, 150, 4933.7, 40066.3, '081700001020', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 15:54:55', '2023-10-09 15:54:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(448, '1696866487', 5083.7, 133.55433333333, 4950.1456666667, 35116.154333333, '081700001020', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 15:54:55', '2023-10-09 15:54:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(449, '1696866487', 5083.7, 117.05384777778, 4966.6461522222, 30149.508181111, '081700001020', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 15:54:55', '2023-10-09 15:54:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(450, '1696866487', 5083.7, 100.4983606037, 4983.2016393963, 25166.306541715, '081700001020', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 15:54:55', '2023-10-09 15:54:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(451, '1696866487', 5083.7, 83.887688472383, 4999.8123115276, 20166.494230187, '081700001020', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 15:54:55', '2023-10-09 15:54:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(452, '1696866487', 5083.7, 67.221647433957, 5016.478352566, 15150.015877621, '081700001020', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 15:54:55', '2023-10-09 15:54:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(453, '1696866487', 5083.7, 50.500052925404, 5033.1999470746, 10116.815930547, '081700001020', 'ACTIVE', 'CLOSED', '2024-05-06', NULL, '2023-10-09 15:54:55', '2023-10-09 15:54:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(454, '1696866487', 5083.7, 33.722719768489, 5049.9772802315, 5066.8386503151, '081700001020', 'ACTIVE', 'CLOSED', '2024-06-05', NULL, '2023-10-09 15:54:55', '2023-10-09 15:54:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(455, '1696866487', 5083.7281124828, 16.889462167717, 5066.8386503151, 0, '081700001020', 'ACTIVE', 'CLOSED', '2024-07-05', NULL, '2023-10-09 15:54:55', '2023-10-09 15:54:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(456, '1696866487', 5083.7, 150, 4933.7, 40066.3, '081700001020', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 15:55:52', '2023-10-09 15:55:52', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(457, '1696866487', 5083.7, 133.55433333333, 4950.1456666667, 35116.154333333, '081700001020', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 15:55:52', '2023-10-09 15:55:52', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(458, '1696866487', 5083.7, 117.05384777778, 4966.6461522222, 30149.508181111, '081700001020', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 15:55:52', '2023-10-09 15:55:52', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(459, '1696866487', 5083.7, 100.4983606037, 4983.2016393963, 25166.306541715, '081700001020', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 15:55:52', '2023-10-09 15:55:52', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(460, '1696866487', 5083.7, 83.887688472383, 4999.8123115276, 20166.494230187, '081700001020', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 15:55:52', '2023-10-09 15:55:52', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(461, '1696866487', 5083.7, 67.221647433957, 5016.478352566, 15150.015877621, '081700001020', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 15:55:52', '2023-10-09 15:55:52', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(462, '1696866487', 5083.7, 50.500052925404, 5033.1999470746, 10116.815930547, '081700001020', 'ACTIVE', 'CLOSED', '2024-05-06', NULL, '2023-10-09 15:55:52', '2023-10-09 15:55:52', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);
INSERT INTO `loans_schedules` (`id`, `loan_id`, `installment`, `interest`, `principle`, `balance`, `bank_account_number`, `completion_status`, `account_status`, `installment_date`, `next_check_date`, `created_at`, `updated_at`, `penalties`, `days_in_arrears`, `amount_in_arrears`, `payment`, `promise_date`, `comment`, `opening_balance`, `closing_balance`) VALUES
(463, '1696866487', 5083.7, 33.722719768489, 5049.9772802315, 5066.8386503151, '081700001020', 'ACTIVE', 'CLOSED', '2024-06-05', NULL, '2023-10-09 15:55:52', '2023-10-09 15:55:52', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(464, '1696866487', 5083.7281124828, 16.889462167717, 5066.8386503151, 0, '081700001020', 'ACTIVE', 'CLOSED', '2024-07-05', NULL, '2023-10-09 15:55:52', '2023-10-09 15:55:52', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(465, '1696867186', 4777.35, 110, 4667.35, 28332.65, '081700001020', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 16:05:00', '2023-10-09 16:05:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(466, '1696867186', 4777.35, 94.442166666667, 4682.9078333333, 23649.742166667, '081700001020', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 16:05:00', '2023-10-09 16:05:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(467, '1696867186', 4777.35, 78.832473888889, 4698.5175261111, 18951.224640556, '081700001020', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 16:05:00', '2023-10-09 16:05:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(468, '1696867186', 4777.35, 63.170748801852, 4714.1792511981, 14237.045389357, '081700001020', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 16:05:00', '2023-10-09 16:05:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(469, '1696867186', 4777.35, 47.456817964525, 4729.8931820355, 9507.1522073219, '081700001020', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 16:05:00', '2023-10-09 16:05:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(470, '1696867186', 4777.35, 31.69050735774, 4745.6594926423, 4761.4927146797, '081700001020', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 16:05:00', '2023-10-09 16:05:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(471, '1696867186', 4777.3643570619, 15.871642382266, 4761.4927146797, 0, '081700001020', 'ACTIVE', 'CLOSED', '2024-05-06', NULL, '2023-10-09 16:05:00', '2023-10-09 16:05:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(472, '1696868181', 9389.29, 246.66666666667, 9142.6233333333, 64857.376666667, '081700001020', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 16:23:39', '2023-10-09 16:23:39', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(473, '1696868181', 9389.29, 216.19125555556, 9173.0987444444, 55684.277922222, '081700001020', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 16:23:39', '2023-10-09 16:23:39', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(474, '1696868181', 9389.29, 185.61425974074, 9203.6757402593, 46480.602181963, '081700001020', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 16:23:39', '2023-10-09 16:23:39', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(475, '1696868181', 9389.29, 154.93534060654, 9234.3546593935, 37246.247522569, '081700001020', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 16:23:39', '2023-10-09 16:23:39', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(476, '1696868181', 9389.29, 124.15415840856, 9265.1358415914, 27981.111680978, '081700001020', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 16:23:39', '2023-10-09 16:23:39', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(477, '1696868181', 9389.29, 93.270372269927, 9296.0196277301, 18685.092053248, '081700001020', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 16:23:39', '2023-10-09 16:23:39', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(478, '1696868181', 9389.29, 62.283640177493, 9327.0063598225, 9358.0856934255, '081700001020', 'ACTIVE', 'CLOSED', '2024-05-06', NULL, '2023-10-09 16:23:39', '2023-10-09 16:23:39', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(479, '1696868181', 9389.2793124036, 31.193618978085, 9358.0856934255, 0, '081700001020', 'ACTIVE', 'CLOSED', '2024-06-05', NULL, '2023-10-09 16:23:39', '2023-10-09 16:23:39', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(480, '1696003014', 40400.89, 666.66666666667, 39734.223333333, 160265.77666667, NULL, 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 16:26:16', '2023-10-09 16:26:16', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(481, '1696003014', 40400.89, 534.21925555556, 39866.670744444, 120399.10592222, NULL, 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 16:26:16', '2023-10-09 16:26:16', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(482, '1696003014', 40400.89, 401.33035307407, 39999.559646926, 80399.546275296, NULL, 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 16:26:16', '2023-10-09 16:26:16', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(483, '1696003014', 40400.89, 267.99848758432, 40132.891512416, 40266.654762881, NULL, 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 16:26:16', '2023-10-09 16:26:16', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(484, '1696003014', 40400.876945424, 134.22218254294, 40266.654762881, 0, NULL, 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 16:26:16', '2023-10-09 16:26:16', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(485, '1696869910', 1592.45, 36.666666666667, 1555.7833333333, 9444.2166666667, '081700001020', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 16:48:32', '2023-10-09 16:48:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(486, '1696869910', 1592.45, 31.480722222222, 1560.9692777778, 7883.2473888889, '081700001020', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 16:48:32', '2023-10-09 16:48:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(487, '1696869910', 1592.45, 26.277491296296, 1566.1725087037, 6317.0748801852, '081700001020', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 16:48:32', '2023-10-09 16:48:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(488, '1696869910', 1592.45, 21.056916267284, 1571.3930837327, 4745.6817964525, '081700001020', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 16:48:32', '2023-10-09 16:48:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(489, '1696869910', 1592.45, 15.818939321508, 1576.6310606785, 3169.050735774, '081700001020', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 16:48:32', '2023-10-09 16:48:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(490, '1696869910', 1592.45, 10.56350245258, 1581.8864975474, 1587.1642382266, '081700001020', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 16:48:32', '2023-10-09 16:48:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(491, '1696869910', 1592.4547856873, 5.2905474607552, 1587.1642382266, 0, '081700001020', 'ACTIVE', 'CLOSED', '2024-05-06', NULL, '2023-10-09 16:48:32', '2023-10-09 16:48:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(492, '1696869910', 1592.45, 36.666666666667, 1555.7833333333, 9444.2166666667, '081700001020', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 16:49:26', '2023-10-09 16:49:26', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(493, '1696869910', 1592.45, 31.480722222222, 1560.9692777778, 7883.2473888889, '081700001020', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 16:49:26', '2023-10-09 16:49:26', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(494, '1696869910', 1592.45, 26.277491296296, 1566.1725087037, 6317.0748801852, '081700001020', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 16:49:26', '2023-10-09 16:49:26', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(495, '1696869910', 1592.45, 21.056916267284, 1571.3930837327, 4745.6817964525, '081700001020', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 16:49:26', '2023-10-09 16:49:26', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(496, '1696869910', 1592.45, 15.818939321508, 1576.6310606785, 3169.050735774, '081700001020', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 16:49:26', '2023-10-09 16:49:26', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(497, '1696869910', 1592.45, 10.56350245258, 1581.8864975474, 1587.1642382266, '081700001020', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 16:49:26', '2023-10-09 16:49:26', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(498, '1696869910', 1592.4547856873, 5.2905474607552, 1587.1642382266, 0, '081700001020', 'ACTIVE', 'CLOSED', '2024-05-06', NULL, '2023-10-09 16:49:26', '2023-10-09 16:49:26', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(499, '1696869910', 1592.45, 36.666666666667, 1555.7833333333, 9444.2166666667, '081700001020', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 17:09:09', '2023-10-09 17:09:09', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(500, '1696869910', 1592.45, 31.480722222222, 1560.9692777778, 7883.2473888889, '081700001020', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 17:09:09', '2023-10-09 17:09:09', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(501, '1696869910', 1592.45, 26.277491296296, 1566.1725087037, 6317.0748801852, '081700001020', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 17:09:09', '2023-10-09 17:09:09', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(502, '1696869910', 1592.45, 21.056916267284, 1571.3930837327, 4745.6817964525, '081700001020', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 17:09:09', '2023-10-09 17:09:09', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(503, '1696869910', 1592.45, 15.818939321508, 1576.6310606785, 3169.050735774, '081700001020', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 17:09:09', '2023-10-09 17:09:09', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(504, '1696869910', 1592.45, 10.56350245258, 1581.8864975474, 1587.1642382266, '081700001020', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 17:09:09', '2023-10-09 17:09:09', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(505, '1696869910', 1592.4547856873, 5.2905474607552, 1587.1642382266, 0, '081700001020', 'ACTIVE', 'CLOSED', '2024-05-06', NULL, '2023-10-09 17:09:09', '2023-10-09 17:09:09', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(506, '1696872712', 2791.41, 73.333333333333, 2718.0766666667, 19281.923333333, '081700001020', 'ACTIVE', 'CLOSED', '2023-11-08', NULL, '2023-10-09 17:37:35', '2023-10-09 17:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(507, '1696872712', 2791.41, 64.273077777778, 2727.1369222222, 16554.786411111, '081700001020', 'ACTIVE', 'CLOSED', '2023-12-08', NULL, '2023-10-09 17:37:35', '2023-10-09 17:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(508, '1696872712', 2791.41, 55.18262137037, 2736.2273786296, 13818.559032481, '081700001020', 'ACTIVE', 'CLOSED', '2024-01-07', NULL, '2023-10-09 17:37:35', '2023-10-09 17:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(509, '1696872712', 2791.41, 46.061863441605, 2745.3481365584, 11073.210895923, '081700001020', 'ACTIVE', 'CLOSED', '2024-02-06', NULL, '2023-10-09 17:37:35', '2023-10-09 17:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(510, '1696872712', 2791.41, 36.91070298641, 2754.4992970136, 8318.7115989095, '081700001020', 'ACTIVE', 'CLOSED', '2024-03-07', NULL, '2023-10-09 17:37:35', '2023-10-09 17:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(511, '1696872712', 2791.41, 27.729038663032, 2763.680961337, 5555.0306375725, '081700001020', 'ACTIVE', 'CLOSED', '2024-04-06', NULL, '2023-10-09 17:37:35', '2023-10-09 17:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(512, '1696872712', 2791.41, 18.516768791908, 2772.8932312081, 2782.1374063644, '081700001020', 'ACTIVE', 'CLOSED', '2024-05-06', NULL, '2023-10-09 17:37:35', '2023-10-09 17:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(513, '1696872712', 2791.411197719, 9.2737913545481, 2782.1374063644, 0, '081700001020', 'ACTIVE', 'CLOSED', '2024-06-05', NULL, '2023-10-09 17:37:35', '2023-10-09 17:37:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(514, '1696920301', 2664.53, 70, 2594.53, 18405.47, '081700001020', 'ACTIVE', 'CLOSED', '2023-11-09', NULL, '2023-10-10 06:49:22', '2023-10-10 06:49:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(515, '1696920301', 2664.53, 61.351566666667, 2603.1784333333, 15802.291566667, '081700001020', 'ACTIVE', 'CLOSED', '2023-12-09', NULL, '2023-10-10 06:49:22', '2023-10-10 06:49:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(516, '1696920301', 2664.53, 52.674305222222, 2611.8556947778, 13190.435871889, '081700001020', 'ACTIVE', 'CLOSED', '2024-01-08', NULL, '2023-10-10 06:49:22', '2023-10-10 06:49:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(517, '1696920301', 2664.53, 43.968119572963, 2620.561880427, 10569.873991462, '081700001020', 'ACTIVE', 'CLOSED', '2024-02-07', NULL, '2023-10-10 06:49:22', '2023-10-10 06:49:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(518, '1696920301', 2664.53, 35.232913304873, 2629.2970866951, 7940.5769047667, '081700001020', 'ACTIVE', 'CLOSED', '2024-03-08', NULL, '2023-10-10 06:49:22', '2023-10-10 06:49:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(519, '1696920301', 2664.53, 26.468589682556, 2638.0614103174, 5302.5154944493, '081700001020', 'ACTIVE', 'CLOSED', '2024-04-07', NULL, '2023-10-10 06:49:22', '2023-10-10 06:49:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(520, '1696920301', 2664.53, 17.675051648164, 2646.8549483518, 2655.6605460974, '081700001020', 'ACTIVE', 'CLOSED', '2024-05-07', NULL, '2023-10-10 06:49:22', '2023-10-10 06:49:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(521, '1696920301', 2664.5127479178, 8.8522018203248, 2655.6605460974, 0, '081700001020', 'ACTIVE', 'CLOSED', '2024-06-06', NULL, '2023-10-10 06:49:22', '2023-10-10 06:49:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(522, '1696921461', 16693.03, 330, 16363.03, 82636.97, '081700001020', 'ACTIVE', 'CLOSED', '2023-11-09', NULL, '2023-10-10 07:12:23', '2023-10-10 07:12:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(523, '1696921461', 16693.03, 275.45656666667, 16417.573433333, 66219.396566667, '081700001020', 'ACTIVE', 'CLOSED', '2023-12-09', NULL, '2023-10-10 07:12:23', '2023-10-10 07:12:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(524, '1696921461', 16693.03, 220.73132188889, 16472.298678111, 49747.097888556, '081700001020', 'ACTIVE', 'CLOSED', '2024-01-08', NULL, '2023-10-10 07:12:23', '2023-10-10 07:12:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(525, '1696921461', 16693.03, 165.82365962852, 16527.206340371, 33219.891548184, '081700001020', 'ACTIVE', 'CLOSED', '2024-02-07', NULL, '2023-10-10 07:12:23', '2023-10-10 07:12:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(526, '1696921461', 16693.03, 110.73297182728, 16582.297028173, 16637.594520011, '081700001020', 'ACTIVE', 'CLOSED', '2024-03-08', NULL, '2023-10-10 07:12:23', '2023-10-10 07:12:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(527, '1696921461', 16693.053168411, 55.458648400038, 16637.594520011, 0, '081700001020', 'ACTIVE', 'CLOSED', '2024-04-07', NULL, '2023-10-10 07:12:23', '2023-10-10 07:12:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(528, '1696936565', 29864.66, 296.66666666667, 29567.993333333, 59432.006666667, '081700001025', 'ACTIVE', 'CLOSED', '2023-11-09', NULL, '2023-10-10 13:54:45', '2023-10-10 13:54:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(529, '1696936565', 29864.66, 198.10668888889, 29666.553311111, 29765.453355556, '081700001025', 'ACTIVE', 'CLOSED', '2023-12-09', NULL, '2023-10-10 13:54:45', '2023-10-10 13:54:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(530, '1696936565', 29864.671533407, 99.218177851852, 29765.453355556, 0, '081700001025', 'ACTIVE', 'CLOSED', '2024-01-08', NULL, '2023-10-10 13:54:45', '2023-10-10 13:54:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(531, '1696936565', 29864.66, 296.66666666667, 29567.993333333, 59432.006666667, '081700001025', 'ACTIVE', 'CLOSED', '2023-11-09', NULL, '2023-10-10 13:57:13', '2023-10-10 13:57:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(532, '1696936565', 29864.66, 198.10668888889, 29666.553311111, 29765.453355556, '081700001025', 'ACTIVE', 'CLOSED', '2023-12-09', NULL, '2023-10-10 13:57:13', '2023-10-10 13:57:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(533, '1696936565', 29864.671533407, 99.218177851852, 29765.453355556, 0, '081700001025', 'ACTIVE', 'CLOSED', '2024-01-08', NULL, '2023-10-10 13:57:13', '2023-10-10 13:57:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(534, '1696931776', 13864.77, 183.33333333333, 13681.436666667, 41318.563333333, '081700001010', 'ACTIVE', 'CLOSED', '2023-11-09', NULL, '2023-10-10 14:03:49', '2023-10-10 14:03:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(535, '1696931776', 13864.77, 137.72854444444, 13727.041455556, 27591.521877778, '081700001010', 'ACTIVE', 'CLOSED', '2023-12-09', NULL, '2023-10-10 14:03:49', '2023-10-10 14:03:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(536, '1696931776', 13864.77, 91.971739592593, 13772.798260407, 13818.72361737, '081700001010', 'ACTIVE', 'CLOSED', '2024-01-08', NULL, '2023-10-10 14:03:49', '2023-10-10 14:03:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(537, '1696931776', 13864.786029428, 46.062412057901, 13818.72361737, 0, '081700001010', 'ACTIVE', 'CLOSED', '2024-02-07', NULL, '2023-10-10 14:03:49', '2023-10-10 14:03:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(538, '1697036559', 5901.58, 116.66666666667, 5784.9133333333, 29215.086666667, '081700001025', 'ACTIVE', 'CLOSED', '2023-11-10', NULL, '2023-10-11 15:08:20', '2023-10-11 15:08:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(539, '1697036559', 5901.58, 97.383622222222, 5804.1963777778, 23410.890288889, '081700001025', 'ACTIVE', 'CLOSED', '2023-12-10', NULL, '2023-10-11 15:08:20', '2023-10-11 15:08:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(540, '1697036559', 5901.58, 78.036300962963, 5823.543699037, 17587.346589852, '081700001025', 'ACTIVE', 'CLOSED', '2024-01-09', NULL, '2023-10-11 15:08:20', '2023-10-11 15:08:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(541, '1697036559', 5901.58, 58.62448863284, 5842.9555113672, 11744.391078485, '081700001025', 'ACTIVE', 'CLOSED', '2024-02-08', NULL, '2023-10-11 15:08:20', '2023-10-11 15:08:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(542, '1697036559', 5901.58, 39.147970261616, 5862.4320297384, 5881.9590487463, '081700001025', 'ACTIVE', 'CLOSED', '2024-03-09', NULL, '2023-10-11 15:08:20', '2023-10-11 15:08:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(543, '1697036559', 5901.5655789088, 19.606530162488, 5881.9590487463, 0, '081700001025', 'ACTIVE', 'CLOSED', '2024-04-08', NULL, '2023-10-11 15:08:20', '2023-10-11 15:08:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(544, '1697120184', 9696.21, 160, 9536.21, 38463.79, '081700001010', 'ACTIVE', 'CLOSED', '2023-11-11', NULL, '2023-10-12 14:48:23', '2023-10-12 14:48:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(545, '1697120184', 9696.21, 128.21263333333, 9567.9973666667, 28895.792633333, '081700001010', 'ACTIVE', 'CLOSED', '2023-12-11', NULL, '2023-10-12 14:48:23', '2023-10-12 14:48:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(546, '1697120184', 9696.21, 96.319308777778, 9599.8906912222, 19295.901942111, '081700001010', 'ACTIVE', 'CLOSED', '2024-01-10', NULL, '2023-10-12 14:48:23', '2023-10-12 14:48:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(547, '1697120184', 9696.21, 64.31967314037, 9631.8903268596, 9664.0116152515, '081700001010', 'ACTIVE', 'CLOSED', '2024-02-09', NULL, '2023-10-12 14:48:23', '2023-10-12 14:48:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(548, '1697120184', 9696.2249873023, 32.213372050838, 9664.0116152515, 0, '081700001010', 'ACTIVE', 'CLOSED', '2024-03-10', NULL, '2023-10-12 14:48:23', '2023-10-12 14:48:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(549, '1697175309', 20066.666666667, 66.666666666667, 20000, 0, '081700001010', 'ACTIVE', 'CLOSED', '2023-11-12', NULL, '2023-10-13 06:24:55', '2023-10-13 06:24:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(550, '1697175654', 3010, 10, 3000, 0, '081700001025', 'ACTIVE', 'CLOSED', '2023-11-12', NULL, '2023-10-13 06:24:57', '2023-10-13 06:24:57', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(551, '1697175741', 255.45, 10, 245.45, 2754.55, '081700001010', 'ACTIVE', 'CLOSED', '2023-11-12', NULL, '2023-10-13 06:27:06', '2023-10-13 06:27:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(552, '1697175741', 255.45, 9.1818333333333, 246.26816666667, 2508.2818333333, '081700001010', 'ACTIVE', 'CLOSED', '2023-12-12', NULL, '2023-10-13 06:27:06', '2023-10-13 06:27:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(553, '1697175741', 255.45, 8.3609394444444, 247.08906055556, 2261.1927727778, '081700001010', 'ACTIVE', 'CLOSED', '2024-01-11', NULL, '2023-10-13 06:27:06', '2023-10-13 06:27:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(554, '1697175741', 255.45, 7.5373092425926, 247.91269075741, 2013.2800820204, '081700001010', 'ACTIVE', 'CLOSED', '2024-02-10', NULL, '2023-10-13 06:27:06', '2023-10-13 06:27:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(555, '1697175741', 255.45, 6.7109336067346, 248.73906639327, 1764.5410156271, '081700001010', 'ACTIVE', 'CLOSED', '2024-03-11', NULL, '2023-10-13 06:27:06', '2023-10-13 06:27:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(556, '1697175741', 255.45, 5.8818033854237, 249.56819661458, 1514.9728190125, '081700001010', 'ACTIVE', 'CLOSED', '2024-04-10', NULL, '2023-10-13 06:27:06', '2023-10-13 06:27:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(557, '1697175741', 255.45, 5.0499093967084, 250.40009060329, 1264.5727284092, '081700001010', 'ACTIVE', 'CLOSED', '2024-05-10', NULL, '2023-10-13 06:27:06', '2023-10-13 06:27:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(558, '1697175741', 255.45, 4.2152424280308, 251.23475757197, 1013.3379708373, '081700001010', 'ACTIVE', 'CLOSED', '2024-06-09', NULL, '2023-10-13 06:27:06', '2023-10-13 06:27:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(559, '1697175741', 255.45, 3.3777932361242, 252.07220676388, 761.26576407339, '081700001010', 'ACTIVE', 'CLOSED', '2024-07-09', NULL, '2023-10-13 06:27:06', '2023-10-13 06:27:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(560, '1697175741', 255.45, 2.5375525469113, 252.91244745309, 508.3533166203, '081700001010', 'ACTIVE', 'CLOSED', '2024-08-08', NULL, '2023-10-13 06:27:06', '2023-10-13 06:27:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(561, '1697175741', 255.45, 1.694511055401, 253.7554889446, 254.5978276757, '081700001010', 'ACTIVE', 'CLOSED', '2024-09-07', NULL, '2023-10-13 06:27:06', '2023-10-13 06:27:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(562, '1697175741', 255.44648710129, 0.84865942558568, 254.5978276757, 0, '081700001010', 'ACTIVE', 'CLOSED', '2024-10-07', NULL, '2023-10-13 06:27:06', '2023-10-13 06:27:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(563, '1697177382', 2554.5, 100, 2454.5, 27545.5, '081700001010', 'ACTIVE', 'CLOSED', '2023-11-12', NULL, '2023-10-13 06:27:58', '2023-10-13 06:27:58', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(564, '1697177382', 2554.5, 91.818333333333, 2462.6816666667, 25082.818333333, '081700001010', 'ACTIVE', 'CLOSED', '2023-12-12', NULL, '2023-10-13 06:27:58', '2023-10-13 06:27:58', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(565, '1697177382', 2554.5, 83.609394444444, 2470.8906055556, 22611.927727778, '081700001010', 'ACTIVE', 'CLOSED', '2024-01-11', NULL, '2023-10-13 06:27:58', '2023-10-13 06:27:58', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(566, '1697177382', 2554.5, 75.373092425926, 2479.1269075741, 20132.800820204, '081700001010', 'ACTIVE', 'CLOSED', '2024-02-10', NULL, '2023-10-13 06:27:58', '2023-10-13 06:27:58', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(567, '1697177382', 2554.5, 67.109336067346, 2487.3906639327, 17645.410156271, '081700001010', 'ACTIVE', 'CLOSED', '2024-03-11', NULL, '2023-10-13 06:27:58', '2023-10-13 06:27:58', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(568, '1697177382', 2554.5, 58.818033854237, 2495.6819661458, 15149.728190125, '081700001010', 'ACTIVE', 'CLOSED', '2024-04-10', NULL, '2023-10-13 06:27:58', '2023-10-13 06:27:58', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(569, '1697177382', 2554.5, 50.499093967084, 2504.0009060329, 12645.727284092, '081700001010', 'ACTIVE', 'CLOSED', '2024-05-10', NULL, '2023-10-13 06:27:58', '2023-10-13 06:27:58', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(570, '1697177382', 2554.5, 42.152424280308, 2512.3475757197, 10133.379708373, '081700001010', 'ACTIVE', 'CLOSED', '2024-06-09', NULL, '2023-10-13 06:27:58', '2023-10-13 06:27:58', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(571, '1697177382', 2554.5, 33.777932361242, 2520.7220676388, 7612.6576407339, '081700001010', 'ACTIVE', 'CLOSED', '2024-07-09', NULL, '2023-10-13 06:27:58', '2023-10-13 06:27:58', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(572, '1697177382', 2554.5, 25.375525469113, 2529.1244745309, 5083.533166203, '081700001010', 'ACTIVE', 'CLOSED', '2024-08-08', NULL, '2023-10-13 06:27:58', '2023-10-13 06:27:58', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(573, '1697177382', 2554.5, 16.94511055401, 2537.554889446, 2545.978276757, '081700001010', 'ACTIVE', 'CLOSED', '2024-09-07', NULL, '2023-10-13 06:27:58', '2023-10-13 06:27:58', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(574, '1697177382', 2554.4648710129, 8.4865942558568, 2545.978276757, 0, '081700001010', 'ACTIVE', 'CLOSED', '2024-10-07', NULL, '2023-10-13 06:27:58', '2023-10-13 06:27:58', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(575, '1697387241', 17029.98, 666.66666666667, 16363.313333333, 183636.68666667, '081700001025', 'ACTIVE', 'CLOSED', '2023-11-14', NULL, '2023-10-15 16:31:42', '2023-10-15 16:31:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(576, '1697387241', 17029.98, 612.12228888889, 16417.857711111, 167218.82895556, '081700001025', 'ACTIVE', 'CLOSED', '2023-12-14', NULL, '2023-10-15 16:31:42', '2023-10-15 16:31:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(577, '1697387241', 17029.98, 557.39609651852, 16472.583903481, 150746.24505207, '081700001025', 'ACTIVE', 'CLOSED', '2024-01-13', NULL, '2023-10-15 16:31:42', '2023-10-15 16:31:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(578, '1697387241', 17029.98, 502.48748350691, 16527.492516493, 134218.75253558, '081700001025', 'ACTIVE', 'CLOSED', '2024-02-12', NULL, '2023-10-15 16:31:42', '2023-10-15 16:31:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(579, '1697387241', 17029.98, 447.39584178527, 16582.584158215, 117636.16837737, '081700001025', 'ACTIVE', 'CLOSED', '2024-03-13', NULL, '2023-10-15 16:31:42', '2023-10-15 16:31:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(580, '1697387241', 17029.98, 392.12056125789, 16637.859438742, 100998.30893862, '081700001025', 'ACTIVE', 'CLOSED', '2024-04-12', NULL, '2023-10-15 16:31:42', '2023-10-15 16:31:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(581, '1697387241', 17029.98, 336.66102979541, 16693.318970205, 84304.98996842, '081700001025', 'ACTIVE', 'CLOSED', '2024-05-12', NULL, '2023-10-15 16:31:42', '2023-10-15 16:31:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(582, '1697387241', 17029.98, 281.01663322807, 16748.963366772, 67556.026601648, '081700001025', 'ACTIVE', 'CLOSED', '2024-06-11', NULL, '2023-10-15 16:31:42', '2023-10-15 16:31:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(583, '1697387241', 17029.98, 225.18675533883, 16804.793244661, 50751.233356986, '081700001025', 'ACTIVE', 'CLOSED', '2024-07-11', NULL, '2023-10-15 16:31:42', '2023-10-15 16:31:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(584, '1697387241', 17029.98, 169.17077785662, 16860.809222143, 33890.424134843, '081700001025', 'ACTIVE', 'CLOSED', '2024-08-10', NULL, '2023-10-15 16:31:42', '2023-10-15 16:31:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(585, '1697387241', 17029.98, 112.96808044948, 16917.011919551, 16973.412215293, '081700001025', 'ACTIVE', 'CLOSED', '2024-09-09', NULL, '2023-10-15 16:31:42', '2023-10-15 16:31:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(586, '1697387241', 17029.99025601, 56.578040717642, 16973.412215293, 0, '081700001025', 'ACTIVE', 'CLOSED', '2024-10-09', NULL, '2023-10-15 16:31:42', '2023-10-15 16:31:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(587, '1697205677', 6851.64, 180, 6671.64, 47328.36, '081700001010', 'CLOSED', 'CLOSED', '2023-11-18', NULL, '2023-10-19 07:55:06', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(588, '1697205677', 6851.64, 157.7612, 6693.8788, 40634.4812, '081700001010', 'CLOSED', 'CLOSED', '2023-12-18', NULL, '2023-10-19 07:55:06', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(589, '1697205677', 6851.64, 135.44827066667, 6716.1917293333, 33918.289470667, '081700001010', 'CLOSED', 'CLOSED', '2024-01-17', NULL, '2023-10-19 07:55:06', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(590, '1697205677', 6851.64, 113.06096490222, 6738.5790350978, 27179.710435569, '081700001010', 'CLOSED', 'CLOSED', '2024-02-16', NULL, '2023-10-19 07:55:06', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(591, '1697205677', 6851.64, 90.59903478523, 6761.0409652148, 20418.669470354, '081700001010', 'CLOSED', 'CLOSED', '2024-03-17', NULL, '2023-10-19 07:55:06', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(592, '1697205677', 6851.64, 68.062231567847, 6783.5777684322, 13635.091701922, '081700001010', 'CLOSED', 'CLOSED', '2024-04-16', NULL, '2023-10-19 07:55:06', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(593, '1697205677', 6851.64, 45.450305673073, 6806.1896943269, 6828.902007595, '081700001010', 'CLOSED', 'CLOSED', '2024-05-16', NULL, '2023-10-19 07:55:06', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(594, '1697205677', 6851.665014287, 22.763006691983, 6828.902007595, 0, '081700001010', 'CLOSED', 'CLOSED', '2024-06-15', NULL, '2023-10-19 07:55:06', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(595, '1697699767', 4060.23, 106.66666666667, 3953.5633333333, 28046.436666667, '081700001010', 'ACTIVE', 'CLOSED', '2023-11-18', NULL, '2023-10-19 09:59:25', '2023-10-19 09:59:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(596, '1697699767', 4060.23, 93.488122222222, 3966.7418777778, 24079.694788889, '081700001010', 'ACTIVE', 'CLOSED', '2023-12-18', NULL, '2023-10-19 09:59:25', '2023-10-19 09:59:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(597, '1697699767', 4060.23, 80.265649296296, 3979.9643507037, 20099.730438185, '081700001010', 'ACTIVE', 'CLOSED', '2024-01-17', NULL, '2023-10-19 09:59:25', '2023-10-19 09:59:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(598, '1697699767', 4060.23, 66.999101460617, 3993.2308985394, 16106.499539646, '081700001010', 'ACTIVE', 'CLOSED', '2024-02-16', NULL, '2023-10-19 09:59:25', '2023-10-19 09:59:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(599, '1697699767', 4060.23, 53.688331798819, 4006.5416682012, 12099.957871445, '081700001010', 'ACTIVE', 'CLOSED', '2024-03-17', NULL, '2023-10-19 09:59:25', '2023-10-19 09:59:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(600, '1697699767', 4060.23, 40.333192904815, 4019.8968070952, 8080.0610643494, '081700001010', 'ACTIVE', 'CLOSED', '2024-04-16', NULL, '2023-10-19 09:59:25', '2023-10-19 09:59:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(601, '1697699767', 4060.23, 26.933536881165, 4033.2964631188, 4046.7646012306, '081700001010', 'ACTIVE', 'CLOSED', '2024-05-16', NULL, '2023-10-19 09:59:25', '2023-10-19 09:59:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(602, '1697699767', 4060.253816568, 13.489215337435, 4046.7646012306, 0, '081700001010', 'ACTIVE', 'CLOSED', '2024-06-15', NULL, '2023-10-19 09:59:25', '2023-10-19 09:59:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(603, '1698408439', 170299.81, 6666.6666666667, 163633.14333333, 1836366.8566667, '081700001010', 'CLOSED', 'CLOSED', '2023-11-30', NULL, '2023-10-31 07:58:31', '2023-11-21 15:34:42', NULL, 1, NULL, NULL, NULL, NULL, 0, 0),
(604, '1698408439', 170299.81, 6121.2228555556, 164178.58714444, 1672188.2695222, '081700001010', 'CLOSED', 'CLOSED', '2023-12-30', NULL, '2023-10-31 07:58:31', '2023-11-21 15:34:42', NULL, 2, NULL, NULL, NULL, NULL, 0, 0),
(605, '1698408439', 170299.81, 5573.9608984074, 164725.84910159, 1507462.4204206, '081700001010', 'CLOSED', 'CLOSED', '2024-01-29', NULL, '2023-10-31 07:58:31', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(606, '1698408439', 170299.81, 5024.8747347354, 165274.93526526, 1342187.4851554, '081700001010', 'CLOSED', 'CLOSED', '2024-02-28', NULL, '2023-10-31 07:58:31', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(607, '1698408439', 170299.81, 4473.9582838512, 165825.85171615, 1176361.6334392, '081700001010', 'CLOSED', 'CLOSED', '2024-03-29', NULL, '2023-10-31 07:58:31', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(608, '1698408439', 170299.81, 3921.2054447974, 166378.6045552, 1009983.028884, '081700001010', 'CLOSED', 'CLOSED', '2024-04-28', NULL, '2023-10-31 07:58:31', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(609, '1698408439', 170299.81, 3366.61009628, 166933.19990372, 843049.82898029, '081700001010', 'CLOSED', 'CLOSED', '2024-05-28', NULL, '2023-10-31 07:58:31', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(610, '1698408439', 170299.81, 2810.166096601, 167489.6439034, 675560.18507689, '081700001010', 'CLOSED', 'CLOSED', '2024-06-27', NULL, '2023-10-31 07:58:31', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(611, '1698408439', 170299.81, 2251.8672835896, 168047.94271641, 507512.24236048, '081700001010', 'CLOSED', 'CLOSED', '2024-07-27', NULL, '2023-10-31 07:58:31', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(612, '1698408439', 170299.81, 1691.7074745349, 168608.10252547, 338904.13983502, '081700001010', 'CLOSED', 'CLOSED', '2024-08-26', NULL, '2023-10-31 07:58:31', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(613, '1698408439', 170299.81, 1129.6804661167, 169170.12953388, 169734.01030114, '081700001010', 'CLOSED', 'CLOSED', '2024-09-25', NULL, '2023-10-31 07:58:31', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(614, '1698408439', 170299.79033547, 565.78003433712, 169734.01030114, 0, '081700001010', 'CLOSED', 'CLOSED', '2024-10-25', NULL, '2023-10-31 07:58:31', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(615, '1699100510', 66061.09, 1950, 64111.09, 715888.91, '081700001020', 'CLOSED', 'CLOSED', '2023-12-04', NULL, '2023-11-04 12:30:59', '2023-11-20 12:00:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(616, '1699100510', 66061.09, 1789.722275, 64271.367725, 651617.542275, '081700001020', 'CLOSED', 'CLOSED', '2024-01-03', NULL, '2023-11-04 12:30:59', '2023-11-20 12:00:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(617, '1699100510', 66061.09, 1629.0438556875, 64432.046144312, 587185.49613069, '081700001020', 'CLOSED', 'CLOSED', '2024-02-02', NULL, '2023-11-04 12:30:59', '2023-11-20 12:00:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(618, '1699100510', 66061.09, 1467.9637403267, 64593.126259673, 522592.36987101, '081700001020', 'CLOSED', 'CLOSED', '2024-03-03', NULL, '2023-11-04 12:30:59', '2023-11-20 12:00:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(619, '1699100510', 66061.09, 1306.4809246775, 64754.609075322, 457837.76079569, '081700001020', 'CLOSED', 'CLOSED', '2024-04-02', NULL, '2023-11-04 12:30:59', '2023-11-20 12:00:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(620, '1699100510', 66061.09, 1144.5944019892, 64916.495598011, 392921.26519768, '081700001020', 'CLOSED', 'CLOSED', '2024-05-02', NULL, '2023-11-04 12:30:59', '2023-11-20 12:00:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(621, '1699100510', 66061.09, 982.3031629942, 65078.786837006, 327842.47836068, '081700001020', 'CLOSED', 'CLOSED', '2024-06-01', NULL, '2023-11-04 12:30:59', '2023-11-20 12:00:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(622, '1699100510', 66061.09, 819.60619590169, 65241.483804098, 262600.99455658, '081700001020', 'CLOSED', 'CLOSED', '2024-07-01', NULL, '2023-11-04 12:30:59', '2023-11-20 12:00:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(623, '1699100510', 66061.09, 656.50248639144, 65404.587513609, 197196.40704297, '081700001020', 'CLOSED', 'CLOSED', '2024-07-31', NULL, '2023-11-04 12:30:59', '2023-11-20 12:00:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(624, '1699100510', 66061.09, 492.99101760742, 65568.098982393, 131628.30806058, '081700001020', 'CLOSED', 'CLOSED', '2024-08-30', NULL, '2023-11-04 12:30:59', '2023-11-20 12:00:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(625, '1699100510', 66061.09, 329.07077015144, 65732.019229849, 65896.288830727, '081700001020', 'CLOSED', 'CLOSED', '2023-11-05', NULL, '2023-11-04 12:30:59', '2023-11-20 12:00:19', NULL, NULL, NULL, NULL, '2023-11-12', 'ameomba siku 3, amesafiri kikazi. tarehe 9. Need to call again.', 0, 0),
(626, '1699100510', 66061.029552804, 164.74072207682, 65896.288830727, 0, '081700001020', 'CLOSED', 'CLOSED', '2024-10-29', NULL, '2023-11-04 12:30:59', '2023-11-20 12:00:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(627, '1699189643', 57715.71, 1000, 56715.71, 343284.29, '081700001020', 'ACTIVE', 'ACTIVE', '2023-12-05', NULL, '2023-11-05 16:24:08', '2023-11-05 16:24:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(628, '1699189643', 57715.71, 858.210725, 56857.499275, 286426.790725, '081700001020', 'ACTIVE', 'ACTIVE', '2024-01-04', NULL, '2023-11-05 16:24:08', '2023-11-05 16:24:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(629, '1699189643', 57715.71, 716.0669768125, 56999.643023187, 229427.14770181, '081700001020', 'ACTIVE', 'ACTIVE', '2024-02-03', NULL, '2023-11-05 16:24:08', '2023-11-05 16:24:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(630, '1699189643', 57715.71, 573.56786925453, 57142.142130745, 172285.00557107, '081700001020', 'ACTIVE', 'ACTIVE', '2024-03-04', NULL, '2023-11-05 16:24:08', '2023-11-05 16:24:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(631, '1699189643', 57715.71, 430.71251392767, 57284.997486072, 115000.00808499, '081700001020', 'ACTIVE', 'ACTIVE', '2024-04-03', NULL, '2023-11-05 16:24:08', '2023-11-05 16:24:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(632, '1699189643', 57715.71, 287.50002021249, 57428.209979788, 57571.798105207, '081700001020', 'ACTIVE', 'ACTIVE', '2024-05-03', NULL, '2023-11-05 16:24:08', '2023-11-05 16:24:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(633, '1699189643', 57715.72760047, 143.92949526302, 57571.798105207, 0, '081700001020', 'ACTIVE', 'ACTIVE', '2023-11-07', NULL, '2023-11-05 16:24:08', '2023-11-05 16:24:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(634, '1699205808', 86573.57, 1500, 85073.57, 514926.43, '081700001010', 'ACTIVE', 'ACTIVE', '2023-12-05', NULL, '2023-11-05 17:42:07', '2023-11-05 17:42:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(635, '1699205808', 86573.57, 1287.316075, 85286.253925, 429640.176075, '081700001010', 'ACTIVE', 'ACTIVE', '2024-01-04', NULL, '2023-11-05 17:42:07', '2023-11-05 17:42:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(636, '1699205808', 86573.57, 1074.1004401875, 85499.469559813, 344140.70651519, '081700001010', 'ACTIVE', 'ACTIVE', '2024-02-03', NULL, '2023-11-05 17:42:07', '2023-11-05 17:42:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(637, '1699205808', 86573.57, 860.35176628797, 85713.218233712, 258427.48828148, '081700001010', 'ACTIVE', 'ACTIVE', '2024-03-04', NULL, '2023-11-05 17:42:07', '2023-11-05 17:42:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(638, '1699205808', 86573.57, 646.06872070369, 85927.501279296, 172499.98700218, '081700001010', 'ACTIVE', 'ACTIVE', '2023-11-06', NULL, '2023-11-05 17:42:07', '2023-11-05 17:42:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(639, '1699205808', 86573.57, 431.24996750545, 86142.320032495, 86357.666969685, '081700001010', 'ACTIVE', 'ACTIVE', '2024-05-03', NULL, '2023-11-05 17:42:07', '2023-11-05 17:42:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(640, '1699205808', 86573.561137109, 215.89416742421, 86357.666969685, 0, '081700001010', 'ACTIVE', 'ACTIVE', '2024-06-02', NULL, '2023-11-05 17:42:07', '2023-11-05 17:42:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(641, '1699206567', 54135, 135, 54000, 0, '081700001010', 'CLOSED', 'CLOSED', '2023-12-05', NULL, '2023-11-05 17:57:48', '2023-11-21 12:33:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(642, '1700481574', 69693.83, 6606.1085, 63087.7215, 729645.2985, NULL, 'CLOSED', 'CLOSED', '2023-12-20', NULL, '2023-11-20 12:00:19', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(643, '1700481574', 69693.83, 6080.3774875, 63613.4525125, 666031.8459875, NULL, 'CLOSED', 'CLOSED', '2024-01-19', NULL, '2023-11-20 12:00:19', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(644, '1700481574', 69693.83, 5550.2653832292, 64143.564616771, 601888.28137073, NULL, 'CLOSED', 'CLOSED', '2024-02-18', NULL, '2023-11-20 12:00:19', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(645, '1700481574', 69693.83, 5015.7356780894, 64678.094321911, 537210.18704882, NULL, 'CLOSED', 'CLOSED', '2024-03-19', NULL, '2023-11-20 12:00:19', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(646, '1700481574', 69693.83, 4476.7515587402, 65217.07844126, 471993.10860756, NULL, 'CLOSED', 'CLOSED', '2024-04-18', NULL, '2023-11-20 12:00:19', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(647, '1700481574', 69693.83, 3933.275905063, 65760.554094937, 406232.55451262, NULL, 'CLOSED', 'CLOSED', '2024-05-18', NULL, '2023-11-20 12:00:19', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(648, '1700481574', 69693.83, 3385.2712876052, 66308.558712395, 339923.99580023, NULL, 'CLOSED', 'CLOSED', '2024-06-17', NULL, '2023-11-20 12:00:19', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(649, '1700481574', 69693.83, 2832.6999650019, 66861.130034998, 273062.86576523, NULL, 'CLOSED', 'CLOSED', '2024-07-17', NULL, '2023-11-20 12:00:19', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(650, '1700481574', 69693.83, 2275.5238813769, 67418.306118623, 205644.55964661, NULL, 'CLOSED', 'CLOSED', '2024-08-16', NULL, '2023-11-20 12:00:19', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(651, '1700481574', 69693.83, 1713.7046637217, 67980.125336278, 137664.43431033, NULL, 'CLOSED', 'CLOSED', '2024-09-15', NULL, '2023-11-20 12:00:19', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(652, '1700481574', 69693.83, 1147.2036192527, 68546.626380747, 69117.80792958, NULL, 'CLOSED', 'CLOSED', '2024-10-15', NULL, '2023-11-20 12:00:19', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(653, '1700481574', 69693.789662327, 575.9817327465, 69117.80792958, 0, NULL, 'CLOSED', 'CLOSED', '2024-11-14', NULL, '2023-11-20 12:00:19', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(654, '1700482214', 73526.34, 6969.3826666667, 66556.957333333, 769768.96266667, NULL, 'ACTIVE', 'ACTIVE', '2023-12-20', NULL, '2023-11-20 12:10:59', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(655, '1700482214', 73526.34, 6969.3826666667, 66556.957333333, 703212.00533333, NULL, 'ACTIVE', 'ACTIVE', '2024-01-19', NULL, '2023-11-20 12:10:59', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(656, '1700482214', 73526.34, 6969.3826666667, 66556.957333333, 636655.048, NULL, 'ACTIVE', 'ACTIVE', '2024-02-18', NULL, '2023-11-20 12:10:59', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(657, '1700482214', 73526.34, 6969.3826666667, 66556.957333333, 570098.09066667, NULL, 'ACTIVE', 'ACTIVE', '2024-03-19', NULL, '2023-11-20 12:10:59', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(658, '1700482214', 73526.34, 6969.3826666667, 66556.957333333, 503541.13333333, NULL, 'ACTIVE', 'ACTIVE', '2024-04-18', NULL, '2023-11-20 12:10:59', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(659, '1700482214', 73526.34, 6969.3826666667, 66556.957333333, 436984.176, NULL, 'ACTIVE', 'ACTIVE', '2024-05-18', NULL, '2023-11-20 12:10:59', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(660, '1700482214', 73526.34, 6969.3826666667, 66556.957333333, 370427.21866667, NULL, 'ACTIVE', 'ACTIVE', '2024-06-17', NULL, '2023-11-20 12:10:59', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(661, '1700482214', 73526.34, 6969.3826666667, 66556.957333333, 303870.26133333, NULL, 'ACTIVE', 'ACTIVE', '2024-07-17', NULL, '2023-11-20 12:10:59', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(662, '1700482214', 73526.34, 6969.3826666667, 66556.957333333, 237313.304, NULL, 'ACTIVE', 'ACTIVE', '2024-08-16', NULL, '2023-11-20 12:10:59', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(663, '1700482214', 73526.34, 6969.3826666667, 66556.957333333, 170756.34666667, NULL, 'ACTIVE', 'ACTIVE', '2024-09-15', NULL, '2023-11-20 12:10:59', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(664, '1700482214', 73526.34, 6969.3826666667, 66556.957333333, 104199.38933333, NULL, 'ACTIVE', 'ACTIVE', '2024-10-15', NULL, '2023-11-20 12:10:59', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(665, '1700482214', 73526.34, 6969.3826666667, 66556.957333333, 37642.432, NULL, 'ACTIVE', 'ACTIVE', '2024-11-14', NULL, '2023-11-20 12:10:59', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(666, '1700482214', 44611.814666667, 6969.3826666667, 37642.432, 0, NULL, 'ACTIVE', 'ACTIVE', '2024-12-14', NULL, '2023-11-20 12:10:59', '2023-11-20 12:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(667, '1700484455', 42346.85, 1250, 41096.85, 458903.15, '081700001025', 'CLOSED', 'CLOSED', '2023-11-20', NULL, '2023-11-20 14:06:02', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, '2023-11-23', 'ameomba siku 4', 0, 0),
(668, '1700484455', 42346.85, 1147.257875, 41199.592125, 417703.557875, '081700001025', 'CLOSED', 'CLOSED', '2023-11-21', NULL, '2023-11-20 14:06:02', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, '2023-11-22', 'kaomba siku 3', 0, 0),
(669, '1700484455', 42346.85, 1044.2588946875, 41302.591105313, 376400.96676969, '081700001025', 'CLOSED', 'CLOSED', '2024-02-18', NULL, '2023-11-20 14:06:02', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(670, '1700484455', 42346.85, 941.00241692422, 41405.847583076, 334995.11918661, '081700001025', 'CLOSED', 'CLOSED', '2024-03-19', NULL, '2023-11-20 14:06:02', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(671, '1700484455', 42346.85, 837.48779796653, 41509.362202033, 293485.75698458, '081700001025', 'CLOSED', 'CLOSED', '2024-04-18', NULL, '2023-11-20 14:06:02', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(672, '1700484455', 42346.85, 733.71439246145, 41613.135607539, 251872.62137704, '081700001025', 'CLOSED', 'CLOSED', '2024-05-18', NULL, '2023-11-20 14:06:02', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(673, '1700484455', 42346.85, 629.6815534426, 41717.168446557, 210155.45293048, '081700001025', 'CLOSED', 'CLOSED', '2024-06-17', NULL, '2023-11-20 14:06:02', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(674, '1700484455', 42346.85, 525.38863232621, 41821.461367674, 168333.99156281, '081700001025', 'CLOSED', 'CLOSED', '2024-07-17', NULL, '2023-11-20 14:06:02', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(675, '1700484455', 42346.85, 420.83497890702, 41926.015021093, 126407.97654172, '081700001025', 'CLOSED', 'CLOSED', '2024-08-16', NULL, '2023-11-20 14:06:02', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(676, '1700484455', 42346.85, 316.01994135429, 42030.830058646, 84377.14648307, '081700001025', 'CLOSED', 'CLOSED', '2024-09-15', NULL, '2023-11-20 14:06:02', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(677, '1700484455', 42346.85, 210.94286620767, 42135.907133792, 42241.239349277, '081700001025', 'CLOSED', 'CLOSED', '2024-10-15', NULL, '2023-11-20 14:06:02', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(678, '1700484455', 42346.842447651, 105.60309837319, 42241.239349277, 0, '081700001025', 'CLOSED', 'CLOSED', '2024-11-14', NULL, '2023-11-20 14:06:02', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(679, '1700562619', 44675.53, 4234.6849166667, 40440.845083333, 467721.34491667, NULL, 'ACTIVE', 'ACTIVE', '2023-12-21', NULL, '2023-11-21 11:23:45', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(680, '1700562619', 44675.53, 4234.6849166667, 40440.845083333, 427280.49983333, NULL, 'ACTIVE', 'ACTIVE', '2024-01-20', NULL, '2023-11-21 11:23:45', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(681, '1700562619', 44675.53, 4234.6849166667, 40440.845083333, 386839.65475, NULL, 'ACTIVE', 'ACTIVE', '2024-02-19', NULL, '2023-11-21 11:23:45', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(682, '1700562619', 44675.53, 4234.6849166667, 40440.845083333, 346398.80966667, NULL, 'ACTIVE', 'ACTIVE', '2024-03-20', NULL, '2023-11-21 11:23:45', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(683, '1700562619', 44675.53, 4234.6849166667, 40440.845083333, 305957.96458333, NULL, 'ACTIVE', 'ACTIVE', '2024-04-19', NULL, '2023-11-21 11:23:45', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(684, '1700562619', 44675.53, 4234.6849166667, 40440.845083333, 265517.1195, NULL, 'ACTIVE', 'ACTIVE', '2024-05-19', NULL, '2023-11-21 11:23:45', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(685, '1700562619', 44675.53, 4234.6849166667, 40440.845083333, 225076.27441667, NULL, 'ACTIVE', 'ACTIVE', '2024-06-18', NULL, '2023-11-21 11:23:45', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(686, '1700562619', 44675.53, 4234.6849166667, 40440.845083333, 184635.42933333, NULL, 'ACTIVE', 'ACTIVE', '2024-07-18', NULL, '2023-11-21 11:23:45', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(687, '1700562619', 44675.53, 4234.6849166667, 40440.845083333, 144194.58425, NULL, 'ACTIVE', 'ACTIVE', '2024-08-17', NULL, '2023-11-21 11:23:45', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(688, '1700562619', 44675.53, 4234.6849166667, 40440.845083333, 103753.73916667, NULL, 'ACTIVE', 'ACTIVE', '2024-09-16', NULL, '2023-11-21 11:23:45', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);
INSERT INTO `loans_schedules` (`id`, `loan_id`, `installment`, `interest`, `principle`, `balance`, `bank_account_number`, `completion_status`, `account_status`, `installment_date`, `next_check_date`, `created_at`, `updated_at`, `penalties`, `days_in_arrears`, `amount_in_arrears`, `payment`, `promise_date`, `comment`, `opening_balance`, `closing_balance`) VALUES
(689, '1700562619', 44675.53, 4234.6849166667, 40440.845083333, 63312.894083333, NULL, 'ACTIVE', 'ACTIVE', '2024-10-16', NULL, '2023-11-21 11:23:45', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(690, '1700562619', 44675.53, 4234.6849166667, 40440.845083333, 22872.049, NULL, 'ACTIVE', 'ACTIVE', '2024-11-15', NULL, '2023-11-21 11:23:45', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(691, '1700562619', 27106.733916667, 4234.6849166667, 22872.049, 0, NULL, 'ACTIVE', 'ACTIVE', '2024-12-15', NULL, '2023-11-21 11:23:45', '2023-11-21 11:23:45', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(692, '1700569371', 18135.3, 135.3375, 17999.9625, 36135.0375, NULL, 'ACTIVE', 'ACTIVE', '2023-12-21', NULL, '2023-11-21 12:23:46', '2023-11-21 12:23:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(693, '1700569371', 18135.3, 135.3375, 17999.9625, 18135.075, NULL, 'ACTIVE', 'ACTIVE', '2024-01-20', NULL, '2023-11-21 12:23:46', '2023-11-21 12:23:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(694, '1700569371', 18270.4125, 135.3375, 18135.075, 0, NULL, 'ACTIVE', 'ACTIVE', '2024-02-19', NULL, '2023-11-21 12:23:46', '2023-11-21 12:23:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(695, '1700569371', 18135.3, 135.3375, 17999.9625, 36135.0375, '081700001010', 'ACTIVE', 'ACTIVE', '2023-12-21', NULL, '2023-11-21 12:33:06', '2023-11-21 12:33:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(696, '1700569371', 18135.3, 90.33759375, 18044.96240625, 18090.07509375, '081700001010', 'ACTIVE', 'ACTIVE', '2024-01-20', NULL, '2023-11-21 12:33:06', '2023-11-21 12:33:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(697, '1700569371', 18135.300281484, 45.225187734375, 18090.07509375, 0, '081700001010', 'ACTIVE', 'ACTIVE', '2024-02-19', NULL, '2023-11-21 12:33:06', '2023-11-21 12:33:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(698, '1700570154', 8791.59, 833.33333333333, 7958.2566666667, 92041.743333333, NULL, 'ACTIVE', 'ACTIVE', '2023-12-21', NULL, '2023-11-21 15:34:42', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(699, '1700570154', 8791.59, 767.01452777778, 8024.5754722222, 84017.167861111, NULL, 'ACTIVE', 'ACTIVE', '2024-01-20', NULL, '2023-11-21 15:34:42', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(700, '1700570154', 8791.59, 700.14306550926, 8091.4469344907, 75925.72092662, NULL, 'ACTIVE', 'ACTIVE', '2024-02-19', NULL, '2023-11-21 15:34:42', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(701, '1700570154', 8791.59, 632.71434105517, 8158.8756589448, 67766.845267676, NULL, 'ACTIVE', 'ACTIVE', '2024-03-20', NULL, '2023-11-21 15:34:42', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(702, '1700570154', 8791.59, 564.72371056396, 8226.866289436, 59539.97897824, NULL, 'ACTIVE', 'ACTIVE', '2024-04-19', NULL, '2023-11-21 15:34:42', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(703, '1700570154', 8791.59, 496.16649148533, 8295.4235085147, 51244.555469725, NULL, 'ACTIVE', 'ACTIVE', '2024-05-19', NULL, '2023-11-21 15:34:42', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(704, '1700570154', 8791.59, 427.03796224771, 8364.5520377523, 42880.003431973, NULL, 'ACTIVE', 'ACTIVE', '2024-06-18', NULL, '2023-11-21 15:34:42', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(705, '1700570154', 8791.59, 357.3333619331, 8434.2566380669, 34445.746793906, NULL, 'ACTIVE', 'ACTIVE', '2024-07-18', NULL, '2023-11-21 15:34:42', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(706, '1700570154', 8791.59, 287.04788994921, 8504.5421100508, 25941.204683855, NULL, 'ACTIVE', 'ACTIVE', '2024-08-17', NULL, '2023-11-21 15:34:42', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(707, '1700570154', 8791.59, 216.17670569879, 8575.4132943012, 17365.791389554, NULL, 'ACTIVE', 'ACTIVE', '2024-09-16', NULL, '2023-11-21 15:34:42', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(708, '1700570154', 8791.59, 144.71492824628, 8646.8750717537, 8718.9163177999, NULL, 'ACTIVE', 'ACTIVE', '2024-10-16', NULL, '2023-11-21 15:34:42', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(709, '1700570154', 8791.5739537816, 72.657635981666, 8718.9163177999, 0, NULL, 'ACTIVE', 'ACTIVE', '2024-11-15', NULL, '2023-11-21 15:34:42', '2023-11-21 15:34:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(710, '1700570154', 8469.37, 250, 8219.37, 91780.63, '081700001010', 'ACTIVE', 'ACTIVE', '2023-12-21', NULL, '2023-11-21 15:37:23', '2023-11-21 15:37:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(711, '1700570154', 8469.37, 229.451575, 8239.918425, 83540.711575, '081700001010', 'ACTIVE', 'ACTIVE', '2024-01-20', NULL, '2023-11-21 15:37:23', '2023-11-21 15:37:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(712, '1700570154', 8469.37, 208.8517789375, 8260.5182210625, 75280.193353938, '081700001010', 'ACTIVE', 'ACTIVE', '2024-02-19', NULL, '2023-11-21 15:37:23', '2023-11-21 15:37:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(713, '1700570154', 8469.37, 188.20048338484, 8281.1695166152, 66999.023837322, '081700001010', 'ACTIVE', 'ACTIVE', '2024-03-20', NULL, '2023-11-21 15:37:23', '2023-11-21 15:37:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(714, '1700570154', 8469.37, 167.49755959331, 8301.8724404067, 58697.151396916, '081700001010', 'ACTIVE', 'ACTIVE', '2024-04-19', NULL, '2023-11-21 15:37:23', '2023-11-21 15:37:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(715, '1700570154', 8469.37, 146.74287849229, 8322.6271215077, 50374.524275408, '081700001010', 'ACTIVE', 'ACTIVE', '2024-05-19', NULL, '2023-11-21 15:37:23', '2023-11-21 15:37:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(716, '1700570154', 8469.37, 125.93631068852, 8343.4336893115, 42031.090586096, '081700001010', 'ACTIVE', 'ACTIVE', '2024-06-18', NULL, '2023-11-21 15:37:23', '2023-11-21 15:37:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(717, '1700570154', 8469.37, 105.07772646524, 8364.2922735348, 33666.798312562, '081700001010', 'ACTIVE', 'ACTIVE', '2024-07-18', NULL, '2023-11-21 15:37:23', '2023-11-21 15:37:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(718, '1700570154', 8469.37, 84.166995781404, 8385.2030042186, 25281.595308343, '081700001010', 'ACTIVE', 'ACTIVE', '2024-08-17', NULL, '2023-11-21 15:37:23', '2023-11-21 15:37:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(719, '1700570154', 8469.37, 63.203988270858, 8406.1660117291, 16875.429296614, '081700001010', 'ACTIVE', 'ACTIVE', '2024-09-16', NULL, '2023-11-21 15:37:23', '2023-11-21 15:37:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(720, '1700570154', 8469.37, 42.188573241535, 8427.1814267585, 8448.2478698555, '081700001010', 'ACTIVE', 'ACTIVE', '2024-10-16', NULL, '2023-11-21 15:37:23', '2023-11-21 15:37:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(721, '1700570154', 8469.3684895301, 21.120619674639, 8448.2478698555, 0, '081700001010', 'ACTIVE', 'ACTIVE', '2024-11-15', NULL, '2023-11-21 15:37:23', '2023-11-21 15:37:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(722, '1698755529', 12830.35, 583.33333333333, 12247.016666667, 87752.983333333, NULL, 'ACTIVE', 'ACTIVE', '2023-12-21', NULL, '2023-11-21 17:14:13', '2023-11-21 17:14:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(723, '1698755529', 12830.35, 583.33333333333, 12247.016666667, 75505.966666667, NULL, 'ACTIVE', 'ACTIVE', '2024-01-20', NULL, '2023-11-21 17:14:13', '2023-11-21 17:14:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(724, '1698755529', 12830.35, 583.33333333333, 12247.016666667, 63258.95, NULL, 'ACTIVE', 'ACTIVE', '2024-02-19', NULL, '2023-11-21 17:14:13', '2023-11-21 17:14:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(725, '1698755529', 12830.35, 583.33333333333, 12247.016666667, 51011.933333333, NULL, 'ACTIVE', 'ACTIVE', '2024-03-20', NULL, '2023-11-21 17:14:13', '2023-11-21 17:14:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(726, '1698755529', 12830.35, 583.33333333333, 12247.016666667, 38764.916666667, NULL, 'ACTIVE', 'ACTIVE', '2024-04-19', NULL, '2023-11-21 17:14:13', '2023-11-21 17:14:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(727, '1698755529', 12830.35, 583.33333333333, 12247.016666667, 26517.9, NULL, 'ACTIVE', 'ACTIVE', '2024-05-19', NULL, '2023-11-21 17:14:13', '2023-11-21 17:14:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(728, '1698755529', 12830.35, 583.33333333333, 12247.016666667, 14270.883333333, NULL, 'ACTIVE', 'ACTIVE', '2024-06-18', NULL, '2023-11-21 17:14:13', '2023-11-21 17:14:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(729, '1698755529', 12830.35, 583.33333333333, 12247.016666667, 2023.8666666667, NULL, 'ACTIVE', 'ACTIVE', '2024-07-18', NULL, '2023-11-21 17:14:13', '2023-11-21 17:14:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(730, '1698755529', 2607.2, 583.33333333333, 2023.8666666667, 0, NULL, 'ACTIVE', 'ACTIVE', '2024-08-17', NULL, '2023-11-21 17:14:13', '2023-11-21 17:14:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(731, '1700592333', 297998.11, 20090, 277908.11, 3166091.89, NULL, 'CLOSED', 'ACTIVE', '2023-12-21', NULL, '2023-11-21 18:47:57', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(732, '1700592333', 297998.11, 18468.869358333, 279529.24064167, 2886562.6493583, NULL, 'CLOSED', 'ACTIVE', '2024-01-20', NULL, '2023-11-21 18:47:57', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(733, '1700592333', 297998.11, 16838.282121257, 281159.82787874, 2605402.8214796, NULL, 'CLOSED', 'ACTIVE', '2024-02-19', NULL, '2023-11-21 18:47:57', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(734, '1700592333', 297998.11, 15198.183125298, 282799.9268747, 2322602.8946049, NULL, 'CLOSED', 'ACTIVE', '2024-03-20', NULL, '2023-11-21 18:47:57', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(735, '1700592333', 297998.11, 13548.516885195, 284449.5931148, 2038153.3014901, NULL, 'CLOSED', 'ACTIVE', '2024-04-19', NULL, '2023-11-21 18:47:57', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(736, '1700592333', 297998.11, 11889.227592025, 286108.88240797, 1752044.4190821, NULL, 'CLOSED', 'ACTIVE', '2024-05-19', NULL, '2023-11-21 18:47:57', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(737, '1700592333', 297998.11, 10220.259111312, 287777.85088869, 1464266.5681934, NULL, 'CLOSED', 'ACTIVE', '2024-06-18', NULL, '2023-11-21 18:47:57', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(738, '1700592333', 297998.11, 8541.5549811283, 289456.55501887, 1174810.0131745, NULL, 'CLOSED', 'ACTIVE', '2024-07-18', NULL, '2023-11-21 18:47:57', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(739, '1700592333', 297998.11, 6853.0584101849, 291145.05158982, 883664.96158473, NULL, 'CLOSED', 'ACTIVE', '2024-08-17', NULL, '2023-11-21 18:47:57', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(740, '1700592333', 297998.11, 5154.712275911, 292843.39772409, 590821.56386065, NULL, 'CLOSED', 'ACTIVE', '2024-09-16', NULL, '2023-11-21 18:47:57', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(741, '1700592333', 297998.11, 3446.4591225204, 294551.65087748, 296269.91298317, NULL, 'CLOSED', 'ACTIVE', '2024-10-16', NULL, '2023-11-21 18:47:57', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(742, '1700592333', 297998.15414223, 1728.2411590685, 296269.91298317, 0, NULL, 'CLOSED', 'ACTIVE', '2024-11-15', NULL, '2023-11-21 18:47:57', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(743, '1700592333', 291685.1, 8610, 283075.1, 3160924.9, '081700001025', 'CLOSED', 'ACTIVE', '2023-12-21', NULL, '2023-11-21 18:49:31', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(744, '1700592333', 291685.1, 7902.31225, 283782.78775, 2877142.11225, '081700001025', 'CLOSED', 'ACTIVE', '2024-01-20', NULL, '2023-11-21 18:49:31', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(745, '1700592333', 291685.1, 7192.855280625, 284492.24471937, 2592649.8675306, '081700001025', 'CLOSED', 'ACTIVE', '2024-02-19', NULL, '2023-11-21 18:49:31', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(746, '1700592333', 291685.1, 6481.6246688266, 285203.47533117, 2307446.3921995, '081700001025', 'CLOSED', 'ACTIVE', '2024-03-20', NULL, '2023-11-21 18:49:31', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(747, '1700592333', 291685.1, 5768.6159804986, 285916.4840195, 2021529.90818, '081700001025', 'CLOSED', 'ACTIVE', '2024-04-19', NULL, '2023-11-21 18:49:31', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(748, '1700592333', 291685.1, 5053.8247704499, 286631.27522955, 1734898.6329504, '081700001025', 'CLOSED', 'ACTIVE', '2024-05-19', NULL, '2023-11-21 18:49:31', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(749, '1700592333', 291685.1, 4337.246582376, 287347.85341762, 1447550.7795328, '081700001025', 'CLOSED', 'ACTIVE', '2024-06-18', NULL, '2023-11-21 18:49:31', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(750, '1700592333', 291685.1, 3618.8769488319, 288066.22305117, 1159484.5564816, '081700001025', 'CLOSED', 'ACTIVE', '2024-07-18', NULL, '2023-11-21 18:49:31', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(751, '1700592333', 291685.1, 2898.711391204, 288786.3886088, 870698.16787281, '081700001025', 'CLOSED', 'ACTIVE', '2024-08-17', NULL, '2023-11-21 18:49:31', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(752, '1700592333', 291685.1, 2176.745419682, 289508.35458032, 581189.81329249, '081700001025', 'CLOSED', 'ACTIVE', '2024-09-16', NULL, '2023-11-21 18:49:31', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(753, '1700592333', 291685.1, 1452.9745332312, 290232.12546677, 290957.68782573, '081700001025', 'CLOSED', 'ACTIVE', '2024-10-16', NULL, '2023-11-21 18:49:31', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(754, '1700592333', 291685.08204529, 727.39421956431, 290957.68782573, 0, '081700001025', 'CLOSED', 'ACTIVE', '2024-11-15', NULL, '2023-11-21 18:49:31', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(755, '1700675592', 519160.48, 35000, 484160.48, 5515839.52, NULL, 'ACTIVE', 'ACTIVE', '2023-12-22', NULL, '2023-11-22 17:54:19', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(756, '1700675592', 519160.48, 35000, 484160.48, 5031679.04, NULL, 'ACTIVE', 'ACTIVE', '2024-01-21', NULL, '2023-11-22 17:54:19', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(757, '1700675592', 519160.48, 35000, 484160.48, 4547518.56, NULL, 'ACTIVE', 'ACTIVE', '2024-02-20', NULL, '2023-11-22 17:54:19', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(758, '1700675592', 519160.48, 35000, 484160.48, 4063358.08, NULL, 'ACTIVE', 'ACTIVE', '2024-03-21', NULL, '2023-11-22 17:54:19', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(759, '1700675592', 519160.48, 35000, 484160.48, 3579197.6, NULL, 'ACTIVE', 'ACTIVE', '2024-04-20', NULL, '2023-11-22 17:54:19', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(760, '1700675592', 519160.48, 35000, 484160.48, 3095037.12, NULL, 'ACTIVE', 'ACTIVE', '2024-05-20', NULL, '2023-11-22 17:54:19', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(761, '1700675592', 519160.48, 35000, 484160.48, 2610876.64, NULL, 'ACTIVE', 'ACTIVE', '2024-06-19', NULL, '2023-11-22 17:54:19', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(762, '1700675592', 519160.48, 35000, 484160.48, 2126716.16, NULL, 'ACTIVE', 'ACTIVE', '2024-07-19', NULL, '2023-11-22 17:54:19', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(763, '1700675592', 519160.48, 35000, 484160.48, 1642555.68, NULL, 'ACTIVE', 'ACTIVE', '2024-08-18', NULL, '2023-11-22 17:54:19', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(764, '1700675592', 519160.48, 35000, 484160.48, 1158395.2, NULL, 'ACTIVE', 'ACTIVE', '2024-09-17', NULL, '2023-11-22 17:54:19', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(765, '1700675592', 519160.48, 35000, 484160.48, 674234.72, NULL, 'ACTIVE', 'ACTIVE', '2024-10-17', NULL, '2023-11-22 17:54:19', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(766, '1700675592', 519160.48, 35000, 484160.48, 190074.24, NULL, 'ACTIVE', 'ACTIVE', '2024-11-16', NULL, '2023-11-22 17:54:19', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(767, '1700675592', 225074.24, 35000, 190074.24, 0, NULL, 'ACTIVE', 'ACTIVE', '2024-12-16', NULL, '2023-11-22 17:54:19', '2023-11-22 17:54:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(768, '1700675592', 508162.19, 15000, 493162.19, 5506837.81, '081700001025', 'ACTIVE', 'ACTIVE', '2023-12-22', NULL, '2023-11-22 17:55:06', '2023-11-22 17:55:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(769, '1700675592', 508162.19, 13767.094525, 494395.095475, 5012442.714525, '081700001025', 'ACTIVE', 'ACTIVE', '2024-01-21', NULL, '2023-11-22 17:55:06', '2023-11-22 17:55:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(770, '1700675592', 508162.19, 12531.106786312, 495631.08321369, 4516811.6313113, '081700001025', 'ACTIVE', 'ACTIVE', '2024-02-20', NULL, '2023-11-22 17:55:06', '2023-11-22 17:55:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(771, '1700675592', 508162.19, 11292.029078278, 496870.16092172, 4019941.4703896, '081700001025', 'ACTIVE', 'ACTIVE', '2024-03-21', NULL, '2023-11-22 17:55:06', '2023-11-22 17:55:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(772, '1700675592', 508162.19, 10049.853675974, 498112.33632403, 3521829.1340656, '081700001025', 'ACTIVE', 'ACTIVE', '2024-04-20', NULL, '2023-11-22 17:55:06', '2023-11-22 17:55:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(773, '1700675592', 508162.19, 8804.5728351639, 499357.61716484, 3022471.5169007, '081700001025', 'ACTIVE', 'ACTIVE', '2024-05-20', NULL, '2023-11-22 17:55:06', '2023-11-22 17:55:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(774, '1700675592', 508162.19, 7556.1787922518, 500606.01120775, 2521865.505693, '081700001025', 'ACTIVE', 'ACTIVE', '2024-06-19', NULL, '2023-11-22 17:55:06', '2023-11-22 17:55:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(775, '1700675592', 508162.19, 6304.6637642324, 501857.52623577, 2020007.9794572, '081700001025', 'ACTIVE', 'ACTIVE', '2024-07-19', NULL, '2023-11-22 17:55:06', '2023-11-22 17:55:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(776, '1700675592', 508162.19, 5050.019948643, 503112.17005136, 1516895.8094059, '081700001025', 'ACTIVE', 'ACTIVE', '2024-08-18', NULL, '2023-11-22 17:55:06', '2023-11-22 17:55:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(777, '1700675592', 508162.19, 3792.2395235146, 504369.95047649, 1012525.8589294, '081700001025', 'ACTIVE', 'ACTIVE', '2023-11-27', NULL, '2023-11-22 17:55:06', '2023-11-22 17:55:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(778, '1700675592', 508162.19, 2531.3146473234, 505630.87535268, 506894.98357669, '081700001025', 'ACTIVE', 'ACTIVE', '2024-10-17', NULL, '2023-11-22 17:55:06', '2023-11-22 17:55:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(779, '1700675592', 508162.22103563, 1267.2374589417, 506894.98357669, 0, '081700001025', 'ACTIVE', 'ACTIVE', '2024-11-16', NULL, '2023-11-22 17:55:06', '2023-11-22 17:55:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(780, '1701155555', 17769.76, 2000, 15769.76, 184230.24, NULL, 'ACTIVE', 'ACTIVE', '2023-12-28', NULL, '2023-11-28 07:13:22', '2023-11-28 07:13:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(781, '1701155555', 17769.76, 1842.3024, 15927.4576, 168302.7824, NULL, 'ACTIVE', 'ACTIVE', '2024-01-27', NULL, '2023-11-28 07:13:22', '2023-11-28 07:13:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(782, '1701155555', 17769.76, 1683.027824, 16086.732176, 152216.050224, NULL, 'ACTIVE', 'ACTIVE', '2024-02-26', NULL, '2023-11-28 07:13:22', '2023-11-28 07:13:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(783, '1701155555', 17769.76, 1522.16050224, 16247.59949776, 135968.45072624, NULL, 'ACTIVE', 'ACTIVE', '2024-03-27', NULL, '2023-11-28 07:13:22', '2023-11-28 07:13:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(784, '1701155555', 17769.76, 1359.6845072624, 16410.075492738, 119558.3752335, NULL, 'ACTIVE', 'ACTIVE', '2024-04-26', NULL, '2023-11-28 07:13:22', '2023-11-28 07:13:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(785, '1701155555', 17769.76, 1195.583752335, 16574.176247665, 102984.19898584, NULL, 'ACTIVE', 'ACTIVE', '2024-05-26', NULL, '2023-11-28 07:13:22', '2023-11-28 07:13:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(786, '1701155555', 17769.76, 1029.8419898584, 16739.918010142, 86244.280975696, NULL, 'ACTIVE', 'ACTIVE', '2024-06-25', NULL, '2023-11-28 07:13:22', '2023-11-28 07:13:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(787, '1701155555', 17769.76, 862.44280975696, 16907.317190243, 69336.963785453, NULL, 'ACTIVE', 'ACTIVE', '2024-07-25', NULL, '2023-11-28 07:13:22', '2023-11-28 07:13:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(788, '1701155555', 17769.76, 693.36963785453, 17076.390362145, 52260.573423307, NULL, 'ACTIVE', 'ACTIVE', '2024-08-24', NULL, '2023-11-28 07:13:22', '2023-11-28 07:13:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(789, '1701155555', 17769.76, 522.60573423307, 17247.154265767, 35013.41915754, NULL, 'ACTIVE', 'ACTIVE', '2024-09-23', NULL, '2023-11-28 07:13:22', '2023-11-28 07:13:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(790, '1701155555', 17769.76, 350.1341915754, 17419.625808425, 17593.793349116, NULL, 'ACTIVE', 'ACTIVE', '2024-10-23', NULL, '2023-11-28 07:13:22', '2023-11-28 07:13:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(791, '1701155555', 17769.731282607, 175.93793349116, 17593.793349116, 0, NULL, 'ACTIVE', 'ACTIVE', '2024-11-22', NULL, '2023-11-28 07:13:22', '2023-11-28 07:13:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(792, '1698755529', 13069.03, 1000, 12069.03, 87930.97, '081700001010', 'ACTIVE', 'ACTIVE', '2023-12-28', NULL, '2023-11-28 07:18:20', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(793, '1698755529', 13069.03, 879.3097, 12189.7203, 75741.2497, '081700001010', 'ACTIVE', 'ACTIVE', '2024-01-27', NULL, '2023-11-28 07:18:20', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(794, '1698755529', 13069.03, 757.412497, 12311.617503, 63429.632197, '081700001010', 'ACTIVE', 'ACTIVE', '2024-02-26', NULL, '2023-11-28 07:18:20', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(795, '1698755529', 13069.03, 634.29632197, 12434.73367803, 50994.89851897, '081700001010', 'ACTIVE', 'ACTIVE', '2024-03-27', NULL, '2023-11-28 07:18:20', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(796, '1698755529', 13069.03, 509.9489851897, 12559.08101481, 38435.81750416, '081700001010', 'ACTIVE', 'ACTIVE', '2024-04-26', NULL, '2023-11-28 07:18:20', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(797, '1698755529', 13069.03, 384.3581750416, 12684.671824958, 25751.145679201, '081700001010', 'ACTIVE', 'ACTIVE', '2024-05-26', NULL, '2023-11-28 07:18:20', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(798, '1698755529', 13069.03, 257.51145679201, 12811.518543208, 12939.627135993, '081700001010', 'ACTIVE', 'ACTIVE', '2024-06-25', NULL, '2023-11-28 07:18:20', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(799, '1698755529', 13069.023407353, 129.39627135993, 12939.627135993, 0, '081700001010', 'ACTIVE', 'ACTIVE', '2024-07-25', NULL, '2023-11-28 07:18:20', '2023-11-28 07:18:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(800, '1701155555', 17769.76, 2000, 15769.76, 184230.24, '081700001010', 'ACTIVE', 'ACTIVE', '2023-12-28', NULL, '2023-11-28 07:18:27', '2023-11-28 07:18:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(801, '1701155555', 17769.76, 1842.3024, 15927.4576, 168302.7824, '081700001010', 'ACTIVE', 'ACTIVE', '2024-01-27', NULL, '2023-11-28 07:18:27', '2023-11-28 07:18:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(802, '1701155555', 17769.76, 1683.027824, 16086.732176, 152216.050224, '081700001010', 'ACTIVE', 'ACTIVE', '2024-02-26', NULL, '2023-11-28 07:18:27', '2023-11-28 07:18:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(803, '1701155555', 17769.76, 1522.16050224, 16247.59949776, 135968.45072624, '081700001010', 'ACTIVE', 'ACTIVE', '2024-03-27', NULL, '2023-11-28 07:18:27', '2023-11-28 07:18:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(804, '1701155555', 17769.76, 1359.6845072624, 16410.075492738, 119558.3752335, '081700001010', 'ACTIVE', 'ACTIVE', '2024-04-26', NULL, '2023-11-28 07:18:27', '2023-11-28 07:18:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(805, '1701155555', 17769.76, 1195.583752335, 16574.176247665, 102984.19898584, '081700001010', 'ACTIVE', 'ACTIVE', '2024-05-26', NULL, '2023-11-28 07:18:27', '2023-11-28 07:18:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(806, '1701155555', 17769.76, 1029.8419898584, 16739.918010142, 86244.280975696, '081700001010', 'ACTIVE', 'ACTIVE', '2024-06-25', NULL, '2023-11-28 07:18:27', '2023-11-28 07:18:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(807, '1701155555', 17769.76, 862.44280975696, 16907.317190243, 69336.963785453, '081700001010', 'ACTIVE', 'ACTIVE', '2024-07-25', NULL, '2023-11-28 07:18:27', '2023-11-28 07:18:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(808, '1701155555', 17769.76, 693.36963785453, 17076.390362145, 52260.573423307, '081700001010', 'ACTIVE', 'ACTIVE', '2024-08-24', NULL, '2023-11-28 07:18:27', '2023-11-28 07:18:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(809, '1701155555', 17769.76, 522.60573423307, 17247.154265767, 35013.41915754, '081700001010', 'ACTIVE', 'ACTIVE', '2024-09-23', NULL, '2023-11-28 07:18:27', '2023-11-28 07:18:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(810, '1701155555', 17769.76, 350.1341915754, 17419.625808425, 17593.793349116, '081700001010', 'ACTIVE', 'ACTIVE', '2024-10-23', NULL, '2023-11-28 07:18:27', '2023-11-28 07:18:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(811, '1701155555', 17769.731282607, 175.93793349116, 17593.793349116, 0, '081700001010', 'ACTIVE', 'ACTIVE', '2024-11-22', NULL, '2023-11-28 07:18:27', '2023-11-28 07:18:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(812, '171', 25125.07, 166.67, 24958.4, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-03-16', NULL, '2025-03-15 21:00:00', '2025-03-15 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 50000, 25041.6),
(813, '171', 25125.07, 83.47, 25041.6, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-04-16', NULL, '2025-03-15 21:00:00', '2025-03-15 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 25041.6, 0),
(814, '171', 25125.07, 166.67, 24958.4, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-03-16', NULL, '2025-03-15 21:00:00', '2025-03-15 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 50000, 25041.6),
(815, '171', 25125.07, 83.47, 25041.6, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-04-16', NULL, '2025-03-15 21:00:00', '2025-03-15 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 25041.6, 0),
(816, '171', 25125.07, 166.67, 24958.4, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-03-16', NULL, '2025-03-15 21:00:00', '2025-03-15 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 50000, 25041.6),
(817, '171', 25125.07, 83.47, 25041.6, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-04-16', NULL, '2025-03-15 21:00:00', '2025-03-15 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 25041.6, 0),
(818, '171', 25125.07, 166.67, 24958.4, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-03-16', NULL, '2025-03-15 21:00:00', '2025-03-15 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 50000, 25041.6),
(819, '171', 25125.07, 83.47, 25041.6, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-04-16', NULL, '2025-03-15 21:00:00', '2025-03-15 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 25041.6, 0),
(820, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-04-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 2043240, 1983150),
(821, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-05-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1983150, 1923050),
(822, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-06-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1923050, 1862960),
(823, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-07-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1862960, 1802860),
(824, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-08-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1802860, 1742770),
(825, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-09-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1742770, 1682670),
(826, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-10-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1682670, 1622580),
(827, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-11-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1622580, 1562480),
(828, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-12-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1562480, 1502390),
(829, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-01-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1502390, 1442290),
(830, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-02-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1442290, 1382200),
(831, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-03-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1382200, 1322100),
(832, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-04-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1322100, 1262000),
(833, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-05-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1262000, 1201910),
(834, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-06-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1201910, 1141810),
(835, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-07-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1141810, 1081720),
(836, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-08-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1081720, 1021620),
(837, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-09-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1021620, 961527),
(838, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-10-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 961527, 901432),
(839, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-11-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 901432, 841336),
(840, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-12-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 841336, 781241),
(841, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-01-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 781241, 721145),
(842, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-02-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 721145, 661050),
(843, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-03-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 661050, 600954),
(844, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-04-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 600954, 540859),
(845, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-05-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 540859, 480764),
(846, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-06-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 480764, 420668),
(847, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-07-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 420668, 360573),
(848, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-08-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 360573, 300477),
(849, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-09-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 300477, 240382),
(850, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-10-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 240382, 180286),
(851, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-11-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 180286, 120191),
(852, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-12-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 120191, 60095.5),
(853, '189', 65203.55, 5108.11, 60095.44, NULL, NULL, 'ACTIVE', 'ACTIVE', '2028-01-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 60095.5, 0.04),
(854, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-04-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 10000000, 9705880),
(855, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-05-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 9705880, 9411760),
(856, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-06-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 9411760, 9117650),
(857, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-07-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 9117650, 8823530),
(858, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-08-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 8823530, 8529410),
(859, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-09-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 8529410, 8235290),
(860, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-10-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 8235290, 7941180),
(861, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-11-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 7941180, 7647060),
(862, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-12-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 7647060, 7352940),
(863, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-01-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 7352940, 7058820),
(864, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-02-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 7058820, 6764710),
(865, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-03-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 6764710, 6470590),
(866, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-04-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 6470590, 6176470),
(867, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-05-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 6176470, 5882350),
(868, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-06-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 5882350, 5588240),
(869, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-07-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 5588240, 5294120),
(870, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-08-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 5294120, 5000000),
(871, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-09-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 5000000, 4705880),
(872, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-10-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 4705880, 4411760),
(873, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-11-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 4411760, 4117650),
(874, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-12-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 4117650, 3823530),
(875, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-01-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 3823530, 3529410),
(876, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-02-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 3529410, 3235290),
(877, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-03-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 3235290, 2941180),
(878, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-04-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 2941180, 2647060),
(879, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-05-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 2647060, 2352940),
(880, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-06-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 2352940, 2058820),
(881, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-07-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 2058820, 1764710),
(882, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-08-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1764710, 1470590),
(883, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-09-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1470590, 1176470),
(884, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-10-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1176470, 882353),
(885, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-11-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 882353, 588235),
(886, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2027-12-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 588235, 294118),
(887, '190', 319117.65, 25000, 294117.65, NULL, NULL, 'ACTIVE', 'ACTIVE', '2028-01-13', NULL, '2025-04-12 21:00:00', '2025-04-12 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 294118, 0),
(888, '192', 5200000, 200000, 5000000, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-04-15', NULL, '2025-04-14 21:00:00', '2025-04-14 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 60000000, 55000000),
(889, '192', 5200000, 200000, 5000000, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-05-15', NULL, '2025-04-14 21:00:00', '2025-04-14 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 55000000, 50000000),
(890, '192', 5200000, 200000, 5000000, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-06-15', NULL, '2025-04-14 21:00:00', '2025-04-14 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 50000000, 45000000),
(891, '192', 5200000, 200000, 5000000, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-07-15', NULL, '2025-04-14 21:00:00', '2025-04-14 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 45000000, 40000000),
(892, '192', 5200000, 200000, 5000000, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-08-15', NULL, '2025-04-14 21:00:00', '2025-04-14 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 40000000, 35000000),
(893, '192', 5200000, 200000, 5000000, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-09-15', NULL, '2025-04-14 21:00:00', '2025-04-14 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 35000000, 30000000),
(894, '192', 5200000, 200000, 5000000, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-10-15', NULL, '2025-04-14 21:00:00', '2025-04-14 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 30000000, 25000000),
(895, '192', 5200000, 200000, 5000000, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-11-15', NULL, '2025-04-14 21:00:00', '2025-04-14 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 25000000, 20000000),
(896, '192', 5200000, 200000, 5000000, NULL, NULL, 'ACTIVE', 'ACTIVE', '2025-12-15', NULL, '2025-04-14 21:00:00', '2025-04-14 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 20000000, 15000000),
(897, '192', 5200000, 200000, 5000000, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-01-15', NULL, '2025-04-14 21:00:00', '2025-04-14 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 15000000, 10000000),
(898, '192', 5200000, 200000, 5000000, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-02-15', NULL, '2025-04-14 21:00:00', '2025-04-14 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 10000000, 5000000),
(899, '192', 5200000, 200000, 5000000, NULL, NULL, 'ACTIVE', 'ACTIVE', '2026-03-15', NULL, '2025-04-14 21:00:00', '2025-04-14 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 5000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loans_summary`
--

CREATE TABLE `loans_summary` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `installment` double DEFAULT NULL,
  `interest` double DEFAULT NULL,
  `principle` double DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `completion_status` varchar(255) DEFAULT NULL,
  `account_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans_summary`
--

INSERT INTO `loans_summary` (`id`, `loan_id`, `installment`, `interest`, `principle`, `balance`, `bank_account_number`, `completion_status`, `account_status`, `created_at`, `updated_at`) VALUES
(1, '1689752091', 10133.33, 133.33, 10000, 0, NULL, 'Active', 'Active', '2023-07-20 04:03:22', '2023-07-20 04:03:22'),
(2, '1688372500', 0, 0, 0, 0, NULL, 'Active', 'Active', '2023-07-20 04:20:57', '2023-07-20 04:20:57'),
(3, '1689752091', 10133.33, 133.33, 10000, 0, NULL, 'CLOSED', 'CLOSED', '2023-07-20 06:07:47', '2023-07-20 06:07:47'),
(4, '1689752091', 10133.33, 133.33, 10000, 0, NULL, 'CLOSED', 'CLOSED', '2023-07-20 06:08:53', '2023-07-20 06:08:53'),
(5, '1689752091', 10133.33, 133.33, 10000, 0, NULL, 'CLOSED', 'CLOSED', '2023-07-20 06:09:23', '2023-07-20 06:09:23'),
(6, '1689752091', 10133.33, 133.33, 10000, 0, NULL, 'CLOSED', 'CLOSED', '2023-07-20 06:09:53', '2023-07-20 06:09:53'),
(7, '1689752091', 10133.33, 133.33, 10000, 0, NULL, 'CLOSED', 'CLOSED', '2023-07-20 06:14:44', '2023-07-20 06:14:44'),
(8, '1689752091', 10133.33, 133.33, 10000, 0, NULL, 'CLOSED', 'CLOSED', '2023-07-20 06:15:21', '2023-07-20 06:15:21'),
(9, '1689850713', 4355081.1785643, 355081.17856431, 4000000, 0, '921673621', 'CLOSED', 'CLOSED', '2023-07-20 10:12:43', '2023-07-20 10:12:43'),
(10, '1689850713', 4355081.1785643, 355081.17856431, 4000000, 0, '921673621', 'CLOSED', 'CLOSED', '2023-07-20 10:13:15', '2023-07-20 10:13:15'),
(11, '1689850713', 4355081.1785643, 355081.17856431, 4000000, 0, '921673621', 'CLOSED', 'CLOSED', '2023-07-20 10:14:06', '2023-07-20 10:14:06'),
(12, '1691497401', 4107137.5944841, 107137.59448415, 4000000, 0, '921673621', 'CLOSED', 'CLOSED', '2023-08-08 09:37:50', '2023-08-08 09:37:50'),
(13, '1692790481', 6882557060.4154, 1882557060.4154, 5000000000, 0, '921673621', 'CLOSED', 'CLOSED', '2023-08-23 09:26:40', '2023-08-23 09:26:40'),
(14, '1692793558', 410713.7592877, 10713.759287704, 400000, 0, '921673621', 'CLOSED', 'CLOSED', '2023-08-23 09:28:02', '2023-08-23 09:28:02'),
(15, '1692793558', 410713.7592877, 10713.759287704, 400000, 0, '921673621', 'CLOSED', 'CLOSED', '2023-08-23 09:28:29', '2023-08-23 09:28:29'),
(16, '1692793558', 410713.7592877, 10713.759287704, 400000, 0, '921673621', 'CLOSED', 'CLOSED', '2023-08-23 09:30:40', '2023-08-23 09:30:40'),
(17, '1691410650', 10471817.030704, 471817.03070404, 10000000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-08-23 09:32:10', '2023-08-23 09:32:10'),
(18, '1694100884', 507512.4378, 7512.4378, 500000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-07 15:35:20', '2023-09-07 15:35:20'),
(19, '1695281446', 37451075.889352, 2451075.8893524, 35000000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-21 07:31:18', '2023-09-21 07:31:18'),
(20, '1695294388', 270774.93538899, 20774.935388988, 250000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-21 13:26:17', '2023-09-21 13:26:17'),
(21, '1695723205', 137418.46109882, 7418.4610988247, 130000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-26 10:13:43', '2023-09-26 10:13:43'),
(22, '1695725761', 395250, 55250, 340000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-26 10:56:49', '2023-09-26 10:56:49'),
(23, '1695736013', 119325, 8325, 111000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-26 13:49:54', '2023-09-26 13:49:54'),
(24, '1695737111', 156630.4294842, 6630.4294841969, 150000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-26 14:07:34', '2023-09-26 14:07:34'),
(25, '1695737906', 45562.5, 562.5, 45000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-26 14:18:38', '2023-09-26 14:18:38'),
(26, '1695739042', 249112.94365517, 19112.94365517, 230000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-26 14:37:35', '2023-09-26 14:37:35'),
(27, '1695739661', 216619.95175264, 16619.951752636, 200000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-26 14:47:51', '2023-09-26 14:47:51'),
(28, '1695742386', 345000, 45000, 300000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-26 15:33:25', '2023-09-26 15:33:25'),
(29, '1695763797', 146188.40123323, 6188.401233226, 140000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-26 21:30:41', '2023-09-26 21:30:41'),
(30, '1695763797', 146188.40123323, 6188.401233226, 140000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-26 21:33:43', '2023-09-26 21:33:43'),
(31, '1695764868', 131750, 7750, 124000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-26 21:47:59', '2023-09-26 21:47:59'),
(32, '1695796061', 235750, 5750, 230000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-27 06:27:52', '2023-09-27 06:27:52'),
(33, '1695796061', 235750, 5750, 230000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-27 06:28:10', '2023-09-27 06:28:10'),
(34, '1695796061', 235750, 5750, 230000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-27 06:32:22', '2023-09-27 06:32:22'),
(35, '1695802310', 147400, 13400, 134000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-27 08:12:06', '2023-09-27 08:12:06'),
(36, '1695802310', 147400, 13400, 134000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-27 08:27:25', '2023-09-27 08:27:25'),
(37, '1695806663', 133428.8722032, 6428.8722032018, 127000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-27 09:24:37', '2023-09-27 09:24:37'),
(38, '1695806663', 133428.8722032, 6428.8722032018, 127000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-27 09:27:22', '2023-09-27 09:27:22'),
(39, '1695806663', 133428.8722032, 6428.8722032018, 127000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-27 09:30:59', '2023-09-27 09:30:59'),
(40, '1695806663', 133428.8722032, 6428.8722032018, 127000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-27 09:33:16', '2023-09-27 09:33:16'),
(41, '1695807715', 108750, 8750, 100000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-27 09:42:07', '2023-09-27 09:42:07'),
(42, '1695905294', 3337500, 337500, 3000000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-28 12:48:51', '2023-09-28 12:48:51'),
(43, '1696001716', 114724.50209747, 3724.5020974696, 111000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-29 15:35:34', '2023-09-29 15:35:34'),
(44, '1696003014', 216000, 16000, 200000, 0, '921673621', 'ACTIVE', 'ACTIVE', '2023-09-29 15:57:21', '2023-09-29 15:57:21'),
(45, '1696334088', 145148.5572, 2148.5572, 143000, 0, '921673621', 'CLOSED', 'CLOSED', '2023-10-03 14:32:57', '2023-10-03 14:32:57'),
(46, '1696419133', 305527.45305663, 5527.4530566334, 300000, 0, '921673621', 'CLOSED', 'CLOSED', '2023-10-04 11:38:38', '2023-10-04 11:38:38'),
(47, '1696419133', 305527.45305663, 5527.4530566334, 300000, 0, '921673621', 'CLOSED', 'CLOSED', '2023-10-04 11:38:45', '2023-10-04 11:38:45'),
(48, '1696419133', 305527.45305663, 5527.4530566334, 300000, 0, '921673621', 'CLOSED', 'CLOSED', '2023-10-04 11:40:34', '2023-10-04 11:40:34'),
(49, '1696419133', 305527.45305663, 5527.4530566334, 300000, 0, '921673621', 'CLOSED', 'CLOSED', '2023-10-04 11:47:53', '2023-10-04 11:47:53'),
(50, '1696419133', 305527.45305663, 5527.4530566334, 300000, 0, '921673621', 'CLOSED', 'CLOSED', '2023-10-04 11:48:17', '2023-10-04 11:48:17'),
(51, '1696423712', 121605.32435885, 1605.324358851, 120000, 0, '081700001010', 'CLOSED', 'CLOSED', '2023-10-04 12:59:19', '2023-10-04 12:59:19'),
(52, '1696423712', 121605.32435885, 1605.324358851, 120000, 0, '081700001010', 'CLOSED', 'CLOSED', '2023-10-04 13:00:50', '2023-10-04 13:00:50'),
(53, '1696522015', 1010022.1850616, 10022.185061564, 1000000, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-05 16:18:15', '2023-10-05 16:18:15'),
(54, '1696843609', 125258.1865851, 1858.1865851029, 123400, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-09 09:46:08', '2023-10-09 09:46:08'),
(55, '1696843609', 0, 0, 0, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-09 09:49:30', '2023-10-09 09:49:30'),
(56, '1696843609', 0, 0, 0, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-09 09:50:21', '2023-10-09 09:50:21'),
(57, '1696843609', 0, 0, 0, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-09 09:52:25', '2023-10-09 09:52:25'),
(58, '1696843609', 0, 0, 0, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-09 09:53:10', '2023-10-09 09:53:10'),
(59, '1696843609', 0, 0, 0, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-09 09:54:41', '2023-10-09 09:54:41'),
(60, '1696843609', 0, 0, 0, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-09 09:55:03', '2023-10-09 09:55:03'),
(61, '1696847741', 437053.97659467, 5053.9765946744, 432000, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-09 10:42:33', '2023-10-09 10:42:33'),
(62, '1696848599', 101526.12431324, 1506.1243132423, 100020, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-09 10:53:15', '2023-10-09 10:53:15'),
(63, '1696073440', 23269.077437823, 269.07743782324, 23000, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-09 11:06:33', '2023-10-09 11:06:33'),
(64, '1696849827', 557357.73717266, 7357.73717266, 550000, 0, '081700001010', 'CLOSED', 'CLOSED', '2023-10-09 11:13:35', '2023-10-09 11:13:35'),
(65, '1696850305', 125315.02941481, 1859.0294148092, 123456, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-09 11:21:30', '2023-10-09 11:21:30'),
(66, '1696861240', 40602.329535815, 602.32953581466, 40000, 0, '081700001010', 'CLOSED', 'CLOSED', '2023-10-09 14:30:06', '2023-10-09 14:30:06'),
(67, '1696862114', 56843.260974308, 843.2609743079, 56000, 0, '081700001010', 'CLOSED', 'CLOSED', '2023-10-09 15:06:00', '2023-10-09 15:06:00'),
(68, '1696865436', 66772.135278198, 772.13527819833, 66000, 0, '081700001020', 'CLOSED', 'CLOSED', '2023-10-09 15:38:32', '2023-10-09 15:38:32'),
(69, '1696866487', 45753.328112483, 753.32811248276, 45000, 0, '081700001020', 'CLOSED', 'CLOSED', '2023-10-09 15:54:55', '2023-10-09 15:54:55'),
(70, '1696866487', 45753.328112483, 753.32811248276, 45000, 0, '081700001020', 'CLOSED', 'CLOSED', '2023-10-09 15:55:52', '2023-10-09 15:55:52'),
(71, '1696867186', 33441.464357062, 441.46435706194, 33000, 0, '081700001020', 'CLOSED', 'CLOSED', '2023-10-09 16:05:00', '2023-10-09 16:05:00'),
(72, '1696868181', 75114.309312404, 1114.3093124036, 74000, 0, '081700001020', 'CLOSED', 'CLOSED', '2023-10-09 16:23:39', '2023-10-09 16:23:39'),
(73, '1696003014', 202004.43694542, 2004.4369454236, 200000, 0, NULL, 'CLOSED', 'CLOSED', '2023-10-09 16:26:16', '2023-10-09 16:26:16'),
(74, '1696869910', 11147.154785687, 147.15478568731, 11000, 0, '081700001020', 'CLOSED', 'CLOSED', '2023-10-09 16:48:32', '2023-10-09 16:48:32'),
(75, '1696869910', 11147.154785687, 147.15478568731, 11000, 0, '081700001020', 'CLOSED', 'CLOSED', '2023-10-09 16:49:26', '2023-10-09 16:49:26'),
(76, '1696869910', 11147.154785687, 147.15478568731, 11000, 0, '081700001020', 'CLOSED', 'CLOSED', '2023-10-09 17:09:09', '2023-10-09 17:09:09'),
(77, '1696872712', 22331.281197719, 331.28119771898, 22000, 0, '081700001020', 'CLOSED', 'CLOSED', '2023-10-09 17:37:35', '2023-10-09 17:37:35'),
(78, '1696920301', 21316.222747918, 316.22274791777, 21000, 0, '081700001020', 'CLOSED', 'CLOSED', '2023-10-10 06:49:22', '2023-10-10 06:49:22'),
(79, '1696921461', 100158.20316841, 1158.2031684114, 99000, 0, '081700001020', 'CLOSED', 'CLOSED', '2023-10-10 07:12:23', '2023-10-10 07:12:23'),
(80, '1696936565', 89593.991533407, 593.99153340741, 89000, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-10 13:54:45', '2023-10-10 13:54:45'),
(81, '1696936565', 89593.991533407, 593.99153340741, 89000, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-10 13:57:13', '2023-10-10 13:57:13'),
(82, '1696931776', 55459.096029428, 459.09602942827, 55000, 0, '081700001010', 'CLOSED', 'CLOSED', '2023-10-10 14:03:49', '2023-10-10 14:03:49'),
(83, '1697036559', 35409.465578909, 409.46557890879, 35000, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-11 15:08:20', '2023-10-11 15:08:20'),
(84, '1697120184', 48481.064987302, 481.06498730232, 48000, 0, '081700001010', 'CLOSED', 'CLOSED', '2023-10-12 14:48:23', '2023-10-12 14:48:23'),
(85, '1697175309', 20066.666666667, 66.666666666667, 20000, 0, '081700001010', 'CLOSED', 'CLOSED', '2023-10-13 06:24:55', '2023-10-13 06:24:55'),
(86, '1697175654', 3010, 10, 3000, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-13 06:24:57', '2023-10-13 06:24:57'),
(87, '1697175741', 3065.3964871013, 65.39648710129, 3000, 0, '081700001010', 'CLOSED', 'CLOSED', '2023-10-13 06:27:06', '2023-10-13 06:27:06'),
(88, '1697177382', 30653.964871013, 653.9648710129, 30000, 0, '081700001010', 'CLOSED', 'CLOSED', '2023-10-13 06:27:58', '2023-10-13 06:27:58'),
(89, '1697387241', 204359.77025601, 4359.7702560102, 200000, 0, '081700001025', 'CLOSED', 'CLOSED', '2023-10-15 16:31:42', '2023-10-15 16:31:42'),
(90, '1697205677', 54813.145014287, 813.14501428702, 54000, 0, '081700001010', 'CLOSED', 'CLOSED', '2023-10-19 07:55:06', '2023-10-19 07:55:06'),
(91, '1697699767', 32481.863816568, 481.86381656804, 32000, 0, '081700001010', 'CLOSED', 'CLOSED', '2023-10-19 09:59:25', '2023-10-19 09:59:25'),
(92, '1698408439', 2043597.7003355, 43597.700335473, 2000000, 0, '081700001010', 'CLOSED', 'CLOSED', '2023-10-31 07:58:31', '2023-10-31 07:58:31'),
(93, '1699100510', 792733.0195528, 12733.019552804, 780000, 0, '081700001020', 'ACTIVE', 'ACTIVE', '2023-11-04 12:30:59', '2023-11-04 12:30:59'),
(94, '1699189643', 404009.98760047, 4009.9876004702, 400000, 0, '081700001020', 'ACTIVE', 'ACTIVE', '2023-11-05 16:24:08', '2023-11-05 16:24:08'),
(95, '1699205808', 606014.98113711, 6014.9811371088, 600000, 0, '081700001010', 'ACTIVE', 'ACTIVE', '2023-11-05 17:42:07', '2023-11-05 17:42:07'),
(96, '1699206567', 54135, 135, 54000, 0, '081700001010', 'ACTIVE', 'ACTIVE', '2023-11-05 17:57:48', '2023-11-05 17:57:48'),
(97, '1700481574', 836325.91966233, 43592.899662327, 792733.02, 0, NULL, 'ACTIVE', 'ACTIVE', '2023-11-20 12:00:19', '2023-11-20 12:00:19'),
(98, '1700482214', 926927.89466667, 90601.974666667, 836325.92, 0, NULL, 'ACTIVE', 'ACTIVE', '2023-11-20 12:10:59', '2023-11-20 12:10:59'),
(99, '1700484455', 508162.19244765, 8162.1924476507, 500000, 0, '081700001025', 'ACTIVE', 'ACTIVE', '2023-11-20 14:06:02', '2023-11-20 14:06:02'),
(100, '1700562619', 563213.09391667, 55050.903916667, 508162.19, 0, NULL, 'ACTIVE', 'ACTIVE', '2023-11-21 11:23:45', '2023-11-21 11:23:45'),
(101, '1700569371', 54541.0125, 406.0125, 54135, 0, NULL, 'ACTIVE', 'ACTIVE', '2023-11-21 12:23:46', '2023-11-21 12:23:46'),
(102, '1700569371', 54405.900281484, 270.90028148438, 54135, 0, '081700001010', 'ACTIVE', 'ACTIVE', '2023-11-21 12:33:06', '2023-11-21 12:33:06'),
(103, '1700570154', 105499.06395378, 5499.0639537816, 100000, 0, NULL, 'ACTIVE', 'ACTIVE', '2023-11-21 15:34:42', '2023-11-21 15:34:42'),
(104, '1700570154', 101632.43848953, 1632.4384895301, 100000, 0, '081700001010', 'ACTIVE', 'ACTIVE', '2023-11-21 15:37:23', '2023-11-21 15:37:23'),
(105, '1698755529', 105250, 5250, 100000, 0, NULL, 'ACTIVE', 'ACTIVE', '2023-11-21 17:14:13', '2023-11-21 17:14:13'),
(106, '1700592333', 3575977.3641422, 131977.36414223, 3444000, 0, NULL, 'ACTIVE', 'ACTIVE', '2023-11-21 18:47:57', '2023-11-21 18:47:57'),
(107, '1700592333', 3500221.1820453, 56221.18204529, 3444000, 0, '081700001025', 'ACTIVE', 'ACTIVE', '2023-11-21 18:49:31', '2023-11-21 18:49:31'),
(108, '1700675592', 6455000, 455000, 6000000, 0, NULL, 'ACTIVE', 'ACTIVE', '2023-11-22 17:54:19', '2023-11-22 17:54:19'),
(109, '1700675592', 6097946.3110356, 97946.311035636, 6000000, 0, '081700001025', 'ACTIVE', 'ACTIVE', '2023-11-22 17:55:06', '2023-11-22 17:55:06'),
(110, '1701155555', 213237.09128261, 13237.091282607, 200000, 0, NULL, 'ACTIVE', 'ACTIVE', '2023-11-28 07:13:22', '2023-11-28 07:13:22'),
(111, '1698755529', 104552.23340735, 4552.2334073532, 100000, 0, '081700001010', 'ACTIVE', 'ACTIVE', '2023-11-28 07:18:20', '2023-11-28 07:18:20'),
(112, '1701155555', 213237.09128261, 13237.091282607, 200000, 0, '081700001010', 'ACTIVE', 'ACTIVE', '2023-11-28 07:18:27', '2023-11-28 07:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `loan_images`
--

CREATE TABLE `loan_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `document_descriptions` varchar(100) DEFAULT NULL,
  `filename` varchar(1000) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_images`
--

INSERT INTO `loan_images` (`id`, `loan_id`, `category`, `document_descriptions`, `filename`, `url`, `created_at`, `updated_at`) VALUES
(55, '1695807715', 'add-document', '', 'Word doc', 'userfiles/ayj9kkRaqYRtHDqj5JGrxj92V5WdG9U2bW7Xkrdt.docx', '2023-09-29 06:16:35', '2023-09-29 06:16:35'),
(56, '1695807715', 'add-document', '', 'pdf form', 'userfiles/KVtfJ67jpul8DJpIJaljlwH237SzA1txVfDZhdYD.pdf', '2023-09-29 06:18:14', '2023-09-29 06:18:14'),
(57, '1695807715', 'add-document', '', 'basea sjfj dfkfjdffd fdlfd', 'userfiles/LnOfqDGf2oh6aUu809LJdPZp2XTXhoUpYWkkYTCs.docx', '2023-09-29 06:24:04', '2023-09-29 06:24:04'),
(58, '1695807715', 'add-document', '', 'uryereruiern rer', 'userfiles/ETO4JkcpnxJ0pAvbn7Pn6SxN8EVwCEZ4I7VoCZVk.docx', '2023-09-29 07:09:15', '2023-09-29 07:09:15'),
(59, '1695807715', 'add-document', '', 'files srr', 'userfiles/nwUan7gOHKTQkPmlvQCMR2jbdjbdbJw044qihCOA.docx', '2023-09-29 07:11:38', '2023-09-29 07:11:38'),
(60, '1696414390', 'add-document', '', 'sql files', 'userfiles/w0pdsLl55WMnNuSlE5GW2dW5GQfhNbXwGM9OM7ft.pdf', '2023-10-04 10:19:57', '2023-10-04 10:19:57'),
(65, '1698408439', 'add-document', 'My Job CV', '1698747509_Job CV.pdf', 'LoanDocument/1698747509_Job CV.pdf', '2023-10-31 10:18:29', '2023-10-31 10:18:29'),
(68, '1698408439', 'add-document', 'My birth certificate', '1698757173_File 1 (2).docx', 'LoanDocument/1698757173_File 1 (2).docx', '2023-10-31 12:59:33', '2023-10-31 12:59:33'),
(69, '1699189643', 'add-document', 'My CV', '1699201056_1698747509_Job CV.pdf', 'LoanDocument/1699201056_1698747509_Job CV.pdf', '2023-11-05 16:17:36', '2023-11-05 16:17:36'),
(70, '1700484455', 'add-document', 'document 1', '1700485371_Screenshot 2023-11-20 at 08.35.32.png', 'LoanDocument/1700485371_Screenshot 2023-11-20 at 08.35.32.png', '2023-11-20 13:02:51', '2023-11-20 13:02:51'),
(71, '1700483934', 'add-document', 'hello there', '1701097172_Loan processig user guide doc.docx', 'LoanDocument/1701097172_Loan processig user guide doc.docx', '2023-11-27 14:59:32', '2023-11-27 14:59:32'),
(72, '1700483934', 'add-document', 'cmghjkfjhjgjhgj', '1701099776_f01beb98-7292-493f-b2be-ec0672225b1e.JPG', 'LoanDocument/1701099776_f01beb98-7292-493f-b2be-ec0672225b1e.JPG', '2023-11-27 15:42:56', '2023-11-27 15:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `loan_officer_clients`
--

CREATE TABLE `loan_officer_clients` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `phone_number` bigint(20) DEFAULT NULL,
  `nida_no` bigint(20) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `loan_amount` int(11) DEFAULT NULL,
  `pay_in_days` int(11) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `days_left` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_sub_products`
--

CREATE TABLE `loan_sub_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_product_name` varchar(255) DEFAULT NULL,
  `sub_product_status` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `principle_min_value` double DEFAULT NULL,
  `principle_max_value` double DEFAULT NULL,
  `min_term` double DEFAULT NULL,
  `max_term` double DEFAULT NULL,
  `interest_value` int(11) DEFAULT NULL,
  `interest_tenure` int(11) DEFAULT NULL,
  `interest_method` varchar(255) DEFAULT NULL,
  `amortization_method` varchar(255) DEFAULT NULL,
  `repayment_strategy` varchar(255) DEFAULT NULL,
  `inactivity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `institution_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_sub_products`
--

INSERT INTO `loan_sub_products` (`id`, `sub_product_name`, `sub_product_status`, `currency`, `principle_min_value`, `principle_max_value`, `min_term`, `max_term`, `interest_value`, `interest_tenure`, `interest_method`, `amortization_method`, `repayment_strategy`, `inactivity`, `created_at`, `updated_at`, `institution_id`) VALUES
(1, 'BUSINESS LOANS', 'Pending', '1', 100000, 600000, NULL, NULL, 16, 12, 'flat', 'equal', NULL, NULL, '2023-07-02 11:14:48', '2023-11-20 09:09:31', '20'),
(2, 'SHEREHE LOANS', 'Pending', '1', 2000000, 5000000, 6, 12, 12, 12, 'declining', 'declining', NULL, 24, '2023-08-28 06:32:44', '2023-11-20 10:55:32', '20'),
(3, 'SCHOOL LOANS', 'Pending', '1', 250000, 800000, NULL, NULL, 15, 10, 'flat', 'equal', NULL, NULL, '2023-09-08 10:59:14', '2023-11-05 12:49:52', '20'),
(4, 'KUSAIDIANA LOANS', 'Pending', '1', 40000, 90000, 0, 0, NULL, 4, 'declining', 'declining', 'PICP', 24, '2023-10-02 09:35:03', '2023-11-05 12:50:53', '20'),
(6, 'MAENDELEO LOANS', 'Pending', NULL, 30000, 78000, 1, 5, 4, 2, 'declining', 'declining', NULL, 18, '2023-10-04 07:12:11', '2023-12-11 15:04:26', '20'),
(7, 'SALARY LOANS', 'Pending', NULL, 20000, 23000, 12000, 22000, 4, 5, 'flat', 'equal', 'PICP', 12, '2023-10-04 12:00:17', '2023-10-31 09:29:00', '20'),
(8, 'MORTGAGE/HOUSING LOANS', 'Pending', NULL, 40001, 200000, 3, 7, 12, 3, 'declining', 'declining', NULL, 24, '2023-10-31 09:32:17', '2023-11-24 12:41:50', '20'),
(9, 'VEHICLE LOANS', 'Pending', NULL, 23000, 120000, 4, 7, 5, 4, 'flat', 'declining', NULL, 24, '2023-10-31 09:34:30', '2023-11-01 08:29:55', '21'),
(10, 'PENSIONS FOR RETIRED PEOPLE', '1', NULL, 17000, 34000, 2, 7, 3, 6, 'declining', NULL, NULL, 24, '2023-10-31 09:36:47', '2023-10-31 09:36:47', '20'),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-24 11:48:01', '2023-11-24 11:48:01', '20'),
(12, 'HOUSING  demo', NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-24 11:48:28', '2023-11-24 11:48:28', NULL),
(13, 'HOUSING  demo', '1', NULL, 12, 12, 2, 3, 12, 12, 'declining', NULL, NULL, NULL, '2023-11-24 11:49:19', '2023-11-24 11:49:19', NULL),
(14, 'HOUSING  demo', 'ACTIVE', NULL, 12, 12, 2, 3, 12, 12, 'declining', NULL, NULL, NULL, '2023-11-24 11:49:26', '2023-11-24 11:49:39', NULL),
(15, 'demo product', 'Active', NULL, 200, 400000, 12, 24, 4, 2, 'reducing', NULL, 'daily', NULL, '2025-03-16 16:45:09', '2025-03-16 16:46:09', NULL),
(16, 'erjh', 'Inactive', NULL, 389, 8300, 832, 3298, 3, 237, 'flat', NULL, 'daily', NULL, '2025-04-10 03:54:57', '2025-04-10 03:54:57', NULL),
(17, 'MKOPO WA WASTAAFUew', 'Inactive', NULL, 3, 12, 2, 321, 1, 2, 'reducing', NULL, 'daily', NULL, '2025-04-12 07:37:03', '2025-04-12 07:37:03', NULL),
(18, 'CHEME LOANS -TASIWU34', 'Active', NULL, 2, 33, 34, 34553, 3, 344, 'flat', NULL, 'daily', NULL, '2025-04-12 07:48:33', '2025-04-12 07:48:33', NULL),
(19, 'MAISHA AGRI FINANCEerrcxvdc', 'Active', NULL, 2, 3423, 3, 34, 3, 34, 'flat', NULL, 'monthly', NULL, '2025-04-12 07:50:35', '2025-04-12 07:50:35', '1'),
(20, 'xxxxx', 'Active', NULL, 100, 100000, 1, 12, 4, 12, 'flat', NULL, 'monthly', NULL, '2025-04-15 05:30:39', '2025-04-15 05:30:39', '21'),
(21, 'MAISHA AGRI FINANCE', 'Active', NULL, 2000, 5000000, 12, 100, 12, 12, 'flat', NULL, 'monthly', NULL, '2025-09-09 01:53:32', '2025-09-09 01:53:32', '23');

-- --------------------------------------------------------

--
-- Table structure for table `makes`
--

CREATE TABLE `makes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `makes`
--

INSERT INTO `makes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(23, 'Seat', NULL, NULL),
(24, 'Renault', NULL, NULL),
(25, 'Peugeot', NULL, NULL),
(26, 'Dacia', NULL, NULL),
(27, 'Citroën', NULL, NULL),
(28, 'Opel', NULL, NULL),
(29, 'Alfa Romeo', NULL, NULL),
(30, 'Škoda', NULL, NULL),
(31, 'Chevrolet', NULL, NULL),
(32, 'Porsche', NULL, NULL),
(33, 'Honda', NULL, NULL),
(34, 'Subaru', NULL, NULL),
(35, 'Mazda', NULL, NULL),
(36, 'Mitsubishi', NULL, NULL),
(37, 'Lexus', NULL, NULL),
(38, 'Toyota', NULL, NULL),
(39, 'BMW', NULL, NULL),
(40, 'Volkswagen', NULL, NULL),
(41, 'Suzuki', NULL, NULL),
(42, 'Mercedes-Benz', NULL, NULL),
(43, 'Saab', NULL, NULL),
(44, 'Audi', NULL, NULL),
(45, 'Kia', NULL, NULL),
(46, 'Land Rover', NULL, NULL),
(47, 'Dodge', NULL, NULL),
(48, 'Chrysler', NULL, NULL),
(49, 'Ford', NULL, NULL),
(50, 'Hummer', NULL, NULL),
(51, 'Hyundai', NULL, NULL),
(52, 'Infiniti', NULL, NULL),
(53, 'Jaguar', NULL, NULL),
(54, 'Jeep', NULL, NULL),
(55, 'Nissan', NULL, NULL),
(56, 'Volvo', NULL, NULL),
(57, 'Daewoo', NULL, NULL),
(58, 'Fiat', NULL, NULL),
(59, 'MINI', NULL, NULL),
(60, 'Rover', NULL, NULL),
(61, 'Smart', NULL, NULL),
(62, 'Honda Test', '2025-05-04 17:21:16', '2025-05-04 17:21:16'),
(63, 'honda test two', '2025-05-04 17:22:43', '2025-05-04 17:22:43'),
(64, 'Honda Three', '2025-05-04 17:26:19', '2025-05-04 17:26:19'),
(65, 'Bentley', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(66, 'Rolls-Royce', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(67, 'Maserati', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(68, 'Ferrari', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(69, 'Lamborghini', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(70, 'Aston Martin', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(71, 'McLaren', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(72, 'Bugatti', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(73, 'Genesis', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(74, 'Acura', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(75, 'Lincoln', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(76, 'Cadillac', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(77, 'BYD', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(78, 'Geely', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(79, 'Great Wall', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(80, 'Chery', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(81, 'JAC', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(82, 'MG', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(83, 'Haval', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(84, 'Tata', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(85, 'Mahindra', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(86, 'Maruti Suzuki', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(87, 'SsangYong', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(88, 'Isuzu', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(89, 'Daihatsu', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(90, 'Lancia', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(91, 'Abarth', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(92, 'DS', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(93, 'Cupra', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(94, 'Buick', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(95, 'GMC', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(96, 'Ram', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(97, 'Tesla', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(98, 'Iveco', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(99, 'MAN', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(100, 'Scania', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(101, 'Volvo Trucks', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(102, 'Freightliner', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(103, 'Peterbilt', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(104, 'Kenworth', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(105, 'Innoson', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(106, 'Kiira', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(107, 'Mobius', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(108, 'Wallyscar', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(109, 'Proton', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(110, 'Perodua', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(111, 'UAZ', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(112, 'Lada', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(113, 'GAZ', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(114, 'ZAZ', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(115, 'Troller', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(116, 'Agrale', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(117, 'Marcopolo', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(118, 'Dongfeng', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(119, 'FAW', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(120, 'JMC', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(121, 'Lifan', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(122, 'Haima', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(123, 'Zotye', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(124, 'BAIC', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(125, 'Changan', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(126, 'GAC', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(127, 'SAIC', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(128, 'Trabant', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(129, 'Wartburg', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(130, 'Moskvich', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(131, 'Zastava', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(132, 'Hino', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(133, 'UD Trucks', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(134, 'Fuso', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(135, 'Tata Motors', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(136, 'Ashok Leyland', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(137, 'Eicher', '2025-09-07 21:36:32', '2025-09-07 21:36:32'),
(138, 'Force Motors', '2025-09-07 21:36:32', '2025-09-07 21:36:32');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` int(11) DEFAULT NULL,
  `menu_name` varchar(255) DEFAULT NULL,
  `menu_description` varchar(255) DEFAULT NULL,
  `menu_title` varchar(255) DEFAULT NULL,
  `menu_number` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `system_id`, `menu_name`, `menu_description`, `menu_title`, `menu_number`, `created_at`, `updated_at`) VALUES
(2, 1, 'Clients', 'Clients', 'Clients', 2, NULL, NULL),
(4, 1, 'Loans', 'Loans', 'Loans', 6, NULL, NULL),
(5, 1, 'Offers', 'Offers', 'Offers', 8, NULL, NULL),
(7, 1, 'Applications', 'Applications', 'Applications', 19, NULL, NULL),
(9, 1, 'Users', 'Users', 'Users', 50, NULL, NULL),
(10, 20, 'Product Management', 'Product Management', 'Product Management', 55, NULL, NULL),
(11, 21, 'Resources Management', 'Resources Management', 'Resources  Management', 55, NULL, NULL),
(12, 22, 'Partner Onboarding', 'Partner Onboarding', 'Partner Onboarding', 55, NULL, NULL),
(13, 22, 'Vehicle Management', 'Vehicle Management', 'Vehicle Management', 55, NULL, NULL),
(14, 22, 'Settings', 'Settings', 'Settings', 55, NULL, NULL),
(15, 23, 'Reports', 'Reports', 'Reports', 55, NULL, NULL),
(16, 24, 'Garage Management', 'Garage Management', 'Garage Management', 55, NULL, NULL),
(17, 24, 'Shop Onboarding', 'Shop Onboarding', 'Shop Onboarding', 55, NULL, NULL),
(18, 24, 'Spare Part Requests', 'Spare Part Requests', 'Spare Part Requests', 55, NULL, NULL),
(19, 24, 'User profile', 'User profile', 'User profile', 55, NULL, NULL),
(20, 24, 'CFC Management ', 'CFC Management ', 'CFC Management ', 55, NULL, NULL),
(21, 24, 'CFC Offers ', 'CFC Offers ', 'CFC Offers ', 55, NULL, NULL),
(22, 24, 'Import Duty Finance', 'Import Duty Finance', 'Import Duty Finance', 55, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus_`
--

CREATE TABLE `menus_` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` int(11) DEFAULT NULL,
  `menu_name` varchar(255) DEFAULT NULL,
  `menu_description` varchar(255) DEFAULT NULL,
  `menu_title` varchar(255) DEFAULT NULL,
  `menu_number` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_list`
--

CREATE TABLE `menu_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2022_12_03_070906_create_resource_logs_table', 1),
(4, '2023_07_01_101401_accounts', 1),
(5, '2023_07_01_101451_accounts_opened', 1),
(6, '2023_07_01_101533_accounts_running_balances', 1),
(7, '2023_07_01_101608_approvals', 1),
(8, '2023_07_01_102004_banks', 1),
(9, '2023_07_01_102034_branches', 1),
(10, '2023_07_01_102103_charges', 1),
(11, '2023_07_01_102140_currencies', 1),
(12, '2023_07_01_102210_departments', 1),
(13, '2023_07_01_102321_failed_jobs', 1),
(14, '2023_07_01_102411_general_ledger', 1),
(15, '2023_07_01_102544_institutions', 1),
(16, '2023_07_01_102840_issured_shares', 1),
(17, '2023_07_01_102919_loan_images', 1),
(18, '2023_07_01_102951_loan_sub_products', 1),
(19, '2023_07_01_103025_loans', 1),
(20, '2023_07_01_103113_loans_arreas', 1),
(21, '2023_07_01_103142_loans_originated', 1),
(22, '2023_07_01_103211_loans_schedules', 1),
(23, '2023_07_01_103459_loans_summary', 1),
(24, '2023_07_01_103542_members', 1),
(25, '2023_07_01_103614_menu_list', 1),
(26, '2023_07_01_103639_menus', 1),
(27, '2023_07_01_103908_menus_', 1),
(28, '2023_07_01_104017_orders', 1),
(29, '2023_07_01_104058_password_resets', 1),
(30, '2023_07_01_104201_sessions', 1),
(31, '2023_07_01_104352_sub_menus', 1),
(32, '2023_07_01_104414_sub_menus_', 1),
(33, '2023_07_01_104454_sub_products', 1),
(34, '2023_07_01_104549_team_invitations', 1),
(35, '2023_07_01_104805_team_user', 1),
(36, '2023_07_01_104832_teams', 1),
(37, '2023_07_01_105009_transactions', 1),
(38, '2023_07_01_105050_user_sub_menus', 1),
(39, '2023_07_01_113345_temp_permissions', 1),
(40, '2014_10_12_100000_create_password_resets_table', 2),
(41, '2014_10_12_200000_add_two_factor_columns_to_users_table', 2),
(42, '2019_08_19_000000_create_failed_jobs_table', 2),
(43, '2022_03_23_163443_create_sessions_table', 2),
(44, '2022_05_11_154250_create_datafeeds_table', 2),
(45, '2023_07_20_204539_expenses', 2),
(46, '2023_10_06_105631_create_employeefiles_table', 3),
(47, '2023_10_06_130528_create_employeefiles_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `principle` varchar(255) DEFAULT NULL,
  `interest` varchar(50) DEFAULT NULL,
  `tenure` varchar(50) DEFAULT NULL,
  `make_and_model` varchar(255) DEFAULT NULL,
  `purchase_price` varchar(255) DEFAULT NULL,
  `schedule` text DEFAULT NULL,
  `offer_status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `loan_id`, `principle`, `interest`, `tenure`, `make_and_model`, `purchase_price`, `schedule`, `offer_status`, `created_at`, `updated_at`) VALUES
(2, '167', '35000000', NULL, NULL, 'NISSAN', '45000000', '[{\"Payment\":\"3028436.11\",\"Interest\":204166.6666666667,\"Principle\":2824269.4433333334,\"balance\":32175730.556666665},{\"Payment\":\"3028436.11\",\"Interest\":187691.76158055555,\"Principle\":2840744.348419444,\"balance\":29334986.208247222},{\"Payment\":\"3028436.11\",\"Interest\":171120.7528814421,\"Principle\":2857315.3571185577,\"balance\":26477670.851128664},{\"Payment\":\"3028436.11\",\"Interest\":154453.0799649172,\"Principle\":2873983.0300350827,\"balance\":23603687.82109358},{\"Payment\":\"3028436.11\",\"Interest\":137688.17895637924,\"Principle\":2890747.9310436207,\"balance\":20712939.89004996},{\"Payment\":\"3028436.11\",\"Interest\":120825.48269195812,\"Principle\":2907610.627308042,\"balance\":17805329.26274192},{\"Payment\":\"3028436.11\",\"Interest\":103864.42069932786,\"Principle\":2924571.689300672,\"balance\":14880757.573441248},{\"Payment\":\"3028436.11\",\"Interest\":86804.41917840729,\"Principle\":2941631.6908215927,\"balance\":11939125.882619657},{\"Payment\":\"3028436.11\",\"Interest\":69644.900981948,\"Principle\":2958791.209018052,\"balance\":8980334.673601605},{\"Payment\":\"3028436.11\",\"Interest\":52385.285596009366,\"Principle\":2976050.8244039905,\"balance\":6004283.849197615},{\"Payment\":\"3028436.11\",\"Interest\":35024.98912031942,\"Principle\":2993411.1208796804,\"balance\":3010872.7283179346},{\"Payment\":3028436.152566456,\"Interest\":17563.424248521285,\"Principle\":3010872.7283179346,\"balance\":0}]', 'DECLINED', NULL, NULL),
(3, '167', '35000000', NULL, NULL, 'NISSAN', '45000000', '[{\"Payment\":\"5953007.81\",\"Interest\":204166.6666666667,\"Principle\":5748841.143333333,\"balance\":29251158.85666667},{\"Payment\":\"5953007.81\",\"Interest\":170631.75999722222,\"Principle\":5782376.050002777,\"balance\":23468782.806663893},{\"Payment\":\"5953007.81\",\"Interest\":136901.2330388727,\"Principle\":5816106.576961127,\"balance\":17652676.229702767},{\"Payment\":\"5953007.81\",\"Interest\":102973.94467326615,\"Principle\":5850033.865326733,\"balance\":11802642.364376035},{\"Payment\":\"5953007.81\",\"Interest\":68848.74712552688,\"Principle\":5884159.062874473,\"balance\":5918483.301501562},{\"Payment\":5953007.787426988,\"Interest\":34524.48592542578,\"Principle\":5918483.301501562,\"balance\":0}]', 'DECLINED', NULL, NULL),
(4, '167', '10000000', '12', '6', 'NISSAN', '45000000', '[{\"Payment\":\"1725483.67\",\"Interest\":100000,\"Principle\":1625483.67,\"balance\":8374516.33},{\"Payment\":\"1725483.67\",\"Interest\":83745.1633,\"Principle\":1641738.5067,\"balance\":6732777.8233},{\"Payment\":\"1725483.67\",\"Interest\":67327.778233,\"Principle\":1658155.8917669998,\"balance\":5074621.931533},{\"Payment\":\"1725483.67\",\"Interest\":50746.21931533,\"Principle\":1674737.45068467,\"balance\":3399884.4808483305},{\"Payment\":\"1725483.67\",\"Interest\":33998.84480848331,\"Principle\":1691484.8251915167,\"balance\":1708399.6556568139},{\"Payment\":1725483.652213382,\"Interest\":17083.996556568138,\"Principle\":1708399.6556568139,\"balance\":0}]', 'ACCEPTED', NULL, NULL),
(5, '167', '35000000', '12', '12', 'NISSAN', '45000000', '[{\"Payment\":\"3109707.60\",\"Interest\":350000,\"Principle\":2759707.6,\"balance\":32240292.4},{\"Payment\":\"3109707.60\",\"Interest\":322402.924,\"Principle\":2787304.676,\"balance\":29452987.724},{\"Payment\":\"3109707.60\",\"Interest\":294529.87724,\"Principle\":2815177.7227600003,\"balance\":26637810.00124},{\"Payment\":\"3109707.60\",\"Interest\":266378.1000124,\"Principle\":2843329.4999876,\"balance\":23794480.5012524},{\"Payment\":\"3109707.60\",\"Interest\":237944.805012524,\"Principle\":2871762.794987476,\"balance\":20922717.706264924},{\"Payment\":\"3109707.60\",\"Interest\":209227.17706264925,\"Principle\":2900480.422937351,\"balance\":18022237.283327572},{\"Payment\":\"3109707.60\",\"Interest\":180222.37283327573,\"Principle\":2929485.2271667244,\"balance\":15092752.056160849},{\"Payment\":\"3109707.60\",\"Interest\":150927.5205616085,\"Principle\":2958780.0794383916,\"balance\":12133971.976722457},{\"Payment\":\"3109707.60\",\"Interest\":121339.71976722457,\"Principle\":2988367.8802327756,\"balance\":9145604.09648968},{\"Payment\":\"3109707.60\",\"Interest\":91456.0409648968,\"Principle\":3018251.5590351033,\"balance\":6127352.537454577},{\"Payment\":\"3109707.60\",\"Interest\":61273.525374545774,\"Principle\":3048434.0746254544,\"balance\":3078918.462829123},{\"Payment\":3109707.647457414,\"Interest\":30789.184628291227,\"Principle\":3078918.462829123,\"balance\":0}]', 'ACCEPTED', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `order_failed_transaction` varchar(255) DEFAULT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `source_account` varchar(255) DEFAULT NULL,
  `amountOfTransactions` varchar(255) DEFAULT NULL,
  `typeOfTransfer` varchar(255) DEFAULT NULL,
  `first_authorizer_id` varchar(255) DEFAULT NULL,
  `first_authorizer_action` varchar(255) NOT NULL,
  `first_authorizer_comments` text DEFAULT NULL,
  `second_authorizer_id` varchar(255) DEFAULT NULL,
  `second_authorizer_action` varchar(255) NOT NULL,
  `second_authorizer_comments` text DEFAULT NULL,
  `third_authorizer_id` varchar(255) DEFAULT NULL,
  `third_authorizer_action` varchar(255) NOT NULL,
  `third_authorizer_comments` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `team_id`, `user_id`, `order_number`, `order_status`, `order_failed_transaction`, `completed`, `source_account`, `amountOfTransactions`, `typeOfTransfer`, `first_authorizer_id`, `first_authorizer_action`, `first_authorizer_comments`, `second_authorizer_id`, `second_authorizer_action`, `second_authorizer_comments`, `third_authorizer_id`, `third_authorizer_action`, `third_authorizer_comments`, `created_at`, `updated_at`) VALUES
(1, '', '24', '095978', NULL, NULL, 0, '9864321975', 'Single Transaction', 'IFT', NULL, '12', NULL, NULL, '2332', NULL, NULL, '234', NULL, '2023-08-02 05:29:48', '2023-08-02 05:29:48'),
(2, '', '24', '289659', NULL, NULL, 0, '9864321975', 'Single Transaction', 'IFT', NULL, '12', NULL, NULL, '2332', NULL, NULL, '234', NULL, '2023-08-02 05:30:43', '2023-08-02 05:30:43'),
(3, '', '24', '428310', NULL, NULL, 0, '9864321975', 'Single Transaction', 'IFT', NULL, '12', NULL, NULL, '2332', NULL, NULL, '234', NULL, '2023-08-02 05:31:31', '2023-08-02 05:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `partner_documents`
--

CREATE TABLE `partner_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `partner_id` bigint(20) UNSIGNED NOT NULL,
  `partner_type` enum('lender','car_dealer') NOT NULL,
  `document_type` varchar(100) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  `mime_type` varchar(100) NOT NULL,
  `status` enum('PENDING','VERIFIED','REJECTED') NOT NULL DEFAULT 'PENDING',
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partner_documents`
--

INSERT INTO `partner_documents` (`id`, `partner_id`, `partner_type`, `document_type`, `file_path`, `file_name`, `file_size`, `mime_type`, `status`, `uploaded_at`, `updated_at`, `created_at`) VALUES
(1, 18, 'lender', 'business_registration', 'documents/lender/18/wkni8HqihHK128FtIVTx0ntiD5qXg8dU0Jw15qQP.png', 'Screenshot 2025-04-07 at 11.02.48.png', 139651, 'image/png', 'PENDING', '2025-04-13 06:25:50', '2025-04-13 03:25:50', '2025-04-13 06:25:50'),
(2, 18, 'lender', 'tax_clearance', 'documents/lender/18/aWikqO9pdOfsuVGNFZvO1c8s0FVc2hZ1iTO5dWpA.png', 'Screenshot 2025-04-08 at 20.22.44.png', 126724, 'image/png', 'PENDING', '2025-04-13 06:25:50', '2025-04-13 03:25:50', '2025-04-13 06:25:50'),
(3, 18, 'lender', 'financial_license', 'documents/lender/18/IyvoD1d0zDA8u5aO1spk8ehnkHpxAo9RsC20efNV.png', 'Screenshot 2025-04-09 at 14.01.46.png', 95259, 'image/png', 'PENDING', '2025-04-13 06:25:50', '2025-04-13 03:25:50', '2025-04-13 06:25:50'),
(4, 19, 'lender', 'business_registration', 'documents/lender/19/ST91Jwo5W4F1pvINcEdvC45pXWXXhFxz5HtACS51.png', 'Screenshot 2025-04-07 at 18.45.43.png', 271712, 'image/png', 'PENDING', '2025-04-14 07:58:34', '2025-04-14 04:58:34', '2025-04-14 07:58:34'),
(5, 19, 'lender', 'tax_clearance', 'documents/lender/19/z5vopr3fwb3q6aKdky7ukWiityUU8zVSHM3NHS9h.png', 'Screenshot 2025-04-08 at 16.34.51.png', 321474, 'image/png', 'PENDING', '2025-04-14 07:58:34', '2025-04-14 04:58:34', '2025-04-14 07:58:34'),
(6, 19, 'lender', 'financial_license', 'documents/lender/19/VJfOG3Cu7rSZ1Cp8ckYGlxIHwDRbm4r2sEAeyne9.png', 'Screenshot 2025-04-06 at 14.09.38.png', 844272, 'image/png', 'PENDING', '2025-04-14 07:58:34', '2025-04-14 04:58:34', '2025-04-14 07:58:34'),
(7, 20, 'lender', 'business_registration', 'documents/lender/20/itIXqWVCBH4n0i3iLilRfFlNXZmqHrHslBe11TKt.png', 'Screenshot 2025-04-08 at 14.27.23.png', 175637, 'image/png', 'PENDING', '2025-04-14 08:13:56', '2025-04-14 05:13:56', '2025-04-14 08:13:56'),
(8, 20, 'lender', 'tax_clearance', 'documents/lender/20/0qOJXcyDW0Ku6jarIsc3zjYSH03inY87G97K6IdO.png', 'Screenshot 2025-04-08 at 20.22.44.png', 126724, 'image/png', 'PENDING', '2025-04-14 08:13:56', '2025-04-14 05:13:56', '2025-04-14 08:13:56'),
(9, 20, 'lender', 'financial_license', 'documents/lender/20/Mml6gZTj8QFNSjovTB31j0QY93b57VhOLPisnJYW.png', 'Screenshot 2025-04-08 at 14.26.29.png', 185943, 'image/png', 'PENDING', '2025-04-14 08:13:56', '2025-04-14 05:13:56', '2025-04-14 08:13:56'),
(10, 21, 'lender', 'business_registration', 'documents/lender/21/spTq2dtHkUNZ2vy1zhCcF2mvmQqCb5b0UBjux67l.png', 'Screenshot 2025-04-08 at 16.34.51.png', 321474, 'image/png', 'PENDING', '2025-04-15 08:26:01', '2025-04-15 05:26:01', '2025-04-15 08:26:01'),
(11, 21, 'lender', 'tax_clearance', 'documents/lender/21/otn9fCil0ELqTS2Ut30WUuhsJ6MbTRDmtGcUCS4K.png', 'Screenshot 2025-04-08 at 16.34.51.png', 321474, 'image/png', 'PENDING', '2025-04-15 08:26:01', '2025-04-15 05:26:01', '2025-04-15 08:26:01'),
(12, 21, 'lender', 'financial_license', 'documents/lender/21/y9irlLxyyiekl8vfrOWwGzzOIABG3Odv0z9Td2Tm.png', 'Screenshot 2025-04-08 at 20.22.44.png', 126724, 'image/png', 'PENDING', '2025-04-15 08:26:01', '2025-04-15 05:26:01', '2025-04-15 08:26:01'),
(13, 22, 'lender', 'business_registration', 'documents/lender/22/NyTPTNqpZIieb8a9yvmTQPQSXmPwgKEB0mF4DRlP.pdf', 'Security Assessment Report_ staging.inaya.io.pdf', 366744, 'application/pdf', 'PENDING', '2025-05-06 14:48:40', '2025-05-06 11:48:40', '2025-05-06 14:48:40'),
(14, 22, 'lender', 'tax_clearance', 'documents/lender/22/X4tw9nKJ9IfH0psKpA602LhCmcdsP5qFn2vhazrv.png', 'Image-1.png', 437037, 'image/png', 'PENDING', '2025-05-06 14:48:40', '2025-05-06 11:48:40', '2025-05-06 14:48:40'),
(15, 22, 'lender', 'financial_license', 'documents/lender/22/HkHSrNJhmw0Zvp5m1Kd8KI0EYj9hX1RWpudZfB1o.png', 'Image-1.png', 437037, 'image/png', 'PENDING', '2025-05-06 14:48:40', '2025-05-06 11:48:40', '2025-05-06 14:48:40'),
(16, 18, 'car_dealer', 'business_registration', 'documents/car_dealer/18/kcn8DuZYi4gMXM9LYCkIoI9CCmacHtZatFdr5QA9.pdf', 'bill-BILL-2025-0002 (2).pdf', 4369, 'application/pdf', 'PENDING', '2025-07-22 09:10:28', '2025-07-22 06:10:28', '2025-07-22 09:10:28'),
(17, 18, 'car_dealer', 'tax_clearance', 'documents/car_dealer/18/t061y73lO3CIkFK8ifJIyIczi9ZpNSAPqB75jZ52.pdf', 'bill-BILL-2025-0002 (2).pdf', 4369, 'application/pdf', 'PENDING', '2025-07-22 09:10:28', '2025-07-22 06:10:28', '2025-07-22 09:10:28'),
(18, 20, 'car_dealer', 'business_registration', 'documents/car_dealer/20/68ZRBNwxbnphh13zT5HSh19I6Rd3fkmJR2kpcrF7.jpg', 'brandmark-design.jpg', 402166, 'image/jpeg', 'PENDING', '2025-09-08 20:38:12', '2025-09-08 17:38:12', '2025-09-08 20:38:12'),
(19, 20, 'car_dealer', 'tax_clearance', 'documents/car_dealer/20/3ThJT2pJGOiDuHuYBbViYcVtqsVGVznsgmZYEie3.png', 'brandmark-design-1024x0.png', 93442, 'image/png', 'PENDING', '2025-09-08 20:38:12', '2025-09-08 17:38:12', '2025-09-08 20:38:12'),
(20, 20, 'car_dealer', 'business_registration', 'documents/car_dealer/20/IQGBmABwQ3Xybhb6a6YZ6YK81sBrGJvpSS8u91aB.pdf', 'Black and White Simple Professional CV Resume.pdf', 224126, 'application/pdf', 'PENDING', '2025-09-08 21:49:54', '2025-09-08 18:49:54', '2025-09-08 21:49:54'),
(21, 20, 'car_dealer', 'tax_clearance', 'documents/car_dealer/20/SxaPXMk5klncECAaOBuvQFn4F5miGXUOTPHh6xnu.png', 'Chat bot-amico.png', 364144, 'image/png', 'PENDING', '2025-09-08 21:49:54', '2025-09-08 18:49:54', '2025-09-08 21:49:54'),
(22, 20, 'car_dealer', 'business_registration', 'documents/car_dealer/20/IkiTpaxAlCUaRhbPCUzgk9RdZq9AcjUPsIc5Vkk9.pdf', 'Black and White Simple Professional CV Resume (1).pdf', 258693, 'application/pdf', 'PENDING', '2025-09-08 22:01:12', '2025-09-08 19:01:12', '2025-09-08 22:01:12'),
(23, 20, 'car_dealer', 'tax_clearance', 'documents/car_dealer/20/p1FtRq2Qd9Ka5RLohvjdxI4w53EIQi0El0SYBIfO.pdf', 'Black and White Simple Professional CV Resume (1).pdf', 258693, 'application/pdf', 'PENDING', '2025-09-08 22:01:12', '2025-09-08 19:01:12', '2025-09-08 22:01:12'),
(24, 23, 'lender', 'business_registration', 'documents/lender/23/MyLLwL2S0kmU20Z8uFsB1Jy7k5fZoHXXTNt378mx.png', 'Screenshot 2025-09-09 at 07.08.21.png', 1175933, 'image/png', 'PENDING', '2025-09-09 04:37:39', '2025-09-09 01:37:39', '2025-09-09 04:37:39'),
(25, 23, 'lender', 'tax_clearance', 'documents/lender/23/zMipITCnb7ZHPKNMVb4T2EQUzorwOTcMkUVAVuF6.png', 'Screenshot 2025-09-09 at 07.07.54.png', 1147129, 'image/png', 'PENDING', '2025-09-09 04:37:39', '2025-09-09 01:37:39', '2025-09-09 04:37:39'),
(26, 23, 'lender', 'financial_license', 'documents/lender/23/ILFOEzPbeD0mFVdvNAAxBD47e4g6SZyEax5DAl0a.png', 'Screenshot 2025-09-02 at 00.26.48.png', 723506, 'image/png', 'PENDING', '2025-09-09 04:37:39', '2025-09-09 01:37:39', '2025-09-09 04:37:39'),
(27, 23, 'lender', 'additional', 'documents/lender/23/DezFW26xJFxHgt1yS2iC0AQEv065oc3CYNOfe1sY.png', 'Screenshot 2025-09-09 at 07.08.21.png', 1175933, 'image/png', 'PENDING', '2025-09-09 04:37:39', '2025-09-09 01:37:39', '2025-09-09 04:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_policies`
--

CREATE TABLE `password_policies` (
  `id` int(11) NOT NULL,
  `requireSpecialCharacter` tinyint(1) NOT NULL,
  `length` varchar(10) NOT NULL,
  `requireUppercase` tinyint(1) NOT NULL,
  `requireNumeric` tinyint(1) NOT NULL,
  `limiter` int(11) NOT NULL,
  `passwordExpire` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_policies`
--

INSERT INTO `password_policies` (`id`, `requireSpecialCharacter`, `length`, `requireUppercase`, `requireNumeric`, `limiter`, `passwordExpire`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '8', 1, 1, 5, 900, 'PENDING', '2023-10-09 23:05:05', '2023-10-09 23:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `payment_number` varchar(50) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `currency` varchar(3) DEFAULT 'TZS',
  `payment_method` varchar(50) NOT NULL,
  `payment_reference` varchar(100) DEFAULT NULL,
  `payment_date` date NOT NULL,
  `status` enum('pending','completed','failed','refunded') DEFAULT 'pending',
  `processed_by` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `receipt_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `bill_id`, `payment_number`, `amount`, `currency`, `payment_method`, `payment_reference`, `payment_date`, `status`, `processed_by`, `notes`, `receipt_url`, `created_at`, `updated_at`) VALUES
(1, 3, 'PAY-2025-0001', 6000.00, 'TZS', 'cash', 'juma locole', '2025-06-24', 'completed', 'ADMIN', 'no', NULL, '2025-06-24 05:36:23', '2025-06-24 05:36:23'),
(2, 3, 'PAY-2025-0002', 8000.00, 'TZS', 'mobile_money', '8998777', '2025-06-24', 'completed', 'ADMIN', 'optional', NULL, '2025-06-24 05:43:19', '2025-06-24 05:43:19'),
(3, 3, 'PAY-2025-0003', 10400.00, 'TZS', 'check', '997778', '2025-06-24', 'completed', 'ADMIN', '', NULL, '2025-06-24 05:43:55', '2025-06-24 05:43:55'),
(4, 3, 'PAY-2025-0004', 11000.00, 'TZS', 'check', 'ygiyu787', '2025-06-24', 'completed', 'ADMIN', '', NULL, '2025-06-24 05:44:10', '2025-06-24 05:44:10'),
(5, 3, 'PAY-2025-0005', 70600.00, 'TZS', 'cash', '7689076', '2025-06-24', 'completed', 'ADMIN', '', NULL, '2025-06-24 05:45:07', '2025-06-24 05:45:07'),
(6, 2, 'PAY-2025-0006', 11800.00, 'TZS', 'cash', '455776644', '2025-06-24', 'completed', 'ADMIN', 'payment received', NULL, '2025-06-24 07:12:22', '2025-06-24 07:12:22'),
(7, 5, 'PAY-2025-0007', 35400.00, 'TZS', 'cash', '788766', '2025-06-24', 'completed', 'ADMIN', 'THANKS', NULL, '2025-06-24 07:49:43', '2025-06-24 07:49:43'),
(8, 2, 'PAY-2025-0008', 106200.00, 'TZS', 'cash', '500', '2025-07-21', 'completed', 'ADMIN', '', NULL, '2025-07-21 09:29:09', '2025-07-21 09:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`) VALUES
(1, 'internal funds transfer'),
(2, 'external funds transfer'),
(3, 'TIC'),
(4, 'mobile payment');

-- --------------------------------------------------------

--
-- Table structure for table `pending_registrations`
--

CREATE TABLE `pending_registrations` (
  `id` int(11) NOT NULL,
  `reference_number` varchar(30) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `account_id` varchar(40) DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_registrations`
--

INSERT INTO `pending_registrations` (`id`, `reference_number`, `amount`, `account_id`, `branch_id`, `phone_number`, `created_at`, `updated_at`, `status`) VALUES
(1, '1234', NULL, '9864321975', 17, 'NE200012347602', '2023-08-05 14:46:42', '2023-08-05 14:46:42', NULL),
(2, '1234', NULL, '9864321975', 17, 'NE200012349532', '2023-08-05 15:18:52', '2023-08-05 15:18:52', NULL),
(3, '1234', NULL, '9864321975', 17, 'NE200012349571', '2023-08-05 15:19:31', '2023-08-05 15:19:31', NULL),
(4, '1234', NULL, '9864321975', 17, 'NE200012349589', '2023-08-05 15:19:49', '2023-08-05 15:19:49', NULL),
(5, '1234', NULL, '9864321975', 17, 'NE200012349621', '2023-08-05 15:20:21', '2023-08-05 15:20:21', NULL),
(6, '1234', NULL, '9864321975', 17, 'NE200012349666', '2023-08-05 15:21:06', '2023-08-05 15:21:06', NULL),
(7, '1234', NULL, '9864321975', 17, 'NE200012349740', '2023-08-05 15:22:20', '2023-08-05 15:22:20', NULL),
(8, '1234', NULL, '9864321975', 17, 'NE200012349782', '2023-08-05 15:23:02', '2023-08-05 15:23:02', NULL),
(9, '1234', NULL, '9864321975', 17, 'NE200012349844', '2023-08-05 15:24:04', '2023-08-05 15:24:04', NULL),
(10, '1234', NULL, '9864321975', 17, 'NE200012340156', '2023-08-05 15:29:16', '2023-08-05 15:29:16', NULL),
(11, '1234', NULL, '9864321975', 17, 'NE200012340189', '2023-08-05 15:29:49', '2023-08-05 15:29:49', NULL),
(12, '1234', NULL, '9864321975', 17, 'NE200012340296', '2023-08-05 15:31:36', '2023-08-05 15:31:36', NULL),
(13, '1234', NULL, '5110000111', 17, 'NE200012340436', '2023-08-05 15:33:56', '2023-08-05 15:33:56', NULL),
(14, '1234', NULL, '5110000111', 17, 'NE200012340561', '2023-08-05 15:36:01', '2023-08-05 15:36:01', NULL),
(15, '1234', NULL, '5110000111', 17, 'NE200012340683', '2023-08-05 15:38:03', '2023-08-05 15:38:03', NULL),
(16, '1234', NULL, '5110000111', 17, 'NE200012340769', '2023-08-05 15:39:29', '2023-08-05 15:39:29', NULL),
(17, 'dddd', NULL, '9864321975', 17, 'NE2000dddd0831', '2023-08-05 15:40:31', '2023-08-05 15:40:31', NULL),
(18, 'dddd', NULL, '9864321975', 17, 'NE2000dddd0887', '2023-08-05 15:41:27', '2023-08-05 15:41:27', NULL),
(19, 'dddd', NULL, '9864321975', 17, 'NE2000dddd0996', '2023-08-05 15:43:16', '2023-08-05 15:43:16', NULL),
(20, '1234', NULL, '9864321975', 17, 'NE200012341078', '2023-08-05 15:44:38', '2023-08-05 15:44:38', NULL),
(21, '1234', 100000, '9864321975', 17, 'NE200012343045', '2023-08-06 08:57:25', '2023-08-06 08:57:25', 'ACTIVE'),
(22, '1234', 100000, '9864321975', 17, 'NE200012343312', '2023-08-06 09:01:52', '2023-08-06 09:01:52', 'ACTIVE'),
(23, '1234', 100000, '9864321975', 17, 'NE200012344804', '2023-08-06 09:26:44', '2023-08-06 09:26:44', 'ACTIVE'),
(24, '1234', 100000, '9864321975', 17, 'NE200012344310', '2023-08-06 14:51:50', '2023-08-06 14:51:50', 'ACTIVE'),
(25, '1234', 100000, '9864321975', 17, 'NE200012344656', '2023-08-06 14:57:36', '2023-08-06 14:57:36', 'ACTIVE'),
(26, '1234', 100000, '9864321975', 17, 'NE200012344691', '2023-08-06 14:58:11', '2023-08-06 14:58:11', 'ACTIVE'),
(27, '1234', 100000, '9864321975', 17, 'NE200012344913', '2023-08-06 15:01:53', '2023-08-06 15:01:53', 'ACTIVE'),
(28, '1234', 100000, '9864321975', 17, 'NE200012344946', '2023-08-06 15:02:26', '2023-08-06 15:02:26', 'ACTIVE'),
(29, '1234', 100000, '9864321975', 17, 'NE200012345235', '2023-08-06 15:07:15', '2023-08-06 15:07:15', 'ACTIVE'),
(30, '1234', 100000, '9864321975', 17, 'NE200012345285', '2023-08-06 15:08:05', '2023-08-06 15:08:05', 'ACTIVE'),
(31, '1234', 100000, '9864321975', 17, 'NE200012345320', '2023-08-06 15:08:40', '2023-08-06 15:08:40', 'ACTIVE'),
(32, '12341', 100000, '9864321975', 17, '123456', '2023-08-06 15:12:58', '2023-08-06 15:12:58', 'ACTIVE'),
(33, '1234', 100000, '9864321975', 17, '123456', '2023-08-07 02:03:41', '2023-08-07 02:03:41', 'ACTIVE'),
(34, '1234', 100000, '9864321975', 17, '123456', '2023-08-07 02:04:39', '2023-08-07 02:04:39', 'ACTIVE'),
(35, '1234', 100000, '9864321975', 17, '123456', '2023-08-07 02:05:27', '2023-08-07 02:05:27', 'ACTIVE'),
(36, '1234', 1000, '9864321975', 17, 'NE200012344779', '2023-08-07 02:07:32', '2023-08-07 02:07:32', NULL),
(37, '1234', 100000, '9864321975', 17, '123456', '2023-08-07 02:53:37', '2023-08-07 02:53:37', 'ACTIVE'),
(38, '1234', 100000, '9864321975', 17, '123456', '2023-08-07 02:57:56', '2023-08-07 02:57:56', 'ACTIVE'),
(39, '1234', 100000, '9864321975', 17, '1234567890', '2023-08-07 03:29:41', '2023-08-07 03:29:41', 'INITIAL PAY'),
(40, '1234', 10000, '9864321975', 17, '1234567890', '2023-08-07 03:37:10', '2023-08-07 03:37:10', NULL),
(41, '1234', 100000, '9864321975', 17, '1234567891', '2023-08-07 03:50:12', '2023-08-07 03:50:12', 'INITIAL PAY'),
(42, '1234', 10000, '9864321975', 17, '1234567891', '2023-08-07 03:50:41', '2023-08-07 03:50:41', 'ACTIVE'),
(43, '1234', 100000, '9864321975', 17, '12345678923', '2023-08-07 05:29:40', '2023-08-07 05:29:40', 'INITIAL PAY'),
(44, '1234', 100000, '9864321975', 17, '1234567892', '2023-08-07 05:30:12', '2023-08-07 05:30:12', 'INITIAL PAY'),
(45, '1234', 100000, '9864321975', 17, '1234561234', '2023-08-08 07:52:36', '2023-08-08 07:52:36', 'INITIAL PAY'),
(46, '1234', 10000, '9864321975', 17, '1234561234', '2023-08-08 07:53:55', '2023-08-08 07:53:55', 'ACTIVE'),
(47, '1234', 100000, ' 21121900003', 17, '1234567893', '2023-08-10 17:01:30', '2023-08-10 17:01:30', 'INITIAL PAY'),
(48, '1234', 10000, '1', 17, '1234567899', '2023-08-11 12:13:17', '2023-08-11 12:13:17', 'INITIAL PAY'),
(49, '1234', 10000, '21', 17, '123456789000', '2023-08-12 11:28:48', '2023-08-12 11:28:48', 'INITIAL PAY'),
(50, '1234', 10000, '081700001010', 17, '+2551234567891', '2023-08-12 15:32:34', '2023-08-12 15:32:34', 'INITIAL PAY'),
(51, '1234', 10000, '081700001010', 17, '+2551234567893', '2023-08-13 03:26:10', '2023-08-13 03:26:10', 'INITIAL PAY'),
(52, '1234', 10000, '081700001010', 17, '1234512345', '2023-08-13 05:32:42', '2023-08-13 05:32:42', 'INITIAL PAY'),
(53, '1234', 10000, '21', 17, '12341234123', '2023-08-13 05:33:34', '2023-08-13 05:33:34', 'INITIAL PAY'),
(54, '1234', 10000, '21', 17, '1234123412323', '2023-08-13 05:35:21', '2023-08-13 05:35:21', 'INITIAL PAY'),
(55, '1234', 10000, '21', 17, '123412341232323', '2023-08-13 05:38:16', '2023-08-13 05:38:16', 'INITIAL PAY'),
(56, '1234', 10000, '21', 17, '2323234545', '2023-08-13 06:31:39', '2023-08-13 06:31:39', 'INITIAL PAY'),
(57, '1234', 10000, '21', 17, '+25512345623456', '2023-08-13 06:33:04', '2023-08-13 06:33:04', 'INITIAL PAY'),
(58, '12347', 10000, '21', 17, '56343243675476', '2023-08-13 06:34:11', '2023-08-13 06:34:11', 'INITIAL PAY'),
(59, '1234', 10000, '21', 17, '1111111111', '2023-08-13 07:32:36', '2023-08-13 07:32:36', 'INITIAL PAY'),
(60, '1234', 10000, '21', 17, '1111111111', '2023-08-13 07:32:54', '2023-08-13 07:32:54', 'ACTIVE'),
(61, NULL, 10000, NULL, 17, '1234567859', '2023-08-13 10:16:23', '2023-08-13 10:16:23', 'INITIAL PAY'),
(62, NULL, 10000, NULL, 17, '2345678912', '2023-08-13 11:00:05', '2023-08-13 11:00:05', 'INITIAL PAY'),
(63, NULL, 10000, NULL, 17, '2345672345', '2023-08-13 11:49:38', '2023-08-13 11:49:38', 'INITIAL PAY'),
(64, NULL, 10000, NULL, 17, '2345672345', '2023-08-13 11:50:03', '2023-08-13 11:50:03', 'ACTIVE'),
(65, NULL, 10000, NULL, 17, '232343829575', '2023-08-13 11:54:48', '2023-08-13 11:54:48', 'INITIAL PAY'),
(66, NULL, 10000, NULL, 17, '1424534435', '2023-08-13 12:06:52', '2023-08-13 12:06:52', 'INITIAL PAY'),
(67, NULL, 10000, NULL, 17, '142453443', '2023-08-13 12:07:25', '2023-08-13 12:07:25', 'INITIAL PAY'),
(68, NULL, 10000, NULL, 17, '1424534432', '2023-08-13 12:08:15', '2023-08-13 12:08:15', 'INITIAL PAY'),
(69, NULL, 10000, NULL, 17, '1424534431', '2023-08-13 12:08:44', '2023-08-13 12:08:44', 'INITIAL PAY'),
(70, NULL, 10000, NULL, 17, '1424534430', '2023-08-13 12:09:29', '2023-08-13 12:09:29', 'INITIAL PAY'),
(71, '12343', 10000, '21', 17, '2222222222', '2023-08-14 05:40:17', '2023-08-14 05:40:17', 'INITIAL PAY'),
(72, '1234', 10000, '21', 17, '2222222222', '2023-08-14 05:40:33', '2023-08-14 05:40:33', 'ACTIVE'),
(73, NULL, 10000, NULL, 17, '55555555555', '2023-08-14 05:46:11', '2023-08-14 05:46:11', 'INITIAL PAY');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_catalog`
--

CREATE TABLE `product_catalog` (
  `id` int(11) NOT NULL,
  `fsp_code` varchar(10) DEFAULT NULL,
  `fsp_name` varchar(100) DEFAULT NULL,
  `product_code` varchar(8) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `min_tenure` int(11) DEFAULT NULL,
  `max_tenure` int(11) DEFAULT NULL,
  `interest_rate` double DEFAULT NULL,
  `processing_fee` double DEFAULT NULL,
  `insurance` double DEFAULT NULL,
  `amount_min` double DEFAULT NULL,
  `amount_max` double DEFAULT NULL,
  `repayment_type` varchar(10) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `for_executive` tinyint(1) NOT NULL,
  `approval_status` varchar(50) NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_catalog`
--

INSERT INTO `product_catalog` (`id`, `fsp_code`, `fsp_name`, `product_code`, `product_name`, `min_tenure`, `max_tenure`, `interest_rate`, `processing_fee`, `insurance`, `amount_min`, `amount_max`, `repayment_type`, `description`, `for_executive`, `approval_status`, `created_at`, `updated_at`) VALUES
(1, '1001', 'ACB BANK', '4007', 'vfbafbfbasfb', 344, 343, 4, 34, 43, 34344, 344343, 'Monthly', 'qwrgqwgqwrgwrgqwg', 1, 'PENDING', '2023-12-17 13:04:44', '2023-12-17 13:04:44'),
(2, '1001', 'ACB BANK', '982765', 'asfasfasf', 34, 4, 4, 4, 3, 4343, 343434, 'Monthly', 'rgwergwergwerge', 1, 'PENDING', '2023-12-17 13:11:29', '2023-12-17 13:11:29'),
(3, '1001', 'ACB BANK', '172773', 'dfvefvefv', 3, 4, 3, 1, 4, 4, 3, 'Monthly', 'gbsdfvfvefve fveverve erv1rvrv3r', 1, 'PENDING', '2023-12-17 13:17:56', '2023-12-17 13:17:56'),
(4, '1001', 'ACB BANK', '172773', 'dfvefvefv', 3, 4, 3, 1, 4, 4, 3, 'Monthly', NULL, 1, 'PENDING', '2023-12-17 13:19:02', '2023-12-17 13:19:02'),
(5, '1001', 'ACB BANK', '172773', 'dfvefvefv', 3, 4, 3, 1, 4, 4, 3, 'Monthly', NULL, 1, 'PENDING', '2023-12-17 13:20:12', '2023-12-17 13:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `country_code` char(2) NOT NULL DEFAULT 'TZ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `country_code`, `created_at`, `updated_at`) VALUES
(1, 'Arusha', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(2, 'Dar es Salaam', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(3, 'Dodoma', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(4, 'Geita', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(5, 'Iringa', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(6, 'Kagera', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(7, 'Katavi', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(8, 'Kigoma', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(9, 'Kilimanjaro', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(10, 'Lindi', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(11, 'Manyara', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(12, 'Mara', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(13, 'Mbeya', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(14, 'Morogoro', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(15, 'Mtwara', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(16, 'Mwanza', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(17, 'Njombe', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(18, 'Pemba North', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(19, 'Pemba South', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(20, 'Pwani', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(21, 'Rukwa', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(22, 'Ruvuma', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(23, 'Shinyanga', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(24, 'Simiyu', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(25, 'Singida', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(26, 'Songwe', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(27, 'Tabora', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(28, 'Tanga', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(29, 'Zanzibar Central/South', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(30, 'Zanzibar North', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16'),
(31, 'Zanzibar Urban/West', 'TZ', '2025-04-10 16:18:16', '2025-04-10 16:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `name` varchar(300) DEFAULT NULL,
  `path_url` varchar(400) DEFAULT NULL,
  `descriptions` varchar(500) DEFAULT NULL,
  `lender_id` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `name`, `path_url`, `descriptions`, `lender_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 'document one ', '1744275523_ISO27k_ISMS_6.1_SoA_2022.xlsx', 'xxxx xxxxxx. xxxx ', '2345', 'Active', '2025-04-10 05:58:43', '2025-04-10 05:58:43'),
(4, 'Solomon Newton', '1744453928_image (5).png', 'document xxxxxxxx. xxxxxxxxxxxx', '1', 'Active', '2025-04-12 07:32:08', '2025-04-12 07:32:08'),
(5, 'Solomon Newtonhgvh', '1744707063_Screenshot 2025-04-09 at 12.40.05.png', 'ghjvgvjgh', '17', 'Active', '2025-04-15 05:51:03', '2025-04-15 05:51:03'),
(6, 'New demo document', '1753436488_loan-application-APP2025942778.pdf', 'new document submited', '17', 'Active', '2025-07-25 06:41:28', '2025-07-25 06:41:28');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5d1xe0vHuY46lA512gK43xJFmhCYZLMz1GwIYiCd', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoid2RzeWwxbnJwMVB6UGE4QlBCVUo0Nm9Xdm54NVJyc1VZa2VEZWZVRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1757927575),
('25sBPcD17HVhazjqJECC9mVQSeiyB2LW2Nk5tClD', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRW10d2RVQlducDViaFVxS2tQeHpuSnZ3MURpTDFnd1BBcU5qeDFrZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC92aWV3L3ZlaGljbGUvMTciO319', 1757929646),
('9mOuNLnbbD2wvYCFCdtSW10mF9hgkleCunzHDMGv', 99, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiM09uU2M4TzF3TFV4OUpHTFZEdU9LekNVbGgzN2hrWHhEVGxOZ3JEViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6Nzoic3VjY2VzcyI7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9DeWJlclBvaW50LVBybyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk5O3M6MTQ6InVzZXJEZXBhcnRtZW50IjtzOjc6IkxFTkRFUlMiO3M6MTE6InBlcm1pc3Npb25zIjthOjc6e2k6MDtzOjE6IjIiO2k6MTtzOjE6IjciO2k6MjtzOjI6IjEwIjtpOjM7czoyOiIxMSI7aTo0O3M6MjoiMTUiO2k6NTtzOjI6IjIwIjtpOjY7czoyOiIyMyI7fXM6MTY6InBlcm1pc3Npb25faXRlbXMiO2E6Nzp7aTowO3M6MjY6IkNyZWF0ZSBhbmQgbWFuYWdlIGJyYW5jaGVzIjtpOjE7czozNzoiTWFuYWdlIENsaWVudCByZWxhdGlvbnNoaXBzIGFuZCB0eXBlcyI7aToyO3M6MTg6IlByb2R1Y3QgTWFuYWdlbWVudCI7aTozO3M6MTk6IlJlc291cmNlIE1hbmFnZW1lbnQiO2k6NDtzOjg6IlNldHRpbmdzIjtpOjU7czoxMjoiVXNlciBQcm9maWxlIjtpOjY7czoxOToiSW1wb3J0IER1dHkgRmluYW5jZSI7fX0=', 1757929142);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `shop_type` enum('spare_parts','mechanic','accessories','service') NOT NULL DEFAULT 'spare_parts',
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `owner_name`, `phone_number`, `email`, `shop_type`, `latitude`, `longitude`, `address`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Pariatur Quidem mol', 'nmhvjgh', '0716815881', 'fastcredit.tzmm@gmail.com', 'spare_parts', -6.7788657, 39.2521949, 'Dar Es Salaam', '2025-08-05 11:51:57', '2025-08-05 11:51:57', 'active'),
(2, 'G&L Spare part', 'James Ilo', '0716815883', 'percyegno@gmail.com', 'spare_parts', -6.7787068, 39.2521144, 'Dar Es Salaam', '2025-09-08 07:50:47', '2025-09-08 07:50:47', 'active'),
(3, 'Makumbusho spare part ', 'max malimbelimbe', '0716815882', 'percyegno@gmail.com', 'spare_parts', -6.7788496, 39.2520393, 'Dar Es Salaam\n2113', '2025-09-08 08:04:56', '2025-09-08 08:04:56', 'active'),
(4, 'Morocco', 'Percy', '0716815881', 'percyegno@gmail.com', 'spare_parts', -6.7786690, 39.2520852, 'Dar Es Salaam', '2025-09-08 09:11:39', '2025-09-08 09:11:39', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `spare_brands`
--

CREATE TABLE `spare_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `spare_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spare_brands`
--

INSERT INTO `spare_brands` (`id`, `spare_category_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Exide', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(2, 1, 'Bosch', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(3, 1, 'Amaron', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(4, 1, 'Rocket', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(5, 1, 'Panasonic', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(6, 1, 'Solite', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(7, 1, 'Furukawa', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(8, 1, 'Delkor', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(9, 2, 'Michelin', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(10, 2, 'Dunlop', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(11, 2, 'Bridgestone', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(12, 2, 'Yokohama', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(13, 2, 'Hankook', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(14, 2, 'Continental', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(15, 2, 'Goodyear', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(16, 2, 'Pirelli', '2025-08-05 12:05:48', '2025-08-05 12:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `spare_categories`
--

CREATE TABLE `spare_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spare_categories`
--

INSERT INTO `spare_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Battery', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(2, 'Tyre', '2025-08-05 12:05:48', '2025-08-05 12:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `spare_models`
--

CREATE TABLE `spare_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `spare_brand_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spare_models`
--

INSERT INTO `spare_models` (`id`, `spare_brand_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'N70', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(2, 1, 'N100', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(3, 1, 'N120', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(4, 1, '35Ah', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(5, 1, '55Ah', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(6, 2, 'S3', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(7, 2, 'S4', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(8, 2, 'S5', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(9, 2, 'SM Mega Power', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(10, 2, 'Hightec Silver', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(11, 3, 'GO', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(12, 3, 'HiLife', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(13, 3, 'Black', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(14, 3, 'Pro', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(15, 4, 'SMF', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(16, 4, 'MF', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(17, 4, 'ES70L', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(18, 5, '75D23L', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(19, 5, '80D26L', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(20, 5, '95D31R', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(21, 6, 'NS60', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(22, 6, 'NS70', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(23, 6, 'N50', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(24, 7, 'FTZ5S', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(25, 7, 'FTX7L-BS', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(26, 8, '55B24L', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(27, 8, '80D26L', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(28, 8, '95D31L', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(29, 9, 'Energy Saver', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(30, 9, 'Pilot Sport 4', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(31, 9, 'Primacy 4', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(32, 10, 'SP Sport LM705', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(33, 10, 'Grandtrek AT3', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(34, 10, 'AT20', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(35, 10, 'SP Touring R1', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(36, 11, 'Dueler H/T', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(37, 11, 'Ecopia EP150', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(38, 11, 'Potenza RE003', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(39, 12, 'Geolandar A/T', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(40, 12, 'BluEarth AE01', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(41, 12, 'Advan Fleva', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(42, 13, 'Dynapro AT2', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(43, 13, 'Kinergy Eco2', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(44, 13, 'Ventus Prime', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(45, 14, 'ContiCrossContact', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(46, 14, 'EcoContact 6', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(47, 14, 'PremiumContact 6', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(48, 15, 'Wrangler AT', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(49, 15, 'EfficientGrip', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(50, 15, 'Eagle F1', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(51, 16, 'Scorpion Verde', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(52, 16, 'Cinturato P6', '2025-08-05 12:05:48', '2025-08-05 12:05:48'),
(53, 16, 'P Zero', '2025-08-05 12:05:48', '2025-08-05 12:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `spare_parts`
--

CREATE TABLE `spare_parts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `spare_category_id` bigint(20) UNSIGNED NOT NULL,
  `spare_brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `spare_model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit` varchar(255) NOT NULL,
  `price_type` enum('per_unit','per_bundle') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `preview_image` varchar(255) NOT NULL,
  `additional_image_1` varchar(255) DEFAULT NULL,
  `additional_image_2` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spare_parts`
--

INSERT INTO `spare_parts` (`id`, `shop_id`, `spare_category_id`, `spare_brand_id`, `spare_model_id`, `unit`, `price_type`, `price`, `preview_image`, `additional_image_1`, `additional_image_2`, `description`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 1, 3, 14, '1', 'per_unit', 50000.00, 'spare-parts/IHBeBRX9AEYh8sYsbb6M6qXYFjwCwElsgZVlVom9.webp', 'spare-parts/ySN69hTh2aAc1oWUtQsgJ9I8VXJkXViveretjiF3.webp', 'spare-parts/Zvl4SlasADv6XGK3bjsbKPFuXwDvzRysBWGZyV9y.jpg', 'good o', '2025-08-05 12:22:32', '2025-08-05 12:22:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `spare_part_payments`
--

CREATE TABLE `spare_part_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quote_id` bigint(20) UNSIGNED NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) DEFAULT 'TZS',
  `payment_method` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_status` enum('pending','completed','failed','cancelled') DEFAULT 'pending',
  `payment_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spare_part_quotes`
--

CREATE TABLE `spare_part_quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `spare_part_request_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency` varchar(3) DEFAULT 'TZS',
  `delivery_time` varchar(100) DEFAULT NULL,
  `warranty_info` text DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  `payment_link` varchar(500) DEFAULT NULL,
  `status` enum('pending','accepted','rejected','expired') DEFAULT 'pending',
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spare_part_quotes`
--

INSERT INTO `spare_part_quotes` (`id`, `spare_part_request_id`, `shop_id`, `price`, `currency`, `delivery_time`, `warranty_info`, `additional_notes`, `payment_link`, `status`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 45000.00, 'TZS', '2-3 business days', '6 months warranty', 'Original Toyota parts, in stock', NULL, 'pending', NULL, '2025-09-01 14:38:27', '2025-09-01 14:38:27'),
(4, 9, 1, 890000.00, 'TZS', '2', '12-monthy', 'welcome', '', 'pending', '2025-09-08 11:46:21', '2025-09-01 11:46:21', '2025-09-01 11:46:21'),
(5, 10, 1, 78000.00, 'TZS', '1-hours', '12 months', 'welcome to our shop near you', 'https://pcc.tpf.go.tz/', 'pending', '2025-09-08 11:55:01', '2025-09-01 11:55:01', '2025-09-01 11:55:01'),
(6, 11, 1, 560000.00, 'TZS', '1-hours', '32 months', 'new addition - version', 'https://pcc.tpf.go.tz/', 'pending', '2025-09-08 12:00:27', '2025-09-01 12:00:27', '2025-09-01 12:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `spare_part_requests`
--

CREATE TABLE `spare_part_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `make_id` bigint(20) UNSIGNED NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `part_number` varchar(255) DEFAULT NULL,
  `part_size` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  `status` enum('pending','in_progress','completed','cancelled') NOT NULL DEFAULT 'pending',
  `expires_at` timestamp NULL DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `part_condition` varchar(20) DEFAULT 'all'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spare_part_requests`
--

INSERT INTO `spare_part_requests` (`id`, `make_id`, `model_id`, `year`, `part_name`, `part_number`, `part_size`, `description`, `customer_name`, `customer_email`, `customer_phone`, `additional_notes`, `status`, `expires_at`, `location`, `latitude`, `longitude`, `created_at`, `updated_at`, `part_condition`) VALUES
(1, 39, 354, 2023, 'oil filter', '97890383', '', 'i need that one dirrect ', 'Pevv gfhd', 'fastcredit.tz@gmail.com', '+255716815881', 'bc xbvm bnxfgdfgfdbb', 'pending', '2025-09-08 08:02:36', NULL, NULL, NULL, '2025-09-01 08:02:36', '2025-09-01 08:02:36', 'all'),
(2, 48, 615, 2023, 'oil filter', '', '', '', 'Pevv gfhd', 'fastcredit.tz@gmail.com', '+255716815881', '', 'pending', '2025-09-08 08:25:16', NULL, NULL, NULL, '2025-09-01 08:25:16', '2025-09-01 08:25:16', 'all'),
(3, 48, 615, 2023, 'oil filter', '', '', '', 'Pevv gfhd', 'fastcredit.tz@gmail.com', '0716815881', '', 'pending', '2025-09-08 08:25:27', NULL, NULL, NULL, '2025-09-01 08:25:27', '2025-09-01 08:25:27', 'all'),
(4, 48, 618, 2019, 'front bumper', '', '', '', 'Percy Egno', 'aleck.ngoshanni@wealthora.co.tz', '0716815881', '', 'pending', '2025-09-08 08:31:12', NULL, NULL, NULL, '2025-09-01 08:31:12', '2025-09-01 08:31:12', 'all'),
(5, 48, 618, 2019, 'front bumper', '', '', '', 'Percy Egno', 'aleck.ngoshanni@wealthora.co.tz', '0716815881', '', 'pending', '2025-09-08 08:31:18', NULL, NULL, NULL, '2025-09-01 08:31:18', '2025-09-01 08:31:18', 'all'),
(6, 26, 86, 2021, 'blackes', '', '', '', 'Percy Egno', 'aleck.ngoshani@wealthora.co.tz', '0716815881', 'sdfdfdg', 'pending', '2025-09-08 09:01:09', NULL, NULL, NULL, '2025-09-01 09:01:09', '2025-09-01 09:01:09', 'all'),
(7, 26, 86, 2021, 'blackes', '', '', '', 'Percy Egno', 'aleck.ngoshani@wealthora.co.tz', '0716815881', 'sdfdfdg', 'pending', '2025-09-08 09:01:10', NULL, NULL, NULL, '2025-09-01 09:01:10', '2025-09-01 09:01:10', 'all'),
(8, 39, 357, 2022, 'jjhjhkihj', 'hhhh', NULL, '', 'Percy Egno', 'aleck.ngoshani@wealthora.co.tz', '0716815881', NULL, 'pending', '2025-09-08 10:03:23', NULL, NULL, NULL, '2025-09-01 10:03:23', '2025-09-01 10:03:23', 'all'),
(9, 62, 622, 1995, 'bbnm', 'bj', 'bb', NULL, 'bbmb', 'fastcredit.btz@gmail.com', NULL, '', 'pending', '2025-09-08 11:15:26', NULL, NULL, NULL, '2025-09-01 11:15:26', '2025-09-01 11:15:26', 'used'),
(10, 39, 353, 2022, 'Brake oil', 'hdfhg', '12 kwa 23', NULL, 'Juma', 'percyegno@gmail.com', NULL, 'new description', 'pending', '2025-09-08 11:53:37', NULL, NULL, NULL, '2025-09-01 11:53:37', '2025-09-01 11:53:37', 'new'),
(11, 27, 93, 2022, 'hjfdvsff', 'df', 'dsf', NULL, 'jobe', 'percyegno@gmail.com', NULL, 'dfnsdnfdgfd', 'pending', '2025-09-08 11:59:44', NULL, NULL, NULL, '2025-09-01 11:59:44', '2025-09-01 11:59:44', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `statement_analyses`
--

CREATE TABLE `statement_analyses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `special_id` varchar(255) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL COMMENT 'The service provider (e.g., Vodacom, Airtel)',
  `statement_start_date` date DEFAULT NULL,
  `statement_end_date` date DEFAULT NULL,
  `total_transactions` int(50) DEFAULT NULL,
  `total_turnover` decimal(50,2) DEFAULT NULL,
  `wallet_balance` decimal(50,2) DEFAULT NULL,
  `affordability_score_high` decimal(50,2) DEFAULT NULL,
  `affordability_score_moderate` decimal(50,2) DEFAULT NULL,
  `affordability_score_low` decimal(50,2) DEFAULT NULL,
  `affordability_rank` int(30) DEFAULT NULL,
  `raw_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Full JSON response from the API' CHECK (json_valid(`raw_response`)),
  `analysis_summary` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Processed summary of the analysis' CHECK (json_valid(`analysis_summary`)),
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Related user if applicable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statement_analyses`
--

INSERT INTO `statement_analyses` (`id`, `account_number`, `full_name`, `is_verified`, `special_id`, `provider`, `statement_start_date`, `statement_end_date`, `total_transactions`, `total_turnover`, `wallet_balance`, `affordability_score_high`, `affordability_score_moderate`, `affordability_score_low`, `affordability_rank`, `raw_response`, `analysis_summary`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '255767582837', 'John Doe', 0, 'LOAN-2025-001', 'Vodacom', '2025-04-18', '2025-05-02', 17, NULL, NULL, 19467.00, 14600.00, 9733.00, 2, '{\"profile\":{\"name\":\"255767582837\",\"account\":\"255767582837\",\"contacts\":\"255767582837\",\"company\":\"Vodacom\",\"currency\":\"Tanzanian Shilling\",\"currency_code\":\"TZS\",\"type\":\"mno\",\"start_date\":\"2025-04-18T11:05:00\",\"end_date\":\"2025-05-02T09:03:00\",\"no_of_transactions\":17},\"1d_analysis\":[],\"2d_analysis\":[],\"3d_analysis\":[],\"affordability_scores\":{\"rank\":2,\"high\":19467,\"moderate\":14600,\"low\":9733}}', '{\"cash_flow\":{\"total_turnover\":0,\"total_cashin\":0,\"total_cashout\":0},\"cash_inflow\":[],\"cash_outflow\":[],\"monthly_analysis\":{\"inflow\":[],\"outflow\":[]},\"loan_activity\":[]}', 123, '2025-05-11 05:01:03', '2025-05-11 05:01:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menus`
--

CREATE TABLE `sub_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` int(10) UNSIGNED DEFAULT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `sub_menu_name` varchar(100) DEFAULT NULL,
  `user_action` varchar(100) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_menus`
--

INSERT INTO `sub_menus` (`id`, `system_id`, `menu_id`, `sub_menu_name`, `user_action`, `position`, `created_at`, `updated_at`) VALUES
(2, 1, 2, ' manage Clients', 'Create and manage branches', 1, NULL, NULL),
(3, 1, 4, 'Manage Loans', 'Edit branch information', 1, NULL, NULL),
(5, 1, 5, 'Manage Offers', 'Create, edit, and delete Client profiles', 1, NULL, NULL),
(7, 1, 7, 'Manage Loan Applications', 'Manage Client relationships and types', 1, NULL, NULL),
(9, 1, 9, 'Create and Manage Users', 'Generate Client reports', 1, NULL, NULL),
(10, 10, 10, 'Product Management', 'Product Management', 10, NULL, NULL),
(11, 1, 11, 'Resource Management', 'Resource Management', 1, NULL, NULL),
(12, 1, 12, 'Partner Onboarding', 'Partner Onboarding', 1, NULL, NULL),
(14, 1, 13, 'Vehicle Management', 'Vehicle Management', 1, NULL, NULL),
(15, 1, 14, 'Settings', 'Settings', 1, NULL, NULL),
(16, 1, 15, 'Reports', 'Reports', 1, NULL, NULL),
(17, 1, 16, 'Garage Management', 'Garage Management', 1, NULL, NULL),
(18, 1, 17, 'Shop Onboarding', 'Shop Onboarding', 1, NULL, NULL),
(19, 1, 18, 'Spare Part Requests', 'Spare Part Requests', 1, NULL, NULL),
(20, 1, 19, 'User Profile', 'User Profile', 1, NULL, NULL),
(21, 1, 20, 'CFC Management ', 'CFC Management ', 1, NULL, NULL),
(22, 1, 21, 'CFC Offers ', 'CFC Offers ', 1, NULL, NULL),
(23, 1, 22, 'Import Duty Finance', 'Import Duty Finance', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menus_`
--

CREATE TABLE `sub_menus_` (
  `id` int(10) UNSIGNED NOT NULL,
  `system_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `sub_menu_name` varchar(50) NOT NULL,
  `user_action` varchar(100) NOT NULL,
  `position` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_products`
--

CREATE TABLE `sub_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `default_status` int(11) DEFAULT NULL,
  `sub_product_name` varchar(50) DEFAULT NULL,
  `sub_product_id` varchar(50) DEFAULT NULL,
  `sub_product_status` tinyint(4) DEFAULT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `deposit` tinyint(4) DEFAULT NULL,
  `deposit_charge` double(8,2) DEFAULT NULL,
  `deposit_charge_min_value` double(8,2) DEFAULT NULL,
  `deposit_charge_max_value` double(8,2) DEFAULT NULL,
  `withdraw` tinyint(4) DEFAULT NULL,
  `withdraw_charge` double(8,2) DEFAULT NULL,
  `withdraw_charge_min_value` double(8,2) DEFAULT NULL,
  `withdraw_charge_max_value` double(8,2) DEFAULT NULL,
  `interest_value` double(8,2) DEFAULT NULL,
  `interest_tenure` double(8,2) DEFAULT NULL,
  `maintenance_fees` double(8,2) DEFAULT NULL,
  `maintenance_fees_value` double(8,2) DEFAULT NULL,
  `profit_account` varchar(255) DEFAULT NULL,
  `inactivity` varchar(50) DEFAULT NULL,
  `create_during_registration` tinyint(4) DEFAULT NULL,
  `activated_by_lower_limit` tinyint(4) DEFAULT NULL,
  `requires_approval` tinyint(4) DEFAULT NULL,
  `generate_atm_card_profile` tinyint(4) DEFAULT NULL,
  `allow_statement_generation` tinyint(4) DEFAULT NULL,
  `send_notifications` tinyint(4) DEFAULT NULL,
  `require_image_member` tinyint(4) DEFAULT NULL,
  `require_image_id` tinyint(4) DEFAULT NULL,
  `require_mobile_number` tinyint(4) DEFAULT NULL,
  `generate_mobile_profile` tinyint(4) DEFAULT NULL,
  `notes` varchar(120) DEFAULT NULL,
  `interest` int(11) DEFAULT NULL,
  `ledger_fees` tinyint(4) DEFAULT NULL,
  `ledger_fees_value` double(8,2) DEFAULT NULL,
  `total_shares` int(11) DEFAULT NULL,
  `shares_per_member` int(11) DEFAULT NULL,
  `nominal_price` double(8,2) DEFAULT NULL,
  `shares_allocated` double(8,2) DEFAULT NULL,
  `available_shares` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_products`
--

INSERT INTO `sub_products` (`id`, `product_name`, `product_id`, `default_status`, `sub_product_name`, `sub_product_id`, `sub_product_status`, `currency`, `deposit`, `deposit_charge`, `deposit_charge_min_value`, `deposit_charge_max_value`, `withdraw`, `withdraw_charge`, `withdraw_charge_min_value`, `withdraw_charge_max_value`, `interest_value`, `interest_tenure`, `maintenance_fees`, `maintenance_fees_value`, `profit_account`, `inactivity`, `create_during_registration`, `activated_by_lower_limit`, `requires_approval`, `generate_atm_card_profile`, `allow_statement_generation`, `send_notifications`, `require_image_member`, `require_image_id`, `require_mobile_number`, `generate_mobile_profile`, `notes`, `interest`, `ledger_fees`, `ledger_fees_value`, `total_shares`, `shares_per_member`, `nominal_price`, `shares_allocated`, `available_shares`, `created_at`, `updated_at`) VALUES
(1, '', 11, NULL, 'HISA ZA MALENGO', '1178', 0, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FAMILY SAVING', '18', 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 'HISA ZA MALENGO', NULL, NULL, NULL, 500000, 10, 2000.00, NULL, 5000.00, '2023-07-02 04:46:53', '2023-08-17 09:55:08'),
(8, '', 12, NULL, 'DEMO SAVING', '1266', 0, '1', 0, 500.00, NULL, NULL, 0, 1.00, NULL, NULL, 6.00, 12.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PRODUCT', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-08 06:05:29', '2023-08-08 06:05:29'),
(9, '', 13, NULL, 'DEPO TEST', '1367', 0, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-08 06:21:38', '2023-08-08 06:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `system_notifications`
--

CREATE TABLE `system_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recipient_type` enum('CLIENT','CF_COMPANY','LENDER','ADMIN') NOT NULL,
  `recipient_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED DEFAULT NULL,
  `application_type` enum('LOAN','IMPORT_DUTY') DEFAULT NULL,
  `notification_type` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `action_url` varchar(500) DEFAULT NULL,
  `action_text` varchar(100) DEFAULT NULL,
  `priority` enum('LOW','NORMAL','HIGH','URGENT') DEFAULT 'NORMAL',
  `is_read` tinyint(1) DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_permissions`
--

CREATE TABLE `temp_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `t1` int(11) DEFAULT NULL,
  `t2` int(11) DEFAULT NULL,
  `t3` int(11) DEFAULT NULL,
  `t4` int(11) DEFAULT NULL,
  `t5` int(11) DEFAULT NULL,
  `t6` int(11) DEFAULT NULL,
  `t7` int(11) DEFAULT NULL,
  `t8` int(11) DEFAULT NULL,
  `t9` int(11) DEFAULT NULL,
  `t10` int(11) DEFAULT NULL,
  `t11` int(11) DEFAULT NULL,
  `t12` int(11) DEFAULT NULL,
  `t13` int(11) DEFAULT NULL,
  `t14` int(11) DEFAULT NULL,
  `t15` int(11) DEFAULT NULL,
  `t16` int(11) DEFAULT NULL,
  `t17` int(11) DEFAULT NULL,
  `t18` int(11) DEFAULT NULL,
  `t19` int(11) DEFAULT NULL,
  `t20` int(11) DEFAULT NULL,
  `t21` int(11) DEFAULT NULL,
  `t22` int(11) DEFAULT NULL,
  `t23` int(11) DEFAULT NULL,
  `t24` int(11) DEFAULT NULL,
  `t25` int(11) DEFAULT NULL,
  `t26` int(11) DEFAULT NULL,
  `t27` int(11) DEFAULT NULL,
  `t28` int(11) DEFAULT NULL,
  `t29` int(11) DEFAULT NULL,
  `t30` int(11) DEFAULT NULL,
  `t31` int(11) DEFAULT NULL,
  `t32` int(11) DEFAULT NULL,
  `t33` int(11) DEFAULT NULL,
  `t34` int(11) DEFAULT NULL,
  `t35` int(11) DEFAULT NULL,
  `t36` int(11) DEFAULT NULL,
  `t37` int(11) DEFAULT NULL,
  `t38` int(11) DEFAULT NULL,
  `t39` int(11) DEFAULT NULL,
  `t40` int(11) DEFAULT NULL,
  `t41` int(11) DEFAULT NULL,
  `t42` int(11) DEFAULT NULL,
  `t43` int(11) DEFAULT NULL,
  `t44` int(11) DEFAULT NULL,
  `t45` int(11) DEFAULT NULL,
  `t46` int(11) DEFAULT NULL,
  `t47` int(11) DEFAULT NULL,
  `t48` int(11) DEFAULT NULL,
  `t49` int(11) DEFAULT NULL,
  `t50` int(11) DEFAULT NULL,
  `t51` int(11) DEFAULT NULL,
  `t52` int(11) DEFAULT NULL,
  `t53` int(11) DEFAULT NULL,
  `t54` int(11) DEFAULT NULL,
  `t55` int(11) DEFAULT NULL,
  `t56` int(11) DEFAULT NULL,
  `t57` int(11) DEFAULT NULL,
  `t58` int(11) DEFAULT NULL,
  `t59` int(11) DEFAULT NULL,
  `t60` int(11) DEFAULT NULL,
  `t61` int(11) DEFAULT NULL,
  `t62` int(11) DEFAULT NULL,
  `t63` int(11) DEFAULT NULL,
  `t64` int(11) DEFAULT NULL,
  `t65` int(11) DEFAULT NULL,
  `t66` int(11) DEFAULT NULL,
  `t67` int(11) DEFAULT NULL,
  `t68` int(11) DEFAULT NULL,
  `t69` int(11) DEFAULT NULL,
  `t70` int(11) DEFAULT NULL,
  `t71` int(11) DEFAULT NULL,
  `t72` int(11) DEFAULT NULL,
  `t73` int(11) DEFAULT NULL,
  `t74` int(11) DEFAULT NULL,
  `t75` int(11) DEFAULT NULL,
  `t76` int(11) DEFAULT NULL,
  `t77` int(11) DEFAULT NULL,
  `t78` int(11) DEFAULT NULL,
  `t79` int(11) DEFAULT NULL,
  `t80` int(11) DEFAULT NULL,
  `t81` int(11) DEFAULT NULL,
  `t82` int(11) DEFAULT NULL,
  `t83` int(11) DEFAULT NULL,
  `t84` int(11) DEFAULT NULL,
  `t85` int(11) DEFAULT NULL,
  `t86` int(11) DEFAULT NULL,
  `t87` int(11) DEFAULT NULL,
  `t88` int(11) DEFAULT NULL,
  `t89` int(11) DEFAULT NULL,
  `t90` int(11) DEFAULT NULL,
  `t91` int(11) DEFAULT NULL,
  `t92` int(11) DEFAULT NULL,
  `t93` int(11) DEFAULT NULL,
  `t94` int(11) DEFAULT NULL,
  `t95` int(11) DEFAULT NULL,
  `t96` int(11) DEFAULT NULL,
  `t97` int(11) DEFAULT NULL,
  `t98` int(11) DEFAULT NULL,
  `t99` int(11) DEFAULT NULL,
  `t100` int(11) DEFAULT NULL,
  `t101` int(11) DEFAULT NULL,
  `t102` int(11) DEFAULT NULL,
  `t103` int(11) DEFAULT NULL,
  `t104` int(11) DEFAULT NULL,
  `t105` int(11) DEFAULT NULL,
  `t106` int(11) DEFAULT NULL,
  `t107` int(11) DEFAULT NULL,
  `t108` int(11) DEFAULT NULL,
  `t109` int(11) DEFAULT NULL,
  `t110` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `t111` int(11) DEFAULT NULL,
  `t112` int(11) DEFAULT NULL,
  `t113` int(11) DEFAULT NULL,
  `t114` int(11) DEFAULT NULL,
  `t115` int(11) DEFAULT NULL,
  `t116` int(11) DEFAULT NULL,
  `t117` int(11) DEFAULT NULL,
  `t118` int(11) DEFAULT NULL,
  `t119` int(11) DEFAULT NULL,
  `t120` int(11) DEFAULT NULL,
  `t121` int(11) DEFAULT NULL,
  `t122` int(11) DEFAULT NULL,
  `t123` int(11) DEFAULT NULL,
  `t124` int(11) DEFAULT NULL,
  `t125` int(11) DEFAULT NULL,
  `t126` int(11) DEFAULT NULL,
  `t127` int(11) DEFAULT NULL,
  `t128` int(11) DEFAULT NULL,
  `t129` int(11) DEFAULT NULL,
  `t130` int(11) DEFAULT NULL,
  `t131` int(11) DEFAULT NULL,
  `t132` int(11) DEFAULT NULL,
  `t133` int(11) DEFAULT NULL,
  `t134` int(11) DEFAULT NULL,
  `t135` int(11) DEFAULT NULL,
  `t136` int(11) DEFAULT NULL,
  `t137` int(11) DEFAULT NULL,
  `t138` int(11) DEFAULT NULL,
  `t139` int(11) DEFAULT NULL,
  `t140` int(11) DEFAULT NULL,
  `t141` int(11) DEFAULT NULL,
  `t142` int(11) DEFAULT NULL,
  `t143` int(11) DEFAULT NULL,
  `t144` int(11) DEFAULT NULL,
  `t145` int(11) DEFAULT NULL,
  `t146` int(11) DEFAULT NULL,
  `t147` int(11) DEFAULT NULL,
  `t148` int(11) DEFAULT NULL,
  `t149` int(11) DEFAULT NULL,
  `t150` int(11) DEFAULT NULL,
  `t151` int(11) DEFAULT NULL,
  `t152` int(11) DEFAULT NULL,
  `t153` int(11) DEFAULT NULL,
  `t154` int(11) DEFAULT NULL,
  `t155` int(11) DEFAULT NULL,
  `t156` int(11) DEFAULT NULL,
  `t157` int(11) DEFAULT NULL,
  `t158` int(11) DEFAULT NULL,
  `t159` int(11) DEFAULT NULL,
  `t160` int(11) DEFAULT NULL,
  `t161` int(11) DEFAULT NULL,
  `t162` int(11) DEFAULT NULL,
  `t163` int(11) DEFAULT NULL,
  `t164` int(11) DEFAULT NULL,
  `t165` int(11) DEFAULT NULL,
  `t166` int(11) DEFAULT NULL,
  `t167` int(11) DEFAULT NULL,
  `t168` int(11) DEFAULT NULL,
  `t169` int(11) DEFAULT NULL,
  `t170` int(11) DEFAULT NULL,
  `t171` int(11) DEFAULT NULL,
  `t172` int(11) DEFAULT NULL,
  `t173` int(11) DEFAULT NULL,
  `t174` int(11) DEFAULT NULL,
  `t175` int(11) DEFAULT NULL,
  `t176` int(11) DEFAULT NULL,
  `t177` int(11) DEFAULT NULL,
  `t178` int(11) DEFAULT NULL,
  `t179` int(11) DEFAULT NULL,
  `t180` int(11) DEFAULT NULL,
  `t181` int(11) DEFAULT NULL,
  `t182` int(11) DEFAULT NULL,
  `t183` int(11) DEFAULT NULL,
  `t184` int(11) DEFAULT NULL,
  `t185` int(11) DEFAULT NULL,
  `t186` int(11) DEFAULT NULL,
  `t187` int(11) DEFAULT NULL,
  `t188` int(11) DEFAULT NULL,
  `t189` int(11) DEFAULT NULL,
  `t190` int(11) DEFAULT NULL,
  `t191` int(11) DEFAULT NULL,
  `t192` int(11) DEFAULT NULL,
  `t193` int(11) DEFAULT NULL,
  `t194` int(11) DEFAULT NULL,
  `t195` int(11) DEFAULT NULL,
  `t196` int(11) DEFAULT NULL,
  `t197` int(11) DEFAULT NULL,
  `t198` int(11) DEFAULT NULL,
  `t199` int(11) DEFAULT NULL,
  `t200` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_permissions`
--

INSERT INTO `temp_permissions` (`id`, `role_id`, `t1`, `t2`, `t3`, `t4`, `t5`, `t6`, `t7`, `t8`, `t9`, `t10`, `t11`, `t12`, `t13`, `t14`, `t15`, `t16`, `t17`, `t18`, `t19`, `t20`, `t21`, `t22`, `t23`, `t24`, `t25`, `t26`, `t27`, `t28`, `t29`, `t30`, `t31`, `t32`, `t33`, `t34`, `t35`, `t36`, `t37`, `t38`, `t39`, `t40`, `t41`, `t42`, `t43`, `t44`, `t45`, `t46`, `t47`, `t48`, `t49`, `t50`, `t51`, `t52`, `t53`, `t54`, `t55`, `t56`, `t57`, `t58`, `t59`, `t60`, `t61`, `t62`, `t63`, `t64`, `t65`, `t66`, `t67`, `t68`, `t69`, `t70`, `t71`, `t72`, `t73`, `t74`, `t75`, `t76`, `t77`, `t78`, `t79`, `t80`, `t81`, `t82`, `t83`, `t84`, `t85`, `t86`, `t87`, `t88`, `t89`, `t90`, `t91`, `t92`, `t93`, `t94`, `t95`, `t96`, `t97`, `t98`, `t99`, `t100`, `t101`, `t102`, `t103`, `t104`, `t105`, `t106`, `t107`, `t108`, `t109`, `t110`, `created_at`, `updated_at`, `t111`, `t112`, `t113`, `t114`, `t115`, `t116`, `t117`, `t118`, `t119`, `t120`, `t121`, `t122`, `t123`, `t124`, `t125`, `t126`, `t127`, `t128`, `t129`, `t130`, `t131`, `t132`, `t133`, `t134`, `t135`, `t136`, `t137`, `t138`, `t139`, `t140`, `t141`, `t142`, `t143`, `t144`, `t145`, `t146`, `t147`, `t148`, `t149`, `t150`, `t151`, `t152`, `t153`, `t154`, `t155`, `t156`, `t157`, `t158`, `t159`, `t160`, `t161`, `t162`, `t163`, `t164`, `t165`, `t166`, `t167`, `t168`, `t169`, `t170`, `t171`, `t172`, `t173`, `t174`, `t175`, `t176`, `t177`, `t178`, `t179`, `t180`, `t181`, `t182`, `t183`, `t184`, `t185`, `t186`, `t187`, `t188`, `t189`, `t190`, `t191`, `t192`, `t193`, `t194`, `t195`, `t196`, `t197`, `t198`, `t199`, `t200`) VALUES
(1, 4, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 1, 1, 1, NULL, NULL, NULL, '2023-10-24 09:38:48', '2025-09-07 18:39:49', NULL, NULL, 1, 1, 1, 1, 0, NULL, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, 0, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, '2023-10-24 09:40:33', '2025-07-22 06:40:55', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2023-10-29 07:30:00', '2025-06-12 04:36:15', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(4, 9, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-29 10:11:01', '2023-10-29 10:12:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1009, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-29 10:11:34', '2023-10-29 10:16:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1010, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-29 10:11:40', '2023-10-29 10:12:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 7, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-29 10:12:02', '2023-10-29 10:12:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 1, 1, 1, NULL, NULL, NULL, '2023-10-29 10:12:14', '2023-10-31 20:41:11', NULL, NULL, 1, 1, 1, 1, NULL, NULL, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1015, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-29 10:12:28', '2023-10-29 10:14:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 1, 1, 0, 1, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, '2023-10-29 10:33:46', '2023-11-01 05:16:09', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 6, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, 1, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-29 10:34:03', '2023-11-01 05:16:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transmissions`
--

CREATE TABLE `transmissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transmissions`
--

INSERT INTO `transmissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Automatic', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(2, 'Manual', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(3, 'CVT', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(4, 'Semi-Automatic', '2025-04-30 08:32:18', '2025-04-30 08:32:18'),
(5, 'Dual Clutch', '2025-04-30 08:32:18', '2025-04-30 08:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `tra_calculation_logs`
--

CREATE TABLE `tra_calculation_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `cf_company_id` bigint(20) UNSIGNED NOT NULL,
  `tra_reference_number` varchar(100) DEFAULT NULL,
  `calculation_method` enum('TANCIS_ONLINE','TRA_OFFICE','MANUAL_VERIFICATION') NOT NULL,
  `calculated_by_officer` varchar(255) DEFAULT NULL,
  `calculation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tra_documents` text DEFAULT NULL,
  `verification_status` enum('PENDING','VERIFIED','DISPUTED') DEFAULT 'PENDING',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nida_number` bigint(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` int(11) DEFAULT NULL,
  `profile_photo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `otp_time` time DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `verification_status` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `employeeId` int(11) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `institution_id` int(11) DEFAULT NULL,
  `last_update_password` datetime NOT NULL DEFAULT current_timestamp(),
  `address` varchar(255) DEFAULT NULL,
  `shop_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nida_number`, `email_verified_at`, `password`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `role`, `status`, `otp_time`, `otp`, `verification_status`, `phone_number`, `employeeId`, `department`, `branch`, `institution_id`, `last_update_password`, `address`, `shop_id`) VALUES
(32, 'ADMIN', 'admin@gmail.com', NULL, '2025-07-22 12:58:29', '$2y$10$pU0Z8cl8zIGK4NDashwMy.wXC5XNXcbrrz2ljmLbl0PqWCiYD.XhK', NULL, NULL, NULL, '2023-08-13 11:35:20', '2025-07-22 12:58:29', NULL, NULL, NULL, NULL, 'ACTIVE', '08:15:42', 724580, '0', '0767582817', 900029, 4, 25, 22, '2023-11-24 08:06:15', NULL, '1'),
(45, 'ANDREW MASHAMBA', 'andrew.stanslaus.mashamba@gmail.com', NULL, NULL, '$2y$10$t2RfIW4S0JVXgUCrzu7RX.D2jFwAFyHuySF0p6oryTOwp25YUOagu', NULL, NULL, NULL, '2024-01-29 13:28:08', '2024-01-29 13:28:08', NULL, NULL, NULL, NULL, 'PENDING', '13:28:08', NULL, '0', '+255692410353', NULL, 1, NULL, NULL, '2024-01-29 13:28:08', NULL, NULL),
(46, 'Percy Egno', 'aleck.ngoshani@wealthora.co.tz', NULL, NULL, '$2y$10$Dp0zCQ.Iijqro9NE4NTIK.TmuZupItklw2/z1jWSR21WDr5mFH0mW', NULL, NULL, 'profile-photos/oJ2hL9950UyiPD7Pwolt9h1VM2tnE11n3p6WINXW.jpg', '2025-04-10 11:57:37', '2025-04-10 11:57:37', NULL, NULL, NULL, NULL, 'PENDING', '14:57:37', NULL, '0', '0716815881', NULL, NULL, NULL, NULL, '2025-04-10 17:57:37', NULL, NULL),
(50, 'juma all', 'fastcredfdewit.tz@gmail.com', NULL, NULL, '$2y$10$c09bV0hfieQkqkAQmrtDHedkAbdxLV6kv0XPpS/OgtWDhP0QFNjXK', NULL, NULL, NULL, '2025-04-13 03:25:03', '2025-04-13 03:25:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 17, '2025-04-13 09:25:03', NULL, NULL),
(51, 'juma all', 'fastcdfredfdewit.tz@gmail.com', NULL, NULL, '$2y$10$xpwqKlbiYt2YKLZ/UJScRuovfgGcVveQLiCvVkIt5VAuTb2XHAzHC', NULL, NULL, NULL, '2025-04-13 03:25:50', '2025-04-13 03:25:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 18, '2025-04-13 09:25:50', NULL, NULL),
(53, 'ADMIN', 'admin@gmail1.com', 94984284248242, NULL, '$2y$10$ehEE6ZXyBweJ0G2eU4u.GerUqMsrkc6o1FtmLbRgL0BbYH4woEk32', NULL, NULL, NULL, '2023-08-13 11:35:20', '2025-02-22 05:15:42', NULL, NULL, NULL, NULL, 'ACTIVE', '08:15:42', 111111, '0', '0767582817', 900029, 1, 25, 22, '2023-11-24 08:06:15', NULL, NULL),
(54, 'ADMIN', 'admin@gmail3.com', 94984284248242, NULL, '$2y$10$ehEE6ZXyBweJ0G2eU4u.GerUqMsrkc6o1FtmLbRgL0BbYH4woEk32', NULL, NULL, NULL, '2023-08-13 11:35:20', '2025-02-22 05:15:42', NULL, NULL, NULL, NULL, 'ACTIVE', '08:15:42', 111111, '0', '0767582817', 900029, 4, 25, 1, '2023-11-24 08:06:15', NULL, NULL),
(55, 'Percy Egno', 'aleck.ngoshadfni@wealthora.co.tz', NULL, NULL, '$2y$10$wj3ThSn/u3WY2Lff7IaOX.nTPFqauIrw09nLDkLTOYzo0dl0qRSZC', NULL, NULL, NULL, '2025-04-14 03:31:41', '2025-04-14 03:31:41', NULL, NULL, NULL, NULL, 'ACTIVE', '06:31:41', NULL, '0', '0716815886', NULL, 1, NULL, NULL, '2025-04-14 09:31:41', NULL, NULL),
(56, 'Percy Egno', 'percyehjkugno@gmail.com', NULL, NULL, '$2y$10$K.PmShNbq3LCvgPsoU6p7.W9wa6llR8.a6rHqdYK4e84LSU6x6rba', NULL, NULL, NULL, '2025-04-14 04:28:11', '2025-04-14 04:28:11', NULL, NULL, NULL, NULL, NULL, '07:28:11', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2025-04-14 10:28:11', NULL, NULL),
(58, 'Percy Egno', 'percyeregno@gmail.com', NULL, NULL, '$2y$10$/XDgyB2/VuxC6l2x0yj1.eawjyM1vFGRwjlsHK.l0TOHRIKuifDZW', NULL, NULL, NULL, '2025-04-14 04:58:29', '2025-04-14 04:58:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 19, '2025-04-14 10:58:29', NULL, NULL),
(59, 'Percy Egno', 'percyegnERTo@gmail.com', NULL, NULL, '$2y$10$QhpHtxzV17UB/7w5RKOHnujxqITjc3Ol9.hm1pAR3Hj.tAJgrfrea', NULL, NULL, NULL, '2025-04-14 05:21:30', '2025-04-14 05:21:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 2, NULL, 20, '2025-04-14 11:21:30', NULL, NULL),
(61, 'Percy Egno', 'percewryegno@gmail.com', NULL, NULL, '$2y$10$wzMUE/oQa2Bfj/WK9F1KU.544sB.t4Ox21ul5reKV9KFMx.Vkwc1S', NULL, NULL, NULL, '2025-04-14 05:46:08', '2025-04-14 05:46:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 3, NULL, 14, '2025-04-14 11:46:08', NULL, NULL),
(62, 'Percy Egno', 'percddyegno@gmail.com', NULL, NULL, '$2y$10$KRxpt9tdE8k5KmxsmNfL4e2yAdFJss.5zQQSNELcCjdmjWL2pvNN2', NULL, NULL, NULL, '2025-04-15 05:26:21', '2025-04-15 05:26:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 2, NULL, 21, '2025-04-15 11:26:21', NULL, NULL),
(63, 'Percy Egno', 'percyeddgno@gmail.com', NULL, NULL, '$2y$10$ehEE6ZXyBweJ0G2eU4u.GerUqMsrkc6o1FtmLbRgL0BbYH4woEk32', NULL, NULL, NULL, '2025-04-15 05:26:25', '2025-04-15 05:26:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 1, NULL, 21, '2025-04-15 11:26:25', NULL, NULL),
(64, 'Percy Egno', 'percyemmgno@gmail.com', NULL, NULL, '$2y$10$ehEE6ZXyBweJ0G2eU4u.GerUqMsrkc6o1FtmLbRgL0BbYH4woEk32', NULL, NULL, NULL, '2025-04-15 05:33:35', '2025-04-15 05:33:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 3, NULL, 16, '2025-04-15 11:33:35', NULL, NULL),
(65, 'Brielle Dunlap', 'mijahowuwe@mailinator.com', NULL, NULL, '$2y$10$nPHUmb1f2m3fhN8nlIkzH./l8C75DWyMMRNg3Ak/jggLOoRrMrEH2', NULL, NULL, NULL, '2025-05-03 07:58:41', '2025-05-03 07:58:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (927) 135-4129', NULL, 10, NULL, NULL, '2025-05-03 13:58:41', 'Quibusdam laborum N', NULL),
(66, 'Adria Walton', 'neliqomu@mailinator.com', NULL, NULL, '$2y$10$sA7orRZTdrJGAWE8VRiSAOTpb/FEi9kv2U7Qj9CaifigzAxwn/vHC', NULL, NULL, NULL, '2025-05-03 09:40:22', '2025-05-03 09:40:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (203) 727-6356', NULL, 10, NULL, NULL, '2025-05-03 15:40:22', 'Voluptatem vero ut r', NULL),
(67, 'Serena Gill', 'cuzopiby@mailinator.com', NULL, NULL, '$2y$10$f2Fi36xqf6zutSeDLlVfGu6ZXAvXymCfVc420i56LvOf20EgseeJu', NULL, NULL, NULL, '2025-05-03 14:09:54', '2025-05-03 14:09:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (874) 831-7863', NULL, 10, NULL, NULL, '2025-05-03 20:09:54', 'Tempor qui velit re', NULL),
(68, 'Benedict Booker', 'vepet@mailinator.com', NULL, NULL, '$2y$10$5xYNLsX0eKnadsQECVVq5eoHEQzilJBGtC0LpfkXDcjkaiQL1IfYe', NULL, NULL, NULL, '2025-05-04 11:54:36', '2025-05-04 11:54:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (158) 262-8324', NULL, 10, NULL, NULL, '2025-05-04 17:54:36', 'Vel iste quidem et u', NULL),
(69, 'Isaiah Shannon', 'percyegnoxc@gmail.com', NULL, NULL, '$2y$10$46B8BZo1cGfjdXxgtvcfdumhyJQ6PiHpqiceNeK7Nr/Zi/AkXRksC', NULL, NULL, NULL, '2025-05-05 15:16:14', '2025-05-05 15:16:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '+1 (233) 604-8331', NULL, 3, NULL, 17, '2025-05-05 21:16:14', NULL, NULL),
(70, 'percy', 'percyefffgno@gmail.com', NULL, NULL, '$2y$10$GoJBkqrg/F08FDItoz60Ieu4y1lcNgEyAL1ZgfbcvAjkX/jPAhWkO', NULL, NULL, NULL, '2025-05-06 03:03:34', '2025-05-06 03:03:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0624451311', NULL, 10, NULL, NULL, '2025-05-06 09:03:34', 'kijitonyama', NULL),
(71, 'Mallory Pugh', 'zixozi@mailinator.com', NULL, NULL, '$2y$10$4g.npGZq4JG//b.F.5r2b.MD6/DMIy5QqY.9QjXzy02JrwZQI9Usi', NULL, NULL, NULL, '2025-05-06 04:41:09', '2025-05-06 04:41:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (788) 359-5768', NULL, 10, NULL, NULL, '2025-05-06 10:41:09', 'Nisi sint sed quis', NULL),
(72, 'Percy Egno', 'percyedfsdfsdgno@gmail.com', NULL, '2025-07-22 08:14:56', '$2y$12$lOjHOPDgCpIBieeYSjX.3OHI4/UcLkTr8wdQG/iXLQttRpO1gpAvG', NULL, NULL, NULL, '2025-05-06 12:05:44', '2025-07-22 08:14:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '+255716815887', NULL, 3, NULL, 17, '2025-05-06 18:05:44', NULL, NULL),
(73, 'Nash Rowe', 'jemufeqyb@mailinator.com', NULL, NULL, '$2y$10$hk0.pT0C1nSGXfL0aD2YhuPYxu.B8HT/Xhf5BY8DJiN0nDUls57Au', NULL, NULL, NULL, '2025-05-06 15:18:35', '2025-05-06 15:18:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (527) 676-5493', NULL, 10, NULL, NULL, '2025-05-06 21:18:35', 'Alias necessitatibus', NULL),
(74, 'Rosalyn Coleman', 'likuw@mailinator.com', NULL, NULL, '$2y$10$e3NNNC8HyQB2mbnjaRFL0u.zicqhgrlkrvNTN8yp4WgBZgvrAoTYO', NULL, NULL, NULL, '2025-05-06 20:51:40', '2025-05-06 20:51:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (692) 208-4253', NULL, 10, NULL, NULL, '2025-05-07 02:51:40', 'Numquam eos nisi no', NULL),
(76, 'Britanney Nunez', 'xohetyzof@mailinator.com', NULL, NULL, '$2y$10$xAUU1oUg5QOwIaiwGiHhd.UOq7kPWuU1fzpCcepKcBt3a8x0hiwju', NULL, NULL, NULL, '2025-05-07 06:00:01', '2025-05-07 06:00:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (107) 182-8981', NULL, 10, NULL, NULL, '2025-05-07 12:00:01', 'Ipsa facilis sunt', NULL),
(77, 'Medge Pearson', 'lifebuvu@mailinator.com', NULL, NULL, '$2y$10$7Aysz/BXcYC9cgT0cmTUKu280FmbROmRmaH48S3XOcsTHuZW.cnuS', NULL, NULL, NULL, '2025-05-09 07:18:15', '2025-05-09 07:18:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (152) 624-8633', NULL, 10, NULL, NULL, '2025-05-09 13:18:15', 'Aliquam et molestiae', NULL),
(78, 'Dale Hernandez', 'pexinid@mailinator.com', NULL, NULL, '$2y$10$KImryIJuYgRCLrULX73Iwez32UtAcRwYpn/kBlSXrnuYh6i5ojOdu', NULL, NULL, NULL, '2025-05-10 01:58:49', '2025-05-10 01:58:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (205) 382-6326', NULL, 10, NULL, NULL, '2025-05-10 07:58:49', 'Fugit culpa incidi', NULL),
(79, 'Edward Levine', 'vaxidaf@mailinator.com', NULL, NULL, '$2y$10$Reqnm0Ovoen14.sGsg/0euQwQiKIGeI7MPxssVxSK/4souCjJmTyq', NULL, NULL, NULL, '2025-05-10 02:36:52', '2025-05-10 02:36:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (905) 867-4955', NULL, 10, NULL, NULL, '2025-05-10 08:36:52', 'Repudiandae accusamu', NULL),
(80, 'Hasad York', 'wupezel@mailinator.com', NULL, NULL, '$2y$10$O3b/V1RCxJB0lniP3sumge4u43nWiTM/KQ0tcdx0J4ynplhh1UTwC', NULL, NULL, NULL, '2025-05-13 05:07:21', '2025-05-13 05:07:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (621) 442-6461', NULL, 10, NULL, NULL, '2025-05-13 11:07:21', 'Est duis corporis ea', NULL),
(81, 'Zeus Simon', 'vazuxicim@mailinator.com', NULL, NULL, '$2y$10$vJGIHdcQvYohqJzQQk681.PhkoLqmKl5uNKnyI5EyRJ796I7Woacy', NULL, NULL, NULL, '2025-05-24 12:35:56', '2025-05-24 12:35:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (162) 178-9948', NULL, 10, NULL, NULL, '2025-05-24 18:35:56', 'Aut ipsa architecto', NULL),
(82, 'Juma', 'fastcredit.tz@gmail.com', NULL, NULL, '$2y$10$R8EOU1GlsZAyAo7LD8xCuONlQj4qsgrmarm16/NPjnLuN56xUJKGW', NULL, NULL, NULL, '2025-06-12 03:47:05', '2025-06-12 03:47:05', NULL, NULL, NULL, NULL, NULL, '06:47:05', NULL, NULL, '0716815882', NULL, 1, NULL, NULL, '2025-06-12 09:47:05', NULL, NULL),
(83, 'Wing Duffy', 'ruxihesihi@mailinator.com', NULL, NULL, '$2y$10$6vO7HEMa3IV9FnMuske5a.k33Enxh9SpG8.NPuIxKmIFuydh9vL3e', NULL, NULL, NULL, '2025-06-12 03:51:30', '2025-06-12 03:51:30', NULL, NULL, NULL, NULL, 'ACTIVE', '06:51:30', NULL, NULL, '0767583845', NULL, 1, NULL, NULL, '2025-06-12 09:51:30', NULL, NULL),
(84, 'Talon Finch', 'xafyzanux@mailinator.com', NULL, NULL, '$2y$10$xnOmVDXznTa9DqlOWZrA1eFYm.2uzBr/iLKqV3MgBJ21nTHQdkqry', NULL, NULL, NULL, '2025-06-21 10:37:40', '2025-06-21 10:37:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (673) 777-9271', NULL, 10, NULL, NULL, '2025-06-21 16:37:40', 'In voluptate sunt re', NULL),
(85, 'Idona James', 'qekugot@mailinator.com', NULL, NULL, '$2y$10$qNnv7UvZAhiYQmYCAC4pBu88wBviwyFTXYcBgJpvoTXBTCU7mREJS', NULL, NULL, NULL, '2025-07-21 09:10:51', '2025-07-21 09:10:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (507) 676-7514', NULL, 10, NULL, NULL, '2025-07-21 15:10:51', 'Labore consequatur', NULL),
(86, 'Vladimir Blair', 'wonym@mailinator.com', NULL, NULL, '$2y$10$r0mQmiqFFCzt1oH.AtrNHOmSBk1gNBCRYf6Ifn60Xtier.oOM9dEu', NULL, NULL, NULL, '2025-07-22 02:41:34', '2025-07-22 02:41:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (852) 396-6338', NULL, 10, NULL, NULL, '2025-07-22 08:41:34', 'Recusandae Providen', NULL),
(87, 'Shafira Battle', 'fyxiniqeb@mailinator.com', NULL, NULL, '$2y$10$v8SVUTXrzAkZjI/YFwdrQuNaInhzo6Mb3T.ZgrHH0XeJrJd89B2xS', NULL, NULL, NULL, '2025-07-25 06:42:46', '2025-07-25 06:42:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+1 (626) 648-2141', NULL, 10, NULL, NULL, '2025-07-25 12:42:46', 'Quos quasi aut quo d', NULL),
(88, 'Percy Egno', 'aleck.ngonnshani@wealthora.co.tz', NULL, NULL, '$2y$10$q.e/TwAkqia65EXpHn1B4OWNTH9pXUA5LcZRlyYbQ.IMCIKV3hiSa', NULL, NULL, NULL, '2025-07-25 07:04:33', '2025-07-25 07:04:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0716815881', NULL, 10, NULL, NULL, '2025-07-25 13:04:33', 'Dar Es Salaam, 2113', NULL),
(89, 'Yvette Cohen', 'qijejaxyq@mailinator.com', NULL, '2025-07-25 07:31:27', '$2y$10$i3g1IEPsuVuDAK0s5HhnKewJ4WNb5FTht48J9IBpTQnyKOJAlnkLO', NULL, NULL, NULL, '2025-07-25 07:26:00', '2025-07-25 07:31:27', NULL, NULL, NULL, NULL, NULL, NULL, 486288, NULL, '+1 (124) 922-8401', NULL, 10, NULL, NULL, '2025-07-25 13:26:00', 'Expedita est reicie', NULL),
(90, 'Neil Berry', 'ryno@mailinator.com', NULL, '2025-07-25 07:31:56', '$2y$10$H3SmLRoJam4zKRhBr8.dA./4xat83D.ltRdOIZFd1LiTmAtPSklia', NULL, NULL, NULL, '2025-07-25 07:31:56', '2025-07-25 07:31:56', NULL, NULL, NULL, NULL, NULL, NULL, 111111, NULL, '+1 (727) 363-9883', NULL, 10, NULL, NULL, '2025-07-25 13:31:56', 'Ut adipisci sit sed', NULL),
(91, 'Rina Cabrera', 'myfyz@mailinator.com', NULL, '2025-07-25 08:35:55', '$2y$10$tcff16lzjhap952G2Hcm5.kdu7uIhj9ek2MWtAPWC3ybG3RbRzZ/W', NULL, NULL, NULL, '2025-07-25 08:35:55', '2025-07-25 08:35:55', NULL, NULL, NULL, NULL, NULL, NULL, 111111, NULL, '+1 (137) 556-4185', NULL, 10, NULL, NULL, '2025-07-25 14:35:55', 'Duis sit voluptas t', NULL),
(92, 'Steven Hull', 'winon@mailinator.com', NULL, '2025-08-01 07:06:30', '$2y$10$pU0Z8cl8zIGK4NDashwMy.wXC5XNXcbrrz2ljmLbl0PqWCiYD.XhK', NULL, NULL, NULL, '2025-08-01 07:06:30', '2025-08-01 07:06:30', NULL, NULL, NULL, NULL, NULL, NULL, 111111, NULL, '+1 (523) 482-6001', NULL, 10, NULL, NULL, '2025-08-01 13:06:30', 'Earum impedit sequi', NULL),
(93, 'Justine Cabrera', 'jypycoteky@mailinator.com', NULL, '2025-08-05 03:21:05', '$2y$10$h//KWkPAFlNHbmsqc00vi.61R4MtTkuIsjm/pN3ElAN0cu3nhUGvm', NULL, NULL, NULL, '2025-08-05 03:21:05', '2025-08-05 03:21:05', NULL, NULL, NULL, NULL, NULL, NULL, 103124, NULL, '+1 (491) 444-1174', NULL, 10, NULL, NULL, '2025-08-05 09:21:05', 'Natus enim doloremqu', NULL),
(94, 'Abraham Huff', 'wiqazozovo@mailinator.com', NULL, '2025-08-05 07:01:07', '$2y$10$tGpXgbCDRGBNOKZwAI.2i.SCJnXrmf2CQYTEZX53ablB6DmN7/CYi', NULL, NULL, NULL, '2025-08-05 07:00:16', '2025-08-05 07:00:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '+1 (832) 875-2123', NULL, 10, NULL, NULL, '2025-08-05 13:00:16', 'Possimus quis repre', NULL),
(95, 'juma ali', 'fastcredit.tzmm@gmail.com', NULL, NULL, '$2y$10$q6Hi4egCKZCXsuEaaBjI0.dufIw4DLOUlDy9qkLBd3lSPBPxwTrKK', NULL, NULL, NULL, '2025-08-05 11:51:57', '2025-08-05 11:51:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-05 17:51:57', NULL, NULL),
(96, 'Mussa Kalokola', 'percyegnkko@gmail.com', NULL, '2025-08-16 08:14:54', '$2y$10$UVaRmt9zaWYz3Tp4Ptn9m.C.Hg8VKf35SgeSuHm4s00UoT6jA.q3C', NULL, NULL, NULL, '2025-08-16 08:14:54', '2025-08-16 08:14:54', NULL, NULL, NULL, NULL, NULL, NULL, 111111, NULL, '+255716815881', NULL, 10, NULL, NULL, '2025-08-16 14:14:54', 'Sinza Madukani', NULL),
(97, 'Pevv gfhd', 'fastcrenndit.tz@gmail.com', NULL, NULL, '$2y$10$uHulMssJ94khtMl8PenYHO2.rgbChJ5LOoihWtAYCdnNFMOL/VgxG', NULL, NULL, NULL, '2025-08-16 11:25:50', '2025-08-16 11:25:50', NULL, NULL, NULL, NULL, 'active', NULL, NULL, NULL, '0716815881', NULL, NULL, NULL, NULL, '2025-08-16 17:25:50', NULL, NULL),
(98, 'Yeo Caldwell', 'cogavapul@mailinator.com', NULL, '2025-08-16 16:21:28', '$2y$10$BK..XsIjjmrQjXb443eNqOn3Piy/sJvzHGCFRi4wyYedxZ48yLc1m', NULL, NULL, NULL, '2025-08-16 16:21:28', '2025-08-16 16:21:28', NULL, NULL, NULL, NULL, NULL, NULL, 809952, NULL, '+1 (887) 226-4214', NULL, 10, NULL, NULL, '2025-08-16 22:21:28', 'Qui qui occaecat et', NULL),
(99, 'Kibo Auto Super Admin', 'admin.kiboauto@kiboauto.co.tz', NULL, '2025-09-08 02:50:44', '$2y$10$DE7Kr6zpKsixq949hXFymOkjp1tmeT1OTOqEhTNrg9IdpMIEjcVFm', NULL, NULL, NULL, '2025-09-08 05:46:30', '2025-09-08 02:51:34', NULL, NULL, NULL, NULL, 'ACTIVE', NULL, 111111, '0', '+255123456789', NULL, 2, NULL, 23, '2025-09-08 08:46:30', NULL, NULL),
(100, 'Kibo Auto Admin 02', 'admin02.kiboauto@kiboauto.co.tz', NULL, '2025-09-08 03:06:12', '$2y$10$b6lXzdY1K1pinW18BmgLEO7mzFahvLZ8TGsMDJksvYWaAe0RtB1fG', NULL, NULL, NULL, '2025-09-08 05:46:30', '2025-09-08 03:05:42', NULL, NULL, NULL, NULL, 'ACTIVE', NULL, NULL, '0', '+255123456790', NULL, 1, NULL, NULL, '2025-09-08 08:46:30', NULL, NULL),
(103, 'Gerold', 'percyegnnghhfdtyo@gmail.com', NULL, '2025-09-08 09:12:09', '$2y$10$pikjQANjZu81gTahwLsF8u2yIDsH1xhy28cl/UIgQW/NfBsq50Q0K', NULL, NULL, NULL, '2025-09-08 09:11:39', '2025-09-08 09:12:09', NULL, NULL, NULL, NULL, 'ACTIVE', NULL, 111111, '0', NULL, NULL, 6, NULL, NULL, '2025-09-08 15:11:39', NULL, '4'),
(105, 'Percy Egno', 'percyegnm,yuo@gmail.com', NULL, '2025-09-08 09:53:28', '$2y$10$86GaZqZZrmBwoOdE5tqz3uflbBM/SFK6UCNJukC0kUufl4JIQ.5su', NULL, NULL, NULL, '2025-09-08 09:51:37', '2025-09-08 09:53:10', NULL, NULL, NULL, NULL, 'ACTIVE', NULL, NULL, '0', '0716815881', NULL, 5, NULL, NULL, '2025-09-08 15:51:37', NULL, NULL),
(106, 'Sacha England', 'gaduwipapo@mailinator.com', NULL, '2025-09-08 10:28:00', '$2y$10$70hBfmu84Vl4EJ3RWnHkPuQuFCCQCKZATPxS.spo6xvchZH5dxiEG', NULL, NULL, NULL, '2025-09-08 10:27:36', '2025-09-08 10:27:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '+1 (824) 686-8327', NULL, 10, NULL, NULL, '2025-09-08 16:27:36', 'Est amet aliqua E', NULL),
(107, 'Percy Egno', 'percyegnmmno@gmail.com', NULL, '2025-09-08 19:05:15', '$2y$10$FgkYQ29sFwdYSxvu1SZpMeGuKHYwudYstYJcI0TybL/.P.3jOG3qK', NULL, NULL, NULL, '2025-09-08 19:04:30', '2025-09-09 01:13:07', NULL, NULL, NULL, NULL, 'ACTIVE', NULL, 100995, '0', '+255716815881', NULL, 3, NULL, 20, '2025-09-09 04:13:07', NULL, NULL),
(108, 'Percy Egno', 'percyegno@gmail.com', NULL, '2025-09-09 01:45:20', '$2y$10$2hJa439lyq6/kxKAYBPMn.HWl8U1hKy2FwEmC638j44nXYCIHThPa', NULL, NULL, NULL, '2025-09-09 01:41:56', '2025-09-09 01:45:00', NULL, NULL, NULL, NULL, 'ACTIVE', NULL, NULL, '0', '+255716815889', NULL, 4, NULL, 23, '2025-09-09 07:41:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menus`
--

CREATE TABLE `user_sub_menus` (
  `ID` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `sub_menu_id` int(11) DEFAULT NULL,
  `permission` varchar(50) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `previous` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `make_id` bigint(20) UNSIGNED DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dealer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `body_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fuel_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transmission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `price` bigint(20) UNSIGNED DEFAULT NULL,
  `mileage` int(10) UNSIGNED DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `vin` varchar(255) NOT NULL,
  `engine_size` varchar(255) DEFAULT NULL,
  `engine_type` varchar(255) DEFAULT NULL,
  `horsepower` int(10) UNSIGNED DEFAULT NULL,
  `drivetrain` varchar(255) DEFAULT NULL,
  `length` int(10) UNSIGNED DEFAULT NULL,
  `width` int(10) UNSIGNED DEFAULT NULL,
  `height` int(10) UNSIGNED DEFAULT NULL,
  `wheelbase` int(10) UNSIGNED DEFAULT NULL,
  `seating_capacity` int(10) UNSIGNED DEFAULT NULL,
  `cargo_volume` int(10) UNSIGNED DEFAULT NULL,
  `vehicle_condition` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `trim` varchar(255) DEFAULT NULL,
  `owners` int(10) UNSIGNED DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `car_dealer_id` varchar(80) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active' COMMENT 'Vehicle status: active, on_hold, sold',
  `downPaymentPercent` varchar(25) DEFAULT NULL,
  `is_wedding_car` tinyint(1) DEFAULT 0,
  `rent_price` decimal(15,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `make_id`, `model_id`, `dealer_id`, `body_type_id`, `fuel_type_id`, `transmission_id`, `year`, `price`, `mileage`, `color`, `vin`, `engine_size`, `engine_type`, `horsepower`, `drivetrain`, `length`, `width`, `height`, `wheelbase`, `seating_capacity`, `cargo_volume`, `vehicle_condition`, `description`, `trim`, `owners`, `location`, `is_featured`, `created_at`, `updated_at`, `car_dealer_id`, `status`, `downPaymentPercent`, `is_wedding_car`, `rent_price`) VALUES
(1, 15, 3, 13, 15, 7, 6, 2000, 8000000, 12000, 'black', '457789', '1900', 'LG', 78, 'Lvn', 3, 2, 4, 2, 6, 56, 'good', 'good condition', 'no', 2, 'dar es salaam', 1, '2025-04-30 08:57:11', '2025-05-03 13:33:57', '6', 'active', '40', 1, 45000000.00),
(5, 15, 4, 13, 15, 7, 6, 2015, 75800000, 12000, 'Yellow', '457789', '1900', 'LG', 78, 'Lvn', 3, 2, 4, 2, 6, 56, 'good', 'good condition', 'yes', 2, 'dar es salaam', 1, '2025-04-30 08:57:11', '2025-04-30 08:57:11', '8', 'active', '40', 0, 0.00),
(6, 15, 5, 14, 15, 8, 8, 2020, 75800000, 12000, 'Yellow', '457789', '1900', 'LG', 78, 'Lvn', 3, 2, 4, 2, 6, 56, 'good', 'good condition', 'yes', 2, 'dar es salaam', 1, '2025-04-30 08:57:11', '2025-04-30 08:57:11', '8', 'active', '40', 0, 0.00),
(9, 33, 222, 14, 6, 2, 1, 2025, 999967000, 12000, 'black', '656756673289', '2', '3', 800, 'FWD', NULL, NULL, NULL, NULL, 8, NULL, NULL, 'xxxxxxxx', 'XL', 0, 'Dar Es Salaam', 1, '2025-05-05 15:52:54', '2025-05-05 15:52:54', NULL, 'active', NULL, 0, 0.00),
(10, 39, 360, 14, 6, 2, 1, 2025, 999967000, 12000, 'black', '656756673288', '2', '3', 800, 'FWD', NULL, NULL, NULL, NULL, 8, NULL, NULL, 'xxxxxxxx', 'XL', 0, 'Dar Es Salaam', 1, '2025-05-05 15:55:03', '2025-05-05 15:55:03', NULL, 'active', NULL, 0, 0.00),
(11, 31, 182, 17, 6, 2, 1, 2005, 8977009, 12000, 'gray', '3000476545', '2', '3', 8, 'FWD', NULL, NULL, NULL, NULL, 9, NULL, NULL, 'xxxxxxxxxxxxx', 'XL', 0, 'Dar Es Salaam', 1, '2025-05-05 16:02:35', '2025-05-05 16:45:20', NULL, 'active', NULL, 0, 0.00),
(12, 27, 115, 22, 5, 6, 1, 2025, 8000000000, 12, 'black', '300047643', '2', '3', 4, 'AWD', NULL, NULL, NULL, NULL, 4, NULL, 'Used', 'descriptions descriptionsdescriptionsdescriptionsdescriptionsdescriptionsdescriptionsdescriptionsdescriptionsdescriptionsdescriptionsdescriptions', '', 0, 'KIJITONYAMA', 1, '2025-05-09 18:47:52', '2025-06-11 03:57:56', NULL, 'active', '23', 0, 0.00),
(13, 31, 179, 22, 4, 3, 5, 2025, 60000000, 12000, 'white', '300045646', '2', '3', 4, 'AWD', NULL, NULL, NULL, NULL, 56, NULL, 'Used', 'fgsrthtyhrftyfyjhynhj', 'XL', 0, 'KIJITONYAMA', 1, '2025-05-09 19:05:26', '2025-06-12 05:59:26', NULL, 'sold', '40', 0, 0.00),
(14, 52, 385, 22, 6, 2, 3, 2025, 600000, 12000, 'gray', '30004765454', '2', '3', 700, 'AWD', NULL, NULL, NULL, NULL, 6, NULL, 'Certified Pre-Owned', 'car condition is good ', 'XL', 0, 'KIJITONYAMA', 1, '2025-06-12 05:56:52', '2025-08-01 15:19:59', NULL, 'active', '40', 0, 0.00),
(15, 49, 655, 17, 5, 3, 1, 2025, 40000000, 12000, 'gray-white', '1HJDH449NN', '2L', 'V4', 400, 'AWD', NULL, NULL, NULL, NULL, 5, NULL, 'Used', 'Car with good condition and fit for family uses', 'Limited', 0, 'Dar es salaam', 1, '2025-07-25 09:27:33', '2025-08-01 15:14:47', NULL, 'active', '', 1, 0.00),
(16, 122, 1472, 20, 5, 3, 3, 2010, 56000000, 90000, 'gray-white', '3000476545ew', '2', '3', 300, 'RWD', NULL, NULL, NULL, NULL, 6, NULL, 'Used', 'Lower resale value, limited parts availability, and reliability concerns have been noted in markets like the UAE. Service network and advanced features may be less comprehensive than more established competitors', 'XL', 0, 'KIJITONYAMA', 1, '2025-09-09 01:09:57', '2025-09-09 01:26:21', NULL, 'active', NULL, 0, 0.00),
(17, 94, 1013, 16, 9, 3, 1, 2023, 60000000, 0, 'black', '65675667323eHkh', '2', '3v', 500, 'RWD', NULL, NULL, NULL, NULL, 7, NULL, 'New', 'The Buick Envision is a stylish and refined compact SUV that blends comfort, advanced technology, and confident performance. With its sculpted exterior design and a spacious, premium interior, the Envision offers a quiet, comfortable ride that makes every journey enjoyable.\n\nDepending on the trim level, the Envision comes equipped with a variety of high-end features such as:\n\nLeather-appointed seating\n\nHeated and ventilated front seats\n\nPanoramic moonroof\n\nBuick Infotainment System with Apple CarPlay® and Android Auto™\n\nDriver-assistance technologies like Lane Keep Assist, Forward Collision Alert, and Adaptive Cruise Control\n\nUnder the hood, the Envision typically features a turbocharged 2.0L engine paired with a smooth-shifting 9-speed automatic transmission, offering a balanced combination of power and efficiency.', 'Sport', 0, 'Dar Es Salaam', 0, '2025-09-15 06:34:22', '2025-09-15 06:34:22', NULL, 'active', NULL, 0, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_images`
--

CREATE TABLE `vehicle_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `view` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_images`
--

INSERT INTO `vehicle_images` (`id`, `vehicle_id`, `image_url`, `is_featured`, `created_at`, `updated_at`, `view`) VALUES
(2, 10, NULL, 0, '2025-05-05 15:55:03', '2025-05-05 15:55:03', NULL),
(3, 10, NULL, 0, '2025-05-05 15:55:03', '2025-05-05 15:55:03', NULL),
(4, 11, 'vehicles/11/J3ITTFQzGTE1MCBySLDgycPavrdovEM9E7rmu5Bf.png', 0, '2025-05-05 16:02:35', '2025-05-05 16:02:35', NULL),
(6, 11, 'vehicles/11/8C0vpsXKvMP6UpN49TN14vZTqGjj9mzAlno9hVLm.png', 0, '2025-05-05 16:02:35', '2025-05-05 16:02:35', NULL),
(7, 11, 'vehicles/11/NFYce9e0TpVnc7SeDREWzwSuX3cjcBFJ0NGFSIaT.jpg', 0, '2025-05-05 16:28:48', '2025-05-05 16:28:48', NULL),
(8, 12, 'vehicles/12/hJRIfaCrzgY3omeWaAbyc6WZIcnXB06E6bdkSadb.jpg', 0, '2025-05-09 18:47:52', '2025-05-09 18:47:52', 'side'),
(10, 12, 'vehicles/12/E4KfzAhT5fUX58r9QdZWmSyJhSwwaEb9DhgTP169.png', 0, '2025-05-09 18:47:52', '2025-05-09 18:47:52', 'additional'),
(11, 13, 'vehicles/13/L3OTRRT95vSyZtbIt4fbx9JOaVXr5mGCpvXsTkbB.png', 1, '2025-05-09 19:05:26', '2025-05-09 19:05:26', 'front'),
(14, 13, 'vehicles/13/22PYGrxsk0fZUP8dnKyBhUgUtrfCD1XGo1IF2yD8.png', 0, '2025-05-09 19:05:26', '2025-05-09 19:05:26', 'additional'),
(15, 13, 'vehicles/13/ueBDEao8eYPsp6hdQpmLAxFSS1rtqjhorIBVyqmE.png', 0, '2025-05-09 19:05:26', '2025-05-09 19:05:26', 'additional'),
(17, 13, 'vehicles/13/iLrycaGpCk7zYmZHuytbEvYS5QBqkrGzOB93QgMH.png', 0, '2025-05-09 19:05:26', '2025-05-09 19:05:26', 'additional'),
(18, 14, 'vehicles/14/hkXPmSeM8Qa2BH8r4Nwl8s4Jyr0cjZx2vTguvGVX.png', 1, '2025-06-12 05:56:52', '2025-06-12 05:56:52', 'front'),
(19, 14, 'vehicles/14/9mhw8Ijug8jshVH8xQNy998SaquNNezSerq38uBo.png', 0, '2025-06-12 05:56:52', '2025-06-12 05:56:52', 'side'),
(20, 14, 'vehicles/14/hhf91Y6JBRD34cdGKiFnyoL3bxHm4XT9jEMCCqiR.png', 0, '2025-06-12 05:56:52', '2025-06-12 05:56:52', 'additional'),
(22, 15, 'vehicles/15/front_1753446453_688378350d844.webp', 1, '2025-07-25 09:27:33', '2025-07-25 09:27:33', 'front'),
(23, 15, 'vehicles/15/side_1753446453_688378351e2dd.webp', 0, '2025-07-25 09:27:33', '2025-07-25 09:27:33', 'side'),
(24, 15, 'vehicles/15/back_1753446453_688378352b015.webp', 0, '2025-07-25 09:27:33', '2025-07-25 09:27:33', 'back'),
(25, 15, 'vehicles/15/additional_0_1753446453_688378353472e.webp', 0, '2025-07-25 09:27:33', '2025-07-25 09:27:33', 'additional'),
(26, 16, 'vehicles/16/front_1757390997_68bfa89549f8d.webp', 1, '2025-09-09 01:09:57', '2025-09-09 01:09:57', 'front'),
(27, 16, 'vehicles/16/side_1757390997_68bfa8955cd00.webp', 0, '2025-09-09 01:09:57', '2025-09-09 01:09:57', 'side'),
(29, 16, 'vehicles/16/additional_0_1757390997_68bfa89586d0f.webp', 0, '2025-09-09 01:09:57', '2025-09-09 01:09:57', 'additional'),
(30, 16, 'vehicles/16/additional_1_1757390997_68bfa89595d83.webp', 0, '2025-09-09 01:09:57', '2025-09-09 01:09:57', 'additional'),
(31, 16, 'vehicles/16/back_1757391656_68bfab283b203.webp', 0, '2025-09-09 01:20:56', '2025-09-09 01:20:56', 'back'),
(32, 17, 'vehicles/17/front_1757928862_68c7dd9e08727.webp', 1, '2025-09-15 06:34:22', '2025-09-15 06:34:22', 'front'),
(33, 17, 'vehicles/17/side_1757928862_68c7dd9e0bed5.webp', 0, '2025-09-15 06:34:22', '2025-09-15 06:34:22', 'side'),
(34, 17, 'vehicles/17/back_1757928862_68c7dd9e0e12a.webp', 0, '2025-09-15 06:34:22', '2025-09-15 06:34:22', 'back'),
(35, 17, 'vehicles/17/additional_0_1757928862_68c7dd9e10204.webp', 0, '2025-09-15 06:34:22', '2025-09-15 06:34:22', 'additional'),
(36, 17, 'vehicles/17/additional_1_1757928862_68c7dd9e11e36.webp', 0, '2025-09-15 06:34:22', '2025-09-15 06:34:22', 'additional'),
(37, 17, 'vehicles/17/additional_2_1757928862_68c7dd9e139d9.webp', 0, '2025-09-15 06:34:22', '2025-09-15 06:34:22', 'additional'),
(38, 17, 'vehicles/17/additional_3_1757928862_68c7dd9e15962.webp', 0, '2025-09-15 06:34:22', '2025-09-15 06:34:22', 'additional');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_models`
--

CREATE TABLE `vehicle_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `make_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_models`
--

INSERT INTO `vehicle_models` (`id`, `make_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 23, 'Alhambra', NULL, NULL),
(2, 23, 'Altea', NULL, NULL),
(3, 23, 'Altea XL', NULL, NULL),
(4, 23, 'Arosa', NULL, NULL),
(5, 23, 'Cordoba', NULL, NULL),
(6, 23, 'Cordoba Vario', NULL, NULL),
(7, 23, 'Exeo', NULL, NULL),
(8, 23, 'Ibiza', NULL, NULL),
(9, 23, 'Ibiza ST', NULL, NULL),
(10, 23, 'Exeo ST', NULL, NULL),
(11, 23, 'Leon', NULL, NULL),
(12, 23, 'Leon ST', NULL, NULL),
(13, 23, 'Inca', NULL, NULL),
(14, 23, 'Mii', NULL, NULL),
(15, 23, 'Toledo', NULL, NULL),
(16, 24, 'Captur', NULL, NULL),
(17, 24, 'Clio', NULL, NULL),
(18, 24, 'Clio Grandtour', NULL, NULL),
(19, 24, 'Espace', NULL, NULL),
(20, 24, 'Express', NULL, NULL),
(21, 24, 'Fluence', NULL, NULL),
(22, 24, 'Grand Espace', NULL, NULL),
(23, 24, 'Grand Modus', NULL, NULL),
(24, 24, 'Grand Scenic', NULL, NULL),
(25, 24, 'Kadjar', NULL, NULL),
(26, 24, 'Kangoo', NULL, NULL),
(27, 24, 'Kangoo Express', NULL, NULL),
(28, 24, 'Koleos', NULL, NULL),
(29, 24, 'Laguna', NULL, NULL),
(30, 24, 'Laguna Grandtour', NULL, NULL),
(31, 24, 'Latitude', NULL, NULL),
(32, 24, 'Mascott', NULL, NULL),
(33, 24, 'Mégane', NULL, NULL),
(34, 24, 'Mégane CC', NULL, NULL),
(35, 24, 'Mégane Combi', NULL, NULL),
(36, 24, 'Mégane Grandtour', NULL, NULL),
(37, 24, 'Mégane Coupé', NULL, NULL),
(38, 24, 'Mégane Scénic', NULL, NULL),
(39, 24, 'Scénic', NULL, NULL),
(40, 24, 'Talisman', NULL, NULL),
(41, 24, 'Talisman Grandtour', NULL, NULL),
(42, 24, 'Thalia', NULL, NULL),
(43, 24, 'Twingo', NULL, NULL),
(44, 24, 'Wind', NULL, NULL),
(45, 24, 'Zoé', NULL, NULL),
(46, 25, '1007', NULL, NULL),
(47, 25, '107', NULL, NULL),
(48, 25, '106', NULL, NULL),
(49, 25, '108', NULL, NULL),
(50, 25, '2008', NULL, NULL),
(51, 25, '205', NULL, NULL),
(52, 25, '205 Cabrio', NULL, NULL),
(53, 25, '206', NULL, NULL),
(54, 25, '206 CC', NULL, NULL),
(55, 25, '206 SW', NULL, NULL),
(56, 25, '207', NULL, NULL),
(57, 25, '207 CC', NULL, NULL),
(58, 25, '207 SW', NULL, NULL),
(59, 25, '306', NULL, NULL),
(60, 25, '307', NULL, NULL),
(61, 25, '307 CC', NULL, NULL),
(62, 25, '307 SW', NULL, NULL),
(63, 25, '308', NULL, NULL),
(64, 25, '308 CC', NULL, NULL),
(65, 25, '308 SW', NULL, NULL),
(66, 25, '309', NULL, NULL),
(67, 25, '4007', NULL, NULL),
(68, 25, '4008', NULL, NULL),
(69, 25, '405', NULL, NULL),
(70, 25, '406', NULL, NULL),
(71, 25, '407', NULL, NULL),
(72, 25, '407 SW', NULL, NULL),
(73, 25, '5008', NULL, NULL),
(74, 25, '508', NULL, NULL),
(75, 25, '508 SW', NULL, NULL),
(76, 25, '605', NULL, NULL),
(77, 25, '806', NULL, NULL),
(78, 25, '607', NULL, NULL),
(79, 25, '807', NULL, NULL),
(80, 25, 'Bipper', NULL, NULL),
(81, 25, 'RCZ', NULL, NULL),
(82, 26, 'Dokker', NULL, NULL),
(83, 26, 'Duster', NULL, NULL),
(84, 26, 'Lodgy', NULL, NULL),
(85, 26, 'Logan', NULL, NULL),
(86, 26, 'Logan MCV', NULL, NULL),
(87, 26, 'Logan Van', NULL, NULL),
(88, 26, 'Sandero', NULL, NULL),
(89, 26, 'Solenza', NULL, NULL),
(90, 27, 'Berlingo', NULL, NULL),
(91, 27, 'C-Crosser', NULL, NULL),
(92, 27, 'C-Elissée', NULL, NULL),
(93, 27, 'C-Zero', NULL, NULL),
(94, 27, 'C1', NULL, NULL),
(95, 27, 'C2', NULL, NULL),
(96, 27, 'C3', NULL, NULL),
(97, 27, 'C3 Picasso', NULL, NULL),
(98, 27, 'C4', NULL, NULL),
(99, 27, 'C4 Aircross', NULL, NULL),
(100, 27, 'C4 Cactus', NULL, NULL),
(101, 27, 'C4 Coupé', NULL, NULL),
(102, 27, 'C4 Grand Picasso', NULL, NULL),
(103, 27, 'C4 Sedan', NULL, NULL),
(104, 27, 'C5', NULL, NULL),
(105, 27, 'C5 Break', NULL, NULL),
(106, 27, 'C5 Tourer', NULL, NULL),
(107, 27, 'C6', NULL, NULL),
(108, 27, 'C8', NULL, NULL),
(109, 27, 'DS3', NULL, NULL),
(110, 27, 'DS4', NULL, NULL),
(111, 27, 'DS5', NULL, NULL),
(112, 27, 'Evasion', NULL, NULL),
(113, 27, 'Jumper', NULL, NULL),
(114, 27, 'Jumpy', NULL, NULL),
(115, 27, 'Saxo', NULL, NULL),
(116, 27, 'Nemo', NULL, NULL),
(117, 27, 'Xantia', NULL, NULL),
(118, 27, 'Xsara', NULL, NULL),
(119, 28, 'Agila', NULL, NULL),
(120, 28, 'Ampera', NULL, NULL),
(121, 28, 'Antara', NULL, NULL),
(122, 28, 'Astra', NULL, NULL),
(123, 28, 'Astra cabrio', NULL, NULL),
(124, 28, 'Astra caravan', NULL, NULL),
(125, 28, 'Astra coupé', NULL, NULL),
(126, 28, 'Calibra', NULL, NULL),
(127, 28, 'Campo', NULL, NULL),
(128, 28, 'Cascada', NULL, NULL),
(129, 28, 'Corsa', NULL, NULL),
(130, 28, 'Frontera', NULL, NULL),
(131, 28, 'Insignia', NULL, NULL),
(132, 28, 'Insignia kombi', NULL, NULL),
(133, 28, 'Kadett', NULL, NULL),
(134, 28, 'Meriva', NULL, NULL),
(135, 28, 'Mokka', NULL, NULL),
(136, 28, 'Movano', NULL, NULL),
(137, 28, 'Omega', NULL, NULL),
(138, 28, 'Signum', NULL, NULL),
(139, 28, 'Vectra', NULL, NULL),
(140, 28, 'Vectra Caravan', NULL, NULL),
(141, 28, 'Vivaro', NULL, NULL),
(142, 28, 'Vivaro Kombi', NULL, NULL),
(143, 28, 'Zafira', NULL, NULL),
(144, 29, '145', NULL, NULL),
(145, 29, '146', NULL, NULL),
(146, 29, '147', NULL, NULL),
(147, 29, '155', NULL, NULL),
(148, 29, '156', NULL, NULL),
(149, 29, '156 Sportwagon', NULL, NULL),
(150, 29, '159', NULL, NULL),
(151, 29, '159 Sportwagon', NULL, NULL),
(152, 29, '164', NULL, NULL),
(153, 29, '166', NULL, NULL),
(154, 29, '4C', NULL, NULL),
(155, 29, 'Brera', NULL, NULL),
(156, 29, 'GTV', NULL, NULL),
(157, 29, 'MiTo', NULL, NULL),
(158, 29, 'Crosswagon', NULL, NULL),
(159, 29, 'Spider', NULL, NULL),
(160, 29, 'GT', NULL, NULL),
(161, 29, 'Giulietta', NULL, NULL),
(162, 29, 'Giulia', NULL, NULL),
(163, 30, 'Favorit', NULL, NULL),
(164, 30, 'Felicia', NULL, NULL),
(165, 30, 'Citigo', NULL, NULL),
(166, 30, 'Fabia', NULL, NULL),
(167, 30, 'Fabia Combi', NULL, NULL),
(168, 30, 'Fabia Sedan', NULL, NULL),
(169, 30, 'Felicia Combi', NULL, NULL),
(170, 30, 'Octavia', NULL, NULL),
(171, 30, 'Octavia Combi', NULL, NULL),
(172, 30, 'Roomster', NULL, NULL),
(173, 30, 'Yeti', NULL, NULL),
(174, 30, 'Rapid', NULL, NULL),
(175, 30, 'Rapid Spaceback', NULL, NULL),
(176, 30, 'Superb', NULL, NULL),
(177, 30, 'Superb Combi', NULL, NULL),
(178, 31, 'Alero', NULL, NULL),
(179, 31, 'Aveo', NULL, NULL),
(180, 31, 'Camaro', NULL, NULL),
(181, 31, 'Captiva', NULL, NULL),
(182, 31, 'Corvette', NULL, NULL),
(183, 31, 'Cruze', NULL, NULL),
(184, 31, 'Cruze SW', NULL, NULL),
(185, 31, 'Epica', NULL, NULL),
(186, 31, 'Equinox', NULL, NULL),
(187, 31, 'Evanda', NULL, NULL),
(188, 31, 'HHR', NULL, NULL),
(189, 31, 'Kalos', NULL, NULL),
(190, 31, 'Lacetti', NULL, NULL),
(191, 31, 'Lacetti SW', NULL, NULL),
(192, 31, 'Lumina', NULL, NULL),
(193, 31, 'Malibu', NULL, NULL),
(194, 31, 'Matiz', NULL, NULL),
(195, 31, 'Monte Carlo', NULL, NULL),
(196, 31, 'Nubira', NULL, NULL),
(197, 31, 'Orlando', NULL, NULL),
(198, 31, 'Spark', NULL, NULL),
(199, 31, 'Suburban', NULL, NULL),
(200, 31, 'Tacuma', NULL, NULL),
(201, 31, 'Tahoe', NULL, NULL),
(202, 31, 'Trax', NULL, NULL),
(203, 32, '911 Carrera', NULL, NULL),
(204, 32, '911 Carrera Cabrio', NULL, NULL),
(205, 32, '911 Targa', NULL, NULL),
(206, 32, '911 Turbo', NULL, NULL),
(207, 32, '924', NULL, NULL),
(208, 32, '944', NULL, NULL),
(209, 32, '997', NULL, NULL),
(210, 32, 'Boxster', NULL, NULL),
(211, 32, 'Cayenne', NULL, NULL),
(212, 32, 'Cayman', NULL, NULL),
(213, 32, 'Macan', NULL, NULL),
(214, 32, 'Panamera', NULL, NULL),
(215, 33, 'Accord', NULL, NULL),
(216, 33, 'Accord Coupé', NULL, NULL),
(217, 33, 'Accord Tourer', NULL, NULL),
(218, 33, 'City', NULL, NULL),
(219, 33, 'Civic', NULL, NULL),
(220, 33, 'Civic Aerodeck', NULL, NULL),
(221, 33, 'Civic Coupé', NULL, NULL),
(222, 33, 'Civic Tourer', NULL, NULL),
(223, 33, 'Civic Type R', NULL, NULL),
(224, 33, 'CR-V', NULL, NULL),
(225, 33, 'CR-X', NULL, NULL),
(226, 33, 'CR-Z', NULL, NULL),
(227, 33, 'FR-V', NULL, NULL),
(228, 33, 'HR-V', NULL, NULL),
(229, 33, 'Insight', NULL, NULL),
(230, 33, 'Integra', NULL, NULL),
(231, 33, 'Jazz', NULL, NULL),
(232, 33, 'Legend', NULL, NULL),
(233, 33, 'Prelude', NULL, NULL),
(234, 34, 'BRZ', NULL, NULL),
(235, 34, 'Forester', NULL, NULL),
(236, 34, 'Impreza', NULL, NULL),
(237, 34, 'Impreza Wagon', NULL, NULL),
(238, 34, 'Justy', NULL, NULL),
(239, 34, 'Legacy', NULL, NULL),
(240, 34, 'Legacy Wagon', NULL, NULL),
(241, 34, 'Legacy Outback', NULL, NULL),
(242, 34, 'Levorg', NULL, NULL),
(243, 34, 'Outback', NULL, NULL),
(244, 34, 'SVX', NULL, NULL),
(245, 34, 'Tribeca', NULL, NULL),
(246, 34, 'Tribeca B9', NULL, NULL),
(247, 34, 'XV', NULL, NULL),
(248, 35, '121', NULL, NULL),
(249, 35, '2', NULL, NULL),
(250, 35, '3', NULL, NULL),
(251, 35, '323', NULL, NULL),
(252, 35, '323 Combi', NULL, NULL),
(253, 35, '323 Coupé', NULL, NULL),
(254, 35, '323 F', NULL, NULL),
(255, 35, '5', NULL, NULL),
(256, 35, '6', NULL, NULL),
(257, 35, '6 Combi', NULL, NULL),
(258, 35, '626', NULL, NULL),
(259, 35, '626 Combi', NULL, NULL),
(260, 35, 'B-Fighter', NULL, NULL),
(261, 35, 'B2500', NULL, NULL),
(262, 35, 'BT', NULL, NULL),
(263, 35, 'CX-3', NULL, NULL),
(264, 35, 'CX-5', NULL, NULL),
(265, 35, 'CX-7', NULL, NULL),
(266, 35, 'CX-9', NULL, NULL),
(267, 35, 'Demio', NULL, NULL),
(268, 35, 'MPV', NULL, NULL),
(269, 35, 'MX-3', NULL, NULL),
(270, 35, 'MX-5', NULL, NULL),
(271, 35, 'MX-6', NULL, NULL),
(272, 35, 'Premacy', NULL, NULL),
(273, 35, 'RX-7', NULL, NULL),
(274, 35, 'RX-8', NULL, NULL),
(275, 35, 'Xedox 6', NULL, NULL),
(276, 36, '3000 GT', NULL, NULL),
(277, 36, 'ASX', NULL, NULL),
(278, 36, 'Carisma', NULL, NULL),
(279, 36, 'Colt', NULL, NULL),
(280, 36, 'Colt CC', NULL, NULL),
(281, 36, 'Eclipse', NULL, NULL),
(282, 36, 'Fuso canter', NULL, NULL),
(283, 36, 'Galant', NULL, NULL),
(284, 36, 'Galant Combi', NULL, NULL),
(285, 36, 'Grandis', NULL, NULL),
(286, 36, 'L200', NULL, NULL),
(287, 36, 'L200 Pick up', NULL, NULL),
(288, 36, 'L200 Pick up Allrad', NULL, NULL),
(289, 36, 'L300', NULL, NULL),
(290, 36, 'Lancer', NULL, NULL),
(291, 36, 'Lancer Combi', NULL, NULL),
(292, 36, 'Lancer Evo', NULL, NULL),
(293, 36, 'Lancer Sportback', NULL, NULL),
(294, 36, 'Outlander', NULL, NULL),
(295, 36, 'Pajero', NULL, NULL),
(296, 36, 'Pajeto Pinin', NULL, NULL),
(297, 36, 'Pajero Pinin Wagon', NULL, NULL),
(298, 36, 'Pajero Sport', NULL, NULL),
(299, 36, 'Pajero Wagon', NULL, NULL),
(300, 36, 'Space Star', NULL, NULL),
(301, 37, 'CT', NULL, NULL),
(302, 37, 'GS', NULL, NULL),
(303, 37, 'GS 300', NULL, NULL),
(304, 37, 'GX', NULL, NULL),
(305, 37, 'IS', NULL, NULL),
(306, 37, 'IS 200', NULL, NULL),
(307, 37, 'IS 250 C', NULL, NULL),
(308, 37, 'IS-F', NULL, NULL),
(309, 37, 'LS', NULL, NULL),
(310, 37, 'LX', NULL, NULL),
(311, 37, 'NX', NULL, NULL),
(312, 37, 'RC F', NULL, NULL),
(313, 37, 'RX', NULL, NULL),
(314, 37, 'RX 300', NULL, NULL),
(315, 37, 'RX 400h', NULL, NULL),
(316, 37, 'RX 450h', NULL, NULL),
(317, 37, 'SC 430', NULL, NULL),
(318, 38, '4-Runner', NULL, NULL),
(319, 38, 'Auris', NULL, NULL),
(320, 38, 'Avensis', NULL, NULL),
(321, 38, 'Avensis Combi', NULL, NULL),
(322, 38, 'Avensis Van Verso', NULL, NULL),
(323, 38, 'Aygo', NULL, NULL),
(324, 38, 'Camry', NULL, NULL),
(325, 38, 'Carina', NULL, NULL),
(326, 38, 'Celica', NULL, NULL),
(327, 38, 'Corolla', NULL, NULL),
(328, 38, 'Corolla Combi', NULL, NULL),
(329, 38, 'Corolla sedan', NULL, NULL),
(330, 38, 'Corolla Verso', NULL, NULL),
(331, 38, 'FJ Cruiser', NULL, NULL),
(332, 38, 'GT86', NULL, NULL),
(333, 38, 'Hiace', NULL, NULL),
(334, 38, 'Hiace Van', NULL, NULL),
(335, 38, 'Highlander', NULL, NULL),
(336, 38, 'Hilux', NULL, NULL),
(337, 38, 'Land Cruiser', NULL, NULL),
(338, 38, 'MR2', NULL, NULL),
(339, 38, 'Paseo', NULL, NULL),
(340, 38, 'Picnic', NULL, NULL),
(341, 38, 'Prius', NULL, NULL),
(342, 38, 'RAV4', NULL, NULL),
(343, 38, 'Sequoia', NULL, NULL),
(344, 38, 'Starlet', NULL, NULL),
(345, 38, 'Supra', NULL, NULL),
(346, 38, 'Tundra', NULL, NULL),
(347, 38, 'Urban Cruiser', NULL, NULL),
(348, 38, 'Verso', NULL, NULL),
(349, 38, 'Yaris', NULL, NULL),
(350, 38, 'Yaris Verso', NULL, NULL),
(351, 39, 'i3', NULL, NULL),
(352, 39, 'i8', NULL, NULL),
(353, 39, 'M3', NULL, NULL),
(354, 39, 'M4', NULL, NULL),
(355, 39, 'M5', NULL, NULL),
(356, 39, 'M6', NULL, NULL),
(357, 39, 'Rad 1', NULL, NULL),
(358, 39, 'Rad 1 Cabrio', NULL, NULL),
(359, 39, 'Rad 1 Coupé', NULL, NULL),
(360, 39, 'Rad 2', NULL, NULL),
(361, 39, 'Rad 2 Active Tourer', NULL, NULL),
(362, 39, 'Rad 2 Coupé', NULL, NULL),
(363, 39, 'Rad 2 Gran Tourer', NULL, NULL),
(364, 39, 'Rad 3', NULL, NULL),
(365, 39, 'Rad 3 Cabrio', NULL, NULL),
(366, 39, 'Rad 3 Compact', NULL, NULL),
(367, 39, 'Rad 3 Coupé', NULL, NULL),
(368, 39, 'Rad 3 GT', NULL, NULL),
(369, 39, 'Rad 3 Touring', NULL, NULL),
(370, 39, 'Rad 4', NULL, NULL),
(371, 39, 'Rad 4 Cabrio', NULL, NULL),
(372, 39, 'Rad 4 Gran Coupé', NULL, NULL),
(373, 39, 'Rad 5', NULL, NULL),
(374, 39, 'Rad 5 GT', NULL, NULL),
(375, 39, 'Rad 5 Touring', NULL, NULL),
(376, 39, 'Rad 6', NULL, NULL),
(377, 39, 'Rad 6 Cabrio', NULL, NULL),
(378, 39, 'Rad 6 Coupé', NULL, NULL),
(379, 39, 'Rad 6 Gran Coupé', NULL, NULL),
(380, 39, 'Rad 7', NULL, NULL),
(381, 39, 'Rad 8 Coupé', NULL, NULL),
(382, 39, 'X1', NULL, NULL),
(383, 39, 'X3', NULL, NULL),
(384, 39, 'X4', NULL, NULL),
(385, 39, 'X5', NULL, NULL),
(386, 39, 'X6', NULL, NULL),
(387, 39, 'Z3', NULL, NULL),
(388, 39, 'Z3 Coupé', NULL, NULL),
(389, 39, 'Z3 Roadster', NULL, NULL),
(390, 39, 'Z4', NULL, NULL),
(391, 39, 'Z4 Roadster', NULL, NULL),
(392, 40, 'Amarok', NULL, NULL),
(393, 40, 'Beetle', NULL, NULL),
(394, 40, 'Bora', NULL, NULL),
(395, 40, 'Bora Variant', NULL, NULL),
(396, 40, 'Caddy', NULL, NULL),
(397, 40, 'Caddy Van', NULL, NULL),
(398, 40, 'Life', NULL, NULL),
(399, 40, 'California', NULL, NULL),
(400, 40, 'Caravelle', NULL, NULL),
(401, 40, 'CC', NULL, NULL),
(402, 40, 'Crafter', NULL, NULL),
(403, 40, 'Crafter Van', NULL, NULL),
(404, 40, 'Crafter Kombi', NULL, NULL),
(405, 40, 'CrossTouran', NULL, NULL),
(406, 40, 'Eos', NULL, NULL),
(407, 40, 'Fox', NULL, NULL),
(408, 40, 'Golf', NULL, NULL),
(409, 40, 'Golf Cabrio', NULL, NULL),
(410, 40, 'Golf Plus', NULL, NULL),
(411, 40, 'Golf Sportvan', NULL, NULL),
(412, 40, 'Golf Variant', NULL, NULL),
(413, 40, 'Jetta', NULL, NULL),
(414, 40, 'LT', NULL, NULL),
(415, 40, 'Lupo', NULL, NULL),
(416, 40, 'Multivan', NULL, NULL),
(417, 40, 'New Beetle', NULL, NULL),
(418, 40, 'New Beetle Cabrio', NULL, NULL),
(419, 40, 'Passat', NULL, NULL),
(420, 40, 'Passat Alltrack', NULL, NULL),
(421, 40, 'Passat CC', NULL, NULL),
(422, 40, 'Passat Variant', NULL, NULL),
(423, 40, 'Passat Variant Van', NULL, NULL),
(424, 40, 'Phaeton', NULL, NULL),
(425, 40, 'Polo', NULL, NULL),
(426, 40, 'Polo Van', NULL, NULL),
(427, 40, 'Polo Variant', NULL, NULL),
(428, 40, 'Scirocco', NULL, NULL),
(429, 40, 'Sharan', NULL, NULL),
(430, 40, 'T4', NULL, NULL),
(431, 40, 'T4 Caravelle', NULL, NULL),
(432, 40, 'T4 Multivan', NULL, NULL),
(433, 40, 'T5', NULL, NULL),
(434, 40, 'T5 Caravelle', NULL, NULL),
(435, 40, 'T5 Multivan', NULL, NULL),
(436, 40, 'T5 Transporter Shuttle', NULL, NULL),
(437, 40, 'Tiguan', NULL, NULL),
(438, 40, 'Touareg', NULL, NULL),
(439, 40, 'Touran', NULL, NULL),
(440, 41, 'Alto', NULL, NULL),
(441, 41, 'Baleno', NULL, NULL),
(442, 41, 'Baleno kombi', NULL, NULL),
(443, 41, 'Grand Vitara', NULL, NULL),
(444, 41, 'Grand Vitara XL-7', NULL, NULL),
(445, 41, 'Ignis', NULL, NULL),
(446, 41, 'Jimny', NULL, NULL),
(447, 41, 'Kizashi', NULL, NULL),
(448, 41, 'Liana', NULL, NULL),
(449, 41, 'Samurai', NULL, NULL),
(450, 41, 'Splash', NULL, NULL),
(451, 41, 'Swift', NULL, NULL),
(452, 41, 'SX4', NULL, NULL),
(453, 41, 'SX4 Sedan', NULL, NULL),
(454, 41, 'Vitara', NULL, NULL),
(455, 41, 'Wagon R+', NULL, NULL),
(456, 42, '100 D', NULL, NULL),
(457, 42, '115', NULL, NULL),
(458, 42, '124', NULL, NULL),
(459, 42, '126', NULL, NULL),
(460, 42, '190', NULL, NULL),
(461, 42, '190 D', NULL, NULL),
(462, 42, '190 E', NULL, NULL),
(463, 42, '200 - 300', NULL, NULL),
(464, 42, '200 D', NULL, NULL),
(465, 42, '200 E', NULL, NULL),
(466, 42, '210 Van', NULL, NULL),
(467, 42, '210 kombi', NULL, NULL),
(468, 42, '310 Van', NULL, NULL),
(469, 42, '310 kombi', NULL, NULL),
(470, 42, '230 - 300 CE Coupé', NULL, NULL),
(471, 42, '260 - 560 SE', NULL, NULL),
(472, 42, '260 - 560 SEL', NULL, NULL),
(473, 42, '500 - 600 SEC Coupé', NULL, NULL),
(474, 42, 'Trieda A', NULL, NULL),
(475, 42, 'A', NULL, NULL),
(476, 42, 'A L', NULL, NULL),
(477, 42, 'AMG GT', NULL, NULL),
(478, 42, 'Trieda B', NULL, NULL),
(479, 42, 'Trieda C', NULL, NULL),
(480, 42, 'C', NULL, NULL),
(481, 42, 'C Sportcoupé', NULL, NULL),
(482, 42, 'C T', NULL, NULL),
(483, 42, 'Citan', NULL, NULL),
(484, 42, 'CL', NULL, NULL),
(485, 42, 'CL', NULL, NULL),
(486, 42, 'CLA', NULL, NULL),
(487, 42, 'CLC', NULL, NULL),
(488, 42, 'CLK Cabrio', NULL, NULL),
(489, 42, 'CLK Coupé', NULL, NULL),
(490, 42, 'CLS', NULL, NULL),
(491, 42, 'Trieda E', NULL, NULL),
(492, 42, 'E', NULL, NULL),
(493, 42, 'E Cabrio', NULL, NULL),
(494, 42, 'E Coupé', NULL, NULL),
(495, 42, 'E T', NULL, NULL),
(496, 42, 'Trieda G', NULL, NULL),
(497, 42, 'G Cabrio', NULL, NULL),
(498, 42, 'GL', NULL, NULL),
(499, 42, 'GLA', NULL, NULL),
(500, 42, 'GLC', NULL, NULL),
(501, 42, 'GLE', NULL, NULL),
(502, 42, 'GLK', NULL, NULL),
(503, 42, 'Trieda M', NULL, NULL),
(504, 42, 'MB 100', NULL, NULL),
(505, 42, 'Trieda R', NULL, NULL),
(506, 42, 'Trieda S', NULL, NULL),
(507, 42, 'S', NULL, NULL),
(508, 42, 'S Coupé', NULL, NULL),
(509, 42, 'SL', NULL, NULL),
(510, 42, 'SLC', NULL, NULL),
(511, 42, 'SLK', NULL, NULL),
(512, 42, 'SLR', NULL, NULL),
(513, 42, 'Sprinter', NULL, NULL),
(514, 43, '9-3', NULL, NULL),
(515, 43, '9-3 Cabriolet', NULL, NULL),
(516, 43, '9-3 Coupé', NULL, NULL),
(517, 43, '9-3 SportCombi', NULL, NULL),
(518, 43, '9-5', NULL, NULL),
(519, 43, '9-5 SportCombi', NULL, NULL),
(520, 43, '900', NULL, NULL),
(521, 43, '900 C', NULL, NULL),
(522, 43, '900 C Turbo', NULL, NULL),
(523, 43, '9000', NULL, NULL),
(524, 44, '100', NULL, NULL),
(525, 44, '100 Avant', NULL, NULL),
(526, 44, '80', NULL, NULL),
(527, 44, '80 Avant', NULL, NULL),
(528, 44, '80 Cabrio', NULL, NULL),
(529, 44, '90', NULL, NULL),
(530, 44, 'A1', NULL, NULL),
(531, 44, 'A2', NULL, NULL),
(532, 44, 'A3', NULL, NULL),
(533, 44, 'A3 Cabriolet', NULL, NULL),
(534, 44, 'A3 Limuzina', NULL, NULL),
(535, 44, 'A3 Sportback', NULL, NULL),
(536, 44, 'A4', NULL, NULL),
(537, 44, 'A4 Allroad', NULL, NULL),
(538, 44, 'A4 Avant', NULL, NULL),
(539, 44, 'A4 Cabriolet', NULL, NULL),
(540, 44, 'A5', NULL, NULL),
(541, 44, 'A5 Cabriolet', NULL, NULL),
(542, 44, 'A5 Sportback', NULL, NULL),
(543, 44, 'A6', NULL, NULL),
(544, 44, 'A6 Allroad', NULL, NULL),
(545, 44, 'A6 Avant', NULL, NULL),
(546, 44, 'A7', NULL, NULL),
(547, 44, 'A8', NULL, NULL),
(548, 44, 'A8 Long', NULL, NULL),
(549, 44, 'Q3', NULL, NULL),
(550, 44, 'Q5', NULL, NULL),
(551, 44, 'Q7', NULL, NULL),
(552, 44, 'R8', NULL, NULL),
(553, 44, 'RS4 Cabriolet', NULL, NULL),
(554, 44, 'RS4/RS4 Avant', NULL, NULL),
(555, 44, 'RS5', NULL, NULL),
(556, 44, 'RS6 Avant', NULL, NULL),
(557, 44, 'RS7', NULL, NULL),
(558, 44, 'S3/S3 Sportback', NULL, NULL),
(559, 44, 'S4 Cabriolet', NULL, NULL),
(560, 44, 'S4/S4 Avant', NULL, NULL),
(561, 44, 'S5/S5 Cabriolet', NULL, NULL),
(562, 44, 'S6/RS6', NULL, NULL),
(563, 44, 'S7', NULL, NULL),
(564, 44, 'S8', NULL, NULL),
(565, 44, 'SQ5', NULL, NULL),
(566, 44, 'TT Coupé', NULL, NULL),
(567, 44, 'TT Roadster', NULL, NULL),
(568, 44, 'TTS', NULL, NULL),
(569, 45, 'Avella', NULL, NULL),
(570, 45, 'Besta', NULL, NULL),
(571, 45, 'Carens', NULL, NULL),
(572, 45, 'Carnival', NULL, NULL),
(573, 45, 'Cee`d', NULL, NULL),
(574, 45, 'Cee`d SW', NULL, NULL),
(575, 45, 'Cerato', NULL, NULL),
(576, 45, 'K 2500', NULL, NULL),
(577, 45, 'Magentis', NULL, NULL),
(578, 45, 'Opirus', NULL, NULL),
(579, 45, 'Optima', NULL, NULL),
(580, 45, 'Picanto', NULL, NULL),
(581, 45, 'Pregio', NULL, NULL),
(582, 45, 'Pride', NULL, NULL),
(583, 45, 'Pro Cee`d', NULL, NULL),
(584, 45, 'Rio', NULL, NULL),
(585, 45, 'Rio Combi', NULL, NULL),
(586, 45, 'Rio sedan', NULL, NULL),
(587, 45, 'Sephia', NULL, NULL),
(588, 45, 'Shuma', NULL, NULL),
(589, 45, 'Sorento', NULL, NULL),
(590, 45, 'Soul', NULL, NULL),
(591, 45, 'Sportage', NULL, NULL),
(592, 45, 'Venga', NULL, NULL),
(593, 46, '109', NULL, NULL),
(594, 46, 'Defender', NULL, NULL),
(595, 46, 'Discovery', NULL, NULL),
(596, 46, 'Discovery Sport', NULL, NULL),
(597, 46, 'Freelander', NULL, NULL),
(598, 46, 'Range Rover', NULL, NULL),
(599, 46, 'Range Rover Evoque', NULL, NULL),
(600, 46, 'Range Rover Sport', NULL, NULL),
(601, 47, 'Avenger', NULL, NULL),
(602, 47, 'Caliber', NULL, NULL),
(603, 47, 'Challenger', NULL, NULL),
(604, 47, 'Charger', NULL, NULL),
(605, 47, 'Grand Caravan', NULL, NULL),
(606, 47, 'Journey', NULL, NULL),
(607, 47, 'Magnum', NULL, NULL),
(608, 47, 'Nitro', NULL, NULL),
(609, 47, 'RAM', NULL, NULL),
(610, 47, 'Stealth', NULL, NULL),
(611, 47, 'Viper', NULL, NULL),
(612, 48, '300 C', NULL, NULL),
(613, 48, '300 C Touring', NULL, NULL),
(614, 48, '300 M', NULL, NULL),
(615, 48, 'Crossfire', NULL, NULL),
(616, 48, 'Grand Voyager', NULL, NULL),
(617, 48, 'LHS', NULL, NULL),
(618, 48, 'Neon', NULL, NULL),
(619, 48, 'Pacifica', NULL, NULL),
(620, 48, 'Plymouth', NULL, NULL),
(621, 48, 'PT Cruiser', NULL, NULL),
(622, 48, 'Sebring', NULL, NULL),
(623, 48, 'Sebring Convertible', NULL, NULL),
(624, 48, 'Stratus', NULL, NULL),
(625, 48, 'Stratus Cabrio', NULL, NULL),
(626, 48, 'Town & Country', NULL, NULL),
(627, 48, 'Voyager', NULL, NULL),
(628, 49, 'Aerostar', NULL, NULL),
(629, 49, 'B-Max', NULL, NULL),
(630, 49, 'C-Max', NULL, NULL),
(631, 49, 'Cortina', NULL, NULL),
(632, 49, 'Cougar', NULL, NULL),
(633, 49, 'Edge', NULL, NULL),
(634, 49, 'Escort', NULL, NULL),
(635, 49, 'Escort Cabrio', NULL, NULL),
(636, 49, 'Escort kombi', NULL, NULL),
(637, 49, 'Explorer', NULL, NULL),
(638, 49, 'F-150', NULL, NULL),
(639, 49, 'F-250', NULL, NULL),
(640, 49, 'Fiesta', NULL, NULL),
(641, 49, 'Focus', NULL, NULL),
(642, 49, 'Focus C-Max', NULL, NULL),
(643, 49, 'Focus CC', NULL, NULL),
(644, 49, 'Focus kombi', NULL, NULL),
(645, 49, 'Fusion', NULL, NULL),
(646, 49, 'Galaxy', NULL, NULL),
(647, 49, 'Grand C-Max', NULL, NULL),
(648, 49, 'Ka', NULL, NULL),
(649, 49, 'Kuga', NULL, NULL),
(650, 49, 'Maverick', NULL, NULL),
(651, 49, 'Mondeo', NULL, NULL),
(652, 49, 'Mondeo Combi', NULL, NULL),
(653, 49, 'Mustang', NULL, NULL),
(654, 49, 'Orion', NULL, NULL),
(655, 49, 'Puma', NULL, NULL),
(656, 49, 'Ranger', NULL, NULL),
(657, 49, 'S-Max', NULL, NULL),
(658, 49, 'Sierra', NULL, NULL),
(659, 49, 'Street Ka', NULL, NULL),
(660, 49, 'Tourneo Connect', NULL, NULL),
(661, 49, 'Tourneo Custom', NULL, NULL),
(662, 49, 'Transit', NULL, NULL),
(663, 49, 'Transit', NULL, NULL),
(664, 49, 'Transit Bus', NULL, NULL),
(665, 49, 'Transit Connect LWB', NULL, NULL),
(666, 49, 'Transit Courier', NULL, NULL),
(667, 49, 'Transit Custom', NULL, NULL),
(668, 49, 'Transit kombi', NULL, NULL),
(669, 49, 'Transit Tourneo', NULL, NULL),
(670, 49, 'Transit Valnik', NULL, NULL),
(671, 49, 'Transit Van', NULL, NULL),
(672, 49, 'Transit Van 350', NULL, NULL),
(673, 49, 'Windstar', NULL, NULL),
(674, 50, 'H2', NULL, NULL),
(675, 50, 'H3', NULL, NULL),
(676, 51, 'Accent', NULL, NULL),
(677, 51, 'Atos', NULL, NULL),
(678, 51, 'Atos Prime', NULL, NULL),
(679, 51, 'Coupé', NULL, NULL),
(680, 51, 'Elantra', NULL, NULL),
(681, 51, 'Galloper', NULL, NULL),
(682, 51, 'Genesis', NULL, NULL),
(683, 51, 'Getz', NULL, NULL),
(684, 51, 'Grandeur', NULL, NULL),
(685, 51, 'H 350', NULL, NULL),
(686, 51, 'H1', NULL, NULL),
(687, 51, 'H1 Bus', NULL, NULL),
(688, 51, 'H1 Van', NULL, NULL),
(689, 51, 'H200', NULL, NULL),
(690, 51, 'i10', NULL, NULL),
(691, 51, 'i20', NULL, NULL),
(692, 51, 'i30', NULL, NULL),
(693, 51, 'i30 CW', NULL, NULL),
(694, 51, 'i40', NULL, NULL),
(695, 51, 'i40 CW', NULL, NULL),
(696, 51, 'ix20', NULL, NULL),
(697, 51, 'ix35', NULL, NULL),
(698, 51, 'ix55', NULL, NULL),
(699, 51, 'Lantra', NULL, NULL),
(700, 51, 'Matrix', NULL, NULL),
(701, 51, 'Santa Fe', NULL, NULL),
(702, 51, 'Sonata', NULL, NULL),
(703, 51, 'Terracan', NULL, NULL),
(704, 51, 'Trajet', NULL, NULL),
(705, 51, 'Tucson', NULL, NULL),
(706, 51, 'Veloster', NULL, NULL),
(707, 52, 'EX', NULL, NULL),
(708, 52, 'FX', NULL, NULL),
(709, 52, 'G', NULL, NULL),
(710, 52, 'G Coupé', NULL, NULL),
(711, 52, 'M', NULL, NULL),
(712, 52, 'Q', NULL, NULL),
(713, 52, 'QX', NULL, NULL),
(714, 53, 'Daimler', NULL, NULL),
(715, 53, 'F-Pace', NULL, NULL),
(716, 53, 'F-Type', NULL, NULL),
(717, 53, 'S-Type', NULL, NULL),
(718, 53, 'Sovereign', NULL, NULL),
(719, 53, 'X-Type', NULL, NULL),
(720, 53, 'X-type Estate', NULL, NULL),
(721, 53, 'XE', NULL, NULL),
(722, 53, 'XF', NULL, NULL),
(723, 53, 'XJ', NULL, NULL),
(724, 53, 'XJ12', NULL, NULL),
(725, 53, 'XJ6', NULL, NULL),
(726, 53, 'XJ8', NULL, NULL),
(727, 53, 'XJ8', NULL, NULL),
(728, 53, 'XJR', NULL, NULL),
(729, 53, 'XK', NULL, NULL),
(730, 53, 'XK8 Convertible', NULL, NULL),
(731, 53, 'XKR', NULL, NULL),
(732, 53, 'XKR Convertible', NULL, NULL),
(733, 54, 'Cherokee', NULL, NULL),
(734, 54, 'Commander', NULL, NULL),
(735, 54, 'Compass', NULL, NULL),
(736, 54, 'Grand Cherokee', NULL, NULL),
(737, 54, 'Patriot', NULL, NULL),
(738, 54, 'Renegade', NULL, NULL),
(739, 54, 'Wrangler', NULL, NULL),
(740, 55, '100 NX', NULL, NULL),
(741, 55, '200 SX', NULL, NULL),
(742, 55, '350 Z', NULL, NULL),
(743, 55, '350 Z Roadster', NULL, NULL),
(744, 55, '370 Z', NULL, NULL),
(745, 55, 'Almera', NULL, NULL),
(746, 55, 'Almera Tino', NULL, NULL),
(747, 55, 'Cabstar E - T', NULL, NULL),
(748, 55, 'Cabstar TL2 Valnik', NULL, NULL),
(749, 55, 'e-NV200', NULL, NULL),
(750, 55, 'GT-R', NULL, NULL),
(751, 55, 'Insterstar', NULL, NULL),
(752, 55, 'Juke', NULL, NULL),
(753, 55, 'King Cab', NULL, NULL),
(754, 55, 'Leaf', NULL, NULL),
(755, 55, 'Maxima', NULL, NULL),
(756, 55, 'Maxima QX', NULL, NULL),
(757, 55, 'Micra', NULL, NULL),
(758, 55, 'Murano', NULL, NULL),
(759, 55, 'Navara', NULL, NULL),
(760, 55, 'Note', NULL, NULL),
(761, 55, 'NP300 Pickup', NULL, NULL),
(762, 55, 'NV200', NULL, NULL),
(763, 55, 'NV400', NULL, NULL),
(764, 55, 'Pathfinder', NULL, NULL),
(765, 55, 'Patrol', NULL, NULL),
(766, 55, 'Patrol GR', NULL, NULL),
(767, 55, 'Pickup', NULL, NULL),
(768, 55, 'Pixo', NULL, NULL),
(769, 55, 'Primastar', NULL, NULL),
(770, 55, 'Primastar Combi', NULL, NULL),
(771, 55, 'Primera', NULL, NULL),
(772, 55, 'Primera Combi', NULL, NULL),
(773, 55, 'Pulsar', NULL, NULL),
(774, 55, 'Qashqai', NULL, NULL),
(775, 55, 'Serena', NULL, NULL),
(776, 55, 'Sunny', NULL, NULL),
(777, 55, 'Terrano', NULL, NULL),
(778, 55, 'Tiida', NULL, NULL),
(779, 55, 'Trade', NULL, NULL),
(780, 55, 'Vanette Cargo', NULL, NULL),
(781, 55, 'X-Trail', NULL, NULL),
(782, 56, '240', NULL, NULL),
(783, 56, '340', NULL, NULL),
(784, 56, '360', NULL, NULL),
(785, 56, '460', NULL, NULL),
(786, 56, '850', NULL, NULL),
(787, 56, '850 kombi', NULL, NULL),
(788, 56, 'C30', NULL, NULL),
(789, 56, 'C70', NULL, NULL),
(790, 56, 'C70 Cabrio', NULL, NULL),
(791, 56, 'C70 Coupé', NULL, NULL),
(792, 56, 'S40', NULL, NULL),
(793, 56, 'S60', NULL, NULL),
(794, 56, 'S70', NULL, NULL),
(795, 56, 'S80', NULL, NULL),
(796, 56, 'S90', NULL, NULL),
(797, 56, 'V40', NULL, NULL),
(798, 56, 'V50', NULL, NULL),
(799, 56, 'V60', NULL, NULL),
(800, 56, 'V70', NULL, NULL),
(801, 56, 'V90', NULL, NULL),
(802, 56, 'XC60', NULL, NULL),
(803, 56, 'XC70', NULL, NULL),
(804, 56, 'XC90', NULL, NULL),
(805, 57, 'Espero', NULL, NULL),
(806, 57, 'Kalos', NULL, NULL),
(807, 57, 'Lacetti', NULL, NULL),
(808, 57, 'Lanos', NULL, NULL),
(809, 57, 'Leganza', NULL, NULL),
(810, 57, 'Lublin', NULL, NULL),
(811, 57, 'Matiz', NULL, NULL),
(812, 57, 'Nexia', NULL, NULL),
(813, 57, 'Nubira', NULL, NULL),
(814, 57, 'Nubira kombi', NULL, NULL),
(815, 57, 'Racer', NULL, NULL),
(816, 57, 'Tacuma', NULL, NULL),
(817, 57, 'Tico', NULL, NULL),
(818, 58, '1100', NULL, NULL),
(819, 58, '126', NULL, NULL),
(820, 58, '500', NULL, NULL),
(821, 58, '500L', NULL, NULL),
(822, 58, '500X', NULL, NULL),
(823, 58, '850', NULL, NULL),
(824, 58, 'Barchetta', NULL, NULL),
(825, 58, 'Brava', NULL, NULL),
(826, 58, 'Cinquecento', NULL, NULL),
(827, 58, 'Coupé', NULL, NULL),
(828, 58, 'Croma', NULL, NULL),
(829, 58, 'Doblo', NULL, NULL),
(830, 58, 'Doblo Cargo', NULL, NULL),
(831, 58, 'Doblo Cargo Combi', NULL, NULL),
(832, 58, 'Ducato', NULL, NULL),
(833, 58, 'Ducato Van', NULL, NULL),
(834, 58, 'Ducato Kombi', NULL, NULL),
(835, 58, 'Ducato Podvozok', NULL, NULL),
(836, 58, 'Florino', NULL, NULL),
(837, 58, 'Florino Combi', NULL, NULL),
(838, 58, 'Freemont', NULL, NULL),
(839, 58, 'Grande Punto', NULL, NULL),
(840, 58, 'Idea', NULL, NULL),
(841, 58, 'Linea', NULL, NULL),
(842, 58, 'Marea', NULL, NULL),
(843, 58, 'Marea Weekend', NULL, NULL),
(844, 58, 'Multipla', NULL, NULL),
(845, 58, 'Palio Weekend', NULL, NULL),
(846, 58, 'Panda', NULL, NULL),
(847, 58, 'Panda Van', NULL, NULL),
(848, 58, 'Punto', NULL, NULL),
(849, 58, 'Punto Cabriolet', NULL, NULL),
(850, 58, 'Punto Evo', NULL, NULL),
(851, 58, 'Punto Van', NULL, NULL),
(852, 58, 'Qubo', NULL, NULL),
(853, 58, 'Scudo', NULL, NULL),
(854, 58, 'Scudo Van', NULL, NULL),
(855, 58, 'Scudo Kombi', NULL, NULL),
(856, 58, 'Sedici', NULL, NULL),
(857, 58, 'Seicento', NULL, NULL),
(858, 58, 'Stilo', NULL, NULL),
(859, 58, 'Stilo Multiwagon', NULL, NULL),
(860, 58, 'Strada', NULL, NULL),
(861, 58, 'Talento', NULL, NULL),
(862, 58, 'Tipo', NULL, NULL),
(863, 58, 'Ulysse', NULL, NULL),
(864, 58, 'Uno', NULL, NULL),
(865, 58, 'X1/9', NULL, NULL),
(866, 59, 'Cooper', NULL, NULL),
(867, 59, 'Cooper Cabrio', NULL, NULL),
(868, 59, 'Cooper Clubman', NULL, NULL),
(869, 59, 'Cooper D', NULL, NULL),
(870, 59, 'Cooper D Clubman', NULL, NULL),
(871, 59, 'Cooper S', NULL, NULL),
(872, 59, 'Cooper S Cabrio', NULL, NULL),
(873, 59, 'Cooper S Clubman', NULL, NULL),
(874, 59, 'Countryman', NULL, NULL),
(875, 59, 'Mini One', NULL, NULL),
(876, 59, 'One D', NULL, NULL),
(877, 60, '200', NULL, NULL),
(878, 60, '214', NULL, NULL),
(879, 60, '218', NULL, NULL),
(880, 60, '25', NULL, NULL),
(881, 60, '400', NULL, NULL),
(882, 60, '414', NULL, NULL),
(883, 60, '416', NULL, NULL),
(884, 60, '620', NULL, NULL),
(885, 60, '75', NULL, NULL),
(886, 61, 'Cabrio', NULL, NULL),
(887, 61, 'City-Coupé', NULL, NULL),
(888, 61, 'Compact Pulse', NULL, NULL),
(889, 61, 'Forfour', NULL, NULL),
(890, 61, 'Fortwo cabrio', NULL, NULL),
(891, 61, 'Fortwo coupé', NULL, NULL),
(892, 61, 'Roadster', NULL, NULL),
(895, 65, 'Continental GT', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(896, 65, 'Continental Flying Spur', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(897, 65, 'Bentayga', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(898, 65, 'Mulsanne', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(899, 66, 'Phantom', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(900, 66, 'Ghost', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(901, 66, 'Wraith', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(902, 66, 'Dawn', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(903, 66, 'Cullinan', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(904, 67, 'Ghibli', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(905, 67, 'Quattroporte', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(906, 67, 'Levante', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(907, 67, 'MC20', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(908, 67, 'GranTurismo', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(909, 68, '488 GTB', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(910, 68, 'F8 Tributo', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(911, 68, 'SF90 Stradale', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(912, 68, 'Roma', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(913, 68, 'Portofino', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(914, 68, '812 Superfast', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(915, 69, 'Huracán', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(916, 69, 'Aventador', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(917, 69, 'Urus', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(918, 69, 'Gallardo', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(919, 70, 'DB11', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(920, 70, 'Vantage', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(921, 70, 'DBS Superleggera', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(922, 70, 'DBX', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(923, 71, '720S', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(924, 71, '570S', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(925, 71, '600LT', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(926, 71, 'Artura', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(927, 72, 'Chiron', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(928, 72, 'Veyron', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(929, 72, 'Divo', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(930, 73, 'G90', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(931, 73, 'G80', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(932, 73, 'G70', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(933, 73, 'GV80', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(934, 73, 'GV70', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(935, 74, 'NSX', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(936, 74, 'TLX', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(937, 74, 'ILX', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(938, 74, 'RDX', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(939, 74, 'MDX', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(940, 75, 'Continental', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(941, 75, 'MKZ', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(942, 75, 'Corsair', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(943, 75, 'Nautilus', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(944, 75, 'Aviator', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(945, 75, 'Navigator', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(946, 76, 'CT4', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(947, 76, 'CT5', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(948, 76, 'CT6', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(949, 76, 'XT4', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(950, 76, 'XT5', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(951, 76, 'XT6', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(952, 76, 'Escalade', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(953, 77, 'Tang', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(954, 77, 'Song', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(955, 77, 'Qin', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(956, 77, 'Han', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(957, 77, 'Dolphin', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(958, 78, 'Coolray', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(959, 78, 'Atlas', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(960, 78, 'GC9', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(961, 78, 'Emgrand', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(962, 79, 'Haval H6', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(963, 79, 'Haval H2', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(964, 79, 'Haval H9', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(965, 79, 'Wingle', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(966, 80, 'Tiggo 7', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(967, 80, 'Tiggo 8', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(968, 80, 'Arrizo 5', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(969, 80, 'Arrizo 6', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(970, 82, 'HS', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(971, 82, 'ZS', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(972, 82, 'RX5', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(973, 82, 'RX8', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(974, 84, 'Nexon', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(975, 84, 'Harrier', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(976, 84, 'Safari', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(977, 84, 'Tiago', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(978, 84, 'Tigor', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(979, 85, 'XUV300', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(980, 85, 'XUV500', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(981, 85, 'Scorpio', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(982, 85, 'Bolero', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(983, 85, 'Thar', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(984, 86, 'Swift', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(985, 86, 'Dzire', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(986, 86, 'Baleno', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(987, 86, 'Vitara Brezza', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(988, 86, 'Ertiga', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(989, 87, 'Tivoli', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(990, 87, 'Korando', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(991, 87, 'Rexton', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(992, 87, 'Musso', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(993, 88, 'D-Max', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(994, 88, 'MU-X', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(995, 88, 'Trooper', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(996, 89, 'Terios', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(997, 89, 'Sirion', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(998, 89, 'Mira', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(999, 90, 'Delta', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1000, 90, 'Ypsilon', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1001, 90, 'Thema', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1002, 91, '500', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1003, 91, '124 Spider', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1004, 91, 'Punto', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1005, 92, 'DS 3', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1006, 92, 'DS 4', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1007, 92, 'DS 7', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1008, 92, 'DS 9', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1009, 93, 'Formentor', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1010, 93, 'Leon', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1011, 93, 'Ateca', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1012, 94, 'Encore', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1013, 94, 'Envision', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1014, 94, 'Enclave', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1015, 94, 'LaCrosse', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1016, 95, 'Sierra', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1017, 95, 'Silverado', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1018, 95, 'Yukon', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1019, 95, 'Acadia', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1020, 95, 'Terrain', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1021, 96, '1500', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1022, 96, '2500', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1023, 96, '3500', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1024, 96, 'ProMaster', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1025, 97, 'Model S', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1026, 97, 'Model 3', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1027, 97, 'Model X', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1028, 97, 'Model Y', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1029, 97, 'Cybertruck', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1030, 98, 'Daily', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1031, 98, 'Eurocargo', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1032, 98, 'Stralis', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1033, 99, 'TGL', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1034, 99, 'TGM', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1035, 99, 'TGS', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1036, 99, 'TGX', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1037, 100, 'P Series', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1038, 100, 'G Series', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1039, 100, 'R Series', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1040, 100, 'S Series', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1041, 101, 'FH', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1042, 101, 'FM', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1043, 101, 'FMX', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1044, 101, 'VNL', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1045, 102, 'Cascadia', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1046, 102, 'Columbia', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1047, 102, 'Century Class', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1048, 103, '579', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1049, 103, '567', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1050, 103, '389', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1051, 104, 'T680', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1052, 104, 'T880', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1053, 104, 'W900', '2025-09-07 21:34:20', '2025-09-07 21:34:20'),
(1054, 38, 'Prius', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1055, 38, 'Prius C', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1056, 38, 'Prius V', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1057, 38, 'Mirai', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1058, 38, 'Avalon', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1059, 38, 'C-HR', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1060, 38, 'Venza', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1061, 38, 'Sequoia', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1062, 38, 'Tundra', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1063, 38, 'Tacoma', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1064, 38, '4Runner', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1065, 38, 'Land Cruiser', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1066, 38, 'Highlander', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1067, 38, 'RAV4', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1068, 38, 'Sienna', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1069, 38, 'Yaris', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1070, 38, 'Yaris iA', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1071, 38, '86', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1072, 38, 'Supra', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1073, 33, 'Civic Type R', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1074, 33, 'Civic Si', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1075, 33, 'Insight', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1076, 33, 'Clarity', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1077, 33, 'Passport', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1078, 33, 'Ridgeline', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1079, 33, 'Pilot', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1080, 33, 'HR-V', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1081, 33, 'CR-V', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1082, 33, 'Odyssey', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1083, 33, 'Fit', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1084, 33, 'NSX', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1085, 39, 'i3', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1086, 39, 'i8', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1087, 39, 'iX', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1088, 39, 'i4', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1089, 39, 'X1', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1090, 39, 'X2', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1091, 39, 'X3', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1092, 39, 'X4', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1093, 39, 'X5', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1094, 39, 'X6', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1095, 39, 'X7', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1096, 39, 'Z4', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1097, 39, '8 Series', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1098, 39, 'M2', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1099, 39, 'M3', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1100, 39, 'M4', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1101, 39, 'M5', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1102, 39, 'M8', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1103, 42, 'A-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1104, 42, 'B-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1105, 42, 'C-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1106, 42, 'E-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1107, 42, 'S-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1108, 42, 'CLA-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1109, 42, 'CLS-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1110, 42, 'GLA-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1111, 42, 'GLB-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1112, 42, 'GLC-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1113, 42, 'GLE-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1114, 42, 'GLS-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1115, 42, 'G-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1116, 42, 'SL-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1117, 42, 'SLC-Class', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1118, 42, 'AMG GT', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1119, 42, 'EQC', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1120, 42, 'EQS', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1121, 44, 'A1', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1122, 44, 'A3', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1123, 44, 'A4', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1124, 44, 'A5', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1125, 44, 'A6', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1126, 44, 'A7', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1127, 44, 'A8', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1128, 44, 'Q2', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1129, 44, 'Q3', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1130, 44, 'Q4 e-tron', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1131, 44, 'Q5', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1132, 44, 'Q7', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1133, 44, 'Q8', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1134, 44, 'TT', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1135, 44, 'R8', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1136, 44, 'e-tron', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1137, 44, 'e-tron GT', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1138, 40, 'Golf', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1139, 40, 'Golf GTI', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1140, 40, 'Golf R', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1141, 40, 'Jetta', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1142, 40, 'Passat', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1143, 40, 'Arteon', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1144, 40, 'Tiguan', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1145, 40, 'Atlas', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1146, 40, 'ID.3', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1147, 40, 'ID.4', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1148, 40, 'ID.Buzz', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1149, 40, 'Beetle', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1150, 40, 'CC', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1151, 49, 'Mustang', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1152, 49, 'Mustang Mach-E', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1153, 49, 'F-150', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1154, 49, 'F-250', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1155, 49, 'F-350', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1156, 49, 'Ranger', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1157, 49, 'Explorer', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1158, 49, 'Expedition', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1159, 49, 'Edge', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1160, 49, 'Escape', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1161, 49, 'Bronco', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1162, 49, 'Bronco Sport', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1163, 49, 'EcoSport', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1164, 49, 'Transit', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1165, 49, 'Transit Connect', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1166, 55, 'Altima', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1167, 55, 'Maxima', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1168, 55, 'Sentra', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1169, 55, 'Versa', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1170, 55, 'Rogue', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1171, 55, 'Murano', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1172, 55, 'Pathfinder', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1173, 55, 'Armada', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1174, 55, 'Frontier', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1175, 55, 'Titan', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1176, 55, '370Z', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1177, 55, 'GT-R', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1178, 55, 'Leaf', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1179, 55, 'Ariya', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1180, 51, 'Elantra', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1181, 51, 'Sonata', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1182, 51, 'Accent', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1183, 51, 'Veloster', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1184, 51, 'Tucson', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1185, 51, 'Santa Fe', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1186, 51, 'Palisade', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1187, 51, 'Kona', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1188, 51, 'Venue', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1189, 51, 'Nexo', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1190, 51, 'Ioniq', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1191, 51, 'Ioniq 5', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1192, 45, 'Forte', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1193, 45, 'Optima', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1194, 45, 'Rio', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1195, 45, 'Stinger', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1196, 45, 'Sportage', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1197, 45, 'Sorento', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1198, 45, 'Telluride', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1199, 45, 'Seltos', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1200, 45, 'Soul', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1201, 45, 'Niro', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1202, 45, 'EV6', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1203, 35, 'Mazda2', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1204, 35, 'Mazda3', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1205, 35, 'Mazda6', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1206, 35, 'CX-3', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1207, 35, 'CX-5', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1208, 35, 'CX-9', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1209, 35, 'CX-30', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1210, 35, 'MX-5 Miata', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1211, 35, 'MX-30', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1212, 34, 'Impreza', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1213, 34, 'Legacy', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1214, 34, 'Outback', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1215, 34, 'Forester', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1216, 34, 'Crosstrek', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1217, 34, 'Ascent', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1218, 34, 'WRX', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1219, 34, 'BRZ', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1220, 36, 'Mirage', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1221, 36, 'Lancer', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1222, 36, 'Outlander', '2025-09-07 21:36:06', '2025-09-07 21:36:06');
INSERT INTO `vehicle_models` (`id`, `make_id`, `name`, `created_at`, `updated_at`) VALUES
(1223, 36, 'Outlander Sport', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1224, 36, 'Eclipse Cross', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1225, 36, 'i-MiEV', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1226, 41, 'Swift', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1227, 41, 'Baleno', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1228, 41, 'Celerio', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1229, 41, 'Ignis', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1230, 41, 'Vitara', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1231, 41, 'S-Cross', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1232, 41, 'Jimny', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1233, 56, 'S60', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1234, 56, 'S90', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1235, 56, 'V60', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1236, 56, 'V90', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1237, 56, 'XC40', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1238, 56, 'XC60', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1239, 56, 'XC90', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1240, 56, 'C30', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1241, 56, 'C70', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1242, 53, 'XE', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1243, 53, 'XF', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1244, 53, 'XJ', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1245, 53, 'F-PACE', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1246, 53, 'E-PACE', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1247, 53, 'I-PACE', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1248, 53, 'F-TYPE', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1249, 46, 'Defender', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1250, 46, 'Discovery', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1251, 46, 'Discovery Sport', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1252, 46, 'Range Rover', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1253, 46, 'Range Rover Evoque', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1254, 46, 'Range Rover Sport', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1255, 46, 'Range Rover Velar', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1256, 32, '911', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1257, 32, 'Boxster', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1258, 32, 'Cayman', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1259, 32, 'Panamera', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1260, 32, 'Macan', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1261, 32, 'Cayenne', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1262, 32, 'Taycan', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1263, 59, 'Cooper', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1264, 59, 'Cooper S', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1265, 59, 'Cooper SE', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1266, 59, 'Countryman', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1267, 59, 'Clubman', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1268, 59, 'Convertible', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1269, 61, 'Fortwo', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1270, 61, 'Forfour', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1271, 61, 'EQ Fortwo', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1272, 61, 'EQ Forfour', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1273, 58, '500', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1274, 58, '500L', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1275, 58, '500X', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1276, 58, 'Panda', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1277, 58, 'Tipo', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1278, 58, 'Doblo', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1279, 29, 'Giulia', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1280, 29, 'Stelvio', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1281, 29, '4C', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1282, 29, 'Tonale', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1283, 28, 'Corsa', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1284, 28, 'Astra', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1285, 28, 'Insignia', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1286, 28, 'Crossland', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1287, 28, 'Grandland', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1288, 28, 'Mokka', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1289, 25, '208', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1290, 25, '308', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1291, 25, '508', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1292, 25, '2008', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1293, 25, '3008', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1294, 25, '5008', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1295, 25, 'Partner', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1296, 25, 'Expert', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1297, 24, 'Clio', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1298, 24, 'Megane', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1299, 24, 'Talisman', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1300, 24, 'Captur', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1301, 24, 'Kadjar', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1302, 24, 'Koleos', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1303, 24, 'Kangoo', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1304, 24, 'Master', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1305, 24, 'Zoe', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1306, 27, 'C1', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1307, 27, 'C3', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1308, 27, 'C4', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1309, 27, 'C5', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1310, 27, 'C3 Aircross', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1311, 27, 'C4 Cactus', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1312, 27, 'C5 Aircross', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1313, 27, 'Berlingo', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1314, 27, 'Jumper', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1315, 30, 'Fabia', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1316, 30, 'Rapid', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1317, 30, 'Octavia', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1318, 30, 'Superb', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1319, 30, 'Kamiq', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1320, 30, 'Karoq', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1321, 30, 'Kodiaq', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1322, 30, 'Citigo', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1323, 23, 'Mii', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1324, 23, 'Ibiza', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1325, 23, 'Leon', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1326, 23, 'Toledo', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1327, 23, 'Arona', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1328, 23, 'Ateca', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1329, 23, 'Tarraco', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1330, 26, 'Sandero', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1331, 26, 'Logan', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1332, 26, 'Duster', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1333, 26, 'Lodgy', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1334, 26, 'Dokker', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1335, 31, 'Camaro', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1336, 31, 'Corvette', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1337, 31, 'Malibu', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1338, 31, 'Cruze', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1339, 31, 'Sonic', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1340, 31, 'Spark', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1341, 31, 'Equinox', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1342, 31, 'Traverse', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1343, 31, 'Tahoe', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1344, 31, 'Suburban', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1345, 31, 'Silverado', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1346, 31, 'Colorado', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1347, 31, 'Bolt', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1348, 47, 'Challenger', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1349, 47, 'Charger', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1350, 47, 'Durango', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1351, 47, 'Journey', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1352, 47, 'Grand Caravan', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1353, 47, 'Ram 1500', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1354, 47, 'Ram 2500', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1355, 47, 'Ram 3500', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1356, 48, '300', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1357, 48, 'Pacifica', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1358, 48, 'Voyager', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1359, 54, 'Wrangler', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1360, 54, 'Grand Cherokee', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1361, 54, 'Cherokee', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1362, 54, 'Compass', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1363, 54, 'Renegade', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1364, 54, 'Gladiator', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1365, 52, 'Q50', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1366, 52, 'Q60', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1367, 52, 'Q70', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1368, 52, 'QX30', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1369, 52, 'QX50', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1370, 52, 'QX60', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1371, 52, 'QX80', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1372, 37, 'IS', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1373, 37, 'ES', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1374, 37, 'GS', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1375, 37, 'LS', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1376, 37, 'CT', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1377, 37, 'UX', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1378, 37, 'NX', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1379, 37, 'RX', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1380, 37, 'GX', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1381, 37, 'LX', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1382, 37, 'LC', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1383, 37, 'RC', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1384, 57, 'Matiz', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1385, 57, 'Lanos', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1386, 57, 'Nubira', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1387, 57, 'Leganza', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1388, 57, 'Tacuma', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1389, 57, 'Rezzo', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1390, 60, '25', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1391, 60, '45', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1392, 60, '75', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1393, 60, 'Streetwise', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1394, 43, '9-3', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1395, 43, '9-5', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1396, 43, '9-7X', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1397, 50, 'H1', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1398, 50, 'H2', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1399, 50, 'H3', '2025-09-07 21:36:06', '2025-09-07 21:36:06'),
(1400, 105, 'IVM G5', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1401, 105, 'IVM G6', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1402, 105, 'IVM G12', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1403, 105, 'IVM Umu', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1404, 105, 'IVM Fox', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1405, 106, 'Kiira EV', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1406, 106, 'Kayoola', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1407, 106, 'Kiira EVS', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1408, 107, 'Mobius II', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1409, 107, 'Mobius III', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1410, 108, 'Izy', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1411, 108, 'Izy 4x4', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1412, 109, 'Saga', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1413, 109, 'Persona', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1414, 109, 'Preve', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1415, 109, 'Suprima S', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1416, 109, 'Iriz', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1417, 109, 'Exora', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1418, 109, 'X70', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1419, 109, 'X50', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1420, 110, 'Axia', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1421, 110, 'Myvi', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1422, 110, 'Bezza', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1423, 110, 'Alza', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1424, 110, 'Aruz', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1425, 110, 'Ativa', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1426, 111, 'Patriot', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1427, 111, 'Hunter', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1428, 111, 'Pickup', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1429, 111, 'Cargo', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1430, 111, 'Profi', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1431, 112, 'Vesta', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1432, 112, 'Granta', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1433, 112, 'Kalina', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1434, 112, 'Priora', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1435, 112, 'Largus', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1436, 112, 'XRAY', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1437, 112, 'Niva', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1438, 112, '4x4', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1439, 113, 'Volga', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1440, 113, 'Sobol', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1441, 113, 'Gazelle', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1442, 113, 'Valdai', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1443, 114, 'Sens', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1444, 114, 'Vida', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1445, 114, 'Forza', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1446, 115, 'T4', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1447, 116, 'Marrua', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1448, 116, 'T4R', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1449, 117, 'Torino', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1450, 117, 'Paradiso', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1451, 117, 'Viaggio', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1452, 118, 'AX7', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1453, 118, 'AX3', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1454, 118, 'AX5', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1455, 118, 'S30', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1456, 118, 'A9', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1457, 119, 'Besturn B50', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1458, 119, 'Besturn B70', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1459, 119, 'Besturn X40', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1460, 119, 'Besturn X80', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1461, 119, 'Haima M3', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1462, 120, 'Vigus', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1463, 120, 'Baodian', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1464, 120, 'Shuttle', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1465, 121, 'X60', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1466, 121, 'X50', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1467, 121, '320', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1468, 121, '620', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1469, 121, '720', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1470, 122, 'M3', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1471, 122, 'M5', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1472, 122, 'S5', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1473, 122, 'S7', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1474, 123, 'T600', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1475, 123, 'T700', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1476, 123, 'Z300', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1477, 123, 'Z500', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1478, 124, 'X25', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1479, 124, 'X35', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1480, 124, 'X55', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1481, 124, 'X65', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1482, 125, 'CS35', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1483, 125, 'CS55', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1484, 125, 'CS75', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1485, 125, 'CS95', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1486, 125, 'Eado', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1487, 126, 'Trumpchi GS4', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1488, 126, 'Trumpchi GS8', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1489, 126, 'Trumpchi GA6', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1490, 126, 'Trumpchi GA8', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1491, 127, 'MG ZS', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1492, 127, 'MG HS', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1493, 127, 'Roewe 350', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1494, 127, 'Roewe 550', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1495, 128, '601', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1496, 128, '1.1', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1497, 129, '353', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1498, 129, '1.3', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1499, 130, '2140', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1500, 130, '2141', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1501, 131, 'Yugo', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1502, 131, 'Florida', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1503, 131, 'Koral', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1504, 132, 'Dutro', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1505, 132, 'Ranger', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1506, 132, 'Profia', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1507, 132, 'S Series', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1508, 133, 'Quester', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1509, 133, 'Croner', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1510, 133, 'Condor', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1511, 134, 'Canter', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1512, 134, 'Fighter', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1513, 134, 'Super Great', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1514, 135, 'Ace', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1515, 135, 'Super Ace', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1516, 135, 'LPT', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1517, 135, 'Prima', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1518, 136, 'Dost', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1519, 136, 'Partner', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1520, 136, 'Viking', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1521, 136, 'Stile', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1522, 137, 'Pro', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1523, 137, 'Skyline', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1524, 137, 'Tiger', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1525, 138, 'Traveller', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1526, 138, 'Gurkha', '2025-09-07 21:37:43', '2025-09-07 21:37:43'),
(1527, 138, 'One', '2025-09-07 21:37:43', '2025-09-07 21:37:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `entity_type` (`entity_type`,`entity_id`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_application_type` (`application_type`);

--
-- Indexes for table `application_status_history`
--
ALTER TABLE `application_status_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_application` (`application_type`,`application_id`),
  ADD KEY `idx_status_change` (`new_status`,`created_at`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_configurations`
--
ALTER TABLE `billing_configurations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_entity` (`entity_type`,`entity_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bill_number` (`bill_number`),
  ADD KEY `idx_entity_bill` (`entity_type`,`entity_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_due_date` (`due_date`);

--
-- Indexes for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`),
  ADD KEY `idx_bill_id` (`bill_id`);

--
-- Indexes for table `body_types`
--
ALTER TABLE `body_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_dealers`
--
ALTER TABLE `car_dealers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cf_quotations`
--
ALTER TABLE `cf_quotations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quotation_number` (`quotation_number`),
  ADD KEY `fk_cf_quotations_application` (`application_id`),
  ADD KEY `fk_cf_quotations_company` (`cf_company_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_quotation_timeline` (`submitted_at`,`expires_at`,`status`),
  ADD KEY `fk_quotation_tra_log` (`tra_calculation_log_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`region_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `clearing_forwarding_companies`
--
ALTER TABLE `clearing_forwarding_companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tra_license_number` (`tra_license_number`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_region_city` (`region`,`city`),
  ADD KEY `idx_cf_performance` (`rating`,`average_response_time_hours`,`success_rate_percentage`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract_managements`
--
ALTER TABLE `contract_managements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_reviews`
--
ALTER TABLE `dealer_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dealer_id` (`dealer_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer_verifications`
--
ALTER TABLE `employer_verifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `fk_employer_verifications_application` (`application_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_vehicle`
--
ALTER TABLE `feature_vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feature_id` (`feature_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `fuel_types`
--
ALTER TABLE `fuel_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `garages`
--
ALTER TABLE `garages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_lat_long` (`latitude`,`longitude`),
  ADD KEY `idx_is_active` (`is_active`),
  ADD KEY `idx_featured` (`featured`),
  ADD KEY `idx_rating` (`rating`),
  ADD KEY `idx_city_state` (`city`,`state`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_duty_applications`
--
ALTER TABLE `import_duty_applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `application_number` (`application_number`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_applicant` (`phone_number`,`email`),
  ADD KEY `idx_cf_company` (`selected_cf_company_id`),
  ADD KEY `idx_lender` (`selected_lender_id`),
  ADD KEY `idx_import_duty_search` (`applicant_name`,`phone_number`,`vehicle_make`,`vehicle_model`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `dealer_id` (`dealer_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lenders`
--
ALTER TABLE `lenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lender_financing_criterias`
--
ALTER TABLE `lender_financing_criterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lender` (`lender_id`),
  ADD KEY `fk_make` (`make_id`),
  ADD KEY `fk_model` (`model_id`);

--
-- Indexes for table `lender_financing_offers`
--
ALTER TABLE `lender_financing_offers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `offer_number` (`offer_number`),
  ADD KEY `fk_lender_offers_application` (`application_id`),
  ADD KEY `fk_lender_offers_lender` (`lender_id`),
  ADD KEY `idx_status_priority` (`status`,`priority_order`),
  ADD KEY `idx_offer_timeline` (`submitted_at`,`expires_at`,`priority_order`);

--
-- Indexes for table `lender_model`
--
ALTER TABLE `lender_model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans_schedules`
--
ALTER TABLE `loans_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_sub_products`
--
ALTER TABLE `loan_sub_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `makes`
--
ALTER TABLE `makes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `makes_name_unique` (`name`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner_documents`
--
ALTER TABLE `partner_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partner_id` (`partner_id`,`partner_type`),
  ADD KEY `document_type` (`document_type`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_number` (`payment_number`),
  ADD KEY `idx_bill_payment` (`bill_id`),
  ADD KEY `idx_payment_date` (`payment_date`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`country_code`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spare_brands`
--
ALTER TABLE `spare_brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_spare_brands_category` (`spare_category_id`);

--
-- Indexes for table `spare_categories`
--
ALTER TABLE `spare_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `spare_models`
--
ALTER TABLE `spare_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_spare_models_brand` (`spare_brand_id`);

--
-- Indexes for table `spare_parts`
--
ALTER TABLE `spare_parts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_spare_parts_shop` (`shop_id`),
  ADD KEY `fk_spare_parts_category` (`spare_category_id`),
  ADD KEY `fk_spare_parts_brand` (`spare_brand_id`),
  ADD KEY `fk_spare_parts_model` (`spare_model_id`);

--
-- Indexes for table `spare_part_payments`
--
ALTER TABLE `spare_part_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_quote_id` (`quote_id`),
  ADD KEY `idx_payment_status` (`payment_status`),
  ADD KEY `idx_customer_email` (`customer_email`);

--
-- Indexes for table `spare_part_quotes`
--
ALTER TABLE `spare_part_quotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `idx_request_shop` (`spare_part_request_id`,`shop_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_expires_at` (`expires_at`);

--
-- Indexes for table `spare_part_requests`
--
ALTER TABLE `spare_part_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spare_part_requests_model_id_foreign` (`model_id`),
  ADD KEY `spare_part_requests_make_id_model_id_year_index` (`make_id`,`model_id`,`year`),
  ADD KEY `spare_part_requests_status_index` (`status`),
  ADD KEY `spare_part_requests_expires_at_index` (`expires_at`),
  ADD KEY `idx_customer_email` (`customer_email`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `statement_analyses`
--
ALTER TABLE `statement_analyses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statement_analyses_account_number_index` (`account_number`),
  ADD KEY `statement_analyses_special_id_index` (`special_id`),
  ADD KEY `statement_analyses_user_id_index` (`user_id`);

--
-- Indexes for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_notifications`
--
ALTER TABLE `system_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_recipient` (`recipient_type`,`recipient_id`,`is_read`),
  ADD KEY `idx_application` (`application_type`,`application_id`);

--
-- Indexes for table `transmissions`
--
ALTER TABLE `transmissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tra_calculation_logs`
--
ALTER TABLE `tra_calculation_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tra_log_application` (`application_id`),
  ADD KEY `fk_tra_log_cf_company` (`cf_company_id`),
  ADD KEY `idx_tra_reference` (`tra_reference_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `make_id` (`make_id`),
  ADD KEY `model_id` (`model_id`),
  ADD KEY `dealer_id` (`dealer_id`),
  ADD KEY `body_type_id` (`body_type_id`),
  ADD KEY `fuel_type_id` (`fuel_type_id`),
  ADD KEY `transmission_id` (`transmission_id`);

--
-- Indexes for table `vehicle_images`
--
ALTER TABLE `vehicle_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_models_make_id_foreign` (`make_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `application_status_history`
--
ALTER TABLE `application_status_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `billing_configurations`
--
ALTER TABLE `billing_configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `body_types`
--
ALTER TABLE `body_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `car_dealers`
--
ALTER TABLE `car_dealers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cf_quotations`
--
ALTER TABLE `cf_quotations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `clearing_forwarding_companies`
--
ALTER TABLE `clearing_forwarding_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `contract_managements`
--
ALTER TABLE `contract_managements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dealer_reviews`
--
ALTER TABLE `dealer_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employer_verifications`
--
ALTER TABLE `employer_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `feature_vehicle`
--
ALTER TABLE `feature_vehicle`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_types`
--
ALTER TABLE `fuel_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `garages`
--
ALTER TABLE `garages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `import_duty_applications`
--
ALTER TABLE `import_duty_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `lenders`
--
ALTER TABLE `lenders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `lender_financing_criterias`
--
ALTER TABLE `lender_financing_criterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `lender_financing_offers`
--
ALTER TABLE `lender_financing_offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lender_model`
--
ALTER TABLE `lender_model`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `loans_schedules`
--
ALTER TABLE `loans_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=900;

--
-- AUTO_INCREMENT for table `loan_sub_products`
--
ALTER TABLE `loan_sub_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `makes`
--
ALTER TABLE `makes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `partner_documents`
--
ALTER TABLE `partner_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `spare_brands`
--
ALTER TABLE `spare_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `spare_categories`
--
ALTER TABLE `spare_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `spare_models`
--
ALTER TABLE `spare_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `spare_parts`
--
ALTER TABLE `spare_parts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spare_part_payments`
--
ALTER TABLE `spare_part_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spare_part_quotes`
--
ALTER TABLE `spare_part_quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `spare_part_requests`
--
ALTER TABLE `spare_part_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `statement_analyses`
--
ALTER TABLE `statement_analyses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_menus`
--
ALTER TABLE `sub_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `system_notifications`
--
ALTER TABLE `system_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transmissions`
--
ALTER TABLE `transmissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tra_calculation_logs`
--
ALTER TABLE `tra_calculation_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vehicle_images`
--
ALTER TABLE `vehicle_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1528;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD CONSTRAINT `bill_items_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_items_ibfk_2` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `cf_quotations`
--
ALTER TABLE `cf_quotations`
  ADD CONSTRAINT `fk_cf_quotations_application` FOREIGN KEY (`application_id`) REFERENCES `import_duty_applications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cf_quotations_company` FOREIGN KEY (`cf_company_id`) REFERENCES `clearing_forwarding_companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_quotation_tra_log` FOREIGN KEY (`tra_calculation_log_id`) REFERENCES `tra_calculation_logs` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dealer_reviews`
--
ALTER TABLE `dealer_reviews`
  ADD CONSTRAINT `dealer_reviews_ibfk_1` FOREIGN KEY (`dealer_id`) REFERENCES `car_dealers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employer_verifications`
--
ALTER TABLE `employer_verifications`
  ADD CONSTRAINT `fk_employer_verifications_application` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feature_vehicle`
--
ALTER TABLE `feature_vehicle`
  ADD CONSTRAINT `feature_vehicle_ibfk_1` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feature_vehicle_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `import_duty_applications`
--
ALTER TABLE `import_duty_applications`
  ADD CONSTRAINT `fk_import_duty_cf_company` FOREIGN KEY (`selected_cf_company_id`) REFERENCES `clearing_forwarding_companies` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_import_duty_lender` FOREIGN KEY (`selected_lender_id`) REFERENCES `lenders` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD CONSTRAINT `inquiries_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inquiries_ibfk_2` FOREIGN KEY (`dealer_id`) REFERENCES `car_dealers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lender_financing_criterias`
--
ALTER TABLE `lender_financing_criterias`
  ADD CONSTRAINT `fk_lender` FOREIGN KEY (`lender_id`) REFERENCES `lenders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_make` FOREIGN KEY (`make_id`) REFERENCES `makes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_model` FOREIGN KEY (`model_id`) REFERENCES `vehicle_models` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lender_financing_offers`
--
ALTER TABLE `lender_financing_offers`
  ADD CONSTRAINT `fk_lender_offers_application` FOREIGN KEY (`application_id`) REFERENCES `import_duty_applications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_lender_offers_lender` FOREIGN KEY (`lender_id`) REFERENCES `lenders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `spare_brands`
--
ALTER TABLE `spare_brands`
  ADD CONSTRAINT `fk_spare_brands_category` FOREIGN KEY (`spare_category_id`) REFERENCES `spare_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `spare_models`
--
ALTER TABLE `spare_models`
  ADD CONSTRAINT `fk_spare_models_brand` FOREIGN KEY (`spare_brand_id`) REFERENCES `spare_brands` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `spare_parts`
--
ALTER TABLE `spare_parts`
  ADD CONSTRAINT `fk_spare_parts_brand` FOREIGN KEY (`spare_brand_id`) REFERENCES `spare_brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_spare_parts_category` FOREIGN KEY (`spare_category_id`) REFERENCES `spare_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_spare_parts_model` FOREIGN KEY (`spare_model_id`) REFERENCES `spare_models` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_spare_parts_shop` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `spare_part_payments`
--
ALTER TABLE `spare_part_payments`
  ADD CONSTRAINT `spare_part_payments_ibfk_1` FOREIGN KEY (`quote_id`) REFERENCES `spare_part_quotes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `spare_part_quotes`
--
ALTER TABLE `spare_part_quotes`
  ADD CONSTRAINT `spare_part_quotes_ibfk_1` FOREIGN KEY (`spare_part_request_id`) REFERENCES `spare_part_requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `spare_part_quotes_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `spare_part_requests`
--
ALTER TABLE `spare_part_requests`
  ADD CONSTRAINT `spare_part_requests_make_id_foreign` FOREIGN KEY (`make_id`) REFERENCES `makes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `spare_part_requests_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `vehicle_models` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tra_calculation_logs`
--
ALTER TABLE `tra_calculation_logs`
  ADD CONSTRAINT `fk_tra_log_application` FOREIGN KEY (`application_id`) REFERENCES `import_duty_applications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tra_log_cf_company` FOREIGN KEY (`cf_company_id`) REFERENCES `clearing_forwarding_companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicle_images`
--
ALTER TABLE `vehicle_images`
  ADD CONSTRAINT `vehicle_images_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
