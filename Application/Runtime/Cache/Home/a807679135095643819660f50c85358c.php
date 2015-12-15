<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>YouPan-你的云上优盘</title>
	<link type="image/x-icon" rel="shortcut icon" href="/Public/img/favicon.ico" />
	<link rel="stylesheet" href="/Public/css/bootstrap.css" />
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
				<li><a href="">主页</a></li>
				<li><a href="<?php echo U('Disk/index');?>">网盘</a></li>
				<li><a href="">分享</a></li>
			</ul>
			<a href="<?php echo U('user/signup');?>" class="btn btn-info navbar-btn pull-right">注册</a>

			<a href="<?php echo U('user/signin');?>" class="btn btn-default navbar-btn pull-right" style="margin-right:10px;">登录</a>
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
      <button class="btn btn-lg btn-success btn-block" type="submit">注册</button>
    </form>
  </div>

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
      $.ajax({
        url:"<?php echo U('User/doSignup');?>",
        type : 'POST',
        data:$('.form-signin').serialize(),
        dataType:'json',
        success : function(data){
            if(data.code == 0)
            {
              $('#message').find('.modal-body p').text(data.message);
              $('#message').modal('show');
            }else{
              location.href = '<?php echo U('User/signin');?>';
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