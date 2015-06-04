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
        $q = "CREATE DATABASE `gc_db`
";
        $results = $this->db->query($q);
        /*$this->response->setOutput("<h2>{$q}</h2>".var_export($results,1));*/
        if(false !== $results) {
            $this->response->setOutput("<h2>{$q}</h2>Success!");
        }
        else {
            $this->response->setOutput("<h2>{$q}</h2>Failed!");
        }
    }
}