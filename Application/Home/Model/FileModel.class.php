<?php
namespace Home\Model;
use Think\Model;

class FileModel extends Model {

	const ALLOW_STATUS   = 1;  // 有效状态
	const INVALID_STATUS = 0;  // 无效状态
	const DEFAULT_PAGE   = 1;  // 当前页
	const LIST_ROWS 	 = 20; // 每页条数
	const ALL_FILE  	 = 0;  // 所有文件
	const IMAGE_FILE	 = 1;  // 图片文件
	const VIDEO_FILE	 = 2;  // 视频文件
	const AUDIO_FILE	 = 3;  // 声音文件
	const DOC_FILE  	 = 4;  // 文档文件
	const OTHER_FILE	 = 5;  // 其他文件

	protected $trueTableName = 'tbFile';

	/**
	 * 添加文件信息
	 * @param  $param array 文件信息
	 * @return int 1:上传成功 0:上传失败
	 */
	public function addFile($param) {
		$ret = array(
			'code' => 0,
			'message' => '上传失败',
		);
		if (empty($param)) {
			$ret['message'] = '参数不能为空';
			return $ret;
		}
		
		$isExist = $this->checkFileExist($param['fileKey']);

		if ($isExist) {
			$ret['message'] = '上传成功';
			return $ret;
		}
		$nowTime = date('Y-m-d H:i:s', time());
		$data = array(
			'fdName'   => $param['fileName'],
			'fdSize'   => $param['fileSize'],
			'fdSizeH'  => convert($param['fileSize']),
			'fdKey'    => $param['fileKey'],
			'fdUserID' => $param['userID'],
			'fdCreate' => $nowTime,
			'fdUpdate' => $nowTime,
		);
		$typeID = D('Mime')->getFileTypeByExt(ltrim($param['fileType'],'.'));
		$data['fdTypeID'] = $typeID;

		$res = $this->add($data);

		if ($res) {
			$ret['message'] = '上传成功';
			return $ret;
		} else {
			return $ret;
		}
	}

	/**
	 * 检查文件是否重复
	 * @param  $key string 文件key
	 * @return boolean
	 */
	public function checkFileExist($key) {
		$res = $this->where(array('fdKey' => $key))->find();
		if ($res) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 获取用户的文件
	 * @param  $param 查询参数
	 * @return array
	 */
	public function getUserFile($param) {
		if(empty($param))
		{
			return false;
		}

		$userID    = $param['userID'];
		$nowPage   = empty($param['p'])  ? self::DEFAULT_PAGE : $param['p'];	
		$listRows  = empty($param['listRows']) ? self::LIST_ROWS : $param['listRows'];	

		$where = array(
			'fdStatus' => self::ALLOW_STATUS,
			'fdUserID' => $userID,
		);

		if ($param['fileType']>0) {
			$where['fdTypeID'] = $param['fileType'];
		}

		if ($param['isDelete'] == 1) {
			$where['fdStatus'] = 0;
		}

		$field = 'id,fdName,fdSize,fdUpdate,fdSizeH';

		$files = $this->where($where)->field($field)
			->order('id desc')->page($nowPage, $listRows)->select();

		return $files;
	}


	/**
	 * getOneFileByID 获取单个文件信息
	 * @param     intger   $id     
	 * @param     integer  $userID 
	 * @return    array            
	 */
	public function getOneFileByID($id, $userID = 0) {
		if (empty($id)) {
			return false;
		}

		$where = array(
			'id' => $id,
			'fdStatus' => self::ALLOW_STATUS,
		);

		if ($userID > 0) {
			$where['fdUserID'] = $userID;
		} else {
			$where['fdUserID'] = session('UID');
		}

		$file = $this->where($where)->field('id,fdKey,fdName,fdSizeH')->find();

		return $file;
	}

	/**
	 * getUserFileCount 获取用户文件数量
	 * @param     intger  userID 用户ID
	 * @return    intger  文件数量
	 */
	public function getUserFileCount($param) {
		if (empty($param)) {
			return false;
		}

		$where = array(
			'fdUserID' => $param['userID'],
			'fdStatus' => self::ALLOW_STATUS,
		);

		if ($param['fileType']>0) {
			$where['fdTypeID'] = $param['fileType'];
		}

		$count = $this->where($where)->count();
		return $count;
	}

	/**
	 * changeStatus 改变文件状态
	 * @param  intger   $id 用户ID
	 * @return boolean  修改结果
	 */
	public function changeStatus($id){
		if (empty($id)) {
			return false;
		}

		$res = $this->find($id);

		if (!$res) {
			return false;
		}

		$nowStatus = $this->fdStatus;

		if($nowStatus == 1){
			$this->fdStatus = 0;
		}else{
			$this->fdStatus = 1;
		}
		return $this->save();
	}


}

?>
