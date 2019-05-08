<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers;
use App\Http\Models\LoginsessModel;
use Illuminate\Http\Request;
use App\Http\Models\ArticleModel;

class ArticleController extends Controller{
	public function index(Request $request){
		try{
			$id = $request->all();

			$article['artic'] = ArticleModel::article($id);
			$article['commenthot'] = ArticleModel::commentlist($id);
			//$article['comment'] = ArticleModel::article($id);
			$article['use'] = LoginsessModel::login_sess();
			return response()->json($article);
	}catch(\Exception $e){
            \Log::info('ArticleController/index：errCode:'.$e->getCode().'errMsg'.$e->getMessage()."\n\n\t");
            return response()->json(['arrtic'=>'null'
            	,'use'=>LoginsessModel::login_sess()]);
        }
        }
	}


?>