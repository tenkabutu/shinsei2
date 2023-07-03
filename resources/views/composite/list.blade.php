<x-app-layout>
	<x-slot name="style"></x-slot>
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
    		<ul>

    			<li><div>日時　：<select id="year" name="year"><option value="2023">2023</option><option value="2022">2022</option></select>年
					<select id="month" name="month"><option value="0">--</option></select>月
					</div>
					<div><label>状態：</label>
					 <div class="radio-group">
					<input id="st1_1" type="radio" class="st1" name="search_type" value="1" @if(Request::get('search_type')==1) checked @elseif(isset($search_type)) checked @endif />
					<label for="st1_1">全件</label>
					<input id="st1_2" type="radio" class="st1" name="search_type" value="2" @if(Request::get('search_type')==2) checked @endif/>
					<label for="st1_2">未申請</label>
					<input id="st1_3" type="radio" class="st1" name="search_type" value="3" @if(Request::get('search_type')==3) checked @endif/>
					<label for="st1_3">申請中</label>
					<input id="st1_4" type="radio" class="st1" name="search_type" value="4" @if(Request::get('search_type')==4) checked @endif/>
					<label for="st1_4">終了</label>

					</div>
					</div>

    			</li>
    		</ul>

    	<div><button type="submit" name="mode" value="search">検索</button></div>
    	</form>
    	</fieldset>
    </div>
    <div class="">
		<table class="task_table sort-table">
			<thead>
			<tr>
				<th class="id" sortable>No</th>
				<th class="id">種類</th>
				<th class="id">実施日</th>
				<th>開始時間</th>
				<th class="id">終了時間</th>
				<th class="s3">時間</th>
				<th>案件状態</th>
				<th>申請・確認日</th>

				<th class="id">確認者</th>


			</tr>
			</thead>
			@if(isset($records))
			{{-- @foreach ($records as $record) --}}
			@php
			 $back = 0;
			@endphp
			@foreach ($records as $id =>$record)
			@if($back!=$record->matters_id)
			<tr class="d{{$id+1}}">
				<td><a href="/shinsei2/public/{{ $record->matters_id }}/
				@if($record->matter_type==1)
				rewrite_ov
				@elseif($record->matter_type==2)
				show_pa
				@else
				show_te
				@endif

				">{{ $record->matters_id}}</a></td>


				<td>@isset($record->typename) {{$record->typename}} @else テレワ @endif</td>
				<td>{{ date('n/j',strtotime($record->matter_change_date))}}</td>
				<td>{{$record->hour1."時".$record->minutes1}}分</td>
				<td>{{$record->hour2."時".$record->minutes2}}分</td>
				<td>{{floor($record->allotted/60).'時間 '.($record->allotted%60).'分'}}</td>

				@if($record->status==5)<td class="text-danger">@else<td>@endif{{ $record->statusname}}</td>
				<td>@if($record->status==2){{$record->matter_request_date}}@elseif($record->status>=3){{$record->matter_reply_date}}@endif</td>

				<td>{{ $record->username2}}</td>



			</tr>
			@endif
				@php
					if($back!=$record->matters_id){
						$back =$record->matters_id;
					};
				@endphp
				@if($record->matter_id)
				<tr>
				<td colspan="1"></td>

				<td>⇒</td>
				<td>{{date('n/j',strtotime($record->task_change_date))}}</td>
				<td>{{$record->task_hour1."時".$record->task_minutes1}}分</td>
				<td>{{$record->task_hour2."時".$record->task_minutes2}}分</td>
				<td>{{floor($record->task_allotted/60).'時間 '.($record->task_allotted%60).'分'}}</td>
				@if($record->task_status==2)
				<td>申請中</td><td>{{date('n/j',strtotime($record->task_request_date))}}</td>
				@elseif($record->task_status>=3)
				<td>許可済</td><td>{{date('n/j',strtotime($record->task_reply_date))}}</td>
				@else
				<td></td><td></td>
				@endif
				<td>{{$record->task_total}}</td>
				<td></td>
				@endif



			</tr>

			@endforeach
			@endif
		</table>
	</div>
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
$('input[name="index50"]').change(function() {
	var val1 = $('input[name="index50"]:checked').val();
	var val2= $('input[name="schooltype"]:checked').val();


	if(val2=="小学校"||val2=="中学校"){

		$('select[name="index_select"]').find('option').each(function() {
      var val3 = $(this).attr("class");
      var val4 = $(this).data("val");
      if (val1 == val3&&val2==val4) {
        $(this).show();
      }else{
        $(this).hide();
      }
    	});
	}else{
		$('select[name="index_select"]').find('option').each(function() {
	          var val3 = $(this).attr("class");
	          var val4 = $(this).data("val");
	          if (val1 == val3) {
	            $(this).show();
	          }else{
	            $(this).hide();
	          }
	        	});

    	}
});
for (var i = 1; i <= 12; i++) {
    $('#month').append('<option value="' + i + '">' + i + '</option>');
}
for (var i = 1; i <= 31; i++) {
    $('#day').append('<option value="' + i + '">' + i + '</option>');
}
});
</script>
</x-app-layout>
