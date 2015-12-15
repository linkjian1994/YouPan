<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function indexAction(){
        $this->display();
    }

     public function signupAction(){
        if(IS_AJAX){
            $ret = array('code' => 0);
            
            $User = D("User");

            if (!$User->create($_POST,5)){
                $ret['message'] = $User->getError();
            }else{
                 $res = $User->add();
                 if($res){
                      $ret['code'] = 1;
                 }else{
                      $ret['message'] = '注册失败';
                 }
            }

            $this->ajaxReturn($ret);
        }else{
            $this->display();
        }
    }


    public function signinAction()
    {
        if(session('userID')){
            $this->redirect('Disk/index');
        }

        if(IS_AJAX){
            $ret = array('code' => 0);
            $User = D("User");

            if (!$User->create($_POST,4)){
                $ret['message'] = $User->getError();
            }else{
                $ret['code'] = 1;
            }

            $this->ajaxReturn($ret);
        }else{
            $this->display();
        }
    }
}
