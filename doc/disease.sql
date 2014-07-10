/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50704
Source Host           : localhost:3306
Source Database       : disease

Target Server Type    : MYSQL
Target Server Version : 50704
File Encoding         : 65001

Date: 2014-07-09 19:59:16
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `city`
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cityname` varchar(32) NOT NULL,
  `ename` varchar(64) DEFAULT NULL,
  `letter` char(2) DEFAULT NULL,
  `coordinate` varchar(32) NOT NULL,
  `level` tinyint(2) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cityname` (`cityname`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES ('1', '亚洲', 'yazhou', 'Y', '', '0', '0');
INSERT INTO `city` VALUES ('2', '欧洲', 'ozhou', 'O', '', '0', '0');
INSERT INTO `city` VALUES ('3', '北美洲', 'beimeizhou', 'B', '', '0', '0');
INSERT INTO `city` VALUES ('4', '南美洲', 'nanmeizhou', 'N', '', '0', '0');
INSERT INTO `city` VALUES ('5', '非洲', 'feizhou', 'F', '', '0', '0');
INSERT INTO `city` VALUES ('6', '大洋洲', 'dayangzhou', 'D', '', '0', '0');
INSERT INTO `city` VALUES ('7', '南极洲', 'nanjizhou', 'N', '', '0', '0');
INSERT INTO `city` VALUES ('8', '中国', 'zhongou', 'Z', '', '1', '1');
INSERT INTO `city` VALUES ('9', '日本', 'riben', 'R', '', '1', '1');
INSERT INTO `city` VALUES ('10', '冰岛', 'bingdao', 'B', '', '1', '2');
INSERT INTO `city` VALUES ('11', '是打发', '', 'S', '107.08393275:40.44370956', '2', '8');
INSERT INTO `city` VALUES ('13', '北京', '', 'B', '108.70990931:35.31090904', '2', '8');
INSERT INTO `city` VALUES ('15', '是双方都', '', 'S', '112.09369838:34.98536885', '2', '8');
INSERT INTO `city` VALUES ('16', '', '', '', ':', '2', '0');

-- ----------------------------
-- Table structure for `cityinfo`
-- ----------------------------
DROP TABLE IF EXISTS `cityinfo`;
CREATE TABLE `cityinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `describe` text,
  `other` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cityinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `disease_list`
-- ----------------------------
DROP TABLE IF EXISTS `disease_list`;
CREATE TABLE `disease_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cityid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `number` int(5) DEFAULT NULL,
  `ratio` float(3,0) DEFAULT NULL,
  `createtime` int(11) DEFAULT NULL,
  `doctor_id` int(11) NOT NULL,
  `comment` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city` (`cityid`),
  KEY `title` (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of disease_list
-- ----------------------------
INSERT INTO `disease_list` VALUES ('23', '13', '1', '1391788800', '1405612800', '0', '12', '1399385761', '123123', '位于圭亚那东北沿海德梅拉拉（DEMERARA）河口中岸，濒临大西洋的西侧，是圭亚那的最大港口。它是圭亚那的首者和全国政治、经济、文化和交通中心，还是该国农、林、矿产品的集散地和加工中心。铝钒土、蔗糖及大米为圭亚那三大经济支柱');

-- ----------------------------
-- Table structure for `diseaseinfo`
-- ----------------------------
DROP TABLE IF EXISTS `diseaseinfo`;
CREATE TABLE `diseaseinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diseasename` varchar(32) NOT NULL,
  `ename` varchar(64) DEFAULT NULL,
  `pathogen` varchar(32) DEFAULT NULL COMMENT '病原体名称',
  `epathogen` varchar(54) DEFAULT NULL,
  `group` varchar(32) DEFAULT NULL,
  `source` varchar(32) DEFAULT NULL COMMENT '传染源',
  `easyinfection` varchar(32) DEFAULT NULL COMMENT '容易感染人群',
  `pathway` varchar(32) DEFAULT NULL COMMENT '传染途径',
  `criteria` varchar(512) DEFAULT NULL COMMENT '断诊标准',
  `precautions` varchar(512) DEFAULT NULL COMMENT '预防措施',
  `treatment` varchar(512) DEFAULT NULL COMMENT '治疗措施',
  PRIMARY KEY (`id`),
  UNIQUE KEY `diseasename` (`diseasename`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of diseaseinfo
-- ----------------------------
INSERT INTO `diseaseinfo` VALUES ('1', '有毛病', ' 撒地方', '啊', ' 阿斯达', '阿斯达', '阿斯达', '阿萨', '是', '阿萨', ' 敌法师', ' 割发代首');
INSERT INTO `diseaseinfo` VALUES ('2', '是大法官', ' 地方官', '啊', '啊', '啊', '发送到', '  是', '高仿', '阿萨', '非官方的话', '华国锋接口');
INSERT INTO `diseaseinfo` VALUES ('3', '阿斯达', ' 双方都', ' 撒地方', '啊', ' 公司法定', '', '速度', '', ' 个但是', ' 是的噶', ' 是个撒');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(32) NOT NULL,
  `password` varchar(54) NOT NULL,
  `email` varchar(54) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `level` tinyint(2) DEFAULT NULL,
  `ext` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
