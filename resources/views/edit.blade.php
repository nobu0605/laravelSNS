@extends('layouts.layouts')

@section('title', 'BookSNS')

@section('menubar')
    @parent

@endsection

@section('content')
	<table>
		<tr>
			<th>ツイート一覧</th>
			<th>編集</th>
		</tr>
		<tr>
			<form action="/edit" method="post">
			{{ csrf_field() }}
			<td><input type="text" name="content" value="{{$content['content']}}"></td>
			<td><button type="submit">編集</button></a></td>
			<input type="hidden" name="id" value="{{$content['id']}}">
			</form>
		</tr>
	</table>
@endsection

@section('footer')
@endsection
