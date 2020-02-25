<?php
namespace app\university\controller;

use think\Controller;
use think\Db;
use think\Request;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    
    public function university()
    {
        $university_name = input('university_name'); 
        $type = input('type');
        $university_level = input('university_level');
        $university_985 = input('university_985');
//      if($university_985 == 0)
//      {
//      	$university_985 = NULL;
//      }
        $university_211 = input('university_211');
//      if($university_211 == 0)
//      {
//      	$university_211 = NULL;
//      }
        $first_class = input('first_class');
//      if($first_class == 0)
//      {
//      	$first_class = NULL;
//      }
        $config = ['query'=>[]];
        $config['query']['university_name'] = $university_name;
        $config['query']['type'] = $type;
        $config['query']['university_level'] = $university_level;
        $config['query']['university_985'] = $university_985;
//      if($config['query']['university_985'] == 0){
//              $config['query']['university_985'] = null;
//          }
        $config['query']['university_211'] = $university_211;
//      if($config['query']['university_211'] == 0){
//              $config['query']['university_211'] = null;
//          }
        $config['query']['first_class'] = $first_class;
//      if($config['query']['first_class'] == 0){
//              $config['query']['first_class'] = null;
//          }
				if (empty($university_985)) {
					$university_985 = null;
				}
				if (empty($university_211)) {
					$university_211 = null;
				}
				if (empty($first_class)) {
					$first_class = null;
				}
        $config = Db::table('exam_university')
														->where('university_name', 'like', "%$university_name%")
														->where('type', 'like', "%$type%" )
														->where('university_level', 'like', "%$university_level%")
														->whereor('university_985', $university_985)
														->whereor('university_211', $university_211)
														->whereor('first_class', $first_class)
				->where('state', 1)
        ->paginate(10, false, $config);
        $this->assign("universities", $config); 
//      $this->assign('university_name',$university_name);
        return $this->fetch();
		}
}

  
  