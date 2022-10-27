<x-app-layout>
<x-slot name="head">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src='/shinsei2/public/js/jquery.repeater.js'></script>
	<script>
   $(function() {
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
		@if (session('save_check'))
    	<div class="alert alert-danger">{{ session('save_check') }}</div>
		<x-save-box :status="$matter->status"/>
		@endif
		@if(isset($matter->status))
		<h3>振替申請</h3>
		<p>作成日:{{$matter->created_at}}　　更新日:{{$matter->updated_at}}</p>
			<x-change-status :matter="$matter" />
		@else
		<h3>新規振替申請</h3>
		@endif
			<ul>
				@foreach($errors->all() as $err)
				<li class="text-danger">{{ $err }}</li> @endforeach
			</ul>

		<x-user-box :userdata="$user"/>

		<section>
			<h5>　通知</h5>
			<fieldset>
				<div>
					<div class="g12"><label>承認者</label></div>
					<div class="g23 text_right">水田浩子</div>
				</div>
				<div>
					<div class="g12"><label>通知先</label></div>
					<div class="g23 text_right">松金秀司</div>
				</div>

			</fieldset>
		</section>
		<form  method="post" action="save_ov" class="repeater"  >
			@csrf
			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">


			<!-- onsubmit="return false;"  -->
			@if(isset($matter))
				<input type="hidden" name="starttime" value="@hour($matter->starttime):@minutes($matter->starttime):00">
				<input type="hidden" name="endtime" value="@hour($matter->endtime):@minutes($matter->endtime):00">
				<input type="hidden" name="allotted" value="{{$matter->allotted}}">
				<input type="hidden" name="change_check" value="{{old('change_check',0)}}">
				<input type="hidden" name="change_check" value="{{old('change_check2',0)}}">
				<x-matter-rewrite-box :userdata="$user" :matter="$matter"/>

			@else
				<input type="hidden" name="starttime" value="@hour($user->worktype->setdate1):@minutes($user->worktype->setdate1):00">
				<input type="hidden" name="endtime" value="@hour($user->worktype->setdate2):@minutes($user->worktype->setdate2):00">
				<input type="hidden" name="allotted" value="{{$user->worktype->hours*60+$user->worktype->minutes}}">
				<input type="hidden" name="matter_type" value="1">
				<x-matter-box :userdata="$user"/>
			@endif
			<section id="task_area">
			<h5>　振替休暇情報</h5>

				<fieldset>
					<div data-repeater-list="task_group">
						<div class="task_form" data-repeater-item>
						<input type="hidden" name="matter_id" value="{{$matter->id}}">
							<div class="grid">
								<label class="g12">振替予定日</label>
								<input type="text" class="g23 target2" name='task_change_date' autocomplete="off" value="{{old('task_change_date')}}">
							</div>
							<div class="grid">
								<label class="g12">開始時間</label>
								<div class="g23">
									<input type="number" name="task_hour1" class="task_hour1" value="{{old('task_hour1')}}" autocomplete="off">
									<input type="number" name="task_minutes1" class="task_minutes1" value="{{old('task_minutes1')}}" autocomplete="off">
								</div>
								<label class="g34">終了時間</label>
								<div class="g45">
									<input type="number" name="task_hour2" value="{{old('task_hour2')}}" autocomplete="off">
									<input type="number" step="30" name="task_minutes2" value="{{old('task_minutes2')}}" autocomplete="off">
								</div>

								<label class="g56">休憩時間</label>
								<div class="g67">
									<input type="number" class="task_break" name="task_break" value="{{old('task_break')}}" autocomplete="off">
								</div>
							</div>
							<div class="grid">
								<label class="g12">振替時間</label>
								<label class="task_hour3 g34"></label><label class="task_minutes3 g45"></label>

							</div>

						</div>
					</div>
					<div>

						<div class="g23 text_right">
							<span data-repeater-create>＋</span>
						</div>
					</div>
					<div>
						<label class="g12">合計振替休暇時間</label>
						<div class="g23 text_right">○時間</div>
					</div>
				</fieldset>

			</section>
			@if(isset($matter))
				@if($matter->user_id==Auth::user()->id)
			<x-save-box :status="$matter->status"/>
				@endif
			@else
			<x-save-box :status="0"/>
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
	$('.repeater').repeater({hide: function (deleteElement) {
	      if(confirm('削除してもいいですか？')) {
	          $(this).slideUp(deleteElement);
	        }
	}});


	$('#matter_area input[type="number"],select.minutes2').bind('input', function () {
		var h1 = $('input.hour1').val()- 0;
		var h2 = $('input.hour2').val()- 0;
		var m1 = $('input.minutes1').val()- 0;
		var mdf1 =$('.mdef1').val()-0;
		$('.mdef1').text(m1);
		if(m1<30){
			$('.mdef2').text(m1+30);
		}else{
			$('.mdef2').text(m1-30);
		}
		var m2 = $('select.minutes2').val()- 0;
		var bt = $('input[name="breaktime"]').val()- 0;
		var mt = ((h2*60+m2)-(h1*60+m1))-bt;
		var wt = Math.floor(mt/60);
		var lt = mt%60;
		if(wt>4){
			$('input[name="breaktime"]').val('60');
			mt = ((h2*60+m2)-(h1*60+m1))-60;
			wt = Math.floor(mt/60);
			lt = mt%60;
		}
		$('label.hour3').text(wt+'時間');
		$('label.minutes3').text(lt+'分');
		$('input[name="allotted"]').val(mt);
		$('input[name="starttime"]').val(h1+":"+m1+":00");
		$('input[name="endtime"]').val(h2+":"+m2+":00");
		if(wt>{{$user->worktype->hours}}){
			$('label.time_alert').text('設定時間オーバー');
		}else if(wt=={{$user->worktype->hours}}&&lt>{{$user->worktype->minutes}}){
			$('label.time_alert').text('設定時間オーバー');
		}else{
			$('label.time_alert').text('');
			}
	});
	$('#task_area input[type="number"]').bind('input', function () {
		var tf = $(this).closest('.task_form');
		tf.css('color', 'red');

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
		alert(tmt);
		var twt = Math.floor(tmt/60);
		var tlt = tmt%60;
		/* if(wt>4){
			$('input[name="breaktime"]').val('60');
			mt = ((h2*60+m2)-(h1*60+m1))-60;
			wt = Math.floor(mt/60);
			lt = mt%60;
		} */
		$('label.task_hour3').text(twt+'時間');
		$('label.task_minutes3').text(tlt+'分');
		$('input[name="allotted"]').val(tmt);
		$('input[name="starttime"]').val(th1+":"+tm1+":00");
		$('input[name="endtime"]').val(th2+":"+tm2+":00");
		if(twt>{{$user->worktype->hours}}){
			$('label.time_alert').text('設定時間オーバー');
		}else if(twt=={{$user->worktype->hours}}&&tlt>{{$user->worktype->minutes}}){
			$('label.time_alert').text('設定時間オーバー');
		}else{
			$('label.time_alert').text('');
			}
	});
 });
</script>
</x-app-layout>
