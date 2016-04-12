/*
Navicat MySQL Data Transfer

Source Server         : vmw
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : raovat

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-04-13 00:32:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_categories
-- ----------------------------
DROP TABLE IF EXISTS `tbl_categories`;
CREATE TABLE `tbl_categories` (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(255) NOT NULL,
  `cate_slug` varchar(255) NOT NULL,
  `cate_sort` int(11) DEFAULT '999',
  `parent_id` int(11) DEFAULT NULL,
  `cate_icon` varchar(255) NOT NULL,
  `created_date` int(11) NOT NULL,
  `user_created` int(11) NOT NULL,
  `updated_date` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `cate_meta_title` varchar(255) DEFAULT NULL,
  `cate_meta_keyword` varchar(255) DEFAULT NULL,
  `cate_meta_description` varchar(255) DEFAULT NULL,
  `cate_description` varchar(255) DEFAULT NULL,
  `cate_status` int(11) DEFAULT '1',
  `cate_grade` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_categories
-- ----------------------------
INSERT INTO `tbl_categories` VALUES ('1', 'Điện thoại', 'dien-thoai', '1', '0', 'icon-mobile-phone', '1460140880', '1', null, null, 'điện thoại, rao vặt điện thoại,', 'điện thoại, rao vặt điện thoại,', 'điện thoại, rao vặt điện thoại,', null, '1', '0001:0001:');
INSERT INTO `tbl_categories` VALUES ('2', 'Máy tính', 'may-tinh', '2', '0', 'icon-desktop', '1460140913', '1', null, null, 'Rao vặt máy tính. máy tính để bàn', 'Rao vặt máy tính. máy tính để bàn', 'Rao vặt máy tính. máy tính để bàn', null, '1', '0002:0002:');
INSERT INTO `tbl_categories` VALUES ('3', 'USB', 'usb', '3', '0', 'icon-mobile-phone', '1460140949', '1', null, null, 'Bán USB của các hãng Sony, samsung,usb 8G, usb 4G ....', 'Bán USB của các hãng Sony, samsung,usb 8G, usb 4G ....', 'Bán USB của các hãng Sony, samsung,usb 8G, usb 4G ....', null, '1', '0003:0003:');
INSERT INTO `tbl_categories` VALUES ('4', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', '2', '3', '', '1460140977', '1', '1460143693', '1', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', null, '-1', '0003:0003:0002:0004:');
INSERT INTO `tbl_categories` VALUES ('5', 'Nhà đất', 'nha-dat', '4', '0', 'icon-home', '1460365760', '1', null, null, 'Mua bán nhà đất,', 'Mua bán nhà đất,', 'Mua bán nhà đất,', null, '1', '0004:0005:');
INSERT INTO `tbl_categories` VALUES ('6', 'Chợ Sim', 'cho-sim', '5', '0', 'icon-rss', '1460365943', '1', null, null, 'Mua bán các loại sim điện thoại', 'Mua bán các loại sim điện thoại', 'Mua bán các loại sim điện thoại', null, '1', '0005:0006:');
INSERT INTO `tbl_categories` VALUES ('7', 'Điện máy', 'dien-may', '6', '0', 'icon-camera', '1460366063', '1', null, null, 'Điện máy', 'Điện máy', 'Điện máy', null, '1', '0006:0007:');
INSERT INTO `tbl_categories` VALUES ('8', 'Thời trang', 'thoi-trang', '7', '0', 'icon-female', '1460366155', '1', null, null, 'Thời trang', 'Thời trang', 'Thời trang', null, '1', '0007:0008:');
INSERT INTO `tbl_categories` VALUES ('9', 'Ôtô', 'oto', '8', '0', 'icon-truck', '1460366340', '1', null, null, 'Ôtô', 'Ôtô', 'Ôtô', null, '1', '0008:0009:');
INSERT INTO `tbl_categories` VALUES ('10', 'Xe máy', 'xe-may', '9', '0', 'icon-motorcycle', '1460366775', '1', null, null, 'Xe máy', 'Xe máy', 'Xe máy', null, '1', '0009:0010:');
INSERT INTO `tbl_categories` VALUES ('11', 'Vui chơi - giải trí', 'vui-choi-giai-tri', '10', '0', 'icon-smile-o', '1460366897', '1', null, null, 'Vui chơi - giải trí', 'Vui chơi - giải trí', 'Vui chơi - giải trí', null, '1', '0010:0011:');
INSERT INTO `tbl_categories` VALUES ('12', 'Dịch vụ', 'dich-vu', '11', '0', 'icon-wrench', '1460367104', '1', null, null, 'Dịch vụ', 'Dịch vụ', 'Dịch vụ', null, '1', '0011:0012:');
INSERT INTO `tbl_categories` VALUES ('13', 'Cộng đồng', 'cong-dong', '12', '0', 'icon-users', '1460367202', '1', null, null, 'Cộng đồng', 'Cộng đồng', 'Cộng đồng', null, '1', '0012:0013:');
INSERT INTO `tbl_categories` VALUES ('14', 'Giáo dục', 'giao-duc', '13', '0', 'icon-book', '1460367324', '1', null, null, 'Giáo dục', 'Giáo dục', 'Giáo dục', null, '1', '0013:0014:');
INSERT INTO `tbl_categories` VALUES ('15', 'Tổng hợp', 'tong-hop', '14', '0', 'icon-shopping-cart', '1460367492', '1', null, null, 'Tổng hợp', 'Tổng hợp', 'Tổng hợp', null, '1', '0014:0015:');
INSERT INTO `tbl_categories` VALUES ('16', 'Tuyển dụng - việc làm', 'tuyen-dung-viec-lam', '15', '0', 'fa-thumbs-o-up', '1460367712', '1', null, null, 'Tuyển dụng - việc làm', 'Tuyển dụng - việc làm', 'Tuyển dụng - việc làm', null, '1', '0015:0016:');

-- ----------------------------
-- Table structure for tbl_comments
-- ----------------------------
DROP TABLE IF EXISTS `tbl_comments`;
CREATE TABLE `tbl_comments` (
  `comm_id` int(11) NOT NULL AUTO_INCREMENT,
  `comm_content` text NOT NULL,
  `comm_status` int(11) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  PRIMARY KEY (`comm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_comments
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_contents
-- ----------------------------
DROP TABLE IF EXISTS `tbl_contents`;
CREATE TABLE `tbl_contents` (
  `cont_id` int(11) NOT NULL AUTO_INCREMENT,
  `cont_title` varchar(255) NOT NULL,
  `cont_slug` varchar(255) NOT NULL,
  `cont_content` text NOT NULL,
  `created_date` int(11) NOT NULL,
  `user_created` int(11) NOT NULL,
  `updated_date` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `cont_desciption` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `is_vip` int(11) DEFAULT '0' COMMENT '1:vip',
  `vip_type` int(11) DEFAULT NULL,
  `expired_time` int(11) DEFAULT NULL,
  `prop_id` int(11) DEFAULT NULL,
  `cont_views` int(11) DEFAULT '0',
  `cont_password` varchar(255) DEFAULT NULL,
  `user_info` text,
  `cont_status` int(255) DEFAULT '1',
  `ip_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cont_id`),
  FULLTEXT KEY `cont_title` (`cont_title`,`cont_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_contents
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_general
-- ----------------------------
DROP TABLE IF EXISTS `tbl_general`;
CREATE TABLE `tbl_general` (
  `gene_id` int(11) NOT NULL AUTO_INCREMENT,
  `gene_name` varchar(255) NOT NULL,
  `gene_slug` varchar(255) NOT NULL,
  `gene_parent` int(11) DEFAULT '0',
  `gene_content` varchar(255) DEFAULT NULL,
  `user_created` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `updated_date` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`gene_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_general
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_groups
-- ----------------------------
DROP TABLE IF EXISTS `tbl_groups`;
CREATE TABLE `tbl_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `created_date` int(11) NOT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `updated_date` int(11) DEFAULT NULL,
  `is_acp` int(11) NOT NULL DEFAULT '0' COMMENT '1: được vào backend',
  `is_full_access` int(11) NOT NULL DEFAULT '0' COMMENT '1: full quyền',
  `group_status` int(11) DEFAULT '1',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_groups
-- ----------------------------
INSERT INTO `tbl_groups` VALUES ('1', 'Adminstrator', '345678', '1', null, null, '1', '1', '1');
INSERT INTO `tbl_groups` VALUES ('2', 'Nhóm viết bài', '1460108301', '1', null, null, '1', '0', '1');
INSERT INTO `tbl_groups` VALUES ('3', 'Nhóm duyệt bài', '1460108470', '1', null, null, '1', '0', '1');
INSERT INTO `tbl_groups` VALUES ('4', 'Nhóm support', '1460108514', '1', null, null, '1', '0', '1');
INSERT INTO `tbl_groups` VALUES ('5', 'Nhóm Mod', '1460108565', '1', null, null, '1', '0', '-1');
INSERT INTO `tbl_groups` VALUES ('6', 'Administrator', '1460111589', '1', '1', '1460115132', '1', '0', '-1');

-- ----------------------------
-- Table structure for tbl_logs
-- ----------------------------
DROP TABLE IF EXISTS `tbl_logs`;
CREATE TABLE `tbl_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `table_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `log_content` text,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_logs
-- ----------------------------
INSERT INTO `tbl_logs` VALUES ('1', 'backend', 'group', 'add', '5', '1', '1460108565', '{\"group_name\":\"Nh\\u00f3m Mod\",\"is_acp\":1,\"is_full_access\":0,\"created_date\":1460108565,\"user_created\":1,\"group_status\":1}');
INSERT INTO `tbl_logs` VALUES ('2', 'backend', 'group', 'add', '6', '1', '1460111589', '{\"group_name\":\"Nh\\u00f3m Mod mod mod\",\"is_acp\":1,\"is_full_access\":0,\"created_date\":1460111589,\"user_created\":1,\"group_status\":1}');
INSERT INTO `tbl_logs` VALUES ('3', 'backend', 'group', 'edit', '6', '1', '1460114633', '{\"group_name\":\"aaaaaaaaaaaaaaaaaaaa\",\"is_full_access\":0,\"is_acp\":\"1\",\"group_status\":1,\"user_updated\":1,\"updated_date\":1460114633}');
INSERT INTO `tbl_logs` VALUES ('4', 'backend', 'group', 'edit', '6', '1', '1460114675', '{\"group_name\":\"ccccccccccccccccc\",\"is_full_access\":0,\"is_acp\":\"1\",\"group_status\":1,\"user_updated\":1,\"updated_date\":1460114675}');
INSERT INTO `tbl_logs` VALUES ('5', 'backend', 'group', 'edit', '6', '1', '1460115114', '{\"group_name\":\"ccccccccccccccccc\",\"is_full_access\":0,\"is_acp\":\"1\",\"group_status\":1,\"user_updated\":1,\"updated_date\":1460115114}');
INSERT INTO `tbl_logs` VALUES ('6', 'backend', 'group', 'edit', '6', '1', '1460115132', '{\"group_name\":\"Administrator\",\"is_full_access\":0,\"is_acp\":\"1\",\"group_status\":1,\"user_updated\":1,\"updated_date\":1460115132}');
INSERT INTO `tbl_logs` VALUES ('7', 'backend', 'group', 'delete', '6', '1', '1460115501', '{\"group_status\":-1}');
INSERT INTO `tbl_logs` VALUES ('8', 'backend', 'group', 'delete', '5', '1', '1460115560', '{\"group_status\":-1}');
INSERT INTO `tbl_logs` VALUES ('9', 'backend', 'user', 'add', '2', '1', '1460119396', '{\"user_fullname\":\"Nguy\\u1ec5n Ng\\u1ecdc Chi\\u1ebfn\",\"user_email\":\"ngocchien01@gmail.com\",\"user_phone\":\"0973531619\",\"user_birthday\":638902800,\"user_gender\":\"1\",\"user_password\":\"4297f44b13955235245b2497399d7a93\",\"group_id\":4,\"user_status\":\"1\",\"user_created\":1,\"created_date\":1460119396}');
INSERT INTO `tbl_logs` VALUES ('10', 'backend', 'user', 'edit', '2', '1', '1460123349', '{\"fullName\":\"Nguy\\u1ec5n Ng\\u1ecdc Chi\\u1ebfn\",\"email\":\"ngocchien01@gmail.com\",\"password\":\"\",\"gender\":\"1\",\"phoneNumber\":\"0973531619\",\"birthdate\":\"01-04-1990\",\"group\":\"4\",\"user_status\":\"1\",\"save\":\"\"}');
INSERT INTO `tbl_logs` VALUES ('11', 'backend', 'user', 'edit', '2', '1', '1460123369', '{\"fullName\":\"Nguy\\u1ec5n Ng\\u1ecdc Chi\\u1ebfn\",\"email\":\"ngocchien01@gmail.com\",\"password\":\"\",\"gender\":\"1\",\"phoneNumber\":\"0973531619\",\"birthdate\":\"01-04-1990\",\"group\":\"4\",\"user_status\":\"1\",\"save\":\"\"}');
INSERT INTO `tbl_logs` VALUES ('12', 'backend', 'user', 'edit', '2', '1', '1460123415', '{\"fullName\":\"Nguy\\u1ec5n Ng\\u1ecdc Chi\\u1ebfn1\",\"email\":\"ngocchien01@gmail.com\",\"password\":\"\",\"gender\":\"1\",\"phoneNumber\":\"0973531619\",\"birthdate\":\"01-04-1990\",\"group\":\"4\",\"user_status\":\"1\",\"save\":\"\"}');
INSERT INTO `tbl_logs` VALUES ('13', 'backend', 'user', 'edit', '2', '1', '1460123426', '{\"fullName\":\"Nguy\\u1ec5n Ng\\u1ecdc Chi\\u1ebfn\",\"email\":\"ngocchien01@gmail.com\",\"password\":\"\",\"gender\":\"1\",\"phoneNumber\":\"0973531619\",\"birthdate\":\"01-04-1990\",\"group\":\"3\",\"user_status\":\"1\",\"save\":\"\"}');
INSERT INTO `tbl_logs` VALUES ('14', 'backend', 'user', 'edit', '2', '1', '1460124824', '{\"fullName\":\"Nguy\\u1ec5n Ng\\u1ecdc Chi\\u1ebfn\",\"email\":\"ngocchien01@gmail.com\",\"password\":\"\",\"gender\":\"1\",\"phoneNumber\":\"0973531619\",\"birthdate\":\"01-04-1990\",\"group\":\"3\",\"user_status\":\"0\",\"save\":\"\"}');
INSERT INTO `tbl_logs` VALUES ('15', 'backend', 'user', 'delete', '2', '1', '1460125301', '{\"user_status\":-1}');
INSERT INTO `tbl_logs` VALUES ('16', 'backend', 'category', 'add', '2', '1', '1460129412', '{\"cate_name\":\"M\\u00e1y t\\u00ednh\",\"cate_icon\":\"icon-desktop\",\"cate_slug\":\"may-tinh\",\"cate_meta_title\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_meta_description\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_meta_keyword\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_sort\":2,\"cate_status\":\"1\",\"created_date\":1460129412,\"user_created\":1,\"parent_id\":\"1\"}');
INSERT INTO `tbl_logs` VALUES ('17', 'backend', 'category', 'add', '3', '1', '1460138159', '{\"cate_name\":\"USB\",\"cate_icon\":\"icon-mobile-phone\",\"cate_slug\":\"usb\",\"cate_meta_title\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_description\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_keyword\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460138159,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('18', 'backend', 'category', 'add', '4', '1', '1460138270', '{\"cate_name\":\"zxcvbnm\",\"cate_icon\":\"\",\"cate_slug\":\"zxcvbnm\",\"cate_meta_title\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_description\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_keyword\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460138270,\"user_created\":1,\"parent_id\":\"3\"}');
INSERT INTO `tbl_logs` VALUES ('19', 'backend', 'category', 'edit', '3', '1', '1460139371', '{\"cate_name\":\"USB\",\"cate_icon\":\"icon-mobile-phone\",\"cate_slug\":\"usb\",\"cate_meta_title\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_description\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_keyword\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_sort\":2,\"cate_status\":\"1\",\"updated_date\":1460139371,\"user_updated\":1,\"parent_id\":0}');
INSERT INTO `tbl_logs` VALUES ('20', 'backend', 'category', 'edit', '4', '1', '1460139508', '{\"cate_name\":\"zxcvbnm\",\"cate_icon\":\"icon-desktop\",\"cate_slug\":\"zxcvbnm\",\"cate_meta_title\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_description\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_keyword\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_sort\":1,\"cate_status\":\"1\",\"updated_date\":1460139508,\"user_updated\":1,\"parent_id\":0}');
INSERT INTO `tbl_logs` VALUES ('21', 'backend', 'category', 'edit', '4', '1', '1460139788', '{\"cate_name\":\"zxcvbnm\",\"cate_icon\":\"icon-desktop\",\"cate_slug\":\"zxcvbnm\",\"cate_meta_title\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_description\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_keyword\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_sort\":1,\"cate_status\":\"1\",\"updated_date\":1460139788,\"user_updated\":1,\"parent_id\":0}');
INSERT INTO `tbl_logs` VALUES ('22', 'backend', 'category', 'edit', '2', '1', '1460140364', '{\"cate_name\":\"M\\u00e1y t\\u00ednh\",\"cate_icon\":\"icon-desktop\",\"cate_slug\":\"may-tinh\",\"cate_meta_title\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_meta_description\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_meta_keyword\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_sort\":2,\"cate_status\":\"1\",\"updated_date\":1460140364,\"user_updated\":1,\"parent_id\":3}');
INSERT INTO `tbl_logs` VALUES ('23', 'backend', 'category', 'edit', '2', '1', '1460140380', '{\"cate_name\":\"M\\u00e1y t\\u00ednh\",\"cate_icon\":\"icon-desktop\",\"cate_slug\":\"may-tinh\",\"cate_meta_title\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_meta_description\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_meta_keyword\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_sort\":2,\"cate_status\":\"1\",\"updated_date\":1460140380,\"user_updated\":1,\"parent_id\":0}');
INSERT INTO `tbl_logs` VALUES ('24', 'backend', 'category', 'add', '5', '1', '1460140414', '{\"cate_name\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_icon\":\"\",\"cate_slug\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_meta_title\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_meta_description\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_meta_keyword\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460140414,\"user_created\":1,\"parent_id\":\"1\"}');
INSERT INTO `tbl_logs` VALUES ('25', 'backend', 'category', 'add', '8', '1', '1460140635', '{\"cate_name\":\"eeeeeeeeeeeeeee\",\"cate_icon\":\"\",\"cate_slug\":\"eeeeeeeeeeeeeee\",\"cate_meta_title\":\"eeeeeeeeeeeeeee\",\"cate_meta_description\":\"eeeeeeeeeeeeeee\",\"cate_meta_keyword\":\"eeeeeeeeeeeeeee\",\"cate_sort\":0,\"cate_status\":\"1\",\"created_date\":1460140635,\"user_created\":1,\"parent_id\":\"3\"}');
INSERT INTO `tbl_logs` VALUES ('26', 'backend', 'category', 'edit', '8', '1', '1460140696', '{\"cate_name\":\"eeeeeeeeeeeeeee\",\"cate_icon\":\"\",\"cate_slug\":\"eeeeeeeeeeeeeee\",\"cate_meta_title\":\"eeeeeeeeeeeeeee\",\"cate_meta_description\":\"eeeeeeeeeeeeeee\",\"cate_meta_keyword\":\"eeeeeeeeeeeeeee\",\"cate_sort\":0,\"cate_status\":\"1\",\"updated_date\":1460140696,\"user_updated\":1,\"parent_id\":1}');
INSERT INTO `tbl_logs` VALUES ('27', 'backend', 'category', 'edit', '8', '1', '1460140823', '{\"cate_name\":\"eeeeeeeeeeeeeee\",\"cate_icon\":\"\",\"cate_slug\":\"eeeeeeeeeeeeeee\",\"cate_meta_title\":\"eeeeeeeeeeeeeee\",\"cate_meta_description\":\"eeeeeeeeeeeeeee\",\"cate_meta_keyword\":\"eeeeeeeeeeeeeee\",\"cate_sort\":0,\"cate_status\":\"1\",\"updated_date\":1460140823,\"user_updated\":1,\"parent_id\":3}');
INSERT INTO `tbl_logs` VALUES ('28', 'backend', 'category', 'add', '1', '1', '1460140880', '{\"cate_name\":\"\\u0110i\\u1ec7n tho\\u1ea1i\",\"cate_icon\":\"icon-mobile-phone\",\"cate_slug\":\"dien-thoai\",\"cate_meta_title\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_description\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_keyword\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460140880,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('29', 'backend', 'category', 'add', '2', '1', '1460140914', '{\"cate_name\":\"M\\u00e1y t\\u00ednh\",\"cate_icon\":\"icon-desktop\",\"cate_slug\":\"may-tinh\",\"cate_meta_title\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_meta_description\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_meta_keyword\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_sort\":2,\"cate_status\":\"1\",\"created_date\":1460140913,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('30', 'backend', 'category', 'add', '3', '1', '1460140949', '{\"cate_name\":\"USB\",\"cate_icon\":\"icon-mobile-phone\",\"cate_slug\":\"usb\",\"cate_meta_title\":\"B\\u00e1n USB c\\u1ee7a c\\u00e1c h\\u00e3ng Sony, samsung,usb 8G, usb 4G ....\",\"cate_meta_description\":\"B\\u00e1n USB c\\u1ee7a c\\u00e1c h\\u00e3ng Sony, samsung,usb 8G, usb 4G ....\",\"cate_meta_keyword\":\"B\\u00e1n USB c\\u1ee7a c\\u00e1c h\\u00e3ng Sony, samsung,usb 8G, usb 4G ....\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460140949,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('31', 'backend', 'category', 'add', '4', '1', '1460140977', '{\"cate_name\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_icon\":\"\",\"cate_slug\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_meta_title\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_meta_description\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_meta_keyword\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460140977,\"user_created\":1,\"parent_id\":\"1\"}');
INSERT INTO `tbl_logs` VALUES ('32', 'backend', 'category', 'edit', '4', '1', '1460141264', '{\"cate_name\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_icon\":\"\",\"cate_slug\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_meta_title\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_meta_description\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_meta_keyword\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_sort\":2,\"cate_status\":\"1\",\"updated_date\":1460141264,\"user_updated\":1,\"parent_id\":1}');
INSERT INTO `tbl_logs` VALUES ('33', 'backend', 'category', 'edit', '4', '1', '1460141284', '{\"cate_name\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_icon\":\"\",\"cate_slug\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_meta_title\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_meta_description\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_meta_keyword\":\"kkkkkkkkkkkkkkkkkkkkkkkkkk\",\"cate_sort\":2,\"cate_status\":\"1\",\"updated_date\":1460141284,\"user_updated\":1,\"parent_id\":3}');
INSERT INTO `tbl_logs` VALUES ('34', 'backend', 'category', 'delete', '4', '1', '1460143501', '{\"cate_status\":-1,\"user_updated\":1,\"updated_date\":1460143501}');
INSERT INTO `tbl_logs` VALUES ('35', 'backend', 'category', 'delete', '4', '1', '1460143693', '{\"cate_status\":-1,\"user_updated\":1,\"updated_date\":1460143693}');
INSERT INTO `tbl_logs` VALUES ('36', 'backend', 'category', 'add', '5', '1', '1460365760', '{\"cate_name\":\"Nh\\u00e0 \\u0111\\u1ea5t\",\"cate_icon\":\"icon-home\",\"cate_slug\":\"nha-dat\",\"cate_meta_title\":\"Mua b\\u00e1n nh\\u00e0 \\u0111\\u1ea5t,\",\"cate_meta_description\":\"Mua b\\u00e1n nh\\u00e0 \\u0111\\u1ea5t,\",\"cate_meta_keyword\":\"Mua b\\u00e1n nh\\u00e0 \\u0111\\u1ea5t,\",\"cate_sort\":4,\"cate_status\":\"1\",\"created_date\":1460365760,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('37', 'backend', 'category', 'add', '6', '1', '1460365943', '{\"cate_name\":\"Ch\\u1ee3 Sim\",\"cate_icon\":\"icon-rss\",\"cate_slug\":\"cho-sim\",\"cate_meta_title\":\"Mua b\\u00e1n c\\u00e1c lo\\u1ea1i sim \\u0111i\\u1ec7n tho\\u1ea1i\",\"cate_meta_description\":\"Mua b\\u00e1n c\\u00e1c lo\\u1ea1i sim \\u0111i\\u1ec7n tho\\u1ea1i\",\"cate_meta_keyword\":\"Mua b\\u00e1n c\\u00e1c lo\\u1ea1i sim \\u0111i\\u1ec7n tho\\u1ea1i\",\"cate_sort\":5,\"cate_status\":\"1\",\"created_date\":1460365943,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('38', 'backend', 'category', 'add', '7', '1', '1460366064', '{\"cate_name\":\"\\u0110i\\u1ec7n m\\u00e1y\",\"cate_icon\":\"icon-camera\",\"cate_slug\":\"dien-may\",\"cate_meta_title\":\"\\u0110i\\u1ec7n m\\u00e1y\",\"cate_meta_description\":\"\\u0110i\\u1ec7n m\\u00e1y\",\"cate_meta_keyword\":\"\\u0110i\\u1ec7n m\\u00e1y\",\"cate_sort\":6,\"cate_status\":\"1\",\"created_date\":1460366063,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('39', 'backend', 'category', 'add', '8', '1', '1460366155', '{\"cate_name\":\"Th\\u1eddi trang\",\"cate_icon\":\"icon-female\",\"cate_slug\":\"thoi-trang\",\"cate_meta_title\":\"Th\\u1eddi trang\",\"cate_meta_description\":\"Th\\u1eddi trang\",\"cate_meta_keyword\":\"Th\\u1eddi trang\",\"cate_sort\":7,\"cate_status\":\"1\",\"created_date\":1460366155,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('40', 'backend', 'category', 'add', '9', '1', '1460366340', '{\"cate_name\":\"\\u00d4t\\u00f4\",\"cate_icon\":\"icon-truck\",\"cate_slug\":\"oto\",\"cate_meta_title\":\"\\u00d4t\\u00f4\",\"cate_meta_description\":\"\\u00d4t\\u00f4\",\"cate_meta_keyword\":\"\\u00d4t\\u00f4\",\"cate_sort\":8,\"cate_status\":\"1\",\"created_date\":1460366340,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('41', 'backend', 'category', 'add', '10', '1', '1460366775', '{\"cate_name\":\"Xe m\\u00e1y\",\"cate_icon\":\"icon-motorcycle\",\"cate_slug\":\"xe-may\",\"cate_meta_title\":\"Xe m\\u00e1y\",\"cate_meta_description\":\"Xe m\\u00e1y\",\"cate_meta_keyword\":\"Xe m\\u00e1y\",\"cate_sort\":9,\"cate_status\":\"1\",\"created_date\":1460366775,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('42', 'backend', 'category', 'add', '11', '1', '1460366898', '{\"cate_name\":\"Vui ch\\u01a1i - gi\\u1ea3i tr\\u00ed\",\"cate_icon\":\"icon-smile-o\",\"cate_slug\":\"vui-choi-giai-tri\",\"cate_meta_title\":\"Vui ch\\u01a1i - gi\\u1ea3i tr\\u00ed\",\"cate_meta_description\":\"Vui ch\\u01a1i - gi\\u1ea3i tr\\u00ed\",\"cate_meta_keyword\":\"Vui ch\\u01a1i - gi\\u1ea3i tr\\u00ed\",\"cate_sort\":10,\"cate_status\":\"1\",\"created_date\":1460366897,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('43', 'backend', 'category', 'add', '12', '1', '1460367104', '{\"cate_name\":\"D\\u1ecbch v\\u1ee5\",\"cate_icon\":\"icon-wrench\",\"cate_slug\":\"dich-vu\",\"cate_meta_title\":\"D\\u1ecbch v\\u1ee5\",\"cate_meta_description\":\"D\\u1ecbch v\\u1ee5\",\"cate_meta_keyword\":\"D\\u1ecbch v\\u1ee5\",\"cate_sort\":11,\"cate_status\":\"1\",\"created_date\":1460367104,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('44', 'backend', 'category', 'add', '13', '1', '1460367202', '{\"cate_name\":\"C\\u1ed9ng \\u0111\\u1ed3ng\",\"cate_icon\":\"icon-users\",\"cate_slug\":\"cong-dong\",\"cate_meta_title\":\"C\\u1ed9ng \\u0111\\u1ed3ng\",\"cate_meta_description\":\"C\\u1ed9ng \\u0111\\u1ed3ng\",\"cate_meta_keyword\":\"C\\u1ed9ng \\u0111\\u1ed3ng\",\"cate_sort\":12,\"cate_status\":\"1\",\"created_date\":1460367202,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('45', 'backend', 'category', 'add', '14', '1', '1460367324', '{\"cate_name\":\"Gi\\u00e1o d\\u1ee5c\",\"cate_icon\":\"icon-book\",\"cate_slug\":\"giao-duc\",\"cate_meta_title\":\"Gi\\u00e1o d\\u1ee5c\",\"cate_meta_description\":\"Gi\\u00e1o d\\u1ee5c\",\"cate_meta_keyword\":\"Gi\\u00e1o d\\u1ee5c\",\"cate_sort\":13,\"cate_status\":\"1\",\"created_date\":1460367324,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('46', 'backend', 'category', 'add', '15', '1', '1460367492', '{\"cate_name\":\"T\\u1ed5ng h\\u1ee3p\",\"cate_icon\":\"icon-shopping-cart\",\"cate_slug\":\"tong-hop\",\"cate_meta_title\":\"T\\u1ed5ng h\\u1ee3p\",\"cate_meta_description\":\"T\\u1ed5ng h\\u1ee3p\",\"cate_meta_keyword\":\"T\\u1ed5ng h\\u1ee3p\",\"cate_sort\":14,\"cate_status\":\"1\",\"created_date\":1460367492,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('47', 'backend', 'category', 'add', '16', '1', '1460367712', '{\"cate_name\":\"Tuy\\u1ec3n d\\u1ee5ng - vi\\u1ec7c l\\u00e0m\",\"cate_icon\":\"fa-thumbs-o-up\",\"cate_slug\":\"tuyen-dung-viec-lam\",\"cate_meta_title\":\"Tuy\\u1ec3n d\\u1ee5ng - vi\\u1ec7c l\\u00e0m\",\"cate_meta_description\":\"Tuy\\u1ec3n d\\u1ee5ng - vi\\u1ec7c l\\u00e0m\",\"cate_meta_keyword\":\"Tuy\\u1ec3n d\\u1ee5ng - vi\\u1ec7c l\\u00e0m\",\"cate_sort\":15,\"cate_status\":\"1\",\"created_date\":1460367712,\"user_created\":1,\"parent_id\":\"0\"}');

-- ----------------------------
-- Table structure for tbl_permisions
-- ----------------------------
DROP TABLE IF EXISTS `tbl_permisions`;
CREATE TABLE `tbl_permisions` (
  `perm_id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `user_created` int(11) NOT NULL,
  `updated_date` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `perm_status` int(11) DEFAULT '1',
  PRIMARY KEY (`perm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_permisions
-- ----------------------------
INSERT INTO `tbl_permisions` VALUES ('1', 'backend', 'content', 'index', '4', '0', '0', null, null, null, '-1');
INSERT INTO `tbl_permisions` VALUES ('2', 'backend', 'content', 'index', '4', '0', '0', null, null, null, '-1');

-- ----------------------------
-- Table structure for tbl_properties
-- ----------------------------
DROP TABLE IF EXISTS `tbl_properties`;
CREATE TABLE `tbl_properties` (
  `prop_id` int(11) NOT NULL AUTO_INCREMENT,
  `prop_name` varchar(255) NOT NULL,
  `prop_slug` varchar(255) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `created_date` int(11) NOT NULL,
  `updated_dated` int(11) DEFAULT NULL,
  PRIMARY KEY (`prop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_properties
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_subcribes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_subcribes`;
CREATE TABLE `tbl_subcribes` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` int(11) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_subcribes
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_tags
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tags`;
CREATE TABLE `tbl_tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) NOT NULL,
  `tag_slug` varchar(255) NOT NULL,
  `user_created` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `updated_date` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_tags
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_transaction_history
-- ----------------------------
DROP TABLE IF EXISTS `tbl_transaction_history`;
CREATE TABLE `tbl_transaction_history` (
  `tran_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `tran_type` int(11) NOT NULL DEFAULT '1' COMMENT '1:nộp tiền || 2 : mua víp tin',
  `user_blance` int(11) NOT NULL,
  `tran_deal` int(11) NOT NULL,
  `soucre_id` int(11) DEFAULT NULL COMMENT '1:viettel || 2: mobi || 3: vina',
  `cont_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tran_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_transaction_history
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_users
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_created` int(11) DEFAULT NULL,
  `created_date` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `updated_date` int(11) DEFAULT NULL,
  `social_profile_url` varchar(255) DEFAULT NULL,
  `user_balance` int(11) NOT NULL DEFAULT '0',
  `user_avatar` text,
  `user_status` int(11) DEFAULT '1' COMMENT '1: đang hoạt động || 0 : block || -1: đã xóa',
  `group_id` int(11) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_last_login` int(11) DEFAULT NULL,
  `user_login_ip` varchar(255) DEFAULT NULL,
  `user_fullname` varchar(255) DEFAULT NULL,
  `user_gender` int(11) DEFAULT NULL,
  `user_birthday` int(11) DEFAULT NULL,
  `random_key` varchar(255) DEFAULT NULL,
  `random_key_expried` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('1', 'admin', 'admin@raovat.vn', '0973531618', null, '34567890', null, null, null, '0', null, '1', '1', '4297f44b13955235245b2497399d7a93', '1460365647', '192.168.29.1', 'Admin', null, null, null, null);
INSERT INTO `tbl_users` VALUES ('2', '', 'ngocchien01@gmail.com', '0973531619', '1', '1460119396', '1', '1460124824', null, '0', null, '1', '3', '4297f44b13955235245b2497399d7a93', null, null, 'Nguyễn Ngọc Chiến', '1', '638902800', 'ef575e8837d065a1683c022d2077d3421460361729', '1460620929');
INSERT INTO `tbl_users` VALUES ('3', '', 'q@gmail.com', '0973531616', null, '1460344674', null, null, null, '0', null, '1', '5', '4297f44b13955235245b2497399d7a93', '1460344674', '192.168.29.1', 'Lê Na', null, null, null, null);
INSERT INTO `tbl_users` VALUES ('4', '', 'aaaaaa@gmail.com', '09090909090', null, '1460345415', null, null, null, '0', null, '1', '5', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', '1460345415', '192.168.29.1', 'aaaaaa', null, null, null, null);

-- ----------------------------
-- Table structure for tbl_vips
-- ----------------------------
DROP TABLE IF EXISTS `tbl_vips`;
CREATE TABLE `tbl_vips` (
  `vip_id` int(11) NOT NULL AUTO_INCREMENT,
  `vip_name` varchar(255) NOT NULL,
  `user_created` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `updated_date` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `vip_money` int(11) NOT NULL,
  `vip_description` varchar(255) DEFAULT NULL COMMENT 'mô tả để biết tác dụng',
  PRIMARY KEY (`vip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_vips
-- ----------------------------
