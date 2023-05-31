 <div class="">
		<table class="task_table sort-table">
			<thead>
			<tr>
				<th class="id" sortable>ID</th>
					<th>職番</th>
					<th>エリア</th>
				<th>申請者</th>
				<th class="id">実施日</th>
				<th class="id">開始時刻</th>
				<th class="id">終了時刻</th>
				<th class="s3">時間</th>
				<th class="id">承認</th>



			</tr>
			</thead>
			@if(isset($records))
			@foreach ($records as $id =>$record)
			<tr class="d{{$id+1}}">


				<td><a href="/shinsei2/public/{{ $record->matters_id }}/show_te">{{ $record->matters_id}}</a></td>
				<td>{{ $record->employee}}</td>
				<td>{{ $record->area}}</td>
				<td>{{ $record->username}}</td>
				<td>{{ date('n/j',strtotime($record->matter_change_date))}}</td>
				<td>{{$record->hour1."時".$record->minutes1}}分</td>
				<td>{{$record->hour2."時".$record->minutes2}}分</td>
				<td>{{floor($record->allotted/60).'時間 '.($record->allotted%60).'分'}}</td>
				<td>@if($record->status==3)○@endif</td>
				</tr>
			@endforeach
			@endif


		</table>
	</div>