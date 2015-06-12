<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
        $photos = M()->query ('SELECT pic,spic FROM p8_projectphoto WHERE status=1 ORDER BY RAND() ');
        $this->assign('photos', $photos);
        $this->display();
    }

    public function save(){
        $type=I('post.type');
        if(!in_array($type,array('banner','category','page','project','projectphoto')))$this->error('',U('Index/index'));
        $tname=$type;
        $jump=cookie("__CURRENTURL__");
        $db=D($tname);
        unset($_POST['pic']);
        if(!$db->create()){
            $this->error($db->getError(),$jump);
        }else{
            $id=I('post.id','');
            foreach($_FILES as $key=>$file) {
                if(empty($file['name'])) unset($_FILES[$key]);
            }
            if(count($_FILES)>0){
                $path=date("Ymd");
                $files=$this->_upload($tname,$path);
                $pid=I('post.pid');
                foreach($_FILES as $key=>$file) {
                    //过滤无效的上传
                    if(!empty($file['name'])) {
                        foreach($files as $k=>$f){
                            $filename=$f['savepath'].$f['savename'];
                            $typename=$f['key'];
                            if($typename=='pic')$this->changePic($db, $tname, $f,$filename,$path);
                            $db->$typename=$f['savepath'].$f['savename'];
                        }
                    }
            
                }
            }
            $fields=$db->getDbFields();
            $date=I('post.date');
            if(in_array('date',$fields)){
                if(empty($date))$db->date=date('Y-m-d');
                else $db->date=$date;
            }
            if(!empty($id)){
                $query=$db->save();
            }else{
                $query=$db->add();
                $id = $query;
            }
        }
    }
    private function changePic($DB,$model,$f,$file,$path){
        $file='./Uploads'.$file;
        switch ($model){
            case 'courselist':
                $path=$f['savepath'];
                $basename=$f['savename'];
                $spic=$path.'s_'.$basename;
                $this->_thumb($file,$file,656,367);
                $this->_thumb($file,$spic,210,123);
                $DB->spic=$spic;
                break;
            case 'tutorslist':
                $this->_thumb($file,$file,80,100);
            break;
            case 'news':
                $this->_thumb($file,$file,153,96);
            break;
            case 'projectphoto':
                $path=$f['savepath'];
                $basename=$f['savename'];
                //$sfile=$path.'p_'.$basename;
                $spic=$path.'s_'.$basename;
                //$this->_thumb($file,$sfile,700,400);
                $this->_thumb($file,'./Uploads'.$spic,174,115);
                //$DB->pic=$sfile;
                $DB->spic=$spic;
            break;
        }
    }
    protected function _thumb($file,$imgname,$width,$height){
        $image=new \Think\Image();
        if(!empty($file)){
            $image->open($file);
            $image->thumb($width, $height,3);
            $image->save($imgname);
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
     public function check_verify(){   
      	$verify = new \Think\Verify();  
      	  if( $verify->check($_GET['code'])) {
              echo 'success';
          }
          else {
              echo '验证码错误';
          }
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