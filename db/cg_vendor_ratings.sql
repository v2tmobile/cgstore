/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : cgtrader

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-03-14 22:59:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cg_vendor_ratings`
-- ----------------------------
DROP TABLE IF EXISTS `cg_vendor_ratings`;
CREATE TABLE `cg_vendor_ratings` (
  `vendor_id` int(11) NOT NULL,
  `point` int(11) DEFAULT NULL,
  `accuracy` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

