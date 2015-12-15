<?php
namespace Home\Model;
use Think\Model;

class FileShareModel extends Model {
	const PUBLIC_SHARE 	= 0;
	const PRIVACY_SHARE = 1;
	const NO_SHARE		= 2;
	const PARAM_ERROR   = 4;

	protected $trueTableName = 'tbFileShare';


	/**
	 * getFileShareStatus 获取文件分享状态
	 * @param  string   $code 分享CODE
	 * @return array
	 */
	public function getFileShareStatus($code)
	{
		$ret = array('code'=>self::PARAM_ERROR);

		if (empty($code)) {
			return $ret;
		}

		$where  = array('fdCode'=>$code);
		$field  = 'fdCode,fdFileID,fdUserID,fdPassword';
		$result = $this->where($where)->field($field)->find();

		if ($result == null) { // 文件未分享
			$ret['code'] = self::NO_SHARE;
		}else{
			if($result['fdPassword'] == ''){// 文件公开分享
				$file = D('file')->getOneFileByID($result['fdFileID'],$result['fdUserID']);
				$ret['data'] = $file;
				$ret['code'] = self::PUBLIC_SHARE;
			}else{ // 文件私密分享
				$ret['code'] = self::PRIVACY_SHARE;
			}
		}

		return $ret;
	}

	/**
	 * 检查提取码是否正确
	 */
	public function checkSharePwd($fileID,$sharePwd)
	{
		if (empty($fileID) || empty($sharePwd)) {
			return false;
		}

		$where = array(
			'fdFileID'	 =>	$fileID,
			'fdPassword' =>	$sharePwd,
		);

		$result = $this->where($where)->field('id')->find();;

		return $result;
	}

	/**
	 * createFileShare 创建文件分享
	 */
	public function createFileShare($params)
	{
		if (count($params)<3) {
			return false;
		}

		$fileID    = $params['fileID'];
		$userID    = $params['userID'];
		$shareType = $params['shareType'];

		unset($params);

		$shared = $this->where(array('fdFileID'=>$fileID))->find();

		$ret = array();

		if ($shared) {
			if ($shareType==self::PUBLIC_SHARE) {
				$this->fdPassword = '';
			}else{
				$this->fdPassword = createSharePassword();
			}
			$ret['fileShareURL'] = C('FILE_SHARE_URL_PREFIX').$this->fdCode;
			$ret['fileSharePwd'] = $this->fdPassword;
			$this->save();

			return $ret;
		}

		$shareCode = createShareCode();

		$insertData = array(
			'fdCode'    => $shareCode,
			'fdFileID'  => $fileID,
			'fdUserID'	=> $userID,
		);

		if ($shareType == self::PRIVACY_SHARE) {
			$insertData['fdPassword'] = $ret['fileSharePwd'] = createSharePassword();
		}

		$result = $this->add($insertData);

		if ($result) {
			$ret['fileShareURL'] = C('FILE_SHARE_URL_PREFIX').$insertData['fdCode'];
			return $ret;
		}else{
			return false;
		}
	}
}

?>
