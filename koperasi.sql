-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 03, 2022 at 06:56 PM
-- Server version: 10.1.47-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_previleges`
--

CREATE TABLE `acl_previleges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `access` tinyint(1) NOT NULL DEFAULT '1',
  `write` tinyint(1) NOT NULL DEFAULT '1',
  `update` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `acl_previleges`
--

INSERT INTO `acl_previleges` (`id`, `role_id`, `menu_id`, `parent_id`, `access`, `write`, `update`, `delete`) VALUES
(1, 7, 1, 2, 1, 1, 1, 1),
(2, 7, 11, 3, 1, 1, 1, 1),
(3, 7, 2, 5, 1, 1, 1, 1),
(4, 7, 3, 5, 1, 1, 1, 1),
(5, 7, 10, 3, 1, 1, 1, 1),
(6, 7, 9, 3, 1, 1, 1, 1),
(7, 7, 8, 3, 1, 1, 1, 1),
(8, 7, 5, 3, 1, 1, 1, 1),
(9, 7, 6, 6, 1, 1, 1, 1),
(10, 7, 12, 6, 1, 1, 1, 1),
(11, 7, 7, 3, 1, 1, 1, 1),
(12, 8, 12, 6, 1, 1, 1, 1),
(13, 8, 6, 6, 1, 1, 1, 1),
(14, 7, 4, 5, 1, 1, 1, 1),
(15, 7, 13, 5, 1, 1, 1, 1),
(16, 7, 14, 5, 1, 1, 1, 1),
(17, 9, 13, 5, 1, 1, 1, 1),
(18, 9, 14, 5, 1, 1, 1, 1),
(19, 9, 1, 2, 1, 1, 1, 1),
(20, 7, 16, 8, 1, 1, 1, 1),
(21, 7, 17, 6, 1, 1, 1, 1),
(22, 7, 18, 8, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sell_price` int(11) NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Process'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enumerations`
--

CREATE TABLE `enumerations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enumerations`
--

INSERT INTO `enumerations` (`id`, `name`, `description`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Jenis Kelamin', 'Data untuk jenis kelamin', 'Gender', 'Laki - Laki', '2022-06-27 12:57:57', NULL),
(2, 'Jenis Kelamin', 'Data untuk jenis kelamin', 'Gender', 'Perempuan', '2022-06-27 12:58:33', NULL),
(3, 'Tipe Barang', 'Data untuk tipe barang', 'TypeProduct', 'Bundle', '2022-06-27 12:59:38', NULL),
(4, 'Tipe Barang', 'Data untuk tipe barang', 'TypeProduct', 'Pcs', '2022-06-27 13:00:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_products`
--

CREATE TABLE `invoice_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sell_price` int(11) NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pr`
--

CREATE TABLE `laporan_pr` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL,
  `supplyer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  `nomor_pr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_child`
--

CREATE TABLE `menu_child` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_parent_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_child`
--

INSERT INTO `menu_child` (`id`, `menu_parent_id`, `name`, `route`, `description`) VALUES
(1, 2, 'Dashboard', 'dashboard', 'Dashboard menu'),
(2, 5, 'Products', 'products.index', 'Products index'),
(3, 5, 'Rack', 'rack.index', 'Rack menu'),
(4, 5, 'Warehouse', 'products.warehouse', NULL),
(5, 3, 'Users', 'masterdata.users', NULL),
(6, 6, 'Purchase Request', 'purchase.request', NULL),
(7, 3, 'Roles', 'masterdata.roles', NULL),
(8, 3, 'Supplyer', 'masterdata.supplyer', NULL),
(9, 3, 'Enumerations', 'masterdata.enumeration', NULL),
(10, 3, 'Menu List', 'masterdata.menu', NULL),
(11, 3, 'Access Control', 'masterdata.acl', NULL),
(12, 6, 'Purchase Order', 'purchase.order', NULL),
(13, 5, 'Store', 'products.store', 'Menu pemilihan barang untuk anggota'),
(14, 5, 'Cart', 'products.cart', 'Cart for products'),
(16, 8, 'Laporan Transaksi', 'purchase.laporan.invoice', NULL),
(17, 6, 'Receiving', 'purchase.receiving', NULL),
(18, 8, 'Potong Gaji', 'purchase.laporan.gaji', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_parent`
--

CREATE TABLE `menu_parent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icons` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'folder'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_parent`
--

INSERT INTO `menu_parent` (`id`, `name`, `description`, `icons`) VALUES
(2, 'Default', 'Parent default without dropdown', 'monitor'),
(3, 'Masterdata', 'Masterdata menu', 'database'),
(5, 'Products', 'Products menu', 'shopping-cart'),
(6, 'Pemesanan', 'Pemesanan', 'box'),
(7, 'Transaksi', 'Menu Transaksi', 'dollar-sign'),
(8, 'Laporan', 'Menu Laporan', 'inbox');

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
(3, '2022_06_19_061953_roles', 1),
(4, '2022_05_04_232402_supplyer', 2),
(5, '2022_04_28_020927_users', 3),
(10, '2022_05_25_012024_history_transaksi', 3),
(15, '2022_06_20_064504_enumerations', 8),
(16, '2022_06_20_054446_notif', 9),
(19, '2022_06_20_052459_laporan_po', 12),
(26, '2022_06_27_104029_rack', 17),
(33, '2022_04_28_022946_product', 21),
(35, '2022_05_09_002224_purchase_request', 22),
(37, '2022_06_26_044801_menu_parent', 24),
(38, '2022_06_26_044816_menu_child', 24),
(40, '2022_06_26_044833_acl_previleges', 25),
(41, '2022_06_20_052651_laporan_pr', 26),
(43, '2022_05_09_021414_purchase_order', 28),
(44, '2022_07_29_040010_cart', 29),
(52, '2022_05_24_081508_invoice', 30),
(53, '2022_07_31_102948_invoice_products', 31),
(54, '2022_08_02_012255_product_purchase', 32),
(55, '2022_08_03_093830_product_purchase_temp', 33);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icons` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info',
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sell_price` int(11) NOT NULL,
  `total_income` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `type`, `image`, `barcode`, `sell_price`, `total_income`, `expired_date`, `created_at`, `updated_at`, `quantity`) VALUES
(9, 'Macbook M2', 15000, 'Pcs', 'default.png', 'none', 40000, '0', '2022-07-31', NULL, '2022-07-29 22:07:05', 23),
(10, 'Noodles', 15000, 'Bundle', 'default.png', 'none', 50000, '150000', '2022-08-04', NULL, NULL, 10),
(12, 'Asus Zenbook 2', 23400, 'Pcs', 'default.png', 'none', 430000, '468000', '2022-08-15', NULL, NULL, 20),
(13, 'RTX 3080', 330000, 'Pcs', 'default.png', 'none', 600000, '3300000', '2022-08-29', NULL, NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `products_purchase`
--

CREATE TABLE `products_purchase` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sell_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_income` int(11) NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL,
  `pr_id` bigint(20) UNSIGNED NOT NULL,
  `expired_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Process',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products_purchase_temp`
--

CREATE TABLE `products_purchase_temp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sell_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_income` int(11) NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL,
  `pr_id` bigint(20) UNSIGNED NOT NULL,
  `expired_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Process',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pr_id` bigint(20) UNSIGNED NOT NULL,
  `supplyer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request`
--

CREATE TABLE `purchase_request` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL,
  `supplyer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  `laporan_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rack`
--

CREATE TABLE `rack` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rack`
--

INSERT INTO `rack` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(8, 'C-1', 'Rack for C-1', NULL, NULL),
(9, 'C-2', 'Rack for C-2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(7, 'Admin', 'Admin Role', '2022-06-19 01:12:20', '2022-06-19 01:12:20'),
(8, 'Keuangan', 'Management Keuangan', NULL, NULL),
(9, 'Anggota', 'Role untuk anggota', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplyer`
--

CREATE TABLE `supplyer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atas_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplyer`
--

INSERT INTO `supplyer` (`id`, `nama`, `atas_nama`, `alamat`, `no_telp`) VALUES
(1, 'Walmart Store', 'David', 'California, West Branch Street', '1927271239');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `fullname`, `password`, `picture`, `role_id`) VALUES
(1, 'admin@koperasi.sch.id', 'Admin Koperasi', '$2y$10$/5zyS5BQBuLeleTWfVzfPO6Ly1AG5guNgO5h33eEDaPcszMuOCS82', 'https://avatars.dicebear.com/api/initials/admin koperasi.png', 7),
(2, 'keuangan@koperasi.sch.id', 'Keuangan Koperasi', '$2y$10$dhBfRTc6yt80AUzzmiKT2eF8jP1nANCGI4IV1OV35OAr9QYxhM9w6', 'https://avatars.dicebear.com/api/initials/Keuangan Koperasi.png', 8),
(3, 'anggota@koperasi.sch.id', 'Anggota Koperasi', '$2y$10$5HCn8E6JqklPfEEAZMfD6eaq.lni06AsyrVOsjndg7CPdKDqv2ahW', 'https://avatars.dicebear.com/api/initials/Anggota Koperasi.png', 9),
(4, 'dedel@koperasi.sch.id', 'Dedel si paling cakep', '$2y$10$SrLhpLEmygslL3nHxbcfN.QSobf.8DNbtoj9IOjcawA0hx//HSKqy', 'https://avatars.dicebear.com/api/initials/Dedel si paling cakep.png', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acl_previleges`
--
ALTER TABLE `acl_previleges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acl_previleges_parent_id_foreign` (`parent_id`),
  ADD KEY `acl_previleges_role_id_foreign` (`role_id`),
  ADD KEY `acl_previleges_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_rack_id_foreign` (`rack_id`),
  ADD KEY `cart_user_id_foreign` (`user_id`);

--
-- Indexes for table `enumerations`
--
ALTER TABLE `enumerations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_user_id_foreign` (`user_id`);

--
-- Indexes for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_products_rack_id_foreign` (`rack_id`),
  ADD KEY `invoice_products_user_id_foreign` (`user_id`),
  ADD KEY `invoice_products_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `laporan_pr`
--
ALTER TABLE `laporan_pr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_pr_rack_id_foreign` (`rack_id`);

--
-- Indexes for table `menu_child`
--
ALTER TABLE `menu_child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_child_menu_parent_id_foreign` (`menu_parent_id`);

--
-- Indexes for table `menu_parent`
--
ALTER TABLE `menu_parent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_purchase`
--
ALTER TABLE `products_purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_purchase_rack_id_foreign` (`rack_id`),
  ADD KEY `products_purchase_pr_id_foreign` (`pr_id`);

--
-- Indexes for table `products_purchase_temp`
--
ALTER TABLE `products_purchase_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_purchase_temp_rack_id_foreign` (`rack_id`),
  ADD KEY `products_purchase_temp_pr_id_foreign` (`pr_id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_pr_id_foreign` (`pr_id`);

--
-- Indexes for table `purchase_request`
--
ALTER TABLE `purchase_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_request_rack_id_foreign` (`rack_id`);

--
-- Indexes for table `rack`
--
ALTER TABLE `rack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplyer`
--
ALTER TABLE `supplyer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acl_previleges`
--
ALTER TABLE `acl_previleges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enumerations`
--
ALTER TABLE `enumerations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `invoice_products`
--
ALTER TABLE `invoice_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_pr`
--
ALTER TABLE `laporan_pr`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `menu_child`
--
ALTER TABLE `menu_child`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `menu_parent`
--
ALTER TABLE `menu_parent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products_purchase`
--
ALTER TABLE `products_purchase`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_purchase_temp`
--
ALTER TABLE `products_purchase_temp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_request`
--
ALTER TABLE `purchase_request`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rack`
--
ALTER TABLE `rack`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `supplyer`
--
ALTER TABLE `supplyer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acl_previleges`
--
ALTER TABLE `acl_previleges`
  ADD CONSTRAINT `acl_previleges_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu_child` (`id`),
  ADD CONSTRAINT `acl_previleges_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu_parent` (`id`),
  ADD CONSTRAINT `acl_previleges_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_rack_id_foreign` FOREIGN KEY (`rack_id`) REFERENCES `rack` (`id`),
  ADD CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD CONSTRAINT `invoice_products_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`),
  ADD CONSTRAINT `invoice_products_rack_id_foreign` FOREIGN KEY (`rack_id`) REFERENCES `rack` (`id`),
  ADD CONSTRAINT `invoice_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `laporan_pr`
--
ALTER TABLE `laporan_pr`
  ADD CONSTRAINT `laporan_pr_rack_id_foreign` FOREIGN KEY (`rack_id`) REFERENCES `rack` (`id`);

--
-- Constraints for table `menu_child`
--
ALTER TABLE `menu_child`
  ADD CONSTRAINT `menu_child_menu_parent_id_foreign` FOREIGN KEY (`menu_parent_id`) REFERENCES `menu_parent` (`id`);

--
-- Constraints for table `products_purchase`
--
ALTER TABLE `products_purchase`
  ADD CONSTRAINT `products_purchase_pr_id_foreign` FOREIGN KEY (`pr_id`) REFERENCES `laporan_pr` (`id`),
  ADD CONSTRAINT `products_purchase_rack_id_foreign` FOREIGN KEY (`rack_id`) REFERENCES `rack` (`id`);

--
-- Constraints for table `products_purchase_temp`
--
ALTER TABLE `products_purchase_temp`
  ADD CONSTRAINT `products_purchase_temp_pr_id_foreign` FOREIGN KEY (`pr_id`) REFERENCES `laporan_pr` (`id`),
  ADD CONSTRAINT `products_purchase_temp_rack_id_foreign` FOREIGN KEY (`rack_id`) REFERENCES `rack` (`id`);

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_pr_id_foreign` FOREIGN KEY (`pr_id`) REFERENCES `laporan_pr` (`id`);

--
-- Constraints for table `purchase_request`
--
ALTER TABLE `purchase_request`
  ADD CONSTRAINT `purchase_request_rack_id_foreign` FOREIGN KEY (`rack_id`) REFERENCES `rack` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
