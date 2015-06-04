<?php
namespace Home\Controller;
use Think\Controller;
class ContactusController extends BaseController {
    public function index(){
        $id=1;
        $lang=cookie('gc_lang');
        $list=M('page')->where(array('id'=>(2 == $lang)?$id+4:$id))->find();
        $refurl = M('banner')->where(array('sid'=>$id))->getField('url');
        $this->assign('list',$list);
        $this->assign('refurl',$refurl);
        $this->display('Pageview/index');
    }
    public function sendmsg(){
        $name = I('post.name','Anonymous');
        $email = I('post.email','');
        $phone = I('post.phone','');
        $message = I('post.message','');
        $tomail = '540115739@qq.com';
        $fromname = 'TC';
        $msg = think_send_mail ($tomail,$fromname,'GC Website Message From '.$name,"Message:{$message}<br/><br/>Name:{$name}<br/>Email:{$email}<br/>Phone:{$phone}");
        if (true === $msg) {
            $this->success('Your message has been sent. Thank you.',U('/Contactus'),3);
        }
        else {
            $this->success($msg,U('/Contactus'),3);
        }
    }
}