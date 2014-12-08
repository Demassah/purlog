-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2014 at 02:12 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `purlog`
--

-- --------------------------------------------------------

--
-- Table structure for table `ref_barang`
--

CREATE TABLE IF NOT EXISTS `ref_barang` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_kategori` smallint(6) NOT NULL,
  `id_sub_kategori` smallint(6) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ref_barang`
--

INSERT INTO `ref_barang` (`id`, `id_kategori`, `id_sub_kategori`, `kode_barang`, `nama_barang`, `jumlah`, `status`) VALUES
(1, 2, 2, '001', 'Busi', 100, ''),
(2, 2, 2, '101', 'Asd', 25, ''),
(3, 3, 4, '002', 'Ban', 200, ''),
(4, 2, 2, '003', 'CPU', 50, ''),
(5, 3, 4, '004', 'Monitor', 75, ''),
(6, 2, 2, '005', 'Keyboard', 100, ''),
(7, 3, 4, '006', 'Mouse', 500, ''),
(8, 2, 2, '007', 'Meja', 1000, ''),
(9, 3, 4, '008', 'Kursi', 800, ''),
(10, 3, 4, '009', 'Mobil', 5000, ''),
(11, 3, 4, '010', 'Bis Pariwisata', 1000, '');

-- --------------------------------------------------------

--
-- Table structure for table `ref_departement`
--

CREATE TABLE IF NOT EXISTS `ref_departement` (
  `departement_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `departement_name` varchar(25) NOT NULL,
  PRIMARY KEY (`departement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ref_departement`
--

INSERT INTO `ref_departement` (`departement_id`, `departement_name`) VALUES
(1, 'IT'),
(2, 'Heavy Equipment'),
(3, 'Workshop'),
(4, 'Logistic'),
(5, 'Purchasing'),
(6, 'Promotion');

-- --------------------------------------------------------

--
-- Table structure for table `ref_kategori`
--

CREATE TABLE IF NOT EXISTS `ref_kategori` (
  `id_kategori` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(25) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ref_kategori`
--

INSERT INTO `ref_kategori` (`id_kategori`, `nama_kategori`, `status`) VALUES
(2, 'Consumables', ''),
(3, 'Not  Consumables', '');

-- --------------------------------------------------------

--
-- Table structure for table `ref_sub_kategori`
--

CREATE TABLE IF NOT EXISTS `ref_sub_kategori` (
  `id_sub_kategori` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_kategori` smallint(6) NOT NULL,
  `nama_sub_kategori` varchar(25) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id_sub_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ref_sub_kategori`
--

INSERT INTO `ref_sub_kategori` (`id_sub_kategori`, `id_kategori`, `nama_sub_kategori`, `status`) VALUES
(2, 2, 'Barang Konsumsi', ''),
(4, 3, 'Tak Habis', '');

-- --------------------------------------------------------

--
-- Table structure for table `sys_menu`
--

CREATE TABLE IF NOT EXISTS `sys_menu` (
  `menu_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `menu_group` varchar(30) DEFAULT NULL,
  `menu_name` varchar(50) DEFAULT NULL,
  `menu_parent` smallint(6) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `hide` smallint(6) DEFAULT NULL,
  `icon_class` varchar(30) DEFAULT NULL,
  `policy` varchar(50) DEFAULT '',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=39 ;

--
-- Dumping data for table `sys_menu`
--

INSERT INTO `sys_menu` (`menu_id`, `menu_group`, `menu_name`, `menu_parent`, `url`, `position`, `hide`, `icon_class`, `policy`) VALUES
(1, 'Administrator', 'Administrator', 0, '#', 99, 0, 'icon-administrator', 'ACCESS;'),
(2, 'Administrator', 'Otoritas Menu', 1, 'otoritas', 2, 0, 'icon-otoritas', 'ACCESS;ADD;EDIT;DETAIL;DELETE;'),
(3, 'Administrator', 'Pengguna', 1, 'pengguna', 3, 0, 'icon-user', 'ACCESS;ADD;EDIT;DELETE;'),
(4, 'Administrator', 'Departemen', 36, 'departement', 4, 0, 'icon-departement', 'ACCESS;ADD;EDIT;DELETE;'),
(5, 'Master Data', 'Master Data', 0, '#', 2, 0, 'icon-master', 'ACCESS;'),
(6, 'Master Data', 'Kategori', 5, 'kategori', 2, 0, 'icon-kategori', 'ACCESS;ADD;EDIT;DELETE;'),
(7, 'Master Data', 'Sub Kategori', 5, 'sub_kategori', 3, 0, 'icon-subkateg', 'ACCESS;ADD;EDIT;DELETE;'),
(8, 'Master Data', 'Barang', 5, 'barang', 4, 0, 'icon-barang', 'ACCESS;ADD;EDIT;DELETE;PRINT;IMPORT;'),
(9, 'Purchase', 'Purchase', 0, '#', 4, 0, 'icon-purchase', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(10, 'Logistic', 'Request Order', 34, 'request_order', 2, 0, 'icon-ro', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(11, 'Logistic', 'Request Order Selected', 34, 'request_order_selected', 5, 0, 'icon-ros', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(12, 'Logistic', 'Picking Request Order Selected', 34, 'picking_req_order_selected', 6, 0, 'icon-picking', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(13, 'Logistic', 'Shipment Request Order', 34, 'shipment_req_order', 7, 0, 'icon-shipment', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(14, 'Purchase', 'Purchase Request', 9, 'purchase_request', 7, 0, 'icon-pr', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(15, 'Purchase', 'Quotation Request Selected', 9, 'quotation_request_selected', 8, 0, 'icon-qrs', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(17, 'Purchase', 'Purchase Order', 9, 'purchase_order', 10, 0, 'icon-po', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(18, 'Purchase', 'Document Receive', 34, 'document_receive', 10, 0, 'icon-dr', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(19, 'Logistic', 'Delivery Order', 34, 'delivery_order', 8, 0, 'icon-delivery', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(20, 'Purchase', 'Berita Acara Pengembalian', 9, 'underconstruction', 12, 0, 'icon-bap', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(21, 'Purchase', 'Berita Acara Pengembalian Pengiriman', 9, 'underconstruction', 13, 0, 'icon-bapp', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(22, 'Logistic', 'Request Order Logistic', 34, 'request_order_logistic', 4, 0, 'icon-rol', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(23, 'Administrator', 'Menu', 1, 'menu', 1, 0, 'icon-menu', 'ACCESS;ADD;EDIT;DELETE;'),
(34, 'Logistic', 'Logistic', 0, '#', 3, 0, 'icon-logistic', 'ACCESS;'),
(36, 'Setup', 'Setup', 0, '#', 1, 0, 'icon-setup', 'ACCESS;'),
(37, 'Logistic', 'Request Order Approval', 34, 'request_order_approval', 3, 0, 'icon-approval', 'ACCESS;EDIT;DELETE;DETAIL;'),
(38, 'Logistic', 'Delivered', 34, 'delivered', 9, 0, 'icon-delivered', 'ACCESS;DETAIL;');

-- --------------------------------------------------------

--
-- Table structure for table `sys_user`
--

CREATE TABLE IF NOT EXISTS `sys_user` (
  `user_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nik` int(12) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `passwd` varchar(32) DEFAULT NULL,
  `departement_id` smallint(6) NOT NULL,
  `user_level_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `sys_user`
--

INSERT INTO `sys_user` (`user_id`, `nik`, `user_name`, `full_name`, `passwd`, `departement_id`, `user_level_id`) VALUES
(1, 1111111, 'admin', 'administrator', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(11, 1111112, 'iqbal', 'Mochamad Iqbal', 'eedae20fc3c7a6e9c5b1102098771c70', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_access`
--

CREATE TABLE IF NOT EXISTS `sys_user_access` (
  `user_access_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `menu_id` smallint(6) NOT NULL DEFAULT '0',
  `user_level_id` smallint(6) NOT NULL DEFAULT '0',
  `policy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_access_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=751 ;

--
-- Dumping data for table `sys_user_access`
--

INSERT INTO `sys_user_access` (`user_access_id`, `menu_id`, `user_level_id`, `policy`) VALUES
(1, 1, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(2, 2, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(3, 3, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(4, 4, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(727, 5, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(728, 6, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(729, 7, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(730, 8, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(731, 9, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(732, 10, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(733, 11, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(734, 12, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(735, 13, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(736, 14, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(737, 15, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(739, 17, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(740, 18, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(741, 19, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(742, 20, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(743, 21, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(744, 22, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(745, 23, 1, 'ACCESS;ADD;EDIT;DELETE;'),
(746, 34, 1, 'ACCESS;'),
(747, 35, 1, 'ACCESS;'),
(748, 36, 1, 'ACCESS;'),
(749, 37, 1, 'ACCESS;DETAIL;EDIT;DELETE;'),
(750, 38, 1, 'ACCESS;DETAIL;');

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_level`
--

CREATE TABLE IF NOT EXISTS `sys_user_level` (
  `user_level_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(40) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sys_user_level`
--

INSERT INTO `sys_user_level` (`user_level_id`, `level_name`, `level`) VALUES
(1, 'Administrator', 10000),
(2, 'Logistic', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_po`
--

CREATE TABLE IF NOT EXISTS `tr_po` (
  `id_po` varchar(21) NOT NULL,
  `id_pr` varchar(21) DEFAULT NULL,
  `id_ro` varchar(21) DEFAULT NULL,
  `requestor` varchar(21) DEFAULT NULL,
  `departement` varchar(21) DEFAULT NULL,
  `purpose` varchar(21) DEFAULT NULL,
  `cat_req` varchar(21) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_po`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tr_po`
--


-- --------------------------------------------------------

--
-- Table structure for table `tr_pr`
--

CREATE TABLE IF NOT EXISTS `tr_pr` (
  `id_pr` varchar(21) NOT NULL,
  `id_ro` varchar(21) DEFAULT NULL,
  `requestor` varchar(21) DEFAULT NULL,
  `departement` varchar(21) DEFAULT NULL,
  `purpose` varchar(21) DEFAULT NULL,
  `cat_req` varchar(21) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_pr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tr_pr`
--


-- --------------------------------------------------------

--
-- Table structure for table `tr_qr`
--

CREATE TABLE IF NOT EXISTS `tr_qr` (
  `id_qr` varchar(21) NOT NULL,
  `id_pr` varchar(21) DEFAULT NULL,
  `id_vendor` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_qr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tr_qr`
--


-- --------------------------------------------------------

--
-- Table structure for table `tr_qrs`
--

CREATE TABLE IF NOT EXISTS `tr_qrs` (
  `id_po` varchar(21) NOT NULL,
  `id_pr` varchar(21) DEFAULT NULL,
  `id_ro` varchar(21) DEFAULT NULL,
  `requestor` varchar(21) DEFAULT NULL,
  `departement` varchar(21) DEFAULT NULL,
  `purpose` varchar(21) DEFAULT NULL,
  `cat_req` varchar(21) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_po`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tr_qrs`
--


-- --------------------------------------------------------

--
-- Table structure for table `tr_qr_detail`
--

CREATE TABLE IF NOT EXISTS `tr_qr_detail` (
  `id_detail_qr` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(21) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_qr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tr_qr_detail`
--


-- --------------------------------------------------------

--
-- Table structure for table `tr_ro`
--

CREATE TABLE IF NOT EXISTS `tr_ro` (
  `id_ro` varchar(21) NOT NULL,
  `requestor` varchar(21) DEFAULT NULL,
  `departement` varchar(21) DEFAULT NULL,
  `purpose` varchar(21) DEFAULT NULL,
  `cat_req` varchar(21) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_ro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tr_ro`
--


-- --------------------------------------------------------

--
-- Table structure for table `tr_ros`
--

CREATE TABLE IF NOT EXISTS `tr_ros` (
  `id_ro` varchar(21) NOT NULL,
  `requestor` varchar(21) DEFAULT NULL,
  `departement` varchar(21) DEFAULT NULL,
  `purpose` varchar(21) DEFAULT NULL,
  `cat_req` varchar(21) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_ro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tr_ros`
--


-- --------------------------------------------------------

--
-- Table structure for table `v_barang`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purlog`.`v_barang` AS select `a`.`kode_barang` AS `kode_barang`,`a`.`nama_barang` AS `nama_barang`,`a`.`jumlah` AS `jumlah`,`b`.`nama_kategori` AS `nama_kategori`,`c`.`nama_sub_kategori` AS `nama_sub_kategori` from ((`purlog`.`ref_barang` `a` join `purlog`.`ref_kategori` `b` on((`a`.`id_kategori` = `b`.`id_kategori`))) join `purlog`.`ref_sub_kategori` `c` on((`a`.`id_sub_kategori` = `c`.`id_sub_kategori`)));

--
-- Dumping data for table `v_barang`
--

INSERT INTO `v_barang` (`kode_barang`, `nama_barang`, `jumlah`, `nama_kategori`, `nama_sub_kategori`) VALUES
('001', 'Busi', 100, 'Consumables', 'Barang Konsumsi'),
('101', 'Asd', 25, 'Consumables', 'Barang Konsumsi'),
('002', 'Ban', 200, 'Not  Consumables', 'Tak Habis'),
('003', 'CPU', 50, 'Consumables', 'Barang Konsumsi'),
('004', 'Monitor', 75, 'Not  Consumables', 'Tak Habis'),
('005', 'Keyboard', 100, 'Consumables', 'Barang Konsumsi'),
('006', 'Mouse', 500, 'Not  Consumables', 'Tak Habis'),
('007', 'Meja', 1000, 'Consumables', 'Barang Konsumsi'),
('008', 'Kursi', 800, 'Not  Consumables', 'Tak Habis'),
('009', 'Mobil', 5000, 'Not  Consumables', 'Tak Habis'),
('010', 'Bis Pariwisata', 1000, 'Not  Consumables', 'Tak Habis');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
