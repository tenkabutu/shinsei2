<x-print-layout>
<x-slot name="style">main_print</x-slot>
<x-slot name="head">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


</x-slot>
<!-- @php
($user);
@endphp -->
	<div class="">

			<table class="info_table">
			 <tr>
			 <th colspan="8" rowspan="2"><div><span class="print_h2">年次有給取得情報</span></div></th>
			 </tr>
			 <tr></tr>
			 <tr>
    <td></td>
    <th class="square_4_1"><label>職員番号</label></th>
    <td class="square_4_2" colspan="2">{{$user_rest->employee}}</td>
     <td></td>
    <th class="square_4_1" colspan="2">前年度残日</th>

    <td class="square_4_2">{{$user_rest->co_day+$user_rest->co_harf_rest*0.5}}</td>
  </tr>
  <tr>

    <td></td>
    <th class="square_4_3"><label>氏名</label></th>
    <td  class="square_4_4" colspan="2">{{$user_rest->name}}</td>
     <td></td>
    <th class="square_4_3" colspan="2">前年度残時間</th>
    <td class="square_4_4">{{$user_rest->co_time}}</td>


  </tr>
  <tr>
  	 <td colspan="5"></td>
  	 <th class="square_4_3" colspan="2">今年度付与日</th>
  	 <td class="square_4_4">{{$user_rest->rest_allotted_day}}</td>
  	 </tr>
  	 <tr><td>　</td><th class="square_4_1">勤務時間</th><td class="square_4_2" colspan="2">{{ $select_user->worktype->worktype }}</td><td></td><td></td><td></td><td></td></tr>
 <tr>
    <td></td>
    <th class="square_4_1"><label>備考</label></th>
    <td class="square_4_2" colspan="2"></td>
    <td></td>
    <th class="square_6_1">有給休暇</th>

@php
    // =============================
    // 1日の時間数
    // =============================
    $dayHours = in_array($select_user->worktype_id, [8,9]) ? 6 : 8;

    // =============================
    // 付与日数合計
    // =============================
    $uq = $user_rest->co_day
        + $user_rest->co_harf_rest * 0.5
        + $user_rest->rest_allotted_day;

    // =============================
    // 使用状況
    // =============================
    $usedDay   = optional($user)->rest_day ?? 0;
    $usedHalf  = optional($user)->harf_rest_day ?? 0;
    $usedTime  = (optional($user)->rest_time ?? 0) / 60; // 分→時間

    // =============================
    // 日残計算
    // =============================
    $overTime = $usedTime - $user_rest->co_time;

    $cutDays = $overTime > 0
        ? ceil($overTime / $dayHours)
        : 0;

    $remainDays = $uq
        - $usedDay
        - $usedHalf * 0.5
        - $cutDays;

    // =============================
    // 時間残計算
    // =============================
    if ($overTime <= 0) {
        // co_time内で収まっている
        $remainTime = $user_rest->co_time - $usedTime;
    } else {
        // 日を切り崩した後の残時間
        $remainTime = ($dayHours - ($overTime % $dayHours)) % $dayHours;
    }
@endphp

    <td class="square_6_2">{{$uq}}日</td>
    <td class="square_6_3">{{$user_rest->co_time}}時間</td>
</tr>

<tr>
    <td></td>
    <th><label>時間累計</label></th>
    <td></td><td>{{$usedTime}}</td>
    <td></td>
    <th class="square_6_4">有給残</th>
    <td class="square_6_5">{{$remainDays}}日</td>
    <td class="square_6_6">{{$remainTime}}時間</td>
</tr>
   <tr><th colspan="4">
   @if(isset($user->hiring_period))
   		{{$user_rest->rest_year}}年度
   		@if($month==0)

   			@if($select_user->hiring_period==0)
   				({{$year}}年4月1日～{{$year+1}}年3月31日)
   			@else
   				({{$year}}年10月1日～{{$year+1}}年9月30日)
   			@endif
   		@else
   			({{$year}}年{{$month}}月)
   		@endif
   @else
	該当なし
   	@if($month==0)

   	@if($select_user->hiring_period==0)
   		({{$year}}年4月1日～{{$year+1}}年3月31日)
   	@else
   		({{$year}}年10月1日～{{$year+1}}年9月30日)
   	@endif
   @else
   		({{$year}}年{{$month}}月)
   	@endif

   @endif

   	</th><td></td><td></td><td></td><td></td></tr>
</table>


<table class="total_table">
<thead>
<tr>
    <th class="id">ID</th>
    <th class="id">実施日</th>
    <th>取得日数</th>
    <th>取得時間数</th>
    <th class="id">累計日</th>
    <th>累計時間</th>
    <th>日残</th>
    <th>時間残</th>
</tr>
</thead>

@php
    // ■ 1日の基準時間
    $dayHours = in_array($select_user->worktype_id, [8,9]) ? 6 : 8;

    // ■ 付与日数
    $totalGrantDay = $user_rest->co_day
        + $user_rest->co_harf_rest * 0.5
        + $user_rest->rest_allotted_day;

    $remainDays = $totalGrantDay;
    $remainTime = $user_rest->co_time;

    // ■ 内部管理用
    $usedFullAndHalfDays = 0;   // 1日＋半休だけ管理
    $usedTimeHours       = 0;   // 時間休のみ管理

    // 32行固定
    $missingRecordsCount = max(0, 32 - count($records));
    $defaultRecord = (object)[
        'matters_id' => '',
        'matter_change_date' => '',
        'opt1' => '',
        'allotted' => 0
    ];

    for ($i = 0; $i < $missingRecordsCount; $i++) {
        $records[] = $defaultRecord;
    }
@endphp

@foreach ($records as $record)

@php
    // =========================
    // 使用処理
    // =========================

    if ($record->opt1 == 1) {

        // 1日休
        $usedFullAndHalfDays += 1;
        $remainDays -= 1;

    } elseif (in_array($record->opt1, [2,3,12])) {

        // 半休
        $usedFullAndHalfDays += 0.5;
        $remainDays -= 0.5;

    } elseif ($record->opt1 == 4) {

        // 時間休
        $useHour = $record->allotted / 60;

        $usedTimeHours += $useHour;
        $remainTime -= $useHour;

        // 残時間マイナスなら日を崩す（既存ロジック維持）
        while ($remainTime < 0) {
            $remainDays -= 1;
            $remainTime += $dayHours;
        }
    }

    // =========================
    // 表示用累計計算
    // =========================

    $displayDays =
        $usedFullAndHalfDays
        + floor($usedTimeHours / $dayHours);
    $displayRemainTime = $usedTimeHours % $dayHours;

@endphp

<tr>
<td>
@if($record->matters_id)
<a href="/shinsei2/public/{{ $record->matters_id }}/show_pa">
{{ $record->matters_id }}
</a>
@endif
</td>

<td>
@if($record->matter_change_date)
{{ date('n/j', strtotime($record->matter_change_date)) }}
@endif
</td>

{{-- 取得表示 --}}
@if($record->opt1==1)
<td>1</td><td></td>

@elseif(in_array($record->opt1,[2,3,12]))
<td>0.5</td><td></td>

@elseif($record->opt1==4)
<td></td>
<td>{{ floor($record->allotted/60) }}</td>

@else
<td></td><td></td>
@endif

{{-- 累計表示 --}}
@if($record->matters_id)
<td>{{ $usedFullAndHalfDays }}</td>
<td>{{ $usedTimeHours }}</td>
<td>{{ $remainDays }}</td>
<td>{{ $remainTime }}</td>
@else
<td></td><td></td><td></td><td></td>
@endif

</tr>
@endforeach
<tfoot>
        <tr>
            <td></td><td></td><td></td><td></td><td class="footer_border">{{$displayDays}}</td><td class="footer_border">{{ $displayRemainTime }}</td><td></td><td></td>
        </tr>
    </tfoot>
</table>


</div>
<div class="footer">
 {{$user_rest->employee}}
</div>
<script>
</script>
</x-print-layout>
