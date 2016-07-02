/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : db_jobportal

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2016-07-02 14:35:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_qualification
-- ----------------------------
DROP TABLE IF EXISTS `tbl_qualification`;
CREATE TABLE `tbl_qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `degree` varchar(255) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `completion_date` year(4) DEFAULT NULL,
  `gpa_pct` float DEFAULT NULL,
  `remarks` text,
  `user_id` int(11) NOT NULL,
  `del_flag` tinyint(11) DEFAULT '0',
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
