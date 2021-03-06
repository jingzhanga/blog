<?php
namespace App\Http\Controllers\Auth;

use App\User;

use App\Http\Controllers\Controller;
use App\Http\Models\ReplyModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReplyController extends Controller{
	public function index(Request $request){
		try{

			$mesage = $request->all();
		 

			$article = ReplyModel::reply($mesage);

			return response()->json($article);

	}catch(\Exception $e){
            \Log::info('ReplyController/index:errCode:'.$e->getCode().'errMsg'.$e->getMessage()."\n\n\t");
            return response()->json(['status'=>"0",'mesg'=>404,'data'=>null]);
        }
        }
	}


?>