<?php

namespace Home\Model;

use Think\Model;

class DiseaseListModel extends Model {
	protected $tableName = 'diseaselist';
	protected $disease	= null;

	public function __construct(){

	}
	
	public function add($data){

		$diseas = M('DiseaseList');
		$data = $diseas->create($data);
 		
 		return $diseas->add();
	}
	
	public function get($condition){
		$diseas = M('DiseaseList');
		$reslust = $diseas->where($condition)->select();
		foreach ($reslust as $key=>$noe){
			$reslust[$key]['starttime'] =$noe['starttime']?date('Y-h-d',$noe['starttime']):'';
			$reslust[$key]['endtime'] =$noe['endtime']?date('Y-h-d',$noe['endtime']):'';
		}
		 return $reslust;
	}
	
	public function addDisease(){
		$diseas = M('diseaseinfo');
		$data = $diseas->create($data);
			
		return $diseas->add();
	}
	
}
