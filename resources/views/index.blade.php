@php
	function like_check($content_id){
		if (Auth::check() AND  Auth::user()->likes()->where('post_id', $content_id)->first() != null){
			return true;
		}
		return false;
	}
@endphp

@php
	function like_count_check($like_count){
		if ($like_count == NULL || $like_count == 0){
			return 'none;';
		}
		return 'inline-block;';
	}
@endphp

@extends('layouts.layouts')
@section('title', 'BookSNS')
@section('menubar')
@parent
@endsection

@section('content')
	@if (Auth::check())
		<p>Hello！{{$user->name . ' さん'}}</p>
		    <img style="height:13vw;width: 13vw;" src="img/{{$user->image}}">
		<p>Do you wanna tweet?</p>
	@else
		<p>※ログインしていません。（<a href="/login">ログイン</a>｜
		<a href="/register">登録</a>）</p>
	@endif

	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	@if (Auth::check())
		<form action="/tweet" enctype="multipart/form-data" method="post">
			{{ csrf_field() }}
				<input type="hidden" name="user_id" value="{{$user->id}}">
				<div>
					<input class="input_content" type="text" name="content" value="{{ old('content') }}">
					<input class="input_file" accept="image/*" id="imgFile"
								 type="file" name="image" value="{{ old('image') }}"
					>
					<br/><br/>
			    <div class="preview"></div>
				</div><br/>
				<input type="submit" value="投稿">
		</form>
	@endif

	<div class="contents_wrapper col-md-12">
		@foreach ($contents as $content)

			@for ($i = 0; $i < 2 ; $i++)

			@if ($i == 1)
			<div class="modal" id="modal{{ $content->id }}">
		    <div class="overLay modalClose"></div>
		    <div class="inner">
			@endif

				<div class="table_body col-xs-12 {{$i == 1 ? 'col-md-12' : 'col-md-4'}}"
							style="
							  height:'100%';
							  margin-bottom:{{ $i == 1 ? '0px' : '30px'}};"
				>
					<h4>{{$content['name']}}</h4>
					<div class="content_body">
						<a href="/mypage?id={{$content->user_id}}">
							<img class="profile_img" src="img/{{$content->image}}">
						</a>
                        <img class="post_image"
                             style="height:{{ $i == 1 ? '35vw' : '25vw'}};"
                             src="img/{{$content->post_image}}"
                        >
						<span class="content_post">{{$content->content}}</span>
					</div>

					<div style="width: 100%; display: flex;justify-content:flex-start;">
						@if (Auth::check() AND $user->id == $content['user_id'])
							<a href="/edit?id={{$content->id}}">
								<button class="btn btn-success">編集</button>
							</a>
							<a href="/delete?id={{$content->id}}">
								<button class="btn btn-primary" onclick="return confirm('本当に削除しますか？');">削除</button>
							</a>
						@endif

						<div style="display:inline-block;" data-postid="{{ $content->id }}">
							<div class="class{{ $content->id }}" data-like="{{ $content->like_count }}">
								<div>
									<a href="#"
										 id="{{ $content->id }}"
										 class="like {{like_check($content->id) ? 'up' : ''}}"
									>
										<i style="color:#ff69b4;" class="{{like_check($content->id) ? 'fas' : 'far'}} fa-heart"></i>
										<p class="like_count show"
											 style="display:{{ like_count_check($content->like_count) }} color:#ff69b4;"
										>
											&nbsp;({{ $content->like_count }})
										</p>
									</a>
									<span>
										<a href="#modal{{ $content->id }}" class="modalOpen">
											<i class="far fa-comment"></i>
										</a>
									</span>
								</div>
							</div>
						</div>
						<div class="{{$i == 1 ? '' : 'invisible'}}"
								 style="margin-left: 10px;"
						>
							<form action="/comment" method="post">
								{{ csrf_field() }}
								<input type="text" name="comment" >
								<input type="hidden" name="user_id" value="{{$content->user_id}}">
								<input type="hidden" name="content_id" value="{{$content->id}}">
								<input type="submit">
							</form>
						</div>
					</div>
				</div>

			@if ($i == 1)
				<div class="comment_section" >
						@forelse($content->comments as $comment)
		            @if ($comment->content_id == $content->id)
				          <div style="height: 50px;">
				            <img style="height:2vw;width: 2vw;" src="img/{{$content->image}}">
				            <span>{{ $comment->comment }}</span>
				          </div>
		            @endif
		        @empty
		        <p>No posts yet</p>
						@endforelse
				</div>

			   </div>
			</div>
			@endif

			@endfor
		@endforeach
	</div>
	{{$contents->links()}}
	{{$contents_simple->links()}}
@endsection
@section('footer')
@endsection
