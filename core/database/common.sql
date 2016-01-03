/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : common

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2016-01-03 09:46:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `administrateurs`
-- ----------------------------
DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE `administrateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of administrateurs
-- ----------------------------
INSERT INTO `administrateurs` VALUES ('1', '[Admin]Vamos');
INSERT INTO `administrateurs` VALUES ('2', '[Admin]VaNos');
INSERT INTO `administrateurs` VALUES ('3', '[Admin]Vam0s');

-- ----------------------------
-- Table structure for `gmhost`
-- ----------------------------
DROP TABLE IF EXISTS `gmhost`;
CREATE TABLE `gmhost` (
  `mIP` varchar(16) NOT NULL DEFAULT '',
  PRIMARY KEY (`mIP`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- ----------------------------
-- Records of gmhost
-- ----------------------------
INSERT INTO `gmhost` VALUES ('37.59.18.68');

-- ----------------------------
-- Table structure for `gmlist`
-- ----------------------------
DROP TABLE IF EXISTS `gmlist`;
CREATE TABLE `gmlist` (
  `mID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mAccount` varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `mName` varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `mContactIP` varchar(16) CHARACTER SET big5 NOT NULL DEFAULT '',
  `mServerIP` varchar(16) CHARACTER SET big5 NOT NULL DEFAULT 'ALL',
  `mAuthority` enum('IMPLEMENTOR','HIGH_WIZARD','GOD','LOW_WIZARD','PLAYER') CHARACTER SET big5 DEFAULT 'PLAYER',
  PRIMARY KEY (`mID`)
) ENGINE=MyISAM AUTO_INCREMENT=69019023 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of gmlist
-- ----------------------------
INSERT INTO `gmlist` VALUES ('1', 'admin3', '[Admin]Vamos', '84.73.119.167', 'ALL', 'IMPLEMENTOR');
INSERT INTO `gmlist` VALUES ('2', 'admin', '[Dev]Vamos', '84.73.119.167', 'ALL', 'IMPLEMENTOR');
INSERT INTO `gmlist` VALUES ('3', 'admin', '[SGM]Hunter', '84.73.119.167', 'ALL', 'HIGH_WIZARD');
INSERT INTO `gmlist` VALUES ('35', 'admin', '[SGM]Finch', '84.73.119.167', 'ALL', 'IMPLEMENTOR');
INSERT INTO `gmlist` VALUES ('15', 'admin', '[Admin]VaNos', '84.73.119.167', 'ALL', 'IMPLEMENTOR');
INSERT INTO `gmlist` VALUES ('41', 'admin', '[GM]Miya', '84.73.119.167', 'ALL', 'HIGH_WIZARD');
INSERT INTO `gmlist` VALUES ('39', 'admin', '[GM]Sharky', '84.73.119.167', 'ALL', 'HIGH_WIZARD');
INSERT INTO `gmlist` VALUES ('40', 'admin', '[GM]Hanji', '84.73.119.167', 'ALL', 'HIGH_WIZARD');
INSERT INTO `gmlist` VALUES ('81', 'admin', '[GM]Deltaz', '84.73.119.167', 'ALL', 'HIGH_WIZARD');
INSERT INTO `gmlist` VALUES ('33', 'admin', '[GM]Buddy', '84.73.119.167', 'ALL', 'HIGH_WIZARD');
INSERT INTO `gmlist` VALUES ('85', 'admin', '[SGM]Faylinn', '84.73.119.167', 'ALL', 'IMPLEMENTOR');

-- ----------------------------
-- Table structure for `locale`
-- ----------------------------
DROP TABLE IF EXISTS `locale`;
CREATE TABLE `locale` (
  `mKey` varchar(255) NOT NULL DEFAULT '',
  `mValue` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`mKey`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of locale
-- ----------------------------
INSERT INTO `locale` VALUES ('SKILL_POWER_BY_LEVEL_TYPE0', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125');
INSERT INTO `locale` VALUES ('SKILL_POWER_BY_LEVEL_TYPE1', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125');
INSERT INTO `locale` VALUES ('SKILL_POWER_BY_LEVEL_TYPE2', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125');
INSERT INTO `locale` VALUES ('SKILL_POWER_BY_LEVEL_TYPE3', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125');
INSERT INTO `locale` VALUES ('SKILL_POWER_BY_LEVEL_TYPE4', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125');
INSERT INTO `locale` VALUES ('SKILL_POWER_BY_LEVEL_TYPE5', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125');
INSERT INTO `locale` VALUES ('SKILL_POWER_BY_LEVEL_TYPE6', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125');
INSERT INTO `locale` VALUES ('SKILL_POWER_BY_LEVEL_TYPE7', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125');
INSERT INTO `locale` VALUES ('LOCALE', 'germany');
INSERT INTO `locale` VALUES ('DB_NAME_COLUMN', 'locale_name');
INSERT INTO `locale` VALUES ('SKILL_DAMAGE_BY_LEVEL_UNDER_90', '0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0');
INSERT INTO `locale` VALUES ('SKILL_DAMAGE_BY_LEVEL_UNDER_45', '0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0');
INSERT INTO `locale` VALUES ('SKILL_POWER_BY_LEVEL', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125');

-- ----------------------------
-- Table structure for `locale_bug`
-- ----------------------------
DROP TABLE IF EXISTS `locale_bug`;
CREATE TABLE `locale_bug` (
  `mKey` varchar(255) NOT NULL DEFAULT '',
  `mValue` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`mKey`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of locale_bug
-- ----------------------------

-- ----------------------------
-- Table structure for `spam_db`
-- ----------------------------
DROP TABLE IF EXISTS `spam_db`;
CREATE TABLE `spam_db` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(15) DEFAULT NULL,
  `score` varchar(15) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of spam_db
-- ----------------------------
