<?php
namespace Home\Controller;
use Think\Controller;
use \Home\Model\FileShareModel as Share;

class ShareController extends Controller {

    protected $share = null;

    public function _initialize()
    {
        $this->share = new Share;
    }

    public function indexAction(){

        $code = I('get.code');

        layout('/layout/share');

        if($_SESSION['accessCode'][$code]){
            $this->display();
        }

        $result = $this->share->getFileShareStatus($code);
        print_r($result);exit;
        $code   = $result['code'];

        if ($code == Share::PUBLIC_SHARE) {
            $this->assign('file',$result['data']);
            $this->display('index');
        }elseif($code == Share::PRIVACY_SHARE){
            $this->display('privacy');
        }else{
            $this->error('您访问的页面不存在',U('Index/index'));
        }
    }

    public function checkShareCodeAction(){
        $ret = array('code'=>0);

        if(!IS_AJAX){
          $ret['message'] = 'request error';
          $this->ajaxReturn($ret);
        }

        $fileID    = I('post.fileID');
        $sharePwd  = I('post.sharePwd');

        if (empty(fileID) || empty($sharePwd)) {
            $ret['message'] = 'param error';
            $this->ajaxReturn($ret);
        }

        $result = $this->share->checkSharePwd($fileID,$sharePwd);

        if ($result) {
            $ret['code'] = 1;
            $ret['message'] = 'check success';
            $this->addAccessCode($code,$result);
        }else{
            $ret['message'] = 'check error';
        }

        $this->ajaxReturn($ret);

    }

    // 创建文件分享
    public function createFileShareAction()
    {

        $ret = array('code'=>1);

        if(!IS_AJAX){
            $ret['message'] = 'request error';
            $this->ajaxReturn($ret);
        }

        $data = I('post.');
        $data['userID'] = session('userID');

        $result = $this->share->createFileShare($data);

        if ($result) {
            $ret['code'] = 0;
            $ret['message'] = 'create success';
            $ret['data'] = $result;
        }else{
            $ret['message'] = 'create fail';
        }

        $this->ajaxReturn($ret);

    }

    protected function addAccessCode($code,$fileID)
    {
        $access = session('accessCode');

        if (!$access) {
            $accessArr = array($code => $fileID);
            session('accessURL',$accessArr);
        }else{
            if(!$access[$code])
            {
                 $access[$code] = true;
                session('accessArr',$access);
            }
        }
        return true;
    }
}
