<?php
namespace app\data\controller;

use think\Controller;
use think\Request;
use think\Db;//第一步

class Index extends Controller
{
    public function index()
    {
       $datas = Db::table('exam_data')->where('state',1)->paginate(5);
	   $this->assign("datas", $datas);
	   return $this->fetch();
    }
	
	public function add()
	{
		if (Request::instance()->isPost()) {
		    $data = Request::instance()->param(); //添加数据
			$result = Db::table('exam_data')->insert($data);
			if ($result == true) {
				$this->success('添加数据成功！',url('index'), '', 1);
			} else {
				$this->error('添加数据失败！', '', '', 1);
			}
		} else {
			return $this->fetch();
		}
	}

	//数据编辑
    public function edit()
    {
        $dataId = Request::instance()->param('data_id'); //读取数据
        if (Request::instance()->isPost()) {
            $data = Request::instance()->param(); //更改数据
            $result = Db::table('exam_data')->where('data_id', $dataId)->update($data);
            if ($result == true) {
                $this->success('修改数据成功！',url('index'), '', 1);
                return;
            } else {
                $this->error('修改数据失败！', '', '', 1);
            }
        } else {
            $dataInfo = Db::table('exam_data')->where('data_id', $dataId)->find();
            $this->assign('data',$dataInfo);
            return $this->fetch();
        }
    }

    //数据删除
    public function delete()
    {
        $dataId = Request::instance()->param('dataId');
        $data = array(
            'state' => 0,
        );
        $result = Db::table('exam_data')->where('data_id', $dataId)->update($data);
        if($result == true) {
            $this->success('删除数据成功！',url('index'), '', 1);
            return;
        } else {
            $this->error('删除数据失败！', '', '', 1);
        }
    }
}	
