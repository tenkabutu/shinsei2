<x-app-layout>
<x-slot name="style"></x-slot>
<x-slot name="head">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src='{{ mix('js/jquery.tablesorter.js') }}'></script>
<script>
$(document).ready(function(){
	$('.sort-table').tablesorter();
});
</script>
<style>
.select2-search--inline{display:none;}</style>
</x-slot>

<div class="main_right">
	<div class="">
		<h2>ユーザー管理</h2>

		<label class="success_label"></label>
		<table class="user_table  sort-table">
			<thead>
			<tr>
				<th  data-sorter="false">No</th>
				<th >使用者</th>

				<th>権限</th>
				<th>承認</th>
				<th>地域</th>
				<th>エリア</th>
				<th>勤務時間</th>
				<th>購確</th>
				<th>購承</th>
				<th>購買</th>
				<th>編</th>
				<th>表</th>
				<th  data-sorter="false"></th>
			</tr>
			</thead>
			{{-- @foreach ($userlist as $record) --}}
			@foreach ($userlist as $id =>$record)
			<tr class="d{{$id+1}}">
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
    				<select name="areas[]" multiple class="areas">
        			@foreach($areas as $area)
            			<option value="{{ $area->id }}"
                @if($record->areas->contains('id', $area->id)) selected @endif>
                {{ $area->name }}
            </option>
        @endforeach
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
				<td><input type="checkbox" name="p1" value="1" @if($record->permissions & 1) checked @endif></td>
				<td><input type="checkbox" name="p2" value="2" @if($record->permissions & 2) checked @endif></td>
				<td><input type="checkbox" name="p3" value="4" @if($record->permissions & 4) checked @endif></td>
				<td><input type="checkbox" name="p4" value="8" @if($record->permissions & 8) checked @endif></td>
				<td><input type="checkbox" name="p5" value="16" @if($record->permissions & 16) checked @endif></td>
				<td><input type="button" class="user_change" value="変更"></td>
				@else
				<td>{{ $record->approvaltag->nametag}}</td>
				<td>{{ $record->areatag->nametag}}</td>
				<td>{{optional( $record->worktype)->worktype}}</td>

				<td>@if($record->permissions & 1) ◯ @endif</td>
				<td>@if($record->permissions & 2) ◯ @endif</td>
				<td>@if($record->permissions & 4) ◯ @endif</td>
				<td>@if($record->permissions & 8) ◯ @endif</td>
				<td>@if($record->permissions & 16) ◯ @endif</td>
				<td></td>
				@endif





			</tr>
			@endforeach
		</table>
	</div>
</div>
<script>
$(document).ready(function() {
    $('.areas').select2({
        placeholder: "未選択",

        width: '100%'
    });
    $ ('.areas'). on ( 'select2:opening select2:closing' , function ( event ) { var $searchfield = $ ( this ). parent (). find ( '.select2-search__field' );
    $searchfield . prop ( 'disabled' , true ); });
});
	$('.user_change').on('click', function(){
		var str = $(this).closest('tr');
		var id = str.find('input[name="id"]').val();
		var role = str.find('select[name="role"]').val();
		var approval = str.find('select[name="approval"]').val();
		var area = str.find('select[name="area"]').val();
		var areas = str.find('select[name="areas[]"]').val();
		var wt = str.find('select[name="worktype_id"]').val();
		var pe=0;
		if(str.find('input[name="p1"]').prop('checked')){
			pe |= 1;
			}
		if(str.find('input[name="p2"]').prop('checked')){
			pe |= 2;
			}
		if(str.find('input[name="p3"]').prop('checked')){
			pe |= 4;
			}
		if(str.find('input[name="p4"]').prop('checked')){
			pe |= 8;
			}
		if(str.find('input[name="p5"]').prop('checked')){
			pe |= 16;
			}

		$.ajax({
	        url: "user/change",
	        dataType: "json",
	        type: "POST",
	        data:{id:id,role:role,approval:approval,areas:areas,area:area,worktype_id:wt,permissions:pe, _token: '{{csrf_token()}}'},
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
	});
	$('input[type="checkbox"]').on('click', function() {
	    // クリックされたチェックボックスのname属性とチェック状態を取得します
	    var isCheckedP1 = $(this).attr('name') === 'p1' && $(this).prop('checked');
	    var isCheckedP2 = $(this).attr('name') === 'p2' && $(this).prop('checked');

	    if (isCheckedP1) {
	        // p1Checkboxにチェックがついたらp2Checkboxのチェックを外す
	        $(this).closest('tr').find('input[name="p2"]').prop('checked', false);
	    } else if (isCheckedP2) {
	        // p2Checkboxにチェックがついたらp1Checkboxのチェックを外す
	        $(this).closest('tr').find('input[name="p1"]').prop('checked', false);
	    }
	});
   	</script>
</x-app-layout>
