<x-app-layout>
<x-slot name="style"></x-slot>
<x-slot name="head">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src='./js/jquery.tablesorter.js'></script>
<script>
$(document).ready(function(){
	$('.sort-table').tablesorter({
		headers: {
			6: { sorter: false }
		}
		});
});
</script>
</x-slot>

<div class="main_right">
	<div class="">
		<h2>年休取得状況一覧</h2>
	<fieldset id="print_set">
		<legend>印刷時年月設定</legend>
	<select id="yearSelect">
  <!-- 年の選択肢はJavaScriptで生成されます -->
</select>

<select id="monthSelect">
  <!-- 月の選択肢はJavaScriptで生成されます -->
</select>
</fieldset>
		<label class="success_label"></label>
		<table class="user_table  sort-table">
			<thead>
			<tr>
				<th>No</th>
				<th>使用者</th>
				<th colspan="2">今年度有給</th>
				<th colspan="2">取得有給</th>
				<th colspan="2">残有給</th>
				<th>5日</th>
				<th></th>
			</tr>
			</thead>
			{{-- @foreach ($userlist as $record) --}}
			@foreach ($userlist as $id =>$record)

			@php

        		$uq = $record->rest ? $record->rest->co_day+$record->rest->co_harf_rest*0.5+$record->rest->rest_allotted_day :'';
        		$ruq=$record->harf_rest_day*0.5+$record->rest_day+ceil(($record->rest_time/60-optional($record->rest)->co_time)/8);
   			@endphp
			<tr class="d{{$id+1}}">
				<td>{{ $record->employee}}</td>
				<td>{{ $record->name}}</td>
				<td>{{$uq}}日</td>
				<td>{{optional($record->rest)->co_time}}時間</td>
				<td>{{$ruq}}日</td>
				<td>{{$record->rest_time/60%8}}時間</td>

				<td>@if(is_numeric($uq) && is_numeric($ruq))
					{{ $uq - $ruq }}日
					@endif</td>
				 @if(isset($record->rest))
				<td>{{(8-($record->rest_time/60-optional($record->rest)->co_time)%8)%8}}時間</td>
				<td>@if($ruq>=5)
				◯
				@endif</td>
				<td><input type="button" value="印刷" id='{{$record->id}}' ></td>

				  @else
				  <td></td><td></td><td></td>
				  @endif


			</tr>
			@endforeach
		</table>
	</div>
</div>
<script>
$(document).ready(function() {
	  // セレクトボックスの初期化
	  initializeSelectBoxes();

	  // セレクトボックスの変更イベント
	  $('#yearSelect, #monthSelect').on('change', function() {
	    updateSelectBoxes();
	  });

	  // 印刷ボタンのクリックイベント
	  $('input[type="button"]').on('click', function() {
	    var printButtonId = $(this).attr('id');
	    var year = $('#yearSelect').val();
	    var month = $('#monthSelect').val();
	    var url = printButtonId + '/print_total_pa/' + year + '/' + month;
	    location.href = url;
	  });
	});

function initializeSelectBoxes() {
	  var currentYear = new Date().getFullYear();
	  var currentMonth = new Date().getMonth() + 1;
	  var yearSelect = $('#yearSelect');
	  var monthSelect = $('#monthSelect');

	  // 年のセレクトボックスの初期化
	  for (var year = currentYear; year >= 2022; year--) {
	    var option = $('<option>').val(year).text(year);
	    if (year === currentYear) {
	      option.prop('selected', true);
	    }
	    yearSelect.append(option);
	  }

	  // 月のセレクトボックスの初期化
	  var option = $('<option>').val(0).text('---');
  		monthSelect.append(option);
	  updateSelectBoxes();
	}

	function updateSelectBoxes() {
	  var currentYear = new Date().getFullYear();
	  var currentMonth = new Date().getMonth() + 1;
	  var selectedYear = parseInt($('#yearSelect').val());
	  var selectedMonth = parseInt($('#monthSelect').val());
	  var monthSelect = $('#monthSelect');

	  // 月のセレクトボックスの更新
	  monthSelect.empty();
	  var option = $('<option>').val(0).text('---');
	  monthSelect.append(option);
	  for (var month = 12; month >= 1; month--) {
	    if (selectedYear === currentYear && month > currentMonth) {
	      continue; // 未来の月はスキップ
	    }
	    var option = $('<option>').val(month).text(month);
	    if (month === selectedMonth) {
	      option.prop('selected', true);
	    }
	    monthSelect.append(option);
	  }
	}
</script>
</x-app-layout>
