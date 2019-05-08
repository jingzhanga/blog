<?php
namespace App\Http\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Server\dateserver;

class ArticleModel extends Model{
	
//文章页面
	static public function article($id){
		$cacheid='actic_'.$id['id'];

		$error_name = null;
		if(empty($id)){
			$article = $error_name;
		}else{
			
			if(Cache::has($cacheid)){
			$article=Cache::get($cacheid);
			DB::table('article')->where(['id'=>$id])->increment('hot');
		}else{

			$has=DB::table('article')->where(['id'=>$id])->get();

			if(empty($has)){
				$article=$error_name;
			}else{
				$article=$has['0'];
				$inc=DB::table('article')->where(['id'=>$id])->increment('hot');
				if(empty($inc)){
					\Log::warning('ArticleModel/article:articleid:'.$id."\t");
				}				
			}

			}
		}
		$date=new dateserver();
		$article['date']=$date->datequit($article['date']);
		return $article;
        }






//评论列表

        static public function commentlist($id){
        	$cachecomment='comment'.$id['id'];
        	try{
        		
        		if(empty($id)){
					$comment = [];
					}else{
						if(Cache::has($cachecomment)){
							$comment=Cache::get($cachecomment);
						}else{
							$comment=DB::table('comment')->where(['cid'=>$id])->orderby('date','desc')->get();
							Cache::add($cachecomment,$comment,1);
						}
					
					}
					$date=new dateserver();
					for($i=0;$i<count($comment);$i++){
						$comment[$i]['date']=$date->datequit($comment[$i]['date']);
					}
					return $comment;
        	}catch(\Exception $e){
            \Log::info('errCode:'.$e->getCode().'errMsg'.$e->getMessage()."\n\n\t");
            return null;
        }
	}
    

}
?>