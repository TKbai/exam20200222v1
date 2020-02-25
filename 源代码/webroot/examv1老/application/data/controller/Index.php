<?php
namespace app\data\controller;

use think\Controller;
use think\Request;
use think\Db;//第一步

class Index extends Controller
{
    public function index()
    {
        $datas = Db::table('exam_data')->where('state', 1)->paginate(5);
        $this->assign("datas", $datas);
        return $this->fetch();
    }

      public function add()
      {
      	if(Request::instance()->isPost()){
      	    $data = Request::instance()->param();
              if($data['data_date'] == ''){
                  $data['data_date'] = null;
              }
      		$result = Db::table('exam_data')->insert($data);
      		if($result == true) {
      			$this->success('通知添加成功',url('index'),'',1);
      		}else{
      			$this->error('通知添加失败','','',1);
      		}
      	} else {
      		return $this->fetch();
      	}
      }
//
//    public function edit()
//    {
//        $dataId = Request::instance()->param('data_id');
//        if (Request::instance()->isPost()) {
//            $data = Request::instance()->param();
//            if($data['data_date'] == ''){
//                $data['data_date'] = null;
//            }
////            $data_title = input('post.data_title');
////            $data_web = input('post.data_web');
////            $data_date = input('post.data_date');
////            $data = array('data_title' => $data_title, 'data_web' => $data_web, 'data_date' => $data_date);
//            $result = Db::table('exam_data')->where('data_id',$dataId)->update($data);
//            if ($result == true) {
//                $this->success('修改成功!', url('index'),'',1);
//            } else {
//               $this->error('修改失败','','',1);
//            }
//            return;
//        }else {
//            $data = Db::table('exam_data')->where('data_id',$dataId)->find();
//            $this->assign('data',$data);
//            return view('edit');
//        }
//    }
//
//    public function delete()
//    {
//        $id = Request::instance()->param('dataId');
//        $dataId = array(
//            'state' => 0,
//        );
//        $result = Db::table('exam_data')->where('data_id', $id)->update($dataId);
//        if ($result == true) {
//            $this->success('删除成功！', url('index'));
//            return;
//        } else {
//          $this->error('删除失败');
//        }
//    }

//    public function edit()
//    {
//
//    }



}
