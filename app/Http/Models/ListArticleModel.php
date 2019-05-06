<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;


class ListArticleModel extends Model{
	protected $table        = 'article';   
	protected $primaryKey   = 'id'; 
	protected $fillable = [
        'id', 'hot', 'artic', 'date', 'title', 
    ];

	public    $timestamps   = false; 
//文章列表
	static public function article(){
		$error_name = '没有发布的文章';
		if(Cache::has('key3')){
			$message=Cache::get('key3');
			
		}else{
			$message = ListArticleModel::where('id','>=','1')->orderby('date')->get()->toArray();
		
			$b=Cache::add('key3',$message,1);
		}

		$message=MysqlErrorModel::index($message,$error_name);

		return $message;
        }

//热门文章3条
    static public function hot(){
    	$error_name = '没有发布的文章';

    	$mun = '3';
		try{
			$hot = ListArticleModel::where('id','>=','1')->orderby('hot','desc')->limit($mun)->get()->toArray();
			$hot=MysqlErrorModel::index($hot,$error_name);
			return $hot;

		}catch(\Exception $e){
			\Log::info('errCode:'.$e->getCode().'errMsg'.$e->getMessage()."\n\n\t");
            return $hot=$error_name;
		}	
}

}
?>