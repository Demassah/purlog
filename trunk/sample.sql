/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50516
Source Host           : 127.0.0.1:3306
Source Database       : sample

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2014-12-08 11:08:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cpgt_barang
-- ----------------------------
DROP TABLE IF EXISTS `cpgt_barang`;
CREATE TABLE `cpgt_barang` (
  `barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_nama` varchar(50) NOT NULL,
  PRIMARY KEY (`barang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpgt_barang
-- ----------------------------
INSERT INTO `cpgt_barang` VALUES ('1', 'Bussi');
INSERT INTO `cpgt_barang` VALUES ('2', 'Ban');
INSERT INTO `cpgt_barang` VALUES ('3', 'Kaca Film');

-- ----------------------------
-- Table structure for cpgt_quotation
-- ----------------------------
DROP TABLE IF EXISTS `cpgt_quotation`;
CREATE TABLE `cpgt_quotation` (
  `quote_id` int(11) NOT NULL AUTO_INCREMENT,
  `top` smallint(5) NOT NULL,
  `price` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  PRIMARY KEY (`quote_id`),
  KEY `fk_quote_barang` (`barang_id`),
  KEY `fk_quote_supplier` (`supplier_id`),
  CONSTRAINT `fk_quote_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `cpgt_supplier` (`supplier_id`),
  CONSTRAINT `fk_quote_barang` FOREIGN KEY (`barang_id`) REFERENCES `cpgt_barang` (`barang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpgt_quotation
-- ----------------------------
INSERT INTO `cpgt_quotation` VALUES ('1', '30', '300', '1', '1');
INSERT INTO `cpgt_quotation` VALUES ('2', '20', '200', '1', '2');
INSERT INTO `cpgt_quotation` VALUES ('3', '10', '100', '1', '3');
INSERT INTO `cpgt_quotation` VALUES ('4', '33', '330', '2', '1');
INSERT INTO `cpgt_quotation` VALUES ('5', '22', '220', '2', '2');
INSERT INTO `cpgt_quotation` VALUES ('6', '11', '110', '2', '3');
INSERT INTO `cpgt_quotation` VALUES ('7', '36', '360', '3', '1');
INSERT INTO `cpgt_quotation` VALUES ('8', '24', '240', '3', '2');
INSERT INTO `cpgt_quotation` VALUES ('9', '12', '120', '3', '3');

-- ----------------------------
-- Table structure for cpgt_supplier
-- ----------------------------
DROP TABLE IF EXISTS `cpgt_supplier`;
CREATE TABLE `cpgt_supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_nama` varchar(50) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpgt_supplier
-- ----------------------------
INSERT INTO `cpgt_supplier` VALUES ('1', 'PT. Adhi Agung Makmur');
INSERT INTO `cpgt_supplier` VALUES ('2', 'PT. Iqbal Sejahtera');
INSERT INTO `cpgt_supplier` VALUES ('3', 'PT. Demas Nusantara');
