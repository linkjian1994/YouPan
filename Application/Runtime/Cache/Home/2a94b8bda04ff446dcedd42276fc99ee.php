<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>YouPan-你的云上优盘</title>
	<link type="image/x-icon" rel="shortcut icon" href="/Public/img/favicon.ico" />
	<link rel="stylesheet" href="/Public/css/bootstrap.css" />
	<link rel="stylesheet" href="/Public/css/font-awesome.min.css" />
	<link rel="stylesheet" href="/Public/css/common.css" />
	<script type="text/javascript" src="/Public/js/jquery-1.11.3.min.js" ></script>
	<script type="text/javascript" src="/Public/js/bootstrap.js" ></script>
</head>
<body>
	<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
	        <a class="navbar-brand" href="<?php echo U('Index/index');?>">
	        	<img src="/Public/img/cloud_24.png" alt="">
	        </a>
	        <div class="navbar-brand">YouPan</div>
		</div>
		<div class="collapse navbar-collapse" role="navigation">
			<ul class="nav navbar-nav">
				<li class="active"><a href="<?php echo U('Index/index');?>" >主页</a></li>
				<li><a href="<?php echo U('Disk/index');?>">网盘</a></li>
				<li><a href="">分享</a></li>
			</ul>
			<div class="form-group">
				<?php if(empty($_SESSION['userID'])): ?><a href="<?php echo U('Index/signup');?>" class="btn btn-info navbar-btn pull-right">注册</a>
					<a href="<?php echo U('Index/signin');?>" class="btn btn-default navbar-btn pull-right" style="margin-right:10px;">登录</a>
				<?php else: ?>
					
					<ul class="nav navbar-nav navbar-right">

		            <li class="dropdown">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo (session('email')); ?> <span class="caret"></span></a>
		              <ul class="dropdown-menu">
		                <li><a href="<?php echo U('User/logout');?>"><i class="icon-user"></i>个人资料</a></li>
		                <li><a href="<?php echo U('User/logout');?>"><i class="icon-signout"></i>退出登录</a></li>
		              </ul>
		            </li>
		          </ul><?php endif; ?>
				
			</div>
			
		</div>	
	</div>
</nav>
	<div class="container">  
    <div class="jumbotron">
    	<h1>YouPan，你的云上优盘</h1>
	</div>
</div>

	
</body>
</html>