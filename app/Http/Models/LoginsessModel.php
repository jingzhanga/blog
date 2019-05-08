<?php
namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;


class LoginsessModel extends Model{
	
//用户状态
	static public function login_sess(){

		$user = session()->has('id');
		if($user==null){
			$state['state'] = "0";
			$state['name'] = "游客";

		}else{
			//$user=session()->all();
			$user = session()->get('usename');
			$state['state'] = "1";
			$state['name'] = $user;
		}

		return $state;
	}
	
		

}
?>