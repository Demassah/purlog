/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50516
Source Host           : 127.0.0.1:3306
Source Database       : purlog

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2015-02-08 22:14:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ref_barang
-- ----------------------------
DROP TABLE IF EXISTS `ref_barang`;
CREATE TABLE `ref_barang` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(6) NOT NULL,
  `id_sub_kategori` int(6) NOT NULL,
  `kode_barang` varchar(21) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `id_satuan` int(6) DEFAULT NULL,
  `status` varchar(1) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1: fast moving, 2: slow moving, 3: new item',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ref_barang
-- ----------------------------
INSERT INTO `ref_barang` VALUES ('1', '1', '1', '100', 'PC', '5', '1', '1');
INSERT INTO `ref_barang` VALUES ('2', '1', '2', '201', 'Microsoft Office', '2', '1', '2');
INSERT INTO `ref_barang` VALUES ('3', '2', '6', '301', 'Lampu', '2', '1', '2');
INSERT INTO `ref_barang` VALUES ('4', '2', '5', '302', 'Oli', '6', '1', '1');
INSERT INTO `ref_barang` VALUES ('5', '1', '1', '202', 'New  Item - Hardware', '5', '1', '3');
INSERT INTO `ref_barang` VALUES ('6', '1', '1', '203', 'Mouse', '2', '1', '2');

-- ----------------------------
-- Table structure for ref_courir
-- ----------------------------
DROP TABLE IF EXISTS `ref_courir`;
CREATE TABLE `ref_courir` (
  `id_courir` varchar(21) CHARACTER SET latin1 NOT NULL,
  `name_courir` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `contact` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_courir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ref_courir
-- ----------------------------
INSERT INTO `ref_courir` VALUES ('420015', 'Asep Zaelani', '0811115214', '1');
INSERT INTO `ref_courir` VALUES ('430016', 'Jajang Nurjaman', '0857456895', '1');

-- ----------------------------
-- Table structure for ref_departement
-- ----------------------------
DROP TABLE IF EXISTS `ref_departement`;
CREATE TABLE `ref_departement` (
  `departement_id` int(6) NOT NULL AUTO_INCREMENT,
  `departement_name` varchar(25) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`departement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ref_departement
-- ----------------------------
INSERT INTO `ref_departement` VALUES ('1', 'IT', '1');
INSERT INTO `ref_departement` VALUES ('15', 'Workshop', '1');
INSERT INTO `ref_departement` VALUES ('16', 'Heavy Equipment', '1');
INSERT INTO `ref_departement` VALUES ('17', 'Promotion', '1');
INSERT INTO `ref_departement` VALUES ('18', 'Bispar', '1');
INSERT INTO `ref_departement` VALUES ('19', 'Other', '1');

-- ----------------------------
-- Table structure for ref_kategori
-- ----------------------------
DROP TABLE IF EXISTS `ref_kategori`;
CREATE TABLE `ref_kategori` (
  `id_kategori` int(6) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(25) NOT NULL,
  `type_kategri` varchar(21) DEFAULT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ref_kategori
-- ----------------------------
INSERT INTO `ref_kategori` VALUES ('1', 'IT', null, '1');
INSERT INTO `ref_kategori` VALUES ('2', 'Sparepart', null, '1');
INSERT INTO `ref_kategori` VALUES ('3', 'Furniture', null, '1');

-- ----------------------------
-- Table structure for ref_satuan
-- ----------------------------
DROP TABLE IF EXISTS `ref_satuan`;
CREATE TABLE `ref_satuan` (
  `id_satuan` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(21) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_satuan
-- ----------------------------
INSERT INTO `ref_satuan` VALUES ('1', 'Biji', '1');
INSERT INTO `ref_satuan` VALUES ('2', 'PCS', '1');
INSERT INTO `ref_satuan` VALUES ('3', 'Sachet', '1');
INSERT INTO `ref_satuan` VALUES ('4', 'Box', '1');
INSERT INTO `ref_satuan` VALUES ('5', 'Unit', '1');
INSERT INTO `ref_satuan` VALUES ('6', 'Liter', null);

-- ----------------------------
-- Table structure for ref_sub_kategori
-- ----------------------------
DROP TABLE IF EXISTS `ref_sub_kategori`;
CREATE TABLE `ref_sub_kategori` (
  `id_sub_kategori` int(6) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(6) NOT NULL,
  `nama_sub_kategori` varchar(25) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id_sub_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ref_sub_kategori
-- ----------------------------
INSERT INTO `ref_sub_kategori` VALUES ('1', '1', 'Hardware', '1');
INSERT INTO `ref_sub_kategori` VALUES ('2', '1', 'Software', '1');
INSERT INTO `ref_sub_kategori` VALUES ('5', '2', 'Mesin', '1');
INSERT INTO `ref_sub_kategori` VALUES ('6', '2', 'Accecoris', '1');

-- ----------------------------
-- Table structure for ref_vendor
-- ----------------------------
DROP TABLE IF EXISTS `ref_vendor`;
CREATE TABLE `ref_vendor` (
  `id_vendor` varchar(21) CHARACTER SET latin1 NOT NULL,
  `name_vendor` varchar(60) CHARACTER SET latin1 DEFAULT NULL,
  `address_vendor` text CHARACTER SET latin1,
  `contact_vendor` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `mobile_vendor` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_vendor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_vendor
-- ----------------------------
INSERT INTO `ref_vendor` VALUES ('V001', 'Adi', 'aa', '12', '34', '1');
INSERT INTO `ref_vendor` VALUES ('V002', 'iqbal', 'bb', '23', '45', '1');
INSERT INTO `ref_vendor` VALUES ('V003', 'Demas', 'cc', '34', '67', '1');

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
  `policy` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
INSERT INTO `sys_menu` VALUES ('1', 'Administrator', 'Administrator', '0', '#', '99', '0', 'icon-administrator', 'ACCESS;');
INSERT INTO `sys_menu` VALUES ('2', 'Administrator', 'Otoritas Menu', '1', 'otoritas', '2', '0', 'icon-otoritas', 'ACCESS;ADD;EDIT;DETAIL;DELETE;');
INSERT INTO `sys_menu` VALUES ('3', 'Administrator', 'Pengguna', '1', 'pengguna', '3', '0', 'icon-user', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_menu` VALUES ('4', 'Setup', 'Departemen', '36', 'departement', '2', '0', 'icon-departement', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_menu` VALUES ('5', 'Master Data', 'Master Data', '0', '#', '2', '0', 'icon-master', 'ACCESS;');
INSERT INTO `sys_menu` VALUES ('6', 'Master Data', 'Kategori', '5', 'kategori', '2', '0', 'icon-kategori', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_menu` VALUES ('7', 'Master Data', 'Sub Kategori', '5', 'sub_kategori', '3', '0', 'icon-subkateg', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_menu` VALUES ('8', 'Master Data', 'Barang', '5', 'barang', '4', '0', 'icon-barang', 'ACCESS;ADD;EDIT;DELETE;PDF;');
INSERT INTO `sys_menu` VALUES ('9', 'Purchase', 'Purchase', '0', '#', '4', '0', 'icon-purchase', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('10', 'Logistic', 'Request Order', '34', 'request_order', '2', '0', 'icon-ro', 'ACCESS;ADD;EDIT;DELETE;DETAIL;APPROVE;');
INSERT INTO `sys_menu` VALUES ('11', 'Logistic', 'Request Order Selected', '34', 'request_order_selected', '5', '0', 'icon-ros', 'ACCESS;EDIT;DELETE;DETAIL;APPROVE;');
INSERT INTO `sys_menu` VALUES ('12', 'Logistic', 'Picking Request Order Selected', '34', 'picking_req_order_selected', '6', '0', 'icon-picking', 'ACCESS;DETAIL;EDIT;PDF;APPROVE;');
INSERT INTO `sys_menu` VALUES ('13', 'Logistic', 'Shipment Request Order', '34', 'shipment_req_order', '7', '0', 'icon-shipment', 'ACCESS;ADD;DETAIL;DELETE;PDF;APPROVE;');
INSERT INTO `sys_menu` VALUES ('14', 'Purchase', 'Purchase Request', '9', 'purchase_request', '7', '0', 'icon-pr', 'ACCESS;ADD;DELETE;DETAIL;APPROVE;');
INSERT INTO `sys_menu` VALUES ('15', 'Purchase', 'Quotation Request Selected', '9', 'quotation_request_selected', '8', '0', 'icon-qrs', 'ACCESS;ADD;DELETE;DETAIL;SELECT;APPROVE;');
INSERT INTO `sys_menu` VALUES ('17', 'Purchase', 'Purchase Order', '9', 'purchase_order', '10', '0', 'icon-po', 'ACCESS;ADD;DELETE;PDF;APPROVE;SELECT;');
INSERT INTO `sys_menu` VALUES ('18', 'Purchase', 'Document Receive', '34', 'document_receive', '10', '0', 'icon-dr', 'ACCESS;ADD;EDIT;DELETE;PRINT;IMPORT;PDF;EXCEL;APPROVE;');
INSERT INTO `sys_menu` VALUES ('19', 'Logistic', 'Delivery Order', '34', 'delivery_order', '8', '0', 'icon-delivery', 'ACCESS;ADD;DETAIL;DELETE;PDF;APPROVE;');
INSERT INTO `sys_menu` VALUES ('20', 'Purchase', 'Berita Acara Pengembalian', '9', 'underconstruction', '12', '0', 'icon-bap', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('21', 'Logistic', 'Return', '34', 'retur', '13', '0', 'icon-bapp', 'ACCESS;ADD;DETAIL;');
INSERT INTO `sys_menu` VALUES ('22', 'Logistic', 'Request Order Logistic', '34', 'request_order_logistic', '4', '0', 'icon-rol', 'ACCESS;DETAIL;APPROVE;');
INSERT INTO `sys_menu` VALUES ('23', 'Administrator', 'Menu', '1', 'menu', '1', '0', 'icon-menu', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_menu` VALUES ('34', 'Logistic', 'Logistic', '0', '#', '3', '0', 'icon-logistic', 'ACCESS;');
INSERT INTO `sys_menu` VALUES ('36', 'Setup', 'Setup', '0', '#', '1', '0', 'icon-setup', 'ACCESS;');
INSERT INTO `sys_menu` VALUES ('37', 'Logistic', 'Request Order Approval', '34', 'request_order_approval', '3', '0', 'icon-approval', 'ACCESS;ADD;EDIT;DELETE;DETAIL;APPROVE;');
INSERT INTO `sys_menu` VALUES ('38', 'Logistic', 'Delivered', '34', 'delivered', '9', '0', 'icon-delivered', 'ACCESS;DETAIL;');
INSERT INTO `sys_menu` VALUES ('39', 'Purchase', 'Ordered', '9', 'ordered', '11', '0', 'icon-ordered', 'DETAIL;');
INSERT INTO `sys_menu` VALUES ('40', 'Logistic', 'Alocate Return', '34', 'alocate_return', '14', '1', '', 'ACCESS;DETAIL;');
INSERT INTO `sys_menu` VALUES ('41', 'Logistic', 'Inbound', '34', 'inbound', '20', '0', 'icon-inbound', 'ACCESS;ADD;DETAIL;DELETE;PDF;APPROVE;');
INSERT INTO `sys_menu` VALUES ('42', 'Logistic', 'Stock On Hand', '34', 'soh', '21', '0', 'icon-stock', 'ACCESS;');
INSERT INTO `sys_menu` VALUES ('43', 'Logistic', 'Transfer', '34', 'transfer', '26', '0', 'icon-transfer', 'ACCESS;ADD;EDIT;DELETE;DETAIL;');
INSERT INTO `sys_menu` VALUES ('44', 'Setup', 'Satuan', '36', 'satuan', '3', '0', 'icon-satuan', 'ACCESS;ADD;EDIT;DELETE;');

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
  `departement_id` smallint(6) DEFAULT NULL,
  `user_level_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES ('1', '1111111', 'admin', 'administrator', '21232f297a57a5a743894a0e4a801fc3', '1', '1');
INSERT INTO `sys_user` VALUES ('11', '1111112', 'iqbal', 'Mochamad Iqbal', 'eedae20fc3c7a6e9c5b1102098771c70', '15', '1');
INSERT INTO `sys_user` VALUES ('12', '12345', 'harry', 'Harry Pret', '3b87c97d15e8eb11e51aa25e9a5770e9', '17', '1');
INSERT INTO `sys_user` VALUES ('13', '5757', 'demas', 'Demassah', 'd8f08986e8072e78bf9295c294ef3bc2', '1', '1');
INSERT INTO `sys_user` VALUES ('14', '3453', 'asd', 'logistic', '7815696ecbf1c96e6894b779456d330e', '19', '2');
INSERT INTO `sys_user` VALUES ('15', '56361', 'tes', 'tes', '28b662d883b6d76fd96e4ddc5e9ba780', '0', '1');
INSERT INTO `sys_user` VALUES ('16', '112233', 'superadmin', 'Superadmin', '17c4520f6cfd1ab53d8745e84681eb49', '19', '14');
INSERT INTO `sys_user` VALUES ('17', '9988', 'operator', 'operator', '4b583376b2767b923c3e1da60d10de59', null, '1');
INSERT INTO `sys_user` VALUES ('18', '9988', 'requestor', 'Requestor', '560115e15fdc6b37096d514904104a57', '0', '4');

-- ----------------------------
-- Table structure for sys_user_access
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_access`;
CREATE TABLE `sys_user_access` (
  `user_access_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `menu_id` smallint(6) NOT NULL DEFAULT '0',
  `user_level_id` smallint(6) NOT NULL DEFAULT '0',
  `policy` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`user_access_id`)
) ENGINE=InnoDB AUTO_INCREMENT=821 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user_access
-- ----------------------------
INSERT INTO `sys_user_access` VALUES ('1', '1', '1', 'ACCESS;');
INSERT INTO `sys_user_access` VALUES ('2', '2', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;');
INSERT INTO `sys_user_access` VALUES ('3', '3', '1', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_user_access` VALUES ('4', '4', '1', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_user_access` VALUES ('727', '5', '1', 'ACCESS;');
INSERT INTO `sys_user_access` VALUES ('728', '6', '1', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_user_access` VALUES ('729', '7', '1', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_user_access` VALUES ('730', '8', '1', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_user_access` VALUES ('731', '9', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;');
INSERT INTO `sys_user_access` VALUES ('732', '10', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('733', '11', '1', 'ACCESS;DETAIL;EDIT;DELETE;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('734', '12', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('735', '13', '1', 'ACCESS;ADD;DETAIL;DELETE;PRINT;PDF;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('736', '14', '1', 'ACCESS;ADD;DETAIL;DELETE;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('737', '15', '1', 'ACCESS;ADD;DETAIL;DELETE;SELECT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('739', '17', '1', 'ACCESS;ADD;EDIT;DELETE;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('740', '18', '1', 'ACCESS;ADD;EDIT;DELETE;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('741', '19', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;PDF;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('742', '20', '1', '');
INSERT INTO `sys_user_access` VALUES ('743', '21', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;');
INSERT INTO `sys_user_access` VALUES ('744', '22', '1', 'ACCESS;DETAIL;EDIT;DELETE;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('745', '23', '1', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_user_access` VALUES ('746', '34', '1', 'ACCESS;');
INSERT INTO `sys_user_access` VALUES ('747', '35', '1', 'ACCESS;');
INSERT INTO `sys_user_access` VALUES ('748', '36', '1', 'ACCESS;');
INSERT INTO `sys_user_access` VALUES ('749', '37', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('750', '38', '1', 'ACCESS;DETAIL;');
INSERT INTO `sys_user_access` VALUES ('751', '39', '1', 'ACCESS;DETAIL;');
INSERT INTO `sys_user_access` VALUES ('752', '40', '1', 'ACCESS;DETAIL;');
INSERT INTO `sys_user_access` VALUES ('753', '41', '1', 'ACCESS;ADD;DETAIL;DELETE;PDF;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('754', '42', '1', 'ACCESS;');
INSERT INTO `sys_user_access` VALUES ('755', '43', '1', 'ACCESS;ADD;DETAIL;EDIT;DELETE;');
INSERT INTO `sys_user_access` VALUES ('756', '44', '1', 'ACCESS;ADD;EDIT;DELETE;');
INSERT INTO `sys_user_access` VALUES ('757', '36', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('758', '4', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('759', '44', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('760', '5', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('761', '6', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('762', '7', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('763', '8', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('764', '34', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('765', '10', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('766', '37', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('767', '22', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('768', '11', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('769', '12', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('770', '13', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('771', '19', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('772', '38', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('773', '21', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('774', '40', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('775', '41', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('776', '42', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('777', '43', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('778', '9', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('779', '14', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('780', '15', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('781', '17', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('782', '39', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('783', '20', '14', '');
INSERT INTO `sys_user_access` VALUES ('784', '18', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('785', '1', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('786', '23', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('787', '2', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('788', '3', '14', 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;');
INSERT INTO `sys_user_access` VALUES ('789', '36', '4', '');
INSERT INTO `sys_user_access` VALUES ('790', '4', '4', '');
INSERT INTO `sys_user_access` VALUES ('791', '44', '4', '');
INSERT INTO `sys_user_access` VALUES ('792', '5', '4', 'ACCESS;');
INSERT INTO `sys_user_access` VALUES ('793', '6', '4', 'ACCESS;');
INSERT INTO `sys_user_access` VALUES ('794', '7', '4', 'ACCESS;');
INSERT INTO `sys_user_access` VALUES ('795', '8', '4', 'ACCESS;');
INSERT INTO `sys_user_access` VALUES ('796', '34', '4', '');
INSERT INTO `sys_user_access` VALUES ('797', '10', '4', '');
INSERT INTO `sys_user_access` VALUES ('798', '37', '4', '');
INSERT INTO `sys_user_access` VALUES ('799', '22', '4', '');
INSERT INTO `sys_user_access` VALUES ('800', '11', '4', '');
INSERT INTO `sys_user_access` VALUES ('801', '12', '4', '');
INSERT INTO `sys_user_access` VALUES ('802', '13', '4', '');
INSERT INTO `sys_user_access` VALUES ('803', '19', '4', '');
INSERT INTO `sys_user_access` VALUES ('804', '38', '4', '');
INSERT INTO `sys_user_access` VALUES ('805', '21', '4', '');
INSERT INTO `sys_user_access` VALUES ('806', '40', '4', '');
INSERT INTO `sys_user_access` VALUES ('807', '41', '4', '');
INSERT INTO `sys_user_access` VALUES ('808', '42', '4', '');
INSERT INTO `sys_user_access` VALUES ('809', '43', '4', '');
INSERT INTO `sys_user_access` VALUES ('810', '9', '4', '');
INSERT INTO `sys_user_access` VALUES ('811', '14', '4', '');
INSERT INTO `sys_user_access` VALUES ('812', '15', '4', '');
INSERT INTO `sys_user_access` VALUES ('813', '17', '4', '');
INSERT INTO `sys_user_access` VALUES ('814', '39', '4', '');
INSERT INTO `sys_user_access` VALUES ('815', '20', '4', '');
INSERT INTO `sys_user_access` VALUES ('816', '18', '4', '');
INSERT INTO `sys_user_access` VALUES ('817', '1', '4', '');
INSERT INTO `sys_user_access` VALUES ('818', '23', '4', '');
INSERT INTO `sys_user_access` VALUES ('819', '2', '4', '');
INSERT INTO `sys_user_access` VALUES ('820', '3', '4', '');

-- ----------------------------
-- Table structure for sys_user_level
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_level`;
CREATE TABLE `sys_user_level` (
  `user_level_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(40) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user_level
-- ----------------------------
INSERT INTO `sys_user_level` VALUES ('1', 'Administrator', '99');
INSERT INTO `sys_user_level` VALUES ('2', 'Logistic', '2');
INSERT INTO `sys_user_level` VALUES ('3', 'Purchasing', '3');
INSERT INTO `sys_user_level` VALUES ('4', 'Requestor', '1');
INSERT INTO `sys_user_level` VALUES ('5', 'Vendor', '4');
INSERT INTO `sys_user_level` VALUES ('6', 'Dept Manager', '5');
INSERT INTO `sys_user_level` VALUES ('7', 'Related Dept Manager', '6');
INSERT INTO `sys_user_level` VALUES ('8', 'Inventory', '7');
INSERT INTO `sys_user_level` VALUES ('9', 'Warehouse Man', '8');
INSERT INTO `sys_user_level` VALUES ('10', 'Inbound Receive Team', '9');
INSERT INTO `sys_user_level` VALUES ('11', 'Inbound Retur Team', '10');
INSERT INTO `sys_user_level` VALUES ('12', 'Outbond Distribution Team', '11');
INSERT INTO `sys_user_level` VALUES ('13', 'Courir', '12');
INSERT INTO `sys_user_level` VALUES ('14', 'Superadmin', '999');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_do
-- ----------------------------
INSERT INTO `tr_do` VALUES ('1', '420015', '2015-01-20 11:08:30', '1', '2');
INSERT INTO `tr_do` VALUES ('2', '430016', '2015-01-20 11:08:53', '1', '2');

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
-- Table structure for tr_in
-- ----------------------------
DROP TABLE IF EXISTS `tr_in`;
CREATE TABLE `tr_in` (
  `id_in` int(11) NOT NULL AUTO_INCREMENT,
  `ext_rec_no` int(11) DEFAULT NULL,
  `type` varchar(21) CHARACTER SET utf8 DEFAULT NULL COMMENT 'PO, Return',
  `date_create` datetime DEFAULT NULL,
  `user_id` smallint(6) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_in`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_in
-- ----------------------------
INSERT INTO `tr_in` VALUES ('5', '19', '1', '2015-02-07 02:17:40', '16', '1');

-- ----------------------------
-- Table structure for tr_in_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_in_detail`;
CREATE TABLE `tr_in_detail` (
  `id_detail_in` int(11) NOT NULL AUTO_INCREMENT,
  `id_in` int(11) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `ext_rec_no_detail` int(11) DEFAULT NULL,
  `lokasi` varchar(21) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_in`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tr_in_detail
-- ----------------------------
INSERT INTO `tr_in_detail` VALUES ('1', '5', '201', '2', '9', 'Pusat', '1');

-- ----------------------------
-- Table structure for tr_notifikasi
-- ----------------------------
DROP TABLE IF EXISTS `tr_notifikasi`;
CREATE TABLE `tr_notifikasi` (
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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tr_notifikasi
-- ----------------------------
INSERT INTO `tr_notifikasi` VALUES ('41', 'Request Order telah dikirim ke RO Approval', 'request_order_approval', '19', '0', '0000-00-00', '1', '1', '1', '2');
INSERT INTO `tr_notifikasi` VALUES ('42', 'Purchase Request Baru telah dibuat', 'purchase_request', '4', '0', '0000-00-00', '3', '1', '1', '3');
INSERT INTO `tr_notifikasi` VALUES ('43', 'Request Order Baru telah dibuat', 'request_order', '20', '0', '0000-00-00', '1', '1', '1', '2');
INSERT INTO `tr_notifikasi` VALUES ('44', 'Request Order telah dikirim ke RO Approval', 'request_order_approval', '20', '0', '0000-00-00', '1', '1', '1', '2');
INSERT INTO `tr_notifikasi` VALUES ('45', 'Purchase Request Baru telah dibuat', 'purchase_request', '5', '0', '0000-00-00', '3', '1', '1', '3');
INSERT INTO `tr_notifikasi` VALUES ('46', 'Request Order Baru telah dibuat', 'request_order', '21', '0', '0000-00-00', '1', '1', '1', '2');
INSERT INTO `tr_notifikasi` VALUES ('47', 'Request Order telah dikirim ke RO Approval', 'request_order_approval', '21', '0', '0000-00-00', '1', '1', '1', '2');
INSERT INTO `tr_notifikasi` VALUES ('48', 'RO Approval telah dikirim ke RO Logistic', 'request_order_logistic', '21', '0', '0000-00-00', '1', '1', '1', '2');
INSERT INTO `tr_notifikasi` VALUES ('49', 'RO Logistic telah dikirim ke RO Selected', 'request_order_selected', '21', '0', '0000-00-00', '1', '1', '1', '2');
INSERT INTO `tr_notifikasi` VALUES ('50', 'Purchase Request Baru telah dibuat', 'purchase_request', '6', '0', '0000-00-00', '3', '1', '1', '3');
INSERT INTO `tr_notifikasi` VALUES ('51', 'Request Order Baru telah dibuat', 'request_order', '22', '1', '0000-00-00', '1', '1', '1', '2');

-- ----------------------------
-- Table structure for tr_po
-- ----------------------------
DROP TABLE IF EXISTS `tr_po`;
CREATE TABLE `tr_po` (
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tr_po
-- ----------------------------
INSERT INTO `tr_po` VALUES ('17', '13', '1', '1', '16', '19', 'REQUEST', 'ASSET', 'SPK/123', '2015-01-20', '2015-02-06 22:21:31', '2');
INSERT INTO `tr_po` VALUES ('18', '14', '1', '1', '16', '19', 'REQUEST', 'ASSET', 'SPK/123', '2015-01-20', '2015-02-06 22:26:10', '1');
INSERT INTO `tr_po` VALUES ('19', '16', '6', '21', '16', '19', 'REQUEST', 'ASSET', '12354', '2015-02-06', '2015-02-07 01:01:24', '2');

-- ----------------------------
-- Table structure for tr_pr
-- ----------------------------
DROP TABLE IF EXISTS `tr_pr`;
CREATE TABLE `tr_pr` (
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tr_pr
-- ----------------------------
INSERT INTO `tr_pr` VALUES ('1', '1', null, '1', 'REQUEST', 'ASSET', 'SPK/123', '2015-01-20', '2015-01-20 09:22:32', '2');
INSERT INTO `tr_pr` VALUES ('4', '19', null, '1', 'REQUEST', 'ASSET', '1', '2015-02-03', '2015-02-03 12:48:48', '2');
INSERT INTO `tr_pr` VALUES ('5', '20', null, '1', 'REQUEST', 'ATK', '1234', '2015-02-04', '2015-02-04 16:27:03', '2');
INSERT INTO `tr_pr` VALUES ('6', '21', null, '16', 'REQUEST', 'ASSET', '12354', '2015-02-06', '2015-02-06 17:28:29', '2');

-- ----------------------------
-- Table structure for tr_pros_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_pros_detail`;
CREATE TABLE `tr_pros_detail` (
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_pros_detail
-- ----------------------------
INSERT INTO `tr_pros_detail` VALUES ('1', '4', '2', '1', '1', '301', '4', 'Workshop', '2015-01-19 20:06:59', '1', '1', '1');
INSERT INTO `tr_pros_detail` VALUES ('2', '5', '3', '2', '2', '302', '3', 'Workshop', '2015-01-19 20:07:24', '1', '1', '1');
INSERT INTO `tr_pros_detail` VALUES ('3', '9', '19', '3', '3', '201', '3', 'Pusat', '2015-02-03 13:51:25', '1', '0', '1');
INSERT INTO `tr_pros_detail` VALUES ('4', '13', '21', null, '0', '201', '23', 'CROSSDOCK', '2015-02-07 02:02:53', '1', '0', '2');
INSERT INTO `tr_pros_detail` VALUES ('5', '13', '21', null, '0', '201', '54', 'CROSSDOCK', '2015-02-07 02:02:53', '1', '0', '2');

-- ----------------------------
-- Table structure for tr_pr_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_pr_detail`;
CREATE TABLE `tr_pr_detail` (
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_pr_detail
-- ----------------------------
INSERT INTO `tr_pr_detail` VALUES ('1', '1', '1', '1', '100', '20', '1', '2015-01-19 18:30:40', null, '2', '0');
INSERT INTO `tr_pr_detail` VALUES ('2', '1', '2', '1', '201', '10', '1', '2015-01-19 18:30:40', null, '2', '0');
INSERT INTO `tr_pr_detail` VALUES ('3', '1', '3', '1', '203', '5', '1', '2015-01-19 18:30:40', null, '2', '0');
INSERT INTO `tr_pr_detail` VALUES ('4', '0', '4', '2', '301', '1', '1', '2015-01-19 20:07:18', null, '1', '0');
INSERT INTO `tr_pr_detail` VALUES ('5', '4', '9', '19', '201', '2', '1', '2015-02-03 13:51:08', null, '2', '0');
INSERT INTO `tr_pr_detail` VALUES ('6', '5', '10', '20', '100', '34', '1', '2015-02-04 16:29:20', null, '2', '0');
INSERT INTO `tr_pr_detail` VALUES ('7', '5', '11', '20', '302', '12', '1', '2015-02-04 16:29:20', null, '2', '0');
INSERT INTO `tr_pr_detail` VALUES ('8', '5', '12', '20', '100', '12', '1', '2015-02-04 16:29:20', null, '2', '0');
INSERT INTO `tr_pr_detail` VALUES ('9', '6', '13', '21', '201', '123', '16', '2015-02-06 17:37:37', null, '2', '0');

-- ----------------------------
-- Table structure for tr_qr
-- ----------------------------
DROP TABLE IF EXISTS `tr_qr`;
CREATE TABLE `tr_qr` (
  `id_qr` int(11) NOT NULL AUTO_INCREMENT,
  `id_qrs` int(11) DEFAULT NULL,
  `id_pr` int(11) DEFAULT NULL,
  `id_vendor` varchar(21) DEFAULT NULL,
  `id_po` int(11) DEFAULT '0',
  `top` int(3) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  PRIMARY KEY (`id_qr`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_qr
-- ----------------------------
INSERT INTO `tr_qr` VALUES ('43', '13', '1', 'V001', '17', '2', '2015-02-06', '2');
INSERT INTO `tr_qr` VALUES ('44', '13', '1', 'V002', '0', '4', '2015-02-06', '1');
INSERT INTO `tr_qr` VALUES ('45', '13', '1', 'V003', '0', '5', '2015-02-06', '1');
INSERT INTO `tr_qr` VALUES ('46', '14', '1', 'V001', '0', '13', '2015-02-06', '1');
INSERT INTO `tr_qr` VALUES ('47', '14', '1', 'V002', '18', '4', '2015-02-06', '2');
INSERT INTO `tr_qr` VALUES ('48', '14', '1', 'V003', '0', '5', '2015-02-06', '1');
INSERT INTO `tr_qr` VALUES ('49', '16', '6', 'V001', '0', '12', '2015-02-07', '1');
INSERT INTO `tr_qr` VALUES ('50', '16', '6', 'V002', '19', '2', '2015-02-07', '2');
INSERT INTO `tr_qr` VALUES ('51', '16', '6', 'V003', '0', '3', '2015-02-07', '1');
INSERT INTO `tr_qr` VALUES ('52', '17', '6', 'V001', '0', '11', '2015-02-07', '1');
INSERT INTO `tr_qr` VALUES ('53', '17', '6', 'V002', '0', '12', '2015-02-07', '1');
INSERT INTO `tr_qr` VALUES ('54', '17', '6', 'V003', '0', '34', '2015-02-07', '1');

-- ----------------------------
-- Table structure for tr_qrs
-- ----------------------------
DROP TABLE IF EXISTS `tr_qrs`;
CREATE TABLE `tr_qrs` (
  `id_qrs` int(11) NOT NULL AUTO_INCREMENT,
  `id_po` int(11) DEFAULT NULL,
  `id_pr` int(11) DEFAULT NULL,
  `id_ro` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_id` smallint(6) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_qrs`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_qrs
-- ----------------------------
INSERT INTO `tr_qrs` VALUES ('13', '17', '1', '1', '2015-02-06 01:58:36', '1', '2');
INSERT INTO `tr_qrs` VALUES ('14', '18', '1', '1', '2015-02-06 01:59:06', '1', '2');
INSERT INTO `tr_qrs` VALUES ('16', '19', '6', '21', '2015-02-07 00:59:54', '16', '2');
INSERT INTO `tr_qrs` VALUES ('17', null, '6', '21', '2015-02-07 01:00:11', '16', '1');

-- ----------------------------
-- Table structure for tr_qrs_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_qrs_detail`;
CREATE TABLE `tr_qrs_detail` (
  `id_detail_qrs` int(11) NOT NULL AUTO_INCREMENT,
  `id_qrs` int(11) DEFAULT NULL,
  `id_pr` int(11) DEFAULT NULL,
  `id_detail_pr` int(11) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_qrs`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_qrs_detail
-- ----------------------------
INSERT INTO `tr_qrs_detail` VALUES ('26', '13', '1', '1', '100', '4', '1');
INSERT INTO `tr_qrs_detail` VALUES ('27', '13', '1', '2', '201', '3', '1');
INSERT INTO `tr_qrs_detail` VALUES ('28', '13', '1', '3', '203', '3', '1');
INSERT INTO `tr_qrs_detail` VALUES ('29', '14', '1', '1', '100', '4', '1');
INSERT INTO `tr_qrs_detail` VALUES ('30', '14', '1', '2', '201', '4', '1');
INSERT INTO `tr_qrs_detail` VALUES ('31', '14', '1', '3', '203', '1', '1');
INSERT INTO `tr_qrs_detail` VALUES ('32', '16', '6', '9', '201', '100', '1');
INSERT INTO `tr_qrs_detail` VALUES ('33', '17', '6', '9', '201', '23', '1');

-- ----------------------------
-- Table structure for tr_qr_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_qr_detail`;
CREATE TABLE `tr_qr_detail` (
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
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_qr_detail
-- ----------------------------
INSERT INTO `tr_qr_detail` VALUES ('137', '43', '13', '1', '1', '100', '4', '12', '2015-02-06 01:58:54', '1');
INSERT INTO `tr_qr_detail` VALUES ('138', '43', '13', '2', '1', '201', '3', '12', '2015-02-06 01:58:54', '1');
INSERT INTO `tr_qr_detail` VALUES ('139', '43', '13', '3', '1', '203', '2', '12', '2015-02-06 01:58:54', '1');
INSERT INTO `tr_qr_detail` VALUES ('140', '44', '13', '1', '1', '100', '4', '0', '2015-02-06 01:58:58', '1');
INSERT INTO `tr_qr_detail` VALUES ('141', '44', '13', '2', '1', '201', '3', '0', '2015-02-06 01:58:58', '1');
INSERT INTO `tr_qr_detail` VALUES ('142', '44', '13', '3', '1', '203', '2', '0', '2015-02-06 01:58:58', '1');
INSERT INTO `tr_qr_detail` VALUES ('143', '45', '13', '1', '1', '100', '4', '0', '2015-02-06 01:59:02', '1');
INSERT INTO `tr_qr_detail` VALUES ('144', '45', '13', '2', '1', '201', '3', '0', '2015-02-06 01:59:02', '1');
INSERT INTO `tr_qr_detail` VALUES ('145', '45', '13', '3', '1', '203', '2', '0', '2015-02-06 01:59:02', '1');
INSERT INTO `tr_qr_detail` VALUES ('146', '46', '14', '1', '1', '100', '4', '0', '2015-02-06 01:59:29', '1');
INSERT INTO `tr_qr_detail` VALUES ('147', '46', '14', '2', '1', '201', '4', '0', '2015-02-06 01:59:29', '1');
INSERT INTO `tr_qr_detail` VALUES ('148', '46', '14', '3', '1', '203', '1', '0', '2015-02-06 01:59:29', '1');
INSERT INTO `tr_qr_detail` VALUES ('149', '47', '14', '1', '1', '100', '4', '23', '2015-02-06 01:59:33', '1');
INSERT INTO `tr_qr_detail` VALUES ('150', '47', '14', '2', '1', '201', '4', '23', '2015-02-06 01:59:33', '1');
INSERT INTO `tr_qr_detail` VALUES ('151', '47', '14', '3', '1', '203', '1', '34', '2015-02-06 01:59:33', '1');
INSERT INTO `tr_qr_detail` VALUES ('152', '48', '14', '1', '1', '100', '4', '0', '2015-02-06 01:59:36', '1');
INSERT INTO `tr_qr_detail` VALUES ('153', '48', '14', '2', '1', '201', '4', '0', '2015-02-06 01:59:36', '1');
INSERT INTO `tr_qr_detail` VALUES ('154', '48', '14', '3', '1', '203', '1', '0', '2015-02-06 01:59:36', '1');
INSERT INTO `tr_qr_detail` VALUES ('155', '49', '16', '9', '6', '201', '100', '0', '2015-02-07 01:00:40', '1');
INSERT INTO `tr_qr_detail` VALUES ('156', '50', '16', '9', '6', '201', '100', '1000000', '2015-02-07 01:00:45', '1');
INSERT INTO `tr_qr_detail` VALUES ('157', '51', '16', '9', '6', '201', '100', '0', '2015-02-07 01:00:48', '1');
INSERT INTO `tr_qr_detail` VALUES ('158', '52', '17', '9', '6', '201', '23', '23', '2015-02-07 14:15:31', '1');
INSERT INTO `tr_qr_detail` VALUES ('159', '53', '17', '9', '6', '201', '23', '45', '2015-02-07 14:16:54', '1');
INSERT INTO `tr_qr_detail` VALUES ('160', '54', '17', '9', '6', '201', '23', '23', '2015-02-07 14:16:59', '1');

-- ----------------------------
-- Table structure for tr_receive
-- ----------------------------
DROP TABLE IF EXISTS `tr_receive`;
CREATE TABLE `tr_receive` (
  `id_receive` int(11) NOT NULL AUTO_INCREMENT,
  `id_courir` varchar(21) DEFAULT NULL,
  `id_sro` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` smallint(6) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_receive`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tr_receive
-- ----------------------------
INSERT INTO `tr_receive` VALUES ('1', '420015', '1', '2015-01-19 00:00:00', '1', '1');
INSERT INTO `tr_receive` VALUES ('2', '430016', '2', '2015-01-19 00:00:00', '1', '2');

-- ----------------------------
-- Table structure for tr_receive_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_receive_detail`;
CREATE TABLE `tr_receive_detail` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tr_receive_detail
-- ----------------------------
INSERT INTO `tr_receive_detail` VALUES ('1', '1', '1', '4', '2', '1', '301', '4', '2015-01-19 20:14:10', '1');
INSERT INTO `tr_receive_detail` VALUES ('2', '2', '2', '5', '3', '2', '302', '3', '2015-01-19 20:14:21', '1');

-- ----------------------------
-- Table structure for tr_return
-- ----------------------------
DROP TABLE IF EXISTS `tr_return`;
CREATE TABLE `tr_return` (
  `id_return` int(11) NOT NULL AUTO_INCREMENT,
  `id_receive` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_return`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tr_return
-- ----------------------------

-- ----------------------------
-- Table structure for tr_return_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_return_detail`;
CREATE TABLE `tr_return_detail` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tr_return_detail
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
  `date_approve` datetime DEFAULT '0000-00-00 00:00:00',
  `date_reject` datetime DEFAULT '0000-00-00 00:00:00',
  `status` int(1) DEFAULT NULL COMMENT '1: RO, 2: ROA, 3:ROL, 4: ROS, 5: Picking, 6: Shipment, 7: DO, 9: Reject',
  `status_order` smallint(1) DEFAULT '1' COMMENT '1: ORDER, 2: PURCHASE, 3: RETURN',
  PRIMARY KEY (`id_ro`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_ro
-- ----------------------------
INSERT INTO `tr_ro` VALUES ('19', '1', 'REQUEST', 'ASSET', '1', '2015-02-03', '2015-02-03 12:48:48', '2015-02-03 13:46:42', '0000-00-00 00:00:00', '6', '1');
INSERT INTO `tr_ro` VALUES ('20', '1', 'REQUEST', 'ATK', '1234', '2015-02-04', '2015-02-04 16:27:03', '2015-02-04 16:28:30', '0000-00-00 00:00:00', '6', '1');
INSERT INTO `tr_ro` VALUES ('21', '16', 'REQUEST', 'ASSET', '12354', '2015-02-06', '2015-02-06 17:28:29', '2015-02-06 17:29:24', '0000-00-00 00:00:00', '6', '1');
INSERT INTO `tr_ro` VALUES ('22', '16', 'REQUEST', 'ASSET', '89898', '2015-02-07', '2015-02-07 14:15:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');

-- ----------------------------
-- Table structure for tr_ro_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_ro_detail`;
CREATE TABLE `tr_ro_detail` (
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tr_ro_detail
-- ----------------------------
INSERT INTO `tr_ro_detail` VALUES ('1', '1', 'SPK/123', '100', '20', '2', '1', '2015-01-20 09:22:32', 'adi', '1', '0', '0');
INSERT INTO `tr_ro_detail` VALUES ('2', '1', 'SPK/123', '201', '10', '1', '1', '2015-01-20 09:22:32', 'ida', '1', '0', '0');
INSERT INTO `tr_ro_detail` VALUES ('3', '1', 'SPK/123', '203', '5', '1', '1', '2015-01-20 09:22:32', 'MOuse logitech', '1', '0', '0');
INSERT INTO `tr_ro_detail` VALUES ('4', '2', '112233', '301', '5', '1', '1', '2015-01-20 10:54:09', 'tes', '1', '0', '0');
INSERT INTO `tr_ro_detail` VALUES ('5', '3', '332211', '302', '3', '1', '1', '2015-01-20 10:54:49', '-', '1', '0', '0');
INSERT INTO `tr_ro_detail` VALUES ('6', '4', '554433', '301', '1', '1', '1', '2015-01-23 13:53:19', 'tes', '1', '0', '0');
INSERT INTO `tr_ro_detail` VALUES ('7', '10', '987897', '203', '15', '1', '1', '2015-01-28 09:34:30', '-', '1', '0', '0');
INSERT INTO `tr_ro_detail` VALUES ('8', '11', '546', '302', '546', '2', '1', '2015-01-28 10:55:38', '-', '1', '0', '0');
INSERT INTO `tr_ro_detail` VALUES ('9', '19', '1', '201', '5', '1', '1', '2015-02-03 12:48:48', '-', '1', '0', '0');
INSERT INTO `tr_ro_detail` VALUES ('10', '20', '1234', '100', '34', '1', '1', '2015-02-04 16:27:03', 'dgfdgdf', '1', '0', '0');
INSERT INTO `tr_ro_detail` VALUES ('11', '20', '1234', '302', '12', '1', '1', '2015-02-04 16:27:03', 'qwewqe', '1', '0', '0');
INSERT INTO `tr_ro_detail` VALUES ('12', '20', '1234', '100', '12', '1', '1', '2015-02-04 16:27:03', 'wqeqwe', '1', '0', '0');
INSERT INTO `tr_ro_detail` VALUES ('13', '21', '12354', '201', '123', '1', '16', '2015-02-06 17:28:29', 'sadasd', '1', '0', '0');
INSERT INTO `tr_ro_detail` VALUES ('14', '22', '89898', '100', '12', '1', '16', '2015-02-07 14:15:47', 'adsd', '1', '0', '0');

-- ----------------------------
-- Table structure for tr_sro
-- ----------------------------
DROP TABLE IF EXISTS `tr_sro`;
CREATE TABLE `tr_sro` (
  `id_sro` int(11) NOT NULL AUTO_INCREMENT,
  `id_do` int(11) DEFAULT NULL,
  `id_ro` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_sro`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_sro
-- ----------------------------
INSERT INTO `tr_sro` VALUES ('1', '1', '2', '2015-01-19 00:00:00', '1', '2');
INSERT INTO `tr_sro` VALUES ('2', '2', '3', '2015-01-19 00:00:00', '1', '2');
INSERT INTO `tr_sro` VALUES ('3', null, '19', '2015-02-06 00:00:00', '1', '1');

-- ----------------------------
-- Table structure for tr_stock
-- ----------------------------
DROP TABLE IF EXISTS `tr_stock`;
CREATE TABLE `tr_stock` (
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tr_stock
-- ----------------------------
INSERT INTO `tr_stock` VALUES ('1', null, null, '301', '2', '1000', 'Workshop', '2015-01-20 10:54:09', '1', null);
INSERT INTO `tr_stock` VALUES ('2', null, null, '302', '0', '500', 'Heavy Equipment', '2015-01-20 10:54:09', '1', null);
INSERT INTO `tr_stock` VALUES ('3', null, null, '201', '0', '250', 'Pusat', '2015-01-20 10:54:09', '1', '0');
INSERT INTO `tr_stock` VALUES ('4', null, null, '100', '2', '210', 'IT', '2015-02-07 01:33:33', '1', null);
INSERT INTO `tr_stock` VALUES ('5', '2', '6', '201', '23', null, 'Pusat', '2015-02-07 02:02:53', '1', '1');
INSERT INTO `tr_stock` VALUES ('6', '2', '7', '201', '54', null, 'Pusat', '2015-02-07 02:02:53', '1', '1');

-- ----------------------------
-- Table structure for tr_transfer
-- ----------------------------
DROP TABLE IF EXISTS `tr_transfer`;
CREATE TABLE `tr_transfer` (
  `id_transfer` int(11) NOT NULL AUTO_INCREMENT,
  `type_transfer` smallint(1) DEFAULT NULL COMMENT '1: move',
  `note` text,
  `date_create` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_transfer`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tr_transfer
-- ----------------------------
INSERT INTO `tr_transfer` VALUES ('1', '1', 'tes', '2015-01-19 23:43:10', '1', '1');
INSERT INTO `tr_transfer` VALUES ('2', '1', 'tes 2', '2015-01-19 23:45:15', '1', '1');

-- ----------------------------
-- Table structure for tr_transfer_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_transfer_detail`;
CREATE TABLE `tr_transfer_detail` (
  `id_detail_transfer` int(11) NOT NULL AUTO_INCREMENT,
  `id_transfer` int(11) DEFAULT NULL,
  `id_stock` int(11) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `id_lokasi` varchar(21) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_transfer`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tr_transfer_detail
-- ----------------------------
INSERT INTO `tr_transfer_detail` VALUES ('7', '1', '1', '301', '1', '1000', 'Heavy Equipment', '1');
INSERT INTO `tr_transfer_detail` VALUES ('8', '2', '2', '302', null, '500', null, '1');

-- ----------------------------
-- View structure for v_po_detail
-- ----------------------------
DROP VIEW IF EXISTS `v_po_detail`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER  VIEW `v_po_detail` AS SELECT
c.id_po AS id_po,
a.id_detail_pr AS id_detail_pr,
a.kode_barang AS kode_barang,
a.note AS note,
a.qty AS qty,
e.price AS price,
(`a`.`qty` * `e`.`price`) AS total,
c.purpose AS purpose,
c.ext_doc_no AS ext_doc_no,
c.ETD AS ETD,
d.top AS top,
f.nama_barang AS nama_barang,
a.user_id AS user_id,
g.full_name AS full_name,
d.id_vendor AS id_vendor,
g.departement_id AS departement_id,
h.departement_name AS departement_name,
c.cat_req AS cat_req,
c.date_create AS date_create
from (((((((`tr_pr_detail` `a` left join `tr_pr` `b` on((`a`.`id_pr` = `b`.`id_pr`))) left join `tr_po` `c` on((`b`.`id_po` = `c`.`id_po`))) left join `tr_qr` `d` on(((`b`.`id_pr` = `d`.`id_pr`) and (`d`.`status` = 2)))) left join `tr_qr_detail` `e` on(((`e`.`id_qr` = `d`.`id_qr`) and (`e`.`id_detail_pr` = `a`.`id_detail_pr`)))) left join `ref_barang` `f` on((`f`.`kode_barang` = `a`.`kode_barang`))) left join `sys_user` `g` on((`g`.`user_id` = `a`.`user_id`))) left join `ref_departement` `h` on((`h`.`departement_id` = `g`.`departement_id`))) ;

-- ----------------------------
-- View structure for v_po_detail_2
-- ----------------------------
DROP VIEW IF EXISTS `v_po_detail_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_po_detail_2` AS SELECT
tr_po.id_po,
tr_po.requestor,
tr_po.departement,
tr_po.purpose,
tr_po.cat_req,
tr_po.ext_doc_no,
tr_po.ETD,
tr_po.date_create,
tr_qr.top,
tr_qr.id_vendor,
tr_qr.id_pr,
tr_qr.id_qrs,
ref_vendor.name_vendor,
ref_vendor.address_vendor,
ref_vendor.contact_vendor,
ref_vendor.mobile_vendor,
tr_qr_detail.kode_barang,
tr_qr_detail.qty,
tr_qr_detail.price,
(tr_qr_detail.qty * tr_qr_detail.price) AS total,
tr_qr.id_qr,
tr_qr_detail.id_detail_pr,
sys_user.full_name,
sys_user.departement_id,
ref_departement.departement_name,
ref_barang.nama_barang,
tr_pr_detail.note
FROM
tr_po
LEFT JOIN tr_qr ON tr_qr.id_po = tr_po.id_po
LEFT JOIN ref_vendor ON tr_qr.id_vendor = ref_vendor.id_vendor
LEFT JOIN tr_qr_detail ON tr_qr.id_qrs = tr_qr_detail.id_qrs AND tr_qr.id_pr = tr_qr_detail.id_pr AND tr_qr.id_qr = tr_qr_detail.id_qr
LEFT JOIN sys_user ON tr_po.requestor = sys_user.user_id
LEFT JOIN ref_departement ON sys_user.departement_id = ref_departement.departement_id
LEFT JOIN ref_barang ON tr_qr_detail.kode_barang = ref_barang.kode_barang
LEFT JOIN tr_pr_detail ON tr_qr_detail.id_detail_pr = tr_pr_detail.id_detail_pr ;

-- ----------------------------
-- View structure for v_po_inbound
-- ----------------------------
DROP VIEW IF EXISTS `v_po_inbound`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER  VIEW `v_po_inbound` AS select 
`x`.`id_detail_pr` AS `id_detail_pr`,
`x`.`id_pr` AS `id_pr`,
`z`.`id_po` AS `id_po`,
`x`.`kode_barang` AS `kode_barang`,
`x`.`qty` AS `asal`,
coalesce(sum(`y`.`qty`),0) AS `receive`,
(`x`.`qty` - coalesce(sum(`y`.`qty`),0)) AS `sisa`,
`a`.`nama_barang` AS `nama_barang` 
from (((`tr_pr_detail` `x` left join `tr_in_detail` `y` on((`x`.`id_detail_pr` = `y`.`ext_rec_no_detail`))) 
			left join `tr_pr` `z` on((`x`.`id_pr` = `z`.`id_pr`))) left join `ref_barang` `a` on((`x`.`kode_barang` = `a`.`kode_barang`))) 
where (`z`.`id_po` <> '') group by `x`.`id_detail_pr` ;

-- ----------------------------
-- View structure for v_po_inbound_2
-- ----------------------------
DROP VIEW IF EXISTS `v_po_inbound_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_po_inbound_2` AS SELECT
x.id_detail_pr,
x.id_pr,
z.id_po,
x.kode_barang,
x.qty AS asal,
coalesce(sum(`y`.`qty`),0) AS receive,
(`x`.`qty` - coalesce(sum(`y`.`qty`),0)) AS sisa,
a.nama_barang
FROM
tr_qrs_detail AS x
LEFT JOIN tr_in_detail AS y ON x.id_detail_pr = y.ext_rec_no_detail
LEFT JOIN tr_qrs AS z ON x.id_pr = z.id_pr
LEFT JOIN ref_barang AS a ON x.kode_barang = a.kode_barang
where (`z`.`id_po` <> '')
group by `x`.`id_detail_pr` ;

-- ----------------------------
-- View structure for v_print_inbound
-- ----------------------------
DROP VIEW IF EXISTS `v_print_inbound`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER  VIEW `v_print_inbound` AS select `a`.`id_in` AS `id_in`,`a`.`type` AS `type`,`b`.`id_po` AS `id_po`,`b`.`id_pr` AS `id_pr`,`b`.`id_ro` AS `id_ro`,`b`.`requestor` AS `requestor`,`b`.`departement` AS `departement`,`b`.`purpose` AS `purpose`,`b`.`cat_req` AS `cat_req`,`a`.`date_create` AS `date_create`,`c`.`id_detail_in` AS `id_detail_in`,`c`.`kode_barang` AS `kode_barang`,`c`.`qty` AS `qty`,`c`.`lokasi` AS `lokasi`,`d`.`nama_barang` AS `nama_barang`,`f`.`full_name` AS `full_name`,`g`.`departement_name` AS `departement_name`,`b`.`ext_doc_no` AS `ext_doc_no` from (((((`tr_in` `a` left join `tr_po` `b` on((`a`.`ext_rec_no` = `b`.`id_po`))) left join `tr_in_detail` `c` on((`a`.`id_in` = `c`.`id_in`))) left join `ref_barang` `d` on((`c`.`kode_barang` = convert(`d`.`kode_barang` using utf8)))) left join `sys_user` `f` on((`a`.`user_id` = `f`.`user_id`))) left join `ref_departement` `g` on((`b`.`departement` = `g`.`departement_id`))) ;

-- ----------------------------
-- View structure for v_pros_detail
-- ----------------------------
DROP VIEW IF EXISTS `v_pros_detail`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_pros_detail` AS select `tr_ro_detail`.`id_detail_ro` AS `id_detail_ro`,`tr_ro_detail`.`id_ro` AS `id_ro`,`tr_ro_detail`.`kode_barang` AS `kode_barang`,`tr_ro_detail`.`qty` AS `orders`,(`tr_ro_detail`.`qty` - (`tr_ro_detail`.`qty` - coalesce(sum(`tr_pros_detail`.`qty`),0))) AS `picking`,(`tr_ro_detail`.`qty` - coalesce(sum(`tr_pros_detail`.`qty`),0)) AS `sisa` from (`tr_ro_detail` left join `tr_pros_detail` on((`tr_ro_detail`.`id_detail_ro` = `tr_pros_detail`.`id_detail_ro`))) where (`tr_ro_detail`.`status_delete` <> 1) group by `tr_ro_detail`.`id_detail_ro` ; ;

-- ----------------------------
-- View structure for v_qrs_detail
-- ----------------------------
DROP VIEW IF EXISTS `v_qrs_detail`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER  VIEW `v_qrs_detail` AS (select `a`.`id_detail_pr` AS `id_detail_pr`,`a`.`id_pr` AS `id_pr`,`a`.`id_ro` AS `id_ro`,`b`.`id_detail_qrs` AS `id_detail_qrs`,`a`.`kode_barang` AS `kode_barang`,`a`.`qty` AS `qty`,coalesce(sum(`b`.`qty`),0) AS `pick`,(`a`.`qty` - coalesce(sum(`b`.`qty`),0)) AS `sisa` from ((`tr_pr_detail` `a` left join `tr_pr` `c` on((`a`.`id_pr` = `c`.`id_pr`))) left join `tr_qrs_detail` `b` on((`a`.`id_detail_pr` = `b`.`id_detail_pr`))) where (`c`.`status` = 2) group by `a`.`id_detail_pr`) ; ;

-- ----------------------------
-- View structure for v_status_barang
-- ----------------------------
DROP VIEW IF EXISTS `v_status_barang`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER  VIEW `v_status_barang` AS (select `ref_barang`.`kode_barang` AS `kode_barang`,(case `ref_barang`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_barang` from `ref_barang`) ; ;

-- ----------------------------
-- View structure for v_status_kategori
-- ----------------------------
DROP VIEW IF EXISTS `v_status_kategori`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER  VIEW `v_status_kategori` AS (select `ref_kategori`.`id_kategori` AS `id_kategori`,(case `ref_kategori`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_kategori` from `ref_kategori`) ; ;

-- ----------------------------
-- View structure for v_status_satuan
-- ----------------------------
DROP VIEW IF EXISTS `v_status_satuan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER  VIEW `v_status_satuan` AS (select `ref_satuan`.`id_satuan` AS `id_satuan`,(case `ref_satuan`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_satuan` from `ref_satuan`) ; ;

-- ----------------------------
-- View structure for v_status_sub_kategori
-- ----------------------------
DROP VIEW IF EXISTS `v_status_sub_kategori`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER  VIEW `v_status_sub_kategori` AS (select `ref_sub_kategori`.`id_sub_kategori` AS `id_sub_kategori`,(case `ref_sub_kategori`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_sub_kategori` from `ref_sub_kategori`) ; ;

-- ----------------------------
-- Procedure structure for p_allocated
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_allocated`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_allocated`(IN p_id_ro INT, IN p_user_id INT)
BEGIN











	DECLARE done INT DEFAULT FALSE;











	DECLARE a, b, d INT;











	DECLARE c VARCHAR(21);











	DECLARE cur1 CURSOR FOR SELECT id_detail_ro, id_ro, kode_barang, sisa FROM v_pros_detail WHERE sisa != 0 AND id_ro = p_id_ro ;











	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;











		











	OPEN cur1;











	read_loop : LOOP











	FETCH cur1 INTO a, b, c, d ;











	IF done THEN 











	LEAVE read_loop;











	END IF;











	INSERT INTO tr_pr_detail (id_detail_ro, id_ro, kode_barang, qty, date_create, user_id, STATUS) VALUES (a, b, c, d, CURRENT_TIMESTAMP(), p_user_id,"1");











	END LOOP;











	CLOSE cur1; 











    END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for p_delete_transfer_detail
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_delete_transfer_detail`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_delete_transfer_detail`(IN p_id_transfer INT)
BEGIN











	DECLARE done INT DEFAULT FALSE;











	DECLARE a, b, c INT;











	











	DECLARE cur1 CURSOR FOR 











	SELECT id_stock, qty, id_detail_transfer











	FROM  tr_transfer_detail











	WHERE id_transfer = p_id_transfer ;











	











	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;











		











	OPEN cur1;











	read_loop : LOOP











	FETCH cur1 INTO  a, b, c;











	IF done THEN 











	LEAVE read_loop;











	END IF;











	











	UPDATE tr_stock SET qty = (qty + b) WHERE id_stock = a;	











	DELETE FROM tr_transfer_detail WHERE id_detail_transfer = c;











	END LOOP;











	CLOSE cur1; 











END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for p_id_qrs
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_id_qrs`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_id_qrs`(IN `p_id_pr` int,IN `p_id_qr` int,IN `p_id_qrs` int)
BEGIN
	DECLARE done INT DEFAULT FALSE;
	DECLARE a, c INT;
	DECLARE b VARCHAR(21);
	DECLARE cur1 CURSOR FOR SELECT id_detail_pr,kode_barang, qty FROM tr_qrs_detail WHERE id_pr = p_id_pr  AND id_qrs = p_id_qrs;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	OPEN cur1;
		read_loop : LOOP
			FETCH cur1 INTO a, b, c ;
			IF done THEN 
				LEAVE read_loop;
			END IF;
			INSERT INTO tr_qr_detail (id_qr, id_qrs, id_detail_pr, id_pr, kode_barang, qty, date_create)
			VALUES (p_id_qr, p_id_qrs, a, p_id_pr, b, c, CURRENT_TIMESTAMP());
		END LOOP;
	CLOSE cur1; 
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for p_in_po
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_in_po`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_in_po`(IN p_id_in INT)
BEGIN











	DECLARE done INT DEFAULT FALSE;











	DECLARE a, b, d INT;











	DECLARE c VARCHAR(21);











	DECLARE cur1 CURSOR FOR SELECT  b.`id_detail_ro` ,b.`id_ro`, a.kode_barang, a.qty  











	FROM tr_in_detail a











	LEFT JOIN tr_pr_detail b ON (a.`ext_rec_no_detail` = b.`id_detail_pr`)











	where a.id_in = p_id_in;	











	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;











			











	OPEN cur1;











	read_loop : LOOP











	FETCH cur1 INTO a, b, c, d;











	IF done THEN 











	LEAVE read_loop;











	END IF;











	











	INSERT INTO tr_pros_detail (id_detail_ro, id_ro, id_stock, kode_barang,  qty, id_lokasi, date_create, status, status_picking ) 











	VALUES (  a, b, 0, c, d, 'CROSSDOCK', CURRENT_TIMESTAMP(), 1, 2);











	











	END LOOP;











	CLOSE cur1; 











END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for p_in_stock
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_in_stock`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_in_stock`(IN p_id_in INT)
BEGIN











	DECLARE done INT DEFAULT FALSE;











	DECLARE a, b, d, e, g INT;











	DECLARE c, f VARCHAR(21);











	DECLARE cur1 CURSOR FOR SELECT  a.`id_in`, a.`id_detail_in`, a.`kode_barang`, a.`qty`, f.`price` , a.`lokasi`, b.`type`











	FROM tr_in_detail a











	LEFT JOIN tr_in b ON a.id_in = b.id_in











	LEFT JOIN tr_pr c ON b.`ext_rec_no` = c.`id_po`











	LEFT JOIN tr_pr_detail d ON a.`ext_rec_no_detail` = d.`id_detail_pr`











	LEFT JOIN tr_qr e ON c.`id_pr` = e.`id_pr` AND e.`status` = 2











	LEFT JOIN tr_qr_detail f ON a.`ext_rec_no_detail` = f.`id_detail_pr` AND f.`id_qr` = e.`id_qr`











	where a.id_in = p_id_in ;	











	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;











			











	OPEN cur1;











	read_loop : LOOP











	FETCH cur1 INTO a, b, c, d, e, f, g;











	IF done THEN 











	LEAVE read_loop;











	END IF;











	











	INSERT INTO tr_stock (id_in, id_detail_in, kode_barang,  qty, price, id_lokasi, date_create, status, type_in ) 











	VALUES (  a, b, c, d, e, f, CURRENT_TIMESTAMP(), 1, g);











	











	END LOOP;











	CLOSE cur1; 











END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for p_qrs_detail
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_qrs_detail`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_qrs_detail`(IN p_id_pr INT, IN p_id_qr INT, IN p_id_qrs INT)
BEGIN
	DECLARE done INT DEFAULT FALSE;
	DECLARE a, c INT;
	DECLARE b VARCHAR(21);
	DECLARE cur1 CURSOR FOR SELECT id_detail_pr,kode_barang, qty FROM tr_qrs_detail WHERE id_pr = p_id_pr  AND id_qrs = p_id_qrs;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	OPEN cur1;
		read_loop : LOOP
			FETCH cur1 INTO a, b, c ;
			IF done THEN 
				LEAVE read_loop;
			END IF;
			INSERT INTO tr_qr_detail (id_qr, id_qrs, id_detail_pr, id_pr, kode_barang, qty, date_create)
			VALUES (p_id_qr, p_id_qrs, a, p_id_pr, b, c, CURRENT_TIMESTAMP());
		END LOOP;
	CLOSE cur1; 
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for p_receive_detail
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_receive_detail`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_receive_detail`(IN p_id_receive INT, IN p_id_sro INT)
BEGIN











	DECLARE done INT DEFAULT FALSE;











	DECLARE a, b, c, e INT;











	DECLARE d VARCHAR(21);











	DECLARE cur1 CURSOR FOR SELECT id_detail_pros, id_detail_ro, id_ro, kode_barang, qty FROM tr_pros_detail 











	WHERE id_sro = p_id_sro ;











	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;











		











	OPEN cur1;











	read_loop : LOOP











	FETCH cur1 INTO a, b, c, d, e ;











	IF done THEN 











	LEAVE read_loop;











	END IF;











	INSERT INTO tr_receive_detail (id_receive, id_detail_pros, id_detail_ro, id_ro, id_sro, kode_barang, qty, date_create, status) 











	VALUES (p_id_receive, a, b, c, p_id_sro, d, e, CURRENT_TIMESTAMP(), 1);











	update tr_pros_detail set status_receive =  1 where id_detail_pros = a ;











	END LOOP;











	CLOSE cur1; 











END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for p_receive_return
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_receive_return`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_receive_return`(IN p_id_receive INT)
BEGIN











	DECLARE done INT DEFAULT FALSE;











	DECLARE a, b, c, e, f INT;











	DECLARE d VARCHAR(21);











	DECLARE cur1 CURSOR FOR SELECT  y.id_detail_pros, y.id_ro, y.id_detail_ro, x.kode_barang, (y.qty - x.qty) as sisa, x.id_detail_receive 











	FROM  tr_receive_detail x, tr_pros_detail y 











	where x.id_detail_pros = y.id_detail_pros











	and x.id_receive = p_id_receive;











	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;











		











	OPEN cur1;











	read_loop : LOOP











	FETCH cur1 INTO a, b, c, d, e, f ;











	IF done THEN 











	LEAVE read_loop;











	END IF;











	if e <> 0 then











	INSERT INTO tr_return_detail (id_receive, id_detail_receive, id_detail_pros, id_ro, id_detail_ro, kode_barang, qty, date_create, STATUS) 











	VALUES ( p_id_receive, f, a, b, c, d, e, CURRENT_TIMESTAMP(), 1);











	end if;











	END LOOP;











	CLOSE cur1; 











END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for p_return_order
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_return_order`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_return_order`(IN p_id_return INT)
BEGIN











	DECLARE done INT DEFAULT FALSE;











	DECLARE a INT;











	DECLARE b, c VARCHAR(21);











	DECLARE d DATE;











	DECLARE cur1 CURSOR FOR SELECT x.user_id, y.purpose, y.cat_req, y.ETD











	FROM  tr_return X, tr_ro  Y, tr_receive z, tr_sro v 











	WHERE x.id_return = p_id_return and x.id_receive = z.id_receive and z.id_sro = v.id_sro and v.id_ro = y.id_ro;











	











	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;











		











	OPEN cur1;











	read_loop : LOOP











	FETCH cur1 INTO a, b, c, d;











	IF done THEN 











	LEAVE read_loop;











	END IF;











	











	INSERT INTO tr_ro (user_id, purpose, cat_req, ext_doc_no, ETD, date_create,  status, status_order ) 











	VALUES (  a, b, c, p_id_return, d, CURRENT_TIMESTAMP(), 4, 3);











	











	END LOOP;











	CLOSE cur1; 











END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for p_return_order_detail
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_return_order_detail`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_return_order_detail`(IN p_id_return INT, IN p_id_ro int, IN p_user_id INT)
BEGIN











	DECLARE done INT DEFAULT FALSE;











	DECLARE b INT;











	DECLARE a VARCHAR(21);











	DECLARE c TEXT;











	DECLARE cur1 CURSOR FOR SELECT x.kode_barang, x.qty, y.note











	FROM  tr_return_detail X, tr_ro_detail  Y











	WHERE x.id_return = p_id_return and x.id_detail_ro = y.id_detail_ro;











	











	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;











		











	OPEN cur1;











	read_loop : LOOP











	FETCH cur1 INTO a, b, c;











	IF done THEN 











	LEAVE read_loop;











	END IF;











	











	INSERT INTO tr_ro_detail (id_ro, ext_doc_no, kode_barang,  qty, barang_bekas, user_id, date_create, note, status, status_delete ) 











	VALUES (  p_id_ro, p_id_return, a, b, 1, p_user_id, CURRENT_TIMESTAMP(), c, 1, 0);











	











	END LOOP;











	CLOSE cur1; 











END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for p_transfer
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_transfer`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_transfer`(IN p_id_transfer INT)
BEGIN











	DECLARE done INT DEFAULT FALSE;











	DECLARE b, d, e INT;











	DECLARE c, f VARCHAR(21);











	DECLARE cur1 CURSOR FOR 











	SELECT id_detail_transfer, kode_barang, qty, price, id_lokasi











	FROM  tr_transfer_detail











	WHERE id_transfer = p_id_transfer ;











	











	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;











		











	OPEN cur1;











	read_loop : LOOP











	FETCH cur1 INTO  b, c, d, e, f;











	IF done THEN 











	LEAVE read_loop;











	END IF;











	











	INSERT INTO tr_stock ( id_in, id_detail_in, kode_barang, qty, price, id_lokasi, date_create, status, type_in ) 











	VALUES (  p_id_transfer, b, c, d, e, f, CURRENT_TIMESTAMP(), 1, 2);











	











	END LOOP;











	CLOSE cur1; 











END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_update_do`;
DELIMITER ;;
CREATE TRIGGER `after_update_do` AFTER UPDATE ON `tr_do` FOR EACH ROW BEGIN
    IF new.status = 2 THEN
	UPDATE tr_sro SET STATUS = 2  WHERE id_do = old.id_do;
   END IF;
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_delete_do`;
DELIMITER ;;
CREATE TRIGGER `after_delete_do` AFTER DELETE ON `tr_do` FOR EACH ROW BEGIN
	UPDATE tr_sro SET id_do = NULL WHERE id_do = old.id_do;
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_update_in`;
DELIMITER ;;
CREATE TRIGGER `after_update_in` AFTER UPDATE ON `tr_in` FOR EACH ROW BEGIN
IF new.status = 2 and new.type = 1 THEN
CALL p_in_po(new.id_in);
CALL p_in_stock(new.id_in);	
END IF;




    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `before_delete_inbound`;
DELIMITER ;;
CREATE TRIGGER `before_delete_inbound` BEFORE DELETE ON `tr_in` FOR EACH ROW BEGIN
	delete from tr_in_detail where id_in = old.id_in;
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_insert_po`;
DELIMITER ;;
CREATE TRIGGER `after_insert_po` AFTER INSERT ON `tr_po` FOR EACH ROW BEGIN 
   update tr_qrs set id_po = new.id_po where id_qrs = new.id_qrs;
   update tr_qr set id_po = new.id_po where id_qrs  = new.id_qrs and status = '2'; 
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_delete_po`;
DELIMITER ;;
CREATE TRIGGER `after_delete_po` AFTER DELETE ON `tr_po` FOR EACH ROW BEGIN
  update tr_qr set id_po = 0 where id_po = old.id_po;
update tr_qrs set id_po = null where id_po = old.id_po;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `before_delete_pr`;
DELIMITER ;;
CREATE TRIGGER `before_delete_pr` BEFORE DELETE ON `tr_pr` FOR EACH ROW BEGIN
	update tr_pr_detail set id_pr = null, status =  1 where id_pr = old.id_pr;
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_insert_alocation`;
DELIMITER ;;
CREATE TRIGGER `after_insert_alocation` AFTER INSERT ON `tr_pros_detail` FOR EACH ROW BEGIN
	UPDATE purlog.tr_stock SET tr_stock.qty = tr_stock.qty - new.qty WHERE tr_stock.id_stock = new.id_stock;
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_update_allocate`;
DELIMITER ;;
CREATE TRIGGER `after_update_allocate` AFTER UPDATE ON `tr_pros_detail` FOR EACH ROW BEGIN
	UPDATE tr_stock SET qty = qty + (old.qty - new.qty) WHERE id_stock = old.id_stock;	
	
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_insert_qr`;
DELIMITER ;;
CREATE TRIGGER `after_insert_qr` AFTER INSERT ON `tr_qr` FOR EACH ROW BEGIN
    CALL p_qrs_detail(new.id_pr, new.id_qr,new.id_qrs);
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `before_delete_qr`;
DELIMITER ;;
CREATE TRIGGER `before_delete_qr` BEFORE DELETE ON `tr_qr` FOR EACH ROW BEGIN
	delete from tr_qr_detail where id_qr = old.id_qr;
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `before_delete_qrs`;
DELIMITER ;;
CREATE TRIGGER `before_delete_qrs` BEFORE DELETE ON `tr_qrs` FOR EACH ROW BEGIN
  delete from tr_qrs_detail where id_qrs = old.id_qrs;
  delete from tr_qr where id_pr = old.id_pr and id_qrs=old.id_qrs;
  delete from tr_qr_detail where id_pr = old.id_pr and id_qrs = old.id_qrs;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_insert_receive`;
DELIMITER ;;
CREATE TRIGGER `after_insert_receive` AFTER INSERT ON `tr_receive` FOR EACH ROW BEGIN
	CALL p_receive_detail(new.id_receive, new.id_sro);
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_update_receive`;
DELIMITER ;;
CREATE TRIGGER `after_update_receive` AFTER UPDATE ON `tr_receive` FOR EACH ROW BEGIN
	if new.status = 2 then
	CALL p_receive_return(new.id_receive);
	end if; 
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_delete_receive`;
DELIMITER ;;
CREATE TRIGGER `after_delete_receive` AFTER DELETE ON `tr_receive` FOR EACH ROW BEGIN
	delete from tr_receive_detail where id_receive = old.id_receive;
	Update tr_pros_detail set status_receive = 0  WHERE id_sro = old.id_sro;
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_update_return`;
DELIMITER ;;
CREATE TRIGGER `after_update_return` AFTER UPDATE ON `tr_return` FOR EACH ROW BEGIN
	if new.status = 2 then
	CALL p_return_order(new.id_return);	
	end if;
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_insert_ro`;
DELIMITER ;;
CREATE TRIGGER `after_insert_ro` AFTER INSERT ON `tr_ro` FOR EACH ROW BEGIN
	IF new.status_order = 3 THEN
	CALL p_return_order_detail(new.ext_doc_no, new.id_ro, new.user_id);	
	END IF;
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_allocated`;
DELIMITER ;;
CREATE TRIGGER `after_allocated` AFTER UPDATE ON `tr_ro` FOR EACH ROW BEGIN
	IF new.status = 6 THEN
	CALL p_allocated(old.id_ro, old.user_id);
	END IF;
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_delete_sro`;
DELIMITER ;;
CREATE TRIGGER `after_delete_sro` AFTER DELETE ON `tr_sro` FOR EACH ROW BEGIN
	UPDATE tr_pros_detail SET id_sro = NULL WHERE id_sro = old.id_sro;
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_update_transfer`;
DELIMITER ;;
CREATE TRIGGER `after_update_transfer` AFTER UPDATE ON `tr_transfer` FOR EACH ROW BEGIN
	IF new.status = 2 THEN
	CALL p_transfer(new.id_transfer);
	END IF;
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `before_delete_transfer`;
DELIMITER ;;
CREATE TRIGGER `before_delete_transfer` BEFORE DELETE ON `tr_transfer` FOR EACH ROW BEGIN
	CALL p_delete_transfer_detail(old.id_transfer);
	
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `after_insert_transfer_detail`;
DELIMITER ;;
CREATE TRIGGER `after_insert_transfer_detail` AFTER INSERT ON `tr_transfer_detail` FOR EACH ROW BEGIN
	
	update tr_stock set qty = (qty - new.qty) where id_stock = new.id_stock;
    END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `before_delete_transfer_detail`;
DELIMITER ;;
CREATE TRIGGER `before_delete_transfer_detail` BEFORE DELETE ON `tr_transfer_detail` FOR EACH ROW BEGIN
	
	update tr_stock set qty = (qty + old.qty) where id_stock = old.id_stock;
    END
;;
DELIMITER ;
