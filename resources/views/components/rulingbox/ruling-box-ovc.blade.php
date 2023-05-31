 <div class="">
		<table class="task_table sort-table">
			<thead>
			<tr>
				<th class="id" sortable>No</th>
				<th>区分</th>
				<th>職番</th>
				<th>エリア</th>
				<th>氏名</th>
				<th class="id">実施日</th>
				<th class="s3">開始時間</th>
				<th class="s3">終了時間</th>
				<th class="id">時</th>
				<th class="id">承認</th>


			</tr>
			</thead>
			@if(isset($records))

			@php
			 $back = 0;
			@endphp
			@foreach ($records as $id =>$record)
			@if($back!=$record->matters_id)
			<tr class="d{{$id+1}}">


				<td><a href="/shinsei2/public/{{ $record->matters_id }}/rewrite_ov">{{ $record->matters_id}}</a></td>
				<td>{{ $record->optname}}</td>
				<td>{{ $record->employee}}</td>
				<td>{{ $record->area}}</td>
				<td>{{ $record->username}}</td>
				<td>{{ date('n/j',strtotime($record->matter_change_date))}}</td>
			<td>{{$record->hour1.":".$record->minutes1}}</td>
				<td>{{$record->hour2.":".$record->minutes2}}</td>

				<td>{{floor($record->allotted/60)}}@if($record->allotted%60>0)時間{{$record->allotted%60}}分@endif</td>
				<td>@if($record->status==3)○@endif</td>
				</tr>

				@endif
				@php
					if($back!=$record->matters_id){
						$back =$record->matters_id;
					};
				@endphp
				@if($record->matter_id&&$record->opt1==7)
				<tr>
				<td>{{ $record->matters_id}}</td>
				<td>⇒</td>

				<td>{{ $record->employee}}</td>
				<td></td>

				<td></td>
				<td>{{date('n/j',strtotime($record->task_change_date))}}</td>
				<td>{{$record->task_hour1.":".$record->task_minutes1}}</td>
				<td>{{$record->task_hour2.":".$record->task_minutes2}}</td>
				<td>{{floor($record->task_allotted/60)}}@if($record->task_allotted%60>0)時間{{$record->task_allotted%60}}分@endif</td>
				@if($record->task_status==2)
				<td></td>
				@elseif($record->task_status>=3)
				<td>○</td>
				@else
				<td></td>
				@endif


				@endif



			</tr>

			@endforeach
			@endif


		</table>
	</div>