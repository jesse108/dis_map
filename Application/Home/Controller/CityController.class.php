<?php
namespace Home\Controller;
use Home\Model\CityModel;


use	Think\controller;

class CityController extends \Think\Controller{
	public function index(){
		$where = array(
				'level' => 0
				);
		$delta= CityModel::$delta;
		$country = CityModel::getCity(array('level' =>1),'parent_id');
		$this->assign('delta',$delta);
		$this->assign('country',json_encode($country));
		$this->assign('title','创建地点');
		$this->display();
	}
	
	public function addCity(){
		$cityname	= $this->toStr('cityname');	//太原
		$comment	= $this->toStr('comment');//这个了萨格拉斯东莞哪里的归纳
		$latitude	= $this->toStr('lat');//37.95038387
		$longitude	= $this->toStr('lng');//112.55512419
		$country	= $this->toInt('country');
		$data = array(
				'cityname'	=>$cityname,
				'letter'	=>CityModel::pinyin($cityname,1),
				'coordinate'=>$longitude . ':' . $latitude,
				'level'		=>2,
				'parent_id'	=>$country,
				'ename'		=> ''
				);
		$res = CityModel::addCity($data,$comment);
		if($res){
			$this->ajaxReturn(1, '添加城市成功');
		}
		$this->ajaxReturn(0, '添加城市失败');
	}
	
	public function searchcity(){
		$cityname= $this->toStr('keyword');
		$where = array(
				'level' =>2,
				'cityname' => $cityname
				);
		$res = CityModel::getCity($where);
		$cityid = $res[0]['id'];
		if($cityid){
			
		}
	}
}