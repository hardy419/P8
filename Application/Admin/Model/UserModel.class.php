<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model{ 	
  protected $_validate=array(
	 array('id','require','ID is required',1,'',2),
	 array('account','require','please input account'),
	 array('account','','Account already exists,please input another one',0,'unique',1),
	 array('password','4,20','Password length between 4 and 20',0,'length'),
	 array('repassword','password','Confirm password is incorrect',0,'confirm')
   );	
}
?>