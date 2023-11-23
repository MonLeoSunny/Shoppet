-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 23, 2023 lúc 09:33 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shoppet`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `id` int(11) NOT NULL,
  `id_taikhoan` int(11) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `noidung` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctdonhang`
--

CREATE TABLE `ctdonhang` (
  `id` int(11) NOT NULL,
  `id_donhang` int(11) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ctdonhang`
--

INSERT INTO `ctdonhang` (`id`, `id_donhang`, `id_sanpham`, `soluong`, `gia`) VALUES
(1, 1, 4, 1, 666),
(2, 2, 5, 1, 4444444),
(3, 3, 5, 1, 4444444),
(4, 4, 4, 1, 666),
(5, 5, 5, 1, 4444444),
(6, 6, 4, 4, 666),
(7, 7, 5, 1, 4444444),
(8, 8, 4, 1, 6666),
(9, 9, 4, 1, 6666);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id_dm` int(11) NOT NULL,
  `danhmuc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id_dm`, `danhmuc`) VALUES
(1, 'Thức ăn cho mèo'),
(3, 'Quần áo'),
(4, 'Vật dụng ăn uống'),
(5, 'Đồ chơi cho Pet');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id` int(11) NOT NULL,
  `id_taikhoan` int(11) NOT NULL,
  `tongtien` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `diachi` text DEFAULT NULL,
  `thoigian` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`id`, `id_taikhoan`, `tongtien`, `status`, `diachi`, `thoigian`) VALUES
(9, 1, 6666, 2, ' 34 Trưng Nhị, Nguyễn Trãi, Hà Đông, Hà Nội', '23-11-2023 01:33:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `id` int(11) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `dienthoai` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `diachi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`id`, `ten`, `dienthoai`, `email`, `diachi`) VALUES
(1, 'Royal Canin', '0968454225', 'royalcanin@gmail.com', 'Hà Nội'),
(2, 'Smartheart', '0943543434', 'Smartheart@gmail.com', 'Thái Lan');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`id`, `ten`, `created_at`, `updated_at`) VALUES
(1, 'Sản phẩm', '2023-11-18 05:07:16', '2023-11-18 05:07:16'),
(3, 'Danh mục sản phẩm', '2023-11-18 05:08:56', '2023-11-18 05:08:56'),
(4, 'Đơn hàng', '2023-11-18 05:08:56', '2023-11-18 05:08:56'),
(7, 'Bình luận', '2023-11-18 05:55:19', '2023-11-18 05:55:19'),
(8, 'Tài khoản', '2023-11-18 07:27:42', '2023-11-18 07:27:42'),
(9, 'Tin tức', '2023-11-18 07:27:48', '2023-11-18 07:27:48'),
(10, 'Nhà cung cấp', '2023-11-19 03:57:43', '2023-11-19 03:57:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `id_danhmuc` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `id_nhacungcap` int(11) NOT NULL,
  `loaimoi` varchar(255) NOT NULL,
  `nguyenlieu` varchar(255) NOT NULL,
  `thuonghieu` varchar(255) NOT NULL,
  `baohanh` varchar(255) NOT NULL,
  `xuatxu` varchar(255) NOT NULL,
  `bonho` varchar(11) NOT NULL,
  `gia` int(11) NOT NULL,
  `soluong` int(3) NOT NULL DEFAULT 0,
  `anh1` text NOT NULL,
  `anh2` text NOT NULL,
  `anh3` text NOT NULL,
  `chitiet` text NOT NULL,
  `mota` text NOT NULL,
  `luotxem` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `id_danhmuc`, `ten`, `id_nhacungcap`, `loaimoi`, `nguyenlieu`, `thuonghieu`, `baohanh`, `xuatxu`, `bonho`, `gia`, `soluong`, `anh1`, `anh2`, `anh3`, `chitiet`, `mota`, `luotxem`, `status`) VALUES
(4, 1, 'Sunhouse 5', 1, 'g', 'g', 'g', 'g', 'g', 'g', 6666, 4, 'Alistar playing the cowbell by naclyaf.jpg', '', '', 'g', 'g', 34, 0),
(7, 5, 'Royal Canin', 1, 'abc', 'abc', 'acbc', 'acb', 'acbc', 'acb', 54543, 0, 'avatar đôi cute.jpg', 'Alistar playing the cowbell by naclyaf.jpg', 'avatar đôi cute.jpg', 'accbc', 'ancn', 0, 0),
(8, 1, 'Royal Canin', 1, '2', '2', '2', '2', '2', '2', 232, 0, 'logo.png', '', '', 'đá', 'á', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `anh` text NOT NULL,
  `mota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `taikhoan` varchar(55) NOT NULL,
  `matkhau` varchar(50) NOT NULL,
  `hoten` varchar(100) NOT NULL,
  `anh` text NOT NULL,
  `sdt` text NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `phanquyen` int(11) NOT NULL DEFAULT 0,
  `superuser` tinyint(4) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `taikhoan`, `matkhau`, `hoten`, `anh`, `sdt`, `diachi`, `phanquyen`, `superuser`, `status`) VALUES
(1, 'admin@gmail.com', 'admin123', 'Quản trị viên', '', '0971801472', '34 Trưng Nhị, Nguyễn Trãi, Hà Đông, Hà Nội', 0, 0, 0),
(3, 'vutuananh@gmail.com', 'Vu06102001', 'Vũ Tuấn Anh', 'Alistar playing the cowbell by naclyaf.jpg', '0971801472', 'Hà Nội', 1, 0, 0),
(6, 'vuthithao@gmail.com', 'Vu06102001', 'Vũ Thị Thảo', '', '', '', 1, 0, 0),
(7, 'ngothuyhang@gmail.com', 'Vu06102001', 'Ngô Thuý Hằng', '', '985736321', '', 2, 0, 0),
(8, 'khachang01@gmail.com', '1234', 'khách hàng 01', '', '1345345453', '', 2, 0, 0),
(9, 'khachhang@gmail.com', 'Vu06102001', 'Khách hàng 02', '', '968565733', '', 2, 0, 1),
(10, 'khachhang03@gmail.com', 'Vu06102001', 'Khách hàng 03', '', '947343432', '', 2, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan_quyen`
--

CREATE TABLE `taikhoan_quyen` (
  `id` int(11) NOT NULL,
  `id_taikhoan` int(11) NOT NULL,
  `id_quyen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `taikhoan_quyen`
--

INSERT INTO `taikhoan_quyen` (`id`, `id_taikhoan`, `id_quyen`) VALUES
(22, 3, 7),
(23, 6, 3),
(24, 6, 4),
(25, 6, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `mota` text NOT NULL,
  `noidung` text NOT NULL,
  `anh` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tlbinhluan`
--

CREATE TABLE `tlbinhluan` (
  `id` int(11) NOT NULL,
  `id_binhluan` int(11) NOT NULL,
  `noidung` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id sản phẩm` (`id_sanpham`),
  ADD KEY `id tài khoản` (`id_taikhoan`);

--
-- Chỉ mục cho bảng `ctdonhang`
--
ALTER TABLE `ctdonhang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fk_id_donhang` (`id_donhang`),
  ADD KEY `Fk_id_sanpham` (`id_sanpham`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id_dm`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_takhoan` (`id_taikhoan`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten` (`ten`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id danh mục` (`id_danhmuc`),
  ADD KEY `nhacungcap` (`id_nhacungcap`);

--
-- Chỉ mục cho bảng `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `taikhoan_quyen`
--
ALTER TABLE `taikhoan_quyen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_permission` (`id_taikhoan`,`id_quyen`),
  ADD KEY `taikhoan_quyen_ibfk_2` (`id_quyen`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tlbinhluan`
--
ALTER TABLE `tlbinhluan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id bình luận` (`id_binhluan`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ctdonhang`
--
ALTER TABLE `ctdonhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id_dm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `quyen`
--
ALTER TABLE `quyen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `taikhoan_quyen`
--
ALTER TABLE `taikhoan_quyen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tlbinhluan`
--
ALTER TABLE `tlbinhluan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `fk_id_sanpham_bl` FOREIGN KEY (`id_sanpham`) REFERENCES `sanpham` (`id`),
  ADD CONSTRAINT `fk_id_taikhoan` FOREIGN KEY (`id_taikhoan`) REFERENCES `taikhoan` (`id`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`id_nhacungcap`) REFERENCES `nhacungcap` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
