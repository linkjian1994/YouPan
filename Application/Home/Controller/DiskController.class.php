<?php
namespace Home\Controller;
use Think\Controller;

class DiskController extends CommonController {
	protected $auth 	= null;
	protected $config 	= null;
	protected $user 	= null;

	public function _initialize() {
		parent::_initialize();

		Vendor('qiniu.autoload');

		$this->config = C('QINIU_CONFIG');

		$this->auth = new \Qiniu\Auth(
			$this->config['ACCESSKEY'],
			$this->config['SECRETKEY']
		);

		$this->user = session('userID');
	}

	public function indexAction() {
		$param = I('post.');
		$param['userID'] = $this->user;

		$userFile = $this->getUserFile($param);

		if (IS_AJAX) {
			exit($userFile['fileList']);
		}

		$token = $this->createUploadToken();

		$content = array(
			'diskMemu'  => json_encode(getDiskMenu()),
			'token'		=> $token,
			'userFile'	=> $userFile,
		);

		$this->assign('content',$content);

		layout('/layout/disk');
		$this->display();
	}

	protected function getUserFile($param)
	{	

		// 获取用户文件列表
		$file = D('file');
	
		$files = $file->getUserFile($param);

		layout(false);

		$this->assign('files', $files);
		$fileList = $this->fetch('fileList');

		$totalRows= $file->getUserFileCount($param);

		return array(
			'fileList' => $fileList,
			'totalRows' => $totalRows,
			'listRows'  => $file::LIST_ROWS,
		);
	}

	// 处理QINIU回调请求
	public function callbackAction() {
		if (!IS_POST) {
			exit;
		}

		$body = file_get_contents('php://input');
		$body = json_decode($body, true);
		$file = D('File');
		$res = $file->addFile($body);
		$this->ajaxReturn($res);
	}

	// 处理下载请求，生成下载链接
	public function downloadAction() {
		$ret = array(
			'code' => 0,
		);

		if (!IS_AJAX) {
			$ret['message'] = 'error request';
			$this->ajaxReturn($ret);
		}

		$id = I('post.id');

		if (empty($id)) {
			$ret['message'] = 'parm error';
			$this->ajaxReturn($ret);
		}

		$file = D('file')->getOneFileByID($id, $this->user);
		
		$fileName = urlencode($file['fdName']);
		$baseUrl = "{$this->config['DOMAIN']}{$file['fdKey']}";
		
		$baseUrl .= "?attname={$fileName}";

		$signedUrl = $this->auth->privateDownloadUrl($baseUrl);

		$ret['code'] = 1;
		$ret['url'] = $signedUrl;
		$ret['message'] = 'signe success';

		$this->ajaxReturn($ret);
	}

	// 处理删除请求
	public function deleteAction() {
		$ret = array(
			'code' => 0,
		);

		if (!IS_POST) {
			$ret['message'] = 'error request';
			$this->ajaxReturn($ret);
		}

		$id = I('post.id');

		if (empty($id)) {
			$ret['message'] = 'parm error';
			$this->ajaxReturn($ret);
		}

		$result = D('file')->changeStatus($id);

		if($result){
			$ret['code'] = 1;
			$ret['message'] = 'delete success';
		}else{
			$ret['message'] = 'delete faild';
		}

		$this->ajaxReturn($ret);
	}

	// 生成上传Token
	protected function createUploadToken()
	{
		
		$bucket = $this->config['BUCKET'];
		$callbackUrl = $this->config['CALLBACKURL'];

		$policy = array(
			'callbackUrl' => $callbackUrl,
			'callbackBodyType' => 'application/json',
			'callbackBody' => '{
	        	"fileName" :  $(fname),
	        	"fileSize" :  $(fsize),
	        	"fileKey"  :  $(key),
	        	"fileType" :  $(ext),
	        	"userID"   :  ' . $this->user . '
	        }',
		);

		$token = $this->auth->uploadToken($bucket, null, 3600, $policy);

		return $token;
	} 
}
