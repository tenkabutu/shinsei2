<x-app-layout>
<x-slot name="style"></x-slot>
<x-slot name="head">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src='./js/jquery.tablesorter.js'></script>
<script>
$(document).ready(function(){
	$('.sort-table').tablesorter();
});
</script>
</x-slot>

<div class="main_right">
	<div class="">
		<h2>ユーザー管理</h2>

		<label class="success_label"></label>
		<table class="user_table  sort-table">
			<thead>
			<tr>
				<th>ID</th>
				<th>No</th>
				<th >使用者</th>

				<th>権限</th>
				<th>承認</th>
				<th>地域</th>
				<th>勤務時間</th>
				<th>購</th>
				<th></th>
			</tr>
			</thead>
			{{-- @foreach ($userlist as $record) --}}
			@foreach ($userlist as $id =>$record)
			<tr class="d{{$id+1}}">

				<td>{{ $id + 1 }}</td>
				<td>{{ $record->employee}}</td>
				<td>{{ $record->name}}</td>

				@if(Auth::user()->role<=2)
				<td>
					<input type="hidden" name="id" value="{{ $record->id}}">
					<select name="role">
					<option value=1 @if($record->role==1)selected @endif >管理者</option>
					<option value=2 @if($record->role==2)selected @endif >リーダー</option>
					<option value=3 @if($record->role==3)selected @endif >支援員</option>
					<option value=4 @if($record->role==4)selected @endif >人事</option>
					<option value=5 @if($record->role==5)selected @endif >退職者</option>
					</select>
				</td>
				@elseif(Auth::user()->role==2&&Auth::user()->approval==2)
				<td>{{ $record->roletag->nametag}}</td>
				@else
				<td>{{ $record->roletag->nametag}}</td>
				@endif

				@if(Auth::user()->role<=2)
				<td>
					<select name="approval">
					<option value=1 @if($record->approval==1)selected @endif >すべて</option>
					<option value=2 @if($record->approval==2)selected @endif >エリア</option>
					<option value=0 @if($record->approval==0)selected @endif >なし</option>

					</select>
				</td>
				<td>
					<select name="area">
					<option value=0 @if($record->area==0)selected @endif >江越</option>
					<option value=1 @if($record->area==1)selected @endif >八代</option>
					<option value=2 @if($record->area==2)selected @endif >熊本市</option>
					<option value=3 @if($record->area==3)selected @endif >玉名</option>
					<option value=4 @if($record->area==4)selected @endif >荒尾</option>
					<option value=5 @if($record->area==5)selected @endif >天草</option>
					<option value=6 @if($record->area==6)selected @endif >市町村A</option>
					<option value=7 @if($record->area==7)selected @endif >市町村B</option>
					<option value=8 @if($record->area==8)selected @endif >熊本県</option>

					</select>
				</td>
				<td>
					<select name="worktype_id">
					<option value=0 @if($record->worktype_id==0)selected @endif >未設定</option>
					<option value=1 @if($record->worktype_id==1)selected @endif >9時-18時</option>
					<option value=2 @if($record->worktype_id==2)selected @endif >8時半-17時</option>
					<option value=3 @if($record->worktype_id==3)selected @endif >9時-17時</option>
					<option value=4 @if($record->worktype_id==4)selected @endif >10時-18時</option>
					<option value=5 @if($record->worktype_id==5)selected @endif >8時半-16時半</option>
					<option value=6 @if($record->worktype_id==6)selected @endif >8時半-17時半</option>
					<option value=7 @if($record->worktype_id==7)selected @endif >9時-17時半</option>

					</select>
				</td>
				@else
				<td>{{ $record->approvaltag->nametag}}</td>
				<td>{{ $record->areatag->nametag}}</td>
				<td>{{optional( $record->worktype)->worktype}}</td>
				@endif
				<td><input type="checkbox" name="p1" value="1" @if($record->permissions & 1) checked @endif></td>



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
		var pe=0;
		if(str.find('input[name="p1"]').prop('checked')){
			pe |= 1;
			}

		$.ajax({
	        url: "user/change",
	        dataType: "json",
	        type: "POST",
	        data:{id:id,role:role,approval:approval,area:area,worktype_id:wt,permissions:pe, _token: '{{csrf_token()}}'},
	        success: function(data) {

	         	var resp ="ID:"+data.id+" "+data.name+"さんの情報を書き換えました。";
	        	$('.success_label').append(resp);
	        	console.log(data);



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
