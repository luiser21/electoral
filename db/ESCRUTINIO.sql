/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : electoral

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2014-03-08 13:19:57
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `escrutinio`
-- ----------------------------
DROP TABLE IF EXISTS `escrutinio`;
CREATE TABLE `escrutinio` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CURULES` int(11) DEFAULT NULL,
  `MESAS_INSTALADAS` int(11) DEFAULT NULL,
  `MESAS_INFORMADAS` int(11) DEFAULT NULL,
  `VOTOS_PARTIDO` int(11) DEFAULT NULL,
  `PORCENTAJE_PARTIDO` int(11) DEFAULT NULL,
  `VOTOS_U49` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of escrutinio
-- ----------------------------
INSERT INTO ESCRUTINIO VALUES ('1', '20', '25030', '34', '30000', '20', '5000');
