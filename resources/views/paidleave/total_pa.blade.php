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
				<th colspan="3">有給</th>
				<th colspan="2">取得有給</th>
				<th colspan="2">残有給</th>
				<th>5日</th>
				<th></th>
				<th></th>
			</tr>
			</thead>
			@foreach ($userlist as $id => $record)

@php
$rest = $record->rest;

if (!$rest) {
    $rowClass = 'uq_none';
} else {

    /* ============================
       基本設定
    ============================ */
    $dayHours = in_array($record->worktype_id, [8,9]) ? 6 : 8;

    /* ============================
       ① 付与有給
    ============================ */

    $grantDays =
        (float)$rest->co_day +
        ((float)$rest->co_harf_rest * 0.5) +
        (float)$rest->rest_allotted_day;

    $grantHours = (float)($rest->co_time ?? 0);



    /* ============================
       ② 取得有給
    ============================ */

    $usedDays =
        (float)$record->rest_day +
        ((float)$record->harf_rest_day * 0.5);

    $usedHours = (float)$record->rest_time / 60;

    if ($usedHours >= $dayHours) {
        $usedDays += floor($usedHours / $dayHours);
        $usedHours %= $dayHours;
    }

    /* ============================
       ③ 残有給
    ============================ */

    $remainDays  = $grantDays - $usedDays;
    $remainHours = $grantHours - $usedHours;

    if ($remainHours < 0) {
        $remainDays -= 1;
        $remainHours += $dayHours;
    }

    /* ============================
       ④ 行クラス判定
    ============================ */

    if ($remainDays == 0 && $remainHours == 0) {
        $rowClass = 'uq_just';
    } elseif ($remainDays < 0) {
        $rowClass = 'uq_alert';
    } else {
        $rowClass = '';
    }

    /* ============================
       ⑤ 5日取得判定
    ============================ */

    $usedTotalDays = $usedDays + ($usedHours / $dayHours);
}
@endphp

<tr class="d{{ $id+1 }} {{ $rowClass }}">
<td>{{ $record->employee }}</td>
<td>{{ $record->name }}</td>

@if($rest)

<td>{{ $rest->rest_year }}</td>

{{-- 付与 --}}
<td>{{ $grantDays }}日</td>
<td>{{ $grantHours }}時間</td>

{{-- 取得 --}}
<td>{{ $usedDays }}日</td>
<td>{{ $usedHours }}時間</td>

{{-- 残 --}}
<td>{{ $remainDays }}日</td>
<td>{{ $remainHours }}時間</td>

{{-- 5日取得 --}}
<td>
@if($usedTotalDays >= 5)
◯
@endif
</td>

<td>
@if($record->hiring_period==0)
4月～
@else
10月～
@endif
</td>

<td>
<input type="button" value="印刷" id="{{ $record->id }}">
</td>

@else
<td colspan="9"></td><td></td>
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
    if ((year === currentYear && currentMonth >= 4) || (year === currentYear - 1 && currentMonth <= 3)) {
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
