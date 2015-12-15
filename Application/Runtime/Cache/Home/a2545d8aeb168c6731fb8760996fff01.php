<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>YouPan-你的云上优盘</title>
	<link type="image/x-icon" rel="shortcut icon" href="/Public/img/favicon.ico" />
	<link rel="stylesheet" href="/Public/css/bootstrap.css" />
	<link rel="stylesheet" href="/Public/css/font-awesome.min.css" />
	<link rel="stylesheet" href="/Public/css/context.standalone.css" />
	<link rel="stylesheet" href="/Public/css/common.css" />
	<script type="text/javascript" src="/Public/js/jquery-1.11.3.min.js" ></script>
	<script type="text/javascript" src="/Public/js/bootstrap.js" ></script>
	<script type="text/javascript" src="/Public/js/bootstart-contextmenu.js" ></script>
	<script type="text/javascript" src="/Public/plugins/plupload/js/plupload.full.min.js" ></script>
	<script type="text/javascript" src="/Public/plugins/ZeroClipboard/ZeroClipboard.min.js" ></script>
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
		<link rel="stylesheet" type="text/css" href="/Public/css/disk.css" />
	<div class="container-fluid">
		<div class="left">
			<ul class="nav nav-pills nav-stacked text-center">
				<li role="presentation">
					<a href="<?php echo U('Disk/index');?>">
						<span class="icon-folder-close-alt icon-large" ></span>
						<span style="">所有文件</span>
					</a>
				</li>
				<li role="presentation">
					<a href="javascript:;" id="photo">
						<span class="icon-picture icon-large"></span>
						<span>图片</span>
					</a>
				</li>
				<li role="presentation">
					<a href="javascript:;" id="video">
						<span class="icon-facetime-video icon-large"></span>
						<span>视频</span>
					</a>
				</li>
				<li role="presentation">
					<a href="javascript:;" id="music">
						<span class="icon-music icon-large"></span>
						<span>音乐</span>
					</a>
				</li>
				<li role="presentation">
					<a href="javascript:;" id="document">
						<span class="icon-file icon-large"></span>
						<span>文档</span>
					</a>
				</li>
				<li role="presentation" style="border-top:1px solid #e5ebf1">
					<a href="javascript:;" id="my">
						<span class="icon-link icon-large"></span>
						<span>我的分享</span>
					</a>
				</li>
				<li role="presentation" style="border-top:1px solid #e5ebf1">
					<a href="#">
						<span class="icon-lock icon-large"></span>
						<span>保险箱</span>
					</a>
				</li>
				<li role="presentation" style="border-top:1px solid #e5ebf1">
					<a href="#" id="trash">
						<span class="icon-trash icon-large"></span>
						<span>回收站</span>
					</a>
				</li>
			</ul>
		</div>
		<div class="right">
			<div class="tool">
				<div class="btn-Group" id="btn-Group">
					<button class="btn btn-info" type="button" id="open_upload_modal">
						<span class="icon-upload-alt" ></span>
						<span>上传文件</span>
					</button>
					<button class="btn btn-default" type="button">
						<span class="icon-plus"></span>
						<span>新建文件夹</span>
					</button>
					<!-- <div class="pageInfo" style="float:right">
						<span class="totalRows">共个文件</span>
						<span class="nowTotalRows">
							已加载个
						</span>
					</div> -->
				</div>
			</div>
			<div class="fileList">
				<div class="row">
					<table class="table table-hover text-left">
						<thead>
							<tr>
								<th>文件名</th>
								<th>大小</th>
								<th>修改日期</th>
							</tr>
						</thead>
						<tbody>
							<?php echo ($content["userFile"]["fileList"]); ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="upload-modal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" >
	    <div class="modal-content" >
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="mySmallModalLabel">上传文件到YouPan</h4>
	      </div>
	      <div class="modal-body" style="text-align:left;with:543px;">
	      	<div class="modal-body-header">
				<button class="btn btn-info" type="button" id="upload_file">添加文件</button>
	      	</div>
	        <div id="upload-list">
	        	<!-- <div class="text-center">
	        		<h5>试试将文件拖到这里</h5>
	        	</div> -->
	        </div>
	      </div>
	       <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">完成</button>
	      </div>
	    </div>
	  </div>
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

	<div class="modal fade" id="share"  tabindex="-1" role="dialog">
	  <div class="modal-dialog" >
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="mySmallModalLabel">分享文件</h4>
	      </div>
	      <div class="modal-body" style="">
	      		<div class="share-btn-area">
		        	<p>
		        		<button class="btn btn-primary share-btn" data="0">创建公开链接</button>
		        		<span>文件会出现在你的分享主页，任何人都查看</span>
		        	</p>
		        	<p>
		        		<button class="btn btn-primary share-btn" data="1">创建私密链接</button>
		        		<span>查看时需要输入提取码才能查看</span>
		        	</p>
	      		</div>
	      		<div class="share-info-area" style="display:none">
	      				<div class="create-success">
	      					<i class="icon-ok icon-2x"></i>
	      					<span class="public">成功创建公开链接</span>
	      					<span class="private" style="display:none">成功创建私密链接</span>
	      					<div class="form-group">
										<label for="">分享地址</label>
	      						<input type="text" readonly="readonly" class="form-control" id="share-url" value="dgfdsfgdfgdfdgdf">
	      					</div>
	      					<div class="form-group share-pwd-area">
	      						<label for="">提取密码：</label>
	      						<input type="text" readonly="readonly" class="form-control" id="share-pwd" value="dgfs" style="width:60px;">
	      					</div>
	      					<div>
	      						<button class="btn btn-info" id="copy-share">复制到剪贴板</button>
	      					</div>
	      				</div>
	      		</div>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="file-info" style="display:none" id="file-info-model">
		<div class="file-name"><strong></strong></div>
		<div class="progress">
		  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">
		  </div>
		</div>
		 <div class="precent">
		  		<span class="precent-num">&nbsp;</span>
		  		<span>&nbsp;</span>
		  		<a href="#" class="btn-link btn-cancel">取消</a>
		 </div>
		 <div class="upload-progress-info">
		 	<span class="wait-upload"><small>等待上传中...</small></span>
		 	<ul class="list-inline" style="display:none">
			  <li class="uploaded-size"><small>已上传：</small></li>
			  <li class="uploaded-speed"><small>上传速度：</small></li>
			  <li class="uploaded-time"><small>剩余时间</small></li>
			</ul>
		 </div>
	</div>
   <div id="context-menu">
      <ul class="dropdown-menu" role="menu">
          <li><a tabindex="-1" data="1">下载</a></li>
          <li><a tabindex="-1" data="2">删除</a></li>
          <li><a tabindex="-1" data="3">重命名</a></li>
          <li><a tabindex="-1" data="4">分享</a></li>
      </ul>
    </div>
	<script type="text/javascript">
		$(function(){
			// 上传窗口
			$('#open_upload_modal').click(function(){
				$('#upload-list').empty();
				$('#upload-modal').modal('show');
			});

			// 上传控件
			var uploader = new plupload.Uploader({
				runtimes : 'html5,flash,silverlight,html4',
				browse_button : 'upload_file',
				container: document.getElementById('btn-Group'),
				url : 'http://upload.qiniu.com/',
				flash_swf_url : '/Public/plugins/plupload/js/Moxie.swf',
				silverlight_xap_url : '/Public/plugins/plupload/js/Moxie.xap',
				multipart_params : {
					token : '<?php echo ($content["token"]); ?>',
				},
				filters : {
					max_file_size : '100mb',
					/*mime_types: [
						{title : "Image files", extensions : "jpg,gif,png"},
						{title : "Zip files", extensions : "zip"}
					]*/
				},
				drop_element:'upload-list',
				init: {
					PostInit: function() {
					/*	document.getElementById('upload-list').innerHTML = '';
						document.getElementById('uploadfiles').onclick = function() {
							 return false;
						 };*/
					},
					FilesAdded: function(up, files) {
						plupload.each(files, function(file) {
							var $fileInfo = $('#file-info-model').clone();
							$fileInfo.css('display','block');
							$fileInfo.attr('id',file.id);
							$fileInfo.find('.file-name strong').text(file.name);
							$('#upload-list').append($fileInfo);
						});
						uploader.start();
					},
					FileUploaded : function(up,file,response){
						 var $fileInfo = $('#'+file.id);
						 var $response = $.parseJSON(response.response);
						 $fileInfo.find('.wait-upload small').text($response.message)
						 $fileInfo.find('.wait-upload').css('display','block');
						 $fileInfo.find('.upload-progress-info ul').css('display','none');
					},
					UploadProgress: function(up, file) {
						var $fileInfo = $('#'+file.id);
						$fileInfo.find('.wait-upload').css('display','none');
						$fileInfo.find('.upload-progress-info ul').css('display','block');
						$fileInfo.find('.progress-bar').css('width',file.percent+'%');
						$fileInfo.find('.precent-num').text(file.percent+'%');
						$fileInfo.find('.uploaded-size small').text('已上传：'+plupload.formatSize(file.loaded));
						$fileInfo.find('.uploaded-speed small').text('上传速度：'+plupload.formatSize(up.total.bytesPerSec)+'/秒');

						$fileInfo.find('.uploaded-time small').text('剩余时间：'+formatTime(parseInt((file.size - file.loaded)/up.total.bytesPerSec)));
					},
					FilesRemoved : function(up,file){

					},
					UploadComplete : function(uploader,files) {
						$.ajax({
							type : 'POST',
							url  : '<?php echo U("Disk/index");?>',
							success : function(data){
								$('.fileList tbody').empty();
								$('.fileList tbody').html(data);
							},
							error : function(data){

							}
						})
					},
					Error: function(up, err) {
						$('#message .modal-body p').text('上传失败：'+err.message);
						$('#message').modal('show');
					}
				}
			});

			uploader.init();

			// 下载事件
			$('.fileList').on('click','.download',function(){
				var id =$(this).parent().parent().attr('data');
				fileDownload(id);
			});

			// 取消上传事件
			$('#upload-list').on('click','.btn-cancel',function(){
				var id = $(this).parent().parent().attr('id');
				var fileObj = uploader.getFile(id);
				if (fileObj) {
					$('#'+id).remove();
					uploader.removeFile(fileObj);
				};
			});

			// 滚动自动加载
			var nowType   = null;
			var nowPage   = 1;
			var listRows  = <?php echo ($content["userFile"]["listRows"]); ?>;
			var totalRows = <?php echo ($content["userFile"]["totalRows"]); ?>;
			var pageCount = Math.ceil(totalRows/listRows);
			var isDelete  = 0;
			 $('.fileList').scroll(function(event){
           		var $this =$(this),
		        viewH =$(this).height(),//可见高度
		        contentH =$(this).get(0).scrollHeight,//内容高度
		        scrollTop =$(this).scrollTop();//滚动高度

		        if(scrollTop/(contentH -viewH)>=0.95){ //到达底部100px时,加载新内容
		        	nowPage++;
		        	if(nowPage <= pageCount){
	                	$.ajax({
								type : 'POST',
								data : {'p':nowPage,'fileType':nowType,isDelete:isDelete},
								url  : '<?php echo U("Disk/index");?>',
								success : function(data){
									$('.fileList tbody').append(data);
									createMemu();
								},
								error : function(data){

								}
						})
					}
		        }

    		});

			// 根据左侧菜单加载不同类型文件
			var menuSrc = <?php echo ($content["diskMemu"]); ?>;
			$('.left li a').click(function(event) {
				var fileType = menuSrc[$(this).attr('id')];
				nowPage = 1;
				nowType = fileType;
				if (fileType>0) {
					isDelete = 0;
					getUserFile(fileType);
				}else{
					isDelete = 1;
					getUserFile(fileType);
				}

			});

			var shareFileID = null;

			$('.share-btn').click(function(){
				var type = $(this).attr('data');
				$.ajax({
					data : {fileID:shareFileID,shareType:type},
					type : 'POST',
					url  : '<?php echo U("Share/createFileShare");?>',
					dataType : 'json',
					success : function(data){
						if(data.code=='0'){
							$('#share-url').val(data.data.fileShareURL);
							$('#share-pwd').val(data.data.fileSharePwd);

							if(type==0){
								$('.share-pwd-area').css('display','none');
								$('.public').css('display','block');
								$('.private').css('display','none');
							}else{
								$('.share-pwd-area').css('display','block');
								$('.public').css('display','none');
								$('.private').css('display','block');
							}

							$('.share-info-area').css('display','block');
							$('.share-btn-area').css('display','none');
						}
					},
					error:function(){

					}
				})
			});

			var clip = new ZeroClipboard(document.getElementById("copy-share"));

			clip.on("copy", function(e){
					var shareURL = ' 地址: '+$('#share-url').val()+' ';
					var sharePwd = '';
					var pwd = $('#share-pwd').val();
					if( pwd != ''){
						sharePwd = ' 提取码: '+pwd;
					}
    			e.clipboardData.setData("text/plain",shareURL+sharePwd);
					$('#share').modal('hide');
					$('#message .modal-body p').text('复制成功');
					$('#message').modal('show');
			});
			// 右键菜单
			function createMemu()
			{
				$('.fileList tbody tr').contextmenu({
					target:'#context-menu',
					before: function(e,context) {

					  // execute code before context menu if shown
					},
					onItem: function(context,e) {
						var operator = e.target.getAttribute('data');
						var fileID   = context.find('td:first-child').attr('data');
						switch(operator){
						 	case '1' :
								fileDownload(fileID);
								break;
							case '2' :
								fileDelete(fileID,context);
								break;
							case '4' :
								flieShare(fileID);
								break;
						}
					}
				});
			}

			createMemu();

			function getUserFile(fileType)
			{
				$.ajax({
					type : 'POST',
					data : {fileType:fileType,isDelete:isDelete},
					url  : '<?php echo U("Disk/index");?>',
					beforeSend : function()
					{
						var $loading = '<h5 class="text-center loading"><i class="icon-spinner icon-spin"></i>正在加载中...</h5>';
						$('.fileList tbody').html($loading);
					},
					success : function(data){
						$('.fileList tbody').empty();
						$('.fileList tbody').html(data);
					},
					error : function(data){
						$('#message .modal-body').text('服务器出错，请稍后再试');
						$('#message').modal('show');
					}
				})
			}

			function fileDownload(id)
			{
				$.ajax({
					data : {id:id},
					type : 'POST',
					url  : '<?php echo U("Disk/download");?>',
					dataType : 'json',
					success : function(data){
						if(data.code==1)
						{
							location.href = data.url;
						}else{
							$('#message').find('modal-body').text(data.message);
						}
					},
					error : function(data){

					}
				});
			}

			function fileDelete(id,fileInfo)
			{

				$.ajax({
					data : {id:id},
					type : 'POST',
					url  : '<?php echo U("Disk/delete");?>',
					dataType : 'json',
					success : function(data){
						if(data.code == 1)
						{
							fileInfo.remove();
						}else{
							$('#message').find('modal-body').text(data.message);
						}
					},
					error : function(data){
							$('#message').find('modal-body').text(data.message);
					}
				});
			}

			function flieShare(id)
			{
				if (id=='') {return false};
				shareFileID = id;
				$('.share-info-area').css('display','none');
				$('.share-btn-area').css('display','block');
				$('#share').modal('show');

			}

			function formatTime(time){
				 // 计算
				var h=0,i=0,s=parseInt(time);
				if(s>60){
				i=parseInt(s/60);
				s=parseInt(s%60);
				 if(i > 60) {
				h=parseInt(i/60);
				 i = parseInt(i%60);
				}
				}
				 // 补零
				 var zero=function(v){
				 return (v>>0)<10?"0"+v:v;
				};
				 return [zero(h),zero(i),zero(s)].join(":");
			};
		});
</script>

	
</body>
</html>