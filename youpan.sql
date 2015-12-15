/*
Navicat MySQL Data Transfer

Source Server         : 腾讯云
Source Server Version : 50524
Source Host           : 5588e85f9dde1.gz.cdb.myqcloud.com:8996
Source Database       : youpan

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2015-12-15 21:22:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbFile
-- ----------------------------
DROP TABLE IF EXISTS `tbFile`;
CREATE TABLE `tbFile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fdName` varchar(64) NOT NULL COMMENT '文件名称',
  `fdSize` int(10) unsigned NOT NULL COMMENT '文件大小(Byte)',
  `fdSizeH` varchar(255) NOT NULL,
  `fdKey` char(28) NOT NULL COMMENT '文件key',
  `fdTypeID` tinyint(3) unsigned NOT NULL COMMENT '文件类型ID',
  `fdUserID` int(10) unsigned NOT NULL COMMENT '所属用户ID,对应tbUser.id',
  `fdStatus` tinyint(4) NOT NULL DEFAULT '1' COMMENT '文件状态：0 已删除 1存在',
  `fdCreate` datetime NOT NULL COMMENT '文件上传时间',
  `fdUpdate` datetime NOT NULL COMMENT '文件更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `KEY_UNIQUE_FDNAME` (`fdName`) USING BTREE,
  UNIQUE KEY `KEY_UNIQUE_FDKEY` (`fdKey`) USING BTREE,
  KEY `KEY_INDEX_FDTYPEID` (`fdTypeID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


-- ----------------------------
-- Table structure for tbFileShare
-- ----------------------------
DROP TABLE IF EXISTS `tbFileShare`;
CREATE TABLE `tbFileShare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fdCode` char(10) NOT NULL DEFAULT '',
  `fdPassword` char(4) NOT NULL,
  `fdFileID` int(11) NOT NULL,
  `fdUserID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_KEY_fdCode` (`fdCode`) USING BTREE,
  UNIQUE KEY `UNIQUE_KEY_fdFileID` (`fdFileID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;



-- ----------------------------
-- Table structure for tbFileType
-- ----------------------------
DROP TABLE IF EXISTS `tbFileType`;
CREATE TABLE `tbFileType` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `fdName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbFileType
-- ----------------------------
INSERT INTO `tbFileType` VALUES ('1', 'image');
INSERT INTO `tbFileType` VALUES ('2', 'video');
INSERT INTO `tbFileType` VALUES ('3', 'audio');
INSERT INTO `tbFileType` VALUES ('4', 'document');
INSERT INTO `tbFileType` VALUES ('5', 'other');

-- ----------------------------
-- Table structure for tbMime
-- ----------------------------
DROP TABLE IF EXISTS `tbMime`;
CREATE TABLE `tbMime` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `fdName` varchar(128) NOT NULL COMMENT 'MIME名称',
  `fdExt` varchar(10) NOT NULL COMMENT 'MIME对应的后缀',
  `fdTypeID` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fdName` (`fdName`),
  KEY `fdExt` (`fdExt`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbMime
-- ----------------------------
INSERT INTO `tbMime` VALUES ('1', 'image/gif', 'gif', '1');
INSERT INTO `tbMime` VALUES ('2', 'image/jpeg', 'jpe', '1');
INSERT INTO `tbMime` VALUES ('3', 'image/jpeg', 'jpeg', '1');
INSERT INTO `tbMime` VALUES ('4', 'image/jpeg', 'jpg', '1');
INSERT INTO `tbMime` VALUES ('5', 'image/x-icon', 'ico', '1');
INSERT INTO `tbMime` VALUES ('6', 'image/bmp', 'bmp', '1');
INSERT INTO `tbMime` VALUES ('7', 'image/png', 'png', '1');
INSERT INTO `tbMime` VALUES ('8', 'video/mpeg', 'mpg', '2');
INSERT INTO `tbMime` VALUES ('9', 'video/mpeg', 'mpeg ', '2');
INSERT INTO `tbMime` VALUES ('10', 'video/x-msvideo', 'avi', '2');
INSERT INTO `tbMime` VALUES ('11', 'video/quicktime', 'mov', '2');
INSERT INTO `tbMime` VALUES ('12', 'video/mp4', 'mp4', '2');
INSERT INTO `tbMime` VALUES ('13', 'video/3gpp', '3gp', '2');
INSERT INTO `tbMime` VALUES ('14', 'flv-application/octet-stream', 'flv', '2');
INSERT INTO `tbMime` VALUES ('15', 'audio/x-pn-realaudio', 'rmvb', '2');
INSERT INTO `tbMime` VALUES ('16', 'audio/x-wav', 'wav', '3');
INSERT INTO `tbMime` VALUES ('17', 'audio/mpeg', 'mp3', '3');
INSERT INTO `tbMime` VALUES ('18', 'audio/x-ms-wma', 'wma', '3');
INSERT INTO `tbMime` VALUES ('19', 'application/msword', 'doc', '4');
INSERT INTO `tbMime` VALUES ('20', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'docx', '4');
INSERT INTO `tbMime` VALUES ('21', 'text/plain', 'txt', '4');
INSERT INTO `tbMime` VALUES ('22', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'xlsx', '4');
INSERT INTO `tbMime` VALUES ('23', 'application/vnd.ms-excel', 'xls', '4');
INSERT INTO `tbMime` VALUES ('24', 'application/vnd.ms-powerpoint', 'ppt', '4');
INSERT INTO `tbMime` VALUES ('25', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'pptx', '4');
INSERT INTO `tbMime` VALUES ('26', 'application/pdf', 'pdf', '4');

-- ----------------------------
-- Table structure for tbUser
-- ----------------------------
DROP TABLE IF EXISTS `tbUser`;
CREATE TABLE `tbUser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fdName` varchar(12) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `fdPassword` char(32) NOT NULL COMMENT '密码',
  `fdStatus` tinyint(4) NOT NULL DEFAULT '1' COMMENT '账户状态: 0-禁用 1-启用',
  `fdEmail` varchar(32) NOT NULL COMMENT '用户EMAIL',
  `fdCreate` datetime NOT NULL COMMENT '账号创建时间',
  `fdUpdate` datetime NOT NULL COMMENT '账号更新时间',
  `fdAvatar` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_KEY_FDEMAIL` (`fdEmail`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

