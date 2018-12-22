<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Content;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function postComment(Request $request)
  {
    $request->validate(['comment' => 'required|max:255']);

    $param = [
      'user_id' => $request->user_id,
      'content_id' => $request->content_id,
      'comment' => $request->comment
    ];

    Comment::insert([$param]);
    return redirect()->back();
  }

}
