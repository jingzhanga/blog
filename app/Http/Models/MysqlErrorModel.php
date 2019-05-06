<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class MysqlErrorModel extends Model{


//数据库状态
	static public function index($message,$error_name){
			$default = "操作失败";
			if(empty($error_name)){
				$error_name = $default;
			}
			if(empty($message)){
				if($message === false){
					\Log::emergency('数据库连接异常');
				}
				$message[] = $error_name;
			}
			return $message;

        }
	}


?>