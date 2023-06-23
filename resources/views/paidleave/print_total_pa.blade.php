<x-print-layout>
<x-slot name="style">main_print</x-slot>
@section('reception_id', $user->id) <x-slot name="head">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


</x-slot>


	<div class="">

			<table class="info_table">
			 <tr>
    <td></td>
    <th class="square_4_1"><label>職員番号</label></th>
    <td class="square_4_2" colspan="2">{{$user->id}}</td>
     <td></td>
    <th class="square_4_1" colspan="2">前年度残日</th>

    <td class="square_4_2"></td>
  </tr>
  <tr>

    <td></td>
    <th class="square_4_3"><label>氏名</label></th>
    <td  class="square_4_4" colspan="2">{{$user->name}}</td>
     <td></td>
    <th class="square_4_3" colspan="2">前年度残時間</th>
    <td class="square_4_4"></td>


  </tr>
  <tr>
  	 <td colspan="5"></td>
  	 <th class="square_4_3" colspan="2">今年度付与日</th>
  	 <td class="square_4_4"></td>
  	 </tr>
  	 <tr><td>　</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
  <tr>

    <td></td>
    <th class="square_4_1"><label>備考</label></th>
    <td class="square_4_2" colspan="2"></td>
    <td></td>
    <th class="square_6_1">有給休暇</th>
    <td class="square_6_2">日</td>
    <td class="square_6_3">時間</td>
  </tr>
  <tr>

    <td></td>
    <th><label>時間累計</label></th>
    <td colspan="2"></td>
     <td></td>
    <th class="square_6_4">有給残</th>
    <td class="square_6_5">日</td>
    <td class="square_6_6">時間</td>
  </tr>
   <tr><td>　</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
</table>
			<!-- <div class="grid_wrap2" id="grid_reception">
				<div class="g23 gr12 square_4_1">
						<label>職員番号</label>
				</div>
				<div class="g35 gr12 square_4_2">
						{{$user->id}}
				</div>
				<div class="g67 gr12">前年度残日</div>
				<div class="g79 gr12"></div>
				<div class="g23 gr23 square_4_3">
						<label>氏名</label>
				</div>
				<div class="g35 gr23 square_4_4">
						{{$user->name}}
				</div>
				<div class="g67 gr23">前年度残時間</div>
				<div class="g79 gr23"></div>
				<div class="g67 gr34">今年度付与日</div>
				<div class="g79 gr34"></div>

				<div class="g23 gr56 middle_label2">
						<label>備考</label>
				</div>
				<div class="g35 gr56">
				</div>
				<div class="g67 gr56">有給休暇</div>
				<div class="g78 gr56">日</div>
				<div class="g89 gr56">時間</div>
				<div class="g23 gr67 middle_label2">
						<label>時間累計</label>
				</div>
				<div class="g35 gr67">
				</div>
				<div class="g67 gr67">有給残</div>
				<div class="g78 gr67">日</div>
				<div class="g89 gr67">時間</div>


			</div> -->

			<table class="total_table">
			<thead>
			<tr>
				<th class="id" sortable>ID</th>
				<th class="id">実施日</th>

				<th>取得日数</th>
				<th>取得時間数</th>

				<th class="id">累計日</th>
				<th>時間</th>
				<th>日残</th>
				<th>時間残</th>

			</tr>
			</thead>
			@php

  $missingRecordsCount = max(0, 34 - count($records));
  $defaultRecord = (object) [
    'matters_id' => '',
    'matter_change_date' => '',
    'opt1' => '',
    'allotted' => ''
  ];

  for ($i = 0; $i < $missingRecordsCount; $i++) {
    $records[] = $defaultRecord;
  }
@endphp
			@if(isset($records))
			@foreach ($records as $id =>$record)
			<tr class="d{{$id+1}}">


				<td><a href="/shinsei2/public/{{ $record->matters_id }}/show_pa">{{ $record->matters_id}}</a></td>
				<td>@if($record->matter_change_date)
						{{ date('n/j', strtotime($record->matter_change_date)) }}
					@endif</td>
				@if($record->opt1==1)
				<td>1</td><td></td><td></td>
				@elseif($record->opt1==2||$record->opt1==3)
				<td>0.5</td><td></td><td></td>
				@elseif($record->opt1==4)
				<td></td><td>{{floor($record->allotted/60)}}@if($record->allotted%60>0)時間{{$record->allotted%60}}分@endif</td><td></td>
				@elseif($record->opt1==5||$record->opt1==6)
				<td></td><td></td><td>1</td>
				@else
				<td></td><td></td><td></td>
				@endif
				<td></td>
				<td></td><td></td>
				</tr>
			@endforeach
			@endif
		</table>


</div>

<script>
</script>
</x-print-layout>
