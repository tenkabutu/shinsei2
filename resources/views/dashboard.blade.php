<x-app-layout>
	<x-slot name="style"></x-slot>
    <x-slot name="head">

    </x-slot>

    <div class="main_right">
    <h3>トップページ</h3>
     <fieldset>
				<legend>info</legend>
				<ul>
					<li>・振替は許可済みであっても、作業時間と振替先の作業時間が一致しないと完了扱いになりません</li>
						<li>・リーダーの承認機能で、再提出ボタンがありますが未実装です。</li>
				</ul>
				</fieldset>
				<fieldset>
				<legend>update</legend>
				<ul>
					<li>・持ち越し分を計算するようにしました、また消滅する可能性がある日数を表示しました。</li>
					<li>・勤務テレワ申請で修正が反映されなくなっていた不具合を修正</li>
					<li>・勤務テレワ申請で保存機能を削除</li></ul>
				</fieldset>
				 <fieldset>
					<legend>改修予定</legend>
					<ul>
						<li>・入力エラーがでたときに入力欄の情報を保持する</li>
						<li>・この画面には直近の貸出予定と休暇予定などを記載する予定</li>
						<li>・一覧画面で半休かどうかや、エリアの表示を行う予定</li>
						<li>・休暇申請の未申請状態を削除し、保存＝申請に変更</li>
					</ul>
				</fieldset>
				 <fieldset>
					<legend>不具合</legend>
					<ul>

						<li>・気づいた点があればサイボウズなどでご連絡ください。</li>
					</ul>
				</fieldset>

	    		<fieldset>
				<legend>未振替</legend>
				<ul><li>
				<table class="task_table sort-table">
			<thead>
			<tr>
				<th class="id" sortable>No</th>
				<th>申請者</th>
				<th class="id">申請日</th>
				<th class="id">実施日</th>
				<th class="id">開始時間</th>
				<th class="id">終了時間</th>
				<th class="s3">時間</th>
				<th>案件状態</th>
				<th class="id">申請/確認日</th>
				<th class="auto">作業</th>
				<th></th>

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
				<td>{{ $record->username}}</td>
				<td>{{ date('n/j',strtotime($record->matter_request_date))}}</td>
				<td>{{ date('n/j',strtotime($record->matter_change_date))}}</td>
				<td>{{$record->hour1.":".$record->minutes1}}</td>
				<td>{{$record->hour2.":".$record->minutes2}}</td>

				<td>{{floor($record->allotted/60).'時間 '.($record->allotted%60).'分'}}</td>
				<td>{{ $record->statusname}}</td>
				<td>@if($record->status==2){{date('n/j',strtotime($record->matter_request_date))}}@elseif($record->status>=3){{date('n/j',strtotime($record->matter_reply_date))}}@endif</td>
				<td>{{$record->allotted}}</td>
				<td><button class="show_ov" onclick="location.href='/shinsei2/public/{{ $record->matters_id }}/rewrite_ov'">詳細</button></td>
				</tr>

				@endif
				@php
					if($back!=$record->matters_id){
						$back =$record->matters_id;
					};
				@endphp
				@if($record->matter_id)
				<tr>
				<td></td>
				<td></td>
				<td>⇒</td>
				<td>{{date('n/j',strtotime($record->task_change_date))}}</td>
				<td>{{$record->task_hour1.":".$record->task_minutes1}}</td>
				<td>{{$record->task_hour2.":".$record->task_minutes2}}</td>
				<td>{{floor($record->task_allotted/60).'時間 '.($record->task_allotted%60).'分'}}</td>
				@if($record->task_status==2)
				<td>申請中</td><td>{{date('n/j',strtotime($record->task_request_date))}}</td>
				@elseif($record->task_status>=3)
				<td>確認済み</td><td>{{date('n/j',strtotime($record->task_reply_date))}}</td>
				@else
				<td></td><td></td>
				@endif
				<td>{{$record->task_total}}</td>
				<td></td>
				@endif



			</tr>

			@endforeach
			@endif


		</table></li>
				</ul>
				</fieldset>



    </div>
</x-app-layout>
