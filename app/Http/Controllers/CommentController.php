<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers;
use App\Http\Models\CommentModel;
use App\Http\Models\LoginsessModel;
use Illuminate\Http\Request;

class CommentController extends Controller{
	public function index(Request $request){
		try{
			$toke = $request->all();

			$article['use'] = LoginsessModel::login_sess();

			if($article['use']['state']==='0'){
				$status['status']='0';
				$status['mes']='用户尚未登录';
			}else{
				$status=CommentModel::comment($article['use'],$toke);
			}

			return response()->json($status);
	}catch(\Exception $e){
            \Log::info('errCode:'.$e->getCode().'errMsg'.$e->getMessage()."\n\n\t");
            return response()->json(['status'=>'0','mes'=>'评论失败']);
        }
        }
	}


?>