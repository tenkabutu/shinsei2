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
				<th>承認</th>
				<th>地域</th>
			</tr>
			{{-- @foreach ($userlist as $record) --}}
			@foreach ($userlist as $id =>$record)
			<tr class="d{{$id+1}}">
				<td>{{ $id + 1 }}</td>
				<td>{{ $record->name}}</td>
				<td>{{ $record->email}}</td>
				@if(Auth::user()->role==3)
				<td>
					<select>
					<option val=1 @if($record->role==1)selected @endif >管理者</option>
					<option val=2 @if($record->role==2)selected @endif >リーダー</option>
					<option val=3 @if($record->role==3)selected @endif >支援員</option>
					</select>
				</td>
				@else
				<td>{{ $record->roletag->nametag}}</td>
				@endif
				@if(Auth::user()->role==3)
				<td>
					<select>
					<option val=1 @if($record->role==0)select @endif >管理者</option>
					<option val=2 @if($record->role==0)select @endif >リーダー</option>
					<option val=3 @if($record->role==0)select @endif >支援員</option>
					</select>
				</td>
				@else
				<td>{{ $record->roletag->nametag}}</td>
				@endif
				<td>{{optional( $record->areatag)->nametag}}</td>



				<td><a href="/save/{{ $record->id }}/edit">編集</a></td>
			</tr>
			@endforeach
		</table>
	</div>
</div>
</x-app-layout>
