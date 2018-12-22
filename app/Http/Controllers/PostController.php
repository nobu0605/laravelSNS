<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Like;
use Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\View;
use App\Content;

class PostController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        View::share('post.index', $user);

        $posts = Post::orderBy('created_at','desc')->get();
        return view('post.index',['posts' => $posts,'user' => $user]);
    }

  public function postLikePost(Request $request){
 
        $post_id = $request['postId'];

         //post_idが存在しない場合は終わり
        $content = 
        Content::leftjoin('users','contents.user_id','=','users.id')
        ->select('users.*',
            'contents.id',
            'contents.user_id',
            'contents.content',
            'like_count'           
        )
        ->where('contents.id', $post_id);

         $post_like = $content->first()->like_count;
         $increase = [
            'like_count' => $post_like +1
         ];
         $decrease = [
            'like_count' => $post_like -1
         ];

         if (!$content) {
             return null;
         }
         //ログインしているユーザーの情報を取得します
         $user = Auth::user();
         //ユーザーがライクを押しているか
         $like = $user
                ->likes()
                ->where('post_id', $post_id)
                ->first();

         //既に押してるときは何もしない
         if ($like) {
            DB::table('likes')
            ->where('post_id', $post_id)
            ->where('user_id', $user->id)
            ->delete();

            DB::table('contents')
            ->where('id', $post_id)
            ->update($decrease);
         }
         //初めての押下時は新規にLikeテーブルにレコードを入れます
         else{
             $like = new Like();

        	DB::table('contents')
            ->where('id', $post_id)
            ->update($increase);
         }

         $like->like = 1;//ここで1のみを扱います
         $like->user_id = $user->id;
         $like->post_id = $content->first()->id;
 
        $like->save();
 
        return null;
 
   }
}