<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	
        $this->assign('title','搜地点');
        $this->display();
    }
}