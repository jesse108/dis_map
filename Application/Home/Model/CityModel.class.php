<?php

namespace Home\Model;
use Think\Model;

class CityModel extends Model{
	protected $tableName = 'city';
	
	protected $city = null;
	public static  $delta = array(
			0 =>array (
					'id' =>  '1' ,
					'cityname' =>  '亚洲' ,
					'ename' =>  'yazhou' ,
					'letter' =>  'Y' ,
					'coordinate' =>  '' ,
					'level' =>  '0' ,
					'parent_id' =>  '0' ,
			),
			1 =>
			array (
					'id' =>  '2' ,
					'cityname' =>  '欧洲' ,
					'ename' =>  'ozhou' ,
					'letter' =>  'O' ,
					'coordinate' =>  '' ,
					'level' =>  '0' ,
					'parent_id' =>  '0' ,
			),
			2 =>
			array (
					'id' =>  '3' ,
					'cityname' =>  '北美洲' ,
					'ename' =>  'beimeizhou',
					'letter' =>  'B' ,
					'coordinate' =>  '' ,
					'level' =>  '0' ,
					'parent_id' =>  '0' ,
			),
			3 =>
			array (
					'id' =>  '4' ,
					'cityname' =>  '南美洲' ,
					'ename' =>  'nanmeizhou',
					'letter' =>  'N' ,
					'coordinate' =>  '' ,
					'level' =>  '0' ,
					'parent_id' =>  '0' ,
			),
			4 =>
			array (
					'id' =>  '5' ,
					'cityname' =>  '非洲' ,
					'ename' =>  'feizhou',
					'letter' =>  'F' ,
					'coordinate' =>  '' ,
					'level' =>  '0' ,
					'parent_id' =>  '0' ,
			),
			5 =>
			array (
					'id' =>  '6' ,
					'cityname' =>  '大洋洲' ,
					'ename' =>  'dayangzhou',
					'letter' =>  'D' ,
					'coordinate' =>  '' ,
					'level' =>  '0' ,
					'parent_id' =>  '0' ,
			),
			6 =>
			array (
					'id' =>  '7' ,
					'cityname' =>  '南极洲' ,
					'ename' =>  'nanjizhou' ,
					'letter' =>  'N' ,
					'coordinate' =>  '' ,
					'level' =>  '0' ,
					'parent_id' =>  '0' ,
			),
	);
	public function addCity($data,$comment=null){
		$cityDB = M('city');
		$result = true;
		$res = $cityDB->data($data)->add();
		if($res && $comment!=null){
			$infodata = array(
					'parent_id'=> $res,
					'describe' =>$comment
					);
			$infoDB = M('cityinfo');
			if(!$infoDB->data($infodata)->add()){
				
				$result = false;
			}
		}else{
			$result= false;
		}
		return $result;
	}
	
	public function getCity($condition,$key=null){
		$cityDB = M('city');
		$res =$cityDB->where($condition)->select();
		if($key){
			foreach ($res as $one){
				$citylist[$one[$key]][] = $one;
			}
		}else {
			$citylist = $res;
		}
		
		return $citylist;
	}
	

	public function getfirstchar($s0){
		$fchar = ord($s0{0});
		if($fchar >= ord("A") and $fchar <= ord("z") )return strtoupper($s0{0});
		$s1 = iconv("UTF-8","gb2312", $s0);
		$s2 = iconv("gb2312","UTF-8", $s1);
		if($s2 == $s0){$s = $s1;}else{$s = $s0;}
		$asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
		if($asc >= -20319 and $asc <= -20284) return "A";
		if($asc >= -20283 and $asc <= -19776) return "B";
		if($asc >= -19775 and $asc <= -19219) return "C";
		if($asc >= -19218 and $asc <= -18711) return "D";
		if($asc >= -18710 and $asc <= -18527) return "E";
		if($asc >= -18526 and $asc <= -18240) return "F";
		if($asc >= -18239 and $asc <= -17923) return "G";
		if($asc >= -17922 and $asc <= -17418) return "I";
		if($asc >= -17417 and $asc <= -16475) return "J";
		if($asc >= -16474 and $asc <= -16213) return "K";
		if($asc >= -16212 and $asc <= -15641) return "L";
		if($asc >= -15640 and $asc <= -15166) return "M";
		if($asc >= -15165 and $asc <= -14923) return "N";
		if($asc >= -14922 and $asc <= -14915) return "O";
		if($asc >= -14914 and $asc <= -14631) return "P";
		if($asc >= -14630 and $asc <= -14150) return "Q";
		if($asc >= -14149 and $asc <= -14091) return "R";
		if($asc >= -14090 and $asc <= -13319) return "S";
		if($asc >= -13318 and $asc <= -12839) return "T";
		if($asc >= -12838 and $asc <= -12557) return "W";
		if($asc >= -12556 and $asc <= -11848) return "X";
		if($asc >= -11847 and $asc <= -11056) return "Y";
		if($asc >= -11055 and $asc <= -10247) return "Z";
		return null;
	}
	
	
	public function pinyin($zh,$length=0){
		$ret = "";
		$s1 = iconv("UTF-8","gb2312", $zh);
		$s2 = iconv("gb2312","UTF-8", $s1);
		if($s2 == $zh){$zh = $s1;}
		for($i = 0; $i < strlen($zh); $i++)
		{
			$s1 = substr($zh,$i,1);
			$p = ord($s1);
			if($p > 160){
				$s2 = substr($zh,$i++,2);
				$ret .= self::getfirstchar($s2);
			}else{
				$ret .= $s1;
			}
			if($length && strlen($ret)>=$length){
				break;
			}
			
		}
		return $ret;
	}

	
		
}