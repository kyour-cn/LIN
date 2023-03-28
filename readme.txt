《科佑儿在线下单系统 LIN1.0》

开发团队：科佑儿网络
--官网 http://www.kyour.vip
--QQ 2653907035

运行环境
--PHP 5.3+ (测试运行环境Centos7 +PHP7.0)

配置修改
--/config.php - 系统运行配置
--/pay/epay.config.php - 易支付配置

系统安全
--xss防御  *注册表单验证+验证码 用户提交所有数据经过<HTMLPurifier>过滤
--sql注入  *用户上传所有数据库操作经过PDO预处理，防止注入
--------------------更新日志--------------------

-1.1
ALTER TABLE tools ADD vals varchar(255)
创建表 gd -工单
创建class字段 iszk 是否折扣
创建表 gd，news
添加user表字段

商品价格获取优先级
1-

-1.0
第一版本