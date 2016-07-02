/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : db_jobportal

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-07-02 15:00:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_experience
-- ----------------------------
DROP TABLE IF EXISTS `tbl_experience`;
CREATE TABLE `tbl_experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `start_year` int(11) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `duration_unit` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
