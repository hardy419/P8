<?php
namespace Home\Controller;
use Think\Controller;
class WhatwedoController extends BaseController {
    public function index(){
        $id=3;
        $lang=cookie('gc_lang');
        $list=M('page')->where(array('id'=>(2 == $lang)?$id+4:$id))->find();
        $refurl = M('banner')->where(array('sid'=>$id))->getField('url');
        $this->assign('list',$list);
        $this->assign('refurl',$refurl);
        $this->display('Pageview/index');
    }
}