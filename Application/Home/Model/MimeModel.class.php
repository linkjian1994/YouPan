<?php
namespace Home\Model;
use Think\Model;

class MimeModel extends Model {

	const OTHER_FILE_TYPE = 5;

	protected $trueTableName = 'tbMime';

	/**
	 * 获取MimeType类型
	 * @param  $id type类型ID
	 * @return array
	 */
	public function getMimeTypeByID($id) {
		return $this->select($id);
	}

	/**
	 * 获取MimeType类型
	 * @param  $ext mime后缀
	 * @return array
	 */
	public function getFileTypeByExt($ext) {
		$where  = array('fdExt' => $ext);
		$join   = 'tbFileType on tbFileType.id = tbMime.fdTypeID';
		$typeID = $this->where($where)->join($join)->getField('tbFileType.id');
		if(empty($typeID))
		{
			$typeID = self::OTHER_FILE_TYPE;
		}

		return $typeID;
	}

	/**
	 * 获取MimeType类型
	 * @param  $ext mime后缀
	 * @return array
	 */
	public function getMimeTypeByName($name) {
		return $this->where(array('fdName' => $name))->find();
	}
}

?>
