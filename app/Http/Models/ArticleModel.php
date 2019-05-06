<?php
namespace App\Http\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;


class ArticleModel extends Model{
	
//文章页面
	static public function article($id){
		$error_name = null;
		if(empty($id)){
			$article = $error_name;
		}else{

			$has=DB::table('article')->where(['id'=>$id])->get();

			if(empty($has)){
				$article=$error_name;
			}else{
				$article=$has['0'];
				DB::table('article')->where(['id'=>$id])->increment('hot');

				$b=new ArticleModel();
				$article['comment']=$b->commentlist($id);

				
			}

			
		}
		return $article;
        }


//评论列表

        public function commentlist($id){

        	try{
        		if(empty($id)){
					$article = [];
					}else{
					$comment=DB::table('comment')->where(['cid'=>$id])->orderby('date','desc')->get();
					}
					return $comment;
        	}catch(\Exception $e){
            \Log::info('errCode:'.$e->getCode().'errMsg'.$e->getMessage()."\n\n\t");
            return null;
        }
	}
    

}
?>