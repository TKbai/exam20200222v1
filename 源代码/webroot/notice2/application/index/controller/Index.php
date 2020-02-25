<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;//第一步

class Index extends Controller
{
    public function index()
    {
        $notices = Db::table('t_notice')->where('state', 1)->paginate(5);
        $this->assign("notices", $notices);
        return $this->fetch();
    }

    public function add()
    {
    	if(Request::instance()->isPost()){
    	    $data = Request::instance()->param();
//    		$data = array(
//    		'notice_name' => input('post.notice_name'),
//    		'notice_web' => input('post.notice_web'),
//    		'notice_time' => input('post.notice_time'),
//    		);
            if($data['notice_time'] == ''){
                $data['notice_time'] = null;
            }
    		$result = Db::table('t_notice')->insert($data);
    		if($result == true) {
    			$this->success('通知添加成功',url('index'),'',1);
    		}else{
    			$this->error('通知添加失败','','',1);
    		}
    	} else {
    		return $this->fetch();
    	}
    }

    public function noticeEdit()
    {
        $noticeId = Request::instance()->param('notice_id');
        if (Request::instance()->isPost()) {
            $data = Request::instance()->param();
            if($data['notice_time'] == ''){
                $data['notice_time'] = null;
            }
//            $notice_name = input('post.notice_name');
//            $notice_web = input('post.notice_web');
//            $notice_time = input('post.notice_time');
//            $data = array('notice_name' => $notice_name, 'notice_web' => $notice_web, 'notice_time' => $notice_time);
            $result = Db::table('t_notice')->where('notice_id',$noticeId)->update($data);
            if ($result == true) {
                $this->success('修改成功!', url('index'),'',1);
            } else {
               $this->error('修改失败','','',1);
            }
            return;
        }else {
            $notice = Db::table('t_notice')->where('notice_id',$noticeId)->find();
            $this->assign('notice',$notice);
            return view('edit');
        }
    }

    public function delete()
    {
        $id = Request::instance()->param('noticeId');
        $dataId = array(
            'state' => 0,
        );
        $result = Db::table('t_notice')->where('notice_id', $id)->update($dataId);
        if ($result == true) {
            $this->success('删除成功！', url('index'));
            return;
        } else {
          $this->error('删除失败');
        }
    }

//    public function edit()
//    {
//
//    }
























}
