/*
Navicat MySQL Data Transfer

Source Server         : xammp
Source Server Version : 100121
Source Host           : localhost:3306
Source Database       : techassessmentlaravelphp

Target Server Type    : MYSQL
Target Server Version : 100121
File Encoding         : 65001

Date: 2017-06-27 19:56:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user_stats
-- ----------------------------
DROP TABLE IF EXISTS `user_stats`;
CREATE TABLE `user_stats` (
  `user_id` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `onboarding_percentage` varchar(255) DEFAULT NULL,
  `count_applications` varchar(255) DEFAULT NULL,
  `count_accepted_applications` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET FOREIGN_KEY_CHECKS=1;
