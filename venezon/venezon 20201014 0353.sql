-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.32


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema venezon
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ venezon;
USE venezon;

--
-- Table structure for table `venezon`.`tab_clientes`
--

DROP TABLE IF EXISTS `tab_clientes`;
CREATE TABLE `tab_clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) DEFAULT NULL,
  `nombres` varchar(20) DEFAULT NULL,
  `apellidos` varchar(20) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `movimiento` varchar(2) DEFAULT 'no',
  `fecha_reg` date DEFAULT NULL,
  `hora_reg` varchar(20) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venezon`.`tab_clientes`
--

/*!40000 ALTER TABLE `tab_clientes` DISABLE KEYS */;
INSERT INTO `tab_clientes` (`id_cliente`,`cedula`,`nombres`,`apellidos`,`telefono`,`direccion`,`correo`,`movimiento`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (7,'V-8089946','Carlo Julio ','Castillo Vivas','0414-6023242','Urb. Mocoties, casa A-5, setor san josé, el Llano, Tovar','carlo@gmail.com','no','2020-08-31','01:22:04 AM',3),
 (8,'V-10898884','Gerardo','Vivas','04247809750','El Corozo Tovar ','materialescristorey@gmail.com','si','2020-09-29','08:52:58 PM',3),
 (9,'V-10897762','Alejandro','Espinoza','04247434607','San Francisco','R@gmail.com','si','2007-01-01','12:13:19 AM',3),
 (10,'V-12048284','Gisela ','Guillen','04147297434','Correo ','R@gmail.com','si','2007-01-01','01:29:23 AM',3),
 (11,'V-20828892','Henry','Mendez','04125138011','El Corozo Tovar','R@gmail.com','si','2007-01-01','02:20:23 AM',3),
 (12,'V-8075175','Jackelyn','Mama (charcuteria)','04161796124','El Corozo Tovar ','R@gmail.com','si','2020-10-03','02:05:13 PM',3);
/*!40000 ALTER TABLE `tab_clientes` ENABLE KEYS */;


--
-- Table structure for table `venezon`.`tab_correlativos`
--

DROP TABLE IF EXISTS `tab_correlativos`;
CREATE TABLE `tab_correlativos` (
  `id_correlativo` int(11) NOT NULL AUTO_INCREMENT,
  `nro_factura` int(11) DEFAULT NULL,
  `cod_producto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_correlativo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venezon`.`tab_correlativos`
--

/*!40000 ALTER TABLE `tab_correlativos` DISABLE KEYS */;
INSERT INTO `tab_correlativos` (`id_correlativo`,`nro_factura`,`cod_producto`) VALUES 
 (1,8,87);
/*!40000 ALTER TABLE `tab_correlativos` ENABLE KEYS */;


--
-- Table structure for table `venezon`.`tab_facturas`
--

DROP TABLE IF EXISTS `tab_facturas`;
CREATE TABLE `tab_facturas` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `nro_factura` int(11) NOT NULL DEFAULT '0',
  `fecha_reg` date NOT NULL,
  `hora_reg` varchar(20) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `total` double(15,3) NOT NULL DEFAULT '0.000',
  `descuento` double(15,3) DEFAULT '0.000',
  `total_desc` double(15,3) DEFAULT '0.000',
  `anulado` varchar(2) DEFAULT 'no',
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_factura`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venezon`.`tab_facturas`
--

/*!40000 ALTER TABLE `tab_facturas` DISABLE KEYS */;
INSERT INTO `tab_facturas` (`id_factura`,`nro_factura`,`fecha_reg`,`hora_reg`,`id_cliente`,`total`,`descuento`,`total_desc`,`anulado`,`id_user`) VALUES 
 (1,1,'2020-09-29','09:20:02 PM',8,5.000,0.000,5.000,'no',3),
 (2,2,'2020-09-30','05:07:05 PM',8,7.000,0.000,7.000,'no',3),
 (3,3,'2020-10-01','12:13:19 AM',9,121.940,0.000,121.940,'no',3),
 (4,4,'2020-10-01','01:29:23 AM',10,17.000,0.000,17.000,'no',3),
 (5,5,'2020-10-01','02:20:23 AM',11,10.500,0.000,10.500,'no',3),
 (6,6,'2020-10-02','03:45:54 PM',8,7.500,0.000,7.500,'no',3),
 (7,7,'2020-10-03','02:05:13 PM',12,9.500,0.000,9.500,'no',3),
 (8,8,'2020-10-03','02:14:07 PM',8,6.500,0.000,6.500,'no',3);
/*!40000 ALTER TABLE `tab_facturas` ENABLE KEYS */;


--
-- Table structure for table `venezon`.`tab_facturas_monedas`
--

DROP TABLE IF EXISTS `tab_facturas_monedas`;
CREATE TABLE `tab_facturas_monedas` (
  `id_fact_moneda` int(11) NOT NULL AUTO_INCREMENT,
  `id_factura` int(11) NOT NULL,
  `moneda` varchar(20) NOT NULL,
  `valor_cambio` double(15,3) NOT NULL,
  PRIMARY KEY (`id_fact_moneda`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venezon`.`tab_facturas_monedas`
--

/*!40000 ALTER TABLE `tab_facturas_monedas` DISABLE KEYS */;
INSERT INTO `tab_facturas_monedas` (`id_fact_moneda`,`id_factura`,`moneda`,`valor_cambio`) VALUES 
 (1,1,'bolivares',450000.000),
 (2,1,'pesos',10.000),
 (3,2,'bolivares',450000.000),
 (4,2,'pesos',10.000),
 (5,3,'bolivares',450000.000),
 (6,3,'pesos',10.000),
 (7,4,'bolivares',450000.000),
 (8,4,'pesos',10.000),
 (9,5,'bolivares',450000.000),
 (10,5,'pesos',10.000),
 (11,6,'bolivares',450000.000),
 (12,6,'pesos',10.000),
 (13,7,'bolivares',450000.000),
 (14,7,'pesos',10.000),
 (15,8,'bolivares',450000.000),
 (16,8,'pesos',10.000);
/*!40000 ALTER TABLE `tab_facturas_monedas` ENABLE KEYS */;


--
-- Table structure for table `venezon`.`tab_facturas_reng`
--

DROP TABLE IF EXISTS `tab_facturas_reng`;
CREATE TABLE `tab_facturas_reng` (
  `id_fact_reng` int(11) NOT NULL AUTO_INCREMENT,
  `id_factura` int(11) NOT NULL,
  `nro_reglon` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` double(15,3) NOT NULL,
  `precio_total` double(15,3) NOT NULL,
  `descuento` double(15,3) DEFAULT '0.000',
  `precio_unitario_desc` double(15,3) DEFAULT NULL,
  `precio_costo` double(15,3) DEFAULT NULL,
  PRIMARY KEY (`id_fact_reng`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venezon`.`tab_facturas_reng`
--

/*!40000 ALTER TABLE `tab_facturas_reng` DISABLE KEYS */;
INSERT INTO `tab_facturas_reng` (`id_fact_reng`,`id_factura`,`nro_reglon`,`id_producto`,`cantidad`,`precio_unitario`,`precio_total`,`descuento`,`precio_unitario_desc`,`precio_costo`) VALUES 
 (1,1,1,14,1,5.000,5.000,0.000,5.000,3.000),
 (2,2,1,22,1,7.000,7.000,0.000,7.000,5.000),
 (3,3,1,81,1,19.000,19.000,0.000,19.000,17.000),
 (4,3,2,76,1,15.000,15.000,0.000,15.000,14.000),
 (5,3,3,80,1,18.000,18.000,0.000,18.000,16.000),
 (6,3,4,16,3,1.500,4.500,0.000,1.500,1.000),
 (7,3,5,85,3,1.500,4.500,0.000,1.500,1.500),
 (8,3,6,87,1,1.500,1.500,0.000,1.500,1.500),
 (9,3,7,61,2,7.500,15.000,0.000,7.500,6.500),
 (10,3,8,8,6,1.990,11.940,0.000,1.990,1.500),
 (11,3,9,42,1,8.500,8.500,0.000,8.500,7.000),
 (12,3,10,40,1,2.500,2.500,0.000,2.500,1.500),
 (13,3,11,69,1,5.500,5.500,0.000,5.500,4.000),
 (14,3,12,7,1,5.000,5.000,0.000,5.000,3.500),
 (15,3,13,15,2,1.500,3.000,0.000,1.500,1.000),
 (16,3,14,54,1,4.000,4.000,0.000,4.000,2.500),
 (17,3,15,51,1,4.000,4.000,0.000,4.000,2.500),
 (18,4,1,36,1,3.500,3.500,0.000,3.500,2.500),
 (19,4,2,28,1,4.000,4.000,0.000,4.000,2.500);
INSERT INTO `tab_facturas_reng` (`id_fact_reng`,`id_factura`,`nro_reglon`,`id_producto`,`cantidad`,`precio_unitario`,`precio_total`,`descuento`,`precio_unitario_desc`,`precio_costo`) VALUES 
 (20,4,3,15,1,1.500,1.500,0.000,1.500,1.000),
 (21,4,4,5,2,1.500,3.000,0.000,1.500,1.000),
 (22,4,5,7,1,5.000,5.000,0.000,5.000,3.500),
 (23,5,1,64,1,5.000,5.000,0.000,5.000,3.000),
 (24,5,2,85,1,1.500,1.500,0.000,1.500,1.500),
 (25,5,3,39,1,2.500,2.500,0.000,2.500,1.500),
 (26,5,4,16,1,1.500,1.500,0.000,1.500,1.000),
 (27,6,1,61,1,7.500,7.500,0.000,7.500,6.500),
 (28,7,1,6,1,4.000,4.000,0.000,4.000,2.500),
 (29,7,2,21,1,4.000,4.000,0.000,4.000,2.500),
 (30,7,3,16,1,1.500,1.500,0.000,1.500,1.000),
 (31,8,1,66,1,6.500,6.500,0.000,6.500,5.000);
/*!40000 ALTER TABLE `tab_facturas_reng` ENABLE KEYS */;


--
-- Table structure for table `venezon`.`tab_fecha_pc`
--

DROP TABLE IF EXISTS `tab_fecha_pc`;
CREATE TABLE `tab_fecha_pc` (
  `Id_fecha_pc` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pc` date DEFAULT NULL,
  PRIMARY KEY (`Id_fecha_pc`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venezon`.`tab_fecha_pc`
--

/*!40000 ALTER TABLE `tab_fecha_pc` DISABLE KEYS */;
INSERT INTO `tab_fecha_pc` (`Id_fecha_pc`,`fecha_pc`) VALUES 
 (1,'2020-10-02');
/*!40000 ALTER TABLE `tab_fecha_pc` ENABLE KEYS */;


--
-- Table structure for table `venezon`.`tab_monedas`
--

DROP TABLE IF EXISTS `tab_monedas`;
CREATE TABLE `tab_monedas` (
  `id_moneda` int(11) NOT NULL AUTO_INCREMENT,
  `moneda` varchar(20) NOT NULL,
  `valor_cambio` double(15,3) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_moneda`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venezon`.`tab_monedas`
--

/*!40000 ALTER TABLE `tab_monedas` DISABLE KEYS */;
INSERT INTO `tab_monedas` (`id_moneda`,`moneda`,`valor_cambio`,`id_user`) VALUES 
 (1,'bolivares',450000.000,3),
 (2,'pesos',10.000,3);
/*!40000 ALTER TABLE `tab_monedas` ENABLE KEYS */;


--
-- Table structure for table `venezon`.`tab_productos`
--

DROP TABLE IF EXISTS `tab_productos`;
CREATE TABLE `tab_productos` (
  `id_producto` int(8) NOT NULL AUTO_INCREMENT,
  `cod_producto_1` int(11) DEFAULT NULL,
  `cod_producto_2` varchar(15) DEFAULT NULL,
  `producto` varchar(100) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `precio_compra` double(15,3) DEFAULT '0.000',
  `precio_final` double(15,3) DEFAULT '0.000',
  `ganancia` double(15,3) DEFAULT '0.000',
  `cantidad_producto` int(11) DEFAULT '0',
  `cantidad_venta` int(11) DEFAULT '0',
  `cantidad_existencia` int(11) DEFAULT '0',
  `facturas` varchar(2) DEFAULT 'no',
  `fecha_reg` date DEFAULT NULL,
  `hora_reg` varchar(20) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT '0',
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `venezon`.`tab_productos`
--

/*!40000 ALTER TABLE `tab_productos` DISABLE KEYS */;
INSERT INTO `tab_productos` (`id_producto`,`cod_producto_1`,`cod_producto_2`,`producto`,`descripcion`,`precio_compra`,`precio_final`,`ganancia`,`cantidad_producto`,`cantidad_venta`,`cantidad_existencia`,`facturas`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (1,1,'cod-1','Acondicionador Alverto VO5','Acondicionador VO5 De (350mL)',2.500,4.000,1.500,18,0,18,'si','2018-03-26','01:22:04 AM',3),
 (2,2,'cod-2','Aceite De Aguacate','Aceite De Aguacate  De (134g) ',6.000,8.000,2.000,4,0,4,'si','2020-09-29','08:17:51 PM',3),
 (3,3,'cod-3','Aceite De Oliva','Aceite De Oliva Pompeian de (1.41L) ',13.500,15.000,1.500,4,0,4,'si','2020-09-29','08:17:51 PM',3),
 (4,4,'cod-4','Aceite En Spray ','Aceite En Spray WELLSLEY De (454g)',4.500,6.000,1.500,4,0,4,'si','2020-09-29','08:17:51 PM',3),
 (5,5,'cod-5','Afeitadoras Gillete','Afeitadoras 2 Hojillas',1.000,1.500,0.500,17,2,15,'si','2020-09-29','08:17:51 PM',3),
 (6,6,'cod-6','Ajax En Polvo ','Limpiador AJAX De (794g)',2.500,4.000,1.500,5,1,4,'si','2020-09-29','08:17:51 PM',3),
 (7,7,'cod-7','Antiacido','Berkley De (200) Pastillas ',3.500,5.000,1.500,4,2,2,'si','2020-09-29','08:17:51 PM',3);
INSERT INTO `tab_productos` (`id_producto`,`cod_producto_1`,`cod_producto_2`,`producto`,`descripcion`,`precio_compra`,`precio_final`,`ganancia`,`cantidad_producto`,`cantidad_venta`,`cantidad_existencia`,`facturas`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (8,8,'cod-8','Atun Bumble Bee','Comida, Atun Light De (113g)',1.500,1.990,0.490,19,6,13,'si','2020-09-29','08:17:51 PM',3),
 (9,9,'cod-9','Azucar Splenda','Azucar (1200 Packets) ',30.000,33.000,3.000,1,0,1,'si','2020-09-29','08:17:51 PM',3),
 (10,10,'cod-10','Azucar Sweetener','Azucar (1000 Packets) ',18.000,20.000,2.000,1,0,1,'si','2020-09-29','08:17:51 PM',3),
 (11,11,'cod-11','Azucar Truvia Stevia','Azucar (400 packets)',25.000,27.000,2.000,1,0,1,'si','2020-09-29','08:55:46 PM',3),
 (12,12,'cod-12','Caja De Guantes ','Guantes Para Covid',15.000,17.000,2.000,1,0,1,'si','2020-09-29','08:55:46 PM',3),
 (13,13,'cod-13','Cebolla En Polvo','Badia (566.9g)',7.500,9.000,1.500,2,0,2,'si','2020-09-29','08:55:46 PM',3),
 (14,14,'cod-14','Cepillos Dentales','Colgate Classic Clean (3)',3.000,5.000,2.000,5,1,4,'si','2020-09-29','08:55:46 PM',3),
 (15,15,'cod-15','Chocolate MIM','MIM Amarillos (49.3g)',1.000,1.500,0.500,96,3,93,'si','2020-09-29','08:55:46 PM',3);
INSERT INTO `tab_productos` (`id_producto`,`cod_producto_1`,`cod_producto_2`,`producto`,`descripcion`,`precio_compra`,`precio_final`,`ganancia`,`cantidad_producto`,`cantidad_venta`,`cantidad_existencia`,`facturas`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (16,16,'cod-16','Chocolate Snickers','Chocolate (250g)',1.000,1.500,0.500,96,5,91,'si','2020-09-29','08:55:46 PM',3),
 (17,17,'cod-17','Crema Colgate PequeÃ±a','Crema De Dientes PequeÃ±a (39.6g)',1.250,1.990,0.740,20,0,20,'si','2020-09-29','08:55:46 PM',3),
 (18,18,'cod-18','Crema Dental Crest ','Dental Crest (232g)',3.000,4.000,1.000,15,0,15,'si','2020-09-29','08:55:46 PM',3),
 (19,19,'cod-19','Crema Para Cuerpo Body Lotions morada ','Crema Para Cuerpo morada April (156g)',2.500,4.000,1.500,4,0,4,'si','2020-09-29','08:55:46 PM',3),
 (20,20,'cod-20','Crema Para Cuerpo Body Lotions Verde ','Crema Para Cuerpo Verde April (156g)',2.500,4.000,1.500,4,0,4,'si','2020-09-29','08:55:46 PM',3),
 (21,21,'cod-21','Dermasil ','Crema Humectante Para Prevenir La Resequedad (236mL)',2.500,4.000,1.500,10,1,9,'si','2020-09-30','01:47:55 PM',3),
 (22,22,'cod-22','Desodorante AXE','Desodorante Para Hombre  PHOENIX (76g)',5.000,7.000,2.000,16,1,15,'si','2020-09-30','01:47:55 PM',3);
INSERT INTO `tab_productos` (`id_producto`,`cod_producto_1`,`cod_producto_2`,`producto`,`descripcion`,`precio_compra`,`precio_final`,`ganancia`,`cantidad_producto`,`cantidad_venta`,`cantidad_existencia`,`facturas`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (23,23,'cod-23','Desodorante Speed  Stick Para Hombre COOL CLEAN','Desodorante Para Hombre (51g)',2.500,4.000,1.500,6,0,6,'si','2020-09-30','01:47:55 PM',3),
 (24,24,'cod-24','Desodorante Speed  Stick Para Hombre REGULAR','Desodorante Para Hombre (51g)',2.500,4.000,1.500,5,0,5,'si','2020-09-30','01:47:55 PM',3),
 (25,25,'cod-25','Desodorante Speed  Stick Para Mujer Invisible ','Desodorante Para Mujer (39.6g)',2.500,4.000,1.500,6,0,6,'si','2020-09-30','02:04:52 PM',3),
 (26,26,'cod-26','Desodorante Lady Speed  Stick Para Mujer Power','Desodorante Para Mujer (39.6g)',2.500,4.000,1.500,4,0,4,'si','2020-09-30','02:04:52 PM',3),
 (27,27,'cod-27','Desodorante Speed  Stick Para Mujer Roll-on','Desodorante Para Mujer (50mL) Roll-on',2.500,4.000,1.500,4,0,4,'si','2020-09-30','02:04:52 PM',3),
 (28,28,'cod-28','Desodorante De Mujer Suave Powder ','Desodorante Para Mujer (39g)',2.500,4.000,1.500,11,1,10,'si','2020-09-30','02:04:52 PM',3);
INSERT INTO `tab_productos` (`id_producto`,`cod_producto_1`,`cod_producto_2`,`producto`,`descripcion`,`precio_compra`,`precio_final`,`ganancia`,`cantidad_producto`,`cantidad_venta`,`cantidad_existencia`,`facturas`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (29,29,'cod-29','Desodorante De Mujer Suave Sweet Pea & Violet ','Desodorante Para Mujer (39g)',2.500,4.000,1.500,12,0,12,'si','2020-09-30','02:04:52 PM',3),
 (30,30,'cod-30','Desodorante Old Spice ','Desodorante (85g)',4.000,5.500,1.500,16,0,16,'si','2020-09-30','02:04:52 PM',3),
 (31,31,'cod-31','Desodorante Arrid ','Desodorante Azul (28g) ',2.500,4.000,1.500,6,0,6,'si','2020-09-30','02:35:45 PM',3),
 (32,32,'cod-32','Gelatina Super Wet Azul Hombre ','Gelatina Para Cabello (250g)',2.500,4.000,1.500,2,0,2,'si','2020-09-30','02:35:45 PM',3),
 (33,33,'cod-33','Gelatina CLear Super Wet Hombre ','Gelatina Para Cabello (250g)',2.500,4.000,1.500,4,0,4,'si','2020-09-30','02:35:45 PM',3),
 (34,34,'cod-34','Gelatina Xtreme Clear ','Gelatina Para Cabello (250g)',2.500,4.000,1.500,3,0,3,'si','2020-09-30','02:35:45 PM',3),
 (35,35,'cod-35','HIsopos Assured','Caja De Hisopos (300) ',2.500,4.000,1.500,10,0,10,'si','2020-09-30','02:35:45 PM',3);
INSERT INTO `tab_productos` (`id_producto`,`cod_producto_1`,`cod_producto_2`,`producto`,`descripcion`,`precio_compra`,`precio_final`,`ganancia`,`cantidad_producto`,`cantidad_venta`,`cantidad_existencia`,`facturas`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (36,36,'cod-36','Jabon Palmolive ','Jabon De BaÃ±o (272g 3)',2.500,3.500,1.000,12,1,11,'si','2020-09-30','02:35:45 PM',3),
 (37,37,'cod-37','Jabon Dove ','Jabon De BaÃ±o (106g)',2.000,3.000,1.000,16,0,16,'si','2020-09-30','02:35:45 PM',3),
 (38,38,'cod-38','Jabon Irish Spring (verde)','Jabon De BaÃ±o (104.8g)',1.500,2.500,1.000,60,0,60,'si','2020-09-30','02:35:45 PM',3),
 (39,39,'cod-39','Leche Condensada La Lechera ','Leche Condensada De (397g)',1.500,2.500,1.000,12,1,11,'si','2020-09-30','02:35:45 PM',3),
 (40,40,'cod-40','Leche Evaporada Carnation','Leche Evaporada de (354mL)',1.500,2.500,1.000,16,1,15,'si','2020-09-30','02:35:45 PM',3),
 (41,41,'cod-41','Mantequilla De Many JiF Extra Crunch','Mantequilla De Many de (1.36Kg)',6.500,8.000,1.500,2,0,2,'si','2020-09-30','03:07:34 PM',3),
 (42,42,'cod-42','Mantequilla De Many Skippy ','Mantequilla De Many de (1.36Kg)',7.000,8.500,1.500,4,1,3,'si','2020-09-30','03:07:34 PM',3);
INSERT INTO `tab_productos` (`id_producto`,`cod_producto_1`,`cod_producto_2`,`producto`,`descripcion`,`precio_compra`,`precio_final`,`ganancia`,`cantidad_producto`,`cantidad_venta`,`cantidad_existencia`,`facturas`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (43,43,'cod-43','Maquillaje Base Natural Coconnut WetYWild',',Maquillaje',2.500,4.000,1.500,4,0,4,'si','2020-09-30','03:07:34 PM',3),
 (44,44,'cod-44','Maquillaje Brillo Boca-Glossy Lips',',Maquillaje',2.500,4.000,1.500,4,0,4,'si','2020-09-30','03:07:34 PM',3),
 (45,45,'cod-45','Maquillaje Brochas-Power Bruch ','Brocha De Maquillaje ',2.500,4.000,1.500,5,0,5,'si','2020-09-30','03:07:34 PM',3),
 (47,47,'cod-47','Maquillaje Colorete-Power Blush L.A',',Maquillaje',2.500,4.000,1.500,6,0,6,'si','2020-09-30','03:07:34 PM',3),
 (48,48,'cod-48','Maquillaje Compacto Color Mate Logth Med ',',Maquillaje',2.500,4.000,1.500,1,0,1,'si','2020-09-30','03:07:34 PM',3),
 (49,49,'cod-49','Maquillaje Delineador De Ojo Maybeline ',',Maquillaje',2.500,4.000,1.500,4,0,4,'si','2020-09-30','03:07:34 PM',3),
 (50,50,'cod-50','Maquillaje Labiales ELF',',Maquillaje',2.500,4.000,1.500,5,0,5,'si','2020-09-30','03:07:34 PM',3);
INSERT INTO `tab_productos` (`id_producto`,`cod_producto_1`,`cod_producto_2`,`producto`,`descripcion`,`precio_compra`,`precio_final`,`ganancia`,`cantidad_producto`,`cantidad_venta`,`cantidad_existencia`,`facturas`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (51,51,'cod-51','Maquillaje Lapiz De Ojo L.A Color Black ',',Maquillaje',2.500,4.000,1.500,7,1,6,'si','2020-09-30','03:07:34 PM',3),
 (52,52,'cod-52','Maquillaje Lspiz Delineador Labios ELF ',',Maquillaje',2.500,4.000,1.500,4,0,4,'si','2020-09-30','03:07:34 PM',3),
 (53,53,'cod-53','Maquillaje Liquid Makeup base L.A',',Maquillaje (Base En Tubitos)',2.500,4.000,1.500,7,0,7,'si','2020-09-30','03:36:39 PM',3),
 (54,54,'cod-54','Maquillaje Mascara Pestanas WetYWild',',Maquillaje',2.500,4.000,1.500,5,1,4,'si','2020-09-30','03:36:39 PM',3),
 (55,55,'cod-55','Maquillaje Polvo Compacto P. Power Color M',',Maquillaje',2.500,4.000,1.500,4,0,4,'si','2020-09-30','03:36:39 PM',3),
 (56,56,'cod-56','Maquillaje Polvo Compacto P. Power L:A',',Maquillaje',2.500,4.000,1.500,11,0,11,'si','2020-09-30','03:36:39 PM',3),
 (57,57,'cod-57','Maquillaje Sombras De Ojo Sunset L:A ',',Maquillaje',2.500,4.000,1.500,4,0,4,'si','2020-09-30','03:36:39 PM',3);
INSERT INTO `tab_productos` (`id_producto`,`cod_producto_1`,`cod_producto_2`,`producto`,`descripcion`,`precio_compra`,`precio_final`,`ganancia`,`cantidad_producto`,`cantidad_venta`,`cantidad_existencia`,`facturas`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (58,58,'cod-58','Maquillaje Sombras ELF',',Maquillaje',2.500,4.000,1.500,6,0,6,'si','2020-09-30','03:36:39 PM',3),
 (59,59,'cod-59','MAquillaje Sombras De Ojo Revlon',',Maquillaje',2.500,4.000,1.500,5,0,5,'si','2020-09-30','03:36:39 PM',3),
 (60,60,'cod-60','Mascarillas ','Mascaras Contra El Covid-19',1.000,2.000,1.000,50,0,50,'si','2020-09-30','03:36:39 PM',3),
 (61,61,'cod-61','Nutella ','Nutella Chocolate De (750g) ',6.500,7.500,1.000,10,3,7,'si','2020-09-30','03:36:39 PM',3),
 (62,62,'cod-62','Pasta Barilla Spaguetti','Barilla (454g)',2.000,3.000,1.000,8,0,8,'si','2020-09-30','04:02:51 PM',3),
 (63,63,'cod-63','Pasta Organica Barilla 3 Penne 3 Spaguetti ','Pastas Organic corta y larga (454g)',2.500,3.500,1.000,6,0,6,'si','2020-09-30','04:02:51 PM',3),
 (64,64,'cod-64','Polvo De Hornear ','Polvo De Hornear (230g)',3.000,5.000,2.000,8,1,7,'si','2020-09-30','04:02:51 PM',3);
INSERT INTO `tab_productos` (`id_producto`,`cod_producto_1`,`cod_producto_2`,`producto`,`descripcion`,`precio_compra`,`precio_final`,`ganancia`,`cantidad_producto`,`cantidad_venta`,`cantidad_existencia`,`facturas`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (65,65,'cod-65','Red Pepper ','McCorrmick Red Pepper (368g)',9.000,10.500,1.500,1,0,1,'si','2020-09-30','04:02:51 PM',3),
 (66,66,'cod-66','Salsa BBQ','Salsa BBQ Honey (1.13Kg)',5.000,6.500,1.500,4,1,3,'si','2020-09-30','04:02:51 PM',3),
 (67,67,'cod-67','Salsa De Tomate (Ketchup)','Salsa De Tomate De (1.25Kg)',4.000,5.000,1.000,3,0,3,'si','2020-09-30','04:02:51 PM',3),
 (68,68,'cod-68','Salsas Pack Picnic (4)','Salsas Heinz, Pack De 4; TOTAL (2.60Kg)',12.000,14.000,2.000,4,0,4,'si','2020-09-30','04:02:51 PM',3),
 (69,69,'cod-69','Salsa Mostaza ','Mostaza Frenchs De (850g)',4.000,5.500,1.500,4,1,3,'si','2020-09-30','04:02:51 PM',3),
 (70,70,'cod-70','Shampoo Alverto VO5 ','Shampoo Para El Cabello  (370mL)',2.500,4.000,1.500,18,0,18,'si','2020-09-30','04:02:51 PM',3),
 (71,71,'cod-71','Shampoo 2 En 1 AXE ','Shampoo Para Caballero De (828ML)',7.500,9.000,1.500,6,0,6,'si','2020-09-30','04:02:51 PM',3);
INSERT INTO `tab_productos` (`id_producto`,`cod_producto_1`,`cod_producto_2`,`producto`,`descripcion`,`precio_compra`,`precio_final`,`ganancia`,`cantidad_producto`,`cantidad_venta`,`cantidad_existencia`,`facturas`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (72,72,'cod-72','Shampoo HeadYShoulders 2 En 1','Shampoo  (1.28L)',18.000,20.000,2.000,2,0,2,'si','2020-09-30','04:33:54 PM',3),
 (73,73,'cod-73','Shampoo HeadYShoulders 2 En 1 Almendras ','Shampoo  (1.28L)',18.000,20.000,2.000,2,0,2,'si','2020-09-30','04:33:54 PM',3),
 (74,74,'cod-74','Shampoo HeadYShoulders Clasic ','Shampoo  (1.28L)',18.000,20.000,2.000,2,0,2,'si','2020-09-30','04:33:54 PM',3),
 (75,75,'cod-75','Shampoo NiÃ±a Frozen II','Shampoo (236mL)',2.500,4.000,1.500,8,0,8,'si','2020-09-30','04:33:54 PM',3),
 (76,76,'cod-76','Shampoo Pantene ','Shampoo (1.13L)',14.000,15.000,1.000,6,1,5,'si','2020-09-30','04:33:54 PM',3),
 (77,77,'cod-77','Shampoo De Bebe Wash ','Johnsons baby (800mL)',6.000,7.000,1.000,1,0,1,'si','2020-09-30','04:33:54 PM',3),
 (78,78,'cod-78','Shampoo spray  Sec-Dry','Dry Shampoo Crisp - blossom ',2.500,4.000,1.500,13,0,13,'si','2020-09-30','04:33:54 PM',3);
INSERT INTO `tab_productos` (`id_producto`,`cod_producto_1`,`cod_producto_2`,`producto`,`descripcion`,`precio_compra`,`precio_final`,`ganancia`,`cantidad_producto`,`cantidad_venta`,`cantidad_existencia`,`facturas`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (79,79,'cod-79','Shampoo Seco Batiste','Shampoo Seco tropical (120 g)',7.500,9.000,1.500,8,0,8,'si','2020-09-30','04:33:54 PM',3),
 (80,80,'cod-80','Shampoo Treseme Keratina 2Pack ','Shampoo (828 ml)',16.000,18.000,2.000,2,1,1,'si','2020-09-30','04:33:54 PM',3),
 (81,81,'cod-81','Shampoo De Bebe Johnsons Pack (2Gran1Peque)','Shampoo Johnsons Baby ',17.000,19.000,2.000,1,1,0,'si','2020-09-30','04:33:54 PM',3),
 (82,82,'cod-82','Tintes Color Eazy ','Tintes Para El Cabello',2.500,4.000,1.500,18,0,18,'si','2020-09-30','04:33:54 PM',3),
 (83,83,'cod-83','Tintes Revlon ','Tintes Para El Cabello',5.000,6.500,1.500,26,0,26,'si','2020-09-30','04:33:54 PM',3),
 (84,84,'cod-84','Toallas Desmaquillantes Collegene Cloths ','Desmaquillantes (30 cloths)',2.500,4.000,1.500,6,0,6,'si','2020-09-30','04:33:54 PM',3),
 (85,85,'cod-85','Trident 6Paquetes (CAJA 17$)','Chicles ',1.500,1.500,0.000,90,4,86,'si','2020-09-30','04:33:54 PM',3);
INSERT INTO `tab_productos` (`id_producto`,`cod_producto_1`,`cod_producto_2`,`producto`,`descripcion`,`precio_compra`,`precio_final`,`ganancia`,`cantidad_producto`,`cantidad_venta`,`cantidad_existencia`,`facturas`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (86,86,'cod-86','Trident Splash Fresa ','Chicles',2.000,2.500,0.500,9,0,9,'si','2020-09-30','04:33:54 PM',3),
 (87,87,'cod-87','Trident White (caja en 19$) ','Chicles',1.500,1.500,0.000,24,1,23,'si','2020-09-30','04:33:54 PM',3);
/*!40000 ALTER TABLE `tab_productos` ENABLE KEYS */;


--
-- Table structure for table `venezon`.`tab_proveedores`
--

DROP TABLE IF EXISTS `tab_proveedores`;
CREATE TABLE `tab_proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) DEFAULT NULL,
  `nombres` varchar(20) DEFAULT NULL,
  `apellidos` varchar(20) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `comercio` varchar(50) DEFAULT NULL,
  `movimiento` varchar(2) DEFAULT 'no',
  `fecha_reg` date DEFAULT NULL,
  `hora_reg` varchar(20) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venezon`.`tab_proveedores`
--

/*!40000 ALTER TABLE `tab_proveedores` DISABLE KEYS */;
INSERT INTO `tab_proveedores` (`id_proveedor`,`cedula`,`nombres`,`apellidos`,`telefono`,`direccion`,`correo`,`comercio`,`movimiento`,`fecha_reg`,`hora_reg`,`id_usuario`) VALUES 
 (7,'J-8089946-1','Carlo Julio ','Castillo Vivas','0414-6023242','Urb. Mocoties, casa A-5, setor san josé, el Llano, Tovar','carlo@gmail.com','Mini Sistemas cjcv','no','2020-08-31','01:22:04 AM',3),
 (8,'V-16306321','Karen','Vivas','+1(786) 461-5778','Miami, Florida','karenmv1410@gmail.com','venezon','si','2020-09-29','07:58:41 PM',3);
/*!40000 ALTER TABLE `tab_proveedores` ENABLE KEYS */;


--
-- Table structure for table `venezon`.`tab_proveedores_facturas`
--

DROP TABLE IF EXISTS `tab_proveedores_facturas`;
CREATE TABLE `tab_proveedores_facturas` (
  `id_factura_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nro_factura_proveedor` varchar(15) NOT NULL DEFAULT '0',
  `fecha_factura_proveedor` date DEFAULT NULL,
  `fecha_reg` date NOT NULL,
  `hora_reg` varchar(20) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `total` double(15,3) NOT NULL DEFAULT '0.000',
  `descuento` double(15,3) DEFAULT '0.000',
  `total_desc` double(15,3) DEFAULT '0.000',
  `anulado` varchar(2) DEFAULT 'no',
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_factura_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venezon`.`tab_proveedores_facturas`
--

/*!40000 ALTER TABLE `tab_proveedores_facturas` DISABLE KEYS */;
INSERT INTO `tab_proveedores_facturas` (`id_factura_proveedor`,`nro_factura_proveedor`,`fecha_factura_proveedor`,`fecha_reg`,`hora_reg`,`id_proveedor`,`total`,`descuento`,`total_desc`,`anulado`,`id_user`) VALUES 
 (1,'FP-1','2020-09-29','2020-09-29','07:58:41 PM',8,45.000,0.000,45.000,'si',3),
 (2,'FP-2','2020-09-29','2020-09-29','08:46:11 PM',8,261.000,0.000,261.000,'no',3),
 (3,'FP-3','2020-09-29','2020-09-29','09:18:28 PM',8,352.000,0.000,352.000,'no',3),
 (4,'FP-4','2020-09-29','2020-09-30','02:23:49 PM',8,289.000,0.000,289.000,'no',3),
 (5,'FP-5','2020-09-29','2020-09-30','02:59:43 PM',8,256.500,0.000,256.500,'no',3),
 (6,'FP-6','2020-09-29','2020-09-30','03:30:14 PM',8,131.000,0.000,131.000,'no',3),
 (7,'FP-7','2020-09-29','2020-09-30','03:55:01 PM',8,230.000,0.000,230.000,'no',3),
 (8,'FP-8','2020-09-29','2020-09-30','04:27:40 PM',8,250.000,0.000,250.000,'no',3),
 (9,'FP-9','2020-09-29','2020-09-30','04:55:47 PM',8,738.500,0.000,738.500,'no',3);
/*!40000 ALTER TABLE `tab_proveedores_facturas` ENABLE KEYS */;


--
-- Table structure for table `venezon`.`tab_proveedores_facturas_monedas`
--

DROP TABLE IF EXISTS `tab_proveedores_facturas_monedas`;
CREATE TABLE `tab_proveedores_facturas_monedas` (
  `id_fact_moneda` int(11) NOT NULL AUTO_INCREMENT,
  `id_factura_proveedor` int(11) NOT NULL,
  `moneda` varchar(20) NOT NULL,
  `valor_cambio` double(15,3) NOT NULL,
  PRIMARY KEY (`id_fact_moneda`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venezon`.`tab_proveedores_facturas_monedas`
--

/*!40000 ALTER TABLE `tab_proveedores_facturas_monedas` DISABLE KEYS */;
INSERT INTO `tab_proveedores_facturas_monedas` (`id_fact_moneda`,`id_factura_proveedor`,`moneda`,`valor_cambio`) VALUES 
 (1,1,'bolivares',450000.000),
 (2,1,'pesos',10.000),
 (3,2,'bolivares',450000.000),
 (4,2,'pesos',10.000),
 (5,3,'bolivares',450000.000),
 (6,3,'pesos',10.000),
 (7,4,'bolivares',450000.000),
 (8,4,'pesos',10.000),
 (9,5,'bolivares',450000.000),
 (10,5,'pesos',10.000),
 (11,6,'bolivares',450000.000),
 (12,6,'pesos',10.000),
 (13,7,'bolivares',450000.000),
 (14,7,'pesos',10.000),
 (15,8,'bolivares',450000.000),
 (16,8,'pesos',10.000),
 (17,9,'bolivares',450000.000),
 (18,9,'pesos',10.000);
/*!40000 ALTER TABLE `tab_proveedores_facturas_monedas` ENABLE KEYS */;


--
-- Table structure for table `venezon`.`tab_proveedores_facturas_reng`
--

DROP TABLE IF EXISTS `tab_proveedores_facturas_reng`;
CREATE TABLE `tab_proveedores_facturas_reng` (
  `id_fact_reng` int(11) NOT NULL AUTO_INCREMENT,
  `id_factura_proveedor` int(11) NOT NULL,
  `nro_reglon` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` double(15,3) NOT NULL,
  `precio_total` double(15,3) NOT NULL,
  `descuento` double(15,3) DEFAULT '0.000',
  `precio_unitario_desc` double(15,3) DEFAULT NULL,
  `precio_costo` double(15,3) DEFAULT NULL,
  PRIMARY KEY (`id_fact_reng`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venezon`.`tab_proveedores_facturas_reng`
--

/*!40000 ALTER TABLE `tab_proveedores_facturas_reng` DISABLE KEYS */;
INSERT INTO `tab_proveedores_facturas_reng` (`id_fact_reng`,`id_factura_proveedor`,`nro_reglon`,`id_producto`,`cantidad`,`precio_unitario`,`precio_total`,`descuento`,`precio_unitario_desc`,`precio_costo`) VALUES 
 (1,1,1,1,18,2.500,45.000,0.000,2.500,2.500),
 (2,2,1,2,4,6.000,24.000,0.000,6.000,6.000),
 (3,2,2,3,4,13.500,54.000,0.000,13.500,13.500),
 (4,2,3,4,4,4.500,18.000,0.000,4.500,4.500),
 (5,2,4,1,18,2.500,45.000,0.000,2.500,2.500),
 (6,2,5,5,17,1.000,17.000,0.000,1.000,1.000),
 (7,2,6,6,5,2.500,12.500,0.000,2.500,2.500),
 (8,2,7,7,4,3.500,14.000,0.000,3.500,3.500),
 (9,2,8,8,19,1.500,28.500,0.000,1.500,1.500),
 (10,2,9,9,1,30.000,30.000,0.000,30.000,30.000),
 (11,2,10,10,1,18.000,18.000,0.000,18.000,18.000),
 (12,3,1,11,1,25.000,25.000,0.000,25.000,25.000),
 (13,3,2,12,1,15.000,15.000,0.000,15.000,15.000),
 (14,3,3,13,2,7.500,15.000,0.000,7.500,7.500),
 (15,3,4,14,5,3.000,15.000,0.000,3.000,3.000),
 (16,3,5,15,96,1.000,96.000,0.000,1.000,1.000),
 (17,3,6,16,96,1.000,96.000,0.000,1.000,1.000),
 (18,3,7,17,20,1.250,25.000,0.000,1.250,1.250);
INSERT INTO `tab_proveedores_facturas_reng` (`id_fact_reng`,`id_factura_proveedor`,`nro_reglon`,`id_producto`,`cantidad`,`precio_unitario`,`precio_total`,`descuento`,`precio_unitario_desc`,`precio_costo`) VALUES 
 (19,3,8,18,15,3.000,45.000,0.000,3.000,3.000),
 (20,3,9,19,4,2.500,10.000,0.000,2.500,2.500),
 (21,3,10,20,4,2.500,10.000,0.000,2.500,2.500),
 (22,4,1,21,10,2.500,25.000,0.000,2.500,2.500),
 (23,4,2,22,16,5.000,80.000,0.000,5.000,5.000),
 (24,4,3,28,11,2.500,27.500,0.000,2.500,2.500),
 (25,4,4,29,12,2.500,30.000,0.000,2.500,2.500),
 (26,4,5,30,16,4.000,64.000,0.000,4.000,4.000),
 (27,4,6,23,6,2.500,15.000,0.000,2.500,2.500),
 (28,4,7,24,5,2.500,12.500,0.000,2.500,2.500),
 (29,4,8,25,6,2.500,15.000,0.000,2.500,2.500),
 (30,4,9,26,4,2.500,10.000,0.000,2.500,2.500),
 (31,4,10,27,4,2.500,10.000,0.000,2.500,2.500),
 (32,5,1,31,6,2.500,15.000,0.000,2.500,2.500),
 (33,5,2,32,2,2.500,5.000,0.000,2.500,2.500),
 (34,5,3,33,4,2.500,10.000,0.000,2.500,2.500),
 (35,5,4,34,3,2.500,7.500,0.000,2.500,2.500),
 (36,5,5,35,10,2.500,25.000,0.000,2.500,2.500);
INSERT INTO `tab_proveedores_facturas_reng` (`id_fact_reng`,`id_factura_proveedor`,`nro_reglon`,`id_producto`,`cantidad`,`precio_unitario`,`precio_total`,`descuento`,`precio_unitario_desc`,`precio_costo`) VALUES 
 (37,5,6,36,12,2.500,30.000,0.000,2.500,2.500),
 (38,5,7,37,16,2.000,32.000,0.000,2.000,2.000),
 (39,5,8,38,60,1.500,90.000,0.000,1.500,1.500),
 (40,5,9,39,12,1.500,18.000,0.000,1.500,1.500),
 (41,5,10,40,16,1.500,24.000,0.000,1.500,1.500),
 (42,6,1,41,2,6.500,13.000,0.000,6.500,6.500),
 (43,6,2,42,4,7.000,28.000,0.000,7.000,7.000),
 (44,6,3,43,4,2.500,10.000,0.000,2.500,2.500),
 (45,6,4,44,4,2.500,10.000,0.000,2.500,2.500),
 (46,6,5,45,5,2.500,12.500,0.000,2.500,2.500),
 (47,6,6,47,6,2.500,15.000,0.000,2.500,2.500),
 (48,6,7,48,1,2.500,2.500,0.000,2.500,2.500),
 (49,6,8,49,4,2.500,10.000,0.000,2.500,2.500),
 (50,6,9,50,5,2.500,12.500,0.000,2.500,2.500),
 (51,6,10,51,7,2.500,17.500,0.000,2.500,2.500),
 (52,7,1,52,4,2.500,10.000,0.000,2.500,2.500),
 (53,7,2,53,7,2.500,17.500,0.000,2.500,2.500),
 (54,7,3,54,5,2.500,12.500,0.000,2.500,2.500);
INSERT INTO `tab_proveedores_facturas_reng` (`id_fact_reng`,`id_factura_proveedor`,`nro_reglon`,`id_producto`,`cantidad`,`precio_unitario`,`precio_total`,`descuento`,`precio_unitario_desc`,`precio_costo`) VALUES 
 (55,7,4,55,4,2.500,10.000,0.000,2.500,2.500),
 (56,7,5,56,11,2.500,27.500,0.000,2.500,2.500),
 (57,7,6,57,4,2.500,10.000,0.000,2.500,2.500),
 (58,7,7,58,6,2.500,15.000,0.000,2.500,2.500),
 (59,7,8,59,5,2.500,12.500,0.000,2.500,2.500),
 (60,7,9,60,50,1.000,50.000,0.000,1.000,1.000),
 (61,7,10,61,10,6.500,65.000,0.000,6.500,6.500),
 (62,8,1,62,8,2.000,16.000,0.000,2.000,2.000),
 (63,8,2,63,6,2.500,15.000,0.000,2.500,2.500),
 (64,8,3,64,8,3.000,24.000,0.000,3.000,3.000),
 (65,8,4,65,1,9.000,9.000,0.000,9.000,9.000),
 (66,8,5,66,4,5.000,20.000,0.000,5.000,5.000),
 (67,8,6,67,3,4.000,12.000,0.000,4.000,4.000),
 (68,8,7,68,4,12.000,48.000,0.000,12.000,12.000),
 (69,8,8,69,4,4.000,16.000,0.000,4.000,4.000),
 (70,8,9,71,6,7.500,45.000,0.000,7.500,7.500),
 (71,8,10,70,18,2.500,45.000,0.000,2.500,2.500),
 (72,9,1,72,2,18.000,36.000,0.000,18.000,18.000);
INSERT INTO `tab_proveedores_facturas_reng` (`id_fact_reng`,`id_factura_proveedor`,`nro_reglon`,`id_producto`,`cantidad`,`precio_unitario`,`precio_total`,`descuento`,`precio_unitario_desc`,`precio_costo`) VALUES 
 (73,9,2,73,2,18.000,36.000,0.000,18.000,18.000),
 (74,9,3,74,2,18.000,36.000,0.000,18.000,18.000),
 (75,9,4,75,8,2.500,20.000,0.000,2.500,2.500),
 (76,9,5,76,6,14.000,84.000,0.000,14.000,14.000),
 (77,9,6,77,1,6.000,6.000,0.000,6.000,6.000),
 (78,9,7,78,13,2.500,32.500,0.000,2.500,2.500),
 (79,9,8,79,8,7.500,60.000,0.000,7.500,7.500),
 (80,9,9,80,2,16.000,32.000,0.000,16.000,16.000),
 (81,9,10,81,1,17.000,17.000,0.000,17.000,17.000),
 (82,9,11,82,18,2.500,45.000,0.000,2.500,2.500),
 (83,9,12,83,26,5.000,130.000,0.000,5.000,5.000),
 (84,9,13,84,6,2.500,15.000,0.000,2.500,2.500),
 (85,9,14,85,90,1.500,135.000,0.000,1.500,1.500),
 (86,9,15,86,9,2.000,18.000,0.000,2.000,2.000),
 (87,9,16,87,24,1.500,36.000,0.000,1.500,1.500);
/*!40000 ALTER TABLE `tab_proveedores_facturas_reng` ENABLE KEYS */;


--
-- Table structure for table `venezon`.`tab_usuarios`
--

DROP TABLE IF EXISTS `tab_usuarios`;
CREATE TABLE `tab_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) DEFAULT NULL,
  `contrasena` varchar(20) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `estado` varchar(9) DEFAULT 'activo',
  `movimiento` varchar(2) DEFAULT 'no',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venezon`.`tab_usuarios`
--

/*!40000 ALTER TABLE `tab_usuarios` DISABLE KEYS */;
INSERT INTO `tab_usuarios` (`id_usuario`,`usuario`,`contrasena`,`nombre`,`rol`,`estado`,`movimiento`) VALUES 
 (3,'venezon','12345','Venezon','Administrador','activo','si'),
 (4,'carlo','12345','Carlo Julio','administrador','activo','no');
/*!40000 ALTER TABLE `tab_usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
