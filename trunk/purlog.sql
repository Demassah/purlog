-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2014 at 10:34 PM
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ref_barang`
--

INSERT INTO `ref_barang` (`id`, `id_kategori`, `id_sub_kategori`, `kode_barang`, `nama_barang`, `jumlah`) VALUES
(1, 2, 2, '001', 'Busi', 100),
(2, 2, 2, '101', 'Asd', 25);

-- --------------------------------------------------------

--
-- Table structure for table `ref_kategori`
--

CREATE TABLE IF NOT EXISTS `ref_kategori` (
  `id_kategori` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(25) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ref_kategori`
--

INSERT INTO `ref_kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Consumables'),
(3, 'Not  Consumables');

-- --------------------------------------------------------

--
-- Table structure for table `ref_sub_kategori`
--

CREATE TABLE IF NOT EXISTS `ref_sub_kategori` (
  `id_sub_kategori` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_kategori` smallint(6) NOT NULL,
  `nama_sub_kategori` varchar(25) NOT NULL,
  PRIMARY KEY (`id_sub_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ref_sub_kategori`
--

INSERT INTO `ref_sub_kategori` (`id_sub_kategori`, `id_kategori`, `nama_sub_kategori`) VALUES
(2, 2, 'Barang Konsumsi'),
(4, 3, 'Tak Habis');

-- --------------------------------------------------------

--
-- Table structure for table `sys_departement`
--

CREATE TABLE IF NOT EXISTS `sys_departement` (
  `departement_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `departement_name` varchar(25) NOT NULL,
  PRIMARY KEY (`departement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sys_departement`
--

INSERT INTO `sys_departement` (`departement_id`, `departement_name`) VALUES
(1, 'IT'),
(2, 'Heavy Equipment'),
(3, 'Workshop'),
(4, 'Logistic'),
(5, 'Purchasing'),
(6, 'Promotion');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=34 ;

--
-- Dumping data for table `sys_menu`
--

INSERT INTO `sys_menu` (`menu_id`, `menu_group`, `menu_name`, `menu_parent`, `url`, `position`, `hide`, `icon_class`, `policy`) VALUES
(1, 'Administrator', 'Administrator', 0, '#', 99, 0, 'icon-administrator', 'ACCESS;'),
(2, 'Administrator', 'Otoritas Menu', 1, 'otoritas', 2, 0, 'icon-otoritas', 'ACCESS;ADD;EDIT;DETAIL;DELETE;'),
(3, 'Administrator', 'Pengguna', 1, 'pengguna', 3, 0, 'icon-user', 'ACCESS;ADD;EDIT;DELETE;'),
(4, 'Administrator', 'Departemen', 1, 'departement', 4, 0, 'icon-departement', 'ACCESS;ADD;EDIT;DELETE;'),
(5, 'Master Data', 'Master Data', 0, '#', 1, 0, 'icon-master', 'ACCESS;'),
(6, 'Master Data', 'Kategori', 5, 'kategori', 2, 0, 'icon-kategori', 'ACCESS;ADD;EDIT;DELETE;'),
(7, 'Master Data', 'Sub Kategori', 5, 'sub_kategori', 3, 0, 'icon-subkateg', 'ACCESS;ADD;EDIT;DELETE;'),
(8, 'Master Data', 'Barang', 5, 'barang', 4, 0, 'icon-barang', 'ACCESS;ADD;EDIT;DELETE;PRINT;IMPORT;'),
(9, 'Transaksi', 'Transaksi', 0, '#', 1, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(10, 'Transaksi', 'Request Order', 9, 'request_order', 2, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(11, 'Transaksi', 'Request Order Selected', 9, 'request_order_selected', 4, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(12, 'Transaksi', 'PROS', 9, 'pros', 5, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(13, 'Transaksi', 'Shipment Request Order', 9, 'sro', 6, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(14, 'Transaksi', 'Purchase Request', 9, 'pr', 7, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(15, 'Transaksi', 'Quotation Request Selected', 9, 'qrs', 8, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(16, 'Transaksi', 'Quotation Request Vendor', 9, 'qrv', 9, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(17, 'Transaksi', 'Purchase Order', 9, 'po', 10, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(18, 'Transaksi', 'Document Receive', 9, 'dr', 17, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(19, 'Transaksi', 'Delivery Order', 9, 'do', 11, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(20, 'Transaksi', 'Berita Acara Pengembalian', 9, 'bap', 12, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(21, 'Transaksi', 'Berita Acara Pengembalian Pengiriman', 9, 'bapp', 13, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(22, 'Transaksi', 'Request Order Logistic', 9, 'ro_logistic', 3, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(23, 'Administrator', 'Menu', 1, 'menu', 1, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=746 ;

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
(738, 16, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(739, 17, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(740, 18, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(741, 19, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(742, 20, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(743, 21, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(744, 22, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),
(745, 23, 1, 'ACCESS;ADD;EDIT;DELETE;');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
