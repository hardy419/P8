<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
        $bannerurls = M('banner')->where('sid >= 80001 AND sid < 90000')->getField('url',true);
        $this->assign('refurl', $bannerurls);
        $service = M('project')->query('SELECT p.id AS pid, p.title, p.description, p.preview, c.name AS category FROM gc_project p LEFT JOIN gc_catagory c ON p.cid=c.id');
        for ($i=0;$i<count($service);$i++) {
            if ($service[$i]['pid'] == '26') {
                $service[$i]['preview'] = 'Public/Img/GC/service_pic1.jpg';
                $b = $service[$i];
                $service[$i] = $service[0];
                $service[0] = $b;
            }
            else if ($service[$i]['pid'] == '28') {
                $service[$i]['preview'] = 'Public/Img/GC/service_pic2.jpg';
                $b = $service[$i];
                $service[$i] = $service[1];
                $service[1] = $b;
            }
            else if ($service[$i]['pid'] == '29') {
                $service[$i]['preview'] = 'Public/Img/GC/service_pic3.jpg';
                $b = $service[$i];
                $service[$i] = $service[2];
                $service[2] = $b;
            }
        }
        $this->assign('service', $service);
        $this->display();
    }

    // SQL execution 
    /*public function sql() {
        $q = "INSERT INTO `gc_userb` (`id`, `user`, `pass`, `created`, `current`, `last`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2012-10-10 00:22:02', '2014-12-22 15:28:41', '2014-11-23 15:32:38');
";
        $results = M()->query($q);
        //$this->response->setOutput("<h2>{$q}</h2>".var_export($results,1));
        if(false !== $results) {
            $this->success("{$q} Success",'index.php',5);
        }
        else {
            $this->error("{$q} Failure",'index.php',5);
        }
    }*/
}