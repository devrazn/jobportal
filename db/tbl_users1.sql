/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : db_jobportal

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2015-11-20 10:10:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_users`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob_estd` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `company_type` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `benefits` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `newsletter_subscription` tinyint(4) DEFAULT '0' COMMENT '0:No,1:Yes',
  `pw_reset_key` varchar(255) DEFAULT NULL,
  `reg_date` date DEFAULT NULL,
  `activation_code` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `del_flag` tinyint(4) DEFAULT '0',
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`company_type`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('1', 'neetupradhan96@gmail.com', '12345', 'Neetu', 'Pradhan', 'F', '2000-12-06', 'Sanepa', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor ', 'qaz', 'aa', '0', '9800000000', '0', '1', 'aa', null, null, 'test2.jpg', '0', '1');
INSERT INTO `tbl_users` VALUES ('2', 'acharya.rajanpkr@gmail.com', '111111', 'Rajan', 'Acharya', 'M', '2000-12-12', 'Kathmandu', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor ', 'asd', 'asd', '0', '9800000000', '0', '1', 'aa', null, null, 'test.jpg', '0', '1');
INSERT INTO `tbl_users` VALUES ('3', 'neetupradhan96@hotmail.com', '111111', 'Neetu', 'Pradhan', 'f', '2003-12-30', 'Lalitpur', '', '', '', '', '0', '1111111', '2', '0', '', null, null, '', '0', '1');
INSERT INTO `tbl_users` VALUES ('6', 'admin@admin.com', '9066e4e4b3d1a41af455ffd2de69fa17', 'test', 'test', 'F', '0000-00-00', ' test', 'Test', ' test', ' test', 'test', 'M', '9843254545', 'Job Seeker', null, null, '2015-11-19', 'RIIAPBDM9CBT', null, '0', '1');
INSERT INTO `tbl_users` VALUES ('7', 'admin@admin.com', '9066e4e4b3d1a41af455ffd2de69fa17', 'Neetu', 'Pradhan', 'F', '0000-00-00', 'sad', 'Test', ' dsfd', ' hfhgfd', 'rewr', 'M', '9843254545', 'Job Seeker', null, null, '2015-11-19', 'K5CCIU128YHA', null, '0', '0');
INSERT INTO `tbl_users` VALUES ('8', 'admin@admin.com', '9066e4e4b3d1a41af455ffd2de69fa17', 'Neetu', 'Pradhan', 'F', '0000-00-00', ' hfdh', 'Test', ' fdh', ' hfghd', 'fhd', 'M', '9843254545', 'Job Seeker', '0', null, '2015-11-19', 'CEC2B1MKJSPN', null, '0', '1');
INSERT INTO `tbl_users` VALUES ('9', 'admin@admin.com', '9066e4e4b3d1a41af455ffd2de69fa17', 'Neetu', 'Pradhan', 'F', '0000-00-00', ' gff', 'Test1', 'gfdg', ' fg', 'fg', 'M', '9843254545', 'Employer', '1', null, '2015-11-19', 'RTAE1DFRXC1T', null, '0', '1');
