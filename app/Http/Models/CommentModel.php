<?php  
namespace App\Http\Models;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\LoginsessModel;


class CommentModel extends Model{



	//插入评论
    static public function comment($use,$toke){

    	$date=date('Y-m-d');
//

    	if(!is_array($toke)||!isset($toke['id'])||!isset($toke['meg'])){
    		$comment=['status'=>'0','meg'=>'评论失败'];

    	}else{
    	$has = DB::table('article')->where(['id'=>$toke['id']])->get();
    	
    	if(empty($has)){
    		$comment=['status'=>'0','meg'=>'文章不存在'];
    	}else{
    		
    		$id = DB::table('comment')->insert(['uid'=>$use['state'],'comment'=>$toke['meg'],'cid'=>$toke['id'],'date'=>$date]);
    		$comment=(empty($id))?['status'=>'0','meg'=>'评论失败']:['status'=>'1','meg'=>'评论成功'];
    	}
    }
    	return $comment;
    }
}