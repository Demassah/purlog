/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.1.41 : Database - purlog
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`purlog` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `purlog`;

/*Table structure for table `ref_barang` */

DROP TABLE IF EXISTS `ref_barang`;

CREATE TABLE `ref_barang` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(6) NOT NULL,
  `id_sub_kategori` int(6) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `ref_barang` */

insert  into `ref_barang`(`id`,`id_kategori`,`id_sub_kategori`,`kode_barang`,`nama_barang`,`status`) values (1,2,2,'001','Busi','1'),(2,2,2,'101','Asd','1'),(3,3,4,'002','Ban','1'),(4,2,2,'003','CPU','1'),(5,3,4,'004','Monitor','1'),(6,2,2,'005','Keyboard','1'),(7,3,4,'006','Mouse','1'),(8,2,2,'007','Meja','1'),(9,3,4,'008','Kursi','1'),(10,3,4,'009','Mobil','1'),(11,3,4,'010','Bis Pariwisata','1');

/*Table structure for table `ref_departement` */

DROP TABLE IF EXISTS `ref_departement`;

CREATE TABLE `ref_departement` (
  `departement_id` int(6) NOT NULL AUTO_INCREMENT,
  `departement_name` varchar(25) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`departement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `ref_departement` */

insert  into `ref_departement`(`departement_id`,`departement_name`,`status`) values (1,'IT','1'),(15,'Workshop','1'),(16,'Heavy Equipment','1'),(17,'Promotion','1');

/*Table structure for table `ref_kategori` */

DROP TABLE IF EXISTS `ref_kategori`;

CREATE TABLE `ref_kategori` (
  `id_kategori` int(6) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(25) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `ref_kategori` */

insert  into `ref_kategori`(`id_kategori`,`nama_kategori`,`status`) values (2,'Consumables','1'),(3,'Not  Consumables','1');

/*Table structure for table `ref_sub_kategori` */

DROP TABLE IF EXISTS `ref_sub_kategori`;

CREATE TABLE `ref_sub_kategori` (
  `id_sub_kategori` int(6) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(6) NOT NULL,
  `nama_sub_kategori` varchar(25) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id_sub_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ref_sub_kategori` */

insert  into `ref_sub_kategori`(`id_sub_kategori`,`id_kategori`,`nama_sub_kategori`,`status`) values (2,2,'Barang Konsumsi','1'),(4,3,'Tak Habis','1');

/*Table structure for table `sys_menu` */

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

/*Data for the table `sys_menu` */

insert  into `sys_menu`(`menu_id`,`menu_group`,`menu_name`,`menu_parent`,`url`,`position`,`hide`,`icon_class`,`policy`) values (1,'Administrator','Administrator',0,'#',99,0,'icon-administrator','ACCESS;'),(2,'Administrator','Otoritas Menu',1,'otoritas',2,0,'icon-otoritas','ACCESS;ADD;EDIT;DETAIL;DELETE;'),(3,'Administrator','Pengguna',1,'pengguna',3,0,'icon-user','ACCESS;ADD;EDIT;DELETE;'),(4,'Administrator','Departemen',36,'departement',4,0,'icon-departement','ACCESS;ADD;EDIT;DELETE;'),(5,'Master Data','Master Data',0,'#',2,0,'icon-master','ACCESS;'),(6,'Master Data','Kategori',5,'kategori',2,0,'icon-kategori','ACCESS;ADD;EDIT;DELETE;'),(7,'Master Data','Sub Kategori',5,'sub_kategori',3,0,'icon-subkateg','ACCESS;ADD;EDIT;DELETE;'),(8,'Master Data','Barang',5,'barang',4,0,'icon-barang','ACCESS;ADD;EDIT;DELETE;PRINT;IMPORT;'),(9,'Purchase','Purchase',0,'#',4,0,'icon-purchase','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(10,'Logistic','Request Order',34,'request_order',2,0,'icon-ro','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(11,'Logistic','Request Order Selected',34,'request_order_selected',5,0,'icon-ros','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(12,'Logistic','Picking Request Order Selected',34,'picking_req_order_selected',6,0,'icon-picking','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(13,'Logistic','Shipment Request Order',34,'shipment_req_order',7,0,'icon-shipment','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(14,'Purchase','Purchase Request',9,'purchase_request',7,0,'icon-pr','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(15,'Purchase','Quotation Request Selected',9,'quotation_request_selected',8,0,'icon-qrs','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(17,'Purchase','Purchase Order',9,'purchase_order',10,0,'icon-po','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(18,'Purchase','Document Receive',34,'document_receive',10,0,'icon-dr','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(19,'Logistic','Delivery Order',34,'delivery_order',8,0,'icon-delivery','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(20,'Purchase','Berita Acara Pengembalian',9,'underconstruction',12,0,'icon-bap','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(21,'Purchase','Berita Acara Pengembalian Pengiriman',9,'underconstruction',13,0,'icon-bapp','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(22,'Logistic','Request Order Logistic',34,'request_order_logistic',4,0,'icon-rol','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(23,'Administrator','Menu',1,'menu',1,0,'icon-menu','ACCESS;ADD;EDIT;DELETE;'),(34,'Logistic','Logistic',0,'#',3,0,'icon-logistic','ACCESS;'),(36,'Setup','Setup',0,'#',1,0,'icon-setup','ACCESS;'),(37,'Logistic','Request Order Approval',34,'request_order_approval',3,0,'icon-approval','ACCESS;EDIT;DELETE;DETAIL;'),(38,'Logistic','Delivered',34,'delivered',9,0,'icon-delivered','ACCESS;DETAIL;');

/*Table structure for table `sys_user` */

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `sys_user` */

insert  into `sys_user`(`user_id`,`nik`,`user_name`,`full_name`,`passwd`,`departement_id`,`user_level_id`) values (1,1111111,'admin','administrator','21232f297a57a5a743894a0e4a801fc3',1,1),(11,1111112,'iqbal','Mochamad Iqbal','eedae20fc3c7a6e9c5b1102098771c70',1,1),(12,12345,'harry','Harry Pret','3b87c97d15e8eb11e51aa25e9a5770e9',1,1);

/*Table structure for table `sys_user_access` */

DROP TABLE IF EXISTS `sys_user_access`;

CREATE TABLE `sys_user_access` (
  `user_access_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `menu_id` smallint(6) NOT NULL DEFAULT '0',
  `user_level_id` smallint(6) NOT NULL DEFAULT '0',
  `policy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_access_id`)
) ENGINE=InnoDB AUTO_INCREMENT=751 DEFAULT CHARSET=latin1;

/*Data for the table `sys_user_access` */

insert  into `sys_user_access`(`user_access_id`,`menu_id`,`user_level_id`,`policy`) values (1,1,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(2,2,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(3,3,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(4,4,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(727,5,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(728,6,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(729,7,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(730,8,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(731,9,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(732,10,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(733,11,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(734,12,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(735,13,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(736,14,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(737,15,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(739,17,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(740,18,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(741,19,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(742,20,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(743,21,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(744,22,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;IMPORT;'),(745,23,1,'ACCESS;ADD;EDIT;DELETE;'),(746,34,1,'ACCESS;'),(747,35,1,'ACCESS;'),(748,36,1,'ACCESS;'),(749,37,1,'ACCESS;DETAIL;EDIT;DELETE;'),(750,38,1,'ACCESS;DETAIL;');

/*Table structure for table `sys_user_level` */

DROP TABLE IF EXISTS `sys_user_level`;

CREATE TABLE `sys_user_level` (
  `user_level_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(40) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `sys_user_level` */

insert  into `sys_user_level`(`user_level_id`,`level_name`,`level`) values (1,'Administrator',99),(2,'Logistic',2),(3,'Purchasing',3),(4,'Requestor',1),(5,'Vendor',4),(6,'Dept Manager',5),(7,'Related Dept Manager',6),(8,'Inventory',7),(9,'Warehouse Man',8),(10,'Inbound Receive Team',9),(11,'Inbound Retur Team',10),(12,'Outbond Distribution Team',11),(13,'Courir',12);

/*Table structure for table `tr_do` */

DROP TABLE IF EXISTS `tr_do`;

CREATE TABLE `tr_do` (
  `id_do` int(11) NOT NULL AUTO_INCREMENT,
  `id_courir` varchar(21) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_do`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_do` */

/*Table structure for table `tr_do_detail` */

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

/*Data for the table `tr_do_detail` */

/*Table structure for table `tr_po` */

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

/*Data for the table `tr_po` */

/*Table structure for table `tr_pr` */

DROP TABLE IF EXISTS `tr_pr`;

CREATE TABLE `tr_pr` (
  `id_pr` int(6) NOT NULL AUTO_INCREMENT,
  `id_ro` int(6) NOT NULL,
  `user_id` smallint(6) DEFAULT NULL,
  `purpose` varchar(21) DEFAULT NULL,
  `cat_req` varchar(21) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_pr`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `tr_pr` */

insert  into `tr_pr`(`id_pr`,`id_ro`,`user_id`,`purpose`,`cat_req`,`ext_doc_no`,`ETD`,`date_create`,`status`) values (3,2,1,'STOCK','ATK','54321','2014-12-15','2014-12-15 00:00:00',1),(4,2,1,'STOCK','ATK','54321','2014-12-15','2014-12-15 00:00:00',1),(5,2,1,'STOCK','ATK','54321','2014-12-15','2014-12-15 00:00:00',1),(6,2,1,'STOCK','ATK','54321','2014-12-15','2014-12-15 00:00:00',1);

/*Table structure for table `tr_pr_detail` */

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tr_pr_detail` */

insert  into `tr_pr_detail`(`id_detail_pr`,`id_pr`,`id_detail_ro`,`id_ro`,`kode_barang`,`qty`,`user_id`,`date_create`,`note`,`status`,`status_delete`) values (1,0,3,2,'002',10,1,'2014-12-15 18:47:32',NULL,1,0),(2,0,4,2,'004',5,1,'2014-12-15 18:47:32',NULL,1,0),(3,0,1,1,'003',4,1,'2014-12-15 23:35:56',NULL,1,0),(4,0,2,1,'005',20,1,'2014-12-15 23:35:56',NULL,1,0),(5,0,3,2,'002',10,NULL,'2014-12-16 00:01:44',NULL,1,0),(6,0,4,2,'004',5,NULL,'2014-12-16 00:01:44',NULL,1,0),(7,0,1,1,'003',4,NULL,'2014-12-16 02:04:30',NULL,1,0),(8,0,2,1,'005',20,NULL,'2014-12-16 02:04:30',NULL,1,0),(9,0,3,2,'002',10,NULL,'2014-12-16 02:04:31',NULL,1,0),(10,0,4,2,'004',5,NULL,'2014-12-16 02:04:31',NULL,1,0);

/*Table structure for table `tr_pros_detail` */

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
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_pros`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_pros_detail` */

insert  into `tr_pros_detail`(`id_detail_pros`,`id_detail_ro`,`id_ro`,`id_sro`,`id_stock`,`kode_barang`,`qty`,`id_lokasi`,`status`) values (4,1,1,NULL,2,'003',4,'A0201',1),(5,1,1,NULL,3,'003',4,'A0301',1),(6,1,1,NULL,3,'003',3,'A0301',1),(12,3,2,NULL,12,'002',0,'A0101',1),(13,3,2,NULL,13,'002',0,'A0302',1),(14,4,2,NULL,4,'004',0,'A0402',1),(15,4,2,NULL,4,'004',25,'A0402',1),(16,3,2,NULL,12,'002',20,'A0101',1),(17,3,2,NULL,13,'002',20,'A0302',1);

/*Table structure for table `tr_qr` */

DROP TABLE IF EXISTS `tr_qr`;

CREATE TABLE `tr_qr` (
  `id_qr` varchar(21) NOT NULL,
  `id_pr` varchar(21) DEFAULT NULL,
  `id_vendor` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_qr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_qr` */

/*Table structure for table `tr_qr_detail` */

DROP TABLE IF EXISTS `tr_qr_detail`;

CREATE TABLE `tr_qr_detail` (
  `id_detail_qr` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(21) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_qr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_qr_detail` */

/*Table structure for table `tr_qrs` */

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

/*Data for the table `tr_qrs` */

/*Table structure for table `tr_ro` */

DROP TABLE IF EXISTS `tr_ro`;

CREATE TABLE `tr_ro` (
  `id_ro` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(6) DEFAULT NULL,
  `purpose` varchar(21) DEFAULT NULL,
  `cat_req` varchar(21) DEFAULT NULL,
  `ext_doc_no` varchar(21) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT '1: RO, 2: ROA, 3:ROL, 4: ROS, 5: Picking, 6: Shipment',
  PRIMARY KEY (`id_ro`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_ro` */

insert  into `tr_ro`(`id_ro`,`user_id`,`purpose`,`cat_req`,`ext_doc_no`,`ETD`,`date_create`,`status`) values (1,1,'REQUEST','ASSET',' 12345','2014-12-15','2014-12-15 00:00:00',6),(2,2,'STOCK','ATK','54321','2014-12-15','2014-12-15 00:00:00',6);

/*Table structure for table `tr_ro_detail` */

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
  `id_sro` int(6) NOT NULL,
  PRIMARY KEY (`id_detail_ro`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tr_ro_detail` */

insert  into `tr_ro_detail`(`id_detail_ro`,`id_ro`,`ext_doc_no`,`kode_barang`,`qty`,`user_id`,`date_create`,`note`,`status`,`status_delete`,`id_sro`) values (1,1,'12345','003',15,1,'2014-12-15 00:00:00',NULL,1,0,0),(2,1,'12345','005',20,1,'2014-12-15 00:00:00',NULL,1,0,0),(3,2,'54321','002',50,1,'2014-12-15 00:00:00',NULL,1,0,0),(4,2,'54321','004',30,1,'2014-12-15 00:00:00',NULL,1,0,0);

/*Table structure for table `tr_sro` */

DROP TABLE IF EXISTS `tr_sro`;

CREATE TABLE `tr_sro` (
  `id_sro` int(11) NOT NULL AUTO_INCREMENT,
  `id_ro` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_sro`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_sro` */

insert  into `tr_sro`(`id_sro`,`id_ro`,`date_create`,`id_user`,`status`) values (1,2,'2014-12-15 00:00:00','11',1),(2,1,'2014-12-15 00:00:00','1',1);

/*Table structure for table `tr_stock` */

DROP TABLE IF EXISTS `tr_stock`;

CREATE TABLE `tr_stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(5) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `id_lokasi` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_stock` */

insert  into `tr_stock`(`id_stock`,`kode_barang`,`qty`,`price`,`id_lokasi`,`status`) values (1,'001',50,1000,'A0101',1),(2,'003',0,1000,'A0201',1),(3,'003',4,1500,'A0301',1),(4,'004',0,2000,'A0402',1),(5,'005',0,500,'A0101',1),(6,'005',0,1250,'A0101',1),(7,'005',0,400,'A0201',1),(8,'008',0,5000,'A0301',1),(9,'009',10,75000,'A0402',1),(10,'010',0,15000,'A0201',1),(11,'011',10,2000,'A0301',1),(12,'002',0,1000,'A0101',1),(13,'002',0,5000,'A0302',1);

/* Trigger structure for table `tr_pros_detail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_insert_alocation` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `after_insert_alocation` AFTER INSERT ON `tr_pros_detail` FOR EACH ROW BEGIN
	UPDATE purlog.tr_stock SET tr_stock.qty = tr_stock.qty - new.qty WHERE tr_stock.id_stock = new.id_stock;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_pros_detail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_update_allocate` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `after_update_allocate` AFTER UPDATE ON `tr_pros_detail` FOR EACH ROW BEGIN
	if new.qty >= 0 && new.qty < old.qty then
	update tr_stock set qty = qty + (old.qty - new.qty) where id_stock = old.id_stock;	
	end if ;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_ro` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_allocated` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_allocated` AFTER UPDATE ON `tr_ro` FOR EACH ROW BEGIN
	IF new.status = 6 THEN
	CALL p_allocated(old.id_ro);
	END IF;
    END */$$


DELIMITER ;

/* Procedure structure for procedure `p_allocated` */

/*!50003 DROP PROCEDURE IF EXISTS  `p_allocated` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `p_allocated`(IN p_id_ro INT)
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
	INSERT INTO tr_pr_detail (id_detail_ro, id_ro, kode_barang, qty, date_create, STATUS) VALUES (a, b, c, d, CURRENT_TIMESTAMP(),"1");
	END LOOP;
	CLOSE cur1; 
    END */$$
DELIMITER ;

/*Table structure for table `v_pros_detail` */

DROP TABLE IF EXISTS `v_pros_detail`;

/*!50001 DROP VIEW IF EXISTS `v_pros_detail` */;
/*!50001 DROP TABLE IF EXISTS `v_pros_detail` */;

/*!50001 CREATE TABLE  `v_pros_detail`(
 `id_detail_ro` int(11) ,
 `id_ro` int(11) ,
 `kode_barang` varchar(21) ,
 `orders` int(11) ,
 `picking` decimal(34,0) ,
 `sisa` decimal(33,0) 
)*/;

/*View structure for view v_pros_detail */

/*!50001 DROP TABLE IF EXISTS `v_pros_detail` */;
/*!50001 DROP VIEW IF EXISTS `v_pros_detail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pros_detail` AS select `tr_ro_detail`.`id_detail_ro` AS `id_detail_ro`,`tr_ro_detail`.`id_ro` AS `id_ro`,`tr_ro_detail`.`kode_barang` AS `kode_barang`,`tr_ro_detail`.`qty` AS `orders`,(`tr_ro_detail`.`qty` - (`tr_ro_detail`.`qty` - coalesce(sum(`tr_pros_detail`.`qty`),0))) AS `picking`,(`tr_ro_detail`.`qty` - coalesce(sum(`tr_pros_detail`.`qty`),0)) AS `sisa` from (`tr_ro_detail` left join `tr_pros_detail` on((`tr_ro_detail`.`id_detail_ro` = `tr_pros_detail`.`id_detail_ro`))) group by `tr_ro_detail`.`id_detail_ro` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
