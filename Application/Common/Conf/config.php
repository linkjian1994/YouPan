<?php
return array(
	//'配置项'=>'配置值'
	'LAYOUT_ON' => TRUE,
	'LAYOUT_NAME' => 'layout/main',
	//数据库配置信息
	'DB_TYPE' => 'mysql', // 数据库类型
	'DB_HOST' => '', // 服务器地址
	'DB_NAME' => 'youpan', // 数据库名
	'DB_USER' => 'root', // 用户名
	'DB_PWD' => '', // 密码
	'DB_PORT' => , // 端口
	'DB_PREFIX' => 'tb', // 数据库表前缀
	'DB_CHARSET' => 'utf8', // 字符集
	'DB_DEBUG' => TRUE, // 数据库调试模式 开启后可以记录SQL日志

	'ACTION_SUFFIX' => 'ACTION',
	'DB_PARAMS' => array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
	'QINIU_CONFIG' => array(
		'ACCESSKEY' => '',
		'SECRETKEY' => '',
		'BUCKET' => '',
		'CALLBACKURL' => '',
		'DOMAIN' => '',
	),
	'URL_ROUTER_ON'   => true,
	'URL_ROUTE_RULES' => array(
		's/:code' => 'Share/index'
	),
	'MULTI_MODULE'   =>  false,
	'DEFAULT_MODULE' => 'Home',
	'URL_MODEL'	=>	2,
	'FILE_SHARE_URL_PREFIX' => "http://{$_SERVER['SERVER_NAME']}/s/",
);
