<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReplyModel extends Model{

	
//用户注册	
	static public function reply($message){
		$error_name = '注册失败';
		$error_has = '账号已存在';
		$state=['mesg'=>'',
				'state'=>'0'
		];

		if(!is_array($message) || !array_key_exists('userid', $message) || !array_key_exists('password', $message)||!array_key_exists('usename', $message)){
			$state['mesg'] = $error_name;

		}else{
			$has = DB::table('bloguser')->where('user',$message['userid'])->get();

			if(!empty($has)){
				$state['mesg'] = !empty($has)?$error_has:$error_name;
			}else{
			DB::table('bloguser')->insert(['user'=>$message['userid'],'password'=>md5($message['password']),'usename'=>$message['usename']]);
				$state['state']='1';
			}
		}
		return $state;
	}		
}
	


?>