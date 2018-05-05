CREATE TABLE `think_admin_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(64) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '用户密码',
  `realname` varchar(32) NOT NULL DEFAULT '' COMMENT '用户真实姓名',
  `remark` varchar(128) DEFAULT NULL COMMENT '用户备注',
  `structure_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '部门ID',
  `post_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '岗位ID',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '用户状态，1启用，0禁用',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT='用户表';