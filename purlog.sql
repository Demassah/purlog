-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2014 at 05:28 
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
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ref_barang`
--

INSERT INTO `ref_barang` (`id`, `id_kategori`, `id_sub_kategori`, `kode_barang`, `nama_barang`, `status`) VALUES
(1, 2, 2, '001', 'Busi', '1'),
(2, 2, 2, '101', 'Asd', '1'),
(3, 3, 4, '002', 'Ban', '1'),
(4, 2, 2, '003', 'CPU', '1'),
(5, 3, 4, '004', 'Monitor', '1'),
(6, 2, 2, '005', 'Keyboard', '1'),
(7, 3, 4, '006', 'Mouse', '1'),
(8, 2, 2, '007', 'Meja', '1'),
(9, 3, 4, '008', 'Kursi', '1'),
(10, 3, 4, '009', 'Mobil', '1'),
(11, 3, 4, '010', 'Bis Pariwisata', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ref_departement`
--

CREATE TABLE IF NOT EXISTS `ref_departement` (
  `departement_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `departement_name` varchar(25) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`departement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `ref_departement`
--

INSERT INTO `ref_departement` (`departement_id`, `departement_name`, `status`) VALUES
(1, 'IT', '1'),
(15, 'Workshop', '1'),
(16, 'Heavy Equipment', '1'),
(17, 'Promotion', '1');

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
(2, 'Consumables', '1'),
(3, 'Not  Consumables', '1');

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
(2, 2, 'Barang Konsumsi', '1'),
(4, 3, 'Tak Habis', '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `sys_user`
--

INSERT INTO `sys_user` (`user_id`, `nik`, `user_name`, `full_name`, `passwd`, `departement_id`, `user_level_id`) VALUES
(1, 1111111, 'admin', 'administrator', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(11, 1111112, 'iqbal', 'Mochamad Iqbal', 'eedae20fc3c7a6e9c5b1102098771c70', 1, 1),
(12, 12345, 'harry', 'Harry Pret', '3b87c97d15e8eb11e51aa25e9a5770e9', 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `sys_user_level`
--

INSERT INTO `sys_user_level` (`user_level_id`, `level_name`, `level`) VALUES
(1, 'Administrator', 99),
(2, 'Logistic', 2),
(3, 'Purchasing', 3),
(4, 'Requestor', 1),
(5, 'Vendor', 4),
(6, 'Dept Manager', 5),
(7, 'Related Dept Manager', 6),
(8, 'Inventory', 7),
(9, 'Warehouse Man', 8),
(10, 'Inbound Receive Team', 9),
(11, 'Inbound Retur Team', 10),
(12, 'Outbond Distribution Team', 11),
(13, 'Courir', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tr_do`
--

CREATE TABLE IF NOT EXISTS `tr_do` (
  `id_do` int(11) NOT NULL AUTO_INCREMENT,
  `id_courir` varchar(21) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_do`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tr_do`
--


-- --------------------------------------------------------

--
-- Table structure for table `tr_do_detail`
--

CREATE TABLE IF NOT EXISTS `tr_do_detail` (
  `id_do_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_do` int(11) DEFAULT NULL,
  `id_sro` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_do_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tr_do_detail`
--


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
  `id_pr` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_ro` smallint(6) NOT NULL,
  `user_id` smallint(6) DEFAULT NULL,
  `purpose` varchar(21) DEFAULT NULL,
  `cat_req` varchar(21) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_pr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tr_pr`
--

INSERT INTO `tr_pr` (`id_pr`, `id_ro`, `user_id`, `purpose`, `cat_req`, `ext_doc_no`, `ETD`, `date_create`, `status`) VALUES
(1, 1, 1, 'REQUEST', 'ASSET', '001123456', '2014-12-10', '2014-12-10 06:20:36', 1),
(2, 2, 1, 'STOCK', 'ATK', '001123456', '2014-12-08', '2014-12-08 00:00:00', 2),
(3, 3, 1, 'REQUEST', 'SPAREPART', '001123456', '2014-12-08', '2014-12-09 21:09:35', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tr_pros_detail`
--

CREATE TABLE IF NOT EXISTS `tr_pros_detail` (
  `id_detail_pros` int(11) NOT NULL AUTO_INCREMENT,
  `id_detail_ro` int(11) DEFAULT NULL,
  `id_ro` int(11) DEFAULT NULL,
  `id_sro` int(11) DEFAULT NULL,
  `id_stock` int(11) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `id_lokasi` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_pros`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tr_pros_detail`
--

INSERT INTO `tr_pros_detail` (`id_detail_pros`, `id_detail_ro`, `id_ro`, `id_sro`, `id_stock`, `kode_barang`, `qty`, `id_lokasi`, `status`) VALUES
(1, 12, 2, 0, 2, '002', 100, 'A0201', 1),
(2, 12, 2, 0, 12, '002', 50, 'A0101', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_pr_detail`
--

CREATE TABLE IF NOT EXISTS `tr_pr_detail` (
  `id_detail_pr` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_pr` smallint(6) NOT NULL,
  `id_ro` int(11) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `user_id` smallint(6) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `note` text,
  `status` int(1) DEFAULT NULL,
  `status_delete` int(1) NOT NULL,
  PRIMARY KEY (`id_detail_pr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tr_pr_detail`
--

INSERT INTO `tr_pr_detail` (`id_detail_pr`, `id_pr`, `id_ro`, `ext_doc_no`, `kode_barang`, `qty`, `user_id`, `date_create`, `note`, `status`, `status_delete`) VALUES
(1, 1, 1, '001123456', '004', 50, 1, '2014-12-09 21:09:35', 'tes 1', 1, 0),
(2, 2, 2, '001123456', '005', 50, 1, '2014-12-08 00:00:00', 'tes 2', 3, 0),
(3, 2, 2, '001123456', '007', 150, 1, '2014-12-11 07:39:52', 'tes2', 2, 0),
(4, 2, 2, '001123456', '010', 75, 1, '2014-12-09 21:09:35', 'Yomannn', 2, 0),
(5, 2, 2, '001123456', '009', 25, 1, '2014-12-09 21:09:35', 'tes purchase request', 1, 0),
(6, 2, 2, '001123456', '002', 250, 1, '2014-12-10 06:20:36', 'tes allocate all', 1, 0),
(7, 3, 3, '001123456', '001', 25, 1, '2014-12-09 21:09:35', 'Tes data 1', 1, 0),
(8, 3, 3, '001123456', '005', 50, 1, '2014-12-08 00:00:00', 'Tes data 2', 1, 0),
(9, 3, 3, '001123456', '008', 125, 1, '2014-12-08 00:00:00', 'Tes data 3', 2, 0),
(10, 3, 3, '012345678', '010', 225, 1, '2014-12-11 12:13:21', 'Tes data 4', 3, 0),
(11, 3, 3, '0976541213', '003', 10, 1, '2014-12-11 12:13:56', 'Tes data 5', 3, 0);

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
  `id_ro` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(6) DEFAULT NULL,
  `purpose` varchar(21) DEFAULT NULL,
  `cat_req` varchar(21) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_ro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tr_ro`
--

INSERT INTO `tr_ro` (`id_ro`, `user_id`, `purpose`, `cat_req`, `ext_doc_no`, `ETD`, `date_create`, `status`) VALUES
(1, 1, 'REQUEST', 'ASSET', ' asd123', '2014-12-08', '2014-12-08 00:00:00', 2),
(2, 1, 'STOCK', 'ASSET', ' 001123456', '2014-12-08', '2014-12-08 00:00:00', 3),
(3, 1, 'SPAREPART', '023456712', '0976541213', '2014-12-09', '2014-12-09 20:58:54', 2),
(13, 1, 'REQUEST', 'ATK', '001123456', '2014-12-08', '2014-12-08 00:00:00', 3),
(14, 1, 'REQUEST', 'ATK', '001123456', '2014-12-08', '2014-12-08 00:00:00', 1),
(15, 1, 'REQUEST', 'SPAREPART', '001123456', '2014-12-08', '2014-12-08 00:00:00', 2),
(16, 1, 'STOCK', 'SPAREPART', '012345678', '2014-12-08', '2014-12-08 00:00:00', 3),
(18, 1, 'STOCK', 'ASSET', '001123456', '2014-12-10', '2014-12-10 06:20:36', 1),
(19, 1, 'REQUEST', 'ATK', '001123456', '2014-12-10', '2014-12-09 21:09:35', 3),
(20, 1, 'STOCK', 'SPAREPART', ' 098765543321', '2014-12-11', '2014-12-11 00:00:00', 1),
(21, 12, 'REQUEST', 'ATK', '098765543321', '2014-12-13', '2014-12-13 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_ros`
--

CREATE TABLE IF NOT EXISTS `tr_ros` (
  `id_ro` smallint(6) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(6) DEFAULT NULL,
  `purpose` varchar(21) DEFAULT NULL,
  `cat_req` varchar(21) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT '1: ros, 2: picking, 3:shipment',
  PRIMARY KEY (`id_ro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tr_ros`
--

INSERT INTO `tr_ros` (`id_ro`, `user_id`, `purpose`, `cat_req`, `ext_doc_no`, `ETD`, `date_create`, `status`) VALUES
(1, 1, 'REQUEST', 'ASSET', '001123456', '2014-12-10', '2014-12-10 06:20:36', 1),
(2, 1, 'STOCK', 'ATK', '001123456', '2014-12-08', '2014-12-08 00:00:00', 2),
(3, 1, 'REQUEST', 'SPAREPART', '001123456', '2014-12-08', '2014-12-09 21:09:35', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tr_ros_detail`
--

CREATE TABLE IF NOT EXISTS `tr_ros_detail` (
  `id_detail_ro` int(6) NOT NULL AUTO_INCREMENT,
  `id_ro` int(11) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `user_id` smallint(6) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `note` text,
  `status` int(1) DEFAULT NULL COMMENT '1: detail, 2: picking, 3: lock, 4: pending',
  `id_sro` smallint(6) NOT NULL,
  PRIMARY KEY (`id_detail_ro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tr_ros_detail`
--

INSERT INTO `tr_ros_detail` (`id_detail_ro`, `id_ro`, `ext_doc_no`, `kode_barang`, `qty`, `user_id`, `date_create`, `note`, `status`, `id_sro`) VALUES
(1, 1, '001123456', '004', 100, 1, '2014-12-09 21:09:35', 'tes 1', 2, 0),
(2, 2, '001123456', '005', 150, 1, '2014-12-08 00:00:00', 'tes 2', 2, 0),
(3, 2, '001123456', '007', 200, 1, '2014-12-11 07:39:52', 'tes2', 2, 0),
(4, 2, '001123456', '010', 250, 1, '2014-12-09 21:09:35', 'Yomannn', 2, 1),
(6, 2, '001123456', '009', 300, 1, '2014-12-09 21:09:35', 'tes purchase request', 2, 0),
(7, 3, '001123456', '001', 200, 1, '2014-12-09 21:09:35', 'Tes data 1', 2, 0),
(8, 3, '001123456', '005', 50, 1, '2014-12-08 00:00:00', 'Tes data 2', 2, 0),
(9, 3, '001123456', '008', 150, 1, '2014-12-08 00:00:00', 'Tes data 3', 2, 0),
(10, 3, '012345678', '010', 250, 1, '2014-12-11 12:13:21', 'Tes data 4', 2, 0),
(11, 3, '0976541213', '003', 200, 1, '2014-12-11 12:13:56', 'Tes data 5', 2, 0),
(12, 2, '001123456', '002', 150, 1, '2014-12-10 06:20:36', 'tes allocate all', 2, 0),
(15, 2, '001123456', '002', 100, 1, '2014-12-10 06:20:36', 'tes allocate all', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tr_ro_detail`
--

CREATE TABLE IF NOT EXISTS `tr_ro_detail` (
  `id_detail_ro` int(11) NOT NULL AUTO_INCREMENT,
  `id_ro` int(11) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `user_id` smallint(6) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `note` text,
  `status` int(1) DEFAULT NULL,
  `status_delete` int(1) NOT NULL,
  PRIMARY KEY (`id_detail_ro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tr_ro_detail`
--

INSERT INTO `tr_ro_detail` (`id_detail_ro`, `id_ro`, `ext_doc_no`, `kode_barang`, `qty`, `user_id`, `date_create`, `note`, `status`, `status_delete`) VALUES
(2, 1, '123456789', '002', 25, 1, '2014-12-09 13:25:58', 'KW 1', 1, 0),
(3, 1, '987654321', '003', 50, 1, '2014-12-09 13:25:58', 'KW Super', 1, 0),
(4, 16, '001123456', '004', 50, 1, '2014-12-09 21:09:35', 'ORI', 3, 0),
(5, 16, '001123456', '005', 50, 1, '2014-12-08 21:09:38', 'KW Super', 3, 0),
(6, 16, '001123456', '004', 50, 1, '2014-12-09 21:09:35', 'ORI', 3, 1),
(7, 16, '001123456', '005', 50, 1, '2014-12-08 21:09:38', 'KW Super', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tr_sro`
--

CREATE TABLE IF NOT EXISTS `tr_sro` (
  `id_sro` int(11) NOT NULL AUTO_INCREMENT,
  `id_ro` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_sro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tr_sro`
--

INSERT INTO `tr_sro` (`id_sro`, `id_ro`, `date_create`, `id_user`, `status`) VALUES
(2, 3, '2014-12-10 10:12:37', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_stock`
--

CREATE TABLE IF NOT EXISTS `tr_stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(5) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `id_lokasi` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tr_stock`
--

INSERT INTO `tr_stock` (`id_stock`, `kode_barang`, `qty`, `price`, `id_lokasi`, `status`) VALUES
(1, '001', 50, 1000, 'A0101', 1),
(2, '002', 0, 1000, 'A0201', 1),
(3, '003', 100, 1500, 'A0301', 1),
(4, '004', 25, 2000, 'A0402', 1),
(5, '005', 20, 500, 'A0101', 1),
(6, '006', 30, 1250, 'A0101', 1),
(7, '007', 300, 400, 'A0201', 1),
(8, '008', 500, 5000, 'A0301', 1),
(9, '009', 10, 75000, 'A0402', 1),
(10, '010', 25, 15000, 'A0201', 1),
(11, '011', 10, 2000, 'A0301', 1),
(12, '002', 0, 1000, 'A0101', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_trans_stock`
--

CREATE TABLE IF NOT EXISTS `tr_trans_stock` (
  `id_trans_stock` int(11) NOT NULL AUTO_INCREMENT,
  `id_stock` int(11) NOT NULL,
  `id_trans` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id_trans_stock`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tr_trans_stock`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
