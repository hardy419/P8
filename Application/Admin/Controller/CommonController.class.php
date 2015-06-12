<?php
namespace Admin\Controller;
use Think\Controller;
use Org\Util\Rbac;
class CommonController extends Controller {
      public function login(){
          if(!$this->checkStatus()){
          $this->display();
          }else{
              $this->redirect(U('Index/index'));
          }
      }
      public function password(){
          if(!$this->checkStatus()){
              $this->error('Please login');
          }else{
              $this->display('changepassword');
          }
      }
      public function changePassword(){
          if(!$this->checkStatus()){
              $this->error('Please login');
          }else{
              $this->success('Password changed!');
          }
          $map=array();
          $map['status']=1;
          $map['account']=$_SESSION['loginUserName'];
          M('user')->where($map)->setField('password', md5($_POST['pwd']));
      }
      public  function checkStatus(){
      	 $loginMarked=md5(C('AUTH_TOKEN'));
      	 
      	 if(!$_SESSION[$loginMarked]){
      	 	return false;
      	 }
      	 $cookie=explode("_",cookie($loginMarked));
      	 $outtime=C('LOGIN_TIMEOUT');
      	 
      	 if(intval(time())>($outtime+end($cookie)))return false;
      	 if($cookie[0]!=$loginMarked)return false;
      	 cookie($loginMarked,$cookie[0].'_'.time(),0,'/');
      	 return true;
      }
      public function logout(){
      	  $loginMarked=md5(C('AUTH_TOKEN'));
          if(isset($_SESSION[$loginMarked])){
              unset($_SESSION[$loginMarked]);
              $this->success('Logout Success',U('Common/login'));
          }else{
             
              $this->success('Logout Success',U('Common/login'));
          }
      }
      
     protected function check_verify($code, $id = ''){   
      	$verify = new \Think\Verify();  
      	  return $verify->check($code, $id);
      }
      public function checkLogin(){
          $verify=$_POST['seccode'];
          if(empty($_POST['account'])){
              $this->error('Please Input Account!');
          }else if(empty($_POST['password'])){
              $this->error('Please Input Password!');
          }else if(empty($verify)){
              $this->error('Please Input Verify!');
          }else if(!$this->check_verify($verify)){
              $this->error('The Verify is not correct!');
          }
          
          $map=array();
          $map['status']=1;
          $map['account']=$_POST['account'];
          $authInfo=M('user')->where($map)->find();
          
          if($authInfo==false){
              $this->error('Account or Password not correct！');
          }else{
          
             if($authInfo['password']!=md5($_POST['password'])){
                $this->error('Account or Password not correct！');
             }
            $loginMarked=md5(C('AUTH_TOKEN'));
            $_SESSION[$loginMarked]=$authInfo['id'];
            $_SESSION['email']	=	$authInfo['email'];
            $_SESSION['loginUserName']		=	$authInfo['account'];
            $_SESSION['lastLoginTime']		=	$authInfo['last_login_time'];
            $_SESSION['login_count']	=	$authInfo['login_count'];
            if($authInfo['account']=='admin') {
                $_SESSION['administrator']		=	true;
            }
            cookie($loginMarked,$loginMarked.'_'.time(),0,'/');
            //保存登录信息
            $DB=M('user');
            $data=array();
            $data['id']=$authInfo['id'];
            //$data['last_login_ip']=get_client_ip();
            $data['last_login_time']=time();
            $data['login_count']=array('exp','login_count+1');
            $DB->save($data);
            
            $this->success('Login Success',U('Index/index'));
          }          
      }
      public function verify(){
      	  $config =    array(   
      	  		  'imageW'=>100,    // 验证码字体大小   
      	  		  'imageH'=>30,
      	  		  'length'=>4,     // 验证码位数   \
      	  		  'useCurve'=>false,
      	  		  'fontSize'=>14,
      	  		  'useNoise'    =>false, // 关闭验证码杂点
      	  		  );
          $Verify = new \Think\Verify($config);
          ob_end_clean();
          $Verify->entry();
      }  
}
?>