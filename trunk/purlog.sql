-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2014 at 06:49 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ref_barang`
--

INSERT INTO `ref_barang` (`id`, `id_kategori`, `id_sub_kategori`, `kode_barang`, `nama_barang`, `jumlah`) VALUES
(1, 2, 2, '001', 'Busi', 100),
(2, 2, 2, '002', 'Ban', 25);

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
(3, 'Not Consumables');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=70 ;

--
-- Dumping data for table `sys_menu`
--

INSERT INTO `sys_menu` (`menu_id`, `menu_group`, `menu_name`, `menu_parent`, `url`, `position`, `hide`, `icon_class`, `policy`) VALUES
(1, 'Administrator', 'Administrator', 0, '#', 99, 0, 'icon-administrator', 'ACCESS;'),
(2, 'Administrator', 'Otoritas Menu', 1, 'otoritas', 1, 0, 'icon-otoritas', 'ACCESS;ADD;EDIT;DELETE;'),
(3, 'Administrator', 'Pengguna', 1, 'pengguna', 2, 0, 'icon-pengguna', 'ACCESS;ADD;EDIT;DELETE;'),
(4, 'Administrator', 'Departemen', 1, 'departement', 3, 0, 'icon-departement', 'ACCESS;ADD;EDIT;DELETE;'),
(5, 'Master Data', 'Master Data', 0, '#', 1, 0, 'icon-master', 'ACCESS;'),
(6, 'Master Data', 'Kategori', 5, 'kategori', 2, 0, 'icon-kategori', 'ACCESS;ADD;EDIT;DELETE;'),
(7, 'Master Data', 'Sub Kategori', 5, 'sub_kategori', 3, 0, 'icon-sub_kategori', 'ACCESS;ADD;EDIT;DELETE;'),
(8, 'Master Data', 'Barang', 5, 'barang', 3, 0, 'icon-barang', 'ACCESS;ADD;EDIT;DELETE;'),
(9, 'Rancang', 'Rancang', 0, '#', 1, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(10, 'Rancang', 'Request Order', 9, '#', 2, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(11, 'Rancang', 'Detail RO', 9, '#', 3, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(12, 'Rancang', 'Request Order Selected', 9, '#', 4, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(13, 'Rancang', 'Detail ROS', 9, '#', 5, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(14, 'Rancang', 'Picking ROS', 9, '#', 6, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(15, 'Rancang', 'Detail PROS', 9, '#', 7, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(16, 'Rancang', 'Shipment Request Order', 9, '#', 8, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(17, 'Rancang', 'SRO Detail', 9, '#', 9, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(18, 'Rancang', 'Purchase Request', 9, '#', 10, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(19, 'Rancang', 'Detail PR', 9, '#', 11, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(20, 'Rancang', 'Quotation Request Selected', 9, '#', 12, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(21, 'Rancang', 'Detail QRS', 9, '#', 13, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(22, 'Rancang', 'Quotation Request Vendor', 9, '#', 14, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(23, 'Rancang', 'Purchase Order', 9, '#', 15, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(24, 'Rancang', 'Detail PO', 9, '#', 16, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(25, 'Rancang', 'Document Receive', 9, '#', 17, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(26, 'Rancang', 'Detail DR', 9, '#', 18, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(27, 'Rancang', 'Delivery Order', 9, '#', 19, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(28, 'Rancang', 'Detail DO', 9, '#', 20, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(29, 'Rancang', 'Berita Acara Pengembalian', 9, '#', 21, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(30, 'Rancang', 'Berita Acara Pengembalian Pengiriman', 9, '#', 22, 0, NULL, 'ACCESS;ADD;EDIT;DELETE;DETAIL;');

-- --------------------------------------------------------

--
-- Table structure for table `sys_user`
--

CREATE TABLE IF NOT EXISTS `sys_user` (
  `user_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_departemen` int(11) NOT NULL,
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

INSERT INTO `sys_user` (`user_id`, `id_departemen`, `user_name`, `full_name`, `passwd`, `departement_id`, `user_level_id`) VALUES
(1, 0, 'admin', 'administrator', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(11, 0, 'iqbal', 'Mochamad Iqbal', 'eedae20fc3c7a6e9c5b1102098771c70', 3, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=726 ;

--
-- Dumping data for table `sys_user_access`
--

INSERT INTO `sys_user_access` (`user_access_id`, `menu_id`, `user_level_id`, `policy`) VALUES
(1, 1, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(2, 2, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(3, 3, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(4, 4, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(700, 5, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(701, 7, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(702, 6, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(703, 8, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(704, 9, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(705, 10, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(706, 11, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(707, 12, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(708, 13, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(709, 14, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(710, 15, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(711, 16, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(712, 17, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(713, 18, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(714, 19, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(715, 20, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(716, 21, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(717, 22, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(718, 23, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(719, 24, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(720, 25, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(721, 26, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(722, 27, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(723, 28, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(724, 29, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;'),
(725, 30, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;');

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
(1, 'Administrator', 10000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
