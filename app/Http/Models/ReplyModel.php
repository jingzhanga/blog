<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReplyModel extends Model{

	
//用户注册	
	static public function reply($message){
		
		$state=['mesg'=>'',
				'state'=>'0'
		];

		if(!is_array($message) || !isset($message['userid']) || !isset($message['password'])||!isset($message['usename'])){
			$state['mesg'] = '账号密码发送失败';
			\Log::warning('ReplyModel/reply:userid:'.$message['userid']."\t".'password:'.$message['password']."\n\n\t");
		}else{
			$u_match=ReplyModel::match($message['userid']);
			if($u_match['state']==='0'){
				$state['mesg']='账号'.$u_match['mesg'];
			}else{
				$p_match=ReplyModel::match($message['password']);
				if($p_match['state']==='0'){
					$state['mesg']='密码'.$p_match['mesg'];	
				}else{
					$has = DB::table('bloguser')->where('user',$message['userid'])->first();
					if(!empty($has)){
					$state['mesg'] ='账号已经存在';
					}else{
						$b=DB::table('bloguser')->insert(['user'=>$message['userid'],'password'=>md5($message['password']),'usename'=>$message['usename']]);
						if(empty($b)){
							$state=['state'=>'0','mesg'=>'注册失败'];
						}else{
							$state=['state'=>'1','mesg'=>'注册成功'];
						}
						
					}
				}
			}
		}
		return $state;
	}	

		static public function match($message){
			if(is_string($message)){
				$pattern ='/^[A-Za-z]+\d+[A-Za-z0-9]*[A-Za-z0-9]$/';
				$match=preg_match($pattern, $message);
				if($match){
					if(strlen($message)<8){
						$state=['state'=>'0','mesg'=>'位数数少于8'];
					}elseif(strlen($message)<16) {
						$state=['state'=>'1','mesg'=>''];
					}else{
						$state=['state'=>'0','mesg'=>'位数数多于16'];
					}
				}else{
					$state=['state'=>'0','mesg'=>'含有非法字符'];
				}
			}else{
				$state=['state'=>'0','mesg'=>'不是字符串'];
			}
			return $state;

		}

}
	


?>