/*
Navicat MySQL Data Transfer

Source Server         : vmw
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : raovat

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-05-05 23:02:57
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
  `prop_id` int(11) DEFAULT NULL,
  `total_content` int(11) DEFAULT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_categories
-- ----------------------------
INSERT INTO `tbl_categories` VALUES ('1', 'Điện thoại', 'dien-thoai', '1', '0', 'icon-mobile-phone', '1460140880', '1', '1460646075', '1', 'điện thoại, rao vặt điện thoại,', 'điện thoại, rao vặt điện thoại,', 'điện thoại, rao vặt điện thoại,', null, '1', '0001:0001:', '25', '1');
INSERT INTO `tbl_categories` VALUES ('2', 'Máy tính', 'may-tinh', '2', '0', 'icon-desktop', '1460140913', '1', '1462441715', '1', 'Rao vặt máy tính. máy tính để bàn', 'Rao vặt máy tính. máy tính để bàn', 'Rao vặt máy tính. máy tính để bàn', null, '1', '0002:0002:', '25', null);
INSERT INTO `tbl_categories` VALUES ('3', 'USB', 'usb', '3', '0', 'icon-mobile-phone', '1460140949', '1', '1460558330', '1', 'Bán USB của các hãng Sony, samsung,usb 8G, usb 4G ....', 'Bán USB của các hãng Sony, samsung,usb 8G, usb 4G ....', 'Bán USB của các hãng Sony, samsung,usb 8G, usb 4G ....', null, '-1', '0003:0003:', null, null);
INSERT INTO `tbl_categories` VALUES ('4', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', '2', '3', '', '1460140977', '1', '1460143693', '1', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', null, '-1', '0003:0003:0002:0004:', null, null);
INSERT INTO `tbl_categories` VALUES ('5', 'Nhà đất', 'nha-dat', '4', '0', 'icon-home', '1460365760', '1', '1462441766', '1', 'Mua bán nhà đất,', 'Mua bán nhà đất,', 'Mua bán nhà đất,', null, '1', '0004:0005:', '18', null);
INSERT INTO `tbl_categories` VALUES ('6', 'Chợ Sim', 'cho-sim', '5', '0', 'icon-rss', '1460365943', '1', null, null, 'Mua bán các loại sim điện thoại', 'Mua bán các loại sim điện thoại', 'Mua bán các loại sim điện thoại', null, '1', '0005:0006:', null, null);
INSERT INTO `tbl_categories` VALUES ('7', 'Điện máy', 'dien-may', '6', '0', 'icon-camera', '1460366063', '1', null, null, 'Điện máy', 'Điện máy', 'Điện máy', null, '1', '0006:0007:', null, null);
INSERT INTO `tbl_categories` VALUES ('8', 'Thời trang', 'thoi-trang', '7', '0', 'icon-female', '1460366155', '1', null, null, 'Thời trang', 'Thời trang', 'Thời trang', null, '1', '0007:0008:', null, null);
INSERT INTO `tbl_categories` VALUES ('9', 'Ôtô', 'oto', '8', '0', 'icon-truck', '1460366340', '1', '1462441821', '1', 'Ôtô', 'Ôtô', 'Ôtô', null, '1', '0008:0009:', '11', null);
INSERT INTO `tbl_categories` VALUES ('10', 'Xe máy', 'xe-may', '6', '0', 'icon-motorcycle', '1460366775', '1', '1462441798', '1', 'Xe máy', 'Xe máy', 'Xe máy', null, '1', '0006:0010:', '11', null);
INSERT INTO `tbl_categories` VALUES ('11', 'Vui chơi - giải trí', 'vui-choi-giai-tri', '5', '0', 'icon-smile-o', '1460366897', '1', '1460510932', '1', 'Vui chơi - giải trí', 'Vui chơi - giải trí', 'Vui chơi - giải trí', null, '1', '0005:0011:', null, null);
INSERT INTO `tbl_categories` VALUES ('12', 'Dịch vụ', 'dich-vu', '11', '0', 'icon-wrench', '1460367104', '1', null, null, 'Dịch vụ', 'Dịch vụ', 'Dịch vụ', null, '1', '0011:0012:', null, null);
INSERT INTO `tbl_categories` VALUES ('13', 'Cộng đồng', 'cong-dong', '12', '0', 'icon-users', '1460367202', '1', null, null, 'Cộng đồng', 'Cộng đồng', 'Cộng đồng', null, '1', '0012:0013:', null, null);
INSERT INTO `tbl_categories` VALUES ('14', 'Giáo dục', 'giao-duc', '13', '0', 'icon-book', '1460367324', '1', null, null, 'Giáo dục', 'Giáo dục', 'Giáo dục', null, '1', '0013:0014:', null, null);
INSERT INTO `tbl_categories` VALUES ('15', 'Tổng hợp', 'tong-hop', '14', '0', 'icon-shopping-cart', '1460367492', '1', null, null, 'Tổng hợp', 'Tổng hợp', 'Tổng hợp', null, '1', '0014:0015:', null, null);
INSERT INTO `tbl_categories` VALUES ('16', 'Tuyển dụng - việc làm', 'tuyen-dung-viec-lam', '3', '0', 'fa-briefcase', '1460367712', '1', '1462441743', '1', 'Tuyển dụng - việc làm', 'Tuyển dụng - việc làm', 'Tuyển dụng - việc làm', null, '1', '0003:0016:', '4', null);
INSERT INTO `tbl_categories` VALUES ('17', 'Samsung', 'samsung', '1', '1', '', '1460556033', '1', null, null, 'Samsung', 'Samsung', 'Samsung', null, '1', '0001:0001:0001:0017:', null, '1');
INSERT INTO `tbl_categories` VALUES ('19', 'Nokia', 'nokia', '2', '1', '', '1460557724', '1', null, null, 'Nokia', 'Nokia', 'Nokia', null, '1', '0001:0001:0002:0019:', null, null);
INSERT INTO `tbl_categories` VALUES ('20', 'Sony', 'sony', '3', '1', '', '1460557808', '1', null, null, 'Sony', 'Sony', 'Sony', null, '1', '0001:0001:0003:0020:', null, null);
INSERT INTO `tbl_categories` VALUES ('21', 'HTC', 'htc', '4', '1', '', '1460558037', '1', null, null, 'HTC', 'HTC', 'HTC', null, '1', '0001:0001:0004:0021:', null, null);
INSERT INTO `tbl_categories` VALUES ('22', 'Iphone', 'iphone', '5', '1', '', '1460558152', '1', null, null, 'Iphone', 'Iphone', 'Iphone', null, '1', '0001:0001:0005:0022:', null, '1');
INSERT INTO `tbl_categories` VALUES ('23', 'Laptop', 'laptop', '1', '2', '', '1460558189', '1', null, null, 'Laptop', 'Laptop', 'Laptop', null, '1', '0002:0002:0001:0023:', null, null);
INSERT INTO `tbl_categories` VALUES ('24', 'Máy tính để bàn', 'may-tinh-de-ban', '2', '2', '', '1460558215', '1', null, null, 'Máy tính để bàn', 'Máy tính để bàn', 'Máy tính để bàn', null, '1', '0002:0002:0002:0024:', null, null);
INSERT INTO `tbl_categories` VALUES ('25', 'Màn hình', 'man-hinh', '3', '2', '', '1460558251', '1', null, null, 'Màn hình', 'Màn hình', 'Màn hình', null, '1', '0002:0002:0003:0025:', null, null);
INSERT INTO `tbl_categories` VALUES ('26', 'Link kiện máy tính', 'link-kien-may-tinh', '4', '2', '', '1460558272', '1', null, null, 'Link kiện máy tính', 'Link kiện máy tính', 'Link kiện máy tính', null, '1', '0002:0002:0004:0026:', null, null);
INSERT INTO `tbl_categories` VALUES ('27', 'Máy chiếu, Máy in, Scan', 'may-chieu-may-in-scan', '4', '2', '', '1460558305', '1', null, null, 'Máy chiếu, Máy in, Scan', 'Máy chiếu, Máy in, Scan', 'Máy chiếu, Máy in, Scan', null, '1', '0002:0002:0004:0027:', null, null);
INSERT INTO `tbl_categories` VALUES ('28', 'Nhà ở', 'nha-o', '1', '5', '', '1460558366', '1', null, null, 'Nhà ở', 'Nhà ở', 'Nhà ở', null, '1', '0004:0005:0001:0028:', null, null);
INSERT INTO `tbl_categories` VALUES ('29', 'Nhà chung cư', 'nha-chung-cu', '2', '5', '', '1460558390', '1', null, null, 'Nhà chung cư', 'Nhà chung cư', 'Nhà chung cư', null, '1', '0004:0005:0002:0029:', null, null);
INSERT INTO `tbl_categories` VALUES ('30', 'Đất biệt thự, P.Lô', 'dat-biet-thu-plo', '3', '5', '', '1460558411', '1', null, null, 'Đất biệt thự, P.Lô', 'Đất biệt thự, P.Lô', 'Đất biệt thự, P.Lô', null, '1', '0004:0005:0003:0030:', null, null);
INSERT INTO `tbl_categories` VALUES ('31', 'C.Hàng, nơi kinh doanh', 'chang-noi-kinh-doanh', '4', '5', '', '1460558436', '1', null, null, 'C.Hàng, nơi kinh doanh', 'C.Hàng, nơi kinh doanh', 'C.Hàng, nơi kinh doanh', null, '1', '0004:0005:0004:0031:', null, null);
INSERT INTO `tbl_categories` VALUES ('32', 'N.Xưởng, Trang trại', 'nxuong-trang-trai', '5', '5', '', '1460558454', '1', null, null, 'N.Xưởng, Trang trại', 'N.Xưởng, Trang trại', 'N.Xưởng, Trang trại', null, '1', '0004:0005:0005:0032:', null, null);
INSERT INTO `tbl_categories` VALUES ('33', 'Vip, tứ quý, ngũ quý', 'vip-tu-quy-ngu-quy', '1', '6', '', '1460558495', '1', null, null, 'Vip, tứ quý, ngũ quý', 'Vip, tứ quý, ngũ quý', 'Vip, tứ quý, ngũ quý', null, '1', '0005:0006:0001:0033:', null, null);
INSERT INTO `tbl_categories` VALUES ('34', 'Sim năm sinh', 'sim-nam-sinh', '2', '6', '', '1460558519', '1', null, null, 'Sim năm sinh', 'Sim năm sinh', 'Sim năm sinh', null, '1', '0005:0006:0002:0034:', null, null);
INSERT INTO `tbl_categories` VALUES ('35', 'Sim lộc phát, thần tài', 'sim-loc-phat-than-tai', '3', '6', '', '1460558535', '1', null, null, 'Sim lộc phát, thần tài', 'Sim lộc phát, thần tài', 'Sim lộc phát, thần tài', null, '1', '0005:0006:0003:0035:', null, null);
INSERT INTO `tbl_categories` VALUES ('36', 'Sim giá rẻ', 'sim-gia-re', '4', '6', '', '1460558593', '1', null, null, 'Sim giá rẻ', 'Sim giá rẻ', 'Sim giá rẻ', null, '1', '0005:0006:0004:0036:', null, null);
INSERT INTO `tbl_categories` VALUES ('37', 'Sim tam hoa', 'sim-tam-hoa', '5', '6', '', '1460558617', '1', null, null, 'Sim tam hoa', 'Sim tam hoa', 'Sim tam hoa', null, '1', '0005:0006:0005:0037:', null, null);
INSERT INTO `tbl_categories` VALUES ('38', 'Tủ lạnh', 'tu-lanh', '1', '7', '', '1460558674', '1', null, null, 'Tủ lạnh', 'Tủ lạnh', 'Tủ lạnh', null, '1', '0006:0007:0001:0038:', null, null);
INSERT INTO `tbl_categories` VALUES ('39', 'Điều hòa', 'dieu-hoa', '2', '7', '', '1460558707', '1', null, null, 'Điều hòa', 'Điều hòa', 'Điều hòa', null, '1', '0006:0007:0002:0039:', null, null);
INSERT INTO `tbl_categories` VALUES ('40', 'Máy giặt', 'may-giat', '3', '7', '', '1460558721', '1', null, null, 'Máy giặt', 'Máy giặt', 'Máy giặt', null, '1', '0006:0007:0003:0040:', null, null);
INSERT INTO `tbl_categories` VALUES ('41', 'Điện gia dụng', 'dien-gia-dung', '4', '7', '', '1460558739', '1', null, null, 'Điện gia dụng', 'Điện gia dụng', 'Điện gia dụng', null, '1', '0006:0007:0004:0041:', null, null);
INSERT INTO `tbl_categories` VALUES ('42', 'Điện lạnh, điện máy khác', 'dien-lanh-dien-may-khac', '5', '7', '', '1460558757', '1', null, null, 'Điện lạnh, điện máy khác', 'Điện lạnh, điện máy khác', 'Điện lạnh, điện máy khác', null, '1', '0006:0007:0005:0042:', null, null);
INSERT INTO `tbl_categories` VALUES ('43', 'Quần áo', 'quan-ao', '1', '8', '', '1460558797', '1', null, null, 'Quần áo', 'Quần áo', 'Quần áo', null, '1', '0007:0008:0001:0043:', null, null);
INSERT INTO `tbl_categories` VALUES ('44', 'Giày, Túi, Phụ kiện', 'giay-tui-phu-kien', '2', '8', '', '1460558815', '1', null, null, 'Giày, Túi, Phụ kiện', 'Giày, Túi, Phụ kiện', 'Giày, Túi, Phụ kiện', null, '1', '0007:0008:0002:0044:', null, null);
INSERT INTO `tbl_categories` VALUES ('45', 'Hàng thanh lý, Giảm giá', 'hang-thanh-ly-giam-gia', '3', '8', '', '1460558830', '1', null, null, 'Hàng thanh lý, Giảm giá', 'Hàng thanh lý, Giảm giá', 'Hàng thanh lý, Giảm giá', null, '1', '0007:0008:0003:0045:', null, null);
INSERT INTO `tbl_categories` VALUES ('46', 'Thẩm mỹ, chăm sóc sắc đẹp', 'tham-my-cham-soc-sac-dep', '4', '8', '', '1460558859', '1', null, null, 'Thẩm mỹ, chăm sóc sắc đẹp', 'Thẩm mỹ, chăm sóc sắc đẹp', 'Thẩm mỹ, chăm sóc sắc đẹp', null, '1', '0007:0008:0004:0046:', null, null);
INSERT INTO `tbl_categories` VALUES ('47', 'Thời trang, Mỹ phẩm khác', 'thoi-trang-my-pham-khac', '5', '8', '', '1460558876', '1', null, null, 'Thời trang, Mỹ phẩm khác', 'Thời trang, Mỹ phẩm khác', 'Thời trang, Mỹ phẩm khác', null, '1', '0007:0008:0005:0047:', null, null);
INSERT INTO `tbl_categories` VALUES ('48', 'Xe tải', 'xe-tai', '1', '9', '', '1460558910', '1', null, null, 'Xe tải', 'Xe tải', 'Xe tải', null, '1', '0008:0009:0001:0048:', null, null);
INSERT INTO `tbl_categories` VALUES ('49', 'Xe công trình', 'xe-cong-trinh', '2', '9', '', '1460558924', '1', null, null, 'Xe công trình', 'Xe công trình', 'Xe công trình', null, '1', '0008:0009:0002:0049:', null, null);
INSERT INTO `tbl_categories` VALUES ('50', 'Độ xe, sơn sửa, phụ tùng ô tô', 'do-xe-son-sua-phu-tung-o-to', '3', '9', '', '1460558950', '1', null, null, 'Độ xe, sơn sửa, phụ tùng ô tô', 'Độ xe, sơn sửa, phụ tùng ô tô', 'Độ xe, sơn sửa, phụ tùng ô tô', null, '1', '0008:0009:0003:0050:', null, null);
INSERT INTO `tbl_categories` VALUES ('51', 'Xe khách, xe du lịch', 'xe-khach-xe-du-lich', '4', '9', '', '1460558998', '1', '1460559005', '1', 'Xe khách, xe du lịch', 'Xe khách, xe du lịch', 'Xe khách, xe du lịch', null, '1', '0008:0009:0004:0051:', null, null);
INSERT INTO `tbl_categories` VALUES ('52', 'Loại xe khác', 'loai-xe-khac', '5', '9', '', '1460559030', '1', null, null, 'Loại xe khác', 'Loại xe khác', 'Loại xe khác', null, '1', '0008:0009:0005:0052:', null, null);
INSERT INTO `tbl_categories` VALUES ('53', 'Honda', 'honda', '1', '10', '', '1460559068', '1', '1460511260', '1', 'Honda xe số', 'Honda xe số', 'Honda xe số', null, '1', '0006:0010:0001:0053:', null, null);
INSERT INTO `tbl_categories` VALUES ('54', 'Suzuki', 'suzuki', '2', '10', '', '1460559089', '1', null, null, 'Suzuki', 'Suzuki', 'Suzuki', null, '1', '0006:0010:0002:0054:', null, null);
INSERT INTO `tbl_categories` VALUES ('55', 'Yamaha', 'yamaha', '3', '10', '', '1460559100', '1', null, null, 'Yamaha', 'Yamaha', 'Yamaha', null, '1', '0006:0010:0003:0055:', null, null);
INSERT INTO `tbl_categories` VALUES ('56', 'Piaggio', 'piaggio', '4', '10', '', '1460559139', '1', null, null, 'Piaggio', 'Piaggio', 'Piaggio', null, '1', '0006:0010:0004:0056:', null, null);
INSERT INTO `tbl_categories` VALUES ('57', 'Xe máy Trung Quốc', 'xe-may-trung-quoc', '4', '10', '', '1460559168', '1', null, null, 'Xe máy Trung Quốc', 'Xe máy Trung Quốc', 'Xe máy Trung Quốc', null, '1', '0006:0010:0004:0057:', null, null);
INSERT INTO `tbl_categories` VALUES ('58', 'Xe máy khác', 'xe-may-khac', '5', '10', '', '1460559184', '1', '1460511294', '1', 'Xe máy, xe đạp khác', 'Xe máy, xe đạp khác', 'Xe máy, xe đạp khác', null, '1', '0006:0010:0005:0058:', null, null);
INSERT INTO `tbl_categories` VALUES ('59', 'Địa điểm vui chơi, giải trí', 'dia-diem-vui-choi-giai-tri', '1', '11', '', '1460559290', '1', null, null, 'Địa điểm vui chơi, giải trí', 'Địa điểm vui chơi, giải trí', 'Địa điểm vui chơi, giải trí', null, '1', '0005:0011:0001:0059:', null, null);
INSERT INTO `tbl_categories` VALUES ('60', 'Tour nội địa', 'tour-noi-dia', '2', '11', '', '1460559307', '1', null, null, 'Tour nội địa', 'Tour nội địa', 'Tour nội địa', null, '1', '0005:0011:0002:0060:', null, null);
INSERT INTO `tbl_categories` VALUES ('61', 'Tour nước ngoài', 'tour-nuoc-ngoai', '3', '11', '', '1460559324', '1', null, null, 'Tour nước ngoài', 'Tour nước ngoài', 'Tour nước ngoài', null, '1', '0005:0011:0003:0061:', null, null);
INSERT INTO `tbl_categories` VALUES ('62', 'Vé máy bay, tàu, xe', 've-may-bay-tau-xe', '3', '11', '', '1460559344', '1', null, null, 'Vé máy bay, tàu, xe', 'Vé máy bay, tàu, xe', 'Vé máy bay, tàu, xe', null, '1', '0005:0011:0003:0062:', null, null);
INSERT INTO `tbl_categories` VALUES ('63', 'Các DV vui chơi - giải trí khác', 'cac-dv-vui-choi-giai-tri-khac', '5', '11', '', '1460559380', '1', null, null, 'Các DV vui chơi - giải trí khác', 'Các DV vui chơi - giải trí khác', 'Các DV vui chơi - giải trí khác', null, '1', '0005:0011:0005:0063:', null, null);
INSERT INTO `tbl_categories` VALUES ('64', 'Bảo vệ, Vệ sỹ, Thám tử', 'bao-ve-ve-sy-tham-tu', '1', '12', '', '1460566538', '1', null, null, 'Bảo vệ, Vệ sỹ, Thám tử', 'Bảo vệ, Vệ sỹ, Thám tử', 'Bảo vệ, Vệ sỹ, Thám tử', null, '1', '0011:0012:0001:0064:', null, null);
INSERT INTO `tbl_categories` VALUES ('65', 'DV Sức khỏe - Thể hình', 'dv-suc-khoe-the-hinh', '2', '12', '', '1460566581', '1', null, null, 'DV Sức khỏe - Thể hình', 'DV Sức khỏe - Thể hình', 'DV Sức khỏe - Thể hình', null, '1', '0011:0012:0002:0065:', null, null);
INSERT INTO `tbl_categories` VALUES ('66', 'PR / Tổ chức sự kiện', 'pr-to-chuc-su-kien', '3', '12', '', '1460566600', '1', null, null, 'PR / Tổ chức sự kiện', 'PR / Tổ chức sự kiện', 'PR / Tổ chức sự kiện', null, '1', '0011:0012:0003:0066:', null, null);
INSERT INTO `tbl_categories` VALUES ('67', 'Lắp đặt ĐT, Internet, TH cáp', 'lap-dat-dt-internet-th-cap', '4', '12', '', '1460566623', '1', null, null, 'Lắp đặt ĐT, Internet, TH cáp', 'Lắp đặt ĐT, Internet, TH cáp', 'Lắp đặt ĐT, Internet, TH cáp', null, '1', '0011:0012:0004:0067:', null, null);
INSERT INTO `tbl_categories` VALUES ('68', 'Dịch vụ khác', 'dich-vu-khac', '5', '12', '', '1460566644', '1', null, null, 'Dịch vụ khác', 'Dịch vụ khác', 'Dịch vụ khác', null, '1', '0011:0012:0005:0068:', null, null);
INSERT INTO `tbl_categories` VALUES ('69', 'Hoạt động cộng đồng', 'hoat-dong-cong-dong', '1', '13', '', '1460566677', '1', null, null, 'Hoạt động cộng đồng', 'Hoạt động cộng đồng', 'Hoạt động cộng đồng', null, '1', '0012:0013:0001:0069:', null, null);
INSERT INTO `tbl_categories` VALUES ('70', 'Tình nguyện viên', 'tinh-nguyen-vien', '2', '13', '', '1460566689', '1', null, null, 'Tình nguyện viên', 'Tình nguyện viên', 'Tình nguyện viên', null, '1', '0012:0013:0002:0070:', null, null);
INSERT INTO `tbl_categories` VALUES ('71', 'Sự kiện', 'su-kien', '3', '13', '', '1460566703', '1', null, null, 'Sự kiện', 'Sự kiện', 'Sự kiện', null, '1', '0012:0013:0003:0071:', null, null);
INSERT INTO `tbl_categories` VALUES ('72', 'Tìm giấy tờ, nhắn tin', 'tim-giay-to-nhan-tin', '4', '13', '', '1460566741', '1', null, null, 'Tìm giấy tờ, nhắn tin', 'Tìm giấy tờ, nhắn tin', 'Tìm giấy tờ, nhắn tin', null, '1', '0012:0013:0004:0072:', null, null);
INSERT INTO `tbl_categories` VALUES ('73', 'Hoạt động khác', 'hoat-dong-khac', '5', '13', '', '1460566755', '1', null, null, 'Hoạt động khác', 'Hoạt động khác', 'Hoạt động khác', null, '1', '0012:0013:0005:0073:', null, null);
INSERT INTO `tbl_categories` VALUES ('74', 'Tuyển sinh TC, CĐ, ĐH', 'tuyen-sinh-tc-cd-dh', '1', '14', '', '1460566833', '1', null, null, 'Tuyển sinh TC, CĐ, ĐH', 'Tuyển sinh TC, CĐ, ĐH', 'Tuyển sinh TC, CĐ, ĐH', null, '1', '0013:0014:0001:0074:', null, null);
INSERT INTO `tbl_categories` VALUES ('75', 'Dạy nghề, sửa chữa', 'day-nghe-sua-chua', '3', '14', '', '1460567196', '1', null, null, 'Dạy nghề, sửa chữa', 'Dạy nghề, sửa chữa', 'Dạy nghề, sửa chữa', null, '1', '0013:0014:0003:0075:', null, null);
INSERT INTO `tbl_categories` VALUES ('76', 'Bằng lái các loại', 'bang-lai-cac-loai', '4', '14', '', '1460567276', '1', null, null, 'Bằng lái các loại', 'Bằng lái các loại', 'Bằng lái các loại', null, '1', '0013:0014:0004:0076:', null, null);
INSERT INTO `tbl_categories` VALUES ('77', 'Khai giảng lớp học', 'khai-giang-lop-hoc', '3', '14', '', '1460567342', '1', null, null, 'Khai giảng lớp học', 'Khai giảng lớp học', 'Khai giảng lớp học', null, '1', '0013:0014:0003:0077:', null, null);
INSERT INTO `tbl_categories` VALUES ('78', 'Tuyển sinh khác', 'tuyen-sinh-khac', '5', '14', '', '1460567360', '1', null, null, 'Tuyển sinh khác', 'Tuyển sinh khác', 'Tuyển sinh khác', null, '1', '0013:0014:0005:0078:', null, null);
INSERT INTO `tbl_categories` VALUES ('79', 'Việc tìm người', 'viec-tim-nguoi', '1', '16', '', '1460567727', '1', null, null, 'Việc tìm người', 'Việc tìm người', 'Việc tìm người', null, '1', '0003:0016:0001:0079:', null, null);
INSERT INTO `tbl_categories` VALUES ('80', 'Người tìm việc', 'nguoi-tim-viec', '2', '16', '', '1460507802', '1', null, null, 'Người tìm việc', 'Người tìm việc', 'Người tìm việc', null, '1', '0003:0016:0002:0080:', null, null);
INSERT INTO `tbl_categories` VALUES ('81', 'Khuyến mãi, Giảm giá', 'khuyen-mai-giam-gia', '1', '15', '', '1460507898', '1', null, null, 'Khuyến mãi, Giảm giá', 'Khuyến mãi, Giảm giá', 'Khuyến mãi, Giảm giá', null, '1', '0014:0015:0001:0081:', null, null);
INSERT INTO `tbl_categories` VALUES ('82', 'Kiếm tiền qua mạng', 'kiem-tien-qua-mang', '2', '15', '', '1460507930', '1', null, null, 'Kiếm tiền qua mạng', 'Kiếm tiền qua mạng', 'Kiếm tiền qua mạng', null, '1', '0014:0015:0002:0082:', null, null);
INSERT INTO `tbl_categories` VALUES ('83', 'Trả góp - Hỗ trợ vốn', 'tra-gop-ho-tro-von', '3', '15', '', '1460507971', '1', null, null, 'Trả góp - Hỗ trợ vốn', 'Trả góp - Hỗ trợ vốn', 'Trả góp - Hỗ trợ vốn', null, '1', '0014:0015:0003:0083:', null, null);
INSERT INTO `tbl_categories` VALUES ('84', 'Chứng khoán', 'chung-khoan', '4', '15', '', '1460508004', '1', null, null, 'Chứng khoán', 'Chứng khoán', 'Chứng khoán', null, '1', '0014:0015:0004:0084:', null, null);
INSERT INTO `tbl_categories` VALUES ('85', 'Khác', 'khac', '5', '15', '', '1460508037', '1', null, null, 'khác', 'khác', 'khác', null, '1', '0014:0015:0005:0085:', null, null);
INSERT INTO `tbl_categories` VALUES ('86', 'Chăm sóc sức khỏe', 'cham-soc-suc-khoe', '2', '16', '', '1460509203', '1', null, null, 'Chăm sóc sức khỏe', 'Chăm sóc sức khỏe', 'Chăm sóc sức khỏe', null, '1', '0003:0016:0002:0086:', null, null);
INSERT INTO `tbl_categories` VALUES ('87', 'PG-PB', 'pg-pb', '4', '16', '', '1460509254', '1', null, null, 'PG-PB', 'PG-PB', 'PG-PB', null, '1', '0003:0016:0004:0087:', null, null);
INSERT INTO `tbl_categories` VALUES ('88', 'Điện thoại khác', 'dien-thoai-khac', '6', '1', '', '1460509937', '1', null, null, 'Điện thoại khác', 'Điện thoại khác', 'Điện thoại khác', null, '1', '0001:0001:0006:0088:', null, null);
INSERT INTO `tbl_categories` VALUES ('89', 'Khác', 'khac', '6', '2', '', '1460510122', '1', null, null, 'khác', 'khác', 'khác', null, '1', '0002:0002:0006:0089:', null, null);
INSERT INTO `tbl_categories` VALUES ('90', 'Khác', 'khac', '6', '5', '', '1460510170', '1', null, null, 'Khác', 'Khác', 'Khác', null, '1', '0004:0005:0006:0090:', null, null);
INSERT INTO `tbl_categories` VALUES ('91', 'Khác', 'khac', '6', '6', '', '1460510200', '1', null, null, 'Khác', 'Khác', 'Khác', null, '1', '0005:0006:0006:0091:', null, null);
INSERT INTO `tbl_categories` VALUES ('92', 'Visa - hộ chiếu - Thông hành', 'visa-ho-chieu-thong-hanh', '4', '11', '', '1460510319', '1', null, null, 'Visa - hộ chiếu - Thông hành', 'Visa - hộ chiếu - Thông hành', 'Visa - hộ chiếu - Thông hành', null, '1', '0005:0011:0004:0092:', null, null);
INSERT INTO `tbl_categories` VALUES ('93', 'Vệ sinh, thông, tắc', 've-sinh-thong-tac', '4', '12', '', '1460510516', '1', null, null, 'Vệ sinh, thông, tắc', 'Vệ sinh, thông, tắc', 'Vệ sinh, thông, tắcLắp đặt ĐT, Internet, TH cáp', null, '1', '0011:0012:0004:0093:', null, null);
INSERT INTO `tbl_categories` VALUES ('94', 'Nhạc công, Nghệ sỹ, Ban nhạc', 'nhac-cong-nghe-sy-ban-nhac', '4', '13', '', '1460510563', '1', null, null, 'Nhạc công, Nghệ sỹ, Ban nhạc', 'Nhạc công, Nghệ sỹ, Ban nhạc', 'Nhạc công, Nghệ sỹ, Ban nhạc', null, '1', '0012:0013:0004:0094:', null, null);
INSERT INTO `tbl_categories` VALUES ('95', 'Thực tập sinh', 'thuc-tap-sinh', '4', '14', '', '1460510637', '1', null, null, 'Thực tập sinh', 'Thực tập sinh', 'Thực tập sinh', null, '1', '0013:0014:0004:0095:', null, null);
INSERT INTO `tbl_categories` VALUES ('96', 'Tư vấn - bảo hiểm', 'tu-van-bao-hiem', '4', '16', '', '1460510723', '1', null, null, 'Tư vấn - bảo hiểm', 'Tư vấn - bảo hiểm', 'Tư vấn - bảo hiểm', null, '1', '0003:0016:0004:0096:', null, null);
INSERT INTO `tbl_categories` VALUES ('97', 'Khác', 'khac', '6', '16', '', '1460510744', '1', null, null, 'khác', 'khác', 'khác', null, '1', '0003:0016:0006:0097:', null, null);
INSERT INTO `tbl_categories` VALUES ('98', 'Nóng lạnh', 'nong-lanh', '4', '7', '', '1460510992', '1', null, null, 'nóng lạnh', 'nóng lạnh', 'nóng lạnh', null, '1', '0006:0007:0004:0098:', null, null);
INSERT INTO `tbl_categories` VALUES ('99', 'Mỹ phẩm, trang sức', 'my-pham-trang-suc', '4', '8', '', '1460511058', '1', null, null, 'Mỹ phẩm, trang sức', 'Mỹ phẩm, trang sức', 'Mỹ phẩm, trang sức', null, '1', '0007:0008:0004:0099:', null, null);
INSERT INTO `tbl_categories` VALUES ('100', 'Xe chuyên dụng', 'xe-chuyen-dung', '4', '9', '', '1460511143', '1', null, null, 'Xe chuyên dụng', 'Xe chuyên dụng', 'Xe chuyên dụng', null, '1', '0008:0009:0004:0100:', null, null);
INSERT INTO `tbl_categories` VALUES ('101', 'In ấn, thiết kế, quảng cáo', 'in-an-thiet-ke-quang-cao', '4', '15', '', '1460511192', '1', null, null, 'In ấn, thiết kế, quảng cáo', 'In ấn, thiết kế, quảng cáo', 'In ấn, thiết kế, quảng cáo', null, '1', '0014:0015:0004:0101:', null, null);

-- ----------------------------
-- Table structure for tbl_comments
-- ----------------------------
DROP TABLE IF EXISTS `tbl_comments`;
CREATE TABLE `tbl_comments` (
  `comm_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT '0',
  `comm_content` text NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_date` int(11) NOT NULL,
  `user_avatar` text,
  `cont_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`comm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_comments
-- ----------------------------
INSERT INTO `tbl_comments` VALUES ('1', '0', '', 'Ngọc Chiến Nguyễn', 'chiennguyenngoc@hhdgroup.com', '7', '1461551026', '', '5');
INSERT INTO `tbl_comments` VALUES ('2', '0', '', 'Ngọc Chiến Nguyễn', 'chiennguyenngoc@hhdgroup.com', '7', '1461551160', '', '5');
INSERT INTO `tbl_comments` VALUES ('3', '0', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 'Ngọc Chiến Nguyễn', 'chiennguyenngoc@hhdgroup.com', '7', '1461551564', '', '5');
INSERT INTO `tbl_comments` VALUES ('4', '0', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Nguyễn Ngọc Chiến', 'ngocchien01@gmail.com', '2', '1461628459', '', '5');
INSERT INTO `tbl_comments` VALUES ('5', '0', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Nguyễn Ngọc Chiến', 'ngocchien01@gmail.com', '2', '1461628583', '', '5');
INSERT INTO `tbl_comments` VALUES ('6', '0', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Nguyễn Ngọc Chiến', 'ngocchien01@gmail.com', '2', '1461628685', '', '5');
INSERT INTO `tbl_comments` VALUES ('7', '0', '5 Triệu mua được pm 0973531618', 'Nguyễn Ngọc Chiến', 'ngocchien01@gmail.com', null, '1462338176', null, '10');
INSERT INTO `tbl_comments` VALUES ('8', '0', '5 Triệu mua được pm 0973531618', 'Nguyễn Ngọc Chiến', 'ngocchien01@gmail.com', null, '1462338381', null, '10');
INSERT INTO `tbl_comments` VALUES ('9', '0', 'Liên hệ với mình nhé 0973531618', 'Nguyễn Ngọc Chiến', 'ngocchien01@gmail.com', null, '1462338591', null, '10');

-- ----------------------------
-- Table structure for tbl_contact
-- ----------------------------
DROP TABLE IF EXISTS `tbl_contact`;
CREATE TABLE `tbl_contact` (
  `contatc_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_title` varchar(255) NOT NULL,
  `contact_content` text NOT NULL,
  `created_date` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_info` text,
  `status` int(11) DEFAULT '0',
  `updated_date` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`contatc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_contact
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_contents
-- ----------------------------
DROP TABLE IF EXISTS `tbl_contents`;
CREATE TABLE `tbl_contents` (
  `cont_id` int(11) NOT NULL AUTO_INCREMENT,
  `cont_title` varchar(255) NOT NULL,
  `cont_slug` varchar(255) NOT NULL,
  `cont_detail` text NOT NULL,
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
  `cont_image` text,
  `modified_date` int(11) DEFAULT NULL,
  `cont_detail_text` text,
  `dist_id` int(11) DEFAULT NULL,
  `total_content` int(11) DEFAULT NULL,
  PRIMARY KEY (`cont_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_contents
-- ----------------------------
INSERT INTO `tbl_contents` VALUES ('1', 'Mua lumia 1202', 'mua-lumia-1202', '<p><span\nstyle=\"color: #333399;\">aaaaaaaaaaaa &nbsp;<span\nstyle=\"font-size: 14pt;\">\'aaaaaaaaaaaaaaaaaaaa\'&nbsp;<span\nstyle=\"background-color: #666699;\">\'aaaaaaaaaaaaaaaaaaaaa\',&nbsp;<span\nstyle=\"background-color: #ffff00;\">aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</span></span></span></span></p>', '1461030036', '7', '1462103897', '7', '19', null, null, null, '0', null, null, '27', '0', null, null, '-1', '192.168.29.1', '[\"{\\\"sourceImage\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/1461029604.8325.jpg\\\",\\\"thumbImage\\\":{\\\"150x100\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/thumbs\\\\\\/150x100\\\\\\/1461029604.8325.jpg\\\",\\\"224x224\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/thumbs\\\\\\/224x224\\\\\\/1461029604.8325.jpg\\\",\\\"291x250\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/thumbs\\\\\\/291x250\\\\\\/1461029604.8325.jpg\\\"}}\"]', null, null, null, null);
INSERT INTO `tbl_contents` VALUES ('2', 'Mua lumia 1202 gi&aacute; si&ecirc;u rẻ :((((', 'mua-lumia-1202-gia-sieu-re', '<p><span\nstyle=\"color: #333399;\">aaaaaaaaaaaa &nbsp;<span\nstyle=\"font-size: 14pt;\">\'aaaaaaaaaaaaaaaaaaaa\'&nbsp;<span\nstyle=\"background-color: #666699;\">\'aaaaaaaaaaaaaaaaaaaaa\',&nbsp;<span\nstyle=\"background-color: #ffff00;\">aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</span></span></span></span></p>', '1461030740', '7', '1462104067', '7', '19', null, null, null, '0', null, null, '27', '0', null, null, '-1', '192.168.29.1', '[\"{\\\"sourceImage\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/1461029604.8325.jpg\\\",\\\"thumbImage\\\":{\\\"150x100\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/thumbs\\\\\\/150x100\\\\\\/1461029604.8325.jpg\\\",\\\"224x224\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/thumbs\\\\\\/224x224\\\\\\/1461029604.8325.jpg\\\",\\\"291x250\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/thumbs\\\\\\/291x250\\\\\\/1461029604.8325.jpg\\\"}}\"]', null, null, null, null);
INSERT INTO `tbl_contents` VALUES ('3', 'B&aacute;n HTC gi&aacute; b&egrave;o vl', 'ban-htc-gia-beo-vl', '<p><span\nstyle=\"font-size: 12pt;\">B&aacute;n 1 c&aacute;i HTC gi&aacute; b&egrave;o như con m&egrave;o&nbsp;<span\nstyle=\"color: #ff6600;\">! 300k mua nh&agrave;o z&ocirc; lẹ</span></span></p><p><span\nstyle=\"font-size: 12pt;\"><span\nstyle=\"color: #ff6600;\">Số đt : 0973531618</span></span></p>', '1461031401', '7', null, null, '21', null, null, null, '0', null, null, '27', '0', null, null, '1', '192.168.29.1', '[\"{\\\"sourceImage\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/1461031335.3865.jpg\\\",\\\"thumbImage\\\":{\\\"150x100\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/thumbs\\\\\\/150x100\\\\\\/1461031335.3865.jpg\\\",\\\"224x224\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/thumbs\\\\\\/224x224\\\\\\/1461031335.3865.jpg\\\",\\\"291x250\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/thumbs\\\\\\/291x250\\\\\\/1461031335.3865.jpg\\\"}}\"]', null, null, null, null);
INSERT INTO `tbl_contents` VALUES ('4', 'B&aacute;n th&ecirc;m 1 c&aacute;i htc gi&aacute; b&egrave;o nh&egrave;o nữa', 'ban-them-1-cai-htc-gia-beo-nheo-nua', '<p><span\nstyle=\"font-size: 12pt; background-color: #00ff00;\">B&aacute;n HTC lấy tiền cưới vợ :d. Li&ecirc;n hệ : 0973531618</span></p>', '1461031535', '7', null, null, '21', null, null, null, '0', null, null, '27', '2', null, null, '1', '192.168.29.1', '[\"{\\\"sourceImage\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/1461031490.1922.jpg\\\",\\\"thumbImage\\\":{\\\"150x100\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/thumbs\\\\\\/150x100\\\\\\/1461031490.1922.jpg\\\",\\\"224x224\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/thumbs\\\\\\/224x224\\\\\\/1461031490.1922.jpg\\\",\\\"291x250\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/19\\\\\\/thumbs\\\\\\/291x250\\\\\\/1461031490.1922.jpg\\\"}}\"]', null, null, null, null);
INSERT INTO `tbl_contents` VALUES ('5', 'Cần b&aacute;n 1 glaxy s7 gi&aacute; c&ugrave;i bắp ai mua d&ugrave;m c&aacute;i đ&ecirc;', 'can-ban-1-glaxy-s7-gia-cui-bap-ai-mua-dum-cai-de', '<p\nclass=\"MsoNormal\" style=\"margin: 1.2em 0px; padding: 0px; color: #3b454f; font-family: Arial, sans-serif; font-size: 13px; text-align: justify; line-height: 19.5px;\"><strong><span\nstyle=\"line-height: 28px; font-size: 14pt; color: red;\">* Giới thiệu về giagiam.vn:</span></strong></p><p\nclass=\"MsoNormal\" style=\"margin: 1.2em 0px; padding: 0px; color: #3b454f; font-family: Arial, sans-serif; font-size: 13px; text-align: justify; text-indent: 0.5in; line-height: 19.5px;\"><span\nstyle=\"line-height: 28px; font-size: 14pt;\">&nbsp;Với khẩu hiệu&nbsp;<strong><span\nstyle=\"line-height: 29.8667px; color: #00b050;\">\" Chia sẻ g&aacute;nh nặng doanh thu c&ugrave;ng doanh nghiệp\"</span></strong>&nbsp;Gi&aacute; Giảm sẽ mang đến cho đối t&aacute;c những đơn h&agrave;ng gi&aacute; trị v&agrave; chất lượng dịch vụ tốt nhất.</span></p><p\nclass=\"MsoNormal\" style=\"margin: 1.2em 0px; padding: 0px; color: #3b454f; font-family: Arial, sans-serif; font-size: 13px; text-align: justify; line-height: 19.5px;\"><strong><span\nstyle=\"line-height: 28px; font-size: 14pt; color: red;\">* V&igrave; sao chọn giagiam.vn:</span></strong></p><p\nclass=\"MsoNormal\" style=\"margin: 1.2em 0px; padding: 0px; color: #3b454f; font-family: Arial, sans-serif; font-size: 13px; text-align: justify; text-indent: 0.5in; line-height: 19.5px;\"><span\nstyle=\"line-height: 28px; font-size: 14pt;\">- &nbsp;Đề cao lợi &iacute;ch b&aacute;n h&agrave;ng của đối t&aacute;c.</span></p><p\nclass=\"MsoNormal\" style=\"margin: 1.2em 0px; padding: 0px; color: #3b454f; font-family: Arial, sans-serif; font-size: 13px; text-align: justify; text-indent: 0.5in; line-height: 19.5px;\"><span\nstyle=\"line-height: 28px; font-size: 14pt; text-indent: 0.5in;\">- &nbsp;Bạn kh&ocirc;ng mất bất cứ chi ph&iacute; n&agrave;o nhưng vẫn c&oacute; đơn h&agrave;ng.</span></p><p\nclass=\"MsoNormal\" style=\"margin: 1.2em 0px; padding: 0px; color: #3b454f; font-family: Arial, sans-serif; font-size: 13px; text-align: justify; text-indent: 0.5in; line-height: 19.5px;\"><span\nstyle=\"line-height: 28px; font-size: 14pt; text-indent: 0.5in;\">- &nbsp;Chất lượng dịch vụ hỗ trợ b&aacute;n h&agrave;ng rất hiệu quả.</span></p><p\nclass=\"MsoNormal\" style=\"margin: 1.2em 0px; padding: 0px; color: #3b454f; font-family: Arial, sans-serif; font-size: 13px; text-align: justify; text-indent: 0.5in; line-height: 19.5px;\"><span\nstyle=\"line-height: 28px; font-size: 14pt; text-indent: 0.5in;\">- &nbsp;Ph&aacute;t triển thị trường, mở rộng thị phần.</span></p><p\nclass=\"MsoNormal\" style=\"margin: 1.2em 0px; padding: 0px; color: #3b454f; font-family: Arial, sans-serif; font-size: 13px; text-align: justify; text-indent: 0.5in; line-height: 19.5px;\"><span\nstyle=\"line-height: 28px; font-size: 14pt;\">- X&acirc;y dựng nền m&oacute;ng thương hiệu vững chắc.</span></p><p\nclass=\"MsoNormal\" style=\"margin: 1.2em 0px; padding: 0px; color: #3b454f; font-family: Arial, sans-serif; font-size: 13px; text-align: justify; line-height: 19.5px;\"><strong><span\nstyle=\"line-height: 28px; font-size: 14pt; color: red;\">* Lợi &iacute;ch khi tham gia hợp t&aacute;c c&ugrave;ng giagiam.vn:</span></strong></p>', '1461435123', '7', null, null, '17', null, null, null, '0', null, null, '27', '323', null, null, '1', '192.168.29.1', '[\"{\\\"sourceImage\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/1461435052.681.jpg\\\",\\\"thumbImage\\\":{\\\"150x100\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/150x100\\\\\\/1461435052.681.jpg\\\",\\\"224x224\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/224x224\\\\\\/1461435052.681.jpg\\\",\\\"291x250\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/291x250\\\\\\/1461435052.681.jpg\\\",\\\"490x294\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/490x294\\\\\\/1461435052.681.jpg\\\"}}\",\"{\\\"sourceImage\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/1461435055.5822.jpg\\\",\\\"thumbImage\\\":{\\\"150x100\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/150x100\\\\\\/1461435055.5822.jpg\\\",\\\"224x224\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/224x224\\\\\\/1461435055.5822.jpg\\\",\\\"291x250\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/291x250\\\\\\/1461435055.5822.jpg\\\",\\\"490x294\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/490x294\\\\\\/1461435055.5822.jpg\\\"}}\",\"{\\\"sourceImage\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/1461435067.2245.jpg\\\",\\\"thumbImage\\\":{\\\"150x100\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/150x100\\\\\\/1461435067.2245.jpg\\\",\\\"224x224\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/224x224\\\\\\/1461435067.2245.jpg\\\",\\\"291x250\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/291x250\\\\\\/1461435067.2245.jpg\\\",\\\"490x294\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/490x294\\\\\\/1461435067.2245.jpg\\\"}}\",\"{\\\"sourceImage\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/1461435074.4077.jpg\\\",\\\"thumbImage\\\":{\\\"150x100\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/150x100\\\\\\/1461435074.4077.jpg\\\",\\\"224x224\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/224x224\\\\\\/1461435074.4077.jpg\\\",\\\"291x250\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/291x250\\\\\\/1461435074.4077.jpg\\\",\\\"490x294\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/24\\\\\\/thumbs\\\\\\/490x294\\\\\\/1461435074.4077.jpg\\\"}}\"]', '1462449801', null, null, null);
INSERT INTO `tbl_contents` VALUES ('6', 'Mua iphone cũ giá cực cao, ai bán thì pm nhóe, Mua iphone cũ giá cực cao, ai bán thì pm nhóe, Mua iphone cũ giá cực cao, ai bán thì pm nhóe,', 'mua-iphone-cu-gia-cuc-cao-ai-ban-thi-pm-nhoe-mua-iphone-cu-gia-cuc-cao-ai-ban-thi-pm-nhoe-mua-iphone-cu-gia-cuc-cao-ai-ban-thi-pm-nhoe', '<p>Cần mua iphone cũ, gi&aacute; cao, c&ograve;n sử dụng được, li&ecirc;n hệ 0973531618,Mua iphone cũ gi&aacute; cực cao, ai b&aacute;n th&igrave; pm nh&oacute;e,Mua iphone cũ gi&aacute; cực cao, ai b&aacute;n th&igrave; pm nh&oacute;e,Mua iphone cũ gi&aacute; cực cao, ai b&aacute;n th&igrave; pm nh&oacute;e,Mua iphone cũ gi&aacute; cực cao, ai b&aacute;n th&igrave; pm nh&oacute;e,Mua iphone cũ gi&aacute; cực cao, ai b&aacute;n th&igrave; pm nh&oacute;e</p>', '1461905325', '7', '1462142595', '7', '22', null, null, null, '0', null, null, '26', '174', null, null, '1', '192.168.29.1', '[\"{\\\"sourceImage\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/1461905284.6383.jpg\\\",\\\"thumbImage\\\":{\\\"150x100\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/thumbs\\\\\\/150x100\\\\\\/1461905284.6383.jpg\\\",\\\"224x224\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/thumbs\\\\\\/224x224\\\\\\/1461905284.6383.jpg\\\",\\\"291x250\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/thumbs\\\\\\/291x250\\\\\\/1461905284.6383.jpg\\\",\\\"490x294\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/thumbs\\\\\\/490x294\\\\\\/1461905284.6383.jpg\\\"}}\",\"{\\\"sourceImage\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/1461905287.2296.jpg\\\",\\\"thumbImage\\\":{\\\"150x100\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/thumbs\\\\\\/150x100\\\\\\/1461905287.2296.jpg\\\",\\\"224x224\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/thumbs\\\\\\/224x224\\\\\\/1461905287.2296.jpg\\\",\\\"291x250\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/thumbs\\\\\\/291x250\\\\\\/1461905287.2296.jpg\\\",\\\"490x294\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/thumbs\\\\\\/490x294\\\\\\/1461905287.2296.jpg\\\"}}\"]', '1462340202', 'Cần mua iphone cũ, giá cao, còn sử dụng được, liên hệ 0973531618,Mua iphone cũ giá cực cao, ai bán thì pm nhóe,Mua iphone cũ giá cực cao, ai bán thì pm nhóe,Mua iphone cũ giá cực cao, ai bán thì pm nhóe,Mua iphone cũ giá cực cao, ai bán thì pm nhóe,Mua iphone cũ giá cực cao, ai bán thì pm nhóe', '1', null);
INSERT INTO `tbl_contents` VALUES ('7', 'http://dev.raovat.vn/http://dev.raovat.vn/http://dev.raovat.vn/http://dev.raovat.vn/http://dev.raovat.vn/http://dev.raovat.vn/', 'httpdevraovatvnhttpdevraovatvnhttpdevraovatvnhttpdevraovatvnhttpdevraovatvnhttpdevraovatvn', '<p>http://dev.raovat.vn/http://dev.raovat.vn/http://dev.raovat.vn/http://dev.raovat.vn/http://dev.raovat.vn/</p>', '1461905692', '7', '1462038114', null, '17', null, null, null, '0', null, null, '26', '4', null, null, '-1', '192.168.29.1', '[\"{\\\"sourceImage\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/1461905541.9768.jpg\\\",\\\"thumbImage\\\":{\\\"150x100\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/thumbs\\\\\\/150x100\\\\\\/1461905541.9768.jpg\\\",\\\"224x224\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/thumbs\\\\\\/224x224\\\\\\/1461905541.9768.jpg\\\",\\\"291x250\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/thumbs\\\\\\/291x250\\\\\\/1461905541.9768.jpg\\\",\\\"490x294\\\":\\\"http:\\\\\\/\\\\\\/dev.st.raovat.vn\\\\\\/uploads\\\\\\/content\\\\\\/2016\\\\\\/04\\\\\\/29\\\\\\/thumbs\\\\\\/490x294\\\\\\/1461905541.9768.jpg\\\"}}\"]', '1461935961', null, null, null);
INSERT INTO `tbl_contents` VALUES ('8', 'Cần mua 1 em s5 còn đẹp, ai bán pm', 'can-mua-1-em-s5-con-dep-ai-ban-pm', '<p>Cần mua 1 em s5 c&ograve;n đẹp, ai b&aacute;n pm. Li&ecirc;n hệ Chiến : 0973531618</p>', '1462335306', '0', null, null, '17', null, null, null, '0', null, null, '26', '0', null, '{\"user_fullname\":\"Nguy\\u1ec5n Ng\\u1ecdc Chi\\u1ebfn\",\"user_email\":\"ngocchien01@gmail.com\",\"user_phone\":\"0973531618\",\"password\":\"123123\"}', '1', '192.168.29.1', 'null', null, 'Cần mua 1 em s5 còn đẹp, ai bán pm. Liên hệ Chiến : 0973531618', '1', null);
INSERT INTO `tbl_contents` VALUES ('9', 'Cần mua 1 em s5 còn đẹp, ai bán pm', 'can-mua-1-em-s5-con-dep-ai-ban-pm', '<p>Cần mua 1 em s5 c&ograve;n đẹp, ai b&aacute;n pm. Li&ecirc;n hệ Chiến : 0973531618</p>', '1462335831', '0', null, null, '17', null, null, null, '0', null, null, '0', '0', null, '{\"user_fullname\":\"Nguy\\u1ec5n Ng\\u1ecdc Chi\\u1ebfn\",\"user_email\":\"ngocchien01@gmail.com\",\"user_phone\":\"0973531618\",\"password\":\"123123\"}', '1', '192.168.29.1', 'null', null, 'Cần mua 1 em s5 còn đẹp, ai bán pm. Liên hệ Chiến : 0973531618', '1', null);
INSERT INTO `tbl_contents` VALUES ('10', 'Cần mua 1 em s5 còn đẹp, ai bán pm', 'can-mua-1-em-s5-con-dep-ai-ban-pm', '<p>Cần mua 1 em s5 c&ograve;n đẹp, ai b&aacute;n pm</p>\r\n<p>Li&ecirc;n hệ : Chiến - 0973531618</p>', '1462336243', '0', '1462341999', null, '17', null, null, null, '0', null, null, '26', '32', null, '{\"user_fullname\":\"Nguy\\u1ec5n Ng\\u1ecdc Chi\\u1ebfn\",\"user_email\":\"ngocchien01@gmail.com\",\"user_phone\":\"0973531618\",\"password\":\"{\"}', '1', '192.168.29.1', 'null', '1462341965', 'Cần mua 1 em s5 còn đẹp, ai bán pm\r\nLiên hệ : Chiến - 0973531618', '1', null);
INSERT INTO `tbl_contents` VALUES ('11', 'Cần mua iphone 5s cũ giá cả phải chăng', 'can-mua-iphone-5s-cu-gia-ca-phai-chang', '<p>Cần mua&nbsp;<span style=\"font-size: 12pt;\">1 c&aacute;i iphone 5s cũ, gi&aacute; phải chăng để tiện nghe gọi</span></p>', '1462342512', '2', '1462342512', null, '22', null, null, null, '0', null, null, '26', '7', null, null, '1', '192.168.29.1', 'null', '1462343201', 'Cần mua 1 cái iphone 5s cũ, giá phải chăng để tiện nghe gọi', '0', null);

-- ----------------------------
-- Table structure for tbl_districts
-- ----------------------------
DROP TABLE IF EXISTS `tbl_districts`;
CREATE TABLE `tbl_districts` (
  `dist_id` int(11) NOT NULL AUTO_INCREMENT,
  `dist_name` varchar(255) NOT NULL,
  `dist_slug` varchar(255) DEFAULT NULL,
  `created_date` int(11) DEFAULT NULL,
  `dist_status` int(11) DEFAULT '1',
  `user_created` int(11) DEFAULT NULL,
  `updated_date` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `dist_sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`dist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_districts
-- ----------------------------
INSERT INTO `tbl_districts` VALUES ('1', 'TP Qui Nhơn', 'tp-qui-nhon', '1461884242', '1', '1', null, null, null);
INSERT INTO `tbl_districts` VALUES ('2', 'Huyện Vân Canh', 'huyen-van-canh', '1461884242', '1', '1', null, null, null);
INSERT INTO `tbl_districts` VALUES ('3', 'Huyện Tuy Phước', 'huyen-tuy-phuoc', '1461884242', '1', '1', null, null, null);
INSERT INTO `tbl_districts` VALUES ('4', 'Huyện Tây Sơn', 'huyen-tay-son', '1461884242', '1', '1', null, null, null);
INSERT INTO `tbl_districts` VALUES ('5', 'Huyện Phù Mỹ', 'huyen-phu-my', '1461884242', '1', '1', null, null, null);
INSERT INTO `tbl_districts` VALUES ('6', 'Huyện Phù Cát', 'huyen-phu-cat', '1461884242', '1', '1', null, null, null);
INSERT INTO `tbl_districts` VALUES ('7', 'Huyện Hoài Nhơn', 'huyen-hoai-nhon', '1461884242', '1', '1', null, null, null);
INSERT INTO `tbl_districts` VALUES ('8', 'Huyện Hoài Ân', 'huyen-hoai-an', '1461884242', '1', '1', null, null, null);
INSERT INTO `tbl_districts` VALUES ('9', 'Huyện An Nhơn', 'huyen-an-nhon', '1461884242', '1', '1', null, null, null);
INSERT INTO `tbl_districts` VALUES ('10', 'Huyện An Lão', 'huyen-an-lao', '1461884242', '1', '1', null, null, null);
INSERT INTO `tbl_districts` VALUES ('11', 'Huyện Vĩnh Thạnh', 'huyen-vinh-thanh', '1461884242', '1', '1', null, null, null);

-- ----------------------------
-- Table structure for tbl_favourite
-- ----------------------------
DROP TABLE IF EXISTS `tbl_favourite`;
CREATE TABLE `tbl_favourite` (
  `favo_id` int(11) NOT NULL AUTO_INCREMENT,
  `cont_id` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `updated_date` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`favo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_favourite
-- ----------------------------
INSERT INTO `tbl_favourite` VALUES ('1', '5', '1461650991', '1462113243', '2', '-1');
INSERT INTO `tbl_favourite` VALUES ('2', '6', '1462104733', '1462113925', '2', '1');

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
  `gene_status` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_logs
-- ----------------------------
INSERT INTO `tbl_logs` VALUES ('48', 'backend', 'category', 'add', '17', '1', '1460556033', '{\"cate_name\":\"Samsung\",\"cate_icon\":\"\",\"cate_slug\":\"samsung\",\"cate_meta_title\":\"Samsung\",\"cate_meta_description\":\"Samsung\",\"cate_meta_keyword\":\"Samsung\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460556033,\"user_created\":1,\"parent_id\":\"1\"}');
INSERT INTO `tbl_logs` VALUES ('49', 'backend', 'category', 'add', '19', '1', '1460557724', '{\"cate_name\":\"Nokia\",\"cate_icon\":\"\",\"cate_slug\":\"nokia\",\"cate_meta_title\":\"Nokia\",\"cate_meta_description\":\"Nokia\",\"cate_meta_keyword\":\"Nokia\",\"cate_sort\":2,\"cate_status\":\"1\",\"created_date\":1460557724,\"user_created\":1,\"parent_id\":\"1\"}');
INSERT INTO `tbl_logs` VALUES ('50', 'backend', 'category', 'add', '20', '1', '1460557808', '{\"cate_name\":\"Sony\",\"cate_icon\":\"\",\"cate_slug\":\"sony\",\"cate_meta_title\":\"Sony\",\"cate_meta_description\":\"Sony\",\"cate_meta_keyword\":\"Sony\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460557808,\"user_created\":1,\"parent_id\":\"1\"}');
INSERT INTO `tbl_logs` VALUES ('51', 'backend', 'category', 'add', '21', '1', '1460558037', '{\"cate_name\":\"HTC\",\"cate_icon\":\"\",\"cate_slug\":\"htc\",\"cate_meta_title\":\"HTC\",\"cate_meta_description\":\"HTC\",\"cate_meta_keyword\":\"HTC\",\"cate_sort\":4,\"cate_status\":\"1\",\"created_date\":1460558037,\"user_created\":1,\"parent_id\":\"1\"}');
INSERT INTO `tbl_logs` VALUES ('52', 'backend', 'category', 'add', '22', '1', '1460558153', '{\"cate_name\":\"Iphone\",\"cate_icon\":\"\",\"cate_slug\":\"iphone\",\"cate_meta_title\":\"Iphone\",\"cate_meta_description\":\"Iphone\",\"cate_meta_keyword\":\"Iphone\",\"cate_sort\":5,\"cate_status\":\"1\",\"created_date\":1460558152,\"user_created\":1,\"parent_id\":\"1\"}');
INSERT INTO `tbl_logs` VALUES ('53', 'backend', 'category', 'add', '23', '1', '1460558189', '{\"cate_name\":\"Laptop\",\"cate_icon\":\"\",\"cate_slug\":\"laptop\",\"cate_meta_title\":\"Laptop\",\"cate_meta_description\":\"Laptop\",\"cate_meta_keyword\":\"Laptop\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460558189,\"user_created\":1,\"parent_id\":\"2\"}');
INSERT INTO `tbl_logs` VALUES ('54', 'backend', 'category', 'add', '24', '1', '1460558215', '{\"cate_name\":\"M\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_icon\":\"\",\"cate_slug\":\"may-tinh-de-ban\",\"cate_meta_title\":\"M\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_meta_description\":\"M\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_meta_keyword\":\"M\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_sort\":2,\"cate_status\":\"1\",\"created_date\":1460558215,\"user_created\":1,\"parent_id\":\"2\"}');
INSERT INTO `tbl_logs` VALUES ('55', 'backend', 'category', 'add', '25', '1', '1460558251', '{\"cate_name\":\"M\\u00e0n h\\u00ecnh\",\"cate_icon\":\"\",\"cate_slug\":\"man-hinh\",\"cate_meta_title\":\"M\\u00e0n h\\u00ecnh\",\"cate_meta_description\":\"M\\u00e0n h\\u00ecnh\",\"cate_meta_keyword\":\"M\\u00e0n h\\u00ecnh\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460558251,\"user_created\":1,\"parent_id\":\"2\"}');
INSERT INTO `tbl_logs` VALUES ('56', 'backend', 'category', 'add', '26', '1', '1460558273', '{\"cate_name\":\"Link ki\\u1ec7n m\\u00e1y t\\u00ednh\",\"cate_icon\":\"\",\"cate_slug\":\"link-kien-may-tinh\",\"cate_meta_title\":\"Link ki\\u1ec7n m\\u00e1y t\\u00ednh\",\"cate_meta_description\":\"Link ki\\u1ec7n m\\u00e1y t\\u00ednh\",\"cate_meta_keyword\":\"Link ki\\u1ec7n m\\u00e1y t\\u00ednh\",\"cate_sort\":4,\"cate_status\":\"1\",\"created_date\":1460558272,\"user_created\":1,\"parent_id\":\"2\"}');
INSERT INTO `tbl_logs` VALUES ('57', 'backend', 'category', 'add', '27', '1', '1460558305', '{\"cate_name\":\"M\\u00e1y chi\\u1ebfu, M\\u00e1y in, Scan\",\"cate_icon\":\"\",\"cate_slug\":\"may-chieu-may-in-scan\",\"cate_meta_title\":\"M\\u00e1y chi\\u1ebfu, M\\u00e1y in, Scan\",\"cate_meta_description\":\"M\\u00e1y chi\\u1ebfu, M\\u00e1y in, Scan\",\"cate_meta_keyword\":\"M\\u00e1y chi\\u1ebfu, M\\u00e1y in, Scan\",\"cate_sort\":4,\"cate_status\":\"1\",\"created_date\":1460558305,\"user_created\":1,\"parent_id\":\"2\"}');
INSERT INTO `tbl_logs` VALUES ('58', 'backend', 'category', 'delete', '3', '1', '1460558330', '{\"cate_status\":-1,\"user_updated\":1,\"updated_date\":1460558330}');
INSERT INTO `tbl_logs` VALUES ('59', 'backend', 'category', 'add', '28', '1', '1460558366', '{\"cate_name\":\"Nh\\u00e0 \\u1edf\",\"cate_icon\":\"\",\"cate_slug\":\"nha-o\",\"cate_meta_title\":\"Nh\\u00e0 \\u1edf\",\"cate_meta_description\":\"Nh\\u00e0 \\u1edf\",\"cate_meta_keyword\":\"Nh\\u00e0 \\u1edf\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460558366,\"user_created\":1,\"parent_id\":\"5\"}');
INSERT INTO `tbl_logs` VALUES ('60', 'backend', 'category', 'add', '29', '1', '1460558390', '{\"cate_name\":\"Nh\\u00e0 chung c\\u01b0\",\"cate_icon\":\"\",\"cate_slug\":\"nha-chung-cu\",\"cate_meta_title\":\"Nh\\u00e0 chung c\\u01b0\",\"cate_meta_description\":\"Nh\\u00e0 chung c\\u01b0\",\"cate_meta_keyword\":\"Nh\\u00e0 chung c\\u01b0\",\"cate_sort\":2,\"cate_status\":\"1\",\"created_date\":1460558390,\"user_created\":1,\"parent_id\":\"5\"}');
INSERT INTO `tbl_logs` VALUES ('61', 'backend', 'category', 'add', '30', '1', '1460558411', '{\"cate_name\":\"\\u0110\\u1ea5t bi\\u1ec7t th\\u1ef1, P.L\\u00f4\",\"cate_icon\":\"\",\"cate_slug\":\"dat-biet-thu-plo\",\"cate_meta_title\":\"\\u0110\\u1ea5t bi\\u1ec7t th\\u1ef1, P.L\\u00f4\",\"cate_meta_description\":\"\\u0110\\u1ea5t bi\\u1ec7t th\\u1ef1, P.L\\u00f4\",\"cate_meta_keyword\":\"\\u0110\\u1ea5t bi\\u1ec7t th\\u1ef1, P.L\\u00f4\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460558411,\"user_created\":1,\"parent_id\":\"5\"}');
INSERT INTO `tbl_logs` VALUES ('62', 'backend', 'category', 'add', '31', '1', '1460558436', '{\"cate_name\":\"C.H\\u00e0ng, n\\u01a1i kinh doanh\",\"cate_icon\":\"\",\"cate_slug\":\"chang-noi-kinh-doanh\",\"cate_meta_title\":\"C.H\\u00e0ng, n\\u01a1i kinh doanh\",\"cate_meta_description\":\"C.H\\u00e0ng, n\\u01a1i kinh doanh\",\"cate_meta_keyword\":\"C.H\\u00e0ng, n\\u01a1i kinh doanh\",\"cate_sort\":4,\"cate_status\":\"1\",\"created_date\":1460558436,\"user_created\":1,\"parent_id\":\"5\"}');
INSERT INTO `tbl_logs` VALUES ('63', 'backend', 'category', 'add', '32', '1', '1460558454', '{\"cate_name\":\"N.X\\u01b0\\u1edfng, Trang tr\\u1ea1i\",\"cate_icon\":\"\",\"cate_slug\":\"nxuong-trang-trai\",\"cate_meta_title\":\"N.X\\u01b0\\u1edfng, Trang tr\\u1ea1i\",\"cate_meta_description\":\"N.X\\u01b0\\u1edfng, Trang tr\\u1ea1i\",\"cate_meta_keyword\":\"N.X\\u01b0\\u1edfng, Trang tr\\u1ea1i\",\"cate_sort\":5,\"cate_status\":\"1\",\"created_date\":1460558454,\"user_created\":1,\"parent_id\":\"5\"}');
INSERT INTO `tbl_logs` VALUES ('64', 'backend', 'category', 'add', '33', '1', '1460558495', '{\"cate_name\":\"Vip, t\\u1ee9 qu\\u00fd, ng\\u0169 qu\\u00fd\",\"cate_icon\":\"\",\"cate_slug\":\"vip-tu-quy-ngu-quy\",\"cate_meta_title\":\"Vip, t\\u1ee9 qu\\u00fd, ng\\u0169 qu\\u00fd\",\"cate_meta_description\":\"Vip, t\\u1ee9 qu\\u00fd, ng\\u0169 qu\\u00fd\",\"cate_meta_keyword\":\"Vip, t\\u1ee9 qu\\u00fd, ng\\u0169 qu\\u00fd\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460558495,\"user_created\":1,\"parent_id\":\"6\"}');
INSERT INTO `tbl_logs` VALUES ('65', 'backend', 'category', 'add', '34', '1', '1460558519', '{\"cate_name\":\"Sim n\\u0103m sinh\",\"cate_icon\":\"\",\"cate_slug\":\"sim-nam-sinh\",\"cate_meta_title\":\"Sim n\\u0103m sinh\",\"cate_meta_description\":\"Sim n\\u0103m sinh\",\"cate_meta_keyword\":\"Sim n\\u0103m sinh\",\"cate_sort\":2,\"cate_status\":\"1\",\"created_date\":1460558519,\"user_created\":1,\"parent_id\":\"6\"}');
INSERT INTO `tbl_logs` VALUES ('66', 'backend', 'category', 'add', '35', '1', '1460558535', '{\"cate_name\":\"Sim l\\u1ed9c ph\\u00e1t, th\\u1ea7n t\\u00e0i\",\"cate_icon\":\"\",\"cate_slug\":\"sim-loc-phat-than-tai\",\"cate_meta_title\":\"Sim l\\u1ed9c ph\\u00e1t, th\\u1ea7n t\\u00e0i\",\"cate_meta_description\":\"Sim l\\u1ed9c ph\\u00e1t, th\\u1ea7n t\\u00e0i\",\"cate_meta_keyword\":\"Sim l\\u1ed9c ph\\u00e1t, th\\u1ea7n t\\u00e0i\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460558535,\"user_created\":1,\"parent_id\":\"6\"}');
INSERT INTO `tbl_logs` VALUES ('67', 'backend', 'category', 'add', '36', '1', '1460558593', '{\"cate_name\":\"Sim gi\\u00e1 r\\u1ebb\",\"cate_icon\":\"\",\"cate_slug\":\"sim-gia-re\",\"cate_meta_title\":\"Sim gi\\u00e1 r\\u1ebb\",\"cate_meta_description\":\"Sim gi\\u00e1 r\\u1ebb\",\"cate_meta_keyword\":\"Sim gi\\u00e1 r\\u1ebb\",\"cate_sort\":4,\"cate_status\":\"1\",\"created_date\":1460558593,\"user_created\":1,\"parent_id\":\"6\"}');
INSERT INTO `tbl_logs` VALUES ('68', 'backend', 'category', 'add', '37', '1', '1460558617', '{\"cate_name\":\"Sim tam hoa\",\"cate_icon\":\"\",\"cate_slug\":\"sim-tam-hoa\",\"cate_meta_title\":\"Sim tam hoa\",\"cate_meta_description\":\"Sim tam hoa\",\"cate_meta_keyword\":\"Sim tam hoa\",\"cate_sort\":5,\"cate_status\":\"1\",\"created_date\":1460558617,\"user_created\":1,\"parent_id\":\"6\"}');
INSERT INTO `tbl_logs` VALUES ('69', 'backend', 'category', 'add', '38', '1', '1460558674', '{\"cate_name\":\"T\\u1ee7 l\\u1ea1nh\",\"cate_icon\":\"\",\"cate_slug\":\"tu-lanh\",\"cate_meta_title\":\"T\\u1ee7 l\\u1ea1nh\",\"cate_meta_description\":\"T\\u1ee7 l\\u1ea1nh\",\"cate_meta_keyword\":\"T\\u1ee7 l\\u1ea1nh\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460558674,\"user_created\":1,\"parent_id\":\"7\"}');
INSERT INTO `tbl_logs` VALUES ('70', 'backend', 'category', 'add', '39', '1', '1460558707', '{\"cate_name\":\"\\u0110i\\u1ec1u h\\u00f2a\",\"cate_icon\":\"\",\"cate_slug\":\"dieu-hoa\",\"cate_meta_title\":\"\\u0110i\\u1ec1u h\\u00f2a\",\"cate_meta_description\":\"\\u0110i\\u1ec1u h\\u00f2a\",\"cate_meta_keyword\":\"\\u0110i\\u1ec1u h\\u00f2a\",\"cate_sort\":2,\"cate_status\":\"1\",\"created_date\":1460558707,\"user_created\":1,\"parent_id\":\"7\"}');
INSERT INTO `tbl_logs` VALUES ('71', 'backend', 'category', 'add', '40', '1', '1460558721', '{\"cate_name\":\"M\\u00e1y gi\\u1eb7t\",\"cate_icon\":\"\",\"cate_slug\":\"may-giat\",\"cate_meta_title\":\"M\\u00e1y gi\\u1eb7t\",\"cate_meta_description\":\"M\\u00e1y gi\\u1eb7t\",\"cate_meta_keyword\":\"M\\u00e1y gi\\u1eb7t\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460558721,\"user_created\":1,\"parent_id\":\"7\"}');
INSERT INTO `tbl_logs` VALUES ('72', 'backend', 'category', 'add', '41', '1', '1460558739', '{\"cate_name\":\"\\u0110i\\u1ec7n gia d\\u1ee5ng\",\"cate_icon\":\"\",\"cate_slug\":\"dien-gia-dung\",\"cate_meta_title\":\"\\u0110i\\u1ec7n gia d\\u1ee5ng\",\"cate_meta_description\":\"\\u0110i\\u1ec7n gia d\\u1ee5ng\",\"cate_meta_keyword\":\"\\u0110i\\u1ec7n gia d\\u1ee5ng\",\"cate_sort\":4,\"cate_status\":\"1\",\"created_date\":1460558739,\"user_created\":1,\"parent_id\":\"7\"}');
INSERT INTO `tbl_logs` VALUES ('73', 'backend', 'category', 'add', '42', '1', '1460558757', '{\"cate_name\":\"\\u0110i\\u1ec7n l\\u1ea1nh, \\u0111i\\u1ec7n m\\u00e1y kh\\u00e1c\",\"cate_icon\":\"\",\"cate_slug\":\"dien-lanh-dien-may-khac\",\"cate_meta_title\":\"\\u0110i\\u1ec7n l\\u1ea1nh, \\u0111i\\u1ec7n m\\u00e1y kh\\u00e1c\",\"cate_meta_description\":\"\\u0110i\\u1ec7n l\\u1ea1nh, \\u0111i\\u1ec7n m\\u00e1y kh\\u00e1c\",\"cate_meta_keyword\":\"\\u0110i\\u1ec7n l\\u1ea1nh, \\u0111i\\u1ec7n m\\u00e1y kh\\u00e1c\",\"cate_sort\":5,\"cate_status\":\"1\",\"created_date\":1460558757,\"user_created\":1,\"parent_id\":\"7\"}');
INSERT INTO `tbl_logs` VALUES ('74', 'backend', 'category', 'add', '43', '1', '1460558797', '{\"cate_name\":\"Qu\\u1ea7n \\u00e1o\",\"cate_icon\":\"\",\"cate_slug\":\"quan-ao\",\"cate_meta_title\":\"Qu\\u1ea7n \\u00e1o\",\"cate_meta_description\":\"Qu\\u1ea7n \\u00e1o\",\"cate_meta_keyword\":\"Qu\\u1ea7n \\u00e1o\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460558797,\"user_created\":1,\"parent_id\":\"8\"}');
INSERT INTO `tbl_logs` VALUES ('75', 'backend', 'category', 'add', '44', '1', '1460558815', '{\"cate_name\":\"Gi\\u00e0y, T\\u00fai, Ph\\u1ee5 ki\\u1ec7n\",\"cate_icon\":\"\",\"cate_slug\":\"giay-tui-phu-kien\",\"cate_meta_title\":\"Gi\\u00e0y, T\\u00fai, Ph\\u1ee5 ki\\u1ec7n\",\"cate_meta_description\":\"Gi\\u00e0y, T\\u00fai, Ph\\u1ee5 ki\\u1ec7n\",\"cate_meta_keyword\":\"Gi\\u00e0y, T\\u00fai, Ph\\u1ee5 ki\\u1ec7n\",\"cate_sort\":2,\"cate_status\":\"1\",\"created_date\":1460558815,\"user_created\":1,\"parent_id\":\"8\"}');
INSERT INTO `tbl_logs` VALUES ('76', 'backend', 'category', 'add', '45', '1', '1460558830', '{\"cate_name\":\"H\\u00e0ng thanh l\\u00fd, Gi\\u1ea3m gi\\u00e1\",\"cate_icon\":\"\",\"cate_slug\":\"hang-thanh-ly-giam-gia\",\"cate_meta_title\":\"H\\u00e0ng thanh l\\u00fd, Gi\\u1ea3m gi\\u00e1\",\"cate_meta_description\":\"H\\u00e0ng thanh l\\u00fd, Gi\\u1ea3m gi\\u00e1\",\"cate_meta_keyword\":\"H\\u00e0ng thanh l\\u00fd, Gi\\u1ea3m gi\\u00e1\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460558830,\"user_created\":1,\"parent_id\":\"8\"}');
INSERT INTO `tbl_logs` VALUES ('77', 'backend', 'category', 'add', '46', '1', '1460558859', '{\"cate_name\":\"Th\\u1ea9m m\\u1ef9, ch\\u0103m s\\u00f3c s\\u1eafc \\u0111\\u1eb9p\",\"cate_icon\":\"\",\"cate_slug\":\"tham-my-cham-soc-sac-dep\",\"cate_meta_title\":\"Th\\u1ea9m m\\u1ef9, ch\\u0103m s\\u00f3c s\\u1eafc \\u0111\\u1eb9p\",\"cate_meta_description\":\"Th\\u1ea9m m\\u1ef9, ch\\u0103m s\\u00f3c s\\u1eafc \\u0111\\u1eb9p\",\"cate_meta_keyword\":\"Th\\u1ea9m m\\u1ef9, ch\\u0103m s\\u00f3c s\\u1eafc \\u0111\\u1eb9p\",\"cate_sort\":4,\"cate_status\":\"1\",\"created_date\":1460558859,\"user_created\":1,\"parent_id\":\"8\"}');
INSERT INTO `tbl_logs` VALUES ('78', 'backend', 'category', 'add', '47', '1', '1460558876', '{\"cate_name\":\"Th\\u1eddi trang, M\\u1ef9 ph\\u1ea9m kh\\u00e1c\",\"cate_icon\":\"\",\"cate_slug\":\"thoi-trang-my-pham-khac\",\"cate_meta_title\":\"Th\\u1eddi trang, M\\u1ef9 ph\\u1ea9m kh\\u00e1c\",\"cate_meta_description\":\"Th\\u1eddi trang, M\\u1ef9 ph\\u1ea9m kh\\u00e1c\",\"cate_meta_keyword\":\"Th\\u1eddi trang, M\\u1ef9 ph\\u1ea9m kh\\u00e1c\",\"cate_sort\":5,\"cate_status\":\"1\",\"created_date\":1460558876,\"user_created\":1,\"parent_id\":\"8\"}');
INSERT INTO `tbl_logs` VALUES ('79', 'backend', 'category', 'add', '48', '1', '1460558910', '{\"cate_name\":\"Xe t\\u1ea3i\",\"cate_icon\":\"\",\"cate_slug\":\"xe-tai\",\"cate_meta_title\":\"Xe t\\u1ea3i\",\"cate_meta_description\":\"Xe t\\u1ea3i\",\"cate_meta_keyword\":\"Xe t\\u1ea3i\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460558910,\"user_created\":1,\"parent_id\":\"9\"}');
INSERT INTO `tbl_logs` VALUES ('80', 'backend', 'category', 'add', '49', '1', '1460558924', '{\"cate_name\":\"Xe c\\u00f4ng tr\\u00ecnh\",\"cate_icon\":\"\",\"cate_slug\":\"xe-cong-trinh\",\"cate_meta_title\":\"Xe c\\u00f4ng tr\\u00ecnh\",\"cate_meta_description\":\"Xe c\\u00f4ng tr\\u00ecnh\",\"cate_meta_keyword\":\"Xe c\\u00f4ng tr\\u00ecnh\",\"cate_sort\":2,\"cate_status\":\"1\",\"created_date\":1460558924,\"user_created\":1,\"parent_id\":\"9\"}');
INSERT INTO `tbl_logs` VALUES ('81', 'backend', 'category', 'add', '50', '1', '1460558950', '{\"cate_name\":\"\\u0110\\u1ed9 xe, s\\u01a1n s\\u1eeda, ph\\u1ee5 t\\u00f9ng \\u00f4 t\\u00f4\",\"cate_icon\":\"\",\"cate_slug\":\"do-xe-son-sua-phu-tung-o-to\",\"cate_meta_title\":\"\\u0110\\u1ed9 xe, s\\u01a1n s\\u1eeda, ph\\u1ee5 t\\u00f9ng \\u00f4 t\\u00f4\",\"cate_meta_description\":\"\\u0110\\u1ed9 xe, s\\u01a1n s\\u1eeda, ph\\u1ee5 t\\u00f9ng \\u00f4 t\\u00f4\",\"cate_meta_keyword\":\"\\u0110\\u1ed9 xe, s\\u01a1n s\\u1eeda, ph\\u1ee5 t\\u00f9ng \\u00f4 t\\u00f4\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460558950,\"user_created\":1,\"parent_id\":\"9\"}');
INSERT INTO `tbl_logs` VALUES ('82', 'backend', 'category', 'add', '51', '1', '1460558999', '{\"cate_name\":\"Xe kh\\u00e1ch, xe du l\\u1ecbch\",\"cate_icon\":\"\",\"cate_slug\":\"xe-khach-xe-du-lich\",\"cate_meta_title\":\"Xe kh\\u00e1ch, xe du l\\u1ecbch\",\"cate_meta_description\":\"Xe kh\\u00e1ch, xe du l\\u1ecbch\",\"cate_meta_keyword\":\"v\",\"cate_sort\":4,\"cate_status\":\"1\",\"created_date\":1460558998,\"user_created\":1,\"parent_id\":\"9\"}');
INSERT INTO `tbl_logs` VALUES ('83', 'backend', 'category', 'edit', '51', '1', '1460558999', '{\"cate_name\":\"Xe kh\\u00e1ch, xe du l\\u1ecbch\",\"cate_icon\":\"\",\"cate_slug\":\"xe-khach-xe-du-lich\",\"cate_meta_title\":\"Xe kh\\u00e1ch, xe du l\\u1ecbch\",\"cate_meta_description\":\"Xe kh\\u00e1ch, xe du l\\u1ecbch\",\"cate_meta_keyword\":\"v\",\"cate_sort\":4,\"cate_status\":\"1\",\"updated_date\":1460558999,\"user_updated\":1,\"parent_id\":9}');
INSERT INTO `tbl_logs` VALUES ('84', 'backend', 'category', 'edit', '51', '1', '1460559005', '{\"cate_name\":\"Xe kh\\u00e1ch, xe du l\\u1ecbch\",\"cate_icon\":\"\",\"cate_slug\":\"xe-khach-xe-du-lich\",\"cate_meta_title\":\"Xe kh\\u00e1ch, xe du l\\u1ecbch\",\"cate_meta_description\":\"Xe kh\\u00e1ch, xe du l\\u1ecbch\",\"cate_meta_keyword\":\"Xe kh\\u00e1ch, xe du l\\u1ecbch\",\"cate_sort\":4,\"cate_status\":\"1\",\"updated_date\":1460559005,\"user_updated\":1,\"parent_id\":9}');
INSERT INTO `tbl_logs` VALUES ('85', 'backend', 'category', 'add', '52', '1', '1460559030', '{\"cate_name\":\"Lo\\u1ea1i xe kh\\u00e1c\",\"cate_icon\":\"\",\"cate_slug\":\"loai-xe-khac\",\"cate_meta_title\":\"Lo\\u1ea1i xe kh\\u00e1c\",\"cate_meta_description\":\"Lo\\u1ea1i xe kh\\u00e1c\",\"cate_meta_keyword\":\"Lo\\u1ea1i xe kh\\u00e1c\",\"cate_sort\":5,\"cate_status\":\"1\",\"created_date\":1460559030,\"user_created\":1,\"parent_id\":\"9\"}');
INSERT INTO `tbl_logs` VALUES ('86', 'backend', 'category', 'add', '53', '1', '1460559068', '{\"cate_name\":\"Honda xe s\\u1ed1\",\"cate_icon\":\"\",\"cate_slug\":\"honda-xe-so\",\"cate_meta_title\":\"Honda xe s\\u1ed1\",\"cate_meta_description\":\"Honda xe s\\u1ed1\",\"cate_meta_keyword\":\"Honda xe s\\u1ed1\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460559068,\"user_created\":1,\"parent_id\":\"10\"}');
INSERT INTO `tbl_logs` VALUES ('87', 'backend', 'category', 'add', '54', '1', '1460559089', '{\"cate_name\":\"Suzuki\",\"cate_icon\":\"\",\"cate_slug\":\"suzuki\",\"cate_meta_title\":\"Suzuki\",\"cate_meta_description\":\"Suzuki\",\"cate_meta_keyword\":\"Suzuki\",\"cate_sort\":2,\"cate_status\":\"1\",\"created_date\":1460559089,\"user_created\":1,\"parent_id\":\"10\"}');
INSERT INTO `tbl_logs` VALUES ('88', 'backend', 'category', 'add', '55', '1', '1460559100', '{\"cate_name\":\"Yamaha\",\"cate_icon\":\"\",\"cate_slug\":\"yamaha\",\"cate_meta_title\":\"Yamaha\",\"cate_meta_description\":\"Yamaha\",\"cate_meta_keyword\":\"Yamaha\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460559100,\"user_created\":1,\"parent_id\":\"10\"}');
INSERT INTO `tbl_logs` VALUES ('89', 'backend', 'category', 'add', '56', '1', '1460559139', '{\"cate_name\":\"Piaggio\",\"cate_icon\":\"\",\"cate_slug\":\"piaggio\",\"cate_meta_title\":\"Piaggio\",\"cate_meta_description\":\"Piaggio\",\"cate_meta_keyword\":\"Piaggio\",\"cate_sort\":4,\"cate_status\":\"1\",\"created_date\":1460559139,\"user_created\":1,\"parent_id\":\"10\"}');
INSERT INTO `tbl_logs` VALUES ('90', 'backend', 'category', 'add', '57', '1', '1460559168', '{\"cate_name\":\"Xe m\\u00e1y Trung Qu\\u1ed1c\",\"cate_icon\":\"\",\"cate_slug\":\"xe-may-trung-quoc\",\"cate_meta_title\":\"Xe m\\u00e1y Trung Qu\\u1ed1c\",\"cate_meta_description\":\"Xe m\\u00e1y Trung Qu\\u1ed1c\",\"cate_meta_keyword\":\"Xe m\\u00e1y Trung Qu\\u1ed1c\",\"cate_sort\":4,\"cate_status\":\"1\",\"created_date\":1460559168,\"user_created\":1,\"parent_id\":\"10\"}');
INSERT INTO `tbl_logs` VALUES ('91', 'backend', 'category', 'add', '58', '1', '1460559184', '{\"cate_name\":\"Xe m\\u00e1y, xe \\u0111\\u1ea1p kh\\u00e1c\",\"cate_icon\":\"\",\"cate_slug\":\"xe-may-xe-dap-khac\",\"cate_meta_title\":\"Xe m\\u00e1y, xe \\u0111\\u1ea1p kh\\u00e1c\",\"cate_meta_description\":\"Xe m\\u00e1y, xe \\u0111\\u1ea1p kh\\u00e1c\",\"cate_meta_keyword\":\"Xe m\\u00e1y, xe \\u0111\\u1ea1p kh\\u00e1c\",\"cate_sort\":5,\"cate_status\":\"1\",\"created_date\":1460559184,\"user_created\":1,\"parent_id\":\"10\"}');
INSERT INTO `tbl_logs` VALUES ('92', 'backend', 'category', 'add', '59', '1', '1460559290', '{\"cate_name\":\"\\u0110\\u1ecba \\u0111i\\u1ec3m vui ch\\u01a1i, gi\\u1ea3i tr\\u00ed\",\"cate_icon\":\"\",\"cate_slug\":\"dia-diem-vui-choi-giai-tri\",\"cate_meta_title\":\"\\u0110\\u1ecba \\u0111i\\u1ec3m vui ch\\u01a1i, gi\\u1ea3i tr\\u00ed\",\"cate_meta_description\":\"\\u0110\\u1ecba \\u0111i\\u1ec3m vui ch\\u01a1i, gi\\u1ea3i tr\\u00ed\",\"cate_meta_keyword\":\"\\u0110\\u1ecba \\u0111i\\u1ec3m vui ch\\u01a1i, gi\\u1ea3i tr\\u00ed\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460559290,\"user_created\":1,\"parent_id\":\"11\"}');
INSERT INTO `tbl_logs` VALUES ('93', 'backend', 'category', 'add', '60', '1', '1460559307', '{\"cate_name\":\"Tour n\\u1ed9i \\u0111\\u1ecba\",\"cate_icon\":\"\",\"cate_slug\":\"tour-noi-dia\",\"cate_meta_title\":\"Tour n\\u1ed9i \\u0111\\u1ecba\",\"cate_meta_description\":\"Tour n\\u1ed9i \\u0111\\u1ecba\",\"cate_meta_keyword\":\"Tour n\\u1ed9i \\u0111\\u1ecba\",\"cate_sort\":2,\"cate_status\":\"1\",\"created_date\":1460559307,\"user_created\":1,\"parent_id\":\"11\"}');
INSERT INTO `tbl_logs` VALUES ('94', 'backend', 'category', 'add', '61', '1', '1460559324', '{\"cate_name\":\"Tour n\\u01b0\\u1edbc ngo\\u00e0i\",\"cate_icon\":\"\",\"cate_slug\":\"tour-nuoc-ngoai\",\"cate_meta_title\":\"Tour n\\u01b0\\u1edbc ngo\\u00e0i\",\"cate_meta_description\":\"Tour n\\u01b0\\u1edbc ngo\\u00e0i\",\"cate_meta_keyword\":\"Tour n\\u01b0\\u1edbc ngo\\u00e0i\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460559324,\"user_created\":1,\"parent_id\":\"11\"}');
INSERT INTO `tbl_logs` VALUES ('95', 'backend', 'category', 'add', '62', '1', '1460559344', '{\"cate_name\":\"V\\u00e9 m\\u00e1y bay, t\\u00e0u, xe\",\"cate_icon\":\"\",\"cate_slug\":\"ve-may-bay-tau-xe\",\"cate_meta_title\":\"V\\u00e9 m\\u00e1y bay, t\\u00e0u, xe\",\"cate_meta_description\":\"V\\u00e9 m\\u00e1y bay, t\\u00e0u, xe\",\"cate_meta_keyword\":\"V\\u00e9 m\\u00e1y bay, t\\u00e0u, xe\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460559344,\"user_created\":1,\"parent_id\":\"11\"}');
INSERT INTO `tbl_logs` VALUES ('96', 'backend', 'category', 'add', '63', '1', '1460559380', '{\"cate_name\":\"C\\u00e1c DV vui ch\\u01a1i - gi\\u1ea3i tr\\u00ed kh\\u00e1c\",\"cate_icon\":\"\",\"cate_slug\":\"cac-dv-vui-choi-giai-tri-khac\",\"cate_meta_title\":\"C\\u00e1c DV vui ch\\u01a1i - gi\\u1ea3i tr\\u00ed kh\\u00e1c\",\"cate_meta_description\":\"C\\u00e1c DV vui ch\\u01a1i - gi\\u1ea3i tr\\u00ed kh\\u00e1c\",\"cate_meta_keyword\":\"C\\u00e1c DV vui ch\\u01a1i - gi\\u1ea3i tr\\u00ed kh\\u00e1c\",\"cate_sort\":5,\"cate_status\":\"1\",\"created_date\":1460559380,\"user_created\":1,\"parent_id\":\"11\"}');
INSERT INTO `tbl_logs` VALUES ('97', 'backend', 'category', 'add', '64', '1', '1460566538', '{\"cate_name\":\"B\\u1ea3o v\\u1ec7, V\\u1ec7 s\\u1ef9, Th\\u00e1m t\\u1eed\",\"cate_icon\":\"\",\"cate_slug\":\"bao-ve-ve-sy-tham-tu\",\"cate_meta_title\":\"B\\u1ea3o v\\u1ec7, V\\u1ec7 s\\u1ef9, Th\\u00e1m t\\u1eed\",\"cate_meta_description\":\"B\\u1ea3o v\\u1ec7, V\\u1ec7 s\\u1ef9, Th\\u00e1m t\\u1eed\",\"cate_meta_keyword\":\"B\\u1ea3o v\\u1ec7, V\\u1ec7 s\\u1ef9, Th\\u00e1m t\\u1eed\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460566538,\"user_created\":1,\"parent_id\":\"12\"}');
INSERT INTO `tbl_logs` VALUES ('98', 'backend', 'category', 'add', '65', '1', '1460566581', '{\"cate_name\":\"DV S\\u1ee9c kh\\u1ecfe - Th\\u1ec3 h\\u00ecnh\",\"cate_icon\":\"\",\"cate_slug\":\"dv-suc-khoe-the-hinh\",\"cate_meta_title\":\"DV S\\u1ee9c kh\\u1ecfe - Th\\u1ec3 h\\u00ecnh\",\"cate_meta_description\":\"DV S\\u1ee9c kh\\u1ecfe - Th\\u1ec3 h\\u00ecnh\",\"cate_meta_keyword\":\"DV S\\u1ee9c kh\\u1ecfe - Th\\u1ec3 h\\u00ecnh\",\"cate_sort\":2,\"cate_status\":\"1\",\"created_date\":1460566581,\"user_created\":1,\"parent_id\":\"12\"}');
INSERT INTO `tbl_logs` VALUES ('99', 'backend', 'category', 'add', '66', '1', '1460566600', '{\"cate_name\":\"PR \\/ T\\u1ed5 ch\\u1ee9c s\\u1ef1 ki\\u1ec7n\",\"cate_icon\":\"\",\"cate_slug\":\"pr-to-chuc-su-kien\",\"cate_meta_title\":\"PR \\/ T\\u1ed5 ch\\u1ee9c s\\u1ef1 ki\\u1ec7n\",\"cate_meta_description\":\"PR \\/ T\\u1ed5 ch\\u1ee9c s\\u1ef1 ki\\u1ec7n\",\"cate_meta_keyword\":\"PR \\/ T\\u1ed5 ch\\u1ee9c s\\u1ef1 ki\\u1ec7n\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460566600,\"user_created\":1,\"parent_id\":\"12\"}');
INSERT INTO `tbl_logs` VALUES ('100', 'backend', 'category', 'add', '67', '1', '1460566623', '{\"cate_name\":\"L\\u1eafp \\u0111\\u1eb7t \\u0110T, Internet, TH c\\u00e1p\",\"cate_icon\":\"\",\"cate_slug\":\"lap-dat-dt-internet-th-cap\",\"cate_meta_title\":\"L\\u1eafp \\u0111\\u1eb7t \\u0110T, Internet, TH c\\u00e1p\",\"cate_meta_description\":\"L\\u1eafp \\u0111\\u1eb7t \\u0110T, Internet, TH c\\u00e1p\",\"cate_meta_keyword\":\"L\\u1eafp \\u0111\\u1eb7t \\u0110T, Internet, TH c\\u00e1p\",\"cate_sort\":4,\"cate_status\":\"1\",\"created_date\":1460566623,\"user_created\":1,\"parent_id\":\"12\"}');
INSERT INTO `tbl_logs` VALUES ('101', 'backend', 'category', 'add', '68', '1', '1460566644', '{\"cate_name\":\"D\\u1ecbch v\\u1ee5 kh\\u00e1c\",\"cate_icon\":\"\",\"cate_slug\":\"dich-vu-khac\",\"cate_meta_title\":\"D\\u1ecbch v\\u1ee5 kh\\u00e1c\",\"cate_meta_description\":\"D\\u1ecbch v\\u1ee5 kh\\u00e1c\",\"cate_meta_keyword\":\"D\\u1ecbch v\\u1ee5 kh\\u00e1c\",\"cate_sort\":5,\"cate_status\":\"1\",\"created_date\":1460566644,\"user_created\":1,\"parent_id\":\"12\"}');
INSERT INTO `tbl_logs` VALUES ('102', 'backend', 'category', 'add', '69', '1', '1460566678', '{\"cate_name\":\"Ho\\u1ea1t \\u0111\\u1ed9ng c\\u1ed9ng \\u0111\\u1ed3ng\",\"cate_icon\":\"\",\"cate_slug\":\"hoat-dong-cong-dong\",\"cate_meta_title\":\"Ho\\u1ea1t \\u0111\\u1ed9ng c\\u1ed9ng \\u0111\\u1ed3ng\",\"cate_meta_description\":\"Ho\\u1ea1t \\u0111\\u1ed9ng c\\u1ed9ng \\u0111\\u1ed3ng\",\"cate_meta_keyword\":\"Ho\\u1ea1t \\u0111\\u1ed9ng c\\u1ed9ng \\u0111\\u1ed3ng\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460566677,\"user_created\":1,\"parent_id\":\"13\"}');
INSERT INTO `tbl_logs` VALUES ('103', 'backend', 'category', 'add', '70', '1', '1460566689', '{\"cate_name\":\"T\\u00ecnh nguy\\u1ec7n vi\\u00ean\",\"cate_icon\":\"\",\"cate_slug\":\"tinh-nguyen-vien\",\"cate_meta_title\":\"T\\u00ecnh nguy\\u1ec7n vi\\u00ean\",\"cate_meta_description\":\"T\\u00ecnh nguy\\u1ec7n vi\\u00ean\",\"cate_meta_keyword\":\"T\\u00ecnh nguy\\u1ec7n vi\\u00ean\",\"cate_sort\":2,\"cate_status\":\"1\",\"created_date\":1460566689,\"user_created\":1,\"parent_id\":\"13\"}');
INSERT INTO `tbl_logs` VALUES ('104', 'backend', 'category', 'add', '71', '1', '1460566703', '{\"cate_name\":\"S\\u1ef1 ki\\u1ec7n\",\"cate_icon\":\"\",\"cate_slug\":\"su-kien\",\"cate_meta_title\":\"S\\u1ef1 ki\\u1ec7n\",\"cate_meta_description\":\"S\\u1ef1 ki\\u1ec7n\",\"cate_meta_keyword\":\"S\\u1ef1 ki\\u1ec7n\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460566703,\"user_created\":1,\"parent_id\":\"13\"}');
INSERT INTO `tbl_logs` VALUES ('105', 'backend', 'category', 'add', '72', '1', '1460566741', '{\"cate_name\":\"T\\u00ecm gi\\u1ea5y t\\u1edd, nh\\u1eafn tin\",\"cate_icon\":\"\",\"cate_slug\":\"tim-giay-to-nhan-tin\",\"cate_meta_title\":\"T\\u00ecm gi\\u1ea5y t\\u1edd, nh\\u1eafn tin\",\"cate_meta_description\":\"T\\u00ecm gi\\u1ea5y t\\u1edd, nh\\u1eafn tin\",\"cate_meta_keyword\":\"T\\u00ecm gi\\u1ea5y t\\u1edd, nh\\u1eafn tin\",\"cate_sort\":4,\"cate_status\":\"1\",\"created_date\":1460566741,\"user_created\":1,\"parent_id\":\"13\"}');
INSERT INTO `tbl_logs` VALUES ('106', 'backend', 'category', 'add', '73', '1', '1460566755', '{\"cate_name\":\"Ho\\u1ea1t \\u0111\\u1ed9ng kh\\u00e1c\",\"cate_icon\":\"\",\"cate_slug\":\"hoat-dong-khac\",\"cate_meta_title\":\"Ho\\u1ea1t \\u0111\\u1ed9ng kh\\u00e1c\",\"cate_meta_description\":\"Ho\\u1ea1t \\u0111\\u1ed9ng kh\\u00e1c\",\"cate_meta_keyword\":\"Ho\\u1ea1t \\u0111\\u1ed9ng kh\\u00e1c\",\"cate_sort\":5,\"cate_status\":\"1\",\"created_date\":1460566755,\"user_created\":1,\"parent_id\":\"13\"}');
INSERT INTO `tbl_logs` VALUES ('107', 'backend', 'category', 'add', '74', '1', '1460566833', '{\"cate_name\":\"Tuy\\u1ec3n sinh TC, C\\u0110, \\u0110H\",\"cate_icon\":\"\",\"cate_slug\":\"tuyen-sinh-tc-cd-dh\",\"cate_meta_title\":\"Tuy\\u1ec3n sinh TC, C\\u0110, \\u0110H\",\"cate_meta_description\":\"Tuy\\u1ec3n sinh TC, C\\u0110, \\u0110H\",\"cate_meta_keyword\":\"Tuy\\u1ec3n sinh TC, C\\u0110, \\u0110H\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460566833,\"user_created\":1,\"parent_id\":\"14\"}');
INSERT INTO `tbl_logs` VALUES ('108', 'backend', 'category', 'add', '75', '1', '1460567196', '{\"cate_name\":\"D\\u1ea1y ngh\\u1ec1, s\\u1eeda ch\\u1eefa\",\"cate_icon\":\"\",\"cate_slug\":\"day-nghe-sua-chua\",\"cate_meta_title\":\"D\\u1ea1y ngh\\u1ec1, s\\u1eeda ch\\u1eefa\",\"cate_meta_description\":\"D\\u1ea1y ngh\\u1ec1, s\\u1eeda ch\\u1eefa\",\"cate_meta_keyword\":\"D\\u1ea1y ngh\\u1ec1, s\\u1eeda ch\\u1eefa\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460567196,\"user_created\":1,\"parent_id\":\"14\"}');
INSERT INTO `tbl_logs` VALUES ('109', 'backend', 'category', 'add', '76', '1', '1460567276', '{\"cate_name\":\"B\\u1eb1ng l\\u00e1i c\\u00e1c lo\\u1ea1i\",\"cate_icon\":\"\",\"cate_slug\":\"bang-lai-cac-loai\",\"cate_meta_title\":\"B\\u1eb1ng l\\u00e1i c\\u00e1c lo\\u1ea1i\",\"cate_meta_description\":\"B\\u1eb1ng l\\u00e1i c\\u00e1c lo\\u1ea1i\",\"cate_meta_keyword\":\"B\\u1eb1ng l\\u00e1i c\\u00e1c lo\\u1ea1i\",\"cate_sort\":4,\"cate_status\":\"1\",\"created_date\":1460567276,\"user_created\":1,\"parent_id\":\"14\"}');
INSERT INTO `tbl_logs` VALUES ('110', 'backend', 'category', 'add', '77', '1', '1460567342', '{\"cate_name\":\"Khai gi\\u1ea3ng l\\u1edbp h\\u1ecdc\",\"cate_icon\":\"\",\"cate_slug\":\"khai-giang-lop-hoc\",\"cate_meta_title\":\"Khai gi\\u1ea3ng l\\u1edbp h\\u1ecdc\",\"cate_meta_description\":\"Khai gi\\u1ea3ng l\\u1edbp h\\u1ecdc\",\"cate_meta_keyword\":\"Khai gi\\u1ea3ng l\\u1edbp h\\u1ecdc\",\"cate_sort\":3,\"cate_status\":\"1\",\"created_date\":1460567342,\"user_created\":1,\"parent_id\":\"14\"}');
INSERT INTO `tbl_logs` VALUES ('111', 'backend', 'category', 'add', '78', '1', '1460567360', '{\"cate_name\":\"Tuy\\u1ec3n sinh kh\\u00e1c\",\"cate_icon\":\"\",\"cate_slug\":\"tuyen-sinh-khac\",\"cate_meta_title\":\"Tuy\\u1ec3n sinh kh\\u00e1c\",\"cate_meta_description\":\"Tuy\\u1ec3n sinh kh\\u00e1c\",\"cate_meta_keyword\":\"Tuy\\u1ec3n sinh kh\\u00e1c\",\"cate_sort\":5,\"cate_status\":\"1\",\"created_date\":1460567360,\"user_created\":1,\"parent_id\":\"14\"}');
INSERT INTO `tbl_logs` VALUES ('112', 'backend', 'category', 'add', '79', '1', '1460567727', '{\"cate_name\":\"Vi\\u1ec7c t\\u00ecm ng\\u01b0\\u1eddi\",\"cate_icon\":\"\",\"cate_slug\":\"viec-tim-nguoi\",\"cate_meta_title\":\"Vi\\u1ec7c t\\u00ecm ng\\u01b0\\u1eddi\",\"cate_meta_description\":\"Vi\\u1ec7c t\\u00ecm ng\\u01b0\\u1eddi\",\"cate_meta_keyword\":\"Vi\\u1ec7c t\\u00ecm ng\\u01b0\\u1eddi\",\"cate_sort\":1,\"cate_status\":\"1\",\"created_date\":1460567727,\"user_created\":1,\"parent_id\":\"16\"}');
INSERT INTO `tbl_logs` VALUES ('113', 'backend', 'properties', 'add', '1', '1', '1460630791', '{\"prop_name\":\"Nh\\u00f3m mua b\\u00e1n\",\"prop_slug\":\"nhom-mua-ban\",\"prop_sort\":1,\"prop_status\":\"1\",\"created_date\":1460630791,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('114', 'backend', 'properties', 'add', '2', '1', '1460631315', '{\"prop_name\":\"C\\u1ea7n mua\",\"prop_slug\":\"can-mua\",\"prop_sort\":1,\"prop_status\":\"1\",\"created_date\":1460631315,\"user_created\":1,\"parent_id\":\"1\"}');
INSERT INTO `tbl_logs` VALUES ('115', 'backend', 'properties', 'add', '3', '1', '1460631421', '{\"prop_name\":\"C\\u1ea7n b\\u00e1n\",\"prop_slug\":\"can-ban\",\"prop_sort\":2,\"prop_status\":\"1\",\"created_date\":1460631421,\"user_created\":1,\"parent_id\":\"1\"}');
INSERT INTO `tbl_logs` VALUES ('116', 'backend', 'properties', 'add', '4', '1', '1460631912', '{\"prop_name\":\"Nh\\u00f3m tuy\\u1ec3n d\\u1ee5ng - vi\\u1ec7c l\\u00e0m\",\"prop_slug\":\"nhom-tuyen-dung-viec-lam\",\"prop_sort\":2,\"prop_status\":\"1\",\"created_date\":1460631912,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('117', 'backend', 'properties', 'edit', '3', '1', '1460632164', '{\"prop_name\":\"C\\u1ea7n b\\u00e1n\",\"prop_slug\":\"can-ban\",\"prop_sort\":1,\"prop_status\":\"1\",\"updated_date\":1460632164,\"user_updated\":1,\"parent_id\":4}');
INSERT INTO `tbl_logs` VALUES ('118', 'backend', 'properties', 'edit', '3', '1', '1460632191', '{\"prop_name\":\"C\\u1ea7n b\\u00e1n\",\"prop_slug\":\"can-ban\",\"prop_sort\":1,\"prop_status\":\"1\",\"updated_date\":1460632191,\"user_updated\":1,\"parent_id\":1}');
INSERT INTO `tbl_logs` VALUES ('119', 'backend', 'properties', 'edit', '3', '1', '1460632629', '{\"prop_name\":\"C\\u1ea7n b\\u00e1n\",\"prop_slug\":\"can-ban\",\"prop_sort\":2,\"prop_status\":\"1\",\"updated_date\":1460632628,\"user_updated\":1,\"parent_id\":1}');
INSERT INTO `tbl_logs` VALUES ('120', 'backend', 'properties', 'edit', '2', '1', '1460632646', '{\"prop_name\":\"C\\u1ea7n mua\",\"prop_slug\":\"can-mua\",\"prop_sort\":3,\"prop_status\":\"1\",\"updated_date\":1460632646,\"user_updated\":1,\"parent_id\":1}');
INSERT INTO `tbl_logs` VALUES ('121', 'backend', 'properties', 'edit', '2', '1', '1460632658', '{\"prop_name\":\"C\\u1ea7n mua\",\"prop_slug\":\"can-mua\",\"prop_sort\":1,\"prop_status\":\"1\",\"updated_date\":1460632658,\"user_updated\":1,\"parent_id\":1}');
INSERT INTO `tbl_logs` VALUES ('122', 'backend', 'properties', 'add', '5', '1', '1460632713', '{\"prop_name\":\"Chuy\\u1ec3n nh\\u01b0\\u1ee3ng\",\"prop_slug\":\"chuyen-nhuong\",\"prop_sort\":3,\"prop_status\":\"1\",\"created_date\":1460632713,\"user_created\":1,\"parent_id\":\"1\"}');
INSERT INTO `tbl_logs` VALUES ('123', 'backend', 'properties', 'add', '6', '1', '1460632863', '{\"prop_name\":\"Nhu c\\u1ea7u kh\\u00e1c\",\"prop_slug\":\"nhu-cau-khac\",\"prop_sort\":4,\"prop_status\":\"1\",\"created_date\":1460632863,\"user_created\":1,\"parent_id\":\"1\"}');
INSERT INTO `tbl_logs` VALUES ('124', 'backend', 'properties', 'add', '7', '1', '1460632886', '{\"prop_name\":\"Tuy\\u1ec3n d\\u1ee5ng\",\"prop_slug\":\"tuyen-dung\",\"prop_sort\":1,\"prop_status\":\"1\",\"created_date\":1460632886,\"user_created\":1,\"parent_id\":\"4\"}');
INSERT INTO `tbl_logs` VALUES ('125', 'backend', 'properties', 'add', '8', '1', '1460632909', '{\"prop_name\":\"T\\u00ecm vi\\u1ec7c\",\"prop_slug\":\"tim-viec\",\"prop_sort\":2,\"prop_status\":\"1\",\"created_date\":1460632909,\"user_created\":1,\"parent_id\":\"4\"}');
INSERT INTO `tbl_logs` VALUES ('126', 'backend', 'properties', 'add', '9', '1', '1460632989', '{\"prop_name\":\"Lao \\u0111\\u1ed9ng ph\\u1ed5 th\\u00f4ng\",\"prop_slug\":\"lao-dong-pho-thong\",\"prop_sort\":3,\"prop_status\":\"1\",\"created_date\":1460632989,\"user_created\":1,\"parent_id\":\"4\"}');
INSERT INTO `tbl_logs` VALUES ('127', 'backend', 'properties', 'add', '10', '1', '1460633001', '{\"prop_name\":\"Kh\\u00e1c\",\"prop_slug\":\"khac\",\"prop_sort\":4,\"prop_status\":\"1\",\"created_date\":1460633001,\"user_created\":1,\"parent_id\":\"4\"}');
INSERT INTO `tbl_logs` VALUES ('128', 'backend', 'properties', 'add', '11', '1', '1460634942', '{\"prop_name\":\"Nh\\u00f3m nhu c\\u1ea7u \\u00f4t\\u00f4 - Xe m\\u00e1y\",\"prop_slug\":\"nhom-nhu-cau-oto-xe-may\",\"prop_sort\":3,\"prop_status\":\"1\",\"created_date\":1460634942,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('129', 'backend', 'properties', 'add', '12', '1', '1460634969', '{\"prop_name\":\"C\\u1ea7n mua\",\"prop_slug\":\"can-mua\",\"prop_sort\":1,\"prop_status\":\"1\",\"created_date\":1460634969,\"user_created\":1,\"parent_id\":\"11\"}');
INSERT INTO `tbl_logs` VALUES ('130', 'backend', 'properties', 'add', '13', '1', '1460634982', '{\"prop_name\":\"C\\u1ea7n b\\u00e1n\",\"prop_slug\":\"can-ban\",\"prop_sort\":2,\"prop_status\":\"1\",\"created_date\":1460634982,\"user_created\":1,\"parent_id\":\"11\"}');
INSERT INTO `tbl_logs` VALUES ('131', 'backend', 'properties', 'add', '14', '1', '1460635023', '{\"prop_name\":\"Cho thu\\u00ea\",\"prop_slug\":\"cho-thue\",\"prop_sort\":3,\"prop_status\":\"1\",\"created_date\":1460635023,\"user_created\":1,\"parent_id\":\"11\"}');
INSERT INTO `tbl_logs` VALUES ('132', 'backend', 'properties', 'add', '15', '1', '1460635237', '{\"prop_name\":\"C\\u1ea7n thu\\u00ea\",\"prop_slug\":\"can-thue\",\"prop_sort\":4,\"prop_status\":\"1\",\"created_date\":1460635237,\"user_created\":1,\"parent_id\":\"11\"}');
INSERT INTO `tbl_logs` VALUES ('133', 'backend', 'properties', 'add', '16', '1', '1460641162', '{\"prop_name\":\"D\\u1ecbch v\\u1ee5 s\\u1eeda ch\\u1eefa\",\"prop_slug\":\"dich-vu-sua-chua\",\"prop_sort\":4,\"prop_status\":\"1\",\"created_date\":1460641162,\"user_created\":1,\"parent_id\":\"11\"}');
INSERT INTO `tbl_logs` VALUES ('134', 'backend', 'properties', 'add', '17', '1', '1460641192', '{\"prop_name\":\"Nhu c\\u1ea7u kh\\u00e1c\",\"prop_slug\":\"nhu-cau-khac\",\"prop_sort\":5,\"prop_status\":\"1\",\"created_date\":1460641192,\"user_created\":1,\"parent_id\":\"11\"}');
INSERT INTO `tbl_logs` VALUES ('135', 'backend', 'properties', 'edit', '9', '1', '1460641282', '{\"prop_name\":\"D\\u1ecbch v\\u1ee5 lao \\u0111\\u1ed9ng\",\"prop_slug\":\"dich-vu-lao-dong\",\"prop_sort\":3,\"prop_status\":\"1\",\"updated_date\":1460641282,\"user_updated\":1,\"parent_id\":4}');
INSERT INTO `tbl_logs` VALUES ('136', 'backend', 'properties', 'add', '18', '1', '1460641695', '{\"prop_name\":\"Nh\\u00f3m nh\\u00e0 \\u0111\\u1ea5t\",\"prop_slug\":\"nhom-nha-dat\",\"prop_sort\":4,\"prop_status\":\"1\",\"created_date\":1460641695,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('137', 'backend', 'properties', 'add', '19', '1', '1460641713', '{\"prop_name\":\"C\\u1ea7n b\\u00e1n\",\"prop_slug\":\"can-ban\",\"prop_sort\":1,\"prop_status\":\"1\",\"created_date\":1460641713,\"user_created\":1,\"parent_id\":\"18\"}');
INSERT INTO `tbl_logs` VALUES ('138', 'backend', 'properties', 'add', '20', '1', '1460641724', '{\"prop_name\":\"C\\u1ea7n mua\",\"prop_slug\":\"can-mua\",\"prop_sort\":2,\"prop_status\":\"1\",\"created_date\":1460641724,\"user_created\":1,\"parent_id\":\"18\"}');
INSERT INTO `tbl_logs` VALUES ('139', 'backend', 'properties', 'add', '21', '1', '1460641739', '{\"prop_name\":\"Cho thu\\u00ea\",\"prop_slug\":\"cho-thue\",\"prop_sort\":3,\"prop_status\":\"1\",\"created_date\":1460641739,\"user_created\":1,\"parent_id\":\"18\"}');
INSERT INTO `tbl_logs` VALUES ('140', 'backend', 'properties', 'add', '22', '1', '1460641761', '{\"prop_name\":\"C\\u1ea7n thu\\u00ea\",\"prop_slug\":\"can-thue\",\"prop_sort\":4,\"prop_status\":\"1\",\"created_date\":1460641761,\"user_created\":1,\"parent_id\":\"18\"}');
INSERT INTO `tbl_logs` VALUES ('141', 'backend', 'properties', 'add', '23', '1', '1460641782', '{\"prop_name\":\"Chuy\\u1ec3n nh\\u01b0\\u1ee3ng\",\"prop_slug\":\"chuyen-nhuong\",\"prop_sort\":2,\"prop_status\":\"1\",\"created_date\":1460641782,\"user_created\":1,\"parent_id\":\"18\"}');
INSERT INTO `tbl_logs` VALUES ('142', 'backend', 'properties', 'add', '24', '1', '1460641815', '{\"prop_name\":\"Nhu c\\u1ea7u kh\\u00e1c\",\"prop_slug\":\"nhu-cau-khac\",\"prop_sort\":5,\"prop_status\":\"1\",\"created_date\":1460641814,\"user_created\":1,\"parent_id\":\"18\"}');
INSERT INTO `tbl_logs` VALUES ('143', 'backend', 'properties', 'add', '25', '1', '1460644800', '{\"prop_name\":\"Nh\\u00f3m nhu c\\u1ea7u \\u0110i\\u00ean tho\\u1ea1i - laptop\",\"prop_slug\":\"nhom-nhu-cau-dien-thoai-laptop\",\"prop_sort\":1,\"prop_status\":\"1\",\"created_date\":1460644800,\"user_created\":1,\"parent_id\":\"0\"}');
INSERT INTO `tbl_logs` VALUES ('144', 'backend', 'properties', 'add', '26', '1', '1460644814', '{\"prop_name\":\"C\\u1ea7n mua\",\"prop_slug\":\"can-mua\",\"prop_sort\":1,\"prop_status\":\"1\",\"created_date\":1460644814,\"user_created\":1,\"parent_id\":\"25\"}');
INSERT INTO `tbl_logs` VALUES ('145', 'backend', 'properties', 'add', '27', '1', '1460644830', '{\"prop_name\":\"C\\u1ea7n b\\u00e1n\",\"prop_slug\":\"can-ban\",\"prop_sort\":2,\"prop_status\":\"1\",\"created_date\":1460644830,\"user_created\":1,\"parent_id\":\"25\"}');
INSERT INTO `tbl_logs` VALUES ('146', 'backend', 'properties', 'add', '28', '1', '1460644854', '{\"prop_name\":\"D\\u1ecbch v\\u1ee5 s\\u1eeda ch\\u1eefa\",\"prop_slug\":\"dich-vu-sua-chua\",\"prop_sort\":3,\"prop_status\":\"1\",\"created_date\":1460644854,\"user_created\":1,\"parent_id\":\"25\"}');
INSERT INTO `tbl_logs` VALUES ('147', 'backend', 'properties', 'add', '29', '1', '1460644869', '{\"prop_name\":\"Kh\\u00e1c\",\"prop_slug\":\"khac\",\"prop_sort\":4,\"prop_status\":\"1\",\"created_date\":1460644869,\"user_created\":1,\"parent_id\":\"25\"}');
INSERT INTO `tbl_logs` VALUES ('148', 'backend', 'category', 'edit', '1', '1', '1460645586', '{\"cate_name\":\"\\u0110i\\u1ec7n tho\\u1ea1i\",\"cate_icon\":\"icon-mobile-phone\",\"cate_slug\":\"dien-thoai\",\"cate_meta_title\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_description\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_keyword\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_sort\":1,\"cate_status\":\"1\",\"updated_date\":1460645586,\"user_updated\":1,\"parent_id\":25,\"prop_id\":null}');
INSERT INTO `tbl_logs` VALUES ('149', 'backend', 'category', 'edit', '1', '1', '1460646075', '{\"cate_name\":\"\\u0110i\\u1ec7n tho\\u1ea1i\",\"cate_icon\":\"icon-mobile-phone\",\"cate_slug\":\"dien-thoai\",\"cate_meta_title\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_description\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_meta_keyword\":\"\\u0111i\\u1ec7n tho\\u1ea1i, rao v\\u1eb7t \\u0111i\\u1ec7n tho\\u1ea1i,\",\"cate_sort\":1,\"cate_status\":\"1\",\"updated_date\":1460646075,\"user_updated\":1,\"parent_id\":0,\"prop_id\":25}');
INSERT INTO `tbl_logs` VALUES ('150', 'backend', 'category', 'edit', '2', '1', '1462441715', '{\"cate_name\":\"M\\u00e1y t\\u00ednh\",\"cate_icon\":\"icon-desktop\",\"cate_slug\":\"may-tinh\",\"cate_meta_title\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_meta_description\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_meta_keyword\":\"Rao v\\u1eb7t m\\u00e1y t\\u00ednh. m\\u00e1y t\\u00ednh \\u0111\\u1ec3 b\\u00e0n\",\"cate_sort\":2,\"cate_status\":\"1\",\"updated_date\":1462441715,\"user_updated\":1,\"parent_id\":0,\"prop_id\":25}');
INSERT INTO `tbl_logs` VALUES ('151', 'backend', 'category', 'edit', '16', '1', '1462441743', '{\"cate_name\":\"Tuy\\u1ec3n d\\u1ee5ng - vi\\u1ec7c l\\u00e0m\",\"cate_icon\":\"fa-briefcase\",\"cate_slug\":\"tuyen-dung-viec-lam\",\"cate_meta_title\":\"Tuy\\u1ec3n d\\u1ee5ng - vi\\u1ec7c l\\u00e0m\",\"cate_meta_description\":\"Tuy\\u1ec3n d\\u1ee5ng - vi\\u1ec7c l\\u00e0m\",\"cate_meta_keyword\":\"Tuy\\u1ec3n d\\u1ee5ng - vi\\u1ec7c l\\u00e0m\",\"cate_sort\":3,\"cate_status\":\"1\",\"updated_date\":1462441743,\"user_updated\":1,\"parent_id\":0,\"prop_id\":4}');
INSERT INTO `tbl_logs` VALUES ('152', 'backend', 'category', 'edit', '5', '1', '1462441766', '{\"cate_name\":\"Nh\\u00e0 \\u0111\\u1ea5t\",\"cate_icon\":\"icon-home\",\"cate_slug\":\"nha-dat\",\"cate_meta_title\":\"Mua b\\u00e1n nh\\u00e0 \\u0111\\u1ea5t,\",\"cate_meta_description\":\"Mua b\\u00e1n nh\\u00e0 \\u0111\\u1ea5t,\",\"cate_meta_keyword\":\"Mua b\\u00e1n nh\\u00e0 \\u0111\\u1ea5t,\",\"cate_sort\":4,\"cate_status\":\"1\",\"updated_date\":1462441766,\"user_updated\":1,\"parent_id\":0,\"prop_id\":18}');
INSERT INTO `tbl_logs` VALUES ('153', 'backend', 'category', 'edit', '10', '1', '1462441798', '{\"cate_name\":\"Xe m\\u00e1y\",\"cate_icon\":\"icon-motorcycle\",\"cate_slug\":\"xe-may\",\"cate_meta_title\":\"Xe m\\u00e1y\",\"cate_meta_description\":\"Xe m\\u00e1y\",\"cate_meta_keyword\":\"Xe m\\u00e1y\",\"cate_sort\":6,\"cate_status\":\"1\",\"updated_date\":1462441798,\"user_updated\":1,\"parent_id\":0,\"prop_id\":11}');
INSERT INTO `tbl_logs` VALUES ('154', 'backend', 'category', 'edit', '9', '1', '1462441821', '{\"cate_name\":\"\\u00d4t\\u00f4\",\"cate_icon\":\"icon-truck\",\"cate_slug\":\"oto\",\"cate_meta_title\":\"\\u00d4t\\u00f4\",\"cate_meta_description\":\"\\u00d4t\\u00f4\",\"cate_meta_keyword\":\"\\u00d4t\\u00f4\",\"cate_sort\":8,\"cate_status\":\"1\",\"updated_date\":1462441821,\"user_updated\":1,\"parent_id\":0,\"prop_id\":11}');

-- ----------------------------
-- Table structure for tbl_messages
-- ----------------------------
DROP TABLE IF EXISTS `tbl_messages`;
CREATE TABLE `tbl_messages` (
  `mess_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_created` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `mess_content` text NOT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `user_info` text NOT NULL,
  `cont_id` int(11) NOT NULL,
  `is_send_mail` int(11) DEFAULT '0',
  `is_view` int(11) DEFAULT '0',
  `updated_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`mess_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_messages
-- ----------------------------
INSERT INTO `tbl_messages` VALUES ('1', '2', '1461847984', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '7', '', '0', '0', '0', null);
INSERT INTO `tbl_messages` VALUES ('2', '2', '1461848687', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '7', '', '0', '0', '0', null);
INSERT INTO `tbl_messages` VALUES ('3', '2', '1461853308', 'ádasdaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '7', '', '0', '0', '0', null);
INSERT INTO `tbl_messages` VALUES ('4', '2', '1461853373', 'ádasdaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '7', '', '0', '0', '0', null);
INSERT INTO `tbl_messages` VALUES ('5', '2', '1461853419', 'ádasdaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '7', '', '0', '0', '0', null);
INSERT INTO `tbl_messages` VALUES ('6', '2', '1461853867', '11111111111111111111111111111111111111111111111111111', '7', '', '0', '0', '0', null);
INSERT INTO `tbl_messages` VALUES ('7', '2', '1461854460', '11111111111111111111111111111111111111111111111111111', '7', '', '0', '0', '0', null);
INSERT INTO `tbl_messages` VALUES ('8', '2', '1461854800', 'asdasdasdasdsadasdsadasdaasdasdas', '7', '', '5', '0', '0', null);
INSERT INTO `tbl_messages` VALUES ('9', '2', '1461854871', 'asdasdasdasdsadasdsadasdaasdasdas', '7', '', '5', '0', '1', '1461885689');
INSERT INTO `tbl_messages` VALUES ('10', '2', '1461855103', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '7', '', '5', '0', '1', null);
INSERT INTO `tbl_messages` VALUES ('11', '2', '1461855200', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '7', '', '5', '0', '1', null);
INSERT INTO `tbl_messages` VALUES ('12', '2', '1461855366', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '7', '', '5', '0', '1', null);
INSERT INTO `tbl_messages` VALUES ('13', '2', '1461855456', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '7', '', '5', '0', '1', null);
INSERT INTO `tbl_messages` VALUES ('14', '2', '1461886348', '11111111111111111111111111111111111111111111111111111111111111111111111', '7', '', '5', '0', '0', null);
INSERT INTO `tbl_messages` VALUES ('15', '2', '1461886635', 'llalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalala', '7', '', '5', '0', '0', null);
INSERT INTO `tbl_messages` VALUES ('16', '2', '1461886642', 'llalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalala', '7', '', '5', '0', '0', null);
INSERT INTO `tbl_messages` VALUES ('17', '2', '1461886648', 'llalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalala', '7', '', '5', '0', '0', null);
INSERT INTO `tbl_messages` VALUES ('18', '2', '1461886654', 'llalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalalallalalalalalalalalalalalalala', '7', '', '5', '0', '0', null);

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
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `created_date` int(11) NOT NULL,
  `prop_sort` varchar(255) DEFAULT NULL,
  `prop_grade` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `prop_status` int(11) DEFAULT NULL,
  `updated_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`prop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_properties
-- ----------------------------
INSERT INTO `tbl_properties` VALUES ('1', 'Nhóm mua bán', 'nhom-mua-ban', '1', null, '1460630791', '1', '0001:0001:', '0', '1', null);
INSERT INTO `tbl_properties` VALUES ('2', 'Cần mua', 'can-mua', '1', '1', '1460631315', '1', '0001:0001:0001:0002:', '1', '1', '1460632658');
INSERT INTO `tbl_properties` VALUES ('3', 'Cần bán', 'can-ban', '1', '1', '1460631421', '2', '0001:0001:0002:0003:', '1', '1', '1460632628');
INSERT INTO `tbl_properties` VALUES ('4', 'Nhóm tuyển dụng - việc làm', 'nhom-tuyen-dung-viec-lam', '1', null, '1460631912', '2', '0002:0004:', '0', '1', null);
INSERT INTO `tbl_properties` VALUES ('5', 'Chuyển nhượng', 'chuyen-nhuong', '1', null, '1460632713', '3', '0001:0001:0003:0005:', '1', '1', null);
INSERT INTO `tbl_properties` VALUES ('6', 'Nhu cầu khác', 'nhu-cau-khac', '1', null, '1460632863', '4', '0001:0001:0004:0006:', '1', '1', null);
INSERT INTO `tbl_properties` VALUES ('7', 'Tuyển dụng', 'tuyen-dung', '1', null, '1460632886', '1', '0002:0004:0001:0007:', '4', '1', null);
INSERT INTO `tbl_properties` VALUES ('8', 'Tìm việc', 'tim-viec', '1', null, '1460632909', '2', '0002:0004:0002:0008:', '4', '1', null);
INSERT INTO `tbl_properties` VALUES ('9', 'Dịch vụ lao động', 'dich-vu-lao-dong', '1', '1', '1460632989', '3', '0002:0004:0003:0009:', '4', '1', '1460641282');
INSERT INTO `tbl_properties` VALUES ('10', 'Khác', 'khac', '1', null, '1460633001', '4', '0002:0004:0004:0010:', '4', '1', null);
INSERT INTO `tbl_properties` VALUES ('11', 'Nhóm nhu cầu ôtô - Xe máy', 'nhom-nhu-cau-oto-xe-may', '1', null, '1460634942', '3', '0003:0011:', '0', '1', null);
INSERT INTO `tbl_properties` VALUES ('12', 'Cần mua', 'can-mua', '1', null, '1460634969', '1', '0003:0011:0001:0012:', '11', '1', null);
INSERT INTO `tbl_properties` VALUES ('13', 'Cần bán', 'can-ban', '1', null, '1460634982', '2', '0003:0011:0002:0013:', '11', '1', null);
INSERT INTO `tbl_properties` VALUES ('14', 'Cho thuê', 'cho-thue', '1', null, '1460635023', '3', '0003:0011:0003:0014:', '11', '1', null);
INSERT INTO `tbl_properties` VALUES ('15', 'Cần thuê', 'can-thue', '1', null, '1460635237', '4', '0003:0011:0004:0015:', '11', '1', null);
INSERT INTO `tbl_properties` VALUES ('16', 'Dịch vụ sửa chữa', 'dich-vu-sua-chua', '1', null, '1460641162', '4', '0003:0011:0004:0016:', '11', '1', null);
INSERT INTO `tbl_properties` VALUES ('17', 'Nhu cầu khác', 'nhu-cau-khac', '1', null, '1460641192', '5', '0003:0011:0005:0017:', '11', '1', null);
INSERT INTO `tbl_properties` VALUES ('18', 'Nhóm nhà đất', 'nhom-nha-dat', '1', null, '1460641695', '4', '0004:0018:', '0', '1', null);
INSERT INTO `tbl_properties` VALUES ('19', 'Cần bán', 'can-ban', '1', null, '1460641713', '1', '0004:0018:0001:0019:', '18', '1', null);
INSERT INTO `tbl_properties` VALUES ('20', 'Cần mua', 'can-mua', '1', null, '1460641724', '2', '0004:0018:0002:0020:', '18', '1', null);
INSERT INTO `tbl_properties` VALUES ('21', 'Cho thuê', 'cho-thue', '1', null, '1460641739', '3', '0004:0018:0003:0021:', '18', '1', null);
INSERT INTO `tbl_properties` VALUES ('22', 'Cần thuê', 'can-thue', '1', null, '1460641761', '4', '0004:0018:0004:0022:', '18', '1', null);
INSERT INTO `tbl_properties` VALUES ('23', 'Chuyển nhượng', 'chuyen-nhuong', '1', null, '1460641782', '2', '0004:0018:0002:0023:', '18', '1', null);
INSERT INTO `tbl_properties` VALUES ('24', 'Nhu cầu khác', 'nhu-cau-khac', '1', null, '1460641814', '5', '0004:0018:0005:0024:', '18', '1', null);
INSERT INTO `tbl_properties` VALUES ('25', 'Nhóm nhu cầu Điên thoại - laptop', 'nhom-nhu-cau-dien-thoai-laptop', '1', null, '1460644800', '1', '0001:0025:', '0', '1', null);
INSERT INTO `tbl_properties` VALUES ('26', 'Cần mua', 'can-mua', '1', null, '1460644814', '1', '0001:0025:0001:0026:', '25', '1', null);
INSERT INTO `tbl_properties` VALUES ('27', 'Cần bán', 'can-ban', '1', null, '1460644830', '2', '0001:0025:0002:0027:', '25', '1', null);
INSERT INTO `tbl_properties` VALUES ('28', 'Dịch vụ sửa chữa', 'dich-vu-sua-chua', '1', null, '1460644854', '3', '0001:0025:0003:0028:', '25', '1', null);
INSERT INTO `tbl_properties` VALUES ('29', 'Khác', 'khac', '1', null, '1460644869', '4', '0001:0025:0004:0029:', '25', '1', null);

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
  `user_avatar_social` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('1', 'admin', 'admin@raovat.vn', '0973531618', null, '34567890', null, null, null, '0', null, '1', '1', '4297f44b13955235245b2497399d7a93', '1462441674', '192.168.134.1', 'Admin', null, null, null, null, null);
INSERT INTO `tbl_users` VALUES ('2', '', 'ngocchien01@gmail.com', '0973531619', '1', '1460119396', '2', '1462343191', 'https://www.facebook.com/app_scoped_user_id/1077754252286056/', '0', '[{\"sourceImage\":\"http:\\/\\/dev.st.raovat.vn\\/uploads\\/user\\/2016\\/05\\/04\\/1462343191.692.jpg\",\"thumbImage\":{\"150x150\":\"http:\\/\\/dev.st.raovat.vn\\/uploads\\/user\\/2016\\/05\\/04\\/thumbs\\/150x150\\/1462343191.692.jpg\",\"30x30\":\"http:\\/\\/dev.st.raovat.vn\\/uploads\\/user\\/2016\\/05\\/04\\/thumbs\\/30x30\\/1462343191.692.jpg\",\"120x120\":\"http:\\/\\/dev.st.raovat.vn\\/uploads\\/user\\/2016\\/05\\/04\\/thumbs\\/120x120\\/1462343191.692.jpg\"}}]', '1', '3', '4297f44b13955235245b2497399d7a93', '1462342492', '192.168.29.1', 'Nguyễn Ngọc Chiến', '1', '638902800', 'ef575e8837d065a1683c022d2077d3421460361729', '1460620929', null);
INSERT INTO `tbl_users` VALUES ('3', '', 'q@gmail.com', '0973531616', null, '1460344674', null, null, null, '0', null, '1', '5', '4297f44b13955235245b2497399d7a93', '1460344674', '192.168.29.1', 'Lê Na', null, null, null, null, null);
INSERT INTO `tbl_users` VALUES ('4', '', 'aaaaaa@gmail.com', '09090909090', null, '1460345415', null, null, null, '0', null, '1', '5', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', '1460345415', '192.168.29.1', 'aaaaaa', null, null, null, null, null);
INSERT INTO `tbl_users` VALUES ('6', '', 'ngaoda.net@gmail.com', '0909090909', null, '1460908611', null, null, 'google.com', '0', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', '1', '0', '4297f44b13955235245b2497399d7a93', '1460936477', '192.168.29.1', 'da ngao', null, null, null, null, null);
INSERT INTO `tbl_users` VALUES ('7', '', 'chiennguyenngoc@hhdgroup.com', '09999999999', null, '1460936572', null, '1462115823', 'google.com', '0', '[{\"sourceImage\":\"http:\\/\\/dev.st.raovat.vn\\/uploads\\/user\\/2016\\/05\\/01\\/1462115823.285.jpg\",\"thumbImage\":{\"150x150\":\"http:\\/\\/dev.st.raovat.vn\\/uploads\\/user\\/2016\\/05\\/01\\/thumbs\\/150x150\\/1462115823.285.jpg\"}}]', '1', '0', '4297f44b13955235245b2497399d7a93', '1462115637', '192.168.29.1', 'Ngọc Chiến Nguyễn', null, null, null, null, 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg');

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
