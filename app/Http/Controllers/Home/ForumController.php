<?php
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Input;
use YuanChao\Editor\EndaEditor;
use Redirect, Response;
use App\Models\User;
use App\Models\LtCard;
use App\Http\Requests;
use App\Models\LtComment;
use App\Http\Controllers\Controller;

class ForumController extends Controller
{

    /**
    *@brief 判断是否登录
     */
    public function login(){}


    /**
    *@brief 论坛主页
    *@param $new_card  最新文章
    *@param $fire_card 最火文章
     */
    public function forumIndex()
    {
        $card = new LtCard;
        $new_card = $card
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        $fire_card = $card
            ->orderBy('browse', 'desc')
            ->limit(5)
            ->get();

        return view('home/forum/index',['new_card'=>$new_card,'fire_card'=>$fire_card]);
    }
 
    /**
    *@brief 读文章
    *@param $id  文章ID
    *@param $article  文章
    *@param $data  用户表
     */
    public function forumArticle()
    {
        $id = Input::get()['id']?Input::get()['id']:'';

        if (!empty(unserialize(Redis::get($id.'article')))) 
        {
            $article = unserialize(Redis::get($id.'article'));
        }
        else
        {
            $card = new LtCard;
            $article = $card->where('id',$id)->first()->toArray();
            $ar= Redis::set($id.'article',serialize($article));
        }
        $browse = $article['browse'];
        //增加浏览量
        DB::table('lt_card')
        ->where('id', $id)
        ->update(['browse' => $browse+1]);

        $user = new User;
        $data = $user
                ->where('user_id',$article['user_id'])
                ->first()
                ->toArray();
        $article['user_id'] = $data['username'];
        //评论条数
        $count = DB::table('lt_comment')
                ->where('article_id', $article['id'])
                ->count();

        //查看评论
        $arr = DB::table('lt_comment')
                ->select('article_id', 'u_id', 'content', 'time')
                ->where('article_id',$article['id'])
                ->paginate(5);
            foreach ($arr as $val) 
            {
                $new_data = $user->where('user_id',$val->u_id)
                            ->get()
                            ->first()
                            ->toArray();
                $val->u_id = $new_data['username'];
            }

        return view('home/forum/article',['article'=>$article, 'arr'=>$arr, 'count'=>$count]);
    }

    /**
    *@brief 文章点赞
    *@param $id 文章ID
    */
    public function forumZan()
    {
        $id  = Input::get()['id'];

        $card = new LtCard;
        $data = $card->where('id',$id)
                ->first()
                ->toArray();
        $assist = $data['assist'];

       $arr = DB::table('lt_card')
        ->where('id', $id)
        ->update(['assist' => $assist+1]);
        if ($arr) {
            $success = ['success'=>1]; 
        }

        return $success;
    }

    /**
        *@brief 文章评论
        *@param $data 接值
        *@param $article_id 文章ID
        *@param $u_id 评论人ID
        *@param $content 评论内容
    */
    public function forumComment()
    {
        $data = Input::get();

        $insert = DB::table('lt_comment')->insertGetId(
                        ['article_id' =>  $data['article_id'],
                         'u_id'      =>    $data['u_id'],
                         'content'   => $data['content'],
                         'time'      => date('Y-m-d H:i:s'),]
                        );
        if ($insert)
        {
             //查看评论
         $data = DB::table('lt_comment')
                ->join('user', 'lt_comment.u_id', '=', 'user.user_id')
                ->select('lt_comment.*','user.username')
                ->where('id', $insert)
                ->get()
                ->toArray();
        }

            return $data;
    }

    /**
    *@brief 个人信息
    */    
    public function forumInfo()
    {
        $user = new User;
        $data = $user
                ->where('user_id',37)
                ->first();
        $data->reg_time = date("Y-m-d H:i:s",$data->reg_time);

    	return view('home/forum/info',['data'=>$data]);
    }

    /**
        *@brief 写文章
        *@param $data 文章数据
        *@param $file 图片
        *@param $path 图片路径
    */
    public function imgUpload()
    {
        $data = Input::get();
        $file = Input::file('file');
        $id = Input::get('id');
        $allowed_extensions = ["png", "jpg", "gif"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg or gif.'];
        }
        $destinationPath = 'uploads/images/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        $path = $destinationPath.''.$fileName;
       
        $insert = DB::table('lt_card')->insert(
                ['user_id' =>  '44',
                 'head' => $data['head'],
                 'content' => $data['content'],
                 'date' => date('Y-m-d H:i:s'),
                 'images' => $path,]
            );

       return redirect('admin-forum-index');
    }

    /**
     *@brief 更换皮肤
    */
    public function blueSkin()
    {
        $card = new LtCard;
        $new_card = $card->orderBy('date', 'desc')->limit(5)->get();
        $fire_card = $card->orderBy('browse', 'desc')->limit(5)->get();

        return view('home/forum/blue-skin',['new_card'=>$new_card,'fire_card'=>$fire_card]);
    }

    public function greenSkin()
    {
        $card = new LtCard;
        $new_card = $card->orderBy('date', 'desc')->limit(5) ->get();
        $fire_card = $card->orderBy('browse', 'desc')->limit(5)->get();

        return view('home/forum/green-skin',['new_card'=>$new_card,'fire_card'=>$fire_card]);
    }
    
    public function redSkin()
    {
        $card = new LtCard;
        $new_card = $card->orderBy('date', 'desc')->limit(5) ->get();
        $fire_card = $card->orderBy('browse', 'desc')->limit(5)->get();

        return view('home/forum/red-skin',['new_card'=>$new_card,'fire_card'=>$fire_card]);
    }
    /**
     *@brief 全部文章
    */
    public function allArticle()
    {
        $card = new LtCard;
        $data = $card->select('head','content','assist','browse','comment','date')
        -> orderBy('date', 'asc')->paginate(2);
 
        return view('home/forum/all-article',['data'=>$data]);
    }

    /**
     *@brief 搜索接口
    */ 
   // admin-forum-duct
    public function foruDuct($a_parm)
    {
        $data = Input::get();
        // print_r($data);die;
         
    }

    /**
     *@brief AJAX无刷新搜索
    */  
// admin-forum-fullSearch
    public function fullSearch()
    {

    }

}
 