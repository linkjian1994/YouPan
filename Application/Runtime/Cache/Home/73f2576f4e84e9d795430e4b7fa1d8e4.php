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
	<link rel="stylesheet" type="text/css" href="/Public/css/signup.css" />
<div class="container">
  <form class="form-signin">
    <h2 class="form-signin-heading">YouPan</h2>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="电子邮箱" required autofocus name="email">
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="密码" required name="password"/>
    <button class="btn btn-lg btn-success btn-block" type="submit" id="btn-login">登录</button>
  </form>
</div>
<!-- /container -->
<div class="modal fade" id="message"  tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="mySmallModalLabel">提示</h4>
      </div>
      <div class="modal-body" style="text-align:center">
        <p></p>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(function(){
    $('.form-signin').submit(function(){
        var $btn = $('#btn-login');

        $.ajax({
          url:"<?php echo U('Index/signin');?>",
          type : 'POST',
          data:$('.form-signin').serialize(),
          dataType:'json',
          beforeSend : function(){
            $btn.attr('disabled','disabled ');
            $btn.html('<i class="icon-spinner icon-spin"></i>');
          },
          success : function(data){
              if(data.code == 0)
              {
                $('#message').find('.modal-body p').text(data.message);
                $('#message').modal('show');
                $btn.attr('disabled',false);
                $btn.html('登录');
              }else{
                location.href = '<?php echo U('Disk/index');?>';
              }
          },
          error:function(){
              $('#message').find('.modal-body p').text('服务器错误');
          }
      })
      return false;
    })
  });
</script>


	
</body>
</html>