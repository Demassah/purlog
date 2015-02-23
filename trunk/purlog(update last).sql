-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2015 at 04:15 PM
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
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(6) NOT NULL,
  `id_sub_kategori` int(6) NOT NULL,
  `kode_barang` varchar(21) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `id_satuan` int(6) DEFAULT NULL,
  `status` varchar(1) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1: fast moving, 2: slow moving, 3: new item',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ref_barang`
--

INSERT INTO `ref_barang` (`id`, `id_kategori`, `id_sub_kategori`, `kode_barang`, `nama_barang`, `id_satuan`, `status`, `type`) VALUES
(1, 1, 1, '100', 'PC', 5, '1', 1),
(2, 1, 2, '201', 'Microsoft Office', 2, '1', 2),
(3, 2, 6, '301', 'Lampu', 2, '1', 2),
(4, 2, 5, '302', 'Oli', 6, '1', 1),
(5, 1, 1, '202', 'New  Item - Hardware', 5, '1', 3),
(6, 1, 1, '203', 'Mouse', 2, '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ref_courir`
--

CREATE TABLE IF NOT EXISTS `ref_courir` (
  `id_courir` int(11) NOT NULL AUTO_INCREMENT,
  `name_courir` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `contact` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_courir`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ref_courir`
--

INSERT INTO `ref_courir` (`id_courir`, `name_courir`, `contact`, `status`) VALUES
(1, 'Asep Zaelani', '0811115214', 1),
(2, 'Jajang Nurjaman', '0857456895', 1),
(3, 'Dea fajarrr', '000000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_departement`
--

CREATE TABLE IF NOT EXISTS `ref_departement` (
  `departement_id` int(6) NOT NULL AUTO_INCREMENT,
  `departement_name` varchar(25) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`departement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `ref_departement`
--

INSERT INTO `ref_departement` (`departement_id`, `departement_name`, `status`) VALUES
(1, 'IT', '1'),
(15, 'Workshop', '1'),
(16, 'Heavy Equipment', '1'),
(17, 'Promotion', '1'),
(18, 'Bispar', '1'),
(19, 'Other', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ref_kategori`
--

CREATE TABLE IF NOT EXISTS `ref_kategori` (
  `id_kategori` int(6) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(25) NOT NULL,
  `type_kategri` varchar(21) DEFAULT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ref_kategori`
--

INSERT INTO `ref_kategori` (`id_kategori`, `nama_kategori`, `type_kategri`, `status`) VALUES
(1, 'IT', NULL, '1'),
(2, 'Sparepart', NULL, '1'),
(3, 'Furniture', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ref_lokasi`
--

CREATE TABLE IF NOT EXISTS `ref_lokasi` (
  `id_lks` int(11) NOT NULL AUTO_INCREMENT,
  `id_lokasi` varchar(21) NOT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '1. fast 2. slow',
  `storage` tinyint(1) DEFAULT NULL COMMENT '1. available 2. hold 3. damage',
  `status` tinyint(1) DEFAULT NULL COMMENT '1. active 2. inactive',
  PRIMARY KEY (`id_lks`,`id_lokasi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ref_lokasi`
--

INSERT INTO `ref_lokasi` (`id_lks`, `id_lokasi`, `type`, `storage`, `status`) VALUES
(1, 'A100', 1, 1, 1),
(2, 'B100', 2, 2, 1),
(3, 'C100', 2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ref_satuan`
--

CREATE TABLE IF NOT EXISTS `ref_satuan` (
  `id_satuan` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(21) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ref_satuan`
--

INSERT INTO `ref_satuan` (`id_satuan`, `nama_satuan`, `status`) VALUES
(1, 'Biji', 1),
(2, 'PCS', 1),
(3, 'Sachet', 1),
(4, 'Box', 1),
(5, 'Unit', 1),
(6, 'Liter', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_sub_kategori`
--

CREATE TABLE IF NOT EXISTS `ref_sub_kategori` (
  `id_sub_kategori` int(6) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(6) NOT NULL,
  `nama_sub_kategori` varchar(25) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id_sub_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ref_sub_kategori`
--

INSERT INTO `ref_sub_kategori` (`id_sub_kategori`, `id_kategori`, `nama_sub_kategori`, `status`) VALUES
(1, 1, 'Hardware', '1'),
(2, 1, 'Software', '1'),
(5, 2, 'Mesin', '1'),
(6, 2, 'Accecoris', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ref_vendor`
--

CREATE TABLE IF NOT EXISTS `ref_vendor` (
  `id_vendor` varchar(21) CHARACTER SET latin1 NOT NULL,
  `name_vendor` varchar(60) CHARACTER SET latin1 DEFAULT NULL,
  `address_vendor` text CHARACTER SET latin1,
  `contact_vendor` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `mobile_vendor` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_vendor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_vendor`
--

INSERT INTO `ref_vendor` (`id_vendor`, `name_vendor`, `address_vendor`, `contact_vendor`, `mobile_vendor`, `status`) VALUES
('V001', 'Adi', 'aa', '12', '34', 1),
('V002', 'iqbal', 'bb', '23', '45', 1),
('V003', 'Demas', 'cc', '34', '67', 1);

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
  `policy` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=54 ;

--
-- Dumping data for table `sys_menu`
--

INSERT INTO `sys_menu` (`menu_id`, `menu_group`, `menu_name`, `menu_parent`, `url`, `position`, `hide`, `icon_class`, `policy`) VALUES
(1, 'Administrator', 'Administrator', 0, '#', 99, 0, 'icon-administrator', 'ACCESS;'),
(2, 'Administrator', 'Otoritas Menu', 1, 'otoritas', 2, 0, 'icon-otoritas', 'ACCESS;ADD;EDIT;DETAIL;DELETE;'),
(3, 'Administrator', 'Pengguna', 1, 'pengguna', 3, 0, 'icon-user', 'ACCESS;ADD;EDIT;DELETE;'),
(4, 'Setup', 'Departemen', 36, 'departement', 2, 0, 'icon-departement', 'ACCESS;ADD;EDIT;DELETE;'),
(5, 'Master Data', 'Master Data', 0, '#', 2, 0, 'icon-master', 'ACCESS;'),
(6, 'Master Data', 'Kategori', 5, 'kategori', 2, 0, 'icon-kategori', 'ACCESS;ADD;EDIT;DELETE;'),
(7, 'Master Data', 'Sub Kategori', 5, 'sub_kategori', 3, 0, 'icon-subkateg', 'ACCESS;ADD;EDIT;DELETE;'),
(8, 'Master Data', 'Barang', 5, 'barang', 4, 0, 'icon-barang', 'ACCESS;ADD;EDIT;DELETE;PDF;'),
(9, 'Purchase', 'Purchase', 0, '#', 4, 0, 'icon-purchase', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(10, 'Logistic', 'Request Order', 34, 'request_order', 2, 0, 'icon-ro', 'ACCESS;ADD;EDIT;DELETE;DETAIL;APPROVE;PDF;'),
(11, 'Logistic', 'Request Order Selected', 34, 'request_order_selected', 5, 0, 'icon-ros', 'ACCESS;EDIT;DELETE;DETAIL;APPROVE;PDF;'),
(12, 'Logistic', 'Picking Request Order Selected', 34, 'picking_req_order_selected', 6, 0, 'icon-picking', 'ACCESS;DETAIL;EDIT;PDF;APPROVE;'),
(13, 'Logistic', 'Shipment Request Order', 34, 'shipment_req_order', 7, 0, 'icon-shipment', 'ACCESS;ADD;DETAIL;DELETE;PDF;APPROVE;'),
(14, 'Purchase', 'Purchase Request', 9, 'purchase_request', 7, 0, 'icon-pr', 'ACCESS;ADD;DELETE;DETAIL;APPROVE;'),
(15, 'Purchase', 'Quotation Request Selected', 9, 'quotation_request_selected', 8, 0, 'icon-qrs', 'ACCESS;ADD;DELETE;DETAIL;SELECT;APPROVE;'),
(17, 'Purchase', 'Purchase Order', 9, 'purchase_order', 10, 0, 'icon-po', 'ACCESS;ADD;DELETE;PDF;APPROVE;SELECT;'),
(18, 'Purchase', 'Document Receive', 34, 'document_receive', 10, 0, 'icon-dr', 'ACCESS;ADD;EDIT;DELETE;PRINT;IMPORT;PDF;EXCEL;APPROVE;'),
(19, 'Logistic', 'Delivery Order', 34, 'delivery_order', 8, 0, 'icon-delivery', 'ACCESS;ADD;DETAIL;DELETE;PDF;APPROVE;'),
(20, 'Purchase', 'Berita Acara Pengembalian', 9, 'underconstruction', 12, 0, 'icon-bap', 'ACCESS;ADD;EDIT;DELETE;DETAIL;'),
(21, 'Logistic', 'Return', 34, 'retur', 13, 0, 'icon-bapp', 'ACCESS;ADD;DETAIL;'),
(22, 'Logistic', 'Request Order Logistic', 34, 'request_order_logistic', 4, 0, 'icon-rol', 'ACCESS;DETAIL;APPROVE;'),
(23, 'Administrator', 'Menu', 1, 'menu', 1, 0, 'icon-menu', 'ACCESS;ADD;EDIT;DELETE;'),
(34, 'Logistic', 'Logistic', 0, '#', 3, 0, 'icon-logistic', 'ACCESS;'),
(36, 'Setup', 'Setup', 0, '#', 1, 0, 'icon-setup', 'ACCESS;'),
(37, 'Logistic', 'Request Order Approval', 34, 'request_order_approval', 3, 0, 'icon-approval', 'ACCESS;ADD;EDIT;DELETE;DETAIL;APPROVE;'),
(38, 'Logistic', 'Delivered', 34, 'delivered', 9, 0, 'icon-delivered', 'ACCESS;DETAIL;'),
(39, 'Purchase', 'Ordered', 9, 'ordered', 11, 0, 'icon-ordered', 'DETAIL;'),
(40, 'Logistic', 'Alocate Return', 34, 'alocate_return', 14, 1, '', 'ACCESS;DETAIL;'),
(41, 'Logistic', 'Inbound', 34, 'inbound', 20, 0, 'icon-inbound', 'ACCESS;ADD;DETAIL;DELETE;PDF;APPROVE;'),
(42, 'Logistic', 'Stock On Hand', 34, 'soh', 21, 0, 'icon-stock', 'ACCESS;'),
(43, 'Logistic', 'Transfer', 34, 'transfer', 26, 0, 'icon-transfer', 'ACCESS;ADD;EDIT;DELETE;DETAIL;APPROVE;'),
(44, 'Setup', 'Satuan', 36, 'satuan', 3, 0, 'icon-satuan', 'ACCESS;ADD;EDIT;DELETE;'),
(45, 'Master Data', 'Kurir', 5, 'courir', 5, 0, 'icon-po', 'ACCESS;ADD;EDIT;DELETE;'),
(46, 'Master Data', 'Lokasi', 5, 'lokasi', 6, 0, 'icon-otoritas', 'ACCESS;ADD;EDIT;DELETE;'),
(47, 'Laporan', 'Laporan', 0, '#', 5, 0, 'icon-ordered', 'ACCESS;'),
(48, 'Laporan', 'Laporan Picking', 47, 'laporan_picking', 1, 0, 'icon-po', 'PDF;EXCEL;'),
(49, 'Laporan', 'Laporan Delivery Order', 47, 'laporan_delivery', 2, 0, 'icon-po', 'PDF;EXCEL;'),
(50, 'Laporan', 'Laporan Document Receive', 47, 'laporan_document', 4, 0, 'icon-po', 'PDF;EXCEL;'),
(51, 'Laporan', 'Laporan Shipment', 47, 'laporan_shipment', 3, 0, 'icon-po', 'PDF;EXCEL;'),
(52, 'Laporan', 'Laporan Inbound', 47, 'laporan_inbound', 5, 0, 'icon-po', 'PDF;EXCEL;'),
(53, 'Laporan', 'Laporan Purchase', 47, 'laporan_purchase', 6, 0, 'icon-po', 'PDF;EXCEL;');

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
  `departement_id` smallint(6) DEFAULT NULL,
  `user_level_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `sys_user`
--

INSERT INTO `sys_user` (`user_id`, `nik`, `user_name`, `full_name`, `passwd`, `departement_id`, `user_level_id`) VALUES
(1, 1111111, 'admin', 'administrator', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(11, 1111112, 'iqbal', 'Mochamad Iqbal', 'eedae20fc3c7a6e9c5b1102098771c70', 15, 1),
(12, 12345, 'harry', 'Harry Pret', '3b87c97d15e8eb11e51aa25e9a5770e9', 17, 1),
(13, 5757, 'demas', 'Demassah', 'd8f08986e8072e78bf9295c294ef3bc2', 1, 1),
(14, 3453, 'asd', 'logistic', '7815696ecbf1c96e6894b779456d330e', 19, 2),
(15, 56361, 'tes', 'tes', '28b662d883b6d76fd96e4ddc5e9ba780', 0, 1),
(16, 112233, 'superadmin', 'Superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 19, 14),
(17, 9988, 'operator', 'operator', '4b583376b2767b923c3e1da60d10de59', NULL, 1),
(18, 9988, 'requestor', 'Requestor', '560115e15fdc6b37096d514904104a57', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_access`
--

CREATE TABLE IF NOT EXISTS `sys_user_access` (
  `user_access_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `menu_id` smallint(6) NOT NULL DEFAULT '0',
  `user_level_id` smallint(6) NOT NULL DEFAULT '0',
  `policy` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`user_access_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=830 ;

--
-- Dumping data for table `sys_user_access`
--

INSERT INTO `sys_user_access` (`user_access_id`, `menu_id`, `user_level_id`, `policy`) VALUES
(1, 1, 1, 'ACCESS;'),
(2, 2, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;'),
(3, 3, 1, 'ACCESS;ADD;EDIT;DELETE;'),
(4, 4, 1, 'ACCESS;ADD;EDIT;DELETE;'),
(727, 5, 1, 'ACCESS;'),
(728, 6, 1, 'ACCESS;ADD;EDIT;DELETE;'),
(729, 7, 1, 'ACCESS;ADD;EDIT;DELETE;'),
(730, 8, 1, 'ACCESS;ADD;EDIT;DELETE;'),
(731, 9, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;'),
(732, 10, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;APPROVE;'),
(733, 11, 1, 'ACCESS;DETAIL;EDIT;DELETE;APPROVE;'),
(734, 12, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(735, 13, 1, 'ACCESS;ADD;DETAIL;DELETE;PRINT;PDF;APPROVE;'),
(736, 14, 1, 'ACCESS;ADD;DETAIL;DELETE;APPROVE;'),
(737, 15, 1, 'ACCESS;ADD;DETAIL;DELETE;SELECT;APPROVE;'),
(739, 17, 1, 'ACCESS;ADD;EDIT;DELETE;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(740, 18, 1, 'ACCESS;ADD;EDIT;DELETE;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(741, 19, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;PDF;APPROVE;'),
(742, 20, 1, ''),
(743, 21, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;'),
(744, 22, 1, 'ACCESS;DETAIL;EDIT;DELETE;APPROVE;'),
(745, 23, 1, 'ACCESS;ADD;EDIT;DELETE;'),
(746, 34, 1, 'ACCESS;'),
(747, 35, 1, 'ACCESS;'),
(748, 36, 1, 'ACCESS;'),
(749, 37, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;APPROVE;'),
(750, 38, 1, 'ACCESS;DETAIL;'),
(751, 39, 1, 'ACCESS;DETAIL;'),
(752, 40, 1, 'ACCESS;DETAIL;'),
(753, 41, 1, 'ACCESS;ADD;DETAIL;DELETE;PDF;APPROVE;'),
(754, 42, 1, 'ACCESS;'),
(755, 43, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;APPROVE;'),
(756, 44, 1, 'ACCESS;ADD;EDIT;DELETE;'),
(757, 36, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(758, 4, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(759, 44, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(760, 5, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(761, 6, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(762, 7, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(763, 8, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(764, 34, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(765, 10, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(766, 37, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(767, 22, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(768, 11, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(769, 12, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(770, 13, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(771, 19, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(772, 38, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(773, 21, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(774, 40, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(775, 41, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(776, 42, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(777, 43, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(778, 9, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(779, 14, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(780, 15, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(781, 17, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(782, 39, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(783, 20, 14, ''),
(784, 18, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(785, 1, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(786, 23, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(787, 2, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(788, 3, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(789, 36, 4, ''),
(790, 4, 4, ''),
(791, 44, 4, ''),
(792, 5, 4, 'ACCESS;'),
(793, 6, 4, 'ACCESS;'),
(794, 7, 4, 'ACCESS;'),
(795, 8, 4, 'ACCESS;'),
(796, 34, 4, ''),
(797, 10, 4, ''),
(798, 37, 4, ''),
(799, 22, 4, ''),
(800, 11, 4, ''),
(801, 12, 4, ''),
(802, 13, 4, ''),
(803, 19, 4, ''),
(804, 38, 4, ''),
(805, 21, 4, ''),
(806, 40, 4, ''),
(807, 41, 4, ''),
(808, 42, 4, ''),
(809, 43, 4, ''),
(810, 9, 4, ''),
(811, 14, 4, ''),
(812, 15, 4, ''),
(813, 17, 4, ''),
(814, 39, 4, ''),
(815, 20, 4, ''),
(816, 18, 4, ''),
(817, 1, 4, ''),
(818, 23, 4, ''),
(819, 2, 4, ''),
(820, 3, 4, ''),
(821, 45, 1, 'ACCESS;ADD;EDIT;DELETE;'),
(822, 46, 1, 'ACCESS;ADD;EDIT;DELETE;'),
(823, 47, 1, 'ACCESS;'),
(824, 48, 1, 'ACCESS;PDF;EXCEL;'),
(825, 49, 1, 'ACCESS;PDF;EXCEL;'),
(826, 51, 1, 'ACCESS;PDF;EXCEL;'),
(827, 50, 1, 'ACCESS;PDF;EXCEL;'),
(828, 52, 1, 'ACCESS;PDF;EXCEL;'),
(829, 53, 1, 'ACCESS;PDF;EXCEL;');

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_level`
--

CREATE TABLE IF NOT EXISTS `sys_user_level` (
  `user_level_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(40) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

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
(13, 'Courir', 12),
(14, 'Superadmin', 999);

-- --------------------------------------------------------

--
-- Table structure for table `tr_do`
--

CREATE TABLE IF NOT EXISTS `tr_do` (
  `id_do` int(11) NOT NULL AUTO_INCREMENT,
  `id_courir` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_do`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tr_do`
--

INSERT INTO `tr_do` (`id_do`, `id_courir`, `date_create`, `id_user`, `status`) VALUES
(1, 1, '2015-01-20 11:08:30', '1', 2),
(2, 2, '2015-01-20 11:08:53', '1', 2),
(4, 1, '2015-02-10 14:32:43', '16', 2);

--
-- Triggers `tr_do`
--
DROP TRIGGER IF EXISTS `after_update_do`;
DELIMITER //
CREATE TRIGGER `after_update_do` AFTER UPDATE ON `tr_do`
 FOR EACH ROW BEGIN
    IF new.status = 2 THEN
	UPDATE tr_sro SET STATUS = 2  WHERE id_do = old.id_do;
   END IF;
    END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `after_delete_do`;
DELIMITER //
CREATE TRIGGER `after_delete_do` AFTER DELETE ON `tr_do`
 FOR EACH ROW BEGIN	UPDATE tr_sro SET id_do = NULL WHERE id_do = old.id_do;    END
//
DELIMITER ;

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
-- Table structure for table `tr_in`
--

CREATE TABLE IF NOT EXISTS `tr_in` (
  `id_in` int(11) NOT NULL AUTO_INCREMENT,
  `ext_rec_no` int(11) DEFAULT NULL,
  `type` varchar(21) CHARACTER SET utf8 DEFAULT NULL COMMENT 'PO, Return',
  `date_create` datetime DEFAULT NULL,
  `user_id` smallint(6) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_in`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tr_in`
--

INSERT INTO `tr_in` (`id_in`, `ext_rec_no`, `type`, `date_create`, `user_id`, `status`) VALUES
(10, 17, '1', '2015-02-12 10:24:42', 16, 1);

--
-- Triggers `tr_in`
--
DROP TRIGGER IF EXISTS `after_update_in`;
DELIMITER //
CREATE TRIGGER `after_update_in` AFTER UPDATE ON `tr_in`
 FOR EACH ROW BEGIN
IF new.status = 2 and new.type = 1 THEN
CALL p_in_po(new.id_in);
CALL p_in_stock(new.id_in);	
END IF;




    END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `before_delete_inbound`;
DELIMITER //
CREATE TRIGGER `before_delete_inbound` BEFORE DELETE ON `tr_in`
 FOR EACH ROW BEGIN
	delete from tr_in_detail where id_in = old.id_in;
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tr_in_detail`
--

CREATE TABLE IF NOT EXISTS `tr_in_detail` (
  `id_detail_in` int(11) NOT NULL AUTO_INCREMENT,
  `id_in` int(11) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `ext_rec_no_detail` int(11) DEFAULT NULL,
  `lokasi` varchar(21) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_in`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `tr_in_detail`
--

INSERT INTO `tr_in_detail` (`id_detail_in`, `id_in`, `kode_barang`, `qty`, `ext_rec_no_detail`, `lokasi`, `status`) VALUES
(61, 10, '203', 2, 28, 'A100', 1),
(62, 10, '203', 1, 28, 'A100', 1),
(63, 10, '201', 3, 27, 'A100', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_notifikasi`
--

CREATE TABLE IF NOT EXISTS `tr_notifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `context` text,
  `url` varchar(255) DEFAULT NULL,
  `id_object` int(11) NOT NULL,
  `status` int(11) DEFAULT '0',
  `tanggal` date DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `binding_type` int(11) NOT NULL,
  `binding_id` int(11) NOT NULL,
  `user_level_id` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `tr_notifikasi`
--

INSERT INTO `tr_notifikasi` (`id`, `context`, `url`, `id_object`, `status`, `tanggal`, `type`, `binding_type`, `binding_id`, `user_level_id`) VALUES
(41, 'Request Order telah dikirim ke RO Approval', 'request_order_approval', 19, 0, '0000-00-00', 1, 1, 1, 2),
(42, 'Purchase Request Baru telah dibuat', 'purchase_request', 4, 0, '0000-00-00', 3, 1, 1, 3),
(43, 'Request Order Baru telah dibuat', 'request_order', 20, 0, '0000-00-00', 1, 1, 1, 2),
(44, 'Request Order telah dikirim ke RO Approval', 'request_order_approval', 20, 0, '0000-00-00', 1, 1, 1, 2),
(45, 'Purchase Request Baru telah dibuat', 'purchase_request', 5, 0, '0000-00-00', 3, 1, 1, 3),
(46, 'Request Order Baru telah dibuat', 'request_order', 21, 0, '0000-00-00', 1, 1, 1, 2),
(47, 'Request Order telah dikirim ke RO Approval', 'request_order_approval', 21, 0, '0000-00-00', 1, 1, 1, 2),
(48, 'RO Approval telah dikirim ke RO Logistic', 'request_order_logistic', 21, 0, '0000-00-00', 1, 1, 1, 2),
(49, 'RO Logistic telah dikirim ke RO Selected', 'request_order_selected', 21, 0, '0000-00-00', 1, 1, 1, 2),
(50, 'Purchase Request Baru telah dibuat', 'purchase_request', 6, 0, '0000-00-00', 3, 1, 1, 3),
(51, 'Request Order Baru telah dibuat', 'request_order', 22, 1, '0000-00-00', 1, 1, 1, 2),
(52, 'Request Order Baru telah dibuat', 'request_order', 23, 0, '0000-00-00', 1, 1, 1, 2),
(53, 'Request Order telah dikirim ke RO Approval', 'request_order_approval', 23, 0, '0000-00-00', 1, 1, 1, 2),
(54, 'RO Approval telah dikirim ke RO Logistic', 'request_order_logistic', 23, 0, '0000-00-00', 1, 1, 1, 2),
(55, 'RO Logistic telah dikirim ke RO Selected', 'request_order_selected', 23, 1, '0000-00-00', 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tr_po`
--

CREATE TABLE IF NOT EXISTS `tr_po` (
  `id_po` int(11) NOT NULL AUTO_INCREMENT,
  `id_qrs` int(11) DEFAULT NULL,
  `id_pr` int(11) DEFAULT NULL,
  `id_ro` int(11) DEFAULT NULL,
  `requestor` varchar(21) DEFAULT NULL,
  `departement` varchar(21) DEFAULT NULL,
  `purpose` varchar(21) DEFAULT NULL,
  `cat_req` varchar(21) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_po`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tr_po`
--

INSERT INTO `tr_po` (`id_po`, `id_qrs`, `id_pr`, `id_ro`, `requestor`, `departement`, `purpose`, `cat_req`, `ext_doc_no`, `ETD`, `date_create`, `status`) VALUES
(17, 13, 1, 1, '16', '19', 'REQUEST', 'ASSET', 'SPK/123', '2015-01-20', '2015-02-06 22:21:31', 2),
(18, 14, 1, 1, '16', '19', 'REQUEST', 'ASSET', 'SPK/123', '2015-01-20', '2015-02-06 22:26:10', 1),
(19, 16, 6, 21, '16', '19', 'REQUEST', 'ASSET', '12354', '2015-02-06', '2015-02-07 01:01:24', 2),
(20, 17, 6, 21, '16', '19', 'REQUEST', 'ASSET', '12354', '2015-02-06', '2015-02-12 09:46:36', 2);

--
-- Triggers `tr_po`
--
DROP TRIGGER IF EXISTS `after_insert_po`;
DELIMITER //
CREATE TRIGGER `after_insert_po` AFTER INSERT ON `tr_po`
 FOR EACH ROW BEGIN 
   update tr_qrs set id_po = new.id_po where id_qrs = new.id_qrs;
   update tr_qr set id_po = new.id_po where id_qrs  = new.id_qrs and status = '2'; 
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `after_delete_po`;
DELIMITER //
CREATE TRIGGER `after_delete_po` AFTER DELETE ON `tr_po`
 FOR EACH ROW BEGIN
  update tr_qr set id_po = 0 where id_po = old.id_po;
update tr_qrs set id_po = null where id_po = old.id_po;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tr_pr`
--

CREATE TABLE IF NOT EXISTS `tr_pr` (
  `id_pr` int(11) NOT NULL AUTO_INCREMENT,
  `id_ro` int(11) NOT NULL,
  `id_po` int(11) DEFAULT NULL,
  `user_id` smallint(6) DEFAULT NULL,
  `purpose` varchar(21) DEFAULT NULL,
  `cat_req` varchar(21) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_pr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tr_pr`
--

INSERT INTO `tr_pr` (`id_pr`, `id_ro`, `id_po`, `user_id`, `purpose`, `cat_req`, `ext_doc_no`, `ETD`, `date_create`, `status`) VALUES
(1, 1, NULL, 1, 'REQUEST', 'ASSET', 'SPK/123', '2015-01-20', '2015-01-20 09:22:32', 2),
(4, 19, NULL, 1, 'REQUEST', 'ASSET', '1', '2015-02-03', '2015-02-03 12:48:48', 2),
(5, 20, NULL, 1, 'REQUEST', 'ATK', '1234', '2015-02-04', '2015-02-04 16:27:03', 2),
(6, 21, NULL, 16, 'REQUEST', 'ASSET', '12354', '2015-02-06', '2015-02-06 17:28:29', 2);

--
-- Triggers `tr_pr`
--
DROP TRIGGER IF EXISTS `before_delete_pr`;
DELIMITER //
CREATE TRIGGER `before_delete_pr` BEFORE DELETE ON `tr_pr`
 FOR EACH ROW BEGIN
	update tr_pr_detail set id_pr = null, status =  1 where id_pr = old.id_pr;
    END
//
DELIMITER ;

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
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `status_receive` smallint(1) DEFAULT '0',
  `status_picking` smallint(1) DEFAULT NULL COMMENT '1: picking 2: purchase 3: return',
  PRIMARY KEY (`id_detail_pros`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tr_pros_detail`
--

INSERT INTO `tr_pros_detail` (`id_detail_pros`, `id_detail_ro`, `id_ro`, `id_sro`, `id_stock`, `kode_barang`, `qty`, `id_lokasi`, `date_create`, `status`, `status_receive`, `status_picking`) VALUES
(1, 4, 2, 1, 1, '301', 4, 'Workshop', '2015-01-19 20:06:59', 1, 1, 1),
(2, 5, 3, 2, 2, '302', 3, 'Workshop', '2015-01-19 20:07:24', 1, 1, 1),
(3, 9, 19, 3, 3, '201', 3, 'Pusat', '2015-02-03 13:51:25', 1, 1, 1),
(4, 13, 21, NULL, 0, '201', 23, 'CROSSDOCK', '2015-02-07 02:02:53', 1, 0, 2),
(5, 13, 21, NULL, 0, '201', 54, 'CROSSDOCK', '2015-02-07 02:02:53', 1, 0, 2);

--
-- Triggers `tr_pros_detail`
--
DROP TRIGGER IF EXISTS `after_insert_alocation`;
DELIMITER //
CREATE TRIGGER `after_insert_alocation` AFTER INSERT ON `tr_pros_detail`
 FOR EACH ROW BEGIN
	UPDATE purlog.tr_stock SET tr_stock.qty = tr_stock.qty - new.qty WHERE tr_stock.id_stock = new.id_stock;
    END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `after_update_allocate`;
DELIMITER //
CREATE TRIGGER `after_update_allocate` AFTER UPDATE ON `tr_pros_detail`
 FOR EACH ROW BEGIN
	UPDATE tr_stock SET qty = qty + (old.qty - new.qty) WHERE id_stock = old.id_stock;	
	
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tr_pr_detail`
--

CREATE TABLE IF NOT EXISTS `tr_pr_detail` (
  `id_detail_pr` int(11) NOT NULL AUTO_INCREMENT,
  `id_pr` int(11) NOT NULL,
  `id_detail_ro` int(11) DEFAULT NULL,
  `id_ro` int(11) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `user_id` smallint(6) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `note` text,
  `status` int(1) DEFAULT NULL,
  `status_delete` int(1) NOT NULL,
  PRIMARY KEY (`id_detail_pr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tr_pr_detail`
--

INSERT INTO `tr_pr_detail` (`id_detail_pr`, `id_pr`, `id_detail_ro`, `id_ro`, `kode_barang`, `qty`, `user_id`, `date_create`, `note`, `status`, `status_delete`) VALUES
(1, 1, 1, 1, '100', 20, 1, '2015-01-19 18:30:40', NULL, 2, 0),
(2, 1, 2, 1, '201', 10, 1, '2015-01-19 18:30:40', NULL, 2, 0),
(3, 1, 3, 1, '203', 5, 1, '2015-01-19 18:30:40', NULL, 2, 0),
(4, 0, 4, 2, '301', 1, 1, '2015-01-19 20:07:18', NULL, 1, 0),
(5, 4, 9, 19, '201', 2, 1, '2015-02-03 13:51:08', NULL, 2, 0),
(6, 5, 10, 20, '100', 34, 1, '2015-02-04 16:29:20', NULL, 2, 0),
(7, 5, 11, 20, '302', 12, 1, '2015-02-04 16:29:20', NULL, 2, 0),
(8, 5, 12, 20, '100', 12, 1, '2015-02-04 16:29:20', NULL, 2, 0),
(9, 6, 13, 21, '201', 123, 16, '2015-02-06 17:37:37', NULL, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tr_qr`
--

CREATE TABLE IF NOT EXISTS `tr_qr` (
  `id_qr` int(11) NOT NULL AUTO_INCREMENT,
  `id_qrs` int(11) DEFAULT NULL,
  `id_pr` int(11) DEFAULT NULL,
  `id_vendor` varchar(21) DEFAULT NULL,
  `id_po` int(11) DEFAULT '0',
  `top` int(3) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  PRIMARY KEY (`id_qr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=55 ;

--
-- Dumping data for table `tr_qr`
--

INSERT INTO `tr_qr` (`id_qr`, `id_qrs`, `id_pr`, `id_vendor`, `id_po`, `top`, `ETD`, `status`) VALUES
(43, 13, 1, 'V001', 17, 2, '2015-02-06', 2),
(44, 13, 1, 'V002', 0, 4, '2015-02-06', 1),
(45, 13, 1, 'V003', 0, 5, '2015-02-06', 1),
(46, 14, 1, 'V001', 0, 13, '2015-02-06', 1),
(47, 14, 1, 'V002', 18, 4, '2015-02-06', 2),
(48, 14, 1, 'V003', 0, 5, '2015-02-06', 1),
(49, 16, 6, 'V001', 0, 12, '2015-02-07', 1),
(50, 16, 6, 'V002', 19, 2, '2015-02-07', 2),
(51, 16, 6, 'V003', 0, 3, '2015-02-07', 1),
(52, 17, 6, 'V001', 0, 12, '2015-02-12', 1),
(53, 17, 6, 'V002', 20, 2, '2015-02-12', 2),
(54, 17, 6, 'V003', 0, 4, '2015-02-12', 1);

--
-- Triggers `tr_qr`
--
DROP TRIGGER IF EXISTS `after_insert_qr`;
DELIMITER //
CREATE TRIGGER `after_insert_qr` AFTER INSERT ON `tr_qr`
 FOR EACH ROW BEGIN
    CALL p_qrs_detail(new.id_pr, new.id_qr,new.id_qrs);
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `before_delete_qr`;
DELIMITER //
CREATE TRIGGER `before_delete_qr` BEFORE DELETE ON `tr_qr`
 FOR EACH ROW BEGIN
	delete from tr_qr_detail where id_qr = old.id_qr;
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tr_qrs`
--

CREATE TABLE IF NOT EXISTS `tr_qrs` (
  `id_qrs` int(11) NOT NULL AUTO_INCREMENT,
  `id_po` int(11) DEFAULT NULL,
  `id_pr` int(11) DEFAULT NULL,
  `id_ro` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_id` smallint(6) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_qrs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tr_qrs`
--

INSERT INTO `tr_qrs` (`id_qrs`, `id_po`, `id_pr`, `id_ro`, `date_create`, `user_id`, `status`) VALUES
(13, 17, 1, 1, '2015-02-06 01:58:36', 1, 2),
(14, 18, 1, 1, '2015-02-06 01:59:06', 1, 2),
(16, 19, 6, 21, '2015-02-07 00:59:54', 16, 2),
(17, 20, 6, 21, '2015-02-07 01:00:11', 16, 2),
(18, NULL, 5, 20, '2015-02-12 10:18:21', 16, 1);

--
-- Triggers `tr_qrs`
--
DROP TRIGGER IF EXISTS `before_delete_qrs`;
DELIMITER //
CREATE TRIGGER `before_delete_qrs` BEFORE DELETE ON `tr_qrs`
 FOR EACH ROW BEGIN
  delete from tr_qrs_detail where id_qrs = old.id_qrs;
  delete from tr_qr where id_pr = old.id_pr and id_qrs=old.id_qrs;
  delete from tr_qr_detail where id_pr = old.id_pr and id_qrs = old.id_qrs;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tr_qrs_detail`
--

CREATE TABLE IF NOT EXISTS `tr_qrs_detail` (
  `id_detail_qrs` int(11) NOT NULL AUTO_INCREMENT,
  `id_qrs` int(11) DEFAULT NULL,
  `id_pr` int(11) DEFAULT NULL,
  `id_detail_pr` int(11) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_qrs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=37 ;

--
-- Dumping data for table `tr_qrs_detail`
--

INSERT INTO `tr_qrs_detail` (`id_detail_qrs`, `id_qrs`, `id_pr`, `id_detail_pr`, `kode_barang`, `qty`, `status`) VALUES
(26, 13, 1, 1, '100', 4, 1),
(27, 13, 1, 2, '201', 3, 1),
(28, 13, 1, 3, '203', 3, 1),
(29, 14, 1, 1, '100', 4, 1),
(30, 14, 1, 2, '201', 4, 1),
(31, 14, 1, 3, '203', 1, 1),
(32, 16, 6, 9, '201', 100, 1),
(36, 17, 6, 9, '201', 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_qr_detail`
--

CREATE TABLE IF NOT EXISTS `tr_qr_detail` (
  `id_detail_qr` int(11) NOT NULL AUTO_INCREMENT,
  `id_qr` int(11) DEFAULT NULL,
  `id_qrs` int(11) DEFAULT NULL,
  `id_detail_pr` int(11) DEFAULT NULL,
  `id_pr` int(11) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT '0',
  `price` bigint(12) DEFAULT '0',
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id_detail_qr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=161 ;

--
-- Dumping data for table `tr_qr_detail`
--

INSERT INTO `tr_qr_detail` (`id_detail_qr`, `id_qr`, `id_qrs`, `id_detail_pr`, `id_pr`, `kode_barang`, `qty`, `price`, `date_create`, `status`) VALUES
(137, 43, 13, 1, 1, '100', 4, 12, '2015-02-06 01:58:54', 1),
(138, 43, 13, 2, 1, '201', 3, 12, '2015-02-06 01:58:54', 1),
(139, 43, 13, 3, 1, '203', 2, 12, '2015-02-06 01:58:54', 1),
(140, 44, 13, 1, 1, '100', 4, 0, '2015-02-06 01:58:58', 1),
(141, 44, 13, 2, 1, '201', 3, 0, '2015-02-06 01:58:58', 1),
(142, 44, 13, 3, 1, '203', 2, 0, '2015-02-06 01:58:58', 1),
(143, 45, 13, 1, 1, '100', 4, 0, '2015-02-06 01:59:02', 1),
(144, 45, 13, 2, 1, '201', 3, 0, '2015-02-06 01:59:02', 1),
(145, 45, 13, 3, 1, '203', 2, 0, '2015-02-06 01:59:02', 1),
(146, 46, 14, 1, 1, '100', 4, 0, '2015-02-06 01:59:29', 1),
(147, 46, 14, 2, 1, '201', 4, 0, '2015-02-06 01:59:29', 1),
(148, 46, 14, 3, 1, '203', 1, 0, '2015-02-06 01:59:29', 1),
(149, 47, 14, 1, 1, '100', 4, 23, '2015-02-06 01:59:33', 1),
(150, 47, 14, 2, 1, '201', 4, 23, '2015-02-06 01:59:33', 1),
(151, 47, 14, 3, 1, '203', 1, 34, '2015-02-06 01:59:33', 1),
(152, 48, 14, 1, 1, '100', 4, 0, '2015-02-06 01:59:36', 1),
(153, 48, 14, 2, 1, '201', 4, 0, '2015-02-06 01:59:36', 1),
(154, 48, 14, 3, 1, '203', 1, 0, '2015-02-06 01:59:36', 1),
(155, 49, 16, 9, 6, '201', 100, 0, '2015-02-07 01:00:40', 1),
(156, 50, 16, 9, 6, '201', 100, 1000000, '2015-02-07 01:00:45', 1),
(157, 51, 16, 9, 6, '201', 100, 0, '2015-02-07 01:00:48', 1),
(158, 52, 17, 9, 6, '201', 23, 34, '2015-02-12 09:45:09', 1),
(159, 53, 17, 9, 6, '201', 23, 12, '2015-02-12 09:45:13', 1),
(160, 54, 17, 9, 6, '201', 23, 4, '2015-02-12 09:45:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_receive`
--

CREATE TABLE IF NOT EXISTS `tr_receive` (
  `id_receive` int(11) NOT NULL AUTO_INCREMENT,
  `id_courir` int(11) DEFAULT NULL,
  `id_sro` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` smallint(6) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_receive`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tr_receive`
--

INSERT INTO `tr_receive` (`id_receive`, `id_courir`, `id_sro`, `date_create`, `id_user`, `status`) VALUES
(1, 1, 1, '2015-01-19 00:00:00', 1, 1),
(2, 2, 2, '2015-01-19 00:00:00', 1, 2),
(3, 1, 3, '2015-02-06 00:00:00', 1, 1);

--
-- Triggers `tr_receive`
--
DROP TRIGGER IF EXISTS `after_insert_receive`;
DELIMITER //
CREATE TRIGGER `after_insert_receive` AFTER INSERT ON `tr_receive`
 FOR EACH ROW BEGIN
	CALL p_receive_detail(new.id_receive, new.id_sro);
    END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `after_update_receive`;
DELIMITER //
CREATE TRIGGER `after_update_receive` AFTER UPDATE ON `tr_receive`
 FOR EACH ROW BEGIN
	if new.status = 2 then
	CALL p_receive_return(new.id_receive);
	end if; 
    END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `after_delete_receive`;
DELIMITER //
CREATE TRIGGER `after_delete_receive` AFTER DELETE ON `tr_receive`
 FOR EACH ROW BEGIN
	delete from tr_receive_detail where id_receive = old.id_receive;
	Update tr_pros_detail set status_receive = 0  WHERE id_sro = old.id_sro;
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tr_receive_detail`
--

CREATE TABLE IF NOT EXISTS `tr_receive_detail` (
  `id_detail_receive` int(11) NOT NULL AUTO_INCREMENT,
  `id_receive` int(11) DEFAULT NULL,
  `id_detail_pros` int(11) DEFAULT NULL,
  `id_detail_ro` int(11) DEFAULT NULL,
  `id_ro` int(11) DEFAULT NULL,
  `id_sro` int(11) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_receive`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tr_receive_detail`
--

INSERT INTO `tr_receive_detail` (`id_detail_receive`, `id_receive`, `id_detail_pros`, `id_detail_ro`, `id_ro`, `id_sro`, `kode_barang`, `qty`, `date_create`, `status`) VALUES
(1, 1, 1, 4, 2, 1, '301', 4, '2015-01-19 20:14:10', 1),
(2, 2, 2, 5, 3, 2, '302', 3, '2015-01-19 20:14:21', 1),
(3, 3, 3, 9, 19, 3, '201', 3, '2015-02-10 01:43:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_return`
--

CREATE TABLE IF NOT EXISTS `tr_return` (
  `id_return` int(11) NOT NULL AUTO_INCREMENT,
  `id_receive` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_return`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tr_return`
--


--
-- Triggers `tr_return`
--
DROP TRIGGER IF EXISTS `after_update_return`;
DELIMITER //
CREATE TRIGGER `after_update_return` AFTER UPDATE ON `tr_return`
 FOR EACH ROW BEGIN
	if new.status = 2 then
	CALL p_return_order(new.id_return);	
	end if;
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tr_return_detail`
--

CREATE TABLE IF NOT EXISTS `tr_return_detail` (
  `id_detail_return` int(11) NOT NULL AUTO_INCREMENT,
  `id_return` int(11) DEFAULT '0',
  `id_receive` int(11) DEFAULT NULL,
  `id_detail_receive` int(11) DEFAULT NULL,
  `id_detail_pros` int(11) DEFAULT NULL,
  `id_ro` int(11) DEFAULT NULL,
  `id_detail_ro` int(11) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_return`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tr_return_detail`
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
  `date_approve` datetime DEFAULT '0000-00-00 00:00:00',
  `date_reject` datetime DEFAULT '0000-00-00 00:00:00',
  `status` int(1) DEFAULT NULL COMMENT '1: RO, 2: ROA, 3:ROL, 4: ROS, 5: Picking, 6: Shipment, 7: DO, 9: Reject',
  `status_order` smallint(1) DEFAULT '1' COMMENT '1: ORDER, 2: PURCHASE, 3: RETURN',
  PRIMARY KEY (`id_ro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tr_ro`
--

INSERT INTO `tr_ro` (`id_ro`, `user_id`, `purpose`, `cat_req`, `ext_doc_no`, `ETD`, `date_create`, `date_approve`, `date_reject`, `status`, `status_order`) VALUES
(19, 1, 'REQUEST', 'ASSET', '1', '2015-02-03', '2015-02-03 12:48:48', '2015-02-03 13:46:42', '0000-00-00 00:00:00', 6, 1),
(20, 1, 'REQUEST', 'ATK', '1234', '2015-02-04', '2015-02-04 16:27:03', '2015-02-04 16:28:30', '0000-00-00 00:00:00', 6, 1),
(21, 16, 'REQUEST', 'ASSET', '12354', '2015-02-06', '2015-02-06 17:28:29', '2015-02-06 17:29:24', '0000-00-00 00:00:00', 6, 1),
(22, 16, 'REQUEST', 'ASSET', '89898', '2015-02-07', '2015-02-07 14:15:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1),
(23, 1, 'REQUEST', 'ATK', '123', '2015-02-10', '2015-02-10 14:25:17', '2015-02-10 14:25:57', '0000-00-00 00:00:00', 4, 1);

--
-- Triggers `tr_ro`
--
DROP TRIGGER IF EXISTS `after_insert_ro`;
DELIMITER //
CREATE TRIGGER `after_insert_ro` AFTER INSERT ON `tr_ro`
 FOR EACH ROW BEGIN
	IF new.status_order = 3 THEN
	CALL p_return_order_detail(new.ext_doc_no, new.id_ro, new.user_id);	
	END IF;
    END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `after_allocated`;
DELIMITER //
CREATE TRIGGER `after_allocated` AFTER UPDATE ON `tr_ro`
 FOR EACH ROW BEGIN	IF new.status = 6 THEN	CALL p_allocated(old.id_ro, old.user_id);	END IF;    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tr_ro_detail`
--

CREATE TABLE IF NOT EXISTS `tr_ro_detail` (
  `id_detail_ro` int(11) NOT NULL AUTO_INCREMENT,
  `id_ro` int(11) DEFAULT NULL,
  `ext_doc_no` varchar(21) CHARACTER SET latin1 DEFAULT NULL,
  `kode_barang` varchar(21) CHARACTER SET latin1 DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `barang_bekas` int(1) NOT NULL DEFAULT '2' COMMENT '1. ada, 2. tidak ada',
  `user_id` smallint(6) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `note` text CHARACTER SET latin1,
  `status` int(1) DEFAULT NULL,
  `status_delete` int(1) NOT NULL COMMENT '1. deleted',
  `id_sro` int(6) NOT NULL,
  PRIMARY KEY (`id_detail_ro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tr_ro_detail`
--

INSERT INTO `tr_ro_detail` (`id_detail_ro`, `id_ro`, `ext_doc_no`, `kode_barang`, `qty`, `barang_bekas`, `user_id`, `date_create`, `note`, `status`, `status_delete`, `id_sro`) VALUES
(1, 1, 'SPK/123', '100', 20, 2, 1, '2015-01-20 09:22:32', 'adi', 1, 0, 0),
(2, 1, 'SPK/123', '201', 10, 1, 1, '2015-01-20 09:22:32', 'ida', 1, 0, 0),
(3, 1, 'SPK/123', '203', 5, 1, 1, '2015-01-20 09:22:32', 'MOuse logitech', 1, 0, 0),
(4, 2, '112233', '301', 5, 1, 1, '2015-01-20 10:54:09', 'tes', 1, 0, 0),
(5, 3, '332211', '302', 3, 1, 1, '2015-01-20 10:54:49', '-', 1, 0, 0),
(6, 4, '554433', '301', 1, 1, 1, '2015-01-23 13:53:19', 'tes', 1, 0, 0),
(7, 10, '987897', '203', 15, 1, 1, '2015-01-28 09:34:30', '-', 1, 0, 0),
(8, 11, '546', '302', 546, 2, 1, '2015-01-28 10:55:38', '-', 1, 0, 0),
(9, 19, '1', '201', 5, 1, 1, '2015-02-03 12:48:48', '-', 1, 0, 0),
(10, 20, '1234', '100', 34, 1, 1, '2015-02-04 16:27:03', 'dgfdgdf', 1, 0, 0),
(11, 20, '1234', '302', 12, 1, 1, '2015-02-04 16:27:03', 'qwewqe', 1, 0, 0),
(12, 20, '1234', '100', 12, 1, 1, '2015-02-04 16:27:03', 'wqeqwe', 1, 0, 0),
(13, 21, '12354', '201', 123, 1, 16, '2015-02-06 17:28:29', 'sadasd', 1, 0, 0),
(14, 22, '89898', '100', 12, 1, 16, '2015-02-07 14:15:47', 'adsd', 1, 0, 0),
(15, 23, '123', '302', 5, 2, 1, '2015-02-10 14:25:17', '-', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tr_sro`
--

CREATE TABLE IF NOT EXISTS `tr_sro` (
  `id_sro` int(11) NOT NULL AUTO_INCREMENT,
  `id_do` int(11) DEFAULT NULL,
  `id_ro` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_sro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tr_sro`
--

INSERT INTO `tr_sro` (`id_sro`, `id_do`, `id_ro`, `date_create`, `id_user`, `status`) VALUES
(1, 1, 2, '2015-01-19 00:00:00', '1', 2),
(2, 2, 3, '2015-01-19 00:00:00', '1', 2),
(3, 4, 19, '2015-02-06 00:00:00', '1', 2);

--
-- Triggers `tr_sro`
--
DROP TRIGGER IF EXISTS `after_delete_sro`;
DELIMITER //
CREATE TRIGGER `after_delete_sro` AFTER DELETE ON `tr_sro`
 FOR EACH ROW BEGIN
	UPDATE tr_pros_detail SET id_sro = NULL WHERE id_sro = old.id_sro;
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tr_stock`
--

CREATE TABLE IF NOT EXISTS `tr_stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `id_in` int(11) DEFAULT NULL,
  `id_detail_in` int(11) DEFAULT NULL,
  `kode_barang` varchar(5) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `id_lokasi` varchar(21) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `type_in` smallint(1) DEFAULT NULL COMMENT '1: in 2: transfer',
  PRIMARY KEY (`id_stock`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tr_stock`
--

INSERT INTO `tr_stock` (`id_stock`, `id_in`, `id_detail_in`, `kode_barang`, `qty`, `price`, `id_lokasi`, `date_create`, `status`, `type_in`) VALUES
(1, NULL, NULL, '301', 4, 1000, 'Workshop', '2015-01-20 10:54:09', 1, NULL),
(2, NULL, NULL, '302', 10, 500, 'Heavy Equipment', '2015-01-20 10:54:09', 1, NULL),
(3, NULL, NULL, '201', 10, 250, 'Pusat', '2015-01-20 10:54:09', 1, 0),
(4, NULL, NULL, '100', 15, 210, 'IT', '2015-02-07 01:33:33', 1, NULL),
(5, 2, 6, '201', 10, 100, 'Pusat', '2015-02-07 02:02:53', 1, 1),
(6, 2, 7, '201', 74, 100, 'Pusat', '2015-02-07 02:02:53', 1, 1),
(7, 2, 10, '301', 1, 1000, 'IT', '2015-02-09 22:28:31', 1, 2),
(8, 1, 7, '301', 1, 1000, 'IT', '2015-02-09 22:40:49', 1, 2),
(9, 1, 7, '301', 1, 1000, 'IT', '2015-02-09 22:42:43', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tr_transfer`
--

CREATE TABLE IF NOT EXISTS `tr_transfer` (
  `id_transfer` int(11) NOT NULL AUTO_INCREMENT,
  `type_transfer` smallint(1) DEFAULT NULL COMMENT '1: move',
  `note` text,
  `date_create` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_transfer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tr_transfer`
--

INSERT INTO `tr_transfer` (`id_transfer`, `type_transfer`, `note`, `date_create`, `user_id`, `status`) VALUES
(1, 1, 'tes', '2015-01-19 23:43:10', 1, 1),
(2, 1, 'tes 2', '2015-01-19 23:45:15', 1, 1),
(3, 1, '-', '2015-02-10 13:33:58', 1, 1);

--
-- Triggers `tr_transfer`
--
DROP TRIGGER IF EXISTS `after_update_transfer`;
DELIMITER //
CREATE TRIGGER `after_update_transfer` AFTER UPDATE ON `tr_transfer`
 FOR EACH ROW BEGIN
	IF new.status = 2 THEN
	CALL p_transfer(new.id_transfer);
	END IF;
    END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `before_delete_transfer`;
DELIMITER //
CREATE TRIGGER `before_delete_transfer` BEFORE DELETE ON `tr_transfer`
 FOR EACH ROW BEGIN
	CALL p_delete_transfer_detail(old.id_transfer);
	
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tr_transfer_detail`
--

CREATE TABLE IF NOT EXISTS `tr_transfer_detail` (
  `id_detail_transfer` int(11) NOT NULL AUTO_INCREMENT,
  `id_transfer` int(11) DEFAULT NULL,
  `id_stock` int(11) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `id_lokasi` varchar(21) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_transfer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tr_transfer_detail`
--

INSERT INTO `tr_transfer_detail` (`id_detail_transfer`, `id_transfer`, `id_stock`, `kode_barang`, `qty`, `price`, `id_lokasi`, `status`) VALUES
(7, 1, 1, '301', 1, 1000, 'IT', 1),
(10, 2, 1, '301', 2, 1000, 'Workshop', 1),
(15, 3, 2, '302', 7, 500, 'Pusat', 1);

--
-- Triggers `tr_transfer_detail`
--
DROP TRIGGER IF EXISTS `before_delete_transfer_detail`;
DELIMITER //
CREATE TRIGGER `before_delete_transfer_detail` BEFORE DELETE ON `tr_transfer_detail`
 FOR EACH ROW BEGIN
	
	update tr_stock set qty = (qty + old.qty) where id_stock = old.id_stock;
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `v_lokasi`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purlog`.`v_lokasi` AS (select `purlog`.`ref_lokasi`.`id_lks` AS `id_lks`,`purlog`.`ref_lokasi`.`type` AS `type`,(case `purlog`.`ref_lokasi`.`type` when '1' then 'Fast Moving' when '2' then 'Slow Moving' end) AS `type_lokasi`,`purlog`.`ref_lokasi`.`storage` AS `Storage`,(case `purlog`.`ref_lokasi`.`storage` when '1' then 'Available' when '2' then 'Hold' when '3' then 'Damage' end) AS `storage_lokasi`,`purlog`.`ref_lokasi`.`status` AS `status`,(case `purlog`.`ref_lokasi`.`status` when '1' then 'Aktif' when '0' then 'Tidak Aktif' end) AS `status_lokasi` from `purlog`.`ref_lokasi`);

--
-- Dumping data for table `v_lokasi`
--

INSERT INTO `v_lokasi` (`id_lks`, `type`, `type_lokasi`, `Storage`, `storage_lokasi`, `status`, `status_lokasi`) VALUES
(1, 1, 'Fast Moving', 1, 'Available', 1, 'Aktif'),
(2, 2, 'Slow Moving', 2, 'Hold', 1, 'Aktif'),
(3, 2, 'Slow Moving', 3, 'Damage', 1, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `v_po_detail`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `purlog`.`v_po_detail` AS select `c`.`id_po` AS `id_po`,`a`.`id_detail_pr` AS `id_detail_pr`,`a`.`kode_barang` AS `kode_barang`,`a`.`note` AS `note`,`a`.`qty` AS `qty`,`e`.`price` AS `price`,(`a`.`qty` * `e`.`price`) AS `total`,`c`.`purpose` AS `purpose`,`c`.`ext_doc_no` AS `ext_doc_no`,`c`.`ETD` AS `ETD`,`d`.`top` AS `top`,`f`.`nama_barang` AS `nama_barang`,`a`.`user_id` AS `user_id`,`g`.`full_name` AS `full_name`,`d`.`id_vendor` AS `id_vendor`,`g`.`departement_id` AS `departement_id`,`h`.`departement_name` AS `departement_name`,`c`.`cat_req` AS `cat_req`,`c`.`date_create` AS `date_create` from (((((((`purlog`.`tr_pr_detail` `a` left join `purlog`.`tr_pr` `b` on((`a`.`id_pr` = `b`.`id_pr`))) left join `purlog`.`tr_po` `c` on((`b`.`id_po` = `c`.`id_po`))) left join `purlog`.`tr_qr` `d` on(((`b`.`id_pr` = `d`.`id_pr`) and (`d`.`status` = 2)))) left join `purlog`.`tr_qr_detail` `e` on(((`e`.`id_qr` = `d`.`id_qr`) and (`e`.`id_detail_pr` = `a`.`id_detail_pr`)))) left join `purlog`.`ref_barang` `f` on((`f`.`kode_barang` = `a`.`kode_barang`))) left join `purlog`.`sys_user` `g` on((`g`.`user_id` = `a`.`user_id`))) left join `purlog`.`ref_departement` `h` on((`h`.`departement_id` = `g`.`departement_id`)));

--
-- Dumping data for table `v_po_detail`
--

INSERT INTO `v_po_detail` (`id_po`, `id_detail_pr`, `kode_barang`, `note`, `qty`, `price`, `total`, `purpose`, `ext_doc_no`, `ETD`, `top`, `nama_barang`, `user_id`, `full_name`, `id_vendor`, `departement_id`, `departement_name`, `cat_req`, `date_create`) VALUES
(NULL, 1, '100', NULL, 20, 12, 240, NULL, NULL, NULL, 2, 'PC', 1, 'administrator', 'V001', 1, 'IT', NULL, NULL),
(NULL, 1, '100', NULL, 20, 23, 460, NULL, NULL, NULL, 4, 'PC', 1, 'administrator', 'V002', 1, 'IT', NULL, NULL),
(NULL, 2, '201', NULL, 10, 12, 120, NULL, NULL, NULL, 2, 'Microsoft Office', 1, 'administrator', 'V001', 1, 'IT', NULL, NULL),
(NULL, 2, '201', NULL, 10, 23, 230, NULL, NULL, NULL, 4, 'Microsoft Office', 1, 'administrator', 'V002', 1, 'IT', NULL, NULL),
(NULL, 3, '203', NULL, 5, 12, 60, NULL, NULL, NULL, 2, 'Mouse', 1, 'administrator', 'V001', 1, 'IT', NULL, NULL),
(NULL, 3, '203', NULL, 5, 34, 170, NULL, NULL, NULL, 4, 'Mouse', 1, 'administrator', 'V002', 1, 'IT', NULL, NULL),
(NULL, 4, '301', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Lampu', 1, 'administrator', NULL, 1, 'IT', NULL, NULL),
(NULL, 5, '201', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'Microsoft Office', 1, 'administrator', NULL, 1, 'IT', NULL, NULL),
(NULL, 6, '100', NULL, 34, NULL, NULL, NULL, NULL, NULL, NULL, 'PC', 1, 'administrator', NULL, 1, 'IT', NULL, NULL),
(NULL, 7, '302', NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, 'Oli', 1, 'administrator', NULL, 1, 'IT', NULL, NULL),
(NULL, 8, '100', NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, 'PC', 1, 'administrator', NULL, 1, 'IT', NULL, NULL),
(NULL, 9, '201', NULL, 123, 1000000, 123000000, NULL, NULL, NULL, 2, 'Microsoft Office', 16, 'Superadmin', 'V002', 19, 'Other', NULL, NULL),
(NULL, 9, '201', NULL, 123, 12, 1476, NULL, NULL, NULL, 2, 'Microsoft Office', 16, 'Superadmin', 'V002', 19, 'Other', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `v_po_detail_2`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purlog`.`v_po_detail_2` AS select `purlog`.`tr_po`.`id_po` AS `id_po`,`purlog`.`tr_po`.`requestor` AS `requestor`,`purlog`.`tr_po`.`departement` AS `departement`,`purlog`.`tr_po`.`purpose` AS `purpose`,`purlog`.`tr_po`.`cat_req` AS `cat_req`,`purlog`.`tr_po`.`ext_doc_no` AS `ext_doc_no`,`purlog`.`tr_po`.`ETD` AS `ETD`,`purlog`.`tr_po`.`date_create` AS `date_create`,`purlog`.`tr_qr`.`top` AS `top`,`purlog`.`tr_qr`.`id_vendor` AS `id_vendor`,`purlog`.`tr_qr`.`id_pr` AS `id_pr`,`purlog`.`tr_qr`.`id_qrs` AS `id_qrs`,`purlog`.`ref_vendor`.`name_vendor` AS `name_vendor`,`purlog`.`ref_vendor`.`address_vendor` AS `address_vendor`,`purlog`.`ref_vendor`.`contact_vendor` AS `contact_vendor`,`purlog`.`ref_vendor`.`mobile_vendor` AS `mobile_vendor`,`purlog`.`tr_qr_detail`.`kode_barang` AS `kode_barang`,`purlog`.`tr_qr_detail`.`qty` AS `qty`,`purlog`.`tr_qr_detail`.`price` AS `price`,(`purlog`.`tr_qr_detail`.`qty` * `purlog`.`tr_qr_detail`.`price`) AS `total`,`purlog`.`tr_qr`.`id_qr` AS `id_qr`,`purlog`.`tr_qr_detail`.`id_detail_pr` AS `id_detail_pr`,`purlog`.`sys_user`.`full_name` AS `full_name`,`purlog`.`sys_user`.`departement_id` AS `departement_id`,`purlog`.`ref_departement`.`departement_name` AS `departement_name`,`purlog`.`ref_barang`.`nama_barang` AS `nama_barang`,`purlog`.`tr_pr_detail`.`note` AS `note` from (((((((`purlog`.`tr_po` left join `purlog`.`tr_qr` on((`purlog`.`tr_qr`.`id_po` = `purlog`.`tr_po`.`id_po`))) left join `purlog`.`ref_vendor` on((`purlog`.`tr_qr`.`id_vendor` = convert(`purlog`.`ref_vendor`.`id_vendor` using utf8)))) left join `purlog`.`tr_qr_detail` on(((`purlog`.`tr_qr`.`id_qrs` = `purlog`.`tr_qr_detail`.`id_qrs`) and (`purlog`.`tr_qr`.`id_pr` = `purlog`.`tr_qr_detail`.`id_pr`) and (`purlog`.`tr_qr`.`id_qr` = `purlog`.`tr_qr_detail`.`id_qr`)))) left join `purlog`.`sys_user` on((`purlog`.`tr_po`.`requestor` = `purlog`.`sys_user`.`user_id`))) left join `purlog`.`ref_departement` on((`purlog`.`sys_user`.`departement_id` = `purlog`.`ref_departement`.`departement_id`))) left join `purlog`.`ref_barang` on((`purlog`.`tr_qr_detail`.`kode_barang` = convert(`purlog`.`ref_barang`.`kode_barang` using utf8)))) left join `purlog`.`tr_pr_detail` on((`purlog`.`tr_qr_detail`.`id_detail_pr` = `purlog`.`tr_pr_detail`.`id_detail_pr`)));

--
-- Dumping data for table `v_po_detail_2`
--

INSERT INTO `v_po_detail_2` (`id_po`, `requestor`, `departement`, `purpose`, `cat_req`, `ext_doc_no`, `ETD`, `date_create`, `top`, `id_vendor`, `id_pr`, `id_qrs`, `name_vendor`, `address_vendor`, `contact_vendor`, `mobile_vendor`, `kode_barang`, `qty`, `price`, `total`, `id_qr`, `id_detail_pr`, `full_name`, `departement_id`, `departement_name`, `nama_barang`, `note`) VALUES
(17, '16', '19', 'REQUEST', 'ASSET', 'SPK/123', '2015-01-20', '2015-02-06 22:21:31', 2, 'V001', 1, 13, 'Adi', 'aa', '12', '34', '100', 4, 12, 48, 43, 1, 'Superadmin', 19, 'Other', 'PC', NULL),
(17, '16', '19', 'REQUEST', 'ASSET', 'SPK/123', '2015-01-20', '2015-02-06 22:21:31', 2, 'V001', 1, 13, 'Adi', 'aa', '12', '34', '201', 3, 12, 36, 43, 2, 'Superadmin', 19, 'Other', 'Microsoft Office', NULL),
(17, '16', '19', 'REQUEST', 'ASSET', 'SPK/123', '2015-01-20', '2015-02-06 22:21:31', 2, 'V001', 1, 13, 'Adi', 'aa', '12', '34', '203', 2, 12, 24, 43, 3, 'Superadmin', 19, 'Other', 'Mouse', NULL),
(18, '16', '19', 'REQUEST', 'ASSET', 'SPK/123', '2015-01-20', '2015-02-06 22:26:10', 4, 'V002', 1, 14, 'iqbal', 'bb', '23', '45', '100', 4, 23, 92, 47, 1, 'Superadmin', 19, 'Other', 'PC', NULL),
(18, '16', '19', 'REQUEST', 'ASSET', 'SPK/123', '2015-01-20', '2015-02-06 22:26:10', 4, 'V002', 1, 14, 'iqbal', 'bb', '23', '45', '201', 4, 23, 92, 47, 2, 'Superadmin', 19, 'Other', 'Microsoft Office', NULL),
(18, '16', '19', 'REQUEST', 'ASSET', 'SPK/123', '2015-01-20', '2015-02-06 22:26:10', 4, 'V002', 1, 14, 'iqbal', 'bb', '23', '45', '203', 1, 34, 34, 47, 3, 'Superadmin', 19, 'Other', 'Mouse', NULL),
(19, '16', '19', 'REQUEST', 'ASSET', '12354', '2015-02-06', '2015-02-07 01:01:24', 2, 'V002', 6, 16, 'iqbal', 'bb', '23', '45', '201', 100, 1000000, 100000000, 50, 9, 'Superadmin', 19, 'Other', 'Microsoft Office', NULL),
(20, '16', '19', 'REQUEST', 'ASSET', '12354', '2015-02-06', '2015-02-12 09:46:36', 2, 'V002', 6, 17, 'iqbal', 'bb', '23', '45', '201', 23, 12, 276, 53, 9, 'Superadmin', 19, 'Other', 'Microsoft Office', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `v_po_inbound`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `purlog`.`v_po_inbound` AS select `a`.`id_detail_qrs` AS `id_detail_qrs`,`a`.`id_detail_pr` AS `id_detail_pr`,`b`.`id_qrs` AS `id_qrs`,`b`.`id_pr` AS `id_pr`,`b`.`id_po` AS `id_po`,`a`.`kode_barang` AS `kode_barang`,`a`.`qty` AS `qty`,coalesce(sum(`d`.`qty`),0) AS `receive`,(`a`.`qty` - sum(coalesce(`d`.`qty`,0))) AS `sisa` from (((`purlog`.`tr_qrs_detail` `a` left join `purlog`.`tr_qrs` `b` on((`a`.`id_qrs` = `b`.`id_qrs`))) left join `purlog`.`tr_po` `c` on((`b`.`id_po` = `c`.`id_po`))) left join `purlog`.`tr_in_detail` `d` on((`a`.`id_detail_qrs` = `d`.`ext_rec_no_detail`))) where (`c`.`status` = 2) group by `a`.`id_detail_qrs` order by `a`.`id_qrs`;

--
-- Dumping data for table `v_po_inbound`
--

INSERT INTO `v_po_inbound` (`id_detail_qrs`, `id_detail_pr`, `id_qrs`, `id_pr`, `id_po`, `kode_barang`, `qty`, `receive`, `sisa`) VALUES
(27, 2, 13, 1, 17, '201', 3, '3', '0'),
(26, 1, 13, 1, 17, '100', 4, '0', '4'),
(28, 3, 13, 1, 17, '203', 3, '3', '0'),
(32, 9, 16, 6, 19, '201', 100, '0', '100'),
(36, 9, 17, 6, 20, '201', 23, '0', '23');

-- --------------------------------------------------------

--
-- Table structure for table `v_po_inbound_2`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purlog`.`v_po_inbound_2` AS select `x`.`id_detail_pr` AS `id_detail_pr`,`x`.`id_pr` AS `id_pr`,`z`.`id_po` AS `id_po`,`x`.`kode_barang` AS `kode_barang`,`x`.`qty` AS `asal`,coalesce(`y`.`qty`,0) AS `receive`,(`x`.`qty` - coalesce(`y`.`qty`,0)) AS `sisa`,`a`.`nama_barang` AS `nama_barang`,`y`.`id_in` AS `id_in`,`purlog`.`tr_in`.`ext_rec_no` AS `ext_rec_no`,`purlog`.`tr_in`.`id_in` AS `id_in_asal`,`purlog`.`tr_stock`.`id_lokasi` AS `id_lokasi` from (((((`purlog`.`tr_qrs_detail` `x` left join `purlog`.`tr_in_detail` `y` on((`x`.`id_detail_pr` = `y`.`ext_rec_no_detail`))) left join `purlog`.`tr_qrs` `z` on((`x`.`id_pr` = `z`.`id_pr`))) left join `purlog`.`ref_barang` `a` on(((`x`.`kode_barang` = convert(`a`.`kode_barang` using utf8)) and (`x`.`kode_barang` = convert(`a`.`kode_barang` using utf8))))) left join `purlog`.`tr_in` on((`z`.`id_po` = `purlog`.`tr_in`.`ext_rec_no`))) left join `purlog`.`tr_stock` on((`x`.`kode_barang` = `purlog`.`tr_stock`.`kode_barang`))) group by `x`.`id_detail_pr`;

--
-- Dumping data for table `v_po_inbound_2`
--

INSERT INTO `v_po_inbound_2` (`id_detail_pr`, `id_pr`, `id_po`, `kode_barang`, `asal`, `receive`, `sisa`, `nama_barang`, `id_in`, `ext_rec_no`, `id_in_asal`, `id_lokasi`) VALUES
(1, 1, 17, '100', 4, 0, 4, 'PC', NULL, 17, 10, 'IT'),
(2, 1, 17, '201', 3, 0, 3, 'Microsoft Office', NULL, 17, 10, 'Pusat'),
(3, 1, 17, '203', 3, 0, 3, 'Mouse', NULL, 17, 10, NULL),
(9, 6, 19, '201', 100, 0, 100, 'Microsoft Office', NULL, NULL, NULL, 'Pusat');

-- --------------------------------------------------------

--
-- Table structure for table `v_print_inbound`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `purlog`.`v_print_inbound` AS select `a`.`id_in` AS `id_in`,`a`.`type` AS `type`,`b`.`id_po` AS `id_po`,`b`.`id_pr` AS `id_pr`,`b`.`id_ro` AS `id_ro`,`b`.`requestor` AS `requestor`,`b`.`departement` AS `departement`,`b`.`purpose` AS `purpose`,`b`.`cat_req` AS `cat_req`,`a`.`date_create` AS `date_create`,`c`.`id_detail_in` AS `id_detail_in`,`c`.`kode_barang` AS `kode_barang`,`c`.`qty` AS `qty`,`c`.`lokasi` AS `lokasi`,`d`.`nama_barang` AS `nama_barang`,`f`.`full_name` AS `full_name`,`g`.`departement_name` AS `departement_name`,`b`.`ext_doc_no` AS `ext_doc_no` from (((((`purlog`.`tr_in` `a` left join `purlog`.`tr_po` `b` on((`a`.`ext_rec_no` = `b`.`id_po`))) left join `purlog`.`tr_in_detail` `c` on((`a`.`id_in` = `c`.`id_in`))) left join `purlog`.`ref_barang` `d` on((`c`.`kode_barang` = convert(`d`.`kode_barang` using utf8)))) left join `purlog`.`sys_user` `f` on((`a`.`user_id` = `f`.`user_id`))) left join `purlog`.`ref_departement` `g` on((`b`.`departement` = `g`.`departement_id`)));

--
-- Dumping data for table `v_print_inbound`
--

INSERT INTO `v_print_inbound` (`id_in`, `type`, `id_po`, `id_pr`, `id_ro`, `requestor`, `departement`, `purpose`, `cat_req`, `date_create`, `id_detail_in`, `kode_barang`, `qty`, `lokasi`, `nama_barang`, `full_name`, `departement_name`, `ext_doc_no`) VALUES
(10, '1', 17, 1, 1, '16', '19', 'REQUEST', 'ASSET', '2015-02-12 10:24:42', 61, '203', 2, 'A100', 'Mouse', 'Superadmin', 'Other', 'SPK/123'),
(10, '1', 17, 1, 1, '16', '19', 'REQUEST', 'ASSET', '2015-02-12 10:24:42', 62, '203', 1, 'A100', 'Mouse', 'Superadmin', 'Other', 'SPK/123'),
(10, '1', 17, 1, 1, '16', '19', 'REQUEST', 'ASSET', '2015-02-12 10:24:42', 63, '201', 3, 'A100', 'Microsoft Office', 'Superadmin', 'Other', 'SPK/123');

-- --------------------------------------------------------

--
-- Table structure for table `v_pros_detail`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purlog`.`v_pros_detail` AS select `purlog`.`tr_ro_detail`.`id_detail_ro` AS `id_detail_ro`,`purlog`.`tr_ro_detail`.`id_ro` AS `id_ro`,`purlog`.`tr_ro_detail`.`kode_barang` AS `kode_barang`,`purlog`.`tr_ro_detail`.`qty` AS `orders`,(`purlog`.`tr_ro_detail`.`qty` - (`purlog`.`tr_ro_detail`.`qty` - coalesce(sum(`purlog`.`tr_pros_detail`.`qty`),0))) AS `picking`,(`purlog`.`tr_ro_detail`.`qty` - coalesce(sum(`purlog`.`tr_pros_detail`.`qty`),0)) AS `sisa` from (`purlog`.`tr_ro_detail` left join `purlog`.`tr_pros_detail` on((`purlog`.`tr_ro_detail`.`id_detail_ro` = `purlog`.`tr_pros_detail`.`id_detail_ro`))) where (`purlog`.`tr_ro_detail`.`status_delete` <> 1) group by `purlog`.`tr_ro_detail`.`id_detail_ro`;

--
-- Dumping data for table `v_pros_detail`
--

INSERT INTO `v_pros_detail` (`id_detail_ro`, `id_ro`, `kode_barang`, `orders`, `picking`, `sisa`) VALUES
(1, 1, '100', 20, '0', '20'),
(2, 1, '201', 10, '0', '10'),
(3, 1, '203', 5, '0', '5'),
(4, 2, '301', 5, '4', '1'),
(5, 3, '302', 3, '3', '0'),
(6, 4, '301', 1, '0', '1'),
(7, 10, '203', 15, '0', '15'),
(8, 11, '302', 546, '0', '546'),
(9, 19, '201', 5, '3', '2'),
(10, 20, '100', 34, '0', '34'),
(11, 20, '302', 12, '0', '12'),
(12, 20, '100', 12, '0', '12'),
(13, 21, '201', 123, '77', '46'),
(14, 22, '100', 12, '0', '12'),
(15, 23, '302', 5, '0', '5');

-- --------------------------------------------------------

--
-- Table structure for table `v_qrs_detail`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `purlog`.`v_qrs_detail` AS (select `a`.`id_detail_pr` AS `id_detail_pr`,`a`.`id_pr` AS `id_pr`,`a`.`id_ro` AS `id_ro`,`b`.`id_detail_qrs` AS `id_detail_qrs`,`a`.`kode_barang` AS `kode_barang`,`a`.`qty` AS `qty`,coalesce(sum(`b`.`qty`),0) AS `pick`,(`a`.`qty` - coalesce(sum(`b`.`qty`),0)) AS `sisa` from ((`purlog`.`tr_pr_detail` `a` left join `purlog`.`tr_pr` `c` on((`a`.`id_pr` = `c`.`id_pr`))) left join `purlog`.`tr_qrs_detail` `b` on((`a`.`id_detail_pr` = `b`.`id_detail_pr`))) where (`c`.`status` = 2) group by `a`.`id_detail_pr`);

--
-- Dumping data for table `v_qrs_detail`
--

INSERT INTO `v_qrs_detail` (`id_detail_pr`, `id_pr`, `id_ro`, `id_detail_qrs`, `kode_barang`, `qty`, `pick`, `sisa`) VALUES
(1, 1, 1, 26, '100', 20, '8', '12'),
(2, 1, 1, 27, '201', 10, '7', '3'),
(3, 1, 1, 28, '203', 5, '4', '1'),
(5, 4, 19, NULL, '201', 2, '0', '2'),
(6, 5, 20, NULL, '100', 34, '0', '34'),
(7, 5, 20, NULL, '302', 12, '0', '12'),
(8, 5, 20, NULL, '100', 12, '0', '12'),
(9, 6, 21, 32, '201', 123, '123', '0');

-- --------------------------------------------------------

--
-- Table structure for table `v_status_barang`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `purlog`.`v_status_barang` AS (select `purlog`.`ref_barang`.`kode_barang` AS `kode_barang`,(case `purlog`.`ref_barang`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_barang` from `purlog`.`ref_barang`);

--
-- Dumping data for table `v_status_barang`
--

INSERT INTO `v_status_barang` (`kode_barang`, `status_barang`) VALUES
('100', 'Aktif'),
('201', 'Aktif'),
('301', 'Aktif'),
('302', 'Aktif'),
('202', 'Aktif'),
('203', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `v_status_courir`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `purlog`.`v_status_courir` AS (select `purlog`.`ref_courir`.`id_courir` AS `id_courir`,(case `purlog`.`ref_courir`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_courir` from `purlog`.`ref_courir`);

--
-- Dumping data for table `v_status_courir`
--

INSERT INTO `v_status_courir` (`id_courir`, `status_courir`) VALUES
(1, 'Aktif'),
(2, 'Aktif'),
(3, 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `v_status_kategori`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `purlog`.`v_status_kategori` AS (select `purlog`.`ref_kategori`.`id_kategori` AS `id_kategori`,(case `purlog`.`ref_kategori`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_kategori` from `purlog`.`ref_kategori`);

--
-- Dumping data for table `v_status_kategori`
--

INSERT INTO `v_status_kategori` (`id_kategori`, `status_kategori`) VALUES
(1, 'Aktif'),
(2, 'Aktif'),
(3, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `v_status_satuan`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `purlog`.`v_status_satuan` AS (select `purlog`.`ref_satuan`.`id_satuan` AS `id_satuan`,(case `purlog`.`ref_satuan`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_satuan` from `purlog`.`ref_satuan`);

--
-- Dumping data for table `v_status_satuan`
--

INSERT INTO `v_status_satuan` (`id_satuan`, `status_satuan`) VALUES
(1, 'Aktif'),
(2, 'Aktif'),
(3, 'Aktif'),
(4, 'Aktif'),
(5, 'Aktif'),
(6, 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `v_status_sub_kategori`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `purlog`.`v_status_sub_kategori` AS (select `purlog`.`ref_sub_kategori`.`id_sub_kategori` AS `id_sub_kategori`,(case `purlog`.`ref_sub_kategori`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_sub_kategori` from `purlog`.`ref_sub_kategori`);

--
-- Dumping data for table `v_status_sub_kategori`
--

INSERT INTO `v_status_sub_kategori` (`id_sub_kategori`, `status_sub_kategori`) VALUES
(1, 'Aktif'),
(2, 'Aktif'),
(5, 'Aktif'),
(6, 'Aktif');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
