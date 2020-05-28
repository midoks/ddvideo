CREATE TABLE `<?php echo $db_pre ?>column` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(50) DEFAULT NULL COMMENT '栏目名',
  `type` tinyint(11) NOT NULL DEFAULT '0' COMMENT '类型[0:基本,1:外链]',
  `value` text COMMENT '值',
  `sort` int(11) NOT NULL DEFAULT '99' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `created_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '创建时间',
  `updated_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


CREATE TABLE `<?php echo $db_pre ?>column_type` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pid` bigint(11) DEFAULT NULL COMMENT 'PID',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `sort` int(11) NOT NULL DEFAULT '99' COMMENT '排序',
  `status` tinyint(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `created_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '创建时间',
  `updated_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


CREATE TABLE `<?php echo $db_pre ?>logs` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(50) NOT NULL DEFAULT 'logs' COMMENT '类型',
  `msg` text COMMENT '内容',
  `created_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


CREATE TABLE `<?php echo $db_pre ?>message` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `msg` text COMMENT '消息内容',
  `reply` text NOT NULL COMMENT '回复',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:0.未读,1.已处理。',
  `updated_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '更新时间',
  `created_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


CREATE TABLE `<?php echo $db_pre ?>option` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT 'KEY',
  `value` text NOT NULL COMMENT 'VALUE',
  `updated_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '更新时间',
  `created_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;



CREATE TABLE `<?php echo $db_pre ?>server` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `addr` text COMMENT '地址',
  `status` tinyint(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `updated_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '更新时间',
  `created_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;



CREATE TABLE `<?php echo $db_pre ?>user` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '名字',
  `nick` varchar(50) DEFAULT '' COMMENT '昵称',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `updated_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '更新时间',
  `created_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;



CREATE TABLE `<?php echo $db_pre ?>video` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(50) DEFAULT NULL COMMENT '名字',
  `col_id` bigint(20) DEFAULT '0' COMMENT '栏目ID',
  `col_type` bigint(255) NOT NULL COMMENT '类型',
  `director` varchar(50) DEFAULT NULL COMMENT '导演',
  `actor` varchar(100) DEFAULT NULL COMMENT '演员',
  `up_time` year(4) NOT NULL DEFAULT '2019' COMMENT '上映时间',
  `image_path` text,
  `intro` text COMMENT '简介',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `updated_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '更新时间',
  `created_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `col_id` (`col_id`),
  KEY `col_type` (`col_type`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;



CREATE TABLE `<?php echo $db_pre ?>video_list` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `vid` bigint(11) NOT NULL DEFAULT '0' COMMENT '视频ID',
  `sid` bigint(20) NOT NULL DEFAULT '0' COMMENT '分类ID',
  `name` varchar(50) DEFAULT NULL COMMENT '名字',
  `type` tinyint(4) NOT NULL COMMENT '播放类型',
  `sort` tinyint(4) NOT NULL DEFAULT '99' COMMENT '排序',
  `play_addr` text NOT NULL COMMENT '播放地址',
  `updated_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '更新时间',
  `created_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `vid` (`vid`),
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;



CREATE TABLE `<?php echo $db_pre ?>video_source` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(50) DEFAULT NULL COMMENT '名字',
  `mark` text NOT NULL COMMENT '备注',
  `created_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '创建时间',
  `updated_time` datetime NOT NULL DEFAULT '2019-11-13 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
