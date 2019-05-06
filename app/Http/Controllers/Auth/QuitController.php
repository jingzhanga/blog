<?php
namespace App\Http\Controllers\Auth;

use App\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class QuitController extends Controller{

	#退出返回值[1]
	public function index(Request $request){
		try{
			

			$request->Session()->flush();

			$article = session()->all();

			if(!empty($article)){
				\Log::info(time().$status."\n\n\t");
			}
			$status='1';

			return response()->json($status);

	}catch(\Exception $e){
            \Log::info('errCode:'.$e->getCode().'errMsg'.$e->getMessage()."\n\n\t");
            return response()->json(['1']);;
        }
        }
	}


?>