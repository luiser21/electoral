/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : electoral

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-06-04 16:37:10
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `candidato`
-- ----------------------------
DROP TABLE IF EXISTS `candidato`;
CREATE TABLE `candidato` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `NOMBRES` varchar(255) DEFAULT NULL,
  `APELLIDOS` varchar(255) DEFAULT NULL,
  `CEDULA` decimal(10,0) DEFAULT NULL,
  `DIRECCION` varchar(255) DEFAULT NULL,
  `MUNICIPIO` bigint(20) DEFAULT NULL,
  `TELEFONO` decimal(10,0) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `FECHANACIMIENTO` date DEFAULT NULL,
  `TIPOCANDIDATO` bigint(20) DEFAULT NULL,
  `NTARJETON` decimal(10,0) DEFAULT NULL,
  `PARTIDO` bigint(20) DEFAULT NULL,
  `IDUSUARIO` bigint(20) DEFAULT NULL,
  `IDPUESTOSVOTACION` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of candidato
-- ----------------------------
INSERT INTO candidato VALUES ('1', 'MANUEL GUILLERMO', 'CARDENAS', '1126418237', 'CALLE 6 N7-87', null, null, null, '2013-06-04', '5', null, '1', null, null);
INSERT INTO candidato VALUES ('8', 'luis', 'carvajal', '245235', 'calle 6 carrera 78', null, null, 'luis@hotmail.com', '2013-05-02', '2', null, '7', null, null);

-- ----------------------------
-- Table structure for `circunscripcion_electoral`
-- ----------------------------
DROP TABLE IF EXISTS `circunscripcion_electoral`;
CREATE TABLE `circunscripcion_electoral` (
  `ID` decimal(10,0) NOT NULL DEFAULT '0',
  `DESCRIPCION` varchar(255) DEFAULT NULL,
  `VOTOS` varchar(255) DEFAULT NULL,
  `PARTICIPACION` varchar(255) DEFAULT NULL,
  `ELECCIONES` decimal(10,0) DEFAULT NULL,
  `TIPO` decimal(10,0) DEFAULT NULL,
  `INDIGENA` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of circunscripcion_electoral
-- ----------------------------
INSERT INTO circunscripcion_electoral VALUES ('1', 'Mesas Instaladas', '76.940', '100%', '2010', '5', '0');
INSERT INTO circunscripcion_electoral VALUES ('2', 'Mesas Reportadas', '72.190', '93.83%', '2010', '5', '0');
INSERT INTO circunscripcion_electoral VALUES ('3', 'Potencial Votación', '29.852.099', '---', '2010', '5', '0');
INSERT INTO circunscripcion_electoral VALUES ('4', 'Total Votos', '13.014.692', '100%', '2010', '5', '0');
INSERT INTO circunscripcion_electoral VALUES ('5', 'Votos Nulos', '1,403,913', '10.79%', '2010', '5', '0');
INSERT INTO circunscripcion_electoral VALUES ('6', 'Tarjetas No Marcadas', '473,351', '3.64%', '2010', '5', '0');
INSERT INTO circunscripcion_electoral VALUES ('7', 'Votos Válidos', '11,137,428', '85.58%', '2010', '5', '0');
INSERT INTO circunscripcion_electoral VALUES ('8', 'Votos en Blanco', '391,456', '3.01%', '2010', '5', '0');
INSERT INTO circunscripcion_electoral VALUES ('9', 'Votos por Partidos', '10,745,972', '82.57%', '2010', '5', '0');
INSERT INTO circunscripcion_electoral VALUES ('10', 'Mesas Instaladas', '76,940', '100%', '2010', '5', '1');
INSERT INTO circunscripcion_electoral VALUES ('11', 'Mesas Reportadas', '72,190', '93.83%', '2010', '5', '1');
INSERT INTO circunscripcion_electoral VALUES ('12', 'Potencial Votación', '29,852,099', '---', '2010', '5', '1');
INSERT INTO circunscripcion_electoral VALUES ('13', 'Total Votos', '189,070', '100%', '2010', '5', '1');
INSERT INTO circunscripcion_electoral VALUES ('14', 'Votos Nulos', '0', '0.00%', '2010', '5', '1');
INSERT INTO circunscripcion_electoral VALUES ('15', 'Tarjetas No Marcadas', '0', '0.00%', '2010', '5', '1');
INSERT INTO circunscripcion_electoral VALUES ('16', 'Votos Válidos', '189,070', '100%', '2010', '5', '1');
INSERT INTO circunscripcion_electoral VALUES ('17', 'Votos en Blanco', '83,835', '44.34%', '2010', '5', '1');
INSERT INTO circunscripcion_electoral VALUES ('18', 'Votos por Partidos', '105,235', '55.66%', '2010', '5', '1');
INSERT INTO circunscripcion_electoral VALUES ('19', 'Mesas Instaladas', '76,940', '100%', '2010', '6', '0');
INSERT INTO circunscripcion_electoral VALUES ('20', 'Mesas Reportadas', '72,298', '93.97%', '2010', '6', '0');

-- ----------------------------
-- Table structure for `departamentos`
-- ----------------------------
DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE `departamentos` (
  `IDDEPARTAMENTO` bigint(100) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IDDEPARTAMENTO`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of departamentos
-- ----------------------------
INSERT INTO departamentos VALUES ('1', 'AMAZONAS');
INSERT INTO departamentos VALUES ('2', 'ANTIOQUIA');
INSERT INTO departamentos VALUES ('3', 'ARAUCA');
INSERT INTO departamentos VALUES ('4', 'ATLANTICO');
INSERT INTO departamentos VALUES ('5', 'BOGOTA D.C.');
INSERT INTO departamentos VALUES ('6', 'BOLIVAR');
INSERT INTO departamentos VALUES ('7', 'BOYACA');
INSERT INTO departamentos VALUES ('8', 'CALDAS');
INSERT INTO departamentos VALUES ('9', 'CAQUETA');
INSERT INTO departamentos VALUES ('10', 'CASANARE');
INSERT INTO departamentos VALUES ('11', 'CAUCA');
INSERT INTO departamentos VALUES ('12', 'CESAR');
INSERT INTO departamentos VALUES ('13', 'CHOCO');
INSERT INTO departamentos VALUES ('14', 'CONSULADOS');
INSERT INTO departamentos VALUES ('15', 'CORDOBA');
INSERT INTO departamentos VALUES ('16', 'CUNDINAMARCA');
INSERT INTO departamentos VALUES ('17', 'GUAINIA');
INSERT INTO departamentos VALUES ('18', 'GUAVIARE');
INSERT INTO departamentos VALUES ('19', 'HUILA');
INSERT INTO departamentos VALUES ('20', 'LA GUAJIRA');
INSERT INTO departamentos VALUES ('21', 'MAGDALENA');
INSERT INTO departamentos VALUES ('22', 'META');
INSERT INTO departamentos VALUES ('23', 'NARIСO');
INSERT INTO departamentos VALUES ('24', 'NORTE DE SANTANDER');
INSERT INTO departamentos VALUES ('25', 'PUTUMAYO');
INSERT INTO departamentos VALUES ('26', 'QUINDIO');
INSERT INTO departamentos VALUES ('27', 'RISARALDA');
INSERT INTO departamentos VALUES ('28', 'SAN ANDRES Y PROVIDENCIA');
INSERT INTO departamentos VALUES ('29', 'SANTANDER');
INSERT INTO departamentos VALUES ('30', 'SUCRE');
INSERT INTO departamentos VALUES ('31', 'TOLIMA');
INSERT INTO departamentos VALUES ('32', 'VALLE');
INSERT INTO departamentos VALUES ('33', 'VAUPES');
INSERT INTO departamentos VALUES ('34', 'VICHADA');

-- ----------------------------
-- Table structure for `elecciones_senado`
-- ----------------------------
DROP TABLE IF EXISTS `elecciones_senado`;
CREATE TABLE `elecciones_senado` (
  `IDPARTIDO` decimal(10,0) DEFAULT NULL,
  `VOTOS` varchar(255) DEFAULT NULL,
  `PARTICIPACION` varchar(255) DEFAULT NULL,
  `ELECCIONES` decimal(10,0) DEFAULT NULL,
  `TIPO` decimal(10,0) DEFAULT NULL,
  `INDIGENA` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of elecciones_senado
-- ----------------------------
INSERT INTO elecciones_senado VALUES ('1', '2.804.123', '25.18%', '2010', '5', '0');
INSERT INTO elecciones_senado VALUES ('2', '2.298.748', '20.64%', '2010', '5', '0');
INSERT INTO elecciones_senado VALUES ('3', '1.763.908', '15.84%', '2010', '5', '0');
INSERT INTO elecciones_senado VALUES ('4', '907.468', '8.15%', '2010', '5', '0');
INSERT INTO elecciones_senado VALUES ('5', '888.851', '7.98%', '2010', '5', '0');
INSERT INTO elecciones_senado VALUES ('6', '848.905', '7.62%', '2010', '5', '0');
INSERT INTO elecciones_senado VALUES ('7', '531.293', '4.77%', '2010', '5', '0');
INSERT INTO elecciones_senado VALUES ('8', '298.862', '2.68%', '2010', '5', '0');
INSERT INTO elecciones_senado VALUES ('17', '182.826', '1.64%', '2010', '5', '0');
INSERT INTO elecciones_senado VALUES ('13', '95.157', '0.85%', '2010', '5', '0');
INSERT INTO elecciones_senado VALUES ('15', '60.922', '0.55%', '2010', '5', '0');
INSERT INTO elecciones_senado VALUES ('14', '37.245', '0.33%', '2010', '5', '0');
INSERT INTO elecciones_senado VALUES ('18', '15.897', '0.14%', '2010', '5', '0');
INSERT INTO elecciones_senado VALUES ('16', '11.767', '0.11%', '2010', '5', '0');
INSERT INTO elecciones_senado VALUES ('9', '26.428', '13.98%', '2010', '5', '1');
INSERT INTO elecciones_senado VALUES ('10', '23.809', '12.59%', '2010', '5', '1');
INSERT INTO elecciones_senado VALUES ('4', '20.887', '11.05%', '2010', '5', '1');
INSERT INTO elecciones_senado VALUES ('19', '20.445', '10.81%', '2010', '5', '1');
INSERT INTO elecciones_senado VALUES ('6', '13.666', '7.23%', '2010', '5', '1');

-- ----------------------------
-- Table structure for `eleccions_camara_departamento`
-- ----------------------------
DROP TABLE IF EXISTS `eleccions_camara_departamento`;
CREATE TABLE `eleccions_camara_departamento` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `IDDEPARTAMENTO` bigint(20) DEFAULT NULL,
  `MESAS` varchar(255) DEFAULT NULL,
  `MESAS_PROCESADAS` varchar(255) DEFAULT NULL,
  `ELECCION` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of eleccions_camara_departamento
-- ----------------------------
INSERT INTO eleccions_camara_departamento VALUES ('1', '1', '102', '102', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('2', '2', '9,575', '8,962', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('3', '3', '384', '365', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('4', '4', '3,938', '3,618', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('5', '5', '11,009', '10,336', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('6', '6', '3,399', '3,177', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('7', '7', '2,248', '2,218', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('8', '8', '1,899', '1,876', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('9', '9', '646', '633', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('10', '10', '557', '557', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('11', '11', '2,310', '2,205', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('12', '12', '1,626', '1,570', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('13', '13', '823', '654', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('14', '14', '1,149', '476', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('15', '15', '2,735', '2,457', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('16', '16', '3,814', '3,738', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('17', '17', '58', '56', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('18', '18', '136', '136', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('19', '19', '1,707', '1,692', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('20', '20', '1,174', '1,097', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('21', '21', '2,028', '1,766', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('22', '22', '1,381', '1,372', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('23', '23', '2,808', '2,565', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('24', '24', '2,490', '2,401', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('25', '25', '488', '476', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('26', '26', '1,040', '1,037', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('27', '27', '1,682', '1,671', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('28', '28', '108', '108', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('29', '29', '3,854', '3,748', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('30', '30', '1,566', '1,489', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('31', '31', '2,449', '2,346', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('32', '32', '7,593', '7,265', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('33', '33', '54', '52', '2010');
INSERT INTO eleccions_camara_departamento VALUES ('34', '34', '110', '77', '2010');

-- ----------------------------
-- Table structure for `partidos_politicos`
-- ----------------------------
DROP TABLE IF EXISTS `partidos_politicos`;
CREATE TABLE `partidos_politicos` (
  `IDPARTIDO` decimal(10,0) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  `NOMBRECORTO` varchar(255) DEFAULT NULL,
  `FUNDACION` varchar(255) DEFAULT NULL,
  `POSICIOGOBIERNO` varchar(255) DEFAULT NULL,
  `NUMEROSENADORES` decimal(10,0) DEFAULT NULL,
  `NUMEROREPRESENTANTES` decimal(10,0) DEFAULT NULL,
  `DIRECTOR` varchar(255) DEFAULT NULL,
  `LOGO` varchar(255) DEFAULT NULL,
  `CREADO` datetime DEFAULT NULL,
  `MODIFICADO` datetime DEFAULT NULL,
  `PAGINAWEB` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IDPARTIDO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of partidos_politicos
-- ----------------------------
INSERT INTO partidos_politicos VALUES ('1', 'Partido Social de Unidad Nacional (Partido de la U)', 'Partido de la U', '2005', 'Gobierno', '28', '47', 'Juan Lozano Ramírez', 'images/partidos/LogoPartidoDeLaU.jpg', '2013-05-10 12:37:22', '2013-05-10 14:49:49', 'www.partidodelau.com');
INSERT INTO partidos_politicos VALUES ('2', 'Partido Conservador Colombiano', 'Partido Conservador', '1984', 'Coalición de gobierno', '2', '37', 'Efraín Cepeda', 'images/partidos/Part.conservador.png', '2013-05-10 12:38:16', '2013-05-10 14:49:51', 'www.partidoconservador.org');
INSERT INTO partidos_politicos VALUES ('3', 'Partido Liberal Colombiano', 'Partido Liberal', '1848', 'Coalición de gobierno', '17', '36', 'Simón Gaviria', 'images/partidos/PartidoLiberalColombiano.gif', '2013-05-10 12:38:51', '2013-05-10 14:49:54', 'www.partidoliberalcolombiano.info');
INSERT INTO partidos_politicos VALUES ('4', 'Partido de Integración Nacional (PIN)', 'PIN', '2009', 'Independencia', '9', '12', 'Ángel Alirio Moreno', 'images/partidos/Pin789.jpg', '2013-05-10 12:39:26', '2013-05-10 14:49:57', 'www.facebook.com/PIN-Partido-de-Integracion-Nacional');
INSERT INTO partidos_politicos VALUES ('5', 'Partido Cambio Radical', 'Cambio Radical', '1998', 'Coalición de gobierno', '8', '16', 'Carlos Fernando Galán', 'images/partidos/Cambio_Radical_logo.svg.png', '2013-05-10 12:40:25', '2013-05-10 14:49:59', 'www.partidocambioradical.org');
INSERT INTO partidos_politicos VALUES ('6', 'Polo Democrático Alternativo (PDA)', 'POLO', '2005', 'Oposición', '8', '5', 'Clara López Obregón', 'images/partidos/45px-PDA_Logo.svg.png', '2013-05-10 12:41:06', '2013-05-10 14:50:16', 'www.polodemocratico.net');
INSERT INTO partidos_politicos VALUES ('7', 'Partido Verde', 'Partido Verde', '2009', 'Coalición de gobierno', '5', '3', 'Luis Eduardo Garzón', 'images/partidos/Partver.jpg', '2013-05-10 12:41:44', '2013-05-10 14:50:02', 'www.partidoverde.org.co');
INSERT INTO partidos_politicos VALUES ('8', 'Movimiento Independiente de Renovación Absoluta (MIRA)', 'MIRA', '2000', 'Independencia', '3', '1', 'Carlos Alberto Baena', 'images/partidos/45px-Movimiento_mira.svg.png', '2013-05-10 12:42:18', '2013-05-10 14:50:04', 'www.webmira.com');
INSERT INTO partidos_politicos VALUES ('9', 'Alianza Social Independiente', 'Alianza Social Independiente', '1991', 'Centroizquierda', '1', '1', 'Alonso Tobón', 'images/partidos/35px-ASI_Logo.svg.png', '2013-05-10 12:42:56', '2013-05-10 14:50:06', 'www.asicolombia.com');
INSERT INTO partidos_politicos VALUES ('10', 'Autoridades Indígenas de Colombia', 'Autoridades Indígenas de Colombia', '1990', 'Centroizquierda', '1', '0', 'Luis Humberto Cuaspud', 'images/partidos/images2.jpg', '2013-05-10 12:43:10', '2013-05-10 14:50:09', 'http://www.aicocolombia.org/');
INSERT INTO partidos_politicos VALUES ('11', 'Movimiento Afrovides', 'Movimiento Afrovides', '2010', 'Independencia', '0', '1', 'Sixto Manuel Garcia Mejia', 'images/partidos/indice.jpg', '2013-05-10 12:43:31', '2013-05-10 14:50:11', 'http://pwp.etb.net.co/melendezarturoj/Afrovides/');
INSERT INTO partidos_politicos VALUES ('12', 'Movimiento de Inclusión y Oportunidades', 'Movimiento de Inclusión y Oportunidades', '2011', 'Independencia', '0', '1', 'Heriberto Arrechea Banguera', 'images/partidos/images.jpg', '2013-05-10 12:43:47', '2013-05-10 14:50:13', 'http://www.movimientomio.org/');
INSERT INTO partidos_politicos VALUES ('13', 'Apertura Liberal', 'Apertura Liberal', '1993', 'Independencia', null, null, 'Miguel Ángel Flores Rivera', 'images/partidos/untitled4.png', '2013-05-11 10:44:29', '2013-05-11 10:44:29', 'www.aperturaliberal.com');
INSERT INTO partidos_politicos VALUES ('14', 'Alternativa Liberal de Avanzada Social (Partido Alas)', 'Partido Alas', '2005', 'Independencia', null, null, 'Álvaro Araujo Noguera', 'images/partidos/ALAS_EQUIPO_COLOMBIA.jpg', '2013-05-11 10:44:29', '2013-05-11 10:44:29', 'www.partidoalas.com');
INSERT INTO partidos_politicos VALUES ('15', 'Partido Cristiano de Transformación y Orden', 'P. Cristiano de Transformación y Orden', '2007', 'Independencia', null, null, null, null, '2013-05-11 10:44:29', '2013-05-11 10:44:29', 'www.pactonacion.org/index2.html');
INSERT INTO partidos_politicos VALUES ('16', 'Alianza Social Afrocolombiana ASA', 'ASA', '2009', 'Independencia', null, null, 'María Isabel Urrutia', 'images/partidos/untitled.png', '2013-05-11 10:44:29', '2013-05-11 10:44:29', null);
INSERT INTO partidos_politicos VALUES ('17', 'Partido Compromiso Ciudadano por Colombia', 'P. Compromiso Ciudadano por Colombia', '1999', 'Independencia', null, null, 'Carolina Urrutia', 'images/partidos/untitled5.png', '2013-05-11 10:44:29', '2013-05-11 10:44:29', null);
INSERT INTO partidos_politicos VALUES ('18', 'Partido de Integración Social (PAIS)', 'PAIS', null, 'Independencia', null, null, null, 'images/partidos/untitled2.png', '2013-05-11 10:44:29', '2013-05-11 10:44:29', null);
INSERT INTO partidos_politicos VALUES ('19', 'Movimiento Social Indígena', 'Movimiento Social Indígena', null, 'Independencia', '0', null, '', 'images/partidos/untitled3.png', '2013-05-11 10:44:29', '2013-05-11 10:44:29', null);

-- ----------------------------
-- Table structure for `tipo_eleccion`
-- ----------------------------
DROP TABLE IF EXISTS `tipo_eleccion`;
CREATE TABLE `tipo_eleccion` (
  `IDTIPO` decimal(10,0) NOT NULL DEFAULT '0',
  `NOMBRE` varchar(255) DEFAULT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IDTIPO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipo_eleccion
-- ----------------------------
INSERT INTO tipo_eleccion VALUES ('1', 'PRESIDENCIA', null);
INSERT INTO tipo_eleccion VALUES ('2', 'GOBERNACION', null);
INSERT INTO tipo_eleccion VALUES ('3', 'ALCALDIA', null);
INSERT INTO tipo_eleccion VALUES ('4', 'CONSEJO', null);
INSERT INTO tipo_eleccion VALUES ('5', 'SENADO', null);
INSERT INTO tipo_eleccion VALUES ('6', 'CAMARA', null);
INSERT INTO tipo_eleccion VALUES ('7', 'JAL', null);

-- ----------------------------
-- Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `IDUSUARIO` decimal(10,0) NOT NULL DEFAULT '0',
  `NOMBRE` varchar(255) DEFAULT NULL,
  `USUARIO` varchar(255) DEFAULT NULL,
  `CONTRASENA` varchar(255) DEFAULT NULL,
  `PERMISO` varchar(255) DEFAULT NULL,
  `ACTIVO` varchar(255) DEFAULT NULL,
  `FECHA` date DEFAULT NULL,
  PRIMARY KEY (`IDUSUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO usuario VALUES ('1', 'LUIS CARDENAS', 'admin', 'ddc5064706d6e692f06eed4310b65ca58d8a2388', '1', 'Y', '2013-05-09');
