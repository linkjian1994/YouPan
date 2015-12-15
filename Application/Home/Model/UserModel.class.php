<?php
namespace Home\Model;
use Think\Model;

class UserModel extends Model {
	protected $trueTableName = 'tbUser';

	protected $_map = array(
		'email' => 'fdEmail',
		'password' => 'fdPassword',
	);

	protected $_auto = array(
		array('fdPassword', 'md5', 3, 'function'),
		array('fdCreate', "getTime", 3, 'callback'),
		array('fdUpdate', "getTime", 3, 'callback'),
	);

	protected $_validate = array(
		array('fdEmail', 'require', '请输入电子邮箱'),
		array('fdEmail', 'email', '电子邮箱格式不正确'),
		array('fdEmail', '', '电子邮箱已存在', 0, 'unique', 5),
		array('fdPassword', 'require', '请输入密码'),
		array('fdPassword', '/^[a-z]\w{6,18}$/i', '密码格式不正确'),
		array('fdEmail,fdPassword', 'checkLogin', '邮箱或密码错误', 1, 'callback', 4),
	);

	/**
	 * [getTime 获取当前格式化时间]
	 * @AuthorHTL JianL
	 * @DateTime  2015-11-20T09:27:15+0800
	 * @return    string                   当前时间
	 */
	protected function getTime() {
		return date('Y-m-d H:i:s');
	}

	/**
	 * [checkLogin 检查用户登录
	 * @AuthorHTL JianL
	 * @DateTime  2015-11-20T09:29:25+0800
	 * @param     array                   $data  用户名和密码
	 * @return    boolean                        检查结果
	 */
	protected function checkLogin($data) {
		$email = $data['fdEmail'];
		$password = md5($data['fdPassword']);

		$userInfo = $this->where(array('fdEmail' => $email))->field('id,fdName,fdPassword,fdStatus')->find();
		if (!$userInfo) {
			return false;
		}

		if ($password !== $userInfo['fdPassword'] || $userInfo['fdStatus'] == 0) {
			return false;
		}

		session('userID', $userInfo['id']);
		session('email', $email);

		return true;
	}
}

?>
