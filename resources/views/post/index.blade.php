@extends('layouts.layouts')

@section('title', 'Laravel')

@section('menubar')
    @parent
   
@endsection

@section('content')
      <div class="container">
        <div class="blog-header">
            <div class="row">
              <div class="col-sm-12 mt-5">
                <div class="blog-post">
 
                  @foreach ($posts as $post)
 
                  <div class="card mt-5">
                    <h3 class="card-header"><a href="#">{{ $post->title }}</a></h3>
                    <div class="card-body">
                      {{ $post->body }}
                    </div>
                    <div class="card-footer" data-postid="{{ $post->id }}">
                      <div class="d-flex" data-postid="{{ $post->like_count }}">
                        <div class="p-2">
                          <!-- ここを修正　-->
                          @if( Auth::user()->likes()->where('post_id', $post->id)->first() != null )
                            <a href="#" class="btn like">
                              <i class="fas fa-thumbs-up"></i>
                              <p class="like_count show" style="display:inline-block;">&nbsp;&nbsp;&nbsp;({{ $post->like_count }})</p>
                            </a>
                          @else
                            <a href="#" class="btn like">
                              <i class="fas fa-thumbs-up"></i>
                              <p class="like_count show" style="display:inline-block;">&nbsp;&nbsp;&nbsp;({{ $post->like_count }})</p>
                            </a>
                          @endif
                          <!-- ここまで　-->
                        </div>
                        <div class="ml-auto p-2">
                          投稿日時： {{ $post->created_at }} 投稿者： {{ $post->user->name }}
                        </div>
                      </div>
                    </div>
                  </div>
 
                  @endforeach
 
            </div>
          </div>
        </div>
      </div>
    </div>
 
@endsection

@section('footer')
@endsection
