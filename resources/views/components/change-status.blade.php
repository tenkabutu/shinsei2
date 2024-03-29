
    <section>
			<h5>　申請状況</h5>
			<fieldset>

				<div>
					<div class="g12"><label>{{$typename}}時間</label></div>
					<div class="g23 text_right">{{substr($matter->matter_change_date,0,10).":".intdiv($matter->allotted,60)."時間".($matter->allotted%60)."分"}}</div>
				</div>
				<div>
					<div class="g12"><label>{{$typename}}申請</label></div>
					<div class="g23 text_right">
					@if($matter->status==1)未申請
					@elseif($matter->status==2)申請中({{$matter->matter_request_date->format('Y/m/d')}})
					@elseif($matter->status==3)許可済み({{$matter->matter_reply_date->format('Y/m/d')}})
					@elseif($matter->status==5)修正待ち({{$matter->matter_reply_date->format('Y/m/d')}})
					@elseif($matter->status==6)削除済み({{$matter->matter_request_date->format('Y/m/d')}})
					@elseif($matter->status==7)購入済み({{$matter->matter_reply_date->format('Y/m/d')}})
					@endif</div>
				</div>
			</fieldset>
		</section>
	<!-- 	<section>
			<fieldset>
			@foreach ($matter->tasklist as $task)
				<div>
					<div class="g12"><label>振替休暇時間1</label></div>
					<div class="g23 text_right">{{substr($task->task_change_date,0,10).":".intdiv($task->task_allotted,60)."時間".($task->task_allotted%60)."分"}}</div>
				</div>
				<div>
					<div class="g12"><label>振替休暇申請1</label></div>
					<div class="g23 text_right">
					@if($task->status==1)未申請
					@elseif($task->task_status==2)申請中({{$task->task_request_date}})
					@elseif($task->task_status==3)許可済み({{$task->task_reply_date}})
					@endif</div>
				</div>

				@endforeach
			</fieldset>
			<p>申請中・申請後に設定時間を変更すると再度申請が必要になります。</p>
		</section> -->
