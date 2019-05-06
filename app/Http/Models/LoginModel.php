<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoginModel extends Model{

	
	//用户登录
	static public function login($message){
		$error_name = '0';


		if(!is_array($message) || !array_key_exists('userid', $message) || !array_key_exists('password', $message)){
			$state['mesg'] = $error_name;

		}else{
				
		
		$has = DB::table('bloguser')->where('user',$message['userid'])->get();
	
		if($has === false || empty($has)){
		$state['mesg'] = $error_name;
		}else{
			$state['mesg']=md5($message['password'])!==$has['0']['password']?'0':'1';


		}

	}
		if($state['mesg']==='1'){
			
			$state['uuid']=time();
			
			session($has['0']);
		}else{
			$state['uuid']=null;
		}


			return $state;
	}
}
	


?>