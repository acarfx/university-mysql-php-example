/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50713
Source Host           : localhost:3306
Source Database       : site

Target Server Type    : MYSQL
Target Server Version : 50713
File Encoding         : 65001

Date: 2021-02-06 21:25:34
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `uyeler`
-- ----------------------------
DROP TABLE IF EXISTS `uyeler`;
CREATE TABLE `uyeler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(250) DEFAULT NULL,
  `soyisim` varchar(255) DEFAULT NULL,
  `kullanici_adi` varchar(60) CHARACTER SET latin5 NOT NULL,
  `parola` varchar(60) CHARACTER SET latin5 NOT NULL,
  `eposta` varchar(60) CHARACTER SET latin5 NOT NULL,
  `tarih` date DEFAULT NULL,
  `yetki` varchar(60) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of uyeler
-- ----------------------------
INSERT INTO `uyeler` VALUES ('1', 'Selahattin', 'ACAR', 'acar', 'c2f1366c51911b52369fe27df307ff84', 'acar@acar.com', '2021-02-06', '1');
