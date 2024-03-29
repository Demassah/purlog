-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2015 at 02:43 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `purlog`
--

DELIMITER $$
--
-- Procedures
--
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
    END$$

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
END$$

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
END$$

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
END$$

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
END$$

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
END$$

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
END$$

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
END$$

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
END$$

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
END$$

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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_transfer_detail`(IN p_id_stock INT, in p_qty int, in p_status int)
BEGIN
	DECLARE done INT DEFAULT FALSE;
	DECLARE a INT;
	DECLARE b float;
	DECLARE cur1 CURSOR FOR 
	SELECT id_stock, qty
	FROM  tr_stock
	WHERE id_stock = p_id_stock ;
	
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
		
	OPEN cur1;
	read_loop : LOOP
	FETCH cur1 INTO  a, b;
	IF done THEN 
	LEAVE read_loop;
	END IF;
	if p_status = 1 then 
	UPDATE tr_stock SET qty = (b - p_qty) WHERE id_stock = p_id_stock;
	else
	UPDATE tr_stock SET qty = (b + p_qty) WHERE id_stock = p_id_stock;
	end if;
	END LOOP;
	CLOSE cur1; 
END$$

DELIMITER ;

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_kodebarang` (`kode_barang`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=61 ;

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
(15, 'Purchase', 'Quotation Request Selected', 9, 'quotation_request_selected', 9, 0, 'icon-qrs', 'ACCESS;ADD;DELETE;DETAIL;SELECT;APPROVE;'),
(17, 'Purchase', 'Purchase Order', 9, 'purchase_order', 12, 0, 'icon-po', 'ACCESS;ADD;DELETE;PDF;APPROVE;SELECT;DETAIL;'),
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
(39, 'Purchase', 'Ordered', 9, 'ordered', 12, 0, 'icon-ordered', 'DETAIL;'),
(40, 'Logistic', 'Alocate Return', 34, 'alocate_return', 14, 1, '', 'ACCESS;DETAIL;'),
(41, 'Logistic', 'Inbound', 34, 'inbound', 20, 0, 'icon-inbound', 'ACCESS;ADD;DETAIL;DELETE;PDF;APPROVE;'),
(42, 'Logistic', 'Stock On Hand', 34, 'soh', 21, 0, 'icon-stock', 'ACCESS;'),
(43, 'Logistic', 'Transfer', 34, 'transfer', 26, 0, 'icon-transfer', 'ACCESS;ADD;EDIT;DELETE;DETAIL;APPROVE;'),
(44, 'Setup', 'Satuan', 36, 'satuan', 3, 0, 'icon-satuan', 'ACCESS;ADD;EDIT;DELETE;'),
(45, 'Master Data', 'Kurir', 5, 'courir', 5, 0, 'icon-po', 'ACCESS;ADD;EDIT;DELETE;'),
(46, 'Master Data', 'Lokasi', 5, 'lokasi', 6, 0, 'icon-otoritas', 'ACCESS;ADD;EDIT;DELETE;'),
(47, 'Laporan', 'Laporan', 0, '#', 5, 0, 'icon-ordered', 'ACCESS;'),
(48, 'Laporan', 'Laporan Picking', 47, 'laporan_picking', 1, 0, 'icon-po', 'ACCESS;PDF;EXCEL;'),
(49, 'Laporan', 'Laporan Delivery Order', 47, 'laporan_delivery', 2, 0, 'icon-po', 'ACCESS;PDF;EXCEL;'),
(50, 'Laporan', 'Laporan Document Receive', 47, 'laporan_document', 4, 0, 'icon-po', 'ACCESS;PDF;EXCEL;'),
(51, 'Laporan', 'Laporan Shipment', 47, 'laporan_shipment', 3, 0, 'icon-po', 'ACCESS;PDF;EXCEL;'),
(52, 'Laporan', 'Laporan Inbound', 47, 'laporan_inbound', 5, 0, 'icon-po', 'ACCESS;PDF;EXCEL;'),
(53, 'Laporan', 'Laporan Purchase', 47, 'laporan_purchase', 6, 0, 'icon-po', 'ACCESS;PDF;EXCEL;'),
(54, 'Laporan', 'Laporan Pembelian', 47, 'laporan_pembelian', 7, 0, 'icon-po', 'ACCESS;PDF;EXCEL;'),
(55, 'Laporan', 'Laporan Outstanding Supply', 47, 'laporan_outstanding', 8, 0, 'icon-po', 'ACCESS;PDF;EXCEL;'),
(56, 'Laporan', 'Laporan Penerimaan ', 47, 'laporan_penerimaan', 9, 0, 'icon-po', 'ACCESS;PDF;EXCEL;'),
(57, 'Laporan', 'Laporan Pemakaian', 47, 'laporan_usage', 10, 0, 'icon-po', 'ACCESS;PDF;EXCEL;'),
(58, 'Laporan', 'Laporan Persediaan', 47, 'laporan_persediaan', 11, 0, 'icon-po', 'ACCESS;PDF;EXCEL;'),
(59, 'Purchase', 'Quotation Request price', 9, 'quotation_request_price', 10, 0, 'icon-qrs', 'ACCESS;ADD;DELETE;DETAIL;SELECT;APPROVE;'),
(60, 'Purchase', 'Vendor Selected', 9, 'vendor_selected', 11, 0, 'icon-qrs', 'ACCESS;DETAIL;ADD;EDIT;DELETE;');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=851 ;

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
(730, 8, 1, 'ACCESS;ADD;EDIT;DELETE;PDF;'),
(731, 9, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;'),
(732, 10, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PDF;APPROVE;'),
(733, 11, 1, 'ACCESS;DETAIL;EDIT;DELETE;PDF;APPROVE;'),
(734, 12, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(735, 13, 1, 'ACCESS;ADD;DETAIL;DELETE;PRINT;PDF;APPROVE;'),
(736, 14, 1, 'ACCESS;ADD;DETAIL;DELETE;APPROVE;'),
(737, 15, 1, 'ACCESS;ADD;DETAIL;DELETE;SELECT;APPROVE;'),
(739, 17, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(740, 18, 1, 'ACCESS;ADD;EDIT;DELETE;PRINT;PDF;EXCEL;IMPORT;APPROVE;'),
(741, 19, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;PRINT;PDF;APPROVE;'),
(742, 20, 1, 'ACCESS;ADD;DETAIL;EDIT;DELETE;'),
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
(829, 53, 1, 'ACCESS;PDF;EXCEL;'),
(830, 54, 1, 'ACCESS;PDF;EXCEL;'),
(831, 55, 1, 'ACCESS;PDF;EXCEL;'),
(832, 56, 1, 'ACCESS;PDF;EXCEL;'),
(833, 57, 1, 'ACCESS;PDF;EXCEL;'),
(834, 58, 1, 'ACCESS;PDF;EXCEL;'),
(835, 45, 14, 'ACCESS;ADD;EDIT;DELETE;'),
(836, 46, 14, 'ACCESS;ADD;EDIT;DELETE;'),
(837, 47, 14, 'ACCESS;'),
(838, 48, 14, ''),
(839, 49, 14, ''),
(840, 51, 14, ''),
(841, 50, 14, ''),
(842, 52, 14, ''),
(843, 53, 14, ''),
(844, 54, 14, 'ACCESS;PDF;EXCEL;'),
(845, 55, 14, 'ACCESS;PDF;EXCEL;'),
(846, 56, 14, 'ACCESS;PDF;EXCEL;'),
(847, 57, 14, 'ACCESS;PDF;EXCEL;'),
(848, 58, 14, 'ACCESS;PDF;'),
(849, 59, 14, 'ACCESS;ADD;DETAIL;EDIT;DELETE;SELECT;APPROVE;'),
(850, 60, 14, 'ACCESS;ADD;EDIT;DELETE;');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tr_in`
--

INSERT INTO `tr_in` (`id_in`, `ext_rec_no`, `type`, `date_create`, `user_id`, `status`) VALUES
(4, 1, '1', '2015-03-26 18:19:00', 16, 1);

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
  `date_create` datetime DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_detail_in`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tr_in_detail`
--

INSERT INTO `tr_in_detail` (`id_detail_in`, `id_in`, `kode_barang`, `qty`, `ext_rec_no_detail`, `lokasi`, `date_create`, `status`) VALUES
(10, 4, '302', 2, 1, 'A100', '2015-03-26 18:39:44', 1);

--
-- Triggers `tr_in_detail`
--
DROP TRIGGER IF EXISTS `before_insert_in_detail`;
DELIMITER //
CREATE TRIGGER `before_insert_in_detail` BEFORE INSERT ON `tr_in_detail`
 FOR EACH ROW SET new.date_create = CURRENT_TIMESTAMP()
//
DELIMITER ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

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
(51, 'Request Order Baru telah dibuat', 'request_order', 22, 0, '0000-00-00', 1, 1, 1, 2),
(52, 'Request Order Baru telah dibuat', 'request_order', 23, 0, '0000-00-00', 1, 1, 1, 2),
(53, 'Request Order telah dikirim ke RO Approval', 'request_order_approval', 23, 0, '0000-00-00', 1, 1, 1, 2),
(54, 'RO Approval telah dikirim ke RO Logistic', 'request_order_logistic', 23, 0, '0000-00-00', 1, 1, 1, 2),
(55, 'RO Logistic telah dikirim ke RO Selected', 'request_order_selected', 23, 1, '0000-00-00', 1, 1, 1, 2),
(56, 'Request Order Baru telah dibuat', 'request_order', 24, 0, '0000-00-00', 1, 1, 1, 2),
(57, 'Request Order telah dikirim ke RO Approval', 'request_order_approval', 24, 0, '0000-00-00', 1, 1, 1, 2),
(58, 'RO Approval telah dikirim ke RO Logistic', 'request_order_logistic', 24, 0, '0000-00-00', 1, 1, 1, 2),
(59, 'RO Logistic telah dikirim ke RO Selected', 'request_order_selected', 24, 0, '0000-00-00', 1, 1, 1, 2),
(60, 'Request Order Baru telah dibuat', 'request_order', 25, 0, '0000-00-00', 1, 1, 1, 2),
(61, 'Request Order telah dikirim ke RO Approval', 'request_order_approval', 25, 0, '0000-00-00', 1, 1, 1, 2),
(62, 'RO Approval telah dikirim ke RO Logistic', 'request_order_logistic', 25, 0, '0000-00-00', 1, 1, 1, 2),
(63, 'RO Logistic telah dikirim ke RO Selected', 'request_order_selected', 25, 0, '0000-00-00', 1, 1, 1, 2),
(64, 'Purchase Request Baru telah dibuat', 'purchase_request', 7, 0, '0000-00-00', 3, 1, 1, 3),
(65, 'Request Order telah dikirim ke RO Approval', 'request_order_approval', 22, 0, '0000-00-00', 1, 1, 1, 2),
(66, 'RO Approval telah dikirim ke RO Logistic', 'request_order_logistic', 22, 0, '0000-00-00', 1, 1, 1, 2),
(67, 'RO Logistic telah dikirim ke RO Selected', 'request_order_selected', 22, 0, '0000-00-00', 1, 1, 1, 2),
(68, 'Request Order Baru telah dibuat', 'request_order', 1, 0, '0000-00-00', 1, 1, 1, 2),
(69, 'Request Order telah dikirim ke RO Approval', 'request_order_approval', 1, 0, '0000-00-00', 1, 1, 1, 2),
(70, 'RO Approval telah dikirim ke RO Logistic', 'request_order_logistic', 1, 0, '0000-00-00', 1, 1, 1, 2),
(71, 'RO Logistic telah dikirim ke RO Selected', 'request_order_selected', 1, 0, '0000-00-00', 1, 1, 1, 2),
(72, 'Purchase Request Baru telah dibuat', 'purchase_request', 1, 0, '0000-00-00', 3, 1, 1, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tr_po`
--

INSERT INTO `tr_po` (`id_po`, `id_qrs`, `id_pr`, `id_ro`, `requestor`, `departement`, `purpose`, `cat_req`, `ext_doc_no`, `ETD`, `date_create`, `status`) VALUES
(1, 1, 1, 1, '1', '1', 'STOCK', 'SPAREPART', '1234', '2015-03-24', '2015-03-24 15:29:31', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tr_pr`
--

INSERT INTO `tr_pr` (`id_pr`, `id_ro`, `id_po`, `user_id`, `purpose`, `cat_req`, `ext_doc_no`, `ETD`, `date_create`, `status`) VALUES
(1, 1, NULL, 1, 'STOCK', 'SPAREPART', '1234', '2015-03-24', '2015-03-24 15:20:45', 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tr_pr_detail`
--

INSERT INTO `tr_pr_detail` (`id_detail_pr`, `id_pr`, `id_detail_ro`, `id_ro`, `kode_barang`, `qty`, `user_id`, `date_create`, `note`, `status`, `status_delete`) VALUES
(1, 1, 1, 1, '302', 20, 1, '2015-03-24 15:22:05', NULL, 2, 0),
(2, 1, 2, 1, '301', 23, 1, '2015-03-24 15:22:05', NULL, 2, 0);

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
  `ppn` int(4) DEFAULT NULL,
  `top` int(3) DEFAULT NULL,
  `ETD` date DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  PRIMARY KEY (`id_qr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tr_qr`
--

INSERT INTO `tr_qr` (`id_qr`, `id_qrs`, `id_pr`, `id_vendor`, `id_po`, `ppn`, `top`, `ETD`, `status`) VALUES
(4, 4, 1, 'V001', 0, 12, 12, '2015-03-26', 2),
(5, 4, 1, 'V002', 0, 13, 13, '2015-03-26', 1),
(6, 4, 1, 'V003', 0, 14, 14, '2015-03-26', 1),
(7, 6, 1, 'V001', 0, 12, 12, '2015-03-26', 1);

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
  `status` smallint(1) DEFAULT '0',
  `status_qrs` smallint(1) DEFAULT '0' COMMENT '1=qrs;2=qrs price;3=vendor selected',
  PRIMARY KEY (`id_qrs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tr_qrs`
--

INSERT INTO `tr_qrs` (`id_qrs`, `id_po`, `id_pr`, `id_ro`, `date_create`, `user_id`, `status`, `status_qrs`) VALUES
(1, 1, 1, 1, '2015-03-24 15:23:16', 1, 2, NULL),
(4, NULL, 1, 1, '2015-03-26 11:43:48', 16, 2, 3),
(6, NULL, 1, 1, '2015-03-26 17:13:39', 16, 1, 2),
(7, NULL, 1, 1, '2015-03-26 19:14:27', 16, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tr_qrs_detail`
--

INSERT INTO `tr_qrs_detail` (`id_detail_qrs`, `id_qrs`, `id_pr`, `id_detail_pr`, `kode_barang`, `qty`, `status`) VALUES
(1, 1, 1, 1, '302', 10, 1),
(2, 1, 1, 2, '301', 13, 1),
(5, 4, 1, 1, '302', 4, 1),
(6, 4, 1, 2, '301', 4, 1),
(7, 6, 1, 1, '302', 2, 1),
(8, 6, 1, 2, '301', 2, 1),
(9, 7, 1, 1, '302', 4, 1),
(10, 7, 1, 2, '301', 3, 1);

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
  `price` float(12,0) DEFAULT '0',
  `diskon` float(12,0) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id_detail_qr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tr_qr_detail`
--

INSERT INTO `tr_qr_detail` (`id_detail_qr`, `id_qr`, `id_qrs`, `id_detail_pr`, `id_pr`, `kode_barang`, `qty`, `price`, `diskon`, `date_create`, `status`) VALUES
(7, 4, 4, 1, 1, '302', 4, 33, 88, '2015-03-26 13:58:23', 1),
(8, 4, 4, 2, 1, '301', 4, 55, 112, '2015-03-26 13:58:23', 1),
(9, 5, 4, 1, 1, '302', 4, 0, NULL, '2015-03-26 14:39:29', 1),
(10, 5, 4, 2, 1, '301', 4, 0, NULL, '2015-03-26 14:39:29', 1),
(11, 6, 4, 1, 1, '302', 4, 0, NULL, '2015-03-26 14:39:35', 1),
(12, 6, 4, 2, 1, '301', 4, 0, NULL, '2015-03-26 14:39:35', 1),
(13, 7, 6, 1, 1, '302', 2, 0, NULL, '2015-03-26 17:14:02', 1),
(14, 7, 6, 2, 1, '301', 2, 0, NULL, '2015-03-26 17:14:02', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `no_rangka` varchar(21) DEFAULT NULL,
  `no_polisi` varchar(12) DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT '1: RO, 2: ROA, 3:ROL, 4: ROS, 5: Picking, 6: Shipment, 7: DO, 9: Reject',
  `status_order` smallint(1) DEFAULT '1' COMMENT '1: ORDER, 2: PURCHASE, 3: RETURN',
  PRIMARY KEY (`id_ro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tr_ro`
--

INSERT INTO `tr_ro` (`id_ro`, `user_id`, `purpose`, `cat_req`, `ext_doc_no`, `ETD`, `date_create`, `date_approve`, `date_reject`, `no_rangka`, `no_polisi`, `status`, `status_order`) VALUES
(1, 1, 'STOCK', 'SPAREPART', '1234', '2015-03-24', '2015-03-24 15:20:45', '2015-03-24 15:21:58', '0000-00-00 00:00:00', '123678', 'D123', 6, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tr_ro_detail`
--

INSERT INTO `tr_ro_detail` (`id_detail_ro`, `id_ro`, `ext_doc_no`, `kode_barang`, `qty`, `barang_bekas`, `user_id`, `date_create`, `note`, `status`, `status_delete`, `id_sro`) VALUES
(1, 1, '1234', '302', 20, 2, 1, '2015-03-24 15:20:45', '-', 1, 0, 0),
(2, 1, '1234', '301', 23, 1, 1, '2015-03-24 15:20:45', '-', 1, 0, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tr_stock`
--

INSERT INTO `tr_stock` (`id_stock`, `id_in`, `id_detail_in`, `kode_barang`, `qty`, `price`, `id_lokasi`, `date_create`, `status`, `type_in`) VALUES
(2, 1, 7, '201', 6, 0, 'A100', '2015-03-24 17:52:15', 1, 2),
(3, 2, 8, '201', 23, 0, 'A100', '2015-03-24 17:55:02', 1, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tr_transfer`
--

INSERT INTO `tr_transfer` (`id_transfer`, `type_transfer`, `note`, `date_create`, `user_id`, `status`) VALUES
(1, 1, 'we', '2015-03-24 16:29:32', 1, 2),
(2, 1, 'weee', '2015-03-24 17:54:49', 1, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tr_transfer_detail`
--

INSERT INTO `tr_transfer_detail` (`id_detail_transfer`, `id_transfer`, `id_stock`, `kode_barang`, `qty`, `price`, `id_lokasi`, `status`) VALUES
(7, 1, 1, '201', 29, 0, 'A100', 1),
(8, 2, 2, '201', 23, 0, 'A100', 1);

--
-- Triggers `tr_transfer_detail`
--
DROP TRIGGER IF EXISTS `after_insert_transfer_detail`;
DELIMITER //
CREATE TRIGGER `after_insert_transfer_detail` AFTER INSERT ON `tr_transfer_detail`
 FOR EACH ROW BEGIN
	CALL p_transfer_detail(new.id_stock, new.qty,'1');
    END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `before_delete_transfer_detail`;
DELIMITER //
CREATE TRIGGER `before_delete_transfer_detail` BEFORE DELETE ON `tr_transfer_detail`
 FOR EACH ROW BEGIN
	CALL p_transfer_detail(old.id_stock, old.qty,'2');
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_lokasi`
--
CREATE TABLE IF NOT EXISTS `v_lokasi` (
`id_lks` int(11)
,`type` tinyint(1)
,`type_lokasi` varchar(11)
,`Storage` tinyint(1)
,`storage_lokasi` varchar(9)
,`status` tinyint(1)
,`status_lokasi` varchar(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_po_detail`
--
CREATE TABLE IF NOT EXISTS `v_po_detail` (
`id_po` int(11)
,`id_detail_pr` int(11)
,`kode_barang` varchar(21)
,`note` text
,`qty` int(11)
,`price` float(12,0)
,`total` double(17,0)
,`purpose` varchar(21)
,`ext_doc_no` varchar(21)
,`ETD` date
,`top` int(3)
,`nama_barang` varchar(30)
,`user_id` smallint(6)
,`full_name` varchar(100)
,`id_vendor` varchar(21)
,`departement_id` smallint(6)
,`departement_name` varchar(25)
,`cat_req` varchar(21)
,`date_create` datetime
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_po_detail_2`
--
CREATE TABLE IF NOT EXISTS `v_po_detail_2` (
`id_po` int(11)
,`requestor` varchar(21)
,`departement` varchar(21)
,`purpose` varchar(21)
,`cat_req` varchar(21)
,`ext_doc_no` varchar(21)
,`ETD` date
,`date_create` datetime
,`top` int(3)
,`id_vendor` varchar(21)
,`id_pr` int(11)
,`id_qrs` int(11)
,`name_vendor` varchar(60)
,`address_vendor` text
,`contact_vendor` varchar(25)
,`mobile_vendor` varchar(25)
,`kode_barang` varchar(21)
,`qty` int(11)
,`price` float(12,0)
,`total` double(17,0)
,`id_qr` int(11)
,`id_detail_pr` int(11)
,`full_name` varchar(100)
,`departement_id` smallint(6)
,`departement_name` varchar(25)
,`nama_barang` varchar(30)
,`note` text
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_po_inbound`
--
CREATE TABLE IF NOT EXISTS `v_po_inbound` (
`id_detail_qrs` int(11)
,`id_detail_pr` int(11)
,`id_qrs` int(11)
,`id_pr` int(11)
,`id_po` int(11)
,`kode_barang` varchar(21)
,`qty` int(11)
,`receive` decimal(32,0)
,`sisa` decimal(33,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_po_inbound_2`
--
CREATE TABLE IF NOT EXISTS `v_po_inbound_2` (
`id_detail_qrs` int(11)
,`id_po` int(11)
,`kode_barang` varchar(21)
,`asal` int(11)
,`receive` bigint(11)
,`sisa` bigint(12)
,`nama_barang` varchar(30)
,`id_in` int(11)
,`ext_rec_no` int(11)
,`id_in_asal` int(11)
,`id_lokasi` varchar(21)
,`statuspo` int(1)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_print_inbound`
--
CREATE TABLE IF NOT EXISTS `v_print_inbound` (
`id_in` int(11)
,`type` varchar(21)
,`id_po` int(11)
,`id_pr` int(11)
,`id_ro` int(11)
,`requestor` varchar(21)
,`departement` varchar(21)
,`purpose` varchar(21)
,`cat_req` varchar(21)
,`date_create` datetime
,`id_detail_in` int(11)
,`kode_barang` varchar(21)
,`qty` int(11)
,`lokasi` varchar(21)
,`nama_barang` varchar(30)
,`full_name` varchar(100)
,`departement_name` varchar(25)
,`ext_doc_no` varchar(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pros_detail`
--
CREATE TABLE IF NOT EXISTS `v_pros_detail` (
`id_detail_ro` int(11)
,`id_ro` int(11)
,`kode_barang` varchar(21)
,`orders` int(11)
,`picking` decimal(34,0)
,`sisa` decimal(33,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_qrs_detail`
--
CREATE TABLE IF NOT EXISTS `v_qrs_detail` (
`id_detail_pr` int(11)
,`id_pr` int(11)
,`id_ro` int(11)
,`id_detail_qrs` int(11)
,`kode_barang` varchar(21)
,`qty` int(11)
,`pick` decimal(32,0)
,`sisa` decimal(33,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_status_barang`
--
CREATE TABLE IF NOT EXISTS `v_status_barang` (
`kode_barang` varchar(21)
,`status_barang` varchar(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_status_courir`
--
CREATE TABLE IF NOT EXISTS `v_status_courir` (
`id_courir` int(11)
,`status_courir` varchar(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_status_kategori`
--
CREATE TABLE IF NOT EXISTS `v_status_kategori` (
`id_kategori` int(6)
,`status_kategori` varchar(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_status_satuan`
--
CREATE TABLE IF NOT EXISTS `v_status_satuan` (
`id_satuan` smallint(6)
,`status_satuan` varchar(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_status_sub_kategori`
--
CREATE TABLE IF NOT EXISTS `v_status_sub_kategori` (
`id_sub_kategori` int(6)
,`status_sub_kategori` varchar(11)
);
-- --------------------------------------------------------

--
-- Structure for view `v_lokasi`
--
DROP TABLE IF EXISTS `v_lokasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_lokasi` AS (select `ref_lokasi`.`id_lks` AS `id_lks`,`ref_lokasi`.`type` AS `type`,(case `ref_lokasi`.`type` when '1' then 'Fast Moving' when '2' then 'Slow Moving' end) AS `type_lokasi`,`ref_lokasi`.`storage` AS `Storage`,(case `ref_lokasi`.`storage` when '1' then 'Available' when '2' then 'Hold' when '3' then 'Damage' end) AS `storage_lokasi`,`ref_lokasi`.`status` AS `status`,(case `ref_lokasi`.`status` when '1' then 'Aktif' when '0' then 'Tidak Aktif' end) AS `status_lokasi` from `ref_lokasi`);

-- --------------------------------------------------------

--
-- Structure for view `v_po_detail`
--
DROP TABLE IF EXISTS `v_po_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_po_detail` AS select `c`.`id_po` AS `id_po`,`a`.`id_detail_pr` AS `id_detail_pr`,`a`.`kode_barang` AS `kode_barang`,`a`.`note` AS `note`,`a`.`qty` AS `qty`,`e`.`price` AS `price`,(`a`.`qty` * `e`.`price`) AS `total`,`c`.`purpose` AS `purpose`,`c`.`ext_doc_no` AS `ext_doc_no`,`c`.`ETD` AS `ETD`,`d`.`top` AS `top`,`f`.`nama_barang` AS `nama_barang`,`a`.`user_id` AS `user_id`,`g`.`full_name` AS `full_name`,`d`.`id_vendor` AS `id_vendor`,`g`.`departement_id` AS `departement_id`,`h`.`departement_name` AS `departement_name`,`c`.`cat_req` AS `cat_req`,`c`.`date_create` AS `date_create` from (((((((`tr_pr_detail` `a` left join `tr_pr` `b` on((`a`.`id_pr` = `b`.`id_pr`))) left join `tr_po` `c` on((`b`.`id_po` = `c`.`id_po`))) left join `tr_qr` `d` on(((`b`.`id_pr` = `d`.`id_pr`) and (`d`.`status` = 2)))) left join `tr_qr_detail` `e` on(((`e`.`id_qr` = `d`.`id_qr`) and (`e`.`id_detail_pr` = `a`.`id_detail_pr`)))) left join `ref_barang` `f` on((`f`.`kode_barang` = `a`.`kode_barang`))) left join `sys_user` `g` on((`g`.`user_id` = `a`.`user_id`))) left join `ref_departement` `h` on((`h`.`departement_id` = `g`.`departement_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_po_detail_2`
--
DROP TABLE IF EXISTS `v_po_detail_2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_po_detail_2` AS select `tr_po`.`id_po` AS `id_po`,`tr_po`.`requestor` AS `requestor`,`tr_po`.`departement` AS `departement`,`tr_po`.`purpose` AS `purpose`,`tr_po`.`cat_req` AS `cat_req`,`tr_po`.`ext_doc_no` AS `ext_doc_no`,`tr_po`.`ETD` AS `ETD`,`tr_po`.`date_create` AS `date_create`,`tr_qr`.`top` AS `top`,`tr_qr`.`id_vendor` AS `id_vendor`,`tr_qr`.`id_pr` AS `id_pr`,`tr_qr`.`id_qrs` AS `id_qrs`,`ref_vendor`.`name_vendor` AS `name_vendor`,`ref_vendor`.`address_vendor` AS `address_vendor`,`ref_vendor`.`contact_vendor` AS `contact_vendor`,`ref_vendor`.`mobile_vendor` AS `mobile_vendor`,`tr_qr_detail`.`kode_barang` AS `kode_barang`,`tr_qr_detail`.`qty` AS `qty`,`tr_qr_detail`.`price` AS `price`,(`tr_qr_detail`.`qty` * `tr_qr_detail`.`price`) AS `total`,`tr_qr`.`id_qr` AS `id_qr`,`tr_qr_detail`.`id_detail_pr` AS `id_detail_pr`,`sys_user`.`full_name` AS `full_name`,`sys_user`.`departement_id` AS `departement_id`,`ref_departement`.`departement_name` AS `departement_name`,`ref_barang`.`nama_barang` AS `nama_barang`,`tr_pr_detail`.`note` AS `note` from (((((((`tr_po` left join `tr_qr` on((`tr_qr`.`id_po` = `tr_po`.`id_po`))) left join `ref_vendor` on((`tr_qr`.`id_vendor` = convert(`ref_vendor`.`id_vendor` using utf8)))) left join `tr_qr_detail` on(((`tr_qr`.`id_qrs` = `tr_qr_detail`.`id_qrs`) and (`tr_qr`.`id_pr` = `tr_qr_detail`.`id_pr`) and (`tr_qr`.`id_qr` = `tr_qr_detail`.`id_qr`)))) left join `sys_user` on((`tr_po`.`requestor` = `sys_user`.`user_id`))) left join `ref_departement` on((`sys_user`.`departement_id` = `ref_departement`.`departement_id`))) left join `ref_barang` on((`tr_qr_detail`.`kode_barang` = convert(`ref_barang`.`kode_barang` using utf8)))) left join `tr_pr_detail` on((`tr_qr_detail`.`id_detail_pr` = `tr_pr_detail`.`id_detail_pr`)));

-- --------------------------------------------------------

--
-- Structure for view `v_po_inbound`
--
DROP TABLE IF EXISTS `v_po_inbound`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_po_inbound` AS select `a`.`id_detail_qrs` AS `id_detail_qrs`,`a`.`id_detail_pr` AS `id_detail_pr`,`b`.`id_qrs` AS `id_qrs`,`b`.`id_pr` AS `id_pr`,`b`.`id_po` AS `id_po`,`a`.`kode_barang` AS `kode_barang`,`a`.`qty` AS `qty`,coalesce(sum(`d`.`qty`),0) AS `receive`,(`a`.`qty` - sum(coalesce(`d`.`qty`,0))) AS `sisa` from (((`tr_qrs_detail` `a` left join `tr_qrs` `b` on((`a`.`id_qrs` = `b`.`id_qrs`))) left join `tr_po` `c` on((`b`.`id_po` = `c`.`id_po`))) left join `tr_in_detail` `d` on((`a`.`id_detail_qrs` = `d`.`ext_rec_no_detail`))) where (`c`.`status` = 2) group by `a`.`id_detail_qrs` order by `a`.`id_qrs`;

-- --------------------------------------------------------

--
-- Structure for view `v_po_inbound_2`
--
DROP TABLE IF EXISTS `v_po_inbound_2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_po_inbound_2` AS select `x`.`id_detail_qrs` AS `id_detail_qrs`,`z`.`id_po` AS `id_po`,`x`.`kode_barang` AS `kode_barang`,`x`.`qty` AS `asal`,coalesce(`y`.`qty`,0) AS `receive`,(`x`.`qty` - coalesce(`y`.`qty`,0)) AS `sisa`,`a`.`nama_barang` AS `nama_barang`,`y`.`id_in` AS `id_in`,`b`.`ext_rec_no` AS `ext_rec_no`,`b`.`id_in` AS `id_in_asal`,`c`.`id_lokasi` AS `id_lokasi`,`v`.`status` AS `statuspo` from ((((((`tr_qrs_detail` `x` left join `tr_in_detail` `y` on((`x`.`id_detail_pr` = `y`.`ext_rec_no_detail`))) left join `tr_qrs` `z` on((`x`.`id_pr` = `z`.`id_pr`))) left join `tr_po` `v` on((`z`.`id_po` = `v`.`id_po`))) left join `ref_barang` `a` on((`x`.`kode_barang` = convert(`a`.`kode_barang` using utf8)))) left join `tr_in` `b` on((`z`.`id_po` = `b`.`ext_rec_no`))) left join `tr_stock` `c` on((`x`.`kode_barang` = `c`.`kode_barang`))) group by `x`.`id_detail_pr`;

-- --------------------------------------------------------

--
-- Structure for view `v_print_inbound`
--
DROP TABLE IF EXISTS `v_print_inbound`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_print_inbound` AS select `a`.`id_in` AS `id_in`,`a`.`type` AS `type`,`b`.`id_po` AS `id_po`,`b`.`id_pr` AS `id_pr`,`b`.`id_ro` AS `id_ro`,`b`.`requestor` AS `requestor`,`b`.`departement` AS `departement`,`b`.`purpose` AS `purpose`,`b`.`cat_req` AS `cat_req`,`a`.`date_create` AS `date_create`,`c`.`id_detail_in` AS `id_detail_in`,`c`.`kode_barang` AS `kode_barang`,`c`.`qty` AS `qty`,`c`.`lokasi` AS `lokasi`,`d`.`nama_barang` AS `nama_barang`,`f`.`full_name` AS `full_name`,`g`.`departement_name` AS `departement_name`,`b`.`ext_doc_no` AS `ext_doc_no` from (((((`tr_in` `a` left join `tr_po` `b` on((`a`.`ext_rec_no` = `b`.`id_po`))) left join `tr_in_detail` `c` on((`a`.`id_in` = `c`.`id_in`))) left join `ref_barang` `d` on((`c`.`kode_barang` = convert(`d`.`kode_barang` using utf8)))) left join `sys_user` `f` on((`a`.`user_id` = `f`.`user_id`))) left join `ref_departement` `g` on((`b`.`departement` = `g`.`departement_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_pros_detail`
--
DROP TABLE IF EXISTS `v_pros_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pros_detail` AS select `tr_ro_detail`.`id_detail_ro` AS `id_detail_ro`,`tr_ro_detail`.`id_ro` AS `id_ro`,`tr_ro_detail`.`kode_barang` AS `kode_barang`,`tr_ro_detail`.`qty` AS `orders`,(`tr_ro_detail`.`qty` - (`tr_ro_detail`.`qty` - coalesce(sum(`tr_pros_detail`.`qty`),0))) AS `picking`,(`tr_ro_detail`.`qty` - coalesce(sum(`tr_pros_detail`.`qty`),0)) AS `sisa` from (`tr_ro_detail` left join `tr_pros_detail` on((`tr_ro_detail`.`id_detail_ro` = `tr_pros_detail`.`id_detail_ro`))) where (`tr_ro_detail`.`status_delete` <> 1) group by `tr_ro_detail`.`id_detail_ro`;

-- --------------------------------------------------------

--
-- Structure for view `v_qrs_detail`
--
DROP TABLE IF EXISTS `v_qrs_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_qrs_detail` AS (select `a`.`id_detail_pr` AS `id_detail_pr`,`a`.`id_pr` AS `id_pr`,`a`.`id_ro` AS `id_ro`,`b`.`id_detail_qrs` AS `id_detail_qrs`,`a`.`kode_barang` AS `kode_barang`,`a`.`qty` AS `qty`,coalesce(sum(`b`.`qty`),0) AS `pick`,(`a`.`qty` - coalesce(sum(`b`.`qty`),0)) AS `sisa` from ((`tr_pr_detail` `a` left join `tr_pr` `c` on((`a`.`id_pr` = `c`.`id_pr`))) left join `tr_qrs_detail` `b` on((`a`.`id_detail_pr` = `b`.`id_detail_pr`))) where (`c`.`status` = 2) group by `a`.`id_detail_pr`);

-- --------------------------------------------------------

--
-- Structure for view `v_status_barang`
--
DROP TABLE IF EXISTS `v_status_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_status_barang` AS (select `ref_barang`.`kode_barang` AS `kode_barang`,(case `ref_barang`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_barang` from `ref_barang`);

-- --------------------------------------------------------

--
-- Structure for view `v_status_courir`
--
DROP TABLE IF EXISTS `v_status_courir`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_status_courir` AS (select `ref_courir`.`id_courir` AS `id_courir`,(case `ref_courir`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_courir` from `ref_courir`);

-- --------------------------------------------------------

--
-- Structure for view `v_status_kategori`
--
DROP TABLE IF EXISTS `v_status_kategori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_status_kategori` AS (select `ref_kategori`.`id_kategori` AS `id_kategori`,(case `ref_kategori`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_kategori` from `ref_kategori`);

-- --------------------------------------------------------

--
-- Structure for view `v_status_satuan`
--
DROP TABLE IF EXISTS `v_status_satuan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_status_satuan` AS (select `ref_satuan`.`id_satuan` AS `id_satuan`,(case `ref_satuan`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_satuan` from `ref_satuan`);

-- --------------------------------------------------------

--
-- Structure for view `v_status_sub_kategori`
--
DROP TABLE IF EXISTS `v_status_sub_kategori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_status_sub_kategori` AS (select `ref_sub_kategori`.`id_sub_kategori` AS `id_sub_kategori`,(case `ref_sub_kategori`.`status` when '1' then 'Aktif' else 'Tidak Aktif' end) AS `status_sub_kategori` from `ref_sub_kategori`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
