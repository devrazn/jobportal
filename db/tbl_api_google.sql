/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : db_jobportal

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2016-05-10 17:49:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_api_google
-- ----------------------------
DROP TABLE IF EXISTS `tbl_api_google`;
CREATE TABLE `tbl_api_google` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_api_google
-- ----------------------------
INSERT INTO `tbl_api_google` VALUES ('1', '100600384238432966022', 'Neetu', 'Pradhan', 'https://lh6.googleusercontent.com/-3EcrR8h91OU/AAAAAAAAAAI/AAAAAAAAABk/6E9LYHnXAE8/photo.jpg', 'female');
