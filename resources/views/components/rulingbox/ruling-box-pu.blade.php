 <div class="">
		<table class="task_table sort-table">
			<thead>
			<tr>
				<th class="id" sortable>ID</th>
				<th>区分</th>
				<th>UID</th>
				<th>エリア</th>
				<th>申請者</th>
				<th class="id">申請日</th>
				<th class="id">希望日</th>
				<th class="s3">品名</th>
				<th>案件状態</th>
				<th class="id">確認日</th>
				<th class="id">確認者</th>
				<th class="auto"></th>


			</tr>
			</thead>
			@if(isset($records))
			@foreach ($records as $id =>$record)
			<tr class="d{{$id+1}}">


				<td>{{ $record->matters_id}}</td>
				<td>{{ $record->optname}}</td>
				<td>{{ $record->employee}}</td>
				<td>{{ $record->area}}</td>
				<td>{{ $record->username}}</td>
				<td>{{ date('n/j',strtotime($record->matter_request_date))}}</td>
				<td>{{ date('n/j',strtotime($record->matter_change_date))}}</td>
				<td>{{ $record->matter_name}}</td>
				<td>{{ $record->statusname}}</td>
				<td>@if($record->status==2){{date('n/j',strtotime($record->matter_request_date))}}@elseif($record->status>=3){{date('n/j',strtotime($record->matter_reply_date))}}@endif</td>
				<td>{{ $record->username2}}</td>
				<td><button class="show_ov" onclick="location.href='/shinsei2/public/{{ $record->matters_id }}/show_pu'">詳細</button></td>
				</tr>
			@endforeach
			@endif


		</table>
	</div>