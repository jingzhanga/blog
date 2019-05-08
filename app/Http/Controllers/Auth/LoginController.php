<?php
namespace App\Http\Controllers\Auth;

use App\User;

use App\Http\Controllers\Controller;
use App\Http\Models\LoginModel;
use Illuminate\Http\Request;



class LoginController extends Controller{
	public function index(Request $request){
		try{
			$mesage = $request->all();


			$b=new LoginModel();
			$article =$b->login($mesage);
			


			return response()->json($article);

	}catch(\Exception $e){
            \Log::error('LoginController/index:errCode:'.$e->getCode().'errMsg'.$e->getMessage()."\n\n\t");
            return response()->json(['status'=>"0",'mesg'=>404,'data'=>null]);
        }
        }
	}


?>