-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: db
-- Thời gian đã tạo: Th10 28, 2024 lúc 11:26 AM
-- Phiên bản máy phục vụ: 8.0.40
-- Phiên bản PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `atshop_db`
--
CREATE DATABASE IF NOT EXISTS `atshop_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `atshop_db`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_general_ci,
  `status` tinyint NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `status`, `image`, `created_at`) VALUES
(2, 'CHARM', '-32', 'charm', 0, '1729416340.png', '2024-10-03 01:09:20'),
(3, 'VÒNG TAY', '-59', 'chain', 0, '1729416323.png', '2024-10-03 01:09:26'),
(4, 'DÂY CHUYỀN', '-16', 'necklace.', 0, '1729416298.png', '2024-10-03 01:09:35'),
(5, 'HOA TAI', '-19', 'chong chóng tre nè nobita', 0, '1729416354.png', '2024-10-03 01:09:45'),
(10, 'new', '11', 'dvfdaafd', 0, '1732526788.png', '2024-11-25 09:26:28'),
(11, 'new1', 'new1', 'dvfdaafd', 0, '1732528228.jpg', '2024-11-25 09:50:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint NOT NULL,
  `user_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '2',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `addtional` varchar(500) NOT NULL DEFAULT 'Ghi chú đặt hàng, ví dụ, thời gian hoặc địa điểm giao hàng chi tiết hơn.',
  `payment` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `created_at`, `addtional`, `payment`) VALUES
(461, 17, 4, '2024-11-25 10:23:19', '', 0),
(462, 17, 2, '2024-11-25 10:34:25', '', 0),
(463, 17, 2, '2024-11-25 13:22:52', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` bigint NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `order_id` bigint DEFAULT NULL,
  `selling_price` int NOT NULL,
  `quantity` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `rate` tinyint DEFAULT NULL,
  `comment` mediumtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `user_id`, `product_id`, `order_id`, `selling_price`, `quantity`, `status`, `rate`, `comment`, `created_at`) VALUES
(77, 17, 50, 461, 10, 1, 4, 5, 'sdsf', '2024-11-25 10:22:47'),
(79, 17, 50, 462, 9, 1, 2, NULL, NULL, '2024-11-25 10:34:14'),
(80, 17, 21, 462, 200, 1, 2, NULL, NULL, '2024-11-25 10:34:17'),
(81, 17, 53, 463, 9, 1, 2, NULL, NULL, '2024-11-25 13:22:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `small_description` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `original_price` int NOT NULL,
  `selling_price` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inventory_status` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `small_description`, `description`, `original_price`, `selling_price`, `image`, `qty`, `status`, `created_at`, `inventory_status`) VALUES
(10, 3, 'Vòng Bạc Pandora Moments Khóa Mặt Trăng', '-74', 'Bộ sưu tập: Pandora Moments\r\nPhân loại sản phẩm: Vòng tay\r\nKim loại: Bạc', 'Mang một chút không gian thiên hà đến phong cách của bạn với Vòng Pandora Moments Sparkling Moon Clasp. ', 449, '90', '1727962594.png', 0, 0, '2024-10-03 13:36:34', 3),
(12, 3, 'Vòng Pandora Signature Mạ Vàng Hồng 14K Khóa Trụ Dạng Bi', '-50', 'Bộ sưu tập: Pandora Signature\r\nPhân loại: Vòng tay\r\nChất liệu: Mạ vàng hồng 14k ', 'Pavé mạ vàng hồng 14k này là một lựa chọn hoàn hảo. Chiếc vòng đeo này lấy cảm hứng từ những diện mạo thay thế của việc đeo đồ trang sức và phong cách được tạo nên từ nguồn cảm hứng của punk, và thêm vào đó là một nét thanh lịch, tinh tế.', 199, '99', '1727962824.png', 9, 0, '2024-10-03 13:40:24', 1),
(13, 4, 'Dây Chuyền Bạc Pandora Essence Tròn Đính Ngọc Trai', '-28', 'Bộ sưu tập: Pandora Essence\r\nPhân loại sản phẩm: Dây chuyền\r\nChất liêu: Bạc', 'Dây chuyền bạc thiết kế cổ điển. Mặt dây bạc 925 hình tròn tự nhiên, đính ngọc trai nước ngọt và một hàng đá Pavé lấp lánh. Dây chuyền có thể điều chỉnh, mặt dây trượt tự do và không thể tháo rời. Mỗi viên ngọc trai mang vẻ đẹp độc đáo, kích thước và màu sắc có thể thay đổi\r\n', 269, '169', '1727964400.png', 9, 0, '2024-10-03 14:06:40', 1),
(14, 4, 'Dây Chuyền Bạc Pandora Moments Hai Mặt Trái Tim Tách Đôi', '-13', 'Bộ sưu tập: Pandora Moments\r\nPhân loại sản phẩm:Dây chuyền\r\nKim loại: Bạc', 'Hãy giữ những mối liên kết vĩnh cửu gần bên với các Dây Chuyền Collier Splittable Heart Forever amp; Always của chúng tôi. Được chế tác từ bạc sterling, mỗi một trong những mặt dây chuyền hình trái tim được làm bóng được đặt trên một dây chuyền riêng biệt và có các khắc chữ ngọt ngào \"Forever\" và \"Always,\" tượng trưng cho tình yêu bền vững. Thiết kế độc đáo cho phép các mặt dây chuyền trượt tự do trên chuỗi, mặc dù chúng không hoàn toàn có thể tách rời. Hoàn hảo để tặng cho ai đó đặc biệt hoặc mặc chúng cùng nhau, những chiếc dây chuyền này là một biểu hiện vĩnh cửu của các mối liên kết không ngừng.', 329, '109', '1727964452.png', 9, 0, '2024-10-03 14:07:32', 1),
(15, 4, 'Dây Chuyền Marvel x Pandora Biểu Tượng Captain Marvel', '-18', 'Bộ sưu tập:Pandora\r\nPhân loại sản phẩm:Dây chuyền\r\nKim loại:Mạ vàng 14k', 'Biểu Tượng Captain Marvel', 690, '590', '1727964553.png', 2, 0, '2024-10-03 14:09:13', 2),
(16, 4, 'Dây Chuyền Pandora Mạ Vàng Hồng 14k Vòng Tròn Lồng Vào Nhau', '-71', 'Bộ sưu tập: Pandora\r\nPhân loại: Dây Chuyền\r\nChất liệu: Mạ Vàng Hồng 14K', 'Mạ Vàng Hồng 14k Vòng Tròn Lồng Vào Nhau', 569, '409', '1727964666.png', 8, 0, '2024-10-03 14:11:06', 1),
(17, 5, 'Hoa Tai Pandora Signature Mạ Vàng Hồng 14K Dạng Chữ X', '-16', 'Bộ sưu tập: Pandora Signature\r\nPhân loại sản phẩm: Hoa tai\r\nChất liệu: Mạ vàng hồng 14k', 'Hãy đón nhận sự thanh lịch hiện đại với Bông Tai Hoop Crossover Pavé của chúng tôi. Mạ vàng hồng 14k, những chiếc bông tai này có hình dạng chữ X thời thượng được tạo ra bởi những dải vuông chéo. Với nhiều viên đá cubic zirconia trong suốt được đặt theo kiểu pavé, thiết kế tinh tế này thêm một chút sang trọng cho bất kỳ dịp nào. Những chi tiết tinh tế như các đường rãnh và logo Pandora được khắc trên phần đóng cửa nhấn, làm cho chiếc bông tai này trở thành sự kết hợp hoàn hảo giữa phong cách và sự tinh tế. Được bán theo cặp và có thiết kế gương trên bản vẽ của phần bên phải và bên trái.', 419, '300', '1727965069.png', 0, 0, '2024-10-03 14:17:49', 1),
(18, 5, 'Hoa Tai Bạc Pandora Moments Tròn 18mm', '-12', 'Bộ sưu tập: Pandora Moments\r\nPhân loại sản phẩm: Hoa tai\r\nChất liêu: Bạc', 'Nâng tầm phong cách hàng ngày với khuyên tai Pandora Moments. Được chế tác từ bạc sterling cao cấp, đôi khuyên tai này có thiết kế tròn cổ điển và logo Pandora đặc trưng bên trong. Mix & Match với những charm Pandora yêu thích, thể hiện cá tính, cảm xúc và khoảnh khắc đặc biệt qua từng sự kết hợp, biến mỗi diện mạo trở nên độc đáo và mang đậm dấu ấn riêng.\r\n', 209, '169', '1727965155.png', 3, 0, '2024-10-03 14:19:15', 1),
(19, 5, 'Hoa Tai Pandora Essence Mạ Vàng 14k Dạng Rơi Đính Ngọc Trai', '-31', 'Bộ sưu tập: Pandora Essence\r\nPhân loại sản phẩm: Hoa tai\r\nChất liêu: Mạ vàng 14k', 'Hoa tai mạ vàng 14k đuọc đính viên ngọc trai treo lơ lửng trên chuỗi dây uyển chuyển, chốt hình cầu, kết hợp hài hòa mang đến vẻ đẹp tự nhiên, kiêu sa và sang trọng. ', 269, '169', '1727965217.png', 14, 0, '2024-10-03 14:20:17', 1),
(20, 2, 'Charm Pandora ME Mạ Vàng Hồng 14K Hình Bánh Lái', '-19', 'Bộ sưu tập:Pandora ME\r\nPhân loại sản phẩm:Charm\r\nChất liệu: Mạ vàng hồng 14k ', 'Tìm kiếm vận may của bạn với Chiếc Charm Pandora ME Wheel of Fortune Medallion mạ vàng hồng 14k. Tượng trưng cho may mắn và duyên phận, hòm mặt tròn 8 điểm này có một mũi tên có thể di chuyển ở trung tâm - quay nó để chỉ đến số phận bạn đã chọn. Được khắc trên bốn điểm của bánh xe là các chữ cái T, A, R và O, được lấy cảm hứng từ các chữ cái trên một số phiên bản của lá bài tarot Wheel of Fortune.', 890, '790', '1727975481.png', 3, 0, '2024-10-03 17:11:21', 1),
(21, 2, 'Charm Pandora Me Mạ Vàng 14k Lapis Lazuli', '-76', 'Bộ sưu tập: Pandora ME\r\nPhân loại sản phẩm: Charm \r\nChất liệu: Mạ vàng 14k  ', 'Charm Lapis Lazuli - Nét đẹp nhỏ bé, ý nghĩa to lớn. \r\nTỏa sáng rực rỡ với Charm Lapis Lazuli mạ vàng 14k! Lấy cảm hứng từ viên đá Lapis Lazuli huyền bí với sắc xanh thẳm cùng ánh kim tuyến lấp lánh. Biểu tượng cho sự chuyển mình, phát triển và tinh thần tích cực. Mặt sau trơn nhẵn - nơi lưu giữ những thông điệp ý nghĩa, những dấu ấn cá nhân độc đáo. Hãy khắc lên đó những lời chúc, kỷ niệm hay tên của những người bạn yêu thương để biến chiếc Charm này thành món quà đặc biệt dành cho bất kỳ ai, hay đơn giản là món quà lưu niệm đầy ý nghĩa dành cho chính bạn.', 500, '200', '1727976174.png', 1, 0, '2024-10-03 17:22:54', 2),
(25, 5, 'Hoa Tai Bạc Disney x Pandora Xe Bí Ngô', '-68', 'họa tiết đẹp', 'đáng để mua', 120, '100', '1728212420.png', 96, 0, '2024-10-06 11:00:20', 1),
(53, 11, 'sp_new', '-97', 'dsfgsdg', 'dsgsdgsdg', 10, '', '1732539280.jpg', 11, 0, '2024-11-25 12:54:40', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `role_as` tinyint NOT NULL DEFAULT '0',
  `creat_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `otp` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `otp_expiry` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `password`, `role_as`, `creat_at`, `otp`, `otp_expiry`) VALUES
(17, 'admin', 'arridngo@gmail.com', '0138242421', '123', '$2y$10$HiA7FH1ubGhbe61bCniV9.9UD6j9aWcHLY9UKTwrsGH/OePaDFFOe', 1, '2024-11-25 08:47:01', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=464;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
