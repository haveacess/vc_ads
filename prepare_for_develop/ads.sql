/*
 Navicat MySQL Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100420
 Source Host           : localhost:3306
 Source Schema         : test

 Target Server Type    : MySQL
 Target Server Version : 100420
 File Encoding         : 65001

 Date: 15/11/2021 18:45:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ads
-- ----------------------------
DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `price` int NULL DEFAULT NULL,
  `limit_views` int NULL DEFAULT NULL,
  `banner` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ads
-- ----------------------------
INSERT INTO `ads` VALUES (1, 'Test ad', 400, 393, 'http://s.com/image.jpg');
INSERT INTO `ads` VALUES (2, 'John Johnson', 250, 630, 'http://s.com/image1.jpg');
INSERT INTO `ads` VALUES (3, 'Hello Cat', 390, 403, 'http://s.com/image2.jpg');
INSERT INTO `ads` VALUES (4, 'My name is Petr', 900, 175, 'http://s.com/image3.jpg');
INSERT INTO `ads` VALUES (5, 'Call me Alex', 1800, 87, 'http://s.com/image4.jpg');
INSERT INTO `ads` VALUES (6, 'Moscow. 50% off', 1300, 121, 'http://s.com/image5.jpg');
INSERT INTO `ads` VALUES (7, 'test', 100, 599, 'http://vk.com/123');

SET FOREIGN_KEY_CHECKS = 1;
