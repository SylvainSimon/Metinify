/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : account

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2016-01-03 09:44:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `account`
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(45) NOT NULL DEFAULT '',
  `real_name` varchar(16) NOT NULL DEFAULT '',
  `social_id` varchar(7) NOT NULL DEFAULT '',
  `email` varchar(64) NOT NULL DEFAULT '',
  `phone1` varchar(16) DEFAULT NULL,
  `phone2` varchar(16) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `zipcode` varchar(7) NOT NULL DEFAULT '',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `question1` varchar(48) DEFAULT NULL,
  `answer1` varchar(48) DEFAULT NULL,
  `question2` varchar(48) DEFAULT NULL,
  `answer2` varchar(48) DEFAULT NULL,
  `is_testor` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(8) NOT NULL DEFAULT 'OK',
  `securitycode` varchar(192) DEFAULT '',
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `empire` tinyint(4) NOT NULL DEFAULT '0',
  `name_checked` tinyint(1) NOT NULL DEFAULT '0',
  `availDt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mileage` int(11) NOT NULL DEFAULT '0',
  `cash` int(11) NOT NULL DEFAULT '200000',
  `gold_expire` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `silver_expire` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `safebox_expire` datetime NOT NULL DEFAULT '2016-01-01 00:00:00',
  `autoloot_expire` datetime NOT NULL DEFAULT '2016-01-01 00:00:00',
  `fish_mind_expire` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `marriage_fast_expire` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `money_drop_rate_expire` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ttl_cash` int(11) NOT NULL DEFAULT '0',
  `ttl_mileage` int(11) NOT NULL DEFAULT '0',
  `channel_company` varchar(30) NOT NULL DEFAULT '',
  `ip_creation` varchar(30) DEFAULT NULL,
  `last_play` varchar(30) DEFAULT NULL,
  `langue` varchar(3) DEFAULT NULL,
  `pseudo_messagerie` varchar(30) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `social_id` (`social_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of account
-- ----------------------------
INSERT INTO `account` VALUES ('1', 'admin', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', '', '1234567', 'lolfdgsdfgdfg@sdfsdf.fr', null, null, null, '', '2015-10-30 19:29:57', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '522350', '16450', '2037-12-13 14:56:45', '2016-12-11 18:27:40', '2016-02-07 12:25:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-01-12 12:37:41', '424242', '424524', '', '127.0.0.1', null, 'FRA', 'Vamos', null);
INSERT INTO `account` VALUES ('2', 'admin2', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', '', '1234567', 'test@test.fr', null, null, null, '', '0000-00-00 00:00:00', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '5385', '195590', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-01-01 00:00:00', '2016-01-01 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0', '', '127.0.0.2', null, 'FRA', 'BALAISCOUILLE', null);
INSERT INTO `account` VALUES ('3', 'admin3', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', '', '', 'test@test.fr', null, null, null, '', '0000-00-00 00:00:00', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '9195', '193430', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-01-01 00:00:00', '2016-01-01 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0', '', '127.0.0.2', null, 'FRA', 'Midgy', null);
INSERT INTO `account` VALUES ('20', 'dfghdfghghjk', '*CF139198ECD8240667E32EF3F7D4D157FCFBB42F', '', '', 'ghjk@sfg.fr', null, null, null, '', '2015-11-14 16:13:37', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '185', '550', '2015-11-14 16:13:37', '2015-11-14 16:13:37', '2015-11-14 16:13:37', '2015-11-14 16:13:37', '2015-11-14 16:13:37', '2015-11-14 16:13:37', '2015-11-14 16:13:37', '0', '0', '', '127.0.0.2', null, 'FRA', null, null);
INSERT INTO `account` VALUES ('18', 'tasoeur', '*9BB6CD7052D1A28D3F80C4C705AE50CAEF117BB6', '', '', 'monemail@lol.fr', null, null, null, '', '2015-11-13 19:06:32', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '185', '550', '2015-11-13 19:06:32', '2015-11-13 19:06:32', '2015-11-13 19:06:32', '2015-11-13 19:06:32', '2015-11-13 19:06:32', '2015-11-13 19:06:32', '2015-11-13 19:06:32', '0', '0', '', '127.0.0.2', null, 'DEU', null, null);
INSERT INTO `account` VALUES ('19', 'dfghdfgh', '*CF139198ECD8240667E32EF3F7D4D157FCFBB42F', '', '', 'dfghdfgh@sdf.fr', null, null, null, '', '2015-11-13 21:00:09', null, null, null, null, '0', 'BLOCK', '', '0', '0', '0', '0000-00-00 00:00:00', '185', '550', '2015-11-13 21:00:09', '2015-11-13 21:00:09', '2015-11-13 21:00:09', '2015-11-13 21:00:09', '2015-11-13 21:00:09', '2015-11-13 21:00:09', '2015-11-13 21:00:09', '0', '0', '', '127.0.0.1', null, 'FRA', null, null);
INSERT INTO `account` VALUES ('21', 'dfghdfghdfgh', '*CF139198ECD8240667E32EF3F7D4D157FCFBB42F', '', '', 'dfghdfgh@sqdf.fr', null, null, null, '', '2015-11-14 16:14:21', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '185', '550', '2015-11-14 16:14:21', '2015-11-14 16:14:21', '2015-11-14 16:14:21', '2015-11-14 16:14:21', '2015-11-14 16:14:21', '2015-11-14 16:14:21', '2015-11-14 16:14:21', '0', '0', '', '127.0.0.1', null, 'FRA', null, null);
INSERT INTO `account` VALUES ('22', 'hyufgjdfghjfgh', '*640B663834FFB9B41855CE324C53CC7E591FF0BB', '', '', 'fghjfghj@sdf.fr', null, null, null, '', '2015-11-29 17:51:43', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '2015-11-29 17:51:43', '2015-11-29 17:51:43', '2015-11-29 17:51:43', '2015-11-29 17:51:43', '2015-11-29 17:51:43', '2015-11-29 17:51:43', '2015-11-29 17:51:43', '0', '0', '', '127.0.0.1', null, 'ZZZ', null, null);
INSERT INTO `account` VALUES ('23', 'hjfgjhfghjgh', '*CF139198ECD8240667E32EF3F7D4D157FCFBB42F', '', '', 'dfgh@sdgf.fr', null, null, null, '', '2015-11-29 17:52:36', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '2015-11-29 17:52:36', '2015-11-29 17:52:36', '2015-11-29 17:52:36', '2015-11-29 17:52:36', '2015-11-29 17:52:36', '2015-11-29 17:52:36', '2015-11-29 17:52:36', '0', '0', '', '127.0.0.1', null, 'ZZZ', null, null);
INSERT INTO `account` VALUES ('24', 'dfghdfghh', '*CF139198ECD8240667E32EF3F7D4D157FCFBB42F', '', '', 'dfghdfgh@sdf.fr', null, null, null, '', '2015-11-29 17:54:51', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '2015-11-29 17:54:51', '2015-11-29 17:54:51', '2015-11-29 17:54:51', '2015-11-29 17:54:51', '2015-11-29 17:54:51', '2015-11-29 17:54:51', '2015-11-29 17:54:51', '0', '0', '', '127.0.0.1', null, 'ZZZ', null, null);
INSERT INTO `account` VALUES ('25', 'ytuityuityui', '*333B4B35C6B408A49911ABB7B36E8859BF3DBB98', '', '', 'tyui@sdf.fr', null, null, null, '', '2015-11-29 17:57:47', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '2015-11-29 17:57:47', '2015-11-29 17:57:47', '2015-11-29 17:57:47', '2015-11-29 17:57:47', '2015-11-29 17:57:47', '2015-11-29 17:57:47', '2015-11-29 17:57:47', '0', '0', '', '127.0.0.1', null, 'ZZZ', null, null);
INSERT INTO `account` VALUES ('26', 'ujfghjfghj', '*49372EB30349E30EBF8363CC592871DE3FC98140', '', '', 'hjfghjf@sfgD.fr', null, null, null, '', '2015-11-29 17:58:24', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '2015-11-29 17:58:24', '2015-11-29 17:58:24', '2015-11-29 17:58:24', '2015-11-29 17:58:24', '2015-11-29 17:58:24', '2015-11-29 17:58:24', '2015-11-29 17:58:24', '0', '0', '', '127.0.0.1', null, 'ZZZ', null, null);
INSERT INTO `account` VALUES ('27', 'fdgdfghdfghgfhgj', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', '', '', 'truc@lol.fr', null, null, null, '', '2015-12-05 19:59:43', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '2015-12-05 19:59:43', '2015-12-05 19:59:43', '2015-12-05 19:59:43', '2015-12-05 19:59:43', '2015-12-05 19:59:43', '2015-12-05 19:59:43', '2015-12-05 19:59:43', '0', '0', '', '127.0.0.1', null, 'ZZZ', null, null);
INSERT INTO `account` VALUES ('28', 'fgdhdfghdfghfgh', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', '', '', 'dhfghfgh@sdf.fr', null, null, null, '', '2015-12-05 20:00:25', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '2015-12-05 20:00:25', '2015-12-05 20:00:25', '2015-12-05 20:00:25', '2015-12-05 20:00:25', '2015-12-05 20:00:25', '2015-12-05 20:00:25', '2015-12-05 20:00:25', '0', '0', '', '127.0.0.1', null, 'ZZZ', null, null);
INSERT INTO `account` VALUES ('29', 'jesuisuntest', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', '', '', 'vfhdfgh@xcgfd.fr', null, null, null, '', '2015-12-05 20:04:12', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '2015-12-05 20:04:12', '2015-12-05 20:04:12', '2015-12-05 20:04:12', '2015-12-05 20:04:12', '2015-12-05 20:04:12', '2015-12-05 20:04:12', '2015-12-05 20:04:12', '0', '0', '', '127.0.0.1', null, 'ZZZ', null, null);
INSERT INTO `account` VALUES ('30', 'jesuisuntest2', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', '', '', 'jesuisuntest2@lol.fr', null, null, null, '', '2015-12-05 20:05:20', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '2015-12-05 20:05:20', '2015-12-05 20:05:20', '2015-12-05 20:05:20', '2015-12-05 20:05:20', '2015-12-05 20:05:20', '2015-12-05 20:05:20', '2015-12-05 20:05:20', '0', '0', '', '127.0.0.1', null, 'ZZZ', null, null);
INSERT INTO `account` VALUES ('31', 'jesuisuntest3', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', '', '', 'fdgsdfgsdfg@dfgsdfg.fr', null, null, null, '', '2015-12-05 20:29:14', null, null, null, null, '0', 'OK', '', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '2015-12-05 20:29:14', '2015-12-05 20:29:14', '2037-12-05 20:29:14', '2037-12-05 20:29:14', '2015-12-05 20:29:14', '2015-12-05 20:29:14', '2015-12-05 20:29:14', '0', '0', '', '127.0.0.1', null, 'ZZZ', null, null);

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL DEFAULT '0',
  `admin` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin
-- ----------------------------

-- ----------------------------
-- Table structure for `block_exception`
-- ----------------------------
DROP TABLE IF EXISTS `block_exception`;
CREATE TABLE `block_exception` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of block_exception
-- ----------------------------

-- ----------------------------
-- Table structure for `gametime`
-- ----------------------------
DROP TABLE IF EXISTS `gametime`;
CREATE TABLE `gametime` (
  `UserID` varchar(50) NOT NULL DEFAULT '',
  `paymenttype` tinyint(2) NOT NULL DEFAULT '1',
  `LimitTime` int(11) DEFAULT '0',
  `LimitDt` datetime DEFAULT '1990-01-01 00:00:00',
  `Scores` int(11) DEFAULT '0',
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gametime
-- ----------------------------

-- ----------------------------
-- Table structure for `gametimeip`
-- ----------------------------
DROP TABLE IF EXISTS `gametimeip`;
CREATE TABLE `gametimeip` (
  `ipid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `ip` varchar(11) NOT NULL DEFAULT '000.000.000',
  `startIP` int(11) NOT NULL DEFAULT '0',
  `endIP` int(11) NOT NULL DEFAULT '255',
  `paymenttype` tinyint(2) NOT NULL DEFAULT '1',
  `LimitTime` int(11) NOT NULL DEFAULT '0',
  `LimitDt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `readme` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ipid`),
  UNIQUE KEY `ip_uniq` (`ip`,`startIP`,`endIP`),
  KEY `ip_idx` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gametimeip
-- ----------------------------

-- ----------------------------
-- Table structure for `gametimelog`
-- ----------------------------
DROP TABLE IF EXISTS `gametimelog`;
CREATE TABLE `gametimelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(16) DEFAULT NULL,
  `type` enum('IP_FREE','FREE','IP_TIME','IP_DAY','TIME','DAY') DEFAULT NULL,
  `logon_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logout_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `use_time` int(11) DEFAULT NULL,
  `ip` varchar(15) NOT NULL DEFAULT '000.000.000.000',
  `server` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `login_key` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gametimelog
-- ----------------------------

-- ----------------------------
-- Table structure for `iptocountry`
-- ----------------------------
DROP TABLE IF EXISTS `iptocountry`;
CREATE TABLE `iptocountry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IP_FROM` varchar(16) DEFAULT NULL,
  `IP_TO` varchar(16) DEFAULT NULL,
  `COUNTRY_NAME` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of iptocountry
-- ----------------------------

-- ----------------------------
-- Table structure for `item_award`
-- ----------------------------
DROP TABLE IF EXISTS `item_award`;
CREATE TABLE `item_award` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `login` varchar(30) NOT NULL DEFAULT '',
  `vnum` int(6) unsigned NOT NULL DEFAULT '0',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  `given_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `taken_time` datetime DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `why` varchar(128) DEFAULT NULL,
  `socket0` int(11) NOT NULL DEFAULT '0',
  `socket1` int(11) NOT NULL DEFAULT '0',
  `socket2` int(11) NOT NULL DEFAULT '0',
  `mall` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pid_idx` (`pid`),
  KEY `given_time_idx` (`given_time`),
  KEY `taken_time_idx` (`taken_time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of item_award
-- ----------------------------

-- ----------------------------
-- Table structure for `monarch`
-- ----------------------------
DROP TABLE IF EXISTS `monarch`;
CREATE TABLE `monarch` (
  `empire` int(10) unsigned NOT NULL DEFAULT '0',
  `pid` int(10) unsigned DEFAULT '0',
  `name` varchar(16) DEFAULT NULL,
  `windate` datetime DEFAULT '0000-00-00 00:00:00',
  `money` bigint(20) unsigned DEFAULT '0',
  PRIMARY KEY (`empire`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of monarch
-- ----------------------------

-- ----------------------------
-- Table structure for `psc`
-- ----------------------------
DROP TABLE IF EXISTS `psc`;
CREATE TABLE `psc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(20) NOT NULL,
  `psc` varchar(20) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of psc
-- ----------------------------

-- ----------------------------
-- Table structure for `send_notice`
-- ----------------------------
DROP TABLE IF EXISTS `send_notice`;
CREATE TABLE `send_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) NOT NULL DEFAULT '0',
  `server` varchar(3) NOT NULL DEFAULT '',
  `show_check` tinyint(2) NOT NULL DEFAULT '0',
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of send_notice
-- ----------------------------

-- ----------------------------
-- Table structure for `shopgroups`
-- ----------------------------
DROP TABLE IF EXISTS `shopgroups`;
CREATE TABLE `shopgroups` (
  `id` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of shopgroups
-- ----------------------------

-- ----------------------------
-- Table structure for `tele_block`
-- ----------------------------
DROP TABLE IF EXISTS `tele_block`;
CREATE TABLE `tele_block` (
  `account_id` int(11) NOT NULL DEFAULT '0',
  `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tele_block` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tele_block
-- ----------------------------
