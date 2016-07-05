/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : db_jobportal

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2016-06-28 08:59:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_users
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL COMMENT '0: Female, \r\n1: Male',
  `dob_estd` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `company_type` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `benefits` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL COMMENT '0: Unmarried, \r\n1: Married',
  `phone` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL COMMENT '1: JobSeeker, 2:Employer',
  `newsletter_subscription` tinyint(4) DEFAULT '0' COMMENT '0:No,1:Yes',
  `feature_in_slider` tinyint(4) DEFAULT '0',
  `activation_reset_key` varchar(255) DEFAULT NULL,
  `reg_date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `del_flag` tinyint(4) DEFAULT '0',
  `verification_status` varchar(255) DEFAULT '0' COMMENT '0: Unverified, 1: Email Verified, 2: Email & Admin Verified',
  `account_status` varchar(20) NOT NULL DEFAULT '1' COMMENT '1: Active, 2: Suspended, 3: Blocked',
  `api_id` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `app_type` char(255) DEFAULT NULL COMMENT '1:Gmail ,2:Facebook , 3:Twitter',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
