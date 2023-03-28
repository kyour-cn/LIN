/*
 Navicat Premium Data Transfer

 Source Server         : 下单系统测试
 Source Server Type    : MySQL
 Source Server Version : 50639
 Source Host           : kyour.vip:3306
 Source Schema         : cs11

 Target Server Type    : MySQL
 Target Server Version : 50639
 File Encoding         : 65001

 Date: 22/04/2018 20:12:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for apis
-- ----------------------------
DROP TABLE IF EXISTS `apis`;
CREATE TABLE `apis`  (
  `Id` int(11) NOT NULL COMMENT 'API规则',
  `apid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'API唯一编号',
  `apianme` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'api名称',
  `apiurl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'API网络地址',
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '对接商城用' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for class
-- ----------------------------
DROP TABLE IF EXISTS `class`;
CREATE TABLE `class`  (
  `Id` int(16) NOT NULL AUTO_INCREMENT COMMENT '唯一ID，自动生成',
  `name` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名称',
  `cid` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '静态ID',
  `zt` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1' COMMENT '上架状态',
  `px` int(5) NULL DEFAULT 10 COMMENT '排序',
  `text` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '分类说明',
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of class
-- ----------------------------
INSERT INTO `class` VALUES (9, '测试商品', 'cs', '1', 1, NULL);

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config`  (
  `n` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `v` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `b` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`n`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('admin', '10086', '管理员账号');
INSERT INTO `config` VALUES ('by', '', NULL);
INSERT INTO `config` VALUES ('ccon', '', 'CC攻击防御开关');
INSERT INTO `config` VALUES ('cdn', '', '资源服务器地址');
INSERT INTO `config` VALUES ('gg', '<p>公告</p>\r\n', '公告');
INSERT INTO `config` VALUES ('name', '科佑儿VIP下单系统', '站点名称');
INSERT INTO `config` VALUES ('ptime', '1', '默认时区开关');
INSERT INTO `config` VALUES ('title', '科佑儿 LIN系统1.0', '站点标题');

-- ----------------------------
-- Table structure for gd
-- ----------------------------
DROP TABLE IF EXISTS `gd`;
CREATE TABLE `gd`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `uid` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户ID',
  `cid` int(11) NULL DEFAULT NULL COMMENT '记录类型',
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名称',
  `uc` int(255) NOT NULL DEFAULT 0 COMMENT '用户类型',
  `time` datetime(0) NULL DEFAULT NULL COMMENT '时间',
  `gid` int(11) NULL DEFAULT NULL COMMENT '对应工单ID',
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of gd
-- ----------------------------
INSERT INTO `gd` VALUES (2, '10086', 0, '11111', 1, '2018-04-21 15:42:14', 0);
INSERT INTO `gd` VALUES (16, '10086', 0, '工单', 0, '2018-04-22 19:28:22', 0);
INSERT INTO `gd` VALUES (17, '管理员', 1, '添加工单', 0, '2018-04-22 19:38:46', 0);
INSERT INTO `gd` VALUES (18, '管理员', 1, '添加工单测试', 0, '2018-04-22 19:39:31', 0);
INSERT INTO `gd` VALUES (19, '管理员', 1, '测试工单', 0, '2018-04-22 19:40:55', 0);
INSERT INTO `gd` VALUES (20, '管理员', 1, 'gbdf', 0, '2018-04-22 19:43:10', 0);
INSERT INTO `gd` VALUES (21, '管理员', 1, 'fvffff', 0, '2018-04-22 19:44:58', 0);
INSERT INTO `gd` VALUES (22, '管理员', 1, 'fgng', 0, '2018-04-22 19:45:37', 0);
INSERT INTO `gd` VALUES (23, '管理员', 1, '', 0, '2018-04-22 19:47:05', 0);
INSERT INTO `gd` VALUES (24, '管理员', 1, '添加工单测试', 0, '2018-04-22 19:50:27', 0);
INSERT INTO `gd` VALUES (25, '10086', 0, '非但不会', 0, '2018-04-22 19:51:05', NULL);
INSERT INTO `gd` VALUES (26, '管理员', 1, '在不在', 0, '2018-04-22 19:51:12', 25);
INSERT INTO `gd` VALUES (27, '管理员', 1, '在的，有什么问题吗', 1, '2018-04-22 19:54:06', 25);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `Id` int(16) NOT NULL AUTO_INCREMENT COMMENT 'orders',
  `tid` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品ID',
  `uid` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户ID',
  `name` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '昵称',
  `input` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '下单值',
  `addtime` datetime(0) NULL DEFAULT NULL COMMENT '下单时间',
  `endtime` datetime(0) NULL DEFAULT NULL COMMENT '完成时间',
  `tradeno` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '订单ID号',
  `money` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0' COMMENT '金额',
  `zt` int(2) NULL DEFAULT NULL COMMENT '订单状态',
  `bz` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `num` int(6) NULL DEFAULT NULL COMMENT '数量',
  `cid` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '模式',
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 188 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (177, 'pdd', '10086', '购买:测试返回结果判断', '', '2018-04-21 20:49:04', NULL, '20180421204904299', '0.35', 2, NULL, 1, '2');
INSERT INTO `orders` VALUES (178, 'fgbfd', '10086', '购买:ffff', '', '2018-04-21 20:49:32', NULL, '20180421204932258', '31.5', 3, '', 1, '2');
INSERT INTO `orders` VALUES (179, 'gz1', '10086', '购买:观战商品1', '', '2018-04-21 20:51:40', NULL, '20180421205140796', '9.45', 3, '{code:\"-8\",msg:\"余额不足以支付该商品\",m:\"-1\",y:\"0.00\",on:\"0\",name:\"\"}', 1, '2');
INSERT INTO `orders` VALUES (180, 'gz1', '10086', '购买:观战商品1', '121', '2018-04-21 21:06:34', NULL, '20180421210634353', '9.45', 3, '{code:\"-8\",msg:\"余额不足以支付该商品\",m:\"-1\",y:\"0.00\",on:\"0\",name:\"\"}', 1, '2');
INSERT INTO `orders` VALUES (181, 'gz1', '10086', '购买:观战商品1', 'yg8fgyp;', '2018-04-22 10:49:31', NULL, '20180422104931338', '9.45', 3, '{code:\"-8\",msg:\"余额不足以支付该商品\",m:\"-1\",y:\"0.00\",on:\"0\",name:\"\"}', 1, '2');
INSERT INTO `orders` VALUES (182, 'gz1', '10086', '购买:观战商品1', 'uuuu', '2018-04-22 10:51:32', NULL, '20180422105132585', '9.45', 3, '{code:\"-8\",msg:\"余额不足以支付该商品\",m:\"-1\",y:\"0.00\",on:\"0\",name:\"\"}', 1, '2');
INSERT INTO `orders` VALUES (183, 'gz1', '10086', '购买:观战商品1', 'fvd', '2018-04-22 03:24:28', NULL, '20180422032428378', '9.45', 3, '{code:\"-8\",msg:\"余额不足以支付该商品\",m:\"-1\",y:\"0.00\",on:\"0\",name:\"\"}', 1, '2');
INSERT INTO `orders` VALUES (184, 'gz1', '10086', '购买:观战商品1', '11', '2018-04-22 07:16:51', NULL, '20180422071651617', '9.45', 3, '{code:\"-8\",msg:\"余额不足以支付该商品\",m:\"-1\",y:\"0.00\",on:\"0\",name:\"\"}', 1, '2');
INSERT INTO `orders` VALUES (185, 'gz1', '10086', '购买:观战商品1', '测试购买', '2018-04-22 07:17:25', NULL, '20180422071725150', '9.45', 3, '{code:\"-8\",msg:\"余额不足以支付该商品\",m:\"-1\",y:\"0.00\",on:\"0\",name:\"\"}', 1, '2');
INSERT INTO `orders` VALUES (186, 'gz1', '10086', '购买:观战商品1', '车啊', '2018-04-22 07:17:59', NULL, '20180422071759248', '9.45', 3, '{code:\"-8\",msg:\"余额不足以支付该商品\",m:\"-1\",y:\"0.00\",on:\"0\",name:\"\"}', 1, '2');
INSERT INTO `orders` VALUES (187, 'gz1', '10086', '购买:观战商品1', '15.23', '2018-04-22 15:23:03', NULL, '20180422152303560', '9.45', 3, '{code:\"-8\",msg:\"余额不足以支付该商品\",m:\"-1\",y:\"0.00\",on:\"0\",name:\"\"}', 1, '2');

-- ----------------------------
-- Table structure for tools
-- ----------------------------
DROP TABLE IF EXISTS `tools`;
CREATE TABLE `tools`  (
  `Id` int(16) NOT NULL AUTO_INCREMENT,
  `tid` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '静态id/别名',
  `name` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名称',
  `text` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '介绍文本',
  `zt` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '上架状态',
  `money` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '默认商品金额',
  `class` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类',
  `px` int(5) NULL DEFAULT 10 COMMENT '排序',
  `clid` int(6) NOT NULL DEFAULT 0 COMMENT '处理方式',
  `clval` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '处理内容',
  `clpost` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'POST请求',
  `inputs` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '参数列表',
  `cookie` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT 'cookie',
  `num` int(6) NOT NULL DEFAULT 0 COMMENT '下单数量处理',
  `vals` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tools
-- ----------------------------
INSERT INTO `tools` VALUES (7, 'gz1', '观战商品1', '<p>这里是商品独立的介绍文本</p><p>非常的<s>多样化</s></p><p> </p>', '1', '13.5', 'cs', 10, 1, 'http://yds.kyour.vip/xd.php?user=cs11&pass=123456&tid=2&g=json', '', 'cs1', '0', 0, 'NONE');
INSERT INTO `tools` VALUES (8, 'fshsj', '科佑儿VIP下单系统', '', '1', '13.24', 'gz', 10, 0, NULL, NULL, 'OK啦', '0', 5, NULL);
INSERT INTO `tools` VALUES (9, 'fgbfd', 'ffff', '<p>bfgn</p>\\n', '1', '45', 'gz', 10, 0, NULL, '', 'fh', '0', 1, NULL);
INSERT INTO `tools` VALUES (10, '11', 'sdb', '<div class=\"entry_box_h\"><div class=\"box_entry_title_h\"><span class=\"cat_name_l\"><a href=\"/cat_2.html\" class=\"cat_href\">PHP学习</a></span><h3><a href=\"/read/77.html\" title=\"php解压zip格式的压缩文件源码（精简实用）\">php解压zip格式的压缩文件源码（精简实用）</a></h3></div><div class=\"clear\"></div><div class=\"thumbnail_box_h\"><div class=\"thumbnail_t\"></div><div class=\"thumbnail\"><a href=\"/read/77.html\" title=\"php解压zip格式的压缩文件源码（精简实用）\"><img class=\"home-thumb\" src=\"/Public/uploads/201403/1395330215761.png\" alt=\"php解压zip格式的压缩文件源码（精简实用）\" width=\"140\" height=\"100\" /></a></div></div><div class=\"cat_box\">做这个之前，没有接触过php压缩这一块，网上搜了一些，大多数都是php压缩类、压缩函数，少则几百行... <a href=\"/read/77.html\" class=\"xiangxi1\">[更多]</a></div><div class=\"clear\"></div><div class=\"cat_post_box\"><ul><li><span class=\"hoem_date\">2018-04-15</span><a href=\"/read/264.html\" title=\"阿里云免费https证书申请和部署方法\">阿里云免费https证书申请和部署方法</a></li></ul><ul><li><span class=\"hoem_date\">2018-04-04</span><a href=\"/read/263.html\" title=\"php中的变量类型\">php中的变量类型</a></li></ul><ul><li><span class=\"hoem_date\">2018-03-31</span><a href=\"/read/262.html\" title=\"php旋转图片功能-源码示例\">php旋转图片功能-源码示例</a></li></ul><ul><li><span class=\"hoem_date\">2017-12-05</span><a href=\"/read/259.html\" title=\"PHP冒泡排序C扩展（含源码）并与原生性能对比\">PHP冒泡排序C扩展（含源码）并与原生性能</a></li></ul><ul><li><span class=\"hoem_date\">2017-11-01</span><a href=\"/read/257.html\" title=\"linux下配置git能tab自动补全提示\">linux下配置git能tab自动补全提示</a></li></ul></div><div class=\"ption\"><span class=\"cat_name_c\">共有159篇文章</span><span class=\"archive_more\"><a href=\"/cat_2.html\" title=\"更多技术教程的文章\">+更  多</a></span></div><div class=\"clear\"></div></div>', '1', '56', 'gz', 10, 0, NULL, '', 'gfng', '0', 1, NULL);
INSERT INTO `tools` VALUES (11, 'dd-rt', 'fgjnty', '<p>fnffg</p><p>\'</p>', '1', '444', '11', 10, 0, NULL, '', 'gg', '0', 1, NULL);
INSERT INTO `tools` VALUES (12, 'pdd', '测试返回结果判断', '<p>加内特</p><p> </p><p> </p>', '1', '0.5', 'gz', 10, 1, 'http://daili.kyour.vip/a.php', '', 'qq', '0', 1, 'JSON||a=b');
INSERT INTO `tools` VALUES (13, 'fvbnfg', 'gn', '<p>gng</p>', '1', '0', '11', 10, 0, NULL, NULL, 'gn', '0', 1, NULL);

-- ----------------------------
-- Table structure for tools_money
-- ----------------------------
DROP TABLE IF EXISTS `tools_money`;
CREATE TABLE `tools_money`  (
  `tid` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `main` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'main',
  `vip` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'main',
  `vips` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'main',
  `svip` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'main',
  PRIMARY KEY (`tid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tools_money
-- ----------------------------
INSERT INTO `tools_money` VALUES ('11', 'main', 'main', 'main', 'main');
INSERT INTO `tools_money` VALUES ('dd-rt', 'main', 'main', 'main', 'main');
INSERT INTO `tools_money` VALUES ('fdbhdf', 'main', 'main', 'main', 'main');
INSERT INTO `tools_money` VALUES ('fgbfd', 'main', 'main', 'main', 'main');
INSERT INTO `tools_money` VALUES ('fshsj', 'main', 'main', 'main', 'main');
INSERT INTO `tools_money` VALUES ('fvbnfg', 'main', 'main', 'main', 'main');
INSERT INTO `tools_money` VALUES ('grf', 'main', 'main', 'main', 'main');
INSERT INTO `tools_money` VALUES ('gz1', 'main', 'main', 'main', 'main');
INSERT INTO `tools_money` VALUES ('pdd', 'main', 'main', 'main', 'main');
INSERT INTO `tools_money` VALUES ('qq', 'main', 'main', 'main', 'main');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `Id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '唯一ID',
  `pass` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '密码',
  `name` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名称',
  `host` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '域名',
  `money` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0' COMMENT '余额',
  `addmoney` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0' COMMENT '总充值金额',
  `xfmoney` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0' COMMENT '总消费金额',
  `date` datetime(6) NULL DEFAULT NULL COMMENT '注册时间',
  `qq` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'QQ号',
  `payid` int(16) NULL DEFAULT NULL COMMENT '结算账号',
  `paytype` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '结算类型',
  `zt` int(16) NULL DEFAULT NULL COMMENT '账号状态',
  `class` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'main' COMMENT '用户组',
  `apikey` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'APIkey',
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '10086', '1008611', '管理员', NULL, '823.05', '0', '176.95', '2018-04-13 21:31:13.000000', '123456', NULL, NULL, 1, 'main', '7maeefuc');

-- ----------------------------
-- Table structure for user_class
-- ----------------------------
DROP TABLE IF EXISTS `user_class`;
CREATE TABLE `user_class`  (
  `Id` int(6) NOT NULL AUTO_INCREMENT,
  `vipid` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'vip分类ID',
  `name` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'vip分类名称',
  `zk` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'vip分类折扣力度',
  `money` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'vip价值',
  `tabname` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '对应的商品价格表',
  `px` int(6) NULL DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_class
-- ----------------------------
INSERT INTO `user_class` VALUES (1, 'main', '用户', '70', '0', NULL, 10);

-- ----------------------------
-- Table structure for user_log
-- ----------------------------
DROP TABLE IF EXISTS `user_log`;
CREATE TABLE `user_log`  (
  `Id` int(16) NOT NULL AUTO_INCREMENT,
  `uid` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户ID',
  `cid` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '模式',
  `m` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '金额',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名称',
  `bz` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `time` datetime(0) NULL DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 108 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_log
-- ----------------------------
INSERT INTO `user_log` VALUES (98, '10086', '2', '31.5', '购买:ffff', NULL, '2018-04-21 08:49:32');
INSERT INTO `user_log` VALUES (99, '10086', '2', '9.45', '购买:观战商品1', NULL, '2018-04-21 08:51:41');
INSERT INTO `user_log` VALUES (100, '10086', '2', '9.45', '购买:观战商品1', NULL, '2018-04-21 09:06:35');
INSERT INTO `user_log` VALUES (101, '10086', '2', '9.45', '购买:观战商品1', NULL, '2018-04-22 10:49:32');
INSERT INTO `user_log` VALUES (102, '10086', '2', '9.45', '购买:观战商品1', NULL, '2018-04-22 10:51:32');
INSERT INTO `user_log` VALUES (103, '10086', '2', '9.45', '购买:观战商品1', NULL, '2018-04-22 03:24:29');
INSERT INTO `user_log` VALUES (104, '10086', '2', '9.45', '购买:观战商品1', NULL, '2018-04-22 07:16:52');
INSERT INTO `user_log` VALUES (105, '10086', '2', '9.45', '购买:观战商品1', NULL, '2018-04-22 07:17:26');
INSERT INTO `user_log` VALUES (106, '10086', '2', '9.45', '购买:观战商品1', NULL, '2018-04-22 07:18:00');
INSERT INTO `user_log` VALUES (107, '10086', '2', '9.45', '购买:观战商品1', NULL, '2018-04-22 03:23:04');

SET FOREIGN_KEY_CHECKS = 1;
