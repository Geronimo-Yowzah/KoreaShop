-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2022 at 02:40 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koreashop`
--

-- --------------------------------------------------------

--
-- Table structure for table `buying`
--

CREATE TABLE `buying` (
  `Product_ID` int(5) NOT NULL,
  `Order_ID` int(5) NOT NULL,
  `Member_ID` int(5) NOT NULL,
  `Amount` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buying`
--

INSERT INTO `buying` (`Product_ID`, `Order_ID`, `Member_ID`, `Amount`) VALUES
(1, 1, 1, 1),
(1, 77, 5, 1),
(1, 79, 5, 1),
(1, 82, 1, 1),
(2, 2, 3, 1),
(2, 82, 1, 1),
(3, 4, 3, 1),
(4, 81, 7, 1),
(5, 3, 1, 1),
(5, 71, 3, 1),
(5, 79, 5, 1),
(5, 80, 6, 1),
(5, 81, 7, 1),
(7, 77, 5, 1),
(8, 1, 1, 1),
(8, 70, 1, 1),
(8, 71, 3, 2),
(8, 72, 3, 1),
(8, 73, 3, 3),
(8, 74, 5, 1),
(8, 78, 5, 1),
(10, 78, 5, 1),
(13, 70, 1, 2),
(13, 72, 3, 1),
(13, 73, 3, 1),
(13, 74, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(5) NOT NULL,
  `Category_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Category_Name`) VALUES
(1, 'เสื้อเกาหลีชาย'),
(2, 'เสื้อเกาหลีหญิง'),
(3, 'กางเกงเกาหลีชาย'),
(4, 'กางเกงเกาหลีหญิง'),
(5, 'หมวก');

-- --------------------------------------------------------

--
-- Table structure for table `confirm_order`
--

CREATE TABLE `confirm_order` (
  `Slip_ID` int(5) NOT NULL,
  `Order_ID` int(5) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `confirm_order`
--

INSERT INTO `confirm_order` (`Slip_ID`, `Order_ID`, `Status`) VALUES
(1, 1, 'IMG_6515.JPG'),
(2, 2, 'IMG_6531.JPG'),
(3, 3, 'IMG_6628.JPG'),
(4, 4, 'IMG_6733.JPG'),
(5, 70, 'IMG_6508.JPG'),
(6, 71, 'IMG_6304.JPG'),
(7, 82, 'IMG_6762.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `Discount_ID` int(5) NOT NULL,
  `Discount_Name` varchar(50) NOT NULL,
  `Discount_active` tinyint(1) NOT NULL,
  `Discount_Percent` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`Discount_ID`, `Discount_Name`, `Discount_active`, `Discount_Percent`) VALUES
(1, 'NODIS', 1, 0),
(2, 'DIS5', 1, 0.05),
(3, 'DIS10', 1, 0.1),
(4, 'DIS15', 1, 0.15);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `Member_ID` int(5) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Gender` varchar(6) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Member_ID`, `Username`, `Password`, `Name`, `Gender`, `Address`, `Email`, `Phone`, `Role`) VALUES
(1, 'Geronimo', 'yowzah', 'Panu', 'ชาย', '13 soi ramkhamhaeng64/4', 'panupongpnp02@gmail.com', '0937343745', 'customer'),
(2, 'phetlnw007', '0123456789', 'Admin_Phet', 'หญิง', NULL, 'Lnwza007@gmail.com', '0892598120', 'admin'),
(3, 'ashest', '20102001Ff', 'จีระพงศ์ แสนโพธิ์', 'ชาย', '9/133 bangkurud bangbuathong nonthaburi 11110', 'jeerapongsanpo@gmail.com', '0917320212', 'customer'),
(5, 'filmfake', 'love300', 'ณัฐชนนท์ โชติกวณิชย์', 'ชาย', '102/208 ซอย23 ตำบล ไทรม้า อำเภอเมืองนนทบุรี นนทบุรี 11000', 'nutchanon2001@hotmail.com', '0943562198', 'customer'),
(6, 'ninew1234', '123456789', 'วรินทร น้ำสอาด', 'หญิง', '1518 ถนน ​ประชา​ราษฎร์​1 แขวง วงศ์สว่าง เขตบางซื่อ กรุงเทพมหานคร 10800', 'warinthon69@gmail.com', '0823215614', 'customer'),
(7, 'Nemo', 'NongNemo4Y', 'ปิติ แย้ม', 'ชาย', '51/88 รามคำแหง 68', 'panupongap1212@gmail.com', '0851354952', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_ID` int(5) NOT NULL,
  `Order_Date` date NOT NULL,
  `Net` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_ID`, `Order_Date`, `Net`) VALUES
(1, '2022-10-04', 288),
(2, '2022-10-06', 249),
(3, '2022-10-07', 621),
(4, '2022-10-09', 279),
(70, '2022-11-19', 329),
(71, '2022-11-20', 799),
(72, '2022-11-21', 209),
(73, '2022-11-21', 387),
(74, '2022-11-21', 209),
(76, '2022-11-21', 398),
(77, '2022-11-21', 398),
(78, '2022-11-21', 388),
(79, '2022-11-21', 820),
(80, '2022-11-21', 621),
(81, '2022-11-21', 820),
(82, '2022-11-21', 448);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_ID` int(5) NOT NULL,
  `Product_name` varchar(100) NOT NULL,
  `Product_Desc` text NOT NULL,
  `Product_price` int(5) NOT NULL,
  `Product_quantity` int(5) NOT NULL,
  `Category_ID` int(5) DEFAULT NULL,
  `Discount_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Product_name`, `Product_Desc`, `Product_price`, `Product_quantity`, `Category_ID`, `Discount_ID`) VALUES
(1, 'เสื้อเชิ้ตเกาหลีชาย', 'สีขาว ผ้าป็อปปลินแท้ ทำให้เกิดรอยยับได้ยาก เหมาะกับการใส่ทำงาน', 199, 45, 1, 1),
(2, 'เสื้อเชิ้ตเกาหลีหญิง', 'สีขาว ผ้าลินินแท้ ดูดความชื้นและระบายความร้อนได้ดี', 249, 49, 2, 1),
(3, 'เสื้อถักแขนยาวหญิง', 'สีขาว ผ้าไหมแท้ นุ่มสบาย ระบบอากาศได้ดี', 279, 47, 2, 1),
(4, 'เสื้อแขนกุดหญิง', 'สีขาว ผ้าถักแท้  รอบอก34 ซม. ความยาว 34 ซม', 199, 28, 2, 1),
(5, 'เสื้อเชิ้ต คอเปิด แขนสั้นชาย', 'ทรงหลวมและให้สัมผัสอ่อนนุ่ม เหมาะสำหรับการใส่ตัวเดียวหรือเป็นเสื้อตัวนอก', 690, 56, 1, 3),
(6, 'กางเกงยีน ทรงหลวมสำหรับผู้ชาย', 'ผ้าเดนิมอย่างดี ทรงหลวม เหมาะสำหรับผู้ชายแต่ผู้ญิงก็ใส่ได้', 269, 41, 3, 1),
(7, 'กางเกงยีนส์ขาด ชาย', 'วัสดุ ผ้ายีนส์ เพิ่มความสดใสให้กับชุดของคุณ เหมาะสำหรับกิจกรรม', 199, 21, 3, 1),
(8, 'หมวกบักเก็ตลูกฟูก สีพื้น', 'เนื้อผ้า กำมะหยี่ ลูกฟูก ใส่เท่ห์ๆ คูลๆ อินเทรนด์ ขนาด รอบศีรษะ 56-58 ซม.', 89, 52, 5, 1),
(9, 'กางเกงขากระบอก หญิง', 'กางเกงทรงขากระบอกกลางถึงใหญ่ เพิ่มความมั่นใจให้กับสาวๆ รุ่นนี้สามารถใส่ทำงานหรือใส่เที่ยว ได้ทุกโอกาส', 189, 63, 4, 1),
(10, 'กางเกงขากระบอกเอวสูงเอวยางยืด', 'ผ้าฝ้าย เอวสูง เอวยืด ขากว้าง สไตล์กางเกงออกกำลังกาย', 299, 62, 4, 1),
(13, 'กางเกง เอวลอย', 'ลอยมาก เก่ามากๆ', 120, 53, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slip`
--

CREATE TABLE `slip` (
  `Slip_ID` int(5) NOT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `Member_ID` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slip`
--

INSERT INTO `slip` (`Slip_ID`, `Date`, `Time`, `Member_ID`) VALUES
(1, '2022-10-06', '13:01:00', 1),
(2, NULL, NULL, 3),
(3, NULL, NULL, 3),
(4, '2022-10-04', '19:55:02', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buying`
--
ALTER TABLE `buying`
  ADD PRIMARY KEY (`Product_ID`,`Order_ID`,`Member_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `confirm_order`
--
ALTER TABLE `confirm_order`
  ADD PRIMARY KEY (`Slip_ID`,`Order_ID`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`Discount_ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`Member_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`),
  ADD KEY `FK_product_category` (`Category_ID`),
  ADD KEY `FK_product_discount` (`Discount_ID`);

--
-- Indexes for table `slip`
--
ALTER TABLE `slip`
  ADD PRIMARY KEY (`Slip_ID`),
  ADD KEY `FK_membersilp` (`Member_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `confirm_order`
--
ALTER TABLE `confirm_order`
  MODIFY `Slip_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `Discount_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `Member_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `slip`
--
ALTER TABLE `slip`
  MODIFY `Slip_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_category` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`Category_ID`),
  ADD CONSTRAINT `FK_product_discount` FOREIGN KEY (`Discount_ID`) REFERENCES `discount` (`Discount_ID`);

--
-- Constraints for table `slip`
--
ALTER TABLE `slip`
  ADD CONSTRAINT `FK_membersilp` FOREIGN KEY (`Member_ID`) REFERENCES `member` (`Member_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
