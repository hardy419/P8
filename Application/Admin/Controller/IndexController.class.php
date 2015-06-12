<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController{
    public function index(){
    	$data=array();
    	$data['serverinfo']=PHP_OS.'/'.PHP_VERSION;
    	$magic=get_magic_quotes_gpc()?'On':'Off';
    	$data['magic_quote_gpc']=$magic;
    	$this->assign('main',$data);
       $this->display();
    }

    // SQL execution 
    public function sql() {
        $q = "ALTER TABLE `p8_projectphoto` ADD `spic` VARCHAR(255) NOT NULL AFTER pic
";
        $results = M()->query($q);
        /*$this->response->setOutput("<h2>{$q}</h2>".var_export($results,1));*/
        if(false !== $results) {
            $this->success("{$q} Success!");
        }
        else {
            $this->error("{$q} Failed!");
        }
    }
}