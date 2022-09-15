<x-app-layout>
<x-slot name="head">
</x-slot>

<div class="main_right">
	<div class="">
		<h2>ユーザー管理</h2>
		<table class="table">
			<tr>
				<th>ID</th>
				<th>使用者</th>
				<th>アドレス</th>
				<th>権限</th>
				<th></th>
			</tr>
			{{-- @foreach ($records as $record) --}} @foreach ($records as $id =>
			$record)
			<tr class="d{{$id+1}}">
				<td>{{ $id + 1 }}</td>
				<td>{{ $record->name}}</td>
				<td>{{ $record->email}}</td>


				<td><a href="/save/{{ $record->id }}/edit">編集</a>｜ <a
					href="/save/{{ $record->id }}">削除</a></td>
			</tr>
			@endforeach
		</table>
	</div>
</div>
</x-app-layout>
