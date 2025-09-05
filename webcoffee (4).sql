-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2025 at 08:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webcoffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `id_detail` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `gia` decimal(10,0) NOT NULL,
  `soluong` int(11) NOT NULL,
  `tongtien` decimal(10,0) NOT NULL,
  `ghichu` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`id_detail`, `id_order`, `id_product`, `gia`, `soluong`, `tongtien`, `ghichu`) VALUES
(11, 20, 2, 40000, 1, 0, ''),
(12, 21, 10, 50000, 1, 0, 'Ít đá'),
(13, 22, 2, 40000, 1, 40000, 'Đường'),
(14, 23, 2, 40000, 1, 40000, 'Trà đá'),
(18, 33, 3, 35000, 1, 35000, '');

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id_category` int(11) NOT NULL,
  `ten_danhmuc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`id_category`, `ten_danhmuc`) VALUES
(1, 'coffee'),
(2, 'tea'),
(3, 'cake');

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ngaydat` datetime NOT NULL,
  `tongtien` decimal(10,0) NOT NULL,
  `trangthai` varchar(50) NOT NULL DEFAULT 'Chờ xử lý',
  `diachi` varchar(65) NOT NULL,
  `sdt` varchar(15) NOT NULL,
  `phivanchuyen` decimal(10,0) NOT NULL,
  `thanhtoan` varchar(65) NOT NULL,
  `ghichu` text DEFAULT NULL,
  `magiamgia` varchar(50) DEFAULT NULL,
  `giamgia` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`id_order`, `id_user`, `ngaydat`, `tongtien`, `trangthai`, `diachi`, `sdt`, `phivanchuyen`, `thanhtoan`, `ghichu`, `magiamgia`, `giamgia`) VALUES
(20, 17, '2025-07-15 23:44:45', 40000, 'Chờ xử lý', 'Chợ Lầu, Xã Bắc Bình, Tỉnh Lâm Đồng, Việt Nam', '', 0, 'COD', NULL, NULL, 0.00),
(21, 17, '2025-07-15 23:45:38', 50000, 'Chờ xử lý', '1041/62/20 Trần Xuân Soạn, TPHCM', '', 30000, 'COD', NULL, NULL, 0.00),
(22, 17, '2025-07-15 23:48:56', 40000, 'Chờ xử lý', '1041/62/20 Trần Xuân Soạn, TPHCM', '', 30000, 'COD', NULL, NULL, 0.00),
(23, 18, '2025-07-15 23:49:51', 40000, 'Chờ xử lý', '1041/62/20 Trần Xuân Soạn, TPHCM', '', 30000, 'COD', NULL, NULL, 0.00),
(24, 18, '2025-07-15 23:50:10', 180000, 'Chờ xử lý', 'Hẻm 1041/62 Đường Trần Xuân Soạn, Phường Tân Hưng, Thành phố Hồ C', '', 30000, 'COD', NULL, NULL, 0.00),
(33, 21, '2025-08-13 23:26:46', 65000, 'Đang giao', 'Võ văn kiệt', '', 30000, 'COD', NULL, NULL, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `lienhe`
--

CREATE TABLE `lienhe` (
  `id` int(65) NOT NULL,
  `name` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `sdt` int(11) NOT NULL,
  `noidung` text NOT NULL,
  `ngaygui` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lienhe`
--

INSERT INTO `lienhe` (`id`, `name`, `email`, `sdt`, `noidung`, `ngaygui`) VALUES
(1, 'hong tham', 'admin@gmail.com', 0, '', '2025-07-16 11:10:25'),
(2, 'hong tham', 'admin@gmail.com', 27362311, 'dâssfdsfdsf', '2025-07-16 11:11:53'),
(3, '', '', 0, '', '2025-07-16 11:14:46'),
(4, '', '', 0, '', '2025-07-16 11:15:25'),
(5, '', '', 0, '', '2025-07-16 11:16:30'),
(6, '', '', 0, '', '2025-07-16 11:17:23'),
(7, '', '', 0, '', '2025-07-16 11:17:32'),
(8, 'Thương', 'admin@gmail.com', 3243534, 'dâssfdsfdsf', '2025-07-16 11:20:41');

-- --------------------------------------------------------

--
-- Table structure for table `magiamgia`
--

CREATE TABLE `magiamgia` (
  `id` int(11) NOT NULL,
  `ma` varchar(50) DEFAULT NULL,
  `phan_tram_giam` int(11) DEFAULT NULL,
  `giam_toi_da` decimal(10,2) DEFAULT NULL,
  `ngay_bat_dau` date DEFAULT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `da_su_dung` int(11) DEFAULT 0,
  `trang_thai` tinyint(1) DEFAULT 1,
  `dieukien` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `magiamgia`
--

INSERT INTO `magiamgia` (`id`, `ma`, `phan_tram_giam`, `giam_toi_da`, `ngay_bat_dau`, `ngay_ket_thuc`, `so_luong`, `da_su_dung`, `trang_thai`, `dieukien`, `id_user`) VALUES
(1, 'COFFEE10', 10, 20000.00, '2025-08-20', '2025-08-31', 50, 0, 1, '100000', NULL),
(2, 'FREESHIP', 5, 30000.00, '2025-08-20', '2025-09-20', 10, 0, 1, '50000', NULL),
(4, 'SHIP15', 15, 20000.00, '2025-08-13', '2025-08-16', 10, 1, 1, '20000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `id_user` int(65) NOT NULL,
  `username` varchar(65) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(65) NOT NULL,
  `loai_nguoi_dung` enum('Admin','Khách hàng') NOT NULL DEFAULT 'Khách hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`id_user`, `username`, `password`, `email`, `loai_nguoi_dung`) VALUES
(17, 'Le Tham 2', '123456', '221A290101@gmail.com', 'Khách hàng'),
(18, 'Van', '$2y$10$wT.f3K2j4.Y.0L9S8S7W.m5G6A8W.m5G6A8W.m5G6A8W.m5G6A8W.m5G6A8W.m5G6A8W.m5G6A8W.m5G6A8W.m5G6A8W.m5G6A8', 'admin@gmail.com', 'Admin'),
(20, 'Hang', '$2y$10$BSEPwo7yFF5i/Bd2PrtlHu6zZLbVkLPKKhSLalZYDnCAMo/wO6Tw2', 'hangnc@gmail.com', 'Admin'),
(21, 'Tham', '$2y$10$wymvgYPKKbQxog9ob3KFkuoGJwaTOJjBtlphE8keIXXhKxB1ZVK4a', 'hongtham.161024@gmail.com', 'Admin'),
(22, 'Cuong', '$2y$10$wcotcTb/2KVyq606X5K0oepJpCkQStycVZNBYj2Eyw2kk./XsYRYu', 'cuongtv@gmail.com', 'Khách hàng');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id_product` int(65) NOT NULL,
  `name` varchar(65) NOT NULL,
  `image` varchar(65) NOT NULL,
  `price` decimal(65,0) NOT NULL,
  `description` text DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id_product`, `name`, `image`, `price`, `description`, `id_category`) VALUES
(1, 'Cà phê đen', 'coffee_1.png', 45000, NULL, 1),
(2, 'Cà phê sữa', 'coffee_2.png', 50000, NULL, 1),
(3, 'Bạc sỉu', 'coffee_3.png', 50000, NULL, 1),
(4, 'Cà phê trứng', 'coffee_4.png', 55000, NULL, 1),
(5, 'Cà phê muối', 'coffee_5.png', 55000, NULL, 1),
(6, 'Americano', 'coffee_6.png', 60000, NULL, 1),
(7, 'Capuchino', 'coffee_7.png', 65000, NULL, 1),
(8, 'Cold brew', 'coffee_8.png', 65000, NULL, 1),
(9, 'Trà Sữa Truyền Thống', 'tea_1.png', 60000, NULL, 2),
(10, 'Hồng Trà Sữa', 'tea_2.png', 75000, NULL, 2),
(11, 'Matcha Latte', 'tea_3.png', 75000, NULL, 2),
(12, 'Trà Đào Cam Sả', 'tea_4.png', 70000, NULL, 2),
(13, 'Trà Dâu', 'tea_5.png', 60000, NULL, 2),
(14, 'Trà Tắc', 'tea_6.png', 50000, NULL, 2),
(15, 'Trà Vải', 'tea_7.jpg', 55000, NULL, 2),
(16, 'Cheesecake', 'cake_1.png', 70000, NULL, 3),
(20, 'Tiramisu', 'cake_2.png', 60000, NULL, 3),
(21, 'Red Velvet', 'cake_3.png', 65000, NULL, 3),
(22, 'Chocolate', 'cake_4.png', 70000, NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_order` (`id_order`),
  ADD KEY `fk_product` (`id_product`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `fk_user_donhang` (`id_user`);

--
-- Indexes for table `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `magiamgia`
--
ALTER TABLE `magiamgia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`id_user`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `fk_sanpham_danhmuc` (`id_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `magiamgia`
--
ALTER TABLE `magiamgia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `id_user` int(65) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id_product` int(65) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`id_order`) REFERENCES `donhang` (`id_order`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`id_product`) REFERENCES `sanpham` (`id_product`) ON DELETE CASCADE;

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `fk_user_donhang` FOREIGN KEY (`id_user`) REFERENCES `nguoidung` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `magiamgia`
--
ALTER TABLE `magiamgia`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`id_user`) REFERENCES `nguoidung` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_sanpham_danhmuc` FOREIGN KEY (`id_category`) REFERENCES `danhmuc` (`id_category`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
