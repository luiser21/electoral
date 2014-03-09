/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : electoral

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2014-03-08 22:49:49
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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of boletines_departamentos
-- ----------------------------
INSERT INTO boletines_departamentos VALUES ('1', '15', '0', 'ZONA 1', 'MELISSA MARTINEZ');
INSERT INTO boletines_departamentos VALUES ('2', '30', '0', 'ZONA 1', 'MELISSA MARTINEZ');
INSERT INTO boletines_departamentos VALUES ('3', '6', '0', 'ZONA 1', 'MELISSA MARTINEZ');
INSERT INTO boletines_departamentos VALUES ('4', '4', '0', 'ZONA 1', 'MELISSA MARTINEZ');
INSERT INTO boletines_departamentos VALUES ('5', '21', '0', 'ZONA 1', 'MELISSA MARTINEZ');
INSERT INTO boletines_departamentos VALUES ('6', '20', '0', 'ZONA 1', 'MELISSA MARTINEZ');
INSERT INTO boletines_departamentos VALUES ('7', '12', '0', 'ZONA 1', 'MELISSA MARTINEZ');
INSERT INTO boletines_departamentos VALUES ('8', '2', '0', 'ZONA 2', 'ALEJANDRO FORERO');
INSERT INTO boletines_departamentos VALUES ('9', '8', '0', 'ZONA 2', 'ALEJANDRO FORERO');
INSERT INTO boletines_departamentos VALUES ('10', '27', '0', 'ZONA 2', 'ALEJANDRO FORERO');
INSERT INTO boletines_departamentos VALUES ('11', '26', '0', 'ZONA 2', 'ALEJANDRO FORERO');
INSERT INTO boletines_departamentos VALUES ('12', '13', '0', 'ZONA 2', 'ALEJANDRO FORERO');
INSERT INTO boletines_departamentos VALUES ('13', '24', '0', 'ZONA 2', 'ALEJANDRO FORERO');
INSERT INTO boletines_departamentos VALUES ('14', '29', '0', 'ZONA 2', 'ALEJANDRO FORERO');
INSERT INTO boletines_departamentos VALUES ('15', '7', '0', 'ZONA 2', 'ALEJANDRO FORERO');
INSERT INTO boletines_departamentos VALUES ('16', '31', '0', 'ZONA 3', 'ALEJANDRA DELGADO');
INSERT INTO boletines_departamentos VALUES ('17', '19', '0', 'ZONA 3', 'ALEJANDRA DELGADO');
INSERT INTO boletines_departamentos VALUES ('18', '9', '0', 'ZONA 3', 'ALEJANDRA DELGADO');
INSERT INTO boletines_departamentos VALUES ('19', '25', '0', 'ZONA 3', 'ALEJANDRA DELGADO');
INSERT INTO boletines_departamentos VALUES ('20', '32', '0', 'ZONA 3', 'ALEJANDRA DELGADO');
INSERT INTO boletines_departamentos VALUES ('21', '11', '0', 'ZONA 3', 'ALEJANDRA DELGADO');
INSERT INTO boletines_departamentos VALUES ('22', '36', '0', 'ZONA 3', 'ALEJANDRA DELGADO');
INSERT INTO boletines_departamentos VALUES ('23', '23', '0', 'ZONA 3', 'ALEJANDRA DELGADO');
INSERT INTO boletines_departamentos VALUES ('24', '3', '0', 'ZONA 4', 'SANLY NIÑO');
INSERT INTO boletines_departamentos VALUES ('25', '10', '0', 'ZONA 4', 'SANLY NIÑO');
INSERT INTO boletines_departamentos VALUES ('26', '22', '0', 'ZONA 4', 'SANLY NIÑO');
INSERT INTO boletines_departamentos VALUES ('27', '1', '0', 'ZONA 4', 'SANLY NIÑO');
INSERT INTO boletines_departamentos VALUES ('28', '33', '0', 'ZONA 4', 'SANLY NIÑO');
INSERT INTO boletines_departamentos VALUES ('29', '34', '0', 'ZONA 4', 'SANLY NIÑO');
INSERT INTO boletines_departamentos VALUES ('30', '18', '0', 'ZONA 4', 'SANLY NIÑO');
INSERT INTO boletines_departamentos VALUES ('31', '17', '0', 'ZONA 4', 'SANLY NIÑO');
INSERT INTO boletines_departamentos VALUES ('32', '28', '0', 'ZONA 4', 'SANLY NIÑO');
INSERT INTO boletines_departamentos VALUES ('33', '16', '0', 'ZONA 5', 'EDGAR ABAUNZA');
INSERT INTO boletines_departamentos VALUES ('34', '35', '0', 'ZONA 5', 'EDGAR ABAUNZA');
