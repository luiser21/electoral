/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : electoral

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2014-03-08 13:20:15
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `boletines_departamentos`
-- ----------------------------
DROP TABLE IF EXISTS `boletines_departamentos`;
CREATE TABLE `boletines_departamentos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDDEPARTAMENTO` int(11) DEFAULT NULL,
  `MOVILIZADOS` int(11) DEFAULT NULL,
  `ZONA` varchar(300) DEFAULT NULL,
  `ENCARGADO` varchar(300) DEFAULT NULL,
  `VOTOS_REALES` int(11) DEFAULT NULL,
  `META` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of boletines_departamentos
-- ----------------------------
INSERT INTO boletines_departamentos VALUES ('1', '15', '0', 'ZONA 1', 'MELISSA MARTINEZ', '0', '3500');
INSERT INTO boletines_departamentos VALUES ('2', '30', '607', 'ZONA 1', 'MELISSA MARTINEZ', '0', '3500');
INSERT INTO boletines_departamentos VALUES ('3', '6', '0', 'ZONA 1', 'MELISSA MARTINEZ', '0', '3800');
INSERT INTO boletines_departamentos VALUES ('4', '4', '30', 'ZONA 1', 'MELISSA MARTINEZ', '0', '3500');
INSERT INTO boletines_departamentos VALUES ('5', '21', '594', 'ZONA 1', 'MELISSA MARTINEZ', '0', '4200');
INSERT INTO boletines_departamentos VALUES ('6', '20', '230', 'ZONA 1', 'MELISSA MARTINEZ', '0', '3500');
INSERT INTO boletines_departamentos VALUES ('7', '12', '138', 'ZONA 1', 'MELISSA MARTINEZ', '0', '4200');
INSERT INTO boletines_departamentos VALUES ('8', '2', '0', 'ZONA 2', 'ALEJANDRO FORERO', '0', '3500');
INSERT INTO boletines_departamentos VALUES ('9', '8', '850', 'ZONA 2', 'ALEJANDRO FORERO', '0', '3500');
INSERT INTO boletines_departamentos VALUES ('10', '27', '206', 'ZONA 2', 'ALEJANDRO FORERO', '0', '2500');
INSERT INTO boletines_departamentos VALUES ('11', '26', '0', 'ZONA 2', 'ALEJANDRO FORERO', '0', '1500');
INSERT INTO boletines_departamentos VALUES ('12', '13', '0', 'ZONA 2', 'ALEJANDRO FORERO', '0', '1600');
INSERT INTO boletines_departamentos VALUES ('13', '24', '781', 'ZONA 2', 'ALEJANDRO FORERO', '0', '4200');
INSERT INTO boletines_departamentos VALUES ('14', '29', '0', 'ZONA 2', 'ALEJANDRO FORERO', '0', '3500');
INSERT INTO boletines_departamentos VALUES ('15', '7', '400', 'ZONA 2', 'ALEJANDRO FORERO', '0', '3500');
INSERT INTO boletines_departamentos VALUES ('16', '31', '225', 'ZONA 3', 'ALEJANDRA DELGADO', '0', '3500');
INSERT INTO boletines_departamentos VALUES ('17', '19', '312', 'ZONA 3', 'ALEJANDRA DELGADO', '0', '1500');
INSERT INTO boletines_departamentos VALUES ('18', '9', '169', 'ZONA 3', 'ALEJANDRA DELGADO', '0', '3500');
INSERT INTO boletines_departamentos VALUES ('19', '25', '50', 'ZONA 3', 'ALEJANDRA DELGADO', '0', '1000');
INSERT INTO boletines_departamentos VALUES ('20', '32', '510', 'ZONA 3', 'ALEJANDRA DELGADO', '0', '4000');
INSERT INTO boletines_departamentos VALUES ('21', '11', '194', 'ZONA 3', 'ALEJANDRA DELGADO', '0', '3500');
INSERT INTO boletines_departamentos VALUES ('22', '36', '102', 'ZONA 3', 'ALEJANDRA DELGADO', '0', '1000');
INSERT INTO boletines_departamentos VALUES ('23', '23', '2700', 'ZONA 3', 'ALEJANDRA DELGADO', '0', '5500');
INSERT INTO boletines_departamentos VALUES ('24', '3', '376', 'ZONA 4', 'SANLY NIÑO', '0', '1000');
INSERT INTO boletines_departamentos VALUES ('25', '10', '106', 'ZONA 4', 'SANLY NIÑO', '0', '2000');
INSERT INTO boletines_departamentos VALUES ('26', '22', '82', 'ZONA 4', 'SANLY NIÑO', '0', '5500');
INSERT INTO boletines_departamentos VALUES ('27', '1', '50', 'ZONA 4', 'SANLY NIÑO', '0', '1000');
INSERT INTO boletines_departamentos VALUES ('28', '33', '0', 'ZONA 4', 'SANLY NIÑO', '0', null);
INSERT INTO boletines_departamentos VALUES ('29', '34', '0', 'ZONA 4', 'SANLY NIÑO', '0', null);
INSERT INTO boletines_departamentos VALUES ('30', '18', '0', 'ZONA 4', 'SANLY NIÑO', '0', '800');
INSERT INTO boletines_departamentos VALUES ('31', '17', '0', 'ZONA 4', 'SANLY NIÑO', '0', '50');
INSERT INTO boletines_departamentos VALUES ('32', '28', '0', 'ZONA 4', 'SANLY NIÑO', '0', '300');
INSERT INTO boletines_departamentos VALUES ('33', '16', '200', 'ZONA 5', 'EDGAR ABAUNZA', '0', '4200');
INSERT INTO boletines_departamentos VALUES ('34', '35', '610', 'ZONA 5', 'EDGAR ABAUNZA', '0', '10000');
