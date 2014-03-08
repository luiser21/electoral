/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : electoral

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2014-03-08 13:20:06
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `boletines`
-- ----------------------------
DROP TABLE IF EXISTS `boletines`;
CREATE TABLE `boletines` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `REPORTES` varchar(300) DEFAULT NULL,
  `HORA` varchar(100) DEFAULT NULL,
  `IDDEPARTAMENTO` int(11) DEFAULT NULL,
  `MOVILIZADOS` int(11) DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL,
  `ESTADO_DEPARTAMENTO` int(11) DEFAULT NULL,
  `HORA_REAL` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=239 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of boletines
-- ----------------------------
INSERT INTO boletines VALUES ('1', '1er REPORTE', '10am', '15', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('2', '2do REPORTE', '11am', '15', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('3', '3er REPORTE', '12pm', '15', '0', '2', '0', '12');
INSERT INTO boletines VALUES ('4', '4to REPORTE', '1pm', '15', '0', '1', '0', '13');
INSERT INTO boletines VALUES ('5', '5to REPORTE', '2pm', '15', '0', '0', '0', '14');
INSERT INTO boletines VALUES ('6', '6to REPORTE', '3pm', '15', '0', '0', '0', '15');
INSERT INTO boletines VALUES ('7', '7to REPORTE', '4pm', '15', '0', '0', '0', '16');
INSERT INTO boletines VALUES ('8', '1er REPORTE', '10am', '30', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('9', '2do REPORTE', '11am', '30', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('10', '3er REPORTE', '12pm', '30', '607', '2', '1', '12');
INSERT INTO boletines VALUES ('11', '4to REPORTE', '1pm', '30', '607', '1', '0', '13');
INSERT INTO boletines VALUES ('12', '5to REPORTE', '2pm', '30', '607', '0', '0', '14');
INSERT INTO boletines VALUES ('13', '6to REPORTE', '3pm', '30', '607', '0', '0', '15');
INSERT INTO boletines VALUES ('14', '7to REPORTE', '4pm', '30', '607', '0', '0', '16');
INSERT INTO boletines VALUES ('15', '1er REPORTE', '10am', '6', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('16', '2do REPORTE', '11am', '6', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('17', '3er REPORTE', '12pm', '6', '0', '2', '0', '12');
INSERT INTO boletines VALUES ('18', '4to REPORTE', '1pm', '6', '0', '1', '0', '13');
INSERT INTO boletines VALUES ('19', '5to REPORTE', '2pm', '6', '0', '0', '0', '14');
INSERT INTO boletines VALUES ('20', '6to REPORTE', '3pm', '6', '0', '0', '0', '15');
INSERT INTO boletines VALUES ('21', '7to REPORTE', '4pm', '6', '0', '0', '0', '16');
INSERT INTO boletines VALUES ('22', '1er REPORTE', '10am', '4', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('23', '2do REPORTE', '11am', '4', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('24', '3er REPORTE', '12pm', '4', '30', '2', '1', '12');
INSERT INTO boletines VALUES ('25', '4to REPORTE', '1pm', '4', '30', '1', '0', '13');
INSERT INTO boletines VALUES ('26', '5to REPORTE', '2pm', '4', '30', '0', '0', '14');
INSERT INTO boletines VALUES ('27', '6to REPORTE', '3pm', '4', '30', '0', '0', '15');
INSERT INTO boletines VALUES ('28', '7to REPORTE', '4pm', '4', '30', '0', '0', '16');
INSERT INTO boletines VALUES ('29', '1er REPORTE', '10am', '21', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('30', '2do REPORTE', '11am', '21', '594', '2', '1', '11');
INSERT INTO boletines VALUES ('31', '3er REPORTE', '12pm', '21', '594', '2', '0', '12');
INSERT INTO boletines VALUES ('32', '4to REPORTE', '1pm', '21', '594', '1', '0', '13');
INSERT INTO boletines VALUES ('33', '5to REPORTE', '2pm', '21', '594', '0', '0', '14');
INSERT INTO boletines VALUES ('34', '6to REPORTE', '3pm', '21', '594', '0', '0', '15');
INSERT INTO boletines VALUES ('35', '7to REPORTE', '4pm', '21', '594', '0', '0', '16');
INSERT INTO boletines VALUES ('36', '1er REPORTE', '10am', '20', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('37', '2do REPORTE', '11am', '20', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('38', '3er REPORTE', '12pm', '20', '230', '2', '1', '12');
INSERT INTO boletines VALUES ('39', '4to REPORTE', '1pm', '20', '230', '1', '0', '13');
INSERT INTO boletines VALUES ('40', '5to REPORTE', '2pm', '20', '230', '0', '0', '14');
INSERT INTO boletines VALUES ('41', '6to REPORTE', '3pm', '20', '230', '0', '0', '15');
INSERT INTO boletines VALUES ('42', '7to REPORTE', '4pm', '20', '230', '0', '0', '16');
INSERT INTO boletines VALUES ('43', '1er REPORTE', '10am', '12', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('44', '2do REPORTE', '11am', '12', '138', '2', '1', '11');
INSERT INTO boletines VALUES ('45', '3er REPORTE', '12pm', '12', '138', '2', '0', '12');
INSERT INTO boletines VALUES ('46', '4to REPORTE', '1pm', '12', '138', '1', '0', '13');
INSERT INTO boletines VALUES ('47', '5to REPORTE', '2pm', '12', '138', '0', '0', '14');
INSERT INTO boletines VALUES ('48', '6to REPORTE', '3pm', '12', '138', '0', '0', '15');
INSERT INTO boletines VALUES ('49', '7to REPORTE', '4pm', '12', '138', '0', '0', '16');
INSERT INTO boletines VALUES ('50', '1er REPORTE', '10am', '2', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('51', '2do REPORTE', '11am', '2', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('52', '3er REPORTE', '12pm', '2', '0', '2', '0', '12');
INSERT INTO boletines VALUES ('53', '4to REPORTE', '1pm', '2', '0', '1', '0', '13');
INSERT INTO boletines VALUES ('54', '5to REPORTE', '2pm', '2', '0', '0', '0', '14');
INSERT INTO boletines VALUES ('55', '6to REPORTE', '3pm', '2', '0', '0', '0', '15');
INSERT INTO boletines VALUES ('56', '7to REPORTE', '4pm', '2', '0', '0', '0', '16');
INSERT INTO boletines VALUES ('57', '1er REPORTE', '10am', '8', '250', '2', '1', '10');
INSERT INTO boletines VALUES ('58', '2do REPORTE', '11am', '8', '250', '2', '0', '11');
INSERT INTO boletines VALUES ('59', '3er REPORTE', '12pm', '8', '850', '2', '1', '12');
INSERT INTO boletines VALUES ('60', '4to REPORTE', '1pm', '8', '850', '1', '0', '13');
INSERT INTO boletines VALUES ('61', '5to REPORTE', '2pm', '8', '850', '0', '0', '14');
INSERT INTO boletines VALUES ('62', '6to REPORTE', '3pm', '8', '850', '0', '0', '15');
INSERT INTO boletines VALUES ('63', '7to REPORTE', '4pm', '8', '850', '0', '0', '16');
INSERT INTO boletines VALUES ('64', '1er REPORTE', '10am', '27', '206', '2', '1', '10');
INSERT INTO boletines VALUES ('65', '2do REPORTE', '11am', '27', '206', '2', '0', '11');
INSERT INTO boletines VALUES ('66', '3er REPORTE', '12pm', '27', '206', '2', '0', '12');
INSERT INTO boletines VALUES ('67', '4to REPORTE', '1pm', '27', '206', '1', '0', '13');
INSERT INTO boletines VALUES ('68', '5to REPORTE', '2pm', '27', '206', '0', '0', '14');
INSERT INTO boletines VALUES ('69', '6to REPORTE', '3pm', '27', '206', '0', '0', '15');
INSERT INTO boletines VALUES ('70', '7to REPORTE', '4pm', '27', '206', '0', '0', '16');
INSERT INTO boletines VALUES ('71', '1er REPORTE', '10am', '26', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('72', '2do REPORTE', '11am', '26', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('73', '3er REPORTE', '12pm', '26', '0', '2', '0', '12');
INSERT INTO boletines VALUES ('74', '4to REPORTE', '1pm', '26', '0', '1', '0', '13');
INSERT INTO boletines VALUES ('75', '5to REPORTE', '2pm', '26', '0', '0', '0', '14');
INSERT INTO boletines VALUES ('76', '6to REPORTE', '3pm', '26', '0', '0', '0', '15');
INSERT INTO boletines VALUES ('77', '7to REPORTE', '4pm', '26', '0', '0', '0', '16');
INSERT INTO boletines VALUES ('78', '1er REPORTE', '10am', '13', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('79', '2do REPORTE', '11am', '13', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('80', '3er REPORTE', '12pm', '13', '0', '2', '0', '12');
INSERT INTO boletines VALUES ('81', '4to REPORTE', '1pm', '13', '0', '1', '0', '13');
INSERT INTO boletines VALUES ('82', '5to REPORTE', '2pm', '13', '0', '0', '0', '14');
INSERT INTO boletines VALUES ('83', '6to REPORTE', '3pm', '13', '0', '0', '0', '15');
INSERT INTO boletines VALUES ('84', '7to REPORTE', '4pm', '13', '0', '0', '0', '16');
INSERT INTO boletines VALUES ('85', '1er REPORTE', '10am', '24', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('86', '2do REPORTE', '11am', '24', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('87', '3er REPORTE', '12pm', '24', '781', '2', '1', '12');
INSERT INTO boletines VALUES ('88', '4to REPORTE', '1pm', '24', '781', '1', '0', '13');
INSERT INTO boletines VALUES ('89', '5to REPORTE', '2pm', '24', '781', '0', '0', '14');
INSERT INTO boletines VALUES ('90', '6to REPORTE', '3pm', '24', '781', '0', '0', '15');
INSERT INTO boletines VALUES ('91', '7to REPORTE', '4pm', '24', '781', '0', '0', '16');
INSERT INTO boletines VALUES ('92', '1er REPORTE', '10am', '29', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('93', '2do REPORTE', '11am', '29', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('94', '3er REPORTE', '12pm', '29', '0', '2', '0', '12');
INSERT INTO boletines VALUES ('95', '4to REPORTE', '1pm', '29', '0', '1', '0', '13');
INSERT INTO boletines VALUES ('96', '5to REPORTE', '2pm', '29', '0', '0', '0', '14');
INSERT INTO boletines VALUES ('97', '6to REPORTE', '3pm', '29', '0', '0', '0', '15');
INSERT INTO boletines VALUES ('98', '7to REPORTE', '4pm', '29', '0', '0', '0', '16');
INSERT INTO boletines VALUES ('99', '1er REPORTE', '10am', '7', '100', '2', '1', '10');
INSERT INTO boletines VALUES ('100', '2do REPORTE', '11am', '7', '100', '2', '0', '11');
INSERT INTO boletines VALUES ('101', '3er REPORTE', '12pm', '7', '400', '2', '1', '12');
INSERT INTO boletines VALUES ('102', '4to REPORTE', '1pm', '7', '400', '1', '0', '13');
INSERT INTO boletines VALUES ('103', '5to REPORTE', '2pm', '7', '400', '0', '0', '14');
INSERT INTO boletines VALUES ('104', '6to REPORTE', '3pm', '7', '400', '0', '0', '15');
INSERT INTO boletines VALUES ('105', '7to REPORTE', '4pm', '7', '400', '0', '0', '16');
INSERT INTO boletines VALUES ('106', '1er REPORTE', '10am', '31', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('107', '2do REPORTE', '11am', '31', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('108', '3er REPORTE', '12pm', '31', '225', '2', '1', '12');
INSERT INTO boletines VALUES ('109', '4to REPORTE', '1pm', '31', '225', '1', '0', '13');
INSERT INTO boletines VALUES ('110', '5to REPORTE', '2pm', '31', '225', '0', '0', '14');
INSERT INTO boletines VALUES ('111', '6to REPORTE', '3pm', '31', '225', '0', '0', '15');
INSERT INTO boletines VALUES ('112', '7to REPORTE', '4pm', '31', '225', '0', '0', '16');
INSERT INTO boletines VALUES ('113', '1er REPORTE', '10am', '19', '20', '2', '1', '10');
INSERT INTO boletines VALUES ('114', '2do REPORTE', '11am', '19', '282', '2', '1', '11');
INSERT INTO boletines VALUES ('115', '3er REPORTE', '12pm', '19', '312', '2', '1', '12');
INSERT INTO boletines VALUES ('116', '4to REPORTE', '1pm', '19', '312', '1', '0', '13');
INSERT INTO boletines VALUES ('117', '5to REPORTE', '2pm', '19', '312', '0', '0', '14');
INSERT INTO boletines VALUES ('118', '6to REPORTE', '3pm', '19', '312', '0', '0', '15');
INSERT INTO boletines VALUES ('119', '7to REPORTE', '4pm', '19', '312', '0', '0', '16');
INSERT INTO boletines VALUES ('120', '1er REPORTE', '10am', '9', '82', '2', '1', '10');
INSERT INTO boletines VALUES ('121', '2do REPORTE', '11am', '9', '82', '2', '0', '11');
INSERT INTO boletines VALUES ('122', '3er REPORTE', '12pm', '9', '150', '2', '1', '12');
INSERT INTO boletines VALUES ('123', '4to REPORTE', '1pm', '9', '169', '1', '1', '13');
INSERT INTO boletines VALUES ('124', '5to REPORTE', '2pm', '9', '169', '0', '0', '14');
INSERT INTO boletines VALUES ('125', '6to REPORTE', '3pm', '9', '169', '0', '0', '15');
INSERT INTO boletines VALUES ('126', '7to REPORTE', '4pm', '9', '169', '0', '0', '16');
INSERT INTO boletines VALUES ('127', '1er REPORTE', '10am', '25', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('128', '2do REPORTE', '11am', '25', '50', '2', '1', '11');
INSERT INTO boletines VALUES ('129', '3er REPORTE', '12pm', '25', '50', '2', '0', '12');
INSERT INTO boletines VALUES ('130', '4to REPORTE', '1pm', '25', '50', '1', '0', '13');
INSERT INTO boletines VALUES ('131', '5to REPORTE', '2pm', '25', '50', '0', '0', '14');
INSERT INTO boletines VALUES ('132', '6to REPORTE', '3pm', '25', '50', '0', '0', '15');
INSERT INTO boletines VALUES ('133', '7to REPORTE', '4pm', '25', '50', '0', '0', '16');
INSERT INTO boletines VALUES ('134', '1er REPORTE', '10am', '32', '70', '2', '1', '10');
INSERT INTO boletines VALUES ('135', '2do REPORTE', '11am', '32', '70', '2', '0', '11');
INSERT INTO boletines VALUES ('136', '3er REPORTE', '12pm', '32', '510', '2', '1', '12');
INSERT INTO boletines VALUES ('137', '4to REPORTE', '1pm', '32', '510', '1', '0', '13');
INSERT INTO boletines VALUES ('138', '5to REPORTE', '2pm', '32', '510', '0', '0', '14');
INSERT INTO boletines VALUES ('139', '6to REPORTE', '3pm', '32', '510', '0', '0', '15');
INSERT INTO boletines VALUES ('140', '7to REPORTE', '4pm', '32', '510', '0', '0', '16');
INSERT INTO boletines VALUES ('141', '1er REPORTE', '10am', '11', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('142', '2do REPORTE', '11am', '11', '139', '2', '1', '11');
INSERT INTO boletines VALUES ('143', '3er REPORTE', '12pm', '11', '194', '2', '1', '12');
INSERT INTO boletines VALUES ('144', '4to REPORTE', '1pm', '11', '194', '1', '0', '13');
INSERT INTO boletines VALUES ('145', '5to REPORTE', '2pm', '11', '194', '0', '0', '14');
INSERT INTO boletines VALUES ('146', '6to REPORTE', '3pm', '11', '194', '0', '0', '15');
INSERT INTO boletines VALUES ('147', '7to REPORTE', '4pm', '11', '194', '0', '0', '16');
INSERT INTO boletines VALUES ('148', '1er REPORTE', '10am', '36', '65', '2', '1', '10');
INSERT INTO boletines VALUES ('149', '2do REPORTE', '11am', '36', '65', '2', '0', '11');
INSERT INTO boletines VALUES ('150', '3er REPORTE', '12pm', '36', '102', '2', '1', '12');
INSERT INTO boletines VALUES ('151', '4to REPORTE', '1pm', '36', '102', '1', '0', '13');
INSERT INTO boletines VALUES ('152', '5to REPORTE', '2pm', '36', '102', '0', '0', '14');
INSERT INTO boletines VALUES ('153', '6to REPORTE', '3pm', '36', '102', '0', '0', '15');
INSERT INTO boletines VALUES ('154', '7to REPORTE', '4pm', '36', '102', '0', '0', '16');
INSERT INTO boletines VALUES ('155', '1er REPORTE', '10am', '23', '2100', '2', '1', '10');
INSERT INTO boletines VALUES ('156', '2do REPORTE', '11am', '23', '2100', '2', '0', '11');
INSERT INTO boletines VALUES ('157', '3er REPORTE', '12pm', '23', '2406', '2', '1', '12');
INSERT INTO boletines VALUES ('158', '4to REPORTE', '1pm', '23', '2700', '1', '1', '13');
INSERT INTO boletines VALUES ('159', '5to REPORTE', '2pm', '23', '2700', '0', '0', '14');
INSERT INTO boletines VALUES ('160', '6to REPORTE', '3pm', '23', '2700', '0', '0', '15');
INSERT INTO boletines VALUES ('161', '7to REPORTE', '4pm', '23', '2700', '0', '0', '16');
INSERT INTO boletines VALUES ('162', '1er REPORTE', '10am', '3', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('163', '2do REPORTE', '11am', '3', '70', '2', '1', '11');
INSERT INTO boletines VALUES ('164', '3er REPORTE', '12pm', '3', '376', '2', '1', '12');
INSERT INTO boletines VALUES ('165', '4to REPORTE', '1pm', '3', '376', '1', '0', '13');
INSERT INTO boletines VALUES ('166', '5to REPORTE', '2pm', '3', '376', '0', '0', '14');
INSERT INTO boletines VALUES ('167', '6to REPORTE', '3pm', '3', '376', '0', '0', '15');
INSERT INTO boletines VALUES ('168', '7to REPORTE', '4pm', '3', '376', '0', '0', '16');
INSERT INTO boletines VALUES ('169', '1er REPORTE', '10am', '10', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('170', '2do REPORTE', '11am', '10', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('171', '3er REPORTE', '12pm', '10', '106', '2', '1', '12');
INSERT INTO boletines VALUES ('172', '4to REPORTE', '1pm', '10', '106', '1', '0', '13');
INSERT INTO boletines VALUES ('173', '5to REPORTE', '2pm', '10', '106', '0', '0', '14');
INSERT INTO boletines VALUES ('174', '6to REPORTE', '3pm', '10', '106', '0', '0', '15');
INSERT INTO boletines VALUES ('175', '7to REPORTE', '4pm', '10', '106', '0', '0', '16');
INSERT INTO boletines VALUES ('176', '1er REPORTE', '10am', '22', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('177', '2do REPORTE', '11am', '22', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('178', '3er REPORTE', '12pm', '22', '82', '2', '1', '12');
INSERT INTO boletines VALUES ('179', '4to REPORTE', '1pm', '22', '82', '1', '0', '13');
INSERT INTO boletines VALUES ('180', '5to REPORTE', '2pm', '22', '82', '0', '0', '14');
INSERT INTO boletines VALUES ('181', '6to REPORTE', '3pm', '22', '82', '0', '0', '15');
INSERT INTO boletines VALUES ('182', '7to REPORTE', '4pm', '22', '82', '0', '0', '16');
INSERT INTO boletines VALUES ('183', '1er REPORTE', '10am', '1', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('184', '2do REPORTE', '11am', '1', '50', '2', '1', '11');
INSERT INTO boletines VALUES ('185', '3er REPORTE', '12pm', '1', '50', '2', '0', '12');
INSERT INTO boletines VALUES ('186', '4to REPORTE', '1pm', '1', '50', '1', '0', '13');
INSERT INTO boletines VALUES ('187', '5to REPORTE', '2pm', '1', '50', '0', '0', '14');
INSERT INTO boletines VALUES ('188', '6to REPORTE', '3pm', '1', '50', '0', '0', '15');
INSERT INTO boletines VALUES ('189', '7to REPORTE', '4pm', '1', '50', '0', '0', '16');
INSERT INTO boletines VALUES ('190', '1er REPORTE', '10am', '33', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('191', '2do REPORTE', '11am', '33', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('192', '3er REPORTE', '12pm', '33', '0', '2', '0', '12');
INSERT INTO boletines VALUES ('193', '4to REPORTE', '1pm', '33', '0', '1', '0', '13');
INSERT INTO boletines VALUES ('194', '5to REPORTE', '2pm', '33', '0', '0', '0', '14');
INSERT INTO boletines VALUES ('195', '6to REPORTE', '3pm', '33', '0', '0', '0', '15');
INSERT INTO boletines VALUES ('196', '7to REPORTE', '4pm', '33', '0', '0', '0', '16');
INSERT INTO boletines VALUES ('197', '1er REPORTE', '10am', '34', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('198', '2do REPORTE', '11am', '34', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('199', '3er REPORTE', '12pm', '34', '0', '2', '0', '12');
INSERT INTO boletines VALUES ('200', '4to REPORTE', '1pm', '34', '0', '1', '0', '13');
INSERT INTO boletines VALUES ('201', '5to REPORTE', '2pm', '34', '0', '0', '0', '14');
INSERT INTO boletines VALUES ('202', '6to REPORTE', '3pm', '34', '0', '0', '0', '15');
INSERT INTO boletines VALUES ('203', '7to REPORTE', '4pm', '34', '0', '0', '0', '16');
INSERT INTO boletines VALUES ('204', '1er REPORTE', '10am', '18', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('205', '2do REPORTE', '11am', '18', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('206', '3er REPORTE', '12pm', '18', '0', '2', '0', '12');
INSERT INTO boletines VALUES ('207', '4to REPORTE', '1pm', '18', '0', '1', '0', '13');
INSERT INTO boletines VALUES ('208', '5to REPORTE', '2pm', '18', '0', '0', '0', '14');
INSERT INTO boletines VALUES ('209', '6to REPORTE', '3pm', '18', '0', '0', '0', '15');
INSERT INTO boletines VALUES ('210', '7to REPORTE', '4pm', '18', '0', '0', '0', '16');
INSERT INTO boletines VALUES ('211', '1er REPORTE', '10am', '17', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('212', '2do REPORTE', '11am', '17', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('213', '3er REPORTE', '12pm', '17', '0', '2', '0', '12');
INSERT INTO boletines VALUES ('214', '4to REPORTE', '1pm', '17', '0', '1', '0', '13');
INSERT INTO boletines VALUES ('215', '5to REPORTE', '2pm', '17', '0', '0', '0', '14');
INSERT INTO boletines VALUES ('216', '6to REPORTE', '3pm', '17', '0', '0', '0', '15');
INSERT INTO boletines VALUES ('217', '7to REPORTE', '4pm', '17', '0', '0', '0', '16');
INSERT INTO boletines VALUES ('218', '1er REPORTE', '10am', '28', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('219', '2do REPORTE', '11am', '28', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('220', '3er REPORTE', '12pm', '28', '0', '2', '0', '12');
INSERT INTO boletines VALUES ('221', '4to REPORTE', '1pm', '28', '0', '1', '0', '13');
INSERT INTO boletines VALUES ('222', '5to REPORTE', '2pm', '28', '0', '0', '0', '14');
INSERT INTO boletines VALUES ('223', '6to REPORTE', '3pm', '28', '0', '0', '0', '15');
INSERT INTO boletines VALUES ('224', '7to REPORTE', '4pm', '28', '0', '0', '0', '16');
INSERT INTO boletines VALUES ('225', '1er REPORTE', '10am', '16', '0', '2', '0', '10');
INSERT INTO boletines VALUES ('226', '2do REPORTE', '11am', '16', '0', '2', '0', '11');
INSERT INTO boletines VALUES ('227', '3er REPORTE', '12pm', '16', '20', '2', '1', '12');
INSERT INTO boletines VALUES ('228', '4to REPORTE', '1pm', '16', '200', '1', '1', '13');
INSERT INTO boletines VALUES ('229', '5to REPORTE', '2pm', '16', '200', '0', '0', '14');
INSERT INTO boletines VALUES ('230', '6to REPORTE', '3pm', '16', '200', '0', '0', '15');
INSERT INTO boletines VALUES ('231', '7to REPORTE', '4pm', '16', '200', '0', '0', '16');
INSERT INTO boletines VALUES ('232', '1er REPORTE', '10am', '35', '7', '2', '1', '10');
INSERT INTO boletines VALUES ('233', '2do REPORTE', '11am', '35', '8', '2', '1', '11');
INSERT INTO boletines VALUES ('234', '3er REPORTE', '12pm', '35', '400', '2', '1', '12');
INSERT INTO boletines VALUES ('235', '4to REPORTE', '1pm', '35', '604', '1', '1', '13');
INSERT INTO boletines VALUES ('236', '5to REPORTE', '2pm', '35', '604', '0', '0', '14');
INSERT INTO boletines VALUES ('237', '6to REPORTE', '3pm', '35', '604', '0', '0', '15');
INSERT INTO boletines VALUES ('238', '7to REPORTE', '4pm', '35', '604', '0', '0', '16');
