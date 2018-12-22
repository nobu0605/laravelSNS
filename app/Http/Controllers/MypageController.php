<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Content;

class MypageController extends Controller
{
  public function index(Request $request)
  {
    $user = Auth::user();
    View::share('user', $user);

    $contents = 
      Content::leftjoin('users','contents.user_id','=','users.id')
      ->select('users.*',
        'contents.id',
        'contents.user_id',
        'contents.content',
        'contents.image as post_image',
        'like_count'           
      )
      ->where('contents.user_id', $request->id)
      ->orderBy('contents.id', 'desc')
      ->paginate(9);

    $param = [
      'user' => $user
    ];
    
    return view('mypage.Mypage', ['param' => $param,'contents' => $contents]);
  }

  public function create()
  {
      //
  }

  public function store(Request $request)
  {
      //
  }

  public function show($id)
  {
      //
  }

  public function edit($id)
  {
      //
  }

  public function update(Request $request, $id)
  {
      //
  }

  public function destroy($id)
  {
      //
  }
}
