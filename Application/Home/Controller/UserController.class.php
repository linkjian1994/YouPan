<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends CommonController {
   public function logoutAction()
   {
   		if(session('userID'))
   		{
   			session(null);
   			$this->redirect('Index/index');
   		}
   		
   }
}
