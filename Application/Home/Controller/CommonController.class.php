<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {

    public function _initialize(){
      /* import('ORG.Util.Auth');
       $auth=new \Auth();

       if(!$auth->check(MODULE_NAME.'/'.CONTROLLER_NAME,session('UID'))){
            $this->error('抱歉，你没有权限访问此页面');
       }*/

       if(empty(session('userID')) && ACTION_NAME != 'callback')
       {
       		$this->redirect('Index/signin');
       }
    }
}





   











?>