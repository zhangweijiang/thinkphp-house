/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : house

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-12-28 13:43:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for xjc_admin
-- ----------------------------
DROP TABLE IF EXISTS `xjc_admin`;
CREATE TABLE `xjc_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `username` varchar(20) DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `tel` varchar(11) DEFAULT NULL COMMENT '手机号',
  `email` varchar(33) DEFAULT NULL COMMENT '邮箱',
  `user_img` varchar(255) DEFAULT NULL COMMENT '用户头像',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态:0表示禁用,1表示启用',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1表示中介,2表示管理员',
  `card` varchar(33) DEFAULT NULL COMMENT '身份证',
  `company` varchar(33) DEFAULT NULL COMMENT '所属公司',
  `store` varchar(33) DEFAULT NULL COMMENT '分店',
  `sex` tinyint(1) DEFAULT '1' COMMENT '性别:1表示男,2表示女',
  `truename` varchar(20) DEFAULT NULL COMMENT '真实姓名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of xjc_admin
-- ----------------------------
INSERT INTO `xjc_admin` VALUES ('1', 'zwj', 'aaffebecec560fec66e75f24062224ffa4e07696d2ae9a1fee3707c3f8fd9373', '13665994204', '982215226@qq.com', '20181228\\6abae2257309571959087f5479a4aea5.jpeg', '2', '1513692555', '2', '350627199501220022', '麦田', '福州仓山', '2', '徐金春');

-- ----------------------------
-- Table structure for xjc_admin_oath
-- ----------------------------
DROP TABLE IF EXISTS `xjc_admin_oath`;
CREATE TABLE `xjc_admin_oath` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(33) DEFAULT NULL COMMENT '控制器',
  `name` varchar(33) DEFAULT NULL COMMENT '名称',
  `summary` varchar(255) DEFAULT NULL COMMENT '描述',
  `type` tinyint(1) DEFAULT '1' COMMENT '类型:1表示中介，2表示管理员',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1172 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of xjc_admin_oath
-- ----------------------------
INSERT INTO `xjc_admin_oath` VALUES ('1', 'adminoath', '权限管理-权限列表', '管理管理员和中介权限', '2', '1514008853');
INSERT INTO `xjc_admin_oath` VALUES ('2', 'admin', '系统管理员-管理员列表', '管理后台管理员', '2', '1514000000');
INSERT INTO `xjc_admin_oath` VALUES ('1150', 'agency', '用户管理-中介用户列表', '管理中介用户', '2', '1514217875');
INSERT INTO `xjc_admin_oath` VALUES ('1151', 'user', '用户管理-普通用户列表', '管理普通用户', '2', '1514217911');
INSERT INTO `xjc_admin_oath` VALUES ('1152', 'house', '房屋管理-房屋列表', '管理房屋信息', '2', '1514217939');
INSERT INTO `xjc_admin_oath` VALUES ('1153', 'housecheck', '房屋管理-房屋审核列表', '管理房屋的审核状态', '2', '1514217979');
INSERT INTO `xjc_admin_oath` VALUES ('1154', 'house', '房屋管理-房屋列表', '管理房屋信息', '1', '1514219904');
INSERT INTO `xjc_admin_oath` VALUES ('1162', 'housedepute', '房屋管理-房屋委托列表', '管理房屋委托新信息', '1', '1514381877');
INSERT INTO `xjc_admin_oath` VALUES ('1163', 'housedepute', '房屋管理-房屋委托列表', '管理房屋委托信息', '2', '1514381898');
INSERT INTO `xjc_admin_oath` VALUES ('1164', 'houseconfig', '房屋管理-房屋配置列表', '房屋管理-房屋配置列表', '2', '1518415427');
INSERT INTO `xjc_admin_oath` VALUES ('1165', 'sellinghouse', '房屋管理-二手房列表', '房屋管理-二手房列表', '1', '1519570954');
INSERT INTO `xjc_admin_oath` VALUES ('1166', 'sellinghouse', '房屋管理-二手房列表', '房屋管理-二手房列表', '2', '1519570966');
INSERT INTO `xjc_admin_oath` VALUES ('1169', 'agency', '中介用户', '中介用户', '1', '1520408667');
INSERT INTO `xjc_admin_oath` VALUES ('1170', 'reservations', '房屋管理-预约看房列表', '房屋管理-预约看房列表', '1', '1521102172');
INSERT INTO `xjc_admin_oath` VALUES ('1171', 'reservations', '房屋管理-预约看房列表', '房屋管理-预约看房列表', '2', '1521102202');

-- ----------------------------
-- Table structure for xjc_attention
-- ----------------------------
DROP TABLE IF EXISTS `xjc_attention`;
CREATE TABLE `xjc_attention` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `house_id` int(11) DEFAULT NULL COMMENT '房子id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='关注表(租房)';

-- ----------------------------
-- Records of xjc_attention
-- ----------------------------
INSERT INTO `xjc_attention` VALUES ('10', '1', '11', '1520593583');
INSERT INTO `xjc_attention` VALUES ('11', '1', '13', '1520908384');
INSERT INTO `xjc_attention` VALUES ('18', '9', '13', '1521371576');

-- ----------------------------
-- Table structure for xjc_house
-- ----------------------------
DROP TABLE IF EXISTS `xjc_house`;
CREATE TABLE `xjc_house` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `admin_id` int(11) DEFAULT NULL COMMENT 'admin表的主键id',
  `title` varchar(50) NOT NULL COMMENT '房屋标题',
  `name` varchar(50) DEFAULT NULL COMMENT '小区名称',
  `desc` text COMMENT '房屋描述',
  `type1` int(11) DEFAULT NULL COMMENT '室',
  `type2` int(11) DEFAULT NULL COMMENT '厅',
  `type3` int(11) DEFAULT NULL COMMENT '卫',
  `acreage` int(11) DEFAULT NULL COMMENT '面积',
  `direction` varchar(33) DEFAULT NULL COMMENT '朝向',
  `decoration` tinyint(1) DEFAULT '1' COMMENT '装修：1表示精装修，2表示普通装修，3表示毛坯房',
  `floor` tinyint(1) NOT NULL DEFAULT '1' COMMENT '所在楼层:1底层,2低楼层，3中楼层，4高楼层，5顶层',
  `floor_count` int(11) DEFAULT '0' COMMENT '共几层',
  `way` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1表示整租，2表示合租',
  `config` varchar(255) NOT NULL DEFAULT '无' COMMENT '房屋配置',
  `money` double(10,2) DEFAULT '0.00' COMMENT '租金',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '审核状态:0表示审核中，1表示通过，2表示不通过',
  `username` varchar(50) DEFAULT NULL COMMENT '发布者姓名',
  `on_sale` tinyint(1) DEFAULT '0' COMMENT '0表示下架,1表示上架',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `attention` int(11) DEFAULT '0' COMMENT '关注量',
  `house_sn` varchar(33) DEFAULT NULL COMMENT '房屋编号',
  `heating_method` tinyint(1) DEFAULT NULL COMMENT '供暖方式：1自供暖,2集体供暖',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='租房表';

-- ----------------------------
-- Records of xjc_house
-- ----------------------------
INSERT INTO `xjc_house` VALUES ('1', '1', '丽景天成二期，两室1厅，朝北', '象山公寓（二区）', '房东人很好', '2', '1', '1', '65', '东', '1', '1', '1', '0', '14,12,11,7,6,5,4,3,2', '3000.00', '1', 'xjc', '0', '1519196450', '福州市仓山区丽景天成2期', '13', '10000000001', '0');
INSERT INTO `xjc_house` VALUES ('3', '1', '闽侯大学城中海寰宇天下', '闽侯大学城中海寰宇天下', '闽侯大学城，交通便利，拎包入住，房东人超好', '2', '2', '1', '80', '东', '1', '1', '1', '0', '14,12,11,10,8,7,5,4,3', '2500.00', '1', 'xjc', '0', '1519283336', '', '13', '10000000002', '0');
INSERT INTO `xjc_house` VALUES ('2', '1', '象山公寓（二区），价格实惠', '象山公寓（二区）', '临近西湖，交通方便。拎包入住', '1', '0', '1', '20', '东', '1', '1', '1', '0', '14,12,10,9,8,6,4,3,2,1', '1500.00', '1', 'xjc', '0', '1519277550', '福州市鼓楼区洪山镇', '20', '10000000003', '0');
INSERT INTO `xjc_house` VALUES ('4', '1', '金达花园，精装大两居，诚心出租', '金达花园', '价格实惠，拎包入住', '1', '0', '1', '14', '西', '1', '1', '17', '1', '15,14,13,12,11,10,9,8,7,6,5,4,3,2,1', '900.00', '1', 'xjc', '0', '1519283803', '福州市鼓楼区洪山镇', '35', '10000000004', '0');
INSERT INTO `xjc_house` VALUES ('9', '2', '爱情公寓', '明珠小区', '物超所值', '1', '4', '2', '180', '西南', '1', '5', '32', '1', '15,14,13,12,11,10,9,8,7,6,5,4,3,2,1', '4000.00', '1', 'xjc', '1', '1521371271', '北京北京', '2', '10000000501', '1');
INSERT INTO `xjc_house` VALUES ('10', '1', '1', '2', '2', '1', '1', '1', '1', '东', '1', '1', '2', '1', '15', '2.00', '0', 'admin', '0', '1521700337', '2', '0', '10000001001', '1');

-- ----------------------------
-- Table structure for xjc_house_config
-- ----------------------------
DROP TABLE IF EXISTS `xjc_house_config`;
CREATE TABLE `xjc_house_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(33) DEFAULT NULL COMMENT '名称',
  `filename` varchar(255) DEFAULT NULL COMMENT '图片路径',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='租房-配置表';

-- ----------------------------
-- Records of xjc_house_config
-- ----------------------------
INSERT INTO `xjc_house_config` VALUES ('1', '沙发', '20180212\\530764f94115ff358401acbd8f6f4655.png', '1518421088');
INSERT INTO `xjc_house_config` VALUES ('2', '电视', '20180212\\dde03b0169e00d48783d92f6426acb34.png', '1518421104');
INSERT INTO `xjc_house_config` VALUES ('3', '书架', '20180212\\6a19c5635471a60c6c54061c434ad674.png', '1518421123');
INSERT INTO `xjc_house_config` VALUES ('4', '床', '20180212\\7fb9fa4a2a65920386465c55222a428c.png', '1518421134');
INSERT INTO `xjc_house_config` VALUES ('5', '宽带', '20180212\\2942109991aab303309807cdc1bf63b6.png', '1518421147');
INSERT INTO `xjc_house_config` VALUES ('6', '床头柜', '20180212\\31e7dfdfa128eca445e6f3075fc03738.png', '1518421165');
INSERT INTO `xjc_house_config` VALUES ('7', '书桌', '20180212\\9ad17b1034a8567a4dfd7acd33c38d93.png', '1518421174');
INSERT INTO `xjc_house_config` VALUES ('8', '衣柜', '20180212\\d04ed9110afd53b6d83f88cd31bd00c1.png', '1518421188');
INSERT INTO `xjc_house_config` VALUES ('9', '椅子', '20180212\\05d4243262859ac9a71326955e72e53d.png', '1518421210');
INSERT INTO `xjc_house_config` VALUES ('10', '洗衣机', '20180212\\a2c91fa7eb00604274e2ea2bc2da4ec1.png', '1518421222');
INSERT INTO `xjc_house_config` VALUES ('11', '冰箱', '20180212\\f5007d7089d2b86482a158a7214fe710.png', '1518421238');
INSERT INTO `xjc_house_config` VALUES ('12', '空调', '20180212\\81f6ef971ad0014c24328acda6c2603d.png', '1518421256');
INSERT INTO `xjc_house_config` VALUES ('13', '油烟机', '20180212\\ebdcaf0ca16e7cf29754a9bf823d6887.png', '1518421275');
INSERT INTO `xjc_house_config` VALUES ('14', '热水器', '20180212\\f2d854ae74c3ebb700946f5c864758c6.png', '1518421323');
INSERT INTO `xjc_house_config` VALUES ('15', '阳台', '20180212\\991657837ae8bde99dd2a0b8127ee2b6.png', '1518421334');

-- ----------------------------
-- Table structure for xjc_house_depute
-- ----------------------------
DROP TABLE IF EXISTS `xjc_house_depute`;
CREATE TABLE `xjc_house_depute` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `title` varchar(50) DEFAULT NULL COMMENT '小区名称',
  `acreage` int(11) DEFAULT NULL COMMENT '面积',
  `money` double(10,2) DEFAULT NULL COMMENT '期望租金',
  `house_type` varchar(100) DEFAULT NULL COMMENT '户型',
  `username` varchar(100) DEFAULT NULL COMMENT '联系人姓名',
  `tel` varchar(11) DEFAULT NULL COMMENT '电话',
  `is_take` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1表示未接单,2表示已接单',
  `take_name` varchar(100) DEFAULT NULL COMMENT '接单人',
  `take_id` int(11) DEFAULT '0' COMMENT '接单人id',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `take_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '接单人类型:1表示中介，２表示管理员',
  `building` int(11) DEFAULT NULL COMMENT '楼栋号',
  `unit` int(11) DEFAULT NULL COMMENT '单元号',
  `doorplate` int(11) DEFAULT NULL COMMENT '门牌号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='租房-委托表';

-- ----------------------------
-- Records of xjc_house_depute
-- ----------------------------
INSERT INTO `xjc_house_depute` VALUES ('5', '1', null, '6.00', '1', '13665994204', '13665994204', '1', null, '0', '1522399791', '1', '1', '1', '1');
INSERT INTO `xjc_house_depute` VALUES ('4', '1', null, '1.00', '1', '1', '13665994204', '1', null, '0', '1522399748', '1', '1', '1', '1');
INSERT INTO `xjc_house_depute` VALUES ('3', '13665994204', null, '1.00', '1', '1', '13665994204', '1', null, '0', '1521361836', '1', '1', '1', '1');
INSERT INTO `xjc_house_depute` VALUES ('6', '12', null, '1.00', '1', '3', '13665994204', '1', null, '0', '1522588318', '1', '1', '1', '1');
INSERT INTO `xjc_house_depute` VALUES ('7', '12', null, '1.00', '1', '3', '13665994204', '1', null, '0', '1522588320', '1', '1', '1', '1');
INSERT INTO `xjc_house_depute` VALUES ('8', '2', null, '0.00', '2', '3', '13665994204', '1', null, '0', '1522588361', '1', '2', '2', '2');
INSERT INTO `xjc_house_depute` VALUES ('9', '1', null, '0.00', '1', '1', '13665994204', '1', null, '0', '1522588392', '1', '1', '1', '1');
INSERT INTO `xjc_house_depute` VALUES ('10', '1', null, '111.00', '1', '11', '13665994204', '1', null, '0', '1522629857', '1', '1', '1', '1');
INSERT INTO `xjc_house_depute` VALUES ('11', '金尚小区', null, '1500.00', '复式', '徐', '15659266753', '1', null, '0', '1523368702', '1', '0', '2', '211');

-- ----------------------------
-- Table structure for xjc_house_img
-- ----------------------------
DROP TABLE IF EXISTS `xjc_house_img`;
CREATE TABLE `xjc_house_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `house_id` int(11) DEFAULT NULL COMMENT '房屋id',
  `filename` varchar(255) DEFAULT NULL COMMENT '图片路径',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COMMENT='租房-图片关联表';

-- ----------------------------
-- Records of xjc_house_img
-- ----------------------------
INSERT INTO `xjc_house_img` VALUES ('41', '1', '20180222\\1211b99400e576bd64168e447402692f.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('40', '1', '20180222\\52418afa3dbde7268970aeffac05aa53.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('39', '1', '20180222\\04c3ee3f79e134804b4b5af4bdbdbd67.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('38', '1', '20180222\\4ed223982d134c39c9049f2a99e5d1b2.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('37', '1', '20180222\\0502fd4e808cabe7b75711b24d861264.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('36', '1', '20180222\\2a04c3e10e49f1fa4a68ab5a964670f9.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('35', '2', '20180222\\c1f55eb14fc37ea5b6f03887bee199f4.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('34', '2', '20180222\\b45adeda24b5934e8bfcc34f9f697a3a.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('33', '2', '20180222\\99a16bf4b909789d69f33b02e39462d7.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('32', '2', '20180222\\0d45dae9fb8129eac0a2066dd3781a4d.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('31', '2', '20180222\\4da01183c4fbbbfa5b184329b3015966.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('30', '2', '20180222\\cb2e0ec020d02e444415bad5a154b036.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('42', '3', '20180222\\eee80d8927f4c8a0e2ace150b65d19d3.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('43', '3', '20180222\\1e3d2fe6e3a484e4617c8773432d860e.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('44', '3', '20180222\\b2b1522e1dc00ae1169d438ce7283630.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('45', '3', '20180222\\06f0e4bf054b755dd1f210c30af548f6.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('46', '3', '20180222\\fb8e4e1e3c1c75a9452132a8d14cc0a8.jpg', '1519283336');
INSERT INTO `xjc_house_img` VALUES ('47', '4', '20180222\\f13798204b489e834c625746a074f867.jpg', '1519283803');
INSERT INTO `xjc_house_img` VALUES ('48', '4', '20180222\\265ee7b9b314cb54654d2e10eed6e96c.jpg', '1519283803');
INSERT INTO `xjc_house_img` VALUES ('49', '4', '20180222\\7f8b72a651ba3d63e16aaa2d38d1c045.jpg', '1519283803');
INSERT INTO `xjc_house_img` VALUES ('50', '4', '20180222\\008423b4d87ab07bf1638499f8c3f5a6.jpg', '1519283803');
INSERT INTO `xjc_house_img` VALUES ('52', '9', '20180318/e889720d5d3bb670df16a9c54f8e35f9.JPG', '1521371271');

-- ----------------------------
-- Table structure for xjc_protocol
-- ----------------------------
DROP TABLE IF EXISTS `xjc_protocol`;
CREATE TABLE `xjc_protocol` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `content` text COMMENT '用户服务协议',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户服务协议表';

-- ----------------------------
-- Records of xjc_protocol
-- ----------------------------
INSERT INTO `xjc_protocol` VALUES ('1', '                        <h2 class=\"dt-tit\" style=\"padding: 0px 0px 25px; margin: 0px; font-size: 22px; font-weight: normal; text-align: center; color: rgb(51, 51, 51); font-family: \">今日租房用户服务协议</h2><p style=\"padding: 0px; margin-top: 8px; margin-bottom: 0px; margin-left: 5px; line-height: 24px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><strong><span style=\"font-size: 12px; font-family: 宋体;\">【特别提示】</span></strong></p><p style=\"padding: 0px; margin-top: 8px; margin-bottom: 0px; margin-left: 5px; line-height: 24px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><span style=\"font-size: 12px; font-family: 宋体;\">如您同意成为</span><span style=\"font-family: 宋体; font-size: 12px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">的用户或使用今日租房的服务的，请您务必仔细阅读、充分理解以下</span><span style=\"font-size: 12px; font-family: 宋体;\">《</span><span style=\"font-family: 宋体; font-size: 12px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">用户服务协议》及《</span><span style=\"font-family: 宋体; font-size: 12px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">隐私权政策》中的各项条款，尤其是协议中的以粗体方式或加下划线的方式提示您重点注意。</span></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; line-height: 24px;\"><span style=\"font-size: 12px; font-family: 宋体;\">&nbsp;</span></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; text-align: center; line-height: 24px;\"><span style=\"font-family: 宋体; font-size: 12px;\"><b>今日租房</b></span><strong><span style=\"font-size: 12px; font-family: 宋体;\">用户服务协议</span></strong></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 24px; line-height: 24px;\"><span style=\"font-size: 12px; font-family: 宋体;\">欢迎您使用</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">的服务！</span></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 24px; line-height: 24px;\"><b><span style=\"font-size: 12px; font-family: 宋体;\">为使用</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">的服务，您应当阅读并遵守本《</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">用户服务协议》（以下简称“本协议”）。本协议是用户与</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">之间的法律协议，是用户注册安居客账号并使用</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台服务或非经注册程序直接使用</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台服务时的通用条款。请您务必审慎阅读、充分理解本协议各条款内容，特别是免除或者限制责任的条款、管辖与法律适用条款。限制、免责条款可能以黑体加粗或加下划线的形式提示您重点注意。如果您不同意本协议的约定，您应立即停止注册程序或停止使用今日租房平台服务；如您继续访问和使用</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台服务，即视为您已确知并完全同意本协议各项约定。</span></b></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; line-height: 24px;\"><strong><span style=\"font-size: 12px; font-family: 宋体;\">一、定义</span></strong></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 24px; line-height: 24px;\"><span style=\"font-size: 12px; font-family: 宋体;\">1</span><span style=\"font-size: 12px; font-family: 宋体;\">、</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台，是指上海瑞家信息技术有限公司旗下运营之</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">网站、</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">无线站点（包括wap.anjuke.com,m.anjuke.com）及</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">移动应用软件（APP），</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台系专注于房地产行业为用户提供房产信息存储空间及网络推广服务的互联网平台。</span></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 24px; line-height: 24px;\"><span style=\"font-size: 12px; font-family: 宋体;\">2</span><span style=\"font-size: 12px; font-family: 宋体;\">、用户，以下亦称为“您”，系指注册或登录</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台使用安居客产品或服务的具有完全民事权利能力和行为能力的企业法人、社会团体、自然人或其他社会组织等。按用户是否经过注册程序分为注册用户和非注册用户，注册用户是指通过安居</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">完成全部注册程序后，使用</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台服务或</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">网站资料的用户。非注册用户是指未进行注册、直接登录</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台或通过其他</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台允许的方式进入</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台直接或间接地使用</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台服务或安居客网站资料的用户。按用户使用</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">服务的方式分为开发商用户、中介用户以及其他普通消费者用户，其中开发商用户及中介用户可能会使用</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">另行提供的后台系统。</span></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 24px; line-height: 24px;\"><span style=\"font-size: 12px; font-family: 宋体;\">3</span><span style=\"font-size: 12px; font-family: 宋体;\">、协议方，本协议中协议双方合称“协议方”。上海瑞家信息技术有限公司及其相关服务可能存在的运营关联单位、</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台在协议中统称为\"安居客\"。</span></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; line-height: 24px;\"><strong><span style=\"font-size: 12px; font-family: 宋体;\">二、协议的效力</span></strong></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 24px; line-height: 24px;\"><strong><span style=\"font-size: 12px; font-family: 宋体;\">1</span></strong><strong><span style=\"font-size: 12px; font-family: 宋体;\">、在您按照注册页面提示填写信息、阅读并同意本协议并完成全部注册程序后或以其他今日租房允许的方式实际使用</span></strong><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\"><b>今日租房</b></span><strong><span style=\"font-size: 12px; font-family: 宋体;\">平台服务时，您即受本协议的约束。</span></strong></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 24px; line-height: 24px;\"><strong><span style=\"font-size: 12px; font-family: 宋体;\">2</span></strong><strong><span style=\"font-size: 12px; font-family: 宋体;\">、本协议内容包括本协议正文，您在使用</span></strong><b><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">某一特定服务或系统时，该服务可能会另有单独的协议、相关业务规则、公告、帮助、说明、通用条款等（以下统称为“规则”）。所有</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">已经发布的或将来可能发布的规则均为本协议不可分割的组成部分，与本协议具有同等法律效力。除另行明确声明外，任何</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">及其关联公司提供的服务（以下称为“</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台服务”）均受本协议约束。您承诺接受并遵守本协议的约定。如果您不同意本协议的约定，您应立即停止注册程序或停止使用</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台服务；如您继续访问和使用</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台服务，即视为您已确知并完全同意本协议各项内容。</span></b></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 24px; line-height: 24px;\"><b><span style=\"font-size: 12px; font-family: 宋体;\">3</span><span style=\"font-size: 12px; font-family: 宋体;\">、</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">有权根据国家法律法规的更新、产品和服务规则的调整需要不时地制订、修改本协议及/或各类规则，并以网站公示的方式进行公示。如您继续使用</span><span style=\"font-family: 宋体; font-size: 12px; text-indent: 0px;\">今日租房</span><span style=\"font-size: 12px; font-family: 宋体;\">平台服务的，即表示您接受经修订的协议和规则。如发生有关争议时，以安居客最新的相关协议和规则为准。</span></b></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; line-height: 24px;\"><span style=\"font-size: 12px; font-family: 宋体;\">&nbsp;</span></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px;\"><strong><span style=\"font-size: 12px; font-family: 宋体;\">为维护网民和相关权利人利益，上海瑞家信息技术有限公司已经以公示的方式，为用户及相关权利人提供了丰富、便捷的线上线下投诉渠道。基于网络用户间的公平考量，同时也为了使网络用户的投诉能够及时得到处理，避免被当做垃圾邮件屏蔽，上海瑞家信息技术有限公司拒绝接收和处理所有以电子邮件形式发送给本公司员工个人的网络侵权通知，更不承诺对发送给本公司员工个人的电子邮件侵权通知进行优先处理，特此告知</span></strong></p><p><br></p>                ', '1520938293');

-- ----------------------------
-- Table structure for xjc_reservations
-- ----------------------------
DROP TABLE IF EXISTS `xjc_reservations`;
CREATE TABLE `xjc_reservations` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `admin_id` int(11) DEFAULT NULL COMMENT '房子发布者id',
  `user_id` int(11) DEFAULT NULL COMMENT '预约看房用户id',
  `username` varchar(50) DEFAULT NULL COMMENT '预约看房用户姓名',
  `house_id` int(11) DEFAULT NULL COMMENT '房子id',
  `title` varchar(50) DEFAULT NULL COMMENT '房子标题',
  `name` varchar(50) DEFAULT NULL COMMENT '小区名称',
  `building_acreage` double(10,2) DEFAULT NULL COMMENT '建筑面积',
  `money` int(10) DEFAULT NULL COMMENT '价格',
  `status` tinyint(1) DEFAULT '0' COMMENT '处理状态：0未处理，1已处理',
  `tel` varchar(11) DEFAULT NULL COMMENT '电话',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='预约看房表';

-- ----------------------------
-- Records of xjc_reservations
-- ----------------------------
INSERT INTO `xjc_reservations` VALUES ('00000000003', '1', '14', '苏彬彬', '12', '一渡新新小镇项目位于保定涞水', '一渡渡新小镇', '123.00', '30000', '1', '13665994204', '1521101947');
INSERT INTO `xjc_reservations` VALUES ('00000000005', '1', '13', '黄海滨', '3', '诚心出售 看房方便 方正格局 两梯四户', '万象新天一区', '68.22', '57168', '1', '12345678999', '1521377011');
INSERT INTO `xjc_reservations` VALUES ('00000000007', '1', '8', '徐金春', '12', '一渡新新小镇项目位于保定涞水', '一渡渡新小镇', '123.00', '30000', '0', '15659266753', '1522397090');

-- ----------------------------
-- Table structure for xjc_selling_house
-- ----------------------------
DROP TABLE IF EXISTS `xjc_selling_house`;
CREATE TABLE `xjc_selling_house` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `admin_id` int(11) DEFAULT NULL COMMENT 'admin表的主键id',
  `username` varchar(50) DEFAULT NULL COMMENT '发布者姓名',
  `title` varchar(33) DEFAULT NULL COMMENT '标题',
  `name` varchar(33) DEFAULT NULL COMMENT '小区名称',
  `desc` varchar(255) DEFAULT NULL COMMENT '小区描述',
  `see_house_time` tinyint(1) DEFAULT '1' COMMENT '1表示有租户需要预约2提前预约随时可看',
  `house_sn` varchar(33) DEFAULT NULL COMMENT '房屋编号',
  `building_acreage` double(10,2) DEFAULT NULL COMMENT '建筑面积',
  `inner_acreage` double(10,2) DEFAULT NULL COMMENT '套内面积',
  `money` double(10,2) DEFAULT NULL COMMENT '每平多少钱',
  `total_money` double(10,2) DEFAULT '0.00' COMMENT '房屋总价',
  `shi` int(11) DEFAULT NULL COMMENT '室',
  `ting` int(11) DEFAULT NULL COMMENT '厅',
  `chu` int(11) DEFAULT NULL COMMENT '厨',
  `wei` int(11) DEFAULT NULL COMMENT '卫',
  `direction` varchar(11) DEFAULT NULL COMMENT '朝向:',
  `decoration` tinyint(1) NOT NULL DEFAULT '1' COMMENT '装修：1表示精装修，2表示普通装修，3表示毛坯房',
  `heating_method` tinyint(1) DEFAULT '1' COMMENT '供暖方式:1自供暖，2集体供暖',
  `years` int(11) DEFAULT NULL COMMENT '产权年限',
  `floor` tinyint(1) NOT NULL DEFAULT '1' COMMENT '所在楼层:1底层,2低楼层，3中楼层，4高楼层，5顶层',
  `floor_count` int(11) DEFAULT NULL COMMENT '楼层共几层',
  `building_type` tinyint(1) DEFAULT '1' COMMENT '建筑类型：1塔楼，2板楼，3塔板结合',
  `family_structure` tinyint(1) NOT NULL DEFAULT '1' COMMENT '户型结构:1平层，2跃层',
  `building_structure` tinyint(1) DEFAULT '1' COMMENT '建筑结构:1钢混结构，2钢结构，3砖混结构',
  `ti` int(11) NOT NULL DEFAULT '0' COMMENT '梯户比例：梯',
  `hu` int(11) NOT NULL DEFAULT '0' COMMENT '梯户比例:户',
  `lift` tinyint(1) DEFAULT '1' COMMENT '电梯:1有,2没有',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `attention` int(11) DEFAULT NULL COMMENT '关注量',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型:1为二手房,2为新房',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='售房表';

-- ----------------------------
-- Records of xjc_selling_house
-- ----------------------------
INSERT INTO `xjc_selling_house` VALUES ('3', '1', 'xjc', '诚心出售 看房方便 方正格局 两梯四户', '万象新天一区', '价格实惠，拎包入住', '1', '10000000001', '68.22', '68.22', '57168.00', '3900000.96', '1', '1', '1', '1', '北', '1', '1', '70', '2', '12', '1', '1', '1', '2', '6', '2', '1519652884', '23', '1');
INSERT INTO `xjc_selling_house` VALUES ('6', '1', 'xjc', '全明格局 东向一居室 挂北窗 商品品质 正对小区花园', '新景家园东区', '全明格局一居室 东向挂北窗 商品品质 正对小区花园', '1', '10000000401', '61.85', '61.85', '93776.00', '5800045.60', '1', '1', '1', '1', '东', '1', '1', '70', '2', '17', '3', '1', '1', '1', '5', '2', '1519656776', '33', '1');
INSERT INTO `xjc_selling_house` VALUES ('7', '1', 'xjc', '中冶蓝城 3室1厅 270万', '中冶蓝城', '链家网真房源，更多房源信息请联系经纪人', '2', '10000000701', '97.48', '97.48', '27698.00', '2700001.04', '3', '1', '1', '1', '南北', '1', '2', '70', '2', '7', '2', '1', '1', '1', '2', '1', '1519657048', '100', '1');
INSERT INTO `xjc_selling_house` VALUES ('8', '1', 'xjc', '满五年，高楼层南北通透两居，装修好，观景高尔夫', '北辰福第一号院', '满五年，高楼层南北通透两居，装修好，观景高尔夫 满五唯一，距离地铁500米，精装修，高楼层观景高尔夫球场', '1', '10000000801', '87.16', '87.16', '49450.00', '4310062.00', '3', '1', '1', '1', '东', '2', '1', '50', '4', '27', '1', '1', '1', '2', '8', '1', '1519657454', '44', '1');
INSERT INTO `xjc_selling_house` VALUES ('9', '1', 'admin', '金府大院，五证齐全，品牌保障', '金府大院', '金府大院，环境优美', '0', '10000000901', '108.00', '96.00', '80000.00', '8640000.00', '3', '1', '1', '1', '东北', '1', '1', '70', '3', '23', '1', '1', '1', '2', '6', '1', '1519797895', null, '2');
INSERT INTO `xjc_selling_house` VALUES ('10', '1', 'admin', '五和万科长阳天地实景现房即买即住', '五和万科长阳天地', '地区繁华', '2', '10000001001', '100.00', '88.00', '62500.00', '6250000.00', '3', '1', '1', '1', '东', '1', '1', '70', '1', '25', '1', '1', '1', '2', '6', '1', '1519798587', null, '2');
INSERT INTO `xjc_selling_house` VALUES ('11', '1', 'admin', '中铁华侨城和园平层在售', '中铁华侨城和园', '价格实惠，地区繁华', '2', '10000001101', '113.00', '113.00', '35000.00', '3955000.00', '3', '1', '1', '1', '西南', '1', '1', '70', '4', '25', '3', '1', '1', '2', '4', '1', '1519798829', null, '2');
INSERT INTO `xjc_selling_house` VALUES ('12', '1', 'admin', '一渡新新小镇项目位于保定涞水', '一渡渡新小镇', '一渡渡新小镇，世贸一渡青青', '1', '10000001201', '123.00', '111.00', '30000.00', '3690000.00', '3', '2', '1', '3', '东西', '0', '1', '70', '2', '22', '1', '1', '1', '2', '4', '1', '1519799237', null, '2');
INSERT INTO `xjc_selling_house` VALUES ('17', '2', 'xjc', '1', '224', '3', '1', '10000001701', '1.00', '1.00', '4.00', '4.00', '1', '1', '1', '1', '东', '1', '1', '70', '1', '1', '2', '1', '1', '1', '1', '1', '1521375396', null, '1');
INSERT INTO `xjc_selling_house` VALUES ('18', '2', 'xjc', '1', '224', '3', '1', '10000001801', '1.00', '1.00', '4.00', '4.00', '1', '1', '1', '1', '东', '1', '1', '70', '1', '1', '2', '1', '1', '1', '1', '1', '1521375732', null, '1');

-- ----------------------------
-- Table structure for xjc_selling_house_img
-- ----------------------------
DROP TABLE IF EXISTS `xjc_selling_house_img`;
CREATE TABLE `xjc_selling_house_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `selling_house_id` int(11) DEFAULT NULL COMMENT '二手房表的主键id',
  `filename` varchar(255) DEFAULT NULL COMMENT '图片路径',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COMMENT='售房-关联图片表';

-- ----------------------------
-- Records of xjc_selling_house_img
-- ----------------------------
INSERT INTO `xjc_selling_house_img` VALUES ('2', '3', '20180226\\4b43fb2f20f80dfbc73a827d55197c17.jpg', '1519652884');
INSERT INTO `xjc_selling_house_img` VALUES ('3', '3', '20180226\\7735adf91598d0b1b972361be7412469.jpg', '1519652884');
INSERT INTO `xjc_selling_house_img` VALUES ('4', '3', '20180226\\a5807c4cb739e140a7a2963ed9232359.jpg', '1519652884');
INSERT INTO `xjc_selling_house_img` VALUES ('5', '3', '20180226\\6f2f4d57f7ce0ccc8f1e43b9266fd236.jpg', '1519652884');
INSERT INTO `xjc_selling_house_img` VALUES ('6', '6', '20180226\\d91cd50b4a22f181ed2e5377352a61e2.jpg', '1519656776');
INSERT INTO `xjc_selling_house_img` VALUES ('7', '6', '20180226\\baa1b5c4dcc474f50980900ef6507727.jpg', '1519656776');
INSERT INTO `xjc_selling_house_img` VALUES ('8', '6', '20180226\\51bcc6522cb5a6e2931bd42183114289.jpg', '1519656776');
INSERT INTO `xjc_selling_house_img` VALUES ('9', '6', '20180226\\f4a41375037f544668a9cbaa296d6e0b.jpg', '1519656776');
INSERT INTO `xjc_selling_house_img` VALUES ('10', '7', '20180226\\d97bcb82cf8e1922520312b64be707d0.jpg', '1519657048');
INSERT INTO `xjc_selling_house_img` VALUES ('11', '7', '20180226\\86109a71f994d008e333a9ed699e3cdd.jpg', '1519657048');
INSERT INTO `xjc_selling_house_img` VALUES ('12', '7', '20180226\\6715b225ebec5e0e8f7613bffc0d1d35.jpg', '1519657048');
INSERT INTO `xjc_selling_house_img` VALUES ('13', '7', '20180226\\5a0a1add51e8c5eb7b49fc737aea2f85.jpg', '1519657048');
INSERT INTO `xjc_selling_house_img` VALUES ('14', '7', '20180226\\c16ecb2b841b82bde3ebe18ec712c394.jpg', '1519657048');
INSERT INTO `xjc_selling_house_img` VALUES ('15', '8', '20180226\\c74d871fa18dee4932c91e6abc64aea7.jpg', '1519657454');
INSERT INTO `xjc_selling_house_img` VALUES ('16', '8', '20180226\\8989be54df34f29d32380a4bce32f83d.jpg', '1519657454');
INSERT INTO `xjc_selling_house_img` VALUES ('17', '8', '20180226\\985acbdf05448f48c5228d08f7ffe556.jpg', '1519657454');
INSERT INTO `xjc_selling_house_img` VALUES ('18', '8', '20180226\\90be838183b281f7b4681f5c67f2e125.jpg', '1519657454');
INSERT INTO `xjc_selling_house_img` VALUES ('19', '9', '20180228/538da28992762e800a9a37d365f3fd3e.jpg', '1519797895');
INSERT INTO `xjc_selling_house_img` VALUES ('20', '9', '20180228/e3cb9302e1a562eba37bffd96ee36a11.jpg', '1519797895');
INSERT INTO `xjc_selling_house_img` VALUES ('21', '9', '20180228/2fbdd0efdfc40b31bb7e5d787ebf6e90.jpg', '1519797895');
INSERT INTO `xjc_selling_house_img` VALUES ('22', '9', '20180228/4f37f6a670e9c5c0ec09a3e5d234bd48.jpg', '1519797895');
INSERT INTO `xjc_selling_house_img` VALUES ('23', '9', '20180228/e5260e1c4032ef6870379b46b3e7dca0.jpg', '1519797895');
INSERT INTO `xjc_selling_house_img` VALUES ('24', '10', '20180228/5133245d51346c13349f73159b465657.jpg', '1519798587');
INSERT INTO `xjc_selling_house_img` VALUES ('25', '10', '20180228/24498030e5245b873d0466a38cfb13f5.jpg', '1519798587');
INSERT INTO `xjc_selling_house_img` VALUES ('26', '10', '20180228/2e4513d21b15afa421fab0a78f9aacc2.jpg', '1519798587');
INSERT INTO `xjc_selling_house_img` VALUES ('27', '10', '20180228/ab10ea48430ab1aeb3fddb12f0dd6930.jpg', '1519798587');
INSERT INTO `xjc_selling_house_img` VALUES ('28', '10', '20180228/65fe39ac0182f2101575762d8b76bbad.jpg', '1519798587');
INSERT INTO `xjc_selling_house_img` VALUES ('29', '10', '20180228/378653d4eb9ad8acc03e2a114669542a.jpg', '1519798587');
INSERT INTO `xjc_selling_house_img` VALUES ('30', '10', '20180228/1f43b912163c149a57976c5219784dfa.jpg', '1519798587');
INSERT INTO `xjc_selling_house_img` VALUES ('31', '10', '20180228/25a4469c81e104792115f872c677355d.jpg', '1519798587');
INSERT INTO `xjc_selling_house_img` VALUES ('32', '11', '20180228/a179d3504a07ea891060d189a7c38771.jpg', '1519798829');
INSERT INTO `xjc_selling_house_img` VALUES ('33', '11', '20180228/0ac03097a1e14c64eaa42fa04b381dd1.jpg', '1519798829');
INSERT INTO `xjc_selling_house_img` VALUES ('34', '11', '20180228/6c06ac208675e5edb94468f920e9bcce.jpg', '1519798829');
INSERT INTO `xjc_selling_house_img` VALUES ('35', '11', '20180228/6f24b7a6346bf303ff6b035a26605e79.jpg', '1519798829');
INSERT INTO `xjc_selling_house_img` VALUES ('36', '11', '20180228/609dba68467a5186be6cbdf8f660a1ed.jpg', '1519798829');
INSERT INTO `xjc_selling_house_img` VALUES ('37', '11', '20180228/3764c0a282d08c66162fcf00605b0ab7.jpg', '1519798829');
INSERT INTO `xjc_selling_house_img` VALUES ('38', '11', '20180228/bd706128a65d9e04700457aa836c10ff.jpg', '1519798829');
INSERT INTO `xjc_selling_house_img` VALUES ('39', '11', '20180228/9f032a0fea120aec5d23ed324fe55aa9.jpg', '1519798829');
INSERT INTO `xjc_selling_house_img` VALUES ('40', '11', '20180228/a3d21a515322a54bea0fe9b48f2d8a6d.jpg', '1519798829');
INSERT INTO `xjc_selling_house_img` VALUES ('41', '12', '20180228/20885a4a87e5278081f4577b25b45335.jpg', '1519799237');
INSERT INTO `xjc_selling_house_img` VALUES ('42', '12', '20180228/9b5adebcca68a4a3766afe69bf6ff2df.jpg', '1519799237');
INSERT INTO `xjc_selling_house_img` VALUES ('43', '12', '20180228/ba3219e2e98cad67493943230f28d468.jpg', '1519799237');
INSERT INTO `xjc_selling_house_img` VALUES ('44', '12', '20180228/e20021bf22d2edd55e14b82fce937f1a.jpg', '1519799237');
INSERT INTO `xjc_selling_house_img` VALUES ('45', '12', '20180228/f1719cc47c22b40d913ce35c1f937892.jpg', '1519799237');
INSERT INTO `xjc_selling_house_img` VALUES ('46', '12', '20180228/450e82bb2bc2ab2af8e04298f7acfbb8.jpg', '1519799237');
INSERT INTO `xjc_selling_house_img` VALUES ('47', '12', '20180228/74bde9f3e80aa8e0c1ea3f8ddf611575.jpg', '1519799237');
INSERT INTO `xjc_selling_house_img` VALUES ('48', '12', '20180228/724b421940317df69e576807b7f0983a.jpg', '1519799237');
INSERT INTO `xjc_selling_house_img` VALUES ('49', '12', '20180228/809f5e9d4c59f222a212f83c603c9113.jpg', '1519799237');
INSERT INTO `xjc_selling_house_img` VALUES ('50', '12', '20180228/ec6376bcd79df361888a5e1736be39e9.jpg', '1519799237');
INSERT INTO `xjc_selling_house_img` VALUES ('51', '12', '20180228/64cd0fa160eb5ca0a057b9cb374dc0d2.jpg', '1519799237');
INSERT INTO `xjc_selling_house_img` VALUES ('52', '17', '20180318/2efbba6cb3e5e9fac1c047839a35308d.jpg', '1521375396');
INSERT INTO `xjc_selling_house_img` VALUES ('58', '18', '20180318/c98f8107677e9ca0addf6339f3f68390.jpg', null);
INSERT INTO `xjc_selling_house_img` VALUES ('57', '16', '20180318/da8e0e1ca2fd9f23f7670d72211265cf.jpg', null);

-- ----------------------------
-- Table structure for xjc_user
-- ----------------------------
DROP TABLE IF EXISTS `xjc_user`;
CREATE TABLE `xjc_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `username` varchar(25) DEFAULT NULL COMMENT '用户名称',
  `password` varchar(256) DEFAULT NULL COMMENT '密码',
  `tel` varchar(11) DEFAULT NULL COMMENT '用户账号（手机号）',
  `email` varchar(50) DEFAULT NULL COMMENT '电子邮箱',
  `card` varchar(18) DEFAULT NULL COMMENT '身份证',
  `user_img` varchar(255) DEFAULT NULL COMMENT '头像',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `sex` tinyint(1) DEFAULT '1' COMMENT '性别：1表示男,2表示女',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态:1表示启用，2表示禁用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of xjc_user
-- ----------------------------
INSERT INTO `xjc_user` VALUES ('13', '黄海滨', 'fd7956a18232c0cba4744c3907ebd10b', '12345678999', '123', '123', '20180305/8bc5f5411aeecbf12cf8787a6ddbca7b.jpg', null, '1', '1');
INSERT INTO `xjc_user` VALUES ('8', '徐金春', '9a9597465f0cb0e836a8d8fb56df129e', '15659266753', '709069053@qq.com', '350627199501220022', '20180305/8bc5f5411aeecbf12cf8787a6ddbca7b.jpg', '1520229380', '2', '1');
INSERT INTO `xjc_user` VALUES ('12', '宋佳佳', 'c2e9a276e5f9c2a183463c547acd9d8d', null, '982215226@qq.com', null, '20180305/8bc5f5411aeecbf12cf8787a6ddbca7b.jpg', null, '1', '1');
INSERT INTO `xjc_user` VALUES ('14', '苏彬彬', '084c3f712bae05289707f4ca120cdf4f', '', '884587785@qq.com', '', '20180305/8bc5f5411aeecbf12cf8787a6ddbca7b.jpg', null, '1', '1');
INSERT INTO `xjc_user` VALUES ('15', 'aaa', '7fef6171469e80d32c0559f88b377245', null, null, null, '20180312/1.jpg', null, '1', '1');
INSERT INTO `xjc_user` VALUES ('16', 'hbz', '946224153674b2e5afdd55b8a502725c', null, null, null, '20180312/1.jpg', null, '1', '1');
INSERT INTO `xjc_user` VALUES ('17', 'yst', '202cb962ac59075b964b07152d234b70', null, null, null, '20180312/1.jpg', null, '1', '1');
