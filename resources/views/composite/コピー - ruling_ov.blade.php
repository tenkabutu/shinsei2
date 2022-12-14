<x-app-layout>
<x-slot name="head">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src='/shinsei2/public/js/jquery.repeater.js'></script>

<script>
/* $(document).ready(function(){
	$('.sort-table').tablesorter();
}); */
</script>
</x-slot>

<div class="main_right">
	<div id="narrow">
    		<fieldset>
                <legend>検索条件</legend>
    		<form action="" method="GET">
    		@csrf
    		<input type="hidden" name="matter_type" value="1">
    		<ul>

    			<li>
    			<div>日時：<select id="year" name="year">
    				<option value="2022">2022</option><option value="2021">2021</option></select>年
					<select id="month" name="month">
						<option value="0">--</option>
						@for($i = 1; $i <= 12; $i++)
							<option value={{$i}} @if(isset($input_data['month'])&&$i==$input_data['month']) selected @endif>{{$i}}</option>
						@endfor
						</select>月
					</div>
						<div><label>状態：</label>
					 <div class="radio-group">
					<input id="st1_1" type="radio" class="st1" name="matter_type" value="1" @if(Request::get('matter_type')==1) checked @endif />
					<label for="st1_1">振替</label>
					<input id="st1_2" type="radio" class="st1" name="matter_type" value="2" @if(Request::get('matter_type')==2) checked @endif/>
					<label for="st1_2">休暇</label>
					<input id="st1_3" type="radio" class="st1" name="matter_type" value="3" @if(Request::get('matter_type')==3) checked @endif/>
					<label for="st1_3">テレワ</label>

					</div>
					</div>
					<div><label>状態：</label>
					 <div class="radio-group">
					<input id="st1_1" type="radio" class="st1" name="search_type" value="1" @if(Request::get('search_type')==1) checked @endif />
					<label for="st1_1">全件</label>
					<input id="st1_2" type="radio" class="st1" name="search_type" value="2" @if(Request::get('search_type')==2) checked @endif/>
					<label for="st1_2">未申請</label>
					<input id="st1_3" type="radio" class="st1" name="search_type" value="3" @if(Request::get('search_type')==3) checked @endif/>
					<label for="st1_3">申請中</label>
					<input id="st1_5" type="radio" class="st1" name="search_type" value="4" @if(Request::get('search_type')==4) checked @endif/>
					<label for="st1_5">終了</label>
					</div>
					</div>

    			<div><label>氏名：</label>
					<select id ="user" name="user"><option value="0">----</option>{{!!$userlist!!}}</select>
					</div>
    			</li>
    		</ul>

    	<div><button type="submit" name="mode" value="search">検索</button></div>
    	</form>
    	</fieldset>
    </div>
    <x-ruling-box :role="$user->role" type="振替" :records="$records"/>
<!--     <div class=""> -->
<!-- 		<table class="task_table sort-table"> -->
<!-- 			<thead> -->
<!-- 			<tr> -->
<!-- 				<th class="id" sortable>No</th> -->
<!-- 				<th>申請者</th> -->
<!-- 				<th class="id">申請日</th> -->
<!-- 				<th class="id">実施日</th> -->
<!-- 				<th class="id">開始時間</th> -->
<!-- 				<th class="id">終了時間</th> -->
<!-- 				<th class="s3">時間</th> -->
<!-- 				<th>案件状態</th> -->
<!-- 				<th class="id">申請/確認日</th> -->
<!-- 				<th class="auto">作業</th> -->
<!-- 				<th></th> -->

<!-- 			</tr> -->
<!-- 			</thead> -->
<!-- 			@if(isset($records)) -->
<!-- 			{{-- @foreach ($records as $record) --}} -->
<!-- 			@php -->
<!-- 			 $back = 0; -->
<!-- 			@endphp -->
<!-- 			@foreach ($records as $id =>$record) -->
<!-- 			@if($back!=$record->matters_id) -->
<!-- 			<tr class="d{{$id+1}}"> -->


<!-- 				<td><a href="/shinsei2/public/{{ $record->matters_id }}/rewrite_ov">{{ $record->matters_id}}</a></td> -->
<!-- 				<td>{{ $record->username}}</td> -->
<!-- 				<td>{{ date('n/j',strtotime($record->matter_request_date))}}</td> -->
<!-- 				<td>{{ date('n/j',strtotime($record->matter_change_date))}}</td> -->
<!-- 				<td>{{$record->hour1.":".$record->minutes1}}</td> -->
<!-- 				<td>{{$record->hour2.":".$record->minutes2}}</td> -->

<!-- 				<td>{{floor($record->allotted/60).'時間 '.($record->allotted%60).'分'}}</td> -->
<!-- 				<td>{{ $record->statusname}}</td> -->
<!-- 				<td>@if($record->status==2){{date('n/j',strtotime($record->matter_request_date))}}@elseif($record->status>=3){{date('n/j',strtotime($record->matter_reply_date))}}@endif</td> -->
<!-- 				<td>{{$record->allotted}}</td>
				<td><button class="show_ov" onclick="location.href='/shinsei2/public/{{ $record->matters_id }}/rewrite_ov'">詳細</button></td>
 				</tr> -->

<!-- 				@endif -->
<!-- 				@php -->
<!-- 					if($back!=$record->matters_id){ -->
<!-- 						$back =$record->matters_id; -->
<!-- 					}; -->
<!-- 				@endphp -->
<!-- 				@if($record->matter_id) -->
<!-- 				<tr> -->
<!-- 				<td></td> -->
<!-- 				<td></td> -->
<!-- 				<td>⇒</td> -->
<!-- 				<td>{{date('n/j',strtotime($record->task_change_date))}}</td> -->
<!-- 				<td>{{$record->task_hour1.":".$record->task_minutes1}}</td> -->
<!-- 				<td>{{$record->task_hour2.":".$record->task_minutes2}}</td> -->
<!-- 				<td>{{floor($record->task_allotted/60).'時間 '.($record->task_allotted%60).'分'}}</td> -->
<!-- 				@if($record->task_status==2) -->
<!-- 				<td>申請中</td><td>{{date('n/j',strtotime($record->task_request_date))}}</td> -->
<!-- 				@elseif($record->task_status>=3) -->
<!-- 				<td>確認済み</td><td>{{date('n/j',strtotime($record->task_reply_date))}}</td> -->
<!-- 				@else -->
<!-- 				<td></td><td></td> -->
<!-- 				@endif -->
<!-- 				<td>{{$record->task_total}}</td> -->
<!-- 				<td></td> -->
<!-- 				@endif -->



<!-- 			</tr> -->

<!-- 			@endforeach -->
<!-- 			@endif -->


<!-- 		</table> -->
<!-- 	</div> -->
</div>
<script>
$(function(){
var radio = $('div.radio-group');
$('input', radio).css({'opacity': '0'})
//checkedだったら最初からチェックする
.each(function(){
    if ($(this).attr('checked') == 'checked') {
        $(this).next().addClass('checked');
    }
});
//クリックした要素にクラス割り当てる
$('label', radio).click(function() {
    $(this).parent().parent().each(function() {
        $('label',this).removeClass('checked');
    });
    $(this).addClass('checked');
  ////  if($(this).parent().hasClass('index_select')){
    //	alert($('input[name="index50"]:checked').val());
    //    }
});



});
</script>
</x-app-layout>
