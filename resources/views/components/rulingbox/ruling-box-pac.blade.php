 <div class="">
		<table class="task_table sort-table">
			<thead>
			<tr>
				<th class="id" sortable>ID</th>
				<th>区分</th>
				<th>職番</th>
				<th>エリア</th>
				<th>申請者</th>
				<th class="id">実施日</th>
				@if(Request::get('matter_opt')==2)
					<th class="s3">欠勤日</th>
					<th class="s3">欠勤時</th>
				@else
					<th class="s3">有給日</th>
					<th class="s3">有給時</th>
				@endif
				<th class="s3">その他</th>
				<th class="id">承認</th>
				<th></th>
			</tr>
			</thead>
			@if(isset($records))
			@foreach ($records as $id =>$record)
			<tr class="d{{$id+1}}">


				<td><a href="/shinsei2/public/{{ $record->matters_id }}/show_pa">{{ $record->matters_id}}</a></td>
				<td>{{ $record->optname}}</td>
				<td>{{ $record->employee}}</td>
				<td>{{ $record->area}}</td>
				<td>{{ $record->username}}</td>
				<td>{{ date('n/j',strtotime($record->matter_change_date))}}</td>
				@if($record->opt1==1||$record->opt1==9)
				<td>1</td><td></td><td></td>
				@elseif($record->opt1==2||$record->opt1==3||$record->opt1==12)
				<td>0.5</td><td></td><td></td>
				@elseif($record->opt1==4||$record->opt1==10||$record->opt1==11)
				<td></td><td>{{floor($record->allotted/60)}}@if($record->allotted%60>0)時間{{$record->allotted%60}}分@endif</td><td></td>
				@elseif($record->opt1==5||$record->opt1==6)
				<td></td><td></td><td>1</td>
				@else
				<td></td><td></td><td></td>
				@endif
				<td>@if($record->status==3)○@endif</td>
				<td class="unselect"><input type="checkbox" class="end_check" @if($record->opt2==1)checked @endif data-number="{{$record->matters_id}}"></td>
				</tr>
			@endforeach
			@endif


		</table>
</div>
