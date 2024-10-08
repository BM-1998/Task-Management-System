-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 11:05 AM
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
-- Database: `task_management`
--

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_02_163557_create_tasks_table', 1),
(6, '2024_10_03_183051_add_priority_to_tasks_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'authToken', '3572397231a00120c02edf154bb9ef8f7c46b6192c5a447cc76beaeabf3c2fe1', '[\"*\"]', '2024-10-02 12:40:51', '2024-10-02 12:36:58', '2024-10-02 12:40:51'),
(2, 'App\\Models\\User', 1, 'authToken', '8588bed85677e3456135b03787ff9bc8238b5b030402ec353f3b1c02cbb23c64', '[\"*\"]', '2024-10-03 03:21:01', '2024-10-02 12:48:35', '2024-10-03 03:21:01'),
(3, 'App\\Models\\User', 2, 'authToken', 'ff765424308920ffdb9f381dfc3de645231e021cc802daba38e4916b2708d1d8', '[\"*\"]', '2024-10-02 23:30:48', '2024-10-02 23:12:30', '2024-10-02 23:30:48'),
(4, 'App\\Models\\User', 1, 'authToken', 'ecdc7c1b89c0991be4bb680a14c0654b67aacf4d5cdf9abed372fd6ee05ec8a5', '[\"*\"]', '2024-10-04 08:56:52', '2024-10-02 23:30:57', '2024-10-04 08:56:52'),
(5, 'App\\Models\\User', 1, 'authToken', '9b4bcefc9bfe32c269228955247155827824e6e56635e3e09c202ed803e59de1', '[\"*\"]', NULL, '2024-10-03 02:38:40', '2024-10-03 02:38:40'),
(6, 'App\\Models\\User', 1, 'authToken', '1d0ed1f403efc23de8fb29752eaa65bb4f451f22c0c5f68759a71c9c8faa1317', '[\"*\"]', NULL, '2024-10-03 02:55:13', '2024-10-03 02:55:13'),
(7, 'App\\Models\\User', 1, 'authToken', 'dc12081ac42aba304c4b0d48893a65f9647da92a364c4bd848858a4595c37c99', '[\"*\"]', NULL, '2024-10-03 02:55:44', '2024-10-03 02:55:44'),
(8, 'App\\Models\\User', 1, 'authToken', 'b27c9647429c921881dd57ca064304ad4a9ed952890081f529b28b795c512e13', '[\"*\"]', NULL, '2024-10-03 02:56:38', '2024-10-03 02:56:38'),
(9, 'App\\Models\\User', 1, 'authToken', '07c4fd8ac0a5f44eac640d05ee916ac923fe0bd05fc2a41f32cf35a377ade227', '[\"*\"]', NULL, '2024-10-03 02:58:27', '2024-10-03 02:58:27'),
(10, 'App\\Models\\User', 1, 'authToken', 'ef6de0fb1e924823e650cc24dc165cffb7185793c2437024fc06fa9288bdb5e5', '[\"*\"]', NULL, '2024-10-03 02:58:41', '2024-10-03 02:58:41'),
(11, 'App\\Models\\User', 1, 'authToken', 'fbb82efc57ecae580b4e2aa10e0a402e75f508e7bbb61bb060850abd3e1e26a1', '[\"*\"]', NULL, '2024-10-03 03:00:02', '2024-10-03 03:00:02'),
(12, 'App\\Models\\User', 1, 'authToken', '8c136b21daf61cc093b7dbc7d2b302098b5ee58f4616971a0afa48c840eb36ab', '[\"*\"]', NULL, '2024-10-03 04:13:56', '2024-10-03 04:13:56'),
(13, 'App\\Models\\User', 1, 'authToken', 'b8c024d6f62223bbe35299d28b3e0d8b9767331b519b2cee9557ac72877b40fb', '[\"*\"]', NULL, '2024-10-03 05:58:25', '2024-10-03 05:58:25'),
(14, 'App\\Models\\User', 1, 'authToken', '762237149f1af43fe476342498bcc51819279f17dc7c309754be9d2d98dc19f3', '[\"*\"]', NULL, '2024-10-03 07:54:57', '2024-10-03 07:54:57'),
(15, 'App\\Models\\User', 1, 'authToken', '5da9a03c6ce78a0c9d9b279c22da97ff55aeeec47173eb68002024a99097e63e', '[\"*\"]', NULL, '2024-10-03 08:35:04', '2024-10-03 08:35:04'),
(16, 'App\\Models\\User', 2, 'authToken', 'e9dc54afcd7cef23309a4741c763c62036b342684e698d2e4a683dfaec3ee839', '[\"*\"]', NULL, '2024-10-03 13:40:31', '2024-10-03 13:40:31'),
(17, 'App\\Models\\User', 1, 'authToken', '3e31f3c2e4c98fdd4215f78c31a70d3f1a9b2747eb3f0bdcfb85fb8e4763ab66', '[\"*\"]', NULL, '2024-10-03 13:43:47', '2024-10-03 13:43:47'),
(18, 'App\\Models\\User', 2, 'authToken', 'b6fe90491c99d5e3eea65a931663eac8d424ebc0dbc189b099c04cfe09227b4f', '[\"*\"]', NULL, '2024-10-03 13:44:11', '2024-10-03 13:44:11'),
(19, 'App\\Models\\User', 1, 'authToken', 'b9d0830cb3e0cfb2681511074cba80ca9410fd0dfde27b7f4b29bdf39a2346c4', '[\"*\"]', NULL, '2024-10-03 14:03:19', '2024-10-03 14:03:19'),
(20, 'App\\Models\\User', 2, 'authToken', '411c7a2379a0b9f952ff5c01b17a425a70225f5896b92a4456775b31d96b4f03', '[\"*\"]', NULL, '2024-10-03 14:03:40', '2024-10-03 14:03:40'),
(21, 'App\\Models\\User', 2, 'authToken', '2728c50736d53dae653b0c96db093d4074d75f59c4e269505f99d99b06ec166f', '[\"*\"]', NULL, '2024-10-03 14:07:18', '2024-10-03 14:07:18'),
(22, 'App\\Models\\User', 2, 'authToken', '05a7049a8e4373a60bca1179ae66d4b2866a5e5f28d1f057fbacfa712ef7fbf2', '[\"*\"]', NULL, '2024-10-03 22:24:21', '2024-10-03 22:24:21'),
(23, 'App\\Models\\User', 2, 'authToken', 'e248b3361e81912151276b92cb7cc30c671b720b891e967789cb678e48082249', '[\"*\"]', NULL, '2024-10-03 22:24:45', '2024-10-03 22:24:45'),
(24, 'App\\Models\\User', 2, 'authToken', '5f015712ce189521468a13e330f85e014fc8ec1dc012b8ab80e35750ca27e9e2', '[\"*\"]', NULL, '2024-10-03 22:28:07', '2024-10-03 22:28:07'),
(25, 'App\\Models\\User', 2, 'authToken', '316e47d7aa5d23c7b1e065680d3f293bf7d19b0cbfae04d5befd8f4567223f78', '[\"*\"]', NULL, '2024-10-03 22:43:08', '2024-10-03 22:43:08'),
(26, 'App\\Models\\User', 1, 'authToken', '2d79d65c6c1869e24452c1adea975ce0a2c38f7778943dec4be5b9e2e174ae4d', '[\"*\"]', NULL, '2024-10-03 22:49:39', '2024-10-03 22:49:39'),
(27, 'App\\Models\\User', 1, 'authToken', 'e7581137a346689b962f2c8d89ca94c532cc850050d7e8a30bb898bf158865f3', '[\"*\"]', NULL, '2024-10-03 22:50:22', '2024-10-03 22:50:22'),
(28, 'App\\Models\\User', 2, 'authToken', 'fba82654e5029558789354d3acaf2a269038004d228777921d369fddab8cf9db', '[\"*\"]', NULL, '2024-10-03 23:04:25', '2024-10-03 23:04:25'),
(29, 'App\\Models\\User', 1, 'authToken', '3b7eb557ad2f07f25a77c13d13e3ba3edcb2ec7ab8e4ffbcc6d7d07076898864', '[\"*\"]', '2024-10-04 08:12:23', '2024-10-03 23:47:54', '2024-10-04 08:12:23'),
(30, 'App\\Models\\User', 2, 'authToken', 'de94952c02fe1e2ddf6d565562c5f17c4d27dfa826d87991f5d32fb8130e8b3e', '[\"*\"]', NULL, '2024-10-04 08:13:21', '2024-10-04 08:13:21'),
(31, 'App\\Models\\User', 1, 'authToken', '780431e56d20d531bea129618e546bef885a424fe7ed18fb783865f9810b4dff', '[\"*\"]', NULL, '2024-10-04 08:36:55', '2024-10-04 08:36:55'),
(32, 'App\\Models\\User', 2, 'authToken', '7a88a7fbe248c2e0482543297572f727ee49b02c4922416772f32b8abeb71b06', '[\"*\"]', NULL, '2024-10-04 08:50:24', '2024-10-04 08:50:24'),
(33, 'App\\Models\\User', 1, 'authToken', '645f5af3178c6997575edf6e51f62f4fa21e810a9d4263b8bd64974be539f71a', '[\"*\"]', NULL, '2024-10-04 08:55:06', '2024-10-04 08:55:06'),
(34, 'App\\Models\\User', 2, 'authToken', '50376b4fc0b2b935c448afdab8361ee5e79b8705af78c617c989bbe531938896', '[\"*\"]', NULL, '2024-10-04 08:59:18', '2024-10-04 08:59:18'),
(35, 'App\\Models\\User', 1, 'authToken', '95e54d8dfdfb93608c390d4d907aad84a4f5d73b96e62bb8989429ee9377f569', '[\"*\"]', NULL, '2024-10-04 09:08:47', '2024-10-04 09:08:47'),
(36, 'App\\Models\\User', 2, 'authToken', 'daeb5e7308eb3c505306c501c92d9d4daf58cdc1d4d23567b7351b5e81d7a3db', '[\"*\"]', NULL, '2024-10-04 09:09:12', '2024-10-04 09:09:12'),
(37, 'App\\Models\\User', 1, 'authToken', '62c87842beb174160136af101c3854c1eff72ee1e5085263467b3a3425a37884', '[\"*\"]', NULL, '2024-10-04 09:42:03', '2024-10-04 09:42:03'),
(38, 'App\\Models\\User', 1, 'authToken', '30ce6d22c1d08f32e0e31d13076b25683f7e454f0c3669825e179f66870c9a3f', '[\"*\"]', NULL, '2024-10-04 09:42:36', '2024-10-04 09:42:36'),
(39, 'App\\Models\\User', 1, 'authToken', '97c20b07ee86e20f54a3907faaaa9e46d6e0f51585c808dbde5e395522276ab2', '[\"*\"]', NULL, '2024-10-04 09:43:53', '2024-10-04 09:43:53'),
(40, 'App\\Models\\User', 1, 'authToken', 'f47e72982bf14126a76573896471c0bce2a79980c11974c5336e92c98a2624b6', '[\"*\"]', NULL, '2024-10-04 09:44:16', '2024-10-04 09:44:16'),
(41, 'App\\Models\\User', 1, 'authToken', 'ac2ab0a77994081e612535ae2b9edca3d3fdbbcfa3276bb0e0c56a4539aee566', '[\"*\"]', NULL, '2024-10-04 09:50:13', '2024-10-04 09:50:13'),
(42, 'App\\Models\\User', 1, 'authToken', 'b5691045ce87226aad69f2daee197a0c8959d206e6f210c93fb0132f76436fd3', '[\"*\"]', NULL, '2024-10-04 09:50:36', '2024-10-04 09:50:36'),
(43, 'App\\Models\\User', 1, 'authToken', '55197eae4309cdd57245383feb0f1006cfa709b9602e4e50f359b0f3d39848ad', '[\"*\"]', NULL, '2024-10-04 09:51:04', '2024-10-04 09:51:04'),
(44, 'App\\Models\\User', 1, 'authToken', '4c173af8f583e3b71f9c8f6265c49c8b7b4673f9c1197077462b87f017b67574', '[\"*\"]', NULL, '2024-10-04 09:52:25', '2024-10-04 09:52:25'),
(45, 'App\\Models\\User', 1, 'authToken', 'a7afdf26581861ad2c765ae3e62355174896e48114acd06a976fb5fa0039274e', '[\"*\"]', NULL, '2024-10-04 09:53:33', '2024-10-04 09:53:33'),
(46, 'App\\Models\\User', 1, 'authToken', '738807cf7851b75fed4f78935981b842cbe38b19f4ce8e4790b444e15d93b5a1', '[\"*\"]', NULL, '2024-10-04 09:55:34', '2024-10-04 09:55:34'),
(47, 'App\\Models\\User', 2, 'authToken', '9348c504e18800bcdd0c31982e1843a9e0697198f420b717758b2912eb821d60', '[\"*\"]', NULL, '2024-10-04 09:55:44', '2024-10-04 09:55:44'),
(48, 'App\\Models\\User', 1, 'authToken', '3d841a51b0210c4b12e64feff72c263cf419f50b07cb75f43c5e959aef3967ce', '[\"*\"]', NULL, '2024-10-04 09:56:13', '2024-10-04 09:56:13'),
(49, 'App\\Models\\User', 2, 'authToken', 'cb80999d677828bbe72385b62e139e4d9a89dc1583bf79ccba296fead6ab883d', '[\"*\"]', NULL, '2024-10-04 10:05:33', '2024-10-04 10:05:33'),
(50, 'App\\Models\\User', 1, 'authToken', '4bd72845d7eee09fb3477da1d9e3c15661f985221481570d33206babf31e62b6', '[\"*\"]', NULL, '2024-10-08 03:33:32', '2024-10-08 03:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Assigned',
  `priority` varchar(255) NOT NULL DEFAULT 'Medium',
  `created_on` timestamp NULL DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `status`, `priority`, `created_on`, `assigned_to`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'TASK1', 'test133', 'Assigned', 'Medium', NULL, 4, 1, '2024-10-08 03:34:50', '2024-10-08 03:34:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Usertest', 'admin@example.com', NULL, '$2y$10$lEblEJ7f2D2xyUvIfmNRyO0P9PrxlxF1LblRve6tN6AY.ECtkensq', 'admin', NULL, '2024-10-02 12:30:49', '2024-10-03 11:50:44'),
(2, 'Normal User', 'user@example.com', NULL, '$2y$10$maxw/Nu2xSTh4EynwDNogOjj9Y8/u1bOCvP6ouokbtWissMZsqsXK', 'user', NULL, '2024-10-02 12:30:49', '2024-10-02 12:30:49'),
(4, 'baban', 'baban@gmail.com', NULL, '$2y$10$kr6QYpfmbB71kbjkJyrqSeblYxv6SAluj45oKznR/dPZg5o3eDkRK', 'user', NULL, '2024-10-02 23:31:08', '2024-10-02 23:31:08'),
(5, 'baban2', 'baban2@gmail.com', NULL, '$2y$10$FMenPqjqHVJ7ikp4ZRWPI..Fv7dNV5gvL9oP11sZpwhKVsogGJ18S', 'user', NULL, '2024-10-03 10:47:20', '2024-10-03 10:47:20'),
(8, 'Baban', 'test3333@gmail.com', NULL, '$2y$10$RgHFCQwfSKhrSENzBq9hNO1DTl/wwCspViRjxaaLjXJ4DtAvcXmY.', 'admin', NULL, '2024-10-03 11:44:57', '2024-10-03 11:44:57'),
(10, 'Test', 'test222@gmail.com', NULL, '$2y$10$/pYaaChT3juuNRB0ykfeHe3zUCaB9QIJs1ZR24nVmguPESTx2a4Vq', 'user', NULL, '2024-10-04 04:36:07', '2024-10-04 04:36:07'),
(11, 'ghadibaban0ss8@gmail.com', 'ghadibaban08@gmail.com', NULL, '$2y$10$6e2fDi2ZIUr2KC.Vn.jHb.iIXYX0i6nbSb4rbtpEn0mvTi0hDZZdm', 'user', NULL, '2024-10-04 09:58:54', '2024-10-04 09:58:54'),
(12, 'Testsss', 'use22222e3r@example.com', NULL, '$2y$10$WomazUQQMRjT7OM8TxIEMuA3I.pE06UlGPNZ1U9NbyArY84g/fubO', 'user', NULL, '2024-10-04 10:00:03', '2024-10-04 10:00:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_assigned_to_foreign` (`assigned_to`),
  ADD KEY `tasks_created_by_foreign` (`created_by`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
