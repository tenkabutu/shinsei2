<x-app-layout>
<x-slot name="head">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</x-slot>

<div class="main_right">
	<div class="">
		<h2>ユーザー管理</h2>

		<label class="success_label"></label>
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
					<input type="button" name="id" value="{{ $record->id}}">
					<select name="role">
					<option value=1 @if($record->role==1)selected @endif >管理者</option>
					<option value=2 @if($record->role==2)selected @endif >リーダー</option>
					<option value=3 @if($record->role==3)selected @endif >支援員</option>
					</select>
				</td>
				@else
				<td>{{ $record->roletag->nametag}}</td>
				@endif
				@if(Auth::user()->role==3)
				<td>
					<select name="approval">
					<option value=1 @if($record->approval==1)selected @endif >すべて</option>
					<option value=2 @if($record->approval==2)selected @endif >エリア</option>
					<option value=0 @if($record->approval==0)selected @endif >なし</option>

					</select>
				</td>
				@else
				<td>{{ $record->approvaltag->nametag}}</td>
				@endif
				@if(Auth::user()->role==3)
				<td>
					<select name="area">
					<option value=0 @if($record->area==0)selected @endif >江越</option>
					<option value=1 @if($record->area==1)selected @endif >八代</option>
					<option value=2 @if($record->area==2)selected @endif >山鹿</option>

					</select>
				</td>
				@else
				<td>{{ $record->areatag->nametag}}</td>
				@endif
				@if(Auth::user()->role==3)
				<td>
					<select name="worktype_id">
					<option value=0 @if($record->worktype_id==0)selected @endif >未設定</option>
					<option value=1 @if($record->worktype_id==1)selected @endif >9時-18時:8</option>
					<option value=2 @if($record->worktype_id==2)selected @endif >8時半-17時:7.5</option>
					<option value=3 @if($record->worktype_id==3)selected @endif >9時-17時:7</option>
					<option value=4 @if($record->worktype_id==4)selected @endif >10時-18時:7</option>
					<option value=5 @if($record->worktype_id==5)selected @endif >8時半-16時半:7</option>

					</select>
				</td>
				@else
				<td>{{optional( $record->worktype)->worktype}}</td>

				@endif


				<td><input type="button" class="user_change" value="変更"></td>
			</tr>
			@endforeach
		</table>
	</div>
</div>
<script>
	$('.user_change').on('click', function(){
		var str = $(this).closest('tr');
		var id = str.find('input[name="id"]').val();
		var role = str.find('select[name="role"]').val();
		var approval = str.find('select[name="approval"]').val();
		var area = str.find('select[name="area"]').val();
		var wt = str.find('select[name="worktype_id"]').val();
		$.ajax({
	        url: "user/change",
	        dataType: "json",
	        type: "POST",
	        data:{id:id,role:role,approval:approval,area:area,worktype_id:wt, _token: '{{csrf_token()}}'},
	        success: function(data) {

	         	var resp ="ID:"+data.id+" "+data.name+"さんの情報を書き換えました。";
	        	$('.success_label').append(resp);



	        },
	        error: function(XMLHttpRequest, textStatus, errorThrown) {
	        	console.log("XMLHttpRequest : " + XMLHttpRequest.status);
	        	console.log("textStatus     : " + textStatus);
	        	console.log("errorThrown    : " + errorThrown.message);
	        }
	     });
	    // }else{
	      //   alert("端末が選択されていません");
	       //  }
	});
   	</script>
</x-app-layout>
