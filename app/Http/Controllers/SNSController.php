<?php

namespace App\Http\Controllers;

use Image;
use Closure;
use App\Content;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class SNSController extends Controller
{
  public function index()
  {
    $user = Auth::user();
    View::share('user', $user);
    $comments = Comment::all();

    $contents = 
      Content::leftjoin('users','contents.user_id','=','users.id')
      ->select('users.*',
        'contents.id',
        'contents.user_id',
        'contents.content',
        'contents.image as post_image',
        'like_count'
      )
      ->orderBy('contents.id', 'desc')
      ->paginate(9);

    $contents_simple = 
      Content::leftjoin('users','contents.user_id','=','users.id')
      ->orderBy('contents.id', 'desc')
      ->simplePaginate(9);

    $param = [
      'contents' => $contents,
      'user' => $user,
    ];

    View::share('layouts.layouts', ['param' => $param]);
    return view('/index',
      [
        'user' => $user,
        'contents' => $contents,
        'contents_simple' => $contents_simple,
        'comments' => $comments
      ]);
  }

 public function create(Request $request)
  {
    $request->validate(['content' => 'required|max:255']);
    $image_data = empty($request->image) ? "" : $request->image->hashName();
    
    $param = [
      'user_id' => $request->user_id,            
      'content' => $request->content,
      'image' => $image_data,
    ];

    if (isset($request->image)) {
      $file = $request->image;
      $image = Image::make(file_get_contents($file->getRealPath()));
      $filePath = 'public/img/';
      $image->resize(1000, 500)->save(public_path().'/img/'.$file->hashName());
    }

    Content::insert([$param]);
    return redirect('/tweet');
  }

  public function edit(Request $request)
  {
    $user = Auth::user();
    View::share('user', $user);
    $content =Content::where('id', $request->id)->first();
    return view('edit',['content' => $content]);
  }

  public function update(Request $request)
  {
    $param = [
        'id' => $request->id,
        'content' => $request->content,
    ];
    Content::where('id', $request->id)->update($param);
    return redirect('/tweet');
  }

  public function remove(Request $request)
  {
    Content::where('id', $request->id)->delete();
    return redirect('/tweet');
  }

  public function user_logout()
  {
    Auth::logout();
    return redirect('/login');
  }

  public function like()
  {
    return view('/like');
  }
}
