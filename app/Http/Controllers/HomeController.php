<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers;
use App\Http\Models\LoginsessModel;
use App\Http\Models\ListArticleModel;

class HomeController extends Controller{
	public function index(){
		try{
			
			$article['act'] = ListArticleModel::article();
			$article['hot']=ListArticleModel::hot();
			$article['use'] = LoginsessModel::login_sess();
			
			return response()->json($article);
	}catch(\Exception $e){
            \Log::info('errCode:'.$e->getCode().'errMsg'.$e->getMessage()."\n\n\t");
            return response()->json(['act'=>'没有发布的文章','hot'=>'没有发布的文章','use'=>LoginsessModel::login_sess()]);
        }
        }
	}


?>