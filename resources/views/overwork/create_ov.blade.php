<x-app-layout>
<x-slot name="style"></x-slot>
<x-slot name="head">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="/shinsei2/public/js/jquery.datetimepicker.full.min.js"></script>
	<script src="/shinsei2/public/js/jquery-ui.min.js"></script>
	<script src='/shinsei2/public/js/jquery.repeater.js'></script>
	<script>
	$(document).ready(function() {
	   $.datetimepicker.setLocale('ja');
	   $('.target').datetimepicker({  scrollMonth : false,
		    scrollInput : false}).datepicker('setDate','today');

	  $('.target2').datetimepicker({
		  scrollMonth : false,
		  scrollInput : false,
		  timepicker:false,
	      format:'Y/n/j'
		});
	  $('.target3').datetimepicker({
		  scrollMonth : false,
		  scrollInput : false,
		  format:'h:m'
		});
	});
	</script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
</x-slot>

<div class="main_right">
	<div id="shinsei_wrap">

		@if(isset($matter->status))
		<h3>振替申請<label>　(作成:{{$matter->created_at->format('Y/n/j')}}　更新:{{$matter->updated_at->format('Y/n/j')}})</label></h3>

			<x-change-status :matter="$matter" :type="1"/>
			<ul>
				@foreach($errors->all() as $err)
				<li class="text-danger">{{ $err }}</li>
				@endforeach
			</ul>
		<x-user-box :userdata="$user" :checker="$check_userlist" :mcheck="1"/>
		@else
		<h3>新規振替申請</h3>
		<ul>
				@foreach($errors->all() as $err)
				<li class="text-danger">{{ $err }}</li>
				@endforeach
			</ul>
		<x-user-box :userdata="$user" :checker="$check_userlist"  :mcheck="2"/>
		@endif

		<form  method="post" action="save_ov" class="repeater"  >
			@csrf
			@if (session('save_check'))
    	<div class="alert text-danger">{{ session('save_check') }}</div>
		<x-save-box :status="$matter->status" :role="0" :type="1"/>
		@endif
			@if (session('save_check2'))
    	<div class="alert text-danger">{{ session('save_check2') }}</div>
		<x-save-box :status="$matter->status" :role="0" :type="1"/>
		@endif
			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			<input type="hidden" name="matter_type" value="1">

			<!-- onsubmit="return false;"  -->
			@if(isset($matter))
				<input type="hidden" name="allotted" value="{{old('allotted',$matter->allotted)}}">
				@if (session('save_check'))
				<input type="hidden" name="change_check" value="1">
				@else
				<input type="hidden" name="change_check" value="{{old('change_check',$matter->status)}}">
				@endif

				@if (session('save_check2'))
				<input type="hidden" name="change_check2" value="2">
				@else
				<input type="hidden" name="change_check2" value="{{old('change_check2',1)}}">
				@endif



				<x-matter-rewrite-box :userdata="$user" type="1" :matter="$matter"/>
			@else
				<input type="hidden" name="allotted" value="{{old('allotted',$user->worktype->def_allotted)}}">
				<x-matter-box :userdata="$user" type="1"/>
			@endif
			<section id="task_area">
			<h5>　振替休暇情報 @isset($task_data) {{$task_data[0]['task_count']}} @endisset</h5>

				<fieldset>
					<div data-repeater-list="task_group">
					@if(session('old_task_group'))
						<x-task-rewrite-box :tasklist="Session::get('old_task_group')" :type="0"/>
					@else
						@isset($matter->tasklist)
						@foreach ($matter->tasklist as $task)
						<div class="task_form" data-repeater-item>
							<input type="hidden" name="id" value="{{$task->id}}">
							<input type="hidden" name="task_status" value="{{$task->task_status}}">
							<div class="grid">
								<label class="g12">振替予定日</label>
								<input type="text" class="g23 target2" name='task_change_date' autocomplete="off" value="{{$task->task_change_date}}">
							</div>

							<div class="grid">
								<label class="g12">開始時間</label>
								<div class="g23">
									<input type="number" name="task_hour1" class="task_hour1" value="{{$task->task_hour1}}" autocomplete="off">
									<input type="number" name="task_minutes1" class="task_minutes1" value="{{$task->task_minutes1}}" autocomplete="off">
								</div>
								<label class="g34">終了時間</label>
								<div class="g45">
									<input type="number" name="task_hour2" class="task_hour2" value="{{$task->task_hour2}}" autocomplete="off">
									<input type="number" name="task_minutes2" class="task_minutes2" value="{{$task->task_minutes2}}" autocomplete="off">
								</div>

								<label class="g56">休憩時間</label>
								<div class="g67">
									<input type="number" class="task_break" name="task_breaktime"  min="0" max="60" value="{{$task->task_breaktime}}" autocomplete="off">
								</div>
							</div>
							<div class="grid">
								<label class="g12">振替時間</label>
								<label class="task_hour3 g34">{{intdiv($task->task_allotted,60)}}時間</label>
								<label class="task_minutes3 g45">{{$task->task_allotted%60}}分</label>
								<input type="hidden" class="task_allotted" name="task_allotted" value="{{$task->task_allotted}}">
							</div>
						</div>

						@endforeach
						@endisset

						<div class="task_form" data-repeater-item>
							<div class="grid">
								<label class="g12">振替予定日</label>
								<input type="text" class="g23 target2" name='task_change_date' autocomplete="off" value="{{old('task_change_date')}}">
							</div>
							<div class="grid">
								<label class="g12">開始時間</label>
								<div class="g23">
									<input type="number" name="task_hour1" class="task_hour1" value="{{old('task_hour1')}}" autocomplete="off">
									<input type="number" name="task_minutes1" class="task_minutes1" value="{{old('task_minutes1')}}" min="0" max="59"  autocomplete="off">
								</div>
								<label class="g34">終了時間</label>
								<div class="g45">
									<input type="number" name="task_hour2" class="task_hour2" value="{{old('task_hour2')}}" autocomplete="off">
									<input type="number" name="task_minutes2" class="task_minutes2" value="{{old('task_minutes2')}}" min="0" max="59" autocomplete="off">
								</div>

								<label class="g56">休憩時間</label>
								<div class="g67">
									<input type="number" class="task_break" name="task_breaktime" value="0" min="0" max="60" value="{{old('task_break')}}" autocomplete="off">
								</div>
							</div>
							<div class="grid">
								<label class="g12">振替時間</label>
								<label class="task_hour3 g34"></label><label class="task_minutes3 g45"></label>
								<input type="hidden" class="task_allotted" name="task_allotted" value="0">
							</div>

						</div>
						@endif
					</div>
					<div>
						<div class="g23 text_right">
							<span class="round-btn" data-repeater-create>振替日追加＋</span>
						</div>
					</div>
					<div>
						<label class="g12">合計振替休暇時間</label>

						@isset($matter->tasklist)
						<div class="g23 text_right"><label class="task_time_alert"></label><label class="task_total">{{intdiv($task_data[0]['task_total'],60)}}時間{{$task_data[0]['task_total']%60}}分</label></div>
						@else
						<div class="g23 text_right"><label class="task_time_alert"></label><label class="task_total"></label></div>
						@endisset
					</div>
				</fieldset>
			</section>
			@isset($matter)
			@if($matter->status==5 && isset($matter->reject_content))
				<fieldset>
				<label class="text-danger">修正願い：{{$matter->reject_content}}</label>
				</fieldset><br>
			@endif
			@endisset
			@if(session('delete_check'))
				<input type="hidden" name="delete_check" value="{{old('delete_check')}}">
    			<div class="alert alert-danger">{{ session('delete_check') }}</div>
				<x-save-box :status="7" :role="0" :type="1"/>
			@elseif(isset($matter))
				@if($matter->user_id==Auth::user()->id)
					<x-save-box :status="$matter->status" :role="0" :type="1"/>
				@elseif(Auth::user()->role<3)
					<x-save-box :status="$matter->status" :role="1" :type="1"/>
				@elseif(Auth::user()->role==4)
					<x-save-box :status="$matter->status" :role="4" :type="1"/>

				@else
				<!-- <label>test</label> -->
				@endif
			@else
			<x-save-box :status="0" :role="0" :type="1"/>
			@endif

		</form>
	</div>
</div>


<script>
function setAction(url) {
    $('form').attr('action', url);

    $('form').submit();
}
$(function(){
	var radio = $('div.radio-group');
	$('input', radio).css({'opacity': '0'})
	//checkedだったら最初からチェックする
	.each(function(){
	    if ($(this).attr('checked') == 'checked') {
	        $(this).next().addClass('checked');
	        if($(this).val()==8){
		        $('#task_area').hide();

		    };
	    }
	});
	$('.repeater').repeater(
			{hide: function (deleteElement) {
				if(confirm('削除してもいいですか？')) {
					$(this).slideUp(deleteElement);
	        	}
			},
			show: function(){
				$('#task_area input[type="number"]').on('input', function () {
					var tf = $(this).closest('.task_form');
					var th1 = tf.find('.task_hour1').val()- 0;
					var th2 = tf.find('.task_hour2').val()- 0;
					var tm1 = tf.find('.task_minutes1').val()- 0;
					var tm2 = tf.find('.task_minutes2').val()- 0;
					var tbt = tf.find('.task_break').val()- 0;
					var tmt = ((th2*60+tm2)-(th1*60+tm1))-tbt;
					var twt = Math.floor(tmt/60);
					var tlt = tmt%60;
					tf.find('.task_hour3').text(twt+'時間');
					tf.find('.task_minutes3').text(tlt+'分');
					tf.find('.task_allotted').val(tmt);
					var tt=0;
					$('.task_allotted').each(function(){
						tt+=$(this).val()-0;
						});
					$('.task_total').text(Math.floor(tt/60)+'時間'+tt%60+'分');
					if(tt>{{$user->worktype->def_allotted}}){
						$('label.task_time_alert').text('基本勤務時間オーバー').addClass('text-danger');
					}else if(tt>$('input[name="allotted"]').val()){
						$('label.task_time_alert').text('振替勤務時間オーバー').addClass('text-danger');
					}else{
						$('label.task_time_alert').text('').removeClass('text-danger');
					}
				});
				 $(this).slideDown();
				}
			});

	$('label', radio).click(function() {
		if($(this).prev().val()!=7){
			$('#task_area').hide();
		}else{
			$('#task_area').show();
		}
		$(this).parent().parent().each(function() {
	        $('label',this).removeClass('checked');
	    });
	    $(this).addClass('checked');
	});


	$('#matter_area input[type="number"]').bind('input', function () {
		var h1 = $('input[name="hour1"]').val()- 0;
		var h2 = $('input[name="hour2"]').val()- 0;
		var m1 = $('input[name="minutes1"]').val()- 0;

		var m2 = $('input[name="minutes2"]').val()- 0;
		var bt = $('input[name="breaktime"]').val()- 0;
		var mt = ((h2*60+m2)-(h1*60+m1))-bt;
		//alert(m2);
		var wt = Math.floor(mt/60);
		var lt = mt%60;
		if(wt>4){
			$('input[name="breaktime"]').val('60');
			mt = ((h2*60+m2)-(h1*60+m1))-60;
			wt = Math.floor(mt/60);
			lt = mt%60;
		}
		$('label.hour3').text(wt+'時間');
		$('input[name="hour3"]').val(wt);
		$('label.minutes3').text(lt+'分');
		$('input[name="allotted"]').val(mt);
		//$('input[name="starttime"]').val(h1+":"+m1+":00");
		//$('input[name="endtime"]').val(h2+":"+m2+":00");
		if(mt>{{$user->worktype->def_allotted}}){
			$('label.time_alert').text('設定時間オーバー');
		}else{
			$('label.time_alert').text('');
		}
	});
	$('#task_area input[type="number"]').bind('input', function () {
		var tf = $(this).closest('.task_form');
		//tf.css('color', 'red');

		var th1 = tf.find('.task_hour1').val()- 0;

		var th2 = tf.find('.task_hour2').val()- 0;
		var tm1 = tf.find('.task_minutes1').val()- 0;
		var tm2 = tf.find('.task_minutes2').val()- 0;
		//var mdf1 =$('.mdef1').val()-0;
		//$('.mdef1').text(m1);
		//if(m1<30){
		//	$('.mdef2').text(m1+30);
		//}else{
		//	$('.mdef2').text(m1-30);
		//}
		//var m2 = $('select.minutes2').val()- 0;
		var tbt = tf.find('.task_break').val()- 0;
		var tmt = ((th2*60+tm2)-(th1*60+tm1))-tbt;
		//alert(tmt);
		var twt = Math.floor(tmt/60);
		var tlt = tmt%60;
		/* if(wt>4){
			$('input[name="breaktime"]').val('60');
			mt = ((h2*60+m2)-(h1*60+m1))-60;
			wt = Math.floor(mt/60);
			lt = mt%60;
		} */
		tf.find('.task_hour3').text(twt+'時間');
		tf.find('.task_minutes3').text(tlt+'分');
		tf.find('.task_allotted').val(tmt);
		var tt=0;
		$('.task_allotted').each(function(){
			tt+=$(this).val()-0;
			});
		$('.task_total').text(Math.floor(tt/60)+'時間'+tt%60+'分');

		if(tt>{{$user->worktype->def_allotted}}){
			$('label.task_time_alert').text('基本勤務時間オーバー').addClass('text-danger');
		}else if(tt>$('input[name="allotted"]').val()){
			$('label.task_time_alert').text('振替勤務時間オーバー').addClass('text-danger');
		}else{
			$('label.task_time_alert').text('').removeClass('text-danger');
		}
	});
	@empty($matter)
	$('.proxy_check').click(function() {

		$('.proxy_user').html('<select class="select_proxy"><option>---</option>{!!$userlist!!}</select')
		$('#matter_area').append('<input type="hidden" name="proxy_id" value="'+{{Auth::user()->id}}+'">')
		$('.select_proxy').change(function(){
			$('input[name="user_id"]').val($(this).val());
			});


		});
	@endisset
 });
</script>
</x-app-layout>
