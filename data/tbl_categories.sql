/*
Navicat MySQL Data Transfer

Source Server         : vmw
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : raovat

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-04-14 00:10:37
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
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_categories
-- ----------------------------
INSERT INTO `tbl_categories` VALUES ('1', 'Điện thoại', 'dien-thoai', '1', '0', 'icon-mobile-phone', '1460140880', '1', null, null, 'điện thoại, rao vặt điện thoại,', 'điện thoại, rao vặt điện thoại,', 'điện thoại, rao vặt điện thoại,', null, '1', '0001:0001:');
INSERT INTO `tbl_categories` VALUES ('2', 'Máy tính', 'may-tinh', '2', '0', 'icon-desktop', '1460140913', '1', null, null, 'Rao vặt máy tính. máy tính để bàn', 'Rao vặt máy tính. máy tính để bàn', 'Rao vặt máy tính. máy tính để bàn', null, '1', '0002:0002:');
INSERT INTO `tbl_categories` VALUES ('3', 'USB', 'usb', '3', '0', 'icon-mobile-phone', '1460140949', '1', '1460558330', '1', 'Bán USB của các hãng Sony, samsung,usb 8G, usb 4G ....', 'Bán USB của các hãng Sony, samsung,usb 8G, usb 4G ....', 'Bán USB của các hãng Sony, samsung,usb 8G, usb 4G ....', null, '-1', '0003:0003:');
INSERT INTO `tbl_categories` VALUES ('4', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', '2', '3', '', '1460140977', '1', '1460143693', '1', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', null, '-1', '0003:0003:0002:0004:');
INSERT INTO `tbl_categories` VALUES ('5', 'Nhà đất', 'nha-dat', '4', '0', 'icon-home', '1460365760', '1', null, null, 'Mua bán nhà đất,', 'Mua bán nhà đất,', 'Mua bán nhà đất,', null, '1', '0004:0005:');
INSERT INTO `tbl_categories` VALUES ('6', 'Chợ Sim', 'cho-sim', '5', '0', 'icon-rss', '1460365943', '1', null, null, 'Mua bán các loại sim điện thoại', 'Mua bán các loại sim điện thoại', 'Mua bán các loại sim điện thoại', null, '1', '0005:0006:');
INSERT INTO `tbl_categories` VALUES ('7', 'Điện máy', 'dien-may', '6', '0', 'icon-camera', '1460366063', '1', null, null, 'Điện máy', 'Điện máy', 'Điện máy', null, '1', '0006:0007:');
INSERT INTO `tbl_categories` VALUES ('8', 'Thời trang', 'thoi-trang', '7', '0', 'icon-female', '1460366155', '1', null, null, 'Thời trang', 'Thời trang', 'Thời trang', null, '1', '0007:0008:');
INSERT INTO `tbl_categories` VALUES ('9', 'Ôtô', 'oto', '8', '0', 'icon-truck', '1460366340', '1', null, null, 'Ôtô', 'Ôtô', 'Ôtô', null, '1', '0008:0009:');
INSERT INTO `tbl_categories` VALUES ('10', 'Xe máy', 'xe-may', '6', '0', 'icon-motorcycle', '1460366775', '1', '1460510896', '1', 'Xe máy', 'Xe máy', 'Xe máy', null, '1', '0006:0010:');
INSERT INTO `tbl_categories` VALUES ('11', 'Vui chơi - giải trí', 'vui-choi-giai-tri', '5', '0', 'icon-smile-o', '1460366897', '1', '1460510932', '1', 'Vui chơi - giải trí', 'Vui chơi - giải trí', 'Vui chơi - giải trí', null, '1', '0005:0011:');
INSERT INTO `tbl_categories` VALUES ('12', 'Dịch vụ', 'dich-vu', '11', '0', 'icon-wrench', '1460367104', '1', null, null, 'Dịch vụ', 'Dịch vụ', 'Dịch vụ', null, '1', '0011:0012:');
INSERT INTO `tbl_categories` VALUES ('13', 'Cộng đồng', 'cong-dong', '12', '0', 'icon-users', '1460367202', '1', null, null, 'Cộng đồng', 'Cộng đồng', 'Cộng đồng', null, '1', '0012:0013:');
INSERT INTO `tbl_categories` VALUES ('14', 'Giáo dục', 'giao-duc', '13', '0', 'icon-book', '1460367324', '1', null, null, 'Giáo dục', 'Giáo dục', 'Giáo dục', null, '1', '0013:0014:');
INSERT INTO `tbl_categories` VALUES ('15', 'Tổng hợp', 'tong-hop', '14', '0', 'icon-shopping-cart', '1460367492', '1', null, null, 'Tổng hợp', 'Tổng hợp', 'Tổng hợp', null, '1', '0014:0015:');
INSERT INTO `tbl_categories` VALUES ('16', 'Tuyển dụng - việc làm', 'tuyen-dung-viec-lam', '3', '0', 'fa-briefcase ', '1460367712', '1', '1460510787', '1', 'Tuyển dụng - việc làm', 'Tuyển dụng - việc làm', 'Tuyển dụng - việc làm', null, '1', '0003:0016:');
INSERT INTO `tbl_categories` VALUES ('17', 'Samsung', 'samsung', '1', '1', '', '1460556033', '1', null, null, 'Samsung', 'Samsung', 'Samsung', null, '1', '0001:0001:0001:0017:');
INSERT INTO `tbl_categories` VALUES ('19', 'Nokia', 'nokia', '2', '1', '', '1460557724', '1', null, null, 'Nokia', 'Nokia', 'Nokia', null, '1', '0001:0001:0002:0019:');
INSERT INTO `tbl_categories` VALUES ('20', 'Sony', 'sony', '3', '1', '', '1460557808', '1', null, null, 'Sony', 'Sony', 'Sony', null, '1', '0001:0001:0003:0020:');
INSERT INTO `tbl_categories` VALUES ('21', 'HTC', 'htc', '4', '1', '', '1460558037', '1', null, null, 'HTC', 'HTC', 'HTC', null, '1', '0001:0001:0004:0021:');
INSERT INTO `tbl_categories` VALUES ('22', 'Iphone', 'iphone', '5', '1', '', '1460558152', '1', null, null, 'Iphone', 'Iphone', 'Iphone', null, '1', '0001:0001:0005:0022:');
INSERT INTO `tbl_categories` VALUES ('23', 'Laptop', 'laptop', '1', '2', '', '1460558189', '1', null, null, 'Laptop', 'Laptop', 'Laptop', null, '1', '0002:0002:0001:0023:');
INSERT INTO `tbl_categories` VALUES ('24', 'Máy tính để bàn', 'may-tinh-de-ban', '2', '2', '', '1460558215', '1', null, null, 'Máy tính để bàn', 'Máy tính để bàn', 'Máy tính để bàn', null, '1', '0002:0002:0002:0024:');
INSERT INTO `tbl_categories` VALUES ('25', 'Màn hình', 'man-hinh', '3', '2', '', '1460558251', '1', null, null, 'Màn hình', 'Màn hình', 'Màn hình', null, '1', '0002:0002:0003:0025:');
INSERT INTO `tbl_categories` VALUES ('26', 'Link kiện máy tính', 'link-kien-may-tinh', '4', '2', '', '1460558272', '1', null, null, 'Link kiện máy tính', 'Link kiện máy tính', 'Link kiện máy tính', null, '1', '0002:0002:0004:0026:');
INSERT INTO `tbl_categories` VALUES ('27', 'Máy chiếu, Máy in, Scan', 'may-chieu-may-in-scan', '4', '2', '', '1460558305', '1', null, null, 'Máy chiếu, Máy in, Scan', 'Máy chiếu, Máy in, Scan', 'Máy chiếu, Máy in, Scan', null, '1', '0002:0002:0004:0027:');
INSERT INTO `tbl_categories` VALUES ('28', 'Nhà ở', 'nha-o', '1', '5', '', '1460558366', '1', null, null, 'Nhà ở', 'Nhà ở', 'Nhà ở', null, '1', '0004:0005:0001:0028:');
INSERT INTO `tbl_categories` VALUES ('29', 'Nhà chung cư', 'nha-chung-cu', '2', '5', '', '1460558390', '1', null, null, 'Nhà chung cư', 'Nhà chung cư', 'Nhà chung cư', null, '1', '0004:0005:0002:0029:');
INSERT INTO `tbl_categories` VALUES ('30', 'Đất biệt thự, P.Lô', 'dat-biet-thu-plo', '3', '5', '', '1460558411', '1', null, null, 'Đất biệt thự, P.Lô', 'Đất biệt thự, P.Lô', 'Đất biệt thự, P.Lô', null, '1', '0004:0005:0003:0030:');
INSERT INTO `tbl_categories` VALUES ('31', 'C.Hàng, nơi kinh doanh', 'chang-noi-kinh-doanh', '4', '5', '', '1460558436', '1', null, null, 'C.Hàng, nơi kinh doanh', 'C.Hàng, nơi kinh doanh', 'C.Hàng, nơi kinh doanh', null, '1', '0004:0005:0004:0031:');
INSERT INTO `tbl_categories` VALUES ('32', 'N.Xưởng, Trang trại', 'nxuong-trang-trai', '5', '5', '', '1460558454', '1', null, null, 'N.Xưởng, Trang trại', 'N.Xưởng, Trang trại', 'N.Xưởng, Trang trại', null, '1', '0004:0005:0005:0032:');
INSERT INTO `tbl_categories` VALUES ('33', 'Vip, tứ quý, ngũ quý', 'vip-tu-quy-ngu-quy', '1', '6', '', '1460558495', '1', null, null, 'Vip, tứ quý, ngũ quý', 'Vip, tứ quý, ngũ quý', 'Vip, tứ quý, ngũ quý', null, '1', '0005:0006:0001:0033:');
INSERT INTO `tbl_categories` VALUES ('34', 'Sim năm sinh', 'sim-nam-sinh', '2', '6', '', '1460558519', '1', null, null, 'Sim năm sinh', 'Sim năm sinh', 'Sim năm sinh', null, '1', '0005:0006:0002:0034:');
INSERT INTO `tbl_categories` VALUES ('35', 'Sim lộc phát, thần tài', 'sim-loc-phat-than-tai', '3', '6', '', '1460558535', '1', null, null, 'Sim lộc phát, thần tài', 'Sim lộc phát, thần tài', 'Sim lộc phát, thần tài', null, '1', '0005:0006:0003:0035:');
INSERT INTO `tbl_categories` VALUES ('36', 'Sim giá rẻ', 'sim-gia-re', '4', '6', '', '1460558593', '1', null, null, 'Sim giá rẻ', 'Sim giá rẻ', 'Sim giá rẻ', null, '1', '0005:0006:0004:0036:');
INSERT INTO `tbl_categories` VALUES ('37', 'Sim tam hoa', 'sim-tam-hoa', '5', '6', '', '1460558617', '1', null, null, 'Sim tam hoa', 'Sim tam hoa', 'Sim tam hoa', null, '1', '0005:0006:0005:0037:');
INSERT INTO `tbl_categories` VALUES ('38', 'Tủ lạnh', 'tu-lanh', '1', '7', '', '1460558674', '1', null, null, 'Tủ lạnh', 'Tủ lạnh', 'Tủ lạnh', null, '1', '0006:0007:0001:0038:');
INSERT INTO `tbl_categories` VALUES ('39', 'Điều hòa', 'dieu-hoa', '2', '7', '', '1460558707', '1', null, null, 'Điều hòa', 'Điều hòa', 'Điều hòa', null, '1', '0006:0007:0002:0039:');
INSERT INTO `tbl_categories` VALUES ('40', 'Máy giặt', 'may-giat', '3', '7', '', '1460558721', '1', null, null, 'Máy giặt', 'Máy giặt', 'Máy giặt', null, '1', '0006:0007:0003:0040:');
INSERT INTO `tbl_categories` VALUES ('41', 'Điện gia dụng', 'dien-gia-dung', '4', '7', '', '1460558739', '1', null, null, 'Điện gia dụng', 'Điện gia dụng', 'Điện gia dụng', null, '1', '0006:0007:0004:0041:');
INSERT INTO `tbl_categories` VALUES ('42', 'Điện lạnh, điện máy khác', 'dien-lanh-dien-may-khac', '5', '7', '', '1460558757', '1', null, null, 'Điện lạnh, điện máy khác', 'Điện lạnh, điện máy khác', 'Điện lạnh, điện máy khác', null, '1', '0006:0007:0005:0042:');
INSERT INTO `tbl_categories` VALUES ('43', 'Quần áo', 'quan-ao', '1', '8', '', '1460558797', '1', null, null, 'Quần áo', 'Quần áo', 'Quần áo', null, '1', '0007:0008:0001:0043:');
INSERT INTO `tbl_categories` VALUES ('44', 'Giày, Túi, Phụ kiện', 'giay-tui-phu-kien', '2', '8', '', '1460558815', '1', null, null, 'Giày, Túi, Phụ kiện', 'Giày, Túi, Phụ kiện', 'Giày, Túi, Phụ kiện', null, '1', '0007:0008:0002:0044:');
INSERT INTO `tbl_categories` VALUES ('45', 'Hàng thanh lý, Giảm giá', 'hang-thanh-ly-giam-gia', '3', '8', '', '1460558830', '1', null, null, 'Hàng thanh lý, Giảm giá', 'Hàng thanh lý, Giảm giá', 'Hàng thanh lý, Giảm giá', null, '1', '0007:0008:0003:0045:');
INSERT INTO `tbl_categories` VALUES ('46', 'Thẩm mỹ, chăm sóc sắc đẹp', 'tham-my-cham-soc-sac-dep', '4', '8', '', '1460558859', '1', null, null, 'Thẩm mỹ, chăm sóc sắc đẹp', 'Thẩm mỹ, chăm sóc sắc đẹp', 'Thẩm mỹ, chăm sóc sắc đẹp', null, '1', '0007:0008:0004:0046:');
INSERT INTO `tbl_categories` VALUES ('47', 'Thời trang, Mỹ phẩm khác', 'thoi-trang-my-pham-khac', '5', '8', '', '1460558876', '1', null, null, 'Thời trang, Mỹ phẩm khác', 'Thời trang, Mỹ phẩm khác', 'Thời trang, Mỹ phẩm khác', null, '1', '0007:0008:0005:0047:');
INSERT INTO `tbl_categories` VALUES ('48', 'Xe tải', 'xe-tai', '1', '9', '', '1460558910', '1', null, null, 'Xe tải', 'Xe tải', 'Xe tải', null, '1', '0008:0009:0001:0048:');
INSERT INTO `tbl_categories` VALUES ('49', 'Xe công trình', 'xe-cong-trinh', '2', '9', '', '1460558924', '1', null, null, 'Xe công trình', 'Xe công trình', 'Xe công trình', null, '1', '0008:0009:0002:0049:');
INSERT INTO `tbl_categories` VALUES ('50', 'Độ xe, sơn sửa, phụ tùng ô tô', 'do-xe-son-sua-phu-tung-o-to', '3', '9', '', '1460558950', '1', null, null, 'Độ xe, sơn sửa, phụ tùng ô tô', 'Độ xe, sơn sửa, phụ tùng ô tô', 'Độ xe, sơn sửa, phụ tùng ô tô', null, '1', '0008:0009:0003:0050:');
INSERT INTO `tbl_categories` VALUES ('51', 'Xe khách, xe du lịch', 'xe-khach-xe-du-lich', '4', '9', '', '1460558998', '1', '1460559005', '1', 'Xe khách, xe du lịch', 'Xe khách, xe du lịch', 'Xe khách, xe du lịch', null, '1', '0008:0009:0004:0051:');
INSERT INTO `tbl_categories` VALUES ('52', 'Loại xe khác', 'loai-xe-khac', '5', '9', '', '1460559030', '1', null, null, 'Loại xe khác', 'Loại xe khác', 'Loại xe khác', null, '1', '0008:0009:0005:0052:');
INSERT INTO `tbl_categories` VALUES ('53', 'Honda', 'honda', '1', '10', '', '1460559068', '1', '1460511260', '1', 'Honda xe số', 'Honda xe số', 'Honda xe số', null, '1', '0006:0010:0001:0053:');
INSERT INTO `tbl_categories` VALUES ('54', 'Suzuki', 'suzuki', '2', '10', '', '1460559089', '1', null, null, 'Suzuki', 'Suzuki', 'Suzuki', null, '1', '0006:0010:0002:0054:');
INSERT INTO `tbl_categories` VALUES ('55', 'Yamaha', 'yamaha', '3', '10', '', '1460559100', '1', null, null, 'Yamaha', 'Yamaha', 'Yamaha', null, '1', '0006:0010:0003:0055:');
INSERT INTO `tbl_categories` VALUES ('56', 'Piaggio', 'piaggio', '4', '10', '', '1460559139', '1', null, null, 'Piaggio', 'Piaggio', 'Piaggio', null, '1', '0006:0010:0004:0056:');
INSERT INTO `tbl_categories` VALUES ('57', 'Xe máy Trung Quốc', 'xe-may-trung-quoc', '4', '10', '', '1460559168', '1', null, null, 'Xe máy Trung Quốc', 'Xe máy Trung Quốc', 'Xe máy Trung Quốc', null, '1', '0006:0010:0004:0057:');
INSERT INTO `tbl_categories` VALUES ('58', 'Xe máy khác', 'xe-may-khac', '5', '10', '', '1460559184', '1', '1460511294', '1', 'Xe máy, xe đạp khác', 'Xe máy, xe đạp khác', 'Xe máy, xe đạp khác', null, '1', '0006:0010:0005:0058:');
INSERT INTO `tbl_categories` VALUES ('59', 'Địa điểm vui chơi, giải trí', 'dia-diem-vui-choi-giai-tri', '1', '11', '', '1460559290', '1', null, null, 'Địa điểm vui chơi, giải trí', 'Địa điểm vui chơi, giải trí', 'Địa điểm vui chơi, giải trí', null, '1', '0005:0011:0001:0059:');
INSERT INTO `tbl_categories` VALUES ('60', 'Tour nội địa', 'tour-noi-dia', '2', '11', '', '1460559307', '1', null, null, 'Tour nội địa', 'Tour nội địa', 'Tour nội địa', null, '1', '0005:0011:0002:0060:');
INSERT INTO `tbl_categories` VALUES ('61', 'Tour nước ngoài', 'tour-nuoc-ngoai', '3', '11', '', '1460559324', '1', null, null, 'Tour nước ngoài', 'Tour nước ngoài', 'Tour nước ngoài', null, '1', '0005:0011:0003:0061:');
INSERT INTO `tbl_categories` VALUES ('62', 'Vé máy bay, tàu, xe', 've-may-bay-tau-xe', '3', '11', '', '1460559344', '1', null, null, 'Vé máy bay, tàu, xe', 'Vé máy bay, tàu, xe', 'Vé máy bay, tàu, xe', null, '1', '0005:0011:0003:0062:');
INSERT INTO `tbl_categories` VALUES ('63', 'Các DV vui chơi - giải trí khác', 'cac-dv-vui-choi-giai-tri-khac', '5', '11', '', '1460559380', '1', null, null, 'Các DV vui chơi - giải trí khác', 'Các DV vui chơi - giải trí khác', 'Các DV vui chơi - giải trí khác', null, '1', '0005:0011:0005:0063:');
INSERT INTO `tbl_categories` VALUES ('64', 'Bảo vệ, Vệ sỹ, Thám tử', 'bao-ve-ve-sy-tham-tu', '1', '12', '', '1460566538', '1', null, null, 'Bảo vệ, Vệ sỹ, Thám tử', 'Bảo vệ, Vệ sỹ, Thám tử', 'Bảo vệ, Vệ sỹ, Thám tử', null, '1', '0011:0012:0001:0064:');
INSERT INTO `tbl_categories` VALUES ('65', 'DV Sức khỏe - Thể hình', 'dv-suc-khoe-the-hinh', '2', '12', '', '1460566581', '1', null, null, 'DV Sức khỏe - Thể hình', 'DV Sức khỏe - Thể hình', 'DV Sức khỏe - Thể hình', null, '1', '0011:0012:0002:0065:');
INSERT INTO `tbl_categories` VALUES ('66', 'PR / Tổ chức sự kiện', 'pr-to-chuc-su-kien', '3', '12', '', '1460566600', '1', null, null, 'PR / Tổ chức sự kiện', 'PR / Tổ chức sự kiện', 'PR / Tổ chức sự kiện', null, '1', '0011:0012:0003:0066:');
INSERT INTO `tbl_categories` VALUES ('67', 'Lắp đặt ĐT, Internet, TH cáp', 'lap-dat-dt-internet-th-cap', '4', '12', '', '1460566623', '1', null, null, 'Lắp đặt ĐT, Internet, TH cáp', 'Lắp đặt ĐT, Internet, TH cáp', 'Lắp đặt ĐT, Internet, TH cáp', null, '1', '0011:0012:0004:0067:');
INSERT INTO `tbl_categories` VALUES ('68', 'Dịch vụ khác', 'dich-vu-khac', '5', '12', '', '1460566644', '1', null, null, 'Dịch vụ khác', 'Dịch vụ khác', 'Dịch vụ khác', null, '1', '0011:0012:0005:0068:');
INSERT INTO `tbl_categories` VALUES ('69', 'Hoạt động cộng đồng', 'hoat-dong-cong-dong', '1', '13', '', '1460566677', '1', null, null, 'Hoạt động cộng đồng', 'Hoạt động cộng đồng', 'Hoạt động cộng đồng', null, '1', '0012:0013:0001:0069:');
INSERT INTO `tbl_categories` VALUES ('70', 'Tình nguyện viên', 'tinh-nguyen-vien', '2', '13', '', '1460566689', '1', null, null, 'Tình nguyện viên', 'Tình nguyện viên', 'Tình nguyện viên', null, '1', '0012:0013:0002:0070:');
INSERT INTO `tbl_categories` VALUES ('71', 'Sự kiện', 'su-kien', '3', '13', '', '1460566703', '1', null, null, 'Sự kiện', 'Sự kiện', 'Sự kiện', null, '1', '0012:0013:0003:0071:');
INSERT INTO `tbl_categories` VALUES ('72', 'Tìm giấy tờ, nhắn tin', 'tim-giay-to-nhan-tin', '4', '13', '', '1460566741', '1', null, null, 'Tìm giấy tờ, nhắn tin', 'Tìm giấy tờ, nhắn tin', 'Tìm giấy tờ, nhắn tin', null, '1', '0012:0013:0004:0072:');
INSERT INTO `tbl_categories` VALUES ('73', 'Hoạt động khác', 'hoat-dong-khac', '5', '13', '', '1460566755', '1', null, null, 'Hoạt động khác', 'Hoạt động khác', 'Hoạt động khác', null, '1', '0012:0013:0005:0073:');
INSERT INTO `tbl_categories` VALUES ('74', 'Tuyển sinh TC, CĐ, ĐH', 'tuyen-sinh-tc-cd-dh', '1', '14', '', '1460566833', '1', null, null, 'Tuyển sinh TC, CĐ, ĐH', 'Tuyển sinh TC, CĐ, ĐH', 'Tuyển sinh TC, CĐ, ĐH', null, '1', '0013:0014:0001:0074:');
INSERT INTO `tbl_categories` VALUES ('75', 'Dạy nghề, sửa chữa', 'day-nghe-sua-chua', '3', '14', '', '1460567196', '1', null, null, 'Dạy nghề, sửa chữa', 'Dạy nghề, sửa chữa', 'Dạy nghề, sửa chữa', null, '1', '0013:0014:0003:0075:');
INSERT INTO `tbl_categories` VALUES ('76', 'Bằng lái các loại', 'bang-lai-cac-loai', '4', '14', '', '1460567276', '1', null, null, 'Bằng lái các loại', 'Bằng lái các loại', 'Bằng lái các loại', null, '1', '0013:0014:0004:0076:');
INSERT INTO `tbl_categories` VALUES ('77', 'Khai giảng lớp học', 'khai-giang-lop-hoc', '3', '14', '', '1460567342', '1', null, null, 'Khai giảng lớp học', 'Khai giảng lớp học', 'Khai giảng lớp học', null, '1', '0013:0014:0003:0077:');
INSERT INTO `tbl_categories` VALUES ('78', 'Tuyển sinh khác', 'tuyen-sinh-khac', '5', '14', '', '1460567360', '1', null, null, 'Tuyển sinh khác', 'Tuyển sinh khác', 'Tuyển sinh khác', null, '1', '0013:0014:0005:0078:');
INSERT INTO `tbl_categories` VALUES ('79', 'Việc tìm người', 'viec-tim-nguoi', '1', '16', '', '1460567727', '1', null, null, 'Việc tìm người', 'Việc tìm người', 'Việc tìm người', null, '1', '0003:0016:0001:0079:');
INSERT INTO `tbl_categories` VALUES ('80', 'Người tìm việc', 'nguoi-tim-viec', '2', '16', '', '1460507802', '1', null, null, 'Người tìm việc', 'Người tìm việc', 'Người tìm việc', null, '1', '0003:0016:0002:0080:');
INSERT INTO `tbl_categories` VALUES ('81', 'Khuyến mãi, Giảm giá', 'khuyen-mai-giam-gia', '1', '15', '', '1460507898', '1', null, null, 'Khuyến mãi, Giảm giá', 'Khuyến mãi, Giảm giá', 'Khuyến mãi, Giảm giá', null, '1', '0014:0015:0001:0081:');
INSERT INTO `tbl_categories` VALUES ('82', 'Kiếm tiền qua mạng', 'kiem-tien-qua-mang', '2', '15', '', '1460507930', '1', null, null, 'Kiếm tiền qua mạng', 'Kiếm tiền qua mạng', 'Kiếm tiền qua mạng', null, '1', '0014:0015:0002:0082:');
INSERT INTO `tbl_categories` VALUES ('83', 'Trả góp - Hỗ trợ vốn', 'tra-gop-ho-tro-von', '3', '15', '', '1460507971', '1', null, null, 'Trả góp - Hỗ trợ vốn', 'Trả góp - Hỗ trợ vốn', 'Trả góp - Hỗ trợ vốn', null, '1', '0014:0015:0003:0083:');
INSERT INTO `tbl_categories` VALUES ('84', 'Chứng khoán', 'chung-khoan', '4', '15', '', '1460508004', '1', null, null, 'Chứng khoán', 'Chứng khoán', 'Chứng khoán', null, '1', '0014:0015:0004:0084:');
INSERT INTO `tbl_categories` VALUES ('85', 'Khác', 'khac', '5', '15', '', '1460508037', '1', null, null, 'khác', 'khác', 'khác', null, '1', '0014:0015:0005:0085:');
INSERT INTO `tbl_categories` VALUES ('86', 'Chăm sóc sức khỏe', 'cham-soc-suc-khoe', '2', '16', '', '1460509203', '1', null, null, 'Chăm sóc sức khỏe', 'Chăm sóc sức khỏe', 'Chăm sóc sức khỏe', null, '1', '0003:0016:0002:0086:');
INSERT INTO `tbl_categories` VALUES ('87', 'PG-PB', 'pg-pb', '4', '16', '', '1460509254', '1', null, null, 'PG-PB', 'PG-PB', 'PG-PB', null, '1', '0003:0016:0004:0087:');
INSERT INTO `tbl_categories` VALUES ('88', 'Điện thoại khác', 'dien-thoai-khac', '6', '1', '', '1460509937', '1', null, null, 'Điện thoại khác', 'Điện thoại khác', 'Điện thoại khác', null, '1', '0001:0001:0006:0088:');
INSERT INTO `tbl_categories` VALUES ('89', 'Khác', 'khac', '6', '2', '', '1460510122', '1', null, null, 'khác', 'khác', 'khác', null, '1', '0002:0002:0006:0089:');
INSERT INTO `tbl_categories` VALUES ('90', 'Khác', 'khac', '6', '5', '', '1460510170', '1', null, null, 'Khác', 'Khác', 'Khác', null, '1', '0004:0005:0006:0090:');
INSERT INTO `tbl_categories` VALUES ('91', 'Khác', 'khac', '6', '6', '', '1460510200', '1', null, null, 'Khác', 'Khác', 'Khác', null, '1', '0005:0006:0006:0091:');
INSERT INTO `tbl_categories` VALUES ('92', 'Visa - hộ chiếu - Thông hành', 'visa-ho-chieu-thong-hanh', '4', '11', '', '1460510319', '1', null, null, 'Visa - hộ chiếu - Thông hành', 'Visa - hộ chiếu - Thông hành', 'Visa - hộ chiếu - Thông hành', null, '1', '0005:0011:0004:0092:');
INSERT INTO `tbl_categories` VALUES ('93', 'Vệ sinh, thông, tắc', 've-sinh-thong-tac', '4', '12', '', '1460510516', '1', null, null, 'Vệ sinh, thông, tắc', 'Vệ sinh, thông, tắc', 'Vệ sinh, thông, tắcLắp đặt ĐT, Internet, TH cáp', null, '1', '0011:0012:0004:0093:');
INSERT INTO `tbl_categories` VALUES ('94', 'Nhạc công, Nghệ sỹ, Ban nhạc', 'nhac-cong-nghe-sy-ban-nhac', '4', '13', '', '1460510563', '1', null, null, 'Nhạc công, Nghệ sỹ, Ban nhạc', 'Nhạc công, Nghệ sỹ, Ban nhạc', 'Nhạc công, Nghệ sỹ, Ban nhạc', null, '1', '0012:0013:0004:0094:');
INSERT INTO `tbl_categories` VALUES ('95', 'Thực tập sinh', 'thuc-tap-sinh', '4', '14', '', '1460510637', '1', null, null, 'Thực tập sinh', 'Thực tập sinh', 'Thực tập sinh', null, '1', '0013:0014:0004:0095:');
INSERT INTO `tbl_categories` VALUES ('96', 'Tư vấn - bảo hiểm', 'tu-van-bao-hiem', '4', '16', '', '1460510723', '1', null, null, 'Tư vấn - bảo hiểm', 'Tư vấn - bảo hiểm', 'Tư vấn - bảo hiểm', null, '1', '0003:0016:0004:0096:');
INSERT INTO `tbl_categories` VALUES ('97', 'Khác', 'khac', '6', '16', '', '1460510744', '1', null, null, 'khác', 'khác', 'khác', null, '1', '0003:0016:0006:0097:');
INSERT INTO `tbl_categories` VALUES ('98', 'Nóng lạnh', 'nong-lanh', '4', '7', '', '1460510992', '1', null, null, 'nóng lạnh', 'nóng lạnh', 'nóng lạnh', null, '1', '0006:0007:0004:0098:');
INSERT INTO `tbl_categories` VALUES ('99', 'Mỹ phẩm, trang sức', 'my-pham-trang-suc', '4', '8', '', '1460511058', '1', null, null, 'Mỹ phẩm, trang sức', 'Mỹ phẩm, trang sức', 'Mỹ phẩm, trang sức', null, '1', '0007:0008:0004:0099:');
INSERT INTO `tbl_categories` VALUES ('100', 'Xe chuyên dụng', 'xe-chuyen-dung', '4', '9', '', '1460511143', '1', null, null, 'Xe chuyên dụng', 'Xe chuyên dụng', 'Xe chuyên dụng', null, '1', '0008:0009:0004:0100:');
INSERT INTO `tbl_categories` VALUES ('101', 'In ấn, thiết kế, quảng cáo', 'in-an-thiet-ke-quang-cao', '4', '15', '', '1460511192', '1', null, null, 'In ấn, thiết kế, quảng cáo', 'In ấn, thiết kế, quảng cáo', 'In ấn, thiết kế, quảng cáo', null, '1', '0014:0015:0004:0101:');
