<x-print-layout>
<x-slot name="style">main_print</x-slot>
<x-slot name="head">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


</x-slot>


	<div class="">

			<table class="info_table">
			 <tr>
			 <th colspan="8" rowspan="2"><div><span class="print_h2">年次有給取得情報</span></div></th>
			 </tr>
			 <tr></tr>
			 <tr>
    <td></td>
    <th class="square_4_1"><label>職員番号</label></th>
    <td class="square_4_2" colspan="2">{{$user->employee}}</td>
     <td></td>
    <th class="square_4_1" colspan="2">前年度残日</th>

    <td class="square_4_2">{{$user->rest->co_day+$user->rest->co_harf_rest*0.5}}</td>
  </tr>
  <tr>

    <td></td>
    <th class="square_4_3"><label>氏名</label></th>
    <td  class="square_4_4" colspan="2">{{$user->name}}</td>
     <td></td>
    <th class="square_4_3" colspan="2">前年度残時間</th>
    <td class="square_4_4">{{$user->rest->co_time}}</td>


  </tr>
  <tr>
  	 <td colspan="5"></td>
  	 <th class="square_4_3" colspan="2">今年度付与日</th>
  	 <td class="square_4_4">{{$user->rest->rest_allotted_day}}</td>
  	 </tr>
  	 <tr><td>　</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
  <tr>

    <td></td>
    <th class="square_4_1"><label>備考</label></th>
    <td class="square_4_2" colspan="2"></td>
    <td></td>
    <th class="square_6_1">有給休暇</th>
    @php
    	$uq = $user->rest->co_day+$user->rest->co_harf_rest*0.5+$user->rest->rest_allotted_day;
    @endphp
    <td class="square_6_2">{{$uq}}日</td>
    <td class="square_6_3">{{$user->rest->co_time}}時間</td>
  </tr>
  <tr>

    <td></td>
    <th><label>時間累計</label></th>
    <td colspan="2">{{$user->rest_time/60}}</td>
     <td></td>
    <th class="square_6_4">有給残</th>
    <td class="square_6_5">{{$uq-$user->harf_rest_day*0.5-$user->rest_day-floor(($user->rest_time/60+$user->co_time)/8)}}日</td>
    <td class="square_6_6">{{(8-($user->rest_time/60-$user->rest->co_time)%8)%8}}時間</td>
  </tr>
   <tr><td>{{$user->rest->rest_year}}年度</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
</table>


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

  $missingRecordsCount = max(0, 32 - count($records));
  $defaultRecord = (object) [
    'matters_id' => '',
    'matter_change_date' => '',
    'opt1' => '',
    'allotted' => 0
  ];
  $lap_rest_time =0; ;
  $lap_rest_day = 0;
  $residue_rest_time = $user->rest->co_time;

  for ($i = 0; $i < $missingRecordsCount; $i++) {
    $records[] = $defaultRecord;
  }
@endphp
			@if(isset($records))
			@foreach ($records as $id =>$record)
			<!-- 時間給のときだけ積み上げ-->
				@if($record->opt1==4)
					@php
                        $lap_rest_time += $record->allotted;
                        if($lap_rest_time>479){
                        	$lap_rest_time=$lap_rest_time-480;
                        	$lap_rest_day+=1;
                        }
                        $residue_rest_time=$residue_rest_time-$record->allotted/60;
                        if($residue_rest_time<0){
                        	$residue_rest_time=$residue_rest_time+8;
                        }
                    @endphp
                @elseif($record->opt1==1)
                	@php
                        	$lap_rest_day+=1;
                    @endphp

                @elseif($record->opt1==2||$record->opt1==3)
                	@php
                        	$lap_rest_day+=0.5;
                    @endphp

                @endif
			<tr class="d{{$id+1}}">


				<td><a href="/shinsei2/public/{{ $record->matters_id }}/show_pa">{{ $record->matters_id}}</a></td>
				<td>@if($record->matter_change_date)
						{{ date('n/j', strtotime($record->matter_change_date)) }}
					@endif</td>
				@if($record->opt1==1)
				<td>1</td><td></td>
				@elseif($record->opt1==2||$record->opt1==3)
				<td>0.5</td><td></td>
				@elseif($record->opt1==4)
				<td></td><td>{{floor($record->allotted/60)}}@if($record->allotted%60>0)時間{{$record->allotted%60}}分@endif</td>
				@else
				<td></td><td></td>
				@endif
				@if($record->matters_id)
				<td>@if($record->matters_id){{$lap_rest_day}}@endif</td>
				<td>@if($record->matters_id){{$lap_rest_time}}@endif</td>
				<td>{{$user->rest->co_day+$user->rest->co_harf_rest*0.5+$user->rest->rest_allotted_day-$lap_rest_day}}</td>
				<td>{{$residue_rest_time}}</td>
				@else
					<td></td><td></td><td></td><td></td>
				@endif

				</tr>
			@endforeach
			@endif
		</table>


</div>

<script>
</script>
</x-print-layout>
