-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2025 at 06:24 PM
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
-- Database: `association2`
--

-- --------------------------------------------------------

--
-- Table structure for table `anonyme_beneficiaries`
--

CREATE TABLE `anonyme_beneficiaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `phone1` varchar(255) NOT NULL,
  `phone2` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `national_id_issued_at` date DEFAULT NULL,
  `national_id_about` varchar(255) DEFAULT NULL,
  `family_members` int(11) NOT NULL DEFAULT 0,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anonyme_beneficiaries`
--

INSERT INTO `anonyme_beneficiaries` (`id`, `full_name`, `national_id`, `phone1`, `phone2`, `address`, `municipality`, `district`, `state`, `birth_date`, `national_id_issued_at`, `national_id_about`, `family_members`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Khlafaoui Elhareth yfy', '232323', '0795909128', '0795909128', 'BT 4 N 3', 'd', 'd', 'd', '2025-04-05', '2025-04-05', 'd', 0, NULL, '2025-04-05 11:29:01', '2025-04-05 11:29:01'),
(3, 'Khlafaoui Elhareth yfy', '2323233', '0795909128', '0661558942', 'BT 4 N 3', 'd', 'd', 'd', '2025-04-06', '2025-04-06', 'd', 0, NULL, '2025-04-06 20:21:25', '2025-04-06 20:21:25'),
(4, 'عماد الدين قعار', '0830', '0656658777', '0792720200', 'حي الكوثر', 'الوادي', 'الكوثر', 'الوادي', '1998-02-21', '2024-01-21', 'دائرة الوادي', 0, NULL, '2025-04-21 01:00:58', '2025-04-21 01:00:58'),
(5, 'test', '2342434234234', '0696365732', '0696365732', 'test', 'test', 'test', 'test', '2025-04-04', '2025-04-18', 'test', 0, NULL, '2025-04-22 11:50:00', '2025-04-22 11:50:00'),
(6, 'عماد الدين قعار', '09347584', '0656658777', '0792720002', 'الاعشاش', 'الدبيلة', 'حاسي خليفة', 'الوادي', '1998-07-05', '2020-02-26', 'دائرة الوادي', 0, NULL, '2025-05-24 22:46:46', '2025-05-24 22:46:46');

-- --------------------------------------------------------

--
-- Table structure for table `associations`
--

CREATE TABLE `associations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `associations`
--

INSERT INTO `associations` (`id`, `name`, `address`, `phone`, `description`, `created_at`, `updated_at`) VALUES
(1, 'hh', NULL, NULL, NULL, '2024-12-29 10:31:13', '2024-12-29 10:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `municipality_id` bigint(20) UNSIGNED DEFAULT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `phone1` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT 'الوادي',
  `file` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `national_id_issued_at` date DEFAULT NULL,
  `national_id_about` varchar(255) DEFAULT NULL,
  `family_members` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('pending','accepted') DEFAULT 'pending',
  `marital_status` enum('Single','Married','Divorced','Widowed') DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `insured` tinyint(1) DEFAULT NULL,
  `health_status` varchar(255) DEFAULT NULL,
  `income_details` text DEFAULT NULL,
  `neighborhood` varchar(255) DEFAULT NULL,
  `nearest_landmark` varchar(255) DEFAULT NULL,
  `schooling_children_count` int(11) DEFAULT 0,
  `housing_status` varchar(50) DEFAULT NULL,
  `husband_name` varchar(255) DEFAULT NULL,
  `husband_surname` varchar(255) DEFAULT NULL,
  `husband_dob_pob` varchar(255) DEFAULT NULL,
  `husband_profession` varchar(255) DEFAULT NULL,
  `husband_education_level` varchar(255) DEFAULT NULL,
  `husband_skills` text DEFAULT NULL,
  `husband_insured` tinyint(1) DEFAULT 0,
  `husband_health_status` varchar(255) DEFAULT NULL,
  `husband_income` varchar(100) DEFAULT NULL,
  `wife_name` varchar(255) DEFAULT NULL,
  `wife_surname` varchar(255) DEFAULT NULL,
  `wife_dob_pob` varchar(255) DEFAULT NULL,
  `wife_profession` varchar(255) DEFAULT NULL,
  `wife_education_level` varchar(255) DEFAULT NULL,
  `wife_skills` text DEFAULT NULL,
  `wife_insured` tinyint(1) DEFAULT 0,
  `wife_health_status` varchar(255) DEFAULT NULL,
  `wife_income` varchar(100) DEFAULT NULL,
  `need_request` text DEFAULT NULL,
  `registrar_name` varchar(255) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`id`, `district_id`, `municipality_id`, `national_id`, `full_name`, `code`, `phone1`, `phone2`, `address`, `state`, `file`, `birth_date`, `place_of_birth`, `national_id_issued_at`, `national_id_about`, `family_members`, `notes`, `status`, `marital_status`, `profession`, `insured`, `health_status`, `income_details`, `neighborhood`, `nearest_landmark`, `schooling_children_count`, `housing_status`, `husband_name`, `husband_surname`, `husband_dob_pob`, `husband_profession`, `husband_education_level`, `husband_skills`, `husband_insured`, `husband_health_status`, `husband_income`, `wife_name`, `wife_surname`, `wife_dob_pob`, `wife_profession`, `wife_education_level`, `wife_skills`, `wife_insured`, `wife_health_status`, `wife_income`, `need_request`, `registrar_name`, `registration_date`, `created_at`, `updated_at`) VALUES
(1, NULL, 6, '4444444', 'sssss\r\n', '454545454545', '0795909128', NULL, 'Eloued', 'الوادي', NULL, '2025-04-05', NULL, '2025-04-05', 'الوادي', '333', 's', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2025-01-06 14:42:13', '2025-05-24 22:10:57'),
(2, NULL, 6, '232323', 'Khlafaoui Elhareth yfy', NULL, '0795909128', '0795909128', 'BT 4 N 3', 'd', NULL, '2025-04-05', NULL, '2025-04-05', 'd', NULL, NULL, 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2025-04-05 11:29:01', '2025-05-23 00:17:56'),
(3, NULL, 6, '2323233', 'Khlafaoui Elhareth yfy', '000001', '0795909128', '0795909128', 'BT 4 N 3', 'd', NULL, '2025-04-05', NULL, '2025-04-05', 'd', NULL, NULL, 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2025-04-05 11:31:06', '2025-05-31 11:39:12'),
(5, 3, 7, '2323233444', 'Khlafaoui Elhareth', '000002', '0795909128', '44', 'Eloued', 'الوادي', NULL, '2025-06-01', NULL, '2025-06-01', 'd', '1-2', '4', 'pending', 'Married', NULL, NULL, NULL, NULL, '54', 'd', 5, 'rented', '3', '3', '3', '3', NULL, NULL, 1, '3', NULL, '3', '3', '3', '3', NULL, NULL, 1, '3', NULL, '4', '3', '2025-06-01', '2025-06-01 16:51:50', '2025-06-01 16:51:50'),
(6, 3, 7, '23423233444', 'Khlafaoui Elhareth', '000003', '0795909128', '44', 'Eloued', 'الوادي', NULL, '2025-06-01', NULL, '2025-06-01', 'd', '1-2', '4', 'pending', 'Married', NULL, NULL, NULL, NULL, '54', 'd', 5, 'rented', '3', '3', '3', '3', NULL, NULL, 1, '3', NULL, '3', '3', '3', '3', NULL, NULL, 1, '3', NULL, '4', '3', '2025-06-01', '2025-06-01 16:57:26', '2025-06-01 16:57:26'),
(7, 6, 14, '23424443233444', 'Khlafaoui Elhareth', '000004', '0795909128', '0661558942', 'Eloued', 'الوادي', NULL, '2025-06-01', NULL, '2025-06-01', 'd', '1-2', 'sd', 'pending', 'Married', NULL, NULL, NULL, NULL, '54', 'd', 5, 'rented', '3', '3', '3', '3', NULL, NULL, 1, '3', NULL, '3', '3', '3', '3', NULL, NULL, 0, '3', NULL, 'sd', '3', '2025-06-01', '2025-06-01 17:06:02', '2025-06-01 17:06:02'),
(8, 1, 6, '1988010112345', 'علي بن محمد الصالح', 'BNF00789', '0501122334', '0554433221', 'حي الروضة، شارع الأمير سلطان، منزل رقم 15', 'الوادي', NULL, '1988-01-01', NULL, '2015-06-10', 'إدارة أحوال الوادي', '6', 'الأسرة بحاجة إلى دعم غذائي ودفع فواتير الكهرباء.', 'accepted', 'Married', NULL, NULL, NULL, NULL, 'حي الزهور الشرقي', 'مسجد النور القريب من السوق', 2, 'rented', 'سالم', 'عبدالله', '1985-03-10، مدينة الوادي', 'عامل يومي', NULL, NULL, 0, 'يعاني من آلام في الظهر', NULL, 'نورة', 'إبراهيم', '1990-07-20، قرية الأمل', 'ربة منزل', NULL, NULL, 0, 'بصحة جيدة والحمد لله', NULL, 'نرجو المساعدة في توفير حليب الأطفال وملابس شتوية.', 'محمد الأمين', '2024-03-10', '2025-06-01 18:21:49', '2025-06-03 08:55:19'),
(9, NULL, 6, NULL, 'Khlafaoui Elhareth', '000005', '0795909128', '0795909128', 'Eloued', 'الوادي', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-04', '2025-06-04 06:24:55', '2025-06-04 06:24:55'),
(10, NULL, 6, NULL, 'Khlafaoui Elhareth', '000006', '0795909128', NULL, 'Eloued', 'الوادي', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-04', '2025-06-04 06:36:38', '2025-06-04 06:56:12'),
(11, 4, 9, '23232345555545', 'elhareth csdcs', 'WXC76T', '0795909128', '0661558942', 'BT 4 N 3', 'الوادي', '1749032038_78514304-f3ba-49b2-83ef-dc83eb89472c.pdf', '2025-06-21', 'c', '2025-06-04', 'd', '4', '5', 'pending', 'Single', 'hh', 1, 'gh', '45', '54', 'd', 4, 'rented', '3', '3', '3', '3', '5', '5', 1, '3', '5', '3', '3', '3', '3', '5', '5', 1, '3', '5', '5', '5', '2025-06-04', '2025-06-04 09:13:58', '2025-06-04 09:13:58'),
(12, 3, 8, '23232345555545', 'elhareth csdcs', '000007', '0795909128', 'c', 'BT 4 N 3', 'الوادي', NULL, '2025-06-21', 'c', '2025-06-04', 'd', '4', 'c', 'pending', 'Married', 'hh', NULL, 'gh', '45', '54', 'd', 4, 'own', '3', '3', '3', '3', '5', '5', NULL, '3', '5', '3', '3', '3', '3', '5', '5', NULL, '3', '5', 'c', '5', '2025-06-04', '2025-06-04 10:31:48', '2025-06-04 10:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `benifices`
--

CREATE TABLE `benifices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `beneficiary_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `price` double DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `benifices`
--

INSERT INTO `benifices` (`id`, `beneficiary_id`, `date`, `price`, `description`, `type`, `items`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, '2025-06-01', NULL, 'sdsdsd', 'ayni', '\"[{\\\"item\\\":\\\"sdsd\\\",\\\"quantity\\\":\\\"40\\\"},{\\\"item\\\":\\\"sdsd\\\",\\\"quantity\\\":\\\"10\\\"}]\"', '2025-05-31 23:17:00', '2025-05-31 23:17:00', NULL),
(2, 3, '2025-06-08', NULL, NULL, 'ayni', '\"[{\\\"item\\\":\\\"test\\\",\\\"quantity\\\":\\\"20\\\",\\\"price\\\":\\\"1000\\\"}]\"', '2025-06-08 14:08:48', '2025-06-08 14:08:48', NULL),
(3, 3, '2025-06-08', NULL, NULL, 'ayni', '\"[{\\\"item\\\":\\\"Khlafaoui Elhareth\\\",\\\"quantity\\\":\\\"200\\\",\\\"price\\\":\\\"3000\\\",\\\"code\\\":\\\"000085\\\"}]\"', '2025-06-08 14:12:37', '2025-06-08 14:12:37', NULL),
(4, 3, '2025-06-08', 2000, 'test', 'madi', NULL, '2025-06-08 14:35:47', '2025-06-08 14:35:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `association_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` enum('planned','active','completed','cancelled') NOT NULL DEFAULT 'planned',
  `price` decimal(15,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `place` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `association_id`, `name`, `description`, `start_date`, `end_date`, `type`, `status`, `price`, `notes`, `place`, `created_at`, `updated_at`) VALUES
(9, 1, 'طعام', 'تهدف هذه الحملة إلى توفير البطانيات والملابس الشتوية والمواد الغذائية الأساسية للأسر المحتاجة خلال فصل الشتاء القارس. نؤمن بأن كل مساهمة، مهما كانت صغيرة، تحدث فرقًا كبيرًا في حياة من نخدمهم. نسعى جاهدين لضمان وصول المساعدات إلى مستحقيها بشفافية وكفاءة.', '2025-05-31', '2025-06-07', 'food', 'active', 1000.00, 'يتم توزيع المساعدات بالتعاون مع الجمعيات المحلية المعتمدة.', NULL, '2025-05-31 09:46:22', '2025-05-31 09:46:21'),
(10, 1, 'elhareth csdcs', '23', '2025-06-02', '2025-06-19', 'Solidarity', 'planned', 100.00, NULL, '23', '2025-06-02 10:14:45', '2025-06-02 11:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `campaign_items`
--

CREATE TABLE `campaign_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` double(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaign_items`
--

INSERT INTO `campaign_items` (`id`, `campaign_id`, `item_id`, `quantity`, `created_at`, `updated_at`) VALUES
(16, 9, 21, 10.00, '2025-05-31 08:59:00', '2025-05-31 08:59:00'),
(17, 10, 21, 23.00, '2025-06-02 10:14:45', '2025-06-02 10:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `beneficiary_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `school_year` varchar(255) DEFAULT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `health_status` varchar(255) DEFAULT NULL,
  `maturity_status` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `beneficiary_id`, `name`, `dob`, `gender`, `school_year`, `school_name`, `health_status`, `maturity_status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 11, '55', '2025-06-04', 'male', '5', '5', '5', 'not_maturity', '5', '2025-06-04 09:13:58', '2025-06-04 10:33:36'),
(2, 12, 'c', '2025-06-11', 'male', 'c', 'c', 'c', 'not-maturity', 'c', '2025-06-04 10:31:48', '2025-06-04 10:31:48'),
(3, 12, 'c', '2025-07-10', 'male', 'c', 'c', 'c', 'maturity', 'c', '2025-06-04 10:31:48', '2025-06-04 10:31:48'),
(4, 11, 'd', '2025-06-04', 'male', 'd', 'd', 'd', 'maturity', 'd', '2025-06-04 10:33:36', '2025-06-04 10:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `inventory_number` varchar(255) DEFAULT NULL,
  `destruction_report` varchar(255) DEFAULT NULL,
  `usage_count` int(11) NOT NULL DEFAULT 0,
  `reason` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `name`, `barcode`, `inventory_number`, `destruction_report`, `usage_count`, `reason`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'جهاز تنفس', '0976565', 'ج م د و 1235', NULL, 5, 'dfdf', '2025-05-13 23:00:00', '2025-04-22 11:45:47', '2025-05-24 22:39:33', '2025-05-24 22:39:33'),
(10, 'جهاز تنفس', '0001', 'ج د خ و_1', NULL, 1, NULL, NULL, '2025-05-24 22:40:47', '2025-05-24 22:46:46', NULL),
(11, 'جهاز تنفس', '0002', 'ج د خ و_2', NULL, 0, NULL, NULL, '2025-05-24 22:41:37', '2025-05-24 22:41:37', NULL),
(12, 'كرسي متحرك', '0003', 'ج د خ و_ك 01', NULL, 0, NULL, NULL, '2025-05-24 22:42:27', '2025-05-24 22:42:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'الوادي', 'El Oued', NULL, NULL),
(2, 'قمار', 'Guemar', NULL, NULL),
(3, 'الدبيلة', 'Debila', NULL, NULL),
(4, 'الرقيبة', 'Reguiba', NULL, NULL),
(5, 'الطالب العربي', 'Taleb Larbi', NULL, NULL),
(6, 'حاسي خليفة', 'Hassi Khalifa', NULL, NULL),
(7, 'اميه وانسة', 'Mih Ouensa', NULL, NULL),
(8, 'الرباح', 'Robbah', NULL, NULL),
(9, 'المقرن', 'Magrane', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `order_id`, `file`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20, 19, '1748899699_Screenshot_2-6-2025_19442_localhost.jpeg', '2025-06-02 21:28:19', '2025-06-02 21:28:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financial_transactions`
--

CREATE TABLE `financial_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `association_id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED DEFAULT NULL,
  `beneficiary_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mohcen` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `type` enum('income','expense') NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `date` date NOT NULL,
  `description` text DEFAULT NULL,
  `payment_method` enum('cash','bank_transfer','ccp') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `type_export` enum('financial_deduction','expenses_order','other_export') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `financial_transactions`
--

INSERT INTO `financial_transactions` (`id`, `association_id`, `campaign_id`, `beneficiary_id`, `mohcen`, `phone`, `from`, `to`, `type`, `amount`, `date`, `description`, `payment_method`, `created_at`, `updated_at`, `content`, `type_export`) VALUES
(18, 1, NULL, 2, NULL, NULL, 'stock', 'mohtaj', 'expense', 20000.00, '2025-04-23', 'بخصوص اجراء عملية جراحية في تونس', 'bank_transfer', '2025-04-23 17:59:24', '2025-04-23 17:59:24', '[{\"content\":null,\"order_in\":null,\"price\":null,\"cost_in\":null}]', 'financial_deduction'),
(19, 1, NULL, 11, NULL, NULL, 'stock', 'mohtaj', 'expense', 100000.00, '2025-04-23', NULL, 'cash', '2025-04-23 18:04:07', '2025-04-23 18:04:07', '[{\"content\":\"\\u062a\\u0633\\u0644\\u064a\\u0645 \\u0644\\u0648\\u0627\\u0632\\u0645 \\u0645\\u062f\\u0631\\u0633\\u064a\\u0629 \\u0627\\u0644\\u0649 \\u0628\\u0646\\u0647\\u0645 \\u0641\\u0644\\u0627\\u0646 \\u0628\\u0646 \\u0639\\u0644\\u0627\\u0646\",\"order_in\":\"122\\/122\",\"price\":\"100\",\"cost_in\":\"12\\/12\"},{\"content\":\"\\u062a\\u0633\\u0644\\u064a\\u0645 \\u0644\\u0648\\u0627\\u0632\\u0645 \\u0645\\u062f\\u0631\\u0633\\u064a\\u0629 \\u0627\\u0644\\u0649 \\u0628\\u0646\\u0647\\u0645 \\u0641\\u0644\\u0627\\u0646 \\u0628\\u0646 \\u0639\\u0644\\u0627\\u0646\",\"order_in\":\"11\\/11\",\"price\":\"200\",\"cost_in\":\"11\\/11\"}]', 'expenses_order'),
(20, 1, NULL, NULL, 'sodkosd', NULL, 'mohcen', 'stock', 'income', 2000.00, '2025-05-12', NULL, 'bank_transfer', '2025-05-12 15:14:48', '2025-05-12 15:14:48', '[{\"content\":null,\"order_in\":null,\"price\":null,\"cost_in\":null}]', NULL),
(23, 1, NULL, 2, NULL, NULL, 'stock', 'mohtaj', 'expense', 2000.00, '2025-05-23', 'isisjijsid', 'cash', '2025-05-22 23:57:43', '2025-05-22 23:57:43', '[{\"content\":null,\"order_in\":null,\"price\":null,\"cost_in\":null}]', 'other_export'),
(24, 1, NULL, 2, NULL, NULL, 'stock', 'mohtaj', 'expense', 1500.00, '2025-05-23', NULL, 'cash', '2025-05-23 00:00:33', '2025-05-23 00:00:33', '[{\"content\":null,\"order_in\":null,\"price\":null,\"cost_in\":null}]', 'other_export'),
(25, 1, NULL, 11, NULL, NULL, 'stock', 'mohtaj', 'expense', 1500.00, '2025-05-23', 'isjidjisjd', 'cash', '2025-05-23 00:02:08', '2025-05-23 00:02:08', '[{\"content\":null,\"order_in\":null,\"price\":null,\"cost_in\":null}]', 'other_export'),
(38, 1, NULL, 1, NULL, NULL, 'stock', 'mohtaj', 'expense', 1500.00, '2025-05-23', 'sidisdisid', 'cash', '2025-05-23 16:03:44', '2025-05-23 16:03:44', '[{\"content\":null,\"order_in\":null,\"price\":null,\"cost_in\":null}]', 'other_export'),
(39, 1, NULL, 2, NULL, NULL, 'stock', 'mohtaj', 'expense', 5000.00, '2025-05-23', NULL, 'cash', '2025-05-23 19:24:04', '2025-05-23 19:24:04', '[]', 'expenses_order'),
(40, 1, NULL, 2, NULL, NULL, 'stock', 'mohtaj', 'expense', 5000.00, '2025-05-23', NULL, 'cash', '2025-05-23 19:25:34', '2025-05-23 19:25:34', '[]', 'expenses_order'),
(41, 1, NULL, 11, NULL, NULL, 'stock', 'mohtaj', 'expense', 5000.00, '2025-05-23', NULL, 'cash', '2025-05-23 19:33:06', '2025-05-23 19:33:06', '[{\"content\":\"TEST\",\"order_in\":\"ksdh\",\"price\":\"2000\",\"cost_in\":\"sidjis\"}]', 'expenses_order'),
(42, 1, NULL, 1, NULL, NULL, 'stock', 'mohtaj', 'expense', 67.00, '2025-05-28', 'فقف', 'cash', '2025-05-28 11:02:00', '2025-05-28 11:02:00', '[]', 'financial_deduction'),
(43, 1, 9, NULL, NULL, NULL, 'stock', 'campaign', 'expense', 500.00, '2025-05-31', NULL, 'cash', '2025-05-31 08:47:57', '2025-05-31 08:47:57', 'null', NULL),
(44, 1, NULL, 2, NULL, NULL, 'stock', 'mohtaj', 'expense', 5200.00, '2025-06-08', 'sdsd', 'cash', '2025-06-08 12:19:49', '2025-06-08 12:19:49', 'null', 'financial_deduction'),
(45, 1, NULL, 2, NULL, NULL, 'stock', 'mohtaj', 'expense', 520.00, '2025-06-08', 'dfdfdf sdasfd', 'cash', '2025-06-08 12:40:48', '2025-06-08 12:40:48', 'null', 'financial_deduction'),
(46, 1, NULL, NULL, 'محسن', NULL, 'mohcen', 'stock', 'income', 2000.00, '2025-06-08', NULL, 'cash', '2025-06-08 12:41:23', '2025-06-08 12:41:23', 'null', NULL),
(47, 1, 10, NULL, 'محسن', NULL, 'mohcen', 'campaign', 'income', 8000.00, '2025-06-08', NULL, 'cash', '2025-06-08 12:42:14', '2025-06-08 12:42:14', 'null', NULL),
(48, 1, NULL, NULL, 'محسن', '066364909', 'mohcen', 'stock', 'income', 2000.00, '2025-06-08', NULL, 'cash', '2025-06-08 12:54:15', '2025-06-08 12:54:15', 'null', NULL),
(49, 1, 10, NULL, 'مروان', '0666364909', 'mohcen', 'campaign', 'income', 3000.00, '2025-06-08', NULL, 'cash', '2025-06-08 12:57:38', '2025-06-08 12:57:38', 'null', NULL),
(50, 1, 9, NULL, 'محسن', '0658432554', 'mohcen', 'campaign', 'income', 2000.00, '2025-06-08', NULL, 'cash', '2025-06-08 12:59:24', '2025-06-08 12:59:24', 'null', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_items`
--

CREATE TABLE `inventory_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_items`
--

INSERT INTO `inventory_items` (`id`, `item_id`, `inventory_id`, `quantity`, `created_at`, `updated_at`) VALUES
(35, 21, 31, 40, '2025-05-31 08:59:30', '2025-05-31 08:59:30'),
(36, 21, 32, 3, '2025-06-04 16:44:43', '2025-06-04 16:44:43'),
(37, 21, 33, 20, '2025-06-07 22:16:22', '2025-06-07 22:16:22'),
(38, 21, 34, 20, '2025-06-07 22:18:08', '2025-06-07 22:18:08'),
(39, 21, 35, 5, '2025-06-07 22:23:32', '2025-06-07 22:23:32'),
(40, 21, 36, 454, '2025-06-07 22:25:24', '2025-06-07 22:25:24'),
(41, 21, 37, 45, '2025-06-07 22:26:19', '2025-06-07 22:26:19'),
(42, 21, 38, 200, '2025-06-07 22:27:59', '2025-06-07 22:27:59'),
(43, 21, 39, 2000, '2025-06-07 22:29:16', '2025-06-07 22:29:16'),
(44, 21, 40, 200, '2025-06-07 22:29:42', '2025-06-07 22:29:42'),
(46, 21, 42, 8484, '2025-06-07 22:39:04', '2025-06-07 22:39:04'),
(47, 23, 42, 20, '2025-06-07 22:39:04', '2025-06-07 22:39:04'),
(48, 24, 43, 20, '2025-06-07 22:41:49', '2025-06-07 22:41:49'),
(49, 25, 44, 20, '2025-06-07 22:45:05', '2025-06-07 22:45:05'),
(50, 21, 45, 20, '2025-06-07 22:46:50', '2025-06-07 22:46:50'),
(51, 22, 46, 20, '2025-06-07 23:15:25', '2025-06-07 23:15:25'),
(52, 26, 46, 20, '2025-06-07 23:21:01', '2025-06-07 23:21:01'),
(53, 21, 47, 20, '2025-06-07 23:27:21', '2025-06-07 23:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_transactions`
--

CREATE TABLE `inventory_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `association_id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED DEFAULT NULL,
  `beneficiary_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mohcen` varchar(255) DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `others` text DEFAULT NULL,
  `type` enum('in','out') NOT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_transactions`
--

INSERT INTO `inventory_transactions` (`id`, `association_id`, `campaign_id`, `beneficiary_id`, `mohcen`, `from`, `to`, `receipt`, `others`, `type`, `amount`, `date`, `description`, `created_at`, `updated_at`) VALUES
(31, 1, 9, NULL, 'mohcen', 'mohcen', 'campaign', NULL, NULL, 'in', NULL, '2025-05-30 23:00:00', NULL, '2025-05-31 08:59:30', '2025-05-31 08:59:30'),
(32, 1, 9, 11, 'stock', 'mohcen', 'mohtaj', NULL, NULL, 'out', NULL, '2025-06-04 17:45:03', NULL, '2025-06-04 16:44:43', '2025-06-04 16:44:43'),
(33, 1, 9, NULL, 'merouane', 'mohcen', 'campaign', NULL, NULL, 'in', NULL, '2025-06-06 23:00:00', NULL, '2025-06-07 22:16:22', '2025-06-07 22:16:22'),
(34, 1, NULL, NULL, 'فثسف', 'mohcen', 'stock', NULL, NULL, 'in', NULL, '2025-06-06 23:00:00', NULL, '2025-06-07 22:18:08', '2025-06-07 22:18:08'),
(35, 1, 9, NULL, 'mohcen', 'mohcen', 'campaign', NULL, NULL, 'in', NULL, '2025-06-06 23:00:00', NULL, '2025-06-07 22:23:32', '2025-06-07 22:23:32'),
(36, 1, NULL, NULL, 'sdsd', 'mohcen', 'stock', NULL, NULL, 'in', NULL, '2025-06-06 23:00:00', NULL, '2025-06-07 22:25:24', '2025-06-07 22:25:24'),
(37, 1, NULL, NULL, 'treasury', 'mohcen', 'stock', NULL, NULL, 'in', 200.00, '2025-06-06 23:00:00', NULL, '2025-06-07 22:26:19', '2025-06-07 22:26:19'),
(38, 1, 9, NULL, 'treasury', 'mohcen', 'campaign', NULL, NULL, 'in', 2000.00, '2025-06-06 23:00:00', NULL, '2025-06-07 22:27:59', '2025-06-07 22:27:59'),
(39, 1, 9, NULL, 'mohcen', 'mohcen', 'campaign', NULL, NULL, 'in', NULL, '2025-06-06 23:00:00', NULL, '2025-06-07 22:29:16', '2025-06-07 22:29:16'),
(40, 1, 9, NULL, 'mohcen', 'mohcen', 'campaign', NULL, NULL, 'in', NULL, '2025-06-06 23:00:00', NULL, '2025-06-07 22:29:42', '2025-06-07 22:29:42'),
(42, 1, 9, NULL, 'stock', 'mohcen', 'campaign', NULL, NULL, 'out', NULL, '2025-06-06 23:00:00', 'sdsdsd', '2025-06-07 22:39:04', '2025-06-07 22:39:04'),
(43, 1, NULL, NULL, 'stock', 'mohcen', 'others', NULL, 'sdsdsd', 'out', NULL, '2025-06-06 23:00:00', 'asdsas', '2025-06-07 22:41:49', '2025-06-07 22:41:49'),
(44, 1, NULL, 1, 'stock', 'mohcen', 'mohtaj', NULL, NULL, 'out', NULL, '2025-06-06 23:00:00', 'sdsdsd', '2025-06-07 22:45:05', '2025-06-07 22:45:05'),
(45, 1, 9, NULL, 'stock', 'mohcen', 'campaign', NULL, NULL, 'out', NULL, '2025-06-06 23:00:00', 'dfdfdf', '2025-06-07 22:46:50', '2025-06-07 22:46:50'),
(46, 1, NULL, 1, 'stock', 'stock', 'mohtaj', NULL, NULL, 'out', NULL, '2025-06-07 23:00:00', 'sdsdsdsd', '2025-06-07 23:15:25', '2025-06-07 23:21:01'),
(47, 1, NULL, 1, 'stock', 'stock', 'mohtaj', NULL, NULL, 'out', NULL, '2025-06-07 23:00:00', 'sdsd', '2025-06-07 23:27:21', '2025-06-07 23:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `type` enum('food','medical','education','emergency') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `code`, `type`, `created_at`, `updated_at`) VALUES
(21, 'test', '84s8df', 'food', '2025-05-31 08:59:00', '2025-05-31 08:59:00'),
(22, 'Khlafaoui Elhareth', '000085', NULL, '2025-06-02 18:55:47', '2025-06-02 18:55:47'),
(23, 'sdsdsd', 'sdsdsd', NULL, '2025-06-07 22:39:04', '2025-06-07 22:39:04'),
(24, 'test', '887847', NULL, '2025-06-07 22:41:49', '2025-06-07 22:41:49'),
(25, 'testone', '7847', NULL, '2025-06-07 22:45:05', '2025-06-07 22:45:05'),
(26, 'sdasds', '98987', NULL, '2025-06-07 23:21:01', '2025-06-07 23:21:01');

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

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"3da6a22e-ffd5-4b60-b1f0-0eef37a4a5d5\",\"displayName\":\"App\\\\Events\\\\PublicationDeleted\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\PublicationDeleted\\\":1:{s:2:\\\"id\\\";s:1:\\\"1\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"}}', 0, NULL, 1729872387, 1729872387),
(2, 'default', '{\"uuid\":\"31c1aae5-afde-4ded-9984-a4f13de4a126\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":2:{s:7:\\\"message\\\";s:3:\\\"ddd\\\";s:4:\\\"user\\\";i:1;}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"telescope_uuid\":\"9d97a117-db93-4356-80df-939816fec5ea\"}', 0, NULL, 1732745683, 1732745683);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `association_id` bigint(20) UNSIGNED NOT NULL,
  `beneficiary_id` bigint(20) UNSIGNED DEFAULT NULL,
  `device_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` double NOT NULL DEFAULT 1,
  `loan_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('active','returned','lost') NOT NULL DEFAULT 'active',
  `type` enum('anonyme','existing') NOT NULL DEFAULT 'existing',
  `notes` text DEFAULT NULL,
  `receipt_voucher` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `association_id`, `beneficiary_id`, `device_id`, `quantity`, `loan_date`, `return_date`, `status`, `type`, `notes`, `receipt_voucher`, `created_at`, `updated_at`) VALUES
(10, 1, 6, 10, 1, '2025-05-24', '2025-06-08', 'active', 'anonyme', 'بدون شهادة طبية', NULL, '2025-05-24 22:46:46', '2025-05-24 22:46:46');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_03_164733_create_personal_access_tokens_table', 1),
(6, '2024_10_12_164958_create_app_exceptions_table', 3),
(7, '2024_10_18_140211_create_coupons_table', 4),
(8, '2024_10_28_161530_create_details_table', 5),
(11, '2024_11_09_132907_create_telescope_entries_table', 6),
(12, '2024_11_05_094649_create_logs_table', 7),
(25, '2024_11_24_155534_create_cars_table', 8),
(26, '2024_11_24_155602_create_locations_table', 8),
(27, '2024_11_27_213231_create_chat_rooms_table', 9),
(28, '2024_11_27_213250_create_messages_table', 9),
(29, '2024_11_27_213537_create_chat_room_users_table', 9),
(30, '2024_12_20_061500_create_roles_table', 9),
(31, '2024_12_28_075651_association', 10),
(32, '2024_12_29_075611_financial_transaction', 10),
(33, '2024_12_29_075626_inventory_transaction', 10),
(34, '2024_12_29_075633_campaign', 10),
(35, '2024_12_29_075642_beneficiary', 10),
(36, '2024_12_29_080447_create_items_table', 10),
(37, '2025_01_07_095800_create_campaign_items_table', 11),
(39, '2025_01_07_110547_create_inventory_items_table', 12),
(40, '2025_03_03_131352_create_volunteers_table', 13),
(41, '2025_03_03_131405_create_loans_table', 13),
(42, '2025_03_25_171014_create_sponsors_table', 14),
(43, '2025_03_02_185052_create_devices_table', 15),
(44, '2025_04_06_172844_create_anonyme_beneficiaries_table', 16),
(45, '2025_05_29_102219_create_districts_table', 16),
(46, '2025_05_29_102235_create_municipalities_table', 16),
(47, '2025_05_30_080757_create_team_members_table', 16),
(48, '2025_06_04_092454_create_children_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `municipalities`
--

CREATE TABLE `municipalities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `municipalities`
--

INSERT INTO `municipalities` (`id`, `name_ar`, `name_en`, `district_id`, `created_at`, `updated_at`) VALUES
(1, 'الوادي', 'El-Oued', 1, NULL, NULL),
(2, 'كوينين', 'Kouinine', 1, NULL, NULL),
(3, 'الرباح', 'Robbah', 1, NULL, NULL),
(4, 'قمار', 'Guemar', 2, NULL, NULL),
(5, 'ورماس', 'Ourmes', 2, NULL, NULL),
(6, 'تغزوت', 'Taghzout', 2, NULL, NULL),
(7, 'الدبيلة', 'Debila', 3, NULL, NULL),
(8, 'حساني عبد الكريم', 'Hassani Abdelkrim', 3, NULL, NULL),
(9, 'الرقيبة', 'Reguiba', 4, NULL, NULL),
(10, 'الحمراية', 'Hamraia', 4, NULL, NULL),
(11, 'الطالب العربي', 'Taleb Larbi', 5, NULL, NULL),
(12, 'دوار الماء', 'Douar El Maa', 5, NULL, NULL),
(13, 'بن قشة', 'Ben Guecha', 5, NULL, NULL),
(14, 'حاسي خليفة', 'Hassi Khalifa', 6, NULL, NULL),
(15, 'الطريفاوي', 'Trifaoui', 6, NULL, NULL),
(16, 'اميه وانسة', 'Mih Ouansa', 7, NULL, NULL),
(17, 'وادي العلندة', 'Oued El Alenda', 7, NULL, NULL),
(18, 'الرباح', 'Robbah', 8, NULL, NULL),
(19, 'العقلة', 'El Ogla', 8, NULL, NULL),
(20, 'النخلة', 'Nakhla', 8, NULL, NULL),
(21, 'المقرن', 'Magrane', 9, NULL, NULL),
(22, 'سيدي عون', 'Sidi Aoun', 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `request` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_observation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `order_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `beneficiary_id` bigint(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `accepted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `request`, `admin_observation`, `observation`, `price`, `order_type`, `beneficiary_id`, `status`, `accepted_by`, `date`, `items`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 'ushdusd sudhsud', 'ddd', NULL, NULL, 'ayni', 2, 1, NULL, '2025-05-08', '\"[{\\\"item\\\":\\\"sidjisdj\\\",\\\"quantity\\\":\\\"10\\\",\\\"price\\\":\\\"2000\\\"},{\\\"item\\\":\\\"wdiwjsjd\\\",\\\"quantity\\\":\\\"10\\\",\\\"price\\\":\\\"2000\\\"}]\"', '2025-05-31 11:54:29', '2025-06-02 21:00:31', NULL),
(18, 'isdjisd', NULL, NULL, NULL, 'ayni', 11, -1, NULL, '2025-06-13', '\"[{\\\"item\\\":\\\"sdsd\\\",\\\"quantity\\\":\\\"100\\\"}]\"', '2025-05-31 23:34:35', '2025-05-31 23:38:22', NULL),
(19, 'yy', 'bbb', NULL, 99, 'ayni', 2, 1, NULL, '2025-06-02', '\"[{\\\"item\\\":\\\"88\\\",\\\"quantity\\\":\\\"77\\\"}]\"', '2025-06-02 21:28:19', '2025-06-02 21:33:23', NULL),
(20, NULL, NULL, NULL, 2000, 'ayni', 2, 0, NULL, '2025-06-18', '\"[{\\\"item\\\":\\\"dfdfdfdf\\\",\\\"quantity\\\":\\\"30\\\",\\\"price\\\":\\\"2000\\\"}]\"', '2025-06-08 00:55:52', '2025-06-08 00:55:52', NULL),
(21, NULL, NULL, NULL, 2000, 'ayni', 3, 0, NULL, '2025-06-08', '\"[{\\\"item\\\":\\\"Khlafaoui Elhareth\\\",\\\"quantity\\\":\\\"20\\\",\\\"price\\\":\\\"2000\\\"}]\"', '2025-06-08 14:40:12', '2025-06-08 14:40:12', NULL),
(22, NULL, NULL, NULL, 2000, 'ayni', 1, 0, NULL, '2025-06-08', '\"[{\\\"item\\\":\\\"sdsdsd\\\",\\\"quantity\\\":\\\"0200\\\",\\\"price\\\":\\\"2021\\\"}]\"', '2025-06-08 14:40:44', '2025-06-08 14:40:44', NULL),
(23, 'edited', 'accepted', NULL, 2000, 'ayni', 1, 1, NULL, '2025-06-08', '\"[{\\\"item\\\":\\\"test\\\",\\\"quantity\\\":\\\"2000\\\"}]\"', '2025-06-08 14:45:41', '2025-06-08 14:55:36', NULL),
(24, 'sdsdsd', NULL, NULL, 2000, 'ayni', 5, 1, NULL, '2025-06-08', '\"[{\\\"item\\\":\\\"test\\\",\\\"quantity\\\":\\\"20\\\",\\\"price\\\":\\\"1000\\\"}]\"', '2025-06-08 14:56:54', '2025-06-08 15:37:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'Administrator role', '2024-12-20 06:20:26', '2024-12-20 06:20:24', NULL),
(2, 'editor', 'Editor role', '2024-12-20 06:20:27', '2024-12-20 06:20:25', NULL),
(3, 'user', 'Regular user role', '2024-12-20 06:20:28', '2024-12-20 06:20:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('XkYDqkOzipJ8Zhsq6Mt3HwQaSpWurndbSDWgtaGa', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTlgzZU4xcmdqNXliRENDSnNobjJZUGpyTDlxWU9tZ0JVQjBwaFVHZyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwL29yZGVycy8yMCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQzOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvb3JkZXJzL3BkZi1wcmV2aWV3LzI0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1749399655);

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `fund_type` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `full_name`, `business_name`, `fund_type`, `phone`, `notes`, `created_at`, `updated_at`) VALUES
(2, 'elhareth csdcs', 'shatla', 'food', '0795909168', 'd', '2025-03-25 16:35:48', '2025-03-25 19:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `campaign_id`, `first_name`, `last_name`, `role`, `created_at`, `updated_at`) VALUES
(5, 10, 'association', '2024', 'ssssss', '2025-06-02 10:14:45', '2025-06-02 11:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `photo`, `role_id`, `theme`, `lang`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '0795909128', '1735810064_cropped-image.png', 1, NULL, 'ar', NULL, '$2y$12$rb24.cbGqfAQBJVkgkoxpeD3TbB.w.v.ElzV1lilnOFhYmtfA.sW2', 'AYXs4RbL2qnnCHaEmHDQjZzZvKHGJXs0dE9hb9DAh91IExKrirkIOn0VK25A', NULL, '2025-01-02 08:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL COMMENT 'e.g., male, female',
  `birth_date` date DEFAULT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `academic_level` varchar(50) DEFAULT NULL COMMENT 'e.g., primary, intermediate, secondary, university',
  `membership_type` varchar(50) DEFAULT NULL COMMENT 'e.g., founder member, active member, honorary member',
  `phone1` varchar(20) DEFAULT NULL,
  `phone2` varchar(20) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `subDepartment` varchar(50) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`id`, `full_name`, `code`, `gender`, `birth_date`, `national_id`, `entry_date`, `academic_level`, `membership_type`, `phone1`, `phone2`, `phone`, `address`, `email`, `department`, `subDepartment`, `skills`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'yfy', '', NULL, NULL, '232323', NULL, NULL, NULL, NULL, NULL, '0795909128', 'BT 4 N 3', 'elhareth0609@gmail.com', NULL, NULL, '23232', '23232323', '2025-03-03 14:57:32', '2025-03-03 14:57:32'),
(2, 'elhareth csdcs', '000001', 'male', '2025-06-03', '2323233', '2025-06-27', 'primary', 'founder member', '0795909128', '0795909168', NULL, 'BT 4 N 3', 'admin@gmail.com', 'management', 'Social Affairs', 's', 's', '2025-06-03 08:48:51', '2025-06-03 08:48:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anonyme_beneficiaries`
--
ALTER TABLE `anonyme_beneficiaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `associations`
--
ALTER TABLE `associations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `fk_beneficiaries_district` (`district_id`),
  ADD KEY `fk_beneficiaries_municipality` (`municipality_id`);

--
-- Indexes for table `benifices`
--
ALTER TABLE `benifices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaigns_association_id_foreign` (`association_id`);

--
-- Indexes for table `campaign_items`
--
ALTER TABLE `campaign_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_items_campaign_id_foreign` (`campaign_id`),
  ADD KEY `campaign_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `children_beneficiary_id_foreign` (`beneficiary_id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `devices_barcode_unique` (`barcode`),
  ADD UNIQUE KEY `devices_inventory_number_unique` (`inventory_number`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_decument_order` (`order_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `financial_transactions`
--
ALTER TABLE `financial_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `financial_transactions_association_id_foreign` (`association_id`),
  ADD KEY `campaign_id` (`campaign_id`),
  ADD KEY `beneficiary_id` (`beneficiary_id`);

--
-- Indexes for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_items_item_id_foreign` (`item_id`),
  ADD KEY `inventory_items_inventory_id_foreign` (`inventory_id`);

--
-- Indexes for table `inventory_transactions`
--
ALTER TABLE `inventory_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_id` (`campaign_id`),
  ADD KEY `association_id` (`association_id`),
  ADD KEY `beneficiary_id` (`beneficiary_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_association_id_foreign` (`association_id`),
  ADD KEY `loans_device_id_foreign` (`device_id`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `municipalities`
--
ALTER TABLE `municipalities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipalities_district_id_foreign` (`district_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_members_campaign_id_foreign` (`campaign_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `role` (`role_id`) USING BTREE;

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anonyme_beneficiaries`
--
ALTER TABLE `anonyme_beneficiaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `associations`
--
ALTER TABLE `associations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `benifices`
--
ALTER TABLE `benifices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `campaign_items`
--
ALTER TABLE `campaign_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_transactions`
--
ALTER TABLE `financial_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `inventory_items`
--
ALTER TABLE `inventory_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `inventory_transactions`
--
ALTER TABLE `inventory_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `municipalities`
--
ALTER TABLE `municipalities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD CONSTRAINT `fk_beneficiaries_district` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_beneficiaries_municipality` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_association_id_foreign` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `campaign_items`
--
ALTER TABLE `campaign_items`
  ADD CONSTRAINT `campaign_items_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `campaign_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `children_beneficiary_id_foreign` FOREIGN KEY (`beneficiary_id`) REFERENCES `beneficiaries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `fk_decument_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `financial_transactions`
--
ALTER TABLE `financial_transactions`
  ADD CONSTRAINT `financial_transactions_association_id_foreign` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `financial_transactions_beneficiary_id_id_foreign` FOREIGN KEY (`beneficiary_id`) REFERENCES `beneficiaries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `financial_transactions_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD CONSTRAINT `inventory_items_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventory_transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventory_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventory_transactions`
--
ALTER TABLE `inventory_transactions`
  ADD CONSTRAINT `f_association_id` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `f_beneficiary_id` FOREIGN KEY (`beneficiary_id`) REFERENCES `beneficiaries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `f_campaign_id` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_association_id_foreign` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loans_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `devices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `municipalities`
--
ALTER TABLE `municipalities`
  ADD CONSTRAINT `municipalities_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `team_members_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
