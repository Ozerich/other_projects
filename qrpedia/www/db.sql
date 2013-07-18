/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : qrpedia

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2013-03-06 18:21:50
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `admins`
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admins
-- ----------------------------

-- ----------------------------
-- Table structure for `adverts`
-- ----------------------------
DROP TABLE IF EXISTS `adverts`;
CREATE TABLE `adverts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `folder_id` int(11) NOT NULL DEFAULT '0',
  `status` enum('new') NOT NULL DEFAULT 'new',
  `type` enum('legal_company','legal_company_extended','legal_basic_page','legal_custom_page','physical_company','physical_human','physical_page','physical_afisha') DEFAULT NULL,
  `date_publish` datetime DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `days` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `appeal` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `job_position` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_2` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `vkontakte` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `www` varchar(255) DEFAULT NULL,
  `map_coords` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `color_1` varchar(6) DEFAULT NULL,
  `color_2` varchar(6) DEFAULT NULL,
  `color_3` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of adverts
-- ----------------------------

-- ----------------------------
-- Table structure for `advert_photos`
-- ----------------------------
DROP TABLE IF EXISTS `advert_photos`;
CREATE TABLE `advert_photos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `advert_id` int(11) NOT NULL,
  `file` varchar(20) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of advert_photos
-- ----------------------------

-- ----------------------------
-- Table structure for `companies`
-- ----------------------------
DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('new') DEFAULT 'new',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `balance` int(11) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `legal_address` varchar(255) DEFAULT NULL,
  `details` text,
  `phone` varchar(20) DEFAULT NULL,
  `form` enum('physical','legal') DEFAULT 'physical',
  `restore_code` varchar(255) DEFAULT NULL,
  `area` int(11) NOT NULL,
  `package_name` int(11) DEFAULT NULL,
  `package_count_remaining` int(11) DEFAULT NULL,
  `package_types` varchar(255) DEFAULT NULL,
  `package_days` int(11) DEFAULT NULL,
  `package_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of companies
-- ----------------------------

-- ----------------------------
-- Table structure for `folders`
-- ----------------------------
DROP TABLE IF EXISTS `folders`;
CREATE TABLE `folders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of folders
-- ----------------------------

-- ----------------------------
-- Table structure for `packages`
-- ----------------------------
DROP TABLE IF EXISTS `packages`;
CREATE TABLE `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `types` varchar(255) NOT NULL,
  `days` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of packages
-- ----------------------------
INSERT INTO `packages` VALUES ('1', 'Базовый', '5', 'legal_company,legal_custom_page,physical_human', '100', '1000');
INSERT INTO `packages` VALUES ('2', 'Расширенный', '2', 'legal_company,legal_custom_page,physical_human', '100', '1000');
INSERT INTO `packages` VALUES ('3', 'Гибкий', '2', 'legal_company,legal_custom_page,physical_human', '100', '1000');
INSERT INTO `packages` VALUES ('4', 'Временный', '2', 'legal_company,legal_custom_page,physical_human', '100', '1000');
INSERT INTO `packages` VALUES ('5', 'Социальный', '2', 'legal_company,legal_custom_page,physical_human', '100', '1000');
INSERT INTO `packages` VALUES ('6', 'Рекламный', '2', 'legal_company,legal_custom_page,physical_human', '1000', '100');
