
@foreach ($tasklist as $task)
<div class="task_form" data-repeater-item>
	@isset($task->id)
	<input type="hidden" name="id" value="{{$task->id}}">
	<input type="hidden" name="task_status" value="{{$task->task_status}}">
	@endisset

	<div class="grid">
		<label class="g12">振替予定日3</label>
		<input type="text" class="g23 target2" name='task_change_date' autocomplete="off" value="@isset($task->task_change_date){{$task->task_change_date}} @endisset">
	</div>

	<div class="grid">
		<label class="g12">開始時間</label>
		<div class="g23">
			<input type="number" name="task_hour1" class="task_hour1" value="@isset($task->task_hour1){{$task->task_hour1}} @endisset" autocomplete="off">
			<input type="number" name="task_minutes1" class="task_minutes1" value="@isset($task->task_minutes1){{$task->task_minutes1}} @endisset" autocomplete="off">
		</div>
		<label class="g34">終了時間</label>
		<div class="g45">
			<input type="number" name="task_hour2" class="task_hour2" value="@isset($task->task_hour2){{$task->task_hour2}} @endisset" autocomplete="off">
			<input type="number" name="task_minutes2" class="task_minutes2" value="@isset($task->task_minutes2){{$task->task_minutes2}} @endisset" autocomplete="off">
		</div>

		<label class="g56">休憩時間</label>
		<div class="g67">
			<input type="number" class="task_break" name="task_breaktime" value="0" min="0" max="60" value="@isset($task->task_breaktime){{$task->task_breaktime}} @endisset" autocomplete="off">
		</div>
	</div>
	<div class="grid">
		<label class="g12">振替時間</label>
		<label class="task_hour3 g34">@isset($task->task_allotted){{intdiv($task->task_allotted,60)}}時間  @endisset</label> <label class="task_minutes3 g45">@isset($task->task_allotted){{$task->task_allotted%60}}分 @endisset</label>
		<input type="hidden" name="task_allotted" value="@isset($task->task_allotted){{$task->task_allotted}} @endisset">

	</div>
</div>

@endforeach
