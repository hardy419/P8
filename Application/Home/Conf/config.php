<?php
return array(
	'AUTH_Home_TOKEN'=>'_^&javakdyadmin222_',
	'LOGIN_Home_TIMEOUT'=>3600,
    'URL_HTML_SUFFIX'=>'',
    //邮件配置
     'THINK_EMAIL' => array(
         'SMTP_HOST'   => 'smtp.qq.com', //SMTP服务器
         'SMTP_PORT'   => '25', //SMTP服务器端口
         'SMTP_USER'   => '2757144278@qq.com', //SMTP服务器用户名
         'SMTP_PASS'   => '1q2w3e4r', //SMTP服务器密码
         'FROM_EMAIL'  => '2757144278@qq.com', //发件人EMAIL
         'FROM_NAME'   => 'Hardy', //发件人名称
         'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）
         'REPLY_NAME'  => '', //回复名称（留空则为发件人名称）
     ),
	//'配置项'=>'配置值'
	'TMPL_PARSE_STRING'  =>array(
		
				'__JS__' => SITE_PATH.'Public/Js', // 增加新的JS类库路径替换规则
		
				'__CSS__' => SITE_PATH.'Public/Css', // 增加新的css类库路径替换规
		
				'__IMG__' => SITE_PATH.'Public/Img/', // 增加新的img类库路径替换
		
				'__UPLOAD__' => './Uploads', // 增加新的上传路径替换规则
	)
);