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
  `kode_barang` varchar(21) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `id_satuan` int(6) DEFAULT NULL,
  `status` varchar(1) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1: fast moving, 2: slow moving, 3: new item',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `ref_barang` */

insert  into `ref_barang`(`id`,`id_kategori`,`id_sub_kategori`,`kode_barang`,`nama_barang`,`id_satuan`,`status`,`type`) values (1,1,1,'100','PC',5,'1',1),(2,1,2,'201','Microsoft Office',2,'1',2),(3,2,6,'301','Lampu',2,'1',2),(4,2,5,'302','Oli',6,'1',1),(5,1,1,'202','New  Item - Hardware',5,'1',3),(6,1,1,'203','Mouse',2,'1',2);

/*Table structure for table `ref_courir` */

DROP TABLE IF EXISTS `ref_courir`;

CREATE TABLE `ref_courir` (
  `id_courir` varchar(21) CHARACTER SET latin1 NOT NULL,
  `name_courir` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `contact` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_courir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `ref_courir` */

insert  into `ref_courir`(`id_courir`,`name_courir`,`contact`,`status`) values ('420015','Asep Zaelani','0811115214',1),('430016','Jajang Nurjaman','0857456895',1);

/*Table structure for table `ref_departement` */

DROP TABLE IF EXISTS `ref_departement`;

CREATE TABLE `ref_departement` (
  `departement_id` int(6) NOT NULL AUTO_INCREMENT,
  `departement_name` varchar(25) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`departement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `ref_departement` */

insert  into `ref_departement`(`departement_id`,`departement_name`,`status`) values (1,'IT','1'),(15,'Workshop','1'),(16,'Heavy Equipment','1'),(17,'Promotion','1'),(18,'Bispar','1'),(19,'Other','1');

/*Table structure for table `ref_kategori` */

DROP TABLE IF EXISTS `ref_kategori`;

CREATE TABLE `ref_kategori` (
  `id_kategori` int(6) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(25) NOT NULL,
  `type_kategri` varchar(21) DEFAULT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `ref_kategori` */

insert  into `ref_kategori`(`id_kategori`,`nama_kategori`,`type_kategri`,`status`) values (1,'IT',NULL,'1'),(2,'Sparepart',NULL,'1'),(3,'Furniture',NULL,'1');

/*Table structure for table `ref_satuan` */

DROP TABLE IF EXISTS `ref_satuan`;

CREATE TABLE `ref_satuan` (
  `id_satuan` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(21) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `ref_satuan` */

insert  into `ref_satuan`(`id_satuan`,`nama_satuan`,`status`) values (1,'Biji',1),(2,'PCS',1),(3,'Sachet',1),(4,'Box',1),(5,'Unit',1),(6,'Liter',NULL);

/*Table structure for table `ref_sub_kategori` */

DROP TABLE IF EXISTS `ref_sub_kategori`;

CREATE TABLE `ref_sub_kategori` (
  `id_sub_kategori` int(6) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(6) NOT NULL,
  `nama_sub_kategori` varchar(25) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id_sub_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `ref_sub_kategori` */

insert  into `ref_sub_kategori`(`id_sub_kategori`,`id_kategori`,`nama_sub_kategori`,`status`) values (1,1,'Hardware','1'),(2,1,'Software','1'),(5,2,'Mesin','1'),(6,2,'Accecoris','1');

/*Table structure for table `ref_vendor` */

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

/*Data for the table `ref_vendor` */

insert  into `ref_vendor`(`id_vendor`,`name_vendor`,`address_vendor`,`contact_vendor`,`mobile_vendor`,`status`) values ('V001','Adi','aa','12','34',1),('V002','iqbal','bb','23','45',1),('V003','Demas','cc','34','67',1);

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
  `policy` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `sys_menu` */

insert  into `sys_menu`(`menu_id`,`menu_group`,`menu_name`,`menu_parent`,`url`,`position`,`hide`,`icon_class`,`policy`) values (1,'Administrator','Administrator',0,'#',99,0,'icon-administrator','ACCESS;'),(2,'Administrator','Otoritas Menu',1,'otoritas',2,0,'icon-otoritas','ACCESS;ADD;EDIT;DETAIL;DELETE;'),(3,'Administrator','Pengguna',1,'pengguna',3,0,'icon-user','ACCESS;ADD;EDIT;DELETE;'),(4,'Setup','Departemen',36,'departement',2,0,'icon-departement','ACCESS;ADD;EDIT;DELETE;'),(5,'Master Data','Master Data',0,'#',2,0,'icon-master','ACCESS;'),(6,'Master Data','Kategori',5,'kategori',2,0,'icon-kategori','ACCESS;ADD;EDIT;DELETE;'),(7,'Master Data','Sub Kategori',5,'sub_kategori',3,0,'icon-subkateg','ACCESS;ADD;EDIT;DELETE;'),(8,'Master Data','Barang',5,'barang',4,0,'icon-barang','ACCESS;ADD;EDIT;DELETE;PDF;'),(9,'Purchase','Purchase',0,'#',4,0,'icon-purchase','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(10,'Logistic','Request Order',34,'request_order',2,0,'icon-ro','ACCESS;ADD;EDIT;DELETE;DETAIL;APPROVE;'),(11,'Logistic','Request Order Selected',34,'request_order_selected',5,0,'icon-ros','ACCESS;EDIT;DELETE;DETAIL;APPROVE;'),(12,'Logistic','Picking Request Order Selected',34,'picking_req_order_selected',6,0,'icon-picking','ACCESS;DETAIL;EDIT;PDF;APPROVE;'),(13,'Logistic','Shipment Request Order',34,'shipment_req_order',7,0,'icon-shipment','ACCESS;ADD;DETAIL;DELETE;PDF;APPROVE;'),(14,'Purchase','Purchase Request',9,'purchase_request',7,0,'icon-pr','ACCESS;ADD;DELETE;DETAIL;APPROVE;'),(15,'Purchase','Quotation Request Selected',9,'quotation_request_selected',8,0,'icon-qrs','ACCESS;ADD;DELETE;DETAIL;SELECT;APPROVE;'),(17,'Purchase','Purchase Order',9,'purchase_order',10,0,'icon-po','ACCESS;ADD;DELETE;PDF;APPROVE;SELECT;'),(18,'Purchase','Document Receive',34,'document_receive',10,0,'icon-dr','ACCESS;ADD;EDIT;DELETE;PRINT;IMPORT;PDF;EXCEL;APPROVE;'),(19,'Logistic','Delivery Order',34,'delivery_order',8,0,'icon-delivery','ACCESS;ADD;DETAIL;DELETE;PDF;APPROVE;'),(20,'Purchase','Berita Acara Pengembalian',9,'underconstruction',12,0,'icon-bap','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(21,'Logistic','Return',34,'retur',13,0,'icon-bapp','ACCESS;ADD;DETAIL;'),(22,'Logistic','Request Order Logistic',34,'request_order_logistic',4,0,'icon-rol','ACCESS;DETAIL;APPROVE;'),(23,'Administrator','Menu',1,'menu',1,0,'icon-menu','ACCESS;ADD;EDIT;DELETE;'),(34,'Logistic','Logistic',0,'#',3,0,'icon-logistic','ACCESS;'),(36,'Setup','Setup',0,'#',1,0,'icon-setup','ACCESS;'),(37,'Logistic','Request Order Approval',34,'request_order_approval',3,0,'icon-approval','ACCESS;ADD;EDIT;DELETE;DETAIL;APPROVE;'),(38,'Logistic','Delivered',34,'delivered',9,0,'icon-delivered','ACCESS;DETAIL;'),(39,'Purchase','Ordered',9,'ordered',11,0,'icon-ordered','DETAIL;'),(40,'Logistic','Alocate Return',34,'alocate_return',14,1,'','ACCESS;DETAIL;'),(41,'Logistic','Inbound',34,'inbound',20,0,'icon-inbound','ACCESS;ADD;DETAIL;DELETE;PDF;APPROVE;'),(42,'Logistic','Stock On Hand',34,'soh',21,0,'icon-stock','ACCESS;'),(43,'Logistic','Transfer',34,'transfer',26,0,'icon-transfer','ACCESS;ADD;EDIT;DELETE;DETAIL;'),(44,'Setup','Satuan',36,'satuan',3,0,'icon-satuan','ACCESS;ADD;EDIT;DELETE;');

/*Table structure for table `sys_user` */

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

/*Data for the table `sys_user` */

insert  into `sys_user`(`user_id`,`nik`,`user_name`,`full_name`,`passwd`,`departement_id`,`user_level_id`) values (1,1111111,'admin','administrator','21232f297a57a5a743894a0e4a801fc3',1,1),(11,1111112,'iqbal','Mochamad Iqbal','eedae20fc3c7a6e9c5b1102098771c70',15,1),(12,12345,'harry','Harry Pret','3b87c97d15e8eb11e51aa25e9a5770e9',17,1),(13,5757,'demas','Demassah','d8f08986e8072e78bf9295c294ef3bc2',1,1),(14,3453,'asd','logistic','7815696ecbf1c96e6894b779456d330e',19,2),(15,56361,'tes','tes','28b662d883b6d76fd96e4ddc5e9ba780',0,1),(16,112233,'superadmin','Superadmin','17c4520f6cfd1ab53d8745e84681eb49',19,14),(17,9988,'operator','operator','4b583376b2767b923c3e1da60d10de59',NULL,1),(18,9988,'requestor','Requestor','560115e15fdc6b37096d514904104a57',0,4);

/*Table structure for table `sys_user_access` */

DROP TABLE IF EXISTS `sys_user_access`;

CREATE TABLE `sys_user_access` (
  `user_access_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `menu_id` smallint(6) NOT NULL DEFAULT '0',
  `user_level_id` smallint(6) NOT NULL DEFAULT '0',
  `policy` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`user_access_id`)
) ENGINE=InnoDB AUTO_INCREMENT=821 DEFAULT CHARSET=latin1;

/*Data for the table `sys_user_access` */

insert  into `sys_user_access`(`user_access_id`,`menu_id`,`user_level_id`,`policy`) values (1,1,1,'ACCESS;'),(2,2,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;'),(3,3,1,'ACCESS;ADD;EDIT;DELETE;'),(4,4,1,'ACCESS;ADD;EDIT;DELETE;'),(727,5,1,'ACCESS;'),(728,6,1,'ACCESS;ADD;EDIT;DELETE;'),(729,7,1,'ACCESS;ADD;EDIT;DELETE;'),(730,8,1,'ACCESS;ADD;EDIT;DELETE;'),(731,9,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;'),(732,10,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;APPROVE;'),(733,11,1,'ACCESS;DETAIL;EDIT;DELETE;APPROVE;'),(734,12,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(735,13,1,'ACCESS;ADD;DETAIL;DELETE;PRINT;PDF;APPROVE;'),(736,14,1,'ACCESS;ADD;DETAIL;DELETE;APPROVE;'),(737,15,1,'ACCESS;ADD;DETAIL;DELETE;SELECT;APPROVE;'),(739,17,1,'ACCESS;ADD;EDIT;DELETE;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(740,18,1,'ACCESS;ADD;EDIT;DELETE;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(741,19,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;PDF;APPROVE;'),(742,20,1,''),(743,21,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;'),(744,22,1,'ACCESS;DETAIL;EDIT;DELETE;APPROVE;'),(745,23,1,'ACCESS;ADD;EDIT;DELETE;'),(746,34,1,'ACCESS;'),(747,35,1,'ACCESS;'),(748,36,1,'ACCESS;'),(749,37,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;APPROVE;'),(750,38,1,'ACCESS;DETAIL;'),(751,39,1,'ACCESS;DETAIL;'),(752,40,1,'ACCESS;DETAIL;'),(753,41,1,'ACCESS;ADD;DETAIL;DELETE;PDF;APPROVE;'),(754,42,1,'ACCESS;'),(755,43,1,'ACCESS;ADD;DETAIL;EDIT;DELETE;'),(756,44,1,'ACCESS;ADD;EDIT;DELETE;'),(757,36,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(758,4,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(759,44,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(760,5,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(761,6,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(762,7,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(763,8,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(764,34,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(765,10,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(766,37,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(767,22,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(768,11,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(769,12,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(770,13,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(771,19,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(772,38,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(773,21,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(774,40,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(775,41,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(776,42,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(777,43,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(778,9,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(779,14,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(780,15,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(781,17,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(782,39,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(783,20,14,''),(784,18,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(785,1,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(786,23,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(787,2,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(788,3,14,'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),(789,36,4,''),(790,4,4,''),(791,44,4,''),(792,5,4,'ACCESS;'),(793,6,4,'ACCESS;'),(794,7,4,'ACCESS;'),(795,8,4,'ACCESS;'),(796,34,4,''),(797,10,4,''),(798,37,4,''),(799,22,4,''),(800,11,4,''),(801,12,4,''),(802,13,4,''),(803,19,4,''),(804,38,4,''),(805,21,4,''),(806,40,4,''),(807,41,4,''),(808,42,4,''),(809,43,4,''),(810,9,4,''),(811,14,4,''),(812,15,4,''),(813,17,4,''),(814,39,4,''),(815,20,4,''),(816,18,4,''),(817,1,4,''),(818,23,4,''),(819,2,4,''),(820,3,4,'');

/*Table structure for table `sys_user_level` */

DROP TABLE IF EXISTS `sys_user_level`;

CREATE TABLE `sys_user_level` (
  `user_level_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(40) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `sys_user_level` */

insert  into `sys_user_level`(`user_level_id`,`level_name`,`level`) values (1,'Administrator',99),(2,'Logistic',2),(3,'Purchasing',3),(4,'Requestor',1),(5,'Vendor',4),(6,'Dept Manager',5),(7,'Related Dept Manager',6),(8,'Inventory',7),(9,'Warehouse Man',8),(10,'Inbound Receive Team',9),(11,'Inbound Retur Team',10),(12,'Outbond Distribution Team',11),(13,'Courir',12),(14,'Superadmin',999);

/*Table structure for table `tr_do` */

DROP TABLE IF EXISTS `tr_do`;

CREATE TABLE `tr_do` (
  `id_do` int(11) NOT NULL AUTO_INCREMENT,
  `id_courir` varchar(21) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_do`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_do` */

insert  into `tr_do`(`id_do`,`id_courir`,`date_create`,`id_user`,`status`) values (1,'420015','2015-01-20 11:08:30','1',2),(2,'430016','2015-01-20 11:08:53','1',2);

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

/*Table structure for table `tr_in` */

DROP TABLE IF EXISTS `tr_in`;

CREATE TABLE `tr_in` (
  `id_in` int(11) NOT NULL AUTO_INCREMENT,
  `ext_rec_no` int(11) DEFAULT NULL,
  `type` varchar(21) CHARACTER SET utf8 DEFAULT NULL COMMENT 'PO, Return',
  `date_create` datetime DEFAULT NULL,
  `user_id` smallint(6) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_in`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tr_in` */

/*Table structure for table `tr_in_detail` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tr_in_detail` */

/*Table structure for table `tr_notifikasi` */

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

/*Data for the table `tr_notifikasi` */

insert  into `tr_notifikasi`(`id`,`context`,`url`,`id_object`,`status`,`tanggal`,`type`,`binding_type`,`binding_id`,`user_level_id`) values (41,'Request Order telah dikirim ke RO Approval','request_order_approval',19,0,'0000-00-00',1,1,1,2),(42,'Purchase Request Baru telah dibuat','purchase_request',4,0,'0000-00-00',3,1,1,3),(43,'Request Order Baru telah dibuat','request_order',20,0,'0000-00-00',1,1,1,2),(44,'Request Order telah dikirim ke RO Approval','request_order_approval',20,0,'0000-00-00',1,1,1,2),(45,'Purchase Request Baru telah dibuat','purchase_request',5,0,'0000-00-00',3,1,1,3);

/*Table structure for table `tr_po` */

DROP TABLE IF EXISTS `tr_po`;

CREATE TABLE `tr_po` (
  `id_po` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tr_po` */

/*Table structure for table `tr_pr` */

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tr_pr` */

insert  into `tr_pr`(`id_pr`,`id_ro`,`id_po`,`user_id`,`purpose`,`cat_req`,`ext_doc_no`,`ETD`,`date_create`,`status`) values (1,1,NULL,1,'REQUEST','ASSET','SPK/123','2015-01-20','2015-01-20 09:22:32',2),(4,19,NULL,1,'REQUEST','ASSET','1','2015-02-03','2015-02-03 12:48:48',2),(5,20,NULL,1,'REQUEST','ATK','1234','2015-02-04','2015-02-04 16:27:03',2);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tr_pr_detail` */

insert  into `tr_pr_detail`(`id_detail_pr`,`id_pr`,`id_detail_ro`,`id_ro`,`kode_barang`,`qty`,`user_id`,`date_create`,`note`,`status`,`status_delete`) values (1,1,1,1,'100',20,1,'2015-01-19 18:30:40',NULL,2,0),(2,1,2,1,'201',10,1,'2015-01-19 18:30:40',NULL,2,0),(3,1,3,1,'203',5,1,'2015-01-19 18:30:40',NULL,2,0),(4,0,4,2,'301',1,1,'2015-01-19 20:07:18',NULL,1,0),(5,4,9,19,'201',2,1,'2015-02-03 13:51:08',NULL,2,0),(6,5,10,20,'100',34,1,'2015-02-04 16:29:20',NULL,2,0),(7,5,11,20,'302',12,1,'2015-02-04 16:29:20',NULL,2,0),(8,5,12,20,'100',12,1,'2015-02-04 16:29:20',NULL,2,0);

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
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `status_receive` smallint(1) DEFAULT '0',
  `status_picking` smallint(1) DEFAULT NULL COMMENT '1: picking 2: purchase 3: return',
  PRIMARY KEY (`id_detail_pros`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_pros_detail` */

insert  into `tr_pros_detail`(`id_detail_pros`,`id_detail_ro`,`id_ro`,`id_sro`,`id_stock`,`kode_barang`,`qty`,`id_lokasi`,`date_create`,`status`,`status_receive`,`status_picking`) values (1,4,2,1,1,'301',4,'Workshop','2015-01-19 20:06:59',1,1,1),(2,5,3,2,2,'302',3,'Workshop','2015-01-19 20:07:24',1,1,1),(3,9,19,NULL,3,'201',3,'Pusat','2015-02-03 13:51:25',1,0,1);

/*Table structure for table `tr_qr` */

DROP TABLE IF EXISTS `tr_qr`;

CREATE TABLE `tr_qr` (
  `id_qr` int(11) NOT NULL AUTO_INCREMENT,
  `id_pr` int(11) DEFAULT NULL,
  `id_vendor` varchar(21) DEFAULT NULL,
  `id_po` int(11) DEFAULT '0',
  `top` int(3) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  PRIMARY KEY (`id_qr`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_qr` */

/*Table structure for table `tr_qr_detail` */

DROP TABLE IF EXISTS `tr_qr_detail`;

CREATE TABLE `tr_qr_detail` (
  `id_detail_qr` int(11) NOT NULL AUTO_INCREMENT,
  `id_qr` int(11) DEFAULT NULL,
  `id_detail_pr` int(11) DEFAULT NULL,
  `id_pr` int(11) DEFAULT NULL,
  `kode_barang` varchar(21) DEFAULT NULL,
  `qty` int(11) DEFAULT '0',
  `price` bigint(12) DEFAULT '0',
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id_detail_qr`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_qr_detail` */

/*Table structure for table `tr_qrs` */

DROP TABLE IF EXISTS `tr_qrs`;

CREATE TABLE `tr_qrs` (
  `id_qrs` int(11) NOT NULL AUTO_INCREMENT,
  `id_pr` int(11) DEFAULT NULL,
  `id_ro` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_id` smallint(6) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_qrs`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_qrs` */

insert  into `tr_qrs`(`id_qrs`,`id_pr`,`id_ro`,`date_create`,`user_id`,`status`) values (3,5,20,'2015-02-04 16:30:22',1,1),(4,5,20,'2015-02-04 16:30:49',1,1),(5,5,20,'2015-02-04 16:33:11',1,1);

/*Table structure for table `tr_qrs_detail` */

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_qrs_detail` */

insert  into `tr_qrs_detail`(`id_detail_qrs`,`id_qrs`,`id_pr`,`id_detail_pr`,`kode_barang`,`qty`,`status`) values (1,3,5,6,'100',14,1),(2,3,5,7,'302',4,1),(3,3,5,8,'100',4,1),(4,4,5,6,'100',10,1),(5,4,5,7,'302',4,1),(6,4,5,8,'100',4,1),(15,5,5,8,'100',4,1),(17,5,5,6,'100',8,1);

/*Table structure for table `tr_receive` */

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

/*Data for the table `tr_receive` */

insert  into `tr_receive`(`id_receive`,`id_courir`,`id_sro`,`date_create`,`id_user`,`status`) values (1,'420015',1,'2015-01-19 00:00:00',1,1),(2,'430016',2,'2015-01-19 00:00:00',1,2);

/*Table structure for table `tr_receive_detail` */

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

/*Data for the table `tr_receive_detail` */

insert  into `tr_receive_detail`(`id_detail_receive`,`id_receive`,`id_detail_pros`,`id_detail_ro`,`id_ro`,`id_sro`,`kode_barang`,`qty`,`date_create`,`status`) values (1,1,1,4,2,1,'301',4,'2015-01-19 20:14:10',1),(2,2,2,5,3,2,'302',3,'2015-01-19 20:14:21',1);

/*Table structure for table `tr_return` */

DROP TABLE IF EXISTS `tr_return`;

CREATE TABLE `tr_return` (
  `id_return` int(11) NOT NULL AUTO_INCREMENT,
  `id_receive` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_return`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tr_return` */

/*Table structure for table `tr_return_detail` */

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

/*Data for the table `tr_return_detail` */

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
  `date_approve` datetime DEFAULT '0000-00-00 00:00:00',
  `date_reject` datetime DEFAULT '0000-00-00 00:00:00',
  `status` int(1) DEFAULT NULL COMMENT '1: RO, 2: ROA, 3:ROL, 4: ROS, 5: Picking, 6: Shipment, 7: DO, 9: Reject',
  `status_order` smallint(1) DEFAULT '1' COMMENT '1: ORDER, 2: PURCHASE, 3: RETURN',
  PRIMARY KEY (`id_ro`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_ro` */

insert  into `tr_ro`(`id_ro`,`user_id`,`purpose`,`cat_req`,`ext_doc_no`,`ETD`,`date_create`,`date_approve`,`date_reject`,`status`,`status_order`) values (19,1,'REQUEST','ASSET','1','2015-02-03','2015-02-03 12:48:48','2015-02-03 13:46:42','0000-00-00 00:00:00',6,1),(20,1,'REQUEST','ATK','1234','2015-02-04','2015-02-04 16:27:03','2015-02-04 16:28:30','0000-00-00 00:00:00',6,1);

/*Table structure for table `tr_ro_detail` */

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `tr_ro_detail` */

insert  into `tr_ro_detail`(`id_detail_ro`,`id_ro`,`ext_doc_no`,`kode_barang`,`qty`,`barang_bekas`,`user_id`,`date_create`,`note`,`status`,`status_delete`,`id_sro`) values (1,1,'SPK/123','100',20,2,1,'2015-01-20 09:22:32','adi',1,0,0),(2,1,'SPK/123','201',10,1,1,'2015-01-20 09:22:32','ida',1,0,0),(3,1,'SPK/123','203',5,1,1,'2015-01-20 09:22:32','MOuse logitech',1,0,0),(4,2,'112233','301',5,1,1,'2015-01-20 10:54:09','tes',1,0,0),(5,3,'332211','302',3,1,1,'2015-01-20 10:54:49','-',1,0,0),(6,4,'554433','301',1,1,1,'2015-01-23 13:53:19','tes',1,0,0),(7,10,'987897','203',15,1,1,'2015-01-28 09:34:30','-',1,0,0),(8,11,'546','302',546,2,1,'2015-01-28 10:55:38','-',1,0,0),(9,19,'1','201',5,1,1,'2015-02-03 12:48:48','-',1,0,0),(10,20,'1234','100',34,1,1,'2015-02-04 16:27:03','dgfdgdf',1,0,0),(11,20,'1234','302',12,1,1,'2015-02-04 16:27:03','qwewqe',1,0,0),(12,20,'1234','100',12,1,1,'2015-02-04 16:27:03','wqeqwe',1,0,0);

/*Table structure for table `tr_sro` */

DROP TABLE IF EXISTS `tr_sro`;

CREATE TABLE `tr_sro` (
  `id_sro` int(11) NOT NULL AUTO_INCREMENT,
  `id_do` int(11) DEFAULT NULL,
  `id_ro` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_user` varchar(21) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_sro`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_sro` */

insert  into `tr_sro`(`id_sro`,`id_do`,`id_ro`,`date_create`,`id_user`,`status`) values (1,1,2,'2015-01-19 00:00:00','1',2),(2,2,3,'2015-01-19 00:00:00','1',2);

/*Table structure for table `tr_stock` */

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tr_stock` */

insert  into `tr_stock`(`id_stock`,`id_in`,`id_detail_in`,`kode_barang`,`qty`,`price`,`id_lokasi`,`date_create`,`status`,`type_in`) values (1,NULL,NULL,'301',2,1000,'Workshop','2015-01-20 10:54:09',1,NULL),(2,NULL,NULL,'302',0,500,'Heavy Equipment','2015-01-20 10:54:09',1,NULL),(3,NULL,NULL,'201',0,250,'Pusat','2015-01-20 10:54:09',1,0);

/*Table structure for table `tr_transfer` */

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

/*Data for the table `tr_transfer` */

insert  into `tr_transfer`(`id_transfer`,`type_transfer`,`note`,`date_create`,`user_id`,`status`) values (1,1,'tes','2015-01-19 23:43:10',1,1),(2,1,'tes 2','2015-01-19 23:45:15',1,1);

/*Table structure for table `tr_transfer_detail` */

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

/*Data for the table `tr_transfer_detail` */

insert  into `tr_transfer_detail`(`id_detail_transfer`,`id_transfer`,`id_stock`,`kode_barang`,`qty`,`price`,`id_lokasi`,`status`) values (7,1,1,'301',1,1000,'Heavy Equipment',1),(8,2,2,'302',NULL,500,NULL,1);

/* Trigger structure for table `tr_do` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_update_do` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_update_do` AFTER UPDATE ON `tr_do` FOR EACH ROW BEGIN
    IF new.status = 2 THEN
	UPDATE tr_sro SET STATUS = 2  WHERE id_do = old.id_do;
   END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_do` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_delete_do` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_delete_do` AFTER DELETE ON `tr_do` FOR EACH ROW BEGIN
	UPDATE tr_sro SET id_do = NULL WHERE id_do = old.id_do;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_in` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_update_in` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_update_in` AFTER UPDATE ON `tr_in` FOR EACH ROW BEGIN
	IF new.status = 2 and new.type = 1 THEN
	CALL p_in_po(new.id_in);
	CALL p_in_stock(new.id_in);	
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_in` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `before_delete_inbound` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `before_delete_inbound` BEFORE DELETE ON `tr_in` FOR EACH ROW BEGIN
	delete from tr_in_detail where id_in = old.id_in;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_po` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_insert_po` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_insert_po` AFTER INSERT ON `tr_po` FOR EACH ROW BEGIN
	update tr_pr set id_po = new.id_po where id_pr = new.id_pr;
	update tr_qr set id_po = new.id_po where id_pr = new.id_pr and status = '2'; 
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_po` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_delete_po` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_delete_po` AFTER DELETE ON `tr_po` FOR EACH ROW BEGIN
	update tr_pr set id_po = null where id_po = old.id_po;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_pr` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `before_delete_pr` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `before_delete_pr` BEFORE DELETE ON `tr_pr` FOR EACH ROW BEGIN
	update tr_pr_detail set id_pr = null, status =  1 where id_pr = old.id_pr;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_pros_detail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_insert_alocation` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_insert_alocation` AFTER INSERT ON `tr_pros_detail` FOR EACH ROW BEGIN
	UPDATE purlog.tr_stock SET tr_stock.qty = tr_stock.qty - new.qty WHERE tr_stock.id_stock = new.id_stock;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_pros_detail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_update_allocate` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_update_allocate` AFTER UPDATE ON `tr_pros_detail` FOR EACH ROW BEGIN
	UPDATE tr_stock SET qty = qty + (old.qty - new.qty) WHERE id_stock = old.id_stock;	
	
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_qr` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_insert_qr` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_insert_qr` AFTER INSERT ON `tr_qr` FOR EACH ROW BEGIN

CALL p_qrs_detail(new.id_pr, new.id_qr);
	


    END */$$


DELIMITER ;

/* Trigger structure for table `tr_qr` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `before_delete_qr` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `before_delete_qr` BEFORE DELETE ON `tr_qr` FOR EACH ROW BEGIN
	delete from tr_qr_detail where id_qr = old.id_qr;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_qrs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `before_delete_qrs` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `before_delete_qrs` BEFORE DELETE ON `tr_qrs` FOR EACH ROW BEGIN
delete from tr_qrs_detail where id_qrs = old.id_qrs;
delete from tr_qr where id_pr = old.id_pr;
delete from tr_qr_detail where id_pr = old.id_pr;
END */$$


DELIMITER ;

/* Trigger structure for table `tr_receive` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_insert_receive` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_insert_receive` AFTER INSERT ON `tr_receive` FOR EACH ROW BEGIN
	CALL p_receive_detail(new.id_receive, new.id_sro);
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_receive` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_update_receive` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_update_receive` AFTER UPDATE ON `tr_receive` FOR EACH ROW BEGIN
	if new.status = 2 then
	CALL p_receive_return(new.id_receive);
	end if; 
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_receive` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_delete_receive` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_delete_receive` AFTER DELETE ON `tr_receive` FOR EACH ROW BEGIN
	delete from tr_receive_detail where id_receive = old.id_receive;
	Update tr_pros_detail set status_receive = 0  WHERE id_sro = old.id_sro;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_return` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_update_return` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_update_return` AFTER UPDATE ON `tr_return` FOR EACH ROW BEGIN
	if new.status = 2 then
	CALL p_return_order(new.id_return);	
	end if;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_ro` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_insert_ro` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_insert_ro` AFTER INSERT ON `tr_ro` FOR EACH ROW BEGIN
	IF new.status_order = 3 THEN
	CALL p_return_order_detail(new.ext_doc_no, new.id_ro, new.user_id);	
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_ro` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_allocated` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_allocated` AFTER UPDATE ON `tr_ro` FOR EACH ROW BEGIN
	IF new.status = 6 THEN
	CALL p_allocated(old.id_ro, old.user_id);
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_sro` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_delete_sro` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_delete_sro` AFTER DELETE ON `tr_sro` FOR EACH ROW BEGIN
	UPDATE tr_pros_detail SET id_sro = NULL WHERE id_sro = old.id_sro;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_transfer` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_update_transfer` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_update_transfer` AFTER UPDATE ON `tr_transfer` FOR EACH ROW BEGIN
	IF new.status = 2 THEN
	CALL p_transfer(new.id_transfer);
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_transfer` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `before_delete_transfer` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `before_delete_transfer` BEFORE DELETE ON `tr_transfer` FOR EACH ROW BEGIN
	CALL p_delete_transfer_detail(old.id_transfer);
	
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_transfer_detail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_insert_transfer_detail` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_insert_transfer_detail` AFTER INSERT ON `tr_transfer_detail` FOR EACH ROW BEGIN
	
	update tr_stock set qty = (qty - new.qty) where id_stock = new.id_stock;
    END */$$


DELIMITER ;

/* Trigger structure for table `tr_transfer_detail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `before_delete_transfer_detail` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `before_delete_transfer_detail` BEFORE DELETE ON `tr_transfer_detail` FOR EACH ROW BEGIN
	
	update tr_stock set qty = (qty + old.qty) where id_stock = old.id_stock;
    END */$$


DELIMITER ;

/* Procedure structure for procedure `p_allocated` */

/*!50003 DROP PROCEDURE IF EXISTS  `p_allocated` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `p_allocated`(IN p_id_ro INT, IN p_user_id INT)
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





    END */$$
DELIMITER ;

/* Procedure structure for procedure `p_delete_transfer_detail` */

/*!50003 DROP PROCEDURE IF EXISTS  `p_delete_transfer_detail` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `p_delete_transfer_detail`(IN p_id_transfer INT)
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





END */$$
DELIMITER ;

/* Procedure structure for procedure `p_in_po` */

/*!50003 DROP PROCEDURE IF EXISTS  `p_in_po` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `p_in_po`(IN p_id_in INT)
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





END */$$
DELIMITER ;

/* Procedure structure for procedure `p_in_stock` */

/*!50003 DROP PROCEDURE IF EXISTS  `p_in_stock` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `p_in_stock`(IN p_id_in INT)
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





END */$$
DELIMITER ;

/* Procedure structure for procedure `p_qrs_detail` */

/*!50003 DROP PROCEDURE IF EXISTS  `p_qrs_detail` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `p_qrs_detail`(IN p_id_pr INT, IN p_id_qr INT)
BEGIN

	DECLARE done INT DEFAULT FALSE;

	DECLARE a, c INT;

	DECLARE b VARCHAR(21);

	DECLARE cur1 CURSOR FOR SELECT id_detail_pr, kode_barang, qty FROM tr_qrs_detail WHERE id_pr = p_id_pr ;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

	OPEN cur1;

		read_loop : LOOP

			FETCH cur1 INTO a, b, c ;

			IF done THEN 

				LEAVE read_loop;

			END IF;

			INSERT INTO tr_qr_detail (id_qr, id_detail_pr, id_pr, kode_barang, qty, date_create)

			VALUES (p_id_qr, a, p_id_pr, b, c, CURRENT_TIMESTAMP());

		END LOOP;

	CLOSE cur1; 

END */$$
DELIMITER ;

/* Procedure structure for procedure `p_receive_detail` */

/*!50003 DROP PROCEDURE IF EXISTS  `p_receive_detail` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `p_receive_detail`(IN p_id_receive INT, IN p_id_sro INT)
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





END */$$
DELIMITER ;

/* Procedure structure for procedure `p_receive_return` */

/*!50003 DROP PROCEDURE IF EXISTS  `p_receive_return` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `p_receive_return`(IN p_id_receive INT)
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





END */$$
DELIMITER ;

/* Procedure structure for procedure `p_return_order` */

/*!50003 DROP PROCEDURE IF EXISTS  `p_return_order` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `p_return_order`(IN p_id_return INT)
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





END */$$
DELIMITER ;

/* Procedure structure for procedure `p_return_order_detail` */

/*!50003 DROP PROCEDURE IF EXISTS  `p_return_order_detail` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `p_return_order_detail`(IN p_id_return INT, IN p_id_ro int, IN p_user_id INT)
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





END */$$
DELIMITER ;

/* Procedure structure for procedure `p_transfer` */

/*!50003 DROP PROCEDURE IF EXISTS  `p_transfer` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `p_transfer`(IN p_id_transfer INT)
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





END */$$
DELIMITER ;

/*Table structure for table `v_po_detail` */

DROP TABLE IF EXISTS `v_po_detail`;

/*!50001 DROP VIEW IF EXISTS `v_po_detail` */;
/*!50001 DROP TABLE IF EXISTS `v_po_detail` */;

/*!50001 CREATE TABLE  `v_po_detail`(
 `id_po` int(11) ,
 `id_detail_pr` int(11) ,
 `kode_barang` varchar(21) ,
 `note` text ,
 `qty` int(11) ,
 `price` bigint(12) ,
 `total` bigint(30) ,
 `purpose` varchar(21) ,
 `ext_doc_no` varchar(21) ,
 `ETD` date ,
 `top` int(3) ,
 `nama_barang` varchar(30) ,
 `user_id` smallint(6) ,
 `full_name` varchar(100) ,
 `id_vendor` varchar(21) ,
 `departement_id` smallint(6) ,
 `departement_name` varchar(25) ,
 `cat_req` varchar(21) ,
 `date_create` datetime 
)*/;

/*Table structure for table `v_po_inbound` */

DROP TABLE IF EXISTS `v_po_inbound`;

/*!50001 DROP VIEW IF EXISTS `v_po_inbound` */;
/*!50001 DROP TABLE IF EXISTS `v_po_inbound` */;

/*!50001 CREATE TABLE  `v_po_inbound`(
 `id_detail_pr` int(11) ,
 `id_pr` int(11) ,
 `id_po` int(11) ,
 `kode_barang` varchar(21) ,
 `asal` int(11) ,
 `receive` decimal(32,0) ,
 `sisa` decimal(33,0) ,
 `nama_barang` varchar(30) 
)*/;

/*Table structure for table `v_print_inbound` */

DROP TABLE IF EXISTS `v_print_inbound`;

/*!50001 DROP VIEW IF EXISTS `v_print_inbound` */;
/*!50001 DROP TABLE IF EXISTS `v_print_inbound` */;

/*!50001 CREATE TABLE  `v_print_inbound`(
 `id_in` int(11) ,
 `type` varchar(21) ,
 `id_po` int(11) ,
 `id_pr` int(11) ,
 `id_ro` int(11) ,
 `requestor` varchar(21) ,
 `departement` varchar(21) ,
 `purpose` varchar(21) ,
 `cat_req` varchar(21) ,
 `date_create` datetime ,
 `id_detail_in` int(11) ,
 `kode_barang` varchar(21) ,
 `qty` int(11) ,
 `lokasi` varchar(21) ,
 `nama_barang` varchar(30) ,
 `full_name` varchar(100) ,
 `departement_name` varchar(25) ,
 `ext_doc_no` varchar(21) 
)*/;

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

/*Table structure for table `v_qrs_detail` */

DROP TABLE IF EXISTS `v_qrs_detail`;

/*!50001 DROP VIEW IF EXISTS `v_qrs_detail` */;
/*!50001 DROP TABLE IF EXISTS `v_qrs_detail` */;

/*!50001 CREATE TABLE  `v_qrs_detail`(
 `id_detail_pr` int(11) ,
 `id_pr` int(11) ,
 `id_ro` int(11) ,
 `id_detail_qrs` int(11) ,
 `kode_barang` varchar(21) ,
 `qty` int(11) ,
 `pick` decimal(32,0) ,
 `sisa` decimal(33,0) 
)*/;

/*Table structure for table `v_status_barang` */

DROP TABLE IF EXISTS `v_status_barang`;

/*!50001 DROP VIEW IF EXISTS `v_status_barang` */;
/*!50001 DROP TABLE IF EXISTS `v_status_barang` */;

/*!50001 CREATE TABLE  `v_status_barang`(
 `kode_barang` varchar(21) ,
 `status_barang` varchar(11) 
)*/;

/*Table structure for table `v_status_kategori` */

DROP TABLE IF EXISTS `v_status_kategori`;

/*!50001 DROP VIEW IF EXISTS `v_status_kategori` */;
/*!50001 DROP TABLE IF EXISTS `v_status_kategori` */;

/*!50001 CREATE TABLE  `v_status_kategori`(
 `id_kategori` int(6) ,
 `status_kategori` varchar(11) 
)*/;

/*Table structure for table `v_status_satuan` */

DROP TABLE IF EXISTS `v_status_satuan`;

/*!50001 DROP VIEW IF EXISTS `v_status_satuan` */;
/*!50001 DROP TABLE IF EXISTS `v_status_satuan` */;

/*!50001 CREATE TABLE  `v_status_satuan`(
 `id_satuan` smallint(6) ,
 `status_satuan` varchar(11) 
)*/;

/*Table structure for table `v_status_sub_kategori` */

DROP TABLE IF EXISTS `v_status_sub_kategori`;

/*!50001 DROP VIEW IF EXISTS `v_status_sub_kategori` */;
/*!50001 DROP TABLE IF EXISTS `v_status_sub_kategori` */;

/*!50001 CREATE TABLE  `v_status_sub_kategori`(
 `id_sub_kategori` int(6) ,
 `status_sub_kategori` varchar(11) 
)*/;

/*View structure for view v_po_detail */

/*!50001 DROP TABLE IF EXISTS `v_po_detail` */;
/*!50001 DROP VIEW IF EXISTS `v_po_detail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_po_detail` AS select `c`.`id_po` AS `id_po`,`a`.`id_detail_pr` AS `id_detail_pr`,`a`.`kode_barang` AS `kode_barang`,`a`.`note` AS `note`,`a`.`qty` AS `qty`,`e`.`price` AS `price`,(`a`.`qty` * `e`.`price`) AS `total`,`c`.`purpose` AS `purpose`,`c`.`ext_doc_no` AS `ext_doc_no`,`c`.`ETD` AS `ETD`,`d`.`top` AS `top`,`f`.`nama_barang` AS `nama_barang`,`a`.`user_id` AS `user_id`,`g`.`full_name` AS `full_name`,`d`.`id_vendor` AS `id_vendor`,`g`.`departement_id` AS `departement_id`,`h`.`departement_name` AS `departement_name`,`c`.`cat_req` AS `cat_req`,`c`.`date_create` AS `date_create` from (((((((`tr_pr_detail` `a` left join `tr_pr` `b` on((`a`.`id_pr` = `b`.`id_pr`))) left join `tr_po` `c` on((`b`.`id_po` = `c`.`id_po`))) left join `tr_qr` `d` on(((`b`.`id_pr` = `d`.`id_pr`) and (`d`.`status` = 2)))) left join `tr_qr_detail` `e` on(((`e`.`id_qr` = `d`.`id_qr`) and (`e`.`id_detail_pr` = `a`.`id_detail_pr`)))) left join `ref_barang` `f` on((`f`.`kode_barang` = `a`.`kode_barang`))) left join `sys_user` `g` on((`g`.`user_id` = `a`.`user_id`))) left join `ref_departement` `h` on((`h`.`departement_id` = `g`.`departement_id`))) */;

/*View structure for view v_po_inbound */

/*!50001 DROP TABLE IF EXISTS `v_po_inbound` */;
/*!50001 DROP VIEW IF EXISTS `v_po_inbound` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_po_inbound` AS select `x`.`id_detail_pr` AS `id_detail_pr`,`x`.`id_pr` AS `id_pr`,`z`.`id_po` AS `id_po`,`x`.`kode_barang` AS `kode_barang`,`x`.`qty` AS `asal`,coalesce(sum(`y`.`qty`),0) AS `receive`,(`x`.`qty` - coalesce(sum(`y`.`qty`),0)) AS `sisa`,`a`.`nama_barang` AS `nama_barang` from (((`tr_pr_detail` `x` left join `tr_in_detail` `y` on((`x`.`id_detail_pr` = `y`.`ext_rec_no_detail`))) left join `tr_pr` `z` on((`x`.`id_pr` = `z`.`id_pr`))) left join `ref_barang` `a` on((`x`.`kode_barang` = `a`.`kode_barang`))) where (`z`.`id_po` <> '') group by `x`.`id_detail_pr` */;

/*View structure for view v_print_inbound */

/*!50001 DROP TABLE IF EXISTS `v_print_inbound` */;
/*!50001 DROP VIEW IF EXISTS `v_print_inbound` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_print_inbound` AS select `a`.`id_in` AS `id_in`,`a`.`type` AS `type`,`b`.`id_po` AS `id_po`,`b`.`id_pr` AS `id_pr`,`b`.`id_ro` AS `id_ro`,`b`.`requestor` AS `requestor`,`b`.`departement` AS `departement`,`b`.`purpose` AS `purpose`,`b`.`cat_req` AS `cat_req`,`a`.`date_create` AS `date_create`,`c`.`id_detail_in` AS `id_detail_in`,`c`.`kode_barang` AS `kode_barang`,`c`.`qty` AS `qty`,`c`.`lokasi` AS `lokasi`,`d`.`nama_barang` AS `nama_barang`,`f`.`full_name` AS `full_name`,`g`.`departement_name` AS `departement_name`,`b`.`ext_doc_no` AS `ext_doc_no` from (((((`tr_in` `a` left join `tr_po` `b` on((`a`.`ext_rec_no` = `b`.`id_po`))) left join `tr_in_detail` `c` on((`a`.`id_in` = `c`.`id_in`))) left join `ref_barang` `d` on((`c`.`kode_barang` = convert(`d`.`kode_barang` using utf8)))) left join `sys_user` `f` on((`a`.`user_id` = `f`.`user_id`))) left join `ref_departement` `g` on((`b`.`departement` = `g`.`departement_id`))) where (`a`.`id_in` = 5) */;

/*View structure for view v_pros_detail */

/*!50001 DROP TABLE IF EXISTS `v_pros_detail` */;
/*!50001 DROP VIEW IF EXISTS `v_pros_detail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pros_detail` AS select `tr_ro_detail`.`id_detail_ro` AS `id_detail_ro`,`tr_ro_detail`.`id_ro` AS `id_ro`,`tr_ro_detail`.`kode_barang` AS `kode_barang`,`tr_ro_detail`.`qty` AS `orders`,(`tr_ro_detail`.`qty` - (`tr_ro_detail`.`qty` - coalesce(sum(`tr_pros_detail`.`qty`),0))) AS `picking`,(`tr_ro_detail`.`qty` - coalesce(sum(`tr_pros_detail`.`qty`),0)) AS `sisa` from (`tr_ro_detail` left join `tr_pros_detail` on((`tr_ro_detail`.`id_detail_ro` = `tr_pros_detail`.`id_detail_ro`))) where (`tr_ro_detail`.`status_delete` <> 1) group by `tr_ro_detail`.`id_detail_ro` */;

/*View structure for view v_qrs_detail */

/*!50001 DROP TABLE IF EXISTS `v_qrs_detail` */;
/*!50001 DROP VIEW IF EXISTS `v_qrs_detail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_qrs_detail` AS (select `a`.`id_detail_pr` AS `id_detail_pr`,`a`.`id_pr` AS `id_pr`,`a`.`id_ro` AS `id_ro`,`b`.`id_detail_qrs` AS `id_detail_qrs`,`a`.`kode_barang` AS `kode_barang`,`a`.`qty` AS `qty`,coalesce(sum(`b`.`qty`),0) AS `pick`,(`a`.`qty` - coalesce(sum(`b`.`qty`),0)) AS `sisa` from ((`tr_pr_detail` `a` left join `tr_pr` `c` on((`a`.`id_pr` = `c`.`id_pr`))) left join `tr_qrs_detail` `b` on((`a`.`id_detail_pr` = `b`.`id_detail_pr`))) where (`c`.`status` = 2) group by `a`.`id_detail_pr`) */;

/*View structure for view v_status_barang */

/*!50001 DROP TABLE IF EXISTS `v_status_barang` */;
/*!50001 DROP VIEW IF EXISTS `v_status_barang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_status_barang` AS (select `ref_barang`.`kode_barang` AS `kode_barang`,(case `ref_barang`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_barang` from `ref_barang`) */;

/*View structure for view v_status_kategori */

/*!50001 DROP TABLE IF EXISTS `v_status_kategori` */;
/*!50001 DROP VIEW IF EXISTS `v_status_kategori` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_status_kategori` AS (select `ref_kategori`.`id_kategori` AS `id_kategori`,(case `ref_kategori`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_kategori` from `ref_kategori`) */;

/*View structure for view v_status_satuan */

/*!50001 DROP TABLE IF EXISTS `v_status_satuan` */;
/*!50001 DROP VIEW IF EXISTS `v_status_satuan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_status_satuan` AS (select `ref_satuan`.`id_satuan` AS `id_satuan`,(case `ref_satuan`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_satuan` from `ref_satuan`) */;

/*View structure for view v_status_sub_kategori */

/*!50001 DROP TABLE IF EXISTS `v_status_sub_kategori` */;
/*!50001 DROP VIEW IF EXISTS `v_status_sub_kategori` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_status_sub_kategori` AS (select `ref_sub_kategori`.`id_sub_kategori` AS `id_sub_kategori`,(case `ref_sub_kategori`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_sub_kategori` from `ref_sub_kategori`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
