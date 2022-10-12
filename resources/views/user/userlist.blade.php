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
				<th>表示名</th>
				<th>アドレス</th>
				<th>権限</th>
				<th>承認</th>
				<th>地域</th>
				<th>勤務時間</th>
				<th></th>
			</tr>
			{{-- @foreach ($userlist as $record) --}}
			@foreach ($userlist as $id =>$record)
			<tr class="d{{$id+1}}">
				<td>{{ $id + 1 }}</td>
				<td>{{ $record->name}}</td>
				<td>{{ $record->name2}}</td>
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
					<option val=1 @if($record->approval==1)selected @endif >すべて</option>
					<option val=2 @if($record->approval==2)selected @endif >エリア</option>
					<option val=0 @if($record->approval==0)selected @endif >なし</option>

					</select>
				</td>
				@else
				<td>{{ $record->approvaltag->nametag}}</td>
				@endif
				@if(Auth::user()->role==3)
				<td>
					<select>
					<option val=0 @if($record->area==0)selected @endif >江越</option>
					<option val=1 @if($record->area==1)selected @endif >八代</option>
					<option val=2 @if($record->area==2)selected @endif >山鹿</option>

					</select>
				</td>
				@else
				<td>{{ $record->areatag->nametag}}</td>
				@endif
				@if(Auth::user()->role==3)
				<td>
					<select>
					<option val=0 @if($record->worktype_id==0)selected @endif >未設定</option>
					<option val=1 @if($record->worktype_id==1)selected @endif >9時-18時:8</option>
					<option val=2 @if($record->worktype_id==2)selected @endif >8時半-17時:7.5</option>
					<option val=3 @if($record->worktype_id==3)selected @endif >9時-17時:7</option>
					<option val=4 @if($record->worktype_id==4)selected @endif >10時-18時:7</option>
					<option val=5 @if($record->worktype_id==5)selected @endif >8時半-16時半:7</option>

					</select>
				</td>
				@else
				<td>{{optional( $record->worktype)->worktype}}</td>
				@endif


				<td><button onclick="">変更</button></td>
			</tr>
			@endforeach
		</table>
	</div>
</div>
</x-app-layout>
