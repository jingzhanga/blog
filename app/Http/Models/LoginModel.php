<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LoginModel extends Model{

	
	//用户登录
	static public function login($message){
		$error_name = '0';


		if(!is_array($message) || !isset($message['userid']) || !isset($message['password']) ||empty($message['userid']) || empty($message['password'])){
			$state['state'] = $error_name;
			$state['mesg']="账号密码发送失败";
			if(!isset($message['userid'])){
				$state['mesg']="账号发送失败";
			}
			if(!isset($message['password'])){
				$state['mesg']="密码发送失败";
			}
			if(empty($message['userid'])){
				$state['mesg']="没有输入账号";
			}
			if(empty($message['password'])){
				$state['mesg']="没有输入密码";
			}
			
			
			\Log::warning('LoginModel/login:userid:'.$message['userid']."\t".'password:'.$message['password']."\n\n\t");
		}else{
		
		$has = DB::table('bloguser')->where('user',$message['userid'])->first();	
		$mun=Cache::get($message['userid']);
		if(empty($mun)){
			
			Cache::add($message['userid'],'1',5);

			if(empty($has)){
			$state['state'] = $error_name;
			$state['mesg']="账号不存在";
			}else{

			if(md5($message['password'])!==$has['password']){
				$state=['state'=>'0','mesg'=>'密码错误'];
			}else{
				$state=['state'=>'1','mesg'=>'登录成功'];
			}
		}
		}elseif($mun<=10){
			Cache::increment($message['userid']);
			if(empty($has)){
			$state['state'] = $error_name;
			$state['mesg']="账号不存在";
			}else{

			if(md5($message['password'])!==$has['password']){
				$state=['state'=>'0','mesg'=>'密码错误'];
			}else{
				$state=['state'=>'1','mesg'=>'登录成功'];
			}
		}
		}else{
			$state=['state'=>'0','mesg'=>'登录过多，稍后再试'];

			\Log::warning('LoginModel/login:num:'.$mun."mesg:".$message."\n\n\t");
		}	
		

	}	

	if($state['state']==='1'){
		session($has);
	}	

			return $state;
	}

		
}
		

		

?>