-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2025 at 01:04 PM
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
-- Database: `male_fashion`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('active','block') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Khaadi', 'khaadi', 'active', '2025-02-06 03:34:13', '2025-02-06 03:37:25'),
(2, 'J. (Junaid Jamshed)', 'junaid-jamshed', 'active', '2025-02-06 03:34:26', '2025-02-06 03:37:50'),
(3, 'Gul Ahmed', 'gul-ahmed', 'active', '2025-02-06 03:34:35', '2025-02-06 03:38:06'),
(4, 'Bonanza Satrangi', 'bonanza-satrangi', 'active', '2025-02-06 03:34:42', '2025-02-06 03:38:18'),
(5, 'Outfitters', 'outfitters', 'active', '2025-02-06 03:34:48', '2025-02-06 03:38:32'),
(6, 'Adidas', 'adidas', 'active', '2025-02-06 03:36:02', '2025-02-06 03:36:02'),
(7, 'Zara', 'zara', 'active', '2025-02-06 03:36:10', '2025-02-06 03:36:10'),
(8, 'Puma', 'puma', 'active', '2025-02-06 03:36:19', '2025-02-06 03:36:19'),
(9, 'Sapphire', 'sapphire', 'active', '2025-02-06 03:39:03', '2025-02-06 03:39:03'),
(10, 'Maria B', 'maria-b', 'active', '2025-02-06 03:39:08', '2025-02-06 03:39:08'),
(11, 'Bata', 'bata', 'active', '2025-02-06 03:39:17', '2025-02-06 03:39:17'),
(12, 'Hush Puppies', 'hush-puppies', 'active', '2025-02-06 03:39:23', '2025-02-06 03:39:23'),
(13, 'Alkaram', 'alkaram', 'active', '2025-02-06 03:39:44', '2025-02-06 03:39:44'),
(14, 'Sufi’s Jewels', 'sufis-jewels', 'active', '2025-02-06 03:39:54', '2025-02-06 03:39:54'),
(15, 'Vision Express', 'vision-express', 'active', '2025-02-06 03:40:11', '2025-02-06 03:40:11'),
(16, 'Gul Ahmed Opticals', 'gul-ahmed-opticals', 'active', '2025-02-06 03:40:17', '2025-02-06 03:40:17'),
(17, 'Eyewear', 'eyewear', 'active', '2025-02-06 03:40:31', '2025-02-06 03:40:31'),
(18, 'Essence', '', 'active', '2025-03-05 03:50:36', '2025-03-05 03:50:36'),
(19, 'Glamour Beauty', '', 'active', '2025-03-05 03:52:01', '2025-03-05 03:52:01'),
(20, 'Velvet Touch', '', 'active', '2025-03-05 03:52:01', '2025-03-05 03:52:01'),
(21, 'Chic Cosmetics', '', 'active', '2025-03-05 03:52:01', '2025-03-05 03:52:01'),
(22, 'Nail Couture', '', 'active', '2025-03-05 03:52:01', '2025-03-05 03:52:01'),
(23, 'Calvin Klein', '', 'active', '2025-03-05 03:52:01', '2025-03-05 03:52:01'),
(24, 'Chanel', '', 'active', '2025-03-05 03:52:02', '2025-03-05 03:52:02'),
(25, 'Dior', '', 'active', '2025-03-05 03:52:02', '2025-03-05 03:52:02'),
(26, 'Dolce & Gabbana', '', 'active', '2025-03-05 03:52:02', '2025-03-05 03:52:02'),
(27, 'Gucci', '', 'active', '2025-03-05 03:52:02', '2025-03-05 03:52:02'),
(28, 'Annibale Colombo', '', 'active', '2025-03-05 03:52:02', '2025-03-05 03:52:02'),
(29, 'Furniture Co.', '', 'active', '2025-03-05 03:52:02', '2025-03-05 03:52:02'),
(30, 'Knoll', '', 'active', '2025-03-05 03:52:02', '2025-03-05 03:52:02'),
(31, 'Bath Trends', '', 'active', '2025-03-05 03:52:03', '2025-03-05 03:52:03');

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('active','block') NOT NULL DEFAULT 'active',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Men', 'men', 'active', NULL, '2025-02-06 03:24:02', '2025-02-06 03:24:02'),
(2, 'Women', 'women', 'active', NULL, '2025-02-06 03:24:15', '2025-02-06 03:24:15'),
(3, 'Bags', 'bags', 'active', NULL, '2025-02-06 03:24:22', '2025-02-06 03:24:22'),
(4, 'Clothing', 'clothing', 'active', NULL, '2025-02-06 03:24:32', '2025-02-06 03:24:32'),
(5, 'Shoes', 'shoes', 'active', NULL, '2025-02-06 03:24:39', '2025-02-06 03:24:39'),
(6, 'Accessories', 'accessories', 'active', NULL, '2025-02-06 03:24:50', '2025-02-06 03:24:50'),
(7, 'Kids', 'kids', 'active', NULL, '2025-02-06 03:24:56', '2025-02-06 03:24:56'),
(8, 'Jewelry', 'jewelry', 'active', NULL, '2025-02-06 03:25:41', '2025-02-06 03:25:41'),
(9, 'Earrings', 'earrings', 'active', NULL, '2025-02-06 03:25:53', '2025-02-06 03:25:53'),
(10, 'Couple Rings', 'couple-rings', 'active', NULL, '2025-02-06 03:26:05', '2025-02-06 03:26:05'),
(11, 'Necklace', 'necklace', 'active', NULL, '2025-02-06 03:26:16', '2025-02-06 03:26:16'),
(12, 'Perfume', 'perfume', 'active', NULL, '2025-02-06 03:26:25', '2025-02-06 03:26:25'),
(13, 'Cosmetics', 'cosmetics', 'active', NULL, '2025-02-06 03:26:53', '2025-02-06 03:26:53'),
(14, 'Glasses', 'glasses', 'active', NULL, '2025-02-06 03:27:17', '2025-02-06 03:27:17'),
(15, 'Shirt', 'shirt', 'active', NULL, '2025-02-06 03:27:34', '2025-02-06 03:27:34'),
(16, 'Shorts & Jeans', 'shorts-jeans', 'active', NULL, '2025-02-06 03:27:47', '2025-02-06 03:27:47'),
(17, 'Jacket', 'jacket', 'active', NULL, '2025-02-06 03:27:55', '2025-02-06 03:27:55'),
(18, 'Dress & Frock', 'dress-frock', 'active', NULL, '2025-02-06 03:28:08', '2025-02-06 03:28:08'),
(19, 'Sports', 'sports', 'active', NULL, '2025-02-06 03:28:18', '2025-02-06 03:28:18'),
(20, 'Formal', 'formal', 'active', NULL, '2025-02-06 03:28:25', '2025-02-06 03:28:25'),
(21, 'Casual', 'casual', 'active', NULL, '2025-02-06 03:28:34', '2025-02-06 03:28:34'),
(22, 'Wallet', 'wallet', 'active', NULL, '2025-02-06 03:29:09', '2025-02-06 03:29:09'),
(23, 'Bracelets', 'bracelets', 'active', NULL, '2025-02-06 03:29:32', '2025-02-06 03:29:32'),
(24, 'beauty', '', 'active', NULL, '2025-03-05 03:50:37', '2025-03-05 03:50:37'),
(25, 'fragrances', '', 'active', NULL, '2025-03-05 03:52:02', '2025-03-05 03:52:02'),
(26, 'furniture', '', 'active', NULL, '2025-03-05 03:52:02', '2025-03-05 03:52:02');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'United States', 'US', NULL, NULL),
(2, 'Canada', 'CA', NULL, NULL),
(3, 'Afghanistan', 'AF', NULL, NULL),
(4, 'Albania', 'AL', NULL, NULL),
(5, 'Algeria', 'DZ', NULL, NULL),
(6, 'American Samoa', 'AS', NULL, NULL),
(7, 'Andorra', 'AD', NULL, NULL),
(8, 'Angola', 'AO', NULL, NULL),
(9, 'Anguilla', 'AI', NULL, NULL),
(10, 'Antarctica', 'AQ', NULL, NULL),
(11, 'Antigua and/or Barbuda', 'AG', NULL, NULL),
(12, 'Argentina', 'AR', NULL, NULL),
(13, 'Armenia', 'AM', NULL, NULL),
(14, 'Aruba', 'AW', NULL, NULL),
(15, 'Australia', 'AU', NULL, NULL),
(16, 'Austria', 'AT', NULL, NULL),
(17, 'Azerbaijan', 'AZ', NULL, NULL),
(18, 'Bahamas', 'BS', NULL, NULL),
(19, 'Bahrain', 'BH', NULL, NULL),
(20, 'Bangladesh', 'BD', NULL, NULL),
(21, 'Barbados', 'BB', NULL, NULL),
(22, 'Belarus', 'BY', NULL, NULL),
(23, 'Belgium', 'BE', NULL, NULL),
(24, 'Belize', 'BZ', NULL, NULL),
(25, 'Benin', 'BJ', NULL, NULL),
(26, 'Bermuda', 'BM', NULL, NULL),
(27, 'Bhutan', 'BT', NULL, NULL),
(28, 'Bolivia', 'BO', NULL, NULL),
(29, 'Bosnia and Herzegovina', 'BA', NULL, NULL),
(30, 'Botswana', 'BW', NULL, NULL),
(31, 'Bouvet Island', 'BV', NULL, NULL),
(32, 'Brazil', 'BR', NULL, NULL),
(33, 'British lndian Ocean Territory', 'IO', NULL, NULL),
(34, 'Brunei Darussalam', 'BN', NULL, NULL),
(35, 'Bulgaria', 'BG', NULL, NULL),
(36, 'Burkina Faso', 'BF', NULL, NULL),
(37, 'Burundi', 'BI', NULL, NULL),
(38, 'Cambodia', 'KH', NULL, NULL),
(39, 'Cameroon', 'CM', NULL, NULL),
(40, 'Cape Verde', 'CV', NULL, NULL),
(41, 'Cayman Islands', 'KY', NULL, NULL),
(42, 'Central African Republic', 'CF', NULL, NULL),
(43, 'Chad', 'TD', NULL, NULL),
(44, 'Chile', 'CL', NULL, NULL),
(45, 'China', 'CN', NULL, NULL),
(46, 'Christmas Island', 'CX', NULL, NULL),
(47, 'Cocos (Keeling) Islands', 'CC', NULL, NULL),
(48, 'Colombia', 'CO', NULL, NULL),
(49, 'Comoros', 'KM', NULL, NULL),
(50, 'Congo', 'CG', NULL, NULL),
(51, 'Cook Islands', 'CK', NULL, NULL),
(52, 'Costa Rica', 'CR', NULL, NULL),
(53, 'Croatia (Hrvatska)', 'HR', NULL, NULL),
(54, 'Cuba', 'CU', NULL, NULL),
(55, 'Cyprus', 'CY', NULL, NULL),
(56, 'Czech Republic', 'CZ', NULL, NULL),
(57, 'Democratic Republic of Congo', 'CD', NULL, NULL),
(58, 'Denmark', 'DK', NULL, NULL),
(59, 'Djibouti', 'DJ', NULL, NULL),
(60, 'Dominica', 'DM', NULL, NULL),
(61, 'Dominican Republic', 'DO', NULL, NULL),
(62, 'East Timor', 'TP', NULL, NULL),
(63, 'Ecudaor', 'EC', NULL, NULL),
(64, 'Egypt', 'EG', NULL, NULL),
(65, 'El Salvador', 'SV', NULL, NULL),
(66, 'Equatorial Guinea', 'GQ', NULL, NULL),
(67, 'Eritrea', 'ER', NULL, NULL),
(68, 'Estonia', 'EE', NULL, NULL),
(69, 'Ethiopia', 'ET', NULL, NULL),
(70, 'Falkland Islands (Malvinas)', 'FK', NULL, NULL),
(71, 'Faroe Islands', 'FO', NULL, NULL),
(72, 'Fiji', 'FJ', NULL, NULL),
(73, 'Finland', 'FI', NULL, NULL),
(74, 'France', 'FR', NULL, NULL),
(75, 'France, Metropolitan', 'FX', NULL, NULL),
(76, 'French Guiana', 'GF', NULL, NULL),
(77, 'French Polynesia', 'PF', NULL, NULL),
(78, 'French Southern Territories', 'TF', NULL, NULL),
(79, 'Gabon', 'GA', NULL, NULL),
(80, 'Gambia', 'GM', NULL, NULL),
(81, 'Georgia', 'GE', NULL, NULL),
(82, 'Germany', 'DE', NULL, NULL),
(83, 'Ghana', 'GH', NULL, NULL),
(84, 'Gibraltar', 'GI', NULL, NULL),
(85, 'Greece', 'GR', NULL, NULL),
(86, 'Greenland', 'GL', NULL, NULL),
(87, 'Grenada', 'GD', NULL, NULL),
(88, 'Guadeloupe', 'GP', NULL, NULL),
(89, 'Guam', 'GU', NULL, NULL),
(90, 'Guatemala', 'GT', NULL, NULL),
(91, 'Guinea', 'GN', NULL, NULL),
(92, 'Guinea-Bissau', 'GW', NULL, NULL),
(93, 'Guyana', 'GY', NULL, NULL),
(94, 'Haiti', 'HT', NULL, NULL),
(95, 'Heard and Mc Donald Islands', 'HM', NULL, NULL),
(96, 'Honduras', 'HN', NULL, NULL),
(97, 'Hong Kong', 'HK', NULL, NULL),
(98, 'Hungary', 'HU', NULL, NULL),
(99, 'Iceland', 'IS', NULL, NULL),
(100, 'India', 'IN', NULL, NULL),
(101, 'Indonesia', 'ID', NULL, NULL),
(102, 'Iran (Islamic Republic of)', 'IR', NULL, NULL),
(103, 'Iraq', 'IQ', NULL, NULL),
(104, 'Ireland', 'IE', NULL, NULL),
(105, 'Israel', 'IL', NULL, NULL),
(106, 'Italy', 'IT', NULL, NULL),
(107, 'Ivory Coast', 'CI', NULL, NULL),
(108, 'Jamaica', 'JM', NULL, NULL),
(109, 'Japan', 'JP', NULL, NULL),
(110, 'Jordan', 'JO', NULL, NULL),
(111, 'Kazakhstan', 'KZ', NULL, NULL),
(112, 'Kenya', 'KE', NULL, NULL),
(113, 'Kiribati', 'KI', NULL, NULL),
(114, 'Korea, Democratic People\'s Republic of', 'KP', NULL, NULL),
(115, 'Korea, Republic of', 'KR', NULL, NULL),
(116, 'Kuwait', 'KW', NULL, NULL),
(117, 'Kyrgyzstan', 'KG', NULL, NULL),
(118, 'Lao People\'s Democratic Republic', 'LA', NULL, NULL),
(119, 'Latvia', 'LV', NULL, NULL),
(120, 'Lebanon', 'LB', NULL, NULL),
(121, 'Lesotho', 'LS', NULL, NULL),
(122, 'Liberia', 'LR', NULL, NULL),
(123, 'Libyan Arab Jamahiriya', 'LY', NULL, NULL),
(124, 'Liechtenstein', 'LI', NULL, NULL),
(125, 'Lithuania', 'LT', NULL, NULL),
(126, 'Luxembourg', 'LU', NULL, NULL),
(127, 'Macau', 'MO', NULL, NULL),
(128, 'Macedonia', 'MK', NULL, NULL),
(129, 'Madagascar', 'MG', NULL, NULL),
(130, 'Malawi', 'MW', NULL, NULL),
(131, 'Malaysia', 'MY', NULL, NULL),
(132, 'Maldives', 'MV', NULL, NULL),
(133, 'Mali', 'ML', NULL, NULL),
(134, 'Malta', 'MT', NULL, NULL),
(135, 'Marshall Islands', 'MH', NULL, NULL),
(136, 'Martinique', 'MQ', NULL, NULL),
(137, 'Mauritania', 'MR', NULL, NULL),
(138, 'Mauritius', 'MU', NULL, NULL),
(139, 'Mayotte', 'TY', NULL, NULL),
(140, 'Mexico', 'MX', NULL, NULL),
(141, 'Micronesia, Federated States of', 'FM', NULL, NULL),
(142, 'Moldova, Republic of', 'MD', NULL, NULL),
(143, 'Monaco', 'MC', NULL, NULL),
(144, 'Mongolia', 'MN', NULL, NULL),
(145, 'Montserrat', 'MS', NULL, NULL),
(146, 'Morocco', 'MA', NULL, NULL),
(147, 'Mozambique', 'MZ', NULL, NULL),
(148, 'Myanmar', 'MM', NULL, NULL),
(149, 'Namibia', 'NA', NULL, NULL),
(150, 'Nauru', 'NR', NULL, NULL),
(151, 'Nepal', 'NP', NULL, NULL),
(152, 'Netherlands', 'NL', NULL, NULL),
(153, 'Netherlands Antilles', 'AN', NULL, NULL),
(154, 'New Caledonia', 'NC', NULL, NULL),
(155, 'New Zealand', 'NZ', NULL, NULL),
(156, 'Nicaragua', 'NI', NULL, NULL),
(157, 'Niger', 'NE', NULL, NULL),
(158, 'Nigeria', 'NG', NULL, NULL),
(159, 'Niue', 'NU', NULL, NULL),
(160, 'Norfork Island', 'NF', NULL, NULL),
(161, 'Northern Mariana Islands', 'MP', NULL, NULL),
(162, 'Norway', 'NO', NULL, NULL),
(163, 'Oman', 'OM', NULL, NULL),
(164, 'Pakistan', 'PK', NULL, NULL),
(165, 'Palau', 'PW', NULL, NULL),
(166, 'Panama', 'PA', NULL, NULL),
(167, 'Papua New Guinea', 'PG', NULL, NULL),
(168, 'Paraguay', 'PY', NULL, NULL),
(169, 'Peru', 'PE', NULL, NULL),
(170, 'Philippines', 'PH', NULL, NULL),
(171, 'Pitcairn', 'PN', NULL, NULL),
(172, 'Poland', 'PL', NULL, NULL),
(173, 'Portugal', 'PT', NULL, NULL),
(174, 'Puerto Rico', 'PR', NULL, NULL),
(175, 'Qatar', 'QA', NULL, NULL),
(176, 'Republic of South Sudan', 'SS', NULL, NULL),
(177, 'Reunion', 'RE', NULL, NULL),
(178, 'Romania', 'RO', NULL, NULL),
(179, 'Russian Federation', 'RU', NULL, NULL),
(180, 'Rwanda', 'RW', NULL, NULL),
(181, 'Saint Kitts and Nevis', 'KN', NULL, NULL),
(182, 'Saint Lucia', 'LC', NULL, NULL),
(183, 'Saint Vincent and the Grenadines', 'VC', NULL, NULL),
(184, 'Samoa', 'WS', NULL, NULL),
(185, 'San Marino', 'SM', NULL, NULL),
(186, 'Sao Tome and Principe', 'ST', NULL, NULL),
(187, 'Saudi Arabia', 'SA', NULL, NULL),
(188, 'Senegal', 'SN', NULL, NULL),
(189, 'Serbia', 'RS', NULL, NULL),
(190, 'Seychelles', 'SC', NULL, NULL),
(191, 'Sierra Leone', 'SL', NULL, NULL),
(192, 'Singapore', 'SG', NULL, NULL),
(193, 'Slovakia', 'SK', NULL, NULL),
(194, 'Slovenia', 'SI', NULL, NULL),
(195, 'Solomon Islands', 'SB', NULL, NULL),
(196, 'Somalia', 'SO', NULL, NULL),
(197, 'South Africa', 'ZA', NULL, NULL),
(198, 'South Georgia South Sandwich Islands', 'GS', NULL, NULL),
(199, 'Spain', 'ES', NULL, NULL),
(200, 'Sri Lanka', 'LK', NULL, NULL),
(201, 'St. Helena', 'SH', NULL, NULL),
(202, 'St. Pierre and Miquelon', 'PM', NULL, NULL),
(203, 'Sudan', 'SD', NULL, NULL),
(204, 'Suriname', 'SR', NULL, NULL),
(205, 'Svalbarn and Jan Mayen Islands', 'SJ', NULL, NULL),
(206, 'Swaziland', 'SZ', NULL, NULL),
(207, 'Sweden', 'SE', NULL, NULL),
(208, 'Switzerland', 'CH', NULL, NULL),
(209, 'Syrian Arab Republic', 'SY', NULL, NULL),
(210, 'Taiwan', 'TW', NULL, NULL),
(211, 'Tajikistan', 'TJ', NULL, NULL),
(212, 'Tanzania, United Republic of', 'TZ', NULL, NULL),
(213, 'Thailand', 'TH', NULL, NULL),
(214, 'Togo', 'TG', NULL, NULL),
(215, 'Tokelau', 'TK', NULL, NULL),
(216, 'Tonga', 'TO', NULL, NULL),
(217, 'Trinidad and Tobago', 'TT', NULL, NULL),
(218, 'Tunisia', 'TN', NULL, NULL),
(219, 'Turkey', 'TR', NULL, NULL),
(220, 'Turkmenistan', 'TM', NULL, NULL),
(221, 'Turks and Caicos Islands', 'TC', NULL, NULL),
(222, 'Tuvalu', 'TV', NULL, NULL),
(223, 'Uganda', 'UG', NULL, NULL),
(224, 'Ukraine', 'UA', NULL, NULL),
(225, 'United Arab Emirates', 'AE', NULL, NULL),
(226, 'United Kingdom', 'GB', NULL, NULL),
(227, 'United States minor outlying islands', 'UM', NULL, NULL),
(228, 'Uruguay', 'UY', NULL, NULL),
(229, 'Uzbekistan', 'UZ', NULL, NULL),
(230, 'Vanuatu', 'VU', NULL, NULL),
(231, 'Vatican City State', 'VA', NULL, NULL),
(232, 'Venezuela', 'VE', NULL, NULL),
(233, 'Vietnam', 'VN', NULL, NULL),
(234, 'Virgin Islands (British)', 'VG', NULL, NULL),
(235, 'Virgin Islands (U.S.)', 'VI', NULL, NULL),
(236, 'Wallis and Futuna Islands', 'WF', NULL, NULL),
(237, 'Western Sahara', 'EH', NULL, NULL),
(238, 'Yemen', 'YE', NULL, NULL),
(239, 'Yugoslavia', 'YU', NULL, NULL),
(240, 'Zaire', 'ZR', NULL, NULL),
(241, 'Zambia', 'ZM', NULL, NULL),
(242, 'Zimbabwe', 'ZW', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `user_id`, `first_name`, `last_name`, `email`, `phone`, `country_id`, `address`, `apartment`, `city`, `state`, `zip`, `note`, `created_at`, `updated_at`) VALUES
(3, 4, 'Dr. Camron', 'Miller', 'lonnie39@example.org', '3135925050', 1, '1234 Elm Street', 'Apt 567', 'new york', 'Los Angeles, CA 90001', '90001', NULL, '2025-03-04 11:57:01', '2025-03-04 11:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `customer_reviews`
--

CREATE TABLE `customer_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_reviews`
--

INSERT INTO `customer_reviews` (`id`, `user_id`, `product_id`, `rating`, `review_text`, `approved`, `created_at`, `updated_at`) VALUES
(2, 12, 1, 2, 'another test review', 1, '2025-03-06 09:58:45', '2025-03-06 09:58:45'),
(17, 21, 4, 1, 'Bad Quality', 1, '2025-03-08 04:40:47', '2025-03-08 04:40:47');

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
(4, '2025_01_18_070037_create_categories_table', 1),
(5, '2025_01_18_110226_create_sub_categories_table', 1),
(6, '2025_01_19_122516_create_brands_table', 1),
(7, '2025_01_21_090916_create_products_table', 1),
(8, '2025_01_21_102418_create_product_categories_table', 1),
(9, '2025_01_21_115005_create_product_brands_table', 1),
(10, '2025_01_22_091208_create_product_images_table', 1),
(11, '2025_02_05_121315_create_whishlists_table', 1),
(12, '2025_02_08_073159_create_countries_table', 2),
(13, '2025_02_08_074008_create_customer_addresses_table', 3),
(14, '2025_02_08_095242_create_shippings_table', 4),
(15, '2025_02_08_102145_create_orders_table', 5),
(16, '2025_02_08_102313_create_order_items_table', 6),
(17, '2025_02_11_074037_alter_orders_table', 7),
(18, '2025_02_11_104202_create_personal_access_tokens_table', 8),
(19, '2025_03_05_124558_create_customer_reviews_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` double NOT NULL,
  `shipping` double NOT NULL,
  `coupen_code` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `payment_status` enum('paid','not paid') NOT NULL DEFAULT 'not paid',
  `status` enum('pending','shipped','delivered') NOT NULL DEFAULT 'pending',
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `subtotal`, `shipping`, `coupen_code`, `discount`, `grand_total`, `payment_status`, `status`, `first_name`, `last_name`, `email`, `phone`, `country_id`, `address`, `apartment`, `city`, `state`, `zip`, `note`, `created_at`, `updated_at`) VALUES
(27, 4, 43.48, 10, NULL, NULL, 53.48, 'paid', 'pending', 'Dr. Camron', 'Miller', 'lonnie39@example.org', '3135925050', 1, '1234 Elm Street', 'Apt 567', 'new york', 'Los Angeles, CA 90001', '90001', NULL, '2025-03-04 11:57:05', '2025-03-04 11:57:05'),
(28, 4, 200, 10, NULL, NULL, 210, 'paid', 'pending', 'Dr. Camron', 'Miller', 'lonnie39@example.org', '3135925050', 1, '1234 Elm Street', 'Apt 567', 'new york', 'Los Angeles, CA 90001', '90001', NULL, '2025-03-05 02:16:07', '2025-03-05 02:16:07'),
(29, 4, 200, 10, NULL, NULL, 210, 'paid', 'pending', 'Dr. Camron', 'Miller', 'lonnie39@example.org', '3135925050', 1, '1234 Elm Street', 'Apt 567', 'new york', 'Los Angeles, CA 90001', '90001', NULL, '2025-03-05 02:19:58', '2025-03-05 02:19:58'),
(30, 4, 0, 0, NULL, NULL, 0, 'not paid', 'pending', 'Dr. Camron', 'Miller', 'lonnie39@example.org', '3135925050', 1, '1234 Elm Street', 'Apt 567', 'new york', 'Los Angeles, CA 90001', '90001', NULL, '2025-03-05 02:20:58', '2025-03-05 02:20:58'),
(31, 4, 104.38, 20, NULL, NULL, 124.38, 'not paid', 'pending', 'Dr. Camron', 'Miller', 'lonnie39@example.org', '3135925050', 1, '1234 Elm Street', 'Apt 567', 'new york', 'Los Angeles, CA 90001', '90001', NULL, '2025-03-05 02:23:30', '2025-03-05 02:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `name`, `qty`, `price`, `total`, `created_at`, `updated_at`) VALUES
(29, 27, 3, 'Handball Spezial Shoes', 1, 43.48, 43.48, '2025-03-04 11:57:05', '2025-03-04 11:57:05'),
(30, 29, 1, 'Hooded thermal anorak', 1, 200, 200, '2025-03-05 02:19:58', '2025-03-05 02:19:58'),
(31, 31, 3, 'Handball Spezial Shoes', 1, 43.48, 43.48, '2025-03-05 02:23:31', '2025-03-05 02:23:31'),
(32, 31, 4, 'Diagonal Textured Cap', 1, 60.9, 60.9, '2025-03-05 02:23:31', '2025-03-05 02:23:31');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` double NOT NULL,
  `sale_price` double DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_featured` enum('yes','no') NOT NULL DEFAULT 'no',
  `sku` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `track_id` enum('yes','no') NOT NULL DEFAULT 'yes',
  `qty` int(11) DEFAULT NULL,
  `status` enum('publish','draft') NOT NULL DEFAULT 'publish',
  `short_desc` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `price`, `sale_price`, `user_id`, `is_featured`, `sku`, `barcode`, `track_id`, `qty`, `status`, `short_desc`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Hooded thermal anorak', 'hooded-thermal-anorak', '<p><span style=\"font-weight: 600;\">Nam tempus turpis at metus scelerisque placerat nulla deumantos solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo pharetras loremos.</span></p><h2 class=\"\" style=\"margin-right: 0px; margin-bottom: 12px; margin-left: 0px; line-height: 1.2; color: rgb(0, 0, 0);\"><font color=\"#111111\" face=\"Nunito Sans, sans-serif\"><span style=\"font-size: 20px;\">Products Infomation</span></font></h2><p class=\"\" style=\"margin-right: 0px; margin-bottom: 12px; margin-left: 0px; line-height: 1.2;\">A Pocket PC is a handheld computer, which features many of the same capabilities as a modern PC. These handy little devices allow individuals to retrieve and store e-mail messages, create a contact file, coordinate appointments, surf the internet, exchange text messages and more. Every product that is labeled as a Pocket PC must be accompanied with specific software to operate the unit and must feature a touchscreen and touchpad.<br>As is the case with any new technology product, the cost of a Pocket PC was substantial during it’s early release. For approximately $700.00, consumers could purchase one of top-of-the-line Pocket PCs in 2003. These days, customers are finding that prices have become much more reasonable now that the newness is wearing off. For approximately $350.00, a new Pocket PC can now be purchased.</p><h2 class=\"\" style=\"margin-right: 0px; margin-bottom: 12px; margin-left: 0px; line-height: 1.2; color: rgb(0, 0, 0);\"><font color=\"#111111\" face=\"Nunito Sans, sans-serif\"><span style=\"font-size: 20px;\">Material used</span></font></h2><p class=\"\" style=\"margin-right: 0px; margin-bottom: 12px; margin-left: 0px; line-height: 1.2;\">Polyester is deemed lower quality due to its none natural quality’s. Made from synthetic materials, not natural like wool. Polyester suits become creased easily and are known for not being breathable. Polyester suits tend to have a shine to them compared to wool and cotton suits, this can make the suit look cheap. The texture of velvet is luxurious and breathable. Velvet is a great choice for dinner party jacket and can be worn all year round.</p>', 270, 200, 1, 'no', 'SKU-20250206-67A47C1F69F0C', '486665209676', 'yes', 90, 'publish', 'Coat with quilted lining and an adjustable hood. Featuring long sleeves with adjustable cuff tabs, adjustable asymmetric hem with elastic side tabs and a front zip fastening with placket.', '1.png', '2025-02-06 03:59:28', '2025-03-05 02:19:58'),
(2, 'Piqué Biker Jacket', 'pique-biker-jacket', NULL, 67.24, NULL, 1, 'no', 'SKU-20250206-66E', '690395970646', 'yes', 7, 'publish', NULL, '2.jpg', '2025-02-06 07:52:42', '2025-03-05 02:30:05'),
(3, 'Handball Spezial Shoes', 'handball-spezial-shoes', '<h2 class=\"\">A style embraced by football fans and fashionistas, done in suede.</h2><p>First introduced in 1979 for elite handball players, these shoes are now beloved for their classic style. This version is built with a suede upper for a supple feel. A soft gum rubber outsole keeps them true to their vintage roots.</p>', 43.48, NULL, 1, 'no', 'SKU-20250206-E3B', '645871421917', 'yes', 2, 'publish', 'Collegiate Navy / Clear Sky / Gum', '3.jpg', '2025-02-06 07:53:49', '2025-03-05 02:30:04'),
(4, 'Diagonal Textured Cap', 'diagonal-textured-cap', NULL, 60.9, NULL, 1, 'no', 'SKU-20250206-B09', '712668915834', 'yes', 2, 'publish', NULL, '4.jpg', '2025-02-06 07:55:02', '2025-03-05 02:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE `product_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_brands`
--

INSERT INTO `product_brands` (`id`, `product_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 6, NULL, NULL),
(4, 4, 2, NULL, NULL),
(5, 4, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, NULL, NULL),
(2, 1, 1, NULL, NULL),
(3, 2, 21, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 2, 1, NULL, NULL),
(6, 3, 1, NULL, NULL),
(7, 3, 5, NULL, NULL),
(9, 4, 4, NULL, NULL),
(10, 4, 20, NULL, NULL),
(11, 4, 17, NULL, NULL),
(12, 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `gallery` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `gallery`, `created_at`, `updated_at`) VALUES
(1, 1, '1_1738832368_67a479f0c891c.png', '2025-02-06 03:59:28', '2025-02-06 03:59:28'),
(2, 1, '1_1738832368_67a479f0c9230.png', '2025-02-06 03:59:28', '2025-02-06 03:59:28'),
(3, 1, '1_1738832368_67a479f0c96dc.png', '2025-02-06 03:59:28', '2025-02-06 03:59:28'),
(4, 1, '1_1738832368_67a479f0c9a8b.png', '2025-02-06 03:59:29', '2025-02-06 03:59:29'),
(9, 3, '3_1738850621_67a4c13d3eca2.jpg', '2025-02-06 09:03:41', '2025-02-06 09:03:41'),
(10, 3, '3_1738850621_67a4c13d51384.jpg', '2025-02-06 09:03:41', '2025-02-06 09:03:41'),
(11, 3, '3_1738850621_67a4c13d57034.jpg', '2025-02-06 09:03:41', '2025-02-06 09:03:41');

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
('TqH30s2CDji28YR0GXP9na55iK1dkFILR1bb1GO9', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoia2E5RUNoYXMxaXE3amdLQ3NRcENCT2VpRWZCdmtIaEFwZkNTYWZTVSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL21hbGUtZmFzaGlvbi9wcm9maWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1741446612),
('TQZYmm2fNLLerayrDKfOCjQKSxPD1OZm3QY03y43', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMkhpSThiOWIyN2Ywa1lSQkl0Zjg3NW0zN21yT09KdmhxT0hoTkhvdiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3VzZXJzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo0OiJjYXJ0IjthOjE6e2k6MjtPOjI5OiJJbGx1bWluYXRlXFN1cHBvcnRcQ29sbGVjdGlvbiI6Mjp7czo4OiIAKgBpdGVtcyI7YToyOntzOjMyOiJiMmM1YTdjYTU2ZGU0YzUyNjdiOTY0Y2M5MWIyOTU1OSI7TzozMjoiR2xvdWRlbWFuc1xTaG9wcGluZ2NhcnRcQ2FydEl0ZW0iOjk6e3M6NToicm93SWQiO3M6MzI6ImIyYzVhN2NhNTZkZTRjNTI2N2I5NjRjYzkxYjI5NTU5IjtzOjI6ImlkIjtpOjE7czozOiJxdHkiO3M6MToiNCI7czo0OiJuYW1lIjtzOjIxOiJIb29kZWQgdGhlcm1hbCBhbm9yYWsiO3M6NToicHJpY2UiO2Q6MjcwO3M6Nzoib3B0aW9ucyI7TzozOToiR2xvdWRlbWFuc1xTaG9wcGluZ2NhcnRcQ2FydEl0ZW1PcHRpb25zIjoyOntzOjg6IgAqAGl0ZW1zIjthOjI6e3M6MTI6InByb2R1Y3RJbWFnZSI7czo1OiIxLnBuZyI7czo5OiJzYWxlUHJpY2UiO2Q6MjAwO31zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fXM6NDk6IgBHbG91ZGVtYW5zXFNob3BwaW5nY2FydFxDYXJ0SXRlbQBhc3NvY2lhdGVkTW9kZWwiO047czo0MToiAEdsb3VkZW1hbnNcU2hvcHBpbmdjYXJ0XENhcnRJdGVtAHRheFJhdGUiO2k6MjE7czo0MToiAEdsb3VkZW1hbnNcU2hvcHBpbmdjYXJ0XENhcnRJdGVtAGlzU2F2ZWQiO2I6MDt9czozMjoiMmM0NGI5MWY5OTdjNzlkMmViNWYzNGM3NzY2YzY5YTAiO086MzI6Ikdsb3VkZW1hbnNcU2hvcHBpbmdjYXJ0XENhcnRJdGVtIjo5OntzOjU6InJvd0lkIjtzOjMyOiIyYzQ0YjkxZjk5N2M3OWQyZWI1ZjM0Yzc3NjZjNjlhMCI7czoyOiJpZCI7aTo0O3M6MzoicXR5IjtzOjE6IjMiO3M6NDoibmFtZSI7czoyMToiRGlhZ29uYWwgVGV4dHVyZWQgQ2FwIjtzOjU6InByaWNlIjtkOjYwLjk7czo3OiJvcHRpb25zIjtPOjM5OiJHbG91ZGVtYW5zXFNob3BwaW5nY2FydFxDYXJ0SXRlbU9wdGlvbnMiOjI6e3M6ODoiACoAaXRlbXMiO2E6Mjp7czoxMjoicHJvZHVjdEltYWdlIjtzOjU6IjQuanBnIjtzOjk6InNhbGVQcmljZSI7aTowO31zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fXM6NDk6IgBHbG91ZGVtYW5zXFNob3BwaW5nY2FydFxDYXJ0SXRlbQBhc3NvY2lhdGVkTW9kZWwiO047czo0MToiAEdsb3VkZW1hbnNcU2hvcHBpbmdjYXJ0XENhcnRJdGVtAHRheFJhdGUiO2k6MjE7czo0MToiAEdsb3VkZW1hbnNcU2hvcHBpbmdjYXJ0XENhcnRJdGVtAGlzU2F2ZWQiO2I6MDt9fXM6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1741521182);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'rest_of_world', 10, '2025-02-08 11:15:57', '2025-02-08 11:15:57'),
(6, '164', 0, '2025-02-15 06:01:36', '2025-02-15 06:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `status` enum('active','block') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `role` enum('admin','manager','customer') NOT NULL DEFAULT 'customer',
  `status` enum('active','banned') NOT NULL DEFAULT 'active',
  `avatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `phone`, `role`, `status`, `avatar`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '12345678901', 'admin', 'active', '1.jpeg', '$2y$12$X5iYMOBwfF5HBZm/ECrNoO4UqJ0spmslNopVXbz4L3EJ/7YdXTqVi', '9AReP5k4IET1M9VsrZXDk4aWGTHqJTkw3yQomgwUYP7aJoql8K05r7mTLmwm', '2025-02-06 03:19:16', '2025-03-09 06:53:01'),
(4, 'Customer', 'lonnie39@example.org', '2025-03-04 11:48:48', '313.592.5050', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'xGv4ggse1p6Ia3rKh9sMrlFXkKvP0kYoD6OcaGLX793ZU5dnrOjIleSNhy70', '2025-03-04 11:48:49', '2025-03-04 11:48:49'),
(5, 'Dr. Gordon Volkman', 'kyra.hand@example.net', '2025-03-04 11:48:49', '+1.308.445.4822', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'oyl2o7pfox', '2025-03-04 11:48:49', '2025-03-04 11:48:49'),
(6, 'Cordelia Lubowitz', 'gkuhn@example.org', '2025-03-04 11:48:49', '+1.480.363.9762', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'EavRBEcSzb', '2025-03-04 11:48:49', '2025-03-04 11:48:49'),
(7, 'Dr. Domenick Skiles II', 'chanel81@example.net', '2025-03-04 11:48:49', '+1-386-675-3267', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'jhn05Isru3', '2025-03-04 11:48:49', '2025-03-04 11:48:49'),
(8, 'Newell Kerluke', 'collins.leif@example.org', '2025-03-04 11:48:49', '(757) 347-7808', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '5PL6EWwu8m', '2025-03-04 11:48:49', '2025-03-04 11:48:49'),
(9, 'Ms. Loma Dickens IV', 'kmuller@example.org', '2025-03-04 11:48:49', '+1-929-749-4835', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'oZNGvywKxG', '2025-03-04 11:48:49', '2025-03-04 11:48:49'),
(10, 'Alexane Yundt', 'watsica.lyda@example.net', '2025-03-04 11:48:49', '(941) 466-6946', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '7W0tPP1Ug6', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(11, 'Novella Hand II', 'zulauf.eldridge@example.org', '2025-03-04 11:48:49', '706.477.8668', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'C6oenIgDQH', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(12, 'Mr. Darian Nicolas', 'okon.chanel@example.org', '2025-03-04 11:48:49', '(813) 914-0680', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '5mdZJCcQMz', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(13, 'Concepcion Nikolaus IV', 'jkerluke@example.org', '2025-03-04 11:48:49', '(520) 964-1172', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'av7g6FuX5B', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(14, 'Michelle Koss', 'oweber@example.net', '2025-03-04 11:48:49', '+1-860-912-7841', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'HnaxUeKNUX', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(15, 'Myah Howell', 'trantow.marquis@example.org', '2025-03-04 11:48:49', '214-989-7472', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'mQPIVtmWNt', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(16, 'Bill Schuster', 'june.zemlak@example.org', '2025-03-04 11:48:49', '+1-662-780-2098', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '17uitM9uF9', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(17, 'Prof. Sam Sawayn', 'jbergstrom@example.org', '2025-03-04 11:48:49', '469-226-5914', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'IZQgNSekMJ', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(18, 'Ransom Rath', 'treutel.eldon@example.org', '2025-03-04 11:48:49', '1-713-457-6431', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'jNfuUWwPO4', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(19, 'Oran Schoen', 'curtis56@example.net', '2025-03-04 11:48:49', '218-203-6680', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'h3H3FC2MBT', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(20, 'Pinkie Hodkiewicz', 'gnienow@example.net', '2025-03-04 11:48:49', '+1.813.277.9993', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'zox3xtF158', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(21, 'Aditya Hoeger', 'monahan.myron@example.net', '2025-03-04 11:48:49', '820.687.2746', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'sOHFMCqQwB', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(22, 'Korbin Dibbert', 'kiehn.mortimer@example.org', '2025-03-04 11:48:49', '930.793.7548', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'oGCzPe6HES', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(23, 'Mrs. Jewell Donnelly III', 'goodwin.donnell@example.com', '2025-03-04 11:48:49', '+18487392129', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '9hRcjyjTYz', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(24, 'Brant Ledner', 'april.buckridge@example.com', '2025-03-04 11:48:49', '+1-336-672-7763', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'GwUIr99fmw', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(25, 'Tiara Kuhic', 'kautzer.edwardo@example.org', '2025-03-04 11:48:49', '1-425-564-6305', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'KdakCq7o5d', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(26, 'Mr. Edwin Wintheiser', 'roob.mitchell@example.net', '2025-03-04 11:48:49', '910.668.2465', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'L6NR9w9EDo', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(27, 'Howard Wilkinson III', 'lgleichner@example.com', '2025-03-04 11:48:49', '+1 (854) 963-1846', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'rwfgzhYrsa', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(28, 'Danyka Mohr DDS', 'upouros@example.net', '2025-03-04 11:48:49', '1-806-569-5931', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'jY9Y5l0Mh4', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(29, 'Seamus Gutkowski', 'jo.cole@example.com', '2025-03-04 11:48:49', '(458) 423-8114', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'zE0GTiY9Lk', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(30, 'Harmon Quitzon', 'reanna.lang@example.net', '2025-03-04 11:48:49', '+1-262-550-7744', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'znVIED8vX3', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(31, 'Ivah O\'Connell', 'jacobson.frank@example.com', '2025-03-04 11:48:49', '+1.401.232.3088', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'YDUh5VMKf4', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(32, 'Mr. Davon Kutch Jr.', 'rae.littel@example.com', '2025-03-04 11:48:49', '803-451-5532', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'ldRWBrP9md', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(33, 'Rosanna Welch', 'zita.carter@example.net', '2025-03-04 11:48:49', '+1.239.930.0117', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '93f703tScT', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(34, 'Prof. Heber Witting PhD', 'mlarson@example.org', '2025-03-04 11:48:49', '+1 (541) 447-8869', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'uBCA5xVl5y', '2025-03-04 11:48:50', '2025-03-04 11:48:50'),
(35, 'Elliot Conroy', 'carole44@example.org', '2025-03-04 11:48:49', '+1 (586) 357-7957', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'Q4SgYkQy8t', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(36, 'Florence Wisozk', 'benjamin.konopelski@example.com', '2025-03-04 11:48:49', '+1 (870) 609-3043', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'M1ycKdLawp', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(37, 'Mr. Rey Deckow', 'bettie.kozey@example.com', '2025-03-04 11:48:49', '669-476-0417', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 't571Ry8TZo', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(38, 'Ara Hill II', 'twiegand@example.org', '2025-03-04 11:48:49', '1-215-579-0519', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'eghRLLjxWY', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(39, 'Brooklyn Lehner', 'quigley.jamaal@example.net', '2025-03-04 11:48:49', '1-941-619-8879', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'rYwiw8p1LY', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(40, 'Mr. Laurel Donnelly PhD', 'cjacobi@example.net', '2025-03-04 11:48:49', '+13857528610', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'TR2EDqqBFc', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(41, 'Alisha Hegmann', 'emile64@example.org', '2025-03-04 11:48:49', '+1-445-771-0638', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'MqyBOZBnYj', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(42, 'Jenifer Konopelski DDS', 'marks.norris@example.com', '2025-03-04 11:48:49', '1-516-234-5033', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '6RxYkY0pKn', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(43, 'Ed Bednar', 'conn.ladarius@example.net', '2025-03-04 11:48:49', '530.367.4799', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'YRAw88PHjL', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(44, 'Kale Jaskolski V', 'natasha.wuckert@example.com', '2025-03-04 11:48:49', '402.853.3078', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '98eWYg6FJq', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(45, 'Lue Weimann Sr.', 'hayes.karlie@example.com', '2025-03-04 11:48:49', '1-517-253-2459', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'lXPOpwsgPI', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(46, 'Antonia Koch', 'reed93@example.net', '2025-03-04 11:48:49', '914.964.5251', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '40Uid6fd9Z', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(47, 'Dasia Simonis', 'aditya.mayer@example.com', '2025-03-04 11:48:49', '564-997-8033', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'gs77i6MMCa', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(48, 'Keanu Murray I', 'zelda.hoeger@example.org', '2025-03-04 11:48:49', '(239) 346-5690', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'lQ2HPQd3ON', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(49, 'Dr. Emile Steuber', 'lrowe@example.com', '2025-03-04 11:48:49', '732-887-7180', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'JcP3ijI2TS', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(50, 'Colton Franecki', 'buckridge.tess@example.net', '2025-03-04 11:48:49', '+12813907530', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'Ihg450kEOp', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(51, 'Sharon Gleichner', 'percival86@example.org', '2025-03-04 11:48:49', '231.516.6733', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'O0pfkzpj1O', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(52, 'Laurie Quitzon I', 'ines.hirthe@example.net', '2025-03-04 11:48:49', '607-940-0770', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'p1s2lAMm7u', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(53, 'Garnett Schaden', 'dameon82@example.org', '2025-03-04 11:48:49', '1-413-765-4076', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'aXDD3H1xT2', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(54, 'Mrs. Maegan Rolfson', 'qhansen@example.com', '2025-03-04 11:48:49', '910-584-8287', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'fgpNjxdUvz', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(55, 'Amiya Paucek', 'schumm.micheal@example.org', '2025-03-04 11:48:49', '1-678-521-2404', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'PUjgs9sNVv', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(56, 'Eldon Vandervort', 'otha80@example.com', '2025-03-04 11:48:49', '1-410-664-9301', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'LVRq3TIuIp', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(57, 'Osborne Dickens', 'schoen.clifford@example.com', '2025-03-04 11:48:49', '1-601-661-6021', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'zRyvQ7of11', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(58, 'Mr. Paolo Rogahn', 'senger.lura@example.org', '2025-03-04 11:48:49', '828.514.4006', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'CgauAytElL', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(59, 'Hipolito Heaney', 'dgerhold@example.com', '2025-03-04 11:48:49', '(724) 432-2662', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'kREmfmrvTX', '2025-03-04 11:48:51', '2025-03-04 11:48:51'),
(60, 'Freeda Jacobi', 'robel.crystal@example.com', '2025-03-04 11:48:49', '+1-856-864-8989', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'Ke15NltVHf', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(61, 'Deron Bauch', 'rvolkman@example.net', '2025-03-04 11:48:49', '+1-907-888-0864', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'wNwttC7IJy', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(62, 'Nicola Stoltenberg I', 'roberts.elmer@example.net', '2025-03-04 11:48:49', '570-892-9963', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'lpg8QFWYTD', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(63, 'Julius Parisian DVM', 'predovic.taryn@example.com', '2025-03-04 11:48:49', '(269) 853-1966', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'lvn9ewNJfg', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(64, 'Rhiannon Marquardt', 'wlang@example.net', '2025-03-04 11:48:49', '828-971-7983', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '0T5OxJ2AAr', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(65, 'Devin Jacobs Sr.', 'kulas.nellie@example.org', '2025-03-04 11:48:49', '+1.928.882.6747', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'UqpOdft6al', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(66, 'Charlotte Keeling', 'emma.murray@example.net', '2025-03-04 11:48:49', '(732) 409-5175', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '5Yqv3nFNfr', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(67, 'Dr. Rashad Tromp DDS', 'romaguera.carli@example.org', '2025-03-04 11:48:49', '(714) 296-4937', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'ze1FUEjupt', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(68, 'Cora Blick', 'medhurst.ezra@example.com', '2025-03-04 11:48:49', '814.502.3509', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'hxV93eX6VJ', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(69, 'Deonte Smitham', 'katelin.brakus@example.com', '2025-03-04 11:48:49', '970.940.8652', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'mrQ3R1rg57', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(70, 'Kobe Hahn MD', 'imante@example.org', '2025-03-04 11:48:49', '+1-508-639-3349', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'z3bA4wKRNU', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(71, 'Alva Kuphal', 'taylor93@example.net', '2025-03-04 11:48:49', '1-330-295-8258', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'vBfiWFPy1m', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(72, 'Clair Luettgen', 'francisca.tremblay@example.net', '2025-03-04 11:48:49', '+1.225.307.6562', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '9SMGEjl6mx', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(73, 'William Lindgren', 'will.laurie@example.org', '2025-03-04 11:48:49', '724.709.9391', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '892sQ5xqVr', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(74, 'Kristoffer Block', 'gilbert88@example.org', '2025-03-04 11:48:49', '+1-360-813-1262', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '7vTdvihRLg', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(75, 'Georgianna Rosenbaum', 'kailyn.keebler@example.net', '2025-03-04 11:48:49', '+1-615-748-9514', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'QSJ1oBUKDu', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(76, 'Evert Beahan', 'gorczany.gwendolyn@example.net', '2025-03-04 11:48:49', '+1-947-855-0550', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '07w7Q4PyAW', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(77, 'Jovany Roberts', 'elfrieda.friesen@example.com', '2025-03-04 11:48:49', '857-238-4086', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'NnDS0hDbx9', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(78, 'Vance Beer', 'collier.megane@example.net', '2025-03-04 11:48:49', '1-516-413-4453', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'PboyeY4xGA', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(79, 'Brandt Mayer', 'meaghan.bruen@example.com', '2025-03-04 11:48:49', '+1.520.323.7985', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'oHsXlmOFWg', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(80, 'Colten Funk', 'zdaniel@example.com', '2025-03-04 11:48:49', '863-860-6323', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '1Nhx045GYg', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(81, 'Florine Connelly', 'habernathy@example.org', '2025-03-04 11:48:49', '1-423-299-9305', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'mSZ3poix3g', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(82, 'Dallas Towne', 'fadel.elisha@example.com', '2025-03-04 11:48:49', '+14305021856', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '6gZrDpqSjJ', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(83, 'Matilda Runte', 'stokes.berniece@example.net', '2025-03-04 11:48:49', '380.695.4425', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'atrVtYXpMM', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(84, 'Aleen Jakubowski', 'alexzander.quigley@example.org', '2025-03-04 11:48:49', '732-813-9000', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'baO6fxH2pF', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(85, 'Dr. Mackenzie Miller', 'shaun.welch@example.net', '2025-03-04 11:48:49', '954-718-7462', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'TJwkfd5N1V', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(86, 'Jude Schmidt', 'katherine.berge@example.com', '2025-03-04 11:48:49', '(720) 761-1003', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'eAe5WkRWMu', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(87, 'Willa Rippin', 'lizeth95@example.net', '2025-03-04 11:48:49', '689-398-2405', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'HVeVjpX2mW', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(88, 'Estell Ebert', 'kshlerin.luella@example.org', '2025-03-04 11:48:49', '1-618-544-5953', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'OmuiT1q1GJ', '2025-03-04 11:48:52', '2025-03-04 11:48:52'),
(89, 'Chaya Rosenbaum V', 'abbott.luis@example.org', '2025-03-04 11:48:49', '+1-283-415-2513', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', '48UbHJ9r4i', '2025-03-04 11:48:53', '2025-03-04 11:48:53'),
(90, 'Sheila McCullough V', 'senger.rex@example.org', '2025-03-04 11:48:49', '+19724944537', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'KGnWjHE5EM', '2025-03-04 11:48:53', '2025-03-04 11:48:53'),
(91, 'Taryn Gutmann', 'nauer@example.net', '2025-03-04 11:48:49', '+1.458.879.1343', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'mnGVfne76y', '2025-03-04 11:48:53', '2025-03-04 11:48:53'),
(92, 'Jarrett Pouros', 'kmoen@example.com', '2025-03-04 11:48:49', '+1.323.265.1141', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'T6zPyyS2wa', '2025-03-04 11:48:53', '2025-03-04 11:48:53'),
(93, 'Gerardo Hane', 'jacobson.jules@example.org', '2025-03-04 11:48:49', '430.354.1409', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'ZRm8vYefpX', '2025-03-04 11:48:53', '2025-03-04 11:48:53'),
(94, 'Alivia Spinka', 'lucio54@example.com', '2025-03-04 11:48:49', '772-982-2746', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'Oam4Pl87ee', '2025-03-04 11:48:53', '2025-03-04 11:48:53'),
(95, 'Dixie Upton', 'cielo.grant@example.org', '2025-03-04 11:48:49', '952.561.0007', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'b8ntpkJDuf', '2025-03-04 11:48:53', '2025-03-04 11:48:53'),
(96, 'Peggie Senger', 'laisha93@example.org', '2025-03-04 11:48:49', '+1.779.715.2489', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'uUTWe1J7JG', '2025-03-04 11:48:53', '2025-03-04 11:48:53'),
(97, 'Dr. Lura Jones', 'spencer.yasmine@example.net', '2025-03-04 11:48:49', '734-479-9141', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'pIrTBpPWhp', '2025-03-04 11:48:53', '2025-03-04 11:48:53'),
(98, 'Sheila Emard', 'sierra.reynolds@example.com', '2025-03-04 11:48:49', '+1-575-392-6310', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'B04e1rUOgj', '2025-03-04 11:48:53', '2025-03-04 11:48:53'),
(99, 'Carlotta Koelpin', 'sabryna.pagac@example.com', '2025-03-04 11:48:49', '662.925.8185', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'ZV8O8y3SeM', '2025-03-04 11:48:53', '2025-03-04 11:48:53'),
(100, 'Cory McCullough', 'whudson@example.org', '2025-03-04 11:48:49', '559-352-5959', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'VPog05T2j7', '2025-03-04 11:48:53', '2025-03-04 11:48:53'),
(101, 'Elza Shanahan', 'cartwright.hobart@example.net', '2025-03-04 11:48:49', '+1-260-685-7199', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'LqFCwaN7So', '2025-03-04 11:48:53', '2025-03-04 11:48:53'),
(102, 'Melyna Kris V', 'eryan@example.net', '2025-03-04 11:48:49', '(907) 735-4526', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'b2jPfoeHjw', '2025-03-04 11:48:53', '2025-03-04 11:48:53'),
(103, 'Lonnie Von PhD', 'xkovacek@example.net', '2025-03-04 11:48:49', '+1 (848) 236-5186', 'customer', 'active', NULL, '$2y$12$Q.QYPTG21q9A/u.Djqte1.riNjR4SGN3fbmPxaItVqxrEV307r5NS', 'RbkqTMatTK', '2025-03-04 11:48:53', '2025-03-04 11:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `whishlists`
--

CREATE TABLE `whishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `is_favorite` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_user_id_foreign` (`user_id`),
  ADD KEY `customer_addresses_country_id_foreign` (`country_id`);

--
-- Indexes for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_reviews_user_id_foreign` (`user_id`),
  ADD KEY `customer_reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_country_id_foreign` (`country_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_brands_product_id_foreign` (`product_id`),
  ADD KEY `product_brands_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_categories_product_id_foreign` (`product_id`),
  ADD KEY `product_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `whishlists`
--
ALTER TABLE `whishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `whishlists_user_id_foreign` (`user_id`),
  ADD KEY `whishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_brands`
--
ALTER TABLE `product_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `whishlists`
--
ALTER TABLE `whishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  ADD CONSTRAINT `customer_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD CONSTRAINT `product_brands_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_brands_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `whishlists`
--
ALTER TABLE `whishlists`
  ADD CONSTRAINT `whishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `whishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
