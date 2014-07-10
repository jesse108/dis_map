<?php
namespace Home\Controller;
use Home\Model\DiseaseListModel;


use	Think\controller;

class DiseaseMapController extends \Think\Controller {
	public function addDisease(){
		$this->display();
	}
	
	public function addInfo(){
		$cityname	= $this->toStr('cityname');	//太原
		$comment	= $this->toStr('comment');//这个了萨格拉斯东莞哪里的归纳
		$diseasename= $this->toStr('diseasename');	//天花
		$end		= $this->toStr('end');	//2008-12-12
		$latitude	= $this->toStr('lat');//37.95038387
		$longitude	= $this->toStr('lng');//112.55512419
		$mnum		= $this->toInt('mnum');//500
		$ratio		= $this->toStr('ratio');//40%
		$start		= $this->toStr('start');//2001-12-12
		
		if(empty($cityname) || empty($diseasename) || empty($start)){
			$this->ajaxReturn(0,'缺少必要参数');
		}
		$data = array (
				'city' 			=> $cityname,
				'title' 		=> $diseasename,
				'starttime' 	=> $start ? strtotime ( $start ) : 0,
				'endtime'		=> $end ? strtotime ( $end ) : 0,
				'number'		=> $mnum,
				'ratio'			=> $ratio,
				'coordinate' 	=> $longitude . ':' . $latitude,
				'createtime' 	=> NOW_TIME,
				'doctor_id'		=> 123123,//TODO 登录
				'comment'		=> $comment
				);
	 	$res	= DiseaseListModel::add($data);
	 	if(!$res){
	 		$this->ajaxReturn(0,'存入数据失败');
	 	}
	 	$this->ajaxReturn(1,'存入数据成功');
	}
	
	public function searchDisease(){
		$disaseName = $this->toStr('dname');
		$city		= $this->toStr('cname');
		$condition = array();
		
		if($disaseName){
			$condition['title']	= $disaseName;
		}
		if ($city){
			$condition['city']	= $city;
		}
		if($disaseName || $city){
			$res	= DiseaseListModel::get($condition);
		}
		if(!$res){
			$res = array();
		}
		$this->assign('dname',$disaseName);
		$this->assign('cname',$city);
		$this->assign('disease',json_encode($res));
		$this->display();
	}
	
	public function addDiseaselist() {
		$criteria = $this->toStr ( 'criteria' ); // 阿萨
		$diseasename = $this->toStr ( 'diseasename' ); // 撒地方
		$easyinfection = $this->toStr ( 'easyinfection' ); // 阿萨
		$ename = $this->toStr ( 'ename' ); // 撒地方
		$epathogen = $this->toStr ( 'epathogen' ); // 阿斯达
		$group = $this->toStr ( 'group' ); // 阿斯达
		$pathogen = $this->toStr ( 'pathogen' ); // 啊
		$pathway = $this->toStr ( 'pathway' ); // 是
		$precautions = $this->toStr ( 'precautions' ); // 敌法师
		$source = $this->toStr ( 'source' ); // 阿斯达
		$treatment = $this->toStr('treatment');	//	割发代首
		if($diseasename){
			$data = array (
					'criteria' => $criteria,
					'diseasename' => $diseasename,
					'easyinfection' => $easyinfection,
					'ename' => $ename,
					'epathogen' => $epathogen,
					'group' => $group,
					'pathogen' => $pathogen,
					'pathway' => $pathway,
					'precautions' => $precautions,
					'source' => $source,
					'treatment' => $treatment,
			);
			$res =DiseaseListModel::addDisease($data);
			if($res){
				$this->ajaxReturn(1, '添加传染病成功');
			}
			$this->ajaxReturn(0, '添加传染病失败');
		}
		$this->display();
	}
}
