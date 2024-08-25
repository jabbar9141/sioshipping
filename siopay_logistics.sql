-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 19, 2024 at 09:32 AM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siopay_logistics`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `can` enum('all','kyc','accounts') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `created_at`, `updated_at`, `can`) VALUES
(1, 3, '2023-11-19 16:55:31', '2023-11-19 16:55:31', 'kyc'),
(2, 4, '2023-11-19 17:03:21', '2023-11-19 17:03:21', 'accounts'),
(3, 1, '2023-11-19 17:03:21', '2023-11-19 17:03:21', 'all');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `beneficiary_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `beneficiary_phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `beneficiary_country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_datas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_accounts`
--

CREATE TABLE `beneficiary_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `beneficiary_id` bigint UNSIGNED NOT NULL,
  `beneficiary_account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `beneficiary_account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `beneficiary_bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `beneficiary_bank_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_datas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_location` bigint UNSIGNED DEFAULT NULL,
  `vehicle_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive','decommisioned') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `phone`, `phone_alt`, `address1`, `address2`, `zip`, `city`, `state`, `country`, `created_at`, `updated_at`) VALUES
(1, 1, '0802222222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-10 11:33:50', '2023-10-10 11:33:50'),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-19 16:55:31', '2023-11-19 16:55:31'),
(4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-19 17:03:21', '2023-11-19 17:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `dispatchers`
--

CREATE TABLE `dispatchers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `agency_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'person',
  `business_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_id_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pec` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc_status` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dispatchers`
--

INSERT INTO `dispatchers` (`id`, `user_id`, `name`, `phone`, `phone_alt`, `address1`, `address2`, `zip`, `city`, `state`, `country`, `location_id`, `created_at`, `updated_at`, `agency_type`, `business_name`, `tax_id_code`, `vat_no`, `pec`, `sdi`, `kyc_status`) VALUES
(1, 1, 'Apollos Technologies', '07050737402', '07050737402', 'Piazza Medaglia d\'Oro Porcelli', NULL, '88046', 'Lamezia Terme', 'CZ', 'Italy', NULL, '2023-10-08 06:51:44', '2024-02-09 09:46:20', 'person', NULL, '65656565', NULL, NULL, NULL, 0),
(4, 2, 'Apollos Technologies', '07050737402', '07050737402', 'Elwazir Street,bosso', 'Vcm 105 Elwazir Estate', '920281', 'Minna', 'Niger', 'Nigeria', NULL, '2023-10-08 06:51:44', '2023-11-27 09:32:22', 'person', NULL, NULL, NULL, NULL, NULL, 0),
(5, 3, 'Apollos Technologies', '07050737402', '07050737402', 'Elwazir Street,bosso', 'Vcm 105 Elwazir Estate', '920281', 'Minna', 'Niger', 'Nigeria', NULL, '2023-10-08 06:51:44', '2023-10-08 07:45:24', 'person', NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `e_u_funds_transfer_rates`
--

CREATE TABLE `e_u_funds_transfer_rates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_country_eu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rx_country_eu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `calc` enum('perc','fixed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `commision` double NOT NULL DEFAULT '1',
  `ex_rate` double NOT NULL DEFAULT '1',
  `min_amt` double NOT NULL DEFAULT '0',
  `max_amt` double NOT NULL DEFAULT '999',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `e_u_funds_transfer_rates`
--

INSERT INTO `e_u_funds_transfer_rates` (`id`, `name`, `s_country_eu`, `rx_country_eu`, `calc`, `commision`, `ex_rate`, `min_amt`, `max_amt`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Platinum', 'Italy', 'United Kingdom', 'perc', 2, 1, 1, 999, 1, '2023-10-25 09:49:31', '2023-10-25 09:49:31'),
(2, 'Premiumr', 'Italy', 'Hungary', 'fixed', 1, 1, 10, 999, 1, '2023-10-28 14:42:13', '2023-10-28 14:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `e_u_fund_transfer_orders`
--

CREATE TABLE `e_u_fund_transfer_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `walk_in_customer_id` bigint UNSIGNED DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `dispatcher_id` bigint UNSIGNED DEFAULT NULL,
  `e_u_funds_transfer_rate_id` bigint UNSIGNED DEFAULT NULL,
  `tracking_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_bank_routing_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_bank_swift_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_bank_account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_bank_account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_amount` double DEFAULT NULL,
  `rx_amount` double DEFAULT NULL,
  `tx_status` enum('unpaid','pending','done','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `tx_reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `e_u_fund_transfer_orders`
--

INSERT INTO `e_u_fund_transfer_orders` (`id`, `walk_in_customer_id`, `customer_id`, `dispatcher_id`, `e_u_funds_transfer_rate_id`, `tracking_id`, `rx_surname`, `rx_name`, `rx_phone`, `rx_email`, `rx_bank_name`, `rx_bank_routing_no`, `rx_bank_swift_code`, `rx_bank_account_name`, `rx_bank_account_number`, `rx_country`, `s_country`, `s_amount`, `rx_amount`, `tx_status`, `tx_reference`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 1, 'SIO-EUR86502243', NULL, NULL, '08188223228', 'walshak1999@gmail.com', 'zenith', '2827', NULL, 'wal', '22737373737', 'United Kingdom', 'Italy', 100, 100, 'done', 'pi_3O5xr4CPuHcGXdFK1LyPTppj', '2023-10-27 19:46:43', '2023-10-28 14:38:50'),
(2, 2, 1, 1, 1, 'SIO-EUR86452198', NULL, NULL, '07050737402', 'walshak1999@gmail.com', 'zenith', '2827', NULL, 'wal', '22737373737', 'United Kingdom', 'Italy', 100, 100, 'rejected', 'pi_3O6E8XCPuHcGXdFK1nigA9KO', '2023-10-28 14:08:46', '2023-10-28 14:37:20'),
(3, 5, 1, 1, 1, 'SIO-EUR34125856', NULL, NULL, '07050737402', 'walshak1999@gmail.com', 'zenith', '2827', NULL, 'wal', '22737373737', 'United Kingdom', 'Italy', 55, 55, 'pending', '23', '2023-11-19 07:37:08', '2023-11-19 07:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intl_funds_transfer_rates`
--

CREATE TABLE `intl_funds_transfer_rates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rx_country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rx_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ex_rate` double NOT NULL DEFAULT '1',
  `calc` enum('perc','fixed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `commision` double NOT NULL DEFAULT '1',
  `min_amt` double NOT NULL DEFAULT '0',
  `max_amt` double NOT NULL DEFAULT '999',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intl_funds_transfer_rates`
--

INSERT INTO `intl_funds_transfer_rates` (`id`, `name`, `s_country`, `rx_country`, `s_currency`, `rx_currency`, `ex_rate`, `calc`, `commision`, `min_amt`, `max_amt`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Premium-momo mobile money', 'Italy', 'Nigeria', 'EUR - Euro', 'NGN - Nigerian Naira', 1200, 'perc', 2, 1, 999, 1, '2023-10-25 09:39:56', '2023-10-25 09:39:56'),
(2, 'Bronze pickup', 'Italy', 'Nigeria', 'EUR - Euro', 'NGN - Nigerian Naira', 1400, 'perc', 5, 10, 970, 1, '2023-10-28 14:46:52', '2023-10-28 14:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `intl_fund_transfer_orders`
--

CREATE TABLE `intl_fund_transfer_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `walk_in_customer_id` bigint UNSIGNED DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `dispatcher_id` bigint UNSIGNED DEFAULT NULL,
  `e_u_funds_transfer_rate_id` bigint UNSIGNED DEFAULT NULL,
  `tracking_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_bank_routing_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_bank_swift_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_bank_account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_bank_account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rx_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_amount` double DEFAULT NULL,
  `rx_amount` double DEFAULT NULL,
  `tx_status` enum('unpaid','pending','done','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `tx_reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intl_fund_transfer_orders`
--

INSERT INTO `intl_fund_transfer_orders` (`id`, `walk_in_customer_id`, `customer_id`, `dispatcher_id`, `e_u_funds_transfer_rate_id`, `tracking_id`, `rx_surname`, `rx_name`, `rx_phone`, `rx_email`, `rx_bank_name`, `rx_bank_routing_no`, `rx_bank_swift_code`, `rx_bank_account_name`, `rx_bank_account_number`, `rx_country`, `s_country`, `rx_currency`, `s_currency`, `s_amount`, `rx_amount`, `tx_status`, `tx_reference`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 1, 'SIO-EUR74379852', NULL, NULL, '07050737402', 'walshak1999@gmail.com', 'zenith', '2827', NULL, 'wal', '22737373737', 'Nigeria', 'Italy', 'NGN - Nigerian Naira', 'EUR - Euro', 100, 120000, 'rejected', 'pi_3O60KICPuHcGXdFK0Y07LX2s', '2023-10-27 23:14:03', '2023-10-28 10:24:17'),
(2, 2, 1, 1, 1, 'SIO-INTL80180491', NULL, NULL, '08188223228', 'walshak1999@gmail.com', 'zenith', '2827', NULL, 'wal', '22737373737', 'Nigeria', 'Italy', 'NGN - Nigerian Naira', 'EUR - Euro', 200, 240000, 'pending', '29', '2023-10-28 07:05:54', '2023-11-19 07:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `kyc`
--

CREATE TABLE `kyc` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `document_type_id` bigint UNSIGNED DEFAULT NULL,
  `document_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_issue_date` date DEFAULT NULL,
  `document_expiry_date` date DEFAULT NULL,
  `selfie` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `proof_of_address_type_id` bigint UNSIGNED DEFAULT NULL,
  `proof_of_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kyc_level` int NOT NULL DEFAULT '0',
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `rejection_reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `personal_information` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc`
--

INSERT INTO `kyc` (`id`, `user_id`, `document_type_id`, `document_number`, `document_issue_date`, `document_expiry_date`, `selfie`, `proof_of_address_type_id`, `proof_of_address`, `kyc_level`, `status`, `rejection_reason`, `created_at`, `updated_at`, `personal_information`) VALUES
(1, 2, 1, '242324', '2023-11-01', '2024-01-05', 'uu.jpg', 2, 'pp.pdf', 1, 'approved', 'test', NULL, '2023-11-27 11:41:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kyc_address_proof_types`
--

CREATE TABLE `kyc_address_proof_types` (
  `id` bigint UNSIGNED NOT NULL,
  `document_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_address_proof_types`
--

INSERT INTO `kyc_address_proof_types` (`id`, `document_name`, `created_at`, `updated_at`) VALUES
(1, 'Residence permit', NULL, NULL),
(2, 'Utility Bill', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kyc_document_type`
--

CREATE TABLE `kyc_document_type` (
  `id` bigint UNSIGNED NOT NULL,
  `document_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_document_type`
--

INSERT INTO `kyc_document_type` (`id`, `document_name`, `created_at`, `updated_at`) VALUES
(1, 'Passport', NULL, NULL),
(2, 'EU ID Card', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `latitude`, `longitude`, `country_code`, `postcode`, `created_at`, `updated_at`) VALUES
(1, 'Jos', '9.896527', '8.858331', 'NG', '930105', '2023-10-02 07:18:17', '2024-02-03 10:56:48'),
(2, 'Lagos', '6.465422', '3.406448', 'NG', '920281', '2023-10-02 08:50:41', '2024-02-03 10:59:27'),
(3, 'Minna', '9.583555', '6.546316', 'NG', '920283', '2023-10-05 07:21:37', '2023-10-09 09:47:35'),
(4, 'Lamezia Terme', '38.966667', '16.3', 'IT', '88046', '2024-02-08 12:35:49', '2024-02-08 12:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_01_175034_create_locations_table', 1),
(6, '2023_10_01_175530_create_customers_table', 1),
(7, '2023_10_01_181748_create_couriers_table', 1),
(8, '2023_10_01_181821_create_dispatchers_table', 1),
(9, '2023_10_01_184316_create_admins_table', 1),
(11, '2023_10_01_190628_create_vehicles_table', 1),
(15, '2023_10_05_182532_add_postcode_col_to_locations_table', 2),
(20, '2023_10_01_213417_create_shipping_rates_table', 3),
(23, '2023_10_01_185553_create_orders_table', 4),
(25, '2023_10_01_213229_create_order_batches_table', 6),
(26, '2023_10_06_190015_create_order_packages_table', 7),
(27, '2023_10_01_213929_add_batch_id_col_to_orders_table', 8),
(29, '2023_10_09_092606_add_pickup_cost_to_shipping_rates_table', 9),
(30, '2023_10_08_153417_create_payments_table', 10),
(31, '2023_10_10_063141_add_blocked_col_to_users_table', 11),
(32, '2023_10_10_073114_add_customer_id_col_to_payments_table', 12),
(33, '2023_10_10_081718_add_email_sent_col_to_payments_table', 13),
(36, '2023_10_25_071312_create_e_u_funds_transfer_rates_table', 15),
(37, '2023_10_25_071325_create_intl_funds_transfer_rates_table', 16),
(38, '2023_10_26_133444_create_walk_in_customers_table', 17),
(39, '2023_10_26_211532_add_walkincustomercol_to_orders_table', 17),
(44, '2023_10_27_080804_create_e_u_fund_transfer_orders_table', 21),
(47, '2023_10_27_080819_create_intl_fund_transfer_orders_table', 22),
(48, '2023_10_28_075741_add_contact_to_walk_in_customers_table', 23),
(49, '2023_11_17_120452_create_user_funds_table', 24),
(50, '2023_11_19_164924_add_agency_cols_to_dispatchers_table', 25),
(51, '2023_11_20_182243_add_can_col_to_admins_table', 26),
(52, '2023_11_27_085022_add_kyc_col_to_dispatchers_table', 27),
(53, '2023_11_23_184011_create_kyc_document_type_table', 28),
(54, '2023_11_23_185038_create_kyc_address_proof_types_table', 28),
(55, '2023_11_23_190245_create_kyc_table', 28),
(57, '2014_10_12_000000_create_users_table', 29),
(58, '2023_12_03_104313_create_beneficiaries_table', 30),
(59, '2023_12_03_104322_create_beneficiary_accounts_table', 30),
(60, '2023_12_03_104414_create_transactions_table', 30),
(61, '2023_12_12_075509_create_operation_countries_table', 30),
(63, '2023_12_24_171217_create_supported_banks_table', 31),
(69, '2016_06_01_000001_create_oauth_auth_codes_table', 32),
(70, '2016_06_01_000002_create_oauth_access_tokens_table', 32),
(71, '2016_06_01_000003_create_oauth_refresh_tokens_table', 32),
(72, '2016_06_01_000004_create_oauth_clients_table', 32),
(73, '2016_06_01_000005_create_oauth_personal_access_clients_table', 32),
(74, '2023_12_14_181545_add_phone_to_users_table', 32),
(75, '2023_12_14_190559_add_receiveing_and_sending_to_operation_countries_table', 32),
(76, '2023_12_15_091949_add_personal_information_col_to_kyc_table', 32),
(77, '2023_12_15_200626_create_transfer_intent_table', 32),
(78, '2023_12_20_060801_add_payment_intent_data_col_to_transfer_intent_table', 32),
(79, '2023_12_20_063327_add_kyc_level_col_to_users_table', 32),
(80, '2023_12_24_172925_add_payment_intent_to_transactions_table', 32),
(81, '2023_12_24_180811_add_webhook_data_to_transactions_table', 32),
(82, '2024_02_03_104800_add_country_code_to_locations', 32),
(83, '2024_02_16_113930_add_customs_col_to_orders_table', 33),
(84, '2024_02_16_114003_add_customs_col_to_order_packages_table', 33);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operation_countries`
--

CREATE TABLE `operation_countries` (
  `id` bigint UNSIGNED NOT NULL,
  `country_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_alpha2code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_alpha3code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `receiving` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `sending` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `walk_in_customer_id` bigint UNSIGNED DEFAULT NULL,
  `delivery_customer_id` bigint UNSIGNED DEFAULT NULL,
  `courier_id` bigint UNSIGNED DEFAULT NULL,
  `dispatcher_id` bigint UNSIGNED DEFAULT NULL,
  `batch_id` bigint UNSIGNED DEFAULT NULL,
  `shipping_rate_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('unpaid','placed','assigned','in_transit','delivered','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `pickup_location_id` bigint UNSIGNED DEFAULT NULL,
  `delivery_location_id` bigint UNSIGNED DEFAULT NULL,
  `current_location_id` bigint UNSIGNED DEFAULT NULL,
  `tracking_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pickup_time` timestamp NULL DEFAULT NULL,
  `delivery_time` timestamp NULL DEFAULT NULL,
  `delivery_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_phone_alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_address1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `delivery_address2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `delivery_zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_phone_alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_address1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `pickup_address2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `pickup_zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `cond_of_goods` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val_of_goods` double(8,2) DEFAULT NULL,
  `val_cur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customs_inv_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_of_sale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `walk_in_customer_id`, `delivery_customer_id`, `courier_id`, `dispatcher_id`, `batch_id`, `shipping_rate_id`, `status`, `pickup_location_id`, `delivery_location_id`, `current_location_id`, `tracking_id`, `pickup_time`, `delivery_time`, `delivery_name`, `delivery_email`, `delivery_phone`, `delivery_phone_alt`, `delivery_address1`, `delivery_address2`, `delivery_zip`, `delivery_city`, `delivery_state`, `delivery_country`, `pickup_name`, `pickup_phone`, `pickup_email`, `pickup_phone_alt`, `pickup_address1`, `pickup_address2`, `pickup_zip`, `pickup_city`, `pickup_state`, `pickup_country`, `return_date`, `cond_of_goods`, `val_of_goods`, `val_cur`, `provider`, `customs_inv_num`, `terms_of_sale`, `created_at`, `updated_at`) VALUES
(3, 1, NULL, NULL, NULL, NULL, 1, 1, 'in_transit', 2, 1, 3, 'SIP1696717654', NULL, NULL, 'Walshak Rx', 'walshak1999@gmail.com', '07050737402', NULL, 'Dankankani village, Furaka district, Bauchi ring road', NULL, '920281', 'Minna', 'Niger', 'Nigeria', 'Walshak Timothy Apollos', '08188223228', 'walshak1999@gmail.com', '08188223228', 'Elwazir Street,bosso', 'Vcm 105 Elwazir Estate', '920281', 'Minna', 'Niger', 'Nigeria', '2023-10-07', 'goodo', 100000.00, 'EUR - Euro', NULL, NULL, NULL, '2023-10-07 14:14:55', '2023-10-10 10:56:20'),
(4, 1, NULL, NULL, NULL, NULL, 1, 1, 'in_transit', 2, 1, 3, 'SIP1696842642', NULL, NULL, 'Walshak Rx2', 'walshak1999@gmail.com', '08188223228', NULL, 'Elwazir Street,bosso', NULL, '920281', 'Minna', 'Niger', 'Nigeria', 'Walshak Timothy Apollos', '07050737402', 'walshak1999@gmail.com', NULL, 'Dankankani village, Furaka district, Bauchi ring road', NULL, '930232', 'Jos', 'Plateau', 'Nigeria', '2023-10-01', 'good', 1000.00, 'EUR - Euro', NULL, NULL, NULL, '2023-10-09 08:10:42', '2023-10-10 10:56:20'),
(5, 1, NULL, NULL, NULL, 1, 1, 1, 'in_transit', 2, 1, 3, 'SIP1696927405', NULL, NULL, 'Simon James ed', 'simon@gmail.com', '07050737402', NULL, 'Dankankani village, Furaka district, Bauchi ring road', NULL, '930232', 'Jos', 'Plateau', 'Nigeria', 'Walshak Timothy Apollos', '08188223228', 'walshak1999@gmail.com', NULL, 'Elwazir Street,bosso', 'Vcm 105 Elwazir Estate', '920281', 'Minna', 'Niger', 'Nigeria', '2023-10-01', 'good', 1000.00, 'EUR - Euro', NULL, NULL, NULL, '2023-10-09 10:12:51', '2023-10-10 10:56:20'),
(6, 1, 1, NULL, NULL, NULL, NULL, 1, 'placed', 2, 1, 2, 'SIO1698364331', NULL, NULL, 'Walshak Timothy Apollos', 'walshak1999@gmail.com', '07050737402', '07050737402', 'Elwazir Street,bosso\r\nVcm 105 Elwazir Estate', 'Elwazir Street,bosso\r\nVcm 105 Elwazir Estate', '920281', 'Minna', 'Niger', 'Nigeria', 'Walshak Timothy Apollos', '07050737402', 'walshak1999@gmail.com', '08188223228', 'Dankankani village, Furaka district, Bauchi ring road', 'Dankankani village, Furaka district, Bauchi ring road', '930232', 'Jos', 'Plateau', 'Nigeria', '2023-10-20', 'good', 1000.00, 'AED - United Arab Emirates Dirham', NULL, NULL, NULL, '2023-10-26 22:52:11', '2023-11-19 05:47:51'),
(7, 1, 2, NULL, NULL, NULL, NULL, 1, 'placed', 2, 1, 2, 'SIO1698390297', NULL, NULL, 'Walshak Timothy Apollos', 'walshak1999@gmail.com', '07050737402', NULL, 'Dankankani village, Furaka district, Bauchi ring road', NULL, '930232', 'Jos', 'Plateau', 'Nigeria', 'Walshak Timothy Apollos', '08188223228', 'walshak1999@gmail.com', NULL, 'Elwazir Street,bosso', 'Vcm 105 Elwazir Estate', '920281', 'Minna', 'Niger', 'Nigeria', '2023-10-27', 'good', 1000.00, 'EUR - Euro', NULL, NULL, NULL, '2023-10-27 06:04:57', '2023-11-18 20:10:45'),
(8, 1, 2, NULL, NULL, NULL, NULL, 1, 'placed', 2, 1, 2, 'SIO1698390815', NULL, NULL, 'Walshak Timothy Apollos', 'walshak1999@gmail.com', '08188223228', NULL, 'Elwazir Street,bosso', NULL, '920281', 'Minna', 'Niger', 'Nigeria', 'Walshak Timothy Apollos', '07050737402', 'walshak1999@gmail.com', NULL, 'Dankankani village, Furaka district, Bauchi ring road', NULL, '930232', 'Jos', 'Plateau', 'Nigeria', '2023-10-01', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-27 06:13:35', '2023-11-18 20:06:56'),
(9, 1, 2, NULL, NULL, NULL, NULL, 1, 'placed', 2, 1, 2, 'SIO1698391275', NULL, NULL, 'Walshak Timothy Apollos', 'walshak1999@gmail.com', '08188223228', NULL, 'Elwazir Street,bosso', 'Vcm 105 Elwazir Estate', '920281', 'Minna', 'Niger', 'Nigeria', 'Walshak Timothy Apollos', '07050737402', 'walshak1999@gmail.com', '07050737402', 'Dankankani village, Furaka district, Bauchi ring road', NULL, '930232', 'Jos', 'Plateau', 'Nigeria', '2023-10-21', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-27 06:21:15', '2023-10-27 06:32:59'),
(10, 1, 2, NULL, NULL, NULL, NULL, 1, 'placed', 2, 1, 2, 'SIO1698504884', NULL, NULL, 'Walshak Gory', 'walshak1999@gmail.com', '08188223228', NULL, 'Elwazir Street,bosso', 'Vcm 105 Elwazir Estate', '920281', 'Minna', 'Niger', 'Nigeria', 'Walshak Timothy Apollos', '07050737402', 'walshak1999@gmail.com', NULL, 'Elwazir Street,bosso', 'Vcm 105 Elwazir Estate', '920281', 'Minna', 'Niger', 'Nigeria', '2023-10-28', 'good', 1000.00, 'EUR - Euro', NULL, NULL, NULL, '2023-10-28 13:54:44', '2023-11-18 20:00:06'),
(11, 1, 4, NULL, NULL, NULL, NULL, 1, 'placed', 2, 1, 2, 'SIO1700339248', NULL, NULL, 'Walshak Timothy Apollos', 'walshak1999@gmail.com', '07050737402', NULL, 'Dankankani village, Furaka district, Bauchi ring road', NULL, '930232', 'Jos', 'Plateau', 'Nigeria', 'Walshak Timothy Apollos', '08188223228', 'walshak1999@gmail.com', NULL, 'Elwazir Street,bosso', 'Vcm 105 Elwazir Estate', '920281', 'Minna', 'Niger', 'Nigeria', '2023-11-04', NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-18 19:27:28', '2023-11-18 19:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_batches`
--

CREATE TABLE `order_batches` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dispatcher_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('assigned','in_transit','delivered','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'assigned',
  `location_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_batches`
--

INSERT INTO `order_batches` (`id`, `name`, `dispatcher_id`, `status`, `location_id`, `created_at`, `updated_at`) VALUES
(1, 'BA-1696757437-Lagos-Jos', 1, 'in_transit', 3, '2023-10-08 08:30:37', '2023-10-10 10:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `order_packages`
--

CREATE TABLE `order_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length` double(8,2) DEFAULT NULL,
  `width` double(8,2) DEFAULT NULL,
  `height` double(8,2) DEFAULT NULL,
  `weight` double(8,2) DEFAULT NULL,
  `qty` double(8,2) DEFAULT NULL,
  `item_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_packages`
--

INSERT INTO `order_packages` (`id`, `order_id`, `type`, `length`, `width`, `height`, `weight`, `qty`, `item_desc`, `item_value`, `created_at`, `updated_at`) VALUES
(3, 5, 'percel', 1.00, 2.00, 3.00, 0.50, 1.00, NULL, NULL, '2023-10-09 10:12:51', '2023-10-10 07:43:25'),
(4, 5, 'doc', 0.20, 0.10, 0.60, 0.50, 2.00, NULL, NULL, '2023-10-09 10:12:51', '2023-10-10 07:43:25'),
(5, 6, 'percel', 1.00, 1.00, 1.00, 1.00, 1.00, NULL, NULL, '2023-10-26 22:52:11', '2023-10-26 22:52:11'),
(6, 7, 'doc', 1.00, 1.00, 1.00, 1.00, 1.00, NULL, NULL, '2023-10-27 06:04:57', '2023-10-27 06:04:57'),
(7, 8, 'percel', 1.00, 2.00, 1.00, 1.00, 1.00, NULL, NULL, '2023-10-27 06:13:35', '2023-10-27 06:13:35'),
(8, 9, 'pallet', 1.00, 2.00, 2.00, 3.00, 1.00, NULL, NULL, '2023-10-27 06:21:15', '2023-10-27 06:21:15'),
(9, 10, 'percel', 2.00, 3.00, 1.00, 4.00, 1.00, NULL, NULL, '2023-10-28 13:54:44', '2023-10-28 13:54:44'),
(10, 10, 'doc', 1.00, 1.00, 1.00, 0.20, 1.00, NULL, NULL, '2023-10-28 13:54:44', '2023-10-28 13:54:44'),
(11, 11, 'doc', 1.00, 1.00, 1.00, 1.00, 1.00, NULL, NULL, '2023-11-18 19:27:28', '2023-11-18 19:27:28');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `email_sent` tinyint(1) NOT NULL DEFAULT '0',
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `ref` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amt_expected` double(8,2) NOT NULL DEFAULT '0.00',
  `amt_paid` double(8,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','done','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `misc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `email_sent`, `customer_id`, `ref`, `amt_expected`, `amt_paid`, `status`, `misc`, `created_at`, `updated_at`) VALUES
(1, 4, 0, 1, 'pi_3NzO1sCPuHcGXdFK0HZAWsjT', 2465.00, 2465.00, 'done', '{\"headers\":{},\"body\":\"{\\n  \\\"id\\\": \\\"pi_3NzO1sCPuHcGXdFK0HZAWsjT\\\",\\n  \\\"object\\\": \\\"payment_intent\\\",\\n  \\\"amount\\\": 2465,\\n  \\\"amount_capturable\\\": 0,\\n  \\\"amount_details\\\": {\\n    \\\"tip\\\": {}\\n  },\\n  \\\"amount_received\\\": 2465,\\n  \\\"application\\\": null,\\n  \\\"application_fee_amount\\\": null,\\n  \\\"automatic_payment_methods\\\": {\\n    \\\"allow_redirects\\\": \\\"always\\\",\\n    \\\"enabled\\\": true\\n  },\\n  \\\"canceled_at\\\": null,\\n  \\\"cancellation_reason\\\": null,\\n  \\\"capture_method\\\": \\\"automatic\\\",\\n  \\\"client_secret\\\": \\\"pi_3NzO1sCPuHcGXdFK0HZAWsjT_secret_nLXlk4sahDVDAc5XLJeEpPltm\\\",\\n  \\\"confirmation_method\\\": \\\"automatic\\\",\\n  \\\"created\\\": 1696875488,\\n  \\\"currency\\\": \\\"eur\\\",\\n  \\\"customer\\\": null,\\n  \\\"description\\\": null,\\n  \\\"invoice\\\": null,\\n  \\\"last_payment_error\\\": null,\\n  \\\"latest_charge\\\": \\\"ch_3NzO1sCPuHcGXdFK0uytvBYT\\\",\\n  \\\"livemode\\\": false,\\n  \\\"metadata\\\": {},\\n  \\\"next_action\\\": null,\\n  \\\"on_behalf_of\\\": null,\\n  \\\"payment_method\\\": \\\"pm_1NzQwfCPuHcGXdFKE842Wv1o\\\",\\n  \\\"payment_method_configuration_details\\\": {\\n    \\\"id\\\": \\\"pmc_1LRcNhCPuHcGXdFKlIjueJUS\\\",\\n    \\\"parent\\\": null\\n  },\\n  \\\"payment_method_options\\\": {\\n    \\\"card\\\": {\\n      \\\"installments\\\": null,\\n      \\\"mandate_options\\\": null,\\n      \\\"network\\\": null,\\n      \\\"request_three_d_secure\\\": \\\"automatic\\\"\\n    }\\n  },\\n  \\\"payment_method_types\\\": [\\n    \\\"card\\\"\\n  ],\\n  \\\"processing\\\": null,\\n  \\\"receipt_email\\\": null,\\n  \\\"review\\\": null,\\n  \\\"setup_future_usage\\\": null,\\n  \\\"shipping\\\": null,\\n  \\\"source\\\": null,\\n  \\\"statement_descriptor\\\": null,\\n  \\\"statement_descriptor_suffix\\\": null,\\n  \\\"status\\\": \\\"succeeded\\\",\\n  \\\"transfer_data\\\": null,\\n  \\\"transfer_group\\\": null\\n}\",\"json\":{\"id\":\"pi_3NzO1sCPuHcGXdFK0HZAWsjT\",\"object\":\"payment_intent\",\"amount\":2465,\"amount_capturable\":0,\"amount_details\":{\"tip\":[]},\"amount_received\":2465,\"application\":null,\"application_fee_amount\":null,\"automatic_payment_methods\":{\"allow_redirects\":\"always\",\"enabled\":true},\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"client_secret\":\"pi_3NzO1sCPuHcGXdFK0HZAWsjT_secret_nLXlk4sahDVDAc5XLJeEpPltm\",\"confirmation_method\":\"automatic\",\"created\":1696875488,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"latest_charge\":\"ch_3NzO1sCPuHcGXdFK0uytvBYT\",\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":\"pm_1NzQwfCPuHcGXdFKE842Wv1o\",\"payment_method_configuration_details\":{\"id\":\"pmc_1LRcNhCPuHcGXdFKlIjueJUS\",\"parent\":null},\"payment_method_options\":{\"card\":{\"installments\":null,\"mandate_options\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"processing\":null,\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null},\"code\":200}', '2023-10-09 17:18:08', '2023-10-09 20:25:02'),
(10, 5, 1, 1, 'pi_3NzeQRCPuHcGXdFK1z263HT0', 1168.00, 1168.00, 'done', '{\"headers\":{},\"body\":\"{\\n  \\\"id\\\": \\\"pi_3NzeQRCPuHcGXdFK1z263HT0\\\",\\n  \\\"object\\\": \\\"payment_intent\\\",\\n  \\\"amount\\\": 116800,\\n  \\\"amount_capturable\\\": 0,\\n  \\\"amount_details\\\": {\\n    \\\"tip\\\": {}\\n  },\\n  \\\"amount_received\\\": 116800,\\n  \\\"application\\\": null,\\n  \\\"application_fee_amount\\\": null,\\n  \\\"automatic_payment_methods\\\": {\\n    \\\"allow_redirects\\\": \\\"always\\\",\\n    \\\"enabled\\\": true\\n  },\\n  \\\"canceled_at\\\": null,\\n  \\\"cancellation_reason\\\": null,\\n  \\\"capture_method\\\": \\\"automatic\\\",\\n  \\\"client_secret\\\": \\\"pi_3NzeQRCPuHcGXdFK1z263HT0_secret_aI6F0uJUrcUzVnrwFN5uL8aCc\\\",\\n  \\\"confirmation_method\\\": \\\"automatic\\\",\\n  \\\"created\\\": 1696938515,\\n  \\\"currency\\\": \\\"eur\\\",\\n  \\\"customer\\\": null,\\n  \\\"description\\\": null,\\n  \\\"invoice\\\": null,\\n  \\\"last_payment_error\\\": null,\\n  \\\"latest_charge\\\": \\\"ch_3NzeQRCPuHcGXdFK1TFGiAbr\\\",\\n  \\\"livemode\\\": false,\\n  \\\"metadata\\\": {},\\n  \\\"next_action\\\": null,\\n  \\\"on_behalf_of\\\": null,\\n  \\\"payment_method\\\": \\\"pm_1NzeR2CPuHcGXdFKNl7Xddzh\\\",\\n  \\\"payment_method_configuration_details\\\": {\\n    \\\"id\\\": \\\"pmc_1LRcNhCPuHcGXdFKlIjueJUS\\\",\\n    \\\"parent\\\": null\\n  },\\n  \\\"payment_method_options\\\": {\\n    \\\"card\\\": {\\n      \\\"installments\\\": null,\\n      \\\"mandate_options\\\": null,\\n      \\\"network\\\": null,\\n      \\\"request_three_d_secure\\\": \\\"automatic\\\"\\n    }\\n  },\\n  \\\"payment_method_types\\\": [\\n    \\\"card\\\"\\n  ],\\n  \\\"processing\\\": null,\\n  \\\"receipt_email\\\": null,\\n  \\\"review\\\": null,\\n  \\\"setup_future_usage\\\": null,\\n  \\\"shipping\\\": null,\\n  \\\"source\\\": null,\\n  \\\"statement_descriptor\\\": null,\\n  \\\"statement_descriptor_suffix\\\": null,\\n  \\\"status\\\": \\\"succeeded\\\",\\n  \\\"transfer_data\\\": null,\\n  \\\"transfer_group\\\": null\\n}\",\"json\":{\"id\":\"pi_3NzeQRCPuHcGXdFK1z263HT0\",\"object\":\"payment_intent\",\"amount\":116800,\"amount_capturable\":0,\"amount_details\":{\"tip\":[]},\"amount_received\":116800,\"application\":null,\"application_fee_amount\":null,\"automatic_payment_methods\":{\"allow_redirects\":\"always\",\"enabled\":true},\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"client_secret\":\"pi_3NzeQRCPuHcGXdFK1z263HT0_secret_aI6F0uJUrcUzVnrwFN5uL8aCc\",\"confirmation_method\":\"automatic\",\"created\":1696938515,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"latest_charge\":\"ch_3NzeQRCPuHcGXdFK1TFGiAbr\",\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":\"pm_1NzeR2CPuHcGXdFKNl7Xddzh\",\"payment_method_configuration_details\":{\"id\":\"pmc_1LRcNhCPuHcGXdFKlIjueJUS\",\"parent\":null},\"payment_method_options\":{\"card\":{\"installments\":null,\"mandate_options\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"processing\":null,\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null},\"code\":200}', '2023-10-10 10:48:38', '2023-10-10 10:52:42'),
(11, 9, 1, 1, 'pi_3O5kNVCPuHcGXdFK0OXsIoPQ', 2465.00, 2465.00, 'done', '{\"headers\":{},\"body\":\"{\\n  \\\"id\\\": \\\"pi_3O5kNVCPuHcGXdFK0OXsIoPQ\\\",\\n  \\\"object\\\": \\\"payment_intent\\\",\\n  \\\"amount\\\": 246500,\\n  \\\"amount_capturable\\\": 0,\\n  \\\"amount_details\\\": {\\n    \\\"tip\\\": {}\\n  },\\n  \\\"amount_received\\\": 246500,\\n  \\\"application\\\": null,\\n  \\\"application_fee_amount\\\": null,\\n  \\\"automatic_payment_methods\\\": {\\n    \\\"allow_redirects\\\": \\\"always\\\",\\n    \\\"enabled\\\": true\\n  },\\n  \\\"canceled_at\\\": null,\\n  \\\"cancellation_reason\\\": null,\\n  \\\"capture_method\\\": \\\"automatic\\\",\\n  \\\"client_secret\\\": \\\"pi_3O5kNVCPuHcGXdFK0OXsIoPQ_secret_f6lgDlrammRqqsJILKPher7ET\\\",\\n  \\\"confirmation_method\\\": \\\"automatic\\\",\\n  \\\"created\\\": 1698391365,\\n  \\\"currency\\\": \\\"eur\\\",\\n  \\\"customer\\\": null,\\n  \\\"description\\\": null,\\n  \\\"invoice\\\": null,\\n  \\\"last_payment_error\\\": null,\\n  \\\"latest_charge\\\": \\\"ch_3O5kNVCPuHcGXdFK026IuHda\\\",\\n  \\\"livemode\\\": false,\\n  \\\"metadata\\\": {},\\n  \\\"next_action\\\": null,\\n  \\\"on_behalf_of\\\": null,\\n  \\\"payment_method\\\": \\\"pm_1O5kXLCPuHcGXdFK13ZcV6I7\\\",\\n  \\\"payment_method_configuration_details\\\": {\\n    \\\"id\\\": \\\"pmc_1LRcNhCPuHcGXdFKlIjueJUS\\\",\\n    \\\"parent\\\": null\\n  },\\n  \\\"payment_method_options\\\": {\\n    \\\"card\\\": {\\n      \\\"installments\\\": null,\\n      \\\"mandate_options\\\": null,\\n      \\\"network\\\": null,\\n      \\\"request_three_d_secure\\\": \\\"automatic\\\"\\n    }\\n  },\\n  \\\"payment_method_types\\\": [\\n    \\\"card\\\"\\n  ],\\n  \\\"processing\\\": null,\\n  \\\"receipt_email\\\": null,\\n  \\\"review\\\": null,\\n  \\\"setup_future_usage\\\": null,\\n  \\\"shipping\\\": null,\\n  \\\"source\\\": null,\\n  \\\"statement_descriptor\\\": null,\\n  \\\"statement_descriptor_suffix\\\": null,\\n  \\\"status\\\": \\\"succeeded\\\",\\n  \\\"transfer_data\\\": null,\\n  \\\"transfer_group\\\": null\\n}\",\"json\":{\"id\":\"pi_3O5kNVCPuHcGXdFK0OXsIoPQ\",\"object\":\"payment_intent\",\"amount\":246500,\"amount_capturable\":0,\"amount_details\":{\"tip\":[]},\"amount_received\":246500,\"application\":null,\"application_fee_amount\":null,\"automatic_payment_methods\":{\"allow_redirects\":\"always\",\"enabled\":true},\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"client_secret\":\"pi_3O5kNVCPuHcGXdFK0OXsIoPQ_secret_f6lgDlrammRqqsJILKPher7ET\",\"confirmation_method\":\"automatic\",\"created\":1698391365,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"latest_charge\":\"ch_3O5kNVCPuHcGXdFK026IuHda\",\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":\"pm_1O5kXLCPuHcGXdFK13ZcV6I7\",\"payment_method_configuration_details\":{\"id\":\"pmc_1LRcNhCPuHcGXdFKlIjueJUS\",\"parent\":null},\"payment_method_options\":{\"card\":{\"installments\":null,\"mandate_options\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"processing\":null,\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null},\"code\":200}', '2023-10-27 06:22:45', '2023-10-27 06:33:15'),
(17, 7, 1, 1, 'SIO1698390297', 200.00, 0.00, 'done', NULL, '2023-11-18 20:10:45', '2023-11-18 20:11:01'),
(18, 6, 0, 1, 'SIO1698364331', 200.00, 0.00, 'done', NULL, '2023-11-19 05:47:51', '2023-11-19 05:47:51');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_rates`
--

CREATE TABLE `shipping_rates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin_id` bigint UNSIGNED DEFAULT NULL,
  `destination_id` bigint UNSIGNED DEFAULT NULL,
  `weight_start` double(8,2) DEFAULT NULL,
  `weight_end` double(8,2) DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `length` double(8,2) DEFAULT NULL,
  `width` double(8,2) DEFAULT NULL,
  `height` double(8,2) DEFAULT NULL,
  `pickup_cost_per_km` double(8,2) DEFAULT '0.00',
  `delivery_cost_per_km` double(8,2) DEFAULT '0.00',
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_rates`
--

INSERT INTO `shipping_rates` (`id`, `name`, `origin_id`, `destination_id`, `weight_start`, `weight_end`, `price`, `length`, `width`, `height`, `pickup_cost_per_km`, `delivery_cost_per_km`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Lagos-Jos', 2, 1, 0.00, 10.00, 100.00, 10.00, 10.00, 5.00, 2.00, 3.00, 'No returns', '2023-10-06 17:06:33', '2023-10-09 09:21:32'),
(2, 'Minna-Lagos', 3, 2, 0.00, 10.00, 30.00, 10.00, 10.00, 19.00, 2.00, 4.00, 'No retuns', '2023-10-09 09:35:31', '2023-10-09 09:35:31'),
(3, 'Lag-Terme', 2, 4, 1.00, 100.00, 100.00, 100.00, 100.00, 100.00, 0.20, 0.10, '', '2024-02-08 12:37:00', '2024-02-08 12:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `supported_banks`
--

CREATE TABLE `supported_banks` (
  `id` bigint UNSIGNED NOT NULL,
  `bank_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `transaction_type` enum('transfer') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'transfer',
  `beneficiary_id` bigint UNSIGNED NOT NULL,
  `beneficiary_account_id` bigint UNSIGNED NOT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_amount` double NOT NULL,
  `beneficiary_account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `beneficiary_account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `beneficiary_bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `beneficiary_bank_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_status` enum('success','pending','failed','refunded') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'success',
  `transaction_reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_intent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_intent_data` text COLLATE utf8mb4_unicode_ci,
  `webhook_data` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_intent`
--

CREATE TABLE `transfer_intent` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `intent_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_intent_data` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `user_type` enum('user','courier','dispatcher','admin','mobile') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country` bigint UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc_level` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `user_type`, `blocked`, `remember_token`, `created_at`, `updated_at`, `country`, `phone`, `kyc_level`) VALUES
(1, 'Walshak Timothy Apollos', 'admin@siopay.eu', NULL, '$2y$10$Hrrz.cOVHDzxffWsZQdgHO6mB7ibWyAtM4Aa/i6eeVf/S.zk8y.22', 1, 'admin', 0, NULL, '2023-10-02 05:14:50', '2023-10-10 08:45:58', 0, NULL, 1),
(2, 'Walshak Timothy Apollos', 'agent@siopay.eu', NULL, '$2y$10$9XdDeRDsPHVfiLznXJ9HUO1GlEmuEPg9yjxXJog3H5w4p.B6W5FTm', 1, 'mobile', 0, NULL, '2023-10-10 11:33:50', '2023-10-10 13:31:12', 0, NULL, 1),
(3, 'Walshak Timothy Apollos', 'kycadmin@siopay.eu', NULL, '$2y$10$VyB44UUydJUsIXr8P4QJuejUXJzxu3B2Y463owkkUbhNQ0fZfhR4a', 1, 'admin', 0, NULL, '2023-11-19 16:55:31', '2023-11-19 16:55:31', 0, NULL, 1),
(4, 'Walshak Timothy Apollos', 'accountsadmin@siopay.eu', NULL, '$2y$10$LLNhRSBOhJJ1h4iOZFe3AOSOmSLnD2nGuFUHQF7so6bvZ0Pej65oS', 1, 'admin', 0, NULL, '2023-11-19 17:03:21', '2023-11-19 17:03:21', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_funds`
--

CREATE TABLE `user_funds` (
  `id` bigint UNSIGNED NOT NULL,
  `transId` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'EUR',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` enum('debit','credit') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'debit',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_funds`
--

INSERT INTO `user_funds` (`id`, `transId`, `user_id`, `amount`, `currency`, `description`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'pi_3ODUkpCPuHcGXdFK0JAY3yhu', 1, 300000, 'EUR', 'Wallet Funding', 'debit', '2023-11-17 16:10:27', '2023-11-17 16:10:27'),
(2, 'pi_3ODVmuCPuHcGXdFK0OqQI094', 1, 1000, 'EUR', 'Wallet Funding', 'debit', '2023-11-17 16:25:30', '2023-11-17 16:25:30'),
(3, 'SIO1700339248', 1, 0, 'EUR', 'Order SIO1700339248', 'credit', '2023-11-18 19:56:02', '2023-11-18 19:56:02'),
(4, 'SIO1700339248', 1, 1.5, 'EUR', 'Order CommisionSIO1700339248', 'debit', '2023-11-18 19:56:02', '2023-11-18 19:56:02'),
(5, 'SIO1698504884', 1, 0, 'EUR', 'Order SIO1698504884', 'credit', '2023-11-18 20:00:06', '2023-11-18 20:00:06'),
(6, 'SIO1698504884', 1, 1.5, 'EUR', 'Order CommisionSIO1698504884', 'debit', '2023-11-18 20:00:06', '2023-11-18 20:00:06'),
(7, 'SIO1698390815', 1, 0, 'EUR', 'Order SIO1698390815', 'credit', '2023-11-18 20:03:55', '2023-11-18 20:03:55'),
(8, 'SIO1698390815', 1, 1.5, 'EUR', 'Order CommisionSIO1698390815', 'debit', '2023-11-18 20:03:55', '2023-11-18 20:03:55'),
(9, 'SIO1698390815', 1, 0, 'EUR', 'Order SIO1698390815', 'credit', '2023-11-18 20:06:56', '2023-11-18 20:06:56'),
(10, 'SIO1698390815', 1, 1.5, 'EUR', 'Order CommisionSIO1698390815', 'debit', '2023-11-18 20:06:56', '2023-11-18 20:06:56'),
(11, 'SIO1698390297', 1, 100, 'EUR', 'Order SIO1698390297', 'credit', '2023-11-18 20:09:03', '2023-11-18 20:09:03'),
(12, 'SIO1698390297', 1, 3, 'EUR', 'Order CommisionSIO1698390297', 'debit', '2023-11-18 20:09:03', '2023-11-18 20:09:03'),
(13, 'SIO1698390297', 1, 100, 'EUR', 'Order SIO1698390297', 'credit', '2023-11-18 20:10:45', '2023-11-18 20:10:45'),
(14, 'SIO1698390297', 1, 3, 'EUR', 'Order CommisionSIO1698390297', 'debit', '2023-11-18 20:10:45', '2023-11-18 20:10:45'),
(15, 'SIO1698364331', 1, 100, 'EUR', 'Order SIO1698364331', 'credit', '2023-11-19 05:47:51', '2023-11-19 05:47:51'),
(16, 'SIO1698364331', 1, 3, 'EUR', 'Order CommisionSIO1698364331', 'debit', '2023-11-19 05:47:51', '2023-11-19 05:47:51'),
(17, 'SIO-EUR34125856', 1, 55, 'EUR', 'EU Fund Order Order SIO-EUR34125856', 'credit', '2023-11-19 07:37:15', '2023-11-19 07:37:15'),
(18, 'SIO-EUR34125856', 1, 1.1, 'EUR', 'EU Fund Order Commision SIO-EUR34125856', 'debit', '2023-11-19 07:37:15', '2023-11-19 07:37:15'),
(19, 'SIO-EUR34125856', 1, 55, 'EUR', 'EU Fund Order Order SIO-EUR34125856', 'credit', '2023-11-19 07:38:39', '2023-11-19 07:38:39'),
(20, 'SIO-EUR34125856', 1, 1.1, 'EUR', 'EU Fund Order Commision SIO-EUR34125856', 'debit', '2023-11-19 07:38:39', '2023-11-19 07:38:39'),
(21, 'SIO-EUR34125856', 1, 55, 'EUR', 'EU Fund Order Order SIO-EUR34125856', 'credit', '2023-11-19 07:39:29', '2023-11-19 07:39:29'),
(22, 'SIO-EUR34125856', 1, 1.1, 'EUR', 'EU Fund Order Commision SIO-EUR34125856', 'debit', '2023-11-19 07:39:29', '2023-11-19 07:39:29'),
(23, 'SIO-EUR34125856', 1, 55, 'EUR', 'EU Fund Order Order SIO-EUR34125856', 'credit', '2023-11-19 07:40:13', '2023-11-19 07:40:13'),
(24, 'SIO-EUR34125856', 1, 1.1, 'EUR', 'EU Fund Order Commision SIO-EUR34125856', 'debit', '2023-11-19 07:40:13', '2023-11-19 07:40:13'),
(25, 'SIO-INTL80180491', 1, 200, 'EUR', 'EU Fund Order Order SIO-INTL80180491', 'credit', '2023-11-19 07:42:41', '2023-11-19 07:42:41'),
(26, 'SIO-INTL80180491', 1, 4, 'EUR', 'EU Fund Order Commision SIO-INTL80180491', 'debit', '2023-11-19 07:42:41', '2023-11-19 07:42:41'),
(27, 'SIO-INTL80180491', 1, 200, 'EUR', 'EU Fund Order Order SIO-INTL80180491', 'credit', '2023-11-19 07:43:07', '2023-11-19 07:43:07'),
(28, 'SIO-INTL80180491', 1, 4, 'EUR', 'EU Fund Order Commision SIO-INTL80180491', 'debit', '2023-11-19 07:43:07', '2023-11-19 07:43:07'),
(29, 'SIO-INTL80180491', 1, 200, 'EUR', 'EU Fund Order Order SIO-INTL80180491', 'credit', '2023-11-19 07:43:10', '2023-11-19 07:43:10'),
(30, 'SIO-INTL80180491', 1, 4, 'EUR', 'EU Fund Order Commision SIO-INTL80180491', 'debit', '2023-11-19 07:43:10', '2023-11-19 07:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `courier_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive','decommisioned') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `walk_in_customers`
--

CREATE TABLE `walk_in_customers` (
  `id` bigint UNSIGNED NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthDate` date DEFAULT NULL,
  `birthPlace` date DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `belfioreCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_num` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_front` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_back` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc_status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `walk_in_customers`
--

INSERT INTO `walk_in_customers` (`id`, `surname`, `name`, `birthDate`, `birthPlace`, `gender`, `belfioreCode`, `doc_type`, `doc_num`, `doc_front`, `doc_back`, `tax_code`, `kyc_status`, `created_at`, `updated_at`, `email`, `phone`, `address`) VALUES
(1, 'Apollos', 'Walshak', '1985-12-10', NULL, 'M', NULL, 'tax_id', '123', NULL, NULL, NULL, 'rejected', '2023-10-26 22:52:11', '2023-10-28 05:47:03', NULL, NULL, NULL),
(2, 'Apollos', 'Walshak', '1985-12-10', NULL, 'M', NULL, 'EU Driving License / Patente Di Guida', '12344', 'doc_front_1698504884.png', 'doc_back_1698504884.png', 'RSSMRA85T10A562S', 'rejected', '2023-10-27 06:04:57', '2023-10-28 14:36:49', 'walshak1999@gmail.com', '07050737402', 'Elwazir Street,bosso\r\nVcm 105 Elwazir Estate'),
(4, 'Apollos', 'Walshak', '2023-11-01', NULL, 'm', NULL, 'ID Card / Carta Di Identità', '876666', NULL, NULL, 'nhhhh', 'pending', '2023-11-18 19:27:28', '2023-11-18 19:27:28', NULL, NULL, NULL),
(5, 'Apollos', 'Walshak', '2023-11-19', NULL, 'm', NULL, 'Others / Altro', '7373', NULL, NULL, 'yyeeye', 'approved', '2023-11-19 07:37:08', '2023-11-27 06:30:12', 'walshak1999@gmail.com', '07050737402', 'Elwazir Street,bosso\r\nVcm 105 Elwazir Estate');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_user_id_foreign` (`user_id`);

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiaries_user_id_foreign` (`user_id`);

--
-- Indexes for table `beneficiary_accounts`
--
ALTER TABLE `beneficiary_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_accounts_user_id_foreign` (`user_id`),
  ADD KEY `beneficiary_accounts_beneficiary_id_foreign` (`beneficiary_id`);

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `couriers_user_id_foreign` (`user_id`),
  ADD KEY `couriers_current_location_foreign` (`current_location`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `dispatchers`
--
ALTER TABLE `dispatchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dispatchers_user_id_foreign` (`user_id`),
  ADD KEY `dispatchers_location_id_foreign` (`location_id`);

--
-- Indexes for table `e_u_funds_transfer_rates`
--
ALTER TABLE `e_u_funds_transfer_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `e_u_fund_transfer_orders`
--
ALTER TABLE `e_u_fund_transfer_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `e_u_fund_transfer_orders_walk_in_customer_id_foreign` (`walk_in_customer_id`),
  ADD KEY `e_u_fund_transfer_orders_customer_id_foreign` (`customer_id`),
  ADD KEY `e_u_fund_transfer_orders_dispatcher_id_foreign` (`dispatcher_id`),
  ADD KEY `e_u_fund_transfer_orders_e_u_funds_transfer_rate_id_foreign` (`e_u_funds_transfer_rate_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `intl_funds_transfer_rates`
--
ALTER TABLE `intl_funds_transfer_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intl_fund_transfer_orders`
--
ALTER TABLE `intl_fund_transfer_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intl_fund_transfer_orders_walk_in_customer_id_foreign` (`walk_in_customer_id`),
  ADD KEY `intl_fund_transfer_orders_customer_id_foreign` (`customer_id`),
  ADD KEY `intl_fund_transfer_orders_dispatcher_id_foreign` (`dispatcher_id`),
  ADD KEY `intl_fund_transfer_orders_e_u_funds_transfer_rate_id_foreign` (`e_u_funds_transfer_rate_id`);

--
-- Indexes for table `kyc`
--
ALTER TABLE `kyc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kyc_user_id_foreign` (`user_id`),
  ADD KEY `kyc_document_type_id_foreign` (`document_type_id`),
  ADD KEY `kyc_proof_of_address_type_id_foreign` (`proof_of_address_type_id`);

--
-- Indexes for table `kyc_address_proof_types`
--
ALTER TABLE `kyc_address_proof_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_document_type`
--
ALTER TABLE `kyc_document_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `operation_countries`
--
ALTER TABLE `operation_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_tracking_id_unique` (`tracking_id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_delivery_customer_id_foreign` (`delivery_customer_id`),
  ADD KEY `orders_courier_id_foreign` (`courier_id`),
  ADD KEY `orders_dispatcher_id_foreign` (`dispatcher_id`),
  ADD KEY `orders_shipping_rate_id_foreign` (`shipping_rate_id`),
  ADD KEY `orders_pickup_location_id_foreign` (`pickup_location_id`),
  ADD KEY `orders_delivery_location_id_foreign` (`delivery_location_id`),
  ADD KEY `orders_current_location_id_foreign` (`current_location_id`),
  ADD KEY `orders_batch_id_foreign` (`batch_id`),
  ADD KEY `orders_walk_in_customer_id_foreign` (`walk_in_customer_id`);

--
-- Indexes for table `order_batches`
--
ALTER TABLE `order_batches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_batches_dispatcher_id_foreign` (`dispatcher_id`),
  ADD KEY `order_batches_location_id_foreign` (`location_id`);

--
-- Indexes for table `order_packages`
--
ALTER TABLE `order_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_packages_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`),
  ADD KEY `payments_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `shipping_rates`
--
ALTER TABLE `shipping_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_rates_origin_id_foreign` (`origin_id`),
  ADD KEY `shipping_rates_destination_id_foreign` (`destination_id`);

--
-- Indexes for table `supported_banks`
--
ALTER TABLE `supported_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_beneficiary_id_foreign` (`beneficiary_id`),
  ADD KEY `transactions_beneficiary_account_id_foreign` (`beneficiary_account_id`);

--
-- Indexes for table `transfer_intent`
--
ALTER TABLE `transfer_intent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfer_intent_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_funds`
--
ALTER TABLE `user_funds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_funds_user_id_foreign` (`user_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_courier_id_foreign` (`courier_id`);

--
-- Indexes for table `walk_in_customers`
--
ALTER TABLE `walk_in_customers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beneficiary_accounts`
--
ALTER TABLE `beneficiary_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dispatchers`
--
ALTER TABLE `dispatchers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `e_u_funds_transfer_rates`
--
ALTER TABLE `e_u_funds_transfer_rates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `e_u_fund_transfer_orders`
--
ALTER TABLE `e_u_fund_transfer_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intl_funds_transfer_rates`
--
ALTER TABLE `intl_funds_transfer_rates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `intl_fund_transfer_orders`
--
ALTER TABLE `intl_fund_transfer_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kyc`
--
ALTER TABLE `kyc`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kyc_address_proof_types`
--
ALTER TABLE `kyc_address_proof_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kyc_document_type`
--
ALTER TABLE `kyc_document_type`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operation_countries`
--
ALTER TABLE `operation_countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_batches`
--
ALTER TABLE `order_batches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_packages`
--
ALTER TABLE `order_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_rates`
--
ALTER TABLE `shipping_rates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supported_banks`
--
ALTER TABLE `supported_banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer_intent`
--
ALTER TABLE `transfer_intent`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_funds`
--
ALTER TABLE `user_funds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `walk_in_customers`
--
ALTER TABLE `walk_in_customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD CONSTRAINT `beneficiaries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `beneficiary_accounts`
--
ALTER TABLE `beneficiary_accounts`
  ADD CONSTRAINT `beneficiary_accounts_beneficiary_id_foreign` FOREIGN KEY (`beneficiary_id`) REFERENCES `beneficiaries` (`id`),
  ADD CONSTRAINT `beneficiary_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `couriers`
--
ALTER TABLE `couriers`
  ADD CONSTRAINT `couriers_current_location_foreign` FOREIGN KEY (`current_location`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `couriers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `dispatchers`
--
ALTER TABLE `dispatchers`
  ADD CONSTRAINT `dispatchers_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `dispatchers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `e_u_fund_transfer_orders`
--
ALTER TABLE `e_u_fund_transfer_orders`
  ADD CONSTRAINT `e_u_fund_transfer_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `e_u_fund_transfer_orders_dispatcher_id_foreign` FOREIGN KEY (`dispatcher_id`) REFERENCES `dispatchers` (`id`),
  ADD CONSTRAINT `e_u_fund_transfer_orders_e_u_funds_transfer_rate_id_foreign` FOREIGN KEY (`e_u_funds_transfer_rate_id`) REFERENCES `e_u_funds_transfer_rates` (`id`),
  ADD CONSTRAINT `e_u_fund_transfer_orders_walk_in_customer_id_foreign` FOREIGN KEY (`walk_in_customer_id`) REFERENCES `walk_in_customers` (`id`);

--
-- Constraints for table `intl_fund_transfer_orders`
--
ALTER TABLE `intl_fund_transfer_orders`
  ADD CONSTRAINT `intl_fund_transfer_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `intl_fund_transfer_orders_dispatcher_id_foreign` FOREIGN KEY (`dispatcher_id`) REFERENCES `dispatchers` (`id`),
  ADD CONSTRAINT `intl_fund_transfer_orders_e_u_funds_transfer_rate_id_foreign` FOREIGN KEY (`e_u_funds_transfer_rate_id`) REFERENCES `e_u_funds_transfer_rates` (`id`),
  ADD CONSTRAINT `intl_fund_transfer_orders_walk_in_customer_id_foreign` FOREIGN KEY (`walk_in_customer_id`) REFERENCES `walk_in_customers` (`id`);

--
-- Constraints for table `kyc`
--
ALTER TABLE `kyc`
  ADD CONSTRAINT `kyc_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `kyc_document_type` (`id`),
  ADD CONSTRAINT `kyc_proof_of_address_type_id_foreign` FOREIGN KEY (`proof_of_address_type_id`) REFERENCES `kyc_address_proof_types` (`id`),
  ADD CONSTRAINT `kyc_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `order_batches` (`id`),
  ADD CONSTRAINT `orders_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`),
  ADD CONSTRAINT `orders_current_location_id_foreign` FOREIGN KEY (`current_location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_delivery_customer_id_foreign` FOREIGN KEY (`delivery_customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_delivery_location_id_foreign` FOREIGN KEY (`delivery_location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `orders_dispatcher_id_foreign` FOREIGN KEY (`dispatcher_id`) REFERENCES `dispatchers` (`id`),
  ADD CONSTRAINT `orders_pickup_location_id_foreign` FOREIGN KEY (`pickup_location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `orders_shipping_rate_id_foreign` FOREIGN KEY (`shipping_rate_id`) REFERENCES `shipping_rates` (`id`),
  ADD CONSTRAINT `orders_walk_in_customer_id_foreign` FOREIGN KEY (`walk_in_customer_id`) REFERENCES `walk_in_customers` (`id`);

--
-- Constraints for table `order_batches`
--
ALTER TABLE `order_batches`
  ADD CONSTRAINT `order_batches_dispatcher_id_foreign` FOREIGN KEY (`dispatcher_id`) REFERENCES `dispatchers` (`id`),
  ADD CONSTRAINT `order_batches_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Constraints for table `order_packages`
--
ALTER TABLE `order_packages`
  ADD CONSTRAINT `order_packages_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `shipping_rates`
--
ALTER TABLE `shipping_rates`
  ADD CONSTRAINT `shipping_rates_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `shipping_rates_origin_id_foreign` FOREIGN KEY (`origin_id`) REFERENCES `locations` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_beneficiary_account_id_foreign` FOREIGN KEY (`beneficiary_account_id`) REFERENCES `beneficiary_accounts` (`id`),
  ADD CONSTRAINT `transactions_beneficiary_id_foreign` FOREIGN KEY (`beneficiary_id`) REFERENCES `beneficiaries` (`id`),
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transfer_intent`
--
ALTER TABLE `transfer_intent`
  ADD CONSTRAINT `transfer_intent_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_funds`
--
ALTER TABLE `user_funds`
  ADD CONSTRAINT `user_funds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
