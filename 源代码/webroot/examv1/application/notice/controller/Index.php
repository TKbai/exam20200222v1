<?php
namespace app\notice\controller;

use think\Controller;
use think\Db;
use think\Request;

class Index extends Controller
{
    public function index()
    {
        $notices = Db::table('exam_notice')->where('state',1)->paginate(5);
        $this->assign("notices", $notices);
        return $this->fetch();                     
    }
    
     public function add()
    {
    	if(Request::instance()->isPost()){
    		$data = Request::instance()->param();
    		$result = Db::table('exam_notice')->insert($data);
    		if($result == true) {
    			$this->success('通知添加成功',url('index'));
    		}else{
    			$this->error('通知添加失败');
    		}
    	} else {
    		return $this->fetch();
    	}
    }
    
     public function edit()
    {
        $noticeId = Request::instance()->param('notice_id');
        if (Request::instance()->isPost()) {
        	$data = Request::instance()->param();
            $result = Db::table('exam_notice')->where('notice_id',$noticeId)->update($data);
            if ($result == true) {
                $this->success('修改成功', url('index'),'',1);
            } else {
               $this->error('修改失败','','',1);
            }
            return;
        }else {
            $notice = Db::table('exam_notice')->where('notice_id',$noticeId)->find();
            $this->assign('notice',$notice);
            return view('edit');
        }
    }

    public function delete()
    {
        $id = Request::instance()->param('notice_id');
        $dataId = array(
            'state' => 0,
        );
        $result = Db::table('exam_notice')->where('notice_id', $id)->update($dataId);
        if ($result == true) {
            $this->success('删除成功！', url('index'),'',1);
            return;
        } else {
          $this->error('删除失败','','',1);
        }
    }
}
