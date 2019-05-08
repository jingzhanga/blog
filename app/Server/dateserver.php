<?php
namespace App\Server;


class dateserver{
	public function datequit($date){
		
		$time=time();
		if(is_string($date)){
			$date=$this->strdate($date,$time);
			
		}elseif(is_array($date)){
			if(isset($date['date'])&&!empty($date['date'])){
				$date['date']=$this->strdate($date['date'],$time);
			}
		}
			return $date;
			
		
	}


	public function strdate($date_ymd,$time){

		if(strtotime($date_ymd)){

		$date=$time-strtotime($date_ymd);

		if($date<=60){
			$time=$date;
			$time=$time.'秒前';
		}elseif($date<=3600){
			$time=(int)($date/60);
			$time=$time.'分钟前';
		}elseif($date<3600*24){
			$time=(int)($date/3600);
			$time=$time.'小时前';
		}elseif($date<3600*24*4){
			$time=(int)($date/3600/24);
			$time=$time.'天前';
		}else{
			$time=$date_ymd;
		}
	}else{
		$time=$date_ymd;
	}

		return $time;
	}
	
}