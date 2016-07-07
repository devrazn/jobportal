/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : db_jobportal

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-07-07 13:24:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_user_map_tag
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_map_tag`;
CREATE TABLE `tbl_user_map_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
