<?php
namespace Home\Controller;
use Think\Controller;
class ProjectController extends BaseController {
    public function index(){
        $catamodel = M('catagory');
        $catalist = $catamodel->field('id,name')->select();
        $cid = I('get.cid', $catalist[0]['id']);
        $projmodel = M('project');
        $projmodelmap = array('cid'=>$cid);
        $count = $projmodel->where($projmodelmap)->count();
        $p=new \Org\Util\Page($count,6);
        $p->setConfig('prev', '<img src="'.SITE_PATH.'Public/Img/GC/prev_button.png"></img>');
        $p->setConfig('next', '<img src="'.SITE_PATH.'Public/Img/GC/next_button.png"></img>');
        $p->setConfig('last', 'the last Page');
        $p->setConfig('first', 'the first Page');
        $p->setConfig('theme','%upPage% %first%  %prePage% %linkPage%  %downPage%  %nextPage% %end%');
        $list=$projmodel->where($projmodelmap)->order('`id` DESC')->limit($p->firstRow.",".$p->listRows)->field('id,preview,title,description')->select();
        $show=$p->show();
        $this->assign("show",$show);
        $this->assign('catalist',$catalist);
        $this->assign('list',$list);
        $this->assign('refurl','Public/Img/GC/banners/banner_clientlist.png');
        $this->display();
    }
    public function photos(){
        $pid = I('get.pid', 1);
        $catamodel = M('catagory');
        $catalist = $catamodel->field('id,name')->select();
        $projmodel = M('project');
        $preview = $projmodel->where(array('id'=>$pid))->getField('preview');
        $projphotomodel = M('projectphoto');
        $projphotomodelmap = array('pid'=>$pid);
        $count = $projphotomodel->where($projphotomodelmap)->count();
        $p=new \Org\Util\Page($count,9);
        $p->setConfig('prev', '<img src="'.SITE_PATH.'Public/Img/GC/prev_button.png"></img>');
        $p->setConfig('next', '<img src="'.SITE_PATH.'Public/Img/GC/next_button.png"></img>');
        $p->setConfig('last', 'the last Page');
        $p->setConfig('first', 'the first Page');
        $p->setConfig('theme','%upPage% %first%  %prePage% %linkPage%  %downPage%  %nextPage% %end%');
        $list=$projphotomodel->where($projphotomodelmap)->order('`id` DESC')->limit($p->firstRow.",".$p->listRows)->select();
        $show=$p->show();
        $this->assign("show",$show);
        $this->assign('catalist',$catalist);
        $this->assign('photolist',$list);
        $this->assign('preview',$preview);
        $this->assign('pid',$pid);
        $this->assign('refurl','Public/Img/GC/banners/banner_clientlist.png');
        $this->display('index');
    }
}