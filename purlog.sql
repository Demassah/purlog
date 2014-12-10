/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50516
Source Host           : 127.0.0.1:3306
Source Database       : purlog

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2014-12-10 17:07:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ref_barang
-- ----------------------------
DROP TABLE IF EXISTS `ref_barang`;
CREATE TABLE `ref_barang` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_kategori` smallint(6) NOT NULL,
  `id_sub_kategori` smallint(6) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ref_barang
-- ----------------------------
INSERT INTO `ref_barang` VALUES ('1', '2', '2', '001', 'Busi', '100', '');
INSERT INTO `ref_barang` VALUES ('2', '2', '2', '101', 'Asd', '25', '');
INSERT INTO `ref_barang` VALUES ('3', '3', '4', '002', 'Ban', '200', '');
INSERT INTO `ref_barang` VALUES ('4', '2', '2', '003', 'CPU', '50', '');
INSERT INTO `ref_barang` VALUES ('5', '3', '4', '004', 'Monitor', '75', '');
INSERT INTO `ref_barang` VALUES ('6', '2', '2', '005', 'Keyboard', '100', '');
INSERT INTO `ref_barang` VALUES ('7', '3', '4', '006', 'Mouse', '500', '');
INSERT INTO `ref_barang` VALUES ('8', '2', '2', '007', 'Meja', '1000', '');
INSERT INTO `ref_barang` VALUES ('9', '3', '4', '008', 'Kursi', '800', '');
INSERT INTO `ref_barang` VALUES ('10', '3', '4', '009', 'Mobil', '5000', '');
INSERT INTO `ref_barang` VALUES ('11', '3', '4', '010', 'Bis Pariwisata', '1000', '');

-- ----------------------------
-- Table structure for ref_courir
-- ----------------------------
DROP TABLE IF EXISTS `ref_courir`;
CREATE TABLE `ref_courir` (
  `id_courir` varchar(21) NOT NULL,
  `name_courir` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_courir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ref_courir
-- ----------------------------
INSERT INTO `ref_courir` VALUES ('10021', 'ASEP', '1');
INSERT INTO `ref_courir` VALUES ('10022', 'DIDIN', '1');
INSERT INTO `ref_courir` VALUES ('10023', 'DUDUNG', '1');

-- ----------------------------
-- Table structure for ref_departement
-- ----------------------------
DROP TABLE IF EXISTS `ref_departement`;
CREATE TABLE `ref_departement` (
  `departement_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `departement_name` varchar(25) NOT NULL,
  PRIMARY KEY (`departement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ref_departement
-- ----------------------------
INSERT INTO `ref_departement` VALUES ('1', 'IT');
INSERT INTO `ref_departement` VALUES ('2', 'Heavy Equipment');
INSERT INTO `ref_departement` VALUES ('3', 'Workshop');
INSERT INTO `ref_departement` VALUES ('4', 'Logistic');
INSERT INTO `ref_departement` VALUES ('5', 'Purchasing');
INSERT INTO `ref_departement` VALUES ('6', 'Promotion');

-- ----------------------------
-- Table structure for ref_kategori
-- ----------------------------
DROP TABLE IF EXISTS `ref_kategori`;
CREATE TABLE `ref_kategori` (
  `id_kategori` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(25) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ref_kategori
-- ----------------------------
INSERT INTO `ref_kategori` VALUES ('2', 'Consumables', '');
INSERT INTO `ref_kategori` VALUES ('3', 'Not  Consumables', '');

-- ----------------------------
-- Table structure for ref_sub_kategori
-- ----------------------------
DROP TABLE IF EXISTS `ref_sub_kategori`;
CREATE TABLE `ref_sub_kategori` (
  `id_sub_kategori` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_kategori` smallint(6) NOT NULL,
  `nama_sub_kategori` varchar(25) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id_sub_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ref_sub_kategori
-- ----------------------------
INSERT INTO `ref_sub_kategori` VALUES ('2', '2', 'Barang Konsumsi', '');
INSERT INTO `ref_sub_kategori` VALUES ('4', '3', 'Tak Habis', '');

-- ----------------------------
-- Table structure for sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE `sys_menu` (
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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
INSERT INTO `sys_menu` VALUES ('1', 'Administrator', 'Administrator', '0', '#', '99', '0', 'icon-administrator', 'ACCESS;');
INSERT INTO `sys_menu` VALUES ('2', 'Administrator', 'Otoritas Menu', '1', 'otoritas', '2', '0', 'icon-otoritas', 'ACCESS;ADD;EDIT;DETAIL;DELETE;');
INSERT INTO `sys_menu` VALUES ('3', 'Administrator', 'Pengguna', '1', 'pengguna', '3', '0', 'icon-user', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_menu` VALUES ('4', 'Administrator', 'Departemen', '36', 'departement', '4', '0', 'icon-departement', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_menu` VALUES ('5', 'Master Data', 'Master Data', '0', '#', '2', '0', 'icon-master', 'ACCESS;');
INSERT INTO `sys_menu` VALUES ('6', 'Master Data', 'Kategori', '5', 'kategori', '2', '0', 'icon-kategori', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_menu` VALUES ('7', 'Master Data', 'Sub Kategori', '5', 'sub_kategori', '3', '0', 'icon-subkateg', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_menu` VALUES ('8', 'Master Data', 'Barang', '5', 'barang', '4', '0', 'icon-barang', 'ACCESS;ADD;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_menu` VALUES ('9', 'Purchase', 'Purchase', '0', '#', '4', '0', 'icon-purchase', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('10', 'Logistic', 'Request Order', '34', 'request_order', '2', '0', 'icon-ro', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('11', 'Logistic', 'Request Order Selected', '34', 'request_order_selected', '5', '0', 'icon-ros', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('12', 'Logistic', 'Picking Request Order Selected', '34', 'picking_req_order_selected', '6', '0', 'icon-picking', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('13', 'Logistic', 'Shipment Request Order', '34', 'shipment_req_order', '7', '0', 'icon-shipment', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('14', 'Purchase', 'Purchase Request', '9', 'purchase_request', '7', '0', 'icon-pr', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('15', 'Purchase', 'Quotation Request Selected', '9', 'quotation_request_selected', '8', '0', 'icon-qrs', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('17', 'Purchase', 'Purchase Order', '9', 'purchase_order', '10', '0', 'icon-po', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('18', 'Purchase', 'Document Receive', '34', 'document_receive', '10', '0', 'icon-dr', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('19', 'Logistic', 'Delivery Order', '34', 'delivery_order', '8', '0', 'icon-delivery', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('20', 'Purchase', 'Berita Acara Pengembalian', '9', 'underconstruction', '12', '0', 'icon-bap', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('21', 'Purchase', 'Berita Acara Pengembalian Pengiriman', '9', 'underconstruction', '13', '0', 'icon-bapp', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('22', 'Logistic', 'Request Order Logistic', '34', 'request_order_logistic', '4', '0', 'icon-rol', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('23', 'Administrator', 'Menu', '1', 'menu', '1', '0', 'icon-menu', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_menu` VALUES ('34', 'Logistic', 'Logistic', '0', '#', '3', '0', 'icon-logistic', 'ACCESS;');
INSERT INTO `sys_menu` VALUES ('36', 'Setup', 'Setup', '0', '#', '1', '0', 'icon-setup', 'ACCESS;');
INSERT INTO `sys_menu` VALUES ('37', 'Logistic', 'Request Order Approval', '34', 'request_order_approval', '3', '0', 'icon-approval', 'ACCESS;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('38', 'Logistic', 'Delivered', '34', 'delivered', '9', '0', 'icon-delivered', 'ACCESS;DETAIL;');

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `user_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nik` int(12) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `passwd` varchar(32) DEFAULT NULL,
  `departement_id` smallint(6) NOT NULL,
  `user_level_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES ('1', '1111111', 'admin', 'administrator', '21232f297a57a5a743894a0e4a801fc3', '1', '1');
INSERT INTO `sys_user` VALUES ('11', '1111112', 'iqbal', 'Mochamad Iqbal', 'eedae20fc3c7a6e9c5b1102098771c70', '1', '1');

-- ----------------------------
-- Table structure for sys_user_access
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_access`;
CREATE TABLE `sys_user_access` (
  `user_access_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `menu_id` smallint(6) NOT NULL DEFAULT '0',
  `user_level_id` smallint(6) NOT NULL DEFAULT '0',
  `policy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_access_id`)
) ENGINE=InnoDB AUTO_INCREMENT=751 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user_access
-- ----------------------------
INSERT INTO `sys_user_access` VALUES ('1', '1', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('2', '2', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('3', '3', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('4', '4', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('727', '5', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('728', '6', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('729', '7', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('730', '8', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('731', '9', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('732', '10', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('733', '11', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('734', '12', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('735', '13', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('736', '14', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('737', '15', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('739', '17', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('740', '18', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('741', '19', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('742', '20', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('743', '21', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('744', '22', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;');
INSERT INTO `sys_user_access` VALUES ('745', '23', '1', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_user_access` VALUES ('746', '34', '1', 'ACCESS;');
INSERT INTO `sys_user_access` VALUES ('747', '35', '1', 'ACCESS;');
INSERT INTO `sys_user_access` VALUES ('748', '36', '1', 'ACCESS;');
INSERT INTO `sys_user_access` VALUES ('749', '37', '1', 'ACCESS;DETAIL;EDIT;DELETE;');
INSERT INTO `sys_user_access` VALUES ('750', '38', '1', 'ACCESS;DETAIL;');

-- ----------------------------
-- Table structure for sys_user_level
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_level`;
CREATE TABLE `sys_user_level` (
  `user_level_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(40) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user_level
-- ----------------------------
INSERT INTO `sys_user_level` VALUES ('1', 'Administrator', '10000');
INSERT INTO `sys_user_level` VALUES ('2', 'Logistic', '1');

-- ----------------------------
-- Table structure for tr_do
-- ----------------------------
DROP TABLE IF EXISTS `tr_do`;
CREATE TABLE `tr_do` (
  `id_do` int(11) NOT NULL AUTO_INCREMENT,
  `id_courir` varchar(21) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_do`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_do
-- ----------------------------
INSERT INTO `tr_do` VALUES ('1', '10023', '2014-12-10 01:09:19', '1', '1');
INSERT INTO `tr_do` VALUES ('2', '10022', '2014-12-10 13:09:46', '1', '1');
INSERT INTO `tr_do` VALUES ('3', '10021', '2014-12-10 13:40:39', '1', '1');

-- ----------------------------
-- Table structure for tr_do_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_do_detail`;
CREATE TABLE `tr_do_detail` (
  `id_do_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_do` int(11) DEFAULT NULL,
  `id_sro` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_do_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_do_detail
-- ----------------------------

-- ----------------------------
-- Table structure for tr_po
-- ----------------------------
DROP TABLE IF EXISTS `tr_po`;
CREATE TABLE `tr_po` (
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

-- ----------------------------
-- Records of tr_po
-- ----------------------------

-- ----------------------------
-- Table structure for tr_pr
-- ----------------------------
DROP TABLE IF EXISTS `tr_pr`;
CREATE TABLE `tr_pr` (
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

-- ----------------------------
-- Records of tr_pr
-- ----------------------------

-- ----------------------------
-- Table structure for tr_pros_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_pros_detail`;
CREATE TABLE `tr_pros_detail` (
  `id_detail_pros` int(11) NOT NULL AUTO_INCREMENT,
  `id_detail_ros` int(11) DEFAULT NULL,
  `id_sro` int(11) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `id_lokasi` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_pros`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_pros_detail
-- ----------------------------
INSERT INTO `tr_pros_detail` VALUES ('1', '5', null, '003', '3', 'A01', '2');
INSERT INTO `tr_pros_detail` VALUES ('2', '5', null, '003', '2', 'A02', '2');

-- ----------------------------
-- Table structure for tr_qr
-- ----------------------------
DROP TABLE IF EXISTS `tr_qr`;
CREATE TABLE `tr_qr` (
  `id_qr` varchar(21) NOT NULL,
  `id_pr` varchar(21) DEFAULT NULL,
  `id_vendor` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_qr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_qr
-- ----------------------------

-- ----------------------------
-- Table structure for tr_qrs
-- ----------------------------
DROP TABLE IF EXISTS `tr_qrs`;
CREATE TABLE `tr_qrs` (
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

-- ----------------------------
-- Records of tr_qrs
-- ----------------------------

-- ----------------------------
-- Table structure for tr_qr_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_qr_detail`;
CREATE TABLE `tr_qr_detail` (
  `id_detail_qr` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(21) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_qr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_qr_detail
-- ----------------------------

-- ----------------------------
-- Table structure for tr_ro
-- ----------------------------
DROP TABLE IF EXISTS `tr_ro`;
CREATE TABLE `tr_ro` (
  `id_ro` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(6) DEFAULT NULL,
  `purpose` varchar(21) DEFAULT NULL,
  `cat_req` varchar(21) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_ro`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_ro
-- ----------------------------
INSERT INTO `tr_ro` VALUES ('1', '1', 'REQUEST', 'ATK', ' 00123456', '2014-12-10', '2014-12-10 00:00:00', '3');
INSERT INTO `tr_ro` VALUES ('2', '11', 'STOCK', 'ATK', ' 0123457', '2014-12-10', '2014-12-10 00:00:00', '2');
INSERT INTO `tr_ro` VALUES ('3', '1', 'STOCK', 'ASSET', ' 00123458', '2014-12-10', '2014-12-10 00:00:00', '1');

-- ----------------------------
-- Table structure for tr_ros
-- ----------------------------
DROP TABLE IF EXISTS `tr_ros`;
CREATE TABLE `tr_ros` (
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

-- ----------------------------
-- Records of tr_ros
-- ----------------------------

-- ----------------------------
-- Table structure for tr_ros_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_ros_detail`;
CREATE TABLE `tr_ros_detail` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_ros_detail
-- ----------------------------

-- ----------------------------
-- Table structure for tr_ro_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_ro_detail`;
CREATE TABLE `tr_ro_detail` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_ro_detail
-- ----------------------------

-- ----------------------------
-- Table structure for tr_sro
-- ----------------------------
DROP TABLE IF EXISTS `tr_sro`;
CREATE TABLE `tr_sro` (
  `id_sro` int(11) NOT NULL AUTO_INCREMENT,
  `id_ros` int(11) DEFAULT NULL,
  `id_do` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_sro`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_sro
-- ----------------------------
INSERT INTO `tr_sro` VALUES ('1', '1', '1', '2014-12-10 10:46:57', '1', '1');
