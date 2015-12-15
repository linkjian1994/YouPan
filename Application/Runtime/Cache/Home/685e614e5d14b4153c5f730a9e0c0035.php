<?php if (!defined('THINK_PATH')) exit(); if(is_array($files)): $i = 0; $__LIST__ = $files;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$file): $mod = ($i % 2 );++$i;?><tr>
		<td data="<?php echo ($file["id"]); ?>">
			<span class="fileName"><?php echo ($file["fdName"]); ?></span>
			<ul class="list-inline fileConsole">
				<li class="download"><span class="glyphicon glyphicon-download-alt"></span></li>
				<li><span class="glyphicon glyphicon-share"></span></li>
			</ul>
		</td>
		<td class="fileSize"><?php echo ($file["fdSizeH"]); ?></td>
		<td class="fileUpdate"><?php echo ($file["fdUpdate"]); ?></td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>